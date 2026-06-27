<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.6.0
 * @var string[] $attr
 * @var int $id
 * @package ugb
 */

// Add fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksSeparatorGfont( $attr );

$mSelectors = [];
$tSelectors = [];
$borderSize = '100%';


$borderCss             = [
	'-webkit-mask-size' => ( \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorSize'], $attr['separatorSizeType'] ) . ' ' . $borderSize ),
	'border-top-width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorBorderHeight'], $attr['separatorBorderHeightUnit'] ),
	'width'             => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorWidth'], $attr['separatorWidthType'] ),
	'border-top-color'  => $attr['separatorColor'],
	'border-top-style'  => $attr['separatorStyle'],
];
$borderDefaultMargins = [
	'margin-top'    => '5px',
	'margin-bottom' => '5px',
];

$borderStyle       = [];
$iconSpacingStyle = [];

if ( 'none' === $attr['elementType'] ) {
	$combinedBorderStyles = array_merge( $borderCss, $borderDefaultMargins );
	$borderStyle['.wp-block-vxt-separator:not(.wp-block-vxt-separator--text):not(.wp-block-vxt-separator--icon) .wp-block-vxt-separator__inner'] = $combinedBorderStyles;

} else { 
	$alignCss    = \Vexaltrix\Core\Support\Helper::alignmentCss( $attr['separatorAlign'] );
	$borderStyle = [
		'.wp-block-vxt-separator .wp-block-vxt-separator__inner' => array_merge(
			[
				'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorWidth'], $attr['separatorWidthType'] ),

			],
			$alignCss
		),
	];
	$borderStyle['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::before'] = $borderCss;
	$borderStyle['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::before'] = $borderCss;
	$borderStyle['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::after']  = $borderCss;
	$borderStyle['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::after']  = $borderCss;

	if ( 'left' === $attr['elementPosition'] ) {
		$iconSpacingStyle['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacing'], $attr['elementSpacingUnit'] ),
		];
		$borderStyle['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::before']                          = [
			'display' => 'none',
		];
		$borderStyle['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::before']                          = [
			'display' => 'none',
		];
	}
	if ( 'right' === $attr['elementPosition'] ) {
		$iconSpacingStyle['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacing'], $attr['elementSpacingUnit'] ),
		];
		$borderStyle['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::after']                           = [
			'display' => 'none',
		];
		$borderStyle['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::after']                           = [
			'display' => 'none',
		];
	}
	if ( 'center' === $attr['elementPosition'] ) {
		$iconSpacingStyle['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacing'], $attr['elementSpacingUnit'] ),
			'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacing'], $attr['elementSpacingUnit'] ),
		];
	}
}

