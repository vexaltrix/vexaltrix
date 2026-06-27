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

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksTableOfContentsGfont( $attr );

$mSelectors = [];
$tSelectors = [];

$topPadding    = ( isset( $attr['topPadding'] ) && is_numeric( $attr['topPadding'] ) ) ? $attr['topPadding'] : $attr['vPaddingDesktop'];
$bottomPadding = ( isset( $attr['bottomPadding'] ) && is_numeric( $attr['bottomPadding'] ) ) ? $attr['bottomPadding'] : $attr['vPaddingDesktop'];
$leftPadding   = ( isset( $attr['leftPadding'] ) && is_numeric( $attr['leftPadding'] ) ) ? $attr['leftPadding'] : $attr['hPaddingDesktop'];
$rightPadding  = ( isset( $attr['rightPadding'] ) && is_numeric( $attr['rightPadding'] ) ) ? $attr['rightPadding'] : $attr['hPaddingDesktop'];

$mobileTopPadding    = ( isset( $attr['topPaddingMobile'] ) && is_numeric( $attr['topPaddingMobile'] ) ) ? $attr['topPaddingMobile'] : $attr['vPaddingMobile'];
$mobileBottomPadding = ( isset( $attr['bottomPaddingMobile'] ) && is_numeric( $attr['bottomPaddingMobile'] ) ) ? $attr['bottomPaddingMobile'] : $attr['vPaddingMobile'];
$mobileLeftPadding   = ( isset( $attr['leftPaddingMobile'] ) && is_numeric( $attr['leftPaddingMobile'] ) ) ? $attr['leftPaddingMobile'] : $attr['hPaddingMobile'];
$mobileRightPadding  = ( isset( $attr['rightPaddingMobile'] ) && is_numeric( $attr['rightPaddingMobile'] ) ) ? $attr['rightPaddingMobile'] : $attr['hPaddingMobile'];

$tabletTopPadding    = ( isset( $attr['topPaddingTablet'] ) && is_numeric( $attr['topPaddingTablet'] ) ) ? $attr['topPaddingTablet'] : $attr['vPaddingTablet'];
$tabletBottomPadding = ( isset( $attr['bottomPaddingTablet'] ) && is_numeric( $attr['bottomPaddingTablet'] ) ) ? $attr['bottomPaddingTablet'] : $attr['vPaddingTablet'];
$tabletLeftPadding   = ( isset( $attr['leftPaddingTablet'] ) && is_numeric( $attr['leftPaddingTablet'] ) ) ? $attr['leftPaddingTablet'] : $attr['hPaddingTablet'];
$tabletRightPadding  = ( isset( $attr['rightPaddingTablet'] ) && is_numeric( $attr['rightPaddingTablet'] ) ) ? $attr['rightPaddingTablet'] : $attr['hPaddingTablet'];

$topMargin    = isset( $attr['topMargin'] ) ? $attr['topMargin'] : $attr['vMarginDesktop'];
$bottomMargin = isset( $attr['bottomMargin'] ) ? $attr['bottomMargin'] : $attr['vMarginDesktop'];
$leftMargin   = isset( $attr['leftMargin'] ) ? $attr['leftMargin'] : $attr['hMarginDesktop'];
$rightMargin  = isset( $attr['rightMargin'] ) ? $attr['rightMargin'] : $attr['hMarginDesktop'];

$mobileTopMargin    = isset( $attr['topMarginMobile'] ) ? $attr['topMarginMobile'] : $attr['vMarginMobile'];
$mobileBottomMargin = isset( $attr['bottomMarginMobile'] ) ? $attr['bottomMarginMobile'] : $attr['vMarginMobile'];
$mobileLeftMargin   = isset( $attr['leftMarginMobile'] ) ? $attr['leftMarginMobile'] : $attr['hMarginMobile'];
$mobileRightMargin  = isset( $attr['rightMarginMobile'] ) ? $attr['rightMarginMobile'] : $attr['hMarginMobile'];

$tabletTopMargin    = isset( $attr['topMarginTablet'] ) ? $attr['topMarginTablet'] : $attr['vMarginTablet'];
$tabletBottomMargin = isset( $attr['bottomMarginTablet'] ) ? $attr['bottomMarginTablet'] : $attr['vMarginTablet'];
$tabletLeftMargin   = isset( $attr['leftMarginTablet'] ) ? $attr['leftMarginTablet'] : $attr['hMarginTablet'];
$tabletRightMargin  = isset( $attr['rightMarginTablet'] ) ? $attr['rightMarginTablet'] : $attr['hMarginTablet'];
$iconSize             = isset( $attr['iconSize'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['iconSize'], 'px' ) : '20px';

$overallBorderCSS       = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall' );
$overallBorderCSS       = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$overallBorderCSS,
	( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);
$overallBorderCSSTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'tablet' );
$overallBorderCSSMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'mobile' );


