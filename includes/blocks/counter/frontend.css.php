<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

// Add fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksCounterGfont( $attr );

$attr['prefixRightDistanceTablet'] = is_numeric( $attr['prefixRightDistanceTablet'] ) ? $attr['prefixRightDistanceTablet'] : $attr['prefixRightDistance'];
$attr['prefixRightDistanceMobile'] = is_numeric( $attr['prefixRightDistanceMobile'] ) ? $attr['prefixRightDistanceMobile'] : $attr['prefixRightDistanceTablet'];

$attr['suffixLeftDistanceTablet'] = is_numeric( $attr['suffixLeftDistanceTablet'] ) ? $attr['suffixLeftDistanceTablet'] : $attr['suffixLeftDistance'];
$attr['suffixLeftDistanceMobile'] = is_numeric( $attr['suffixLeftDistanceMobile'] ) ? $attr['suffixLeftDistanceMobile'] : $attr['suffixLeftDistanceTablet'];

$attr['iconSizeTablet'] = is_numeric( $attr['iconSizeTablet'] ) ? $attr['iconSizeTablet'] : $attr['iconSize'];
$attr['iconSizeMobile'] = is_numeric( $attr['iconSizeMobile'] ) ? $attr['iconSizeMobile'] : $attr['iconSizeTablet'];

$attr['imageWidthTablet'] = is_numeric( $attr['imageWidthTablet'] ) ? $attr['imageWidthTablet'] : $attr['imageWidth'];
$attr['imageWidthMobile'] = is_numeric( $attr['imageWidthMobile'] ) ? $attr['imageWidthMobile'] : $attr['imageWidthTablet'];

// Icon, Image Border CSS.
$iconWrapBorderCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'iconWrap' );
$iconWrapBorderCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'iconWrap', 'tablet' );
$iconWrapBorderCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'iconWrap', 'mobile' );

$circlePos    = ( $attr['circleSize'] / 2 );
$circleRadius = $circlePos - ( $attr['circleStokeSize'] / 2 );
$circleDash   = round( floatval( 2 * pi() * $circleRadius ), 2 );

// Icon and Image Common Padding.
$iconAndImageSpacing = [
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconTopPadding'], $attr['iconPaddingUnit'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconRightPadding'], $attr['iconPaddingUnit'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBottomPadding'], $attr['iconPaddingUnit'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconLeftPadding'], $attr['iconPaddingUnit'] ),

	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconTopMargin'], $attr['iconMarginUnit'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconRightMargin'], $attr['iconMarginUnit'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBottomMargin'], $attr['iconMarginUnit'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconLeftMargin'], $attr['iconMarginUnit'] ),
];

$iconAndImageSpacingTablet = [
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconTopPaddingTablet'], $attr['iconPaddingUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconRightPaddingTablet'], $attr['iconPaddingUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBottomPaddingTablet'], $attr['iconPaddingUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconLeftPaddingTablet'], $attr['iconPaddingUnitTablet'] ),

	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconTopMarginTablet'], $attr['iconMarginUnitTablet'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconRightMarginTablet'], $attr['iconMarginUnitTablet'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBottomMarginTablet'], $attr['iconMarginUnitTablet'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconLeftMarginTablet'], $attr['iconMarginUnitTablet'] ),
];

$iconAndImageSpacingMobile = [
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconTopPaddingMobile'], $attr['iconPaddingUnitMobile'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconRightPaddingMobile'], $attr['iconPaddingUnitMobile'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBottomPaddingMobile'], $attr['iconPaddingUnitMobile'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconLeftPaddingMobile'], $attr['iconPaddingUnitMobile'] ),

	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconTopMarginMobile'], $attr['iconMarginUnitMobile'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconRightMarginMobile'], $attr['iconMarginUnitMobile'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBottomMarginMobile'], $attr['iconMarginUnitMobile'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconLeftMarginMobile'], $attr['iconMarginUnitMobile'] ),
];

$boxShadowPositionCss = $attr['boxShadowPosition'];

if ( 'outset' === $attr['boxShadowPosition'] ) {
	$boxShadowPositionCss = '';
}

$boxShadowPositionCssHover = $attr['boxShadowPositionHover'];

if ( 'outset' === $attr['boxShadowPositionHover'] ) {
	$boxShadowPositionCssHover = '';
}

$mSelectors = [];
$tSelectors = [];

