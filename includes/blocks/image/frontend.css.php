<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @package ugb
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined else where.
 *
 * @var int $id
 */

// Add fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksAdvancedImageGfont( $attr );

$mSelectors = [];
$tSelectors = [];

$imageBorderCss          = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'image' );
$imageBorderCssTablet   = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'image', 'tablet' );
$imageBorderCssMobile   = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'image', 'mobile' );
$overlayBorderCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overlay' );
$overlayBorderCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overlay', 'tablet' );
$overlayBorderCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overlay', 'mobile' );

$widthTablet = '' !== $attr['widthTablet'] ? $attr['widthTablet'] . 'px' : $attr['width'] . 'px';
$widthMobile = '' !== $attr['widthMobile'] ? $attr['widthMobile'] . 'px' : $widthTablet;

$heightTablet = '' !== $attr['heightTablet'] ? $attr['heightTablet'] . 'px' : $attr['height'] . 'px';
$heightMobile = '' !== $attr['heightMobile'] ? $attr['heightMobile'] . 'px' : $heightTablet;

$align       = '';
$alignTablet = '';
$alignMobile = '';

switch ( $attr['align'] ) {
	case 'left':
		$align = 'flex-start';
		break;
	case 'right':
		$align = 'flex-end';
		break;
	case 'center':
		$align = 'center';
		break;
}

switch ( $attr['alignTablet'] ) {
	case 'left':
		$alignTablet = 'flex-start';
		break;
	case 'right':
		$alignTablet = 'flex-end';
		break;
	case 'center':
		$alignTablet = 'center';
		break;
}

switch ( $attr['alignMobile'] ) {
	case 'left':
		$alignMobile = 'flex-start';
		break;
	case 'right':
		$alignMobile = 'flex-end';
		break;
	case 'center':
		$alignMobile = 'center';
		break;
}

$boxShadowProperties       = [
	'horizontal' => $attr['imageBoxShadowHOffset'],
	'vertical'   => $attr['imageBoxShadowVOffset'],
	'blur'       => $attr['imageBoxShadowBlur'],
	'spread'     => $attr['imageBoxShadowSpread'],
	'color'      => $attr['imageBoxShadowColor'],
	'position'   => $attr['imageBoxShadowPosition'],
];
$boxShadowHoverProperties = [
	'horizontal' => $attr['imageBoxShadowHOffsetHover'],
	'vertical'   => $attr['imageBoxShadowVOffsetHover'],
	'blur'       => $attr['imageBoxShadowBlurHover'],
	'spread'     => $attr['imageBoxShadowSpreadHover'],
	'color'      => $attr['imageBoxShadowColorHover'],
	'position'   => $attr['imageBoxShadowPositionHover'],
	'alt_color'  => $attr['imageBoxShadowColor'],
];

$boxShadowCss       = \Vexaltrix\Presentation\Blocks\BlockHelper::generateShadowCss( $boxShadowProperties );
$boxShadowHoverCss = \Vexaltrix\Presentation\Blocks\BlockHelper::generateShadowCss( $boxShadowHoverProperties );

$attr['captionDecoration'] = '' === $attr['captionDecoration'] && defined( 'ASTRA_THEME_SETTINGS' ) && function_exists( 'astra_get_font_extras' ) && function_exists( 'astra_get_option' ) ? astra_get_font_extras( astra_get_option( 'body-font-extras' ), 'text-decoration' ) : $attr['captionDecoration'];

