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
\Vexaltrix\Core\Blocks\BlockJs::blocksMarketingBtnGfont( $attr );

$mSelectors = [];
$tSelectors = [];

$btnPaddingTop    = isset( $attr['paddingBtnTop'] ) ? $attr['paddingBtnTop'] : $attr['vPadding'];
$btnPaddingBottom = isset( $attr['paddingBtnBottom'] ) ? $attr['paddingBtnBottom'] : $attr['vPadding'];
$btnPaddingLeft   = isset( $attr['paddingBtnLeft'] ) ? $attr['paddingBtnLeft'] : $attr['hPadding'];
$btnPaddingRight  = isset( $attr['paddingBtnRight'] ) ? $attr['paddingBtnRight'] : $attr['hPadding'];

$btnPaddingTopMobile    = isset( $attr['paddingBtnTopMobile'] ) ? $attr['paddingBtnTopMobile'] : $attr['vPaddingMobile'];
$btnPaddingBottomMobile = isset( $attr['paddingBtnBottomMobile'] ) ? $attr['paddingBtnBottomMobile'] : $attr['vPaddingMobile'];
$btnPaddingLeftMobile   = isset( $attr['paddingBtnLeftMobile'] ) ? $attr['paddingBtnLeftMobile'] : $attr['hPaddingMobile'];
$btnPaddingRightMobile  = isset( $attr['paddingBtnRightMobile'] ) ? $attr['paddingBtnRightMobile'] : $attr['hPaddingMobile'];

$btnPaddingTopTablet    = isset( $attr['paddingBtnTopTablet'] ) ? $attr['paddingBtnTopTablet'] : $attr['vPaddingTablet'];
$btnPaddingBottomTablet = isset( $attr['paddingBtnBottomTablet'] ) ? $attr['paddingBtnBottomTablet'] : $attr['vPaddingTablet'];
$btnPaddingLeftTablet   = isset( $attr['paddingBtnLeftTablet'] ) ? $attr['paddingBtnLeftTablet'] : $attr['hPaddingTablet'];
$btnPaddingRightTablet  = isset( $attr['paddingBtnRightTablet'] ) ? $attr['paddingBtnRightTablet'] : $attr['hPaddingTablet'];

$gradientLocation1       = is_numeric( $attr['gradientLocation1'] ) ? $attr['gradientLocation1'] : '';
$gradientLocation2       = is_numeric( $attr['gradientLocation2'] ) ? $attr['gradientLocation2'] : '';
$gradientAngle           = is_numeric( $attr['gradientAngle'] ) ? $attr['gradientAngle'] : '';
$gradientLocationTablet1 = is_numeric( $attr['gradientLocationTablet1'] ) ? $attr['gradientLocationTablet1'] : $gradientLocation1;
$gradientLocationTablet2 = is_numeric( $attr['gradientLocationTablet2'] ) ? $attr['gradientLocationTablet2'] : $gradientLocation2;
$gradientAngleTablet     = is_numeric( $attr['gradientAngleTablet'] ) ? $attr['gradientAngleTablet'] : $gradientAngle;
$gradientLocationMobile1 = is_numeric( $attr['gradientLocationMobile1'] ) ? $attr['gradientLocationMobile1'] : $gradientLocationTablet1;
$gradientLocationMobile2 = is_numeric( $attr['gradientLocationMobile2'] ) ? $attr['gradientLocationMobile2'] : $gradientLocationTablet2;
$gradientAngleMobile     = is_numeric( $attr['gradientAngleMobile'] ) ? $attr['gradientAngleMobile'] : $gradientAngleTablet;

$iconColor       = ( '' === $attr['iconColor'] ) ? $attr['titleColor'] : $attr['iconColor'];
$iconHoverColor = ( '' === $attr['iconHoverColor'] ) ? $attr['titleHoverColor'] : $attr['iconHoverColor'];

$btnBorderCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn' );
$btnBorderCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$btnBorderCss,
	( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);
$btnBorderCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
$btnBorderCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'mobile' );


$iconSpacing        = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSpace'], 'px' );
$iconSpacingTablet = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSpaceTablet'], 'px' );
$iconSpacingMobile = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSpaceMobile'], 'px' );

