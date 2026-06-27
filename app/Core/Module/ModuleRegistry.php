<?php
/**
 * ModuleRegistry — discovers, stores and conditionally boots modules.
 *
 * Flow:
 *  1. Plugin::init() calls register($moduleClass) for every known module.
 *  2. On WordPress `init` (priority 5) boot() is called.
 *  3. boot() reads enabled slugs from the DB, resolves dependency order,
 *     then calls AbstractModule::boot() for each enabled module.
 *
 * Enabling / disabling:
 *  - Stored in WP option `vexaltrix_modules` as array<slug, bool>.
 *  - The REST endpoint PATCH /vexaltrix/v1/modules/{slug}/toggle updates
 *    the option and triggers the `vexaltrix/module/{slug}/enabled` or
 *    `vexaltrix/module/{slug}/disabled` action so modules can react.
 *
 * @package Vexaltrix\Core\Module
 * @author  Huu Ha <huuhadev@gmail.com>
 * @link    https://vexaltrix.com
 */
declare(strict_types=1);

namespace Vexaltrix\Core\Module;

use Vexaltrix\Core\Module\ModuleInterface;
use Vexaltrix\Core\Registry\ServiceRegistry;

final class ModuleRegistry {

    private const OPTION_KEY = 'vexaltrix_modules';

    /** @var array<string, ModuleInterface> slug → instance */
    private array $modules = [];

    /** @var array<string, bool> slug → enabled */
    private array $states = [];

    /** @var array<string, bool> slug → booted */
    private array $booted = [];

    public function __construct( private readonly ServiceRegistry $services ) {}

    // -----------------------------------------------------------------------
    // Registration
    // -----------------------------------------------------------------------

    /**
     * Register a module class. Called during plugin bootstrap (before `init`).
     *
     * @param class-string $moduleClass
     */
    public function register( string $moduleClass ): void {
        if ( ! class_exists( $moduleClass ) ) {
            return;
        }

        $module = new $moduleClass( $this->services );

        if ( ! ( $module instanceof ModuleInterface ) ) {
            return;
        }

        $this->modules[ $module->slug() ] = $module;

        // Allow external code to register modules:
        // add_filter('vexaltrix/modules/register', fn($m) => [...$m, MyModule::class]);
        do_action( 'vexaltrix/module/registered', $module );
    }

    // -----------------------------------------------------------------------
    // Booting
    // -----------------------------------------------------------------------

    /**
     * Boot all enabled modules. Hooked on WordPress `init` priority 5.
     */
    public function boot(): void {
        $this->states = $this->loadStates();

        // Allow third-party code to force-enable/disable modules before boot.
        $this->states = (array) apply_filters( 'vexaltrix/modules/states', $this->states );

        $ordered = $this->resolveOrder();

        foreach ( $ordered as $slug ) {
            if ( $this->isEnabled( $slug ) ) {
                $this->bootModule( $slug );
            }
        }

        do_action( 'vexaltrix/modules/booted', $this );
    }

    /**
     * Boot a single module (idempotent).
     */
    private function bootModule( string $slug ): void {
        if ( isset( $this->booted[ $slug ] ) || ! isset( $this->modules[ $slug ] ) ) {
            return;
        }

        // Ensure dependencies are booted first.
        foreach ( $this->modules[ $slug ]->dependencies() as $dep ) {
            if ( $this->isEnabled( $dep ) ) {
                $this->bootModule( $dep );
            }
        }

        $this->modules[ $slug ]->boot();
        $this->booted[ $slug ] = true;

        do_action( "vexaltrix/module/{$slug}/booted", $this->modules[ $slug ] );
    }

    // -----------------------------------------------------------------------
    // Enable / Disable
    // -----------------------------------------------------------------------

