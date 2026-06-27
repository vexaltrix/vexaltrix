<?php
/**
 * AbstractModule — base class for all Vexaltrix modules.
 *
 * Every module lives entirely in modules/{slug}/:
 *   modules/{slug}/{Name}Module.php     ← this class
 *   modules/{slug}/block.json           ← block metadata (if any)
 *   modules/{slug}/src/                 ← React / JS source
 *   modules/{slug}/languages/           ← module-specific .po files
 *
 * Compiled JS lands in:
 *   assets/build/modules/{slug}/index.js
 *   assets/build/modules/{slug}/frontend.js
 *
 * @package Vexaltrix\Core\Module
 * @author  Huu Ha <huuhadev@gmail.com>
 * @link    https://vexaltrix.com
 */
declare(strict_types=1);

namespace Vexaltrix\Core\Module;

use Vexaltrix\Core\Module\ModuleInterface;
use Vexaltrix\Core\Registry\ServiceRegistry;
use Vexaltrix\Core\Support\AssetHelper;

abstract class AbstractModule implements ModuleInterface {

    public function __construct( protected ServiceRegistry $services ) {}

    // ── Defaults (override in concrete modules as needed) ────────────────────

    public function version(): string {
        return VXT_VER;
    }

    public function dependencies(): array {
        return [];
    }

    /**
     * Return admin asset data for this module's settings card.
     * The built file is expected at assets/build/modules/{slug}/index.js.
     * Returns null when no built file exists (module has no admin UI).
     *
     * @return array{url: string, deps: string[], version: string}|null
     */
    public function adminAssets(): ?array {
        $slug  = $this->slug();
        $built = VEXALTRIX_PATH . "assets/build/modules/{$slug}/index.js";

        if ( ! file_exists( $built ) ) {
            return null;
        }

        $asset = AssetHelper::assetData( "modules/{$slug}/index" );

        return [
            'url'     => AssetHelper::buildUrl( "modules/{$slug}/index.js" ),
            'deps'    => $asset['dependencies'],
            'version' => $asset['version'],
        ];
    }

    // ── Helpers available to concrete modules ────────────────────────────────

    /**
     * Namespaced asset handle: vexaltrix-module-{slug}-{suffix}
     */
    protected function handle( string $suffix = '' ): string {
        $base = "vexaltrix-module-{$this->slug()}";
        return $suffix ? "{$base}-{$suffix}" : $base;
    }

    /**
     * REST sub-path for this module: modules/{slug}
     */
    protected function restBase(): string {
        return "modules/{$this->slug()}";
    }

    /**
     * Fire a namespaced WP action: vexaltrix/module/{slug}/{hook}
     */
    protected function doAction( string $hook, mixed ...$args ): void {
        do_action( "vexaltrix/module/{$this->slug()}/{$hook}", $this, ...$args );
    }

    /**
     * Apply a namespaced WP filter: vexaltrix/module/{slug}/{hook}
     */
    protected function applyFilter( string $hook, mixed $value, mixed ...$args ): mixed {
        return apply_filters( "vexaltrix/module/{$this->slug()}/{$hook}", $value, $this, ...$args );
    }
}
