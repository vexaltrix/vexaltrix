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
$overlayType = ( isset( $attr['overlayType'] ) ) ? $attr['overlayType'] : 'none';

$border        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'column' );
$border        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$border,
	( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);
$borderTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'column', 'tablet' );
$borderMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'column', 'mobile' );

$style = array_merge(
	[
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPadding'], $attr['desktopPaddingType'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPadding'], $attr['desktopPaddingType'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPadding'], $attr['desktopPaddingType'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPadding'], $attr['desktopPaddingType'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMargin'], $attr['desktopMarginType'] ),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMargin'], $attr['desktopMarginType'] ),
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMargin'], $attr['desktopMarginType'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMargin'], $attr['desktopMarginType'] ),
	],
	$border
);

$mSelectors = [];
$tSelectors = [];

$position = str_replace( '-', ' ', $attr['backgroundPosition'] );

if ( 'image' === $bgType ) {

	$style['background-image']      = ( isset( $attr['backgroundImage'] ) && isset( $attr['backgroundImage']['url'] ) ) ? "url('" . $attr['backgroundImage']['url'] . "' )" : null;
	$style['background-position']   = $position;
	$style['background-attachment'] = $attr['backgroundAttachment'];
	$style['background-repeat']     = $attr['backgroundRepeat'];
	$style['background-size']       = $attr['backgroundSize'];

}

$selectors = [
	'.vxt-column__wrap' => $style,
];

$selectors['.vxt-column__wrap:hover'] = [
	'border-color' => $attr['columnBorderHColor'],
];


if ( 'image' === $bgType ) {
	if ( 'color' === $overlayType ) {
		$selectors[' > .vxt-column__overlay'] = [
			'background-color' => $attr['backgroundImageColor'],
			'opacity'          => ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '',
		];
	} else {
		if ( $attr['gradientValue'] ) {
			$selectors[' > .vxt-column__overlay']['background-image'] = $attr['gradientValue'];
		} else {
			$selectors[' > .vxt-column__overlay']['background-color'] = 'transparent';
			$selectors[' > .vxt-column__overlay']['opacity']          = ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '';
			if ( 'linear' === $attr['gradientOverlayType'] ) {

				$selectors[' > .vxt-column__overlay']['background-image'] = 'linear-gradient(' . $attr['gradientOverlayAngle'] . 'deg, ' . $attr['gradientOverlayColor1'] . ' ' . $attr['gradientOverlayLocation1'] . '%, ' . $attr['gradientOverlayColor2'] . ' ' . $attr['gradientOverlayLocation2'] . '%)';
			} else {

				$selectors[' > .vxt-column__overlay']['background-image'] = 'radial-gradient( at center center, ' . $attr['gradientOverlayColor1'] . ' ' . $attr['gradientOverlayLocation1'] . '%, ' . $attr['gradientOverlayColor2'] . ' ' . $attr['gradientOverlayLocation2'] . '%)';
			}
		}
	}
} elseif ( 'color' === $bgType ) {
	$selectors[' > .vxt-column__overlay'] = [
		'background-color' => $attr['backgroundColor'],
		'opacity'          => ( isset( $attr['backgroundOpacity'] ) && '' !== $attr['backgroundOpacity'] && 101 !== $attr['backgroundOpacity'] ) ? $attr['backgroundOpacity'] / 100 : '',
	];
} elseif ( 'gradient' === $bgType ) {

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
	$selectors[' > .vxt-column__overlay']['background-image'] = $gradient;
}

$selectors[' > .vxt-column__overlay']['border-radius'] = $attr['columnBorderTopLeftRadius'] . ' ' . $attr['columnBorderTopRightRadius'] . ' ' . $attr['columnBorderBottomLeftRadius'] . ' ' . $attr['columnBorderBottomRightRadius'];

if ( '' !== $attr['colWidth'] && 0 !== $attr['colWidth'] ) {

	$selectors['.vxt-column__wrap']['width'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['colWidth'], '%' );
}

$mSelectors = [
	'.vxt-column__wrap' => array_merge(
		[
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingMobile'], $attr['mobilePaddingType'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingMobile'], $attr['mobilePaddingType'] ),
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingMobile'], $attr['mobilePaddingType'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingMobile'], $attr['mobilePaddingType'] ),
			'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginMobile'], $attr['mobileMarginType'] ),
			'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginMobile'], $attr['mobileMarginType'] ),
			'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginMobile'], $attr['mobileMarginType'] ),
			'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginMobile'], $attr['mobileMarginType'] ),
		],
		$borderMobile
	),
];

$tSelectors = [
	'.vxt-column__wrap' => array_merge(
		[
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingTablet'], $attr['tabletPaddingType'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingTablet'], $attr['tabletPaddingType'] ),
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingTablet'], $attr['tabletPaddingType'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingTablet'], $attr['tabletPaddingType'] ),
			'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginTablet'], $attr['tabletMarginType'] ),
			'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginTablet'], $attr['tabletMarginType'] ),
			'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginTablet'], $attr['tabletMarginType'] ),
			'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginTablet'], $attr['tabletMarginType'] ),
		],
		$borderTablet
	),
];

if ( '' !== $attr['colWidthTablet'] && 0 !== $attr['colWidthTablet'] ) {

	$tSelectors['.vxt-column__wrap']['width'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['colWidthTablet'], '%' );
}

if ( '' !== $attr['colWidthMobile'] && 0 !== $attr['colWidthMobile'] ) {

	$mSelectors['.vxt-column__wrap']['width'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['colWidthMobile'], '%' );
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = ( $attr['classMigrate'] ) ? '.wp-block-vxt-column.vxt-block-' : '#vxt-column-';

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
