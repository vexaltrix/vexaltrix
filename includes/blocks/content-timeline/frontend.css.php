<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksContentTimelineGfont( $attr );

$selectors   = [];
$tSelectors = [];
$mSelectors = [];

$topMargin    = isset( $attr['topMargin'] ) ? $attr['topMargin'] : $attr['verticalSpace'];
$bottomMargin = isset( $attr['bottomMargin'] ) ? $attr['bottomMargin'] : $attr['verticalSpace'];
$leftMargin   = isset( $attr['leftMargin'] ) ? $attr['leftMargin'] : $attr['horizontalSpace'];
$rightMargin  = isset( $attr['rightMargin'] ) ? $attr['rightMargin'] : $attr['horizontalSpace'];

$topPadding         = isset( $attr['topPadding'] ) ? $attr['topPadding'] : $attr['bgPadding'];
$bottomPadding      = isset( $attr['bottomPadding'] ) ? $attr['bottomPadding'] : $attr['bgPadding'];
$leftPadding        = isset( $attr['leftPadding'] ) ? $attr['leftPadding'] : $attr['bgPadding'];
$rightPadding       = isset( $attr['rightPadding'] ) ? $attr['rightPadding'] : $attr['bgPadding'];
$dateFontSize      = '' !== $attr['dateFontSize'] ? $attr['dateFontSize'] : $attr['dateFontsize'];
$dateFontSizeType = '' !== $attr['dateFontSizeType'] ? $attr['dateFontSizeType'] : $attr['dateFontsizeType'];

