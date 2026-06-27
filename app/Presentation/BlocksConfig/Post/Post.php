<?php
/**
 * Vexaltrix Post.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\BlocksConfig\Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\BlocksConfig\\Post\\Post' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\BlocksConfig\Post\Post.
	 */
	class Post {


		/**
		 * Member Variable
		 *
		 * @since 1.18.1
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @since 1.18.1
		 * @var settings
		 */
		private static $settings;

		/**
		 *  Initiator
		 *
		 * @since 1.18.1
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'registerBlocks' ] );
			add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_post_pagination', [ $this, 'postPagination' ] );
			add_action( 'wp_ajax_nopriv_vxt_ultimate_gutenberg_blocks_post_pagination', [ $this, 'postPagination' ] );
			add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_post_pagination_grid', [ $this, 'postGridPaginationAjaxCallback' ] );
			add_action( 'wp_ajax_nopriv_vxt_ultimate_gutenberg_blocks_post_pagination_grid', [ $this, 'postGridPaginationAjaxCallback' ] );
			add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_get_posts', [ $this, 'masonryPagination' ] );
			add_action( 'wp_ajax_nopriv_vxt_ultimate_gutenberg_blocks_get_posts', [ $this, 'masonryPagination' ] );
			add_action( 'wp_footer', [ $this, 'addPostDynamicScript' ], 1000 );
			add_filter( 'redirect_canonical', [ $this, 'overrideCanonical' ], 1, 2 );
		}

		/**
		 * Registers the `core/latest-posts` block on server.
		 *
		 * @since 0.0.1
		 */
		public function registerBlocks() {
			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			$paginationMasonryBorderAttribute = [];

			if ( method_exists( 'Vexaltrix\Presentation\Blocks\\BlockHelper', 'uagGeneratePhpBorderAttribute' ) ) {

				$paginationMasonryBorderAttribute = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'paginationMasonry' );

			}

			$commonAttributes = $this->getPostAttributes();

			register_block_type(
				'vexaltrix/post-grid',
				[
					'attributes'      => array_merge(
						$commonAttributes,
						[
							'blockName'                   => [
								'type'    => 'string',
								'default' => 'post-grid',
							],
							'equalHeight'                 => [
								'type'    => 'boolean',
								'default' => true,
							],
							'postPagination'              => [
								'type'    => 'boolean',
								'default' => false,
							],
							'pageLimit'                   => [
								'type'    => 'number',
								'default' => 10,
							],
							'paginationBgActiveColor'     => [
								'type'    => 'string',
								'default' => '#e4e4e4',
							],
							'paginationActiveColor'       => [
								'type'    => 'string',
								'default' => '#333333',
							],
							'paginationBgColor'           => [
								'type'    => 'string',
								'default' => '#e4e4e4',
							],
							'paginationColor'             => [
								'type'    => 'string',
								'default' => '#777777',
							],
							'paginationMarkup'            => [
								'type'    => 'string',
								'default' => '',
							],
							'paginationLayout'            => [
								'type'    => 'string',
								'default' => 'filled',
							],
							'paginationBorderActiveColor' => [
								'type' => 'string',
							],
							'paginationBorderColor'       => [
								'type'    => 'string',
								'default' => '#888686',
							],
							'paginationBorderRadius'      => [
								'type' => 'number',
							],
							'paginationBorderSize'        => [
								'type'    => 'number',
								'default' => 1,
							],
							'paginationSpacing'           => [
								'type'    => 'number',
								'default' => 20,
							],
							'paginationAlignment'         => [
								'type'    => 'string',
								'default' => 'left',
							],
							'paginationPrevText'          => [
								'type'    => 'string',
								'default' => '« Previous',
							],
							'paginationNextText'          => [
								'type'    => 'string',
								'default' => 'Next »',
							],
							'layoutConfig'                => [
								'type'    => 'array',
								'default' => [
									[ 'vexaltrix/post-image' ],
									[ 'vexaltrix/post-taxonomy' ],
									[ 'vexaltrix/post-title' ],
									[ 'vexaltrix/post-meta' ],
									[ 'vexaltrix/post-excerpt' ],
									[ 'vexaltrix/post-button' ],
								],
							],
							'post_type'                   => [
								'type'    => 'string',
								'default' => 'grid',
							],
							'equalHeightInlineButtons'    => [
								'type'    => 'boolean',
								'default' => false,
							],
							'imageRatio'                  => [
								'type'    => 'string',
								'default' => 'inherit',
							],
							'imgEqualHeight'              => [
								'type'    => 'boolean',
								'default' => false,
							],
							'paginationType'              => [
								'type'    => 'string',
								'default' => 'ajax',
							],
							'isLeftToRightLayout'         => [
								'type'    => 'boolean',
								'default' => false,
							],
							'wrapperTopPadding'           => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperRightPadding'         => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperLeftPadding'          => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperBottomPadding'        => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperTopPaddingTablet'     => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperRightPaddingTablet'   => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperLeftPaddingTablet'    => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperBottomPaddingTablet'  => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperTopPaddingMobile'     => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperRightPaddingMobile'   => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperLeftPaddingMobile'    => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperBottomPaddingMobile'  => [
								'type'    => 'number',
								'default' => '',
							],
							'wrapperPaddingUnit'          => [
								'type'    => 'string',
								'default' => 'px',
							],
							'wrapperPaddingUnitTablet'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'wrapperPaddingUnitMobile'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'wrapperPaddingLink'          => [
								'type'    => 'boolean',
								'default' => false,
							],
							'wrapperAlign'                => [
								'type'    => 'string',
								'default' => 'row',
							],
							'wrapperAlignPosition'        => [
								'type'    => 'string',
								'default' => 'center',
							],
						]
					),
					'renderCallback' => [ $this, 'postGridCallback' ],
				]
			);

			register_block_type(
				'vexaltrix/post-carousel',
				[
					'attributes'      => array_merge(
						$commonAttributes,
						[
							'blockName'           => [
								'type'    => 'string',
								'default' => 'post-carousel',
							],
							'pauseOnHover'        => [
								'type'    => 'boolean',
								'default' => true,
							],
							'infiniteLoop'        => [
								'type'    => 'boolean',
								'default' => true,
							],
							'transitionSpeed'     => [
								'type'    => 'number',
								'default' => 500,
							],
							'arrowDots'           => [
								'type'    => 'string',
								'default' => 'arrows_dots',
							],
							'autoplay'            => [
								'type'    => 'boolean',
								'default' => true,
							],
							'autoplaySpeed'       => [
								'type'    => 'number',
								'default' => 2000,
							],
							'arrowSize'           => [
								'type'    => 'number',
								'default' => 24,
							],
							'arrowBorderSize'     => [
								'type'    => 'number',
								'default' => 0,
							],
							'arrowBorderRadius'   => [
								'type'    => 'number',
								'default' => 0,
							],
							'arrowColor'          => [
								'type'    => 'string',
								'default' => '#000',
							],
							'arrowDistance'       => [
								'type' => 'number',
							],
							'arrowDistanceTablet' => [
								'type' => 'number',
							],
							'arrowDistanceMobile' => [
								'type' => 'number',
							],
							'equalHeight'         => [
								'type'    => 'boolean',
								'default' => false,
							],
							'layoutConfig'        => [
								'type'    => 'array',
								'default' => [
									[ 'vexaltrix/post-image' ],
									[ 'vexaltrix/post-taxonomy' ],
									[ 'vexaltrix/post-title' ],
									[ 'vexaltrix/post-meta' ],
									[ 'vexaltrix/post-excerpt' ],
									[ 'vexaltrix/post-button' ],
								],
							],
							'post_type'           => [
								'type'    => 'string',
								'default' => 'carousel',
							],
							'dotsMarginTop'       => [
								'type'    => 'number',
								'default' => '20',
							],
							'dotsMarginTopTablet' => [
								'type'    => 'number',
								'default' => '20',
							],
							'dotsMarginTopMobile' => [
								'type'    => 'number',
								'default' => '20',
							],
							'dotsMarginTopUnit'   => [
								'type'    => 'string',
								'default' => 'px',
							],
						]
					),
					'renderCallback' => [ $this, 'postCarouselCallback' ],
				]
			);

			$enableLegacyBlocks = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_enable_legacy_blocks' );

			if ( 'yes' === $enableLegacyBlocks ) {
				register_block_type(
					'vexaltrix/post-masonry',
					[
						'attributes'      => array_merge(
							$commonAttributes,
							[
								'blockName'                => [
									'type'    => 'string',
									'default' => 'post-masonry',
								],
								'paginationType'           => [
									'type'    => 'string',
									'default' => 'none',
								],
								'paginationEventType'      => [
									'type'    => 'string',
									'default' => 'button',
								],
								'buttonText'               => [
									'type'    => 'string',
									'default' => 'Load More',
								],
								'paginationAlign'          => [
									'type'    => 'string',
									'default' => 'center',
								],
								'paginationTextColor'      => [
									'type'    => 'string',
									'default' => '',
								],
								'paginationMasonryBgColor' => [
									'type'    => 'string',
									'default' => '',
								],
								'paginationBgHoverColor'   => [
									'type' => 'string',
								],
								'paginationTextHoverColor' => [
									'type' => 'string',
								],
								'paginationMasonryBorderHColor' => [
									'type'    => 'string',
									'default' => '',
								],
								'paginationFontSize'       => [
									'type'    => 'number',
									'default' => 13,
								],
								'loaderColor'              => [
									'type'    => 'string',
									'default' => '#0085ba',
								],
								'loaderSize'               => [
									'type'    => 'number',
									'default' => 18,
								],
								'paginationButtonPaddingType' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'vpaginationButtonPaddingMobile' => [
									'type'    => 'number',
									'default' => 8,
								],
								'vpaginationButtonPaddingTablet' => [
									'type'    => 'number',
									'default' => 8,
								],
								'vpaginationButtonPaddingDesktop' => [
									'type'    => 'number',
									'default' => 8,
								],
								'hpaginationButtonPaddingMobile' => [
									'type'    => 'number',
									'default' => 12,
								],
								'hpaginationButtonPaddingTablet' => [
									'type'    => 'number',
									'default' => 12,
								],
								'hpaginationButtonPaddingDesktop' => [
									'type'    => 'number',
									'default' => 12,
								],
								'layoutConfig'             => [
									'type'    => 'array',
									'default' => [
										[ 'vexaltrix/post-image' ],
										[ 'vexaltrix/post-taxonomy' ],
										[ 'vexaltrix/post-title' ],
										[ 'vexaltrix/post-meta' ],
										[ 'vexaltrix/post-excerpt' ],
										[ 'vexaltrix/post-button' ],
									],
								],
								'post_type'                => [
									'type'    => 'string',
									'default' => 'masonry',
								],
								'mobilepaginationButtonPaddingType' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'tabletpaginationButtonPaddingType' => [
									'type'    => 'string',
									'default' => 'px',
								],
							],
							$paginationMasonryBorderAttribute
						),
						'renderCallback' => [ $this, 'postMasonryCallback' ],
					]
				);
			}

		}

		/**
		 * Get Post common attributes for all Post Grid, Masonry and Carousel.
		 *
		 * @since 0.0.1
		 */
		public function getPostAttributes() {

			$btnBorderAttribute     = [];
			$overallBorderAttribute = [];

			if ( method_exists( 'Vexaltrix\Presentation\Blocks\\BlockHelper', 'uagGeneratePhpBorderAttribute' ) ) {

				$btnBorderAttribute     = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'btn' );
				$overallBorderAttribute = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'overall' );

			}

			$inheritFromTheme = 'enabled' === ( 'deleted' !== \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_btn_inherit_from_theme_fallback', 'deleted' ) ? 'disabled' : \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_btn_inherit_from_theme', 'disabled' ) );

			return array_merge(
				$btnBorderAttribute,
				$overallBorderAttribute,
				[
					'inheritFromTheme'              => [
						'type'    => 'boolean',
						'default' => true,
					],
					'block_id'                      => [
						'type'    => 'string',
						'default' => 'not_set',
					],
					'categories'                    => [
						'type' => 'string',
					],
					'postType'                      => [
						'type'    => 'string',
						'default' => 'post',
					],
					'postDisplaytext'               => [
						'type'    => 'string',
						'default' => 'No post found!',
					],
					'taxonomyType'                  => [
						'type'    => 'string',
						'default' => 'category',
					],
					'postsToShow'                   => [
						'type'    => 'number',
						'default' => 6,
					],
					'enableOffset'                  => [
						'type'    => 'boolean',
						'default' => false,
					],
					'postsOffset'                   => [
						'type'    => 'number',
						'default' => 0,
					],
					'displayPostDate'               => [
						'type'    => 'boolean',
						'default' => true,
					],
					'displayPostExcerpt'            => [
						'type'    => 'boolean',
						'default' => true,
					],
					'excerptLength'                 => [
						'type'    => 'number',
						'default' => 15,
					],
					'displayPostAuthor'             => [
						'type'    => 'boolean',
						'default' => false,
					],
					'displayPostTitle'              => [
						'type'    => 'boolean',
						'default' => true,
					],
					'displayPostComment'            => [
						'type'    => 'boolean',
						'default' => true,
					],
					'displayPostTaxonomy'           => [
						'type'    => 'boolean',
						'default' => false,
					],
					'hideTaxonomyIcon'              => [
						'type'    => 'boolean',
						'default' => true,
					],
					'taxStyle'                      => [
						'type'    => 'string',
						'default' => 'default',
					],
					'displayPostTaxonomyAboveTitle' => [
						'type'    => 'string',
						'default' => 'withMeta',
					],
					'displayPostImage'              => [
						'type'    => 'boolean',
						'default' => true,
					],
					'imgSize'                       => [
						'type'    => 'string',
						'default' => 'large',
					],
					'imgPosition'                   => [
						'type'    => 'string',
						'default' => 'top',
					],
					'linkBox'                       => [
						'type' => 'boolean',
					],
					'bgOverlayColor'                => [
						'type'    => 'string',
						'default' => '#000000',
					],
					'overlayOpacity'                => [
						'type'    => 'number',
						'default' => '50',
					],
					'displayPostLink'               => [
						'type'    => 'boolean',
						'default' => true,
					],
					'newTab'                        => [
						'type'    => 'boolean',
						'default' => false,
					],
					'ctaText'                       => [
						'type'    => 'string',
						'default' => __( 'Read More', 'vexaltrix' ),
					],
					'inheritFromThemeBtn'           => [
						'type'    => 'boolean',
						'default' => $inheritFromTheme,
					],
					'buttonType'                    => [
						'type'    => 'string',
						'default' => 'primary',
					],
					'btnHPadding'                   => [
						'type'    => 'number',
						'default' => '',
					],
					'btnVPadding'                   => [
						'type'    => 'number',
						'default' => '',
					],
					'columns'                       => [
						'type'    => 'number',
						'default' => 3,
					],
					'tcolumns'                      => [
						'type'    => 'number',
						'default' => 2,
					],
					'mcolumns'                      => [
						'type'    => 'number',
						'default' => 1,
					],
					'align'                         => [
						'type'    => 'string',
						'default' => 'left',
					],
					'width'                         => [
						'type'    => 'string',
						'default' => 'wide',
					],
					'order'                         => [
						'type'    => 'string',
						'default' => 'desc',
					],
					'orderBy'                       => [
						'type'    => 'string',
						'default' => 'date',
					],
					'rowGap'                        => [
						'type'    => 'number',
						'default' => 20,
					],
					'rowGapTablet'                  => [
						'type'    => 'number',
						'default' => 20,
					],
					'rowGapMobile'                  => [
						'type'    => 'number',
						'default' => 20,
					],
					'columnGap'                     => [
						'type'    => 'number',
						'default' => 20,
					],
					'columnGapTablet'               => [
						'type' => 'number',
					],
					'columnGapMobile'               => [
						'type' => 'number',
					],
					'bgType'                        => [
						'type'    => 'string',
						'default' => 'color',
					],
					'bgColor'                       => [
						'type'    => 'string',
						'default' => '#f6f6f6',
					],

					// Title Attributes.
					'titleColor'                    => [
						'type' => 'string',
					],
					'titleTag'                      => [
						'type'    => 'string',
						'default' => 'h4',
					],
					'titleFontSize'                 => [
						'type'    => 'number',
						'default' => '',
					],
					'titleFontSizeType'             => [
						'type'    => 'string',
						'default' => 'px',
					],
					'titleFontSizeMobile'           => [
						'type' => 'number',
					],
					'titleFontSizeTablet'           => [
						'type' => 'number',
					],
					'titleFontFamily'               => [
						'type'    => 'string',
						'default' => '',
					],
					'titleFontWeight'               => [
						'type' => 'string',
					],
					'titleFontStyle'                => [
						'type' => 'string',
					],
					'titleLineHeightType'           => [
						'type'    => 'string',
						'default' => 'em',
					],
					'titleLineHeight'               => [
						'type' => 'number',
					],
					'titleLineHeightTablet'         => [
						'type' => 'number',
					],
					'titleLineHeightMobile'         => [
						'type' => 'number',
					],
					'titleLoadGoogleFonts'          => [
						'type'    => 'boolean',
						'default' => false,
					],

					// Meta attributes.
					'metaColor'                     => [
						'type'    => 'string',
						'default' => '',
					],
					'highlightedTextColor'          => [
						'type'    => 'string',
						'default' => '#fff',
					],
					'highlightedTextBgColor'        => [
						'type'    => 'string',
						'default' => '#3182ce',
					],
					'metaFontSize'                  => [
						'type'    => 'number',
						'default' => '',
					],
					'metaFontSizeType'              => [
						'type'    => 'string',
						'default' => 'px',
					],
					'metaFontSizeMobile'            => [
						'type' => 'number',
					],
					'metaFontSizeTablet'            => [
						'type' => 'number',
					],
					'metaFontFamily'                => [
						'type'    => 'string',
						'default' => '',
					],
					'metaFontWeight'                => [
						'type' => 'string',
					],
					'metaFontStyle'                 => [
						'type' => 'string',
					],
					'metaLineHeightType'            => [
						'type'    => 'string',
						'default' => 'em',
					],
					'metaLineHeight'                => [
						'type' => 'number',
					],
					'metaLineHeightTablet'          => [
						'type' => 'number',
					],
					'metaLineHeightMobile'          => [
						'type' => 'number',
					],
					'metaLoadGoogleFonts'           => [
						'type'    => 'boolean',
						'default' => false,
					],

					// Excerpt Attributes.
					'excerptColor'                  => [
						'type'    => 'string',
						'default' => '',
					],
					'excerptFontSize'               => [
						'type'    => 'number',
						'default' => '',
					],
					'excerptFontSizeType'           => [
						'type'    => 'string',
						'default' => 'px',
					],
					'excerptFontSizeMobile'         => [
						'type' => 'number',
					],
					'excerptFontSizeTablet'         => [
						'type' => 'number',
					],
					'excerptFontFamily'             => [
						'type'    => 'string',
						'default' => '',
					],
					'excerptFontWeight'             => [
						'type' => 'string',
					],
					'excerptFontStyle'              => [
						'type' => 'string',
					],
					'excerptLineHeightType'         => [
						'type'    => 'string',
						'default' => 'em',
					],
					'excerptLineHeight'             => [
						'type' => 'number',
					],
					'excerptLineHeightTablet'       => [
						'type' => 'number',
					],
					'excerptLineHeightMobile'       => [
						'type' => 'number',
					],
					'excerptLoadGoogleFonts'        => [
						'type'    => 'boolean',
						'default' => false,
					],
					'displayPostContentRadio'       => [
						'type'    => 'string',
						'default' => 'excerpt',
					],

					// CTA attributes.
					'ctaColor'                      => [
						'type' => 'string',
					],
					'ctaBgType'                     => [
						'type'    => 'string',
						'default' => 'color',
					],
					'ctaBgHType'                    => [
						'type'    => 'string',
						'default' => 'color',
					],
					'ctaBgColor'                    => [
						'type' => 'string',
					],
					'ctaHColor'                     => [
						'type' => 'string',
					],
					'ctaBgHColor'                   => [
						'type' => 'string',
					],
					'ctaFontSize'                   => [
						'type'    => 'number',
						'default' => '',
					],
					'ctaFontSizeType'               => [
						'type'    => 'string',
						'default' => 'px',
					],
					'ctaFontSizeMobile'             => [
						'type' => 'number',
					],
					'ctaFontSizeTablet'             => [
						'type' => 'number',
					],
					'ctaFontFamily'                 => [
						'type'    => 'string',
						'default' => '',
					],
					'ctaFontWeight'                 => [
						'type' => 'string',
					],
					'ctaFontStyle'                  => [
						'type' => 'string',
					],
					'ctaLineHeightType'             => [
						'type'    => 'string',
						'default' => 'em',
					],
					'ctaLineHeight'                 => [
						'type' => 'number',
					],
					'ctaLineHeightTablet'           => [
						'type' => 'number',
					],
					'ctaLineHeightMobile'           => [
						'type' => 'number',
					],
					'ctaLoadGoogleFonts'            => [
						'type'    => 'boolean',
						'default' => false,
					],

					// Spacing Attributes.
					'paddingTop'                    => [
						'type'    => 'number',
						'default' => 20,
					],
					'paddingBottom'                 => [
						'type'    => 'number',
						'default' => 20,
					],
					'paddingRight'                  => [
						'type'    => 'number',
						'default' => 20,
					],
					'paddingLeft'                   => [
						'type'    => 'number',
						'default' => 20,
					],
					'paddingTopMobile'              => [
						'type' => 'number',
					],
					'paddingBottomMobile'           => [
						'type' => 'number',
					],
					'paddingRightMobile'            => [
						'type' => 'number',
					],
					'paddingLeftMobile'             => [
						'type' => 'number',
					],
					'paddingTopTablet'              => [
						'type' => 'number',
					],
					'paddingBottomTablet'           => [
						'type' => 'number',
					],
					'paddingRightTablet'            => [
						'type' => 'number',
					],
					'paddingLeftTablet'             => [
						'type' => 'number',
					],
					'paddingBtnTop'                 => [
						'type' => 'number',
					],
					'paddingBtnBottom'              => [
						'type' => 'number',
					],
					'paddingBtnRight'               => [
						'type' => 'number',
					],
					'paddingBtnLeft'                => [
						'type' => 'number',
					],
					'contentPadding'                => [
						'type'    => 'number',
						'default' => 20,
					],
					'contentPaddingMobile'          => [
						'type' => 'number',
					],
					'ctaBottomSpace'                => [
						'type'    => 'number',
						'default' => 0,
					],
					'ctaBottomSpaceTablet'          => [
						'type'    => 'number',
						'default' => 0,
					],
					'ctaBottomSpaceMobile'          => [
						'type'    => 'number',
						'default' => 0,
					],
					'imageBottomSpace'              => [
						'type'    => 'number',
						'default' => 15,
					],
					'imageBottomSpaceTablet'        => [
						'type' => 'number',
					],
					'imageBottomSpaceMobiile'       => [
						'type' => 'number',
					],
					'taxonomyBottomSpace'           => [
						'type' => 'number',
					],
					'taxonomyBottomSpaceTablet'     => [
						'type' => 'number',
					],
					'taxonomyBottomSpaceMobile'     => [
						'type' => 'number',
					],
					'titleBottomSpace'              => [
						'type'    => 'number',
						'default' => 15,
					],
					'titleBottomSpaceTablet'        => [
						'type' => 'number',
					],
					'titleBottomSpaceMobile'        => [
						'type' => 'number',
					],
					'metaBottomSpace'               => [
						'type'    => 'number',
						'default' => 15,
					],
					'metaBottomSpaceTablet'         => [
						'type' => 'number',
					],
					'metaBottomSpaceMobile'         => [
						'type' => 'number',
					],
					'excerptBottomSpace'            => [
						'type'    => 'number',
						'default' => 25,
					],
					'excerptBottomSpaceTablet'      => [
						'type' => 'number',
					],
					'excerptBottomSpaceMobile'      => [
						'type' => 'number',
					],
					// Exclude Current Post.
					'excludeCurrentPost'            => [
						'type'    => 'boolean',
						'default' => false,
					],
					'titleTransform'                => [
						'type' => 'string',
					],
					'metaTransform'                 => [
						'type' => 'string',
					],
					'excerptTransform'              => [
						'type' => 'string',
					],
					'ctaTransform'                  => [
						'type' => 'string',
					],
					'titleDecoration'               => [
						'type' => 'string',
					],
					'metaDecoration'                => [
						'type' => 'string',
					],
					'excerptDecoration'             => [
						'type' => 'string',
					],
					'ctaDecoration'                 => [
						'type' => 'string',
					],
					'contentPaddingUnit'            => [
						'type'    => 'string',
						'default' => 'px',
					],
					'rowGapUnit'                    => [
						'type'    => 'string',
						'default' => 'px',
					],
					'columnGapUnit'                 => [
						'type'    => 'string',
						'default' => 'px',
					],
					'excerptBottomSpaceUnit'        => [
						'type'    => 'string',
						'default' => 'px',
					],
					'paginationSpacingUnit'         => [
						'type'    => 'string',
						'default' => 'px',
					],
					'imageBottomSpaceUnit'          => [
						'type'    => 'string',
						'default' => 'px',
					],
					'taxonomyBottomSpaceUnit'       => [
						'type'    => 'string',
						'default' => 'px',
					],
					'titleBottomSpaceUnit'          => [
						'type'    => 'string',
						'default' => 'px',
					],
					'metaBottomSpaceUnit'           => [
						'type'    => 'string',
						'default' => 'px',
					],
					'ctaBottomSpaceUnit'            => [
						'type'    => 'string',
						'default' => 'px',
					],
					'paddingBtnUnit'                => [
						'type'    => 'string',
						'default' => 'px',
					],
					'mobilePaddingBtnUnit'          => [
						'type'    => 'string',
						'default' => 'px',
					],
					'tabletPaddingBtnUnit'          => [
						'type'    => 'string',
						'default' => 'px',
					],
					'paddingUnit'                   => [
						'type'    => 'string',
						'default' => 'px',
					],
					'mobilePaddingUnit'             => [
						'type'    => 'string',
						'default' => 'px',
					],
					'tabletPaddingUnit'             => [
						'type'    => 'string',
						'default' => 'px',
					],
					'isPreview'                     => [
						'type'    => 'boolean',
						'default' => false,
					],
					'taxDivider'                    => [
						'type'    => 'string',
						'default' => ', ',
					],
					'titleLetterSpacing'            => [
						'type'    => 'number',
						'default' => '',
					],
					'titleLetterSpacingType'        => [
						'type'    => 'string',
						'default' => 'px',
					],
					'titleLetterSpacingMobile'      => [
						'type' => 'number',
					],
					'titleLetterSpacingTablet'      => [
						'type' => 'number',
					],
					'metaLetterSpacing'             => [
						'type'    => 'number',
						'default' => '',
					],
					'metaLetterSpacingType'         => [
						'type'    => 'string',
						'default' => 'px',
					],
					'metaLetterSpacingMobile'       => [
						'type' => 'number',
					],
					'metaLetterSpacingTablet'       => [
						'type' => 'number',
					],
					'ctaLetterSpacing'              => [
						'type'    => 'number',
						'default' => '',
					],
					'ctaLetterSpacingType'          => [
						'type'    => 'string',
						'default' => 'px',
					],
					'ctaLetterSpacingMobile'        => [
						'type' => 'number',
					],
					'ctaLetterSpacingTablet'        => [
						'type' => 'number',
					],
					'excerptLetterSpacing'          => [
						'type'    => 'number',
						'default' => '',
					],
					'excerptLetterSpacingType'      => [
						'type'    => 'string',
						'default' => 'px',
					],
					'excerptLetterSpacingMobile'    => [
						'type' => 'number',
					],
					'excerptLetterSpacingTablet'    => [
						'type' => 'number',
					],
					'useSeparateBoxShadows'         => [
						'type'    => 'boolean',
						'default' => true,
					],
					'boxShadowColor'                => [
						'type'    => 'string',
						'default' => '#00000070',
					],
					'boxShadowHOffset'              => [
						'type'    => 'number',
						'default' => 0,
					],
					'boxShadowVOffset'              => [
						'type'    => 'number',
						'default' => 0,
					],
					'boxShadowBlur'                 => [
						'type'    => 'number',
						'default' => '',
					],
					'boxShadowSpread'               => [
						'type'    => 'number',
						'default' => '',
					],
					'boxShadowPosition'             => [
						'type'    => 'string',
						'default' => 'outset',
					],
					'boxShadowColorHover'           => [
						'type'    => 'string',
						'default' => '',
					],
					'boxShadowHOffsetHover'         => [
						'type'    => 'number',
						'default' => 0,
					],
					'boxShadowVOffsetHover'         => [
						'type'    => 'number',
						'default' => 0,
					],
					'boxShadowBlurHover'            => [
						'type'    => 'number',
						'default' => '',
					],
					'boxShadowSpreadHover'          => [
						'type'    => 'number',
						'default' => '',
					],
					'boxShadowPositionHover'        => [
						'type'    => 'string',
						'default' => 'outset',
					],
					'overallBorderHColor'           => [
						'type' => 'string',
					],
					'borderWidth'                   => [
						'type'    => 'number',
						'default' => '',
					],
					'borderStyle'                   => [
						'type'    => 'string',
						'default' => 'none',
					],
					'borderColor'                   => [
						'type'    => 'string',
						'default' => '',
					],
					'borderHColor'                  => [
						'type' => 'string',
					],
					'borderRadius'                  => [
						'type'    => 'number',
						'default' => '',
					],
				]
			);
		}

		/**
		 * Renders the post grid block on server.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 0.0.1
		 */
		public function postGridCallback( $attributes ) {

			// Render query.
			$query = \Vexaltrix\Core\Support\Helper::getQuery( $attributes, 'grid' );

			// Cache the settings.
			self::$settings['grid'][ $attributes['block_id'] ] = $attributes;

			ob_start();
			$this->getPostHtml( $attributes, $query, 'grid' );
			// Output the post markup.
			return ob_get_clean();
		}

		/**
		 * Renders the post grid block on pagination clicks.
		 *
		 * @since 2.6.0
		 *
		 * @return void
		 */
		public function postGridPaginationAjaxCallback() {
			check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_grid_ajax_nonce', 'nonce' );

			if ( isset( $_POST['attr'] ) ) {
				// SECURITY: First decode JSON, then sanitize individual values.
				// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Sanitized after json_decode via required_attribute_for_query.
				$attr = json_decode( wp_unslash( $_POST['attr'] ), true );

				// Validate JSON decode was successful.
				if ( ! is_array( $attr ) ) {
					wp_send_json_error( 'Invalid JSON data received.' );
				}

				$attr['paged'] = isset( $_POST['page_number'] ) ? absint( $_POST['page_number'] ) : 1;
				$html          = $this->postGridCallback( $attr );
				wp_send_json_success( $html );

			}

			wp_send_json_error( ' Something went wrong, failed to load pagination data! ' );
		}

		/**
		 * Renders the post carousel block on server.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 0.0.1
		 */
		public function postCarouselCallback( $attributes ) {

			// Render query.
			$query = \Vexaltrix\Core\Support\Helper::getQuery( $attributes, 'carousel' );

			// Cache the settings.
			self::$settings['carousel'][ $attributes['block_id'] ] = $attributes;

			ob_start();
			$this->getPostHtml( $attributes, $query, 'carousel' );
			// Output the post markup.
			return ob_get_clean();
		}

		/**
		 * Renders the post masonry block on server.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 0.0.1
		 */
		public function postMasonryCallback( $attributes ) {

			// Render query.
			$query = \Vexaltrix\Core\Support\Helper::getQuery( $attributes, 'masonry' );

			// Cache the settings.
			self::$settings['masonry'][ $attributes['block_id'] ] = $attributes;

			ob_start();
			$this->getPostHtml( $attributes, $query, 'masonry' );
			// Output the post markup.
			return ob_get_clean();
		}

		/**
		 * Renders the post grid block on server.
		 *
		 * @param array  $attributes Array of block attributes.
		 *
		 * @param object $query WP_Query object.
		 * @param string $layout post grid/masonry/carousel layout.
		 * @since 0.0.1
		 */
		public function getPostHtml( $attributes, $query, $layout ) {
			
			$wrap = [
				'vxt-post__items vxt-post__columns-' . $attributes['columns'],
				'is-' . $layout,
				'vxt-post__columns-tablet-' . $attributes['tcolumns'],
				'vxt-post__columns-mobile-' . $attributes['mcolumns'],
			];

			$blockId = 'vxt-block-' . $attributes['block_id'];

			$desktopClass = '';
			$tabClass     = '';
			$mobClass     = '';

			if ( array_key_exists( 'UAGHideDesktop', $attributes ) || array_key_exists( 'UAGHideTab', $attributes ) || array_key_exists( 'UAGHideMob', $attributes ) ) {

				$desktopClass = ( isset( $attributes['UAGHideDesktop'] ) ) ? 'uag-hide-desktop' : '';

				$tabClass = ( isset( $attributes['UAGHideTab'] ) ) ? 'uag-hide-tab' : '';

				$mobClass = ( isset( $attributes['UAGHideMob'] ) ) ? 'uag-hide-mob' : '';
			}

			$zindexDesktop           = '';
			$zindexTablet            = '';
			$zindexMobile            = '';
			$zindexWrap              = [];
			$zindexExtentionEnabled = ( isset( $attributes['zIndex'] ) || isset( $attributes['zIndexTablet'] ) || isset( $attributes['zIndexMobile'] ) );

			if ( $zindexExtentionEnabled ) {
				$zindexDesktop = ( isset( $attributes['zIndex'] ) ) ? '--z-index-desktop:' . $attributes['zIndex'] . ';' : false;
				$zindexTablet  = ( isset( $attributes['zIndexTablet'] ) ) ? '--z-index-tablet:' . $attributes['zIndexTablet'] . ';' : false;
				$zindexMobile  = ( isset( $attributes['zIndexMobile'] ) ) ? '--z-index-mobile:' . $attributes['zIndexMobile'] . ';' : false;

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

			$isImageEnabled = ( true === $attributes['displayPostImage'] ) ? 'vxt-post__image-enabled' : 'vxt-post__image-disabled';

			$outerwrap = [
				'wp-block-vxt-post-' . $layout,
				'vxt-post-grid',
				( isset( $attributes['className'] ) ) ? $attributes['className'] : '',
				'vxt-post__image-position-' . $attributes['imgPosition'],
				$isImageEnabled,
				$blockId,
				$desktopClass,
				$tabClass,
				$mobClass,
				$zindexExtentionEnabled ? 'uag-blocks-common-selector' : '',
			];

			switch ( $layout ) {
				case 'masonry':
					break;

				case 'grid':
					if ( $attributes['equalHeight'] ) {
						array_push( $wrap, 'vxt-post__equal-height' );
					}
					if ( $attributes['equalHeightInlineButtons'] ) {
						array_push( $wrap, 'vxt-equal_height_inline-read-more-buttons' );
					}
					break;

				case 'carousel':
					array_push( $outerwrap, 'vxt-post__arrow-outside' );

					if ( $attributes['equalHeight'] ) {
						array_push( $wrap, 'vxt-post__carousel_equal-height' );
					}

					if ( $query->post_count > $attributes['columns'] ) {
						array_push( $outerwrap, 'vxt-slick-carousel' );
					}
					break;

				default:
					// Nothing to do here.
					break;
			}

			$commonClasses = array_merge( $outerwrap, $wrap );

			$total = $query->max_num_pages;

			?>

			<div class="<?php echo esc_attr( implode( ' ', $commonClasses ) ); ?>" data-total="<?php echo esc_attr( $total ); ?>" style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>">

				<?php

				$this->postsArticlesMarkup( $query, $attributes );

				$postNotFound = $query->found_posts;

				if ( 0 === $postNotFound ) {
					?>
					<p class="vxt-post__no-posts">
						<?php echo esc_html( $attributes['postDisplaytext'] ); ?>
					</p>
					<?php
				}

				if ( ( isset( $attributes['postPagination'] ) && true === $attributes['postPagination'] ) ) {

					?>
					<div class="vxt-post-pagination-wrap">
						<?php
							// content already escaped using wp_kses_post.
							echo $this->renderPagination( $query, $attributes ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped using wp_kses_post inside render_pagination().
						?>
					</div>
					<?php
				}
				if ( 'masonry' === $layout && 'infinite' === $attributes['paginationType'] ) {

					if ( 'scroll' === $attributes['paginationEventType'] ) {
						?>
							<div class="vxt-post-inf-loader" style="display: none;">
								<div class="vxt-post-loader-1"></div>
								<div class="vxt-post-loader-2"></div>
								<div class="vxt-post-loader-3"></div>
							</div>
							<?php

					}
					if ( 'button' === $attributes['paginationEventType'] ) {
						?>
							<div class="vxt-post__load-more-wrap">
								<span class="vxt-post-pagination-button">
									<a class="vxt-post__load-more" href="javascript:void(0);">
									<?php echo esc_html( $attributes['buttonText'] ); ?>
									</a>
								</span>
							</div>
							<?php
					}
				}
				?>
			</div>
			<?php
		}

		/**
		 * Renders the post post pagination on server.
		 *
		 * @param object $query WP_Query object.
		 * @param array  $attributes Array of block attributes.
		 * @since 1.18.1
		 */
		public function renderPagination( $query, $attributes ) {

			$permalinkStructure = get_option( 'permalink_structure' );
			$base                = untrailingslashit( wp_specialchars_decode( get_pagenum_link() ) );
			$base                = \Vexaltrix\Core\Support\Helper::buildBaseUrl( $permalinkStructure, $base );
			$format              = \Vexaltrix\Core\Support\Helper::pagedFormat( $permalinkStructure, $base );
			$paged               = \Vexaltrix\Core\Support\Helper::getPaged( $query );
			$pLimit             = isset( $attributes['pageLimit'] ) ? sanitize_text_field( $attributes['pageLimit'] ) : 10;
			$pageLimit          = min( $pLimit, $query->max_num_pages );
			$pageLimit          = isset( $pageLimit ) ? $pageLimit : sanitize_text_field( $attributes['postsToShow'] );

			$links = paginate_links(
				[
					'base'      => $base . '%_%',
					'format'    => $format,
					'current'   => ( ! $paged ) ? 1 : $paged,
					'total'     => $pageLimit,
					'type'      => 'array',
					'mid_size'  => 4,
					'end_size'  => 4,
					'prev_text' => $attributes['paginationPrevText'],
					'next_text' => $attributes['paginationNextText'],
				]
			);

			if ( isset( $links ) ) {

				return wp_kses_post( implode( PHP_EOL, $links ) );
			}

			return '';
		}

		/**
		 * Sends the Post pagination markup to edit.js
		 *
		 * @since 1.14.9
		 */
		public function postPagination() {

			check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'nonce' );

			$postAttributeArray = [];

			if ( isset( $_POST['attributes'] ) ) {

				// $_POST['attributes'] is sanitized in later stage.
				$attr = isset( $_POST['attributes'] ) ? json_decode( wp_unslash( $_POST['attributes'] ), true ) : []; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				if ( ! is_array( $attr ) ) {
					$attr = [];
				}

				$postAttributeArray = $this->requiredAttributeForQuery( $attr );

				$query = \Vexaltrix\Core\Support\Helper::getQuery( $postAttributeArray, 'grid' );

				$paginationMarkup = $this->renderPagination( $query, $attr );

				wp_send_json_success( $paginationMarkup );
			}

			wp_send_json_error( ' No attributes received' );
		}

		/**
		 * Required attribute for query.
		 *
		 * @param array $attributes plugin.
		 * @return array of requred query attributes.
		 * @since 2.0.0
		 */
		public function requiredAttributeForQuery( $attributes ) {
			// SECURITY: Validate post type against public post types to prevent information disclosure.
			$postType     = ( isset( $attributes['postType'] ) ) ? sanitize_text_field( $attributes['postType'] ) : 'post';
			$allowedTypes = get_post_types( [ 'public' => true ] );
			if ( ! in_array( $postType, $allowedTypes, true ) ) {
				$postType = 'post';
			}

			// SECURITY: Validate orderBy against allowed WP_Query values.
			$orderBy        = ( isset( $attributes['orderBy'] ) ) ? sanitize_text_field( $attributes['orderBy'] ) : 'date';
			$allowedOrderby = [ 'date', 'modified', 'ID', 'author', 'title', 'rand', 'menu_order', 'comment_count' ];
			if ( ! in_array( $orderBy, $allowedOrderby, true ) ) {
				$orderBy = 'date';
			}

			// SECURITY: Validate order direction.
			$order = ( isset( $attributes['order'] ) ) ? sanitize_text_field( $attributes['order'] ) : 'desc';
			if ( ! in_array( strtolower( $order ), [ 'asc', 'desc' ], true ) ) {
				$order = 'desc';
			}

			// SECURITY: Validate taxonomy type against registered public taxonomies.
			$taxonomyType = 'category'; // Default fallback.
			if ( isset( $attributes['taxonomyType'] ) ) {
				$requestedTaxonomy = sanitize_text_field( $attributes['taxonomyType'] );
				$taxonomyObj       = get_taxonomy( $requestedTaxonomy );
				// Only allow public taxonomies.
				if ( $taxonomyObj && $taxonomyObj->public ) {
					$taxonomyType = $requestedTaxonomy;
				}
			}

			return [
				'postsOffset'        => ( isset( $attributes['postsOffset'] ) ) ? absint( $attributes['postsOffset'] ) : 0,
				'postsToShow'        => ( isset( $attributes['postsToShow'] ) ) ? absint( $attributes['postsToShow'] ) : 6,
				'postType'           => $postType,
				'order'              => $order,
				'orderBy'            => $orderBy,
				'excludeCurrentPost' => ( ! empty( $attributes['excludeCurrentPost'] ) ) ? (bool) $attributes['excludeCurrentPost'] : false,
				'categories'         => ( isset( $attributes['categories'] ) && '' !== $attributes['categories'] ) ? sanitize_text_field( $attributes['categories'] ) : '',
				'taxonomyType'       => $taxonomyType,
				'postPagination'     => ( isset( $attributes['postPagination'] ) && true === $attributes['postPagination'] ) ? true : false,
				'paginationType'     => ( isset( $attributes['paginationType'] ) && 'none' !== $attributes['paginationType'] ) ? sanitize_text_field( $attributes['paginationType'] ) : 'none',
				'paged'              => ( isset( $attributes['paged'] ) ) ? absint( $attributes['paged'] ) : 1,
				'blockName'          => ( isset( $attributes['blockName'] ) ) ? sanitize_text_field( $attributes['blockName'] ) : '',
			];
		}

		/**
		 * Sends the Posts to Masonry AJAX.
		 *
		 * @since 1.18.1
		 */
		public function masonryPagination() {

			check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_masonry_ajax_nonce', 'nonce' );

			$postAttributeArray = [];
			// $_POST['attr'] is sanitized in later stage.
			$attr = isset( $_POST['attr'] ) ? json_decode( wp_unslash( $_POST['attr'] ), true ) : []; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			if ( ! is_array( $attr ) ) {
				$attr = [];
			}

			$attr['paged'] = isset( $_POST['page_number'] ) ? sanitize_text_field( $_POST['page_number'] ) : '';

			$postAttributeArray = $this->requiredAttributeForQuery( $attr );

			$query = \Vexaltrix\Core\Support\Helper::getQuery( $postAttributeArray, 'masonry' );

			foreach ( $attr as $key => $attribute ) {
				$attr[ $key ] = ( 'false' === $attribute ) ? false : ( ( 'true' === $attribute ) ? true : $attribute );
			}

			ob_start();
			$this->postsArticlesMarkup( $query, $attr );
			$html = ob_get_clean();

			wp_send_json_success( $html );
		}

		/**
		 * Render Posts HTML for Masonry Pagination.
		 *
		 * @param object $query WP_Query object.
		 * @param array  $attributes Array of block attributes.
		 * @since 1.18.1
		 */
		public function postsArticlesMarkup( $query, $attributes ) {

			while ( $query->have_posts() ) {

				$query->the_post();
				// Filter to modify the attributes based on content requirement.
				$attributes         = apply_filters( 'vxt_ultimate_gutenberg_blocks_post_alter_attributes', $attributes, get_the_ID() );
				$postClassEnabled = apply_filters( 'vxt_ultimate_gutenberg_blocks_enable_post_class', false, $attributes );

				do_action( "vxt_ultimate_gutenberg_blocks_post_before_article_{$attributes['post_type']}", get_the_ID(), $attributes );
				$postClasses = ( $postClassEnabled ) ? implode( ' ', get_post_class( 'vxt-post__inner-wrap' ) ) : 'vxt-post__inner-wrap';
				$isLeftRight  = ( is_array( $attributes ) && isset( $attributes['isLeftToRightLayout'] ) ) ? $attributes['isLeftToRightLayout'] : false;
				?>
				<?php do_action( "vxt_ultimate_gutenberg_blocks_post_before_inner_wrap_{$attributes['post_type']}", get_the_ID(), $attributes ); ?>
				<?php
				echo sprintf(
					'<article class="%1$s">',
					esc_attr( $postClasses )
				);
				?>
					<?php
					if ( $isLeftRight ) {
						$this->renderInnerblocksWithWrapper( $attributes );
					} else {
						$this->renderInnerblocks( $attributes );
					}
					?>

					<?php $this->renderCompleteBoxLink( $attributes ); ?>
				</article>
				<?php do_action( "vxt_ultimate_gutenberg_blocks_post_after_inner_wrap_{$attributes['post_type']}", get_the_ID(), $attributes ); ?>
				<?php

				do_action( "vxt_ultimate_gutenberg_blocks_post_after_article_{$attributes['post_type']}", get_the_ID(), $attributes );

			}

			wp_reset_postdata();
		}
		/**
		 * Render layout.
		 *
		 * @param array $fname to get the block.
		 * @param array $attr Array of block attributes.
		 *
		 * @since 1.20.0
		 */
		public function renderLayout( $fname, $attr ) {
			switch ( $fname ) {
				case 'vexaltrix/post-button':
					return $this->renderButton( $attr );
				case 'vexaltrix/post-image':
					return $this->renderImage( $attr );
				case 'vexaltrix/post-taxonomy':
					return ( 'aboveTitle' === $attr['displayPostTaxonomyAboveTitle'] ) ? $this->renderMetaTaxonomy( $attr ) : '';
				case 'vexaltrix/post-title':
					return $this->renderTitle( $attr );
				case 'vexaltrix/post-meta':
					return $this->renderMeta( $attr );
				case 'vexaltrix/post-excerpt':
					return $this->renderExcerpt( $attr );
				default:
					return '';
			}
		}

		/**
		 * Render Inner blocks with a wrapper.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 2.13.3
		 * @return void
		 */
		public function renderInnerblocksWithWrapper( $attributes ) {
			$length   = count( $attributes['layoutConfig'] );
			$imgAtts = [];

			// Iterate through the blocks and find the vexaltrix/post-image block.
			for ( $i = 0; $i < $length; $i++ ) {
				if ( 'vexaltrix/post-image' === $attributes['layoutConfig'][ $i ][0] ) {
					// Store the image attributes for later rendering.
					$imgAtts[] = $attributes['layoutConfig'][ $i ];
					// Remove the vexaltrix/post-image block from the layoutConfig array.
					array_splice( $attributes['layoutConfig'], $i, 1 );
					$i--;
					$length--;
				}
			}

			// Render the vexaltrix/post-image block(s) outside the wrapper, if it exists.
			foreach ( $imgAtts as $imgAtt ) {
				echo esc_html( $this->renderLayout( $imgAtt[0], $attributes ) );
			}

			// Render all blocks except for the vexaltrix/post-image block inside the wrapper.
			echo '<div class="uag-post-grid-wrapper">';
			for ( $i = 0; $i < $length; $i++ ) {
				echo esc_html( $this->renderLayout( $attributes['layoutConfig'][ $i ][0], $attributes ) );
			}
			echo '</div>';
		}

		/**
		 * Render Inner blocks.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.20.0
		 * @return void
		 */
		public function renderInnerblocks( $attributes ) {
			$length   = count( $attributes['layoutConfig'] );
			$imgAtts = [];
			for ( $i = 0; $i < $length; $i++ ) {
				if ( 'background' === $attributes['imgPosition'] && 'vexaltrix/post-image' === $attributes['layoutConfig'][ $i ][0] ) {
					// This is to avoid background image container as first child as we are targetting first child for top margin property.
					$imgAtts = $attributes['layoutConfig'][ $i ][0];
					continue;
				}
				$this->renderLayout( $attributes['layoutConfig'][ $i ][0], $attributes );
			}
			// Render background image container as a last child.
			if ( ! empty( $imgAtts ) ) {
				$this->renderLayout( $imgAtts, $attributes );
			}
		}
		/**
		 * Renders the post masonry related script.
		 *
		 * @since 0.0.1
		 */
		public function addPostDynamicScript() {
			if ( isset( self::$settings['masonry'] ) && ! empty( self::$settings['masonry'] ) ) {
				foreach ( self::$settings['masonry'] as $key => $value ) {
					?>
					<script type="text/javascript" id="vxt-post-masonry-script-<?php echo esc_html( $key ); ?>">
						document.addEventListener("DOMContentLoaded", function(){
							let scope = document.querySelector( '.vxt-block-<?php echo esc_html( $key ); ?>' );
							if (scope.classList.contains( 'is-masonry' )) {
								setTimeout( function() {
									const isotope = new Isotope( scope, { // eslint-disable-line no-undef
											itemSelector: 'article',
										} );
									imagesLoaded( scope, function() { isotope	});
									window.addEventListener( 'resize', function() {	isotope	});
								}, 500 );
							}
							// This CSS is for Post BG Image Spacing
							let articles = document.querySelectorAll( '.wp-block-vxt-post-masonry.vxt-post__image-position-background .vxt-post__inner-wrap' );

							for( let article of articles ) {
								let articleWidth = article.offsetWidth;
								let rowGap = <?php echo esc_html( $value['rowGap'] ); ?>;
								let imageWidth = 100 - ( rowGap / articleWidth ) * 100;
								let image = article.getElementsByClassName('vxt-post__image');
								if ( image[0] ) {
									image[0].style.width = imageWidth + '%';
									image[0].style.marginLeft = rowGap / 2 + 'px';
								}

							}
						});
						<?php $selector = '.vxt-block-' . $key; ?>
						window.addEventListener( 'DOMContentLoaded', function() {
							VexaltrixPostMasonry._init( <?php echo wp_json_encode( $value ); ?>, '<?php echo esc_attr( $selector ); ?>' );
						});
					</script>
					<?php
				}
			}

			if ( isset( self::$settings['carousel'] ) && ! empty( self::$settings['carousel'] ) ) {
				foreach ( self::$settings['carousel'] as $key => $value ) {

					$dots         = ( 'dots' === $value['arrowDots'] || 'arrows_dots' === $value['arrowDots'] ) ? true : false;
					$arrows       = ( 'arrows' === $value['arrowDots'] || 'arrows_dots' === $value['arrowDots'] ) ? true : false;
					$equalHeight = isset( $value['equalHeight'] ) ? $value['equalHeight'] : '';
					$tcolumns     = ( isset( $value['tcolumns'] ) ) ? $value['tcolumns'] : 2;
					$mcolumns     = ( isset( $value['mcolumns'] ) ) ? $value['mcolumns'] : 1;
					$isRtl       = is_rtl();

					?>
					<script type="text/javascript" id="<?php echo esc_attr( $key ); ?>">
						document.addEventListener("DOMContentLoaded", function(){
							( function( $ ) {
								var cols = parseInt( '<?php echo esc_html( $value['columns'] ); ?>' );
								var $scope = $( '.vxt-block-<?php echo esc_html( $key ); ?>' );
								let imagePosition = '<?php echo esc_html( $value['imgPosition'] ); ?>';

								if( 'top' !== imagePosition ){
									// This CSS is for Post BG Image Spacing
									let articles = document.querySelectorAll( '.vxt-post__image-position-background .vxt-post__inner-wrap' );
									if( articles.length ) {
										for( let article of articles ) {
											let image = article.getElementsByClassName('vxt-post__image');
											if ( image[0] ) {
												let articleWidth = article.offsetWidth;
												let rowGap = <?php echo esc_html( $value['rowGap'] ); ?>;
												let imageWidth = 100 - ( rowGap / articleWidth ) * 100;
												image[0].style.width = imageWidth + '%';
												image[0].style.marginLeft = rowGap / 2 + 'px';
											}
										}
									}
								}
								// If this is not a Post Carousel, return.
								// Else if it is a carousel but has less posts than the number of columns, return after setting visibility.
								if ( ! $scope.hasClass('is-carousel') ) {
									return;
								} else if ( cols >= $scope.children('article.vxt-post__inner-wrap').length ) {
									$scope.css( 'visibility', 'visible' );
									return;
								}
								var slider_options = {
									'slidesToShow' : cols,
									'slidesToScroll' : 1,
									'autoplaySpeed' : <?php echo esc_html( $value['autoplaySpeed'] ); ?>,
									'autoplay' : Boolean( '<?php echo esc_html( $value['autoplay'] ); ?>' ),
									'infinite' : Boolean( '<?php echo esc_html( $value['infiniteLoop'] ); ?>' ),
									'pauseOnHover' : Boolean( '<?php echo esc_html( $value['pauseOnHover'] ); ?>' ),
									'speed' : <?php echo esc_html( $value['transitionSpeed'] ); ?>,
									'arrows' : Boolean( '<?php echo esc_html( $arrows ); ?>' ),
									'dots' : Boolean( '<?php echo esc_html( $dots ); ?>' ),
									'rtl' : Boolean( '<?php echo esc_html( $isRtl ); ?>' ),
									'prevArrow' : '<button type=\"button\" data-role=\"none\" class=\"slick-prev\" aria-label=\"Previous\" tabindex=\"0\" role=\"button\"><svg width=\"20\" height=\"20\" viewBox=\"0 0 256 512\"><path d=\"M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z\"></path></svg><\/button>',
									'nextArrow' : '<button type=\"button\" data-role=\"none\" class=\"slick-next\" aria-label=\"Next\" tabindex=\"0\" role=\"button\"><svg width=\"20\" height=\"20\" viewBox=\"0 0 256 512\"><path d=\"M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z\"></path></svg><\/button>',
									'responsive' : [
										{
											'breakpoint' : 1024,
											'settings' : {
												'slidesToShow' : <?php echo esc_html( $tcolumns ); ?>,
												'slidesToScroll' : 1,
											}
										},
										{
											'breakpoint' : 767,
											'settings' : {
												'slidesToShow' : <?php echo esc_html( $mcolumns ); ?>,
												'slidesToScroll' : 1,
											}
										}
									]
								};

								$scope.imagesLoaded( function() {
									$scope.slick( slider_options );
								}).always( function() {
									$scope.css( 'visibility', 'visible' );
								} );

								var enableEqualHeight = ( '<?php echo esc_html( $equalHeight ); ?>' );

								if( enableEqualHeight ){
									$scope.imagesLoaded( function() {
										VexaltrixPostCarousel?._setHeight( $scope );
									});

									$scope.on( 'afterChange', function() {
										VexaltrixPostCarousel?._setHeight( $scope );
									} );
								}

							} )( jQuery );
						});
					</script>
					<?php
				}
			}

			if ( ! empty( self::$settings['grid'] ) && is_array( self::$settings['grid'] ) ) {
				foreach ( self::$settings['grid'] as $key => $value ) {
					if ( empty( $value ) || ! is_array( $value ) ) {
						return; // Exit early if this is not the attributes array.
					}
					if ( ! empty( $value['paginationType'] ) && 'ajax' !== $value['paginationType'] ) {
						return; // Early return when pagination type exists and is not ajax.
					}
					?>

					<script type="text/javascript" id="<?php echo esc_attr( $key ); ?>">
						( function() {
							let elements = document.querySelectorAll( '.vxt-post-grid.vxt-block-<?php echo esc_html( $key ); ?> .vxt-post-pagination-wrap a' );
							elements.forEach(function(element) {
								element.addEventListener("click", function(event){
									event.preventDefault();
									const link = event.target.getAttribute('href').match( /\/page\/\d+\// )?.[0] || '';
									const regex = /\d+/; // regular expression to match a number at the end of the string
									const match = link.match( regex ) ? link.match( regex )[0] : 1; // match the regular expression with the link
									const pageNumber = parseInt( match ); // extract the number and parse it to an integer
									window.VexaltrixPostGrid._callAjax(<?php echo wp_json_encode( $value ); ?>, pageNumber, '<?php echo esc_attr( $key ); ?>');
								});
							});
						} )();
					</script>

					<?php
				}
			}
		}

		/**
		 * Render Image HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 0.0.1
		 */
		public function renderImage( $attributes ) {
			if ( ! $attributes['displayPostImage'] ) {
				return;
			}

			if ( ! get_the_post_thumbnail_url() && ( 'background' !== $attributes['imgPosition'] ) ) {
				return;
			}

			$target = ( $attributes['newTab'] ) ? '_blank' : '_self';
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_featured_image_{$attributes['post_type']}", get_the_ID(), $attributes );

			?>
			<div class='vxt-post__image'>
				<?php
				if ( get_the_post_thumbnail_url() ) {
					if ( 'post-grid' === $attributes['blockName'] && 'background' !== $attributes['imgPosition'] ) {
						?>
					<a href="<?php echo esc_url( apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_link_{$attributes['post_type']}", get_the_permalink(), get_the_ID(), $attributes ) ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="bookmark noopener noreferrer" class='vxt-image-ratio-<?php echo esc_attr( $attributes['imageRatio'] ); ?>'><?php echo wp_get_attachment_image( get_post_thumbnail_id(), $attributes['imgSize'] ); ?>
					</a>
				<?php } else { ?>
					<a href="<?php echo esc_url( apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_link_{$attributes['post_type']}", get_the_permalink(), get_the_ID(), $attributes ) ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="bookmark noopener noreferrer"><?php echo wp_get_attachment_image( get_post_thumbnail_id(), $attributes['imgSize'] ); ?>
					</a>
						<?php
				}
				}
				?>
			</div>
			<?php
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_featured_image_{$attributes['post_type']}", get_the_ID(), $attributes );
		}

		/**
		 * Render Post Title HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 0.0.1
		 */
		public function renderTitle( $attributes ) {

			if ( ! $attributes['displayPostTitle'] ) {
				return;
			}

			$target = ( $attributes['newTab'] ) ? '_blank' : '_self';
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_title_{$attributes['post_type']}", get_the_ID(), $attributes );
			$arrayOfAllowedHTML = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'p' ];
			$titleTag             = \Vexaltrix\Core\Support\Helper::titleTagAllowedHtml( $attributes['titleTag'], $arrayOfAllowedHTML, 'h4' );
			?>
			<<?php echo esc_html( $titleTag ); ?> class="vxt-post__title vxt-post__text">
				<a href="<?php echo esc_url( apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_link_{$attributes['post_type']}", get_the_permalink(), get_the_ID(), $attributes ) ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="bookmark noopener noreferrer"><?php the_title(); ?></a>
			</<?php echo esc_html( $titleTag ); ?>>
			<?php
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_title_{$attributes['post_type']}", get_the_ID(), $attributes );
		}

		/**
		 * Render Post Meta - Author HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.14.0
		 */
		public function renderMetaAuthor( $attributes ) {

			if ( ! $attributes['displayPostAuthor'] ) {
				return;
			}
			?>
				<span class="vxt-post__author">
				<?php echo ( true === $attributes['hideTaxonomyIcon'] ) ? '<span class="dashicons-admin-users dashicons"></span>' : ''; ?>
					<?php the_author_posts_link(); ?>
				</span>
			<?php
		}

		/**
		 * Render Post Meta - Date HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.14.0
		 */
		public function renderMetaDate( $attributes ) {

			if ( ! $attributes['displayPostDate'] ) {
				return;
			}
			global $post;
			?>
				<time datetime="<?php echo esc_attr( get_the_date( 'c', $post->ID ) ); ?>" class="vxt-post__date">
				<?php echo ( true === $attributes['hideTaxonomyIcon'] ) ? '<span class="dashicons-calendar dashicons"></span>' : ''; ?>
					<?php echo esc_html( get_the_date( '', $post->ID ) ); ?>
				</time>
			<?php
		}

		/**
		 * Render Post Meta - Comment HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.14.0
		 */
		public function renderMetaComment( $attributes ) {

			if ( ! $attributes['displayPostComment'] ) {
				return;
			}
			?>
				<span class="vxt-post__comment">
				<?php echo ( true === $attributes['hideTaxonomyIcon'] ) ? '<span class="dashicons-admin-comments dashicons"></span>' : ''; ?>
					<?php comments_number(); ?>
				</span>
			<?php
		}

		/**
		 * Render Post Meta - Comment HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.14.0
		 */
		public function renderMetaTaxonomy( $attributes ) {

			if ( ! $attributes['displayPostTaxonomy'] ) {
				return;
			}
			global $post;

			$terms = get_the_terms( $post->ID, $attributes['taxonomyType'] );
			if ( is_wp_error( $terms ) ) {
				return;
			}

			if ( ! isset( $terms[0] ) ) {
				return;
			}
			$wrap = ( 'aboveTitle' === $attributes['displayPostTaxonomyAboveTitle'] ) ? [
				'vxt-post__taxonomy',
				$attributes['taxStyle'],
			] : [ 'vxt-post__taxonomy' ];

			if ( ( 'default' === $attributes['taxStyle'] && 'aboveTitle' === $attributes['displayPostTaxonomyAboveTitle'] ) || 'withMeta' === $attributes['displayPostTaxonomyAboveTitle'] ) {
				?>
				<div class="vxt-post__text">
					<span class='<?php echo esc_attr( implode( ' ', $wrap ) ); ?>'>
						<?php echo ( true === $attributes['hideTaxonomyIcon'] ) ? '<span class="dashicons-tag dashicons"></span>' : ''; ?>
						<?php
						$termsList = [];
						foreach ( $terms as $key => $value ) {
							// Get the URL of this category.
							$categoryLink = get_category_link( $value->term_id );
							array_push( $termsList, '<a href="' . esc_url( $categoryLink ) . '">' . esc_html( $value->name ) . '</a>' );
						}
						echo esc_attr( ( 'aboveTitle' === $attributes['displayPostTaxonomyAboveTitle'] ) && 'default' === $attributes['taxStyle'] ) ? wp_kses_post( implode( esc_html( $attributes['taxDivider'] ) . '&nbsp;', $termsList ) ) : wp_kses_post( implode( ',&nbsp;', $termsList ) );
						?>
					</span>
				</div>
				<?php
			}
			if ( 'highlighted' === $attributes['taxStyle'] && 'aboveTitle' === $attributes['displayPostTaxonomyAboveTitle'] ) {
				$termsList = [];
				echo sprintf( '<div class="vxt-post__text">' );
				foreach ( $terms as $key => $value ) {
					// Get the URL of this category.
					$categoryLink = get_category_link( $value->term_id );
					echo sprintf(
						'<span class="%s">%s<a href="%s">%s</a></span>',
						esc_html( implode( ' ', $wrap ) ),
						( ( true === $attributes['hideTaxonomyIcon'] ) ? '<span class="dashicons-tag dashicons"></span>' : '' ),
						esc_url( $categoryLink ),
						esc_html( $value->name )
					);
				}
				echo sprintf( '</div>' );
			}
		}

		/**
		 * Render Post Meta HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 0.0.1
		 */
		public function renderMeta( $attributes ) {

			global $post;
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_meta_{$attributes['post_type']}", get_the_ID(), $attributes );

			$metaSequence = [ 'author', 'date', 'comment', 'taxonomy' ];
			$metaSequence = apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_meta_sequence_{$attributes['post_type']}", $metaSequence, get_the_ID(), $attributes );
			?>
			<div class='vxt-post__text vxt-post-grid-byline'>
				<?php
				foreach ( $metaSequence as $key => $sequence ) {
					switch ( $sequence ) {
						case 'author':
							$this->renderMetaAuthor( $attributes );
							break;

						case 'date':
							$this->renderMetaDate( $attributes );
							break;

						case 'comment':
							$this->renderMetaComment( $attributes );
							break;

						case 'taxonomy':
							( 'withMeta' === $attributes['displayPostTaxonomyAboveTitle'] ) ? $this->renderMetaTaxonomy( $attributes ) : '';
							break;

						default:
							break;
					}
				}
				?>
			</div>
			<?php
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_meta_{$attributes['post_type']}", get_the_ID(), $attributes );

		}

		/**
		 * Render Post Excerpt HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 0.0.1
		 */
		public function renderExcerpt( $attributes ) {

			if ( ! $attributes['displayPostExcerpt'] ) {
				return;
			}

			global $post;

			if ( post_password_required( $post ) ) {
				?>
				<div class='vxt-post__text vxt-post__excerpt'>
					<?php echo esc_html__( 'There is no excerpt because this is a protected post.', 'vexaltrix' ); ?>
				</div>
				<?php
				return;
			}

			if ( 'full_post' === $attributes['displayPostContentRadio'] ) {
				$excerpt = get_the_content();
			} else {
				$excerptLengthFallback = \Vexaltrix\Presentation\Blocks\BlockHelper::getFallbackNumber( $attributes['excerptLength'], 'excerptLength', 'post-timeline' );
				$excerpt                 = \Vexaltrix\Core\Support\Helper::vxtUltimateGutenbergBlocksGetExcerpt( $post->ID, $post->post_content, $excerptLengthFallback );
			}

			$excerpt = apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_excerpt_{$attributes['post_type']}", $excerpt, get_the_ID(), $attributes );
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_excerpt_{$attributes['post_type']}", get_the_ID(), $attributes );
			?>
				<div class='vxt-post__text vxt-post__excerpt'>
					<?php echo wp_kses_post( $excerpt ); ?>
				</div>
			<?php
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_excerpt_{$attributes['post_type']}", get_the_ID(), $attributes );
		}

		/**
		 * Render Post CTA button HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 0.0.1
		 */
		public function renderButton( $attributes ) {
			$inheritAstraSecondary = $attributes['inheritFromThemeBtn'] && 'secondary' === $attributes['buttonType'];
			$buttonTypeClass       = $inheritAstraSecondary ? 'ast-outline-button' : 'wp-block-button__link';

			// Initialize an empty string for border style.
			$borderStyle = $inheritAstraSecondary ? 'border-width: revert-layer;' : '';

			if ( ! $attributes['displayPostLink'] ) {
				return;
			}
			$target   = ( $attributes['newTab'] ) ? '_blank' : '_self';
			$ctaText = ( $attributes['ctaText'] ) ? $attributes['ctaText'] : __( 'Read More', 'vexaltrix' );
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_cta_{$attributes['post_type']}", get_the_ID(), $attributes );
			$wrapClasses = 'vxt-post__text vxt-post__cta wp-block-button';
			$linkClasses = $buttonTypeClass . ' vxt-text-link';
			?>
			<div class="<?php echo esc_attr( $wrapClasses ); ?>">
				<a class="<?php echo esc_attr( $linkClasses ); ?>" style="<?php echo esc_attr( $borderStyle ); ?>" href="<?php echo esc_url( apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_link_{$attributes['post_type']}", get_the_permalink(), get_the_ID(), $attributes ) ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="bookmark noopener noreferrer"><?php echo wp_kses_post( $ctaText ); ?></a>
			</div>
			<?php
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_cta_{$attributes['post_type']}", get_the_ID(), $attributes );
		}

		/**
		 * Render Complete Box Link HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.7.0
		 */
		public function renderCompleteBoxLink( $attributes ) {
			if ( ! ( isset( $attributes['linkBox'] ) && $attributes['linkBox'] ) ) {
				return;
			}
			$target = ( $attributes['newTab'] ) ? '_blank' : '_self';
			?>
			<a class="vxt-post__link-complete-box" href="<?php echo esc_url( apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_link_{$attributes['post_type']}", get_the_permalink(), get_the_ID(), $attributes ) ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="bookmark noopener noreferrer"></a>
			<?php
		}

		/**
		 * Disable canonical on Single Post.
		 *
		 * @param  string $redirectUrl  The redirect URL.
		 * @param  string $requestedUrl The requested URL.
		 * @since  1.14.9
		 * @return bool|string
		 */
		public function overrideCanonical( $redirectUrl, $requestedUrl ) {

			global $wp_query;

			if ( is_array( $wp_query->query ) ) {

				if ( true === $wp_query->is_singular
					&& - 1 === $wp_query->current_post
					&& true === $wp_query->is_paged
				) {
					// Only prevent redirect if we're on a valid archive/listing page with pagination.
					// Don't prevent redirects for single posts with invalid pagination.
					if ( ! is_single() ) {
						$redirectUrl = false;
					}
				}
			}

			return $redirectUrl;
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\Post\\Post' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
