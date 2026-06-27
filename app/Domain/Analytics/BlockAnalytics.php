<?php
/**
 * Vexaltrix Block Analytics Manager.
 *
 * Class to manage block usage analytics collection and reporting.
 *
 * @since 2.19.13
 * @package Vexaltrix
 */

namespace Vexaltrix\Domain\Analytics;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Domain\Analytics\\BlockAnalytics' ) ) {

	/**
	 * Class \Vexaltrix\Domain\Analytics\BlockAnalytics
	 *
	 * Manages block usage analytics collection and reporting.
	 *
	 * @since 2.19.13
	 * @package Vexaltrix
	 */
	class BlockAnalytics implements ServiceInterface {

		/**
		 * Member Variable
		 *
		 * @var \Vexaltrix\Domain\Analytics\BlockAnalytics|null
		 * @since 2.19.13
		 */
		private static $instance;

		/**
		 * Block stats processor instance.
		 *
		 * @var \Vexaltrix\Domain\Analytics\BlockStatsProcessor
		 * @since 2.19.13
		 */
		private $statsProcessor;

		/**
		 * Incremental block tracker instance.
		 *
		 * @var \Vexaltrix\Domain\Analytics\IncrementalBlockTracker
		 * @since 2.19.13
		 */
		private $incrementalTracker;

		/**
		 * Initiator
		 *
		 * @since 2.19.13
		 * @return \Vexaltrix\Domain\Analytics\BlockAnalytics
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 *
		 * @since 2.19.13
		 * @return void
		 */
		public function __construct() {

			// Load the stats processor, incremental tracker, and daily KPI counters.
			class_exists( 'Vexaltrix\Domain\Analytics\\BlockStatsProcessor' );
			class_exists( 'Vexaltrix\Domain\Analytics\\IncrementalBlockTracker' );
			class_exists( 'Vexaltrix\Domain\Analytics\\DailyKpiCounters' );

			$this->statsProcessor     = new \Vexaltrix\Domain\Analytics\BlockStatsProcessor();
			$this->incrementalTracker = \Vexaltrix\Domain\Analytics\IncrementalBlockTracker::getInstance();

			// Boot the counter singleton so its hooks register before save/transition events fire.
// Hook into analytics option changes.

			// Hook into plugin activation for first-run stats collection.
	}

		/**
		 * Handle analytics opt-in option update.
		 *
		 * @param string $oldValue Old value.
		 * @param string $value New value.
		 * @param string $option Option name.
		 * @since 2.19.13
		 * @return void
		 */
		public function handleAnalyticsOptinChange( $oldValue, $value, $option ) {
			if ( 'yes' === $value && 'yes' !== $oldValue ) {
				// Analytics was just enabled, start collection.
				$this->startStatsCollection();
			}
		}

		/**
		 * Handle analytics opt-in option addition.
		 *
		 * @param string $option Option name.
		 * @param string $value Option value.
		 * @since 2.19.13
		 * @return void
		 */
		public function handleAnalyticsOptinAdd( $option, $value ) {
			if ( 'yes' === $value ) {
				// Analytics was enabled, start collection.
				$this->startStatsCollection();
			}
		}

		/**
		 * Maybe start first-run stats collection.
		 *
		 * This is called during plugin initialization to check if this is a first-run
		 * installation and start stats collection.
		 *
		 * @since 2.19.13
		 * @return void
		 */
		public function maybeStartFirstRunCollection() {
			$status = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			if ( empty( $status['first_run_check'] ) ) {
				// First-run: mark as done and run full initial setup.
				$status['first_run_check'] = true;
				update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', $status );

				$this->startInitialSetup();
				return;
			}

			// One-time migration for sites upgrading from a version that stored
			// the now-removed `_vxt_ultimate_gutenberg_blocks_last_vexaltrix_edit` meta. Seeds the sitewide
			// page counter by re-walking posts with block counts — cheap because
			// it reads an existing meta key instead of parsing post_content.
			//
			// `method_exists` is defensive — once this class is loaded the method
			// is there. Kept as cheap insurance against a future refactor that
			// removes the seed helper but forgets this caller.
			if ( empty( $status['pages_counter_seeded'] ) && method_exists( $this, 'seedPagesWithVexaltrixCounter' ) ) {
				$status['pages_counter_seeded'] = true;
				update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', $status );

				$this->seedPagesWithVexaltrixCounter();
			}
		}

		/**
		 * Start block usage stats collection (initial scan only).
		 *
		 * This method triggers the background process ONLY for initial setup.
		 * After initial setup, all tracking is done via real-time incremental updates.
		 *
		 * @since 2.19.13
		 * @return void
		 */
		public function startStatsCollection() {
			// Only start if analytics is enabled or this is first run.
			$analyticsEnabled = get_option( 'vexaltrix_usage_optin', 'no' ) === 'yes';
			$status            = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			$isFirstRun = empty( $status['first_run_check'] );

			if ( ! $analyticsEnabled && ! $isFirstRun ) {
				return;
			}

			// Check if collection is already in progress.
			if ( ! empty( $status['is_processing'] ) ) {
				return;
			}

			// Only run background scan if we don't have existing stats or this is forced refresh.
			$analyticsData = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', [] );

			if ( ! is_array( $analyticsData ) ) {
				$analyticsData = [];
			}

			$hasExistingStats = ! empty( $analyticsData['block_usage_stats'] );

			// Skip background scan if we already have stats and this isn't first run.
			if ( $hasExistingStats && ! $isFirstRun ) {
				return;
			}

			// Start the background collection process.
			$this->statsProcessor->startCollection();
		}


		/**
		 * Get block usage statistics for analytics reporting.
		 *
		 * This method merges block usage statistics with existing vexaltrix stats,
		 * ensuring numeric_values are added (not replaced) if they already exist.
		 *
		 * @since 2.19.13
		 * @param array $existingStats Existing vexaltrix stats to merge with.
		 * @return array Merged stats with block usage data.
		 */
		public function getBlockStatsForAnalytics( $existingStats = [] ) {
			// Consent is enforced by BSF_Analytics::is_tracking_enabled() before
			// `bsf_core_stats` is invoked — no per-emit gate needed here.
			$stats               = \Vexaltrix\Domain\Analytics\BlockStatsProcessor::getBlockStats();
			$collectionComplete = \Vexaltrix\Domain\Analytics\BlockStatsProcessor::isCollectionComplete();
			$lastCollection     = \Vexaltrix\Domain\Analytics\BlockStatsProcessor::getLastCollectionTime();

			// Format block usage stats to add 'block_usage_' prefix to the keys.
			$formattedBlockUsageStats = array_combine(
				array_map(
					function ( $key ) {
						return 'block_usage_' . $key;
					},
					array_keys( $stats )
				),
				array_values( $stats )
			);

			// Ensure array_combine succeeded, otherwise use empty array.
			if ( ! is_array( $formattedBlockUsageStats ) ) {
				$formattedBlockUsageStats = [];
			}

			// Get site activity level for Active Site / Super Site KPIs.
			$siteActivity = $this->getSiteActivityLevel();

			// Prepare advanced stats structure.
			$advancedStats = [
				'numeric_values'             => $formattedBlockUsageStats,
				'block_usage_stats_metadata' => [
					'collection_complete'  => $collectionComplete,
					'last_collected'       => $lastCollection ? gmdate( 'Y-m-d H:i:s', $lastCollection ) : null,
					'total_blocks_tracked' => count( array_filter( $stats ) ),
					'most_used_blocks'     => $this->getMostUsedBlocks( $stats, 10 ),
				],
				'site_activity'              => $siteActivity,
			];

			// Merge numeric_values by adding numbers if they already exist.
			// Check if numeric_values array exists in existing_stats and validate it's an array.
			if ( isset( $existingStats['numeric_values'] ) && is_array( $existingStats['numeric_values'] ) ) {

				// Loop through each block's usage count from advanced_stats.
				foreach ( $advancedStats['numeric_values'] as $key => $value ) {
					// If the key exists in existing_stats and both values are numeric, add them together.
					// Otherwise, use the new value from advanced_stats (either new key or non-numeric value).
					$existingStats['numeric_values'][ $key ] = ( isset( $existingStats['numeric_values'][ $key ] )
						&& is_numeric( $value )
						&& is_numeric( $existingStats['numeric_values'][ $key ] ) )
						? $existingStats['numeric_values'][ $key ] + $value
						: $value;
				}
				// Remove numeric_values from advanced_stats to prevent duplication in array_merge_recursive below.
				unset( $advancedStats['numeric_values'] );
			}

			// Merge remaining advanced stats (metadata, etc.) with existing stats.
			return array_merge_recursive( $existingStats, $advancedStats );
		}

		/**
		 * Get the most used blocks from stats.
		 *
		 * @param array $stats Block usage statistics.
		 * @param int   $limit Number of top blocks to return.
		 * @since 2.19.13
		 * @return array Top used blocks.
		 */
		private function getMostUsedBlocks( $stats, $limit = 10 ) {
			// Filter out blocks with 0 usage and sort by usage count.
			$filteredStats = array_filter( $stats );
			arsort( $filteredStats );

			// Return top blocks.
			return array_slice( $filteredStats, 0, $limit, true );
		}

		/**
		 * Force refresh block statistics (for data validation only).
		 *
		 * This method should only be used for manual data validation or troubleshooting.
		 * Normal operation relies on real-time incremental tracking.
		 *
		 * @since 2.19.13
		 * @return void
		 */
		public function forceRefreshStats() {
			// Clear existing processing flag to allow new collection.
			$status = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			$status['is_processing'] = false;
			update_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', $status );

			// Reinitialize post tracking metadata.
			$this->incrementalTracker->initializeExistingPosts();

			// Start full collection for validation.
			$this->startStatsCollection();
		}

		/**
		 * Start initial setup combining background scan and incremental tracking.
		 *
		 * This method is called on first-run to both scan existing content
		 * and setup incremental tracking for future changes.
		 *
		 * @since 2.19.13
		 * @return void
		 */
		public function startInitialSetup() {
			// Only setup if analytics is enabled or this is first run.
			$analyticsEnabled = get_option( 'vexaltrix_usage_optin', 'no' ) === 'yes';
			$status            = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			$isFirstRun = empty( $status['first_run_check'] );

			if ( ! $analyticsEnabled && ! $isFirstRun ) {
				return;
			}

			// Initialize existing posts for incremental tracking.
			$this->incrementalTracker->initializeExistingPosts();

			// Start the background collection process to build initial stats.
			$this->startStatsCollection();
		}

		/**
		 * Get stats collection status.
		 *
		 * @since 2.19.13
		 * @return array Status information about stats collection.
		 */
		public function getCollectionStatus() {
			$status         = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_status', [] );
			$analyticsData = get_option( 'vxt_ultimate_gutenberg_blocks_block_usage_data', [] );

			if ( ! is_array( $status ) ) {
				$status = [];
			}

			if ( ! is_array( $analyticsData ) ) {
				$analyticsData = [];
			}

			return [
				'is_processing'        => ! empty( $status['is_processing'] ),
				'is_complete'          => ! empty( $status['collection_complete'] ),
				'last_collected'       => isset( $status['last_collected'] ) ? $status['last_collected'] : false,
				'last_updated'         => isset( $analyticsData['last_updated'] ) ? $analyticsData['last_updated'] : false,
				'analytics_enabled'    => get_option( 'vexaltrix_usage_optin', 'no' ) === 'yes',
				'first_run_done'       => ! empty( $status['first_run_check'] ),
				'has_stats'            => ! empty( $analyticsData['block_usage_stats'] ),
				'tracking_method'      => 'incremental', // Now using incremental tracking instead of batch processing.
				'total_tracked_blocks' => ! empty( $analyticsData['block_usage_stats'] ) && is_array( $analyticsData['block_usage_stats'] ) ? count( array_filter( $analyticsData['block_usage_stats'] ) ) : 0,
			];
		}

		/**
		 * Get site activity level based on pages currently containing Vexaltrix blocks.
		 *
		 * Reads the sitewide `vxt_ultimate_gutenberg_blocks_pages_with_vexaltrix_count` counter maintained
		 * incrementally by {@see \Vexaltrix\Domain\Analytics\IncrementalBlockTracker}. This is O(1)
		 * and replaces the former 180-day postmeta scan.
		 *
		 * Semantics moved from "pages edited with Vexaltrix in the last 180d" to
		 * "pages currently containing any Vexaltrix block." The signal is stronger
		 * (edits are not the same as presence) and the cost is negligible.
		 *
		 * Key shape is preserved for payload compatibility — `active_pages_180d`
		 * is retained as the field name but now represents the current count.
		 *
		 * @since 2.19.19
		 * @return array Site activity data with classification.
		 */
		public function getSiteActivityLevel() {
			class_exists( 'Vexaltrix\Domain\Analytics\\DailyKpiCounters' );

			$activePagesCount = \Vexaltrix\Domain\Analytics\DailyKpiCounters::getPagesWithVexaltrix();

			$siteType = 'inactive';
			if ( $activePagesCount >= 15 ) {
				$siteType = 'super_site';
			} elseif ( $activePagesCount >= 1 ) {
				$siteType = 'active_site';
			}

			return [
				'active_pages_180d' => $activePagesCount,
				'site_type'         => $siteType,
				'is_active_site'    => $activePagesCount >= 1,
				'is_super_site'     => $activePagesCount >= 15,
			];
		}

		/**
		 * Seed the `vxt_ultimate_gutenberg_blocks_pages_with_vexaltrix_count` counter from existing meta.
		 *
		 * Walks posts that already have `_vxt_ultimate_gutenberg_blocks_previous_block_counts` — avoids
		 * re-parsing post_content — and counts those whose payload contains at
		 * least one Vexaltrix block. Writes the result absolutely (overwrite)
		 * rather than incrementing, so re-running is idempotent.
		 *
		 * @since 2.19.25
		 * @return void
		 */
		private function seedPagesWithVexaltrixCounter() {
			$postTypes = get_post_types( [ 'public' => true ], 'names' );

			$postIds = get_posts(
				[
					'post_type'              => $postTypes,
					'post_status'            => [ 'publish', 'private', 'draft' ],
					'posts_per_page'         => -1,
					'fields'                 => 'ids',
					'no_found_rows'          => true,
					'update_post_meta_cache' => false,
					'update_post_term_cache' => false,
					'meta_query'             => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- One-time seed, runs once per site lifetime.
						[
							'key'     => '_vxt_ultimate_gutenberg_blocks_previous_block_counts',
							'compare' => 'EXISTS',
						],
					],
				]
			);

			if ( empty( $postIds ) ) {
				update_option( \Vexaltrix\Domain\Analytics\DailyKpiCounters::OPT_PAGES_WITH_vexaltrix, 0, false );
				return;
			}

			$pagesWithVexaltrix = 0;
			foreach ( $postIds as $postId ) {
				$postId      = is_object( $postId ) ? $postId->ID : (int) $postId;
				$blockCounts = get_post_meta( $postId, '_vxt_ultimate_gutenberg_blocks_previous_block_counts', true );
				if ( ! is_array( $blockCounts ) ) {
					continue;
				}
				foreach ( $blockCounts as $count ) {
					if ( is_numeric( $count ) && (int) $count > 0 ) {
						++$pagesWithVexaltrix;
						break;
					}
				}
			}

			update_option( \Vexaltrix\Domain\Analytics\DailyKpiCounters::OPT_PAGES_WITH_vexaltrix, $pagesWithVexaltrix, false );
		}
	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'domain';
	}

	/**
	 * Service context.
	 *
	 * @return string
	 */
	public static function context(): string {
		return 'admin';
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
			add_action( 'update_option_vexaltrix_usage_optin', [ $this, 'handleAnalyticsOptinChange' ], 10, 3 );
			add_action( 'add_option_vexaltrix_usage_optin', [ $this, 'handleAnalyticsOptinAdd' ], 10, 2 );
			add_action( 'init', [ $this, 'maybeStartFirstRunCollection' ] );
	}

}
}
