<?php
/**
 * Ajax Initialize.
 *
 * @package uag
 */

namespace Vexaltrix\Transport\Ajax;

use Vexaltrix\Core\Contracts\ServiceInterface;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class \Vexaltrix\Transport\Ajax\AjaxInit.
 */
class AjaxInit implements ServiceInterface {

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
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
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
			'\Vexaltrix\Transport\Ajax\CommonSettings',
		];
		$container = \Vexaltrix\Core\Container::instance();

		foreach ( $controllers as $controller ) {
			$this->$controller = $container->get( $controller );
			$this->{$controller}->registerAjaxEvents();
		}
	}

	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'transport';
	}

	/**
	 * Service context.
	 *
	 * @return string
	 */
	public static function context(): string {
		return 'admin';
	}

	/**
	 * Boot priority.
	 *
	 * @return int
	 */
	public static function priority(): int {
		return 10;
	}

	/**
	 * Register actions and filters.
	 *
	 * @return void
	 */
	public function boot(): void {
		// Auto-generated boot method.
	}

}
