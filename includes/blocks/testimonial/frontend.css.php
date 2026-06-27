<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined else where.
 *
 * @var mixed[] $attr
 * @var int $id
 */

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksTestimonialGfont( $attr );

$rowGapTabletFallback    = is_numeric( $attr['rowGapTablet'] ) ? $attr['rowGapTablet'] : $attr['rowGap'];
$rowGapMobileFallback    = is_numeric( $attr['rowGapMobile'] ) ? $attr['rowGapMobile'] : $rowGapTabletFallback;
$columnGapTabletFallback = is_numeric( $attr['columnGapTablet'] ) ? $attr['columnGapTablet'] : $attr['columnGap'];
$columnGapMobileFallback = is_numeric( $attr['columnGapMobile'] ) ? $attr['columnGapMobile'] : $columnGapTabletFallback;

$imgAlign = 'center';
if ( 'left' === $attr['headingAlign'] ) {
	$imgAlign = 'flex-start';
} elseif ( 'right' === $attr['headingAlign'] ) {
	$imgAlign = 'flex-end';
}

$overallBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall' );
$overallBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$overallBorder,
	( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);
$overallBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'tablet' );
$overallBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'mobile' );

$position = str_replace( '-', ' ', $attr['backgroundPosition'] );

$tSelectors = [];
$mSelectors = [];

$paddingTop    = isset( $attr['paddingTop'] ) ? $attr['paddingTop'] : $attr['contentPadding'];
$paddingBottom = isset( $attr['paddingBottom'] ) ? $attr['paddingBottom'] : $attr['contentPadding'];
$paddingLeft   = isset( $attr['paddingLeft'] ) ? $attr['paddingLeft'] : $attr['contentPadding'];
$paddingRight  = isset( $attr['paddingRight'] ) ? $attr['paddingRight'] : $attr['contentPadding'];

$imgpaddingTop    = isset( $attr['imgpaddingTop'] ) ? $attr['imgpaddingTop'] : $attr['imgVrPadding'];
$imgpaddingRight  = isset( $attr['imgpaddingRight'] ) ? $attr['imgpaddingRight'] : $attr['imgHrPadding'];
$imgpaddingBottom = isset( $attr['imgpaddingBottom'] ) ? $attr['imgpaddingBottom'] : $attr['imgVrPadding'];
$imgpaddingLeft   = isset( $attr['imgpaddingLeft'] ) ? $attr['imgpaddingLeft'] : $attr['imgHrPadding'];