$selectors = [
	'.wp-block-vxt-table-of-contents'                    => [
		'text-align' => $attr['overallAlign'],
	],
	' .vxt-toc__list-wrap ul li'                         => [
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $attr['fontSize'], $attr['fontSizeType'] ),
	],
	' .vxt-toc__list-wrap ol li'                         => [
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $attr['fontSize'], $attr['fontSizeType'] ),
	],
	' .vxt-toc__list-wrap li a:hover'                    => [
		'color' => $attr['linkHoverColor'],
	],
	' .vxt-toc__list-wrap li a'                          => [
		'color' => $attr['linkColor'],
	],
	' .vxt-toc__wrap .vxt-toc__title-wrap'              => [
		'justify-content' => $attr['align'],
		'margin-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['headingBottom'], 'px' ),
	],
	' .vxt-toc__wrap .vxt-toc__title'                   => [
		'color'           => $attr['headingColor'],
		'justify-content' => $attr['headingAlignment'],
		'margin-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['headingBottom'], 'px' ),
	],
	' .vxt-toc__wrap'                                    => array_merge(
		$overallBorderCSS,
		[
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $leftPadding, $attr['paddingTypeDesktop'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $rightPadding, $attr['paddingTypeDesktop'] ),
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $topPadding, $attr['paddingTypeDesktop'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $bottomPadding, $attr['paddingTypeDesktop'] ),
			'background'     => $attr['backgroundColor'],
		]
	),
	' .vxt-toc__wrap:hover'                              => [
		'border-color' => $attr['overallBorderHColor'],
	],
	' .vxt-toc__list-wrap'                               => [
		'column-count' => $attr['tColumnsDesktop'],
		'overflow'     => 'hidden',
		'text-align'   => $attr['align'],
	],
	' .vxt-toc__list-wrap > ul.vxt-toc__list > li:first-child' => [
		'padding-top' => 0,
	],
	' .vxt-toc__list-wrap > ol.vxt-toc__list li'        => [
		'color' => $attr['bulletColor'],
	],
	' .vxt-toc__list-wrap > li'                          => [
		'color' => $attr['bulletColor'],
	],
	' .vxt-toc__list-wrap ol.vxt-toc__list:first-child' => [
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $leftMargin, $attr['marginTypeDesktop'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $rightMargin, $attr['marginTypeDesktop'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $topMargin, $attr['marginTypeDesktop'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $bottomMargin, $attr['marginTypeDesktop'] ),
	],
	' .vxt-toc__list-wrap ul.vxt-toc__list:last-child > li:last-child' => [
		'padding-bottom' => 0,
	],
	' .uag-toc__collapsible-wrap svg'                     => [
		'width'  => $iconSize,
		'height' => $iconSize,
		'fill'   => $attr['iconColor'],
	],
	' svg'                                                => [
		'width'  => $iconSize,
		'height' => $iconSize,
		'fill'   => $attr['iconColor'],
	],
];

if ( '' !== $attr['contentPaddingDesktop'] ) {
	$selectors[' .vxt-toc__list-wrap ol.vxt-toc__list > li']['padding-top']    = 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingDesktop'], $attr['contentPaddingTypeDesktop'] ) . ' / 2 )';
	$selectors[' .vxt-toc__list-wrap ol.vxt-toc__list > li']['padding-bottom'] = 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingDesktop'], $attr['contentPaddingTypeDesktop'] ) . ' / 2 )';
	$selectors[' .vxt-toc__list-wrap ul.vxt-toc__list > li']['padding-top']    = 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingDesktop'], $attr['contentPaddingTypeDesktop'] ) . ' / 2 )';
	$selectors[' .vxt-toc__list-wrap ul.vxt-toc__list > li']['padding-bottom'] = 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingDesktop'], $attr['contentPaddingTypeDesktop'] ) . ' / 2 )';
	// Add the bottom padding to the unordered list that's a child of the expandable list.
	$selectors[' .vxt-toc__list-wrap li.vxt-toc__list.vxt-toc__list--expandable > ul.vxt-toc__list']['padding-top'] = 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingDesktop'], $attr['contentPaddingTypeDesktop'] ) . ' / 2 )';
}

if ( $attr['customWidth'] ) {
	$selectors[' .vxt-toc__wrap']['width'] = \Vexaltrix\Support\Helper::getCssValue( $attr['widthDesktop'], $attr['widthTypeDesktop'] );
}

if ( $attr['customWidth'] && $attr['makeCollapsible'] ) {
	$selectors[' .vxt-toc__wrap .vxt-toc__title']['justify-content'] = 'space-between';
}

