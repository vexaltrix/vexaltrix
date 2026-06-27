<?php
/**
 * Vexaltrix Post.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\BlocksConfig\PostTimeline;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\BlocksConfig\\PostTimeline\\PostTimeline' ) ) {

	/**
	 * Class \Vexaltrix\BlocksConfig\PostTimeline\PostTimeline.
	 */
	class PostTimeline {


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
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'init', [ $this, 'registerBlocks' ] );
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

			$inheritFromTheme = 'enabled' === ( 'deleted' !== \Vexaltrix\Admin\AdminSettings::get( 'uag_btn_inherit_from_theme_fallback', 'deleted' ) ? 'disabled' : \Vexaltrix\Admin\AdminSettings::get( 'uag_btn_inherit_from_theme', 'disabled' ) );

			register_block_type(
				'vexaltrix/post-timeline',
				[
					'attributes'      => [
						'blockName'                  => [
							'type'    => 'string',
							'default' => 'post-timeline',
						],
						'align'                      => [
							'type'    => 'string',
							'default' => '',
						],
						'alignTablet'                => [
							'type'    => 'string',
							'default' => '',
						],
						'alignMobile'                => [
							'type'    => 'string',
							'default' => '',
						],
						'headingColor'               => [
							'type'    => 'string',
							'default' => '#333',
						],
						'subHeadingColor'            => [
							'type'    => 'string',
							'default' => '#333',
						],
						'separatorBg'                => [
							'type'    => 'string',
							'default' => '#eee',
						],
						'backgroundColor'            => [
							'type'    => 'string',
							'default' => '#eee',
						],
						'separatorColor'             => [
							'type'    => 'string',
							'default' => '#eee',
						],
						'separatorFillColor'         => [
							'type'    => 'string',
							'default' => '#0693e3',
						],
						'separatorBorder'            => [
							'type'    => 'string',
							'default' => '#eee',
						],
						'borderFocus'                => [
							'type'    => 'string',
							'default' => '#5cb85c',
						],
						'headingTag'                 => [
							'type'    => 'string',
							'default' => 'h3',
						],
						'horizontalSpace'            => [
							'type'    => 'number',
							'default' => 10,
						],
						'horizontalSpaceTablet'      => [
							'type' => 'number',
						],
						'horizontalSpaceMobile'      => [
							'type' => 'number',
						],
						'horizontalSpaceUnit'        => [
							'type'    => 'string',
							'default' => 'px',
						],
						'horizontalSpaceUnitTablet'  => [
							'type'    => 'string',
							'default' => 'px',
						],
						'horizontalSpaceUnitMobile'  => [
							'type'    => 'string',
							'default' => 'px',
						],
						'verticalSpace'              => [
							'type'    => 'number',
							'default' => 15,
						],
						'verticalSpaceTablet'        => [
							'type' => 'number',
						],
						'verticalSpaceMobile'        => [
							'type' => 'number',
						],
						'verticalSpaceUnit'          => [
							'type'    => 'string',
							'default' => 'px',
						],
						'verticalSpaceUnitTablet'    => [
							'type'    => 'string',
							'default' => 'px',
						],
						'verticalSpaceUnitMobile'    => [
							'type'    => 'string',
							'default' => 'px',
						],
						'timelinAlignment'           => [
							'type'    => 'string',
							'default' => 'center',
						],
						'timelinAlignmentTablet'     => [
							'type' => 'string',
						],
						'timelinAlignmentMobile'     => [
							'type' => 'string',
						],
						'arrowlinAlignment'          => [
							'type'    => 'string',
							'default' => 'center',
						],
						'subHeadFontSizeType'        => [
							'type'    => 'string',
							'default' => 'px',
						],
						'subHeadFontSize'            => [
							'type' => 'number',
						],
						'subHeadFontSizeTablet'      => [
							'type' => 'number',
						],
						'subHeadFontSizeMobile'      => [
							'type' => 'number',
						],
						'subHeadFontFamily'          => [
							'type'    => 'string',
							'default' => '',
						],
						'subHeadFontWeight'          => [
							'type' => 'string',
						],
						'subHeadFontStyle'           => [
							'type' => 'string',
						],
						'subHeadLineHeightType'      => [
							'type'    => 'string',
							'default' => 'em',
						],
						'subHeadLineHeight'          => [
							'type' => 'number',
						],
						'subHeadLineHeightTablet'    => [
							'type' => 'number',
						],
						'subHeadLineHeightMobile'    => [
							'type' => 'number',
						],
						'subHeadLoadGoogleFonts'     => [
							'type'    => 'boolean',
							'default' => false,
						],
						'headSpace'                  => [
							'type'    => 'number',
							'default' => 5,
						],
						'headSpaceTablet'            => [
							'type' => 'number',
						],
						'headSpaceMobile'            => [
							'type' => 'number',
						],
						'authorSpace'                => [
							'type'    => 'number',
							'default' => 5,
						],
						'authorSpaceTablet'          => [
							'type' => 'number',
						],
						'authorSpaceMobile'          => [
							'type' => 'number',
						],
						'contentSpace'               => [
							'type'    => 'number',
							'default' => 15,
						],
						'separatorwidth'             => [
							'type'    => 'number',
							'default' => 3,
						],
						'borderwidth'                => [
							'type'    => 'number',
							'default' => 0,
						],
						'iconColor'                  => [
							'type'    => 'string',
							'default' => '#333',
						],
						'iconFocus'                  => [
							'type'    => 'string',
							'default' => '#fff',
						],
						'iconBgFocus'                => [
							'type'    => 'string',
							'default' => '#0693e3',
						],
						'authorColor'                => [
							'type'    => 'string',
							'default' => '#333',
						],
						'authorFontSizeType'         => [
							'type'    => 'string',
							'default' => 'px',
						],
						'authorFontSize'             => [
							'type'    => 'number',
							'default' => 11,
						],
						'authorFontSizeTablet'       => [
							'type' => 'number',
						],
						'authorFontSizeMobile'       => [
							'type' => 'number',
						],
						'authorFontFamily'           => [
							'type'    => 'string',
							'default' => '',
						],
						'authorFontWeight'           => [
							'type' => 'string',
						],
						'authorFontStyle'            => [
							'type' => 'string',
						],
						'authorLineHeightType'       => [
							'type'    => 'string',
							'default' => 'em',
						],
						'authorLineHeight'           => [
							'type' => 'number',
						],
						'authorLineHeightTablet'     => [
							'type' => 'number',
						],
						'authorLineHeightMobile'     => [
							'type' => 'number',
						],
						'authorLoadGoogleFonts'      => [
							'type'    => 'boolean',
							'default' => false,
						],
						'ctaFontSizeType'            => [
							'type'    => 'string',
							'default' => 'px',
						],
						'ctaFontSize'                => [
							'type'    => 'number',
							'default' => '',
						],
						'ctaFontSizeTablet'          => [
							'type' => 'number',
						],
						'ctaFontSizeMobile'          => [
							'type' => 'number',
						],
						'ctaFontFamily'              => [
							'type'    => 'string',
							'default' => '',
						],
						'ctaFontWeight'              => [
							'type' => 'string',
						],
						'ctaFontStyle'               => [
							'type' => 'string',
						],
						'ctaLineHeightType'          => [
							'type'    => 'string',
							'default' => 'em',
						],
						'ctaLineHeight'              => [
							'type' => 'number',
						],
						'ctaLineHeightTablet'        => [
							'type' => 'number',
						],
						'ctaLineHeightMobile'        => [
							'type' => 'number',
						],
						'ctaLoadGoogleFonts'         => [
							'type'    => 'boolean',
							'default' => false,
						],
						'dateColor'                  => [
							'type'    => 'string',
							'default' => '#333',
						],
						'dateFontsizeType'           => [
							'type'    => 'string',
							'default' => 'px',
						],
						'dateFontsize'               => [
							'type'    => 'number',
							'default' => 12,
						],
						'dateFontsizeTablet'         => [
							'type' => 'number',
						],
						'dateFontsizeMobile'         => [
							'type' => 'number',
						],
						'dateFontSizeType'           => [
							'type' => 'string',
						],
						'dateFontSize'               => [
							'type' => 'number',
						],
						'dateFontSizeTablet'         => [
							'type' => 'number',
						],
						'dateFontSizeMobile'         => [
							'type' => 'number',
						],
						'dateFontFamily'             => [
							'type'    => 'string',
							'default' => '',
						],
						'dateFontWeight'             => [
							'type' => 'string',
						],
						'dateFontStyle'              => [
							'type' => 'string',
						],
						'dateLineHeightType'         => [
							'type'    => 'string',
							'default' => 'em',
						],
						'dateLineHeight'             => [
							'type' => 'number',
						],
						'dateLineHeightTablet'       => [
							'type' => 'number',
						],
						'dateLineHeightMobile'       => [
							'type' => 'number',
						],
						'dateLoadGoogleFonts'        => [
							'type'    => 'boolean',
							'default' => false,
						],
						'connectorBgsize'            => [
							'type'    => 'number',
							'default' => 35,
						],
						'dateBottomspace'            => [
							'type'    => 'number',
							'default' => 5,
						],
						'dateBottomspaceMobile'      => [
							'type' => 'number',
						],
						'dateBottomspaceTablet'      => [
							'type' => 'number',
						],
						'headFontSizeType'           => [
							'type'    => 'string',
							'default' => 'px',
						],
						'headFontSize'               => [
							'type' => 'number',
						],
						'headFontSizeTablet'         => [
							'type' => 'number',
						],
						'headFontSizeMobile'         => [
							'type' => 'number',
						],
						'headFontFamily'             => [
							'type'    => 'string',
							'default' => '',
						],
						'headFontWeight'             => [
							'type' => 'string',
						],
						'headFontStyle'              => [
							'type' => 'string',
						],
						'headLineHeightType'         => [
							'type'    => 'string',
							'default' => 'em',
						],
						'headLineHeight'             => [
							'type' => 'number',
						],
						'headLineHeightTablet'       => [
							'type' => 'number',
						],
						'headLineHeightMobile'       => [
							'type' => 'number',
						],
						'headLoadGoogleFonts'        => [
							'type'    => 'boolean',
							'default' => false,
						],
						'categories'                 => [
							'type' => 'string',
						],
						'postType'                   => [
							'type'    => 'string',
							'default' => 'post',
						],
						'taxonomyType'               => [
							'type'    => 'string',
							'default' => 'category',
						],
						'postsToShow'                => [
							'type'    => 'number',
							'default' => 6,
						],
						'postsOffset'                => [
							'type'    => 'number',
							'default' => 0,
						],
						'displayPostDate'            => [
							'type'    => 'boolean',
							'default' => true,
						],
						'dateFormat'                 => [
							'type'    => 'string',
							'default' => 'F j, Y',
						],
						'displayPostExcerpt'         => [
							'type'    => 'boolean',
							'default' => true,
						],
						'displayPostAuthor'          => [
							'type'    => 'boolean',
							'default' => true,
						],
						'displayPostImage'           => [
							'type'    => 'boolean',
							'default' => true,
						],
						'displayPostLink'            => [
							'type'    => 'boolean',
							'default' => true,
						],
						'inheritFromTheme'           => [
							'type'    => 'boolean',
							'default' => $inheritFromTheme,
						],
						'buttonType'                 => [
							'type'    => 'string',
							'default' => 'primary',
						],
						'exerptLength'               => [
							'type'    => 'number',
							'default' => 15,
						],
						'postLayout'                 => [
							'type'    => 'string',
							'default' => 'grid',
						],
						'columns'                    => [
							'type'    => 'number',
							'default' => 2,
						],
						'width'                      => [
							'type'    => 'string',
							'default' => 'wide',
						],
						'order'                      => [
							'type'    => 'string',
							'default' => 'desc',
						],
						'orderBy'                    => [
							'type'    => 'string',
							'default' => 'date',
						],
						'imageSize'                  => [
							'type'    => 'string',
							'default' => 'large',
						],
						'readMoreText'               => [
							'type'    => 'string',
							'default' => __( 'Read More', 'vexaltrix' ),
						],
						'block_id'                   => [
							'type'    => 'string',
							'default' => 'not_set',
						],
						'icon'                       => [
							'type'    => 'string',
							'default' => 'calendar-days',
						],
						'borderRadius'               => [
							'type'    => 'number',
							'default' => 2,
						],
						'borderRadiusTablet'         => [
							'type' => 'number',
						],
						'borderRadiusMobile'         => [
							'type' => 'number',
						],
						'bgPadding'                  => [
							'type'    => 'number',
							'default' => 20,
						],
						'contentPadding'             => [
							'type'    => 'number',
							'default' => 10,
						],
						'ctaBottomSpacing'           => [
							'type'    => 'number',
							'default' => 0,
						],
						'ctaBottomSpacingTablet'     => [
							'type' => 'number',
						],
						'ctaBottomSpacingMobile'     => [
							'type' => 'number',
						],
						'headTopSpacing'             => [
							'type'    => 'number',
							'default' => 0,
						],
						'headTopSpacingTablet'       => [
							'type' => 'number',
						],
						'headTopSpacingMobile'       => [
							'type' => 'number',
						],
						'iconSize'                   => [
							'type'    => 'number',
							'default' => 15,
						],
						'ctaColor'                   => [
							'type' => 'string',
						],
						'ctaBackground'              => [
							'type' => 'string',
						],
						'stack'                      => [
							'type'    => 'string',
							'default' => 'tablet',
						],
						'linkTarget'                 => [
							'type'    => 'boolean',
							'default' => false,
						],
						// Exclude Current Post.
						'excludeCurrentPost'         => [
							'type'    => 'boolean',
							'default' => false,
						],
						'leftMargin'                 => [
							'type' => 'number',
						],
						'rightMargin'                => [
							'type' => 'number',
						],
						'topMargin'                  => [
							'type' => 'number',
						],
						'bottomMargin'               => [
							'type' => 'number',
						],
						'leftMarginTablet'           => [
							'type' => 'number',
						],
						'rightMarginTablet'          => [
							'type' => 'number',
						],
						'topMarginTablet'            => [
							'type' => 'number',
						],
						'bottomMarginTablet'         => [
							'type' => 'number',
						],
						'leftMarginMobile'           => [
							'type' => 'number',
						],
						'rightMarginMobile'          => [
							'type' => 'number',
						],
						'topMarginMobile'            => [
							'type' => 'number',
						],
						'bottomMarginMobile'         => [
							'type' => 'number',
						],
						'marginUnit'                 => [
							'type'    => 'string',
							'default' => 'px',
						],
						'mobileMarginUnit'           => [
							'type'    => 'string',
							'default' => 'px',
						],
						'tabletMarginUnit'           => [
							'type'    => 'string',
							'default' => 'px',
						],
						'marginLink'                 => [
							'type'    => 'boolean',
							'default' => false,
						],
						'leftPadding'                => [
							'type' => 'number',
						],
						'rightPadding'               => [
							'type' => 'number',
						],
						'topPadding'                 => [
							'type' => 'number',
						],
						'bottomPadding'              => [
							'type' => 'number',
						],
						'leftPaddingTablet'          => [
							'type' => 'number',
						],
						'rightPaddingTablet'         => [
							'type' => 'number',
						],
						'topPaddingTablet'           => [
							'type' => 'number',
						],
						'bottomPaddingTablet'        => [
							'type' => 'number',
						],
						'leftPaddingMobile'          => [
							'type' => 'number',
						],
						'rightPaddingMobile'         => [
							'type' => 'number',
						],
						'topPaddingMobile'           => [
							'type' => 'number',
						],
						'bottomPaddingMobile'        => [
							'type' => 'number',
						],
						'paddingUnit'                => [
							'type'    => 'string',
							'default' => 'px',
						],
						'mobilePaddingUnit'          => [
							'type'    => 'string',
							'default' => 'px',
						],
						'tabletPaddingUnit'          => [
							'type'    => 'string',
							'default' => 'px',
						],
						'paddingLink'                => [
							'type'    => 'boolean',
							'default' => false,
						],
						'headTransform'              => [
							'type' => 'string',
						],
						'authorTransform'            => [
							'type' => 'string',
						],
						'subHeadTransform'           => [
							'type' => 'string',
						],
						'dateTransform'              => [
							'type' => 'string',
						],
						'ctaTransform'               => [
							'type' => 'string',
						],
						'headDecoration'             => [
							'type' => 'string',
						],
						'authorDecoration'           => [
							'type' => 'string',
						],
						'subHeadDecoration'          => [
							'type' => 'string',
						],
						'dateDecoration'             => [
							'type' => 'string',
						],
						'ctaDecoration'              => [
							'type' => 'string',
						],
						'isPreview'                  => [
							'type'    => 'boolean',
							'default' => false,
						],
						'headLetterSpacing'          => [
							'type'    => 'number',
							'default' => '',
						],
						'headLetterSpacingType'      => [
							'type'    => 'string',
							'default' => 'px',
						],
						'headLetterSpacingMobile'    => [
							'type' => 'number',
						],
						'headLetterSpacingTablet'    => [
							'type' => 'number',
						],
						'subHeadLetterSpacing'       => [
							'type'    => 'number',
							'default' => '',
						],
						'subHeadLetterSpacingType'   => [
							'type'    => 'string',
							'default' => 'px',
						],
						'subHeadLetterSpacingMobile' => [
							'type' => 'number',
						],
						'subHeadLetterSpacingTablet' => [
							'type' => 'number',
						],
						'ctaLetterSpacing'           => [
							'type'    => 'number',
							'default' => '',
						],
						'ctaLetterSpacingType'       => [
							'type'    => 'string',
							'default' => 'px',
						],
						'ctaLetterSpacingMobile'     => [
							'type' => 'number',
						],
						'ctaLetterSpacingTablet'     => [
							'type' => 'number',
						],
						'dateLetterSpacing'          => [
							'type'    => 'number',
							'default' => '',
						],
						'dateLetterSpacingType'      => [
							'type'    => 'string',
							'default' => 'px',
						],
						'dateLetterSpacingMobile'    => [
							'type' => 'number',
						],
						'dateLetterSpacingTablet'    => [
							'type' => 'number',
						],
						'authorLetterSpacing'        => [
							'type'    => 'number',
							'default' => '',
						],
						'authorLetterSpacingType'    => [
							'type'    => 'string',
							'default' => 'px',
						],
						'authorLetterSpacingMobile'  => [
							'type' => 'number',
						],
						'authorLetterSpacingTablet'  => [
							'type' => 'number',
						],
					],
					'renderCallback' => [ $this, 'postTimelineCallback' ],
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
		public function postTimelineCallback( $attributes ) {

			$attributes['post_type'] = 'timeline';

			$recentPosts = \Vexaltrix\Support\Helper::getQuery( $attributes, 'timeline' );
			$blockId     = 'vxt-block-' . $attributes['block_id'];

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

			$outerClass = 'vxt-timeline__outer-wrap';

			$mainClasses = [
				'wp-block-vxt-post-timeline',
				$outerClass,
				$blockId,
				$desktopClass,
				$tabClass,
				$mobClass,
				$zindexExtentionEnabled ? 'uag-blocks-common-selector' : '',
			];

			ob_start();
			?>
			<div class = "
			<?php
			echo esc_attr( implode( ' ', $mainClasses ) );
			echo esc_html( $this->getClasses( $attributes ) );
			?>
			<?php
			echo esc_html( $this->getClasses( $attributes ) );
			?>
			"
			style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>" >
				<?php
				if ( empty( $recentPosts ) ) {
					esc_html_e( 'No posts found', 'vexaltrix' );
				} else {
					$this->getPostHtml( $attributes, $recentPosts );
				}
				?>
				<div class = "vxt-timeline__line" >
					<div class = "vxt-timeline__line__inner"></div>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Renders the post timeline block on server.
		 *
		 * @param array  $attributes Array of block attributes.
		 *
		 * @param object $query WP_Query object.
		 * @since 0.0.1
		 */
		public function getPostHtml( $attributes, $query ) {
			?>
				<?php
				$index = 0;
				while ( $query->have_posts() ) {
					$query->the_post();
					global $post;
					$this->renderSingle( $attributes, $index, $post );
					$index++;
				}
				wp_reset_postdata();
				?>
			<?php
		}

		/**
		 * Renders the post timeline single block.
		 *
		 * @param array  $attributes Array of block attributes.
		 * @param int    $index Index value of current post.
		 * @param object $post Current Post object.
		 *
		 * @since 0.0.1
		 */
		public function renderSingle( $attributes, $index, $post ) {

			$displayInnerDate  = ( 'center' === $attributes['timelinAlignment'] ) ? true : false;
			$contentAlignClass = $this->getAlignClasses( $attributes, $index );
			$dayAlignClass     = $this->getDayAlignClasses( $attributes, $index );

			?>
			<article class = "vxt-timeline__field <?php echo esc_html( $contentAlignClass ); ?>">
					<?php $this->getIcon( $attributes ); ?>
					<div class = "<?php echo esc_html( $dayAlignClass ); ?> vxt-timeline__events-inner-new" >
						<div class="vxt-timeline__events-inner--content">
								<?php $this->getDate( $attributes, 'vxt-timeline__date-hide vxt-timeline__inner-date-new' ); ?>
							<?php ( $attributes['displayPostImage'] ) ? $this->getImage( $attributes ) : ''; ?>
								<?php
									$this->getTitle( $attributes );
									$this->getAuthor( $attributes, $post->post_author );
									$this->getExcerpt( $attributes );
									$this->getCta( $attributes );
								?>
								<div class = "vxt-timeline__arrow"></div>
						</div>
					</div>
					<?php if ( $displayInnerDate ) { ?>
						<?php $this->getDate( $attributes, 'vxt-timeline__date-new' ); ?>
					<?php } ?>
			</article>
			<?php
		}

		/**
		 * Function Name: get_icon.
		 *
		 * @param  array $attributes attribute array.
		 */
		public function getIcon( $attributes ) {
			?>
			<div class = "vxt-timeline__marker vxt-timeline__out-view-icon" >
				<span class = "vxt-timeline__icon-new vxt-timeline__out-view-icon" ><?php \Vexaltrix\Support\Helper::renderSvgHtml( $attributes['icon'] ); ?></span>
			</div>
			<?php
		}

		/**
		 * Function Name: get_image.
		 *
		 * @param  array $attributes attribute array.
		 */
		public function getImage( $attributes ) {

			if ( ! get_the_post_thumbnail_url() ) {
				return;
			}

			$target = ( isset( $attributes['linkTarget'] ) && ( true === $attributes['linkTarget'] ) ) ? '_blank' : '_self';
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_featured_image_{$attributes['post_type']}", get_the_ID(), $attributes );
			?>
				<a class='vxt-timeline__image' href="<?php echo esc_url( apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_link_{$attributes['post_type']}", get_the_permalink(), get_the_ID(), $attributes ) ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="noopener noreferrer"><?php echo wp_get_attachment_image( get_post_thumbnail_id(), $attributes['imageSize'] ); ?>
				</a>
			<?php
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_featured_image_{$attributes['post_type']}", get_the_ID(), $attributes );
		}

		/**
		 * Function Name: get_date.
		 *
		 * @param  array  $attributes attribute array.
		 * @param  string $classname attribute string.
		 */
		public function getDate( $attributes, $classname ) {

			global $post;
			$postId = $post->ID;
			?>
			<div datetime="<?php echo esc_attr( get_the_date( 'c', $postId ) ); ?>" class="<?php echo esc_attr( $classname ); ?>">
				<?php
				if ( isset( $attributes['displayPostDate'] ) && $attributes['displayPostDate'] ) {
					echo esc_html( get_the_date( $attributes['dateFormat'], $postId ) );
				}
				?>
			</div>
			<?php
		}

		/**
		 * Function Name: get_title.
		 *
		 * @param  array $attributes attribute array.
		 */
		public function getTitle( $attributes ) {

			$target = ( isset( $attributes['linkTarget'] ) && ( true === $attributes['linkTarget'] ) ) ? '_blank' : '_self';

			$arrayOfAllowedHTML = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'p' ];
			$tag                   = \Vexaltrix\Support\Helper::titleTagAllowedHtml( $attributes['headingTag'], $arrayOfAllowedHTML, 'h3' );
			global $post;
			?>
				<?php do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_title_{$attributes['post_type']}", get_the_ID(), $attributes ); ?>
				<<?php echo esc_html( $tag ); ?> class="vxt-timeline__heading" >
					<a href="<?php echo esc_url( apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_link_{$attributes['post_type']}", get_the_permalink(), get_the_ID(), $attributes ) ); ?>" target="<?php echo esc_attr( $target ); ?>" rel="noopener noreferrer"><?php the_title(); ?></a>
				</<?php echo esc_html( $tag ); ?>>
				<?php do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_title_{$attributes['post_type']}", get_the_ID(), $attributes ); ?>
			<?php
		}

		/**
		 * Function Name: get_cta.
		 *
		 * @param  array $attributes attribute array.
		 */
		public function getCta( $attributes ) {

			$inheritAstraSecondary = $attributes['inheritFromTheme'] && 'secondary' === $attributes['buttonType'];
			$buttonTypeClass       = $inheritAstraSecondary ? 'ast-outline-button' : 'wp-block-button__link';

			// Initialize an empty string for border style.
			$borderStyle  = $inheritAstraSecondary ? 'border-width: revert-layer;' : '';
			$ctaBtnClass = "vxt-timeline__link $buttonTypeClass";

			if ( ! $attributes['displayPostLink'] ) {
				return;
			}
			$target = ( isset( $attributes['linkTarget'] ) && ( true === $attributes['linkTarget'] ) ) ? '_blank' : '_self';
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_cta_{$attributes['post_type']}", get_the_ID(), $attributes );
			?>
			<div class="vxt-timeline__link_parent wp-block-button">
				<a class="<?php echo esc_attr( $ctaBtnClass ); ?>" style="<?php echo esc_attr( $borderStyle ); ?>" href="<?php echo esc_url( apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_link_{$attributes['post_type']}", get_the_permalink(), get_the_ID(), $attributes ) ); ?>" target="<?php echo esc_attr( $target ); ?>" rel=" noopener noreferrer"><?php echo wp_kses_post( $attributes['readMoreText'] ); ?></a>
			</div>
			<?php
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_cta_{$attributes['post_type']}", get_the_ID(), $attributes );
		}

		/**
		 * Function get_author.
		 *
		 * @param  array $attributes attribute.
		 * @param  array $author attribute.
		 */
		public function getAuthor( $attributes, $author ) {

			$output = '';
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_meta_{$attributes['post_type']}", get_the_ID(), $attributes );
			if ( isset( $attributes['displayPostAuthor'] ) && $attributes['displayPostAuthor'] ) {
				?>
				<span class="dashicons-admin-users dashicons"></span>
				<a class="vxt-timeline__author-link" href="<?php echo esc_url( get_author_posts_url( $author ) ); ?>"><?php echo esc_html( get_the_author_meta( 'display_name', $author ) ); ?></a>
				<?php
			}
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_meta_{$attributes['post_type']}", get_the_ID(), $attributes );
		}

		/**
		 * Function get_excerpt.
		 *
		 * @param  array $attributes attribute.
		 */
		public function getExcerpt( $attributes ) {

			if ( ! $attributes['displayPostExcerpt'] ) {
				return;
			}

			global $post;

			if ( post_password_required( $post ) ) {
				?>
				<div class="vxt-timeline-desc-content">
					<?php echo esc_html__( 'There is no excerpt because this is a protected post.', 'vexaltrix' ); ?>
				</div>
				<?php
				return;
			}

			$excerptLengthFallback = \Vexaltrix\Core\Blocks\BlockHelper::getFallbackNumber( $attributes['exerptLength'], 'exerptLength', $attributes['blockName'] );

			$excerpt = \Vexaltrix\Support\Helper::vxtUltimateGutenbergBlocksGetExcerpt( $post->ID, $post->post_content, $excerptLengthFallback );

			$excerpt = apply_filters( "vxt_ultimate_gutenberg_blocks_single_post_excerpt_{$attributes['post_type']}", $excerpt, get_the_ID(), $attributes );
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_before_excerpt_{$attributes['post_type']}", get_the_ID(), $attributes );
			?>
			<div class="vxt-timeline-desc-content">
				<?php echo wp_kses_post( $excerpt ); ?>
			</div>
			<?php
			do_action( "vxt_ultimate_gutenberg_blocks_single_post_after_excerpt_{$attributes['post_type']}", get_the_ID(), $attributes );
		}

		/**
		 * Function Name: get_classes .
		 *
		 * @param  array $attributes array of setting.
		 * @return string             class name.
		 */
		public function getClasses( $attributes ) {

			// Arrow position.
			$classes = [];
			if ( isset( $attributes['arrowlinAlignment'] ) && '' !== $attributes['arrowlinAlignment'] ) {
				$classes[] = 'vxt-timeline__arrow-' . $attributes['arrowlinAlignment'];
			}
			// Alignmnet.
			if ( isset( $attributes['timelinAlignment'] ) && '' !== $attributes['timelinAlignment'] ) {
				$classes[] = 'vxt-timeline__' . $attributes['timelinAlignment'] . '-block';
			}

			if ( isset( $attributes['displayPostLink'] ) && '' !== $attributes['displayPostLink'] ) {
				$classes[] = 'vxt_ultimate_gutenberg_blocks_timeline__cta-enable';
			}

			$classes[] = 'vxt-timeline';
			$classes[] = 'vxt-timeline__content-wrap';

			return implode( ' ', $classes );
		}

		/**
		 * Function Name: get_align_classes description.
		 *
		 * @param array  $attributes attribute array.
		 * @param string $indexVal  post index.
		 * @return string            output HTML/String.
		 */
		public function getAlignClasses( $attributes, $indexVal ) {

			$classes   = [];
			$classes[] = '';
			if ( isset( $attributes['timelinAlignment'] ) && '' !== $attributes['timelinAlignment'] ) {
				if ( 'center' !== $attributes['timelinAlignment'] ) {
					$classes[] = 'vxt-timeline__' . $attributes['timelinAlignment'];
				} else {
					$classes[] = ( 0 === $indexVal % 2 ) ? 'vxt-timeline__right' : 'vxt-timeline__left';
				}
			}

			return implode( ' ', $classes );
		}

		/**
		 * Function Name: get_day_align_classes description.
		 *
		 * @param array  $attributes attribute array.
		 * @param string $indexVal  post index.
		 * @return string            output HTML/String.
		 */
		public function getDayAlignClasses( $attributes, $indexVal ) {

			$classes   = [];
			$classes[] = 'vxt-timeline__day-new';
			if ( isset( $attributes['timelinAlignment'] ) && '' !== $attributes['timelinAlignment'] ) {
				if ( 'center' === $attributes['timelinAlignment'] ) {
					$classes[] = ( 0 === $indexVal % 2 ) ? 'vxt-timeline__day-right' : 'vxt-timeline__day-left';
				} else {
					$classes[] = 'vxt-timeline__day-' . $attributes['timelinAlignment'];
				}
			}

			return implode( ' ', $classes );
		}

	}

	/**
	 *  Prepare if class 'Vexaltrix\\BlocksConfig\\PostTimeline\\PostTimeline' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
