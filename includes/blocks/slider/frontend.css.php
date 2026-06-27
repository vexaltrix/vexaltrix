<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.3.0
 * @var mixed[] $attr
 * @var int $id
 * @package ugb
 */

$blockName = 'slider';

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

$boxShadowCss       = \Vexaltrix\Presentation\Blocks\BlockHelper::generateShadowCss( $boxShadowProperties );
$boxShadowHoverCss = \Vexaltrix\Presentation\Blocks\BlockHelper::generateShadowCss( $boxShadowHoverProperties );

$border        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'slider' );
$borderTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'slider', 'tablet' );
$borderMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'slider', 'mobile' );

$arrowBorder        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'slider-arrow' );
$arrowBorderTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'slider-arrow', 'tablet' );
$arrowBorderMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'slider-arrow', 'mobile' );

$bgObjDesktop           = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => $attr['backgroundImageDesktop'],
	'backgroundColor'          => $attr['backgroundColor'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientType'             => $attr['gradientType'],
	'gradientLocation1'        => $attr['gradientLocation1'],
	'gradientLocation2'        => $attr['gradientLocation2'],
	'gradientAngle'            => $attr['gradientAngle'],
	'selectGradient'           => $attr['selectGradient'],
	'backgroundRepeat'         => $attr['backgroundRepeatDesktop'],
	'backgroundPosition'       => $attr['backgroundPositionDesktop'],
	'backgroundSize'           => $attr['backgroundSizeDesktop'],
	'backgroundAttachment'     => $attr['backgroundAttachmentDesktop'],
	'backgroundImageColor'     => $attr['backgroundImageColor'],
	'overlayType'              => $attr['overlayType'],
	'backgroundCustomSize'     => $attr['backgroundCustomSizeDesktop'],
	'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
	'customPosition'           => $attr['customPosition'],
	'xPosition'                => $attr['xPositionDesktop'],
	'xPositionType'            => $attr['xPositionType'],
	'yPosition'                => $attr['yPositionDesktop'],
	'yPositionType'            => $attr['yPositionType'],
];
$containerBgCssDesktop = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjDesktop );

// Tablet.
$leftPaddingTablet   = '' !== $attr['leftPaddingTablet'] ? $attr['leftPaddingTablet'] : $attr['leftPaddingDesktop'];
$rightPaddingTablet  = '' !== $attr['rightPaddingTablet'] ? $attr['rightPaddingTablet'] : $attr['rightPaddingDesktop'];
$topPaddingTablet    = '' !== $attr['topPaddingTablet'] ? $attr['topPaddingTablet'] : $attr['topPaddingDesktop'];
$bottomPaddingTablet = '' !== $attr['bottomPaddingTablet'] ? $attr['bottomPaddingTablet'] : $attr['bottomPaddingDesktop'];

$leftMarginTablet   = '' !== $attr['leftMarginTablet'] ? $attr['leftMarginTablet'] : $attr['leftMarginDesktop'];
$rightMarginTablet  = '' !== $attr['rightMarginTablet'] ? $attr['rightMarginTablet'] : $attr['rightMarginDesktop'];
$topMarginTablet    = '' !== $attr['topMarginTablet'] ? $attr['topMarginTablet'] : $attr['topMarginDesktop'];
$bottomMarginTablet = '' !== $attr['bottomMarginTablet'] ? $attr['bottomMarginTablet'] : $attr['bottomMarginDesktop'];

// Mobile.
$leftPaddingMobile   = '' !== $attr['leftPaddingMobile'] ? $attr['leftPaddingMobile'] : $leftPaddingTablet;
$rightPaddingMobile  = '' !== $attr['rightPaddingMobile'] ? $attr['rightPaddingMobile'] : $rightPaddingTablet;
$topPaddingMobile    = '' !== $attr['topPaddingMobile'] ? $attr['topPaddingMobile'] : $topPaddingTablet;
$bottomPaddingMobile = '' !== $attr['bottomPaddingMobile'] ? $attr['bottomPaddingMobile'] : $bottomPaddingTablet;