$selectors = [
	'.wp-block-vxt-counter'                               => [
		'text-align'     => $attr['align'],
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMargin'], $attr['blockMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMargin'], $attr['blockMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMargin'], $attr['blockMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMargin'], $attr['blockMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPadding'], $attr['blockPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPadding'], $attr['blockPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPadding'], $attr['blockPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPadding'], $attr['blockPaddingUnit'] ),
	],
	'.wp-block-vxt-counter .wp-block-vxt-counter__image-wrap' => array_merge(
		$iconAndImageSpacing
	),
	'.wp-block-vxt-counter .wp-block-vxt-counter__image-wrap img' => $iconWrapBorderCss,
	'.wp-block-vxt-counter:hover .wp-block-vxt-counter__image-wrap img' => [
		'border-color' => $attr['iconWrapBorderHColor'],
	],
	'.wp-block-vxt-counter .wp-block-vxt-counter__icon'  => array_merge(
		[
			'background-color' => $attr['iconBackgroundColor'],
		],
		$iconAndImageSpacing,
		$iconWrapBorderCss
	),
	'.wp-block-vxt-counter:hover .wp-block-vxt-counter__icon' => [
		'background-color' => $attr['iconBackgroundHoverColor'],
		'border-color'     => $attr['iconWrapBorderHColor'],
	],
	'.wp-block-vxt-counter .wp-block-vxt-counter__icon svg' => [
		'fill'   => $attr['iconColor'],
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeType'] ),
	],
	'.wp-block-vxt-counter:hover .wp-block-vxt-counter__icon svg' => [
		'fill' => $attr['iconHoverColor'],
	],
	'.wp-block-vxt-counter .wp-block-vxt-counter__title' => [
		'font-family'     => $attr['headingFontFamily'],
		'font-style'      => $attr['headingFontStyle'],
		'text-decoration' => $attr['headingDecoration'],
		'text-transform'  => $attr['headingTransform'],
		'font-weight'     => $attr['headingFontWeight'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingFontSize'], $attr['headingFontSizeType'] ),
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLineHeight'], $attr['headingLineHeightType'] ),
		'letter-spacing'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLetterSpacing'], $attr['headingLetterSpacingType'] ),
		'color'           => $attr['headingColor'],
		'margin-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingTopMargin'], $attr['headingMarginUnit'] ),
		'margin-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingRightMargin'], $attr['headingMarginUnit'] ),
		'margin-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingBottomMargin'], $attr['headingMarginUnit'] ),
		'margin-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLeftMargin'], $attr['headingMarginUnit'] ),
	],
	'.wp-block-vxt-counter .wp-block-vxt-counter__number' => [
		'font-family'     => $attr['numberFontFamily'],
		'font-style'      => $attr['numberFontStyle'],
		'text-decoration' => $attr['numberDecoration'],
		'text-transform'  => $attr['numberTransform'],
		'font-weight'     => $attr['numberFontWeight'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberFontSize'], $attr['numberFontSizeType'] ),
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLineHeight'], $attr['numberLineHeightType'] ),
		'letter-spacing'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLetterSpacing'], $attr['numberLetterSpacingType'] ),
		'color'           => $attr['numberColor'],
		'margin-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberTopMargin'], $attr['numberMarginUnit'] ),
		'margin-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberRightMargin'], $attr['numberMarginUnit'] ),
		'margin-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberBottomMargin'], $attr['numberMarginUnit'] ),
		'margin-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLeftMargin'], $attr['numberMarginUnit'] ),
	],
	'.wp-block-vxt-counter .wp-block-vxt-counter__number .vxt-counter-block-prefix' => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['prefixRightDistance'], 'px' ),
	],
	'.wp-block-vxt-counter .wp-block-vxt-counter__number .vxt-counter-block-suffix' => [
		'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['suffixLeftDistance'], 'px' ),
	],
	'.wp-block-vxt-counter--circle .wp-block-vxt-counter-circle-container' => [
		'max-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['circleSize'], 'px' ),
	],
	'.wp-block-vxt-counter--circle .wp-block-vxt-counter-circle-container svg circle' => [
		'stroke-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['circleStokeSize'], 'px' ),
		'stroke'       => $attr['circleBackground'],
		'r'            => \Vexaltrix\Core\Support\Helper::getCssValue( $circleRadius, 'px' ),
		'cx'           => \Vexaltrix\Core\Support\Helper::getCssValue( $circlePos, 'px' ),
		'cy'           => \Vexaltrix\Core\Support\Helper::getCssValue( $circlePos, 'px' ),
	],
	'.wp-block-vxt-counter--circle .wp-block-vxt-counter-circle-container svg .vxt-counter-circle__progress' => [
		'stroke'            => $attr['circleForeground'],
		'stroke-dasharray'  => \Vexaltrix\Core\Support\Helper::getCssValue( $circleDash, 'px' ),
		'stroke-dashoffset' => \Vexaltrix\Core\Support\Helper::getCssValue( $circleDash, 'px' ),
	],
	'.wp-block-vxt-counter--bars'                         => [
		'flex-direction' => $attr['barFlip'] ? 'column-reverse' : 'column',
	],
	'.wp-block-vxt-counter--bars .wp-block-vxt-counter-bars-container' => [
		'background' => $attr['barBackground'],
	],
	'.wp-block-vxt-counter--bars .wp-block-vxt-counter-bars-container .wp-block-vxt-counter__number' => [
		'height'         => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['barSize'], 'px' ),
		'background'     => $attr['barForeground'],
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberTopMargin'], $attr['numberMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberRightMargin'], $attr['numberMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberBottomMargin'], $attr['numberMarginUnit'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLeftMargin'], $attr['numberMarginUnit'] ),
	],
];

