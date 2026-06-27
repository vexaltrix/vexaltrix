<?php
/**
 * Vexaltrix Twenty  Twenty Two Compatibility.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Integration\Compatibility;

use Vexaltrix\Core\Contracts\ServiceInterface;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Integration\Compatibility\\TwentyTwentyTwoCompatibility' ) ) {

	/**
	 * Class \Vexaltrix\Integration\Compatibility\TwentyTwentyTwoCompatibility.
	 */
	final class TwentyTwentyTwoCompatibility implements ServiceInterface {

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
		 * @since 2.0
		 */
		public function generateStylesheet() {

			$queryArgs = [
				'post_type' => 'wp_template',
			];

			$query = new WP_Query( $queryArgs );

			foreach ( $query->posts as $key => $post ) {
				$postId             = $post->ID;
				$currentPostAssets = new \Vexaltrix\Presentation\Assets\PostAssets( intval( $postId ) );
				$currentPostAssets->enqueueScripts();
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
