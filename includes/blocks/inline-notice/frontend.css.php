<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @var mixed[] $attr The block attributes.
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksInlineNoticeGfont( $attr );

$tSelectors = [];
$mSelectors = [];
$selectors   = [];

$leftPadding         = 0;
$rightPadding        = 0;
$leftPaddingMobile  = 0;
$rightPaddingMobile = 0;
$leftPaddingTablet  = 0;
$rightPaddingTablet = 0;

$titleTopPadding    = ( isset( $attr['titleTopPadding'] ) && is_numeric( $attr['titleTopPadding'] ) ) ? $attr['titleTopPadding'] : $attr['titleVrPadding'];
$titleBottomPadding = ( isset( $attr['titleBottomPadding'] ) && is_numeric( $attr['titleBottomPadding'] ) ) ? $attr['titleBottomPadding'] : $attr['titleVrPadding'];
$titleLeftPadding   = ( isset( $attr['titleLeftPadding'] ) && is_numeric( $attr['titleLeftPadding'] ) ) ? $attr['titleLeftPadding'] : $attr['titleHrPadding'];
$titleRightPadding  = ( isset( $attr['titleRightPadding'] ) && is_numeric( $attr['titleRightPadding'] ) ) ? $attr['titleRightPadding'] : $attr['titleHrPadding'];

$titleTopPaddingMobile    = ( isset( $attr['titleTopPaddingMobile'] ) && is_numeric( $attr['titleTopPaddingMobile'] ) ) ? $attr['titleTopPaddingMobile'] : $attr['titleVrPadding'];
$titleBottomPaddingMobile = ( isset( $attr['titleBottomPaddingMobile'] ) && is_numeric( $attr['titleBottomPaddingMobile'] ) ) ? $attr['titleBottomPaddingMobile'] : $attr['titleVrPadding'];
$titleLeftPaddingMobile   = ( isset( $attr['titleLeftPaddingMobile'] ) && is_numeric( $attr['titleLeftPaddingMobile'] ) ) ? $attr['titleLeftPaddingMobile'] : $attr['titleHrPadding'];
$titleRightPaddingMobile  = ( isset( $attr['titleRightPaddingMobile'] ) && is_numeric( $attr['titleRightPaddingMobile'] ) ) ? $attr['titleRightPaddingMobile'] : $attr['titleHrPadding'];

$titleTopPaddingTablet    = ( isset( $attr['titleTopPaddingTablet'] ) && is_numeric( $attr['titleTopPaddingTablet'] ) ) ? $attr['titleTopPaddingTablet'] : $attr['titleVrPadding'];
$titleBottomPaddingTablet = ( isset( $attr['titleBottomPaddingTablet'] ) && is_numeric( $attr['titleBottomPaddingTablet'] ) ) ? $attr['titleBottomPaddingTablet'] : $attr['titleVrPadding'];
$titleLeftPaddingTablet   = ( isset( $attr['titleLeftPaddingTablet'] ) && is_numeric( $attr['titleLeftPaddingTablet'] ) ) ? $attr['titleLeftPaddingTablet'] : $attr['titleHrPadding'];
$titleRightPaddingTablet  = ( isset( $attr['titleRightPaddingTablet'] ) && is_numeric( $attr['titleRightPaddingTablet'] ) ) ? $attr['titleRightPaddingTablet'] : $attr['titleHrPadding'];

$contentTopPadding    = ( isset( $attr['contentTopPadding'] ) && is_numeric( $attr['contentTopPadding'] ) ) ? $attr['contentTopPadding'] : $attr['contentVrPadding'];
$contentBottomPadding = ( isset( $attr['contentBottomPadding'] ) && is_numeric( $attr['contentBottomPadding'] ) ) ? $attr['contentBottomPadding'] : $attr['contentVrPadding'];
$contentLeftPadding   = ( isset( $attr['contentLeftPadding'] ) && is_numeric( $attr['contentLeftPadding'] ) ) ? $attr['contentLeftPadding'] : $attr['contentHrPadding'];
$contentRightPadding  = ( isset( $attr['contentRightPadding'] ) && is_numeric( $attr['contentRightPadding'] ) ) ? $attr['contentRightPadding'] : $attr['contentHrPadding'];

