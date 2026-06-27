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
\Vexaltrix\Core\Blocks\BlockJs::blocksRestaurantMenuGfont( $attr );

$mSelectors = [];
$tSelectors = [];

$rowGapTabletFallback = is_numeric( $attr['rowGapTablet'] ) ? $attr['rowGapTablet'] : $attr['rowGap'];
$rowGapMobileFallback = is_numeric( $attr['rowGapMobile'] ) ? $attr['rowGapMobile'] : $rowGapTabletFallback;

$attr['columnGapTablet'] = is_numeric( $attr['columnGapTablet'] ) ? $attr['columnGapTablet'] : $attr['columnGap'];
$attr['columnGapMobile'] = is_numeric( $attr['columnGapMobile'] ) ? $attr['columnGapMobile'] : $attr['columnGapTablet'];

$attr['imageWidthTablet'] = is_numeric( $attr['imageWidthTablet'] ) ? $attr['imageWidthTablet'] : $attr['imageWidth'];
$attr['imageWidthMobile'] = is_numeric( $attr['imageWidthMobile'] ) ? $attr['imageWidthMobile'] : $attr['imageWidthTablet'];

$align = $attr['headingAlign'];
if ( 'left' === $align ) {
	$align = 'flex-start';
} elseif ( 'right' === $align ) {
	$align = 'flex-end';
}
$imgPaddingTop    = isset( $attr['imgPaddingTop'] ) ? $attr['imgPaddingTop'] : $attr['imgVrPadding'];
$imgPaddingRight  = isset( $attr['imgPaddingRight'] ) ? $attr['imgPaddingRight'] : $attr['imgHrPadding'];
$imgPaddingBottom = isset( $attr['imgPaddingBottom'] ) ? $attr['imgPaddingBottom'] : $attr['imgVrPadding'];
$imgPaddingLeft   = isset( $attr['imgPaddingLeft'] ) ? $attr['imgPaddingLeft'] : $attr['imgHrPadding'];

$contentPaddingTop    = isset( $attr['contentPaddingTop'] ) ? $attr['contentPaddingTop'] : $attr['contentVrPadding'];
$contentPaddingRight  = isset( $attr['contentPaddingRight'] ) ? $attr['contentPaddingRight'] : $attr['contentHrPadding'];
$contentPaddingBottom = isset( $attr['contentPaddingBottom'] ) ? $attr['contentPaddingBottom'] : $attr['contentVrPadding'];
$contentPaddingLeft   = isset( $attr['contentPaddingLeft'] ) ? $attr['contentPaddingLeft'] : $attr['contentHrPadding'];

$selectors = [
	'.wp-block-vxt-restaurant-menu' => [
		'column-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['columnGap'], $attr['columnGapType'] ),
		'row-gap'    => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGap'], $attr['rowGapType'] ),
	],
	' .vxt-rest_menu__wrap img'     => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $imgPaddingLeft, $attr['imgPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $imgPaddingRight, $attr['imgPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $imgPaddingTop, $attr['imgPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $imgPaddingBottom, $attr['imgPaddingUnit'] ),
		'width'          => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthType'] ),
		'max-width'      => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthType'] ),
	],
	// Backward.
	' .vxt-rm__separator-parent'    => [
		'justify-content' => $align,
	],
	' .vxt-rm__content'             => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $contentPaddingLeft, $attr['contentPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $contentPaddingRight, $attr['contentPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $contentPaddingTop, $attr['contentPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $contentPaddingBottom, $attr['contentPaddingUnit'] ),
	],
	' .vxt-rest_menu__wrap .vxt-rm__content .vxt-rm-details .vxt-rm__title' => [
		'color'         => $attr['titleColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpace'], $attr['titleSpaceType'] ),
	],
	' .vxt-rm__price'               => [
		'color' => $attr['priceColor'],
	],
	' .vxt-rm__desc'                => [
		'color'         => $attr['descColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpace'], 'px' ),
	],
];

$tSelectors = [
	' .vxt-rest_menu__wrap .vxt-rm__content .vxt-rm-details .vxt-rm__title' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpaceTablet'], $attr['titleSpaceType'] ),
	],
	'.wp-block-vxt-restaurant-menu' => [
		'column-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['columnGapTablet'], $attr['columnGapType'] ),
		'row-gap'    => \Vexaltrix\Support\Helper::getCssValue( $rowGapTabletFallback, $attr['rowGapType'] ),
	],
	' .vxt-rest_menu__wrap img'     => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['imgPaddingLeftTablet'], $attr['imgTabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgPaddingRightTablet'], $attr['imgTabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['imgPaddingTopTablet'], $attr['imgTabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgPaddingBottomTablet'], $attr['imgTabletPaddingUnit'] ),
		'width'          => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthType'] ),
		'max-width'      => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthType'] ),
	],
	' .vxt-rm__content'             => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingLeftTablet'], $attr['contentTabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingRightTablet'], $attr['contentTabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingTopTablet'], $attr['contentTabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingBottomTablet'], $attr['contentTabletPaddingUnit'] ),
	],
];

