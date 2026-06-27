<?php
/**
 * Ajax Errors.
 *
 * @package uag
 */

namespace Vexaltrix\Ajax;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class \Vexaltrix\Ajax\AjaxErrors
 */
class AjaxErrors {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 2.0.0
	 */
	private static $instance;

	/**
	 * Errors
	 *
	 * @access private
	 * @var array Errors strings.
	 * @since 2.0.0
	 */
	private static $errors = [];

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

		/**
		 * Hooks the method to initialize error messages.
		 *
		 * @uses add_action()
		 * @uses self::initializeErrors()
		 * @since 2.17.0
		 */
		add_action(
			'init',
			[ $this, 'initializeErrors' ],
			10, // priority - run after WordPress has finished loading but before any output is sent.
			0   // number of arguments - default is 1.
		);
	}

	/**
	 * Initializes error messages.
	 *
	 * @since 2.17.0
	 * @access public
	 * @return void
	 */
	public function initializeErrors() {
		self::$errors = [
			'permission' => __( 'Sorry, you are not allowed to do this operation.', 'vexaltrix' ),
			'nonce'      => __( 'Nonce validation failed', 'vexaltrix' ),
			'default'    => __( 'Sorry, something went wrong.', 'vexaltrix' ),
		];
	}

	/**
	 * Get error message.
	 *
	 * @param string $type Message type.
	 * @return string
	 */
	public function getErrorMsg( $type ) {

		if ( ! isset( self::$errors[ $type ] ) ) {
			$type = 'default';
		}

		return self::$errors[ $type ];
	}
}
