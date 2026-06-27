<?php
/**
 * Slider child front end style
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @var int $id
 * @package ugb
 */

$blockName = 'slider';

$bgObjDesktop        = [
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
$sliderBgCssDesktop = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjDesktop );

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

$sliderCss = array_merge(
	[
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['topPaddingDesktop'], $attr['paddingType'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['bottomPaddingDesktop'], $attr['paddingType'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['leftPaddingDesktop'], $attr['paddingType'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['rightPaddingDesktop'], $attr['paddingType'] ),
		'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['topMarginDesktop'], $attr['marginType'] ),
		'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['bottomMarginDesktop'], $attr['marginType'] ),
		'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['leftMarginDesktop'], $attr['marginType'] ),
		'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['rightMarginDesktop'], $attr['marginType'] ),
	]
);
$sliderCss = array_merge( $sliderCss, $sliderBgCssDesktop );

$selectors = [
	' .swiper-content' => $sliderCss, // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
];

$bgObjTablet        = [
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
$sliderBgCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjTablet );
$sliderTabletCss    = array_merge(
	[
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $topPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $bottomPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $leftPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $rightPaddingTablet, $attr['paddingTypeTablet'] ),
		'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $topMarginTablet, $attr['marginTypeTablet'] ),
		'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $bottomMarginTablet, $attr['marginTypeTablet'] ),
		'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $leftMarginTablet, $attr['marginTypeTablet'] ),
		'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $rightMarginTablet, $attr['marginTypeTablet'] ),
	]
);
$sliderTabletCss    = array_merge( $sliderTabletCss, $sliderBgCssTablet );

$tSelectors = [
	' .swiper-content' => $sliderTabletCss, // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
];

$bgObjMobile        = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => ! empty( $attr['backgroundImageMobile'] ) ? $attr['backgroundImageMobile'] : ( ! empty( $attr['backgroundImageTablet'] ) ? $attr['backgroundImageTablet'] : $attr['backgroundImageDesktop'] ),
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
$sliderBgCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjMobile );
$sliderMobileCss    = array_merge(
	[
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $topPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $bottomPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $leftPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $rightPaddingMobile, $attr['paddingTypeMobile'] ),
		'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $topMarginMobile, $attr['marginTypeMobile'] ),
		'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $bottomMarginMobile, $attr['marginTypeMobile'] ),
		'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $leftMarginMobile, $attr['marginTypeMobile'] ),
		'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $rightMarginMobile, $attr['marginTypeMobile'] ),
	]
);
$sliderMobileCss    = array_merge( $sliderMobileCss, $sliderBgCssMobile );
$mSelectors          = [
	' .swiper-content' => $sliderMobileCss, // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