$selectors = [
	' .vxt-testimonial__wrap'                         => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['rowGap'], $attr['rowGapType'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( ( ( $attr['columnGap'] ) / 2 ), $attr['columnGapType'] ),
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( ( ( $attr['columnGap'] ) / 2 ), $attr['columnGapType'] ),
	],
	' .vxt-tm__content'                               => [
		'text-align'     => $attr['headingAlign'],
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $paddingTop, $attr['paddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $paddingBottom, $attr['paddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $paddingLeft, $attr['paddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $paddingRight, $attr['paddingUnit'] ),
		'align-content'  => $attr['vAlignContent'],
	],
	' .vxt-testimonial__wrap .vxt-tm__image-content' => [
		'text-align'     => $attr['headingAlign'],
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $imgpaddingTop, $attr['imgpaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $imgpaddingBottom, $attr['imgpaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $imgpaddingLeft, $attr['imgpaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $imgpaddingRight, $attr['imgpaddingUnit'] ),
	],
	' .vxt-tm__image img'                             => [
		'width'     => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthType'] ),
		'max-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthType'] ),
	],

	' .vxt-tm__author-name'                           => [
		'color'         => $attr['authorColor'],
		'margin-bottom' => $attr['nameSpace'] . $attr['nameSpaceType'],
	],
	' .vxt-tm__company'                               => [
		'color' => $attr['companyColor'],
	],
	' .vxt-tm__desc'                                  => [
		'color'         => $attr['descColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpace'], $attr['descSpaceType'] ),
	],
	' .vxt-testimonial__wrap .vxt-tm__content'       => $overallBorder,
	' .vxt-testimonial__wrap .vxt-tm__content:hover' => [
		'border-color' => $attr['overallBorderHColor'],
	],
	' ul.slick-dots li button:before'                  => [
		'color' => $attr['arrowColor'],
	],
	' ul.slick-dots li.slick-active button:before'     => [
		'color' => $attr['arrowColor'],
	],
	' .vxt-tm__image-position-top .vxt-tm__image-content' => [
		'justify-content' => $imgAlign,
	],
];

$gradient        = '';
$gradientTablet = '';
$gradientMobile = '';

$gradientColor1          = isset( $attr['gradientColor1'] ) ? $attr['gradientColor1'] : '';
$gradientColor2          = isset( $attr['gradientColor2'] ) ? $attr['gradientColor2'] : '';
$gradientType            = isset( $attr['gradientType'] ) ? $attr['gradientType'] : '';
$gradientLocation1       = isset( $attr['gradientLocation1'] ) ? $attr['gradientLocation1'] : '';
$gradientLocation2       = isset( $attr['gradientLocation2'] ) ? $attr['gradientLocation2'] : '';
$gradientAngle           = isset( $attr['gradientAngle'] ) ? $attr['gradientAngle'] : '';
$gradientLocationTablet1 = is_numeric( $attr['gradientLocationTablet1'] ) ? $attr['gradientLocationTablet1'] : $gradientLocation1;
$gradientLocationTablet2 = is_numeric( $attr['gradientLocationTablet2'] ) ? $attr['gradientLocationTablet2'] : $gradientLocation2;
$gradientAngleTablet     = is_numeric( $attr['gradientAngleTablet'] ) ? $attr['gradientAngleTablet'] : $gradientAngle;
$gradientLocationMobile1 = is_numeric( $attr['gradientLocationMobile1'] ) ? $attr['gradientLocationMobile1'] : $gradientLocationTablet1;
$gradientLocationMobile2 = is_numeric( $attr['gradientLocationMobile2'] ) ? $attr['gradientLocationMobile2'] : $gradientLocationTablet2;
$gradientAngleMobile     = is_numeric( $attr['gradientAngleMobile'] ) ? $attr['gradientAngleMobile'] : $gradientAngleTablet;

if ( 'basic' === $attr['selectGradient'] && $attr['gradientValue'] ) {
	$gradient = $attr['gradientValue'];
} elseif ( 'linear' === $gradientType && 'advanced' === $attr['selectGradient'] ) {
	$gradient        = 'linear-gradient(' . $attr['gradientAngle'] . 'deg, ' . $gradientColor1 . ' ' . $gradientLocation1 . '%, ' . $gradientColor2 . ' ' . $gradientLocation2 . '%)';
	$gradientTablet = 'linear-gradient(' . $gradientAngleTablet . 'deg, ' . $gradientColor1 . ' ' . $gradientLocationTablet1 . '%, ' . $gradientColor2 . ' ' . $gradientLocationTablet2 . '%)';
	$gradientMobile = 'linear-gradient(' . $gradientAngleMobile . 'deg, ' . $gradientColor1 . ' ' . $gradientLocationMobile1 . '%, ' . $gradientColor2 . ' ' . $gradientLocationMobile2 . '%)';
} elseif ( 'radial' === $gradientType && 'advanced' === $attr['selectGradient'] ) {
	$gradient        = 'radial-gradient( at center center, ' . $gradientColor1 . ' ' . $gradientLocation1 . '%, ' . $gradientColor2 . ' ' . $gradientLocation2 . '%)';
	$gradientTablet = 'radial-gradient( at center center, ' . $gradientColor1 . ' ' . $gradientLocationTablet1 . '%, ' . $gradientColor2 . ' ' . $gradientLocationTablet2 . '%)';
	$gradientMobile = 'radial-gradient( at center center, ' . $gradientColor1 . ' ' . $gradientLocationMobile1 . '%, ' . $gradientColor2 . ' ' . $gradientLocationMobile2 . '%)';
}

if ( 'gradient' === $attr['backgroundType'] ) {
	$selectors[' .vxt-tm__content'] = [
		'background-color' => 'transparent',
		'background-image' => $gradient,
	];
}
if ( 'image' === $attr['backgroundType'] ) {
	if ( 'color' === $attr['overlayType'] ) {
		$selectors[' .vxt-testimonial__wrap.vxt-tm__bg-type-image .vxt-tm__overlay'] = [
			'background-color' => $attr['backgroundImageColor'],
			'opacity'          => ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] ) ? ( ( 100 - $attr['backgroundOpacity'] ) / 100 ) : '',
		];
	} elseif ( 'gradient' === $attr['overlayType'] ) {
			$selectors[' .vxt-testimonial__wrap.vxt-tm__bg-type-image .vxt-tm__overlay']['background-image']   = $gradient;
			$tSelectors[' .vxt-testimonial__wrap.vxt-tm__bg-type-image .vxt-tm__overlay']['background-image'] = $gradientTablet;
			$mSelectors[' .vxt-testimonial__wrap.vxt-tm__bg-type-image .vxt-tm__overlay']['background-image'] = $gradientMobile;
	}
} else {
	$selectors['  .vxt-testimonial__wrap.vxt-tm__bg-type-color .vxt-tm__content'] = [
		'background-color' => $attr['backgroundColor'],
	];
}

if ( true === $attr['equalHeight'] ) {
	$selectors['  .vxt-tm__content'] = [
		'height' => '-webkit-fill-available',
	];
}

