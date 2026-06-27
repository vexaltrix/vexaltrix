<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @var int $id
 *
 * @package ugb
 */

// Add fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksStarRatingGfont( $attr );

$tSelectors = [];
$mSelectors = [];
$selectors   = [];

$alignment        = 'flex-start';
$alignmentTablet = 'flex-start';
$alignmentMobile = 'flex-start';

if ( '' !== $attr['align'] ) {
	if ( 'right' === $attr['align'] ) {
		$alignment = 'flex-end';
	} elseif ( 'center' === $attr['align'] ) {
		$alignment = 'center';
	} elseif ( 'full' === $attr['align'] ) {
		$alignment = 'space-between';
	} else {
		$alignment = 'flex-start';
	}
}

if ( '' !== $attr['alignTablet'] ) {
	if ( 'right' === $attr['alignTablet'] ) {
		$alignmentTablet = 'flex-end';
	} elseif ( 'center' === $attr['alignTablet'] ) {
		$alignmentTablet = 'center';
	} elseif ( 'full' === $attr['alignTablet'] ) {
		$alignmentTablet = 'space-between';
	} else {
		$alignmentTablet = 'flex-start';
	}
}

if ( '' !== $attr['alignMobile'] ) {
	if ( 'right' === $attr['alignMobile'] ) {
		$alignmentMobile = 'flex-end';
	} elseif ( 'center' === $attr['alignMobile'] ) {
		$alignmentMobile = 'center';
	} elseif ( 'full' === $attr['alignMobile'] ) {
		$alignmentMobile = 'space-between';
	} else {
		$alignmentMobile = 'flex-start';
	}
}

$wrapperCSS = [
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
];

$selectors = [
	' .uag-star-rating'        => [
		'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['size'], 'px' ),
	],
	' .uag-star-rating > span' => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gap'], 'px' ),
		'color'        => $attr['unmarkedColor'],
	],
	' .uag-star:nth-child(-n+' . floor( $attr['rating'] ) . ')' => [
		'color' => $attr['color'],
	],
	' .uag-star-rating__title' => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSize'], $attr['fontSizeType'] ),
		'font-family' => $attr['fontFamily'],
		'font-weight' => $attr['fontWeight'],
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeight'], $attr['lineHeightType'] ),
		'color'       => $attr['titleColor'],
	],
];

$index = 'margin-right';
if ( 'stack' === $attr['layout'] ) {
	if ( 'before' === $attr['starPosition'] ) {
		$index                                   = 'margin-top';
		$selectors['.wp-block-vxt-star-rating'] = array_merge(
			[
				'flex-direction' => 'column-reverse',
				'align-items'    => $alignment, // To align-item in flex-direction column-reverse.
			],
			$wrapperCSS
		);
	} elseif ( 'after' === $attr['starPosition'] ) {
		$index                                    = 'margin-bottom';
		$selectors['.wp-block-vxt-star-rating '] = array_merge(
			[
				'flex-direction' => 'column', // Stack layout using flex.
				'align-items'    => $alignment, // To align-item in flex-direction column.
			],
			$wrapperCSS
		);
	}
} elseif ( 'inline' === $attr['layout'] ) {
	if ( 'before' === $attr['starPosition'] ) {
		$index                                   = 'margin-left';
		$selectors['.wp-block-vxt-star-rating'] = array_merge(
			[
				'flex-direction'  => 'row-reverse',
				'justify-content' => \Vexaltrix\Presentation\Blocks\BlockHelper::flexAlignmentWhenDirectionIsRowReverse( $alignment ), // To align-item in flex-direction column-reverse.
			],
			$wrapperCSS
		);
	} elseif ( 'after' === $attr['starPosition'] ) {
		$index                                    = 'margin-right';
		$selectors['.wp-block-vxt-star-rating '] = array_merge(
			[
				'flex-direction'  => 'row', // inline layout using flex.
				'justify-content' => $alignment,
			],
			$wrapperCSS
		);
	}
}


$wrapperCSSTablet = [
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginTablet'], $attr['blockMarginUnitTablet'] ),
];

