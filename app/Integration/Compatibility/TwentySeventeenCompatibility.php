<?php
/**
 * Vexaltrix Twenty Seventeen Compatibility.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Integration\Compatibility;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Integration\Compatibility\\TwentySeventeenCompatibility' ) ) {

	/**
	 * Class \Vexaltrix\Integration\Compatibility\TwentySeventeenCompatibility.
	 */
	final class TwentySeventeenCompatibility implements ServiceInterface {

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
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		
		/**
		 * Generates stylesheet and appends in head tag.
		 *
		 * @since 1.18.1
		 */
		public function generateStylesheet() {

			if ( is_home() ) {
				$postId             = get_the_ID();
				$currentPostAssets = new \Vexaltrix\Presentation\Assets\PostAssets( intval( $postId ) );
				
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
		return 'always';
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
			add_action( 'wp', [ $this, 'generateStylesheet' ], 101 );
	}

}
}
