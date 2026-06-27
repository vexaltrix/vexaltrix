<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksCallToActionGfont( $attr );

$contentWidthTabletFallback = is_numeric( $attr['contentWidthTablet'] ) ? $attr['contentWidthTablet'] : $attr['contentWidth'];
$contentWidthMobileFallback = is_numeric( $attr['contentWidthMobile'] ) ? $attr['contentWidthMobile'] : $contentWidthTabletFallback;

$btnContentWidthTabletFallback = is_numeric( $attr['btncontentWidthTablet'] ) ? $attr['btncontentWidthTablet'] : $attr['btncontentWidth'];
$btnContentWidthMobileFallback = is_numeric( $attr['btncontentWidthMobile'] ) ? $attr['btncontentWidthMobile'] : $attr['btncontentWidth'];

$tSelectors = [];
$mSelectors = [];

$svgSize   = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaFontSize'], $attr['ctaFontSizeType'] );
$mSvgSize = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaFontSizeMobile'], $attr['ctaFontSizeTypeMobile'] );
$tSvgSize = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaFontSizeTablet'], $attr['ctaFontSizeTypeTablet'] );

$btnPaddingTop    = isset( $attr['ctaTopPadding'] ) ? $attr['ctaTopPadding'] : $attr['ctaBtnVertPadding'];
$btnPaddingBottom = isset( $attr['ctaBottomPadding'] ) ? $attr['ctaBottomPadding'] : $attr['ctaBtnVertPadding'];
$btnPaddingLeft   = isset( $attr['ctaLeftPadding'] ) ? $attr['ctaLeftPadding'] : $attr['ctaBtnHrPadding'];
$btnPaddingRight  = isset( $attr['ctaRightPadding'] ) ? $attr['ctaRightPadding'] : $attr['ctaBtnHrPadding'];

if ( 'left' === $attr['textAlign'] ) {
	$alignment = 'flex-start';
} elseif ( 'right' === $attr['textAlign'] ) {
	$alignment = 'flex-end';
} else {
	$alignment = 'center';
}

if ( 'left' === $attr['textAlignTablet'] ) {
	$alignmentTablet = 'flex-start';
} elseif ( 'right' === $attr['textAlignTablet'] ) {
	$alignmentTablet = 'flex-end';
} else {
	$alignmentTablet = 'center';
}

if ( 'left' === $attr['textAlignMobile'] ) {
	$alignmentMobile = 'flex-start';
} elseif ( 'right' === $attr['textAlignMobile'] ) {

	$alignmentMobile = 'flex-end';
} else {
	$alignmentMobile = 'center';
}
$selectors = [
	'.wp-block-vxt-call-to-action .vxt-cta__title'       => [
		'color'         => $attr['titleColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpace'], $attr['titleSpaceType'] ),
	],
	'.wp-block-vxt-call-to-action .vxt-cta__desc'        => [
		'color'         => $attr['descColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpace'], $attr['descSpaceType'] ),
	],
	' .vxt-cta__align-button-after'                       => [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpace'], 'px' ),
	],
	' .vxt-cta__align-button-before'                      => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpace'], 'px' ),
	],
	' .vxt-cta__button-wrapper .vxt-cta-with-svg'        => [
		'font-size'   => $svgSize,
		'width'       => $svgSize,
		'height'      => $svgSize,
		'line-height' => $svgSize,
	],
	' .vxt-cta__button-wrapper .vxt-cta__block-link svg' => [
		'fill' => $attr['ctaBtnLinkColor'],
	],
	'.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper > svg' => [
		'font-size'   => $svgSize,
		'width'       => $svgSize,
		'height'      => $svgSize,
		'line-height' => $svgSize,
		'fill'        => $attr['ctaBtnLinkColor'],
	],
	'.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper:hover > svg' => [
		'fill' => $attr['ctaLinkHoverColor'],
	],
	'.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper:focus > svg' => [
		'fill' => $attr['ctaLinkHoverColor'],
	],
	'.wp-block-vxt-call-to-action a.vxt-cta-second__button > svg' => [
		'font-size'   => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'width'       => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'height'      => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'line-height' => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'fill'        => $attr['secondCtaColor'],
	],
	'.wp-block-vxt-call-to-action a.vxt-cta-second__button:hover > svg' => [
		'fill' => $attr['secondCtaHoverColor'],
	],
	'.wp-block-vxt-call-to-action a.vxt-cta-second__button:focus > svg' => [
		'fill' => $attr['secondCtaHoverColor'],
	],
];