$contentTopPaddingMobile    = ( isset( $attr['contentTopPaddingMobile'] ) && is_numeric( $attr['contentTopPaddingMobile'] ) ) ? $attr['contentTopPaddingMobile'] : $attr['contentVrPadding'];
$contentBottomPaddingMobile = ( isset( $attr['contentBottomPaddingMobile'] ) && is_numeric( $attr['contentBottomPaddingMobile'] ) ) ? $attr['contentBottomPaddingMobile'] : $attr['contentVrPadding'];
$contentLeftPaddingMobile   = ( isset( $attr['contentLeftPaddingMobile'] ) && is_numeric( $attr['contentLeftPaddingMobile'] ) ) ? $attr['contentLeftPaddingMobile'] : $attr['contentHrPadding'];
$contentRightPaddingMobile  = ( isset( $attr['contentRightPaddingMobile'] ) && is_numeric( $attr['contentRightPaddingMobile'] ) ) ? $attr['contentRightPaddingMobile'] : $attr['contentHrPadding'];

$contentTopPaddingTablet    = ( isset( $attr['contentTopPaddingTablet'] ) && is_numeric( $attr['contentTopPaddingTablet'] ) ) ? $attr['contentTopPaddingTablet'] : $attr['contentVrPadding'];
$contentBottomPaddingTablet = ( isset( $attr['contentBottomPaddingTablet'] ) && is_numeric( $attr['contentBottomPaddingTablet'] ) ) ? $attr['contentBottomPaddingTablet'] : $attr['contentVrPadding'];
$contentLeftPaddingTablet   = ( isset( $attr['contentLeftPaddingTablet'] ) && is_numeric( $attr['contentLeftPaddingTablet'] ) ) ? $attr['contentLeftPaddingTablet'] : $attr['contentHrPadding'];
$contentRightPaddingTablet  = ( isset( $attr['contentRightPaddingTablet'] ) && is_numeric( $attr['contentRightPaddingTablet'] ) ) ? $attr['contentRightPaddingTablet'] : $attr['contentHrPadding'];

$posTopTab        = isset( $attr['titleTopPaddingTablet'] ) ? $attr['titleTopPaddingTablet'] : $attr['titleTopPadding'];
$posLeftTab       = isset( $attr['titleLeftPaddingTablet'] ) ? $attr['titleLeftPaddingTablet'] : $attr['titleLeftPadding'];
$posRightTab      = isset( $attr['titleRightPaddingTablet'] ) ? $attr['titleRightPaddingTablet'] : $attr['titleRightPadding'];
$posClassicTab    = isset( $attr['highlightWidthTablet'] ) ? $attr['highlightWidthTablet'] : $attr['highlightWidth'];
$posTopUnitTab   = isset( $attr['titleTopPaddingTablet'] ) ? $attr['tabletTitlePaddingUnit'] : $attr['titlePaddingUnit'];
$posLeftUnitTab  = isset( $attr['titleLeftPaddingTablet'] ) ? $attr['tabletTitlePaddingUnit'] : $attr['titlePaddingUnit'];
$posRightUnitTab = isset( $attr['titleRightPaddingTablet'] ) ? $attr['tabletTitlePaddingUnit'] : $attr['titlePaddingUnit'];

$posTopMob        = isset( $attr['titleTopPaddingMobile'] ) ? $attr['titleTopPaddingMobile'] : $posTopTab;
$posLeftMob       = isset( $attr['titleLeftPaddingMobile'] ) ? $attr['titleLeftPaddingMobile'] : $posLeftTab;
$posRightMob      = isset( $attr['titleRightPaddingMobile'] ) ? $attr['titleRightPaddingMobile'] : $posRightTab;
$posClassicMob    = isset( $attr['highlightWidthMobile'] ) ? $attr['highlightWidthMobile'] : $posClassicTab;
$posTopUnitMob   = isset( $attr['titleTopPaddingMobile'] ) ? $attr['mobileTitlePaddingUnit'] : $posTopUnitTab;
$posLeftUnitMob  = isset( $attr['titleLeftPaddingMobile'] ) ? $attr['mobileTitlePaddingUnit'] : $posLeftUnitTab;
$posRightUnitMob = isset( $attr['titleRightPaddingMobile'] ) ? $attr['mobileTitlePaddingUnit'] : $posRightUnitTab;

if ( $attr['noticeDismiss'] ) {
	if ( 'left' === $attr['noticeAlignment'] || 'center' === $attr['noticeAlignment'] ) {
		$rightPadding        = $titleRightPadding;
		$leftPadding         = $titleLeftPadding;
		$leftPaddingMobile  = $titleLeftPaddingMobile;
		$rightPaddingMobile = $titleRightPaddingMobile;
		$leftPaddingTablet  = $titleLeftPaddingTablet;
		$rightPaddingTablet = $titleRightPaddingTablet;
	} else {
		$leftPadding         = $titleLeftPadding;
		$rightPadding        = $titleRightPadding;
		$leftPaddingMobile  = $titleLeftPaddingMobile;
		$rightPaddingMobile = $titleRightPaddingMobile;
		$leftPaddingTablet  = $titleLeftPaddingTablet;
		$rightPaddingTablet = $titleRightPaddingTablet;
	}
} else {
	$leftPadding         = $titleLeftPadding;
	$rightPadding        = $titleRightPadding;
	$leftPaddingMobile  = $titleLeftPaddingMobile;
	$rightPaddingMobile = $titleRightPaddingMobile;
	$leftPaddingTablet  = $titleLeftPaddingTablet;
	$rightPaddingTablet = $titleRightPaddingTablet;
}