if ( $attr['makeCollapsible'] ) {
	$selectors[' .vxt-toc__wrap .vxt-toc__title']['cursor'] = 'pointer';
}

if ( $attr['disableBullets'] ) {
	$selectors[' .vxt-toc__list']                 = [
		'list-style-type' => 'none !important',
	];
	$selectors[' .vxt-toc__list .vxt-toc__list'] = [
		'list-style-type' => 'none !important',
	];
} else {
	$selectors[' .vxt-toc__list .vxt-toc__list'] = [
		'list-style-type' => $attr['markerView'] . ' !important',
	];
}


$mSelectors = [
	' .vxt-toc__list-wrap ul li'                         => [
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $attr['fontSizeMobile'], $attr['fontSizeType'] ),
	],
	' .vxt-toc__list-wrap ol li'                         => [
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $attr['fontSizeMobile'], $attr['fontSizeType'] ),
	],
	' .vxt-toc__title'                                   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headingBottomMobile'], 'px' ),
	],
	' .vxt-toc__wrap'                                    => array_merge(
		$overallBorderCSSMobile,
		[
			'width'          => \Vexaltrix\Support\Helper::getCssValue( $attr['widthMobile'], $attr['widthTypeMobile'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $mobileLeftPadding, $attr['paddingTypeMobile'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $mobileRightPadding, $attr['paddingTypeMobile'] ),
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $mobileTopPadding, $attr['paddingTypeMobile'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $mobileBottomPadding, $attr['paddingTypeMobile'] ),
		]
	),
	' .vxt-toc__list-wrap ol.vxt-toc__list:first-child' => [
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $mobileLeftMargin, $attr['marginTypeMobile'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $mobileRightMargin, $attr['marginTypeMobile'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $mobileTopMargin, $attr['marginTypeMobile'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $mobileBottomMargin, $attr['marginTypeMobile'] ),
	],
	' .vxt-toc__list-wrap'                               => [
		'column-count' => $attr['tColumnsMobile'],
		'overflow'     => 'hidden',
		'text-align'   => $attr['align'],
	],
	' .vxt-toc__list-wrap > ul.vxt-toc__list > li:first-child' => [
		'padding-top' => 0,
	],
	' .vxt-toc__list-wrap ul.vxt-toc__list:last-child > li:last-child' => [
		'padding-bottom' => 0,
	],
];

$tSelectors = [
	' .vxt-toc__list-wrap ul li'                         => [
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $attr['fontSizeTablet'], $attr['fontSizeType'] ),
	],
	' .vxt-toc__list-wrap ol li'                         => [
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $attr['fontSizeTablet'], $attr['fontSizeType'] ),
	],
	' .vxt-toc__title'                                   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headingBottomTablet'], 'px' ),
	],
	' .vxt-toc__wrap'                                    => array_merge(
		$overallBorderCSSTablet,
		[
			'width'          => \Vexaltrix\Support\Helper::getCssValue( $attr['widthTablet'], $attr['widthTypeTablet'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $tabletLeftPadding, $attr['paddingTypeTablet'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $tabletRightPadding, $attr['paddingTypeTablet'] ),
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $tabletTopPadding, $attr['paddingTypeTablet'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $tabletBottomPadding, $attr['paddingTypeTablet'] ),
		]
	),
	' .vxt-toc__list-wrap ol.vxt-toc__list:first-child' => [
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $tabletLeftMargin, $attr['marginTypeTablet'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $tabletRightMargin, $attr['marginTypeTablet'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $tabletTopMargin, $attr['marginTypeTablet'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $tabletBottomMargin, $attr['marginTypeTablet'] ),
	],
	' .vxt-toc__list-wrap'                               => [
		'column-count' => $attr['tColumnsTablet'],
		'overflow'     => 'hidden',
		'text-align'   => $attr['align'],
	],
	' .vxt-toc__list-wrap > ul.vxt-toc__list > li:first-child' => [
		'padding-top' => 0,
	],
	' .vxt-toc__list-wrap ul.vxt-toc__list:last-child > li:last-child' => [
		'padding-bottom' => 0,
	],
];

if ( '' !== $attr['contentPaddingTablet'] ) {
	$tSelectors[' .vxt-toc__list-wrap ol.vxt-toc__list > li'] = [
		'padding-top'    => 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingTablet'], $attr['contentPaddingTypeTablet'] ) . ' / 2 )',
		'padding-bottom' => 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingTablet'], $attr['contentPaddingTypeTablet'] ) . ' / 2 )',
	];
	$tSelectors[' .vxt-toc__list-wrap ul.vxt-toc__list > li'] = [
		'padding-top'    => 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingTablet'], $attr['contentPaddingTypeTablet'] ) . ' / 2 )',
		'padding-bottom' => 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingTablet'], $attr['contentPaddingTypeTablet'] ) . ' / 2 )',
	];
}