$rightSideMargin = 'margin-right';
$leftSideMargin  = 'margin-left';

if ( ! is_rtl() ) {
	$rightSideMargin = 'margin-left';
	$leftSideMargin  = 'margin-right';
}

$selectors = [
	' .vxt-marketing-btn__prefix'         => [
		'margin-top' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpace'], $attr['titleSpaceUnit'] ),
	],
	'.vxt-marketing-btn__icon-after .vxt-marketing-btn__link svg' => [
		$rightSideMargin => $iconSpacing,
	],
	'.vxt-marketing-btn__icon-before .vxt-marketing-btn__link svg' => [
		$leftSideMargin => $iconSpacing,
	],
	'.vxt-marketing-btn__icon-after .vxt-marketing-btn__icon-wrap svg' => [ // For backword compatibility.
		$rightSideMargin => $iconSpacing,
	],
	'.vxt-marketing-btn__icon-before .vxt-marketing-btn__icon-wrap svg' => [ // For backword compatibility.
		$leftSideMargin => $iconSpacing,
	],
	' .vxt-marketing-btn__title-wrap'     => [ // For backword compatibility.
		'align-items' => 'center',
	],
	' .vxt-marketing-btn__title-wrap .vxt-marketing-btn__icon-wrap svg' => [ // For backword compatibility.
		'vertical-align' => 'sub',
	],
	' svg'                                 => [
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconFontSize'], $attr['iconFontSizeType'] ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconFontSize'], $attr['iconFontSizeType'] ),
	],
	' .vxt-marketing-btn__link svg'       => [
		'fill' => $iconColor,
	],
	' .vxt-marketing-btn__link:hover svg' => [
		'fill' => $iconHoverColor,
	],
	' .vxt-marketing-btn__link:focus svg' => [
		'fill' => $iconHoverColor,
	],
];

$mSelectors = [
	' svg'                         => [
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconFontSizeMobile'], $attr['iconFontSizeType'] ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconFontSizeMobile'], $attr['iconFontSizeType'] ),
	],
	'.vxt-marketing-btn__icon-after .vxt-marketing-btn__link svg' => [
		$rightSideMargin => $iconSpacingMobile,
	],
	'.vxt-marketing-btn__icon-before .vxt-marketing-btn__link svg' => [
		$leftSideMargin => $iconSpacingMobile,
	],
	' .vxt-marketing-btn__prefix' => [
		'margin-top' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpaceMobile'], 'px' ),
	],
];

$tSelectors = [
	' .vxt-marketing-btn__prefix'         => [
		'margin-top' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpaceTablet'], 'px' ),
	],
	' .wp-block-vxt-marketing-button svg' => [
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconFontSizeTablet'], $attr['iconFontSizeType'] ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconFontSizeTablet'], $attr['iconFontSizeType'] ),
	],
	'.vxt-marketing-btn__icon-after .vxt-marketing-btn__link svg' => [
		$leftSideMargin => $iconSpacingTablet,
	],
	'.vxt-marketing-btn__icon-before .vxt-marketing-btn__link svg' => [
		$rightSideMargin => $iconSpacingTablet,
	],
];

