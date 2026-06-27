<?php
/**
 * Service Discovery — auto-discovers and boots services from the 5 layer folders.
 *
 * @package Vexaltrix\Core
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Core;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Auto-discovers all ServiceInterface implementations in the 5 layer
 * namespaces using Composer's optimized classmap. Boots them in
 * deterministic group order: infrastructure → domain → integration →
 * presentation → transport.
 *
 * @since x.x.x
 */
final class ServiceDiscovery {

	/**
	 * Group boot order — infrastructure first, transport last.
	 *
	 * @var array<string, int>
	 */
	private const GROUP_ORDER = [
		'infrastructure' => 1,
		'domain'         => 2,
		'integration'    => 3,
		'presentation'   => 4,
		'transport'      => 5,
	];

	/**
	 * Namespace prefixes for each layer folder.
	 *
	 * @var string[]
	 */
	private const LAYER_PREFIXES = [
		'Vexaltrix\\Infrastructure\\',
		'Vexaltrix\\Domain\\',
		'Vexaltrix\\Integration\\',
		'Vexaltrix\\Presentation\\',
		'Vexaltrix\\Transport\\',
	];

	/**
	 * Resolved service instances.
	 *
	 * @var ServiceInterface[]
	 */
	private array $resolved = [];

	/**
	 * Constructor.
	 *
	 * @param Container $container IoC container.
	 */
	public function __construct( private readonly Container $container ) {}

	/**
	 * Discover and boot all services matching the current context, in group order.
	 *
	 * @return void
	 */
	public function boot(): void {
		$context  = self::resolveContext();
		$services = $this->discover();

		// Sort: first by group order, then by priority within group.
		usort( $services, function ( ServiceInterface $a, ServiceInterface $b ) {
			$groupA = self::GROUP_ORDER[ $a::group() ] ?? 99;
			$groupB = self::GROUP_ORDER[ $b::group() ] ?? 99;

			if ( $groupA !== $groupB ) {
				return $groupA <=> $groupB;
			}

			return $a::priority() <=> $b::priority();
		} );

		foreach ( $services as $service ) {
			$ctx = $service::context();
			if ( 'always' === $ctx || $ctx === $context ) {
				$service->boot();
			}
		}
	}

	/**
	 * Discover all ServiceInterface implementations in the layer namespaces.
	 * Uses Composer's optimized classmap — no filesystem scanning needed.
	 *
	 * @return ServiceInterface[]
	 */
	private function discover(): array {
		if ( ! empty( $this->resolved ) ) {
			return $this->resolved;
		}

		$classmapFile = VXT_DIR . 'vendor/composer/autoload_classmap.php';
		if ( ! file_exists( $classmapFile ) ) {
			return [];
		}

		$classmap = require $classmapFile;

		foreach ( $classmap as $class => $file ) {
			// Only scan the 5 layer namespaces.
			$inLayer = false;
			foreach ( self::LAYER_PREFIXES as $prefix ) {
				if ( str_starts_with( $class, $prefix ) ) {
					$inLayer = true;
					break;
				}
			}

			if ( ! $inLayer ) {
				continue;
			}

			if ( is_subclass_of( $class, ServiceInterface::class ) ) {
				$this->resolved[] = $this->container->get( $class );
			}
		}

		return $this->resolved;
	}

	/**
	 * Determine the current request context.
	 *
	 * @return string
	 */
	private static function resolveContext(): string {
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return 'cli';
		}
		if ( wp_doing_cron() ) {
			return 'cron';
		}
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return 'rest';
		}
		if ( is_admin() ) {
			return 'admin';
		}
		return 'frontend';
	}
}
