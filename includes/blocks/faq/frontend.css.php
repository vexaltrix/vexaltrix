<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksFaqGfont( $attr );

$iconColor        = $attr['iconColor'];
$iconActiveColor = $attr['iconActiveColor'];

$attr['questionBottomPaddingDesktop'] = ( 10 === $attr['questionBottomPaddingDesktop'] && 10 !== $attr['vquestionPaddingDesktop'] ) ? $attr['vquestionPaddingDesktop'] : $attr['questionBottomPaddingDesktop'];

$attr['questionLeftPaddingDesktop'] = ( 10 === $attr['questionLeftPaddingDesktop'] && 10 !== $attr['hquestionPaddingDesktop'] ) ? $attr['hquestionPaddingDesktop'] : $attr['questionLeftPaddingDesktop'];

$attr['questionBottomPaddingTablet'] = ( 10 === $attr['questionBottomPaddingTablet'] && 10 !== $attr['vquestionPaddingTablet'] ) ? $attr['vquestionPaddingTablet'] : $attr['questionBottomPaddingTablet'];

$attr['questionLeftPaddingTablet'] = ( 10 === $attr['questionLeftPaddingTablet'] && 10 !== $attr['hquestionPaddingTablet'] ) ? $attr['hquestionPaddingTablet'] : $attr['questionLeftPaddingTablet'];

$attr['questionBottomPaddingMobile'] = ( 10 === $attr['questionBottomPaddingMobile'] && 10 !== $attr['vquestionPaddingMobile'] ) ? $attr['vquestionPaddingMobile'] : $attr['questionBottomPaddingMobile'];

$attr['questionLeftPaddingMobile'] = ( 10 === $attr['questionLeftPaddingMobile'] && 10 !== $attr['hquestionPaddingMobile'] ) ? $attr['hquestionPaddingMobile'] : $attr['questionLeftPaddingMobile'];

if ( ! isset( $attr['iconColor'] ) || '' === $attr['iconColor'] ) {

	$iconColor = $attr['questionTextColor'];
}
if ( ! isset( $attr['iconActiveColor'] ) || '' === $attr['iconActiveColor'] ) {

	$iconActiveColor = $attr['questionTextActiveColor'];
}

$iconSize   = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeType'] );
$tIconSize = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTablet'], $attr['iconSizeType'] );
$mIconSize = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMobile'], $attr['iconSizeType'] );

$answerTopPaddingDesktop    = isset( $attr['answerTopPadding'] ) ? $attr['answerTopPadding'] : $attr['vanswerPaddingDesktop'];
$answerBottomPaddingDesktop = isset( $attr['answerBottomPadding'] ) ? $attr['answerBottomPadding'] : $attr['vanswerPaddingDesktop'];
$answerLeftPaddingDesktop   = isset( $attr['answerLeftPadding'] ) ? $attr['answerLeftPadding'] : $attr['hanswerPaddingDesktop'];
$answerRightPaddingDesktop  = isset( $attr['answerRightPadding'] ) ? $attr['answerRightPadding'] : $attr['hanswerPaddingDesktop'];

$answerTopPaddingTablet    = isset( $attr['answerTopPaddingTablet'] ) ? $attr['answerTopPaddingTablet'] : $attr['vanswerPaddingTablet'];
$answerBottomPaddingTablet = isset( $attr['answerBottomPaddingTablet'] ) ? $attr['answerBottomPaddingTablet'] : $attr['vanswerPaddingTablet'];
$answerLeftPaddingTablet   = isset( $attr['answerLeftPaddingTablet'] ) ? $attr['answerLeftPaddingTablet'] : $attr['hanswerPaddingTablet'];
$answerRightPaddingTablet  = isset( $attr['answerRightPaddingTablet'] ) ? $attr['answerRightPaddingTablet'] : $attr['hanswerPaddingTablet'];

$answerTopPaddingMobile    = isset( $attr['answerTopPaddingMobile'] ) ? $attr['answerTopPaddingMobile'] : $attr['vanswerPaddingMobile'];
$answerBottomPaddingMobile = isset( $attr['answerBottomPaddingMobile'] ) ? $attr['answerBottomPaddingMobile'] : $attr['vanswerPaddingMobile'];
$answerLeftPaddingMobile   = isset( $attr['answerLeftPaddingMobile'] ) ? $attr['answerLeftPaddingMobile'] : $attr['hanswerPaddingMobile'];
$answerRightPaddingMobile  = isset( $attr['answerRightPaddingMobile'] ) ? $attr['answerRightPaddingMobile'] : $attr['hanswerPaddingMobile'];

$border        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall' );
$border        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$border,
	( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);
$borderTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'tablet' );
$borderMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'mobile' );

