<?php
/**
 * Uag Admin.
 *
 * @package Uag
 */

namespace Vexaltrix\Admin;

use Vexaltrix\Api\ApiInit;
use Vexaltrix\Ajax\AjaxInit;
use Vexaltrix\Admin\Dashboard;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Class \Vexaltrix\Admin\AdminCore\AdminLoader.
 */
class Loader {

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
		return \Vexaltrix\Container::getInstance()->get( self::class );
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
}