$selectors = [
	'.wp-block-vxt-image'                            => [
		'margin-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageTopMargin'], $attr['imageMarginUnit'] ),
		'margin-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageRightMargin'], $attr['imageMarginUnit'] ),
		'margin-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBottomMargin'], $attr['imageMarginUnit'] ),
		'margin-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageLeftMargin'], $attr['imageMarginUnit'] ),
		'text-align'      => $attr['align'],
		'justify-content' => $align,
		'align-self'      => $align,
	],
	' .wp-block-vxt-image__figure'                   => [
		'align-items' => $align,
	],
	'.wp-block-vxt-image--layout-default figure img' => array_merge(
		[
			'box-shadow' => $boxShadowCss,
		],
		$imageBorderCss
	),
	'.wp-block-vxt-image .wp-block-vxt-image__figure img:hover' => [
		'border-color' => $attr['imageBorderHColor'],
	],
	'.wp-block-vxt-image .wp-block-vxt-image__figure figcaption' => [
		'color'         => $attr['captionColor'],
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionTopMargin'], $attr['captionMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionRightMargin'], $attr['captionMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionBottomMargin'], $attr['captionMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionLeftMargin'], $attr['captionMarginUnit'] ),
		'align-self'    => ( 'overlay' !== $attr['layout'] ? $attr['captionAlign'] : '' ),
	],
	'.wp-block-vxt-image .wp-block-vxt-image__figure figcaption a' => [
		'color' => $attr['captionColor'],
	],
	// overlay.
	'.wp-block-vxt-image--layout-overlay figure img' => array_merge(
		[
			'box-shadow' => $boxShadowCss,
		],
		$imageBorderCss
	),
	'.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__color-wrapper' => array_merge(
		[
			'background' => $attr['overlayBackground'],
			'opacity'    => $attr['overlayOpacity'],
		],
		$imageBorderCss
	),
	'.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__color-wrapper:hover' => [
		'border-color' => $attr['imageBorderHColor'],
	],
	'.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__inner' => array_merge(
		$overlayBorderCss,
		[
			'left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['overlayPositionFromEdge'], $attr['overlayPositionFromEdgeUnit'] ),
			'right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['overlayPositionFromEdge'], $attr['overlayPositionFromEdgeUnit'] ),
			'top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['overlayPositionFromEdge'], $attr['overlayPositionFromEdgeUnit'] ),
			'bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['overlayPositionFromEdge'], $attr['overlayPositionFromEdgeUnit'] ),
		]
	),
	'.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__inner .vxt-image-heading' => [
		'color'         => $attr['headingColor'],
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingTopMargin'], $attr['headingMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingRightMargin'], $attr['headingMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingBottomMargin'], $attr['headingMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLeftMargin'], $attr['headingMarginUnit'] ),
		'opacity'       => 'always' === $attr['headingShowOn'] ? 1 : 0,
	],
	'.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__inner .vxt-image-heading a' => [
		'color' => $attr['headingColor'],
	],
	'.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__inner .vxt-image-caption' => [
		'opacity' => 'always' === $attr['captionShowOn'] ? 1 : 0,
	],
	'.wp-block-vxt-image--layout-overlay .wp-block-vxt-image__figure:hover .wp-block-vxt-image--layout-overlay__inner' => [
		'border-color' => $attr['overlayBorderHColor'],
	],
	'.wp-block-vxt-image--layout-overlay .wp-block-vxt-image__figure:hover .wp-block-vxt-image--layout-overlay__color-wrapper' => [
		'opacity' => $attr['overlayHoverOpacity'],
	],
	// Seperator.
	'.wp-block-vxt-image .wp-block-vxt-image--layout-overlay__inner .vxt-image-separator' => [
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorWidth'], $attr['separatorWidthType'] ),
		'border-top-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorThickness'], $attr['seperatorThicknessUnit'] ),
		'border-top-color' => $attr['seperatorColor'],
		'border-top-style' => $attr['seperatorStyle'],
		'margin-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorBottomMargin'], $attr['seperatorMarginUnit'] ),
		'margin-top'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorTopMargin'], $attr['seperatorMarginUnit'] ),
		'margin-left'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorLeftMargin'], $attr['seperatorMarginUnit'] ),
		'margin-right'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorRightMargin'], $attr['seperatorMarginUnit'] ),
		'opacity'          => 'always' === $attr['seperatorShowOn'] ? 1 : 0,
	],
];

$selectors['.wp-block-vxt-image .wp-block-vxt-image__figure img'] = [
	'object-fit' => $attr['objectFit'],
	'width'      => $attr['width'] . 'px',
	'height'     => 'auto',
];
if ( $attr['customHeightSetDesktop'] ) {
	$selectors['.wp-block-vxt-image .wp-block-vxt-image__figure img']['height'] = $attr['height'] . 'px';
}

