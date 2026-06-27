<?php
/**
 * Init
 *
 * Loads latest UTM Analytics library in environment.
 *
 * @since 2.19.2
 * @package UTM Analytics
 */


namespace Vexaltrix\Integrations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\\UtmAnalytics' ) ) :

	/**
	 * Admin
	 */
	class UtmAnalytics {

		/**
		 * Instance
		 *
		 * @since 2.19.2
		 * @var (Object) VXT_Utm_Analytics
		 */
		private static $instance = null;

		/**
		 * Get Instance
		 *
		 * @since 2.19.2
		 *
		 * @return object Class object.
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor.
		 *
		 * @since 2.19.2
		 */
		private function __construct() {
			$this->versionCheck();
			add_action( 'init', [ $this, 'load' ], 999 );
		}

		/**
		 * Version Check
		 *
		 * @return void
		 */
		public function versionCheck() {

			$file = realpath( VXT_DIR . 'app/lib/utm-analytics/version.json' );

			// Is file exist?
			if ( is_file( $file ) ) {
				// @codingStandardsIgnoreStart
				$fileData = json_decode( file_get_contents( $file ), true );
				// @codingStandardsIgnoreEnd
				global $utmAnalyticsVersion, $utmAnalyticsInit;
				$path = realpath( VXT_DIR . 'app/lib/utm-analytics/bsf-utm-analytics.php' );
				$version = isset( $fileData['bsf-utm-analytics'] ) ? $fileData['bsf-utm-analytics'] : 0;

				if ( null === $utmAnalyticsVersion ) {
					$utmAnalyticsVersion = '0.0.1';
				}

				// Compare versions.
				if ( version_compare( $version, $utmAnalyticsVersion, '>=' ) ) {
					$utmAnalyticsVersion = $version;
					$utmAnalyticsInit = $path;
				}
			}
		}

		/**
		 * Load latest plugin
		 *
		 * @return void
		 */
		public function load() {

			global $utmAnalyticsVersion, $utmAnalyticsInit;
			if ( is_file( realpath( $utmAnalyticsInit ) ) ) {
				include_once realpath( $utmAnalyticsInit );
			}
		}
	}

	UtmAnalytics::getInstance();

endif;