if ( 'text' === $attr['ctaType'] ) {
	$selectors[' .vxt-cta__button-wrapper a.vxt-cta-typeof-text']                    = [
		'color' => $attr['ctaBtnLinkColor'],
	];
	$selectors[' .vxt-cta__button-wrapper a.vxt-cta-typeof-text:hover ']             = [
		'color' => $attr['ctaLinkHoverColor'],
	];
	$selectors[' .vxt-cta__button-wrapper a.vxt-cta-typeof-text:focus ']             = [
		'color' => $attr['ctaLinkHoverColor'],
	];
	$selectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper']        = [
		'color' => $attr['ctaBtnLinkColor'],
	];
	$selectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper:hover '] = [
		'color' => $attr['ctaLinkHoverColor'],
	];
	$selectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper:focus '] = [
		'color' => $attr['ctaLinkHoverColor'],
	];
}

$selectors[' .vxt-cta__content-wrap']      = [
	'text-align' => $attr['textAlign'],
];
$selectors[' .vxt-cta__wrap']              = [
	'width'      => \Vexaltrix\Support\Helper::getCssValue( $attr['contentWidth'], $attr['contentWidthType'] ),
	'text-align' => $attr['textAlign'],
];
$selectors['.wp-block-vxt-call-to-action'] = [
	'text-align'     => $attr['textAlign'],
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopPadding'], $attr['overallBlockPaddingUnit'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomPadding'], $attr['overallBlockPaddingUnit'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftPadding'], $attr['overallBlockPaddingUnit'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightPadding'], $attr['overallBlockPaddingUnit'] ),
	'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopMargin'], $attr['overallBlockMarginUnit'] ),
	'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomMargin'], $attr['overallBlockMarginUnit'] ),
	'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftMargin'], $attr['overallBlockMarginUnit'] ),
	'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightMargin'], $attr['overallBlockMarginUnit'] ),
];

if ( 'left' === $attr['textAlign'] && 'right' === $attr['ctaPosition'] ) {
	$selectors[' .vxt-cta__left-right-wrap .vxt-cta__content'] = [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaLeftSpace'], 'px' ),
		'margin-right' => '0',
	];
}

$tSelectors = [
	'.wp-block-vxt-call-to-action .vxt-cta__title' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpaceTablet'], $attr['titleSpaceType'] ),
	],
	'.wp-block-vxt-call-to-action .vxt-cta__desc'  => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpaceTablet'], $attr['descSpaceType'] ),
	],
	' .vxt-cta__button-wrapper .vxt-cta-with-svg'  => [
		'font-size'   => $tSvgSize,
		'width'       => $tSvgSize,
		'height'      => $tSvgSize,
		'line-height' => $tSvgSize,
	],
	'.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper svg' => [
		'font-size'   => $tSvgSize,
		'width'       => $tSvgSize,
		'height'      => $tSvgSize,
		'line-height' => $tSvgSize,
	],
	'.wp-block-vxt-call-to-action a.vxt-cta-second__button svg' => [
		'font-size'   => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSizeTablet'], $attr['secondCtaFontSizeTypeTablet'] ),
		'width'       => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSizeTablet'], $attr['secondCtaFontSizeTypeTablet'] ),
		'height'      => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSizeTablet'], $attr['secondCtaFontSizeTypeTablet'] ),
		'line-height' => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSizeTablet'], $attr['secondCtaFontSizeTypeTablet'] ),
	],
];

$tSelectors['.wp-block-vxt-call-to-action.vxt-cta__content-stacked-tablet '] = [
	'display' => 'inherit',
];
$tSelectors['.vxt-cta__content-stacked-tablet .vxt-cta__wrap']               = [
	'width' => '100%',
];

