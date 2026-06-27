<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var string[] $attr
 * @var int $id
 *
 * @package ugb
 */

$overallBorderCss    = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'tab' );
$overallBorderCss    = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$overallBorderCss,
	( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);
$overallBorderTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'tab', 'tablet' );
$overallBorderMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'tab', 'mobile' );
// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksTabsGfont( $attr );

$tabTitleTopPadding    = isset( $attr['tabTitleTopPadding'] ) ? $attr['tabTitleTopPadding'] : $attr['tabTitleVertPadding'];
$tabTitleBottomPadding = isset( $attr['tabTitleBottomPadding'] ) ? $attr['tabTitleBottomPadding'] : $attr['tabTitleVertPadding'];
$tabTitleLeftPadding   = isset( $attr['tabTitleLeftPadding'] ) ? $attr['tabTitleLeftPadding'] : $attr['tabTitleHrPadding'];
$tabTitleRightPadding  = isset( $attr['tabTitleRightPadding'] ) ? $attr['tabTitleRightPadding'] : $attr['tabTitleHrPadding'];

$tabBodyTopPadding    = isset( $attr['tabBodyTopPadding'] ) ? $attr['tabBodyTopPadding'] : $attr['tabBodyVertPadding'];
$tabBodyBottomPadding = isset( $attr['tabBodyBottomPadding'] ) ? $attr['tabBodyBottomPadding'] : $attr['tabBodyVertPadding'];
$tabBodyLeftPadding   = isset( $attr['tabBodyLeftPadding'] ) ? $attr['tabBodyLeftPadding'] : $attr['tabBodyHrPadding'];
$tabBodyRightPadding  = isset( $attr['tabBodyRightPadding'] ) ? $attr['tabBodyRightPadding'] : $attr['tabBodyHrPadding'];

