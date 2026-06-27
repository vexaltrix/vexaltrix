<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @var int $id
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksPostGfont( $attr );

$paddingLeftMobile  = isset( $attr['paddingLeftMobile'] ) ? $attr['paddingLeftMobile'] : $attr['contentPaddingMobile'];
$paddingRightMobile = isset( $attr['paddingRightMobile'] ) ? $attr['paddingRightMobile'] : $attr['contentPaddingMobile'];
$paddingLeftTablet  = isset( $attr['paddingLeftTablet'] ) ? $attr['paddingLeftTablet'] : $attr['contentPadding'];
$paddingRightTablet = isset( $attr['paddingRightTablet'] ) ? $attr['paddingRightTablet'] : $attr['contentPadding'];
$paddingLeft        = isset( $attr['paddingLeft'] ) ? $attr['paddingLeft'] : $attr['contentPadding'];
$paddingRight       = isset( $attr['paddingRight'] ) ? $attr['paddingRight'] : $attr['contentPadding'];

$selectors = \Vexaltrix\Core\Blocks\BlockHelper::getPostSelectors( $attr );
// Pagination CSS.
$selectors[' .vxt-post-pagination-wrap'] = [

	'margin-top'                             => \Vexaltrix\Support\Helper::getCssValue( $attr['paginationSpacing'], $attr['paginationSpacingUnit'] ),
	'justify-content'                        => $attr['paginationAlignment'],
	'margin-' . $attr['paginationAlignment'] => '10px',
];

if ( 'filled' === $attr['paginationLayout'] ) {
	$selectors[' .vxt-post-pagination-wrap .page-numbers.current'] = [

		'background-color' => $attr['paginationBgActiveColor'],
		'color'            => $attr['paginationActiveColor'],
	];
	$selectors[' .vxt-post-pagination-wrap a']                     = [

		'background-color' => $attr['paginationBgColor'],
		'color'            => $attr['paginationColor'],
	];
} else {

	$selectors[' .vxt-post-pagination-wrap .page-numbers.current'] = [

		'border-style'     => 'solid',
		'background-color' => 'transparent',
		'border-width'     => \Vexaltrix\Support\Helper::getCssValue( $attr['paginationBorderSize'], 'px' ),
		'border-color'     => $attr['paginationBorderActiveColor'],
		'border-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paginationBorderRadius'], 'px' ),
		'color'            => $attr['paginationActiveColor'],
	];

	$selectors[' .vxt-post-pagination-wrap a'] = [

		'border-style'     => 'solid',
		'background-color' => 'transparent',
		'border-width'     => \Vexaltrix\Support\Helper::getCssValue( $attr['paginationBorderSize'], 'px' ),
		'border-color'     => $attr['paginationBorderColor'],
		'border-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paginationBorderRadius'], 'px' ),
		'color'            => $attr['paginationColor'],
	];

}

$mSelectors = \Vexaltrix\Core\Blocks\BlockHelper::getPostMobileSelectors( $attr );
$tSelectors = \Vexaltrix\Core\Blocks\BlockHelper::getPostTabletSelectors( $attr );

if ( 'top' === $attr['imgPosition'] ) {
	$selectors['.vxt-equal_height_inline-read-more-buttons .vxt-post__inner-wrap .vxt-post__text:last-child']   = [
		'left'  => \Vexaltrix\Support\Helper::getCssValue( $paddingLeft, $attr['contentPaddingUnit'] ),
		'right' => \Vexaltrix\Support\Helper::getCssValue( $paddingRight, $attr['contentPaddingUnit'] ),
	];
	$mSelectors['.vxt-equal_height_inline-read-more-buttons .vxt-post__inner-wrap .vxt-post__text:last-child'] = [
		'left'  => \Vexaltrix\Support\Helper::getCssValue( $paddingLeftMobile, $attr['mobilePaddingUnit'] ),
		'right' => \Vexaltrix\Support\Helper::getCssValue( $paddingRightMobile, $attr['mobilePaddingUnit'] ),
	];
	$mSelectors['.vxt-equal_height_inline-read-more-buttons .vxt-post__inner-wrap .vxt-post__text:last-child'] = [
		'left'  => \Vexaltrix\Support\Helper::getCssValue( $paddingLeftTablet, $attr['tabletPaddingUnit'] ),
		'right' => \Vexaltrix\Support\Helper::getCssValue( $paddingRightTablet, $attr['tabletPaddingUnit'] ),
	];
} else {
	$selectors['.vxt-equal_height_inline-read-more-buttons .vxt-post__inner-wrap .vxt-post__text:nth-last-child(2)']   = [
		'left'  => \Vexaltrix\Support\Helper::getCssValue( $paddingLeft, $attr['contentPaddingUnit'] ),
		'right' => \Vexaltrix\Support\Helper::getCssValue( $paddingRight, $attr['contentPaddingUnit'] ),
	];
	$mSelectors['.vxt-equal_height_inline-read-more-buttons .vxt-post__inner-wrap .vxt-post__text:nth-last-child(2)'] = [
		'left'  => \Vexaltrix\Support\Helper::getCssValue( $paddingLeftMobile, $attr['mobilePaddingUnit'] ),
		'right' => \Vexaltrix\Support\Helper::getCssValue( $paddingRightMobile, $attr['mobilePaddingUnit'] ),
	];
	$mSelectors['.vxt-equal_height_inline-read-more-buttons .vxt-post__inner-wrap .vxt-post__text:nth-last-child(2)'] = [
		'left'  => \Vexaltrix\Support\Helper::getCssValue( $paddingLeftTablet, $attr['tabletPaddingUnit'] ),
		'right' => \Vexaltrix\Support\Helper::getCssValue( $paddingRightTablet, $attr['tabletPaddingUnit'] ),
	];
}

