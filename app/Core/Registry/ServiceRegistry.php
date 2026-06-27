<?php
/**
 * Service Registry — lightweight wrapper around Container for Module system.
 *
 * @package Vexaltrix\Core\Registry
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Core\Registry;

use Vexaltrix\Core\Container;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Service Registry — provides a stable API for modules and extensions
 * to resolve services without depending on the Container directly.
 *
 * @since x.x.x
 */
final class ServiceRegistry {

	/**
	 * Constructor.
	 *
	 * @param Container $container IoC container.
	 */
	public function __construct( private readonly Container $container ) {}

	/**
	 * Resolve a service by class name.
	 *
	 * @param string $class Fully qualified class name.
	 * @return object
	 */
	public function get( string $class ): object {
		return $this->container->get( $class );
	}

	/**
	 * Check if a service is registered.
	 *
	 * @param string $class Fully qualified class name.
	 * @return bool
	 */
	public function has( string $class ): bool {
		return $this->container->has( $class );
	}

	/**
	 * Register a binding.
	 *
	 * @param string $id       Service identifier.
	 * @param mixed  $concrete Concrete implementation.
	 * @return void
	 */
	public function bind( string $id, mixed $concrete ): void {
		$this->container->bind( $id, $concrete );
	}

	/**
	 * Register a singleton binding.
	 *
	 * @param string $id       Service identifier.
	 * @param mixed  $concrete Concrete implementation.
	 * @return void
	 */
	public function singleton( string $id, mixed $concrete ): void {
		$this->container->singleton( $id, $concrete );
	}
}
