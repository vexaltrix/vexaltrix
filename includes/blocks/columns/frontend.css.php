<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

global $contentWidth;

$bgType      = ( isset( $attr['backgroundType'] ) ) ? $attr['backgroundType'] : 'none';
$overlayType = ( isset( $attr['overlayType'] ) ) ? $attr['overlayType'] : 'color';
$border       = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'columns' );
$border       = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$border,
	( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);

$borderTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'columns', 'tablet' );
$borderMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'columns', 'mobile' );

$topMargin    = isset( $attr['topMarginDesktop'] ) ? $attr['topMarginDesktop'] : $attr['topMargin'];
$bottomMargin = isset( $attr['bottomMarginDesktop'] ) ? $attr['bottomMarginDesktop'] : $attr['bottomMargin'];
$leftMargin   = isset( $attr['leftMarginDesktop'] ) ? $attr['leftMarginDesktop'] : '';
$rightMargin  = isset( $attr['rightMarginDesktop'] ) ? $attr['rightMarginDesktop'] : '';

$mobileTopMargin    = $attr['topMarginMobile'];
$mobileBottomMargin = $attr['bottomMarginMobile'];
$mobileLeftMargin   = isset( $attr['leftMarginMobile'] ) ? $attr['leftMarginMobile'] : '';
$mobileRightMargin  = isset( $attr['rightMarginMobile'] ) ? $attr['rightMarginMobile'] : '';

$tabletTopMargin    = $attr['topMarginTablet'];
$tabletBottomMargin = $attr['bottomMarginTablet'];
$tabletLeftMargin   = isset( $attr['leftMarginTablet'] ) ? $attr['leftMarginTablet'] : '';
$tabletRightMargin  = isset( $attr['rightMarginTablet'] ) ? $attr['rightMarginTablet'] : '';

$mSelectors          = [];
$tSelectors          = [];
$boxShadowPositionCSS = $attr['boxShadowPosition'];
if ( 'outset' === $attr['boxShadowPosition'] ) {
	$boxShadowPositionCSS = '';
}
$style = [
	'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPadding'], $attr['desktopPaddingType'] ),
	'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPadding'], $attr['desktopPaddingType'] ),
	'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPadding'], $attr['desktopPaddingType'] ),
	'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPadding'], $attr['desktopPaddingType'] ),
	'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $topMargin, $attr['desktopMarginType'] ),
	'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomMargin, $attr['desktopMarginType'] ),
	'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMargin, $attr['desktopMarginType'] ),
	'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMargin, $attr['desktopMarginType'] ),
];

$position = str_replace( '-', ' ', $attr['backgroundPosition'] );

if ( 'image' === $bgType ) {

	$style['background-image']      = ( isset( $attr['backgroundImage'] ) && isset( $attr['backgroundImage']['url'] ) ) ? "url('" . $attr['backgroundImage']['url'] . "' )" : null;
	$style['background-position']   = $position;
	$style['background-attachment'] = $attr['backgroundAttachment'];
	$style['background-repeat']     = $attr['backgroundRepeat'];
	$style['background-size']       = $attr['backgroundSize'];

}

$innerWidth = '100%';

if ( isset( $attr['contentWidth'] ) ) {
	if ( 'theme' === $attr['contentWidth'] ) {
		$innerWidth = \Vexaltrix\Core\Support\Helper::getCssValue( $contentWidth, 'px' );
	} elseif ( 'custom' === $attr['contentWidth'] ) {
		$innerWidth = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['width'], $attr['widthType'] );
	}
}

$videoOpacity = 0.5;
if ( isset( $attr['backgroundVideoOpacity'] ) && '' !== $attr['backgroundVideoOpacity'] ) {
	$videoOpacity = ( 1 < $attr['backgroundVideoOpacity'] ) ? ( ( 100 - $attr['backgroundVideoOpacity'] ) / 100 ) : ( ( 1 - $attr['backgroundVideoOpacity'] ) );
}