$mSelectors = [
	' .vxt-rest_menu__wrap .vxt-rm__content .vxt-rm-details .vxt-rm__title' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpaceMobile'], $attr['titleSpaceType'] ),
	],
	'.wp-block-vxt-restaurant-menu' => [
		'column-gap' => \Vexaltrix\Support\Helper::getCssValue( $attr['columnGapMobile'], $attr['columnGapType'] ),
		'row-gap'    => \Vexaltrix\Support\Helper::getCssValue( $rowGapMobileFallback, $attr['rowGapType'] ),
	],
	' .vxt-rest_menu__wrap img'     => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['imgPaddingLeftMobile'], $attr['imgMobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgPaddingRightMobile'], $attr['imgMobilePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['imgPaddingTopMobile'], $attr['imgMobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgPaddingBottomMobile'], $attr['imgMobilePaddingUnit'] ),
		'width'          => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthType'] ),
		'max-width'      => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthType'] ),
	],
	' .vxt-rm__content'             => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingLeftMobile'], $attr['contentMobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingRightMobile'], $attr['contentMobilePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingTopMobile'], $attr['contentMobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['contentPaddingBottomMobile'], $attr['contentMobilePaddingUnit'] ),
	],
];

if ( 'none' !== $attr['seperatorStyle'] ) {
	$selectors[' .vxt-rest_menu__wrap .vxt-rm__separator']   = [
		'border-top-color' => $attr['seperatorColor'],
		'border-top-style' => $attr['seperatorStyle'],
		'border-top-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorThickness'], 'px' ),
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorWidth'], $attr['seperatorWidthType'] ),
	];
	$tSelectors[' .vxt-rest_menu__wrap .vxt-rm__separator'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorWidthTablet'], $attr['seperatorWidthType'] ),
	];
	$mSelectors[' .vxt-rest_menu__wrap .vxt-rm__separator'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorWidthMobile'], $attr['seperatorWidthType'] ),
	];
}
if ( 1 === $attr['columns'] ) {
	$selectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto',
	];
}
if ( 2 === $attr['columns'] ) {
	$selectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto',
	];
}
if ( 3 === $attr['columns'] ) {
	$selectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto auto',
	];
}
if ( 4 === $attr['columns'] ) {
	$selectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto auto auto',
	];
}

if ( 1 === $attr['tcolumns'] ) {
	$tSelectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto',
	];
}
if ( 2 === $attr['tcolumns'] ) {
	$tSelectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto',
	];
}
if ( 3 === $attr['tcolumns'] ) {
	$tSelectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto auto',
	];
}
if ( 4 === $attr['tcolumns'] ) {
	$tSelectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto auto auto',
	];
}
if ( 1 === $attr['mcolumns'] ) {
	$mSelectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto',
	];
}
if ( 2 === $attr['mcolumns'] ) {
	$mSelectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto',
	];
}
if ( 3 === $attr['mcolumns'] ) {
	$mSelectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto auto',
	];
}
if ( 4 === $attr['mcolumns'] ) {
	$mSelectors['.wp-block-vxt-restaurant-menu.vxt-rest_menu__outer-wrap '] = [
		'grid-template-columns' => 'auto auto auto auto',
	];
}
if ( 'side' === $attr['imgAlign'] ) {
	$selectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__content'] = [
		'align-items' => 'top' === $attr['imageAlignment'] ? 'flex-start' : 'center',
		'display'     => 'inline-flex',
	];

	if ( 'tablet' === $attr['stack'] ) {
		if ( 'left' === $attr['imagePosition'] ) {
			$tSelectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__content'] = [
				'display'    => 'block',
				'text-align' => 'left',
			];
			$mSelectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__content'] = [
				'display'    => 'block',
				'text-align' => 'left',
			];
		} else {
			$tSelectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__content'] = [
				'display'        => 'flex',
				'flex-direction' => 'column-reverse',
				'align-items'    => 'flex-end',
			];
			$mSelectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__content'] = [
				'display'        => 'flex',
				'flex-direction' => 'column-reverse',
				'align-items'    => 'flex-end',
			];
		}
	} elseif ( 'mobile' === $attr['stack'] ) {
		if ( 'left' === $attr['imagePosition'] ) {
			$mSelectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__content'] = [
				'display'    => 'block',
				'text-align' => 'left',
			];
		} else {
			$mSelectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__content'] = [
				'display'        => 'flex',
				'flex-direction' => 'column-reverse',
				'align-items'    => 'flex-end',
			];
		}
	}
	if ( 'left' === $attr['imagePosition'] ) {
		$selectors[' .vxt-rm-details'] = [
			'text-align' => 'left',
		];
	} elseif ( 'right' === $attr['imagePosition'] ) {
		$selectors[' .vxt-rm-details'] = [
			'text-align' => 'right',
		];
		$selectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__separator'] = [
			'margin-left' => 'auto',
		];
	}
}

if ( 'top' === $attr['imgAlign'] ) {
	$selectors[' .wp-block-vxt-restaurant-menu-child ']                  = [
		'text-align' => $attr['headingAlign'],
		'display'    => 'block',
	];
	$selectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__content'] = [
		'text-align' => $attr['headingAlign'],
		'display'    => 'inline-flex',
	];
	if ( 'center' === $attr['headingAlign'] ) {
		$selectors[' .vxt-rm__content ']                                        = [
			'display' => 'block',
		];
		$selectors[' .vxt-rm__content ']                                        = [
			'display' => 'block',
		];
		$selectors[' .wp-block-vxt-restaurant-menu-child  .vxt-rm__separator'] = [
			'margin' => '0 auto',
		];
	} elseif ( 'right' === $attr['headingAlign'] ) {
		$selectors[' .wp-block-vxt-restaurant-menu-child .vxt-rm__separator'] = [
			'margin-left' => 'auto',
		];
	}
}
$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-rm__title', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'price', ' .vxt-rm__price', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'desc', ' .vxt-rm__desc', $combinedSelectors );

$baseSelector = ( $attr['classMigrate'] ) ? '.wp-block-vxt-restaurant-menu.vxt-block-' : '#vxt-rm-';

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
