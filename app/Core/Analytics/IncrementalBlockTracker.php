<?php
/**
 * Vexaltrix Incremental Block Tracker.
 *
 * Class to track block usage changes in real-time when posts are saved.
 *
 * @since 2.19.13
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Analytics;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Core\\Analytics\\IncrementalBlockTracker' ) ) {

	/**
	 * Class \Vexaltrix\Core\Analytics\IncrementalBlockTracker
	 *
	 * Handles real-time block usage tracking when posts are saved.
	 *
	 * @since 2.19.13
	 * @package Vexaltrix
	 */
	class IncrementalBlockTracker {

		/**
		 * Member Variable
		 *
		 * @var \Vexaltrix\Core\Analytics\IncrementalBlockTracker|null
		 * @since 2.19.13
		 */
		private static $instance;

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
		 * Initiator
		 *
		 * @since 2.19.13
		 * @return \Vexaltrix\Core\Analytics\IncrementalBlockTracker
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 *
		 * @since 2.19.13
		 * @return void
		 */
		public function __construct() {
			// Hook into post save actions.
			add_action( 'save_post', [ $this, 'trackBlockChangesOnSave' ], 10, 2 );
			add_action( 'before_delete_post', [ $this, 'trackBlockRemovalOnDelete' ] );
			add_action( 'wp_trash_post', [ $this, 'trackBlockRemovalOnTrash' ] );
			add_action( 'untrash_post', [ $this, 'trackBlockAdditionOnUntrash' ] );
		}

		/**
		 * Track block changes when a post is saved.
		 *
		 * @param int     $postId Post ID.
		 * @param WP_Post $post    Post object.
		 * @since 2.19.13
		 * @return void
		 */
		public function trackBlockChangesOnSave( $postId, $post ) {
			// Skip autosaves and revisions.
			if ( wp_is_post_autosave( $postId ) || wp_is_post_revision( $postId ) ) {
				return;
			}

			// Only track public post types.
			$publicPostTypes = get_post_types( [ 'public' => true ], 'names' );
			if ( ! in_array( $post->post_type, $publicPostTypes, true ) ) {
				return;
			}

			// Skip if content hasn't changed (performance optimization).
			static $lastProcessedContent = [];
			$contentHash                  = md5( $post->post_content );
			if ( isset( $lastProcessedContent[ $postId ] ) && $lastProcessedContent[ $postId ] === $contentHash ) {
				return;
			}
			$lastProcessedContent[ $postId ] = $contentHash;

			// Get the previous block counts for this post (what was in this post before saving).
			$previousBlocks = get_post_meta( $postId, '_vxt_ultimate_gutenberg_blocks_previous_block_counts', true );
			$previousBlocks = is_array( $previousBlocks ) ? $previousBlocks : [];

			// Count current blocks in the post (what's in this post after saving).
			$currentBlocks = $this->countBlocksInPost( $post->post_content );

			// Update global stats with the correct logic:
			// 1. Subtract the old blocks from global count (remove what this post had before)
			// 2. Add the new blocks to global count (add what this post has now).
			$this->updateGlobalStatsCorrectly( $previousBlocks, $currentBlocks );

			// Store current block counts for next comparison.
			update_post_meta( $postId, '_vxt_ultimate_gutenberg_blocks_previous_block_counts', $currentBlocks );

			// Maintain the O(1) sitewide pages-with-Vexaltrix counter. The counter only
			// moves when the post crosses the has-vexaltrix / does-not-have-vexaltrix
			// boundary; steady-state saves leave it untouched. Replaces the 180-day
			// postmeta scan formerly used for `active_pages_180d`.
			$hadVexaltrix = $this->hasVexaltrixBlocks( $previousBlocks );
			$hasVexaltrix = $this->hasVexaltrixBlocks( $currentBlocks );

			if ( $hadVexaltrix !== $hasVexaltrix && class_exists( 'Vexaltrix\\Core\\Analytics\\DailyKpiCounters' ) ) {
				\Vexaltrix\Core\Analytics\DailyKpiCounters::adjustPagesWithVexaltrix( $hasVexaltrix ? 1 : -1 );
			}
		}

		/**
		 * Track block removal when a post is deleted.
		 *
		 * @param int $postId Post ID being deleted.
		 * @since 2.19.13
		 * @return void
		 */
		public function trackBlockRemovalOnDelete( $postId ) {
			$post = get_post( $postId );
			if ( ! $post ) {
				return;
			}

			// Only track public post types.
			$publicPostTypes = get_post_types( [ 'public' => true ], 'names' );
			if ( ! is_object( $post ) || ! in_array( $post->post_type, $publicPostTypes, true ) ) {
				return;
			}

			// Get the previous block counts for this post.
			$previousBlocks = get_post_meta( $postId, '_vxt_ultimate_gutenberg_blocks_previous_block_counts', true );
			if ( ! is_array( $previousBlocks ) || empty( $previousBlocks ) ) {
				return;
			}

			// Create a negative diff to remove these blocks from stats.
			$blockDiff = [];
			foreach ( $previousBlocks as $blockName => $count ) {
				if ( $count > 0 ) {
					$blockDiff[ $blockName ] = -$count;
				}
			}

			// Update global stats.
			if ( ! empty( $blockDiff ) ) {
				$this->updateGlobalStats( $blockDiff );
			}

			// Deleting a post with Vexaltrix blocks drops the sitewide page count by one.
			if ( $this->hasVexaltrixBlocks( $previousBlocks ) && class_exists( 'Vexaltrix\\Core\\Analytics\\DailyKpiCounters' ) ) {
				\Vexaltrix\Core\Analytics\DailyKpiCounters::adjustPagesWithVexaltrix( -1 );
			}
		}

		/**
		 * Track block removal when a post is trashed.
		 *
		 * @param int $postId Post ID being trashed.
		 * @since 2.19.13
		 * @return void
		 */
		public function trackBlockRemovalOnTrash( $postId ) {
			$this->trackBlockRemovalOnDelete( $postId );
		}

		/**
		 * Track block addition when a post is untrashed.
		 *
		 * @param int $postId Post ID being untrashed.
		 * @since 2.19.13
		 * @return void
		 */
		public function trackBlockAdditionOnUntrash( $postId ) {
			$post = get_post( $postId );
			if ( ! $post ) {
				return;
			}

			// Only track public post types.
			$publicPostTypes = get_post_types( [ 'public' => true ], 'names' );
			if ( ! is_object( $post ) || ! in_array( $post->post_type, $publicPostTypes, true ) ) {
				return;
			}

			// Count current blocks and add them back to stats.
			$currentBlocks = $this->countBlocksInPost( $post->post_content );

			if ( ! empty( $currentBlocks ) ) {
				$this->updateGlobalStats( $currentBlocks );
			}

			// Store current block counts for future comparisons.
			update_post_meta( $postId, '_vxt_ultimate_gutenberg_blocks_previous_block_counts', $currentBlocks );

			// Restoring a Vexaltrix-bearing post brings it back into the sitewide page count.
			if ( $this->hasVexaltrixBlocks( $currentBlocks ) && class_exists( 'Vexaltrix\\Core\\Analytics\\DailyKpiCounters' ) ) {
				\Vexaltrix\Core\Analytics\DailyKpiCounters::adjustPagesWithVexaltrix( 1 );
			}
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

			// Skip if content is empty or has no blocks.
			if ( empty( $content ) || ! has_blocks( $content ) ) {
				return $blockCounts;
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
		 * Update global analytics stats with the correct incremental logic.
		 *
		 * @param array $previousBlocks Block counts that were in the post before saving.
		 * @param array $currentBlocks  Block counts that are in the post after saving.
		 * @since 2.19.13
		 * @return void
		 */
		private function updateGlobalStatsCorrectly( $previousBlocks, $currentBlocks ) {
			// Get existing analytics data.
			$analyticsData = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', [] );

			if ( ! is_array( $analyticsData ) ) {
				$analyticsData = [];
			}

			if ( ! isset( $analyticsData['block_usage_stats'] ) ) {
				$analyticsData['block_usage_stats'] = [];
			}

			// Process each Vexaltrix block type.
			foreach ( $this->vexaltrixBlocks as $blockName ) {
				// Initialize if not set.
				if ( ! isset( $analyticsData['block_usage_stats'][ $blockName ] ) ) {
					$analyticsData['block_usage_stats'][ $blockName ] = 0;
				}

				$previousCount = isset( $previousBlocks[ $blockName ] ) ? $previousBlocks[ $blockName ] : 0;
				$currentCount  = isset( $currentBlocks[ $blockName ] ) ? $currentBlocks[ $blockName ] : 0;

				// Only update if there's a change.
				if ( $previousCount !== $currentCount ) {
					// Step 1: Subtract what this post had before (remove old contribution).
					$analyticsData['block_usage_stats'][ $blockName ] -= $previousCount;

					// Step 2: Add what this post has now (add new contribution).
					$analyticsData['block_usage_stats'][ $blockName ] += $currentCount;

					// Ensure we don't go below 0 (safety check).
					if ( $analyticsData['block_usage_stats'][ $blockName ] < 0 ) {
						$analyticsData['block_usage_stats'][ $blockName ] = 0;
					}
				}
			}

			// Update last modified timestamp.
			$analyticsData['last_updated'] = time();

			// Save the updated analytics data.
			update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', $analyticsData );
		}

		/**
		 * Update global analytics stats with block count changes (legacy method for delete/trash operations).
		 *
		 * @param array $blockDiff Array of block count changes.
		 * @since 2.19.13
		 * @return void
		 */
		private function updateGlobalStats( $blockDiff ) {
			// Get existing analytics data.
			$analyticsData = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', [] );

			if ( ! is_array( $analyticsData ) ) {
				$analyticsData = [];
			}

			if ( ! isset( $analyticsData['block_usage_stats'] ) ) {
				$analyticsData['block_usage_stats'] = [];
			}

			// Apply the block count changes.
			foreach ( $blockDiff as $blockName => $diff ) {
				if ( ! isset( $analyticsData['block_usage_stats'][ $blockName ] ) ) {
					$analyticsData['block_usage_stats'][ $blockName ] = 0;
				}

				$analyticsData['block_usage_stats'][ $blockName ] += $diff;

				// Ensure we don't go below 0.
				$currentCount = $analyticsData['block_usage_stats'][ $blockName ];
				if ( is_numeric( $currentCount ) && $currentCount < 0 ) {
					$analyticsData['block_usage_stats'][ $blockName ] = 0;
				}
			}

			// Update last modified timestamp.
			$analyticsData['last_updated'] = time();

			// Save the updated analytics data.
			update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', $analyticsData );
		}

		/**
		 * Initialize tracking for existing posts (one-time setup).
		 * This method populates the _vxt_ultimate_gutenberg_blocks_previous_block_counts meta for existing
		 * posts and seeds the sitewide `vxt_ultimate_gutenberg_blocks_pages_with_vexaltrix_count` counter.
		 *
		 * @since 2.19.13
		 * @return void
		 */
		public function initializeExistingPosts() {
			$postTypes = get_post_types( [ 'public' => true ], 'names' );

			// Posts without _vxt_ultimate_gutenberg_blocks_previous_block_counts (new installs / new posts).
			$posts = get_posts(
				[
					'post_type'      => $postTypes,
					'post_status'    => [ 'publish', 'private', 'draft' ],
					'posts_per_page' => -1,
					'fields'         => 'ids',
					'meta_query'     => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- Intentional one-time setup query.
						[
							'key'     => '_vxt_ultimate_gutenberg_blocks_previous_block_counts',
							'compare' => 'NOT EXISTS',
						],
					],
				]
			);

			$newlyAddedPages = 0;

			foreach ( $posts as $postId ) {
				$post = get_post( $postId );
				if ( is_object( $post ) && has_blocks( $post->post_content ) ) {
					$blockCounts   = $this->countBlocksInPost( $post->post_content );
					$actualPostId = is_object( $postId ) ? $postId->ID : (int) $postId;
					update_post_meta( $actualPostId, '_vxt_ultimate_gutenberg_blocks_previous_block_counts', $blockCounts );

					if ( $this->hasVexaltrixBlocks( $blockCounts ) ) {
						++$newlyAddedPages;
					}
				}
			}

			if ( $newlyAddedPages > 0 && class_exists( 'Vexaltrix\\Core\\Analytics\\DailyKpiCounters' ) ) {
				\Vexaltrix\Core\Analytics\DailyKpiCounters::adjustPagesWithVexaltrix( $newlyAddedPages );
			}
		}

		/**
		 * Check if block counts contain any Vexaltrix blocks.
		 *
		 * @param array $blockCounts Array of block counts.
		 * @since 2.19.19
		 * @return bool True if any Vexaltrix blocks are present, false otherwise.
		 */
		private function hasVexaltrixBlocks( $blockCounts ) {
			foreach ( $blockCounts as $blockName => $count ) {
				if ( $count > 0 && in_array( $blockName, $this->vexaltrixBlocks, true ) ) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Get block counts for a specific post.
		 *
		 * @param int $postId Post ID.
		 * @since 2.19.13
		 * @return array Block counts for the post.
		 */
		public function getPostBlockCounts( $postId ) {
			$blockCounts = get_post_meta( $postId, '_vxt_ultimate_gutenberg_blocks_previous_block_counts', true );
			return is_array( $blockCounts ) ? $blockCounts : [];
		}
	}
}