if ( 'hover' === $attr['headingShowOn'] ) {
	$selectors['.wp-block-vxt-image .wp-block-vxt-image__figure:hover .wp-block-vxt-image--layout-overlay__inner .vxt-image-heading'] = [
		'opacity' => 1,
	];
}
if ( 'hover' === $attr['captionShowOn'] ) {
	$selectors['.wp-block-vxt-image .wp-block-vxt-image__figure:hover .wp-block-vxt-image--layout-overlay__inner .vxt-image-caption'] = [
		'opacity' => 1,
	];
}
if ( 'hover' === $attr['seperatorShowOn'] ) {
	$selectors['.wp-block-vxt-image .wp-block-vxt-image__figure:hover .wp-block-vxt-image--layout-overlay__inner .vxt-image-separator'] = [
		'opacity' => 1,
	];
}

// If using separate box shadow hover settings, then generate CSS for it.
if ( $attr['useSeparateBoxShadows'] ) {
	$selectors['.wp-block-vxt-image--layout-default figure:hover img'] = [
		'box-shadow' => $boxShadowHoverCss,
	];

	$selectors['.wp-block-vxt-image--layout-overlay figure:hover img'] = [
		'box-shadow' => $boxShadowHoverCss,
	];

};

if ( 'none' !== $attr['maskShape'] ) {
	$imagePath = VXT_URL . 'assets/images/masks/' . $attr['maskShape'] . '.svg';
	if ( 'custom' === $attr['maskShape'] ) {
		$imagePath = $attr['maskCustomShape']['url'];
	}
	if ( ! empty( $imagePath ) ) {
		$selectors[ '.wp-block-vxt-image .wp-block-vxt-image__figure img, .vxt-block-' . $id . ' .wp-block-vxt-image--layout-overlay__color-wrapper' ] = [
			'mask-image'            => 'url(' . $imagePath . ')',
			'-webkit-mask-image'    => 'url(' . $imagePath . ')',
			'mask-size'             => $attr['maskSize'],
			'-webkit-mask-size'     => $attr['maskSize'],
			'mask-repeat'           => $attr['maskRepeat'],
			'-webkit-mask-repeat'   => $attr['maskRepeat'],
			'mask-position'         => $attr['maskPosition'],
			'-webkit-mask-position' => $attr['maskPosition'],
		];
	}
}

// tablet.
$tSelectors['.wp-block-vxt-image--layout-default figure img']       = $imageBorderCssTablet;
$tSelectors['.wp-block-vxt-image--layout-overlay figure img']       = $imageBorderCssTablet;
$tSelectors['.wp-block-vxt-image .wp-block-vxt-image__figure img'] = [
	'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthTablet'], 'px' ),
];
$tSelectors['.wp-block-vxt-image']                                  = [
	'margin-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageTopMarginTablet'], $attr['imageMarginUnitTablet'] ),
	'margin-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageRightMarginTablet'], $attr['imageMarginUnitTablet'] ),
	'margin-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBottomMarginTablet'], $attr['imageMarginUnitTablet'] ),
	'margin-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageLeftMarginTablet'], $attr['imageMarginUnitTablet'] ),
	'text-align'      => $attr['alignTablet'],
	'justify-content' => $alignTablet,
	'align-self'      => $alignTablet,
];
$tSelectors[' .wp-block-vxt-image__figure']                         = [
	'align-items' => $alignTablet,
];
$tSelectors['.wp-block-vxt-image .wp-block-vxt-image__figure figcaption']                           = [
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionTopMarginTablet'], $attr['captionMarginUnitTablet'] ),
	'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionRightMarginTablet'], $attr['captionMarginUnitTablet'] ),
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionBottomMarginTablet'], $attr['captionMarginUnitTablet'] ),
	'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionLeftMarginTablet'], $attr['captionMarginUnitTablet'] ),
];
$tSelectors['.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__inner']       = $overlayBorderCssTablet;
$tSelectors['.wp-block-vxt-image .wp-block-vxt-image--layout-overlay__inner .vxt-image-heading']   = [
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingTopMarginTablet'], $attr['headingMarginUnitTablet'] ),
	'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingRightMarginTablet'], $attr['headingMarginUnitTablet'] ),
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingBottomMarginTablet'], $attr['headingMarginUnitTablet'] ),
	'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLeftMarginTablet'], $attr['headingMarginUnitTablet'] ),
];
$tSelectors['.wp-block-vxt-image .wp-block-vxt-image--layout-overlay__inner .vxt-image-separator'] = [
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorBottomMarginTablet'], $attr['seperatorMarginUnitTablet'] ),
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorTopMarginTablet'], $attr['seperatorMarginUnitTablet'] ),
	'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorLeftMarginTablet'], $attr['seperatorMarginUnitTablet'] ),
	'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorRightMarginTablet'], $attr['seperatorMarginUnitTablet'] ),
];