$selectors = [
	'.wp-block-vxt-inline-notice .vxt-notice-title' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPadding, $attr['titlePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPadding, $attr['titlePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $titleTopPadding, $attr['titlePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $titleBottomPadding, $attr['titlePaddingUnit'] ),
		'color'          => $attr['titleColor'],
	],
	' .vxt-notice-text'                              => [
		'color'          => $attr['textColor'],
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $contentLeftPadding, $attr['contentPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $contentRightPadding, $attr['contentPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $contentTopPadding, $attr['contentPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $contentBottomPadding, $attr['contentPaddingUnit'] ),
	],
	' span.vxt-notice-dismiss svg'                   => [ // For Backward.
		'fill'  => $attr['noticeDismissColor'],
		'color' => $attr['noticeDismissColor'],
	],
	' svg'                                            => [ // For Backward.
		'fill'  => $attr['noticeDismissColor'],
		'color' => $attr['noticeDismissColor'],
	],
	' button[type="button"] svg'                      => [
		'fill'  => $attr['noticeDismissColor'],
		'color' => $attr['noticeDismissColor'],
	],
	'.vxt-dismissable button[type="button"] svg'     => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeUnit'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeUnit'] ),
		'top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleTopPadding'], $attr['titlePaddingUnit'] ),
	],
	'.vxt-dismissable > svg'                         => [ // For Backward.
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeUnit'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeUnit'] ),
		'top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleTopPadding'], $attr['titlePaddingUnit'] ),
	],
	'.vxt-inline_notice__align-left button[type="button"] svg' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleRightPadding'], $attr['titlePaddingUnit'] ),
	],
	'.vxt-inline_notice__align-left svg'             => [ // For Backward.
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleRightPadding'], $attr['titlePaddingUnit'] ),
	],
	'.vxt-inline_notice__align-center button[type="button"] svg' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleRightPadding'], $attr['titlePaddingUnit'] ),
	],
	'.vxt-inline_notice__align-center svg'           => [ // For Backward.
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleRightPadding'], $attr['titlePaddingUnit'] ),
	],
];

$mSelectors = [
	' .vxt-notice-text'                          => [
		'color'          => $attr['textColor'],
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $contentLeftPaddingMobile, $attr['mobileContentPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $contentRightPaddingMobile, $attr['mobileContentPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $contentTopPaddingMobile, $attr['mobileContentPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $contentBottomPaddingMobile, $attr['mobileContentPaddingUnit'] ),
	],
	' .vxt-notice-title'                         => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingMobile, $attr['mobileTitlePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingMobile, $attr['mobileTitlePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $titleTopPaddingMobile, $attr['mobileTitlePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $titleBottomPaddingMobile, $attr['mobileTitlePaddingUnit'] ),
	],
	'.vxt-dismissable button[type="button"] svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMob'], $attr['iconSizeUnit'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMob'], $attr['iconSizeUnit'] ),
		'top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $posTopMob, $posTopUnitMob ),
	],
	'.vxt-dismissable > svg'                     => [ // For Backward.
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMob'], $attr['iconSizeUnit'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMob'], $attr['iconSizeUnit'] ),
		'top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $posTopMob, $posTopUnitMob ),
	],
	'.vxt-inline_notice__align-left button[type="button"] svg' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $posRightMob, $posRightUnitMob ),
	],
	'.vxt-inline_notice__align-left svg'         => [ // For Backward.
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $posRightMob, $posRightUnitMob ),
	],
	'.vxt-inline_notice__align-center button[type="button"] svg' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $posRightMob, $posRightUnitMob ),
	],
	'.vxt-inline_notice__align-center svg'       => [ // For Backward.
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $posRightMob, $posRightUnitMob ),
	],
];

