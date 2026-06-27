<?php
/**
 * Api Init.
 *
 * @package uag
 */

namespace Vexaltrix\Transport\Api;

use Vexaltrix\Core\Contracts\ServiceInterface;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class \Vexaltrix\Transport\Api\ApiInit.
 */
class ApiInit implements ServiceInterface {

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
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
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
			'\Vexaltrix\Transport\Api\CommonSettings',
		];
		$container = \Vexaltrix\Core\Container::instance();

		foreach ( $controllers as $controller ) {
			$this->$controller = $container->get( $controller );
			$this->{$controller}->registerRoutes();
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
		return 'always';
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