$mSelectors = [
	'.wp-block-vxt-call-to-action .vxt-cta__title' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpaceMobile'], $attr['titleSpaceType'] ),
	],
	'.wp-block-vxt-call-to-action .vxt-cta__desc'  => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpaceMobile'], $attr['descSpaceType'] ),
	],
	' .vxt-cta__button-wrapper .vxt-cta-with-svg'  => [
		'font-size'   => $mSvgSize,
		'width'       => $mSvgSize,
		'height'      => $mSvgSize,
		'line-height' => $mSvgSize,
	],
	'.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper svg' => [
		'font-size'   => $mSvgSize,
		'width'       => $mSvgSize,
		'height'      => $mSvgSize,
		'line-height' => $mSvgSize,
	],
	'.wp-block-vxt-call-to-action a.vxt-cta-second__button svg' => [
		'font-size'   => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSizeMobile'], $attr['secondCtaFontSizeTypeMobile'] ),
		'width'       => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSizeMobile'], $attr['secondCtaFontSizeTypeMobile'] ),
		'height'      => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSizeMobile'], $attr['secondCtaFontSizeTypeMobile'] ),
		'line-height' => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSizeMobile'], $attr['secondCtaFontSizeTypeMobile'] ),
	],
];

$mSelectors['.wp-block-vxt-call-to-action.vxt-cta__content-stacked-mobile '] = [
	'display' => 'inherit',
];
$mSelectors['.vxt-cta__content-stacked-mobile .vxt-cta__wrap']               = [
	'width' => '100%',
];
if ( 'desktop' === $attr['stackBtn'] ) {

	$selectors[' .vxt-cta__buttons']    = [
		'flex-direction' => 'column',
		'row-gap'        => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtn'], 'px' ),
	];
	$tSelectors[' .vxt-cta__buttons '] = [
		'row-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtnTablet'], 'px' ),
	];
	$mSelectors[' .vxt-cta__buttons '] = [
		'row-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtnMobile'], 'px' ),
	];

} elseif ( 'tablet' === $attr['stackBtn'] ) {

	$selectors[' .vxt-cta__buttons ']  = [
		'column-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtn'], 'px' ),
	];
	$tSelectors[' .vxt-cta__buttons'] = [
		'flex-direction' => 'column',
		'row-gap'        => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtnTablet'], 'px' ),
	];
	$mSelectors[' .vxt-cta__buttons'] = [
		'flex-direction' => 'column',
		'row-gap'        => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtnMobile'], 'px' ),
	];

} elseif ( 'mobile' === $attr['stackBtn'] ) {

	$selectors[' .vxt-cta__buttons ']  = [
		'column-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtn'], 'px' ),
	];
	$tSelectors[' .vxt-cta__buttons'] = [
		'column-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtnTablet'], 'px' ),
	];
	$mSelectors[' .vxt-cta__buttons'] = [
		'flex-direction' => 'column',
		'row-gap'        => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtnMobile'], 'px' ),
	];

} elseif ( 'none' === $attr['stackBtn'] ) {
	$selectors[' .vxt-cta__buttons']   = [
		'column-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtn'], 'px' ),
	];
	$tSelectors[' .vxt-cta__buttons'] = [
		'column-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtnTablet'], 'px' ),
	];
	$mSelectors[' .vxt-cta__buttons'] = [
		'column-gap'      => \Vexaltrix\Support\Helper::getCssValue( $attr['gapBtnMobile'], 'px' ),
		'justify-content' => 'center',
	];
}
if ( 'button' === $attr['ctaType'] && $attr['enabledSecondCtaButton'] ) {
	$selectors['.wp-block-button .vxt-cta__buttons']   = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['btncontentWidth'], $attr['btncontentWidthType'] ),
	];
	$tSelectors['.wp-block-button .vxt-cta__buttons'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $btnContentWidthTabletFallback, $attr['btncontentWidthType'] ),
	];
	$mSelectors['.wp-block-button .vxt-cta__buttons'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $btnContentWidthMobileFallback, $attr['btncontentWidthType'] ),
	];
}