$tSelectors = [
	' .vxt-notice-text'                          => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $contentLeftPaddingTablet, $attr['tabletContentPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $contentRightPaddingTablet, $attr['tabletContentPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $contentTopPaddingTablet, $attr['tabletContentPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $contentBottomPaddingTablet, $attr['tabletContentPaddingUnit'] ),
	],
	' .vxt-notice-title'                         => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingTablet, $attr['tabletTitlePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingTablet, $attr['tabletTitlePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $titleTopPaddingTablet, $attr['tabletTitlePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $titleBottomPaddingTablet, $attr['tabletTitlePaddingUnit'] ),
	],
	'.vxt-dismissable button[type="button"] svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTab'], $attr['iconSizeUnit'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTab'], $attr['iconSizeUnit'] ),
		'top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $posTopTab, $posTopUnitTab ),
	],
	'.vxt-dismissable > svg'                     => [ // For Backward.
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTab'], $attr['iconSizeUnit'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTab'], $attr['iconSizeUnit'] ),
		'top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $posTopTab, $posTopUnitTab ),
	],
	'.vxt-inline_notice__align-left button[type="button"] svg' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $posRightTab, $posRightUnitTab ),
	],
	'.vxt-inline_notice__align-left svg'         => [ // For Backward.
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $posRightTab, $posRightUnitTab ),
	],
	'.vxt-inline_notice__align-center button[type="button"] svg' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $posRightTab, $posRightUnitTab ),
	],
	'.vxt-inline_notice__align-center svg'       => [ // For Backward.
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $posRightTab, $posRightUnitTab ),
	],
];

if ( 'modern' === $attr['layout'] ) {

	$selectors[' .vxt-notice-title']['background-color']        = $attr['noticeColor'];
	$selectors[' .vxt-notice-title']['border-top-right-radius'] = '3px';
	$selectors[' .vxt-notice-title']['border-top-left-radius']  = '3px';

	$selectors[' .vxt-notice-text']['background-color']           = $attr['contentBgColor'];
	$selectors[' .vxt-notice-text']['border']                     = '2px solid ' . $attr['noticeColor'];
	$selectors[' .vxt-notice-text']['border-bottom-left-radius']  = '3px';
	$selectors[' .vxt-notice-text']['border-bottom-right-radius'] = '3px';

	$selectors['.vxt-inline_notice__align-right button[type="button"] svg']['left']   = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['titleLeftPadding'], $attr['titlePaddingUnit'] );
	$tSelectors['.vxt-inline_notice__align-right button[type="button"] svg']['left'] = \Vexaltrix\Core\Support\Helper::getCssValue( $posLeftTab, $posLeftUnitTab );
	$mSelectors['.vxt-inline_notice__align-right button[type="button"] svg']['left'] = \Vexaltrix\Core\Support\Helper::getCssValue( $posLeftMob, $posLeftUnitMob );

} elseif ( 'simple' === $attr['layout'] ) {

	$selectors[' .vxt-notice-title']['background-color'] = $attr['contentBgColor'];
	$selectors[' .vxt-notice-title']['border-left']      = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highlightWidth'], 'px' ) . ' solid ' . $attr['noticeColor'];
	$tSelectors[' .vxt-notice-title']['border-left']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highlightWidthTablet'], 'px' ) . ' solid ' . $attr['noticeColor'];
	$mSelectors[' .vxt-notice-title']['border-left']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highlightWidthMobile'], 'px' ) . ' solid ' . $attr['noticeColor'];

	$selectors[' .vxt-notice-text']['background-color'] = $attr['contentBgColor'];
	$selectors[' .vxt-notice-text']['border-left']      = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highlightWidth'], 'px' ) . ' solid ' . $attr['noticeColor'];
	$tSelectors[' .vxt-notice-text']['border-left']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highlightWidthTablet'], 'px' ) . ' solid ' . $attr['noticeColor'];
	$mSelectors[' .vxt-notice-text']['border-left']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['highlightWidthMobile'], 'px' ) . ' solid ' . $attr['noticeColor'];

	$selectors['.vxt-inline_notice__align-right button[type="button"] svg']['left']   = 'calc(' . $attr['titleLeftPadding'] . $attr['titlePaddingUnit'] . ' + ' . $attr['highlightWidth'] . 'px)';
	$tSelectors['.vxt-inline_notice__align-right button[type="button"] svg']['left'] = 'calc(' . $posLeftTab . $posLeftUnitTab . ' + ' . $posClassicTab . 'px)';
	$mSelectors['.vxt-inline_notice__align-right button[type="button"] svg']['left'] = 'calc(' . $posLeftMob . $posLeftUnitMob . ' + ' . $posClassicMob . 'px)';

}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-notice-title', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'desc', ' .vxt-notice-text', $combinedSelectors );

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, ' .vxt-block-' . $id );
