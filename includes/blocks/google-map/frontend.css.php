<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$tSelectors = [];
$mSelectors = [];
$selectors   = [];

$selectors = [
	' .vxt-google-map__iframe' => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['height'], 'px' ),
	],
];

$mSelectors = [
	' .vxt-google-map__iframe' => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['heightMobile'], 'px' ),
	],
];

$tSelectors = [
	' .vxt-google-map__iframe' => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['heightTablet'], 'px' ),
	],
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, ' .vxt-block-' . $id );
