<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksHowToGfont( $attr );

$tSelectors = [];
$mSelectors = [];

$selectors = [
	' .vxt-how-to-main-wrap'                              => [ // For Backword.
		'text-align' => $attr['overallAlignment'],
	],
	'.vxt-how-to-main-wrap'                               => [
		'text-align' => $attr['overallAlignment'],
	],
	'.vxt-how-to-main-wrap p.vxt-howto-desc-text'        => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	'.vxt-how-to-main-wrap .vxt-howto__source-wrap'      => [ // For Backword.
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],
	'.vxt-how-to-main-wrap .vxt-howto__source-image'     => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	'.vxt-how-to-main-wrap span.vxt-howto__time-wrap'    => [
		'margin-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
		'justify-content' => $attr['overallAlignment'],
	],

	'.vxt-how-to-main-wrap span.vxt-howto__cost-wrap'    => [
		'margin-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
		'justify-content' => $attr['overallAlignment'],
	],

	' h4.vxt-howto-req-steps-text'                        => [
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],
	' h4.vxt-howto-req-materials-text'                    => [
		'margin-top' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],


	'.vxt-how-to-main-wrap .vxt-how-to-tools-child__wrapper:last-child' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	'.vxt-how-to-main-wrap .vxt-how-to-tools__wrap'      => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	'.vxt-how-to-main-wrap .vxt-how-to-materials-child__wrapper:last-child' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	// for backward compatibility.
	' .vxt-how-to-materials .vxt-how-to-materials-child__wrapper:last-child' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	' .vxt-tools__wrap .vxt-how-to-tools-child__wrapper:last-child' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	' .vxt-how-to-main-wrap span.vxt-howto__cost-wrap'   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	' .vxt-how-to-main-wrap span.vxt-howto__time-wrap'   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	'.vxt-how-to-main-wrap p'                             => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	' .vxt-howto__source-wrap'                            => [ // For Backword.
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],
	' .vxt-howto__source-image'                           => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['row_gap'], 'px' ),
	],

	' .vxt-infobox__content-wrap'                         => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['step_gap'], 'px' ),
	],

	' .vxt-infobox__content-wrap:last-child'              => [
		'margin-bottom' => '0px',
	],
	' .vxt-how-to-step-wrap'                              => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['step_gap'], 'px' ),
	],

	' .vxt-how-to-step-wrap:last-child'                   => [
		'margin-bottom' => '0px',
	],
	' span.vxt-howto__time-wrap .vxt-howto-timeNeeded-value' => [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue(
			$attr['timeSpace'],
			'px'
		),
	],

	' span.vxt-howto__cost-wrap .vxt-howto-estcost-value' => [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue(
			$attr['costSpace'],
			'px'
		),
	],

	' ' . $attr['headingTag'] . '.vxt-howto-heading-text' => [
		'color' => $attr['headingColor'],
	],

	' p.vxt-howto-desc-text'                              => [
		'color' => $attr['subHeadingColor'],
	],

	' span.vxt-howto__time-wrap p'                        => [
		'color' => $attr['subHeadingColor'],
	],

	' span.vxt-howto__cost-wrap p'                        => [
		'color' => $attr['subHeadingColor'],
	],

	' span.vxt-howto__time-wrap h4.vxt-howto-timeNeeded-text' => [
		'color' => $attr['showTotaltimecolor'],
	],

	' span.vxt-howto__cost-wrap h4.vxt-howto-estcost-text' => [
		'color' => $attr['showTotaltimecolor'],
	],

	' .vxt-how-to-tools__wrap .vxt-howto-req-tools-text' => [ // For Backword.
		'color' => $attr['showTotaltimecolor'],
	],
	' .vxt-howto-req-tools-text'                          => [
		'color' => $attr['showTotaltimecolor'],
	],

	' .vxt-howto-req-materials-text'                      => [
		'color' => $attr['showTotaltimecolor'],
	],

	' .vxt-how-to-steps__wrap .vxt-howto-req-steps-text' => [
		'color' => $attr['showTotaltimecolor'],
	],
	' .vxt-howto-req-steps-text'                          => [
		'color' => $attr['showTotaltimecolor'],
	],
];
$selectors[' .vxt-tools__label'] = [
	'color' => $attr['subHeadingColor'],
];

$selectors[' .vxt-materials__label'] = [
	'color' => $attr['subHeadingColor'],
];

$tSelectors = [
	'.vxt-how-to-main-wrap p.vxt-howto-desc-text'     => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],
	'.vxt-how-to-main-wrap .vxt-howto__source-image'  => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],

	'.vxt-how-to-main-wrap span.vxt-howto__time-wrap' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],

	'.vxt-how-to-main-wrap span.vxt-howto__cost-wrap' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],

	' h4.vxt-howto-req-steps-text'                     => [
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],

	' h4.vxt-howto-req-materials-text'                 => [
		'margin-top' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],
	'.vxt-how-to-main-wrap .vxt-how-to-tools-child__wrapper:last-child' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],

	'.vxt-how-to-main-wrap .vxt-how-to-tools__wrap'   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],

	'.vxt-how-to-main-wrap .vxt-how-to-materials-child__wrapper:last-child' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapTablet'], 'px' ),
	],
];

$mSelectors = [
	'.vxt-how-to-main-wrap p.vxt-howto-desc-text'     => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],
	'.vxt-how-to-main-wrap .vxt-howto__source-image'  => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],

	'.vxt-how-to-main-wrap span.vxt-howto__time-wrap' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],

	'.vxt-how-to-main-wrap span.vxt-howto__cost-wrap' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],

	' h4.vxt-howto-req-steps-text'                     => [
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],

	' h4.vxt-howto-req-materials-text'                 => [
		'margin-top' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],
	'.vxt-how-to-main-wrap .vxt-how-to-tools-child__wrapper:last-child' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],

	'.vxt-how-to-main-wrap .vxt-how-to-tools__wrap'   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],

	'.vxt-how-to-main-wrap .vxt-how-to-materials-child__wrapper:last-child' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGapMobile'], 'px' ),
	],
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'subHead', ' p', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'price', ' h4', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'head', ' .vxt-howto-heading-text', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'subHead', ' .vxt-tools__label', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'subHead', ' .vxt-materials__label', $combinedSelectors );

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, ' .vxt-block-' . $id );
