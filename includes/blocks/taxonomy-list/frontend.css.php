<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var string[] $attr
 * @var int $id
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksTaxonomyListGfont( $attr );

$selectors   = [];
$tSelectors = [];
$mSelectors = [];

$overallBorderCss       = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall' );
$overallBorderCss       = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$overallBorderCss,
	( isset( $attr['borderThickness'] ) ? $attr['borderThickness'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);
$overallBorderCsstablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'tablet' );
$overallBorderCssmobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'mobile' );

$topPadding    = isset( $attr['contentTopPadding'] ) ? $attr['contentTopPadding'] : $attr['contentPadding'];
$bottomPadding = isset( $attr['contentBottomPadding'] ) ? $attr['contentBottomPadding'] : $attr['contentPadding'];
$leftPadding   = isset( $attr['contentLeftPadding'] ) ? $attr['contentLeftPadding'] : $attr['contentPadding'];
$rightPadding  = isset( $attr['contentRightPadding'] ) ? $attr['contentRightPadding'] : $attr['contentPadding'];

$topPaddingMobile    = isset( $attr['contentTopPaddingMobile'] ) ? $attr['contentTopPaddingMobile'] : $attr['contentPaddingMobile'];
$bottomPaddingMobile = isset( $attr['contentBottomPaddingMobile'] ) ? $attr['contentBottomPaddingMobile'] : $attr['contentPaddingMobile'];
$leftPaddingMobile   = isset( $attr['contentLeftPaddingMobile'] ) ? $attr['contentLeftPaddingMobile'] : $attr['contentPaddingMobile'];
$rightPaddingMobile  = isset( $attr['contentRightPaddingMobile'] ) ? $attr['contentRightPaddingMobile'] : $attr['contentPaddingMobile'];

$topPaddingTablet    = isset( $attr['contentTopPaddingTablet'] ) ? $attr['contentTopPaddingTablet'] : $attr['contentPaddingTablet'];
$bottomPaddingTablet = isset( $attr['contentBottomPaddingTablet'] ) ? $attr['contentBottomPaddingTablet'] : $attr['contentPaddingTablet'];
$leftPaddingTablet   = isset( $attr['contentLeftPaddingTablet'] ) ? $attr['contentLeftPaddingTablet'] : $attr['contentPaddingTablet'];
$rightPaddingTablet  = isset( $attr['contentRightPaddingTablet'] ) ? $attr['contentRightPaddingTablet'] : $attr['contentPaddingTablet'];

$boxShadowPositionCSS = $attr['boxShadowPosition'];

if ( 'outset' === $attr['boxShadowPosition'] ) {
	$boxShadowPositionCSS = '';
}