$ctaIconSpacing        = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpace'], 'px' );
$ctaIconSpacingTablet = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpaceTablet'], 'px' );
$ctaIconSpacingMobile = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpaceMobile'], 'px' );

$rightSideMargin = 'margin-right';
$leftSideMargin  = 'margin-left';

if ( ! is_rtl() ) {
	$rightSideMargin = 'margin-left';
	$leftSideMargin  = 'margin-right';
}

if ( 'before' === $attr['ctaIconPosition'] ) {
	$selectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper > svg']   = [
		$leftSideMargin => $ctaIconSpacing,
		'font-size'       => $svgSize,
		'width'           => $svgSize,
		'height'          => $svgSize,
		'line-height'     => $svgSize,
		'fill'            => $attr['ctaBtnLinkColor'],
	];
	$tSelectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper > svg'] = [
		$leftSideMargin => $ctaIconSpacingTablet,
	];
	$mSelectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper > svg'] = [
		$leftSideMargin => $ctaIconSpacingMobile,
	];
} else {
	$selectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper > svg']   = [
		$rightSideMargin => $ctaIconSpacing,
		'font-size'        => $svgSize,
		'width'            => $svgSize,
		'height'           => $svgSize,
		'line-height'      => $svgSize,
		'fill'             => $attr['ctaBtnLinkColor'],
	];
	$tSelectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper > svg'] = [
		$rightSideMargin => $ctaIconSpacingTablet,
	];
	$mSelectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper > svg'] = [
		$rightSideMargin => $ctaIconSpacingMobile,
	];
}

if ( 'none' === $attr['ctaType'] || 'all' === $attr['ctaType'] ) {
	$selectors[' .vxt-cta__wrap'] = [
		'width' => '100%',
	];
}

