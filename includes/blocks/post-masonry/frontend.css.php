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

$selectors = \Vexaltrix\Core\Blocks\BlockHelper::getPostSelectors( $attr );

$mSelectors = \Vexaltrix\Core\Blocks\BlockHelper::getPostMobileSelectors( $attr );

$tSelectors = \Vexaltrix\Core\Blocks\BlockHelper::getPostTabletSelectors( $attr );

$paginationpaddingTop    = isset( $attr['paginationButtonPaddingTop'] ) ? $attr['paginationButtonPaddingTop'] : $attr['vpaginationButtonPaddingDesktop'];
$paginationpaddingBottom = isset( $attr['paginationButtonPaddingBottom'] ) ? $attr['paginationButtonPaddingBottom'] : $attr['vpaginationButtonPaddingDesktop'];
$paginationpaddingLeft   = isset( $attr['paginationButtonPaddingLeft'] ) ? $attr['paginationButtonPaddingLeft'] : $attr['hpaginationButtonPaddingDesktop'];
$paginationpaddingRight  = isset( $attr['paginationButtonPaddingRight'] ) ? $attr['paginationButtonPaddingRight'] : $attr['hpaginationButtonPaddingDesktop'];

$paginationButtonPaddingTopTablet    = isset( $attr['paginationButtonPaddingTopTablet'] ) ? $attr['paginationButtonPaddingTopTablet'] : $attr['vpaginationButtonPaddingTablet'];
$paginationButtonPaddingBottomTablet = isset( $attr['paginationButtonPaddingBottomTablet'] ) ? $attr['paginationButtonPaddingBottomTablet'] : $attr['vpaginationButtonPaddingTablet'];
$paginationButtonPaddingLeftTablet   = isset( $attr['paginationButtonPaddingLeftTablet'] ) ? $attr['paginationButtonPaddingLeftTablet'] : $attr['hpaginationButtonPaddingTablet'];
$paginationButtonPaddingRightTablet  = isset( $attr['paginationButtonPaddingRightTablet'] ) ? $attr['paginationButtonPaddingRightTablet'] : $attr['hpaginationButtonPaddingTablet'];

$paginationButtonPaddingTopMobile    = isset( $attr['paginationButtonPaddingTopMobile'] ) ? $attr['paginationButtonPaddingTopMobile'] : $attr['vpaginationButtonPaddingMobile'];
$paginationButtonPaddingBottomMobile = isset( $attr['paginationButtonPaddingBottomMobile'] ) ? $attr['paginationButtonPaddingBottomMobile'] : $attr['vpaginationButtonPaddingMobile'];
$paginationButtonPaddingLeftMobile   = isset( $attr['paginationButtonPaddingLeftMobile'] ) ? $attr['paginationButtonPaddingLeftMobile'] : $attr['hpaginationButtonPaddingMobile'];
$paginationButtonPaddingRightMobile  = isset( $attr['paginationButtonPaddingRightMobile'] ) ? $attr['paginationButtonPaddingRightMobile'] : $attr['hpaginationButtonPaddingMobile'];

$paginationMasonryBorderCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'paginationMasonry' );
$paginationMasonryBorderCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'paginationMasonry', 'tablet' );
$paginationMasonryBorderCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'paginationMasonry', 'mobile' );

if ( 'infinite' === $attr['paginationType'] ) {

	$selectors[' .vxt-post__load-more-wrap'] = [
		'text-align' => $attr['paginationAlign'],
	];

	$selectors[' .vxt-post__load-more-wrap .vxt-post-pagination-button']       = array_merge(
		[

			'color'            => $attr['paginationTextColor'],
			'background-color' => $attr['paginationMasonryBgColor'],
			'font-size'        => \Vexaltrix\Support\Helper::getCssValue( $attr['paginationFontSize'], 'px' ),
			'padding-top'      => \Vexaltrix\Support\Helper::getCssValue(
				$paginationpaddingTop,
				$attr['paginationButtonPaddingType']
			),
			'padding-bottom'   => \Vexaltrix\Support\Helper::getCssValue(
				$paginationpaddingBottom,
				$attr['paginationButtonPaddingType']
			),
			'padding-right'    => \Vexaltrix\Support\Helper::getCssValue(
				$paginationpaddingRight,
				$attr['paginationButtonPaddingType']
			),
			'padding-left'     => \Vexaltrix\Support\Helper::getCssValue(
				$paginationpaddingLeft,
				$attr['paginationButtonPaddingType']
			),
		],
		$paginationMasonryBorderCss
	);
	$selectors[' .vxt-post__load-more-wrap .vxt-post-pagination-button:hover'] = [
		'color'            => $attr['paginationTextHoverColor'],
		'background-color' => $attr['paginationBgHoverColor'],
		'border-color'     => $attr['paginationMasonryBorderHColor'],
	];
	$mSelectors[' .vxt-post__load-more-wrap .vxt-post-pagination-button']     = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue(
			$paginationButtonPaddingTopMobile,
			$attr['mobilepaginationButtonPaddingType']
		),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue(
			$paginationButtonPaddingRightMobile,
			$attr['mobilepaginationButtonPaddingType']
		),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue(
			$paginationButtonPaddingBottomMobile,
			$attr['mobilepaginationButtonPaddingType']
		),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue(
			$paginationButtonPaddingLeftMobile,
			$attr['mobilepaginationButtonPaddingType']
		),
	];
	$tSelectors[' .vxt-post__load-more-wrap .vxt-post-pagination-button']     = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue(
			$paginationButtonPaddingTopTablet,
			$attr['tabletpaginationButtonPaddingType']
		),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue(
			$paginationButtonPaddingBottomTablet,
			$attr['tabletpaginationButtonPaddingType']
		),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue(
			$paginationButtonPaddingRightTablet,
			$attr['tabletpaginationButtonPaddingType']
		),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue(
			$paginationButtonPaddingLeftTablet,
			$attr['tabletpaginationButtonPaddingType']
		),
	];
	$tSelectors[' .vxt-post__load-more-wrap .vxt-post-pagination-button']     = $paginationMasonryBorderCssTablet;
	$mSelectors[' .vxt-post__load-more-wrap .vxt-post-pagination-button']     = $paginationMasonryBorderCssMobile;

	$selectors['.vxt-post-grid .vxt-post-inf-loader div'] = [
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['loaderSize'], 'px' ),
		'height'           => \Vexaltrix\Support\Helper::getCssValue( $attr['loaderSize'], 'px' ),
		'background-color' => $attr['loaderColor'],
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
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-post__text.vxt-post__cta', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-post__text.vxt-post__cta a', $combinedSelectors );


return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
