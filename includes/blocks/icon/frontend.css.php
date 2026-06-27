<?php
/**
 * Frontend CSS.
 *
 * @since 2.4.0
 * @var mixed[] $attr
 *
 * @package ugb
 */

$iconWidth = \Vexaltrix\Support\Helper::getCssValue(
	$attr['iconSize'],
	is_string( $attr['iconSizeUnit'] ) ? $attr['iconSizeUnit'] : ''
);

$transformation = \Vexaltrix\Support\Helper::getCssValue(
	$attr['rotation'],
	is_string( $attr['rotationUnit'] ) ? $attr['rotationUnit'] : ''
);

$background       = 'classic' === $attr['iconBackgroundColorType'] ? $attr['iconBackgroundColor'] : $attr['iconBackgroundGradientColor'];
$hoverBackground = 'classic' === $attr['iconHoverBackgroundColorType'] ? $attr['iconHoverBackgroundColor'] : $attr['iconHoverBackgroundGradientColor'];

$dropShadowProperties = [
	'horizontal' => $attr['iconShadowHOffset'],
	'vertical'   => $attr['iconShadowVOffset'],
	'blur'       => $attr['iconShadowBlur'],
	'color'      => $attr['iconShadowColor'],
];
$dropShadow            = \Vexaltrix\Core\Blocks\BlockHelper::generateShadowCss( $dropShadowProperties );

$boxShadowProperties = [
	'horizontal' => $attr['iconBoxShadowHOffset'],
	'vertical'   => $attr['iconBoxShadowVOffset'],
	'blur'       => $attr['iconBoxShadowBlur'],
	'spread'     => $attr['iconBoxShadowSpread'],
	'color'      => $attr['iconBoxShadowColor'],
	'position'   => $attr['iconBoxShadowPosition'],
];

$boxShadowHoverProperties = [
	'horizontal' => $attr['iconBoxShadowHOffsetHover'],
	'vertical'   => $attr['iconBoxShadowVOffsetHover'],
	'blur'       => $attr['iconBoxShadowBlurHover'],
	'spread'     => $attr['iconBoxShadowSpreadHover'],
	'color'      => $attr['iconBoxShadowColorHover'],
	'position'   => $attr['iconBoxShadowPositionHover'],
	'alt_color'  => $attr['iconBoxShadowColor'],
];

$boxShadow           = \Vexaltrix\Core\Blocks\BlockHelper::generateShadowCss( $boxShadowProperties );
$boxShadowHoverCss = \Vexaltrix\Core\Blocks\BlockHelper::generateShadowCss( $boxShadowHoverProperties );

$tSelectors = [];
$mSelectors = [];

$selectors['.vxt-icon-wrapper']                                     = [
	'text-align' => $attr['align'],
];
$selectors['.vxt-icon-wrapper .vxt-svg-wrapper a']                 = [
	'display' => 'contents',
];
$selectors['.vxt-icon-wrapper svg']                                 = [
	'width'      => $iconWidth,
	'height'     => $iconWidth,
	'transform'  => "rotate($transformation)",
	'box-sizing' => 'content-box',
	'fill'       => $attr['iconColor'],
	'filter'     => $dropShadow ? "drop-shadow( $dropShadow )" : '',
];
$selectors['.vxt-icon-wrapper .vxt-svg-wrapper:hover svg']         = [
	'fill' => $attr['iconHoverColor'],
];
$selectors['.vxt-icon-wrapper .vxt-svg-wrapper:focus-visible svg'] = [
	'fill' => $attr['iconHoverColor'],
];
$selectors['.vxt-icon-wrapper .vxt-svg-wrapper']                   = array_merge(
	[
		'display'        => 'inline-flex',
		'background'     => $background,
		// padding.
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconTopPadding'], $attr['iconPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconRightPadding'], $attr['iconPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconBottomPadding'], $attr['iconPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconLeftPadding'], $attr['iconPaddingUnit'] ),
		// border.
		'border-style'   => $attr['iconBorderStyle'],
		'border-color'   => $attr['iconBorderColor'],
		'box-shadow'     => $boxShadow,
	],
	\Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'icon' )
);
$selectors['.vxt-icon-wrapper .vxt-svg-wrapper:hover']             = [
	'border-color' => $attr['iconBorderHColor'],
	'background'   => $hoverBackground,
];
$selectors['.vxt-icon-wrapper .vxt-svg-wrapper:focus-visible']     = [
	'border-color' => $attr['iconBorderHColor'],
	'background'   => $hoverBackground,
];
$selectors['.vxt-icon-wrapper.wp-block-vxt-icon--has-margin .vxt-icon-margin-wrapper'] = [
	// margin.
	'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconTopMargin'], $attr['iconMarginUnit'] ),
	'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconRightMargin'], $attr['iconMarginUnit'] ),
	'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconBottomMargin'], $attr['iconMarginUnit'] ),
	'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconLeftMargin'], $attr['iconMarginUnit'] ),
];
$selectors['.vxt-icon-wrapper .vxt-svg-wrapper:hover']                                  = [
	'border-color' => $attr['iconBorderHColor'],
	'background'   => $hoverBackground,
];

