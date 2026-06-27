<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksHowToStepGfont( $attr );

$tSelectors = [];
$mSelectors = [];
$selectors   = [
	' .vxt-step-link-text'          => [
		'color' => $attr['urlColor'],
	],
	' .vxt-how-to-step-name'        => [
		'color' => $attr['titleColor'],
	],
	' .vxt-how-to-step-description' => [
		'color' => $attr['descriptionColor'],
	],
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'url', ' .vxt-step-link-text', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-how-to-step-name', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'description', ' .vxt-how-to-step-description', $combinedSelectors );

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, ' .vxt-block-' . $id );
