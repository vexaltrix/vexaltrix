<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Add fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksAdvancedHeadingGfont( $attr );

$mSelectors = [];
$tSelectors = [];

$highlightBorderCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'highLight' );
$highlightBorderCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'highLight', 'tablet' );
$highlightBorderCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'highLight', 'mobile' );


$selectors = [
	'.wp-block-vxt-advanced-heading .vxt-heading-text' => [
		'color' => $attr['headingColor'],
	],
	'.wp-block-vxt-advanced-heading '                   => [
		'background'     => 'classic' === $attr['blockBackgroundType'] ? $attr['blockBackground'] : $attr['blockGradientBackground'],
		'text-align'     => $attr['headingAlign'],
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockTopMargin'],
			$attr['blockMarginUnit']
		),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockRightMargin'],
			$attr['blockMarginUnit']
		),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockBottomMargin'],
			$attr['blockMarginUnit']
		),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockLeftMargin'],
			$attr['blockMarginUnit']
		),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockTopPadding'],
			$attr['blockPaddingUnit']
		),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockRightPadding'],
			$attr['blockPaddingUnit']
		),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockBottomPadding'],
			$attr['blockPaddingUnit']
		),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockLeftPadding'],
			$attr['blockPaddingUnit']
		),
	],
	'.wp-block-vxt-advanced-heading a'                  => [
		'color' => $attr['linkColor'],
	],
	'.wp-block-vxt-advanced-heading a:hover'            => [
		'color' => $attr['linkHColor'],
	],
	'.wp-block-vxt-advanced-heading .vxt-desc-text'    => [
		'color'         => $attr['subHeadingColor'],
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['subHeadSpace'],
			'px'
		),
	],
	'.wp-block-vxt-advanced-heading .vxt-highlight'    => array_merge(
		[
			'background'              => $attr['highLightBackground'],
			'color'                   => $attr['highLightColor'],
			'-webkit-text-fill-color' => $attr['highLightColor'],
			'font-family'             => $attr['highLightFontFamily'],
			'font-style'              => $attr['highLightFontStyle'],
			'text-decoration'         => $attr['highLightDecoration'],
			'text-transform'          => $attr['highLightTransform'],
			'font-weight'             => $attr['highLightFontWeight'],
			'font-size'               => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightFontSize'], $attr['highLightFontSizeType'] ),
			'line-height'             => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightLineHeight'], $attr['highLightLineHeightType'] ),
			'padding-top'             => \Vexaltrix\Core\Support\Helper::getCssValue(
				$attr['highLightTopPadding'],
				$attr['highLightPaddingUnit']
			),
			'padding-right'           => \Vexaltrix\Core\Support\Helper::getCssValue(
				$attr['highLightRightPadding'],
				$attr['highLightPaddingUnit']
			),
			'padding-bottom'          => \Vexaltrix\Core\Support\Helper::getCssValue(
				$attr['highLightBottomPadding'],
				$attr['highLightPaddingUnit']
			),
			'padding-left'            => \Vexaltrix\Core\Support\Helper::getCssValue(
				$attr['highLightLeftPadding'],
				$attr['highLightPaddingUnit']
			),

		],
		$highlightBorderCss
	),
	'.wp-block-vxt-advanced-heading .vxt-highlight:hover' => [
		'border-color' => $attr['highLightBorderHColor'],
	],
];

