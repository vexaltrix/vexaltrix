<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @package ugb
 */

global $contentWidth;

/**
 * Note: Fixing issue due to constraints on variable usage before a global declaration.
 * 
 * @var mixed[] $attr
 * @var int $id
 * @var string $gradient
 */

$overallBorderCss = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall' );
$overallBorderCss = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$overallBorderCss,
	( isset( $attr['borderWidth'] ) && is_string( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) && is_string( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) && is_string( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) && is_string( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);

$overallBorderCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'tablet' );
$overallBorderCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'overall', 'mobile' );


$bgType                 = ( isset( $attr['backgroundType'] ) ) ? $attr['backgroundType'] : 'none';
$overlayType            = ( isset( $attr['overlayType'] ) ) ? $attr['overlayType'] : 'color';
$gradientOverlayPosition = ( isset( $attr['gradientOverlayPosition'] ) ) ? $attr['gradientOverlayPosition'] : 'center center';
$gradientPosition        = ( isset( $attr['gradientPosition'] ) ) ? $attr['gradientPosition'] : 'center center';

$boxShadowPositionCSS = $attr['boxShadowPosition'];
if ( 'outset' === $attr['boxShadowPosition'] ) {
	$boxShadowPositionCSS = '';
}

$style  = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['topPadding'], $attr['desktopPaddingType'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['bottomPadding'], $attr['desktopPaddingType'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['leftPadding'], $attr['desktopPaddingType'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['rightPadding'], $attr['desktopPaddingType'] ),
	'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['topMargin'], $attr['desktopMarginType'] ),
	'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['bottomMargin'], $attr['desktopMarginType'] ),
];
$style += $overallBorderCss;

$mSelectors = [];
$tSelectors = [];
if ( 'boxed' === $attr['contentWidth'] ) {
	switch ( $attr['align'] ) {
		case 'right':
			$style['margin-right'] = \Vexaltrix\Support\Helper::getCssValue( $attr['rightMargin'], $attr['desktopMarginType'] );
			$style['margin-left']  = 'auto';
			break;
		case 'left':
			$style['margin-right'] = 'auto';
			$style['margin-left']  = \Vexaltrix\Support\Helper::getCssValue( $attr['leftMargin'], $attr['desktopMarginType'] );
			break;
		case 'center':
			$style['margin-right'] = 'auto';
			$style['margin-left']  = 'auto';
			break;
	}
}
if ( 'full_width' === $attr['contentWidth'] ) {
	$style['margin-right'] = \Vexaltrix\Support\Helper::getCssValue( $attr['rightMargin'], $attr['desktopMarginType'] );
	$style['margin-left']  = \Vexaltrix\Support\Helper::getCssValue( $attr['leftMargin'], $attr['desktopMarginType'] );
}

$position = str_replace( '-', ' ', $attr['backgroundPosition'] );

$sectionWidth = '100%';

if ( isset( $attr['contentWidth'] ) && ( 'boxed' === $attr['contentWidth'] && isset( $attr['width'] ) ) ) {
	$sectionWidth = \Vexaltrix\Support\Helper::getCssValue( $attr['width'], 'px' );
}

if ( 'wide' !== $attr['align'] && 'full' !== $attr['align'] ) {
	$style['max-width'] = $sectionWidth;
}

if ( 'image' === $bgType ) {

	$style['background-image']      = ( isset( $attr['backgroundImage'] ) && isset( $attr['backgroundImage']['url'] ) ) ? "url('" . $attr['backgroundImage']['url'] . "' )" : null;
	$style['background-position']   = $position;
	$style['background-attachment'] = $attr['backgroundAttachment'];
	$style['background-repeat']     = $attr['backgroundRepeat'];
	$style['background-size']       = $attr['backgroundSize'];

}

$innerWidth = '100%';

if ( isset( $attr['contentWidth'] ) ) {
	if ( 'boxed' !== $attr['contentWidth'] ) {
		if ( isset( $attr['themeWidth'] ) && $attr['themeWidth'] ) {
			$innerWidth = \Vexaltrix\Support\Helper::getCssValue( $contentWidth, 'px' );
		} else {
			if ( isset( $attr['innerWidth'] ) ) {
				$innerWidth = \Vexaltrix\Support\Helper::getCssValue( $attr['innerWidth'], $attr['innerWidthType'] );
			}
		}
	}
}

$videoOpacity = 0.5;
if ( isset( $attr['backgroundVideoOpacity'] ) && '' !== $attr['backgroundVideoOpacity'] ) {
	$videoOpacity = ( 1 < $attr['backgroundVideoOpacity'] ) ? ( ( 100 - $attr['backgroundVideoOpacity'] ) / 100 ) : ( ( 1 - $attr['backgroundVideoOpacity'] ) );
}

$selectors = [
	'.vxt-section__wrap'          => $style,
	' > .vxt-section__video-wrap' => [
		'opacity' => $videoOpacity,
	],
	' > .vxt-section__inner-wrap' => [
		'max-width' => $innerWidth,
	],
	'.wp-block-vxt-section'       => [
		'box-shadow' => \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $boxShadowPositionCSS,
	],
	'.vxt-section__wrap:hover'    => [
		'border-color' => $attr['overallBorderHColor'],
	],
];

if ( 'video' === $bgType ) {
	if ( 'color' === $overlayType ) {
		$selectors[' > .vxt-section__overlay'] = [
			'background-color' => $attr['backgroundVideoColor'],
		];
	} else {
		$selectors[' > .vxt-section__overlay']['background-image'] = $attr['gradientValue'];
	}
} elseif ( 'image' === $bgType ) {
	if ( 'color' === $overlayType ) {
		$selectors[' > .vxt-section__overlay'] = [
			'background-color' => $attr['backgroundImageColor'],
			'opacity'          => ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] && 0 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '',
		];
	} else {
		if ( $attr['gradientValue'] ) {
			$selectors[' > .vxt-section__overlay']['background-image'] = $attr['gradientValue'];
		} else {
			$selectors[' > .vxt-section__overlay']['background-color'] = 'transparent';
			$selectors[' > .vxt-section__overlay']['opacity']          = ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] && 0 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '';
			if ( 'linear' === $attr['gradientOverlayType'] ) {

				$selectors[' > .vxt-section__overlay']['background-image'] = 'linear-gradient(' . $attr['gradientOverlayAngle'] . 'deg, ' . $attr['gradientOverlayColor1'] . ' ' . $attr['gradientOverlayLocation1'] . '%, ' . $attr['gradientOverlayColor2'] . ' ' . $attr['gradientOverlayLocation2'] . '%)';
			} else {

				$selectors[' > .vxt-section__overlay']['background-image'] = 'radial-gradient( at ' . $gradientOverlayPosition . ', ' . $attr['gradientOverlayColor1'] . ' ' . $attr['gradientOverlayLocation1'] . '%, ' . $attr['gradientOverlayColor2'] . ' ' . $attr['gradientOverlayLocation2'] . '%)';
			}
		}
	}
} elseif ( 'color' === $bgType ) {
	$selectors[' > .vxt-section__overlay'] = [
		'background-color' => $attr['backgroundColor'],
		'opacity'          => ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] && 0 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '',
	];
} elseif ( 'gradient' === $bgType ) {
	$selectors[' > .vxt-section__overlay']['background-color'] = 'transparent';
	$selectors[' > .vxt-section__overlay']['opacity']          = ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] && 0 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '';

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
	$selectors[' > .vxt-section__overlay']['background-image'] = $gradient;
}