$tSelectors['.wp-block-vxt-image .wp-block-vxt-image__figure img'] = [
	'object-fit' => $attr['objectFitTablet'],
	'width'      => $widthTablet,
	'height'     => 'auto',
];

if ( $attr['customHeightSetTablet'] ) {
	$tSelectors['.wp-block-vxt-image .wp-block-vxt-image__figure img']['height'] = $heightTablet;
}

// mobile.
$mSelectors['.wp-block-vxt-image--layout-default figure img']       = $imageBorderCssMobile;
$mSelectors['.wp-block-vxt-image--layout-overlay figure img']       = $imageBorderCssMobile;
$mSelectors['.wp-block-vxt-image .wp-block-vxt-image__figure img'] = [
	'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthMobile'], 'px' ),
];
$mSelectors['.wp-block-vxt-image']                                  = [
	'margin-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageTopMarginMobile'], $attr['imageMarginUnitMobile'] ),
	'margin-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageRightMarginMobile'], $attr['imageMarginUnitMobile'] ),
	'margin-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBottomMarginMobile'], $attr['imageMarginUnitMobile'] ),
	'margin-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageLeftMarginMobile'], $attr['imageMarginUnitMobile'] ),
	'text-align'      => $attr['alignMobile'],
	'justify-content' => $alignMobile,
	'align-self'      => $alignMobile,
];
$mSelectors[' .wp-block-vxt-image__figure']                         = [
	'align-items' => $alignMobile,
];
$mSelectors['.wp-block-vxt-image .wp-block-vxt-image__figure figcaption'] = [
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionTopMarginMobile'], $attr['captionMarginUnitMobile'] ),
	'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionRightMarginMobile'], $attr['captionMarginUnitMobile'] ),
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionBottomMarginMobile'], $attr['captionMarginUnitMobile'] ),
	'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionLeftMarginMobile'], $attr['captionMarginUnitMobile'] ),
];

$mSelectors['.wp-block-vxt-image .wp-block-vxt-image--layout-overlay__inner .vxt-image-heading']   = [
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingTopMarginMobile'], $attr['headingMarginUnitMobile'] ),
	'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingRightMarginMobile'], $attr['headingMarginUnitMobile'] ),
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingBottomMarginMobile'], $attr['headingMarginUnitMobile'] ),
	'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['headingLeftMarginMobile'], $attr['headingMarginUnitMobile'] ),
];
$mSelectors['.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__inner']       = $overlayBorderCssMobile;
$mSelectors['.wp-block-vxt-image .wp-block-vxt-image--layout-overlay__inner .vxt-image-separator'] = [
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorBottomMarginMobile'], $attr['seperatorMarginUnitMobile'] ),
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorTopMarginMobile'], $attr['seperatorMarginUnitMobile'] ),
	'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorLeftMarginMobile'], $attr['seperatorMarginUnitMobile'] ),
	'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['seperatorRightMarginMobile'], $attr['seperatorMarginUnitMobile'] ),
];

$mSelectors['.wp-block-vxt-image .wp-block-vxt-image__figure img'] = [
	'object-fit' => $attr['objectFitMobile'],
	'width'      => $widthMobile,
	'height'     => 'auto',
];

if ( $attr['customHeightSetMobile'] ) {
	$mSelectors['.wp-block-vxt-image .wp-block-vxt-image__figure img']['height'] = $heightMobile;
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = '.vxt-block-';

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'heading', '.wp-block-vxt-image--layout-overlay .wp-block-vxt-image--layout-overlay__inner .vxt-image-heading', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'caption', '.wp-block-vxt-image .wp-block-vxt-image__figure figcaption', $combinedSelectors );

return \Vexaltrix\Core\Support\Helper::generateAllCss(
	$combinedSelectors,
	$baseSelector . $id,
	isset( $gbsClass ) ? $gbsClass : ''
);