$iconBorder        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'icon' );
$iconBorderTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'icon', 'tablet' );
$iconBorderMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'icon', 'mobile' );

$selectors = [
	' .vxt-icon svg'                                     => [
		'width'     => $iconSize,
		'height'    => $iconSize,
		'font-size' => $iconSize,
		'fill'      => $iconColor,
	],
	' .vxt-icon-active svg'                              => [
		'width'     => $iconSize,
		'height'    => $iconSize,
		'font-size' => $iconSize,
		'fill'      => $iconActiveColor,
	],
	' .vxt-faq-child__outer-wrap'                        => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGap'], $attr['rowsGapUnit'] ),
	],
	' .vxt-faq-item'                                     => array_merge(
		[
			'background-color' => ( 'color' === $attr['boxBgType'] ) ? $attr['boxBgColor'] : 'transparent',
		],
		$border
	),
	' .vxt-faq-item:hover'                               => [
		'background-color' => ( 'color' === $attr['boxBgHoverType'] ) ? $attr['boxBgHoverColor'] : 'transparent',
		'border-color'     => ! empty( $attr['overallBorderHColor'] ) ? $attr['overallBorderHColor'] : $attr['borderHoverColor'],
	],
	' .vxt-faq-item .vxt-question'                      => [
		'color' => $attr['questionTextColor'],
	],
	' .vxt-faq-item.vxt-faq-item-active .vxt-question' => [
		'color' => $attr['questionTextActiveColor'],
	],
	' .vxt-faq-item:hover .vxt-question'                => [
		'color' => $attr['questionTextActiveColor'],
	],
	' .vxt-faq-questions-button'                         => [
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['vquestionPaddingDesktop'], $attr['questionPaddingTypeDesktop'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['questionBottomPaddingDesktop'], $attr['questionPaddingTypeDesktop'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['hquestionPaddingDesktop'], $attr['questionPaddingTypeDesktop'] ),
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['questionLeftPaddingDesktop'], $attr['questionPaddingTypeDesktop'] ),
		'background-color' => $attr['questionTextBgColor'],
	],
	' .vxt-faq-item.vxt-faq-item-active .vxt-faq-questions-button' => [
		'background-color' => $attr['questionTextActiveBgColor'],
	],
	' .vxt-faq-item:hover .vxt-faq-questions-button'    => [
		'background-color' => $attr['questionTextActiveBgColor'],
	],
	' .vxt-faq-content'                                  => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $answerTopPaddingDesktop, $attr['answerPaddingTypeDesktop'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $answerBottomPaddingDesktop, $attr['answerPaddingTypeDesktop'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $answerRightPaddingDesktop, $attr['answerPaddingTypeDesktop'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $answerLeftPaddingDesktop, $attr['answerPaddingTypeDesktop'] ),
	],
	' .vxt-faq-content span'                             => [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $answerTopPaddingDesktop, $attr['answerPaddingTypeDesktop'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $answerBottomPaddingDesktop, $attr['answerPaddingTypeDesktop'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $answerRightPaddingDesktop, $attr['answerPaddingTypeDesktop'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $answerLeftPaddingDesktop, $attr['answerPaddingTypeDesktop'] ),
	],
	'.vxt-faq-icon-row .vxt-faq-item .vxt-faq-icon-wrap' => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapBtwIconQUestion'], 'px' ),
	],
	'.vxt-faq-icon-row-reverse .vxt-faq-item .vxt-faq-icon-wrap' => [
		'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapBtwIconQUestion'], 'px' ),
	],
	'.wp-block-vxt-faq .vxt-faq-item .vxt-faq-icon-wrap' => array_merge(
		[
			'padding'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBgSize'], $attr['iconBgSizeType'] ),
			'background-color' => $attr['iconBgColor'],
		],
		$iconBorder
	),
	'.wp-block-vxt-faq .vxt-faq-item .vxt-faq-icon-wrap:hover' => [
		'border-color' => $attr['iconBorderHColor'],
	],
	' .vxt-faq-item:hover .vxt-icon svg'                => [
		'fill' => $iconActiveColor,
	],
	' .vxt-faq-item .vxt-faq-questions-button.vxt-faq-questions' => [
		'flex-direction' => $attr['iconAlign'],
	],
	' .vxt-faq-item .vxt-faq-content'                   => [
		'color' => $attr['answerTextColor'],
	],
	'.vxt-faq__outer-wrap'                               => [
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
];

