<?php
/**
 * Vexaltrix Front Assets.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\Assets;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Presentation\Assets\FrontAssets.
 */
class FrontAssets implements ServiceInterface {

	/**
	 * Member Variable
	 *
	 * @since 0.0.1
	 * @var instance
	 */
	private static $instance;

	/**
	 * Post ID
	 *
	 * @since 1.23.0
	 * @var array
	 */
	protected $postId;

	/**
	 * Assets Post Object
	 *
	 * @since 1.23.0
	 * @var object
	 */
	protected $postAssets;

	/**
	 *  Initiator
	 *
	 * @since 0.0.1
	 */
	public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

	/**
	 * Constructor
	 */
	

	/**
	 * Set initial variables.
	 *
	 * @since 1.23.0
	 */
	public function setInitialVariables() {

		$this->postId = false;

		if ( is_single() || is_page() || is_404() ) {
			$this->postId = get_the_ID();
		}

		if ( ! $this->postId ) {
			return;
		}

		$this->postAssets = vxt_ultimate_gutenberg_blocks_get_post_assets( $this->postId );

		if ( ! $this->postAssets->is_allowed_assets_generation ) {
			return;
		}

		if ( is_single() || is_page() || is_404() ) {

			$thisPost = get_post( $this->postId );

			/**
			 * Filters the post to build stylesheet for.
			 *
			 * @param \WP_Post $thisPost The global post.
			 */
			$thisPost = apply_filters_deprecated( 'vxt_ultimate_gutenberg_blocks_post_for_stylesheet', [ $thisPost ], '1.23.0' );

			if ( $thisPost && $this->postId !== $thisPost->ID ) {
				$this->postAssets->prepareAssets( $thisPost );
			}
		}
	}

	/**
	 * Enqueue asset files.
	 *
	 * @since 1.23.0
	 */
	public function enqueueAssetFiles() {
		// Check if assets should be excluded for the current post type.
		if ( \Vexaltrix\Presentation\Admin\AdminSettings::shouldExcludeAssetsForCpt() ) {
			return; // Early return to prevent loading assets.
		}

		if ( $this->postAssets ) {
			$this->postAssets->enqueueScripts();
		}

		/* Archive & 404 page compatibility */
		if ( is_archive() || is_home() || is_search() || is_404() ) {

			global $wp_query;
			$currentObjectId = $wp_query->get_queried_object_id();
			$cachedWpQuery   = $wp_query->posts;
			if ( 0 !== $currentObjectId && null !== $currentObjectId ) {
				$currentPostAssets = new \Vexaltrix\Presentation\Assets\PostAssets( $currentObjectId );
				$currentPostAssets->enqueueScripts();
			} elseif ( ! ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) && ! empty( $cachedWpQuery ) && is_array( $cachedWpQuery ) ) {
				foreach ( $cachedWpQuery as $post ) {
					$currentPostAssets = new \Vexaltrix\Presentation\Assets\PostAssets( $post->ID );
					$currentPostAssets->enqueueScripts();
				}
			} else {
				/*
				If no posts are present in the category/archive
				or 404 page (which is an obvious case for 404), then get the current page ID and enqueue script.
				*/
				$currentObjectId   = is_int( $currentObjectId ) ? $currentObjectId : (int) $currentObjectId;
				$currentPostAssets = new \Vexaltrix\Presentation\Assets\PostAssets( $currentObjectId );
				$currentPostAssets->enqueueScripts();
			}
		}

		/* WooCommerce compatibility */
		if ( class_exists( 'WooCommerce' ) ) {

			if ( is_cart() ) {

				$id = get_option( 'woocommerce_cart_page_id' );
			} elseif ( is_account_page() ) {

				$id = get_option( 'woocommerce_myaccount_page_id' );
			} elseif ( is_checkout() ) {

				if ( is_order_received_page() ) {

					$id = get_option( 'woocommerce_checkout_order_received_endpoint', 'order-received' );
				} else {

					$id = get_option( 'woocommerce_checkout_page_id' );
				}
			} elseif ( is_checkout_pay_page() ) {

				$id = get_option( 'woocommerce_pay_page_id' );
			} elseif ( is_shop() ) {

				$id = get_option( 'woocommerce_shop_page_id' );
			} elseif ( is_order_received_page() ) {

				$id = get_option( 'woocommerce_checkout_order_received_endpoint', 'order-received' );
			}

			if ( ! empty( $id ) ) {
				$currentPostAssets = new \Vexaltrix\Presentation\Assets\PostAssets( intval( $id ) );
				$currentPostAssets->enqueueScripts();
			}
		}

	}

	/**
	 * Trigger post assets update.
	 *
	 * @param int     $postId Post ID.
	 * @param WP_Post $post    Post object.
	 * @param bool    $update  Whether this is an existing post being updated.
	 * @since 2.13.4
	 * @return mixed void if not an update, otherwise null.
	 */
	public function triggerRegenerationEvent( $postId, $post, $update ) {

		if ( ! $update ) {
			return;
		}

		if ( ! wp_next_scheduled( 'vexaltrix_regenerate_post_assets' ) && ! wp_installing() ) {
			$postAssetsRegenerationBufferTime = apply_filters( 'vexaltrix_post_assets_regeneration_buffer_time', 30 );
			wp_schedule_single_event( time() + $postAssetsRegenerationBufferTime, 'vexaltrix_regenerate_post_assets', [ $postId ] ); // Schedule for 30 seconds later.
		}
	}

	/**
	 * Update post assets.
	 *
	 * By passing everything and update assets once post is updated.
	 *
	 * @param int $postId Post ID.
	 * @since 2.13.4
	 * @return void
	 */
	public function updateCurrentPostAssets( $postId ) {
		/**
		 * Case: If previous asset version is same then we need to update the assets, resultant will reduce cache conflicts.
		 */
		$pageAssets = (array) get_post_meta( $postId, '_uag_page_assets', true );
		if ( isset( $pageAssets['uag_version'] ) && VXT_ASSET_VER === $pageAssets['uag_version'] ) {
			$pageAssets['uag_version'] = '';
			update_post_meta( $postId, '_uag_page_assets', $pageAssets );
		}
	}

	/**
	 * Get post_assets obj.
	 *
	 * @since 1.23.0
	 */
	public function getPostAssetsObj() {
		return $this->postAssets;
	}

	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'presentation';
	}

	/**
	 * Service context.
	 *
	 * @return string
	 */
	public static function context(): string {
		return 'frontend';
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
		add_action( 'wp', [ $this, 'setInitialVariables' ], 99 );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueAssetFiles' ] );
		add_action( 'vexaltrix_regenerate_post_assets', [ $this, 'updateCurrentPostAssets' ] );
		add_action( 'wp_insert_post', [ $this, 'triggerRegenerationEvent' ], 10, 3 );
	}

}

/**
 *  Prepare if class 'Vexaltrix\Presentation\Assets\\FrontAssets' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
/**
 * Get frontend post_assets obj.
 *
 * @since 1.23.0
 */
function vxtUltimateGutenbergBlocksGetFrontPostAssets() {
	return \Vexaltrix\Presentation\Assets\FrontAssets::getInstance()->getPostAssetsObj();
}