$selectors = [
	'.wp-block-vxt-columns.vxt-columns__wrap' => $style,
	' .vxt-columns__video-wrap'                => [
		'opacity' => $videoOpacity,
	],
	' > .vxt-columns__inner-wrap'              => [ // For backward user.
		'max-width' => $innerWidth,
	],
	' .vxt-column__inner-wrap'                 => [ // For backward user.
		'padding' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGap'], 'px' ),
	],
	' .vxt-column__wrap'                       => [
		'padding' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGap'], 'px' ),
	],
	' .vxt-columns__shape-top svg'             => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topHeight'], 'px' ),
	],
	' .vxt-columns__shape.vxt-columns__shape-top .vxt-columns__shape-fill' => [
		'fill' => \Vexaltrix\Core\Support\Helper::hex2rgba( $attr['topColor'], ( isset( $attr['topDividerOpacity'] ) && '' !== $attr['topDividerOpacity'] ) ? $attr['topDividerOpacity'] : 100 ),
	],
	' .vxt-columns__shape-bottom svg'          => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomHeight'], 'px' ),
	],
	' .vxt-columns__shape.vxt-columns__shape-bottom .vxt-columns__shape-fill' => [
		'fill' => \Vexaltrix\Core\Support\Helper::hex2rgba( $attr['bottomColor'], ( isset( $attr['bottomDividerOpacity'] ) && '' !== $attr['bottomDividerOpacity'] ) ? $attr['bottomDividerOpacity'] : 100 ),
	],
	'.wp-block-vxt-columns'                    => [
		'box-shadow' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) . ' ' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $boxShadowPositionCSS,
	],
];

if ( '' !== $attr['topWidth'] ) {
	$selectors[' .vxt-columns__shape-top svg']['width'] = 'calc( ' . $attr['topWidth'] . '% + 1.3px )';
}

if ( '' !== $attr['bottomWidth'] ) {
	$selectors[' .vxt-columns__shape-bottom svg']['width'] = 'calc( ' . $attr['bottomWidth'] . '% + 1.3px )';
}

if ( 'video' === $bgType ) {
	if ( 'color' === $overlayType ) {
		$selectors[' > .vxt-columns__overlay'] = [
			'background-color' => $attr['backgroundVideoColor'],
		];
	} else {
		$selectors[' > .vxt-columns__overlay']['background-image'] = $attr['gradientValue'];
	}
} elseif ( 'image' === $bgType ) {
	if ( 'color' === $overlayType ) {
		$selectors[' > .vxt-columns__overlay'] = [
			'background-color' => $attr['backgroundImageColor'],
			'opacity'          => ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] && 0 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '',
		];
	} else {
		if ( $attr['gradientValue'] ) {
			$selectors[' > .vxt-columns__overlay']['background-image'] = $attr['gradientValue'];
		} else {
			$selectors[' > .vxt-columns__overlay']['background-color'] = 'transparent';
			$selectors[' > .vxt-columns__overlay']['opacity']          = ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] && 0 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '';
			if ( 'linear' === $attr['gradientOverlayType'] ) {

				$selectors[' > .vxt-columns__overlay']['background-image'] = 'linear-gradient(' . $attr['gradientOverlayAngle'] . 'deg, ' . $attr['gradientOverlayColor1'] . ' ' . $attr['gradientOverlayLocation1'] . '%, ' . $attr['gradientOverlayColor2'] . ' ' . $attr['gradientOverlayLocation2'] . '%)';
			} else {

				$selectors[' > .vxt-columns__overlay']['background-image'] = 'radial-gradient( at ' . $gradientOverlayPosition . ', ' . $attr['gradientOverlayColor1'] . ' ' . $attr['gradientOverlayLocation1'] . '%, ' . $attr['gradientOverlayColor2'] . ' ' . $attr['gradientOverlayLocation2'] . '%)';
			}
		}
	}
} elseif ( 'color' === $bgType ) {
	$selectors[' > .vxt-columns__overlay'] = [
		'background-color' => $attr['backgroundColor'],
		'opacity'          => ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] && 0 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '',
	];
} elseif ( 'gradient' === $bgType ) {
	$selectors[' > .vxt-columns__overlay']['background-color'] = 'transparent';
	$selectors[' > .vxt-columns__overlay']['opacity']          = ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 0 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '';
	
	$gradientColor1    = isset( $attr['gradientColor1'] ) ? $attr['gradientColor1'] : '';
	$gradientColor2    = isset( $attr['gradientColor2'] ) ? $attr['gradientColor2'] : '';
	$gradientType      = isset( $attr['gradientType'] ) ? $attr['gradientType'] : '';
	$gradientLocation1 = isset( $attr['gradientLocation1'] ) ? $attr['gradientLocation1'] : '';
	$gradientLocation2 = isset( $attr['gradientLocation2'] ) ? $attr['gradientLocation2'] : '';
	$gradientAngle     = isset( $attr['gradientAngle'] ) ? $attr['gradientAngle'] : '';
	
	if ( 'basic' === $attr['selectGradient'] && $attr['gradientValue'] ) {
		$gradient = $attr['gradientValue'];
	} elseif ( 'linear' === $gradientType && 'advanced' === $attr['selectGradient'] ) {
		$gradient = 'linear-gradient(' . $gradientAngle . 'deg, ' . $gradientColor1 . ' ' . $gradientLocation1 . '%, ' . $gradientColor2 . ' ' . $gradientLocation2 . '%)';
	} elseif ( 'radial' === $gradientType && 'advanced' === $attr['selectGradient'] ) {
		$gradient = 'radial-gradient( at center center, ' . $gradientColor1 . ' ' . $gradientLocation1 . '%, ' . $gradientColor2 . ' ' . $gradientLocation2 . '%)';
	} 
	$selectors[' > .vxt-columns__overlay']['background-image'] = $gradient;
}

