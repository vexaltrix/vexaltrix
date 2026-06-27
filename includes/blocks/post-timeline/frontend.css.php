<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @var int $id
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksPostTimelineGfont( $attr );

$horizontalSpace        = $attr['horizontalSpace'];
$horizontalSpaceTablet = '' !== $attr['horizontalSpaceTablet'] ? $attr['horizontalSpaceTablet'] : $horizontalSpace;
$horizontalSpaceMobile = '' !== $attr['horizontalSpaceMobile'] ? $attr['horizontalSpaceMobile'] : $horizontalSpaceTablet;

$tSelectors = [];

$leftMargin  = isset( $attr['leftMargin'] ) ? $attr['leftMargin'] : $attr['horizontalSpace'];
$rightMargin = isset( $attr['rightMargin'] ) ? $attr['rightMargin'] : $attr['horizontalSpace'];

$selectors = [
	' .vxt-timeline__heading'                            => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
	],
	' .vxt-timeline__link_parent'                        => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
	],
	' .vxt-timeline__image a'                            => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
	],
	' a.vxt-timeline__image'                             => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
	],
	' .vxt-timeline__author-link'                        => [
		'color'      => $attr['authorColor'],
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
	],
	' .vxt-timeline__link'                               => [
		'text-align'    => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['ctaBottomSpacing'], 'px' ),
	],
	' .dashicons-admin-users'                             => [
		'color'       => $attr['authorColor'],
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorFontSize'], $attr['authorFontSizeType'] ),
		'font-weight' => $attr['authorFontWeight'],
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorLineHeight'], $attr['authorLineHeightType'] ),
	],
	' .vxt-timeline__heading a'                          => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
		'color'      => $attr['headingColor'],
	],
	' .vxt-timeline__heading-text'                       => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headSpace'], 'px' ),
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headTopSpacing'], 'px' ),
	],
	'.vxt_ultimate_gutenberg_blocks_timeline__cta-enable .vxt-timeline-desc-content' => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentSpace'], 'px' ),
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorSpace'], 'px' ),
	],
	' .vxt-timeline__author-link + .vxt-timeline__link_parent' => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorSpace'], 'px' ),
	],
	'.vxt-timeline__center-block .vxt-timeline__marker' => [
		'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $horizontalSpace, $attr['horizontalSpaceUnit'] ),
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $horizontalSpace, $attr['horizontalSpaceUnit'] ),
	],
	' .vxt-timeline__field:not(:last-child)'             => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalSpace'], $attr['verticalSpaceUnit'] ),
	],
];

$desktopSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getTimelineSelectors( $attr );
$selectors         = array_merge( $selectors, $desktopSelectors );

$tSelectors = [
	' .dashicons-admin-users'                              => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorFontSizeTablet'], $attr['authorFontSizeType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorLineHeightTablet'], $attr['authorLineHeightType'] ),
	],
	' .vxt-timeline__link'                                => [
		'text-align'    => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['ctaBottomSpacingTablet'], 'px' ),
	],
	' .vxt-timeline__heading-text'                        => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headSpaceTablet'], 'px' ),
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headTopSpacingTablet'], 'px' ),
	],
	'.vxt_ultimate_gutenberg_blocks_timeline__cta-enable .vxt-timeline-desc-content' => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorSpaceTablet'], 'px' ),
	],
	' .vxt-timeline__author-link + .vxt-timeline__link_parent' => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorSpaceTablet'], 'px' ),
	],
	'.vxt-timeline__center-block .vxt-timeline__marker'  => [
		'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $horizontalSpaceTablet, $attr['horizontalSpaceUnitTablet'] ),
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $horizontalSpaceTablet, $attr['horizontalSpaceUnitTablet'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__inner-date-new' => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__right .vxt-timeline__day-new'       => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__day-new.vxt-timeline__events-inner-new' => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__link_parent' => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__image a'     => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__day-new a.vxt-timeline__image'      => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__author-link' => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__heading a'   => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__heading'     => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline-desc-content'                         => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignTablet'] ),
	],
	' .vxt-timeline__field:not(:last-child)'              => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalSpaceTablet'], $attr['verticalSpaceUnitTablet'] ),
	],
];

$tabletSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getTimelineTabletSelectors( $attr );
$tSelectors      = array_merge( $tSelectors, $tabletSelectors );

// Mobile responsive CSS.
$mSelectors = [
	' .dashicons-admin-users'                              => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorFontSizeMobile'], $attr['authorFontSizeType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorLineHeightMobile'], $attr['authorLineHeightType'] ),
	],
	' .vxt-timeline__link'                                => [
		'text-align'    => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['ctaBottomSpacingMobile'], 'px' ),
	],
	' .vxt-timeline__heading-text'                        => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headSpaceMobile'], 'px' ),
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headTopSpacingMobile'], 'px' ),
	],
	'.vxt_ultimate_gutenberg_blocks_timeline__cta-enable .vxt-timeline-desc-content' => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorSpaceMobile'], 'px' ),
	],
	' .vxt-timeline__author-link + .vxt-timeline__link_parent' => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorSpaceMobile'], 'px' ),
	],
	'.vxt-timeline__center-block .vxt-timeline__marker'  => [
		'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $horizontalSpaceMobile, $attr['horizontalSpaceUnitMobile'] ),
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $horizontalSpaceMobile, $attr['horizontalSpaceUnitTablet'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__inner-date-new' => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__right .vxt-timeline__day-new'       => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__day-new.vxt-timeline__events-inner-new' => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__link_parent' => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__image a'     => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__day-new a.vxt-timeline__image'      => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__author-link' => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__heading a'   => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__day-new .vxt-timeline__heading'     => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline-desc-content'                         => [
		'text-align' => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['alignMobile'] ),
	],
	' .vxt-timeline__field:not(:last-child)'              => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalSpaceMobile'], $attr['verticalSpaceUnitMobile'] ),
	],
];

if ( ! $attr['inheritFromTheme'] ) { 
	$selectors = array_merge(
		$selectors,
		[
			' .vxt-timeline__link' => [
				'color'            => $attr['ctaColor'],
				'background-color' => $attr['ctaBackground'],
				'text-align'       => \Vexaltrix\Presentation\Blocks\BlockHelper::getLogicalTextAlign( $attr['align'] ),
				'margin-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['ctaBottomSpacing'], 'px' ),
			],      
		]
	);
}

$mobileSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getTimelineMobileSelectors( $attr );
$mSelectors      = array_merge( $mSelectors, $mobileSelectors );

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];
// .vxt-timeline__date-hide.vxt-timeline__inner-date-new
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'date', ' .vxt-timeline__date-hide.vxt-timeline__inner-date-new', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'date', ' .vxt-timeline__date-hide.vxt-timeline__date-inner', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'date', ' .vxt-timeline__date-new', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'subHead', ' .vxt-timeline-desc-content', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'author', ' .vxt-timeline__author-link', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'head', ' .vxt-timeline__heading a', $combinedSelectors );

if ( ! $attr['inheritFromTheme'] ) {
	$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-timeline__link', $combinedSelectors );
}

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id . '.vxt-timeline__outer-wrap' );