if ( $attr['isLeftToRightLayout'] ) {
	$selectors['.wp-block-vxt-post-grid'] = [
		'display'        => 'flex',
		'flex-direction' => 'column',
	];

	$selectors['.wp-block-vxt-post-grid article'] = [
		'display'        => 'flex',
		'flex-direction' => $attr['wrapperAlign'],
		'width'          => '100%',
	];

	$selectors['.wp-block-vxt-post-grid .vxt-post__image'] = [
		'flex'  => 'none',
		'width' => ( 'top' === $attr['imgPosition'] ) ? '35%' : '100%',
	];

}


$selectors['.wp-block-vxt-post-grid .uag-post-grid-wrapper'] = [
	'padding-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperTopPadding'], $attr['wrapperPaddingUnit'] ),
	'padding-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperRightPadding'], $attr['wrapperPaddingUnit'] ),
	'padding-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperBottomPadding'], $attr['wrapperPaddingUnit'] ),
	'padding-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperLeftPadding'], $attr['wrapperPaddingUnit'] ),
	'width'           => '100%',
	'display'         => 'flex',
	'flex-direction'  => 'column',
	'justify-content' => $attr['wrapperAlignPosition'],
];


	$tSelectors['.wp-block-vxt-post-grid .uag-post-grid-wrapper'] = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperTopPaddingTablet'], $attr['wrapperPaddingUnitTablet'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperRightPaddingTablet'], $attr['wrapperPaddingUnitTablet'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperBottomPaddingTablet'], $attr['wrapperPaddingUnitTablet'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperLeftPaddingTablet'], $attr['wrapperPaddingUnitTablet'] ),
	];

	$mSelectors['.wp-block-vxt-post-grid .uag-post-grid-wrapper'] = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperTopPaddingMobile'], $attr['wrapperPaddingUnitMobile'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperRightPaddingMobile'], $attr['wrapperPaddingUnitMobile'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperBottomPaddingMobile'], $attr['wrapperPaddingUnitMobile'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['wrapperLeftPaddingMobile'], $attr['wrapperPaddingUnitMobile'] ),
		'width'          => 'unset',
	];

	if ( $attr['isLeftToRightLayout'] ) {
		$mSelectors['.wp-block-vxt-post-grid .vxt-post__image'] = [
			'width' => ( 'top' === $attr['imgPosition'] ) ? 'unset' : '100%',
		];
		$tSelectors['.wp-block-vxt-post-grid .vxt-post__image'] = [
			'width' => ( 'top' === $attr['imgPosition'] ) ? '45%' : '100%',
		];
	}

	if ( 'aboveTitle' === $attr['displayPostTaxonomyAboveTitle'] ) {

		$selectors   = array_merge(
			$selectors,
			[
				' span.vxt-post__taxonomy' => [
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['taxonomyBottomSpace'], $attr['taxonomyBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap span.vxt-post__taxonomy.highlighted' => [
					'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['taxonomyBottomSpace'], $attr['taxonomyBottomSpaceUnit'] ),
				],
			]
		);
		$mSelectors = array_merge(
			$mSelectors,
			[
				' span.vxt-post__taxonomy' => [
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['taxonomyBottomSpaceMobile'], $attr['taxonomyBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap span.vxt-post__taxonomy.highlighted' => [
					'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['taxonomyBottomSpaceMobile'], $attr['taxonomyBottomSpaceUnit'] ),
				],
			]
		);
		$tSelectors = array_merge(
			$tSelectors,
			[
				' span.vxt-post__taxonomy' => [
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['taxonomyBottomSpaceTablet'], $attr['taxonomyBottomSpaceUnit'] ),
				],
				' .vxt-post__inner-wrap span.vxt-post__taxonomy.highlighted' => [
					'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['taxonomyBottomSpaceTablet'], $attr['taxonomyBottomSpaceUnit'] ),
				],
			]
		);
	}

	$mSelectors['.wp-block-vxt-post-grid']         = ( $attr['isLeftToRightLayout'] ? [
		'display' => 'grid',
	] : [] );
	$mSelectors['.wp-block-vxt-post-grid article'] = ( $attr['isLeftToRightLayout'] ? [
		'display' => 'inline-block',
	] : [] );

	$combinedSelectors = [
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	];


	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-post__text.vxt-post__title', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-post__text.vxt-post__title a', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__text.vxt-post-grid-byline > span', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__text.vxt-post-grid-byline time', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__text.vxt-post-grid-byline .vxt-post__author', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__text.vxt-post-grid-byline .vxt-post__author a', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'meta', ' span.vxt-post__taxonomy', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__inner-wrap .vxt-post__taxonomy.highlighted', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'excerpt', ' .vxt-post__text.vxt-post__excerpt', $combinedSelectors );
	if ( ! $attr['inheritFromThemeBtn'] ) {
		$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-post__text.vxt-post__cta', $combinedSelectors );
		$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-post__text.vxt-post__cta a', $combinedSelectors );
	}

	return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
