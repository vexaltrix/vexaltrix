<?php
/**
 * Api Init.
 *
 * @package uag
 */

namespace Vexaltrix\Api;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class \Vexaltrix\Api\ApiInit.
 */
class ApiInit {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Dynamic properties container
	 *
	 * @since 2.7.10
	 * @var array
	 */
	private $dynamicProperties = [];

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object initialized object of class.
	 */
	public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->initializeHooks();
	}

	/**
	 * Init Hooks.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function initializeHooks() {

		// REST API extensions init.
		add_action( 'rest_api_init', [ $this, 'registerRoutes' ] );
	}

	/**
	 * Init dynamic property setter
	 *
	 * @param string $name  Property name.
	 * @param mixed  $value Property value.
	 *
	 * @since 2.7.10
	 * @return void
	 */
	public function __set( $name, $value ) {
		$this->dynamicProperties[ $name ] = $value;
	}

	/**
	 * Init dynamic property getter
	 *
	 * @param string $name Property name.
	 *
	 * @since 2.7.10
	 * @return mixed Property value if set, null otherwise.
	 */
	public function __get( $name ) {
		return isset( $this->dynamicProperties[ $name ] ) ? $this->dynamicProperties[ $name ] : null;
	}

	/**
	 * Register API routes.
	 */
	public function registerRoutes() {

		$controllers = [
			'\Vexaltrix\Api\CommonSettings',
		];
		$container = \Vexaltrix\Container::instance();

		foreach ( $controllers as $controller ) {
			$this->$controller = $container->get( $controller );
			$this->{$controller}->registerRoutes();
		}
	}
}
