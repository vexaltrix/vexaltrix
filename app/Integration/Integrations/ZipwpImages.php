<?php
/**
 * Init
 *
 * @since 2.17.0
 * @package ZipWP Images
 */

namespace Vexaltrix\Integration\Integrations;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\\ZipwpImages' ) ) :

	/**
	 * Admin
	 * 
	 * @since 2.17.0
	 */
	class ZipwpImages implements ServiceInterface {

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
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
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

	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'integration';
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

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	ZipwpImages::getInstance();

endif;