$selectors = [
	'.vxt-taxonomy__outer-wrap.vxt-layout-grid'          => [
		'display'               => 'grid',
		'grid-template-columns' => 'repeat(' . $attr['columns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGap'], 'px' ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGap'], 'px' ),

	],
	'.vxt-layout-grid .vxt-taxomony-box'                 => [
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPadding, $attr['contentPaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPadding, $attr['contentPaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $topPadding, $attr['contentPaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPadding, $attr['contentPaddingUnit'] ),
		'grid-column-gap'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGap'], 'px' ),
		'background-color' => $attr['bgColor'],
		'text-align'       => $attr['alignment'],
		'box-shadow'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $boxShadowPositionCSS,

	],
	'.vxt-layout-grid .vxt-tax-title'                    => [
		'color'         => $attr['titleColor'],
		'margin-top'    => '0',
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleBottomSpace'], 'px' ),
	],
	'.vxt-layout-grid .vxt-tax-link'                     => [
		'color' => $attr['countColor'],
	],
	// List layout styling.
	'.vxt-layout-list .vxt-tax-list'                     => [
		'list-style' => $attr['listStyle'],
		'color'      => $attr['listStyleColor'],
	],
	'.vxt-layout-list .vxt-tax-list:hover'               => [ // For bullet.
		'color' => $attr['hoverlistStyleColor'],
	],
	'.vxt-layout-list .vxt-tax-link-wrap:hover'          => [ // For Number.
		'color' => $attr['hoverlistStyleColor'],
	],
	'.vxt-layout-list .vxt-tax-list a.vxt-tax-link'     => [
		'color' => $attr['listTextColor'],
	],
	'.vxt-layout-list .vxt-tax-list a.vxt-tax-link:hover' => [
		'color' => $attr['hoverlistTextColor'],
	],
	'.vxt-layout-list .vxt-tax-list .vxt-tax-link-wrap' => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['listBottomMargin'], 'px' ),
	],
	/* For Backword */
	' .vxt-taxonomy-wrap.vxt-layout-grid'                => [
		'display'               => 'grid',
		'grid-template-columns' => 'repeat(' . $attr['columns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGap'], 'px' ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGap'], 'px' ),

	],
	' .vxt-layout-grid .vxt-taxomony-box'                => [
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPadding, $attr['contentPaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPadding, $attr['contentPaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $topPadding, $attr['contentPaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPadding, $attr['contentPaddingUnit'] ),
		'grid-column-gap'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGap'], 'px' ),
		'background-color' => $attr['bgColor'],
		'text-align'       => $attr['alignment'],
		'box-shadow'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $boxShadowPositionCSS,

	],
	' .vxt-layout-grid .vxt-tax-title'                   => [
		'color'         => $attr['titleColor'],
		'margin-top'    => '0',
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleBottomSpace'], 'px' ),
	],
	' .vxt-layout-grid .vxt-tax-link'                    => [
		'color' => $attr['countColor'],
	],
	// List layout styling.
	' .vxt-layout-list .vxt-tax-list'                    => [
		'list-style' => $attr['listStyle'],
		'color'      => $attr['listStyleColor'],
	],
	' .vxt-layout-list .vxt-tax-list:hover'              => [
		'color' => $attr['hoverlistStyleColor'],
	],
	' .vxt-layout-list .vxt-tax-list a.vxt-tax-link'    => [
		'color' => $attr['listTextColor'],
	],
	' .vxt-layout-list .vxt-tax-list a.vxt-tax-link:hover' => [
		'color' => $attr['hoverlistTextColor'],
	],
	' .vxt-layout-list .vxt-tax-list .vxt-tax-link-wrap' => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['listBottomMargin'], 'px' ),
	],
	/* End Backword */

];
if ( 'none' !== $attr['seperatorStyle'] ) {
	$selectors['.vxt-layout-list .vxt-tax-separator']        = [
		'border-top-color' => $attr['seperatorColor'],
		'border-top-style' => $attr['seperatorStyle'],
		'border-top-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorThickness'], 'px' ),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorWidth'], '%' ),
	];
	$selectors['.vxt-layout-list .vxt-tax-separator:hover']  = [
		'border-top-color' => $attr['seperatorHoverColor'],
	];
	$selectors[' .vxt-layout-list .vxt-tax-separator']       = [
		'border-top-color' => $attr['seperatorColor'],
		'border-top-style' => $attr['seperatorStyle'],
		'border-top-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorThickness'], 'px' ),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorWidth'], '%' ),
	];
	$selectors[' .vxt-layout-list .vxt-tax-separator:hover'] = [
		'border-top-color' => $attr['seperatorHoverColor'],
	];
}
$selectors['.vxt-layout-list .vxt-tax-separator:hover'] = [
	'border-top-color' => $attr['seperatorHoverColor'],
];
$selectors[' .vxt-taxomony-box']                         = $overallBorderCss;
$selectors[' .vxt-taxomony-box:hover']                   = [
	'border-color' => $attr['overallBorderHColor'],
];

$tSelectors = [
	'.vxt-taxonomy-wrap.vxt-layout-grid'        => [ // For Backword.
		'grid-template-columns' => 'repeat(' . $attr['tcolumns'] . ', 1fr)',
	],
	'.vxt-taxonomy__outer-wrap.vxt-layout-grid' => [
		'grid-template-columns' => 'repeat(' . $attr['tcolumns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapTablet'], 'px' ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],
	'.vxt-layout-grid .vxt-taxomony-box'        => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingTablet, $attr['tabletContentPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingTablet, $attr['tabletContentPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPaddingTablet, $attr['tabletContentPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPaddingTablet, $attr['tabletContentPaddingUnit'] ),
	],
	'.vxt-layout-grid .vxt-tax-title'           => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleBottomSpaceTablet'], 'px' ),
	],
];

$mSelectors = [
	'.vxt-taxonomy__outer-wrap.vxt-layout-grid' => [
		'grid-template-columns' => 'repeat(' . $attr['mcolumns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapMobile'], 'px' ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],
	'.vxt-layout-grid .vxt-taxomony-box'        => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingMobile, $attr['mobileContentPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingMobile, $attr['mobileContentPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPaddingMobile, $attr['mobileContentPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPaddingMobile, $attr['mobileContentPaddingUnit'] ),
	],
	'.vxt-layout-grid .vxt-tax-title'           => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleBottomSpaceMobile'], 'px' ),
	],
];

$tSelectors[' .vxt-taxomony-box'] = $overallBorderCsstablet;
$mSelectors[' .vxt-taxomony-box'] = $overallBorderCssmobile;

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];
/* For Backword */
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-layout-grid .vxt-tax-title', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'count', ' .vxt-layout-grid .vxt-tax-link', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'list', ' .vxt-layout-list .vxt-tax-list', $combinedSelectors );
/* End Backword */
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'title', '.vxt-layout-grid .vxt-tax-title', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'count', '.vxt-layout-grid .vxt-tax-link', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'list', '.vxt-layout-list .vxt-tax-list', $combinedSelectors );

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
