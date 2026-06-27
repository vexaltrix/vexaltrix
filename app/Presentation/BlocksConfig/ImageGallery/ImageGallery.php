<?php
/**
 * Vexaltrix - Image Gallery
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\BlocksConfig\ImageGallery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\BlocksConfig\\ImageGallery\\ImageGallery' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\BlocksConfig\ImageGallery\ImageGallery.
	 */
	final class ImageGallery {

		/**
		 * Member Variable
		 *
		 * @since 2.1
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @since 2.1
		 * @var settings
		 */
		private static $settings;

		/**
		 *  Initiator
		 *
		 * @since 2.1
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'registerImageGallery' ] );
			add_action( 'wp_ajax_vxt_load_image_gallery_masonry', [ $this, 'renderMasonryPagination' ] );
			add_action( 'wp_ajax_nopriv_vxt_load_image_gallery_masonry', [ $this, 'renderMasonryPagination' ] );
			add_action( 'wp_ajax_vxt_load_image_gallery_grid_pagination', [ $this, 'renderGridPagination' ] );
			add_action( 'wp_ajax_nopriv_vxt_load_image_gallery_grid_pagination', [ $this, 'renderGridPagination' ] );

			// Prevent Imagify from converting images into <picture> tags, which breaks the Vexaltrix Lightbox.
			add_filter( 'imagify_allow_picture_tags_for_nextgen', '__return_false' );
		}

		/**
		 * Registers the `image-gallery` block on server.
		 *
		 * @since 2.1
		 */
		public function registerImageGallery() {
			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			$arrowBorderAttributes      = [];
			$btnBorderAttributes        = [];
			$imageBorderAttributes      = [];
			$mainTitleBorderAttributes = [];

			if ( method_exists( 'Vexaltrix\Presentation\Blocks\\BlockHelper', 'uagGeneratePhpBorderAttribute' ) ) {
				$arrowBorderAttributes      = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute(
					'arrow',
					[
						'borderStyle'             => 'none',
						'borderTopWidth'          => 4,
						'borderRightWidth'        => 4,
						'borderLeftWidth'         => 4,
						'borderBottomWidth'       => 4,
						'borderTopLeftRadius'     => 50,
						'borderTopRightRadius'    => 50,
						'borderBottomLeftRadius'  => 50,
						'borderBottomRightRadius' => 50,
					]
				);
				$btnBorderAttributes        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'btn' );
				$imageBorderAttributes      = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'image' );
				$mainTitleBorderAttributes = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute(
					'mainTitle',
					[
						'borderTopWidth'    => 2,
						'borderRightWidth'  => 0,
						'borderBottomWidth' => 2,
						'borderLeftWidth'   => 0,
					]
				);
			}

			$proAttributes = apply_filters( 'vxt_ultimate_gutenberg_blocks_image_gallery_dynamic_attributes', [] );

			register_block_type(
				'vexaltrix/image-gallery',
				[
					'attributes'      => array_merge(
						// Block Requirements.
						[
							'block_id'     => [
								'type' => 'string',
							],
							'classMigrate' => [
								'type'    => 'boolean',
								'default' => false,
							],
						],
						// Editor Requirements.
						[
							'readyToRender'    => [
								'type'    => 'boolean',
								'default' => false,
							],
							'tileSize'         => [
								'type'    => 'number',
								'default' => 0,
							],
							'tileSizeFrontEnd' => [
								'type'    => 'number',
								'default' => 0,
							],
							'focusList'        => [
								'type'    => 'array',
								'default' => [],
							],
							'focusListObject'  => [
								'type'    => 'object',
								'default' => [],
							],
							'disableLazyLoad'  => [
								'type'    => 'boolean',
								'default' => false,
							],
						],
						// Gallery Settings.
						[
							'mediaGallery'           => [
								'type'    => 'array',
								'default' => [],
							],
							'mediaIDs'               => [
								'type'    => 'array',
								'default' => [],
							],
							'feedLayout'             => [
								'type'    => 'string',
								'default' => 'grid',
							],
							'imageDisplayCaption'    => [
								'type'    => 'boolean',
								'default' => true,
							],
							'galleryImageSize'       => [
								'type'    => 'string',
								'default' => 'large',
							],
							'galleryImageSizeTablet' => [
								'type'    => 'string',
								'default' => 'large',
							],
							'galleryImageSizeMobile' => [
								'type'    => 'string',
								'default' => 'medium',
							],
							'imageClickEvent'        => [
								'type'    => 'string',
								'default' => 'none',
							],
						],
						// Lightbox Settings.
						[
							'lightboxDisplayCaptions'     => [
								'type'    => 'boolean',
								'default' => false,
							],
							'lightboxThumbnails'          => [
								'type'    => 'boolean',
								'default' => false,
							],
							'lightboxDisplayCount'        => [
								'type'    => 'boolean',
								'default' => false,
							],
							'lightboxCloseIcon'           => [
								'type'    => 'string',
								'default' => 'xmark',
							],
							'lightboxCaptionHeight'       => [
								'type'    => 'number',
								'default' => 50,
							],
							'lightboxCaptionHeightTablet' => [
								'type' => 'number',
							],
							'lightboxCaptionHeightMobile' => [
								'type' => 'number',
							],
							'lightboxIconSize'            => [
								'type'    => 'number',
								'default' => 24,
							],
							'lightboxIconSizeTablet'      => [
								'type' => 'number',
							],
							'lightboxIconSizeMobile'      => [
								'type' => 'number',
							],
						],
						// Caption Settings.
						[
							'captionVisibility'       => [
								'type'    => 'string',
								'default' => 'hover',
							],
							'captionDisplayType'      => [
								'type'    => 'string',
								'default' => 'overlay',
							],
							'imageCaptionAlignment'   => [
								'type'    => 'string',
								'default' => 'center center',
							],
							'imageCaptionAlignment01' => [
								'type'    => 'string',
								'default' => 'center',
							],
							'imageCaptionAlignment02' => [
								'type'    => 'string',
								'default' => 'center',
							],
							'imageDefaultCaption'     => [
								'type'    => 'string',
								'default' => __( 'No Caption', 'vexaltrix' ),
							],
							'captionPaddingTop'       => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingRight'     => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingBottom'    => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingLeft'      => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingTopTab'    => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingRightTab'  => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingBottomTab' => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingLeftTab'   => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingTopMob'    => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingRightMob'  => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingBottomMob' => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingLeftMob'   => [
								'type'    => 'number',
								'default' => 8,
							],
							'captionPaddingUnit'      => [
								'type'    => 'string',
								'default' => 'px',
							],
							'captionPaddingUnitTab'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'captionPaddingUnitMob'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'captionPaddingUnitLink'  => [
								'type'    => 'boolean',
								'default' => true,
							],
							'captionGap'              => [
								'type'    => 'number',
								'default' => 4,
							],
							'captionGapUnit'          => [
								'type'    => 'string',
								'default' => 'px',
							],
						],
						// Layout Settings.
						[
							'columnsDesk'         => [
								'type'    => 'number',
								'default' => 3,
							],
							'columnsTab'          => [
								'type'    => 'number',
								'default' => 3,
							],
							'columnsMob'          => [
								'type'    => 'number',
								'default' => 2,
							],
							'gridImageGap'        => [
								'type'    => 'number',
								'default' => 8,
							],
							'gridImageGapTab'     => [
								'type' => 'number',
							],
							'gridImageGapMob'     => [
								'type' => 'number',
							],
							'gridImageGapUnit'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'gridImageGapUnitTab' => [
								'type'    => 'string',
								'default' => 'px',
							],
							'gridImageGapUnitMob' => [
								'type'    => 'string',
								'default' => 'px',
							],
							'feedMarginTop'       => [
								'type' => 'number',
							],
							'feedMarginRight'     => [
								'type' => 'number',
							],
							'feedMarginBottom'    => [
								'type' => 'number',
							],
							'feedMarginLeft'      => [
								'type' => 'number',
							],
							'feedMarginTopTab'    => [
								'type' => 'number',
							],
							'feedMarginRightTab'  => [
								'type' => 'number',
							],
							'feedMarginBottomTab' => [
								'type' => 'number',
							],
							'feedMarginLeftTab'   => [
								'type' => 'number',
							],
							'feedMarginTopMob'    => [
								'type' => 'number',
							],
							'feedMarginRightMob'  => [
								'type' => 'number',
							],
							'feedMarginBottomMob' => [
								'type' => 'number',
							],
							'feedMarginLeftMob'   => [
								'type' => 'number',
							],
							'feedMarginUnit'      => [
								'type'    => 'string',
								'default' => 'px',
							],
							'feedMarginUnitTab'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'feedMarginUnitMob'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'feedMarginUnitLink'  => [
								'type'    => 'boolean',
								'default' => true,
							],
						],
						// Layout Specific Settings.
						[
							'carouselStartAt'         => [
								'type'    => 'number',
								'default' => 0,
							],
							'carouselSquares'         => [
								'type'    => 'boolean',
								'default' => false,
							],
							'carouselLoop'            => [
								'type'    => 'boolean',
								'default' => true,
							],
							'carouselAutoplay'        => [
								'type'    => 'boolean',
								'default' => true,
							],
							'carouselAutoplaySpeed'   => [
								'type'    => 'number',
								'default' => 2000,
							],
							'carouselPauseOnHover'    => [
								'type'    => 'boolean',
								'default' => true,
							],
							'carouselTransitionSpeed' => [
								'type'    => 'number',
								'default' => 500,
							],
							'gridPages'               => [
								'type'    => 'number',
								'default' => 1,
							],
							'gridPageNumber'          => [
								'type'    => 'number',
								'default' => 1,
							],
						],
						// Pagination Settings.
						[
							'feedPagination'               => [
								'type'    => 'boolean',
								'default' => false,
							],
							'paginateUseArrows'            => [
								'type'    => 'boolean',
								'default' => true,
							],
							'paginateUseDots'              => [
								'type'    => 'boolean',
								'default' => true,
							],
							'paginateUseLoader'            => [
								'type'    => 'boolean',
								'default' => true,
							],
							'paginateLimit'                => [
								'type'    => 'number',
								'default' => 9,
							],
							'paginateButtonAlign'          => [
								'type'    => 'string',
								'default' => 'center',
							],
							'paginateButtonText'           => [
								'type'    => 'string',
								'default' => __( 'Load More Images', 'vexaltrix' ),
							],
							'paginateButtonPaddingTop'     => [
								'type' => 'number',
							],
							'paginateButtonPaddingRight'   => [
								'type' => 'number',
							],
							'paginateButtonPaddingBottom'  => [
								'type' => 'number',
							],
							'paginateButtonPaddingLeft'    => [
								'type' => 'number',
							],
							'paginateButtonPaddingTopTab'  => [
								'type' => 'number',
							],
							'paginateButtonPaddingRightTab' => [
								'type' => 'number',
							],
							'paginateButtonPaddingBottomTab' => [
								'type' => 'number',
							],
							'paginateButtonPaddingLeftTab' => [
								'type' => 'number',
							],
							'paginateButtonPaddingTopMob'  => [
								'type' => 'number',
							],
							'paginateButtonPaddingRightMob' => [
								'type' => 'number',
							],
							'paginateButtonPaddingBottomMob' => [
								'type' => 'number',
							],
							'paginateButtonPaddingLeftMob' => [
								'type' => 'number',
							],
							'paginateButtonPaddingUnit'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'paginateButtonPaddingUnitTab' => [
								'type'    => 'string',
								'default' => 'px',
							],
							'paginateButtonPaddingUnitMob' => [
								'type'    => 'string',
								'default' => 'px',
							],
							'paginateButtonPaddingUnitLink' => [
								'type'    => 'boolean',
								'default' => true,
							],
						],
						// Image Styling.
						[
							'imageEnableZoom'             => [
								'type'    => 'boolean',
								'default' => true,
							],
							'imageZoomType'               => [
								'type'    => 'string',
								'default' => 'zoom-in',
							],
							'captionBackgroundEnableBlur' => [
								'type'    => 'boolean',
								'default' => false,
							],
							'captionBackgroundBlurAmount' => [
								'type'    => 'number',
								'default' => 0,
							],
							'captionBackgroundBlurAmountHover' => [
								'type'    => 'number',
								'default' => 5,
							],
						],
						// Lightbox Styling.
						[
							'lightboxEdgeDistance'         => [
								'type'    => 'number',
								'default' => 10,
							],
							'lightboxEdgeDistanceTablet'   => [
								'type' => 'number',
							],
							'lightboxEdgeDistanceMobile'   => [
								'type' => 'number',
							],
							'lightboxBackgroundEnableBlur' => [
								'type'    => 'boolean',
								'default' => true,
							],
							'lightboxBackgroundBlurAmount' => [
								'type'    => 'number',
								'default' => 5,
							],
							'lightboxBackgroundColor'      => [
								'type'    => 'string',
								'default' => 'rgba(0,0,0,0.75)',
							],
							'lightboxIconColor'            => [
								'type'    => 'string',
								'default' => 'rgba(255,255,255,1)',
							],
							'lightboxCaptionColor'         => [
								'type'    => 'string',
								'default' => 'rgba(255,255,255,1)',
							],
							'lightboxCaptionBackgroundColor' => [
								'type'    => 'string',
								'default' => 'rgba(0,0,0,1)',
							],

						],
						// Caption Typography Styling.
						[
							'captionLoadGoogleFonts' => [
								'type'    => 'boolean',
								'default' => false,
							],
							'captionFontFamily'      => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'captionFontWeight'      => [
								'type' => 'string',
							],
							'captionFontStyle'       => [
								'type'    => 'string',
								'default' => 'normal',
							],
							'captionTransform'       => [
								'type' => 'string',
							],
							'captionDecoration'      => [
								'type'    => 'string',
								'default' => 'none',
							],
							'captionFontSizeType'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'captionFontSize'        => [
								'type' => 'number',
							],
							'captionFontSizeTab'     => [
								'type' => 'number',
							],
							'captionFontSizeMob'     => [
								'type' => 'number',
							],
							'captionLineHeightType'  => [
								'type'    => 'string',
								'default' => 'em',
							],
							'captionLineHeight'      => [
								'type' => 'number',
							],
							'captionLineHeightTab'   => [
								'type' => 'number',
							],
							'captionLineHeightMob'   => [
								'type' => 'number',
							],
						],
						// Pagination Button Typography Styling.
						[
							'loadMoreLoadGoogleFonts' => [
								'type'    => 'boolean',
								'default' => false,
							],
							'loadMoreFontFamily'      => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'loadMoreFontWeight'      => [
								'type' => 'string',
							],
							'loadMoreFontStyle'       => [
								'type'    => 'string',
								'default' => 'normal',
							],
							'loadMoreTransform'       => [
								'type' => 'string',
							],
							'loadMoreDecoration'      => [
								'type'    => 'string',
								'default' => 'none',
							],
							'loadMoreFontSizeType'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'loadMoreFontSize'        => [
								'type' => 'number',
							],
							'loadMoreFontSizeTab'     => [
								'type' => 'number',
							],
							'loadMoreFontSizeMob'     => [
								'type' => 'number',
							],
							'loadMoreLineHeightType'  => [
								'type'    => 'string',
								'default' => 'em',
							],
							'loadMoreLineHeight'      => [
								'type' => 'number',
							],
							'loadMoreLineHeightTab'   => [
								'type' => 'number',
							],
							'loadMoreLineHeightMob'   => [
								'type' => 'number',
							],
						],
						// Lightbox Typography Styling.
						[
							'lightboxLoadGoogleFonts' => [
								'type'    => 'boolean',
								'default' => false,
							],
							'lightboxFontFamily'      => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'lightboxFontWeight'      => [
								'type' => 'string',
							],
							'lightboxFontStyle'       => [
								'type'    => 'string',
								'default' => 'normal',
							],
							'lightboxTransform'       => [
								'type' => 'string',
							],
							'lightboxDecoration'      => [
								'type'    => 'string',
								'default' => 'none',
							],
							'lightboxFontSizeType'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'lightboxFontSize'        => [
								'type' => 'number',
							],
							'lightboxFontSizeTab'     => [
								'type' => 'number',
							],
							'lightboxFontSizeMob'     => [
								'type' => 'number',
							],
							'lightboxLineHeightType'  => [
								'type'    => 'string',
								'default' => 'em',
							],
							'lightboxLineHeight'      => [
								'type' => 'number',
							],
							'lightboxLineHeightTab'   => [
								'type' => 'number',
							],
							'lightboxLineHeightMob'   => [
								'type' => 'number',
							],
						],
						// Hoverable Styling.
						[
							'captionBackgroundEffect'      => [
								'type'    => 'string',
								'default' => 'none',
							],
							'captionBackgroundEffectHover' => [
								'type'    => 'string',
								'default' => 'none',
							],
							'captionBackgroundEffectAmount' => [
								'type'    => 'number',
								'default' => 100,
							],
							'captionBackgroundEffectAmountHover' => [
								'type'    => 'number',
								'default' => 0,
							],
							'captionColor'                 => [
								'type'    => 'string',
								'default' => 'rgba(255,255,255,1)',
							],
							'captionColorHover'            => [
								'type'    => 'string',
								'default' => 'rgba(255,255,255,1)',
							],
							'captionBackgroundColor'       => [
								'type'    => 'string',
								'default' => 'rgba(0,0,0,0.75)',
							],
							'captionBackgroundColorHover'  => [
								'type'    => 'string',
								'default' => 'rgba(0,0,0,0.75)',
							],
							'overlayColor'                 => [
								'type'    => 'string',
								'default' => 'rgba(0,0,0,0)',
							],
							'overlayColorHover'            => [
								'type'    => 'string',
								'default' => 'rgba(0,0,0,0)',
							],
							'captionSeparateColors'        => [
								'type'    => 'boolean',
								'default' => false,
							],
						],
						// Pagination Styling.
						[
							'paginateArrowDistance'        => [
								'type'    => 'number',
								'default' => -24,
							],
							'paginateArrowDistanceUnit'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'paginateArrowSize'            => [
								'type'    => 'number',
								'default' => 24,
							],
							'paginateDotDistance'          => [
								'type'    => 'number',
								'default' => 8,
							],
							'paginateDotDistanceUnit'      => [
								'type'    => 'string',
								'default' => 'px',
							],
							'paginateLoaderSize'           => [
								'type'    => 'number',
								'default' => 18,
							],
							'paginateButtonTextColor'      => [
								'type' => 'string',
							],
							'paginateButtonTextColorHover' => [
								'type' => 'string',
							],
							'paginateColor'                => [
								'type' => 'string',
							],
							'paginateColorHover'           => [
								'type' => 'string',
							],
						],
						// Box Shadow Styling.
						[
							'imageBoxShadowColor'         => [
								'type' => 'string',
							],
							'imageBoxShadowHOffset'       => [
								'type'    => 'number',
								'default' => 0,
							],
							'imageBoxShadowVOffset'       => [
								'type'    => 'number',
								'default' => 0,
							],
							'imageBoxShadowBlur'          => [
								'type' => 'number',
							],
							'imageBoxShadowSpread'        => [
								'type' => 'number',
							],
							'imageBoxShadowPosition'      => [
								'type'    => 'string',
								'default' => 'outset',
							],
							'imageBoxShadowColorHover'    => [
								'type' => 'string',
							],
							'imageBoxShadowHOffsetHover'  => [
								'type'    => 'number',
								'default' => 0,
							],
							'imageBoxShadowVOffsetHover'  => [
								'type'    => 'number',
								'default' => 0,
							],
							'imageBoxShadowBlurHover'     => [
								'type' => 'number',
							],
							'imageBoxShadowSpreadHover'   => [
								'type' => 'number',
							],
							'imageBoxShadowPositionHover' => [
								'type'    => 'string',
								'default' => 'outset',
							],
						],
						// Pro Attributes.
						$proAttributes,
						// Responsive Borders.
						$arrowBorderAttributes,
						$btnBorderAttributes,
						$imageBorderAttributes,
						$mainTitleBorderAttributes
					),
					'renderCallback' => [ $this, 'renderInitialGrid' ],
				]
			);
		}

		/**
		 * Renders All Images.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 2.1
		 */
		public function renderInitialGrid( $attributes ) {
			$allMedia = '';
			if ( $attributes['readyToRender'] ) {
				$media = ( ( 'carousel' !== $attributes['feedLayout'] && 'tiled' !== $attributes['feedLayout'] ) && $attributes['feedPagination'] )
					? $this->getGalleryImages( $attributes, 'paginated' )
					: $this->getGalleryImages( $attributes, 'full' );

				if ( ! $media ) {
					ob_start();
					?>
					<!-- Configure your Vexaltrix Image Gallery -->
					<?php
					return ob_get_clean();
				}

				foreach ( $attributes as $key => $attribute ) {
					$attributes[ $key ] = ( 'false' === $attribute ) ? false : ( ( 'true' === $attribute ) ? true : $attribute );
				}

				$desktopClass = '';
				$tabClass     = '';
				$mobClass     = '';

				$vxtUltimateGutenbergBlocksCommonSelectorClass = ''; // Required for z-index.

				if ( array_key_exists( 'UAGHideDesktop', $attributes ) || array_key_exists( 'UAGHideTab', $attributes ) || array_key_exists( 'UAGHideMob', $attributes ) ) {

					$desktopClass = ( isset( $attributes['UAGHideDesktop'] ) ) ? 'uag-hide-desktop' : '';

					$tabClass = ( isset( $attributes['UAGHideTab'] ) ) ? 'uag-hide-tab' : '';

					$mobClass = ( isset( $attributes['UAGHideMob'] ) ) ? 'uag-hide-mob' : '';
				}

				$zindexDesktop = '';
				$zindexTablet  = '';
				$zindexMobile  = '';
				$zindexWrap    = [];

				if ( array_key_exists( 'zIndex', $attributes ) || array_key_exists( 'zIndexTablet', $attributes ) || array_key_exists( 'zIndexMobile', $attributes ) ) {
					$vxtUltimateGutenbergBlocksCommonSelectorClass = 'uag-blocks-common-selector';
					$zindexDesktop             = array_key_exists( 'zIndex', $attributes ) && ( '' !== $attributes['zIndex'] ) ? '--z-index-desktop:' . $attributes['zIndex'] . ';' : false;
					$zindexTablet              = array_key_exists( 'zIndexTablet', $attributes ) && ( '' !== $attributes['zIndexTablet'] ) ? '--z-index-tablet:' . $attributes['zIndexTablet'] . ';' : false;
					$zindexMobile              = array_key_exists( 'zIndexMobile', $attributes ) && ( '' !== $attributes['zIndexMobile'] ) ? '--z-index-mobile:' . $attributes['zIndexMobile'] . ';' : false;

					if ( $zindexDesktop ) {
						array_push( $zindexWrap, $zindexDesktop );
					}

					if ( $zindexTablet ) {
						array_push( $zindexWrap, $zindexTablet );
					}

					if ( $zindexMobile ) {
						array_push( $zindexWrap, $zindexMobile );
					}
				}

				// Check if the new Object Focus List is empty and the old Array Focus List is not - if so, transfer it.
				if ( empty( $attributes['focusListObject'] ) && is_array( $attributes['focusList'] ) && ! empty( $attributes['focusList'] ) ) {
					foreach ( $attributes['focusList'] as $imageId => $focusValue ) {
						if ( true === $focusValue ) {
							$attributes['focusListObject'][ $imageId ] = $focusValue;
						}
					}
				}

				$wrap = [
					'wp-block-vxt-image-gallery',
					'vxt-block-' . $attributes['block_id'],
					( isset( $attributes['className'] ) ) ? $attributes['className'] : '',
					$desktopClass,
					$tabClass,
					$mobClass,
					$vxtUltimateGutenbergBlocksCommonSelectorClass,
				];

				$allMedia               = $this->renderMediaMarkup( $media, $attributes );
				$gridPageKses         = wp_kses_allowed_html( 'post' );
				$gridPageArgs         = [
					'div'    => [ 'class' => true ],
					'button' => [
						'data-role'      => true,
						'class'          => true,
						'aria-label'     => true,
						'tabindex'       => true,
						'data-direction' => true,
						'disabled'       => true,
					],
					'svg'    => [
						'width'       => true,
						'height'      => true,
						'viewbox'     => true,
						'aria-hidden' => true,
					],
					'path'   => [ 'd' => true ],
					'ul'     => [ 'class' => true ],
					'li'     => [
						'class'      => true,
						'data-go-to' => true,
					],
				];
				$mediaArgs             = [
					'div'     => 'carousel' !== $attributes['feedLayout'] ? [
						'class'                         => true,
						'data-vexaltrix-gallery-image-id' => true,
						'tabindex'                      => true,
					] : [
						'class'                         => true,
						'data-vexaltrix-gallery-image-id' => true,
					], 
					'picture' => [],
					'source'  => [
						'media'  => true,
						'srcset' => true,
					],
				];
				$gridPageAllowedTags = array_merge( $gridPageKses, $gridPageArgs );
				$mediaAllowedTags     = array_merge( $gridPageKses, $mediaArgs );

				ob_start();

				?>
					<div
						class="<?php echo esc_attr( implode( ' ', $wrap ) ); ?>"
						style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>"
					>
				<?php
				switch ( $attributes['feedLayout'] ) {
					case 'grid':
						$gridLayout = ( $attributes['feedPagination'] ) ? 'isogrid' : 'grid';
						?>
							<div class="vexaltrix-image-gallery vexaltrix-image-gallery__layout--<?php echo esc_attr( $gridLayout ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $gridLayout ); ?>-col-<?php echo esc_attr( $attributes['columnsDesk'] ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $gridLayout ); ?>-col-tab-<?php echo esc_attr( $attributes['columnsTab'] ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $gridLayout ); ?>-col-mob-<?php echo esc_attr( $attributes['columnsMob'] ); ?>">
								<?php echo wp_kses( $allMedia, $mediaAllowedTags ); ?>
							</div>
							<?php echo $attributes['feedPagination'] ? wp_kses( $this->renderGridPaginationControls( $attributes ), $gridPageAllowedTags ) : ''; ?>
						<?php
						break;
					case 'masonry':
						?>
							<div class="vexaltrix-image-gallery vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?>-col-<?php echo esc_attr( $attributes['columnsDesk'] ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?>-col-tab-<?php echo esc_attr( $attributes['columnsTab'] ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?>-col-mob-<?php echo esc_attr( $attributes['columnsMob'] ); ?>">
								<?php echo wp_kses( $allMedia, $mediaAllowedTags ); ?>
							</div>
							<?php echo $attributes['feedPagination'] ? wp_kses_post( $this->renderMasonryPaginationControls( $attributes ) ) : ''; ?>
						<?php
						break;
					case 'carousel':
						?>
							<div class="vexaltrix-image-gallery vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?>">
								<div class="vxt-slick-carousel vxt-block-<?php echo esc_attr( $attributes['block_id'] ); ?>">
									<?php echo wp_kses( $allMedia, $mediaAllowedTags ); ?>
								</div>
							</div>
						<?php
						break;
					case 'tiled':
						?>
							<div class="vexaltrix-image-gallery vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?>-col-<?php echo esc_attr( $attributes['columnsDesk'] ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?>-col-tab-<?php echo esc_attr( $attributes['columnsTab'] ); ?> vexaltrix-image-gallery__layout--<?php echo esc_attr( $attributes['feedLayout'] ); ?>-col-mob-<?php echo esc_attr( $attributes['columnsMob'] ); ?>">
								<?php echo wp_kses( $allMedia, $mediaAllowedTags ); ?>
								<div class="vexaltrix-image-gallery__media-sizer"></div>
							</div>
						<?php
						break;
				}
				?>
					</div>
					<?php if ( 'lightbox' === $attributes['imageClickEvent'] ) : ?>
						<div class='vexaltrix-image-gallery__control-lightbox' tabindex='0'>
							<?php $this->renderLightbox( $attributes ); ?>
							<?php
							if ( $attributes['lightboxThumbnails'] ) {
									$this->renderThumbnails( $attributes );
							}
							?>
							<?php if ( $attributes['lightboxDisplayCount'] ) : ?>
								<div class='vexaltrix-image-gallery__control-lightbox--count'>
									<?php if ( is_rtl() ) : ?>
										<span class='vexaltrix-image-gallery__control-lightbox--count-total'>1</span>/<span class='vexaltrix-image-gallery__control-lightbox--count-page'>1</span>
									<?php else : ?>
										<span class='vexaltrix-image-gallery__control-lightbox--count-page'>1</span>/<span class='vexaltrix-image-gallery__control-lightbox--count-total'>1</span>
									<?php endif; ?>									
								</div>
							<?php endif; ?>
							<?php if ( $attributes['lightboxCloseIcon'] ) : ?>
								<button class='vexaltrix-image-gallery__control-lightbox--close' aria-label="Close">
									<?php \Vexaltrix\Core\Support\Helper::renderSvgHtml( $attributes['lightboxCloseIcon'] ); ?>
								</button>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php
				// Restore Imagify's default behavior after the Lightbox has been rendered.
				remove_filter( 'imagify_allow_picture_tags_for_nextgen', '__return_false' );
				return ob_get_clean();
			}
		}

		/**
		 * Renders Lightbox.
		 *
		 * @param array $attributes Array of block attributes.
		 * @return void
		 *
		 * @since 2.4.0
		 */
		private function renderLightbox( $attributes ) {
			$totalImages = count( $attributes['mediaGallery'] );
			?>
				<div class="swiper vexaltrix-image-gallery__control-lightbox--main" dir="<?php echo is_rtl() ? 'rtl' : ''; ?>">
					<div class="swiper-wrapper">
						<?php for ( $i = 0; $i < $totalImages; $i++ ) { ?>							
							<div class="swiper-slide">
								<img class="swiper-lazy" data-src="<?php echo esc_url( $attributes['mediaGallery'][ $i ]['url'] ); ?>" alt="<?php echo esc_attr( $attributes['mediaGallery'][ $i ]['alt'] ); ?>"/>
								<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
								<?php if ( $attributes['lightboxDisplayCaptions'] ) : ?>
									<div class="vexaltrix-image-gallery__control-lightbox--caption" data-vexaltrix-gallery-image-id='<?php echo esc_attr( $attributes['mediaGallery'][ $i ]['id'] ); ?>'>
										<?php echo $attributes['mediaGallery'][ $i ]['caption'] ? wp_kses_post( $attributes['mediaGallery'][ $i ]['caption'] ) : wp_kses_post( $attributes['imageDefaultCaption'] ); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php } ?>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>			
			<?php
		}

		/**
		 * Renders Lightbox Thumbnails.
		 *
		 * @param array $attributes Array of block attributes.
		 * @return void
		 *
		 * @since 2.4.0
		 */
		private function renderThumbnails( $attributes ) {
			$totalImages = count( $attributes['mediaGallery'] );
			?>
				<div class="vexaltrix-image-gallery__control-lightbox--thumbnails-wrapper">
					<div class="swiper vexaltrix-image-gallery__control-lightbox--thumbnails">
						<div class="swiper-wrapper">
							<?php 
							for ( $i = 0; $i < $totalImages; $i++ ) { 
								$imageUrl = ! empty( $attributes['mediaGallery'][ $i ]['sizes']['thumbnail']['url'] ) ? $attributes['mediaGallery'][ $i ]['sizes']['thumbnail']['url'] : $attributes['mediaGallery'][ $i ]['url'];
								?>
								<div class="swiper-slide">
									<img src="<?php echo esc_url( $imageUrl ); ?>" tabindex="0" alt="<?php echo esc_attr( $attributes['mediaGallery'][ $i ]['alt'] ); ?>"/>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php
		}

		/**
		 * Renders Grid Pagination Controls.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 2.1
		 */
		private function renderGridPaginationControls( $attributes ) {
			ob_start();
			?>
			<div class="vexaltrix-image-gallery__control-wrapper">
				<button data-role="none" class="vexaltrix-image-gallery__control-arrows vexaltrix-image-gallery__control-arrows--<?php echo esc_attr( $attributes['feedLayout'] ); ?>" aria-label="Previous" tabIndex="0" data-direction="Prev"<?php echo ( 'grid' === $attributes['feedLayout'] && 1 === $attributes['gridPageNumber'] ) ? ' disabled' : ''; ?>>
					<svg width=20 height=20 viewBox="0 0 256 512" aria-hidden="true">
						<path d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z">
						</path>
					</svg>
				</button>
				<ul class="vexaltrix-image-gallery__control-dots">
					<?php
					for ( $i = 0; $i < $attributes['gridPages']; $i++ ) {
						$currentPage = strval( $i + 1 );
						?>
						<li class="vexaltrix-image-gallery__control-dot<?php echo ( ( $attributes['gridPageNumber'] - 1 ) === $i ) ? ' vexaltrix-image-gallery__control-dot--active' : ''; ?>" data-go-to=<?php echo esc_attr( $currentPage ); ?>>
							<button aria-label="Page <?php echo esc_attr( $currentPage ); ?>"></button>
						</li>
						<?php
					}
					?>
				</ul>
				<button type="button" data-role="none" class="vexaltrix-image-gallery__control-arrows vexaltrix-image-gallery__control-arrows--<?php echo esc_attr( $attributes['feedLayout'] ); ?>" aria-label="Next" tabindex="0" data-direction="Next"<?php echo ( 'grid' === $attributes['feedLayout'] && $attributes['gridPages'] === $attributes['gridPageNumber'] ) ? ' disabled' : ''; ?>>
					<svg width=20 height=20 viewBox="0 0 256 512" aria-hidden="true">
						<path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z">
						</path>
					</svg>
				</button>
			</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Renders Masonry Pagination Controls.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 2.1
		 */
		private function renderMasonryPaginationControls( $attributes ) {
			ob_start();
			if ( $attributes['mediaGallery'] && count( $attributes['mediaGallery'] ) > $attributes['paginateLimit'] ) {
				if ( $attributes['paginateUseLoader'] ) {
					?>
					<div class="vexaltrix-image-gallery__control-loader wp-block-button">
						<div class="wp-block-button__link vexaltrix-image-gallery__control-loader--1"></div>
						<div class="wp-block-button__link vexaltrix-image-gallery__control-loader--2"></div>
						<div class="wp-block-button__link vexaltrix-image-gallery__control-loader--3"></div>
					</div>
					<?php
				} else {
					?>
					<div class="vexaltrix-image-gallery__control-wrapper wp-block-button">
						<div class="vexaltrix-image-gallery__control-button wp-block-button__link" aria-label="<?php echo esc_attr( $attributes['paginateButtonText'] ); ?>" tabindex=0>
							<?php echo esc_html( $attributes['paginateButtonText'] ); ?>
						</div>
					</div>
					<?php
				}
			}
			return ob_get_clean();
		}

		/**
		 * Required attribute for query.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @return array of requred query attributes.
		 *
		 * @since 2.1
		 */
		public function requiredAtts( $attributes ) {
			return [
				'mediaGallery'   => ( isset( $attributes['mediaGallery'] ) ) ? wp_json_encode( $attributes['mediaGallery'] ) : [],
				'feedPagination' => ( isset( $attributes['feedPagination'] ) ) ? sanitize_text_field( $attributes['feedPagination'] ) : false,
				'gridPages'      => ( isset( $attributes['gridPages'] ) ) ? sanitize_text_field( $attributes['gridPages'] ) : 1,
				'gridPageNumber' => ( isset( $attributes['gridPageNumber'] ) ) ? sanitize_text_field( $attributes['gridPageNumber'] ) : 1,
				'paginateLimit'  => ( isset( $attributes['paginateLimit'] ) ) ? sanitize_text_field( $attributes['paginateLimit'] ) : 9,
			];
		}

		/**
		 * Sends the Images to Masonry AJAX.
		 *
		 * @since 2.1
		 */
		public function renderMasonryPagination() {
			check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_image_gallery_masonry_ajax_nonce', 'nonce' );
			$mediaAtts = [];
			// sanitizing $attr elements in later stage.
			$attr = isset( $_POST['attr'] ) ? json_decode( wp_unslash( $_POST['attr'] ), true ) : []; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			if ( ! is_array( $attr ) ) {
				$attr = [];
			}
			$attr['gridPageNumber']     = isset( $_POST['page_number'] ) ? sanitize_text_field( $_POST['page_number'] ) : '';
			$mediaAtts                 = $this->requiredAtts( $attr );
			$mediaAtts['mediaGallery'] = json_decode( $mediaAtts['mediaGallery'], true );
			$media                      = $this->getGalleryImages( $mediaAtts, 'paginated' );
			if ( ! $media ) {
				wp_send_json_error();
			}
			foreach ( $attr as $key => $attribute ) {
				$attr[ $key ] = ( 'false' === $attribute ) ? false : ( ( 'true' === $attribute ) ? true : $attribute );
			}
			$htmlArray = $this->renderMediaMarkup( $media, $attr );
			wp_send_json_success( $htmlArray );
		}

		/**
		 * Sends the Imsges to Grid AJAX.
		 *
		 * @since 2.1
		 */
		public function renderGridPagination() {
			check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_image_gallery_grid_pagination_ajax_nonce', 'nonce' );
			$mediaAtts = [];
			// sanitizing $attr elements in later stage.
			$attr = isset( $_POST['attr'] ) ? json_decode( wp_unslash( $_POST['attr'] ), true ) : []; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			if ( ! is_array( $attr ) ) {
				$attr = [];
			}
			$attr['gridPageNumber']     = isset( $_POST['page_number'] ) ? sanitize_text_field( $_POST['page_number'] ) : '';
			$mediaAtts                 = $this->requiredAtts( $attr );
			$mediaAtts['mediaGallery'] = json_decode( $mediaAtts['mediaGallery'], true );
			$media                      = $this->getGalleryImages( $mediaAtts, 'paginated' );
			if ( ! $media ) {
				wp_send_json_error();
			}
			foreach ( $attr as $key => $attribute ) {
				$attr[ $key ] = ( 'false' === $attribute ) ? false : ( ( 'true' === $attribute ) ? true : $attribute );
			}
			$htmlArray = $this->renderMediaMarkup( $media, $attr );
			wp_send_json_success( $htmlArray );
		}

		/**
		 * Renders Entire Gallery HTML.
		 *
		 * @param array $media      Part of Gallery Images.
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 2.1
		 */
		private function renderMediaMarkup( $media, $attributes ) {
			$totalImages = count( $media );
			ob_start();
			if ( 'masonry' === $attributes['feedLayout'] || ( 'grid' === $attributes['feedLayout'] && $attributes['feedPagination'] ) ) {
				for ( $i = 0; $i < $totalImages; $i++ ) {
					$this->renderMasonryHoverHandler( (array) $media[ $i ], $attributes );
				}
			} else {
				for ( $i = 0; $i < $totalImages; $i++ ) {
					$this->renderSingleMedia( (array) $media[ $i ], $attributes );
				}
			}
			return ob_get_clean();
		}

		/**
		 * Renders the Isotope Required Hover Handler to avoid padding triggering hover effects.
		 *
		 * @param array $mediaArray Array of current image's details.
		 * @param array $atts       Array of attributes.
		 *
		 * @since 2.1
		 */
		private function renderMasonryHoverHandler( $mediaArray, $atts ) {
			?>
			<div class='vexaltrix-image-gallery__media-wrapper--isotope' >
				<?php
					$this->renderSingleMedia( $mediaArray, $atts );
				?>
			</div>
			<?php
		}

		/**
		 * Renders an Individual Image Element with All Wrappers.
		 *
		 * @param array $mediaArray Array of current image's details.
		 * @param array $atts       Array of attributes.
		 *
		 * @since 2.1
		 */
		private function renderSingleMedia( $mediaArray, $atts ) {
			// Check if this is part of the Tiled Layout, and if so then check if the current image is focused or not.
			$focusedClass = '';
			if ( 'tiled' === $atts['feedLayout'] && ! empty( $atts['focusListObject'][ $mediaArray['id'] ] ) ) {
				$focusedClass = ' vexaltrix-image-gallery__media-wrapper--focus';
			}
			?>
			<div class='vexaltrix-image-gallery__media-wrapper<?php echo esc_attr( $focusedClass ); ?>' data-vexaltrix-gallery-image-id='<?php echo esc_attr( $mediaArray['id'] ); ?>' tabindex="0" >
				<?php
					$this->renderMediaThumbnail( $mediaArray, $atts );
				?>
			</div>
			<?php
		}

		/**
		 * Renders the Image.
		 *
		 * @param array $mediaArray Array of current image's details.
		 * @param array $atts       Array of attributes.
		 *
		 * @since 2.1
		 */
		private function renderMediaThumbnail( $mediaArray, $atts ) {
			// Create the SrcSet and Sizes to use in the Responsively Sized Images.
			$size     = $atts['galleryImageSize'];
			$sizeTab = $atts['galleryImageSizeTablet'];
			$sizeMob = $atts['galleryImageSizeMobile'];

			$imageUrl     = isset( $mediaArray['sizes'][ $size ]['url'] ) ? $mediaArray['sizes'][ $size ]['url'] : $mediaArray['url'];
			$imageUrlTab = isset( $mediaArray['sizes'][ $sizeTab ]['url'] ) ? $mediaArray['sizes'][ $sizeTab ]['url'] : $mediaArray['url'];
			$imageUrlMob = isset( $mediaArray['sizes'][ $sizeMob ]['url'] ) ? $mediaArray['sizes'][ $sizeMob ]['url'] : $mediaArray['url'];

			if ( 'bar-outside' === $atts['captionDisplayType'] && ( 'top' === \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $atts['imageCaptionAlignment'], 1 ) ) && $atts['imageDisplayCaption'] ) {
				?>
					<div class="vexaltrix-image-gallery__media-thumbnail-caption-wrapper vexaltrix-image-gallery__media-thumbnail-caption-wrapper--<?php echo esc_attr( $atts['captionDisplayType'] ); ?>">
						<?php $this->renderMediaCaption( $mediaArray, $atts ); ?>
					</div>
				<?php
			}
			?>
			<div class="vexaltrix-image-gallery__media vexaltrix-image-gallery__media--<?php echo esc_attr( $atts['feedLayout'] ); ?>">
				<picture>
					<source media="(min-width: 1024px)" srcset="<?php echo esc_url( $imageUrl ); ?>">
					<source media="(min-width: 768px)" srcset="<?php echo esc_url( $imageUrlTab ); ?>">
					<img class="vexaltrix-image-gallery__media-thumbnail vexaltrix-image-gallery__media-thumbnail--<?php echo esc_attr( $atts['feedLayout'] ); ?>" src="<?php echo esc_url( $imageUrlMob ); ?>" alt="<?php echo esc_attr( $mediaArray['alt'] ); ?>" <?php echo esc_attr( $atts['disableLazyLoad'] ) ? '' : 'loading="lazy"'; ?> />
				</picture>
				<div class="vexaltrix-image-gallery__media-thumbnail-blurrer"></div>
				<?php
				if ( $atts['imageDisplayCaption'] ) {
					if ( 'bar-outside' !== $atts['captionDisplayType'] ) {
						?>
							<div class="vexaltrix-image-gallery__media-thumbnail-caption-wrapper vexaltrix-image-gallery__media-thumbnail-caption-wrapper--<?php echo esc_attr( $atts['captionDisplayType'] ); ?>">
							<?php $this->renderMediaCaption( $mediaArray, $atts ); ?>
							</div>
						<?php
					}
				} else {
					?>
							<div class="vexaltrix-image-gallery__media-thumbnail-caption-wrapper vexaltrix-image-gallery__media-thumbnail-caption-wrapper--overlay"></div>
					<?php
				}
				?>
			</div>
			<?php
			if ( 'bar-outside' === $atts['captionDisplayType'] && ( 'top' !== \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $atts['imageCaptionAlignment'], 1 ) ) && $atts['imageDisplayCaption'] ) {
				?>
					<div class="vexaltrix-image-gallery__media-thumbnail-caption-wrapper vexaltrix-image-gallery__media-thumbnail-caption-wrapper--<?php echo esc_attr( $atts['captionDisplayType'] ); ?>">
						<?php $this->renderMediaCaption( $mediaArray, $atts ); ?>
					</div>
				<?php
			}
		}

		/**
		 * Renders Image Caption.
		 *
		 * @param array $mediaArray Array of current image's details.
		 * @param array $atts       Array of attributes.
		 *
		 * @since 2.1
		 */
		private function renderMediaCaption( $mediaArray, $atts ) {
			$limitedCaption = ( isset( $mediaArray['caption'] ) && $mediaArray['caption'] ) ? (
				$mediaArray['caption']
			) : (
				$mediaArray['url'] ? (
					$atts['imageDefaultCaption']
				) : (
					__( 'Unable to load image', 'vexaltrix' )
				)
			);
			?>
				<div class="vexaltrix-image-gallery__media-thumbnail-caption vexaltrix-image-gallery__media-thumbnail-caption--<?php echo esc_attr( $atts['captionDisplayType'] ); ?>">
					<?php echo wp_kses_post( $limitedCaption ); ?>
				</div>
			<?php
		}

		/**
		 * Renders All Images.
		 *
		 * @param array  $attributes Array of block attributes.
		 * @param string $fetchType String to identify whether paginated or full.
		 *
		 * @since 2.1
		 */
		private static function getGalleryImages( $attributes, $fetchType ) {
			$mediaRequired = [];
			switch ( $fetchType ) {
				case 'paginated':
					if ( isset( $attributes['mediaGallery'] ) && isset( $attributes['feedPagination'] ) && isset( $attributes['gridPages'] ) && isset( $attributes['gridPageNumber'] ) && isset( $attributes['paginateLimit'] ) && $attributes['feedPagination'] && $attributes['mediaGallery'] ) {
						$mediaIndex = ( $attributes['gridPageNumber'] - 1 ) * $attributes['paginateLimit'];
						for ( $i = 0; $i < $attributes['paginateLimit']; $i++ ) {
							if ( array_key_exists( $mediaIndex + $i, $attributes['mediaGallery'] ) ) {
								array_push( $mediaRequired, $attributes['mediaGallery'][ $mediaIndex + $i ] );
							}
						}
					}
					break;
				case 'full':
					if ( isset( $attributes['mediaGallery'] ) && $attributes['mediaGallery'] ) {
						$mediaIndex    = 0;
						$galleryLength = count( $attributes['mediaGallery'] );
						for ( $i = 0; $i < $galleryLength; $i++ ) {
							if ( array_key_exists( $mediaIndex + $i, $attributes['mediaGallery'] ) ) {
								array_push( $mediaRequired, $attributes['mediaGallery'][ $mediaIndex + $i ] );
							}
						}
					}
					break;
			}
			return $mediaRequired;
		}

		/**
		 * Renders the Front-end Masonry Layout.
		 *
		 * @param string $id                 The Block ID.
		 * @param array  $attr               An array of attributes.
		 * @param string $selector           The selector used to identify the carousel.
		 * @param array  $lightboxSettings  An array of Lightbox Swiper Settings.
		 * @param array  $thumbnailSettings An array of Thumbnail Swiper Settings.
		 * @since 2.1
		 * @return string   The rendered markup or an empty string.
		 */
		public static function renderFrontendMasonryLayout( $id, $attr, $selector, $lightboxSettings, $thumbnailSettings ) {
			ob_start();
			?>
				window.addEventListener( 'DOMContentLoaded', function() {
					const scope = document.querySelector( '.vxt-block-<?php echo esc_attr( $id ); ?>' );
					if ( scope ){
						if ( scope.children[0].classList.contains( 'vexaltrix-image-gallery__layout--masonry' ) ) {
							// Add timeout for the images to load.
							setTimeout( function() {
								const element = scope.querySelector( '.vexaltrix-image-gallery__layout--masonry' );
								const isotope = new Isotope( element, {
									itemSelector: '.vexaltrix-image-gallery__media-wrapper--isotope',
									percentPosition: true,
								} );
								imagesLoaded( element ).on( 'progress', function() {
									isotope.layout();
								});
								imagesLoaded( element ).on( 'always', function() {
									element.parentNode.style.visibility = 'visible';
								});
								VexaltrixImageGalleryMasonry.init( <?php echo wp_json_encode( $attr ); ?>, '<?php echo esc_attr( $selector ); ?>', <?php echo wp_json_encode( $lightboxSettings ); ?>, <?php echo wp_json_encode( $thumbnailSettings ); ?> );
								VexaltrixImageGalleryMasonry.initByOffset( element, isotope );
							}, 500 );
						}
					}
				});
			<?php
			$output = ob_get_clean();
			return is_string( $output ) ? $output : '';
		}

		/**
		 * Renders the Front-end Grid Paginated Layout.
		 *
		 * @param string $id                 The Block ID.
		 * @param array  $attr               An array of attributes.
		 * @param string $selector           The selector used to identify the carousel.
		 * @param array  $lightboxSettings  An array of Lightbox Swiper Settings.
		 * @param array  $thumbnailSettings An array of Thumbnail Swiper Settings.
		 * @since 2.1
		 * @return string   The rendered markup or an empty string.
		 */
		public static function renderFrontendGridPagination( $id, $attr, $selector, $lightboxSettings, $thumbnailSettings ) {
			ob_start();
			?>
				window.addEventListener( 'DOMContentLoaded', function() {
					const scope = document.querySelector( '.vxt-block-<?php echo esc_attr( $id ); ?>' );
					if ( scope ){
						if ( scope.children[0].classList.contains( 'vexaltrix-image-gallery__layout--isogrid' ) ) {
							setTimeout( function() {
								const element = scope.querySelector( '.vexaltrix-image-gallery__layout--isogrid' );
								const isotope = new Isotope( element, {
									itemSelector: '.vexaltrix-image-gallery__media-wrapper--isotope',
									layoutMode: 'fitRows',
								} );
								imagesLoaded( element ).on( 'progress', function() {
									isotope.layout();
								});
								VexaltrixImageGalleryMasonry.initByOffset( element, isotope );
							}, 500 );
						}
						VexaltrixImageGalleryPagedGrid.init( <?php echo wp_json_encode( $attr ); ?>, '<?php echo esc_attr( $selector ); ?>', <?php echo wp_json_encode( $lightboxSettings ); ?>, <?php echo wp_json_encode( $thumbnailSettings ); ?> );
					}
				});
			<?php
			$output = ob_get_clean();
			return is_string( $output ) ? $output : '';
		}

		/**
		 * Renders Front-end Carousel Layout.
		 *
		 * @param string $id       Block ID.
		 * @param array  $settings  Array of carousel settings.
		 * @param string $selector Selector to identify the carousel.
		 *
		 * @since 2.1
		 */
		public static function renderFrontendCarouselLayout( $id, $settings, $selector ) {
			return 'jQuery(document).ready(function () {
				let scope = jQuery(".wp-block-vxt-image-gallery' . $selector . '");
				if ( scope.length ) { 
					scope.css("visibility", "visible");
					let getSlickCarousel = scope.find(".vxt-slick-carousel");
					if( getSlickCarousel.length ) {
						getSlickCarousel.slick(' . $settings . ');
					}
				}
			});';
		}

		/**
		 * Renders Front-end Tiled Layout.
		 *
		 * @param string $id Block ID.
		 *
		 * @since 2.1
		 */
		public static function renderFrontendTiledLayout( $id ) {
			ob_start();
			?>
				window.addEventListener( 'DOMContentLoaded', function() {
					const scope = document.querySelector( '.vxt-block-<?php echo esc_attr( $id ); ?>' );
					if ( scope ){
						if ( scope.children[0].classList.contains( 'vexaltrix-image-gallery__layout--tiled' ) ) {
							const element = scope.querySelector( '.vexaltrix-image-gallery__layout--tiled' );
							const tileSizer = scope.querySelector( '.vexaltrix-image-gallery__media-sizer' );
							element.style.gridAutoRows = `${ tileSizer.getBoundingClientRect().width }px`;

							imagesLoaded( element ).on( 'progress', ( theInstance, theImage ) => {
								if ( theImage.isLoaded ){
									const imageElement = theImage.img;
									const imageWrapper = imageElement.parentElement.parentElement;
									const mediaWrapper = imageWrapper.parentElement;
									if( ! mediaWrapper.classList.contains( 'vexaltrix-image-gallery__media-wrapper--focus' ) ){
										if ( imageElement.naturalWidth >= ( imageElement.naturalHeight * 2 ) - ( imageElement.naturalHeight / 2 ) ){
											mediaWrapper.classList.add( 'vexaltrix-image-gallery__media-wrapper--wide');
											imageWrapper.classList.add( 'vexaltrix-image-gallery__media--tiled-wide');
										}
										else if ( imageElement.naturalHeight >= ( imageElement.naturalWidth * 2 ) - ( imageElement.naturalWidth / 2 ) ){
											mediaWrapper.classList.add( 'vexaltrix-image-gallery__media-wrapper--tall');
											imageWrapper.classList.add( 'vexaltrix-image-gallery__media--tiled-tall');
										}
									}
								}
							} );
							tileSizer.style.display = 'none';
						}
					}
				} );
			<?php
			return ob_get_clean();
		}

		/**
		 * Renders Front-end Lightbox.
		 *
		 * @param string $id                  Block ID.
		 * @param array  $attr                Array of attributes.
		 * @param array  $lightboxSettings   Array of Lightbox Swiper Settings.
		 * @param array  $thumbnailSettings  Array of Thumbnail Swiper Settings.
		 * @param string $selector            Selector to identify the lightbox.
		 * @since 2.4.0
		 * @return string       The Output Buffer.
		 */
		public static function renderFrontendLightbox( $id, $attr, $lightboxSettings, $thumbnailSettings, $selector ) {
			$proClicker = apply_filters( 'vxt_ultimate_gutenberg_blocks_image_gallery_pro_lightbox_js', '', $id, $attr );
			ob_start();
			?>
				window.addEventListener( 'DOMContentLoaded', () => {
					const blockScope = document.querySelector( '.vxt-block-<?php echo esc_html( $id ); ?>' );
					if ( ! blockScope ) {
						return;
					}

					<?php // Add event listener for Enter and Space key presses. ?>
					blockScope.addEventListener('keydown', (event) => {
						if ( 13 === event.keyCode || 32 === event.keyCode ) {
							<?php // Trigger the click event on the blockScope. ?>
							blockScope.click();
						}
					} );

					let lightboxSwiper = null;
					let thumbnailSwiper = null;

					<?php // First set the Thumbnail Swiper if needed. This will be used in the Lightbox Swiper. ?>
					let lightboxSettings = <?php echo wp_json_encode( $lightboxSettings ); ?>;
					<?php if ( $attr['lightboxThumbnails'] ) : ?>
						thumbnailSwiper = new Swiper( "<?php echo esc_attr( $selector . '+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--thumbnails' ); ?>",
							<?php echo wp_json_encode( $thumbnailSettings ); ?>
						);
						lightboxSettings = {
							...lightboxSettings,
							thumbs: {
								swiper: thumbnailSwiper,
							},
						}
					<?php endif; ?>
					<?php // Next set the Lightbox Swiper. ?>
					lightboxSwiper = new Swiper( "<?php echo esc_attr( $selector . '+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main' ); ?>",
						<?php echo wp_json_encode( $lightboxSettings ); ?>
					);
					loadLightBoxImages( blockScope, lightboxSwiper, null, <?php echo wp_json_encode( $attr ); ?>, thumbnailSwiper );
					<?php echo $proClicker; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped inside pro filter. ?>
				} );
			<?php
			return ob_get_clean();
		}

		/**
		 * Renders Front-end Click Event.
		 *
		 * @param string $id             Block ID.
		 * @param array  $attr           The array of Attribute.
		 * @return string                The Output Buffer.
		 *
		 * @since 2.4.0
		 */
		public static function renderImageClick( $id, $attr ) {
			ob_start();
			?>
				window.addEventListener( 'DOMContentLoaded', () => {
					const blockScope = document.querySelector( '.vxt-block-<?php echo esc_html( $id ); ?>' );
					if ( ! blockScope ) {
						return;
					}
					const attr = <?php echo wp_json_encode( $attr ); ?>;
					addClickListeners( blockScope, null, false, null, attr );

					<?php // Add event listener for Enter and Space key presses. ?> 
					blockScope.addEventListener('keydown', (event) => {
						if ( 13 === event.keyCode || 32 === event.keyCode ) {
							// Trigger the click event on the blockScope
							event.preventDefault();
							blockScope.click();
						}
		});
				} );
			<?php
			return ob_get_clean();
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\ImageGallery\\ImageGallery' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