$newPaddingTop        = empty( $attr['blockTopPadding'] ) && ! is_numeric( $attr['blockTopPadding'] ) ? $attr['separatorHeight'] : '';
$newPaddingBottom     = empty( $attr['blockBottomPadding'] ) && ! is_numeric( $attr['blockBottomPadding'] ) ? $attr['separatorHeight'] : '';
$newPaddingUnit       = empty( $attr['blockTopPaddingUnit'] ) ? $attr['separatorHeightType'] : '';
$blockPaddingUnitTablet = ! empty( $attr['blockPaddingUnitTablet'] ) ? $attr['blockPaddingUnitTablet'] : 'px';
$blockPaddingUnitMobile = ! empty( $attr['blockPaddingUnitMobile'] ) ? $attr['blockPaddingUnitMobile'] : 'px';
$blockPaddingUnit       = ! empty( $attr['blockPaddingUnit'] ) ? $attr['blockPaddingUnit'] : 'px';
$selectors              = [
	'.wp-block-vxt-separator'         => array_merge(
		[
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $newPaddingTop, $newPaddingUnit ),
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $newPaddingBottom, $newPaddingUnit ),
			'text-align'     => $attr['separatorAlign'],
		]
	),
	'.wp-block-vxt-separator--text .wp-block-vxt-separator-element .vxt-html-tag' => [
		'font-family'     => $attr['elementTextFontFamily'],
		'font-style'      => $attr['elementTextFontStyle'],
		'text-decoration' => $attr['elementTextDecoration'],
		'text-transform'  => $attr['elementTextTransform'],
		'font-weight'     => $attr['elementTextFontWeight'],
		'color'           => $attr['elementColor'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextFontSize'], $attr['elementTextFontSizeType'] ),
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextLineHeight'], $attr['elementTextLineHeightType'] ),
		'letter-spacing'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextLetterSpacing'], $attr['elementTextLetterSpacingType'] ),
	],
	'.wp-block-vxt-separator--icon .wp-block-vxt-separator-element svg' => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidth'], $attr['elementIconWidthType'] ),
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidth'], $attr['elementIconWidthType'] ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidth'], $attr['elementIconWidthType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidth'], $attr['elementIconWidthType'] ),
		'color'       => $attr['elementColor'],
		'fill'        => $attr['elementColor'],
	],
	' .vxt-separator-spacing-wrapper' => [
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMargin'], $attr['blockMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMargin'], $attr['blockMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMargin'], $attr['blockMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMargin'], $attr['blockMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPadding'], $blockPaddingUnit ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPadding'], $blockPaddingUnit ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPadding'], $blockPaddingUnit ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPadding'], $blockPaddingUnit ),
	],
];
$selectors              = array_merge( $selectors, $borderStyle, $iconSpacingStyle );

// Tablet.
$borderCssTablet = [
	'-webkit-mask-size' => ( \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorSizeTablet'], $attr['separatorSizeType'] ) . ' ' . $borderSize ),
	'border-top-width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorBorderHeightTablet'], $attr['separatorBorderHeightUnit'] ),
	'width'             => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorWidthTablet'], $attr['separatorWidthType'] ),
	'border-top-color'  => $attr['separatorColor'],
	'border-top-style'  => $attr['separatorStyle'],
];

