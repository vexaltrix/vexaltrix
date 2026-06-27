<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksButtonsGfont( $attr );

$allSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getButtonsChildSelectors( $attr, $id, true );

$combinedSelectors = [
	'desktop' => $allSelectors['selectors'],
	'tablet'  => $allSelectors['t_selectors'],
	'mobile'  => $allSelectors['m_selectors'],
];
if ( ! $attr['inheritFromTheme'] ) {
	$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, '', ' .vxt-button__link', $combinedSelectors );
}

return \Vexaltrix\Core\Support\Helper::generateAllCss(
	$combinedSelectors,
	'.wp-block-vxt-buttons .vxt-block-' . $id,
	isset( $gbsClass ) ? $gbsClass : ''
);
