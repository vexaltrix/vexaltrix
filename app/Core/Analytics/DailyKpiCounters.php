<?php
/**
 * Vexaltrix Daily KPI Counters.
 *
 * O(1) accumulator storage for per-day KPIs that power the Active / Super Active
 * classification in the Vexaltrix KPI dashboard. Each write increments a value in
 * a date-keyed option. Each read at payload build time fetches the last N days
 * from a single get_option() call — no postmeta scans, no wp_query.
 *
 * Replaces the postmeta-scan approach that powered `posts_modified_with_vexaltrix`,
 * which suffered from: lossy overwrites per post, full table scans twice per
 * payload cycle, and a single scalar that could not separate frequency, volume,
 * breadth, or depth of Vexaltrix usage.
 *
 * @since 2.19.25
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Analytics;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vexaltrix\\Core\\Analytics\\DailyKpiCounters' ) ) {

	/**
	 * Class \Vexaltrix\Core\Analytics\DailyKpiCounters
	 *
	 * @since 2.19.25
	 */
	class DailyKpiCounters {

		/**
		 * Singleton instance.
		 *
		 * @var \Vexaltrix\Core\Analytics\DailyKpiCounters|null
		 * @since 2.19.25
		 */
		private static $instance = null;

		/**
		 * Option storing { YYYY-MM-DD => int publish-count }.
		 *
		 * @var string
		 * @since 2.19.25
		 */
		const OPT_PUBLISH = 'vxt_ultimate_gutenberg_blocks_daily_publish_counts';

		/**
		 * Option storing { YYYY-MM-DD => [ block_slug, ... ] }.
		 * Values are unioned on write and de-duplicated on read.
		 *
		 * @var string
		 * @since 2.19.25
		 */
		const OPT_BLOCK_TYPES = 'vxt_ultimate_gutenberg_blocks_daily_block_types';

		/**
		 * Option storing { YYYY-MM-DD => int advanced-feature-uses }.
		 *
		 * @var string
		 * @since 2.19.25
		 */
		const OPT_ADVANCED = 'vxt_ultimate_gutenberg_blocks_daily_advanced_feature_uses';

		/**
		 * Option storing the sitewide count of pages containing any Vexaltrix block.
		 * Maintained incrementally by the block tracker — replaces the 180-day
		 * postmeta scan previously used for `active_pages_180d`.
		 *
		 * @var string
		 * @since 2.19.25
		 */
		const OPT_PAGES_WITH_vexaltrix = 'vxt_ultimate_gutenberg_blocks_pages_with_vexaltrix_count';

		/**
		 * Number of days retained per accumulator. The analytics payload cycles
		 * every 2 days and reads `today - 1` + `today - 2`; 7 days is a safe
		 * buffer against missed cycles, clock drift, and 2-day outages.
		 *
		 * @var int
		 * @since 2.19.25
		 */
		const RETENTION_DAYS = 7;

		/**
		 * Initiator.
		 *
		 * @since 2.19.25
		 * @return \Vexaltrix\Core\Analytics\DailyKpiCounters
		 */
		public static function getInstance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor — wires accumulator hooks.
		 *
		 * @since 2.19.25
		 */
		private function __construct() {
			// Publish + advanced-feature detection on real publish transitions only.
			add_action( 'transition_post_status', [ $this, 'onTransitionPostStatus' ], 10, 3 );

			// Block-types accumulation runs after the incremental tracker writes
			// `_vxt_ultimate_gutenberg_blocks_previous_block_counts` (priority 10). Priority 20 reads that
			// meta so we avoid re-parsing block markup.
			add_action( 'save_post', [ $this, 'onSavePostRecordBlockTypes' ], 20, 2 );

			// Global Block Styles mutation — an advanced-feature signal.
			add_action( 'update_option_vexaltrix_global_block_styles', [ $this, 'onGbsChanged' ], 10, 2 );
			add_action( 'add_option_vexaltrix_global_block_styles', [ $this, 'onGbsAdded' ], 10, 2 );
		}

		/**
		 * Record a publish transition and scan the published content for
		 * advanced-feature signals (forms, popups, dynamic content).
		 *
		 * Fires on real `any -> publish` transitions only. Publish-to-publish
		 * updates (maintenance edits), autosaves, and revisions are ignored.
		 *
		 * @since 2.19.25
		 * @param string   $newStatus New post status.
		 * @param string   $oldStatus Old post status.
		 * @param \WP_Post $post       Post object.
		 * @return void
		 */
		public function onTransitionPostStatus( $newStatus, $oldStatus, $post ) {
			if ( 'publish' !== $newStatus || 'publish' === $oldStatus ) {
				return;
			}

			if ( ! is_object( $post ) || wp_is_post_autosave( $post ) || wp_is_post_revision( $post ) ) {
				return;
			}

			// Limit to content surfaces where Vexaltrix is actually used. `vexaltrix-popup`
			// is not a public post type but its publish is itself an advanced-feature
			// signal and a meaningful publish event.
			$postType = (string) $post->post_type;
			if ( '' === $postType ) {
				return;
			}

			$publicTypes  = get_post_types( [ 'public' => true ], 'names' );
			$allowedTypes = array_merge( array_values( $publicTypes ), [ 'vexaltrix-popup' ] );

			if ( ! in_array( $postType, $allowedTypes, true ) ) {
				return;
			}

			$content = (string) $post->post_content;

			// Skip posts that do not contain any Vexaltrix block — this is a
			// Vexaltrix-specific KPI, not a general publish counter.
			if ( ! self::contentHasVexaltrixBlock( $content ) ) {
				return;
			}

			self::incrementPublish();

			// Advanced-feature signals derived from the published content. Each hit
			// is one increment; multiple signals in the same post add up.
			if ( 'vexaltrix-popup' === $postType ) {
				self::recordAdvancedFeature( 'popup' );
			}

			if ( self::contentHasFormBlock( $content ) ) {
				self::recordAdvancedFeature( 'form' );
			}

			if ( self::contentHasDynamicContent( $content ) ) {
				self::recordAdvancedFeature( 'dynamic_content' );
			}
		}

		/**
		 * Record the set of distinct Vexaltrix block types saved today.
		 *
		 * Runs after `\Vexaltrix\Core\Analytics\IncrementalBlockTracker::trackBlockChangesOnSave()`
		 * which freshly writes `_vxt_ultimate_gutenberg_blocks_previous_block_counts`. Reading that meta is
		 * cheaper than re-parsing `post_content` and keeps both counters in sync.
		 *
		 * @since 2.19.25
		 * @param int      $postId Post ID.
		 * @param \WP_Post $post    Post object.
		 * @return void
		 */
		public function onSavePostRecordBlockTypes( $postId, $post ) {
			if ( wp_is_post_autosave( $postId ) || wp_is_post_revision( $postId ) ) {
				return;
			}

			if ( ! is_object( $post ) ) {
				return;
			}

			$publicTypes = get_post_types( [ 'public' => true ], 'names' );
			if ( ! in_array( $post->post_type, $publicTypes, true ) ) {
				return;
			}

			$blockCounts = get_post_meta( $postId, '_vxt_ultimate_gutenberg_blocks_previous_block_counts', true );
			if ( ! is_array( $blockCounts ) || empty( $blockCounts ) ) {
				return;
			}

			$present = [];
			foreach ( $blockCounts as $slug => $count ) {
				if ( is_string( $slug ) && is_numeric( $count ) && (int) $count > 0 ) {
					$present[] = $slug;
				}
			}

			if ( empty( $present ) ) {
				return;
			}

			self::recordBlockTypes( $present );
		}

		/**
		 * Global Block Styles option updated — record an advanced-feature hit.
		 *
		 * Only counts when the set of styles actually changed. Prevents repeat
		 * writes of the same array (e.g., autoload re-saves) from inflating
		 * the counter.
		 *
		 * @since 2.19.25
		 * @param mixed $oldValue Previous option value.
		 * @param mixed $newValue New option value.
		 * @return void
		 */
		public function onGbsChanged( $oldValue, $newValue ) {
			if ( $oldValue === $newValue ) {
				return;
			}

			self::recordAdvancedFeature( 'gbs' );
		}

		/**
		 * Global Block Styles option created — the first style counts as one hit.
		 *
		 * @since 2.19.25
		 * @param string $option Option name (unused).
		 * @param mixed  $value  New value.
		 * @return void
		 */
		public function onGbsAdded( $option, $value ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
			if ( empty( $value ) ) {
				return;
			}

			self::recordAdvancedFeature( 'gbs' );
		}

		/**
		 * Increment today's publish count.
		 *
		 * @since 2.19.25
		 * @return void
		 */
		public static function incrementPublish() {
			$date            = self::today();
			$counts          = self::getOptionArray( self::OPT_PUBLISH );
			$current         = isset( $counts[ $date ] ) && is_numeric( $counts[ $date ] ) ? (int) $counts[ $date ] : 0;
			$counts[ $date ] = $current + 1;
			$counts          = self::prune( $counts );
			update_option( self::OPT_PUBLISH, $counts, false );
		}

		/**
		 * Union today's block-type bucket with a new set of slugs.
		 *
		 * @since 2.19.25
		 * @param string[] $slugs Block slugs (e.g., 'vexaltrix/container').
		 * @return void
		 */
		public static function recordBlockTypes( $slugs ) {
			if ( empty( $slugs ) || ! is_array( $slugs ) ) {
				return;
			}

			$date   = self::today();
			$bucket = self::getOptionArray( self::OPT_BLOCK_TYPES );

			$existing = isset( $bucket[ $date ] ) && is_array( $bucket[ $date ] ) ? $bucket[ $date ] : [];
			$merged   = array_values( array_unique( array_merge( $existing, $slugs ) ) );

			// Guard against a single malicious or runaway post type list from
			// bloating the option row. The full Vexaltrix block catalog is ~80 entries.
			if ( count( $merged ) > 200 ) {
				$merged = array_slice( $merged, 0, 200 );
			}

			$bucket[ $date ] = $merged;
			$bucket          = self::prune( $bucket );

			update_option( self::OPT_BLOCK_TYPES, $bucket, false );
		}

		/**
		 * Record an advanced-feature invocation for today.
		 *
		 * Treat multiple named features as independent increments — two features
		 * used in the same save add 2, not 1. This is what gives the Depth axis
		 * signal for Super Active classification.
		 *
		 * @since 2.19.25
		 * @param string $feature Feature identifier (e.g., 'gbs', 'popup', 'form').
		 * @return void
		 */
		public static function recordAdvancedFeature( $feature ) {
			if ( ! is_string( $feature ) || '' === trim( $feature ) ) {
				return;
			}

			$date            = self::today();
			$counts          = self::getOptionArray( self::OPT_ADVANCED );
			$current         = isset( $counts[ $date ] ) && is_numeric( $counts[ $date ] ) ? (int) $counts[ $date ] : 0;
			$counts[ $date ] = $current + 1;
			$counts          = self::prune( $counts );

			update_option( self::OPT_ADVANCED, $counts, false );
		}

		/**
		 * Return the last N entries from an accumulator option.
		 *
		 * @since 2.19.25
		 * @param string $optionKey One of the OPT_* constants.
		 * @param int    $days       Days to return (default 7).
		 * @return array<string,mixed> Date-keyed entries, newest last.
		 */
		public static function getLastNDays( $optionKey, $days = self::RETENTION_DAYS ) {
			$data = self::getOptionArray( $optionKey );
			if ( empty( $data ) ) {
				return [];
			}

			$cutoff = self::cutoffDate( max( 1, (int) $days ) );

			$filtered = [];
			foreach ( $data as $date => $value ) {
				if ( is_string( $date ) && $date >= $cutoff ) {
					$filtered[ $date ] = $value;
				}
			}

			ksort( $filtered );
			return $filtered;
		}

		/**
		 * Sitewide count of pages containing at least one Vexaltrix block.
		 *
		 * Maintained incrementally by {@see \Vexaltrix\Core\Analytics\IncrementalBlockTracker}.
		 * Replaces the 180-day postmeta scan previously used in
		 * {@see \Vexaltrix\Core\Analytics\BlockAnalytics::getSiteActivityLevel()}.
		 *
		 * @since 2.19.25
		 * @return int
		 */
		public static function getPagesWithVexaltrix() {
			$value = get_option( self::OPT_PAGES_WITH_vexaltrix, 0 );
			return is_numeric( $value ) ? max( 0, (int) $value ) : 0;
		}

		/**
		 * Adjust the sitewide page counter by a signed delta.
		 *
		 * @since 2.19.25
		 * @param int $delta +1 when a post gains Vexaltrix blocks, -1 when it loses them.
		 * @return void
		 */
		public static function adjustPagesWithVexaltrix( $delta ) {
			$delta = (int) $delta;
			if ( 0 === $delta ) {
				return;
			}

			$current = self::getPagesWithVexaltrix();
			$next    = max( 0, $current + $delta );

			update_option( self::OPT_PAGES_WITH_vexaltrix, $next, false );
		}

		/**
		 * Delete every accumulator option — used on hard-reset / uninstall.
		 *
		 * @since 2.19.25
		 * @return void
		 */
		public static function resetAll() {
			delete_option( self::OPT_PUBLISH );
			delete_option( self::OPT_BLOCK_TYPES );
			delete_option( self::OPT_ADVANCED );
			delete_option( self::OPT_PAGES_WITH_vexaltrix );
		}

		/**
		 * Today's date in YYYY-MM-DD using site timezone — matches the dashboard.
		 *
		 * @since 2.19.25
		 * @return string
		 */
		private static function today() {
			$today = wp_date( 'Y-m-d' );
			return is_string( $today ) ? $today : gmdate( 'Y-m-d' );
		}

		/**
		 * Cutoff date (inclusive) for the most-recent N-day window.
		 *
		 * @since 2.19.25
		 * @param int $days Number of days to include.
		 * @return string YYYY-MM-DD.
		 */
		private static function cutoffDate( $days ) {
			$timestamp = strtotime( self::today() . ' -' . max( 0, (int) $days - 1 ) . ' days' );
			$cutoff    = is_int( $timestamp ) ? wp_date( 'Y-m-d', $timestamp ) : self::today();
			return is_string( $cutoff ) ? $cutoff : self::today();
		}

		/**
		 * Fetch an accumulator option as an array.
		 *
		 * @since 2.19.25
		 * @param string $key Option key.
		 * @return array<string,mixed>
		 */
		private static function getOptionArray( $key ) {
			$value = get_option( $key, [] );
			return is_array( $value ) ? $value : [];
		}

		/**
		 * Drop entries older than RETENTION_DAYS days from an accumulator array.
		 *
		 * @since 2.19.25
		 * @param array<string,mixed> $data Date-keyed data.
		 * @return array<string,mixed>
		 */
		private static function prune( $data ) {
			if ( empty( $data ) ) {
				return $data;
			}

			$cutoff = self::cutoffDate( self::RETENTION_DAYS );

			foreach ( array_keys( $data ) as $date ) {
				if ( ! is_string( $date ) || $date < $cutoff ) {
					unset( $data[ $date ] );
				}
			}

			return $data;
		}

		/**
		 * Whether the serialized content contains any Vexaltrix block.
		 *
		 * Matches both `vexaltrix/` and `vexaltrix/` namespaces — the latter is used by
		 * Vexaltrix v3 blocks (see `vexaltrix-v3/` loader).
		 *
		 * @since 2.19.25
		 * @param string $content Post content.
		 * @return bool
		 */
		private static function contentHasVexaltrixBlock( $content ) {
			if ( '' === $content ) {
				return false;
			}
			return 1 === preg_match( '/<!-- wp:(uagb|vexaltrix)\//', $content );
		}

		/**
		 * Whether the content contains a Vexaltrix form block.
		 *
		 * @since 2.19.25
		 * @param string $content Post content.
		 * @return bool
		 */
		private static function contentHasFormBlock( $content ) {
			if ( '' === $content ) {
				return false;
			}
			return 1 === preg_match( '/<!-- wp:uagb\/forms\b/', $content );
		}

		/**
		 * Whether the content uses the Dynamic Content extension.
		 *
		 * Vexaltrix persists Dynamic Content as an attribute on the block's JSON
		 * payload (for example `"dynamicContent"` or field-level `"Source"` keys
		 * such as `postTitleSource`). Detecting any of these in serialized
		 * markup is a cheap proxy for "this post uses Dynamic Content."
		 *
		 * @since 2.19.25
		 * @param string $content Post content.
		 * @return bool
		 */
		private static function contentHasDynamicContent( $content ) {
			if ( '' === $content ) {
				return false;
			}
			return 1 === preg_match( '/"dynamicContent"|"[A-Za-z]+Source"\s*:\s*"[^"]+-meta"/', $content );
		}
	}
}
