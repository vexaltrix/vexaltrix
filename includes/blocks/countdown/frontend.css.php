<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.4.0
 *
 * @package ugb
 */

$attr = isset( $attr ) ? $attr : [];

\Vexaltrix\Core\Blocks\BlockJs::blocksCountdownGfont( $attr );

$isRtl = is_rtl();

$childSelectorType          = $isRtl ? 'first' : 'last';
$pseudoElementSelectorType = $isRtl ? 'before' : 'after';

$separatorSelector = '.wp-block-vxt-countdown .wp-block-vxt-countdown__box:not(:' . $childSelectorType . '-child) .wp-block-vxt-countdown__time::' . $pseudoElementSelectorType;

// On showSeconds disable this selector is used to remove the separator after minutes.
$minSeparatorRemovalSelector = '.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-minutes:not(:' .
$childSelectorType .
'-child) .wp-block-vxt-countdown__time.wp-block-vxt-countdown__time-minutes::' .
$pseudoElementSelectorType;

// On showSeconds and showMinutes disable this selector is used to remove the separator after hours.
$hourSeparatorRemovalSelector = '.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-hours:not(:' .
$childSelectorType .
'-child) .wp-block-vxt-countdown__time.wp-block-vxt-countdown__time-hours::' .
$pseudoElementSelectorType;

// On showSeconds, showMinutes and showHours disable this selector is used to remove the separator after days.
$daysSeparatorRemovalSelector = '.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-days:not(:' .
$childSelectorType .
'-child) .wp-block-vxt-countdown__time.wp-block-vxt-countdown__time-days::' .
$pseudoElementSelectorType;

// Box Border CSS.
$boxBorderCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'box' );
$boxBorderCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'box', 'tablet' );
$boxBorderCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'box', 'mobile' );

// Box Shadow.
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

$boxShadowCss       = \Vexaltrix\Core\Blocks\BlockHelper::generateShadowCss( $boxShadowProperties );
$boxShadowHoverCss = \Vexaltrix\Core\Blocks\BlockHelper::generateShadowCss( $boxShadowHoverProperties );

$mSelectors = [];
$tSelectors = [];

