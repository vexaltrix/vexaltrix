<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$selectors   = \Vexaltrix\Presentation\Blocks\BlockHelper::getIconListChildSelectors( $attr, $id, true )['desktop'];
$tSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getIconListChildSelectors( $attr, $id, true )['tablet'];
$mSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getIconListChildSelectors( $attr, $id, true )['mobile'];

$desktop = \Vexaltrix\Core\Support\Helper::generateCss( $selectors, '.vxt-block-' . $id );
$tablet  = \Vexaltrix\Core\Support\Helper::generateCss( $tSelectors, '.vxt-block-' . $id );
$mobile  = \Vexaltrix\Core\Support\Helper::generateCss( $mSelectors, '.vxt-block-' . $id );

$generatedCss = [
	'desktop' => $desktop,
	'tablet'  => $tablet,
	'mobile'  => $mobile,
];

return $generatedCss;