// If using separate box shadow hover settings, then generate CSS for it.
if ( $attr['useSeparateBoxShadows'] ) {
	$selectors['.vxt-icon-wrapper .vxt-svg-wrapper:hover']         = [
		'box-shadow'   => $boxShadowHoverCss,
		'border-color' => $attr['iconBorderHColor'],
		'background'   => $hoverBackground,
	];
	$selectors['.vxt-icon-wrapper .vxt-svg-wrapper:focus-visible'] = [
		'box-shadow'   => $boxShadowHoverCss,
		'border-color' => $attr['iconBorderHColor'],
		'background'   => $hoverBackground,
	];

};

// Generates css for tablet devices.
$tIconWidth                                        = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSizeTablet'], $attr['iconSizeUnit'] );
$tSelectors['.vxt-icon-wrapper']                   = [
	'text-align' => $attr['alignTablet'],
];
$tSelectors['.vxt-icon-wrapper svg']               = [
	'width'  => $tIconWidth,
	'height' => $tIconWidth,
];
$tSelectors['.vxt-icon-wrapper .vxt-svg-wrapper'] = array_merge(
	[
		'display'        => 'inline-flex',
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconTopTabletPadding'], $attr['iconTabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconRightTabletPadding'], $attr['iconTabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconBottomTabletPadding'], $attr['iconTabletPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconLeftTabletPadding'], $attr['iconTabletPaddingUnit'] ),
	],
	\Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'icon', 'tablet' )
);
$tSelectors['.vxt-icon-wrapper.wp-block-vxt-icon--has-margin .vxt-icon-margin-wrapper'] = [
	'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconTopTabletMargin'], $attr['iconTabletMarginUnit'] ),
	'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconRightTabletMargin'], $attr['iconTabletMarginUnit'] ),
	'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconBottomTabletMargin'], $attr['iconTabletMarginUnit'] ),
	'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconLeftTabletMargin'], $attr['iconTabletMarginUnit'] ),
];
// Generates css for mobile devices.
$mIconWidth                                        = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSizeMobile'], $attr['iconSizeUnit'] );
$mSelectors['.vxt-icon-wrapper']                   = [
	'text-align' => $attr['alignMobile'],
];
$mSelectors['.vxt-icon-wrapper svg']               = [
	'width'  => $mIconWidth,
	'height' => $mIconWidth,
];
$mSelectors['.vxt-icon-wrapper .vxt-svg-wrapper'] = array_merge(
	[
		'display'        => 'inline-flex',
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconTopMobilePadding'], $attr['iconMobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconRightMobilePadding'], $attr['iconMobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconBottomMobilePadding'], $attr['iconMobilePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconLeftMobilePadding'], $attr['iconMobilePaddingUnit'] ),
	],
	\Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'icon', 'mobile' )
);
$mSelectors['.vxt-icon-wrapper.wp-block-vxt-icon--has-margin .vxt-icon-margin-wrapper'] = [
	'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconTopMobileMargin'], $attr['iconMobileMarginUnit'] ),
	'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconRightMobileMargin'], $attr['iconMobileMarginUnit'] ),
	'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconBottomMobileMargin'], $attr['iconMobileMarginUnit'] ),
	'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconLeftMobileMargin'], $attr['iconMobileMarginUnit'] ),
];
$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

return \Vexaltrix\Support\Helper::generateAllCss(
	$combinedSelectors,
	' .vxt-block-' . $id,
	isset( $gbsClass ) ? $gbsClass : ''
);
