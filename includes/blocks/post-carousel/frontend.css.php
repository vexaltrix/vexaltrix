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
\Vexaltrix\Presentation\Blocks\BlockJs::blocksPostGfont( $attr );

$selectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getPostSelectors( $attr );

$mSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getPostMobileSelectors( $attr );

$tSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getPostTabletSelectors( $attr );

if ( 'background' === $attr['imgPosition'] && $attr['columns'] === $attr['postsToShow'] ) {
	$selectors['.vxt-post__image-position-background'] = [
		'flex-wrap' => 'nowrap !important',
		'gap'       => $attr['rowGap'] . 'px !important',
	];
	$selectors[' .vxt-post__inner-wrap']               = [
		'padding-left'  => '0px !important',
		'padding-right' => '0px !important',
	];
	$selectors[' .vxt-post__image']                    = [
		'width'       => '100% !important',
		'margin-left' => 'unset !important',
	];
}

$arrowSize = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowSize'], 'px' );

$selectors['.is_carousel .vxt-post__inner-wrap'] = [
	'background-color' => $attr['bgType'] ? $attr['bgColor'] : 'transparent',
];

$selectors[' .slick-arrow'] = [
	'border-color' => $attr['arrowColor'],
];

$selectors[' .slick-arrow span'] = [
	'color'     => $attr['arrowColor'],
	'font-size' => $arrowSize,
	'width'     => $arrowSize,
	'height'    => $arrowSize,
];

$selectors[' .slick-arrow svg'] = [
	'fill'   => $attr['arrowColor'],
	'width'  => $arrowSize,
	'height' => $arrowSize,
];

$selectors[' .slick-arrow'] = [
	'border-color'  => $attr['arrowColor'],
	'border-width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowBorderSize'], 'px' ),
	'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowBorderRadius'], 'px' ),
];

$selectors['.vxt-post__arrow-outside.vxt-post-grid .slick-prev'] = [
	'left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowDistance'], 'px' ),
];

$selectors['.vxt-post__arrow-outside.vxt-post-grid .slick-next'] = [
	'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowDistance'], 'px' ),
];

$tSelectors['.vxt-post__arrow-outside.vxt-post-grid .slick-prev'] = [
	'left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowDistanceTablet'], 'px' ),
];

$tSelectors['.vxt-post__arrow-outside.vxt-post-grid .slick-next'] = [
	'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowDistanceTablet'], 'px' ),
];

$mSelectors['.vxt-post__arrow-outside.vxt-post-grid .slick-prev'] = [
	'left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowDistanceMobile'], 'px' ),
];

$mSelectors['.vxt-post__arrow-outside.vxt-post-grid .slick-next'] = [
	'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['arrowDistanceMobile'], 'px' ),
];

$selectors['.vxt-post-grid ul.slick-dots li.slick-active button:before'] = [
	'color' => $attr['arrowColor'],
];

$selectors['.vxt-slick-carousel ul.slick-dots li button:before'] = [
	'color' => $attr['arrowColor'],
];

if ( isset( $attr['arrowDots'] ) && 'dots' === $attr['arrowDots'] ) {

	$selectors['.vxt-slick-carousel'] = [
		'padding' => '0 0 35px 0',
	];
}

// post carousal margin top for dots.
$selectors[' .slick-dots']   = [
	'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['dotsMarginTop'], $attr['dotsMarginTopUnit'] ) . ' !important',
];
$tSelectors[' .slick-dots'] = [
	'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['dotsMarginTopTablet'], $attr['dotsMarginTopUnit'] ) . ' !important',
];
$mSelectors[' .slick-dots'] = [
	'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['dotsMarginTopMobile'], $attr['dotsMarginTopUnit'] ) . ' !important',
];

if ( 'aboveTitle' === $attr['displayPostTaxonomyAboveTitle'] ) {

	$selectors   = array_merge(
		$selectors,
		[
			' span.vxt-post__taxonomy' => [
				'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['taxonomyBottomSpace'], $attr['taxonomyBottomSpaceUnit'] ),
			],
			' .vxt-post__inner-wrap span.vxt-post__taxonomy.highlighted' => [
				'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['taxonomyBottomSpace'], $attr['taxonomyBottomSpaceUnit'] ),
			],
		]
	);
	$mSelectors = array_merge(
		$mSelectors,
		[
			' span.vxt-post__taxonomy' => [
				'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['taxonomyBottomSpaceMobile'], $attr['taxonomyBottomSpaceUnit'] ),
			],
			' .vxt-post__inner-wrap span.vxt-post__taxonomy.highlighted' => [
				'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['taxonomyBottomSpaceMobile'], $attr['taxonomyBottomSpaceUnit'] ),
			],
		]
	);
	$tSelectors = array_merge(
		$tSelectors,
		[
			' span.vxt-post__taxonomy' => [
				'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['taxonomyBottomSpaceTablet'], $attr['taxonomyBottomSpaceUnit'] ),
			],
			' .vxt-post__inner-wrap span.vxt-post__taxonomy.highlighted' => [
				'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['taxonomyBottomSpaceTablet'], $attr['taxonomyBottomSpaceUnit'] ),
			],
		]
	);
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-post__text.vxt-post__title', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-post__text.vxt-post__title a', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__text.vxt-post-grid-byline > span', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__text.vxt-post-grid-byline time', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__text.vxt-post-grid-byline .vxt-post__author', $combinedSelectors );

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__text.vxt-post-grid-byline .vxt-post__author a', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'meta', ' span.vxt-post__taxonomy', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__inner-wrap .vxt-post__taxonomy.highlighted', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'meta', ' .vxt-post__taxonomy', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'excerpt', ' .vxt-post__text.vxt-post__excerpt', $combinedSelectors );

if ( ! $attr['inheritFromThemeBtn'] ) {
	$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-post__text.vxt-post__cta', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-post__text.vxt-post__cta a', $combinedSelectors );
}

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
