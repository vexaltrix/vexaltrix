<?php
/**
 * Frontend CSS loading File.
 *
 * @since 2.2.0
 * @var mixed[] $attr
 * @var int $id
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksModalGfont( $attr );
$mSelectors        = [];
$tSelectors        = [];
$selectors          = [];
$isRtl             = is_rtl();
$btnFontSizeType = is_string( $attr['btnFontSizeType'] ) ? $attr['btnFontSizeType'] : '';
$btnIconSize      = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['btnFontSize'], $btnFontSizeType );
$tBtnIconSize    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['btnFontSizeTablet'], $btnFontSizeType );
$mBtnIconSize    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['btnFontSizeMobile'], $btnFontSizeType );

$btnBorderCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn' );
$btnBorderCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
$btnBorderCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'mobile' );

$contentBorderCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'content' );
$contentBorderCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'content', 'tablet' );
$contentBorderCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'content', 'mobile' );

$bgObjDesktop           = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => $attr['backgroundImageDesktop'],
	'backgroundColor'          => $attr['backgroundColor'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientType'             => $attr['gradientType'],
	'gradientLocation1'        => $attr['gradientLocation1'],
	'gradientLocation2'        => $attr['gradientLocation2'],
	'gradientAngle'            => $attr['gradientAngle'],
	'selectGradient'           => $attr['selectGradient'],
	'backgroundRepeat'         => $attr['backgroundRepeatDesktop'],
	'backgroundPosition'       => $attr['backgroundPositionDesktop'],
	'backgroundSize'           => $attr['backgroundSizeDesktop'],
	'backgroundAttachment'     => $attr['backgroundAttachmentDesktop'],
	'backgroundImageColor'     => $attr['backgroundImageColor'],
	'overlayType'              => $attr['overlayType'],
	'backgroundCustomSize'     => $attr['backgroundCustomSizeDesktop'],
	'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
	'customPosition'           => $attr['customPosition'],
	'xPosition'                => $attr['xPositionDesktop'],
	'xPositionType'            => $attr['xPositionType'],
	'yPosition'                => $attr['yPositionDesktop'],
	'yPositionType'            => $attr['yPositionType'],
];
$containerBgCssDesktop = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjDesktop );

$selectors                = [
	'.vxt-modal-popup .vxt-modal-popup-wrap'   => [
		'width'                      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalWidth'], $attr['modalWidthType'] ),
		'height'                     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalHeight'], $attr['modalHeightType'] ),
		'border-style'               => 'none',
		'border-color'               => 'none',
		'border-top-left-radius'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopLeftRadius'], $attr['contentBorderRadiusUnit'] ),
		'border-top-right-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopRightRadius'], $attr['contentBorderRadiusUnit'] ),
		'border-bottom-left-radius'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomLeftRadius'], $attr['contentBorderRadiusUnit'] ),
		'border-bottom-right-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomRightRadius'], $attr['contentBorderRadiusUnit'] ),
		'z-index'                    => '99999',
	],
	' .vxt-modal-popup-content:hover'           => [
		'border-color' => $attr['contentBorderHColor'],
	],
	' .vxt-modal-popup-close svg'               => [
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'fill'        => $attr['closeIconColor'],
	],
	' .vxt-modal-popup-close:focus svg'         => [
		'filter' => 'drop-shadow(0 0 1px ' . $attr['closeIconColor'] . ')',
	],
	'.vxt-modal-popup.active'                   => [
		'background' => $attr['overlayColor'],
		'z-index'    => '99999',
	],
	' .vxt-modal-popup-content'                 => array_merge(
		[
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalLeft'], $attr['paddingModalUnit'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalRight'], $attr['paddingModalUnit'] ),
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalTop'], $attr['paddingModalUnit'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalBottom'], $attr['paddingModalUnit'] ),
		],
		$contentBorderCss,
		$containerBgCssDesktop
),
	' .vxt-modal-trigger svg'                   => [
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], 'px' ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], 'px' ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconSize'], 'px' ),
		'fill'        => $attr['iconColor'],
	],
	' .vxt-modal-text.vxt-modal-trigger'       => [
		'color' => $attr['textColor'],
	],
	'.vxt-modal-wrapper img.vxt-modal-trigger' => [
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['iconimgBorderRadius'], $attr['iconimgBorderRadiusUnit'] ),
	],
];
$bgObjTablet            = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => ! empty( $attr['backgroundImageTablet'] ) ? $attr['backgroundImageTablet'] : $attr['backgroundImageDesktop'], // Tablet uses tablet image if it exists, otherwise fallback to desktop.
	'backgroundColor'          => $attr['backgroundColor'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientType'             => $attr['gradientType'],
	'gradientLocation1'        => is_numeric( $attr['gradientLocationTablet1'] ) ? $attr['gradientLocationTablet1'] : $bgObjDesktop['gradientLocation1'],
	'gradientLocation2'        => is_numeric( $attr['gradientLocationTablet2'] ) ? $attr['gradientLocationTablet2'] : $bgObjDesktop['gradientLocation2'],
	'gradientAngle'            => is_numeric( $attr['gradientAngleTablet'] ) ? $attr['gradientAngleTablet'] : $bgObjDesktop['gradientAngle'],
	'selectGradient'           => $attr['selectGradient'],
	'backgroundRepeat'         => $attr['backgroundRepeatTablet'],
	'backgroundPosition'       => $attr['backgroundPositionTablet'],
	'backgroundSize'           => $attr['backgroundSizeTablet'],
	'backgroundAttachment'     => $attr['backgroundAttachmentTablet'],
	'backgroundImageColor'     => $attr['backgroundImageColor'],
	'overlayType'              => $attr['overlayType'],
	'backgroundCustomSize'     => $attr['backgroundCustomSizeTablet'],
	'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
	'customPosition'           => $attr['customPosition'],
	'xPosition'                => $attr['xPositionTablet'],
	'xPositionType'            => $attr['xPositionTypeTablet'],
	'yPosition'                => $attr['yPositionTablet'],
	'yPositionType'            => $attr['yPositionTypeTablet'],
];
$containerBgCssTablet  = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjTablet );
$modalWidthTypeTablet  = '' !== $attr['modalWidthTypeTablet'] ? $attr['modalWidthTypeTablet'] : $attr['modalWidthType'];
$modalHeightTypeTablet = '' !== $attr['modalHeightTypeTablet'] ? $attr['modalHeightTypeTablet'] : $attr['modalHeightType'];
$tSelectors              = [
	'.vxt-modal-wrapper'                      => [
		'text-align' => $attr['modalAlignTablet'],
	],
	'.vxt-modal-popup .vxt-modal-popup-wrap' => [
		'width'                      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalWidthTablet'], $modalWidthTypeTablet ),
		'height'                     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalHeightTablet'], $modalHeightTypeTablet ),
		'border-style'               => 'none',
		'border-color'               => 'none',
		'border-top-left-radius'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopLeftRadiusTablet'], $attr['contentBorderRadiusUnitTablet'] ),
		'border-top-right-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopRightRadiusTablet'], $attr['contentBorderRadiusUnitTablet'] ),
		'border-bottom-left-radius'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomLeftRadiusTablet'], $attr['contentBorderRadiusUnitTablet'] ),
		'border-bottom-right-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomRightRadiusTablet'], $attr['contentBorderRadiusUnitTablet'] ),
	],
	' .vxt-modal-popup-content'               => array_merge(
		[
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalLeftTablet'], $attr['tabletPaddingModalUnit'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalRightTablet'], $attr['tabletPaddingModalUnit'] ),
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalTopTablet'], $attr['tabletPaddingModalUnit'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalBottomTablet'], $attr['tabletPaddingModalUnit'] ),
		],
		$contentBorderCssTablet,
		$containerBgCssTablet
	),
];
// Mobile fallback chain: Mobile → Tablet → Desktop.
$mobileBgImage = $attr['backgroundImageDesktop']; // Default fallback.
if ( ! empty( $attr['backgroundImageMobile'] ) ) {
	$mobileBgImage = $attr['backgroundImageMobile'];
} elseif ( ! empty( $attr['backgroundImageTablet'] ) ) {
	$mobileBgImage = $attr['backgroundImageTablet'];
}

$bgObjMobile            = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => $mobileBgImage,
	'backgroundColor'          => $attr['backgroundColor'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientType'             => $attr['gradientType'],
	'gradientLocation1'        => is_numeric( $attr['gradientLocationMobile1'] ) ? $attr['gradientLocationMobile1'] : $bgObjTablet['gradientLocation1'],
	'gradientLocation2'        => is_numeric( $attr['gradientLocationMobile2'] ) ? $attr['gradientLocationMobile2'] : $bgObjTablet['gradientLocation2'],
	'gradientAngle'            => is_numeric( $attr['gradientAngleMobile'] ) ? $attr['gradientAngleMobile'] : $bgObjTablet['gradientAngle'],
	'selectGradient'           => $attr['selectGradient'],
	'backgroundRepeat'         => $attr['backgroundRepeatMobile'],
	'backgroundPosition'       => $attr['backgroundPositionMobile'],
	'backgroundSize'           => $attr['backgroundSizeMobile'],
	'backgroundAttachment'     => $attr['backgroundAttachmentMobile'],
	'backgroundImageColor'     => $attr['backgroundImageColor'],
	'overlayType'              => $attr['overlayType'],
	'backgroundCustomSize'     => $attr['backgroundCustomSizeMobile'],
	'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
	'customPosition'           => $attr['customPosition'],
	'xPosition'                => $attr['xPositionMobile'],
	'xPositionType'            => $attr['xPositionTypeMobile'],
	'yPosition'                => $attr['yPositionMobile'],
	'yPositionType'            => $attr['yPositionTypeMobile'],
];
$containerBgCssMobile  = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjMobile );
$modalWidthTypeMobile  = '' !== $attr['modalWidthTypeMobile'] ? $attr['modalWidthTypeMobile'] : $attr['modalWidthType'];
$modalHeightTypeMobile = '' !== $attr['modalHeightTypeMobile'] ? $attr['modalHeightTypeMobile'] : $attr['modalHeightType'];
$mSelectors              = [
	'.vxt-modal-wrapper'                      => [
		'text-align' => $attr['modalAlignMobile'],
	],
	'.vxt-modal-popup .vxt-modal-popup-wrap' => [
		'width'                      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalWidthMobile'], $modalWidthTypeMobile ),
		'height'                     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalHeightMobile'], $modalHeightTypeMobile ),
		'border-style'               => 'none',
		'border-color'               => 'none',
		'border-top-left-radius'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopLeftRadiusMobile'], $attr['contentBorderRadiusUnitMobile'] ),
		'border-top-right-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopRightRadiusMobile'], $attr['contentBorderRadiusUnitMobile'] ),
		'border-bottom-left-radius'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomLeftRadiusMobile'], $attr['contentBorderRadiusUnitMobile'] ),
		'border-bottom-right-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomRightRadiusMobile'], $attr['contentBorderRadiusUnitMobile'] ),
	],
	' .vxt-modal-popup-content'               => array_merge(
		[
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalLeftMobile'], $attr['mobilePaddingModalUnit'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalRightMobile'], $attr['mobilePaddingModalUnit'] ),
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalTopMobile'], $attr['mobilePaddingModalUnit'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingModalBottomMobile'], $attr['mobilePaddingModalUnit'] ),
		],
		$contentBorderCssMobile,
		$containerBgCssMobile
	),
];

if ( ! $attr['inheritFromTheme'] ) {
	$selectors[' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger']   = $btnBorderCss;
	$tSelectors[' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger'] = $btnBorderCssTablet;
	$mSelectors[' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger'] = $btnBorderCssMobile;
	$selectors = array_merge(
		$selectors,
		[
			'.vxt-modal-wrapper .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger' => [
				'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnLeft'], $attr['paddingBtnUnit'] ),
				'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnRight'], $attr['paddingBtnUnit'] ),
				'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnTop'], $attr['paddingBtnUnit'] ),
				'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnBottom'], $attr['paddingBtnUnit'] ),
				'color'            => $attr['btnLinkColor'],
				'background-color' => ( 'color' === $attr['modalTriggerBgType'] ) ? $attr['btnBgColor'] : 'transparent',
			],
			' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger:hover' => [
				'color'            => $attr['btnLinkHoverColor'] ? $attr['btnLinkHoverColor'] : $attr['btnLinkColor'],
				'background-color' => ( 'color' === $attr['modalTriggerBgHoverType'] ) ? $attr['btnBgHoverColor'] : 'transparent',
				'border-color'     => $attr['btnBorderHColor'],
			],
			' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger:focus' => [
				'color'            => $attr['btnLinkHoverColor'] ? $attr['btnLinkHoverColor'] : $attr['btnLinkColor'],
				'background-color' => ( 'color' === $attr['modalTriggerBgHoverType'] ) ? $attr['btnBgHoverColor'] : 'transparent',
				'border-color'     => $attr['btnBorderHColor'],
			],
			' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger svg' => [
				'width'       => $btnIconSize,
				'height'      => $btnIconSize,
				'line-height' => $btnIconSize,
				'font-size'   => $btnIconSize,
				'fill'        => $attr['btnLinkColor'],
			],
			' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger:hover svg' => [
				'fill' => $attr['btnLinkHoverColor'],
			],
			' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger:focus svg' => [
				'fill' => $attr['btnLinkHoverColor'],
			],
		]
	);

	$tSelectors = array_merge( 
		$tSelectors,
		[
			'.vxt-modal-wrapper .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger' => [
				'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnLeftTablet'], $attr['tabletPaddingBtnUnit'] ),
				'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnRightTablet'], $attr['tabletPaddingBtnUnit'] ),
				'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnTopTablet'], $attr['tabletPaddingBtnUnit'] ),
				'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnBottomTablet'], $attr['tabletPaddingBtnUnit'] ),
			],
			' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger svg' => [
				'width'       => $tBtnIconSize,
				'height'      => $tBtnIconSize,
				'line-height' => $tBtnIconSize,
				'font-size'   => $tBtnIconSize,
			],
		]
	);

	$mSelectors = array_merge(
		$mSelectors,
		[
			'.vxt-modal-wrapper .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger' => [
				'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnLeftMobile'], $attr['mobilePaddingBtnUnit'] ),
				'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnRightMobile'], $attr['mobilePaddingBtnUnit'] ),
				'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnTopMobile'], $attr['mobilePaddingBtnUnit'] ),
				'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnBottomMobile'], $attr['mobilePaddingBtnUnit'] ),
			],
			' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger svg' => [
				'width'       => $mBtnIconSize,
				'height'      => $mBtnIconSize,
				'line-height' => $mBtnIconSize,
				'font-size'   => $mBtnIconSize,
			],
		]
	);

}

if ( 'popup-top-right' === $attr['closeIconPosition'] ) {
	$selectors['.vxt-modal-popup.active .vxt-modal-popup-close'] = [
		'top'   => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'right' => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
	];
}

if ( 'popup-top-left' === $attr['closeIconPosition'] ) {
	$selectors['.vxt-modal-popup.active .vxt-modal-popup-close'] = [
		'top'  => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'left' => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
	];
}

$attr['buttonIconSpaceTablet'] = is_numeric( $attr['buttonIconSpaceTablet'] ) ? $attr['buttonIconSpaceTablet'] : $attr['buttonIconSpace'];
$attr['buttonIconSpaceMobile'] = is_numeric( $attr['buttonIconSpaceMobile'] ) ? $attr['buttonIconSpaceMobile'] : $attr['buttonIconSpaceTablet'];

if ( 'button' === $attr['modalTrigger'] ) {
	if ( 'after' === $attr['buttonIconPosition'] ) {
		$selectors[' .vxt-modal-button-link svg ']   = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpace'], $attr['buttonIconSpaceType'] ),
		];
		$tSelectors[' .vxt-modal-button-link svg '] = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpaceTablet'], $attr['buttonIconSpaceType'] ),
		];
		$mSelectors[' .vxt-modal-button-link svg '] = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpaceMobile'], $attr['buttonIconSpaceType'] ),
		];
	} else {
		$selectors[' .vxt-modal-button-link svg']   = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpace'], $attr['buttonIconSpaceType'] ),
		];
		$tSelectors[' .vxt-modal-button-link svg'] = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpaceTablet'], $attr['buttonIconSpaceType'] ),
		];
		$mSelectors[' .vxt-modal-button-link svg'] = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpaceMobile'], $attr['buttonIconSpaceType'] ),
		];
	}
}

if ( $isRtl ) {
	if ( 'button' === $attr['modalTrigger'] ) {
		if ( 'after' === $attr['buttonIconPosition'] ) {
			$selectors[' .vxt-modal-button-link svg ']   = [
				'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpace'], $attr['buttonIconSpaceType'] ),
			];
			$tSelectors[' .vxt-modal-button-link svg '] = [
				'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpaceTablet'], $attr['buttonIconSpaceType'] ),
			];
			$mSelectors[' .vxt-modal-button-link svg '] = [
				'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpaceMobile'], $attr['buttonIconSpaceType'] ),
			];
		} else {
			$selectors[' .vxt-modal-button-link svg']   = [
				'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpace'], $attr['buttonIconSpaceType'] ),
			];
			$tSelectors[' .vxt-modal-button-link svg'] = [
				'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpaceTablet'], $attr['buttonIconSpaceType'] ),
			];
			$mSelectors[' .vxt-modal-button-link svg'] = [
				'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonIconSpaceMobile'], $attr['buttonIconSpaceType'] ),
			];
		}
	}
}

if ( 'image' === $attr['modalTrigger'] && $attr['imageWidthType'] ) {
	// Image.
	$selectors[' img.vxt-modal-trigger']   = [
		'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthUnit'] ),
	];
	$tSelectors[' img.vxt-modal-trigger'] = [
		'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthUnitTablet'] ),
	];
	$mSelectors[' img.vxt-modal-trigger'] = [
		'width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthUnitMobile'] ),
	];

}

if ( 'custom' !== $attr['modalBoxHeight'] ) {
	$selectors['.vxt-modal-popup .vxt-modal-popup-wrap']   = [
		'height'                     => 'auto',
		'width'                      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalWidth'], $attr['modalWidthType'] ),
		'max-height'                 => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['maxHeight'], $attr['maxHeightType'] ),
		'border-style'               => 'none',
		'border-color'               => 'none',
		'border-top-left-radius'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopLeftRadius'], $attr['contentBorderRadiusUnit'] ),
		'border-top-right-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopRightRadius'], $attr['contentBorderRadiusUnit'] ),
		'border-bottom-left-radius'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomLeftRadius'], $attr['contentBorderRadiusUnit'] ),
		'border-bottom-right-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomRightRadius'], $attr['contentBorderRadiusUnit'] ),
	];
	$tSelectors['.vxt-modal-popup .vxt-modal-popup-wrap'] = [
		'height'                     => 'auto',
		'width'                      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalWidthTablet'], $modalWidthTypeTablet ),
		'max-height'                 => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['maxHeightTablet'], $attr['maxHeightType'] ),
		'border-style'               => 'none',
		'border-color'               => 'none',
		'border-top-left-radius'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopLeftRadiusTablet'], $attr['contentBorderRadiusUnitTablet'] ),
		'border-top-right-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopRightRadiusTablet'], $attr['contentBorderRadiusUnitTablet'] ),
		'border-bottom-left-radius'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomLeftRadiusTablet'], $attr['contentBorderRadiusUnitTablet'] ),
		'border-bottom-right-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomRightRadiusTablet'], $attr['contentBorderRadiusUnitTablet'] ),
	];
	$mSelectors['.vxt-modal-popup .vxt-modal-popup-wrap'] = [
		'height'                     => 'auto',
		'width'                      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['modalWidthMobile'], $modalWidthTypeMobile ),
		'max-height'                 => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['maxHeightMobile'], $attr['maxHeightType'] ),
		'border-style'               => 'none',
		'border-color'               => 'none',
		'border-top-left-radius'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopLeftRadiusMobile'], $attr['contentBorderRadiusUnitMobile'] ),
		'border-top-right-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderTopRightRadiusMobile'], $attr['contentBorderRadiusUnitMobile'] ),
		'border-bottom-left-radius'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomLeftRadiusMobile'], $attr['contentBorderRadiusUnitMobile'] ),
		'border-bottom-right-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['contentBorderBottomRightRadiusMobile'], $attr['contentBorderRadiusUnitMobile'] ),
	];
}

$flexAlignment   = ( 'left' === $attr['modalAlign'] ) ? 'flex-start' : ( ( 'right' === $attr['modalAlign'] ) ? 'flex-end' : 'center' );
$tFlexAlignment = ( 'left' === $attr['modalAlignTablet'] ) ? 'flex-start' : ( ( 'right' === $attr['modalAlignTablet'] ) ? 'flex-end' : 'center' );
$mFlexAlignment = ( 'left' === $attr['modalAlignMobile'] ) ? 'flex-start' : ( ( 'right' === $attr['modalAlignMobile'] ) ? 'flex-end' : 'center' );

if ( 'full' !== $attr['modalAlign'] ) {
	$selectors['.vxt-modal-wrapper']     = [
		'text-align' => $attr['modalAlign'],
	];
	$selectors[' .wp-block-button__link'] = [
		'width' => 'unset',
	];
	$selectors[' .vxt-modal-trigger']    = [
		'justify-content' => $flexAlignment,
	];
	if ( 'image' === $attr['modalTrigger'] ) {
		$selectors['.vxt-modal-wrapper .vxt-editor-wrap'] = [
			'display'         => 'flex',
			'justify-content' => $flexAlignment,
		];
	}
} else {
	$selectors[' .vxt-modal-trigger'] = [
		'width'           => '100%',
		'justify-content' => 'center',
	];
}

if ( 'full' !== $attr['modalAlignMobile'] ) {
	$mSelectors['.vxt-modal-wrapper']     = [
		'text-align' => $attr['modalAlignMobile'],
	];
	$mSelectors[' .wp-block-button__link'] = [
		'width' => 'unset',
	];
	$mSelectors[' .vxt-modal-trigger']    = [
		'justify-content' => $mFlexAlignment,
	];
	if ( 'image' === $attr['modalTrigger'] ) {
		$mSelectors['.vxt-modal-wrapper .vxt-editor-wrap'] = [
			'display'         => 'flex',
			'justify-content' => $mFlexAlignment,
		];
	}
} else {
	$mSelectors[' .wp-block-button__link.vxt-modal-trigger'] = [
		'width'           => '100%',
		'justify-content' => 'center',
	];
}

if ( 'full' !== $attr['modalAlignTablet'] ) {
	$tSelectors['.vxt-modal-wrapper']  = [
		'text-align' => $attr['modalAlignTablet'],
	];
	$tSelectors[' .vxt-modal-trigger'] = [
		'justify-content' => $tFlexAlignment,
	];
	if ( 'image' === $attr['modalTrigger'] ) {
		$tSelectors['.vxt-modal-wrapper .vxt-editor-wrap'] = [
			'display'         => 'flex',
			'justify-content' => $tFlexAlignment,
		];
	}
} else {
	$tSelectors[' .wp-block-button__link.vxt-modal-trigger'] = [
		'width'           => '100%',
		'justify-content' => 'center',
	];
}

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getCombinedSelectors(
	'modal',
	[
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	],
	$attr
);

$baseSelector = '.vxt-block-';

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'text', ' .vxt-modal-text.vxt-modal-trigger', $combinedSelectors );
if ( ! $attr['inheritFromTheme'] ) {
	$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'btn', ' .vxt-button-wrapper .vxt-modal-button-link.vxt-modal-trigger', $combinedSelectors );
}
return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