$selectors[' > .vxt-section__overlay']['border-radius'] = $attr['overallBorderTopLeftRadius'] . ' ' . $attr['overallBorderTopRightRadius'] . ' ' . $attr['overallBorderBottomLeftRadius'] . ' ' . $attr['overallBorderBottomRightRadius'];

$mSelectors = [
	'.vxt-section__wrap' => array_merge(
		[
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['topPaddingMobile'], $attr['mobilePaddingType'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['bottomPaddingMobile'], $attr['mobilePaddingType'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['leftPaddingMobile'], $attr['mobilePaddingType'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['rightPaddingMobile'], $attr['mobilePaddingType'] ),
		],
		$overallBorderCssMobile
),
];

$tSelectors                                      = [
	'.vxt-section__wrap' => array_merge(
		[
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['topPaddingTablet'], $attr['tabletPaddingType'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['bottomPaddingTablet'], $attr['tabletPaddingType'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['leftPaddingTablet'], $attr['tabletPaddingType'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['rightPaddingTablet'], $attr['tabletPaddingType'] ),
		],
		$overallBorderCssTablet
	),
];
$mSelectors['.vxt-section__wrap']['margin-top'] = \Vexaltrix\Support\Helper::getCssValue( $attr['topMarginMobile'], $attr['mobileMarginType'] );
$mSelectors['.vxt-section__wrap']['margin-bottom'] = \Vexaltrix\Support\Helper::getCssValue( $attr['bottomMarginMobile'], $attr['mobileMarginType'] );
$tSelectors['.vxt-section__wrap']['margin-top']    = \Vexaltrix\Support\Helper::getCssValue( $attr['topMarginTablet'], $attr['tabletMarginType'] );
$tSelectors['.vxt-section__wrap']['margin-bottom'] = \Vexaltrix\Support\Helper::getCssValue( $attr['bottomMarginTablet'], $attr['tabletMarginType'] );
if ( 'boxed' === $attr['contentWidth'] ) {
	if ( 'right' === $attr['align'] ) {
		$tSelectors['.vxt-section__wrap']['margin-right'] = \Vexaltrix\Support\Helper::getCssValue( $attr['rightMarginTablet'], $attr['tabletMarginType'] );
		$mSelectors['.vxt-section__wrap']['margin-right'] = \Vexaltrix\Support\Helper::getCssValue( $attr['rightMarginMobile'], $attr['mobileMarginType'] );
	} elseif ( 'left' === $attr['align'] ) {
		$tSelectors['.vxt-section__wrap']['margin-left'] = \Vexaltrix\Support\Helper::getCssValue( $attr['leftMarginTablet'], $attr['tabletMarginType'] );
		$mSelectors['.vxt-section__wrap']['margin-left'] = \Vexaltrix\Support\Helper::getCssValue( $attr['leftMarginMobile'], $attr['mobileMarginType'] );
	}
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-section-';

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