$selectors = [

	'.wp-block-vxt-countdown' => [
		'justify-content' => $attr['align'],
		'margin-top'      => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopMargin'], $attr['blockMarginUnit'] ),
		'margin-right'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightMargin'], $attr['blockMarginUnit'] ),
		'margin-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomMargin'], $attr['blockMarginUnit'] ),
		'margin-left'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftMargin'], $attr['blockMarginUnit'] ),
		'padding-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPadding'], $attr['blockPaddingUnit'] ),
		'padding-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPadding'], $attr['blockPaddingUnit'] ),
		'padding-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPadding'], $attr['blockPaddingUnit'] ),
		'padding-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPadding'], $attr['blockPaddingUnit'] ),
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__box-days' => [
		'display' => $attr['showDays'] ? '' : 'none',
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__box-hours' => [
		'display' => $attr['showHours'] ? '' : 'none',
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__box-minutes' => [
		'display' => $attr['showMinutes'] ? '' : 'none',
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__box-seconds' => [
		'display' => $attr['showSeconds'] ? '' : 'none',
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__box' => array_merge(
		[
			'aspect-ratio'     => $attr['isSquareBox'] ? 1 : 'auto',
			'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['boxWidth'], 'px' ),
			'height'           => $attr['isSquareBox'] ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxWidth'], 'px' ) : 'auto',
			'flex-direction'   => $attr['boxFlex'],
			'justify-content'  => ( 'column' !== $attr['boxFlex'] ) ? $attr['boxAlign'] : 'center',
			'align-items'      => ( 'row' !== $attr['boxFlex'] ) ? $attr['boxAlign'] : 'center',
			'background-color' => ( 'transparent' !== $attr['boxBgType'] ) ? $attr['boxBgColor'] : 'transparent',
			'padding-top'      => \Vexaltrix\Support\Helper::getCssValue( $attr['boxTopPadding'], $attr['boxPaddingUnit'] ),
			'padding-right'    => \Vexaltrix\Support\Helper::getCssValue( $attr['boxRightPadding'], $attr['boxPaddingUnit'] ),
			'padding-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['boxBottomPadding'], $attr['boxPaddingUnit'] ),
			'padding-left'     => \Vexaltrix\Support\Helper::getCssValue( $attr['boxLeftPadding'], $attr['boxPaddingUnit'] ),
			'row-gap'          => \Vexaltrix\Support\Helper::getCssValue( $attr['internalBoxSpacing'], 'px' ),
			'column-gap'       => \Vexaltrix\Support\Helper::getCssValue( $attr['internalBoxSpacing'], 'px' ),
			'box-shadow'       => $boxShadowCss,
		],
		$boxBorderCss
	),

	'.wp-block-vxt-countdown:hover .wp-block-vxt-countdown__box' => [
		'border-color' => $attr['boxBorderHColor'],
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-minutes:not(:last-child)' => [
		'margin-right' => $attr['showSeconds'] ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacing'], 'px' ) : 'unset',
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-hours:not(:last-child)' => [
		'margin-right' => ( $attr['showSeconds'] || $attr['showMinutes'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacing'], 'px' ) : 'unset',
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-days:not(:last-child)' => [
		'margin-right' => ( $attr['showSeconds'] || $attr['showMinutes'] || $attr['showHours'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacing'], 'px' ) : 'unset',
	],

	'.wp-block-vxt-countdown .wp-block-vxt-countdown__time' => [
		'font-family'     => $attr['digitFontFamily'],
		'font-style'      => $attr['digitFontStyle'],
		'text-decoration' => $attr['digitDecoration'],
		'font-weight'     => $attr['digitFontWeight'],
		'font-size'       => \Vexaltrix\Support\Helper::getCssValue( $attr['digitFontSize'], $attr['digitFontSizeType'] ),
		'line-height'     => \Vexaltrix\Support\Helper::getCssValue( $attr['digitLineHeight'], $attr['digitLineHeightType'] ),
		'letter-spacing'  => \Vexaltrix\Support\Helper::getCssValue( $attr['digitLetterSpacing'], $attr['digitLetterSpacingType'] ),
		'color'           => $attr['digitColor'],
	],

	'.wp-block-vxt-countdown div.wp-block-vxt-countdown__label' => [
		'align-self'      => ( ! $attr['isSquareBox'] && ( 'row' === $attr['boxFlex'] ) ) ? $attr['labelVerticalAlignment'] : 'unset',
		'font-family'     => $attr['labelFontFamily'],
		'font-style'      => $attr['labelFontStyle'],
		'text-decoration' => $attr['labelDecoration'],
		'text-transform'  => $attr['labelTransform'],
		'font-weight'     => $attr['labelFontWeight'],
		'font-size'       => \Vexaltrix\Support\Helper::getCssValue( $attr['labelFontSize'], $attr['labelFontSizeType'] ),
		'line-height'     => \Vexaltrix\Support\Helper::getCssValue( $attr['labelLineHeight'], $attr['labelLineHeightType'] ),
		'letter-spacing'  => \Vexaltrix\Support\Helper::getCssValue( $attr['labelLetterSpacing'], $attr['labelLetterSpacingType'] ),
		'color'           => $attr['labelColor'],
	],

];

// If using separate box shadow hover settings, then generate CSS for it.
if ( $attr['useSeparateBoxShadows'] ) {
	$selectors['.wp-block-vxt-countdown:hover .wp-block-vxt-countdown__box']['box-shadow'] = $boxShadowHoverCss;
}

// TABLET SELECTORS.

$tSelectors['.wp-block-vxt-countdown'] = [
	'justify-content' => $attr['alignTablet'],
	'margin-top'      => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-right'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-left'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'padding-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
];

$tSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box'] = array_merge(
	[
		'width'           => \Vexaltrix\Support\Helper::getCssValue( $attr['boxWidthTablet'], 'px' ),
		'height'          => $attr['isSquareBox'] ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxWidthTablet'], 'px' ) : 'auto',
		'flex-direction'  => $attr['boxFlexTablet'],
		'justify-content' => ( 'column' !== $attr['boxFlexTablet'] ) ? $attr['boxAlignTablet'] : 'center',
		'align-items'     => ( 'row' !== $attr['boxFlexTablet'] ) ? $attr['boxAlignTablet'] : 'center',
		'padding-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['boxTopPaddingTablet'], $attr['boxPaddingUnitTablet'] ),
		'padding-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['boxRightPaddingTablet'], $attr['boxPaddingUnitTablet'] ),
		'padding-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['boxBottomPaddingTablet'], $attr['boxPaddingUnitTablet'] ),
		'padding-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['boxLeftPaddingTablet'], $attr['boxPaddingUnitTablet'] ),
		'row-gap'         => \Vexaltrix\Support\Helper::getCssValue( $attr['internalBoxSpacingTablet'], 'px' ),
		'column-gap'      => \Vexaltrix\Support\Helper::getCssValue( $attr['internalBoxSpacingTablet'], 'px' ),
	],
	$boxBorderCssTablet
);

$tSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-minutes:not(:last-child)'] = [
	'margin-right' => $attr['showSeconds'] ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacingTablet'], 'px' ) : 'unset',
];

$tSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-hours:not(:last-child)'] = [
	'margin-right' => ( $attr['showSeconds'] || $attr['showMinutes'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacingTablet'], 'px' ) : 'unset',
];

$tSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-days:not(:last-child)'] = [
	'margin-right' => ( $attr['showSeconds'] || $attr['showMinutes'] || $attr['showHours'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacingTablet'], 'px' ) : 'unset',
];

$tSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__time'] = [
	'font-size'      => \Vexaltrix\Support\Helper::getCssValue( $attr['digitFontSizeTablet'], $attr['digitFontSizeTypeTablet'] ),
	'line-height'    => \Vexaltrix\Support\Helper::getCssValue( $attr['digitLineHeightTablet'], $attr['digitLineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Support\Helper::getCssValue( $attr['digitLetterSpacingTablet'], $attr['digitLetterSpacingType'] ),
];

$tSelectors['.wp-block-vxt-countdown div.wp-block-vxt-countdown__label'] = [
	'align-self'     => ( ! $attr['isSquareBox'] && ( 'row' === $attr['boxFlexTablet'] ) ) ? $attr['labelVerticalAlignmentTablet'] : 'unset',
	'font-size'      => \Vexaltrix\Support\Helper::getCssValue( $attr['labelFontSizeTablet'], $attr['labelFontSizeTypeTablet'] ),
	'line-height'    => \Vexaltrix\Support\Helper::getCssValue( $attr['labelLineHeightTablet'], $attr['labelLineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Support\Helper::getCssValue( $attr['labelLetterSpacingTablet'], $attr['labelLetterSpacingType'] ),
];

// MOBILE SELECTORS.

$mSelectors['.wp-block-vxt-countdown'] = [
	'justify-content' => $attr['alignMobile'],
	'margin-top'      => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-right'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-left'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'padding-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
];

$mSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box'] = array_merge(
	[
		'width'           => \Vexaltrix\Support\Helper::getCssValue( $attr['boxWidthMobile'], 'px' ),
		'height'          => $attr['isSquareBox'] ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxWidthMobile'], 'px' ) : 'auto',
		'flex-direction'  => $attr['boxFlexMobile'],
		'justify-content' => ( 'column' !== $attr['boxFlexMobile'] ) ? $attr['boxAlignMobile'] : 'center',
		'align-items'     => ( 'row' !== $attr['boxFlexMobile'] ) ? $attr['boxAlignMobile'] : 'center',
		'padding-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['boxTopPaddingMobile'], $attr['boxPaddingUnitMobile'] ),
		'padding-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['boxRightPaddingMobile'], $attr['boxPaddingUnitMobile'] ),
		'padding-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['boxBottomPaddingMobile'], $attr['boxPaddingUnitMobile'] ),
		'padding-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['boxLeftPaddingMobile'], $attr['boxPaddingUnitMobile'] ),
		'row-gap'         => \Vexaltrix\Support\Helper::getCssValue( $attr['internalBoxSpacingMobile'], 'px' ),
		'column-gap'      => \Vexaltrix\Support\Helper::getCssValue( $attr['internalBoxSpacingMobile'], 'px' ),
	],
	$boxBorderCssMobile
);

$mSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-minutes:not(:last-child)'] = [
	'margin-right' => $attr['showSeconds'] ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacingMobile'], 'px' ) : 'unset',
];

$mSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-hours:not(:last-child)'] = [
	'margin-right' => ( $attr['showSeconds'] || $attr['showMinutes'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacingMobile'], 'px' ) : 'unset',
];

$mSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box.wp-block-vxt-countdown__box-days:not(:last-child)'] = [
	'margin-right' => ( $attr['showSeconds'] || $attr['showMinutes'] || $attr['showHours'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacingMobile'], 'px' ) : 'unset',
];

$mSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__time'] = [
	'font-size'      => \Vexaltrix\Support\Helper::getCssValue( $attr['digitFontSizeMobile'], $attr['digitFontSizeTypeMobile'] ),
	'line-height'    => \Vexaltrix\Support\Helper::getCssValue( $attr['digitLineHeightMobile'], $attr['digitLineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Support\Helper::getCssValue( $attr['digitLetterSpacingMobile'], $attr['digitLetterSpacingType'] ),
];

$mSelectors['.wp-block-vxt-countdown div.wp-block-vxt-countdown__label'] = [
	'align-self'     => ( ! $attr['isSquareBox'] && ( 'row' === $attr['boxFlexMobile'] ) ) ? $attr['labelVerticalAlignmentMobile'] : 'unset',
	'font-size'      => \Vexaltrix\Support\Helper::getCssValue( $attr['labelFontSizeMobile'], $attr['labelFontSizeTypeMobile'] ),
	'line-height'    => \Vexaltrix\Support\Helper::getCssValue( $attr['labelLineHeightMobile'], $attr['labelLineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Support\Helper::getCssValue( $attr['labelLetterSpacingMobile'], $attr['labelLetterSpacingType'] ),
];

if ( true === $attr['showSeparator'] ) {

	$selectors[ $separatorSelector ] = [
		'content'     => $attr['separatorType'] ? "'" . $attr['separatorType'] . "'" : '',
		'font-family' => $attr['separatorFontFamily'],
		'font-style'  => $attr['separatorFontStyle'],
		'font-weight' => $attr['separatorFontWeight'],
		'font-size'   => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorFontSize'], $attr['separatorFontSizeType'] ),
		'line-height' => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorLineHeight'], $attr['separatorLineHeightType'] ),
		'color'       => $attr['separatorColor'],
		'right'       => is_int( $attr['separatorRightSpacing'] ) ? \Vexaltrix\Support\Helper::getCssValue( -$attr['separatorRightSpacing'], 'px' ) : '',
		'top'         => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorTopSpacing'], 'px' ),
	];

	$selectors[ $minSeparatorRemovalSelector ] = [
		'display' => $attr['showSeconds'] ? '' : 'none',
	];

	$selectors[ $hourSeparatorRemovalSelector ] = [
		'display' => ( $attr['showMinutes'] || $attr['showSeconds'] ) ? '' : 'none',
	];

	$selectors[ $daysSeparatorRemovalSelector ] = [
		'display' => ( $attr['showHours'] || $attr['showMinutes'] || $attr['showSeconds'] ) ? '' : 'none',
	];

	$tSelectors[ $separatorSelector ] = [
		'font-size'   => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorFontSizeTablet'], $attr['separatorFontSizeTypeTablet'] ),
		'line-height' => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorLineHeightTablet'], $attr['separatorLineHeightType'] ),
		'right'       => is_int( $attr['separatorRightSpacingTablet'] ) ? \Vexaltrix\Support\Helper::getCssValue( -$attr['separatorRightSpacingTablet'], 'px' ) : '',
		'top'         => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorTopSpacingTablet'], 'px' ),
	];

	$mSelectors[ $separatorSelector ] = [
		'font-size'   => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorFontSizeMobile'], $attr['separatorFontSizeTypeMobile'] ),
		'line-height' => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorLineHeightMobile'], $attr['separatorLineHeightType'] ),
		'right'       => is_int( $attr['separatorRightSpacingMobile'] ) ? \Vexaltrix\Support\Helper::getCssValue( -$attr['separatorRightSpacingMobile'], 'px' ) : '',
		'top'         => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorTopSpacingMobile'], 'px' ),
	];
}

// RTL support for box gap.
if ( $isRtl ) {
	$boxGapSelectorLTR = '.wp-block-vxt-countdown .wp-block-vxt-countdown__box:not(:last-child)';
	$boxGapSelectorRTL = '.wp-block-vxt-countdown .wp-block-vxt-countdown__box:not(:first-child)';

	$selectors[ $boxGapSelectorLTR ]['margin-right']   = 'unset';
	$tSelectors[ $boxGapSelectorLTR ]['margin-right'] = 'unset';
	$mSelectors[ $boxGapSelectorLTR ]['margin-right'] = 'unset';

	$selectors[ $boxGapSelectorRTL ]['margin-right']   = \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacing'], 'px' );
	$tSelectors[ $boxGapSelectorRTL ]['margin-right'] = \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacingTablet'], 'px' );
	$mSelectors[ $boxGapSelectorRTL ]['margin-right'] = \Vexaltrix\Support\Helper::getCssValue( $attr['boxSpacingMobile'], 'px' );
}


if ( ! empty( $attr['globalBlockStyleId'] ) && empty( $attr['isSquareBox'] ) ) {
	
	$selectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box']['aspect-ratio'] = '';
	$selectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box']['height']       = '';

	// For Tablet.
	$tSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box']['aspect-ratio'] = '';
	$tSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box']['height']       = '';

	// For Mobile.
	$mSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box']['aspect-ratio'] = '';
	$mSelectors['.wp-block-vxt-countdown .wp-block-vxt-countdown__box']['height']       = '';
}

$combinedSelectors = \Vexaltrix\Support\Helper::getCombinedSelectors(
	'countdown',
	[
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	],
	$attr 
);

$baseSelector = '.vxt-block-';

return \Vexaltrix\Support\Helper::generateAllCss(
	$combinedSelectors,
	$baseSelector . $id,
	isset( $gbsClass ) ? $gbsClass : ''
);
