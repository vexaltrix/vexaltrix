<?php
/**
 * Vexaltrix Post.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\BlocksConfig\Image;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\BlocksConfig\\Image\\Image' ) ) {

	/**
	 * Class \Vexaltrix\BlocksConfig\Image\Image.
	 */
	class Image {


		/**
		 * Member Variable
		 *
		 * @since 2.0.0
		 * @var instance
		 */
		private static $instance;


		/**
		 *  Initiator
		 *
		 * @since 2.0.0
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'registerBlocks' ] );
		}

		/**
		 * Register the Image block on server.
		 *
		 * @since 2.0.0
		 */
		public function registerBlocks() {
			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			register_block_type(
				'vexaltrix/image',
				[
					'supports' => [
						'color' => [
							'__experimentalDuotone' => 'img',
							'text'                  => false,
							'background'            => false,
						],
					],
				]
			);
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\\BlocksConfig\\Image\\Image' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