$tSelectors = [
	'.vxt-faq-icon-row .vxt-faq-item .vxt-faq-icon-wrap' => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapBtwIconQUestionTablet'], 'px' ),
	],
	'.vxt-faq-icon-row-reverse .vxt-faq-item .vxt-faq-icon-wrap' => [
		'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapBtwIconQUestionTablet'], 'px' ),
	],
	'.wp-block-vxt-faq .vxt-faq-item .vxt-faq-icon-wrap' => array_merge(
		[
			'padding' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBgSizeTablet'], $attr['iconBgSizeType'] ),
		],
		$iconBorderTablet
	),
	' .vxt-faq-questions-button'  => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['vquestionPaddingTablet'], $attr['questionPaddingTypeTablet'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['questionBottomPaddingTablet'], $attr['questionPaddingTypeTablet'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['hquestionPaddingTablet'], $attr['questionPaddingTypeTablet'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['questionLeftPaddingTablet'], $attr['questionPaddingTypeTablet'] ),
	],
	' .vxt-faq-content'           => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $answerTopPaddingTablet, $attr['answerPaddingTypeTablet'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $answerBottomPaddingTablet, $attr['answerPaddingTypeTablet'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $answerRightPaddingTablet, $attr['answerPaddingTypeTablet'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $answerLeftPaddingTablet, $attr['answerPaddingTypeTablet'] ),
	],
	' .vxt-faq-content span'      => [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $answerTopPaddingTablet, $attr['answerPaddingTypeTablet'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $answerBottomPaddingTablet, $attr['answerPaddingTypeTablet'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $answerRightPaddingTablet, $attr['answerPaddingTypeTablet'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $answerLeftPaddingTablet, $attr['answerPaddingTypeTablet'] ),
	],
	' .vxt-icon svg'              => [
		'width'     => $tIconSize,
		'height'    => $tIconSize,
		'font-size' => $tIconSize,
	],
	' .vxt-icon-active svg'       => [
		'width'     => $tIconSize,
		'height'    => $tIconSize,
		'font-size' => $tIconSize,
	],
	' .vxt-faq-child__outer-wrap' => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGapTablet'], $attr['rowsGapUnit'] ),
	],
	' .vxt-faq-item'              => $borderTablet,
	'.vxt-faq__outer-wrap'        => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginTablet'], $attr['blockMarginUnitTablet'] ),
	],
];
$mSelectors = [
	'.vxt-faq-icon-row .vxt-faq-item .vxt-faq-icon-wrap' => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapBtwIconQUestionMobile'], 'px' ),
	],
	' .vxt-faq-item'              => $borderMobile,
	'.vxt-faq-icon-row-reverse .vxt-faq-item .vxt-faq-icon-wrap' => [
		'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapBtwIconQUestionMobile'], 'px' ),
	],
	' .vxt-faq-child__outer-wrap' => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGapMobile'], $attr['rowsGapUnit'] ),
	],
	'.wp-block-vxt-faq .vxt-faq-item .vxt-faq-icon-wrap' => array_merge(
		[
			'padding' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconBgSizeMobile'], $attr['iconBgSizeType'] ),
		],
		$iconBorderMobile
	),
	' .vxt-faq-questions-button'  => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['vquestionPaddingMobile'], $attr['questionPaddingTypeMobile'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['questionBottomPaddingMobile'], $attr['questionPaddingTypeMobile'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['hquestionPaddingMobile'], $attr['questionPaddingTypeMobile'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['questionLeftPaddingMobile'], $attr['questionPaddingTypeMobile'] ),
	],
	' .vxt-faq-content'           => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $answerTopPaddingMobile, $attr['answerPaddingTypeMobile'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $answerBottomPaddingMobile, $attr['answerPaddingTypeMobile'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $answerRightPaddingMobile, $attr['answerPaddingTypeMobile'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $answerLeftPaddingMobile, $attr['answerPaddingTypeMobile'] ),
	],
	' .vxt-faq-content span'      => [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $answerTopPaddingMobile, $attr['answerPaddingTypeMobile'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $answerBottomPaddingMobile, $attr['answerPaddingTypeMobile'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $answerRightPaddingMobile, $attr['answerPaddingTypeMobile'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $answerLeftPaddingMobile, $attr['answerPaddingTypeMobile'] ),
	],
	' .vxt-icon svg'              => [
		'width'     => $mIconSize,
		'height'    => $mIconSize,
		'font-size' => $mIconSize,
	],
	' .vxt-icon-active svg'       => [
		'width'     => $mIconSize,
		'height'    => $mIconSize,
		'font-size' => $mIconSize,
	],
	'.vxt-faq__outer-wrap'        => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginMobile'], $attr['blockMarginUnitMobile'] ),
	],
];

if ( 'accordion' === $attr['layout'] && true === $attr['inactiveOtherItems'] ) {

	$selectors[' .wp-block-vxt-faq-child.vxt-faq-child__outer-wrap .vxt-faq-content '] = [
		'display' => 'none',
	];
}
if ( 'accordion' === $attr['layout'] && true === $attr['expandFirstItem'] ) {

	$selectors['.vxt-faq__wrap.vxt-buttons-layout-wrap > .vxt-faq-child__outer-wrap:first-child.vxt-faq-item.vxt-faq-item-active .vxt-faq-content ']  = [
		'display' => 'block',
	];
	$selectors['.vxt-faq__wrap.vxt-buttons-layout-wrap > .vxt-faq-child__outer-wrap:first-child .vxt-faq-item.vxt-faq-item-active .vxt-faq-content '] = [
		'display' => 'block',
	];
}
if ( true === $attr['enableSeparator'] ) {

	$selectors[' .vxt-faq-child__outer-wrap .vxt-faq-content '] =
	[
		'border-style'        => 'solid',
		'border-top-color'    => $attr['overallBorderColor'],
		'border-top-width'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['overallBorderTopWidth'], 'px' ),
		'border-right-width'  => '0px',
		'border-bottom-width' => '0px',
		'border-left-width'   => '0px',
	];

	$tSelectors[' .vxt-faq-child__outer-wrap .vxt-faq-content ']     =
	[
		'border-style'        => 'solid',
		'border-top-color'    => $attr['overallBorderColor'],
		'border-top-width'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['overallBorderTopWidthTablet'], 'px' ),
		'border-right-width'  => '0px',
		'border-bottom-width' => '0px',
		'border-left-width'   => '0px',
	];
	$mSelectors[' .vxt-faq-child__outer-wrap .vxt-faq-content ']     =
	[
		'border-style'        => 'solid',
		'border-top-color'    => $attr['overallBorderColor'],
		'border-top-width'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['overallBorderTopWidthMobile'], 'px' ),
		'border-right-width'  => '0px',
		'border-bottom-width' => '0px',
		'border-left-width'   => '0px',
	];
	$selectors[' .vxt-faq-child__outer-wrap .vxt-faq-content:hover '] = [
		'border-top-color' => ! empty( $attr['overallBorderHColor'] ) ? $attr['overallBorderHColor'] : $attr['borderHoverColor'],
	];
}
if ( 'grid' === $attr['layout'] ) {

	$selectors['.vxt-faq-layout-grid.vxt-faq__wrap .vxt-faq-child__outer-wrap '] = [
		'text-align' => $attr['align'],
	];

	$selectors['.vxt-faq-layout-grid .vxt-faq__wrap .vxt-faq-child__outer-wrap '] = [
		'text-align' => $attr['align'],
	];

	$selectors['.vxt-faq-layout-grid .vxt-faq__wrap.vxt-buttons-layout-wrap ']   = [
		'grid-template-columns' => 'repeat(' . $attr['columns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnsGap'], $attr['columnsGapUnit'] ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGap'], $attr['rowsGapUnit'] ),
		'display'               => 'grid',
	];
	$tSelectors['.vxt-faq-layout-grid .vxt-faq__wrap.vxt-buttons-layout-wrap '] = [
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnsGapTablet'], $attr['columnsGapUnit'] ),
		'grid-template-columns' => 'repeat(' . $attr['tcolumns'] . ', 1fr)',
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGapTablet'], $attr['rowsGapUnit'] ),
	];
	$mSelectors['.vxt-faq-layout-grid .vxt-faq__wrap.vxt-buttons-layout-wrap '] = [
		'grid-template-columns' => 'repeat(' . $attr['mcolumns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnsGapMobile'], $attr['columnsGapUnit'] ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGapMobile'], $attr['rowsGapUnit'] ),
	];

	$selectors['.vxt-faq-layout-grid.vxt-faq__wrap.vxt-buttons-layout-wrap '] = [
		'grid-template-columns' => 'repeat(' . $attr['columns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnsGap'], $attr['columnsGapUnit'] ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGap'], $attr['rowsGapUnit'] ),
		'display'               => 'grid',
	];

	$tSelectors['.vxt-faq-layout-grid.vxt-faq__wrap.vxt-buttons-layout-wrap '] = [
		'grid-template-columns' => 'repeat(' . $attr['tcolumns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnsGapTablet'], $attr['columnsGapUnit'] ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGapTablet'], $attr['rowsGapUnit'] ),
	];
	$mSelectors['.vxt-faq-layout-grid.vxt-faq__wrap.vxt-buttons-layout-wrap '] = [
		'grid-template-columns' => 'repeat(' . $attr['mcolumns'] . ', 1fr)',
		'grid-column-gap'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnsGapMobile'], $attr['columnsGapUnit'] ),
		'grid-row-gap'          => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowsGapMobile'], $attr['rowsGapUnit'] ),
	];
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'question', ' .vxt-faq-questions-button .vxt-question', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'answer', ' .vxt-faq-item .vxt-faq-content', $combinedSelectors );

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
