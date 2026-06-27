<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksButtonsGfont( $attr );

$allSelectors = \Vexaltrix\Core\Blocks\BlockHelper::getButtonsChildSelectors( $attr, $id, true );

$combinedSelectors = [
	'desktop' => $allSelectors['selectors'],
	'tablet'  => $allSelectors['t_selectors'],
	'mobile'  => $allSelectors['m_selectors'],
];
if ( ! $attr['inheritFromTheme'] ) {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, '', ' .vxt-button__link', $combinedSelectors );
}

return \Vexaltrix\Support\Helper::generateAllCss(
	$combinedSelectors,
	'.wp-block-vxt-buttons .vxt-block-' . $id,
	isset( $gbsClass ) ? $gbsClass : ''
);
