<?php
/**
 * Ajax Base.
 *
 * @package uag
 */

namespace Vexaltrix\Core\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Vexaltrix\Transport\Ajax\AjaxErrors;

/**
 * Class \Vexaltrix\Core\Base\AjaxController.
 */
abstract class AjaxController {

	/**
	 * Ajax action prefix.
	 *
	 * @var string
	 */
	private $prefix = VXT_AJAX_PREFIX;

	/**
	 * Legacy Ajax action prefix.
	 *
	 * @var string
	 */
	private $legacyPrefix = 'vxt';

	/**
	 * Erros class instance.
	 *
	 * @var object
	 */
	public $errors = null;

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 */
	public function __construct() {

		$this->errors = AjaxErrors::getInstance();
	}

	/**
	 * Register ajax events.
	 *
	 * @param array $ajaxEvents Ajax events.
	 */
	public function initAjaxEvents( $ajaxEvents ) {

		if ( ! empty( $ajaxEvents ) ) {

			foreach ( $ajaxEvents as $ajaxEvent ) {
				add_action( 'wp_ajax_' . $this->prefix . '_' . $ajaxEvent, [ $this, $ajaxEvent ] );
				add_action( 'wp_ajax_' . $this->legacyPrefix . '_' . $ajaxEvent, [ $this, $ajaxEvent ] );

				$snakeCaseEvent = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', $ajaxEvent ) );
				if ( $snakeCaseEvent !== $ajaxEvent ) {
					add_action( 'wp_ajax_' . $this->prefix . '_' . $snakeCaseEvent, [ $this, $ajaxEvent ] );
					add_action( 'wp_ajax_' . $this->legacyPrefix . '_' . $snakeCaseEvent, [ $this, $ajaxEvent ] );
				}

				$this->localizeAjaxActionNonce( $ajaxEvent );
			}
		}
	}

	/**
	 * Localize nonce for ajax call.
	 *
	 * @param string $action Action name.
	 * @return void
	 */
	public function localizeAjaxActionNonce( $action ) {

		if ( current_user_can( 'manage_options' ) ) {

			add_filter(
				'vxt_react_admin_localize',
				function( $localize ) use ( $action ) {

					$localize[ $action . '_nonce' ] = wp_create_nonce( $this->prefix . '_' . $action );

					$snakeCaseAction = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', $action ) );
					if ( $snakeCaseAction !== $action ) {
						$localize[ $snakeCaseAction . '_nonce' ] = wp_create_nonce( $this->prefix . '_' . $snakeCaseAction );
					}

					return $localize;
				}
			);

		}
	}


	/**
	 * Get ajax error message.
	 *
	 * @param string $type Message type.
	 * @return string
	 */
	public function getErrorMsg( $type ) {

		return $this->errors->getErrorMsg( $type );
	}
}
