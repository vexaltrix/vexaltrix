<?php

namespace Vexaltrix\Integrations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\\NpsSurvey' ) ) :

	/**
	 * Admin
	 */
	class NpsSurvey {
		/**
		 * Instance
		 *
		 * @since 2.18.0
		 * @var (Object) VXT_Nps_Survey
		 */
		private static $instance = null;

		/**
		 * Get Instance
		 *
		 * @since 2.18.0
		 *
		 * @return object Class object.
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor.
		 *
		 * @since 2.18.0
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

			$file = realpath( VXT_DIR . 'app/lib/nps-survey/version.json' );

			// Is file exist?
			if ( is_file( $file ) ) {
				
                $fileData = json_decode( file_get_contents( $file ), true );
				
				global $npsSurveyVersion, $npsSurveyInit;
				
                $path = realpath( VXT_DIR . 'app/lib/nps-survey/nps-survey.php' );
				
                $version = isset( $fileData['nps-survey'] ) ? $fileData['nps-survey'] : 0;

				if ( null === $npsSurveyVersion ) {
					$npsSurveyVersion = '1.0.0';
				}

				// Compare versions.
				if ( version_compare( $version, $npsSurveyVersion, '>=' ) ) {
					$npsSurveyVersion = $version;
					$npsSurveyInit = $path;
				}
			}
		}

		/**
		 * Load latest plugin
		 *
		 * @return void
		 */
		public function load() {
			global $npsSurveyVersion, $npsSurveyInit;
			if ( is_file( realpath( $npsSurveyInit ) ) ) {
				include_once realpath( $npsSurveyInit );
			}
		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	NpsSurvey::getInstance();

endif;