$leftMarginMobile   = '' !== $attr['leftMarginMobile'] ? $attr['leftMarginMobile'] : $leftMarginTablet;
$rightMarginMobile  = '' !== $attr['rightMarginMobile'] ? $attr['rightMarginMobile'] : $rightMarginTablet;
$topMarginMobile    = '' !== $attr['topMarginMobile'] ? $attr['topMarginMobile'] : $topMarginTablet;
$bottomMarginMobile = '' !== $attr['bottomMarginMobile'] ? $attr['bottomMarginMobile'] : $bottomMarginTablet;

$arrowSizeTablet = '' !== $attr['arrowSizeTablet'] ? $attr['arrowSizeTablet'] : $attr['arrowSize'];
$arrowSizeMobile = '' !== $attr['arrowSizeMobile'] ? $attr['arrowSizeMobile'] : $arrowSizeTablet;

$arrowDistanceTablet = '' !== $attr['arrowDistanceTablet'] ? $attr['arrowDistanceTablet'] : $attr['arrowDistance'];
$arrowDistanceMobile = '' !== $attr['arrowDistanceMobile'] ? $attr['arrowDistanceMobile'] : $arrowDistanceTablet;

$arrowPaddingTablet = '' !== $attr['arrowPaddingTablet'] ? $attr['arrowPaddingTablet'] : $attr['arrowPadding'];
$arrowPaddingMobile = '' !== $attr['arrowPaddingMobile'] ? $attr['arrowPaddingMobile'] : $arrowPaddingTablet;

$containerCss = array_merge(
	[
		'box-shadow'     => $boxShadowCss,
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingDesktop'], $attr['paddingType'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingDesktop'], $attr['paddingType'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingDesktop'], $attr['paddingType'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingDesktop'], $attr['paddingType'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginDesktop'], $attr['marginType'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginDesktop'], $attr['marginType'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginDesktop'], $attr['marginType'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginDesktop'], $attr['marginType'] ),
	],
	$border
);
$containerCss = array_merge( $containerCss, $containerBgCssDesktop );

$arrowStyle = [
	'color'            => esc_attr( $attr['arrowColor'] ),
	'background-color' => esc_attr( $attr['arrowBgColor'] ),
	'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['arrowPadding'] * 2 ) + $attr['arrowSize'], 'px' ),
	'height'           => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['arrowPadding'] * 2 ) + $attr['arrowSize'], 'px' ),
	'line-height'      => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['arrowPadding'] * 2 ) + $attr['arrowSize'], 'px' ),
];

$arrowStyle = array_merge( $arrowBorder, $arrowStyle );

$selectors = [
	'.vxt-block-' . $id                                  => $containerCss, // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	'.vxt-block-' . $id . '.vxt-slider-container:hover' => [
		'border-color' => $attr['sliderBorderHColor'],
	],
	'.vxt-block-' . $id . '.vxt-slider-container'       => [
		'border-color' => $border['border-color'] ? $border['border-color'] : '#4B4F58',
	],
	'.vxt-block-' . $id . ' .swiper-button-next:after'   => [
		'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowSize'], 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-button-prev:after'   => [
		'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowSize'], 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-pagination-bullet'   => [
		'background-color' => $attr['arrowColor'],
	],
	'.vxt-block-' . $id . ' .swiper-button-prev'         => [
		'left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowDistance'], 'px' ),
	],
	'.vxt-block-' . $id . '.vxt-slider-container .swiper-button-prev' => $arrowStyle,
	'.vxt-block-' . $id . '.vxt-slider-container .swiper-button-next' => $arrowStyle,
	'.vxt-block-' . $id . '.vxt-slider-container .swiper-button-next:hover' => [
		'border-color' => $attr['slider-arrowBorderHColor'],
	],
	'.vxt-block-' . $id . '.vxt-slider-container .swiper-button-prev:hover' => [
		'border-color' => $attr['slider-arrowBorderHColor'],
	],
	'.vxt-block-' . $id . ' .swiper-button-next'         => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowDistance'], 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-wrapper'             => [
		'align-items' => $attr['verticalAlign'],
		'min-height'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeight'], 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-pagination'          => [
		'bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['dotsMarginTop'], 'px' ),
	],
];