// tablet.
$tSelectors['.wp-block-vxt-counter'] = [
	'text-align'     => $attr['alignTablet'],
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
];

$tSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__image-wrap'] = $iconAndImageSpacingTablet;

$tSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__image-wrap img'] = $iconWrapBorderCssTablet;

$tSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__icon'] = array_merge(
	$iconAndImageSpacingTablet,
	$iconWrapBorderCssTablet
);

$tSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__icon svg'] = [
	'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTablet'], $attr['iconSizeTypeTablet'] ),
	'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTablet'], $attr['iconSizeTypeTablet'] ),
];

$tSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__title']                             = [
	'font-size'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingFontSizeTablet'], $attr['headingFontSizeType'] ),
	'line-height'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLineHeightTablet'], $attr['headingLineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLetterSpacingTablet'], $attr['headingLetterSpacingType'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingTopMarginTablet'], $attr['headingMarginUnitTablet'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingRightMarginTablet'], $attr['headingMarginUnitTablet'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingBottomMarginTablet'], $attr['headingMarginUnitTablet'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLeftMarginTablet'], $attr['headingMarginUnitTablet'] ),
];
$tSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__number']                            = [
	'font-size'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberFontSizeTablet'], $attr['numberFontSizeType'] ),
	'line-height'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLineHeightTablet'], $attr['numberLineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLetterSpacingTablet'], $attr['numberLetterSpacingType'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberTopMarginTablet'], $attr['numberMarginUnitTablet'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberRightMarginTablet'], $attr['numberMarginUnitTablet'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberBottomMarginTablet'], $attr['numberMarginUnitTablet'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLeftMarginTablet'], $attr['numberMarginUnitTablet'] ),
];
$tSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__number .vxt-counter-block-prefix'] = [
	'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['prefixRightDistanceTablet'], 'px' ),
];
$tSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__number .vxt-counter-block-suffix'] = [
	'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['suffixLeftDistanceTablet'], 'px' ),
];
$tSelectors['.wp-block-vxt-counter--bars .wp-block-vxt-counter-bars-container .wp-block-vxt-counter__number'] = [
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberTopMarginTablet'], $attr['numberMarginUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberRightMarginTablet'], $attr['numberMarginUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberBottomMarginTablet'], $attr['numberMarginUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLeftMarginTablet'], $attr['numberMarginUnitTablet'] ),
];

// mobile.
$mSelectors['.wp-block-vxt-counter'] = [
	'text-align'     => $attr['alignMobile'],
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
];

$mSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__image-wrap'] = $iconAndImageSpacingMobile;

$mSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__image-wrap img'] = $iconWrapBorderCssMobile;

$mSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__icon'] = array_merge(
	$iconAndImageSpacingMobile,
	$iconWrapBorderCssMobile
);

$mSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__icon svg'] = [
	'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMobile'], $attr['iconSizeTypeMobile'] ),
	'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMobile'], $attr['iconSizeTypeMobile'] ),
];

$mSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__title']                             = [
	'font-size'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingFontSizeMobile'], $attr['headingFontSizeType'] ),
	'line-height'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLineHeightMobile'], $attr['headingLineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLetterSpacingMobile'], $attr['headingLetterSpacingType'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingTopMarginMobile'], $attr['headingMarginUnitMobile'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingRightMarginMobile'], $attr['headingMarginUnitMobile'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingBottomMarginMobile'], $attr['headingMarginUnitMobile'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLeftMarginMobile'], $attr['headingMarginUnitMobile'] ),
];
$mSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__number']                            = [
	'font-size'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberFontSizeMobile'], $attr['numberFontSizeType'] ),
	'line-height'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLineHeightMobile'], $attr['numberLineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLetterSpacingMobile'], $attr['numberLetterSpacingType'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberTopMarginMobile'], $attr['numberMarginUnitMobile'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberRightMarginMobile'], $attr['numberMarginUnitMobile'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberBottomMarginMobile'], $attr['numberMarginUnitMobile'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLeftMarginMobile'], $attr['numberMarginUnitMobile'] ),
];
$mSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__number .vxt-counter-block-prefix'] = [
	'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['prefixRightDistanceMobile'], 'px' ),
];
$mSelectors['.wp-block-vxt-counter .wp-block-vxt-counter__number .vxt-counter-block-suffix'] = [
	'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['suffixLeftDistanceMobile'], 'px' ),
];
$mSelectors['.wp-block-vxt-counter--bars .wp-block-vxt-counter-bars-container .wp-block-vxt-counter__number'] = [
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberTopMarginMobile'], $attr['numberMarginUnitMobile'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberRightMarginMobile'], $attr['numberMarginUnitMobile'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberBottomMarginMobile'], $attr['numberMarginUnitMobile'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['numberLeftMarginMobile'], $attr['numberMarginUnitMobile'] ),
];

