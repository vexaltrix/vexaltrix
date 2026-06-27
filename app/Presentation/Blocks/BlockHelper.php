<?php
/**
 * Vexaltrix Block Helper.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\Blocks\\BlockHelper' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\Blocks\BlockHelper.
	 */
	class BlockHelper {

		/**
		 * Get Buttons Block CSS
		 *
		 * @since 1.14.9
		 * @param array  $attr The block attributes.
		 * @param string $id The key for the Icon List Item.
		 * @param string $childMigrate The child migration flag.
		 * @return array The Widget List.
		 */
		public static function getButtonsChildSelectors( $attr, $id, $childMigrate ) {

			$blockName = 'buttons-child';

			$wrapper = ( ! $childMigrate ) ? ' .vxt-buttons-repeater-' . $id : ' .vxt-buttons-repeater';

			$mSelectors = [];
			$tSelectors = [];
			$selectors   = [];

			$borderCss        = self::uagGenerateBorderCss( $attr, 'btn' );
			$borderCss        = self::uagGenerateDeprecatedBorderCss(
				$borderCss,
				( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
				( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
				( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
				( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
			);
			$borderCssTablet = self::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
			$borderCssMobile = self::uagGenerateBorderCss( $attr, 'btn', 'mobile' );

			$topPadding    = isset( $attr['topPadding'] ) ? $attr['topPadding'] : '';
			$bottomPadding = isset( $attr['bottomPadding'] ) ? $attr['bottomPadding'] : '';
			$leftPadding   = isset( $attr['leftPadding'] ) ? $attr['leftPadding'] : '';
			$rightPadding  = isset( $attr['rightPadding'] ) ? $attr['rightPadding'] : '';

			$attr['sizeType']       = isset( $attr['sizeType'] ) ? $attr['sizeType'] : 'px';
			$attr['lineHeightType'] = isset( $attr['lineHeightType'] ) ? $attr['lineHeightType'] : 'em';

			$boxShadowProperties       = [
				'horizontal' => $attr['boxShadowHOffset'],
				'vertical'   => $attr['boxShadowVOffset'],
				'blur'       => $attr['boxShadowBlur'],
				'spread'     => $attr['boxShadowSpread'],
				'color'      => $attr['boxShadowColor'],
				'position'   => $attr['boxShadowPosition'],
			];
			$boxShadowHoverProperties = [
				'horizontal' => $attr['boxShadowHOffsetHover'],
				'vertical'   => $attr['boxShadowVOffsetHover'],
				'blur'       => $attr['boxShadowBlurHover'],
				'spread'     => $attr['boxShadowSpreadHover'],
				'color'      => $attr['boxShadowColorHover'],
				'position'   => $attr['boxShadowPositionHover'],
				'alt_color'  => $attr['boxShadowColor'],
			];

			$boxShadowCss       = self::generateShadowCss( $boxShadowProperties );
			$boxShadowHoverCss = self::generateShadowCss( $boxShadowHoverProperties );

			if ( ! $attr['inheritFromTheme'] ) {
				if ( 'transparent' === $attr['backgroundType'] ) {

					$selectors[' .wp-block-button__link']['background'] = 'transparent';

				} elseif ( 'color' === $attr['backgroundType'] ) {

					$selectors['.wp-block-vxt-buttons-child .vxt-buttons-repeater']['background'] = $attr['background'];
					$selectors[' .wp-block-button__link']['background']                             = $attr['background'];

				} elseif ( 'gradient' === $attr['backgroundType'] ) {
					$bgObj = [
						'backgroundType'    => 'gradient',
						'gradientValue'     => $attr['gradientValue'],
						'gradientColor1'    => $attr['gradientColor1'],
						'gradientColor2'    => $attr['gradientColor2'],
						'gradientType'      => $attr['gradientType'],
						'gradientLocation1' => $attr['gradientLocation1'],
						'gradientLocation2' => $attr['gradientLocation2'],
						'gradientAngle'     => $attr['gradientAngle'],
						'selectGradient'    => $attr['selectGradient'],
					];

					$bgObjTablet = [
						'backgroundType'    => 'gradient',
						'gradientValue'     => $attr['gradientValue'],
						'gradientColor1'    => $attr['gradientColor1'],
						'gradientColor2'    => $attr['gradientColor2'],
						'gradientType'      => $attr['gradientType'],
						'gradientLocation1' => is_numeric( $attr['gradientLocationTablet1'] ) ? $attr['gradientLocationTablet1'] : $bgObj['gradientLocation1'],
						'gradientLocation2' => is_numeric( $attr['gradientLocationTablet2'] ) ? $attr['gradientLocationTablet2'] : $bgObj['gradientLocation2'],
						'gradientAngle'     => is_numeric( $attr['gradientAngleTablet'] ) ? $attr['gradientAngleTablet'] : $bgObj['gradientAngle'],
						'selectGradient'    => $attr['selectGradient'],
					];

					$bgObjMobile = [
						'backgroundType'    => 'gradient',
						'gradientValue'     => $attr['gradientValue'],
						'gradientColor1'    => $attr['gradientColor1'],
						'gradientColor2'    => $attr['gradientColor2'],
						'gradientType'      => $attr['gradientType'],
						'gradientLocation1' => is_numeric( $attr['gradientLocationMobile1'] ) ? $attr['gradientLocationMobile1'] : $bgObjTablet['gradientLocation1'],
						'gradientLocation2' => is_numeric( $attr['gradientLocationMobile2'] ) ? $attr['gradientLocationMobile2'] : $bgObjTablet['gradientLocation2'],
						'gradientAngle'     => is_numeric( $attr['gradientAngleMobile'] ) ? $attr['gradientAngleMobile'] : $bgObjTablet['gradientAngle'],
						'selectGradient'    => $attr['selectGradient'],
					];

					$btnBgCss                             = self::uagGetBackgroundObj( $bgObj );
					$btnBgTabletCss                      = self::uagGetBackgroundObj( $bgObjTablet );
					$btnBgMobileCss                      = self::uagGetBackgroundObj( $bgObjMobile );
					$selectors[' .wp-block-button__link']   = $btnBgCss;
					$tSelectors[' .wp-block-button__link'] = $btnBgTabletCss;
					$mSelectors[' .wp-block-button__link'] = $btnBgMobileCss;
				}

				// Hover background color types.
				if ( 'transparent' === $attr['hoverbackgroundType'] ) {

					$selectors[' .wp-block-button__link:hover'] = [
						'background' => 'transparent',
					];
					$selectors[' .wp-block-button__link:focus'] = [
						'background' => 'transparent',
					];

				} elseif ( 'color' === $attr['hoverbackgroundType'] ) {

					$selectors[' .wp-block-button__link:hover'] = [
						'background' => $attr['hBackground'],
					];
					$selectors[' .wp-block-button__link:focus'] = [
						'background' => $attr['hBackground'],
					];

				} elseif ( 'gradient' === $attr['hoverbackgroundType'] ) {
					$bgHoverObj = [
						'backgroundType'    => 'gradient',
						'gradientValue'     => $attr['hovergradientValue'],
						'gradientColor1'    => $attr['hovergradientColor1'],
						'gradientColor2'    => $attr['hovergradientColor2'],
						'gradientType'      => $attr['hovergradientType'],
						'gradientLocation1' => $attr['hovergradientLocation1'],
						'gradientLocation2' => $attr['hovergradientLocation2'],
						'gradientAngle'     => $attr['hovergradientAngle'],
						'selectGradient'    => $attr['hoverselectGradient'],
					];

					$bgHoverObjTablet = [
						'backgroundType'    => 'gradient',
						'gradientValue'     => $attr['hovergradientValue'],
						'gradientColor1'    => $attr['hovergradientColor1'],
						'gradientColor2'    => $attr['hovergradientColor2'],
						'gradientType'      => $attr['hovergradientType'],
						'gradientLocation1' => is_numeric( $attr['hovergradientLocationTablet1'] ) ? $attr['hovergradientLocationTablet1'] : $bgHoverObj['gradientLocation1'],
						'gradientLocation2' => is_numeric( $attr['hovergradientLocationTablet2'] ) ? $attr['hovergradientLocationTablet2'] : $bgHoverObj['gradientLocation2'],
						'gradientAngle'     => is_numeric( $attr['hovergradientAngleTablet'] ) ? $attr['hovergradientAngleTablet'] : $bgHoverObj['gradientAngle'],
						'selectGradient'    => $attr['hoverselectGradient'],
					];

					$bgHoverObjMobile = [
						'backgroundType'    => 'gradient',
						'gradientValue'     => $attr['hovergradientValue'],
						'gradientColor1'    => $attr['hovergradientColor1'],
						'gradientColor2'    => $attr['hovergradientColor2'],
						'gradientType'      => $attr['hovergradientType'],
						'gradientLocation1' => is_numeric( $attr['hovergradientLocationMobile1'] ) ? $attr['hovergradientLocationMobile1'] : $bgHoverObjTablet['gradientLocation1'],
						'gradientLocation2' => is_numeric( $attr['hovergradientLocationMobile2'] ) ? $attr['hovergradientLocationMobile2'] : $bgHoverObjTablet['gradientLocation2'],
						'gradientAngle'     => is_numeric( $attr['hovergradientAngleMobile'] ) ? $attr['hovergradientAngleMobile'] : $bgHoverObjTablet['gradientAngle'],
						'selectGradient'    => $attr['hoverselectGradient'],
					];

					$btnHoverBgCss                             = self::uagGetBackgroundObj( $bgHoverObj );
					$btnHoverBgCssTablet                      = self::uagGetBackgroundObj( $bgHoverObjTablet );
					$btnHoverBgCssMobile                      = self::uagGetBackgroundObj( $bgHoverObjMobile );
					$selectors[' .wp-block-button__link:hover']   = $btnHoverBgCss;
					$selectors[' .wp-block-button__link:focus']   = $btnHoverBgCss;
					$tSelectors[' .wp-block-button__link:hover'] = $btnHoverBgCssTablet;
					$tSelectors[' .wp-block-button__link:focus'] = $btnHoverBgCssTablet;
					$mSelectors[' .wp-block-button__link:hover'] = $btnHoverBgCssMobile;
					$mSelectors[' .wp-block-button__link:focus'] = $btnHoverBgCssMobile;
				}

				$selectors[' .vxt-button__wrapper .vxt-buttons-repeater']                   = [
					'font-family'     => $attr['fontFamily'],
					'font-weight'     => $attr['fontWeight'],
					'font-style'      => $attr['fontStyle'],
					'text-transform'  => $attr['transform'],
					'text-decoration' => $attr['decoration'],
					'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['size'], $attr['sizeType'] ),
					'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeight'], $attr['lineHeightType'] ),
					'padding-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $topPadding, $attr['paddingUnit'] ),
					'padding-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPadding, $attr['paddingUnit'] ),
					'padding-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPadding, $attr['paddingUnit'] ),
					'padding-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPadding, $attr['paddingUnit'] ),
					'color'           => $attr['color'],
					'margin-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMargin'], $attr['marginType'] ),
					'margin-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMargin'], $attr['marginType'] ),
					'margin-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMargin'], $attr['marginType'] ),
					'margin-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMargin'], $attr['marginType'] ),
				];
				$selectors[' .wp-block-button__link.has-text-color:hover .vxt-button__link'] = [
					'color' => $attr['hColor'],
				];
				$selectors[' .wp-block-button__link.has-text-color:focus .vxt-button__link'] = [
					'color' => $attr['hColor'],
				];

				$selectors[ ' .vxt-button__wrapper ' . $wrapper . '.wp-block-button__link' ] = [
					'box-shadow' => $boxShadowCss,
				];

				// If using separate box shadow hover settings, then generate CSS for it.
				if ( $attr['useSeparateBoxShadows'] ) {
					$selectors[ ' .vxt-button__wrapper ' . $wrapper . '.wp-block-button__link:hover' ] = [
						'box-shadow' => $boxShadowHoverCss,
					];

				};
				$selectors[ $wrapper . '.wp-block-button__link' ]       = $borderCss;
				$selectors[ $wrapper . '.wp-block-button__link:hover' ] = [
					'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['borderHColor'],
				];
				$selectors[ $wrapper . '.wp-block-button__link:focus' ] = [
					'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['borderHColor'],
				];
				// twenty twenty theme.
				$selectors['.wp-block-button.is-style-outline .vxt-button__wrapper .wp-block-button__link.vxt-buttons-repeater']       = $borderCss;
				$mSelectors['.wp-block-button.is-style-outline .vxt-button__wrapper .wp-block-button__link.vxt-buttons-repeater']     = $borderCssMobile;
				$tSelectors['.wp-block-button.is-style-outline .vxt-button__wrapper .wp-block-button__link.vxt-buttons-repeater']     = $borderCssTablet;
				$selectors['.wp-block-button.is-style-outline .vxt-button__wrapper .wp-block-button__link.vxt-buttons-repeater:hover'] = [
					'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['borderHColor'],
				];
				$selectors[ $wrapper . ' .vxt-button__link' ]       = [
					'color'           => $attr['color'],
					'font-family'     => $attr['fontFamily'],
					'font-weight'     => $attr['fontWeight'],
					'font-style'      => $attr['fontStyle'],
					'text-transform'  => $attr['transform'],
					'text-decoration' => $attr['decoration'],
					'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['size'], $attr['sizeType'] ),
					'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeight'], $attr['lineHeightType'] ),
				];
				$selectors[ $wrapper . ':hover .vxt-button__link' ] = [
					'color' => $attr['hColor'],
				];
				$selectors[ $wrapper . ':focus .vxt-button__link' ] = [
					'color' => $attr['hColor'],
				];
				$mSelectors[ $wrapper . ' .vxt-button__link' ]     = [
					'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['sizeMobile'], $attr['sizeType'] ),
					'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeightMobile'], $attr['lineHeightType'] ),
				];
				$tSelectors[ $wrapper . ' .vxt-button__link' ]     = [
					'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['sizeTablet'], $attr['sizeType'] ),
					'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeightTablet'], $attr['lineHeightType'] ),
				];
				$mSelectors[ $wrapper . '.wp-block-button__link' ]  = array_merge(
					[
						'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMobilePadding'], $attr['mobilePaddingUnit'] ),
						'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMobilePadding'], $attr['mobilePaddingUnit'] ),
						'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMobilePadding'], $attr['mobilePaddingUnit'] ),
						'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMobilePadding'], $attr['mobilePaddingUnit'] ),
						'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginMobile'], $attr['marginType'] ),
						'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginMobile'], $attr['marginType'] ),
						'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginMobile'], $attr['marginType'] ),
						'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginMobile'], $attr['marginType'] ),
					],
					$borderCssMobile
				);

				$tSelectors[ $wrapper . '.wp-block-button__link' ] = array_merge(
					[
						'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topTabletPadding'], $attr['tabletPaddingUnit'] ),
						'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomTabletPadding'], $attr['tabletPaddingUnit'] ),
						'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftTabletPadding'], $attr['tabletPaddingUnit'] ),
						'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightTabletPadding'], $attr['tabletPaddingUnit'] ),
						'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginTablet'], $attr['marginType'] ),
						'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginTablet'], $attr['marginType'] ),
						'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginTablet'], $attr['marginType'] ),
						'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginTablet'], $attr['marginType'] ),

					],
					$borderCssTablet
				);
			}
			$selectors[ ' .vxt-button__wrapper ' . $wrapper . '.wp-block-button__link' ] = [
				'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMargin'], $attr['marginType'] ),
				'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMargin'], $attr['marginType'] ),
				'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMargin'], $attr['marginType'] ),
				'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMargin'], $attr['marginType'] ),
				'box-shadow'    => $boxShadowCss,
			];
			
			$mSelectors[ ' .vxt-button__wrapper ' . $wrapper . '.wp-block-button__link' ] = [
				'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginMobile'], $attr['marginType'] ),
				'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginMobile'], $attr['marginType'] ),
				'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginMobile'], $attr['marginType'] ),
				'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginMobile'], $attr['marginType'] ),

			];

			$tSelectors[ ' .vxt-button__wrapper ' . $wrapper . '.wp-block-button__link' ] = [
				'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginTablet'], $attr['marginType'] ),
				'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginTablet'], $attr['marginType'] ),
				'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginTablet'], $attr['marginType'] ),
				'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginTablet'], $attr['marginType'] ),

			];
			$selectors[ $wrapper . ' .vxt-button__icon > svg' ]       = [
				'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( self::getFallbackNumber( $attr['iconSize'], 'iconSize', $blockName ), 'px' ),
				'height' => \Vexaltrix\Core\Support\Helper::getCssValue( self::getFallbackNumber( $attr['iconSize'], 'iconSize', $blockName ), 'px' ),
				'fill'   => ! empty( $attr['iconColor'] ) ? $attr['iconColor'] : $attr['color'],
			];
			$tSelectors[ $wrapper . ' .vxt-button__icon > svg' ]     = [
				'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTablet'], 'px' ),
				'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTablet'], 'px' ),
				'fill'   => $attr['iconColor'],
			];
			$mSelectors[ $wrapper . ' .vxt-button__icon > svg' ]     = [
				'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMobile'], 'px' ),
				'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMobile'], 'px' ),
				'fill'   => $attr['iconColor'],
			];
			$selectors[ $wrapper . ':hover .vxt-button__icon > svg' ] = [
				'fill' => ! empty( $attr['iconHColor'] ) ? $attr['iconHColor'] : $attr['hColor'],
			];
			$selectors[ $wrapper . ':focus .vxt-button__icon > svg' ] = [
				'fill' => ! empty( $attr['iconHColor'] ) ? $attr['iconHColor'] : $attr['hColor'],
			];
			if ( ! $attr['removeText'] ) {
				$iconMargin        = \Vexaltrix\Core\Support\Helper::getCssValue( self::getFallbackNumber( $attr['iconSpace'], 'iconSpace', $blockName ), 'px' );
				$tabletIconMargin = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpaceTablet'], 'px' );
				$mobileIconMargin = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpaceMobile'], 'px' );

				$rightSideMargin = 'margin-right';
				$leftSideMargin  = 'margin-left';

				if ( ! is_rtl() ) {
					$rightSideMargin = 'margin-left';
					$leftSideMargin  = 'margin-right';
				}

				$selectors[ $wrapper . ' .vxt-button__icon-position-after' ]   = [
					$rightSideMargin => $iconMargin,
				];
				$tSelectors[ $wrapper . ' .vxt-button__icon-position-after' ] = [
					$rightSideMargin => $tabletIconMargin,
				];
				$mSelectors[ $wrapper . ' .vxt-button__icon-position-after' ] = [
					$rightSideMargin => $mobileIconMargin,
				];

				$selectors[ $wrapper . ' .vxt-button__icon-position-before' ]   = [
					$leftSideMargin => $iconMargin,
				];
				$tSelectors[ $wrapper . ' .vxt-button__icon-position-before' ] = [
					$leftSideMargin => $tabletIconMargin,
				];
				$mSelectors[ $wrapper . ' .vxt-button__icon-position-before' ] = [
					$leftSideMargin => $mobileIconMargin,
				];
			}

			return [
				'selectors'   => $selectors,
				'm_selectors' => $mSelectors,
				't_selectors' => $tSelectors,
			];
		}

		/**
		 * Get Social share Block CSS
		 *
		 * @since 1.14.9
		 * @param array  $attr The block attributes.
		 * @param string $id The key for the Icon List Item.
		 * @param mixed  $childMigrate The child migration flag.
		 * @return array The Widget List.
		 */
		public static function getSocialShareChildSelectors( $attr, $id, $childMigrate ) {

			$wrapper = ( ! $childMigrate ) ? ' .vxt-ss-repeater-' . $id : '.vxt-ss-repeater';

			$selectors[ $wrapper . ' span.vxt-ss__link' ]           = [
				'color' => $attr['icon_color'],
			];
			$selectors[ $wrapper . ' a.vxt-ss__link' ]              = [ // Backward user case.
				'color' => $attr['icon_color'],
			];
			$selectors[ $wrapper . ' span.vxt-ss__link' ]           = [
				'color' => $attr['icon_color'],
			];
			$selectors[ $wrapper . ' a.vxt-ss__link' ]              = [ // Backward user case.
				'color' => $attr['icon_color'],
			];
			$selectors[ $wrapper . ' span.vxt-ss__link svg' ]       = [
				'fill' => $attr['icon_color'],
			];
			$selectors[ $wrapper . ' a.vxt-ss__link svg' ]          = [ // Backward user case.
				'fill' => $attr['icon_color'],
			];
			$selectors[ $wrapper . ':hover span.vxt-ss__link' ]     = [
				'color' => $attr['icon_hover_color'],
			];
			$selectors[ $wrapper . ':hover a.vxt-ss__link' ]        = [ // Backward user case.
				'color' => $attr['icon_hover_color'],
			];
			$selectors[ $wrapper . ':hover span.vxt-ss__link svg' ] = [
				'fill' => $attr['icon_hover_color'],
			];
			$selectors[ $wrapper . ':hover a.vxt-ss__link svg' ]    = [ // Backward user case.
				'fill' => $attr['icon_hover_color'],
			];

			$selectors[ $wrapper . '.vxt-ss__wrapper' ]       = [
				'background' => $attr['icon_bg_color'],
			];
			$selectors[ $wrapper . '.vxt-ss__wrapper:hover' ] = [
				'background' => $attr['icon_bg_hover_color'],
			];

			return $selectors;
		}

		/**
		 * Get Icon List Block CSS
		 *
		 * @since 1.14.9
		 * @param array  $attr The block attributes.
		 * @param string $id The key for the Icon List Item.
		 * @param string $childMigrate The child migration flag.
		 * @return array The Widget List.
		 */
		public static function getIconListChildSelectors( $attr, $id, $childMigrate ) {

			$wrapper = ( ! $childMigrate ) ? ' .vxt-icon-list-repeater-' . $id : '.wp-block-vxt-icon-list-child';

			if ( ! empty( $attr['icon_color'] ) ) {
				$selectors[ $wrapper . ' .vxt-icon-list__source-wrap svg' ] = [
					'fill'  => $attr['icon_color'] . ' !important',
					'color' => $attr['icon_color'] . ' !important',
				];
			}
			if ( ! empty( $attr['icon_hover_color'] ) ) {
				$selectors[ $wrapper . ':hover .vxt-icon-list__source-wrap svg' ] = [
					'fill'  => $attr['icon_hover_color'] . ' !important',
					'color' => $attr['icon_hover_color'] . ' !important',
				];
			}
			if ( ! empty( $attr['label_color'] ) ) {
				$selectors[ $wrapper . ' .vxt-icon-list__label' ] = [
					'color' => $attr['label_color'] . ' !important',
				];
			}
			if ( ! empty( $attr['label_hover_color'] ) ) {
				$selectors[ $wrapper . ':hover .vxt-icon-list__label' ] = [
					'color' => $attr['label_hover_color'] . ' !important',
				];
			}

			$selectors[ $wrapper . ' .vxt-icon-list__source-wrap' ]       = [
				'background'   => $attr['icon_bg_color'] . ' !important',
				'border-color' => $attr['icon_border_color'] . ' !important',
			];
			$selectors[ $wrapper . ':hover .vxt-icon-list__source-wrap' ] = [
				'background'   => $attr['icon_bg_hover_color'] . ' !important',
				'border-color' => $attr['icon_border_hover_color'] . ' !important',
			];

			$selectors[ $wrapper . '.wp-block-vxt-icon-list-child.wp-block-vxt-icon-list-child' ] = [
				'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childTopMargin'],
					$attr['childMarginUnit']
				),
				'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childRightMargin'],
					$attr['childMarginUnit']
				),
				'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childBottomMargin'],
					$attr['childMarginUnit']
				),
				'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childLeftMargin'],
					$attr['childMarginUnit']
				),
				'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childTopPadding'],
					$attr['childPaddingUnit']
				),
				'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childRightPadding'],
					$attr['childPaddingUnit']
				),
				'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childBottomPadding'],
					$attr['childPaddingUnit']
				),
				'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childLeftPadding'],
					$attr['childPaddingUnit']
				),
			];

			$tSelectors[ $wrapper . '.wp-block-vxt-icon-list-child.wp-block-vxt-icon-list-child' ] = [
				'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childTopMarginTablet'],
					$attr['childMarginUnitTablet']
				),
				'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childRightMarginTablet'],
					$attr['childMarginUnitTablet']
				),
				'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childBottomMarginTablet'],
					$attr['childMarginUnitTablet']
				),
				'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childLeftMarginTablet'],
					$attr['childMarginUnitTablet']
				),
				'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childTopPaddingTablet'],
					$attr['childPaddingUnitTablet']
				),
				'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childRightPaddingTablet'],
					$attr['childPaddingUnitTablet']
				),
				'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childBottomPaddingTablet'],
					$attr['childPaddingUnitTablet']
				),
				'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childLeftPaddingTablet'],
					$attr['childPaddingUnitTablet']
				),
			];

			$mSelectors[ $wrapper . '.wp-block-vxt-icon-list-child.wp-block-vxt-icon-list-child' ] = [
				'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childTopMarginMobile'],
					$attr['childMarginUnitMobile']
				),
				'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childRightMarginMobile'],
					$attr['childMarginUnitMobile']
				),
				'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childBottomMarginMobile'],
					$attr['childMarginUnitMobile']
				),
				'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childLeftMarginMobile'],
					$attr['childMarginUnitMobile']
				),
				'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childTopPaddingMobile'],
					$attr['childPaddingUnitMobile']
				),
				'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childRightPaddingMobile'],
					$attr['childPaddingUnitMobile']
				),
				'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childBottomPaddingMobile'],
					$attr['childPaddingUnitMobile']
				),
				'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue(
					$attr['childLeftPaddingMobile'],
					$attr['childPaddingUnitMobile']
				),
			];

			return [
				'desktop' => $selectors,
				'tablet'  => $tSelectors,
				'mobile'  => $mSelectors,
			];
		}

		/**
		 * Get Post Block Selectors CSS
		 *
		 * @param array $attr The block attributes.
		 * @since 1.4.0
		 */
		public static function getPostSelectors( $attr ) {

			$overlayOpacityFallback      = self::getFallbackNumber( $attr['overlayOpacity'], 'overlayOpacity', $attr['blockName'] );
			$imageBottomSpaceFallback   = self::getFallbackNumber( $attr['imageBottomSpace'], 'imageBottomSpace', $attr['blockName'] );
			$titleBottomSpaceFallback   = self::getFallbackNumber( $attr['titleBottomSpace'], 'titleBottomSpace', $attr['blockName'] );
			$metaBottomSpaceFallback    = self::getFallbackNumber( $attr['metaBottomSpace'], 'metaBottomSpace', $attr['blockName'] );
			$excerptBottomSpaceFallback = self::getFallbackNumber( $attr['excerptBottomSpace'], 'excerptBottomSpace', $attr['blockName'] );
			$ctaBottomSpaceFallback     = self::getFallbackNumber( $attr['ctaBottomSpace'], 'ctaBottomSpace', $attr['blockName'] );
			$isLeftRight                   = isset( $attr['isLeftToRightLayout'] ) ? $attr['isLeftToRightLayout'] : false;

			$borderCss = self::uagGenerateBorderCss( $attr, 'btn' );
			$borderCss = self::uagGenerateDeprecatedBorderCss(
				$borderCss,
				( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
				( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
				( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
				( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
			);

			$overallBorderCss = self::uagGenerateBorderCss( $attr, 'overall' );

			$paddingTop    = isset( $attr['paddingTop'] ) ? $attr['paddingTop'] : $attr['contentPadding'];
			$paddingBottom = isset( $attr['paddingBottom'] ) ? $attr['paddingBottom'] : $attr['contentPadding'];
			$paddingLeft   = isset( $attr['paddingLeft'] ) ? $attr['paddingLeft'] : $attr['contentPadding'];
			$paddingRight  = isset( $attr['paddingRight'] ) ? $attr['paddingRight'] : $attr['contentPadding'];

			$paddingBtnTop    = isset( $attr['paddingBtnTop'] ) ? $attr['paddingBtnTop'] : $attr['btnVPadding'];
			$paddingBtnBottom = isset( $attr['paddingBtnBottom'] ) ? $attr['paddingBtnBottom'] : $attr['btnVPadding'];
			$paddingBtnLeft   = isset( $attr['paddingBtnLeft'] ) ? $attr['paddingBtnLeft'] : $attr['btnHPadding'];
			$paddingBtnRight  = isset( $attr['paddingBtnRight'] ) ? $attr['paddingBtnRight'] : $attr['btnHPadding'];

			$boxShadowProperties       = [
				'horizontal' => $attr['boxShadowHOffset'],
				'vertical'   => $attr['boxShadowVOffset'],
				'blur'       => $attr['boxShadowBlur'],
				'spread'     => $attr['boxShadowSpread'],
				'color'      => $attr['boxShadowColor'],
				'position'   => $attr['boxShadowPosition'],
			];
			$boxShadowHoverProperties = [
				'horizontal' => $attr['boxShadowHOffsetHover'],
				'vertical'   => $attr['boxShadowVOffsetHover'],
				'blur'       => $attr['boxShadowBlurHover'],
				'spread'     => $attr['boxShadowSpreadHover'],
				'color'      => $attr['boxShadowColorHover'],
				'position'   => $attr['boxShadowPositionHover'],
				'alt_color'  => $attr['boxShadowColor'],
			];

			$boxShadowCss       = self::generateShadowCss( $boxShadowProperties );
			$boxShadowHoverCss = self::generateShadowCss( $boxShadowHoverProperties );

			$columnGapFallback = self::getFallbackNumber( $attr['columnGap'], 'columnGap', $attr['blockName'] );
			$rowGapFallback    = self::getFallbackNumber( $attr['rowGap'], 'rowGap', $attr['blockName'] );

			$selectors = [
				'.is-grid .vxt-post__inner-wrap'         => array_merge(
					[
						'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingTop, $attr['contentPaddingUnit'] ),
						'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottom, $attr['contentPaddingUnit'] ),
						'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingLeft, $attr['contentPaddingUnit'] ),
						'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingRight, $attr['contentPaddingUnit'] ),
						'box-shadow'     => $boxShadowCss,
					],
					$overallBorderCss
				),
				'.is-grid .vxt-post__inner-wrap .vxt-post__image:first-child' => ! $isLeftRight ? [
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $paddingLeft ), $attr['contentPaddingUnit'] ),
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $paddingRight ), $attr['contentPaddingUnit'] ),
					'margin-top'   => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $paddingTop ), $attr['contentPaddingUnit'] ),
				] : [],
				':not(.is-grid) .vxt-post__inner-wrap > .vxt-post__text:last-child' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottom, $attr['contentPaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap > .vxt-post__text:first-child' => [
					'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingTop, $attr['contentPaddingUnit'] ),
				],
				':not(.is-grid).vxt-post__image-position-background .vxt-post__inner-wrap .vxt-post__text:nth-last-child(2) ' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottom, $attr['contentPaddingUnit'] ),
				],
				':not(.wp-block-vxt-post-carousel):not(.is-grid).vxt-post__items' => [
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $rowGapFallback / 2 ), $attr['rowGapUnit'] ),
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $rowGapFallback / 2 ), $attr['rowGapUnit'] ),
				],
				':not(.is-grid).vxt-post__items article' => [
					'padding-right' => \Vexaltrix\Core\Support\Helper::getCssValue( (int) ( $rowGapFallback / 2 ), $attr['rowGapUnit'] ),
					'padding-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( (int) ( $rowGapFallback / 2 ), $attr['rowGapUnit'] ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $columnGapFallback ), $attr['columnGapUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap > .vxt-post__text' => [
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingLeft, $attr['contentPaddingUnit'] ),
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingRight, $attr['contentPaddingUnit'] ),
				],
				' .vxt-post__inner-wrap'                 => [
					'background' => $attr['bgColor'],
					'text-align' => $attr['align'],
				],
				' .vxt-post__inner-wrap:hover'           => [
					'border-color' => $attr['overallBorderHColor'],
				],
				' .vxt-post__inner-wrap .vxt-post__cta' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $ctaBottomSpaceFallback, $attr['ctaBottomSpaceUnit'] ),
				],
				' .vxt-post__image '                     => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $imageBottomSpaceFallback, $attr['imageBottomSpaceUnit'] ),
				],
				' .vxt-post__title'                      => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $titleBottomSpaceFallback, $attr['titleBottomSpaceUnit'] ),
				],
				' .vxt-post-grid-byline'                 => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $metaBottomSpaceFallback, $attr['metaBottomSpaceUnit'] ),
				],
				' .vxt-post__excerpt'                    => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $excerptBottomSpaceFallback, $attr['excerptBottomSpaceUnit'] ),
				],
				' .vxt-post__image:before'               => [
					'background-color' => $attr['bgOverlayColor'],
					'opacity'          => ( (int) $overlayOpacityFallback / 100 ),
				],
				'.is-grid.vxt-post__items'               => [
					'row-gap'    => \Vexaltrix\Core\Support\Helper::getCssValue( $rowGapFallback, $attr['rowGapUnit'] ),
					'column-gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $columnGapFallback, $attr['columnGapUnit'] ),
				],
				'.wp-block-vxt-post-grid.is-grid'        => [
					'grid-template-columns' => 'repeat(' . $attr['columns'] . ' , minmax(0, 1fr))',
				],
			];

			// If using separate box shadow hover settings, then generate CSS for it.
			if ( $attr['useSeparateBoxShadows'] ) {
				$selectors['.is-grid .vxt-post__inner-wrap:hover']['box-shadow'] = $boxShadowHoverCss;
			}

			$selectors[' .vxt-post__text.vxt-post__title']['color']                            = $attr['titleColor'];
			$selectors[' .vxt-post__text.vxt-post__title a']                                   = [
				'color' => $attr['titleColor'],
			];
			$selectors[' .vxt-post__text.vxt-post-grid-byline']['color']                       = $attr['metaColor'];
			$selectors[' .vxt-post__text.vxt-post-grid-byline .vxt-post__author']             = [
				'color' => $attr['metaColor'],
			];
			$selectors[' .vxt-post__inner-wrap .vxt-post__taxonomy']['color']                  = $attr['metaColor'];
			$selectors[' .vxt-post__inner-wrap .vxt-post__taxonomy a']['color']                = $attr['metaColor'];
			$selectors[' .vxt-post__inner-wrap .vxt-post__taxonomy.highlighted']['color']      = $attr['highlightedTextColor'];
			$selectors[' .vxt-post__inner-wrap .vxt-post__taxonomy.highlighted a']['color']    = $attr['highlightedTextColor'];
			$selectors[' .vxt-post__inner-wrap .vxt-post__taxonomy.highlighted']['background'] = $attr['highlightedTextBgColor'];
			$selectors[' .vxt-post__text.vxt-post-grid-byline .vxt-post__author a']           = [
				'color' => $attr['metaColor'],
			];
			$selectors[' .vxt-post__text.vxt-post__excerpt']['color']                          = $attr['excerptColor'];

			if ( ! $attr['inheritFromThemeBtn'] ) {
				$selectors = array_merge(
					$selectors,
					[
						'.vxt-post-grid .wp-block-button.vxt-post__text.vxt-post__cta .vxt-text-link.wp-block-button__link ' => array_merge(
							[
								'color'      => $attr['ctaColor'],
								'background' => ( 'color' === $attr['ctaBgType'] ) ? $attr['ctaBgColor'] : 'transparent',
								$borderCss,
							],
							$borderCss
						),
						'.vxt-post-grid .vxt-post__inner-wrap .wp-block-button.vxt-post__text.vxt-post__cta a'               => array_merge(
							[
								'color'          => $attr['ctaColor'],
								'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBtnTop, $attr['paddingBtnUnit'] ),
								'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBtnBottom, $attr['paddingBtnUnit'] ),
								'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBtnLeft, $attr['paddingBtnUnit'] ),
								'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBtnRight, $attr['paddingBtnUnit'] ),
							]
						),
						'.vxt-post-grid .wp-block-button.vxt-post__text.vxt-post__cta:hover .vxt-text-link.wp-block-button__link' => [
							'border-color' => $attr['btnBorderHColor'],
							'color'        => $attr['ctaHColor'],
							'background'   => ( 'color' === $attr['ctaBgHType'] ) ? $attr['ctaBgHColor'] : 'transparent',
						],
						' .vxt-post__text.vxt-post__cta:hover a.vxt-text-link' => [
							'color'        => $attr['ctaHColor'],
							'border-color' => $attr['btnBorderHColor'],
						],
						' .vxt-post__text.vxt-post__cta a.vxt-text-link:focus' => [
							'color'        => $attr['ctaHColor'],
							'background'   => ( 'color' === $attr['ctaBgHType'] ) ? $attr['ctaBgHColor'] : 'transparent',
							'border-color' => $attr['btnBorderHColor'],
						],
					]
				);
			}
			
			return $selectors;

		}

		/**
		 * Get Post Block Selectors CSS for Mobile devices
		 *
		 * @param array $attr The block attributes.
		 * @since 1.6.1
		 */
		public static function getPostMobileSelectors( $attr ) {

			$columnGapFallback = self::getFallbackNumber( $attr['columnGap'], 'columnGap', $attr['blockName'] );
			$rowGapFallback    = self::getFallbackNumber( $attr['rowGap'], 'rowGap', $attr['blockName'] );

			$borderCssMobile         = self::uagGenerateBorderCss( $attr, 'btn', 'mobile' );
			$overallBorderCssMobile = self::uagGenerateBorderCss( $attr, 'overall', 'mobile' );

			$paddingTopMobile    = isset( $attr['paddingTopMobile'] ) ? $attr['paddingTopMobile'] : $attr['contentPaddingMobile'];
			$paddingBottomMobile = isset( $attr['paddingBottomMobile'] ) ? $attr['paddingBottomMobile'] : $attr['contentPaddingMobile'];
			$paddingLeftMobile   = isset( $attr['paddingLeftMobile'] ) ? $attr['paddingLeftMobile'] : $attr['contentPaddingMobile'];
			$paddingRightMobile  = isset( $attr['paddingRightMobile'] ) ? $attr['paddingRightMobile'] : $attr['contentPaddingMobile'];

			$paddingBtnTopMobile    = isset( $attr['paddingBtnTopMobile'] ) ? $attr['paddingBtnTopMobile'] : $attr['btnVPadding'];
			$paddingBtnBottomMobile = isset( $attr['paddingBtnBottomMobile'] ) ? $attr['paddingBtnBottomMobile'] : $attr['btnVPadding'];
			$paddingBtnLeftMobile   = isset( $attr['paddingBtnLeftMobile'] ) ? $attr['paddingBtnLeftMobile'] : $attr['btnHPadding'];
			$paddingBtnRightMobile  = isset( $attr['paddingBtnRightMobile'] ) ? $attr['paddingBtnRightMobile'] : $attr['btnHPadding'];

			$rowGapMobile    = is_numeric( $attr['rowGapMobile'] ) ? $attr['rowGapMobile'] : $rowGapFallback;
			$columnGapMobile = is_numeric( $attr['columnGapMobile'] ) ? $attr['columnGapMobile'] : $columnGapFallback;

			$ctaBottomSpaceMobile     = isset( $attr['ctaBottomSpaceMobile'] ) ? $attr['ctaBottomSpaceMobile'] : '';
			$imageBottomSpaceMobile   = isset( $attr['imageBottomSpaceMobile'] ) ? $attr['imageBottomSpaceMobile'] : '';
			$titleBottomSpaceMobile   = isset( $attr['titleBottomSpaceMobile'] ) ? $attr['titleBottomSpaceMobile'] : '';
			$metaBottomSpaceMobile    = isset( $attr['metaBottomSpaceMobile'] ) ? $attr['metaBottomSpaceMobile'] : '';
			$excerptBottomSpaceMobile = isset( $attr['excerptBottomSpaceMobile'] ) ? $attr['excerptBottomSpaceMobile'] : '';

			$mSelector = [
				'.wp-block-vxt-post-grid.is-grid'        => [
					'grid-template-columns' => 'repeat(' . $attr['mcolumns'] . ' , minmax(0, 1fr))',
				],
				' .vxt-post__inner-wrap .vxt-post__text.vxt-post__cta' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $ctaBottomSpaceMobile, $attr['ctaBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap .vxt-post__image' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $imageBottomSpaceMobile, $attr['imageBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap .vxt-post__title' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $titleBottomSpaceMobile, $attr['titleBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap .vxt-post-grid-byline' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $metaBottomSpaceMobile, $attr['metaBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap .vxt-post__excerpt' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $excerptBottomSpaceMobile, $attr['excerptBottomSpaceUnit'] ),
				],
				'.is-grid .vxt-post__inner-wrap'         => array_merge(
					[
						'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingTopMobile, $attr['mobilePaddingUnit'] ),
						'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottomMobile, $attr['mobilePaddingUnit'] ),
						'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingLeftMobile, $attr['mobilePaddingUnit'] ),
						'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingRightMobile, $attr['mobilePaddingUnit'] ),
					],
					$overallBorderCssMobile
				),
				'.is-grid.vxt-post__items'               => [
					'row-gap'    => \Vexaltrix\Core\Support\Helper::getCssValue( $rowGapMobile, $attr['rowGapUnit'] ),
					'column-gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $columnGapMobile, $attr['columnGapUnit'] ),
				],
				':not(.is-grid).vxt-post__items article' => [
					'padding-right' => \Vexaltrix\Core\Support\Helper::getCssValue( (int) ( $rowGapMobile / 2 ), $attr['rowGapUnit'] ),
					'padding-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( (int) ( $rowGapMobile / 2 ), $attr['rowGapUnit'] ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $columnGapMobile ), $attr['columnGapUnit'] ),
				],
				':not(.is-grid).vxt-post__items'         => [
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $rowGapMobile / 2 ), $attr['rowGapUnit'] ),
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $rowGapMobile / 2 ), $attr['rowGapUnit'] ),
				],
				'.is-grid .vxt-post__inner-wrap .vxt-post__image:first-child' => [
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( - (int) ( $paddingLeftMobile ), $attr['mobilePaddingUnit'] ),
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( - (int) ( $paddingRightMobile ), $attr['mobilePaddingUnit'] ),
					'margin-top'   => \Vexaltrix\Core\Support\Helper::getCssValue( - (int) ( $paddingTopMobile ), $attr['mobilePaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text:last-child' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottomMobile, $attr['mobilePaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text:first-child' => [
					'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingTopMobile, $attr['mobilePaddingUnit'] ),
				],
				':not(.is-grid).vxt-post__image-position-background .vxt-post__inner-wrap .vxt-post__text:nth-last-child(2) ' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottomMobile, $attr['mobilePaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap > .vxt-post__text:not(.highlighted)' => [
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingLeftMobile, $attr['mobilePaddingUnit'] ),
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingRightMobile, $attr['mobilePaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text:first-child' => [
					'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingTopMobile, $attr['mobilePaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text.highlighted' => [
					'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingLeftMobile, $attr['mobilePaddingUnit'] ),
				],
			];

			if ( ! $attr['inheritFromThemeBtn'] ) {
				$mSelector = array_merge(
					$mSelector,
					[
						'.vxt-post-grid .wp-block-button.vxt-post__text.vxt-post__cta .vxt-text-link.wp-block-button__link ' => $borderCssMobile,
					]
				);
			}
			return $mSelector;
		}

		/**
		 * Get Post Block Selectors CSS for Tablet devices
		 *
		 * @param array $attr The block attributes.
		 * @since 1.8.2
		 */
		public static function getPostTabletSelectors( $attr ) {

			$columnGapFallback = self::getFallbackNumber( $attr['columnGap'], 'columnGap', $attr['blockName'] );
			$rowGapFallback    = self::getFallbackNumber( $attr['rowGap'], 'rowGap', $attr['blockName'] );

			$borderCssTablet         = self::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
			$overallBorderCssTablet = self::uagGenerateBorderCss( $attr, 'overall', 'tablet' );

			$paddingTopTablet    = isset( $attr['paddingTopTablet'] ) ? $attr['paddingTopTablet'] : $attr['contentPadding'];
			$paddingBottomTablet = isset( $attr['paddingBottomTablet'] ) ? $attr['paddingBottomTablet'] : $attr['contentPadding'];
			$paddingLeftTablet   = isset( $attr['paddingLeftTablet'] ) ? $attr['paddingLeftTablet'] : $attr['contentPadding'];
			$paddingRightTablet  = isset( $attr['paddingRightTablet'] ) ? $attr['paddingRightTablet'] : $attr['contentPadding'];

			$paddingBtnTopTablet    = isset( $attr['paddingBtnTopTablet'] ) ? $attr['paddingBtnTopTablet'] : $attr['btnVPadding'];
			$paddingBtnBottomTablet = isset( $attr['paddingBtnBottomTablet'] ) ? $attr['paddingBtnBottomTablet'] : $attr['btnVPadding'];
			$paddingBtnLeftTablet   = isset( $attr['paddingBtnLeftTablet'] ) ? $attr['paddingBtnLeftTablet'] : $attr['btnHPadding'];
			$paddingBtnRightTablet  = isset( $attr['paddingBtnRightTablet'] ) ? $attr['paddingBtnRightTablet'] : $attr['btnHPadding'];

			$rowGapTablet    = is_numeric( $attr['rowGapTablet'] ) ? $attr['rowGapTablet'] : $rowGapFallback;
			$columnGapTablet = is_numeric( $attr['columnGapTablet'] ) ? $attr['columnGapTablet'] : $columnGapFallback;

			$ctaBottomSpaceTablet     = isset( $attr['ctaBottomSpaceTablet'] ) ? $attr['ctaBottomSpaceTablet'] : '';
			$imageBottomSpaceTablet   = isset( $attr['imageBottomSpaceTablet'] ) ? $attr['imageBottomSpaceTablet'] : '';
			$titleBottomSpaceTablet   = isset( $attr['titleBottomSpaceTablet'] ) ? $attr['titleBottomSpaceTablet'] : '';
			$metaBottomSpaceTablet    = isset( $attr['metaBottomSpaceTablet'] ) ? $attr['metaBottomSpaceTablet'] : '';
			$excerptBottomSpaceTablet = isset( $attr['excerptBottomSpaceTablet'] ) ? $attr['excerptBottomSpaceTablet'] : '';
			$isLeftRight              = isset( $attr['isLeftToRightLayout'] ) ? $attr['isLeftToRightLayout'] : false;

			$tSelector = [
				'.wp-block-vxt-post-grid.is-grid'        => [
					'grid-template-columns' => 'repeat(' . $attr['tcolumns'] . ' , minmax(0, 1fr))',
				],
				' .vxt-post__inner-wrap .vxt-post__text.vxt-post__cta' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $ctaBottomSpaceTablet, $attr['ctaBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap .vxt-post__image' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $imageBottomSpaceTablet, $attr['imageBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap .vxt-post__title' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $titleBottomSpaceTablet, $attr['titleBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap .vxt-post-grid-byline' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $metaBottomSpaceTablet, $attr['metaBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap .vxt-post__excerpt' => [
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $excerptBottomSpaceTablet, $attr['excerptBottomSpaceUnit'] ),
				],
				'.is-grid .vxt-post__inner-wrap'         => array_merge(
					[
						'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingTopTablet, $attr['tabletPaddingUnit'] ),
						'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottomTablet, $attr['tabletPaddingUnit'] ),
						'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingLeftTablet, $attr['tabletPaddingUnit'] ),
						'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingRightTablet, $attr['tabletPaddingUnit'] ),
					],
					$overallBorderCssTablet
				),
				'.is-grid.vxt-post__items'               => [
					'row-gap'    => \Vexaltrix\Core\Support\Helper::getCssValue( $rowGapTablet, $attr['rowGapUnit'] ),
					'column-gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $columnGapTablet, $attr['columnGapUnit'] ),
				],
				':not(.is-grid).vxt-post__items article' => [
					'padding-right' => \Vexaltrix\Core\Support\Helper::getCssValue( (int) ( $rowGapTablet / 2 ), $attr['rowGapUnit'] ),
					'padding-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( (int) ( $rowGapTablet / 2 ), $attr['rowGapUnit'] ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $columnGapTablet ), $attr['columnGapUnit'] ),
				],
				':not(.is-grid).vxt-post__items'         => [
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $rowGapTablet / 2 ), $attr['rowGapUnit'] ),
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( - (int) $rowGapTablet / 2 ), $attr['rowGapUnit'] ),
				],
				'.is-grid .vxt-post__inner-wrap .vxt-post__image:first-child' => ! $isLeftRight ? [
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( - (int) ( $paddingLeftTablet ), $attr['tabletPaddingUnit'] ),
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( - (int) ( $paddingRightTablet ), $attr['tabletPaddingUnit'] ),
					'margin-top'   => \Vexaltrix\Core\Support\Helper::getCssValue( - (int) ( $paddingTopTablet ), $attr['tabletPaddingUnit'] ),
				] : [],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text:last-child' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottomTablet, $attr['tabletPaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text:first-child' => [
					'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingTopTablet, $attr['tabletPaddingUnit'] ),
				],
				':not(.is-grid).vxt-post__image-position-background .vxt-post__inner-wrap .vxt-post__text:nth-last-child(2) ' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBottomTablet, $attr['tabletPaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text:not(.highlighted)' => [
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingLeftTablet, $attr['tabletPaddingUnit'] ),
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingRightTablet, $attr['tabletPaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text:first-child' => [
					'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingTopTablet, $attr['tabletPaddingUnit'] ),
				],
				':not(.is-grid) .vxt-post__inner-wrap .vxt-post__text.highlighted' => [
					'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingLeftTablet, $attr['tabletPaddingUnit'] ),
				],
			];
			if ( ! $attr['inheritFromThemeBtn'] ) {
				$tSelector = array_merge(
					$tSelector,
					[
						'.vxt-post-grid .wp-block-button.vxt-post__text.vxt-post__cta .vxt-text-link.wp-block-button__link ' => $borderCssTablet,
						' .vxt-post__cta a' => array_merge(
							[
								'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBtnTopTablet, $attr['tabletPaddingBtnUnit'] ),
								'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBtnBottomTablet, $attr['tabletPaddingBtnUnit'] ),
								'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBtnLeftTablet, $attr['tabletPaddingBtnUnit'] ),
								'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $paddingBtnRightTablet, $attr['tabletPaddingBtnUnit'] ),
							],
							$borderCssTablet
						),
					]
				);
			}
			return $tSelector;
		}

		/**
		 * Flip physical `left`/`right` text-align values under RTL locales.
		 *
		 * Used by Post Timeline so user-selected Text Alignment mirrors the
		 * reading direction (left→right, right→left). Empty and `center`
		 * pass through unchanged.
		 *
		 * Uses an explicit `is_rtl()` swap (rather than CSS logical
		 * `start`/`end`) so the mapping stays consistent between the frontend
		 * and the Gutenberg editor canvas, where the iframe does not reliably
		 * inherit `direction: rtl`.
		 *
		 * @param string $value Attribute value.
		 * @return string
		 * @since 2.19.26
		 */
		public static function getLogicalTextAlign( $value ) {
			if ( ! is_rtl() ) {
				return $value;
			}
			if ( 'left' === $value ) {
				return 'right';
			}
			if ( 'right' === $value ) {
				return 'left';
			}
			return $value;
		}

		/**
		 * Get Timeline Block Desktop Selectors CSS
		 *
		 * @param array $attr The block attributes.
		 * @since 1.8.2
		 */
		public static function getTimelineSelectors( $attr ) {

			$leftMargin  = $attr['horizontalSpace'];
			$rightMargin = $attr['horizontalSpace'];

			$topPadding    = isset( $attr['topPadding'] ) ? $attr['topPadding'] : $attr['bgPadding'];
			$bottomPadding = isset( $attr['bottomPadding'] ) ? $attr['bottomPadding'] : $attr['bgPadding'];
			$leftPadding   = isset( $attr['leftPadding'] ) ? $attr['leftPadding'] : $attr['bgPadding'];
			$rightPadding  = isset( $attr['rightPadding'] ) ? $attr['rightPadding'] : $attr['bgPadding'];

			$iconSizeFallback         = self::getFallbackNumber( $attr['iconSize'], 'iconSize', $attr['blockName'] );
			$connectorBgSizeFallback = self::getFallbackNumber( $attr['connectorBgsize'], 'connectorBgsize', $attr['blockName'] );
			$borderWidthFallback      = self::getFallbackNumber( $attr['borderwidth'], 'borderwidth', $attr['blockName'] );
			$separatorWidthFallback   = self::getFallbackNumber( $attr['separatorwidth'], 'separatorwidth', $attr['blockName'] );
			$headSpaceFallback        = self::getFallbackNumber( $attr['headSpace'], 'headSpace', $attr['blockName'] );
			$borderRadiusFallback     = self::getFallbackNumber( $attr['borderRadius'], 'borderRadius', $attr['blockName'] );
			$dateBottomSpaceFallback = self::getFallbackNumber( $attr['dateBottomspace'], 'dateBottomspace', $attr['blockName'] );
			$headTopSpacingFallback  = 'post-timeline' === $attr['blockName'] ? self::getFallbackNumber( $attr['headTopSpacing'], 'headTopSpacing', $attr['blockName'] ) : $attr['contentPadding'];

			$connectorSize      = \Vexaltrix\Core\Support\Helper::getCssValue( $connectorBgSizeFallback, 'px' );
			$dateFontSize      = '' !== $attr['dateFontSize'] ? $attr['dateFontSize'] : $attr['dateFontsize'];
			$dateFontSizeType = '' !== $attr['dateFontSizeType'] ? $attr['dateFontSizeType'] : $attr['dateFontsizeType'];
			$selectors           = [
				' .vxt-timeline__heading'               => [
					'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $headTopSpacingFallback, 'px' ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $headSpaceFallback, 'px' ),
					'text-align'    => self::getLogicalTextAlign( $attr['align'] ),
				],
				' .vxt-timeline-desc-content'           => [
					'text-align' => self::getLogicalTextAlign( $attr['align'] ),
					'color'      => $attr['subHeadingColor'],
				],
				' .vxt-timeline__day-new'               => [
					'text-align' => self::getLogicalTextAlign( $attr['align'] ),
				],
				' .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
					'border-left-color' => $attr['backgroundColor'],
				],
				' .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
					'border-left-color' => $attr['backgroundColor'],
				],
				' .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
					'border-right-color' => $attr['backgroundColor'],
				],
				' .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
					'border-right-color' => $attr['backgroundColor'],
				],
				' .vxt-timeline__line__inner'           => [
					'background-color' => $attr['separatorFillColor'],
				],
				' .vxt-timeline__line'                  => [
					'background-color' => $attr['separatorColor'],
					'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $separatorWidthFallback, 'px' ),
				],
				'.vxt-timeline__right-block .vxt-timeline__line' => [
					'inset-inline-end' => 'calc( ' . $connectorBgSizeFallback . 'px / 2 )',
				],
				'.vxt-timeline__left-block .vxt-timeline__line' => [
					'inset-inline-start' => 'calc( ' . $connectorBgSizeFallback . 'px / 2 )',
				],
				' .vxt-timeline__marker'                => [
					'background-color' => $attr['separatorBg'],
					'min-height'       => $connectorSize,
					'min-width'        => $connectorSize,
					'line-height'      => $connectorSize,
					'border'           => $borderWidthFallback . 'px solid' . $attr['separatorBorder'],
				],
				'.vxt-timeline__left-block .vxt-timeline__left .vxt-timeline__arrow' => [
					'height' => $connectorSize,
				],
				'.vxt-timeline__right-block .vxt-timeline__right .vxt-timeline__arrow' => [
					'height' => $connectorSize,
				],
				'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__arrow' => [
					'height' => $connectorSize,
				],
				'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__arrow' => [
					'height' => $connectorSize,
				],
				'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__marker' => [
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMargin, $attr['marginUnit'] ),
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMargin, $attr['marginUnit'] ),
				],
				'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__marker' => [
					'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMargin, $attr['marginUnit'] ),
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMargin, $attr['marginUnit'] ),
				],
				' .vxt-timeline__date-hide.vxt-timeline__inner-date-new' => [ // For New User.
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $dateBottomSpaceFallback, 'px' ),
					'color'         => $attr['dateColor'],
					'text-align'    => self::getLogicalTextAlign( $attr['align'] ),
				],
				' .vxt-timeline__date-hide.vxt-timeline__date-inner' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $dateBottomSpaceFallback, 'px' ),
					'color'         => $attr['dateColor'],
					'text-align'    => self::getLogicalTextAlign( $attr['align'] ),
				],
				'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
					'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMargin, $attr['marginUnit'] ),
				],
				'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
					'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMargin, $attr['marginUnit'] ),
				],
				' .vxt-timeline__date-new'              => [
					'color'     => $attr['dateColor'],
					'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $dateFontSize, $dateFontSizeType ),
				],
				' .vxt-timeline__events-inner-new'      => [
					'background-color' => $attr['backgroundColor'],
					'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue( $borderRadiusFallback, 'px' ),
				],
				' .vxt-timeline__events-inner--content' => [
					'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPadding, $attr['paddingUnit'] ),
					'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPadding, $attr['paddingUnit'] ),
					'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPadding, $attr['paddingUnit'] ),
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPadding, $attr['paddingUnit'] ),
					'text-align'     => self::getLogicalTextAlign( $attr['align'] ),
				],
				' svg'                                   => [
					'color'     => $attr['iconColor'],
					'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $iconSizeFallback, 'px' ),
					'width'     => \Vexaltrix\Core\Support\Helper::getCssValue( $iconSizeFallback, 'px' ),
					'fill'      => $attr['iconColor'],
				],
				' .vxt-timeline__marker.vxt-timeline__in-view-icon svg' => [
					'fill'  => $attr['iconFocus'],
					'color' => $attr['iconFocus'],
				],
				' .vxt-timeline__marker.vxt-timeline__in-view-icon' => [
					'background'   => $attr['iconBgFocus'],
					'border-color' => $attr['borderFocus'],
				],
			];

			return $selectors;

		}

		/**
		 * Get Timeline Block Tablet Selectors CSS.
		 *
		 * @param array $attr The block attributes.
		 * @since 1.8.2
		 */
		public static function getTimelineTabletSelectors( $attr ) {

			$connectorBgSizeFallback = self::getFallbackNumber( $attr['connectorBgsize'], 'connectorBgsize', $attr['blockName'] );

			$tabletSelector = [
				' .vxt-timeline__heading'               => [
					'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headTopSpacingTablet'], 'px' ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headSpaceTablet'], 'px' ),
					'text-align'    => self::getLogicalTextAlign( $attr['alignTablet'] ),
				],
				' .vxt-timeline__date-hide.vxt-timeline__inner-date-new' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['dateBottomspaceTablet'], 'px' ),
				],
				'.vxt-timeline__center-block .vxt-timeline__marker' => [
					'margin-left'  => 0,
					'margin-right' => 0,
				],
				'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
					'border-right-color' => $attr['backgroundColor'],
				],
				'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
					'border-right-color' => $attr['backgroundColor'],
				],
				'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__line' => [
					'inset-inline-start' => 'calc( ' . $connectorBgSizeFallback . 'px / 2 )',
				],
				'.vxt-timeline__center-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
					'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginTablet'], $attr['tabletMarginUnit'] ),
					'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginTablet'], $attr['tabletMarginUnit'] ),
					'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginTablet'], $attr['tabletMarginUnit'] ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginTablet'], $attr['tabletMarginUnit'] ),
				],
				'.vxt-timeline__center-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
					'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginTablet'], $attr['tabletMarginUnit'] ),
					'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginTablet'], $attr['tabletMarginUnit'] ),
					'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginTablet'], $attr['tabletMarginUnit'] ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginTablet'], $attr['tabletMarginUnit'] ),
				],
				' .vxt-timeline__events-inner--content' => [
					'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingTablet'], $attr['tabletPaddingUnit'] ),
					'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingTablet'], $attr['tabletPaddingUnit'] ),
					'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingTablet'], $attr['tabletPaddingUnit'] ),
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingTablet'], $attr['tabletPaddingUnit'] ),
					'border-radius'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderRadiusTablet'], 'px' ),
					'text-align'     => self::getLogicalTextAlign( $attr['alignTablet'] ),
				],
			];

			return $tabletSelector;

		}

		/**
		 * Get Timeline Block Mobile Selectors CSS.
		 *
		 * @param array $attr The block attributes.
		 * @since 1.8.2
		 */
		public static function getTimelineMobileSelectors( $attr ) {

			$connectorBgSizeFallback = self::getFallbackNumber( $attr['connectorBgsize'], 'connectorBgsize', $attr['blockName'] );

			$mSelectors = [
				' .vxt-timeline__heading'               => [
					'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headTopSpacingMobile'], 'px' ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headSpaceMobile'], 'px' ),
					'text-align'    => self::getLogicalTextAlign( $attr['alignMobile'] ),
				],
				' .vxt-timeline__date-hide.vxt-timeline__inner-date-new' => [
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['dateBottomspaceMobile'], 'px' ),
				],
				'.vxt-timeline__center-block .vxt-timeline__marker' => [
					'margin-left'  => 0,
					'margin-right' => 0,
				],
				' .vxt-timeline__center-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
					'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['horizontalSpace'], 'px' ),
				],
				' .vxt-timeline__center-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
					'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['horizontalSpace'], 'px' ),
				],
				'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
					'border-right-color' => $attr['backgroundColor'],
				],
				'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__line' => [
					'inset-inline-start' => 'calc( ' . $connectorBgSizeFallback . 'px / 2 )',
				],
				'.vxt-timeline__center-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
					'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginMobile'], $attr['mobileMarginUnit'] ),
					'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginMobile'], $attr['mobileMarginUnit'] ),
					'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginMobile'], $attr['mobileMarginUnit'] ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginMobile'], $attr['mobileMarginUnit'] ),
				],
				'.vxt-timeline__center-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
					'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginMobile'], $attr['mobileMarginUnit'] ),
					'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginMobile'], $attr['mobileMarginUnit'] ),
					'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginMobile'], $attr['mobileMarginUnit'] ),
					'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginMobile'], $attr['mobileMarginUnit'] ),
				],
				' .vxt-timeline__events-inner--content' => [
					'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingMobile'], $attr['mobilePaddingUnit'] ),
					'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingMobile'], $attr['mobilePaddingUnit'] ),
					'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingMobile'], $attr['mobilePaddingUnit'] ),
					'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingMobile'], $attr['mobilePaddingUnit'] ),
					'border-radius'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderRadiusMobile'], 'px' ),
					'text-align'     => self::getLogicalTextAlign( $attr['alignMobile'] ),
				],
			];
			return $mSelectors;

		}

		/**
		 * Get Condition block CSS.
		 *
		 * @since 1.22.0
		 */
		public static function getConditionBlockCss() {

			return '@media (min-width: 1025px){body .uag-hide-desktop.vxt-google-map__wrap,body .uag-hide-desktop{display:none !important}}@media (min-width: 768px) and (max-width: 1024px){body .uag-hide-tab.vxt-google-map__wrap,body .uag-hide-tab{display:none !important}}@media (max-width: 767px){body .uag-hide-mob.vxt-google-map__wrap,body .uag-hide-mob{display:none !important}}';
		}

		/**
		 * Get Masonry Gallery CSS.
		 *
		 * @since 1.24.0
		 * @param array  $attr The block attributes.
		 * @param string $id The selector ID.
		 */
		public static function getGalleryCss( $attr, $id ) {

			if ( isset( $attr['masonry'] ) && true === $attr['masonry'] ) {
				$colCount = ( isset( $attr['columns'] ) ) ? $attr['columns'] : 3;
				$selectors = [];
				if ( isset( $attr['masonryGutter'] ) && '' !== $attr['masonryGutter'] ) {
					$selectors = [
						'.wp-block-gallery.has-nested-images.columns-' . $colCount => [
							'column-gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['masonryGutter'], 'px' ),
						],
						'.wp-block-gallery.has-nested-images.columns-default' => [
							'column-gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['masonryGutter'], 'px' ),
						],
						'.wp-block-gallery.has-nested-images figure.wp-block-image:not(#individual-image) img' => [
							'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['masonryGutter'], 'px' ),
						],
						'.wp-block-gallery.columns-' . $colCount . ' ul.blocks-gallery-grid' => [ // For Backword.
							'column-gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['masonryGutter'], 'px' ),
						],
						'.wp-block-gallery ul.blocks-gallery-grid li.blocks-gallery-item' => [ // For Backword.
							'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['masonryGutter'], 'px' ),
						],
					];
				} else {
					$selectors = [
						'.wp-block-gallery.has-nested-images figure.wp-block-image:not(#individual-image) img' => [
							'margin-bottom' => '1em',
						],
					];
				}
				$tSelectors = [];
				if ( $colCount > 3 ) {
					$tSelectors = [
						'.wp-block-gallery.columns-' . $colCount . ' .blocks-gallery-grid' => [
							'column-count' => '3',
						],
					];
				}
			}
			$combinedSelectors = [
				'desktop' => $selectors,
				'tablet'  => $tSelectors,
				'mobile'  => [],
			];

			return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
		}

		/**
		 * Get Masonry Gallery CSS.
		 *
		 * @since 1.24.0
		 */
		public static function getMasonryGalleryCss() {

			$selectors = [
				'.wp-block-gallery.has-nested-images'    => [
					'display'      => 'block',
					'column-count' => '3',
					'column-gap'   => '1em',
				],
				'.wp-block-gallery.has-nested-images figure.wp-block-image:not(#individual-image)' => [
					'margin'             => 0,
					'display'            => 'block',
					'grid-template-rows' => '1fr auto',
					'break-inside'       => 'avoid',
					'width'              => 'unset',
				],
				'.columns-default.wp-block-gallery.has-nested-images' => [
					'column-count' => '3',
					'width'        => 'unset',
				],
				'.columns-1.wp-block-gallery.has-nested-images' => [
					'column-count' => '1',
					'width'        => 'unset',
				],
				'.columns-2.wp-block-gallery.has-nested-images' => [
					'column-count' => '2',
				],
				'.columns-3.wp-block-gallery.has-nested-images' => [
					'column-count' => '3',
					'width'        => 'unset',
				],
				'.columns-4.wp-block-gallery.has-nested-images' => [
					'column-count' => '4',
					'width'        => 'unset',
				],
				'.columns-5.wp-block-gallery.has-nested-images' => [
					'column-count' => '5',
					'width'        => 'unset',
				],
				'.columns-6.wp-block-gallery.has-nested-images' => [
					'column-count' => '6',
					'width'        => 'unset',
				],
				'.columns-7.wp-block-gallery.has-nested-images' => [
					'column-count' => '7',
					'width'        => 'unset',
				],
				'.columns-8.wp-block-gallery.has-nested-images' => [
					'column-count' => '8',
					'width'        => 'unset',
				],
				/* For Backword */
				' .blocks-gallery-grid .blocks-gallery-item' => [
					'margin'             => 0,
					'display'            => 'block',
					'grid-template-rows' => '1fr auto',
					'margin-bottom'      => '1em',
					'break-inside'       => 'avoid',
					'width'              => 'unset',
				],
				'.wp-block-gallery .blocks-gallery-grid' => [
					'column-gap' => '1em',
					'display'    => 'block',
				],
				'.columns-1 .blocks-gallery-grid'        => [
					'column-count' => '1',
				],
				'.columns-2 .blocks-gallery-grid'        => [
					'column-count' => '2',
				],
				'.columns-3 .blocks-gallery-grid'        => [
					'column-count' => '3',
				],
				'.columns-4 .blocks-gallery-grid'        => [
					'column-count' => '4',
				],
				'.columns-5 .blocks-gallery-grid'        => [
					'column-count' => '5',
				],
				'.columns-6 .blocks-gallery-grid'        => [
					'column-count' => '6',
				],
				'.columns-7 .blocks-gallery-grid'        => [
					'column-count' => '7',
				],
				'.columns-8 .blocks-gallery-grid'        => [
					'column-count' => '8',
				],
				/* End Backword */
			];

			$mSelectors = [
				'.wp-block-gallery[class*="columns-"].blocks-gallery-grid' => [
					'column-count' => '2',
					'column-gap'   => '1em',
					'display'      => 'unset',
				],
				'.wp-block-gallery.columns-1.blocks-gallery-grid'        => [
					'column-count' => '1',
				],
				/* For Backword */
				'.wp-block-gallery[class*="columns-"] .blocks-gallery-grid' => [
					'column-count' => '2',
					'column-gap'   => '1em',
					'display'      => 'unset',
				],
				'.wp-block-gallery.columns-1 .blocks-gallery-grid'        => [
					'column-count' => '1',
				],
				/* End Backword */
			];

			$combinedSelectors = [
				'desktop' => $selectors,
				'tablet'  => [],
				'mobile'  => $mSelectors,
			];

			$css = \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.uag-masonry' );

			$desktop = $css['desktop'];
			$tablet  = $css['tablet'];
			$mobile  = $css['mobile'];

			$tabStylingCss = '';
			$mobStylingCss = '';

			if ( ! empty( $tablet ) ) {
				$tabStylingCss .= '@media only screen and (max-width: ' . VXT_TABLET_BREAKPOINT . 'px) {';
				$tabStylingCss .= $tablet;
				$tabStylingCss .= '}';
			}

			if ( ! empty( $mobile ) ) {
				$mobStylingCss .= '@media only screen and (max-width: ' . VXT_MOBILE_BREAKPOINT . 'px) {';
				$mobStylingCss .= $mobile;
				$mobStylingCss .= '}';
			}

			return $desktop . $tabStylingCss . $mobStylingCss;
		}

		/**
		 * Generates background CSS for a specific device type.
		 *
		 * This function takes attributes for styling and a device type, and returns
		 * the corresponding background object and overlay CSS for that device type.
		 *
		 * @param array  $attr         The array of attributes containing styling options.
		 * @param string $deviceType   The device type ('Desktop', 'Tablet', 'Mobile') for which to generate background CSS.
		 * @param string $overlay      The overlay option ('no' or 'yes') to determine whether to include overlay CSS.
		 *
		 * @since 2.7.8
		 * @return array               The background CSS object for the specified device type.
		 */
		public static function getBackgroundCssByDevice( $attr, $deviceType = 'Desktop', $overlay = 'no' ) {

			switch ( $deviceType ) {
				case 'tablet':
				case 'Tablet':
					$deviceType = 'Tablet';
					break;
				case 'mobile':
				case 'Mobile':
					$deviceType = 'Mobile';
					break;
				default:
					$deviceType = 'Desktop';
			}

					// Implement proper fallback logic for each device type.
			// Desktop always uses desktop image.
			$desktopBgImage = $attr['backgroundImageDesktop'];
		
			// Tablet uses tablet image if it exists, otherwise fallback to desktop.
			$tabletBgImage = ! empty( $attr['backgroundImageTablet'] ) ? $attr['backgroundImageTablet'] : $attr['backgroundImageDesktop'];
		
			// Mobile fallback chain: Mobile → Tablet → Desktop.
			$mobileBgImage = $attr['backgroundImageDesktop']; // Default fallback.
			if ( ! empty( $attr['backgroundImageMobile'] ) ) {
				$mobileBgImage = $attr['backgroundImageMobile'];
			} elseif ( ! empty( $attr['backgroundImageTablet'] ) ) {
				$mobileBgImage = $attr['backgroundImageTablet'];
			}
		
			$bgObj = [
				'backgroundType'                  => $attr['backgroundType'],
				'backgroundImage'                 => $desktopBgImage,
				'backgroundColor'                 => $attr['backgroundColor'],
				'gradientValue'                   => $attr['gradientValue'],
				'gradientColor1'                  => $attr['gradientColor1'],
				'gradientColor2'                  => $attr['gradientColor2'],
				'gradientType'                    => $attr['gradientType'],
				'gradientLocation1'               => $attr['gradientLocation1'],
				'gradientLocation2'               => $attr['gradientLocation2'],
				'gradientAngle'                   => $attr['gradientAngle'],
				'selectGradient'                  => $attr['selectGradient'],
				'backgroundRepeat'                => $attr[ 'backgroundRepeat' . $deviceType ],
				'backgroundPosition'              => $attr[ 'backgroundPosition' . $deviceType ],
				'backgroundSize'                  => $attr[ 'backgroundSize' . $deviceType ],
				'backgroundAttachment'            => $attr[ 'backgroundAttachment' . $deviceType ],
				'backgroundImageColor'            => $attr['backgroundImageColor'],
				'overlayType'                     => $attr['overlayType'],
				'overlayOpacity'                  => $attr['overlayOpacity'],
				'backgroundCustomSize'            => $attr[ 'backgroundCustomSize' . $deviceType ],
				'backgroundCustomSizeType'        => $attr['backgroundCustomSizeType'],
				'backgroundVideo'                 => $attr['backgroundVideo'],
				'backgroundVideoColor'            => $attr['backgroundVideoColor'],
				'customPosition'                  => $attr['customPosition'],
				'centralizedPosition'             => $attr['centralizedPosition'],
				'xPosition'                       => $attr[ 'xPosition' . $deviceType ],
				'xPositionType'                   => $attr['xPositionType'],
				'yPosition'                       => $attr[ 'yPosition' . $deviceType ],
				'yPositionType'                   => $attr['yPositionType'],
				'backgroundOverlayImage'          => $attr[ 'backgroundOverlayImage' . $deviceType ],
				'backgroundOverlayRepeat'         => $attr[ 'backgroundRepeatOverlay' . $deviceType ],
				'backgroundOverlayPosition'       => $attr[ 'backgroundPositionOverlay' . $deviceType ],
				'backgroundOverlaySize'           => $attr[ 'backgroundSizeOverlay' . $deviceType ],
				'backgroundOverlayAttachment'     => $attr[ 'backgroundAttachmentOverlay' . $deviceType ],
				'backgroundOverlayCustomSize'     => $attr[ 'backgroundCustomSizeOverlay' . $deviceType ],
				'backgroundOverlayCustomSizeType' => $attr['backgroundCustomOverlaySizeType'],
				'customOverlayPosition'           => $attr['customOverlayPosition'],
				'xOverlayPosition'                => $attr[ 'xPositionOverlay' . $deviceType ],
				'xOverlayPositionType'            => $attr['xPositionOverlayType'],
				'yOverlayPosition'                => $attr[ 'yPositionOverlay' . $deviceType ],
				'yOverlayPositionType'            => $attr['yPositionOverlayType'],
				'blendMode'                       => $attr['overlayBlendMode'],
				'backgroundVideoFallbackImage'    => $attr['backgroundVideoFallbackImage'],
			];

					$bgObjTablet = [
						'backgroundType'                  => $attr['backgroundType'],
						'backgroundImage'                 => $tabletBgImage,
						'backgroundColor'                 => $attr['backgroundColor'],
						'gradientValue'                   => $attr['gradientValue'],
						'gradientColor1'                  => $attr['gradientColor1'],
						'gradientColor2'                  => $attr['gradientColor2'],
						'gradientType'                    => $attr['gradientType'],
						'gradientLocation1'               => isset( $attr['gradientLocationTablet1'] ) && is_numeric( $attr['gradientLocationTablet1'] ) ? $attr['gradientLocationTablet1'] : $bgObj['gradientLocation1'],
						'gradientLocation2'               => isset( $attr['gradientLocationTablet2'] ) && is_numeric( $attr['gradientLocationTablet2'] ) ? $attr['gradientLocationTablet2'] : $bgObj['gradientLocation2'],
						'gradientAngle'                   => isset( $attr['gradientAngleTablet'] ) && is_numeric( $attr['gradientAngleTablet'] ) ? $attr['gradientAngleTablet'] : $bgObj['gradientAngle'],
						'selectGradient'                  => $attr['selectGradient'],
						'backgroundRepeat'                => $attr[ 'backgroundRepeat' . $deviceType ],
						'backgroundPosition'              => $attr[ 'backgroundPosition' . $deviceType ],
						'backgroundSize'                  => $attr[ 'backgroundSize' . $deviceType ],
						'backgroundAttachment'            => $attr[ 'backgroundAttachment' . $deviceType ],
						'backgroundImageColor'            => $attr['backgroundImageColor'],
						'overlayType'                     => $attr['overlayType'],
						'overlayOpacity'                  => $attr['overlayOpacity'],
						'backgroundCustomSize'            => $attr[ 'backgroundCustomSize' . $deviceType ],
						'backgroundCustomSizeType'        => $attr['backgroundCustomSizeType'],
						'backgroundVideo'                 => $attr['backgroundVideo'],
						'backgroundVideoColor'            => $attr['backgroundVideoColor'],
						'customPosition'                  => $attr['customPosition'],
						'centralizedPosition'             => $attr['centralizedPosition'],
						'xPosition'                       => $attr[ 'xPosition' . $deviceType ],
						'xPositionType'                   => $attr['xPositionType'],
						'yPosition'                       => $attr[ 'yPosition' . $deviceType ],
						'yPositionType'                   => $attr['yPositionType'],
						'backgroundOverlayImage'          => $attr[ 'backgroundOverlayImage' . $deviceType ],
						'backgroundOverlayRepeat'         => $attr[ 'backgroundRepeatOverlay' . $deviceType ],
						'backgroundOverlayPosition'       => $attr[ 'backgroundPositionOverlay' . $deviceType ],
						'backgroundOverlaySize'           => $attr[ 'backgroundSizeOverlay' . $deviceType ],
						'backgroundOverlayAttachment'     => $attr[ 'backgroundAttachmentOverlay' . $deviceType ],
						'backgroundOverlayCustomSize'     => $attr[ 'backgroundCustomSizeOverlay' . $deviceType ],
						'backgroundOverlayCustomSizeType' => $attr['backgroundCustomOverlaySizeType'],
						'customOverlayPosition'           => $attr['customOverlayPosition'],
						'xOverlayPosition'                => $attr[ 'xPositionOverlay' . $deviceType ],
						'xOverlayPositionType'            => $attr['xPositionOverlayType'],
						'yOverlayPosition'                => $attr[ 'yPositionOverlay' . $deviceType ],
						'yOverlayPositionType'            => $attr['yPositionOverlayType'],
						'blendMode'                       => $attr['overlayBlendMode'],
						'backgroundVideoFallbackImage'    => $attr['backgroundVideoFallbackImage'],
					];
			
					$bgObjMobile = [
						'backgroundType'                  => $attr['backgroundType'],
						'backgroundImage'                 => $mobileBgImage,
						'backgroundColor'                 => $attr['backgroundColor'],
						'gradientValue'                   => $attr['gradientValue'],
						'gradientColor1'                  => $attr['gradientColor1'],
						'gradientColor2'                  => $attr['gradientColor2'],
						'gradientType'                    => $attr['gradientType'],
						'gradientLocation1'               => isset( $attr['gradientLocationMobile1'] ) && is_numeric( $attr['gradientLocationMobile1'] ) ? $attr['gradientLocationMobile1'] : $bgObjTablet['gradientLocation1'],
						'gradientLocation2'               => isset( $attr['gradientLocationMobile2'] ) && is_numeric( $attr['gradientLocationMobile2'] ) ? $attr['gradientLocationMobile2'] : $bgObjTablet['gradientLocation2'],
						'gradientAngle'                   => isset( $attr['gradientAngleMobile'] ) && is_numeric( $attr['gradientAngleMobile'] ) ? $attr['gradientAngleMobile'] : $bgObjTablet['gradientAngle'],
						'selectGradient'                  => $attr['selectGradient'],
						'backgroundRepeat'                => $attr[ 'backgroundRepeat' . $deviceType ],
						'backgroundPosition'              => $attr[ 'backgroundPosition' . $deviceType ],
						'backgroundSize'                  => $attr[ 'backgroundSize' . $deviceType ],
						'backgroundAttachment'            => $attr[ 'backgroundAttachment' . $deviceType ],
						'backgroundImageColor'            => $attr['backgroundImageColor'],
						'overlayType'                     => $attr['overlayType'],
						'overlayOpacity'                  => $attr['overlayOpacity'],
						'backgroundCustomSize'            => $attr[ 'backgroundCustomSize' . $deviceType ],
						'backgroundCustomSizeType'        => $attr['backgroundCustomSizeType'],
						'backgroundVideo'                 => $attr['backgroundVideo'],
						'backgroundVideoColor'            => $attr['backgroundVideoColor'],
						'customPosition'                  => $attr['customPosition'],
						'centralizedPosition'             => $attr['centralizedPosition'],
						'xPosition'                       => $attr[ 'xPosition' . $deviceType ],
						'xPositionType'                   => $attr['xPositionType'],
						'yPosition'                       => $attr[ 'yPosition' . $deviceType ],
						'yPositionType'                   => $attr['yPositionType'],
						'backgroundOverlayImage'          => $attr[ 'backgroundOverlayImage' . $deviceType ],
						'backgroundOverlayRepeat'         => $attr[ 'backgroundRepeatOverlay' . $deviceType ],
						'backgroundOverlayPosition'       => $attr[ 'backgroundPositionOverlay' . $deviceType ],
						'backgroundOverlaySize'           => $attr[ 'backgroundSizeOverlay' . $deviceType ],
						'backgroundOverlayAttachment'     => $attr[ 'backgroundAttachmentOverlay' . $deviceType ],
						'backgroundOverlayCustomSize'     => $attr[ 'backgroundCustomSizeOverlay' . $deviceType ],
						'backgroundOverlayCustomSizeType' => $attr['backgroundCustomOverlaySizeType'],
						'customOverlayPosition'           => $attr['customOverlayPosition'],
						'xOverlayPosition'                => $attr[ 'xPositionOverlay' . $deviceType ],
						'xOverlayPositionType'            => $attr['xPositionOverlayType'],
						'yOverlayPosition'                => $attr[ 'yPositionOverlay' . $deviceType ],
						'yOverlayPositionType'            => $attr['yPositionOverlayType'],
						'blendMode'                       => $attr['overlayBlendMode'],
						'backgroundVideoFallbackImage'    => $attr['backgroundVideoFallbackImage'],
					];

					switch ( $deviceType ) {
						case 'Tablet':
							$containerBgCss = self::uagGetBackgroundObj( $bgObjTablet, $overlay );
							break;
						case 'Mobile':
							$containerBgCss = self::uagGetBackgroundObj( $bgObjMobile, $overlay );
							break;
						default:
							$containerBgCss = self::uagGetBackgroundObj( $bgObj, $overlay );
					}

					return $containerBgCss;
		}

		/**
		 * Background Control CSS Generator Function.
		 *
		 * @param array  $bgObj          The background object with all CSS properties.
		 * @param string $cssForOverlay The overlay option ('no' or 'yes') to determine whether to include overlay CSS. Leave empty for blocks that do not use the '::before' overlay.
		 *
		 * @return array                  The formatted CSS properties for the background.
		 */
		public static function uagGetBackgroundObj( $bgObj, $cssForOverlay = '' ) {
			$genBgCss         = [];
			$genBgOverlayCss = [];

			$bgType = isset( $bgObj['backgroundType'] ) ? $bgObj['backgroundType'] : '';
			
			// Background Image Extraction Logic
			// Handles multiple data formats that WordPress/Gutenberg can provide:
			// 1. Array format: { url: "image.jpg" } or { src: "image.jpg" }.
			// 2. String format: "http://example.com/image.jpg" (direct URL).
			// 3. Null/empty values (no background image set).
			$bgImg = '';
			if ( isset( $bgObj['backgroundImage'] ) && null !== $bgObj['backgroundImage'] ) {
				if ( is_array( $bgObj['backgroundImage'] ) ) {
					// Handle array format - check for 'url' property first.
					if ( isset( $bgObj['backgroundImage']['url'] ) ) {
						$bgImg = $bgObj['backgroundImage']['url'];
					} elseif ( isset( $bgObj['backgroundImage']['src'] ) ) {
						// Fallback to 'src' property if 'url' doesn't exist.
						$bgImg = $bgObj['backgroundImage']['src'];
					}
					// If neither 'url' nor 'src' exist, $bgImg remains empty.
				} elseif ( is_string( $bgObj['backgroundImage'] ) && ! empty( $bgObj['backgroundImage'] ) ) {
					// Handle string format - direct URL assignment.
					$bgImg = $bgObj['backgroundImage'];
				}
				// Note: Other data types (boolean, object, etc.) are ignored.
			}
			$bgColor            = isset( $bgObj['backgroundColor'] ) ? $bgObj['backgroundColor'] : '';
			$gradientValue      = isset( $bgObj['gradientValue'] ) ? $bgObj['gradientValue'] : '';
			$gradientColor1      = isset( $bgObj['gradientColor1'] ) ? $bgObj['gradientColor1'] : '';
			$gradientColor2      = isset( $bgObj['gradientColor2'] ) ? $bgObj['gradientColor2'] : '';
			$gradientType        = isset( $bgObj['gradientType'] ) ? $bgObj['gradientType'] : '';
			$gradientLocation1   = isset( $bgObj['gradientLocation1'] ) ? $bgObj['gradientLocation1'] : '';
			$gradientLocation2   = isset( $bgObj['gradientLocation2'] ) ? $bgObj['gradientLocation2'] : '';
			$gradientAngle       = isset( $bgObj['gradientAngle'] ) ? $bgObj['gradientAngle'] : '';
			$selectGradient      = isset( $bgObj['selectGradient'] ) ? $bgObj['selectGradient'] : '';
			$repeat              = isset( $bgObj['backgroundRepeat'] ) ? $bgObj['backgroundRepeat'] : '';
			$position            = isset( $bgObj['backgroundPosition'] ) ? $bgObj['backgroundPosition'] : '';
			$size                = isset( $bgObj['backgroundSize'] ) ? $bgObj['backgroundSize'] : '';
			$attachment          = isset( $bgObj['backgroundAttachment'] ) ? $bgObj['backgroundAttachment'] : '';
			$overlayType        = isset( $bgObj['overlayType'] ) ? $bgObj['overlayType'] : '';
			$overlayOpacity     = isset( $bgObj['overlayOpacity'] ) ? $bgObj['overlayOpacity'] : '';
			$bgImageColor      = isset( $bgObj['backgroundImageColor'] ) ? $bgObj['backgroundImageColor'] : '';
			$bgCustomSize      = isset( $bgObj['backgroundCustomSize'] ) ? $bgObj['backgroundCustomSize'] : '';
			$bgCustomSizeType = isset( $bgObj['backgroundCustomSizeType'] ) ? $bgObj['backgroundCustomSizeType'] : '';
			$bgVideo            = isset( $bgObj['backgroundVideo'] ) ? $bgObj['backgroundVideo'] : '';
			$bgVideoColor      = isset( $bgObj['backgroundVideoColor'] ) ? $bgObj['backgroundVideoColor'] : '';

			$customPosition = isset( $bgObj['customPosition'] ) ? $bgObj['customPosition'] : '';
			$xPosition      = isset( $bgObj['xPosition'] ) ? $bgObj['xPosition'] : '';
			$xPositionType = isset( $bgObj['xPositionType'] ) ? $bgObj['xPositionType'] : '';
			$yPosition      = isset( $bgObj['yPosition'] ) ? $bgObj['yPosition'] : '';
			$yPositionType = isset( $bgObj['yPositionType'] ) ? $bgObj['yPositionType'] : '';

			$bgOverlayImg              = isset( $bgObj['backgroundOverlayImage']['url'] ) ? $bgObj['backgroundOverlayImage']['url'] : '';
			$overlayRepeat              = isset( $bgObj['backgroundOverlayRepeat'] ) ? $bgObj['backgroundOverlayRepeat'] : '';
			$overlayPosition            = isset( $bgObj['backgroundOverlayPosition'] ) ? $bgObj['backgroundOverlayPosition'] : '';
			$overlaySize                = isset( $bgObj['backgroundOverlaySize'] ) ? $bgObj['backgroundOverlaySize'] : '';
			$overlayAttachment          = isset( $bgObj['backgroundOverlayAttachment'] ) ? $bgObj['backgroundOverlayAttachment'] : '';
			$blendMode                  = isset( $bgObj['blendMode'] ) ? $bgObj['blendMode'] : '';
			$bgOverlayCustomSize      = isset( $bgObj['backgroundOverlayCustomSize'] ) ? $bgObj['backgroundOverlayCustomSize'] : '';
			$bgOverlayCustomSizeType = isset( $bgObj['backgroundOverlayCustomSizeType'] ) ? $bgObj['backgroundOverlayCustomSizeType'] : '';

			$customOverlayPosition = isset( $bgObj['customOverlayPosition'] ) ? $bgObj['customOverlayPosition'] : '';
			$xOverlayPosition       = isset( $bgObj['xOverlayPosition'] ) ? $bgObj['xOverlayPosition'] : '';
			$xOverlayPositionType  = isset( $bgObj['xOverlayPositionType'] ) ? $bgObj['xOverlayPositionType'] : '';
			$yOverlayPosition       = isset( $bgObj['yOverlayPosition'] ) ? $bgObj['yOverlayPosition'] : '';
			$yOverlayPositionType  = isset( $bgObj['yOverlayPositionType'] ) ? $bgObj['yOverlayPositionType'] : '';

			$customXPosition = \Vexaltrix\Core\Support\Helper::getCssValue( $xPosition, $xPositionType );
			$customYPosition = \Vexaltrix\Core\Support\Helper::getCssValue( $yPosition, $yPositionType );

			$gradient = '';
			if ( 'custom' === $size ) {
				$size = $bgCustomSize . $bgCustomSizeType;
			}
			if ( 'basic' === $selectGradient ) {
				$gradient = $gradientValue;
			} elseif ( 'linear' === $gradientType && 'advanced' === $selectGradient ) {
				$gradient = 'linear-gradient(' . $gradientAngle . 'deg, ' . $gradientColor1 . ' ' . $gradientLocation1 . '%, ' . $gradientColor2 . ' ' . $gradientLocation2 . '%)';
			} elseif ( 'radial' === $gradientType && 'advanced' === $selectGradient ) {
				$gradient = 'radial-gradient( at center center, ' . $gradientColor1 . ' ' . $gradientLocation1 . '%, ' . $gradientColor2 . ' ' . $gradientLocation2 . '%)';
			}

			if ( '' !== $bgType ) {
				switch ( $bgType ) {
					case 'color':
						if ( '' !== $bgImg && '' !== $bgColor ) {
							$genBgCss['background-image'] = 'linear-gradient(to right, ' . $bgColor . ', ' . $bgColor . '), url(' . $bgImg . ');';
						} elseif ( '' === $bgImg ) {
							$genBgCss['background-color'] = $bgColor . ';';
						}
						break;

					case 'image':
						if ( isset( $repeat ) ) {
							$genBgCss['background-repeat'] = esc_attr( $repeat );
						}
						if ( 'custom' !== $customPosition && isset( $position ) && isset( $position['x'] ) && isset( $position['y'] ) ) {
							$positionValue                    = $position['x'] * 100 . '% ' . $position['y'] * 100 . '%';
							$genBgCss['background-position'] = $positionValue;
						} elseif ( 'custom' === $customPosition && isset( $xPosition ) && isset( $yPosition ) && isset( $xPositionType ) && isset( $yPositionType ) ) {
							$positionValue                    = false === $bgObj['centralizedPosition'] ? $customXPosition . ' ' . $customYPosition : 'calc(50% +  ' . $customXPosition . ') calc(50% + ' . $customYPosition . ')';
							$genBgCss['background-position'] = $positionValue;
						}

						if ( isset( $size ) ) {
							$genBgCss['background-size'] = esc_attr( $size );
						}

						if ( isset( $attachment ) ) {
							$genBgCss['background-attachment'] = esc_attr( $attachment );
						}

						// Handle overlays.
						if ( 'gradient' === $overlayType && '' !== $gradient ) {
							if ( 'yes' === $cssForOverlay ) {
								if ( '' !== $bgImg ) {
									$genBgCss['background-image'] = 'url(' . $bgImg . ')';
								}
								$genBgOverlayCss['background-image'] = $gradient;
								$genBgOverlayCss['opacity']          = $overlayOpacity;
							} else {
								$genBgCss['background-image'] = '' !== $bgImg ? $gradient . ', url(' . $bgImg . ')' : $gradient;
							}
						} elseif ( 'color' === $overlayType && '' !== $bgImageColor ) {
							if ( 'yes' === $cssForOverlay ) {
								if ( '' !== $bgImg ) {
									$genBgCss['background-image'] = 'url(' . $bgImg . ')';
								}
								$genBgOverlayCss['background'] = $bgImageColor;
								$genBgOverlayCss['opacity']    = $overlayOpacity;
							} else {
								if ( '' !== $bgImg ) {
									$genBgCss['background-image'] = 'linear-gradient(to right, ' . $bgImageColor . ', ' . $bgImageColor . '), url(' . $bgImg . ')';
								} else {
									$genBgCss['background'] = $bgImageColor;
								}
							}
						} elseif ( '' !== $bgImg ) {
							$genBgCss['background-image'] = 'url(' . $bgImg . ')';
						}
						
						$genBgCss['background-clip'] = 'padding-box';
						break;

					case 'gradient':
						if ( isset( $gradient ) ) {
							$genBgCss['background']      = $gradient . ';';
							$genBgCss['background-clip'] = 'padding-box';
						}
						break;
					case 'video':
						if ( 'color' === $overlayType && '' !== $bgVideo && '' !== $bgVideoColor ) {
							$genBgCss['background'] = $bgVideoColor . ';';
						}
						if ( 'gradient' === $overlayType && '' !== $bgVideo && '' !== $gradient ) {
							$genBgCss['background-image'] = $gradient . ';';
						}
						break;

					default:
						break;
				}
			} elseif ( '' !== $bgColor ) {
				$genBgCss['background-color'] = $bgColor . ';';
			}
			
			// image overlay.
			if ( 'image' === $overlayType ) {
				if ( 'custom' === $overlaySize ) {
					$overlaySize = $bgOverlayCustomSize . $bgOverlayCustomSizeType;
				}

				if ( $overlayRepeat ) {
					$genBgOverlayCss['background-repeat'] = esc_attr( $overlayRepeat );
				}
				if ( 'custom' !== $customOverlayPosition && $overlayPosition && isset( $overlayPosition['x'] ) && isset( $overlayPosition['y'] ) ) {
					$positionOverlayValue                    = $overlayPosition['x'] * 100 . '% ' . $overlayPosition['y'] * 100 . '%';
					$genBgOverlayCss['background-position'] = $positionOverlayValue;
				} elseif ( 'custom' === $customOverlayPosition && $xOverlayPosition && $yOverlayPosition && $xOverlayPositionType && $yOverlayPositionType ) {
					$positionOverlayValue                    = $xOverlayPosition . $xOverlayPositionType . ' ' . $yOverlayPosition . $yOverlayPositionType;
					$genBgOverlayCss['background-position'] = $positionOverlayValue;
				}

				if ( $overlaySize ) {
					$genBgOverlayCss['background-size'] = esc_attr( $overlaySize );
				}

				if ( $overlayAttachment ) {
					$genBgOverlayCss['background-attachment'] = esc_attr( $overlayAttachment );
				}
				if ( $blendMode ) {
					$genBgOverlayCss['mix-blend-mode'] = esc_attr( $blendMode );
				}
				if ( '' !== $bgOverlayImg ) {
					$genBgOverlayCss['background-image'] = 'url(' . $bgOverlayImg . ');';
				}
				$genBgOverlayCss['background-clip'] = 'padding-box';
				$genBgOverlayCss['opacity']         = $overlayOpacity;
			}
			
			return 'yes' === $cssForOverlay ? $genBgOverlayCss : $genBgCss;
		}


		/**
		 * Border attribute generation Function.
		 *
		 * @since 2.0.0
		 * @param  array $prefix   Attribute Prefix.
		 * @param array $defaultArgs  default attributes args.
		 * @return array
		 */
		public static function uagGeneratePhpBorderAttribute( $prefix, $defaultArgs = [] ) {

			$borderAttr = [];

			$device = [ '', 'Tablet', 'Mobile' ];

			foreach ( $device as $slug => $data ) {

				$borderAttr[ "{$prefix}BorderTopWidth{$data}" ]          = [
					'type' => 'number',
				];
				$borderAttr[ "{$prefix}BorderLeftWidth{$data}" ]         = [
					'type' => 'number',
				];
				$borderAttr[ "{$prefix}BorderRightWidth{$data}" ]        = [
					'type' => 'number',
				];
				$borderAttr[ "{$prefix}BorderBottomWidth{$data}" ]       = [
					'type' => 'number',
				];
				$borderAttr[ "{$prefix}BorderTopLeftRadius{$data}" ]     = [
					'type' => 'number',
				];
				$borderAttr[ "{$prefix}BorderTopRightRadius{$data}" ]    = [
					'type' => 'number',
				];
				$borderAttr[ "{$prefix}BorderBottomLeftRadius{$data}" ]  = [
					'type' => 'number',
				];
				$borderAttr[ "{$prefix}BorderBottomRightRadius{$data}" ] = [
					'type' => 'number',
				];
				$borderAttr[ "{$prefix}BorderRadiusUnit{$data}" ]        = [
					'type' => 'number',
				];
			}

			$borderAttr[ "{$prefix}BorderStyle" ]      = [
				'type' => 'string',
			];
			$borderAttr[ "{$prefix}BorderColor" ]      = [
				'type' => 'string',
			];
			$borderAttr[ "{$prefix}BorderHColor" ]     = [
				'type' => 'string',
			];
			$borderAttr[ "{$prefix}BorderLink" ]       = [
				'type'    => 'boolean',
				'default' => true,
			];
			$borderAttr[ "{$prefix}BorderRadiusLink" ] = [
				'type'    => 'boolean',
				'default' => true,
			];

			return $borderAttr;
		}

		/**
		 * Border attribute generation Function.
		 *
		 * @since 2.0.0
		 * @param  string $prefix   Attribute Prefix.
		 * @return array
		 */
		public static function uagGenerateBorderAttribute( $prefix ) {
			$defaults = [
				// Width.
				'borderTopWidth'                => '',
				'borderRightWidth'              => '',
				'borderBottomWidth'             => '',
				'borderLeftWidth'               => '',
				'borderTopWidthTablet'          => '',
				'borderRightWidthTablet'        => '',
				'borderBottomWidthTablet'       => '',
				'borderLeftWidthTablet'         => '',
				'borderTopWidthMobile'          => '',
				'borderRightWidthMobile'        => '',
				'borderBottomWidthMobile'       => '',
				'borderLeftWidthMobile'         => '',
				// Radius.
				'borderTopLeftRadius'           => '',
				'borderTopRightRadius'          => '',
				'borderBottomRightRadius'       => '',
				'borderBottomLeftRadius'        => '',
				'borderTopLeftRadiusTablet'     => '',
				'borderTopRightRadiusTablet'    => '',
				'borderBottomRightRadiusTablet' => '',
				'borderBottomLeftRadiusTablet'  => '',
				'borderTopLeftRadiusMobile'     => '',
				'borderTopRightRadiusMobile'    => '',
				'borderBottomRightRadiusMobile' => '',
				'borderBottomLeftRadiusMobile'  => '',
				// unit.
				'borderRadiusUnit'              => 'px',
				'borderRadiusUnitTablet'        => 'px',
				'borderRadiusUnitMobile'        => 'px',
				// common.
				'borderStyle'                   => '',
				'borderColor'                   => '',
				'borderHColor'                  => '',

			];

			$borderAttr = [];

			$device = [ '', 'Tablet', 'Mobile' ];

			foreach ( $device as $slug => $data ) {

				$borderAttr[ "{$prefix}BorderTopWidth{$data}" ]          = '';
				$borderAttr[ "{$prefix}BorderLeftWidth{$data}" ]         = '';
				$borderAttr[ "{$prefix}BorderRightWidth{$data}" ]        = '';
				$borderAttr[ "{$prefix}BorderBottomWidth{$data}" ]       = '';
				$borderAttr[ "{$prefix}BorderTopLeftRadius{$data}" ]     = '';
				$borderAttr[ "{$prefix}BorderTopRightRadius{$data}" ]    = '';
				$borderAttr[ "{$prefix}BorderBottomLeftRadius{$data}" ]  = '';
				$borderAttr[ "{$prefix}BorderBottomRightRadius{$data}" ] = '';
				$borderAttr[ "{$prefix}BorderRadiusUnit{$data}" ]        = 'px';
			}

			$borderAttr[ "{$prefix}BorderStyle" ]  = '';
			$borderAttr[ "{$prefix}BorderColor" ]  = '';
			$borderAttr[ "{$prefix}BorderHColor" ] = '';
			return $borderAttr;
		}

		/**
		 * Border CSS generation Function.
		 *
		 * @since 2.0.0
		 * @param  array  $attr   Attribute List.
		 * @param  string $prefix Attribuate prefix .
		 * @param  string $device Responsive.
		 * @return array         border css array.
		 */
		public static function uagGenerateBorderCss( $attr, $prefix, $device = 'desktop' ) {
			$genBorderCss = [];
			// ucfirst function is used to tranform text into first letter capital.
			$device = 'desktop' === $device ? '' : ucfirst( $device );
			if ( 'none' !== $attr[ $prefix . 'BorderStyle' ] && ! empty( $attr[ $prefix . 'BorderStyle' ] ) ) {
				$genBorderCss['border-top-width']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr[ $prefix . 'BorderTopWidth' . $device ], 'px' );
				$genBorderCss['border-left-width']   = \Vexaltrix\Core\Support\Helper::getCssValue( $attr[ $prefix . 'BorderLeftWidth' . $device ], 'px' );
				$genBorderCss['border-right-width']  = \Vexaltrix\Core\Support\Helper::getCssValue( $attr[ $prefix . 'BorderRightWidth' . $device ], 'px' );
				$genBorderCss['border-bottom-width'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr[ $prefix . 'BorderBottomWidth' . $device ], 'px' );
			}
			$genBorderUnit                                  = isset( $attr[ $prefix . 'BorderRadiusUnit' . $device ] ) ? $attr[ $prefix . 'BorderRadiusUnit' . $device ] : 'px';
				$genBorderCss['border-top-left-radius']     = \Vexaltrix\Core\Support\Helper::getCssValue( $attr[ $prefix . 'BorderTopLeftRadius' . $device ], $genBorderUnit );
				$genBorderCss['border-top-right-radius']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr[ $prefix . 'BorderTopRightRadius' . $device ], $genBorderUnit );
				$genBorderCss['border-bottom-left-radius']  = \Vexaltrix\Core\Support\Helper::getCssValue( $attr[ $prefix . 'BorderBottomLeftRadius' . $device ], $genBorderUnit );
				$genBorderCss['border-bottom-right-radius'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr[ $prefix . 'BorderBottomRightRadius' . $device ], $genBorderUnit );

			$genBorderCss['border-style'] = $attr[ $prefix . 'BorderStyle' ];
			$genBorderCss['border-color'] = $attr[ $prefix . 'BorderColor' ];

			if ( 'default' === $attr[ $prefix . 'BorderStyle' ] ) {
				return [];
			}

			return $genBorderCss;
		}

		/**
		 * Deprecated Border CSS generation Function.
		 *
		 * @since 2.0.0
		 * @param  array  $currentCss   Current style list.
		 * @param  string $borderWidth   Border Width.
		 * @param  string $borderRadius Border Radius.
		 * @param  string $borderColor Border Color.
		 * @param string $borderStyle Border Style.
		 */
		public static function uagGenerateDeprecatedBorderCss( $currentCss, $borderWidth, $borderRadius, $borderColor = '', $borderStyle = '' ) {

			$genBorderCss = [];

			if ( ! empty( $currentCss ) && isset( $currentCss['border-style'] ) && 'default' !== $currentCss['border-style'] ) {

				$borderWidth  = is_numeric( $borderWidth ) ? $borderWidth : '';
				$borderRadius = is_numeric( $borderRadius ) ? $borderRadius : '';

				// These would either be in the format of '1px', '0', or '-1px'.
				$genBorderCss['border-top-width']    = ( isset( $currentCss['border-top-width'] ) && ( ! empty( $currentCss['border-top-width'] ) || 0 === $currentCss['border-top-width'] ) ) ? $currentCss['border-top-width'] : \Vexaltrix\Core\Support\Helper::getCssValue( $borderWidth, 'px' );
				$genBorderCss['border-left-width']   = ( isset( $currentCss['border-left-width'] ) && ( ! empty( $currentCss['border-left-width'] ) || 0 === $currentCss['border-left-width'] ) ) ? $currentCss['border-left-width'] : \Vexaltrix\Core\Support\Helper::getCssValue( $borderWidth, 'px' );
				$genBorderCss['border-right-width']  = ( isset( $currentCss['border-right-width'] ) && ( ! empty( $currentCss['border-right-width'] ) || 0 === $currentCss['border-right-width'] ) ) ? $currentCss['border-right-width'] : \Vexaltrix\Core\Support\Helper::getCssValue( $borderWidth, 'px' );
				$genBorderCss['border-bottom-width'] = ( isset( $currentCss['border-bottom-width'] ) && ( ! empty( $currentCss['border-bottom-width'] ) || 0 === $currentCss['border-bottom-width'] ) ) ? $currentCss['border-bottom-width'] : \Vexaltrix\Core\Support\Helper::getCssValue( $borderWidth, 'px' );

				$genBorderCss['border-top-left-radius']     = ( isset( $currentCss['border-top-left-radius'] ) && ( ! empty( $currentCss['border-top-left-radius'] ) || 0 === $currentCss['border-top-left-radius'] ) ) ? $currentCss['border-top-left-radius'] : \Vexaltrix\Core\Support\Helper::getCssValue( $borderRadius, 'px' );
				$genBorderCss['border-top-right-radius']    = ( isset( $currentCss['border-top-right-radius'] ) && ( ! empty( $currentCss['border-top-right-radius'] ) || 0 === $currentCss['border-top-right-radius'] ) ) ? $currentCss['border-top-right-radius'] : \Vexaltrix\Core\Support\Helper::getCssValue( $borderRadius, 'px' );
				$genBorderCss['border-bottom-left-radius']  = ( isset( $currentCss['border-bottom-left-radius'] ) && ( ! empty( $currentCss['border-bottom-left-radius'] ) || 0 === $currentCss['border-bottom-left-radius'] ) ) ? $currentCss['border-bottom-left-radius'] : \Vexaltrix\Core\Support\Helper::getCssValue( $borderRadius, 'px' );
				$genBorderCss['border-bottom-right-radius'] = ( isset( $currentCss['border-bottom-right-radius'] ) && ( ! empty( $currentCss['border-bottom-right-radius'] ) || 0 === $currentCss['border-bottom-right-radius'] ) ) ? $currentCss['border-bottom-right-radius'] : \Vexaltrix\Core\Support\Helper::getCssValue( $borderRadius, 'px' );

				$genBorderCss['border-color'] = ( isset( $currentCss['border-color'] ) && ! empty( $currentCss['border-color'] ) ) ? $currentCss['border-color'] : $borderColor;

				$genBorderCss['border-style'] = ( isset( $currentCss['border-style'] ) && ! empty( $currentCss['border-style'] ) ) ? $currentCss['border-style'] : $borderStyle;
			}
			return $genBorderCss;
		}

		/**
		 * For flex-direction: row-reverse, justify-content work opposite.
		 *
		 * @since 2.0.0
		 * @param string $textAlign Alignment value from text-align property.
		 */
		public static function flexAlignmentWhenDirectionIsRowReverse( $textAlign ) {

			switch ( $textAlign ) {

				case 'flex-end':
					return 'flex-start';
				case 'center':
					return 'center';
				case 'space-between':
					return 'space-between';
				default:
					return 'flex-end';
			}

		}

		/**
		 * Get a Block's Default Attributes.
		 *
		 * @param string $blockName  Name of the block to retrieve defaults.
		 * @return array              All default attributes for the specified block.
		 */
		private static function getBlockDefaultAttributes( $blockName ) {
			$assetsFile = realpath( VXT_DIR . 'includes/blocks/' . basename( $blockName ) . '/attributes.php' );
			return ( is_string( $assetsFile ) && file_exists( $assetsFile ) ) ? require $assetsFile : [];
		}

		/**
		 * Return the Current Attribute or the Default Attribute.
		 *
		 * @param array  $currentValue  The current variable / attribute that is altered by settings.
		 * @param string $key           The key of the default attribute for that setting.
		 * @param string $blockName     The name of the block.
		 */
		public static function getAttributeFallback( $currentValue, $key, $blockName ) {
			$default = self::getBlockDefaultAttributes( $blockName );
			return isset( $currentValue ) ? $currentValue : $default[ $key ];
		}

		/**
		 * Return the Current Attribute or the Default Attribute for Numeric Data.
		 *
		 * @param array  $currentValue  The current variable / attribute that is altered by settings.
		 * @param string $key           The key of the default attribute for that setting.
		 * @param string $blockName     The name of the block.
		 */
		public static function getFallbackNumber( $currentValue, $key, $blockName ) {
			$default = self::getBlockDefaultAttributes( $blockName );
			return is_numeric( $currentValue ) ? $currentValue : $default[ $key ];
		}
		/**
		 * Get Matrix Alignment Value
		 *
		 * Syntax:
		 *
		 *  get_matrix_alignment( VALUE, POSITION, FORMAT );
		 *
		 * E.g.
		 *
		 *  get_matrix_alignment( VALUE, 2, 'flex' );
		 *
		 * @param string $value  Alignment Matrix value.
		 * @param int    $pos    Human readable position.
		 * @param string $format Response format.
		 * @return string        The formatted Matrix Alignment.
		 *
		 * @since 2.1.0
		 */
		public static function getMatrixAlignment( $value, $pos, $format = '' ) {

			// Return early if remote styles is not a string, or is empty, of if the position is not an integer.
			if ( ! is_string( $value ) || empty( $value ) || ! is_int( $pos ) ) {
				return '';
			}

			$alignmentArray = explode( ' ', esc_attr( $value ) );

			// Return early if alignment propery at the given position is not a string, or is empty.
			if ( ! is_string( $alignmentArray[ $pos - 1 ] ) || empty( $alignmentArray[ $pos - 1 ] ) ) {
				return '';
			}

			$alignmentProperty = $alignmentArray[ $pos - 1 ];

			switch ( $format ) {
				case 'flex':
					switch ( $alignmentProperty ) {
						case 'top':
						case 'left':
							$alignmentProperty = 'flex-start';
							break;
						case 'bottom':
						case 'right':
							$alignmentProperty = 'flex-end';
							break;
					}
					break;
			}
			return $alignmentProperty;
		}

		/**
		 * Generate Border Radius
		 *
		 * Syntax:
		 *
		 *  generate_border_radius( UNIT, TOP_LEFT, TOP_RIGHT, BOTTOM_RIGHT, BOTTOM_LEFT );
		 *
		 * E.g.
		 *
		 *  generate_border_radius( 'em', 9, 7, 5, 3 );
		 *
		 * @param string $unit  Alignment Matrix value.
		 * @param int    $topLeft  Top Left Value.
		 * @param int    $topRight  Top Right Value.
		 * @param int    $bottomRight  Bottom Right Value.
		 * @param int    $bottomLeft  Bottom Left Value.
		 * @since 2.1.0
		 */
		public static function generateBorderRadius( $unit, $topLeft, $topRight = null, $bottomRight = null, $bottomLeft = null ) {
			$borderRadius = ! is_null( $topRight )
				? (
					! is_null( $bottomRight )
					? (
						! is_null( $bottomLeft )
						? \Vexaltrix\Core\Support\Helper::getCssValue( $topLeft, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $topRight, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $bottomRight, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $bottomLeft, $unit )
						: \Vexaltrix\Core\Support\Helper::getCssValue( $topLeft, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $topRight, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $bottomRight, $unit )
					)
					: \Vexaltrix\Core\Support\Helper::getCssValue( $topLeft, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $topRight, $unit )
				)
				: \Vexaltrix\Core\Support\Helper::getCssValue( $topLeft, $unit );
			return $borderRadius;
		}

		/**
		 * Generate Spacing
		 *
		 * Syntax:
		 *
		 *  generate_spacing( UNIT, TOP, RIGHT, BOTTOM, LEFT );
		 *
		 * E.g.
		 *
		 *  generate_spacing( 'em', 9, 7, 5, 3 );
		 *
		 * @param string $unit   Alignment Matrix value.
		 * @param int    $top    Top Value.
		 * @param int    $right  Right Value.
		 * @param int    $bottom Bottom Value.
		 * @param int    $left   Left Value.
		 * @since 2.1.0
		 */
		public static function generateSpacing( $unit, $top, $right = null, $bottom = null, $left = null ) {
			$spacing = ! is_null( $right )
				? (
					! is_null( $bottom )
					? (
						! is_null( $left )
						? \Vexaltrix\Core\Support\Helper::getCssValue( $top, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $right, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $bottom, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $left, $unit )
						: \Vexaltrix\Core\Support\Helper::getCssValue( $top, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $right, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $bottom, $unit )
					)
					: \Vexaltrix\Core\Support\Helper::getCssValue( $top, $unit ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $right, $unit )
				)
				: \Vexaltrix\Core\Support\Helper::getCssValue( $top, $unit );
			return $spacing;
		}

		/**
		 * Get the Precise 2-Floating Point Percentage, Rounded to Floor for Precision.
		 *
		 * Syntax:
		 *
		 *  get_precise_percentage( DIVISIONS );
		 *
		 * E.g.
		 *
		 *  get_precise_percentage( 7 );
		 *
		 * @param int $divisions The number of divisions.
		 * @since 2.0.0
		 */
		public static function getPrecisePercentage( $divisions ) {
			$matches = [];
			preg_match( '/^-?\d+(?:\.\d{0,2})?/', strval( 100 / $divisions ), $matches );
			return floatval( $matches[0] ) . '%';
		}

		/**
		 * Generate the Box Shadow or Text Shadow CSS.
		 *
		 * For Text Shadow CSS:
		 * ( 'spread', 'position' ) should not be sent as params during the function call.
		 * ( 'spread_unit' ) will have no effect.
		 *
		 * For Box/Text Shadow Hover CSS:
		 * ( 'alt_color' ) should be set as the attribute used for ( 'color' ) in Box/Text Shadow Normal CSS.
		 *
		 * @param array $shadowProperties  Array containing the necessary shadow properties.
		 * @return string                   The generated border CSS or an empty string on early return.
		 *
		 * @since 2.5.0
		 */
		public static function generateShadowCss( $shadowProperties ) {
			// Get the Object Properties.
			$horizontal      = isset( $shadowProperties['horizontal'] ) ? $shadowProperties['horizontal'] : '';
			$vertical        = isset( $shadowProperties['vertical'] ) ? $shadowProperties['vertical'] : '';
			$blur            = isset( $shadowProperties['blur'] ) ? $shadowProperties['blur'] : '';
			$spread          = isset( $shadowProperties['spread'] ) ? $shadowProperties['spread'] : '';
			$horizontalUnit = isset( $shadowProperties['horizontal_unit'] ) ? $shadowProperties['horizontal_unit'] : 'px';
			$verticalUnit   = isset( $shadowProperties['vertical_unit'] ) ? $shadowProperties['vertical_unit'] : 'px';
			$blurUnit       = isset( $shadowProperties['blur_unit'] ) ? $shadowProperties['blur_unit'] : 'px';
			$spreadUnit     = isset( $shadowProperties['spread_unit'] ) ? $shadowProperties['spread_unit'] : 'px';
			$color           = isset( $shadowProperties['color'] ) ? $shadowProperties['color'] : '';
			$position        = isset( $shadowProperties['position'] ) ? $shadowProperties['position'] : 'outset';
			$altColor       = isset( $shadowProperties['alt_color'] ) ? $shadowProperties['alt_color'] : '';

			// Although optional, color is required for Sarafi on PC. Return early if color isn't set.
			if ( ! $color && ! $altColor ) {
				return '';
			}

			// Get the CSS units for the number properties.

			$horizontal = \Vexaltrix\Core\Support\Helper::getCssValue( $horizontal, $horizontalUnit );
			if ( '' === $horizontal ) {
				$horizontal = 0;
			}

			$vertical = \Vexaltrix\Core\Support\Helper::getCssValue( $vertical, $verticalUnit );
			if ( '' === $vertical ) {
				$vertical = 0;
			}

			$blur = \Vexaltrix\Core\Support\Helper::getCssValue( $blur, $blurUnit );
			if ( '' === $blur ) {
				$blur = 0;
			}

			$spread = \Vexaltrix\Core\Support\Helper::getCssValue( $spread, $spreadUnit );
			if ( '' === $spread ) {
				$spread = 0;
			}

			// If all numeric unit values are exactly 0, don't render the CSS.
			if ( ( 0 === $horizontal && 0 === $vertical ) && ( 0 === $blur && 0 === $spread ) ) {
				return '';
			}

			// Return the CSS with horizontal, vertical, blur, and color - and conditionally render spread and position.
			return (
				$horizontal . ' ' . $vertical . ' ' . $blur . ( $spread ? " {$spread}" : '' ) . ' ' . ( $color ? $color : $altColor ) . ( 'outset' === $position ? '' : " {$position}" )
			);
		}

		/**
		 * Generate the Grid CSS.
		 *
		 * @param array $gridObject  Array containing the necessary grid properties.
		 * @return string  The generated grid CSS or an empty string on early return.
		 *
		 * @since 2.13.0
		 */
		public static function gridCssCreator( $gridObject ) {
			$gridCss = '';
			foreach ( $gridObject as $grid ) {
				if ( $gridCss ) {
					$gridCss = $gridCss . ' ';
				}
				$createCss = '';
				if ( 'custom' === $grid['default'] && ( $grid['custom']['value'] || 0 === $grid['custom']['value'] ) ) {
					$createCss = 'minmax( 1px, ' . $grid['custom']['value'] . $grid['custom']['unit'] . ')';
				} elseif ( 'minmax' === $grid['default'] ) {
					$createCss = 'minmax(' . $grid['min']['value'] . $grid['min']['unit'] . ', ' . $grid['max']['value'] . $grid['max']['unit'] . ')';
				} elseif ( 'auto' === $grid['default'] ) {
					$createCss = 'auto';
				}

				$gridCss .= $createCss . ' ';
			}
			return $gridCss;
		}

		/**
		 * Generate the Grid CSS object according to the device type.
		 *
		 * @param array  $attr Array containing the necessary grid properties.
		 * @param string $deviceType Device type ex : Desktop, Tablet, Mobile.
		 * @return array Array of the css object ex : array( 'grid-template-columns' => '1fr 1fr 1fr', 'grid-template-rows' => '1fr 1fr 1fr' )
		 * 
		 * @since 2.13.0
		 */
		public static function gridCssObject( $attr, $deviceType = 'Desktop' ) {
			$gridCss = [];
			
			// Check attribute is not empty and should be array.
			if ( ! empty( $attr[ 'gridColumn' . $deviceType ] ) && is_array( $attr[ 'gridColumn' . $deviceType ] ) ) {
				$gridCss['grid-template-columns'] = self::gridCssCreator( $attr[ 'gridColumn' . $deviceType ] );
			}
		
			if ( ! empty( $attr[ 'gridRow' . $deviceType ] ) && is_array( $attr[ 'gridRow' . $deviceType ] ) ) {
				$gridCss['grid-template-rows'] = self::gridCssCreator( $attr[ 'gridRow' . $deviceType ] );
			}
		
			if ( ! empty( $attr[ 'gridAlignItems' . $deviceType ] ) ) {
				$gridCss['align-items'] = $attr[ 'gridAlignItems' . $deviceType ];
			}
		
			if ( ! empty( $attr[ 'gridJustifyItems' . $deviceType ] ) ) {
				$gridCss['justify-items'] = $attr[ 'gridJustifyItems' . $deviceType ];
			}
		
			if ( ! empty( $attr[ 'gridAlignContent' . $deviceType ] ) ) {
				$gridCss['align-content'] = $attr[ 'gridAlignContent' . $deviceType ];
			}
		
			if ( ! empty( $attr[ 'gridJustifyContent' . $deviceType ] ) ) {
				$gridCss['justify-content'] = $attr[ 'gridJustifyContent' . $deviceType ];
			}
			
			return $gridCss;
		}
	}
}