if ( '' !== $attr['contentPaddingMobile'] ) {
	$mSelectors[' .vxt-toc__list-wrap ol.vxt-toc__list > li'] = [
		'padding-top'    => 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingMobile'], $attr['contentPaddingTypeMobile'] ) . ' / 2 )',
		'padding-bottom' => 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingMobile'], $attr['contentPaddingTypeMobile'] ) . ' / 2 )',
	];
	$mSelectors[' .vxt-toc__list-wrap ul.vxt-toc__list > li'] = [
		'padding-top'    => 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingMobile'], $attr['contentPaddingTypeMobile'] ) . ' / 2 )',
		'padding-bottom' => 'calc( ' . \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingMobile'], $attr['contentPaddingTypeMobile'] ) . ' / 2 )',
	];
}

if ( 'none' !== $attr['separatorStyle'] ) {

	// Since we need the separator to ignore the padding and cover the entire width of the parent container,
	// we use calc and do the following calculations.

	$calcPaddingLeft  = \Vexaltrix\Support\Helper::getCssValue( $leftPadding, $attr['paddingTypeDesktop'] );
	$calcPaddingRight = \Vexaltrix\Support\Helper::getCssValue( $rightPadding, $attr['paddingTypeDesktop'] );

	$tCalcPaddingLeft  = \Vexaltrix\Support\Helper::getCssValue( $tabletLeftPadding, $attr['paddingTypeTablet'] );
	$tCalcPaddingRight = \Vexaltrix\Support\Helper::getCssValue( $tabletRightPadding, $attr['paddingTypeTablet'] );

	$mCalcPaddingLeft  = \Vexaltrix\Support\Helper::getCssValue( $mobileLeftPadding, $attr['paddingTypeMobile'] );
	$mCalcPaddingRight = \Vexaltrix\Support\Helper::getCssValue( $mobileRightPadding, $attr['paddingTypeMobile'] );

	$selectors[' .vxt-toc__separator'] = [
		'border-top-style' => $attr['separatorStyle'],
		'border-top-width' => \Vexaltrix\Support\Helper::getCssValue(
			$attr['separatorHeight'],
			$attr['separatorHeightType']
		),
		'width'            => 'calc( 100% + ' . $calcPaddingLeft . ' + ' . $calcPaddingRight . ')',
		'margin-left'      => '-' . $calcPaddingLeft,
		'border-color'     => $attr['separatorColor'],
		'margin-bottom'    => \Vexaltrix\Support\Helper::getCssValue(
			$attr['separatorSpace'],
			$attr['separatorSpaceType']
		),
	];

	$selectors[' .vxt-toc__wrap:hover .vxt-toc__separator'] = [
		'border-color' => $attr['separatorHColor'],
	];

	$tSelectors[' .vxt-toc__separator'] = [
		'width'         => 'calc( 100% + ' . $tCalcPaddingLeft . ' + ' . $tCalcPaddingRight . ')',
		'margin-left'   => '-' . $tCalcPaddingLeft,
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue(
			$attr['separatorSpaceTablet'],
			$attr['separatorSpaceType']
		),
	];

	$mSelectors[' .vxt-toc__separator'] = [
		'width'         => 'calc( 100% + ' . $mCalcPaddingLeft . ' + ' . $mCalcPaddingRight . ')',
		'margin-left'   => '-' . $mCalcPaddingLeft,
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue(
			$attr['separatorSpaceMobile'],
			$attr['separatorSpaceType']
		),
	];

}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'heading', ' .vxt-toc__title', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, '', ' .vxt-toc__list-wrap ol li a', $combinedSelectors );

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-toc-';

$desktop = \Vexaltrix\Support\Helper::generateCss( $combinedSelectors['desktop'], $baseSelector . $id );

$tablet = \Vexaltrix\Support\Helper::generateCss( $combinedSelectors['tablet'], $baseSelector . $id );

$mobile = \Vexaltrix\Support\Helper::generateCss( $combinedSelectors['mobile'], $baseSelector . $id );

if ( '' !== $attr['scrollToTopColor'] ) {
	$desktop .= '.vxt-toc__scroll-top { color: ' . $attr['scrollToTopColor'] . '; }';
}

if ( '' !== $attr['scrollToTopBgColor'] ) {
	$desktop .= '.vxt-toc__scroll-top.vxt-toc__show-scroll { background: ' . $attr['scrollToTopBgColor'] . '; }';
}

$generatedCss = [
	'desktop' => $desktop,
	'tablet'  => $tablet,
	'mobile'  => $mobile,
];

return $generatedCss;
