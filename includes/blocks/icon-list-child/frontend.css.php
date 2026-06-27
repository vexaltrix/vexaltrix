<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$selectors   = \Vexaltrix\Core\Blocks\BlockHelper::getIconListChildSelectors( $attr, $id, true )['desktop'];
$tSelectors = \Vexaltrix\Core\Blocks\BlockHelper::getIconListChildSelectors( $attr, $id, true )['tablet'];
$mSelectors = \Vexaltrix\Core\Blocks\BlockHelper::getIconListChildSelectors( $attr, $id, true )['mobile'];

$desktop = \Vexaltrix\Support\Helper::generateCss( $selectors, '.vxt-block-' . $id );
$tablet  = \Vexaltrix\Support\Helper::generateCss( $tSelectors, '.vxt-block-' . $id );
$mobile  = \Vexaltrix\Support\Helper::generateCss( $mSelectors, '.vxt-block-' . $id );

$generatedCss = [
	'desktop' => $desktop,
	'tablet'  => $tablet,
	'mobile'  => $mobile,
];

return $generatedCss;
