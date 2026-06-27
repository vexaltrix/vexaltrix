<?php
/**
 * Vexaltrix Twenty Sixteen Compatibility.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Compatibility;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Compatibility\\TwentySixteenCompatibility' ) ) {

	/**
	 * Class \Vexaltrix\Compatibility\TwentySixteenCompatibility.
	 */
	final class TwentySixteenCompatibility {

		/**
		 * Member Variable
		 *
		 * @var \Vexaltrix\Compatibility\TwentySixteenCompatibility
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @since 2.11.4
		 * @return \Vexaltrix\Compatibility\TwentySixteenCompatibility
		 */
		public static function getInstance() {
			return \Vexaltrix\Container::getInstance()->get( self::class );
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wp', [ $this, 'generateStylesheet' ], 101 );
		}
		/**
		 * Generates stylesheet and appends in head tag.
		 *
		 * @since 2.11.4
		 * @return void
		 */
		public function generateStylesheet() {

			if ( is_home() ) {
				$postId             = get_the_ID();
				$currentPostAssets = new \Vexaltrix\Assets\PostAssets( intval( $postId ) );
				
				if ( is_object( $currentPostAssets ) ) {
					$currentPostAssets->enqueueScripts();
				}
			}

		}
	}
}
