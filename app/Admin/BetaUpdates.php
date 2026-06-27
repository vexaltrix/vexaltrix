<?php
/**
 * Vexaltrix Beta Updates.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Admin\\BetaUpdates' ) ) {

	/**
	 * Class \Vexaltrix\Admin\BetaUpdates.
	 */
	final class BetaUpdates {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Transient key.
		 *
		 * Holds the UAG beta updates transient key.
		 *
		 * @since 1.23.0
		 * @access private
		 * @static
		 *
		 * @var string Transient key.
		 */
		private $transientKey;

		/**
		 *  Initiator
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 *
		 * @since 1.23.0
		 */
		public function __construct() {

			if ( 'yes' !== get_option( 'vxt_ultimate_gutenberg_blocks_beta', 'no' ) ) {
				return;
			}

			$this->transientKey = md5( 'vxt_ultimate_gutenberg_blocks_beta_testers_response_key' );

			add_filter( 'pre_set_site_transient_update_plugins', [ $this, 'checkVersion' ] );

		}

		/**
		 * Get beta version.
		 *
		 * Retrieve UAG beta version from wp.org plugin repository.
		 *
		 * @since 1.23.0
		 * @access private
		 *
		 * @return string|false Beta version or false.
		 */
		private function getBetaVersion() {

			$betaVersion = get_site_transient( $this->transientKey );

			if ( false === $betaVersion ) {
				$betaVersion = 'false';

				$response = wp_remote_get( 'https://plugins.svn.wordpress.org/vexaltrix/trunk/readme.txt' );

				if ( ! is_wp_error( $response ) && ! empty( $response['body'] ) ) {
					preg_match( '/Beta tag: (.*)/i', $response['body'], $matches );
					if ( isset( $matches[1] ) ) {
						$betaVersion = $matches[1];
					}
				}

				set_site_transient( $this->transientKey, $betaVersion, 6 * HOUR_IN_SECONDS );
			}

			return $betaVersion;
		}

		/**
		 * Check version.
		 *
		 * Checks whether a beta version exist, and retrieve the version data.
		 *
		 * Fired by `pre_set_site_transient_update_plugins` filter, before WordPress
		 * runs the plugin update checker.
		 *
		 * @since 1.23.0
		 * @access public
		 *
		 * @param object $transient Plugin version data.
		 *
		 * @return array Plugin version data.
		 */
		public function checkVersion( $transient ) {

			if ( empty( $transient->checked ) ) {
				return $transient;
			}

			delete_site_transient( $this->transientKey );

			$pluginSlug = basename( VXT_FILE, '.php' );

			$betaVersion = $this->getBetaVersion();

			if ( 'false' !== $betaVersion && version_compare( $betaVersion, VXT_VER, '>' ) ) {
				$response              = new \stdClass();
				$response->plugin      = $pluginSlug;
				$response->slug        = $pluginSlug;
				$response->new_version = $betaVersion;
				$response->url         = 'https://wpvexaltrix.com/';
				$response->package     = sprintf( 'https://downloads.wordpress.org/plugin/vexaltrix.%s.zip', $betaVersion );

				$transient->response[ VXT_BASE ] = $response;
			}

			return $transient;
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\\Admin\\BetaUpdates' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