if ( 'right' === $attr['ctaPosition'] && ( 'text' === $attr['ctaType'] || 'button' === $attr['ctaType'] ) ) {
	$selectors['.wp-block-vxt-call-to-action '] = [
		'display'         => 'flex',
		'justify-content' => 'space-between',
	];
	$selectors[' .vxt-cta__content-right .vxt-cta__left-right-wrap .vxt-cta__content']        = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['contentWidth'], $attr['contentWidthType'] ),
	];
	$selectors[' .vxt-cta__content-right .vxt-cta__left-right-wrap .vxt-cta__link-wrapper']   = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( ( 100 - $attr['contentWidth'] ), $attr['contentWidthType'] ),
	];
	$tSelectors[' .vxt-cta__content-right .vxt-cta__left-right-wrap .vxt-cta__content']      = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['contentWidthTablet'], $attr['contentWidthType'] ),
	];
	$tSelectors[' .vxt-cta__content-right .vxt-cta__left-right-wrap .vxt-cta__link-wrapper'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( ( 100 - $contentWidthTabletFallback ), $attr['contentWidthType'] ),
	];

	$mSelectors[' .vxt-cta__content-right .vxt-cta__left-right-wrap .vxt-cta__content']      = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['contentWidthMobile'], $attr['contentWidthType'] ),
	];
	$mSelectors[' .vxt-cta__content-right .vxt-cta__left-right-wrap .vxt-cta__link-wrapper'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( ( 100 - $contentWidthMobileFallback ), $attr['contentWidthType'] ),
	];

	$selectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper '] = [
		'align-self'  => 'top' === $attr['buttonAlign'] ? 'flex-start' : 'center',
		'height'      => 'fit-content',
		'margin-left' => 'auto',
	];
}
$tSelectors[' .vxt-cta__wrap'] = [
	'width'      => \Vexaltrix\Support\Helper::getCssValue( $attr['contentWidthTablet'], $attr['contentWidthType'] ),
	'text-align' => $attr['textAlignTablet'],
];
$mSelectors[' .vxt-cta__wrap'] = [
	'width'      => \Vexaltrix\Support\Helper::getCssValue( $attr['contentWidthMobile'], $attr['contentWidthType'] ),
	'text-align' => $attr['textAlignMobile'],
];
if ( 'desktop' === $attr['stack'] ) {

	$selectors['.wp-block-vxt-call-to-action  ']   = [
		'flex-direction' => 'column',
		'align-items'    => $alignment,
	];
	$tSelectors['.wp-block-vxt-call-to-action  '] = [
		'flex-direction' => 'column',
		'align-items'    => $alignmentTablet,
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopTabletPadding'], $attr['overallBlockTabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomTabletPadding'], $attr['overallBlockTabletPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftTabletPadding'], $attr['overallBlockTabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightTabletPadding'], $attr['overallBlockTabletPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopTabletMargin'], $attr['overallBlockTabletMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomTabletMargin'], $attr['overallBlockTabletMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftTabletMargin'], $attr['overallBlockTabletMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightTabletMargin'], $attr['overallBlockTabletMarginUnit'] ),
	];
	$mSelectors['.wp-block-vxt-call-to-action  '] = [
		'flex-direction' => 'column',
		'align-items'    => $alignmentMobile,
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
	];
} elseif ( 'tablet' === $attr['stack'] ) {

	$selectors['.wp-block-vxt-call-to-action  ']  = [
		'flex-direction' => 'row',
		'align-items'    => 'top' === $attr['buttonAlign'] ? 'flex-start' : 'center',
	];
	$tSelectors['.wp-block-vxt-call-to-action '] = [
		'flex-direction' => 'column',
		'align-items'    => $alignmentTablet,
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopTabletPadding'], $attr['overallBlockTabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomTabletPadding'], $attr['overallBlockTabletPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftTabletPadding'], $attr['overallBlockTabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightTabletPadding'], $attr['overallBlockTabletPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopTabletMargin'], $attr['overallBlockTabletMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomTabletMargin'], $attr['overallBlockTabletMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftTabletMargin'], $attr['overallBlockTabletMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightTabletMargin'], $attr['overallBlockTabletMarginUnit'] ),
	];
	$mSelectors['.wp-block-vxt-call-to-action '] = [
		'flex-direction' => 'column',
		'align-items'    => $alignmentMobile,
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
	];

} elseif ( 'mobile' === $attr['stack'] ) {

	$selectors['.wp-block-vxt-call-to-action  ']  = [
		'flex-direction' => 'row',
		'align-items'    => 'top' === $attr['buttonAlign'] ? 'flex-start' : 'center',
	];
	$tSelectors['.wp-block-vxt-call-to-action '] = [
		'flex-direction' => 'row',
		'align-items'    => 'top' === $attr['buttonAlign'] ? 'flex-start' : 'center',
	];
	$mSelectors['.wp-block-vxt-call-to-action '] = [
		'flex-direction' => 'column',
		'align-items'    => $alignmentMobile,
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightMobilePadding'], $attr['overallBlockMobilePaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockTopMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockBottomMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockLeftMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['overallBlockRightMobileMargin'], $attr['overallBlockMobileMarginUnit'] ),
	];

} elseif ( 'none' === $attr['stack'] ) {
	$selectors['.wp-block-vxt-call-to-action  ']                    = [
		'align-items'    => 'top' === $attr['buttonAlign'] ? 'flex-start' : 'center',
		'flex-direction' => 'row',
	];
	$tSelectors['.wp-block-vxt-call-to-action ']                   = [
		'align-items'    => 'top' === $attr['buttonAlign'] ? 'flex-start' : 'center',
		'flex-direction' => 'row',
	];
	$mSelectors['.wp-block-vxt-call-to-action ']                   = [
		'align-items'    => 'top' === $attr['buttonAlign'] ? 'flex-start' : 'center',
		'flex-direction' => 'row',
	];
	$selectors['.wp-block-vxt-call-to-action .vxt-cta__buttons']   = [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonRightSpace'], $attr['buttonRightSpaceType'] ),
	];
	$tSelectors['.wp-block-vxt-call-to-action .vxt-cta__buttons'] = [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonRightSpaceTablet'], $attr['buttonRightSpaceType'] ),
	];
	$mSelectors[' .vxt-cta__outer-wrap  .vxt-cta__buttons']       = [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonRightSpaceMobile'], $attr['buttonRightSpaceType'] ),
	];
}