// If hover blur or hover color are set, show the hover shadow.
if ( $attr['useSeparateBoxShadows'] ) {

	$selectors[ '.vxt-block-' . $id . ':hover' ]['box-shadow'] = $boxShadowHoverCss;

}

$bgObjTablet           = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => ! empty( $attr['backgroundImageTablet'] ) ? $attr['backgroundImageTablet'] : $attr['backgroundImageDesktop'], // Tablet uses tablet image if it exists, otherwise fallback to desktop.
	'backgroundColor'          => $attr['backgroundColor'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientType'             => $attr['gradientType'],
	'gradientLocation1'        => is_numeric( $attr['gradientLocationTablet1'] ) ? $attr['gradientLocationTablet1'] : $bgObjDesktop['gradientLocation1'],
	'gradientLocation2'        => is_numeric( $attr['gradientLocationTablet2'] ) ? $attr['gradientLocationTablet2'] : $bgObjDesktop['gradientLocation2'],
	'gradientAngle'            => is_numeric( $attr['gradientAngleTablet'] ) ? $attr['gradientAngleTablet'] : $bgObjDesktop['gradientAngle'],
	'selectGradient'           => $attr['selectGradient'],
	'backgroundRepeat'         => $attr['backgroundRepeatTablet'],
	'backgroundPosition'       => $attr['backgroundPositionTablet'],
	'backgroundSize'           => $attr['backgroundSizeTablet'],
	'backgroundAttachment'     => $attr['backgroundAttachmentTablet'],
	'backgroundImageColor'     => $attr['backgroundImageColor'],
	'overlayType'              => $attr['overlayType'],
	'backgroundCustomSize'     => $attr['backgroundCustomSizeTablet'],
	'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
	'customPosition'           => $attr['customPosition'],
	'xPosition'                => $attr['xPositionTablet'],
	'xPositionType'            => $attr['xPositionTypeTablet'],
	'yPosition'                => $attr['yPositionTablet'],
	'yPositionType'            => $attr['yPositionTypeTablet'],
];
$containerBgCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjTablet );
$containerTabletCss    = array_merge(
	[
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingTablet, $attr['paddingTypeTablet'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $topMarginTablet, $attr['marginTypeTablet'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomMarginTablet, $attr['marginTypeTablet'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMarginTablet, $attr['marginTypeTablet'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMarginTablet, $attr['marginTypeTablet'] ),
	],
	$borderTablet
);
$containerTabletCss    = array_merge( $containerTabletCss, $containerBgCssTablet );

$arrowStyleTablet = [
	'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( ( $arrowPaddingTablet * 2 ) + $arrowSizeTablet, 'px' ),
	'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( ( $arrowPaddingTablet * 2 ) + $arrowSizeTablet, 'px' ),
	'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $arrowPaddingTablet * 2 ) + $arrowSizeTablet, 'px' ),
];

$arrowStyleTablet = array_merge( $arrowBorderTablet, $arrowStyleTablet );

$tSelectors = [
	'.vxt-block-' . $id                                => $containerTabletCss, // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	'.vxt-block-' . $id . ' .swiper-button-prev:after' => [
		'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $arrowSizeTablet, 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-button-next:after' => [
		'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $arrowSizeTablet, 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-button-prev'       => [
		'left' => \Vexaltrix\Core\Support\Helper::getCssValue( $arrowDistanceTablet, 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-button-next'       => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $arrowDistanceTablet, 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-pagination'        => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['dotsMarginTopTablet'], 'px' ),
	],
	'.vxt-block-' . $id . '.vxt-slider-container .swiper-button-prev' => $arrowStyleTablet,
	'.vxt-block-' . $id . '.vxt-slider-container .swiper-button-next' => $arrowStyleTablet,
	'.vxt-block-' . $id . ' .swiper-wrapper'           => [
		'min-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeightTablet'], 'px' ),
	],
];

// Mobile fallback chain: Mobile → Tablet → Desktop.
$mobileBgImage = $attr['backgroundImageDesktop']; // Default fallback.
if ( ! empty( $attr['backgroundImageMobile'] ) ) {
	$mobileBgImage = $attr['backgroundImageMobile'];
} elseif ( ! empty( $attr['backgroundImageTablet'] ) ) {
	$mobileBgImage = $attr['backgroundImageTablet'];
}

$bgObjMobile           = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => $mobileBgImage,
	'backgroundColor'          => $attr['backgroundColor'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientType'             => $attr['gradientType'],
	'gradientLocation1'        => is_numeric( $attr['gradientLocationMobile1'] ) ? $attr['gradientLocationMobile1'] : $bgObjTablet['gradientLocation1'],
	'gradientLocation2'        => is_numeric( $attr['gradientLocationMobile2'] ) ? $attr['gradientLocationMobile2'] : $bgObjTablet['gradientLocation2'],
	'gradientAngle'            => is_numeric( $attr['gradientAngleMobile'] ) ? $attr['gradientAngleMobile'] : $bgObjTablet['gradientAngle'],
	'selectGradient'           => $attr['selectGradient'],
	'backgroundRepeat'         => $attr['backgroundRepeatMobile'],
	'backgroundPosition'       => $attr['backgroundPositionMobile'],
	'backgroundSize'           => $attr['backgroundSizeMobile'],
	'backgroundAttachment'     => $attr['backgroundAttachmentMobile'],
	'backgroundImageColor'     => $attr['backgroundImageColor'],
	'overlayType'              => $attr['overlayType'],
	'backgroundCustomSize'     => $attr['backgroundCustomSizeMobile'],
	'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
	'customPosition'           => $attr['customPosition'],
	'xPosition'                => $attr['xPositionMobile'],
	'xPositionType'            => $attr['xPositionTypeMobile'],
	'yPosition'                => $attr['yPositionMobile'],
	'yPositionType'            => $attr['yPositionTypeMobile'],
];
$containerBgCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjMobile );
$containerMobileCss    = array_merge(
	[
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingMobile, $attr['paddingTypeMobile'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $topMarginMobile, $attr['marginTypeMobile'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomMarginMobile, $attr['marginTypeMobile'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMarginMobile, $attr['marginTypeMobile'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMarginMobile, $attr['marginTypeMobile'] ),
	],
	$borderMobile
);
$containerMobileCss    = array_merge( $containerMobileCss, $containerBgCssMobile );

$arrowStyleMobile = [
	'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( ( $arrowPaddingMobile * 2 ) + $arrowSizeMobile, 'px' ),
	'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( ( $arrowPaddingMobile * 2 ) + $arrowSizeMobile, 'px' ),
	'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $arrowPaddingMobile * 2 ) + $arrowSizeMobile, 'px' ),
];

$arrowStyleMobile = array_merge( $arrowBorderMobile, $arrowStyleMobile );

$mSelectors = [
	'.vxt-block-' . $id                                => $containerMobileCss, // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	'.vxt-block-' . $id . ' .swiper-button-prev:after' => [
		'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $arrowSizeMobile, 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-button-next:after' => [
		'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $arrowSizeMobile, 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-button-prev'       => [
		'left' => \Vexaltrix\Core\Support\Helper::getCssValue( $arrowDistanceMobile, 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-button-next'       => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $arrowDistanceMobile, 'px' ),
	],
	'.vxt-block-' . $id . ' .swiper-pagination'        => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['dotsMarginTopMobile'], 'px' ),
	],
	'.vxt-block-' . $id . '.vxt-slider-container .swiper-button-prev' => $arrowStyleMobile,
	'.vxt-block-' . $id . '.vxt-slider-container .swiper-button-next' => $arrowStyleMobile,
	'.vxt-block-' . $id . ' .swiper-wrapper'           => [
		'min-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeightMobile'], 'px' ),
	],
];

$zIndex        = isset( $attr['zIndex'] ) ? $attr['zIndex'] : '';
$zIndexTablet = isset( $attr['zIndexTablet'] ) ? $attr['zIndexTablet'] : '';
$zIndexMobile = isset( $attr['zIndexMobile'] ) ? $attr['zIndexMobile'] : '';

$selectors[ '.vxt-block-' . $id . '.uag-blocks-common-selector' ] = [
	'--z-index-desktop' => $zIndex,
	'--z-index-tablet'  => $zIndexTablet,
	'--z-index-mobile'  => $zIndexMobile,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getCombinedSelectors(
	'slider', 
	[
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	],
	$attr
);

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-slider-container' );
