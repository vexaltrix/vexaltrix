<?php
/**
 * Init
 *
 * @since 2.17.0
 * @package ZipWP Images
 */

namespace Vexaltrix\Integrations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\\ZipwpImages' ) ) :

	/**
	 * Admin
	 * 
	 * @since 2.17.0
	 */
	class ZipwpImages {

		/**
		 * Instance
		 *
		 * @since 2.17.0
		 * @var (Object) Vexaltrix_Zipwp_Images
		 */
		private static $instance = null;

		/**
		 * Get Instance
		 *
		 * @since 2.17.0
		 *
		 * @return object
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor.
		 *
		 * @since 2.17.0
		 */
		private function __construct() {
			$this->versionCheck();
			add_action( 'init', [ $this, 'load' ] );
		}

		/**
		 * Version Check
		 *
		 * @since 2.17.0
		 * 
		 * @return void
		 */
		public function versionCheck() {

            $file = realpath( VXT_DIR . 'app/lib/zipwp-images/version.json' );

			// Is file exist?
			if ( is_file( $file ) ) {
				// @codingStandardsIgnoreStart
				$fileData = json_decode( file_get_contents( $file ), true );
				// @codingStandardsIgnoreEnd
				global $zipwpImagesVersion, $zipwpImagesInit;
				$path    = realpath( VXT_DIR . 'app/lib/zipwp-images/zipwp-images.php' );
				$version = isset( $fileData['zipwp-images'] ) ? $fileData['zipwp-images'] : 0;
                
				if ( false == $zipwpImagesVersion ) {
                    $zipwpImagesVersion = '1.0.0';
                }
                
				// Compare versions.
				if ( version_compare( $version, $zipwpImagesVersion, '>=' ) ) {
					$zipwpImagesVersion = $version;
					$zipwpImagesInit    = $path;
				}
			}
		}

		/**
		 * Load latest plugin
		 *
		 * @since 2.17.0
		 * 
		 * @return void
		 */
		public function load() {
			global $zipwpImagesVersion, $zipwpImagesInit;
			if ( is_file( realpath( $zipwpImagesInit ) ) ) {
				include_once realpath( $zipwpImagesInit );
			}
		}

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	ZipwpImages::getInstance();

endif;