$borderStyleTablet       = [];
$iconSpacingStyleTablet = [];
if ( 'none' === $attr['elementType'] ) {
	$combinedBorderStylesTablet = array_merge( $borderCssTablet, $borderDefaultMargins );
	$borderStyleTablet['.wp-block-vxt-separator:not(.wp-block-vxt-separator--text):not(.wp-block-vxt-separator--icon) .wp-block-vxt-separator__inner'] = $combinedBorderStylesTablet;

} else {
	$alignCss           = \Vexaltrix\Core\Support\Helper::alignmentCss( $attr['separatorAlignTablet'] );
	$borderStyleTablet = [
		'.wp-block-vxt-separator .wp-block-vxt-separator__inner' => array_merge(
			[
				'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorWidthTablet'], $attr['separatorWidthType'] ),

			],
			$alignCss
		),
	];
	$borderStyleTablet['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::before'] = $borderCssTablet;
	$borderStyleTablet['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::before'] = $borderCssTablet;
	$borderStyleTablet['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::after']  = $borderCssTablet;
	$borderStyleTablet['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::after']  = $borderCssTablet;
	if ( 'left' === $attr['elementPosition'] ) {
		$iconSpacingStyleTablet['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacingTablet'], $attr['elementSpacingUnit'] ),
		];
		$borderStyleTablet['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::before']                          = [
			'display' => 'none',
		];
		$borderStyleTablet['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::before']                          = [
			'display' => 'none',
		];
	}
	if ( 'center' === $attr['elementPosition'] ) {
		$iconSpacingStyleTablet['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacingTablet'], $attr['elementSpacingUnit'] ),
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacingTablet'], $attr['elementSpacingUnit'] ),
		];
	}
	if ( 'right' === $attr['elementPosition'] ) {
		$iconSpacingStyleTablet['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacingTablet'], $attr['elementSpacingUnit'] ),
		];
		$borderStyleTablet['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::after']                           = [
			'display' => 'none',
		];
		$borderStyleTablet['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::after']                           = [
			'display' => 'none',
		];
	}
}
$newPaddingTopTablet    = empty( $attr['blockTopPaddingTablet'] ) && ! is_numeric( $attr['blockTopPaddingTablet'] ) ? $attr['separatorHeightTablet'] : '';
$newPaddingBottomTablet = empty( $attr['blockBottomPaddingTablet'] ) && ! is_numeric( $attr['blockBottomPaddingTablet'] ) ? $attr['separatorHeightTablet'] : '';
$newPaddingUnitTablet   = empty( $attr['blockTopPaddingUnitTablet'] ) ? $attr['separatorHeightType'] : '';
$tSelectors               = [
	'.wp-block-vxt-separator'         => array_merge(
		[
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $newPaddingTopTablet, $newPaddingUnitTablet ),
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $newPaddingBottomTablet, $newPaddingUnitTablet ),
			'text-align'     => $attr['separatorAlignTablet'],
		]
),
	'.wp-block-vxt-separator--text .wp-block-vxt-separator-element .vxt-html-tag' => [
		'font-family'     => $attr['elementTextFontFamily'],
		'font-style'      => $attr['elementTextFontStyle'],
		'text-decoration' => $attr['elementTextDecoration'],
		'text-transform'  => $attr['elementTextTransform'],
		'font-weight'     => $attr['elementTextFontWeight'],
		'color'           => $attr['elementColor'],
		'margin-bottom'   => 'initial',
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextFontSizeTablet'], $attr['elementTextFontSizeType'] ),
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextLineHeightTablet'], $attr['elementTextLineHeightType'] ),
		'letter-spacing'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextLetterSpacingTablet'], $attr['elementTextLetterSpacingType'] ),
	],
	'.wp-block-vxt-separator--icon .wp-block-vxt-separator-element svg' => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidthTablet'], $attr['elementIconWidthType'] ),
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidthTablet'], $attr['elementIconWidthType'] ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidthTablet'], $attr['elementIconWidthType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidthTablet'], $attr    ['elementIconWidthType'] ),
		'color'       => $attr['elementColor'],
		'fill'        => $attr['elementColor'],
	],
	' .vxt-separator-spacing-wrapper' => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingTablet'], $blockPaddingUnitTablet ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingTablet'], $blockPaddingUnitTablet ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingTablet'], $blockPaddingUnitTablet ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingTablet'], $blockPaddingUnitTablet ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginTablet'], $attr['blockMarginUnitTablet'] ),
	],
];

$tSelectors = array_merge( $tSelectors, $borderStyleTablet, $iconSpacingStyleTablet );


