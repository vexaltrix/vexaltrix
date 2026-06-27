<?php
/**
 * Vexaltrix IoC Container.
 *
 * @package Vexaltrix\Core
 * @since x.x.x
 */

namespace Vexaltrix\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Container
 *
 * A lightweight Inversion of Control (IoC) / Dependency Injection container
 * with support for singletons, factory bindings, and reflection-based auto-wiring.
 *
 * @since x.x.x
 */
class Container {

	/**
	 * Singleton instance of the container.
	 *
	 * @var Container|null
	 */
	private static $instance = null;

	/**
	 * Registered bindings.
	 *
	 * @var array<string, mixed>
	 */
	private $bindings = [];

	/**
	 * Resolved singleton instances.
	 *
	 * @var array<string, object>
	 */
	private $instances = [];

	/**
	 * Service aliases.
	 *
	 * @var array<string, string>
	 */
	private $aliases = [];

	/**
	 * Get the global instance of the container.
	 *
	 * @return Container
	 */
	public static function getInstance() {
		return self::instance();
	}

	/**
	 * Get the global instance of the container.
	 *
	 * @since x.x.x
	 * @return Container
	 */
	public static function instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Register a binding.
	 *
	 * @param string $id The service identifier (usually class name).
	 * @param mixed $concrete The concrete implementation (Closure, class name, or instance).
	 * @return void
	 */
	public function set( string $id, $concrete ) {
		$this->bind( $id, $concrete );
	}

	/**
	 * Register a binding.
	 *
	 * @param string $id The service identifier.
	 * @param mixed  $concrete The concrete implementation.
	 * @return void
	 */
	public function bind( string $id, $concrete ) {
		$this->bindings[ $id ] = $concrete;
	}

	/**
	 * Register a singleton binding.
	 *
	 * @param string $id The service identifier.
	 * @param mixed  $concrete The concrete implementation.
	 * @return void
	 */
	public function singleton( string $id, $concrete ) {
		$this->bindings[ $id ] = $concrete;
		unset( $this->instances[ $id ] );
	}

	/**
	 * Register an alias for a service identifier.
	 *
	 * @param string $alias Alias identifier.
	 * @param string $id Target service identifier.
	 * @return void
	 */
	public function alias( string $alias, string $id ) {
		if ( $alias !== $id && ! isset( $this->aliases[ $alias ] ) ) {
			$this->aliases[ $alias ] = $id;
		}
	}

	/**
	 * Determine whether a service has been bound or resolved.
	 *
	 * @param string $id The service identifier.
	 * @return bool
	 */
	public function has( string $id ) {
		$id = $this->normalizeId( $id );
		return isset( $this->bindings[ $id ] ) || isset( $this->instances[ $id ] ) || class_exists( $id );
	}

	/**
	 * Resolve and return a service.
	 *
	 * @param string $id The service identifier.
	 * @return mixed
	 * @throws \Exception If the class cannot be resolved.
	 */
	public function get( string $id ) {
		$id = $this->normalizeId( $id );

		if ( isset( $this->instances[ $id ] ) ) {
			return $this->instances[ $id ];
		}

		if ( ! isset( $this->bindings[ $id ] ) ) {
			$this->bindings[ $id ] = $id;
		}

		$concrete = $this->bindings[ $id ];
		$object   = null;

		if ( $concrete instanceof \Closure ) {
			$object = $concrete( $this );
		} elseif ( is_string( $concrete ) && class_exists( $concrete ) ) {
			$object = $this->resolve( $concrete );
		} else {
			$object = $concrete;
		}

		$this->instances[ $id ] = $object;
		return $object;
	}

	/**
	 * Resolve a class constructor dependencies using Reflection.
	 *
	 * Classes with private/protected constructors are NOT auto-resolved.
	 * Register them via $container->bind() with a closure factory instead.
	 *
	 * @param string $class Fully qualified class name.
	 * @return object
	 * @throws \Exception If the class is not instantiable or dependencies fail to resolve.
	 */
	private function resolve( string $class ) {
		$reflector = new \ReflectionClass( $class );

		if ( ! $reflector->isInstantiable() ) {
			throw new \Exception(
				"Class {$class} is not instantiable. Register it via \$container->bind() with a closure factory."
			);
		}

		$constructor = $reflector->getConstructor();

		if ( is_null( $constructor ) ) {
			return new $class();
		}

		$parameters   = $constructor->getParameters();
		$dependencies = [];

		foreach ( $parameters as $parameter ) {
			$type = $parameter->getType();
			$dep  = $type && ! $type->isBuiltin() ? $type->getName() : null;

			if ( is_null( $dep ) ) {
				if ( $parameter->isDefaultValueAvailable() ) {
					$dependencies[] = $parameter->getDefaultValue();
				} else {
					throw new \Exception( "Cannot resolve class dependency '{$parameter->getName()}' in {$class}." );
				}
			} else {
				$dependencies[] = $this->get( $dep );
			}
		}

		return $reflector->newInstanceArgs( $dependencies );
	}

	/**
	 * Resolve service aliases.
	 *
	 * @param string $id Service identifier.
	 * @return string
	 */
	private function normalizeId( string $id ) {
		return $this->aliases[ $id ] ?? $id;
	}
}