$selectors['  .vxt-testimonial__wrap.vxt-tm__bg-type-image .vxt-tm__content'] = [
	'background-image'    => ( isset( $attr['backgroundImage']['url'] ) && '' !== $attr['backgroundImage']['url'] ) ? 'url("' . $attr['backgroundImage']['url'] . '")' : null,
	'background-position' => $position,
	'background-repeat'   => $attr['backgroundRepeat'],
	'background-size'     => $attr['backgroundSize'],
];
if ( 'dots' === $attr['arrowDots'] ) {
	$selectors['.vxt-slick-carousel'] = [
		'padding' => '0 0 35px 0',
	];
}

if ( '1' === $attr['test_item_count'] || $attr['test_item_count'] === $attr['columns'] ) {
	$selectors['.vxt-slick-carousel'] = [
		'padding' => 0,
	];
}

$mSelectors = [
	' .vxt-testimonial__wrap'                          => [
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( ( ( $columnGapMobileFallback ) / 2 ), $attr['columnGapType'] ),
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( ( ( $columnGapMobileFallback ) / 2 ), $attr['columnGapType'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $rowGapMobileFallback, $attr['rowGapType'] ),
	],
	' .vxt-tm__image img'                              => [
		'width'     => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthType'] ),
		'max-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthType'] ),
	],
	' .vxt-tm__author-name'                            => [
		'margin-bottom' => $attr['nameSpaceMobile'] . $attr['nameSpaceType'],
	],

	' .vxt-testimonial__wrap .vxt-tm__content'        => $overallBorderMobile,
	' .vxt-tm__desc'                                   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpaceMobile'], $attr['descSpaceType'] ),
		'margin-left'   => ( ( 1 === $attr['test_item_count'] ) || ( 'dots' === $attr['arrowDots'] ) || ( 1 !== $attr['columns'] ) ) ? 'auto' : '20px',
		'margin-right'  => ( ( 1 === $attr['test_item_count'] ) || ( 'dots' === $attr['arrowDots'] ) || ( 1 !== $attr['columns'] ) ) ? 'auto' : '20px',
	],
	' .vxt-tm__content'                                => [
		'text-align'     => $attr['headingAlignMobile'],
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingTopMobile'], $attr['mobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBottomMobile'], $attr['mobilePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingLeftMobile'], $attr['mobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingRightMobile'], $attr['mobilePaddingUnit'] ),
		'align-content'  => $attr['vAlignContent'],
	],
	'  .vxt-testimonial__wrap .vxt-tm__image-content' => [
		'text-align'     => $attr['headingAlignMobile'],
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['imgpaddingTopMobile'], $attr['imgmobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgpaddingBottomMobile'], $attr['imgmobilePaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['imgpaddingLeftMobile'], $attr['imgmobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgpaddingRightMobile'], $attr['imgmobilePaddingUnit'] ),
	],
];

if ( 'gradient' === $attr['backgroundType'] ) {
	$mSelectors[' .vxt-tm__content'] = [
		'background-color' => 'transparent',
		'background-image' => $gradientMobile,
	];
}

$tSelectors = [
	' .vxt-testimonial__wrap'                          => [
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( ( ( $columnGapTabletFallback ) / 2 ), $attr['columnGapType'] ),
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( ( ( $columnGapTabletFallback ) / 2 ), $attr['columnGapType'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $rowGapTabletFallback, $attr['rowGapType'] ),
	],
	' .vxt-tm__image img'                              => [
		'width'     => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthType'] ),
		'max-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthType'] ),
	],
	' .vxt-tm__author-name'                            => [
		'margin-bottom' => $attr['nameSpaceTablet'] . $attr['nameSpaceType'],
	],
	' .vxt-tm__desc'                                   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpaceTablet'], $attr['descSpaceType'] ),
	],

	' .vxt-testimonial__wrap .vxt-tm__content'        => $overallBorderTablet,
	' .vxt-tm__content'                                => [
		'text-align'     => $attr['headingAlignTablet'],
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingTopTablet'], $attr['tabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBottomTablet'], $attr['tabletPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingLeftTablet'], $attr['tabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingRightTablet'], $attr['tabletPaddingUnit'] ),
		'align-content'  => $attr['vAlignContent'],
	],
	'  .vxt-testimonial__wrap .vxt-tm__image-content' => [
		'text-align'     => $attr['headingAlignTablet'],
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['imgpaddingTopTablet'], $attr['imgtabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgpaddingRightTablet'], $attr['imgtabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgpaddingBottomTablet'], $attr['imgtabletPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['imgpaddingLeftTablet'], $attr['imgtabletPaddingUnit'] ),
	],
];

if ( 'gradient' === $attr['backgroundType'] ) {
	$tSelectors[' .vxt-tm__content'] = [
		'background-color' => 'transparent',
		'background-image' => $gradientTablet,
	];
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'name', '  .vxt-tm__author-name', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'company', ' .vxt-tm__company', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'desc', ' .vxt-tm__desc', $combinedSelectors );

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-testimonial-';

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
