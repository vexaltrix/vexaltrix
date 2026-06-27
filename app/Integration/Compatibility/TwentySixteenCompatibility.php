<?php
/**
 * Vexaltrix Twenty Sixteen Compatibility.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Integration\Compatibility;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Integration\Compatibility\\TwentySixteenCompatibility' ) ) {

	/**
	 * Class \Vexaltrix\Integration\Compatibility\TwentySixteenCompatibility.
	 */
	final class TwentySixteenCompatibility implements ServiceInterface {

		/**
		 * Member Variable
		 *
		 * @var \Vexaltrix\Integration\Compatibility\TwentySixteenCompatibility
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @since 2.11.4
		 * @return \Vexaltrix\Integration\Compatibility\TwentySixteenCompatibility
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
		 * @since 2.11.4
		 * @return void
		 */
		public function generateStylesheet() {

			if ( is_home() ) {
				$postId             = get_the_ID();
				$currentPostAssets = new \Vexaltrix\Presentation\Assets\PostAssets( intval( $postId ) );
				
				if ( is_object( $currentPostAssets ) ) {
					$currentPostAssets->enqueueScripts();
				}
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
