<?php
/**
 * Vexaltrix Twenty Seventeen Compatibility.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Compatibility;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Compatibility\\TwentySeventeenCompatibility' ) ) {

	/**
	 * Class \Vexaltrix\Compatibility\TwentySeventeenCompatibility.
	 */
	final class TwentySeventeenCompatibility {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
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
		 * @since 1.18.1
		 */
		public function generateStylesheet() {

			if ( is_home() ) {
				$postId             = get_the_ID();
				$currentPostAssets = new \Vexaltrix\Assets\PostAssets( intval( $postId ) );
				
				if ( is_object( $currentPostAssets ) ) {
					$currentPostAssets->enqueueScripts();
				}
			}

			if ( ! function_exists( 'twentyseventeen_panel_count' ) ) {
				return;
			}
			$panelCount     = twentyseventeen_panel_count();
			$postAssetsObj = vxt_ultimate_gutenberg_blocks_get_front_post_assets();
			$allPosts       = [];

			for ( $i = 1; $i <= $panelCount; $i++ ) {
				$modKey = 'panel_' . $i;
				$postId = get_theme_mod( $modKey );
				$post    = get_post( $postId );
				array_push( $allPosts, $post );
			}

			if ( ! is_object( $postAssetsObj ) ) {
				return;
			}

			foreach ( $allPosts as $post ) {
				$postAssetsObj->prepareAssets( $post );
			}
		}
	}
}