$headingTextShadowColor = ( ! empty( $attr['headShadowColor'] ) ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headShadowHOffset'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headShadowVOffset'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headShadowBlur'], 'px' ) . ' ' . $attr['headShadowColor'] : '' );

if ( 'gradient' === $attr['headingColorType'] ) {
	$selectors['.wp-block-vxt-advanced-heading .vxt-heading-text'] = array_merge(
		$selectors['.wp-block-vxt-advanced-heading .vxt-heading-text'],
		[
			'background'              => $attr['headingGradientColor'],
			'-webkit-background-clip' => 'text',
			'-webkit-text-fill-color' => 'transparent',
			'filter'                  => 'drop-shadow( ' . $headingTextShadowColor . ' )',
		]
	);
	$selectors['.wp-block-vxt-advanced-heading a']                  = array_merge(
		$selectors['.wp-block-vxt-advanced-heading a'],
		[
			'-webkit-text-fill-color' => $attr['linkColor'],
		]
	);
	$selectors['.wp-block-vxt-advanced-heading a:hover']            = array_merge(
		$selectors['.wp-block-vxt-advanced-heading a:hover'],
		[
			'-webkit-text-fill-color' => $attr['linkHColor'],
		]
	);
} else {
	$selectors['.wp-block-vxt-advanced-heading .vxt-heading-text'] = array_merge(
		$selectors['.wp-block-vxt-advanced-heading .vxt-heading-text'],
		[
			'text-shadow' => $headingTextShadowColor,
		]
	);
}

// Text Selection & highlight.
$highlightSelectionText = [
	'color'                   => $attr['highLightColor'],
	'background'              => $attr['highLightBackground'],
	'-webkit-text-fill-color' => $attr['highLightColor'],
];

$selectors['.wp-block-vxt-advanced-heading .vxt-highlight::-moz-selection'] = $highlightSelectionText;
$selectors['.wp-block-vxt-advanced-heading .vxt-highlight::selection']      = $highlightSelectionText;



$seperatorStyle = isset( $attr['seperatorStyle'] ) ? $attr['seperatorStyle'] : '';

if ( 'none' !== $seperatorStyle ) {
	$selectors['.wp-block-vxt-advanced-heading .vxt-separator']   = [
		'border-top-style' => $attr['seperatorStyle'],
		'border-top-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['separatorHeight'],
			$attr['separatorHeightType']
		),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['separatorWidth'],
			$attr['separatorWidthType']
		),
		'border-color'     => $attr['separatorColor'],
		'margin-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['separatorSpace'],
			$attr['separatorSpaceType']
		),
	];
	$tSelectors['.wp-block-vxt-advanced-heading .vxt-separator'] = [
		'width'         => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['separatorWidthTablet'],
			$attr['separatorWidthType']
		),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['separatorSpaceTablet'],
			$attr['separatorSpaceType']
		),
	];
	$mSelectors['.wp-block-vxt-advanced-heading .vxt-separator'] = [
		'width'         => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['separatorWidthMobile'],
			$attr['separatorWidthType']
		),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['separatorSpaceMobile'],
			$attr['separatorSpaceType']
		),
	];
}
$tSelectors['.wp-block-vxt-advanced-heading '] = [
	'text-align'     => $attr['headingAlignTablet'],
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginTablet'], $attr['blockMarginUnitTablet'] ),
];

$tSelectors['.wp-block-vxt-advanced-heading .vxt-highlight'] = array_merge(
	[
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightTopPaddingTablet'], $attr['highLightPaddingUnitTablet'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightRightPaddingTablet'], $attr['highLightPaddingUnitTablet'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightBottomPaddingTablet'], $attr['highLightPaddingUnitTablet'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightLeftPaddingTablet'], $attr['highLightPaddingUnitTablet'] ),
	],
	$highlightBorderCssTablet
);

$mSelectors['.wp-block-vxt-advanced-heading ']                = [
	'text-align'     => $attr['headingAlignMobile'],
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginMobile'], $attr['blockMarginUnitMobile'] ),
];
$mSelectors['.wp-block-vxt-advanced-heading .vxt-highlight'] = array_merge(
	[
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightTopPaddingMobile'], $attr['highLightPaddingUnitMobile'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightRightPaddingMobile'], $attr['highLightPaddingUnitMobile'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightBottomPaddingMobile'], $attr['highLightPaddingUnitMobile'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highLightLeftPaddingMobile'], $attr['highLightPaddingUnitMobile'] ),
	],
	$highlightBorderCssMobile
);

$tSelectors['.wp-block-vxt-advanced-heading .vxt-desc-text'] = [
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
		$attr['subHeadSpaceTablet'],
		$attr['subHeadSpaceType']
	),
];
$mSelectors['.wp-block-vxt-advanced-heading .vxt-desc-text'] = [
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
		$attr['subHeadSpaceMobile'],
		$attr['subHeadSpaceType']
	),
];
if ( $attr['headingDescToggle'] || 'none' !== $attr['seperatorStyle'] ) {
	$selectors[' .vxt-heading-text']   = [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['headSpace'],
			'px'
		),
	];
	$tSelectors[' .vxt-heading-text'] = [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['headSpaceTablet'],
			$attr['headSpaceType']
		),
	];
	$mSelectors[' .vxt-heading-text'] = [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['headSpaceMobile'],
			$attr['headSpaceType']
		),
	];
}

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getCombinedSelectors(
	'advanced-heading',
	[
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	],
	$attr
);

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'head', ' .vxt-heading-text', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'subHead', ' .vxt-desc-text', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'highLight', '.wp-block-vxt-advanced-heading .vxt-highlight', $combinedSelectors );

$baseSelector = ( $attr['classMigrate'] ) ? '.wp-block-vxt-advanced-heading.vxt-block-' : '#vxt-adv-heading-';

return \Vexaltrix\Core\Support\Helper::generateAllCss(
	$combinedSelectors,
	$baseSelector . $id,
	isset( $gbsClass ) ? '.wp-block-vxt-advanced-heading' . $gbsClass : ''
);