$secondCtaIconSpacing        = \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaIconSpace'], 'px' );
$secondCtaIconSpacingTablet = \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaIconSpaceTablet'], 'px' );
$secondCtaIconSpacingMobile = \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaIconSpaceMobile'], 'px' );

if ( 'before' === $attr['secondCtaIconPosition'] ) {
	$selectors['.wp-block-vxt-call-to-action a.vxt-cta-second__button > svg']   = [
		$leftSideMargin => $secondCtaIconSpacing,
		'font-size'       => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'width'           => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'height'          => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'line-height'     => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'fill'            => $attr['secondCtaColor'],
	];
	$tSelectors['.wp-block-vxt-call-to-action a.vxt-cta-second__button > svg'] = [
		$leftSideMargin => $secondCtaIconSpacingTablet,
	];
	$mSelectors['.wp-block-vxt-call-to-action a.vxt-cta-second__button > svg'] = [
		$leftSideMargin => $secondCtaIconSpacingMobile,
	];
} else {
	$selectors['.wp-block-vxt-call-to-action a.vxt-cta-second__button > svg']   = [
		$rightSideMargin => $secondCtaIconSpacing,
		'font-size'        => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'height'           => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'line-height'      => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaFontSize'], $attr['secondCtaFontSizeType'] ),
		'fill'             => $attr['secondCtaColor'],
	];
	$tSelectors['.wp-block-vxt-call-to-action a.vxt-cta-second__button > svg'] = [
		$rightSideMargin => $secondCtaIconSpacingTablet,
	];
	$mSelectors['.wp-block-vxt-call-to-action a.vxt-cta-second__button > svg'] = [
		$rightSideMargin => $secondCtaIconSpacingMobile,
	];
}

if ( ! $attr['secInheritFromTheme'] ) {
	
	$secondCtaBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'secondCta' );
	$secondCtaBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'secondCta', 'tablet' );
	$secondCtaBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'secondCta', 'mobile' );
	
	$selectors['.wp-block-vxt-call-to-action.wp-block-button a.vxt-cta-second__button']       = array_merge(
		[
			'color'            => $attr['secondCtaColor'],
			'background-color' => ( 'color' === $attr['secondCtaBgType'] ) ? $attr['secondCtaBackground'] : 'transparent',
			'padding-top'      => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaTopPadding'], $attr['secondCtaPaddingUnit'] ),
			'padding-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaBottomPadding'], $attr['secondCtaPaddingUnit'] ),
			'padding-left'     => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaLeftPadding'], $attr['secondCtaPaddingUnit'] ),
			'padding-right'    => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaRightPadding'], $attr['secondCtaPaddingUnit'] ),
			'align-self'       => 'top' === $attr['buttonAlign'] ? 'flex-start' : 'center',
			'height'           => 'fit-content',
		],
		$secondCtaBorder
	);
	$selectors['.wp-block-vxt-call-to-action.wp-block-button a.vxt-cta-second__button:hover'] = [
		'color'            => $attr['secondCtaHoverColor'],
		'background-color' => ( 'color' === $attr['secondCtaBgHoverType'] ) ? $attr['secondCtaHoverBackground'] . '!important' : 'transparent',
		'border-color'     => $attr['secondCtaBorderHColor'],
	];
	$selectors['.wp-block-vxt-call-to-action.wp-block-button a.vxt-cta-second__button:focus'] = [
		'color'            => $attr['secondCtaHoverColor'],
		'background-color' => ( 'color' === $attr['secondCtaBgHoverType'] ) ? $attr['secondCtaHoverBackground'] . '!important' : 'transparent',
		'border-color'     => $attr['secondCtaBorderHColor'],
	];
	
	$tSelectors['.wp-block-vxt-call-to-action.wp-block-button a.vxt-cta-second__button'] = $secondCtaBorderTablet;
	$mSelectors['.wp-block-vxt-call-to-action.wp-block-button a.vxt-cta-second__button'] = $secondCtaBorderMobile;
	$mSelectors['.wp-block-vxt-call-to-action.wp-block-button a.vxt-cta-second__button'] = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaTopMobilePadding'], $attr['secondCtaMobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaBottomMobilePadding'], $attr['secondCtaMobilePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaLeftMobilePadding'], $attr['secondCtaMobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaRightMobilePadding'], $attr['secondCtaMobilePaddingUnit'] ),
	];
	$tSelectors['.wp-block-vxt-call-to-action.wp-block-button a.vxt-cta-second__button'] = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaTopTabletPadding'], $attr['secondCtaTabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaBottomTabletPadding'], $attr['secondCtaTabletPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaLeftTabletPadding'], $attr['secondCtaTabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['secondCtaRightTabletPadding'], $attr['secondCtaTabletPaddingUnit'] ),
	];
}

