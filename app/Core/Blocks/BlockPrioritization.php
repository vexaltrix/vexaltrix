<?php
/**
 * Vexaltrix Block Prioritization.
 *
 * @package Vexaltrix
 * @since 2.1.0
 */

namespace Vexaltrix\Core\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Core\Blocks\BlockPrioritization.
 */
class BlockPrioritization {

	/**
	 * Array of all blocks in order.
	 * This array should be in the same order as: /src/blocks.js.
	 *
	 * @var array
	 */
	private static $blocks = [
		// Core Vexaltrix.
		'container',
		'advanced-heading',
		'image',
		'icon',
		'buttons',
		'info-box',
		'call-to-action',
		'countdown',
		// Alphabetically Ordered Blocks.
		'blockquote',
		'content-timeline',
		'counter',
		'faq',
		'forms',
		'google-map',
		'how-to',
		'icon-list',
		'image-gallery',
		'inline-notice',
		'instagram-feed',
		'login',
		'loop-builder',
		'lottie',
		'marketing-button',
		'modal',
		'post-carousel',
		'post-grid',
		'post-timeline',
		'price-list',
		'register',
		'review',
		'separator',
		'slider',
		'social-share',
		'star-rating',
		'table-of-contents',
		'tabs',
		'taxonomy-list',
		'team',
		'testimonial',
		// Legacy Blocks.
		'columns',
		'section',
		'cf7-styler',
		'gf-styler',
		'post-masonry',
		'wp-search',
		// Extensions.
		'popup-builder',
	];

	/**
	 * Member Variable.
	 *
	 * @var instance
	 */
	private static $instance;

	/**
	 *  Initiator.
	 */
	public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

	/**
	 * Get the Block Priority of a Specific Block.
	 *
	 * @since 2.1.0
	 * @param string $blockName The slug of the required block.
	 */
	public static function getBlockPriority( $blockName ) {
		return ( array_search( $blockName, self::$blocks, true ) + 1 );
	}
}

/**
 *  Prepare if class 'Vexaltrix\\Core\\Blocks\\BlockPrioritization' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
