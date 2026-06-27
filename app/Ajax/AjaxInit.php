<?php
/**
 * Ajax Initialize.
 *
 * @package uag
 */

namespace Vexaltrix\Ajax;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class \Vexaltrix\Ajax\AjaxInit.
 */
class AjaxInit {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 2.0.0
	 */
	private static $instance;

	/**
	 * Dynamic properties container
	 *
	 * @var array
	 * @since 2.7.10
	 */
	private $dynamicProperties = [];

	/**
	 * Initiator
	 *
	 * @since 2.0.0
	 * @return object initialized object of class.
	 */
	public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 */
	public function __construct() {

		$this->initializeHooks();
	}

	/**
	 * Init Hooks.
	 *
	 * @since 2.0.0
	 * @return void
	 */
	public function initializeHooks() {
		$this->registerAllAjaxEvents();
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
	 * Register Ajax actions.
	 */
	public function registerAllAjaxEvents() {

		$controllers = [
			'\Vexaltrix\Ajax\CommonSettings',
		];
		$container = \Vexaltrix\Container::instance();

		foreach ( $controllers as $controller ) {
			$this->$controller = $container->get( $controller );
			$this->{$controller}->registerAjaxEvents();
		}
	}
}
