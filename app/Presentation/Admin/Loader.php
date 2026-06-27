<?php
/**
 * Uag Admin.
 *
 * @package Uag
 */

namespace Vexaltrix\Presentation\Admin;

use Vexaltrix\Core\Contracts\ServiceInterface;

use Vexaltrix\Transport\Api\ApiInit;
use Vexaltrix\Transport\Ajax\AjaxInit;
use Vexaltrix\Presentation\Admin\Dashboard;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class \Vexaltrix\Presentation\Admin\AdminCore\AdminLoader.
 */
class Loader implements ServiceInterface {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 2.0.0
	 */
	private static $instance;

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
		$this->defineConstants();
		$this->setupClasses();
	}

	/**
	 * Include required classes.
	 */
	public function defineConstants() {
		define( 'VXT_ADMIN_DIR', VXT_DIR . 'packages/admin-ui/' );
		define( 'VXT_ADMIN_URL', VXT_URL . 'packages/admin-ui/' );
	}

	/**
	 * Include required classes.
	 */
	public function setupClasses() {

		/* Init API */
		ApiInit::getInstance();

		if ( is_admin() ) {
			/* Setup Menu */
			Dashboard::instance();

			/* Ajax init */
			AjaxInit::getInstance();
		}
	}

	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'presentation';
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
		return 1;
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
