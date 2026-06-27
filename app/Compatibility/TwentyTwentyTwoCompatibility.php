<?php
/**
 * Vexaltrix Twenty  Twenty Two Compatibility.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Compatibility;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Compatibility\\TwentyTwentyTwoCompatibility' ) ) {

	/**
	 * Class \Vexaltrix\Compatibility\TwentyTwentyTwoCompatibility.
	 */
	final class TwentyTwentyTwoCompatibility {

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
		 * @since 2.0
		 */
		public function generateStylesheet() {

			$queryArgs = [
				'post_type' => 'wp_template',
			];

			$query = new WP_Query( $queryArgs );

			foreach ( $query->posts as $key => $post ) {
				$postId             = $post->ID;
				$currentPostAssets = new \Vexaltrix\Assets\PostAssets( intval( $postId ) );
				$currentPostAssets->enqueueScripts();
			}

		}
	}
}
