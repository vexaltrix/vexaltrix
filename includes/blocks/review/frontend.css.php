<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksReviewGfont( $attr );

$tSelectors = [];
$mSelectors = [];
$selectors   = [];

$topPadding    = isset( $attr['topPadding'] ) ? $attr['topPadding'] : $attr['contentVrPadding'];
$bottomPadding = isset( $attr['bottomPadding'] ) ? $attr['bottomPadding'] : $attr['contentVrPadding'];
$leftPadding   = isset( $attr['leftPadding'] ) ? $attr['leftPadding'] : $attr['contentHrPadding'];
$rightPadding  = isset( $attr['rightPadding'] ) ? $attr['rightPadding'] : $attr['contentHrPadding'];

$selectors = [
	' .vxt_ultimate_gutenberg_blocks_review_block .vxt-rating-title'  => [
		'color' => $attr['titleColor'],
	],
	' .vxt_ultimate_gutenberg_blocks_review_block .vxt-rating-desc'   => [
		'color' => $attr['descColor'],
	],
	' .vxt_ultimate_gutenberg_blocks_review_block .vxt-rating-author' => [
		'color' => $attr['authorColor'],
	],
	' .vxt_ultimate_gutenberg_blocks_review_entry'                     => [
		'color' => $attr['contentColor'],
	],
	' .vxt_ultimate_gutenberg_blocks_review_block'                     => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPadding, $attr['paddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPadding, $attr['paddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPadding, $attr['paddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPadding, $attr['paddingUnit'] ),
		'text-align'     => $attr['overallAlignment'],
	],
	' .vxt_ultimate_gutenberg_blocks_review_summary'                   => [
		'color' => $attr['summaryColor'],
	],
	' .vxt_ultimate_gutenberg_blocks_review_entry .star, .vxt_ultimate_gutenberg_blocks_review_average_stars .star' => [
		'fill' => $attr['starColor'],
	],
	' .vxt_ultimate_gutenberg_blocks_review_entry path, .vxt_ultimate_gutenberg_blocks_review_average_stars path' => [
		'stroke' => $attr['starOutlineColor'],
		'fill'   => $attr['starActiveColor'],
	],
];

$mSelectors = [
	' .vxt_ultimate_gutenberg_blocks_review_block' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingLeftMobile'], $attr['mobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingRightMobile'], $attr['mobilePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingTopMobile'], $attr['mobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBottomMobile'], $attr['mobilePaddingUnit'] ),
	],
];

$tSelectors = [
	' .vxt_ultimate_gutenberg_blocks_review_block' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingLeftTablet'], $attr['tabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingRightTablet'], $attr['tabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingTopTablet'], $attr['tabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBottomTablet'], $attr['tabletPaddingUnit'] ),
	],
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'head', ' .vxt-rating-title, .vxt_ultimate_gutenberg_blocks_review_entry', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'subHead', ' .vxt-rating-desc, .vxt-rating-author', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'content', ' .vxt_ultimate_gutenberg_blocks_review_summary, .vxt_ultimate_gutenberg_blocks_review_block .vxt_ultimate_gutenberg_blocks_review_summary_title', $combinedSelectors );

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, ' .vxt-block-' . substr( $attr['block_id'], 0, 8 ) );