$selectors = [
	' .vxt-tabs__panel .vxt-tab '                        => array_merge(
		[
			'background' => $attr['headerBgColor'],
			'text-align' => $attr['titleAlign'],
		],
		$overallBorderCss
	),
	' .vxt-tabs__panel .vxt-tab .vxt-tabs-list'         => array_merge(
		[
			'justify-content' => $attr['titleAlign'],
		]
	),
	'.vxt-tabs__wrap ul.vxt-tabs__panel li.vxt-tab a '  => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $tabTitleTopPadding, $attr['tabTitlePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $tabTitleBottomPadding, $attr['tabTitlePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $tabTitleLeftPadding, $attr['tabTitlePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $tabTitleRightPadding, $attr['tabTitlePaddingUnit'] ),
		'color'          => $attr['headerTextColor'],
	],
	'.vxt-tabs__wrap ul.vxt-tabs__panel li.vxt-tab'     => [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleTopMargin'], $attr['tabTitleMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleLeftMargin'], $attr['tabTitleMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleRightMargin'], $attr['tabTitleMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleBottomMargin'], $attr['tabTitleMarginUnit'] ),
	],
	'.vxt-tabs__wrap .vxt-tabs__panel .vxt-tab:hover '  => [
		'border-color' => $attr['tabBorderHColor'],
	],
	' .vxt-tabs__panel .vxt-tab.vxt-tabs__active'       => [
		'background' => $attr['activeTabBgColor'],
	],
	'.vxt-tabs__wrap ul.vxt-tabs__panel li.vxt-tab.vxt-tabs__active a' => [
		'color' => $attr['activeTabTextColor'],
	],
	' .vxt-tabs__panel .vxt-tab.vxt-tabs__active .vxt-tabs__icon svg' => [
		'fill' => $attr['activeiconColor'],
	],

	'.vxt-tabs__wrap .vxt-tabs__body-wrap '              => [
		'background'     => $attr['bodyBgColor'],
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $tabBodyTopPadding, $attr['tabBodyPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $tabBodyBottomPadding, $attr['tabBodyPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $tabBodyLeftPadding, $attr['tabBodyPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $tabBodyRightPadding, $attr['tabBodyPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyTopMargin'], $attr['tabBodyMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyLeftMargin'], $attr['tabBodyMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyRightMargin'], $attr['tabBodyMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyBottomMargin'], $attr['tabBodyMarginUnit'] ),
	],
	'.vxt-tabs__wrap .vxt-tabs__body-wrap:hover '        => [
		'border-color' => $attr['tabBorderHColor'],
	],
	' .vxt-tabs__body-wrap p '                            => [
		'color' => $attr['bodyTextColor'],
	],
	' .vxt-tabs__icon svg'                                => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], 'px' ),
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], 'px' ),
		'fill'   => $attr['iconColor'],
	],
	' .vxt-tabs__icon-position-left > .vxt-tabs__icon'   => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacing'], 'px' ),
	],
	' .vxt-tabs__icon-position-right > .vxt-tabs__icon'  => [
		'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacing'], 'px' ),
	],
	' .vxt-tabs__icon-position-bottom > .vxt-tabs__icon' => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacing'], 'px' ),
	],
	' .vxt-tabs__icon-position-top > .vxt-tabs__icon'    => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacing'], 'px' ),
	],
	'.vxt-tabs__hstyle1-desktop > .vxt-tabs__panel .vxt-tab' => $overallBorderCss,
	'.vxt-tabs__hstyle1-desktop > .vxt-tabs__body-wrap'  => $overallBorderCss,
	'.vxt-tabs__hstyle2-desktop > .vxt-tabs__panel .vxt-tab' => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__hstyle2-desktop ul.vxt-tabs__panel'      => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderCss
	),
	'.vxt-tabs__hstyle2-desktop > .vxt-tabs__body-wrap'  => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__hstyle3-desktop .vxt-tab'                => array_merge(
		[
			'border-bottom-width' => '0px',
			'border-bottom'       => 0,
			'outline'             => 0,
			'border-radius'       => 0,
		],
		$overallBorderCss
	),
	'.vxt-tabs__hstyle3-desktop > .vxt-tabs__body-wrap'  => $overallBorderCss,
	'.vxt-tabs__hstyle4-desktop .vxt-tab'                => array_merge(
		[
			'border-radius' => '30px',
		],
		$overallBorderCss
	),
	'.vxt-tabs__hstyle4-desktop > .vxt-tabs__body-wrap'  => $overallBorderCss,
	'.vxt-tabs__hstyle5-desktop'                          => $overallBorderCss,
	'.vxt-tabs__hstyle5-desktop .vxt-tab'                => [
		'border-top-width'    => '0px',
		'border-right-width'  => '0px',
		'border-left-width'   => '0px',
		'border-bottom-width' => '0px',
		'border-top'          => 0,
		'border-left'         => 0,
		'border-right'        => 0,
		'border-bottom'       => 0,
		'outline'             => 0,
		'border-radius'       => 0,
	],
	'.vxt-tabs__hstyle5-desktop .vxt-tab.vxt-tabs__active' => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderCss
	),
	'.vxt-tabs__vstyle6-desktop .vxt-tab'                => $overallBorderCss,
	'.vxt-tabs__vstyle6-desktop .vxt-tabs__body-wrap'    => $overallBorderCss,
	'.vxt-tabs__vstyle7-desktop .vxt-tab'                => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderCss
	),
	'.vxt-tabs__vstyle7-desktop > .vxt-tabs__body-wrap'  => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle8-desktop .vxt-tab'                => array_merge(
		[
			'border-right-width' => '0px',
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderCss
	),
	'.vxt-tabs__vstyle8-desktop > .vxt-tabs__body-wrap'  => $overallBorderCss,
	'.vxt-tabs__vstyle9-desktop .vxt-tab'                => array_merge(
		[
			'border-radius' => '30px',
		],
		$overallBorderCss
	),
	'.vxt-tabs__vstyle9-desktop > .vxt-tabs__body-wrap'  => $overallBorderCss,
	'.vxt-tabs__vstyle10-desktop'                         => $overallBorderCss,
	'.vxt-tabs__vstyle10-desktop ul.vxt-tabs__panel .vxt-tab' => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle10-desktop .vxt-tabs__body-wrap'   => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle10-desktop ul.vxt-tabs__panel .vxt-tab.vxt-tabs__active' => array_merge(
		[
			'border-top-width'    => '0px',
			'border-bottom-width' => '0px',
			'border-left-width'   => '0px',
			'border-top'          => 0,
			'border-left'         => 0,
			'border-bottom'       => 0,
			'outline'             => 0,
			'border-radius'       => 0,
		],
		$overallBorderCss
	),
];
if ( 'left' === $attr['tabAlign'] ) {
	$selectors[' ul.vxt-tabs__panel'] = [
		'margin-right' => 'auto',
		'margin-left'  => 0,
	];
} elseif ( 'right' === $attr['tabAlign'] ) {
	$selectors[' ul.vxt-tabs__panel'] = [
		'margin-left'  => 'auto',
		'margin-right' => 0,
	];
} else {
	$selectors[' ul.vxt-tabs__panel'] = [
		'margin' => 'auto',
	];
}
$mSelectors = [
	' .vxt-tabs__icon svg'                                => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMobile'], 'px' ),
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeMobile'], 'px' ),
	],
	'.vxt-tabs__wrap ul.vxt-tabs__panel li.vxt-tab a '  => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleTopPaddingMobile'], $attr['mobiletabTitlePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleBottomPaddingMobile'], $attr['mobiletabTitlePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleLeftPaddingMobile'], $attr['mobiletabTitlePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleRightPaddingMobile'], $attr['mobiletabTitlePaddingUnit'] ),
	],
	'.vxt-tabs__wrap ul.vxt-tabs__panel li.vxt-tab'     => [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleTopMarginMobile'], $attr['mobiletabTitleMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleLeftMarginMobile'], $attr['mobiletabTitleMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleRightMarginMobile'], $attr['mobiletabTitleMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleBottomMarginMobile'], $attr['mobiletabTitleMarginUnit'] ),
	],
	'.vxt-tabs__wrap .vxt-tabs__body-wrap'               => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyTopPaddingMobile'], $attr['mobiletabBodyPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyBottomPaddingMobile'], $attr['mobiletabBodyPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyLeftPaddingMobile'], $attr['mobiletabBodyPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyRightPaddingMobile'], $attr['mobiletabBodyPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyTopMarginMobile'], $attr['mobiletabBodyMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyLeftMarginMobile'], $attr['mobiletabBodyMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyRightMarginMobile'], $attr['mobiletabBodyMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyBottomMarginMobile'], $attr['mobiletabBodyMarginUnit'] ),
	],
	' .vxt-tabs__icon-position-left > .vxt-tabs__icon'   => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacingMobile'], 'px' ),
	],
	' .vxt-tabs__icon-position-right > .vxt-tabs__icon'  => [
		'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacingMobile'], 'px' ),
	],
	' .vxt-tabs__icon-position-bottom > .vxt-tabs__icon' => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacingMobile'], 'px' ),
	],
	' .vxt-tabs__icon-position-top > .vxt-tabs__icon'    => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacingMobile'], 'px' ),
	],
	'.vxt-tabs__hstyle1-mobile > .vxt-tabs__panel .vxt-tab' => $overallBorderMobile,
	'.vxt-tabs__hstyle1-mobile > .vxt-tabs__body-wrap'   => $overallBorderMobile,
	'.vxt-tabs__hstyle2-mobile > .vxt-tabs__panel .vxt-tab' => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__hstyle2-mobile ul.vxt-tabs__panel'       => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderMobile
	),
	'.vxt-tabs__hstyle2-mobile > .vxt-tabs__body-wrap'   => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__hstyle3-mobile .vxt-tab'                 => array_merge(
		[
			'border-bottom-width' => '0px',
			'border-bottom'       => 0,
			'outline'             => 0,
			'border-radius'       => 0,
		],
		$overallBorderMobile
	),
	'.vxt-tabs__hstyle3-mobile > .vxt-tabs__body-wrap'   => $overallBorderMobile,
	'.vxt-tabs__hstyle4-mobile .vxt-tab'                 => array_merge(
		[
			'border-radius' => '30px',
		],
		$overallBorderMobile
	),
	'.vxt-tabs__hstyle4-mobile > .vxt-tabs__body-wrap'   => $overallBorderMobile,
	'.vxt-tabs__hstyle5-mobile'                           => $overallBorderMobile,
	'.vxt-tabs__hstyle5-mobile .vxt-tab'                 => [
		'border-top-width'    => '0px',
		'border-right-width'  => '0px',
		'border-left-width'   => '0px',
		'border-bottom-width' => '0px',
		'border-top'          => 0,
		'border-left'         => 0,
		'border-right'        => 0,
		'border-bottom'       => 0,
		'outline'             => 0,
		'border-radius'       => 0,
	],
	'.vxt-tabs__hstyle5-mobile .vxt-tab.vxt-tabs__active' => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderMobile
	),
	'.vxt-tabs__vstyle6-mobile .vxt-tab'                 => $overallBorderMobile,
	'.vxt-tabs__vstyle6-mobile .vxt-tabs__body-wrap'     => $overallBorderMobile,
	'.vxt-tabs__vstyle7-mobile .vxt-tab'                 => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderMobile
	),
	'.vxt-tabs__vstyle7-mobile > .vxt-tabs__body-wrap'   => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle8-mobile .vxt-tab'                 => array_merge(
		[
			'border-right-width' => '0px',
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderMobile
	),
	'.vxt-tabs__vstyle8-mobile > .vxt-tabs__body-wrap'   => $overallBorderMobile,
	'.vxt-tabs__vstyle9-mobile .vxt-tab'                 => array_merge(
		[
			'border-radius' => '30px',
		],
		$overallBorderMobile
	),
	'.vxt-tabs__vstyle9-mobile > .vxt-tabs__body-wrap'   => $overallBorderMobile,
	'.vxt-tabs__vstyle10-mobile'                          => $overallBorderMobile,
	'.vxt-tabs__vstyle10-mobile ul.vxt-tabs__panel .vxt-tab' => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle10-mobile .vxt-tabs__body-wrap'    => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle10-mobile ul.vxt-tabs__panel .vxt-tab.vxt-tabs__active' => array_merge(
		[
			'border-top-width'    => '0px',
			'border-bottom-width' => '0px',
			'border-left-width'   => '0px',
			'border-top'          => 0,
			'border-left'         => 0,
			'border-bottom'       => 0,
			'outline'             => 0,
			'border-radius'       => 0,
		],
		$overallBorderMobile
	),
	'.vxt-tabs__stack1-mobile > .vxt-tabs__panel .vxt-tab' => $overallBorderMobile,
	'.vxt-tabs__stack1-mobile > .vxt-tabs__body-wrap'    => $overallBorderMobile,
	'.vxt-tabs__stack2-mobile .vxt-tab'                  => array_merge(
		[
			'border-bottom-width' => '0px',
			'border-bottom'       => 0,
			'outline'             => 0,
			'border-radius'       => 0,
		],
		$overallBorderMobile
	),
	'.vxt-tabs__stack2-mobile > .vxt-tabs__body-wrap'    => $overallBorderMobile,
	'.vxt-tabs__stack3-mobile .vxt-tab'                  => array_merge(
		[
			'border-radius' => '30px',
		],
		$overallBorderMobile
	),
	'.vxt-tabs__stack3-mobile > .vxt-tabs__body-wrap'    => $overallBorderMobile,
	'.vxt-tabs__stack4-mobile'                            => $overallBorderMobile,
	'.vxt-tabs__stack4-mobile .vxt-tab'                  => [
		'border-top-width'    => '0px',
		'border-right-width'  => '0px',
		'border-left-width'   => '0px',
		'border-bottom-width' => '0px',
		'border-top'          => 0,
		'border-left'         => 0,
		'border-right'        => 0,
		'border-bottom'       => 0,
		'outline'             => 0,
		'border-radius'       => 0,
	],
	'.vxt-tabs__stack4-mobile .vxt-tab.vxt-tabs__active' => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderMobile
	),


];
$tSelectors = [
	' .vxt-tabs__icon svg'                                => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTablet'], 'px' ),
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSizeTablet'], 'px' ),
	],
	'.vxt-tabs__wrap ul.vxt-tabs__panel li.vxt-tab a '  => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleTopPaddingTablet'], $attr['tablettabTitlePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleBottomPaddingTablet'], $attr['tablettabTitlePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleLeftPaddingTablet'], $attr['tablettabTitlePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleRightPaddingTablet'], $attr['tablettabTitlePaddingUnit'] ),
	],
	'.vxt-tabs__wrap ul.vxt-tabs__panel li.vxt-tab '    => [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleTopMarginTablet'], $attr['tablettabTitleMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleLeftMarginTablet'], $attr['tablettabTitleMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleRightMarginTablet'], $attr['tablettabTitleMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabTitleBottomMarginTablet'], $attr['tablettabTitleMarginUnit'] ),
	],
	'.vxt-tabs__wrap .vxt-tabs__body-wrap '              => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyTopPaddingTablet'], $attr['tablettabBodyPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyBottomPaddingTablet'], $attr['tablettabBodyPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyLeftPaddingTablet'], $attr['tablettabBodyPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyRightPaddingTablet'], $attr['tablettabBodyPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyTopMarginTablet'], $attr['tablettabBodyMarginUnit'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyLeftMarginTablet'], $attr['tablettabBodyMarginUnit'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyRightMarginTablet'], $attr['tablettabBodyMarginUnit'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tabBodyBottomMarginTablet'], $attr['tablettabBodyMarginUnit'] ),
	],
	' .vxt-tabs__icon-position-left > .vxt-tabs__icon'   => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacingTablet'], 'px' ),
	],
	' .vxt-tabs__icon-position-right > .vxt-tabs__icon'  => [
		'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacingTablet'], 'px' ),
	],
	' .vxt-tabs__icon-position-bottom > .vxt-tabs__icon' => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacingTablet'], 'px' ),
	],
	' .vxt-tabs__icon-position-top > .vxt-tabs__icon'    => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSpacingTablet'], 'px' ),
	],
	'.vxt-tabs__hstyle1-tablet > .vxt-tabs__panel .vxt-tab' => $overallBorderTablet,
	'.vxt-tabs__hstyle1-tablet > .vxt-tabs__body-wrap'   => $overallBorderTablet,
	'.vxt-tabs__hstyle2-tablet > .vxt-tabs__panel .vxt-tab' => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__hstyle2-tablet ul.vxt-tabs__panel'       => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderTablet
	),
	'.vxt-tabs__hstyle2-tablet > .vxt-tabs__body-wrap'   => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__hstyle3-tablet .vxt-tab'                 => array_merge(
		[
			'border-bottom-width' => '0px',
			'border-bottom'       => 0,
			'outline'             => 0,
			'border-radius'       => 0,
		],
		$overallBorderTablet
	),
	'.vxt-tabs__hstyle3-tablet > .vxt-tabs__body-wrap'   => $overallBorderTablet,
	'.vxt-tabs__hstyle4-tablet .vxt-tab'                 => array_merge(
		[
			'border-radius' => '30px',
		],
		$overallBorderTablet
	),
	'.vxt-tabs__hstyle4-tablet > .vxt-tabs__body-wrap'   => $overallBorderTablet,
	'.vxt-tabs__hstyle5-tablet'                           => $overallBorderTablet,
	'.vxt-tabs__hstyle5-tablet .vxt-tab'                 => [
		'border-top-width'    => '0px',
		'border-right-width'  => '0px',
		'border-left-width'   => '0px',
		'border-bottom-width' => '0px',
		'border-top'          => 0,
		'border-left'         => 0,
		'border-right'        => 0,
		'border-bottom'       => 0,
		'outline'             => 0,
		'border-radius'       => 0,
	],
	'.vxt-tabs__hstyle5-tablet .vxt-tab.vxt-tabs__active' => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderTablet
	),
	'.vxt-tabs__vstyle6-tablet > .vxt-tabs__panel .vxt-tab' => $overallBorderTablet,
	'.vxt-tabs__vstyle6-tablet > .vxt-tabs__body-wrap'   => $overallBorderTablet,
	'.vxt-tabs__vstyle7-tablet .vxt-tab'                 => array_merge(
		[
			'border-top-width'   => '0px',
			'border-right-width' => '0px',
			'border-left-width'  => '0px',
			'border-top'         => 0,
			'border-left'        => 0,
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderTablet
	),
	'.vxt-tabs__vstyle7-tablet > .vxt-tabs__body-wrap'   => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle8-tablet .vxt-tab'                 => array_merge(
		[
			'border-right-width' => '0px',
			'border-right'       => 0,
			'outline'            => 0,
			'border-radius'      => 0,
		],
		$overallBorderTablet
	),
	'.vxt-tabs__vstyle8-tablet > .vxt-tabs__body-wrap'   => $overallBorderTablet,
	'.vxt-tabs__vstyle9-tablet .vxt-tab'                 => array_merge(
		[
			'border-radius' => '30px',
		],
		$overallBorderTablet
	),
	'.vxt-tabs__vstyle9-tablet > .vxt-tabs__body-wrap'   => $overallBorderTablet,
	'.vxt-tabs__vstyle10-tablet'                          => $overallBorderTablet,
	'.vxt-tabs__vstyle10-tablet ul.vxt-tabs__panel .vxt-tab' => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle10-tablet .vxt-tabs__body-wrap'    => [
		'border-width' => '0px',
		'border-style' => 'none',
	],
	'.vxt-tabs__vstyle10-tablet ul.vxt-tabs__panel .vxt-tab.vxt-tabs__active' => array_merge(
		[
			'border-top-width'    => '0px',
			'border-bottom-width' => '0px',
			'border-left-width'   => '0px',
			'border-top'          => 0,
			'border-left'         => 0,
			'border-bottom'       => 0,
			'outline'             => 0,
			'border-radius'       => 0,
		],
		$overallBorderTablet
	),
];

$combinedSelectors = [
	'desktop' => $selectors,
	'mobile'  => $mSelectors,
	'tablet'  => $tSelectors,
];
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'title', '  .vxt-tabs__panel .vxt-tab a', $combinedSelectors );

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
