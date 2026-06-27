<?php
/**
 * Vexaltrix Scripts Utils.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Support;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Support\ScriptsUtils.
 */
final class ScriptsUtils {

	/**
	 * Enqueue Gutenberg block assets for both frontend + backend.
	 *
	 * @since 1.23.0
	 */
	public static function enqueueBlocksDependencyBoth() {

		$blocks       = \Vexaltrix\Core\Blocks\BlockModule::getBlocksInfo();
		$savedBlocks = \Vexaltrix\Admin\AdminSettings::get( '_vxt_ultimate_gutenberg_blocks_blocks', [] );
		$blockAssets = \Vexaltrix\Core\Blocks\BlockModule::getBlockDependencies();

		foreach ( $blocks as $slug => $value ) {
			$slug = str_replace( 'vexaltrix/', '', $slug );

			if ( ! ( isset( $savedBlocks[ $slug ] ) && 'disabled' === $savedBlocks[ $slug ] ) ) {

				if ( 'cf7-styler' === $slug ) {
					if ( ! wp_script_is( 'contact-form-7', 'enqueued' ) ) {
						wp_enqueue_script( 'contact-form-7' );
					}

					if ( ! wp_script_is( ' wpcf7-admin', 'enqueued' ) ) {
						wp_enqueue_script( ' wpcf7-admin' );
					}
				}
				foreach ( $blockAssets as $handle => $asset ) {

					if ( isset( $asset['type'] ) ) {

						if ( 'js' === $asset['type'] ) {

							// Scripts.
							wp_register_script(
								$handle, // Handle.
								$asset['src'],
								$asset['dep'],
								VXT_VER,
								true
							);

							$skipEditor = isset( $asset['skipEditor'] ) ? $asset['skipEditor'] : false;

							if ( is_admin() && false === $skipEditor ) {
								wp_enqueue_script( $handle );
							}
						} elseif ( 'css' === $asset['type'] ) {

							// Styles.
							wp_register_style(
								$handle, // Handle.
								$asset['src'],
								$asset['dep'],
								VXT_VER
							);

							if ( is_admin() ) {
								wp_enqueue_style( $handle );
							}
						}
					}
				}
			}
		}

		$vxtUltimateGutenbergBlocksMasonryAjaxNonce = wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_masonry_ajax_nonce' );
		wp_localize_script(
			'vxt-post-js',
			'vxt_ultimate_gutenberg_blocks_data',
			[
				'ajax_url'                => admin_url( 'admin-ajax.php' ),
				'vxt_ultimate_gutenberg_blocks_masonry_ajax_nonce' => $vxtUltimateGutenbergBlocksMasonryAjaxNonce,
			]
		);

		$vxtUltimateGutenbergBlocksFormsAjaxNonce = wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_forms_ajax_nonce' );
		wp_localize_script(
			'vxt-forms-js',
			'vxt_ultimate_gutenberg_blocks_forms_data',
			[
				'ajax_url'              => admin_url( 'admin-ajax.php' ),
				'vxt_ultimate_gutenberg_blocks_forms_ajax_nonce' => $vxtUltimateGutenbergBlocksFormsAjaxNonce,
			]
		);

		$vxtUltimateGutenbergBlocksImageGalleryMasonryAjaxNonce         = wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_image_gallery_masonry_ajax_nonce' );
		$vxtUltimateGutenbergBlocksImageGalleryGridPaginationAjaxNonce = wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_image_gallery_grid_pagination_ajax_nonce' );
		wp_localize_script(
			'vxt-image-gallery-js',
			'vxt_ultimate_gutenberg_blocks_image_gallery',
			[
				'ajax_url'                              => admin_url( 'admin-ajax.php' ),
				'vxt_ultimate_gutenberg_blocks_image_gallery_masonry_ajax_nonce' => $vxtUltimateGutenbergBlocksImageGalleryMasonryAjaxNonce,
				'vxt_ultimate_gutenberg_blocks_image_gallery_grid_pagination_ajax_nonce' => $vxtUltimateGutenbergBlocksImageGalleryGridPaginationAjaxNonce,
			]
		);

		wp_localize_script(
			'vxt-countdown-js',
			'vxt_ultimate_gutenberg_blocks_countdown_data',
			[
				'site_name_slug' => sanitize_title( get_bloginfo( 'name' ) ),
			]
		);

	}

	/**
	 * Enqueue block styles.
	 *
	 * @since 1.23.0
	 */
	public static function enqueueBlocksStyles() {

		$wpUploadDir = \Vexaltrix\Support\Helper::getUagUploadDirPath();

		if ( file_exists( $wpUploadDir . 'custom-style-blocks.css' ) ) {

			$wpUploadUrl = \Vexaltrix\Support\Helper::getUagUploadUrlPath();

			wp_enqueue_style(
				'vxt-block-css', // Handle.
				$wpUploadUrl . 'custom-style-blocks.css', // Block style CSS.
				[],
				VXT_VER
			);
		} else {
			wp_enqueue_style(
				'vxt-block-css', // Handle.
				VXT_URL . 'assets/build/style-blocks.css', // Block style CSS.
				[],
				VXT_VER
			);
		}
	}

	/**
	 * Enqueue block rtl styles.
	 *
	 * @since 1.23.0
	 */
	public static function enqueueBlocksRtlStyles() {
		if ( is_rtl() ) {
			wp_enqueue_style(
				'vxt-style-rtl', // Handle.
				VXT_URL . 'assets/css/style-blocks-rtl.min.css', // RTL style CSS.
				[],
				VXT_VER
			);
		}
	}

	/**
	 * Get folder name by post id.
	 *
	 * @param int $postId post id.
	 * @since 2.0.0
	 */
	public static function getAssetFolderName( $postId ) {

		$folderName = 0;

		if ( ! empty( $postId ) ) {
			$folderName = absint( round( $postId, -3 ) );
		}

		return $folderName;
	}

	/**
	 * Returns an array of paths for the CSS and JS assets
	 * of the current post.
	 *
	 * @param  string $type    Gets the CSS\JS type.
	 * @param  int    $postId Post ID.
	 * @since 1.14.0
	 * @return array
	 */
	public static function getAssetInfo( $type, $postId ) {

		$uploadsDir = \Vexaltrix\Support\Helper::getUploadDir();
		$folderName = self::getAssetFolderName( $postId );
		$fileName   = get_post_meta( $postId, '_uag_' . $type . '_file_name', true );
		$path        = $type;
		$url         = $type . '_url';

		$info = [
			$path => '',
			$url  => '',
		];

		if ( ! empty( $fileName ) ) {
			$info[ $path ] = $uploadsDir['path'] . 'assets/' . $folderName . '/' . $fileName;
			$info[ $url ]  = $uploadsDir['url'] . 'assets/' . $folderName . '/' . $fileName;
		}

		return $info;
	}

	/**
	 * Get JS url from to assets.
	 *
	 * @since 2.0.0
	 *
	 * @param string $fileName File name.
	 *
	 * @return string JS url.
	 */
	public static function getJsUrl( $fileName ) {
		return VXT_URL . 'assets/js/' . $fileName . VXT_JS_EXT;
	}
}
