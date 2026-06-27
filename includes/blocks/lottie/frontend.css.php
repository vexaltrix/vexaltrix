<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$selectors   = [];
$tSelectors = [];
$mSelectors = [];

$selectors                                   = [
	'.vxt-lottie__outer-wrap' => [
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['width'], 'px' ),
		'height'           => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['height'], 'px' ),
		'overflow'         => 'hidden',
		'outline'          => 'none',
		'background-color' => $attr['backgroundColor'],
	],
	'.vxt-lottie__left'       => [
		'margin-right' => 'auto !important',
		'margin-left'  => '0px !important',
	],
	'.vxt-lottie__right'      => [
		'margin-left'  => 'auto !important',
		'margin-right' => '0px !important',
	],
	'.vxt-lottie__center'     => [
		'margin' => '0 auto !important',
	],
];
$selectors['.vxt-lottie__outer-wrap:hover'] = [
	'background' => $attr['backgroundHColor'],
];

$tSelectors = [
	'.vxt-lottie__outer-wrap' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthTablet'], 'px' ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['heightTablet'], 'px' ),
	],
];

$mSelectors = [
	'.vxt-lottie__outer-wrap' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthMob'], 'px' ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['heightMob'], 'px' ),
	],
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