$indexTablet = 'margin-right';
if ( 'stack' === $attr['layoutTablet'] ) {
	if ( 'before' === $attr['starPositionTablet'] ) {
		$indexTablet                              = 'margin-top';
		$tSelectors['.wp-block-vxt-star-rating'] = array_merge(
			[
				'flex-direction' => 'column-reverse',
				'align-items'    => $alignmentTablet, // To align-item in flex-direction column-reverse.
			],
			$wrapperCSSTablet
		);
	} elseif ( 'after' === $attr['starPositionTablet'] ) {
		$indexTablet                               = 'margin-bottom';
		$tSelectors['.wp-block-vxt-star-rating '] = array_merge(
			[
				'flex-direction' => 'column', // inline layout using flex.
				'align-items'    => $alignmentTablet,
			],
			$wrapperCSSTablet
		);
	}
} else {
	if ( 'before' === $attr['starPositionTablet'] ) {
		$indexTablet                              = 'margin-left';
		$tSelectors['.wp-block-vxt-star-rating'] = array_merge(
			[
				'flex-direction'  => 'row-reverse',
				'justify-content' => \Vexaltrix\Presentation\Blocks\BlockHelper::flexAlignmentWhenDirectionIsRowReverse( $alignmentTablet ), // To align-item in flex-direction column-reverse.
			],
			$wrapperCSSTablet
		);
	} elseif ( 'after' === $attr['starPositionTablet'] ) {
		$indexTablet                               = 'margin-right';
		$tSelectors['.wp-block-vxt-star-rating '] = array_merge(
			[
				'flex-direction'  => 'row',
				'justify-content' => $alignmentTablet,
			],
			$wrapperCSSTablet
		);
	}
	$tSelectors[' .uag-star-rating__title '] = [
		'margin-bottom' => 0,
	];
}

$wrapperCSSMobile = [
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginMobile'], $attr['blockMarginUnitMobile'] ),
];

$indexMobile = 'margin-right';
if ( 'stack' === $attr['layoutMobile'] ) {
	if ( 'before' === $attr['starPositionMobile'] ) {
		$indexMobile                              = 'margin-top';
		$mSelectors['.wp-block-vxt-star-rating'] = array_merge(
			[
				'flex-direction' => 'column-reverse',
				'align-items'    => $alignmentMobile, // To align-item in flex-direction column-reverse.
			],
			$wrapperCSSMobile
		);
	} elseif ( 'after' === $attr['starPositionMobile'] ) {
		$indexMobile                               = 'margin-bottom';
		$mSelectors['.wp-block-vxt-star-rating '] = array_merge(
			[
				'flex-direction' => 'column', // inline layout using flex.
				'align-items'    => $alignmentMobile,
			],
			$wrapperCSSMobile
		);
	}
} else {
	if ( 'before' === $attr['starPositionMobile'] ) {
		$indexMobile                              = 'margin-left';
		$mSelectors['.wp-block-vxt-star-rating'] = array_merge(
			[
				'flex-direction'  => 'row-reverse',
				'justify-content' => \Vexaltrix\Presentation\Blocks\BlockHelper::flexAlignmentWhenDirectionIsRowReverse( $alignmentMobile ), // To align-item in flex-direction column-reverse.
			],
			$wrapperCSSMobile
		);
	} elseif ( 'after' === $attr['starPositionMobile'] ) {
		$indexMobile                               = 'margin-right';
		$mSelectors['.wp-block-vxt-star-rating '] = array_merge(
			[
				'flex-direction'  => 'row',
				'justify-content' => $alignmentMobile,
			],
			$wrapperCSSMobile
		);
	}
	$mSelectors[' .uag-star-rating__title '] = [
		'margin-bottom' => 0,
	];
}

$selectors[' .uag-star-rating__title'][ $index ]          = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleGap'], 'px' );
$tSelectors[' .uag-star-rating__title'][ $indexTablet ] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleGapTablet'], 'px' );
$mSelectors[' .uag-star-rating__title'][ $indexMobile ] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleGapMobile'], 'px' );
$tSelectors[' .uag-star-rating']                         = [
	'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['sizeTablet'], 'px' ),
];
$tSelectors[' .uag-star-rating > span']                  = [
	'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapTablet'], 'px' ),
];
$mSelectors[' .uag-star-rating']                         = [
	'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['sizeMobile'], 'px' ),
];
$mSelectors[' .uag-star-rating > span']                  = [
	'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapMobile'], 'px' ),
];

$remainder = ( $attr['rating'] - floor( $attr['rating'] ) );
$width     = $remainder * 100;

if ( 0 !== $width ) {
	$selectors[ ' .uag-star:nth-child(' . ceil( $attr['rating'] ) . '):before' ] = [
		'color'    => $attr['color'],
		'width'    => \Vexaltrix\Core\Support\Helper::getCssValue( $width, '%' ),
		'position' => 'absolute',
		'content'  => "'★'",
		'overflow' => 'hidden',
	];
	$selectors[ ' .uag-star:nth-child(' . ceil( $attr['rating'] ) . ')' ]        = [
		'position' => 'relative',
	];
}


$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, '', ' .uag-star-rating__title', $combinedSelectors );


return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, ' .vxt-block-' . substr( $attr['block_id'], 0, 8 ) );