if ( ! $attr['inheritFromTheme'] && 'button' === $attr['ctaType'] ) {

	$ctaBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn' );
	$ctaBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
		$ctaBorder,
		( isset( $attr['ctaBorderWidth'] ) ? $attr['ctaBorderWidth'] : '' ),
		( isset( $attr['ctaBorderRadius'] ) ? $attr['ctaBorderRadius'] : '' ),
		( isset( $attr['ctaBorderColor'] ) ? $attr['ctaBorderColor'] : '' ),
		( isset( $attr['ctaBorderStyle'] ) ? $attr['ctaBorderStyle'] : '' )
	);
	$ctaBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
	$ctaBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'mobile' );


	$selectors[' .vxt-cta__button-wrapper a.vxt-cta-typeof-button'] = array_merge(
		[
			'color'            => $attr['ctaBtnLinkColor'] ? $attr['ctaBtnLinkColor'] : '#333',
			'background-color' => ( 'color' === $attr['ctaBgType'] ) ? $attr['ctaBgColor'] : 'transparent',
			'padding-top'      => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTop, $attr['ctaPaddingUnit'] ),
			'padding-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottom, $attr['ctaPaddingUnit'] ),
			'padding-left'     => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeft, $attr['ctaPaddingUnit'] ),
			'padding-right'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRight, $attr['ctaPaddingUnit'] ),
		],
		$ctaBorder
	);
	$selectors['.wp-block-vxt-call-to-action.wp-block-button .vxt-cta__button-wrapper a.vxt-cta-typeof-button:hover']                       = [
		'color'            => $attr['ctaLinkHoverColor'],
		'background-color' => ( 'color' === $attr['ctaBgHoverType'] ) ? $attr['ctaBgHoverColor'] : 'transparent',
		'border-color'     => $attr['btnBorderHColor'] ? $attr['btnBorderHColor'] : $attr['ctaBorderhoverColor'],
	];
	$selectors['.wp-block-vxt-call-to-action.wp-block-button .vxt-cta__button-wrapper a.vxt-cta-typeof-button:focus']                       = [
		'color'            => $attr['ctaLinkHoverColor'],
		'background-color' => ( 'color' === $attr['ctaBgHoverType'] ) ? $attr['ctaBgHoverColor'] : 'transparent',
		'border-color'     => $attr['btnBorderHColor'] ? $attr['btnBorderHColor'] : $attr['ctaBorderhoverColor'],
	];
	$selectors['.wp-block-vxt-call-to-action.wp-block-button .vxt-cta__buttons a.vxt-cta__button-link-wrapper.wp-block-button__link']       = array_merge(
		[
			'color'            => $attr['ctaBtnLinkColor'],
			'background-color' => ( 'color' === $attr['ctaBgType'] ) ? $attr['ctaBgColor'] : 'transparent',
			'padding-top'      => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTop, $attr['ctaPaddingUnit'] ),
			'padding-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottom, $attr['ctaPaddingUnit'] ),
			'padding-left'     => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeft, $attr['ctaPaddingUnit'] ),
			'padding-right'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRight, $attr['ctaPaddingUnit'] ),
		],
		$ctaBorder
	);
	$selectors['.wp-block-vxt-call-to-action.wp-block-button .vxt-cta__buttons a.vxt-cta__button-link-wrapper.wp-block-button__link:hover'] = [
		'color'            => $attr['ctaLinkHoverColor'],
		'background-color' => ( 'color' === $attr['ctaBgHoverType'] ) ? $attr['ctaBgHoverColor'] : 'transparent',
		'border-color'     => $attr['btnBorderHColor'] ? $attr['btnBorderHColor'] : $attr['ctaBorderhoverColor'],
	];
	$selectors['.wp-block-vxt-call-to-action.wp-block-button .vxt-cta__buttons a.vxt-cta__button-link-wrapper.wp-block-button__link:focus'] = [
		'color'            => $attr['ctaLinkHoverColor'],
		'background-color' => ( 'color' === $attr['ctaBgHoverType'] ) ? $attr['ctaBgHoverColor'] : 'transparent',
		'border-color'     => $attr['btnBorderHColor'] ? $attr['btnBorderHColor'] : $attr['ctaBorderhoverColor'],
	];
	$tSelectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper'] = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaTopPaddingTablet'], $attr['tabletCTAPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaBottomPaddingTablet'], $attr['tabletCTAPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaLeftPaddingTablet'], $attr['tabletCTAPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaRightPaddingTablet'], $attr['tabletCTAPaddingUnit'] ),
	];
	$tSelectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper'] = $ctaBorderTablet;
	$mSelectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper'] = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaTopPaddingMobile'], $attr['mobileCTAPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaBottomPaddingMobile'], $attr['mobileCTAPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaLeftPaddingMobile'], $attr['mobileCTAPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaRightPaddingMobile'], $attr['mobileCTAPaddingUnit'] ),
	];
	$mSelectors['.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper'] = $ctaBorderMobile;
	$tSelectors['.wp-block-vxt-call-to-action.wp-block-button .vxt-cta__buttons a.vxt-cta__button-link-wrapper.wp-block-button__link'] = array_merge(
		[
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaTopPaddingTablet'], $attr['tabletCTAPaddingUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaBottomPaddingTablet'], $attr['tabletCTAPaddingUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaLeftPaddingTablet'], $attr['tabletCTAPaddingUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaRightPaddingTablet'], $attr['tabletCTAPaddingUnit'] ),
		],
		$ctaBorderTablet
	);
	$mSelectors['.wp-block-vxt-call-to-action.wp-block-button .vxt-cta__buttons a.vxt-cta__button-link-wrapper.wp-block-button__link'] = array_merge(
		[
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaTopPaddingMobile'], $attr['mobileCTAPaddingUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaBottomPaddingMobile'], $attr['mobileCTAPaddingUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaLeftPaddingMobile'], $attr['mobileCTAPaddingUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaRightPaddingMobile'], $attr['mobileCTAPaddingUnit'] ),
		],
		$ctaBorderMobile
	);
}
$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];
if ( ! $attr['inheritFromTheme'] ) {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'cta', '.wp-block-vxt-call-to-action a.vxt-cta__button-link-wrapper', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-cta__button-wrapper a.vxt-cta__button-link-wrapper', $combinedSelectors );
}

if ( ! $attr['secInheritFromTheme'] ) {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'secondCta', '.wp-block-vxt-call-to-action a.vxt-cta-second__button', $combinedSelectors );
}

if ( 'text' === $attr['ctaType'] ) {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-cta__button-wrapper a.vxt-cta-typeof-text', $combinedSelectors );
}

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-cta__title', $combinedSelectors );
if ( $attr['enableMultilineParagraph'] ) {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'desc', ' .vxt-cta__desc p', $combinedSelectors );
} else {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'desc', ' .vxt-cta__desc', $combinedSelectors );
}

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-cta-block-';

return \Vexaltrix\Support\Helper::generateAllCss(
	$combinedSelectors,
	$baseSelector . $id,
	isset( $gbsClass ) ? $gbsClass : ''
);