$selectors = [
	' .vxt-timeline__heading'                             => [
		'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
		'color'         => $attr['headingColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headSpace'], 'px' ),
	],
	' .vxt-timeline__marker.vxt-timeline__in-view-icon svg' => [
		'fill'  => $attr['iconFocus'],
		'color' => $attr['iconFocus'],
	],
	' .vxt-timeline__heading-text'                        => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headSpace'], 'px' ),
	],
	' .vxt-timeline-desc-content'                         => [
		'text-align' => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
		'color'      => $attr['subHeadingColor'],
	],
	' .vxt-timeline__day-new'                             => [
		'text-align' => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
	],
	' .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
		'border-left-color'  => $attr['backgroundColor'],
		'border-right-color' => $attr['backgroundColor'],
	],
	' .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
		'border-left-color'  => $attr['backgroundColor'],
		'border-right-color' => $attr['backgroundColor'],
	],
	// Old timeline CSS.
	' .vxt-timeline__center-block .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
		'border-left-color' => $attr['backgroundColor'],
	],
	' .vxt-timeline__right-block .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
		'border-left-color' => $attr['backgroundColor'],
	],
	' .vxt-timeline__right-block .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
		'border-left-color' => $attr['backgroundColor'],
	],
	' .vxt-timeline__center-block .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
		'border-right-color' => $attr['backgroundColor'],
	],
	' .vxt-timeline__left-block .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
		'border-right-color' => $attr['backgroundColor'],
	],
	// Old timeline CSS End.
	// New timeline CSS.
	'.vxt-timeline__center-block .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
		'border-left-color' => $attr['backgroundColor'],
	],
	'.vxt-timeline__right-block .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
		'border-left-color' => $attr['backgroundColor'],
	],
	'.vxt-timeline__right-block .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
		'border-left-color' => $attr['backgroundColor'],
	],
	'.vxt-timeline__center-block .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
		'border-right-color' => $attr['backgroundColor'],
	],
	'.vxt-timeline__left-block .vxt-timeline__day-left .vxt-timeline__arrow:after' => [
		'border-right-color' => $attr['backgroundColor'],
	],
	// New timeline CSS End.
	' .vxt-timeline__line__inner'                         => [
		'background-color' => $attr['separatorFillColor'],
	],
	' .vxt-timeline__line'                                => [
		'background-color' => $attr['separatorColor'],
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorwidth'], 'px' ),
	],
	'.vxt-timeline__right-block .vxt-timeline__line'     => [
		'inset-inline-end' => 'calc( ' . $attr['connectorBgsize'] . 'px / 2 )',
	],
	'.vxt-timeline__left-block .vxt-timeline__line'      => [
		'inset-inline-start' => 'calc( ' . $attr['connectorBgsize'] . 'px / 2 )',
	],
	' .vxt-timeline__marker'                              => [
		'background-color' => $attr['separatorBg'],
		'min-height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsize'], 'px' ),
		'min-width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsize'], 'px' ),
		'line-height'      => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsize'], 'px' ),
		'border'           => $attr['borderwidth'] . 'px solid ' . $attr['separatorBorder'],
	],
	'.vxt-timeline__left-block .vxt-timeline__left .vxt-timeline__arrow' => [
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsize'], 'px' ),
	],
	'.vxt-timeline__right-block .vxt-timeline__right .vxt-timeline__arrow' => [
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsize'], 'px' ),
	],
	'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__arrow' => [
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsize'], 'px' ),
	],
	'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__arrow' => [
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsize'], 'px' ),
	],
	'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__marker' => [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpace'], $attr['horizontalSpaceUnit'] ),
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpace'], $attr['horizontalSpaceUnit'] ),
	],
	'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__marker' => [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpace'], $attr['horizontalSpaceUnit'] ),
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpace'], $attr['horizontalSpaceUnit'] ),
	],
	' .vxt-timeline__field:not(:last-child)'              => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['verticalSpace'], $attr['verticalSpaceUnit'] ),
	],
	' .vxt-timeline__date-hide.vxt-timeline__date-inner' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['dateBottomspace'], 'px' ),
		'color'         => $attr['dateColor'],
		'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
	],
	' .vxt-timeline__date-hide.vxt-timeline__inner-date-new' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['dateBottomspace'], 'px' ),
		'color'         => $attr['dateColor'],
		'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
	],
	'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpace'], $attr['horizontalSpaceUnit'] ),
	],
	'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpace'], $attr['horizontalSpaceUnit'] ),
	],
	'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpace'], $attr['horizontalSpaceUnit'] ),
	],
	'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpace'], $attr['horizontalSpaceUnit'] ),
	],
	' .vxt-timeline__date-new'                            => [
		'color'     => $attr['dateColor'],
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $dateFontSize, $dateFontSizeType ),
	],
	'.vxt-timeline__right-block .vxt-timeline__date-hide.vxt-timeline__date-inner' => [
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $dateFontSize, $dateFontSizeType ),
	],
	'.vxt-timeline__left-block .vxt-timeline__date-hide.vxt-timeline__date-inner' => [
		'font-size' => \Vexaltrix\Support\Helper::getCssValue( $dateFontSize, $dateFontSizeType ),
	],
	' .vxt-events-new .vxt-timeline__events-inner-new'   => [  // Old user CSS.
		'padding' => \Vexaltrix\Support\Helper::getCssValue( $attr['bgPadding'], 'px' ),
	],
	' .vxt-timeline__events-inner-new'                    => [
		'background-color' => $attr['backgroundColor'],
		'border-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['borderRadius'], 'px' ),
	],
	' .vxt-timeline__events-inner--content'               => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $leftPadding, $attr['paddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $rightPadding, $attr['paddingUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $topPadding, $attr['paddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $bottomPadding, $attr['paddingUnit'] ),
	],
	' .vxt-timeline__marker svg'                          => [
		'color' => $attr['iconColor'],
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconSize'], 'px' ),
		'fill'  => $attr['iconColor'],
	],
	' .vxt-timeline__marker.vxt-timeline__in-view-icon'  => [
		'background'   => $attr['iconBgFocus'],
		'border-color' => $attr['borderFocus'],
	],
];

	$mSelectors = [
		' .vxt-timeline__heading'                => [
			'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headSpaceMobile'], 'px' ),
		],
		' .vxt-timeline-desc-content'            => [
			'text-align' => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
		],
		' .vxt-timeline__day-new'                => [
			'text-align' => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
		],
		' .vxt-timeline__heading-text'           => [
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headSpaceMobile'], 'px' ),
		],
		' .vxt-timeline__date-hide.vxt-timeline__date-inner' => [
			'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['dateBottomspaceMobile'], 'px' ),
		],
		' .vxt-timeline__date-hide.vxt-timeline__inner-date-new' => [
			'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['dateBottomspaceMobile'], 'px' ),
		],
		'.vxt-timeline__center-block .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
			'border-right-color' => $attr['backgroundColor'],
		],
		'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__marker' => [
			'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceMobile'], $attr['horizontalSpaceUnitMobile'] ),
			'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceMobile'], $attr['horizontalSpaceUnitMobile'] ),
		],
		'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__marker' => [
			'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceMobile'], $attr['horizontalSpaceUnitMobile'] ),
			'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceMobile'], $attr['horizontalSpaceUnitMobile'] ),
		],
		'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
			'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceMobile'], $attr['horizontalSpaceUnitMobile'] ),
		],
		'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
			'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceMobile'], $attr['horizontalSpaceUnitMobile'] ),
		],
		'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
			'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceMobile'], $attr['horizontalSpaceUnitMobile'] ),
		],
		'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
			'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceMobile'], $attr['horizontalSpaceUnitMobile'] ),
		],
		' .vxt-timeline__events-inner--content'  => [
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['leftPaddingMobile'], $attr['mobilePaddingUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['rightPaddingMobile'], $attr['mobilePaddingUnit'] ),
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['topPaddingMobile'], $attr['mobilePaddingUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['bottomPaddingMobile'], $attr['mobilePaddingUnit'] ),
			'border-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['borderRadiusMobile'], 'px' ),
		],
		'.vxt-timeline__right'                   => [
			'text-align' => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
		],
		' .vxt-timeline__marker svg'             => [
			'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconSizeMobile'], 'px' ),
		],
		' .vxt-timeline__marker'                 => [
			'background-color' => $attr['separatorBg'],
			'min-height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeMobile'], 'px' ),
			'min-width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeMobile'], 'px' ),
			'line-height'      => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeMobile'], 'px' ),
			'border'           => $attr['borderwidth'] . 'px solid ' . $attr['separatorBorder'],
		],
		'.vxt-timeline__left-block .vxt-timeline__left .vxt-timeline__arrow' => [
			'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeMobile'], 'px' ),
		],
		'.vxt-timeline__right-block .vxt-timeline__right .vxt-timeline__arrow' => [
			'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeMobile'], 'px' ),
		],
		'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__arrow' => [
			'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeMobile'], 'px' ),
		],
		'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__arrow' => [
			'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeMobile'], 'px' ),
		],
		' .vxt-timeline__field:not(:last-child)' => [
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['verticalSpaceMobile'], $attr['verticalSpaceUnitMobile'] ),
		],
	];

	$tSelectors = [
		' .vxt-timeline__marker svg'             => [
			'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconSizeTablet'], 'px' ),
		],
		' .vxt-timeline__heading'                => [
			'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headSpaceTablet'], 'px' ),
		],
		' .vxt-timeline__heading-text'           => [
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headSpaceTablet'], 'px' ),
		],
		' .vxt-timeline-desc-content'            => [
			'text-align' => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
		],
		' .vxt-timeline__day-new'                => [
			'text-align' => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
		],
		' .vxt-timeline__date-hide.vxt-timeline__date-inner' => [
			'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['dateBottomspaceTablet'], 'px' ),
		],
		' .vxt-timeline__date-hide.vxt-timeline__inner-date-new' => [
			'text-align'    => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['dateBottomspaceTablet'], 'px' ),
		],
		'.vxt-timeline__center-block .vxt-timeline__day-right .vxt-timeline__arrow:after' => [
			'border-right-color' => $attr['backgroundColor'],
		],
		'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__marker' => [
			'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceTablet'], $attr['horizontalSpaceUnitTablet'] ),
			'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceTablet'], $attr['horizontalSpaceUnitTablet'] ),
		],
		'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__marker' => [
			'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceTablet'], $attr['horizontalSpaceUnitTablet'] ),
			'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceTablet'], $attr['horizontalSpaceUnitTablet'] ),
		],
		'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
			'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceTablet'], $attr['horizontalSpaceUnitTablet'] ),
		],
		'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-left' => [
			'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceTablet'], $attr['horizontalSpaceUnitTablet'] ),
		],
		'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
			'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceTablet'], $attr['horizontalSpaceUnitTablet'] ),
		],
		'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-right' => [
			'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['horizontalSpaceTablet'], $attr['horizontalSpaceUnitTablet'] ),
		],
		' .vxt-timeline__events-inner--content'  => [
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['leftPaddingTablet'], $attr['tabletPaddingUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['rightPaddingTablet'], $attr['tabletPaddingUnit'] ),
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['topPaddingTablet'], $attr['tabletPaddingUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['bottomPaddingTablet'], $attr['tabletPaddingUnit'] ),
			'border-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['borderRadiusTablet'], 'px' ),
		],
		'.vxt-timeline__right'                   => [
			'text-align' => \Vexaltrix\Core\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
		],
		' .vxt-timeline__marker svg'             => [
			'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconSizeTablet'], 'px' ),
		],
		' .vxt-timeline__marker'                 => [
			'background-color' => $attr['separatorBg'],
			'min-height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeTablet'], 'px' ),
			'min-width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeTablet'], 'px' ),
			'line-height'      => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeTablet'], 'px' ),
			'border'           => $attr['borderwidth'] . 'px solid ' . $attr['separatorBorder'],
		],
		'.vxt-timeline__left-block .vxt-timeline__left .vxt-timeline__arrow' => [
			'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeTablet'], 'px' ),
		],
		'.vxt-timeline__right-block .vxt-timeline__right .vxt-timeline__arrow' => [
			'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeTablet'], 'px' ),
		],
		'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__arrow' => [
			'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeTablet'], 'px' ),
		],
		'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__arrow' => [
			'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['connectorBgsizeTablet'], 'px' ),
		],
		' .vxt-timeline__field:not(:last-child)' => [
			'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['verticalSpaceTablet'], $attr['verticalSpaceUnitTablet'] ),
		],
	];

	$combinedSelectors = [
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	];

	$baseSelector      = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-ctm-';
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'head', ' .vxt-timeline__heading', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'date', ' .vxt-timeline__date-new', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'date', ' .vxt-timeline__date-hide.vxt-timeline__inner-date-new', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'date', ' .vxt-timeline__date-hide.vxt-timeline__date-inner', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'subHead', ' .vxt-timeline-desc-content', $combinedSelectors );
	return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id . '.vxt-timeline__outer-wrap' );