// Mobile.
$borderCssMobile         = [
	'-webkit-mask-size' => ( \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorSizeMobile'], $attr['separatorSizeType'] ) . ' ' . $borderSize ),
	'border-top-width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorBorderHeightMobile'], $attr['separatorBorderHeightUnit'] ),
	'width'             => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorWidthMobile'], $attr['separatorWidthType'] ),
	'border-top-color'  => $attr['separatorColor'],
	'border-top-style'  => $attr['separatorStyle'],
];
$borderStyleMobile       = [];
$iconSpacingStyleMobile = [];
if ( 'none' === $attr['elementType'] ) {
	$combinedBorderStylesMobile = array_merge( $borderCssMobile, $borderDefaultMargins );
	$borderStyleMobile['.wp-block-vxt-separator:not(.wp-block-vxt-separator--text):not(.wp-block-vxt-separator--icon) .wp-block-vxt-separator__inner'] = $combinedBorderStylesMobile;

} else {
	$alignCss           = \Vexaltrix\Core\Support\Helper::alignmentCss( $attr['separatorAlignMobile'] );
	$borderStyleMobile = [
		'.wp-block-vxt-separator .wp-block-vxt-separator__inner' => array_merge(
			[
				'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['separatorWidthMobile'], $attr['separatorWidthType'] ),

			],
			$alignCss
		),
	];
	$borderStyleMobile['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::before'] = $borderCssMobile;
	$borderStyleMobile['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::before'] = $borderCssMobile;
	$borderStyleMobile['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::after']  = $borderCssMobile;
	$borderStyleMobile['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::after']  = $borderCssMobile;
	if ( 'left' === $attr['elementPosition'] ) {
		$iconSpacingStyleMobile['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacingMobile'], $attr['elementSpacingUnit'] ),

		];
		$borderStyleMobile['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::before'] = [
			'display' => 'none',
		];
		$borderStyleMobile['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::before'] = [
			'display' => 'none',
		];
	}
	if ( 'center' === $attr['elementPosition'] ) {
		$iconSpacingStyleMobile['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacingMobile'], $attr['elementSpacingUnit'] ),
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacingMobile'], $attr['elementSpacingUnit'] ),
		];
	}
	if ( 'right' === $attr['elementPosition'] ) {
		$iconSpacingStyleMobile['.wp-block-vxt-separator .wp-block-vxt-separator__inner .wp-block-vxt-separator-element'] = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementSpacingMobile'], $attr['elementSpacingUnit'] ),
		];
		$borderStyleMobile['.wp-block-vxt-separator--text .wp-block-vxt-separator__inner::after']                           = [
			'display' => 'none',
		];
		$borderStyleMobile['.wp-block-vxt-separator--icon .wp-block-vxt-separator__inner::after']                           = [
			'display' => 'none',
		];
	}
}
$newPaddingTopMobile    = empty( $attr['blockTopPaddingMobile'] ) && ! is_numeric( $attr['blockTopPaddingMobile'] ) ? $attr['separatorHeightMobile'] : '';
$newPaddingBottomMobile = empty( $attr['blockBottomPaddingMobile'] ) && ! is_numeric( $attr['blockBottomPaddingMobile'] ) ? $attr['separatorHeightMobile'] : '';
$newPaddingUnitMobile   = empty( $attr['blockTopPaddingUnitMobile'] ) ? $attr['separatorHeightType'] : '';
$mSelectors               = [
	'.wp-block-vxt-separator'         => array_merge(
		[
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $newPaddingTopMobile, $newPaddingUnitMobile ),
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $newPaddingBottomMobile, $newPaddingUnitMobile ),
			'text-align'     => $attr['separatorAlignMobile'],
		]
),
	'.wp-block-vxt-separator--text .wp-block-vxt-separator-element .vxt-html-tag' => [
		'font-family'     => $attr['elementTextFontFamily'],
		'font-style'      => $attr['elementTextFontStyle'],
		'text-decoration' => $attr['elementTextDecoration'],
		'text-transform'  => $attr['elementTextTransform'],
		'font-weight'     => $attr['elementTextFontWeight'],
		'color'           => $attr['elementColor'],
		'margin-bottom'   => 'initial',
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextFontSizeMobile'], $attr['elementTextFontSizeType'] ),
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextLineHeightMobile'], $attr['elementTextLineHeightType'] ),
		'letter-spacing'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementTextLetterSpacingMobile'], $attr['elementTextLetterSpacingType'] ),
	],
	'.wp-block-vxt-separator--icon .wp-block-vxt-separator-element svg' => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidthMobile'], $attr['elementIconWidthType'] ),
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidthMobile'], $attr['elementIconWidthType'] ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidthMobile'], $attr['elementIconWidthType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['elementIconWidthMobile'], $attr    ['elementIconWidthType'] ),
		'color'       => $attr['elementColor'],
		'fill'        => $attr['elementColor'],
	],
	' .vxt-separator-spacing-wrapper' => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingMobile'], $blockPaddingUnitMobile ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingMobile'], $blockPaddingUnitMobile ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingMobile'], $blockPaddingUnitMobile ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingMobile'], $blockPaddingUnitMobile ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginMobile'], $attr['blockMarginUnitMobile'] ),
	],
];
$mSelectors               = array_merge( $mSelectors, $borderStyleMobile, $iconSpacingStyleMobile );


$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