    /**
     * Enable a module and persist the state.
     *
     * @return true|\WP_Error
     */
    public function enable( string $slug ): true|\WP_Error {
        if ( ! isset( $this->modules[ $slug ] ) ) {
            return new \WP_Error( 'vexaltrix_module_not_found', "Module '{$slug}' not found." );
        }

        // Check dependencies.
        foreach ( $this->modules[ $slug ]->dependencies() as $dep ) {
            if ( ! $this->isEnabled( $dep ) ) {
                return new \WP_Error(
                    'vexaltrix_module_dependency',
                    sprintf(
                        /* translators: 1: module slug, 2: dependency slug */
                        __( 'Module "%1$s" requires "%2$s" to be enabled first.', 'vexaltrix' ),
                        $slug,
                        $dep
                    )
                );
            }
        }

        $this->states[ $slug ] = true;
        $this->persistStates();

        do_action( "vexaltrix/module/{$slug}/enabled", $this->modules[ $slug ] );
        do_action( 'vexaltrix/module/enabled', $slug, $this->modules[ $slug ] );

        return true;
    }

    /**
     * Disable a module and persist the state.
     *
     * @return true|\WP_Error
     */
    public function disable( string $slug ): true|\WP_Error {
        if ( ! isset( $this->modules[ $slug ] ) ) {
            return new \WP_Error( 'vexaltrix_module_not_found', "Module '{$slug}' not found." );
        }

        // Prevent disabling if other enabled modules depend on this one.
        foreach ( $this->modules as $otherSlug => $module ) {
            if ( $otherSlug !== $slug && $this->isEnabled( $otherSlug ) ) {
                if ( in_array( $slug, $module->dependencies(), true ) ) {
                    return new \WP_Error(
                        'vexaltrix_module_dependency',
                        sprintf(
                            /* translators: 1: module slug, 2: dependent module slug */
                            __( 'Cannot disable "%1$s" because "%2$s" depends on it.', 'vexaltrix' ),
                            $slug,
                            $otherSlug
                        )
                    );
                }
            }
        }

        $this->states[ $slug ] = false;
        $this->persistStates();

        do_action( "vexaltrix/module/{$slug}/disabled", $this->modules[ $slug ] );
        do_action( 'vexaltrix/module/disabled', $slug, $this->modules[ $slug ] );

        return true;
    }

    // -----------------------------------------------------------------------
    // Queries
    // -----------------------------------------------------------------------

    public function isEnabled( string $slug ): bool {
        return (bool) ( $this->states[ $slug ] ?? false );
    }

    public function isBooted( string $slug ): bool {
        return isset( $this->booted[ $slug ] );
    }

    /** @return ModuleInterface[] */
    public function all(): array {
        return $this->modules;
    }

    public function get( string $slug ): ?ModuleInterface {
        return $this->modules[ $slug ] ?? null;
    }

    /**
     * Return the full status payload (used by the REST API and admin UI).
     *
     * @return array<string, array{slug: string, label: string, description: string, version: string, enabled: bool, booted: bool, dependencies: string[]}>
     */
    public function status(): array {
        $out = [];

        foreach ( $this->modules as $slug => $module ) {
            $out[ $slug ] = [
                'slug'         => $slug,
                'label'        => $module->label(),
                'description'  => $module->description(),
                'version'      => $module->version(),
                'enabled'      => $this->isEnabled( $slug ),
                'booted'       => $this->isBooted( $slug ),
                'dependencies' => $module->dependencies(),
                'adminAssets'  => $module->adminAssets(),
            ];
        }

        return $out;
    }

    // -----------------------------------------------------------------------
    // Internals
    // -----------------------------------------------------------------------

    /** @return array<string, bool> */
    private function loadStates(): array {
        return (array) get_option( self::OPTION_KEY, [] );
    }

    private function persistStates(): void {
        update_option( self::OPTION_KEY, $this->states );
    }

    /**
     * Topological sort so dependencies always boot before dependents.
     *
     * @return string[]
     */
    private function resolveOrder(): array {
        $visited = [];
        $order   = [];

        $visit = function ( string $slug ) use ( &$visit, &$visited, &$order ): void {
            if ( isset( $visited[ $slug ] ) ) {
                return;
            }
            $visited[ $slug ] = true;

            if ( isset( $this->modules[ $slug ] ) ) {
                foreach ( $this->modules[ $slug ]->dependencies() as $dep ) {
                    $visit( $dep );
                }
            }

            $order[] = $slug;
        };

        foreach ( array_keys( $this->modules ) as $slug ) {
            $visit( $slug );
        }

        return $order;
    }
}