$selectors[' > .vxt-columns__overlay']['border-radius'] = $border['border-top-left-radius'] . ' ' . $border['border-top-right-radius'] . ' ' . $border['border-bottom-left-radius'] . ' ' . $border['border-bottom-right-radius'];

$mSelectors = [
	'.wp-block-vxt-columns.vxt-columns__wrap' => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingMobile'], $attr['mobilePaddingType'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingMobile'], $attr['mobilePaddingType'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingMobile'], $attr['mobilePaddingType'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingMobile'], $attr['mobilePaddingType'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $mobileTopMargin, $attr['mobileMarginType'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $mobileBottomMargin, $attr['mobileMarginType'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $mobileLeftMargin, $attr['mobileMarginType'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $mobileRightMargin, $attr['mobileMarginType'] ),
	],
	' .vxt-columns__shape-bottom svg'          => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomHeightMobile'], 'px' ),
	],
	' .vxt-columns__shape-top svg'             => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topHeightMobile'], 'px' ),
	],
];

$tSelectors                      = [
	'.wp-block-vxt-columns.vxt-columns__wrap' => [
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingTablet'], $attr['tabletPaddingType'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingTablet'], $attr['tabletPaddingType'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingTablet'], $attr['tabletPaddingType'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingTablet'], $attr['tabletPaddingType'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $tabletTopMargin, $attr['tabletMarginType'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $tabletBottomMargin, $attr['tabletMarginType'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $tabletLeftMargin, $attr['tabletMarginType'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $tabletRightMargin, $attr['tabletMarginType'] ),
	],
	' .vxt-columns__shape-bottom svg'          => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomHeightTablet'], 'px' ),
	],
	' .vxt-columns__shape-top svg'             => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topHeightTablet'], 'px' ),
	],
];
$selectors['.vxt-columns__wrap'] = $border;
$selectors['.vxt-columns__wrap:hover']['border-color'] = $attr['columnsBorderHColor'];
$tSelectors['.vxt-columns__wrap']                     = $borderTablet;
$mSelectors['.vxt-columns__wrap']                     = $borderMobile;

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-columns-';

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
