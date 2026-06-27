<?php
/**
 * Service provider base.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Base;

use Vexaltrix\Container;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Base service provider.
 *
 * @since x.x.x
 */
abstract class ServiceProvider {

	/**
	 * IoC container.
	 *
	 * @var Container
	 */
	protected $container;

	/**
	 * Constructor.
	 *
	 * @param Container $container IoC container.
	 */
	public function __construct( Container $container ) {
		$this->container = $container;
	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {}

	/**
	 * Boot services.
	 *
	 * @return void
	 */
	public function boot() {}
}
