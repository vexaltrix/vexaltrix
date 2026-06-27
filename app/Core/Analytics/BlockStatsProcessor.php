<?php
/**
 * Vexaltrix Block Stats Background Processor.
 *
 * Class to execute background processing for block usage analytics.
 *
 * @since 2.19.13
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Analytics;

use WP_Background_Process;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WP_Async_Request' ) ) {
	require_once VXT_DIR . 'app/lib/batch-processing/class-wp-async-request.php';
}

if ( ! class_exists( 'WP_Background_Process' ) ) {
	require_once VXT_DIR . 'app/lib/batch-processing/class-wp-background-process.php';
}

if ( ! class_exists( 'Vexaltrix\\Core\\Analytics\\BlockStatsProcessor' ) ) {

	/**
	 * Class \Vexaltrix\Core\Analytics\BlockStatsProcessor
	 *
	 * Handles background processing for block usage statistics collection.
	 *
	 * @since 2.19.13
	 * @package Vexaltrix
	 */
	class BlockStatsProcessor extends WP_Background_Process {

		/**
		 * Action name.
		 *
		 * @var string
		 * @since 2.19.13
		 */
		protected $action = 'vxt_ultimate_gutenberg_blocks_block_stats_collection';

		/**
		 * List of all Vexaltrix blocks to track (Core + Pro).
		 *
		 * @var array
		 * @since 2.19.13
		 */
		private $vexaltrixBlocks = [
			// Vexaltrix Core Blocks.
			'vexaltrix/advanced-heading',
			'vexaltrix/blockquote',
			'vexaltrix/buttons',
			'vexaltrix/buttons-child',
			'vexaltrix/call-to-action',
			'vexaltrix/cf7-styler',
			'vexaltrix/column',
			'vexaltrix/columns',
			'vexaltrix/container',
			'vexaltrix/content-timeline',
			'vexaltrix/content-timeline-child',
			'vexaltrix/countdown',
			'vexaltrix/counter',
			'vexaltrix/faq',
			'vexaltrix/faq-child',
			'vexaltrix/forms',
			'vexaltrix/forms-accept',
			'vexaltrix/forms-checkbox',
			'vexaltrix/forms-date',
			'vexaltrix/forms-email',
			'vexaltrix/forms-hidden',
			'vexaltrix/forms-name',
			'vexaltrix/forms-phone',
			'vexaltrix/forms-radio',
			'vexaltrix/forms-select',
			'vexaltrix/forms-textarea',
			'vexaltrix/forms-toggle',
			'vexaltrix/forms-url',
			'vexaltrix/gf-styler',
			'vexaltrix/google-map',
			'vexaltrix/how-to',
			'vexaltrix/how-to-step',
			'vexaltrix/icon',
			'vexaltrix/icon-list',
			'vexaltrix/icon-list-child',
			'vexaltrix/image',
			'vexaltrix/image-gallery',
			'vexaltrix/info-box',
			'vexaltrix/inline-notice',
			'vexaltrix/lottie',
			'vexaltrix/marketing-button',
			'vexaltrix/modal',
			'vexaltrix/popup-builder',
			'vexaltrix/post-button',
			'vexaltrix/post-carousel',
			'vexaltrix/post-excerpt',
			'vexaltrix/post-grid',
			'vexaltrix/post-image',
			'vexaltrix/post-masonry',
			'vexaltrix/post-meta',
			'vexaltrix/post-taxonomy',
			'vexaltrix/post-timeline',
			'vexaltrix/post-title',
			'vexaltrix/restaurant-menu',
			'vexaltrix/restaurant-menu-child',
			'vexaltrix/review',
			'vexaltrix/section',
			'vexaltrix/separator',
			'vexaltrix/slider',
			'vexaltrix/slider-child',
			'vexaltrix/social-share',
			'vexaltrix/social-share-child',
			'vexaltrix/star-rating',
			'vexaltrix/sure-cart-checkout',
			'vexaltrix/sure-cart-product',
			'vexaltrix/sure-forms',
			'vexaltrix/table-of-contents',
			'vexaltrix/tabs',
			'vexaltrix/tabs-child',
			'vexaltrix/taxonomy-list',
			'vexaltrix/team',
			'vexaltrix/testimonial',
			'vexaltrix/wp-search',

			// Vexaltrix Pro Blocks.
			'vexaltrix/instagram-feed',
			'vexaltrix/login',
			'vexaltrix/loop-builder',
			'vexaltrix/loop-category',
			'vexaltrix/loop-pagination',
			'vexaltrix/loop-reset',
			'vexaltrix/loop-search',
			'vexaltrix/loop-sort',
			'vexaltrix/loop-wrapper',
			'vexaltrix/register',
			'vexaltrix/register-email',
			'vexaltrix/register-first-name',
			'vexaltrix/register-last-name',
			'vexaltrix/register-password',
			'vexaltrix/register-reenter-password',
			'vexaltrix/register-terms',
			'vexaltrix/register-username',
		];

		/**
		 * Task to be performed for each post.
		 *
		 * @param int $postId Post ID to be processed.
		 * @since 2.19.13
		 * @return bool False when the task is complete.
		 */
		protected function task( $postId ) {
			$post = get_post( $postId );

			if ( ! is_object( $post ) || ! is_a( $post, 'WP_Post' ) ) {
				return false;
			}

			// Check if post has Gutenberg blocks.
			if ( ! has_blocks( $post->post_content ) ) {
				return false;
			}

			// Count blocks in this post.
			$blockCounts = $this->countBlocksInPost( $post->post_content );

			// Get existing analytics data.
			$analyticsData = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', [] );

			if ( ! is_array( $analyticsData ) ) {
				$analyticsData = [];
			}

			if ( ! isset( $analyticsData['block_usage_stats'] ) ) {
				$analyticsData['block_usage_stats'] = [];
			}

			// Merge with existing stats.
			foreach ( $blockCounts as $blockName => $count ) {
				if ( ! isset( $analyticsData['block_usage_stats'][ $blockName ] ) ) {
					$analyticsData['block_usage_stats'][ $blockName ] = 0;
				}
				$analyticsData['block_usage_stats'][ $blockName ] += $count;
			}

			// Update the consolidated analytics data.
			update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', $analyticsData );

			return false;
		}

		/**
		 * Count blocks recursively in post content.
		 *
		 * @param string $content Post content.
		 * @since 2.19.13
		 * @return array Array of block counts.
		 */
		private function countBlocksInPost( $content ) {
			$blockCounts = [];

			// Initialize all Vexaltrix blocks with 0 count.
			foreach ( $this->vexaltrixBlocks as $blockName ) {
				$blockCounts[ $blockName ] = 0;
			}

			// Parse blocks.
			$blocks = parse_blocks( $content );

			// Count blocks recursively.
			$this->countBlocksRecursive( $blocks, $blockCounts );

			return $blockCounts;
		}

		/**
		 * Recursively count blocks including nested blocks.
		 *
		 * @param array $blocks Array of blocks.
		 * @param array $blockCounts Reference to block counts array.
		 * @since 2.19.13
		 * @return void
		 */
		private function countBlocksRecursive( $blocks, &$blockCounts ) {
			foreach ( $blocks as $block ) {
				$blockName = $block['blockName'];

				// Count this block if it's a Vexaltrix block.
				if ( ! empty( $blockName ) && in_array( $blockName, $this->vexaltrixBlocks, true ) ) {
					$blockCounts[ $blockName ]++;
				}

				// Recursively count inner blocks.
				if ( ! empty( $block['innerBlocks'] ) && is_array( $block['innerBlocks'] ) ) {
					$this->countBlocksRecursive( $block['innerBlocks'], $blockCounts );
				}
			}
		}

		/**
		 * Complete the block stats collection process.
		 *
		 * @since 2.19.13
		 * @return void
		 */
		protected function complete() {
			parent::complete();

			// Update analytics status with completion data.
			$status = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			$status['collection_complete'] = true;
			$status['last_collected']      = time();
			$status['is_processing']       = false;
			update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', $status );
		}

		/**
		 * Start the block stats collection process.
		 *
		 * @since 2.19.13
		 * @return void
		 */
		public function startCollection() {
			// Check if already processing.
			$status = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			if ( ! empty( $status['is_processing'] ) ) {
				return;
			}

			// Set processing flag and reset completion status.
			$status['is_processing']       = true;
			$status['collection_complete'] = false;
			update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', $status );

			// Reset analytics data.
			update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', [] );

			// Get all posts with blocks.
			$postTypes = get_post_types( [ 'public' => true ], 'names' );
			
			$posts = get_posts(
				[
					'post_type'      => $postTypes,
					'post_status'    => [ 'publish', 'private', 'draft' ],
					'posts_per_page' => -1,
					'fields'         => 'ids',
				]
			);

			// Add posts to queue.
			foreach ( $posts as $postId ) {
				$this->push_to_queue( $postId );
			}

			// Save queue and dispatch.
			$this->save()->dispatch();
		}

		/**
		 * Get collected block usage statistics.
		 *
		 * @since 2.19.13
		 * @return array Block usage statistics.
		 */
		public static function getBlockStats() {
			$analyticsData = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', [] );

			if ( ! is_array( $analyticsData ) ) {
				$analyticsData = [];
			}

			return isset( $analyticsData['block_usage_stats'] ) ? $analyticsData['block_usage_stats'] : [];
		}

		/**
		 * Check if stats collection is complete.
		 *
		 * @since 2.19.13
		 * @return bool Whether stats collection is complete.
		 */
		public static function isCollectionComplete() {
			$status = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			return ! empty( $status['collection_complete'] );
		}

		/**
		 * Get the last collection timestamp.
		 *
		 * @since 2.19.13
		 * @return int|false Last collection timestamp or false if never collected.
		 */
		public static function getLastCollectionTime() {
			$status = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			return isset( $status['last_collected'] ) ? $status['last_collected'] : false;
		}
	}
}