if ( $attr['imageWidthType'] ) {
	// Image.
	$selectors[' .wp-block-vxt-counter__image-wrap .wp-block-vxt-counter__image'] = [
		'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthUnit'] ),
	];

	$tSelectors[' .wp-block-vxt-counter__image-wrap .wp-block-vxt-counter__image'] = [
		'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthUnitTablet'] ),
	];

	$mSelectors[' .wp-block-vxt-counter__image-wrap .wp-block-vxt-counter__image'] = [
		'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthUnitMobile'] ),
	];
}

if ( 'number' === $attr['layout'] && ( 'left-number' === $attr['iconImgPosition'] || 'right-number' === $attr['iconImgPosition'] ) ) {

	$selectors[' .wp-block-vxt-counter__number'] = [
		'display'         => 'flex',
		'align-items'     => 'center',
		'justify-content' => $attr['align'],
	];

	$tSelectors[' .wp-block-vxt-counter__number'] = [
		'justify-content' => $attr['alignTablet'],
	];

	$mSelectors[' .wp-block-vxt-counter__number'] = [
		'justify-content' => $attr['alignMobile'],
	];
}

// In case of 'Bar' layout, we need to add padding to the number element and remove the margin.
if ( 'bars' === $attr['layout'] ) {

	$numContainer = '.wp-block-vxt-counter .wp-block-vxt-counter__number';

	$selectors[ $numContainer ]['margin-top']    = 'unset';
	$selectors[ $numContainer ]['margin-bottom'] = 'unset';
	$selectors[ $numContainer ]['margin-left']   = 'unset';
	$selectors[ $numContainer ]['margin-right']  = 'unset';

	$tSelectors[ $numContainer ]['margin-top']    = 'unset';
	$tSelectors[ $numContainer ]['margin-bottom'] = 'unset';
	$tSelectors[ $numContainer ]['margin-left']   = 'unset';
	$tSelectors[ $numContainer ]['margin-right']  = 'unset';

	$mSelectors[ $numContainer ]['margin-top']    = 'unset';
	$mSelectors[ $numContainer ]['margin-bottom'] = 'unset';
	$mSelectors[ $numContainer ]['margin-left']   = 'unset';
	$mSelectors[ $numContainer ]['margin-right']  = 'unset';

	if ( 0 === $attr['endNumber'] ) {

		$selectors[ $numContainer ]['padding-left']  = 'unset';
		$selectors[ $numContainer ]['padding-right'] = 'unset';

		$tSelectors[ $numContainer ]['padding-left']  = 'unset';
		$tSelectors[ $numContainer ]['padding-right'] = 'unset';

		$mSelectors[ $numContainer ]['padding-left']  = 'unset';
		$mSelectors[ $numContainer ]['padding-right'] = 'unset';

	}

	$barContainer       = '.wp-block-vxt-counter .wp-block-vxt-counter-bars-container';
	$barContainerHover = '.wp-block-vxt-counter:hover .wp-block-vxt-counter-bars-container';

	$selectors[ $barContainer ]['box-shadow'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) .
													' ' .
													\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) .
													' ' .
													\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) .
													' ' .
													\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) .
													' ' .
													$attr['boxShadowColor'] .
													' ' .
													$boxShadowPositionCss;

	// If hover blur or hover color are set, show the hover shadow.
	if ( ( ( '' !== $attr['boxShadowBlurHover'] ) && ( null !== $attr['boxShadowBlurHover'] ) ) || '' !== $attr['boxShadowColorHover'] ) {

		$selectors[ $barContainerHover ]['box-shadow'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffsetHover'], 'px' ) .
																	' ' .
															\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffsetHover'], 'px' ) .
															' ' .
															\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlurHover'], 'px' ) .
															' ' .
															\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpreadHover'], 'px' ) .
															' ' .
															$attr['boxShadowColorHover'] .
															' ' .
															$boxShadowPositionCssHover;

	}
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = '.vxt-block-';

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
