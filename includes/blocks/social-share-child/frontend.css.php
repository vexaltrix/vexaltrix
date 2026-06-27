<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @var string $id
 * @package ugb
 */

$selectors = \Vexaltrix\Core\Blocks\BlockHelper::getSocialShareChildSelectors( $attr, $id, true );

$desktop = \Vexaltrix\Support\Helper::generateCss( $selectors, '.vxt-block-' . $id );

$generatedCss = [
	'desktop' => $desktop,
	'tablet'  => '',
	'mobile'  => '',
];

return $generatedCss;