if ( ! $attr['inheritFromTheme'] ) { 
	if ( 'transparent' === $attr['backgroundType'] ) {

		$selectors[' .vxt-marketing-btn__link']['background'] = 'transparent';
		$selectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background'] = 'transparent';
	
	
	} elseif ( 'color' === $attr['backgroundType'] ) {
	
		$selectors['.wp-block-vxt-marketing-button.wp-block-button .wp-block-button__link.vxt-marketing-btn__link']['background'] = \Vexaltrix\Support\Helper::hex2rgba( $attr['backgroundColor'], $attr['backgroundOpacity'] );
	
		$selectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background-color'] = \Vexaltrix\Support\Helper::hex2rgba( $attr['backgroundColor'], $attr['backgroundOpacity'] );
	
		// Hover Background.
		$selectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) .wp-block-button__link.vxt-marketing-btn__link:hover']['background']   = \Vexaltrix\Support\Helper::hex2rgba( $attr['backgroundHoverColor'], $attr['backgroundHoverOpacity'] );
		$selectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) .wp-block-button__link.vxt-marketing-btn__link:focus']['background']   = \Vexaltrix\Support\Helper::hex2rgba( $attr['backgroundHoverColor'], $attr['backgroundHoverOpacity'] );
		$selectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) .wp-block-button__link.vxt-marketing-btn__link:hover']['border-color'] = \Vexaltrix\Support\Helper::hex2rgba( $attr['btnBorderHColor'] );
	
		// Deprecated for v1.2.6.
		$selectors[' .vxt-marketing-btn__link']['background'] = \Vexaltrix\Support\Helper::hex2rgba( $attr['backgroundColor'], $attr['backgroundOpacity'] );
	
		// Hover Background Deprecated for v1.2.6.
		$selectors[' .vxt-marketing-btn__link:hover']['background'] = \Vexaltrix\Support\Helper::hex2rgba( $attr['backgroundHoverColor'], $attr['backgroundHoverOpacity'] );
		$selectors[' .vxt-marketing-btn__link:focus']['background'] = \Vexaltrix\Support\Helper::hex2rgba( $attr['backgroundHoverColor'], $attr['backgroundHoverOpacity'] );
	
	} elseif ( 'gradient' === $attr['backgroundType'] ) {
	
		$selectors[' .vxt-marketing-btn__link']['background-color'] = 'transparent';
		$selectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background-color'] = 'transparent';
	
		$linearGradient        = 'linear-gradient(' . $attr['gradientAngle'] . 'deg, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor1'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocation1 . '%, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor2'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocation2 . '%)';
		$linearGradientTablet = 'linear-gradient(' . $attr['gradientAngleTablet'] . 'deg, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor1'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocationTablet1 . '%, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor2'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocationTablet2 . '%)';
		$linearGradientMobile = 'linear-gradient(' . $attr['gradientAngleMobile'] . 'deg, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor1'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocationMobile1 . '%, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor2'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocationMobile2 . '%)';
		$radialGradient        = 'radial-gradient( at center center, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor1'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocation1 . '%, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor2'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocation2 . '%)';
		$radialGradientTablet = 'radial-gradient( at center center, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor1'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocationTablet1 . '%, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor2'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocationTablet2 . '%)';
		$radialGradientMobile = 'radial-gradient( at center center, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor1'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocationMobile1 . '%, ' . \Vexaltrix\Support\Helper::hex2rgba( $attr['gradientColor2'], $attr['backgroundOpacity'] ) . ' ' . $gradientLocationMobile2 . '%)';

		if ( 'linear' === $attr['gradientType'] ) {
			$selectors[' .vxt-marketing-btn__link']['background-image'] = $linearGradient;
			$selectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background-image'] = $linearGradient;
			$tSelectors[' .vxt-marketing-btn__link']['background-image'] = $linearGradientTablet;
			$tSelectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background-image'] = $linearGradientTablet;
			$mSelectors[' .vxt-marketing-btn__link']['background-image'] = $linearGradientMobile;
			$mSelectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background-image'] = $linearGradientMobile;
		} else {
			$selectors[' .vxt-marketing-btn__link']['background-image'] = $radialGradient;
			$selectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background-image'] = $radialGradient;
			$tSelectors[' .vxt-marketing-btn__link']['background-image'] = $radialGradientTablet;
			$tSelectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background-image'] = $radialGradientTablet;
			$mSelectors[' .vxt-marketing-btn__link']['background-image'] = $radialGradientMobile;
			$mSelectors['.wp-block-vxt-marketing-button.wp-block-button:not(.is-style-outline) a.wp-block-button__link:not(.has-background)']['background-image'] = $radialGradientMobile;
		}
	}
	$selectors   = array_merge(
		$selectors,
		[
			' p.vxt-marketing-btn__prefix'    => [
				'color' => $attr['prefixColor'],
			],
			' .vxt-marketing-btn__link:hover p.vxt-marketing-btn__prefix' => [
				'color' => $attr['prefixHoverColor'],
			],
			' .vxt-marketing-btn__link:focus p.vxt-marketing-btn__prefix' => [
				'color' => $attr['prefixHoverColor'],
			],
			' .vxt-marketing-btn__link.wp-block-button__link' => array_merge(
				[
					'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeft, $attr['paddingBtnUnit'] ),
					'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRight, $attr['paddingBtnUnit'] ),
					'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTop, $attr['paddingBtnUnit'] ),
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottom, $attr['paddingBtnUnit'] ),
				],
				$btnBorderCss
			),
			' .vxt-marketing-btn__link:hover' => [
				'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['borderHoverColor'],
			],
			' .vxt-marketing-btn__link:focus' => [
				'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['borderHoverColor'],
			],
			' .vxt-marketing-btn__wrap .vxt-marketing-btn__link' => array_merge( // deprecated for v1.25.6 .
				[
					'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeft ? $btnPaddingLeft : 20, $attr['paddingBtnUnit'] ),
					'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRight ? $btnPaddingRight : 20, $attr['paddingBtnUnit'] ),
					'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTop ? $btnPaddingTop : 8, $attr['paddingBtnUnit'] ),
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottom ? $btnPaddingBottom : 8, $attr['paddingBtnUnit'] ),
				],
				$btnBorderCss
			),
			' .vxt-marketing-btn__link .vxt-marketing-btn__title' => [
				'color' => $attr['titleColor'],
			],
			' .vxt-marketing-btn__link:hover .vxt-marketing-btn__title' => [
				'color' => $attr['titleHoverColor'],
			],
			' .vxt-marketing-btn__link:focus .vxt-marketing-btn__title' => [
				'color' => $attr['titleHoverColor'],
			],
		]
	);
	$mSelectors = array_merge(
		$mSelectors,
		[
			'.wp-block-vxt-marketing-button.wp-block-button .vxt-marketing-btn__link' => array_merge(
				[
					'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeftMobile, $attr['mobilePaddingBtnUnit'] ),
					'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRightMobile, $attr['mobilePaddingBtnUnit'] ),
					'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTopMobile, $attr['mobilePaddingBtnUnit'] ),
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottomMobile, $attr['mobilePaddingBtnUnit'] ),
				],
				$btnBorderCssMobile
			),
			' .vxt-marketing-btn__wrap .vxt-marketing-btn__link' => array_merge( // deprecated for v1.25.6 .
				[
					'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeftMobile ? $btnPaddingLeftMobile : 20, $attr['paddingBtnUnit'] ),
					'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRightMobile ? $btnPaddingRightMobile : 20, $attr['paddingBtnUnit'] ),
					'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTopMobile ? $btnPaddingTopMobile : 8, $attr['paddingBtnUnit'] ),
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottomMobile ? $btnPaddingBottomMobile : 8, $attr['paddingBtnUnit'] ),
				],
				$btnBorderCssMobile
			),
		]
	);
	$tSelectors = array_merge(
		$tSelectors,
		[
			' .vxt-marketing-btn__link.wp-block-button__link' => array_merge(
				[
					'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeftTablet, $attr['tabletPaddingBtnUnit'] ),
					'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRightTablet, $attr['tabletPaddingBtnUnit'] ),
					'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTopTablet, $attr['tabletPaddingBtnUnit'] ),
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottomTablet, $attr['tabletPaddingBtnUnit'] ),
				],
				$btnBorderCssTablet
			),
			' .vxt-marketing-btn__wrap .vxt-marketing-btn__link' => array_merge( // deprecated for v1.25.6 .
				[
					'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeftTablet ? $btnPaddingLeftTablet : 20, $attr['paddingBtnUnit'] ),
					'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRightTablet ? $btnPaddingRightTablet : 20, $attr['paddingBtnUnit'] ),
					'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTopTablet ? $btnPaddingTopTablet : 8, $attr['paddingBtnUnit'] ),
					'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottomTablet ? $btnPaddingBottomTablet : 8, $attr['paddingBtnUnit'] ),
				],
				$btnBorderCssTablet
			),
	
		]
	);
	
}


$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

if ( ! $attr['inheritFromTheme'] ) {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'title', ' .vxt-marketing-btn__title', $combinedSelectors );
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'prefix', ' .vxt-marketing-btn__prefix', $combinedSelectors );
}

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-marketing-btn-';

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
