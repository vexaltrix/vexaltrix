<?php
/**
 * Frontend CSS File.
 *
 * @since 2.6.0
 *
 * @package ugb
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined else where.
 *
 * @var mixed[] $attr
 */

// Setup Defaults for Variants.
if ( 'banner' === $attr['variantType'] ) {
	$popupPositionV = ! empty( $attr['popupPositionV'] ) ? $attr['popupPositionV'] : 'flex-start';
	$popupPositionH = '';
} else {
	$popupPositionV = ! empty( $attr['popupPositionV'] ) ? $attr['popupPositionV'] : 'center';
	$popupPositionH = ! empty( $attr['popupPositionH'] ) ? $attr['popupPositionH'] : 'center';
}

// Border Attributes.
$contentBorderCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'content' );
$contentBorderCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'content', 'tablet' );
$contentBorderCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'content', 'mobile' );

// Background CSS.
$bgObjDesktop = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => $attr['backgroundImageDesktop'],
	'backgroundColor'          => $attr['backgroundColor'],
	'selectGradient'           => $attr['selectGradient'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientLocation1'        => $attr['gradientLocation1'],
	'gradientLocation2'        => $attr['gradientLocation2'],
	'gradientType'             => $attr['gradientType'],
	'gradientAngle'            => $attr['gradientAngle'],
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
$bgObjTablet  = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => ! empty( $attr['backgroundImageTablet'] ) ? $attr['backgroundImageTablet'] : $attr['backgroundImageDesktop'], // Tablet uses tablet image if it exists, otherwise fallback to desktop.
	'backgroundColor'          => $attr['backgroundColor'],
	'selectGradient'           => $attr['selectGradient'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientLocation1'        => is_numeric( $attr['gradientLocationTablet1'] ) ? $attr['gradientLocationTablet1'] : $bgObjDesktop['gradientLocation1'],
	'gradientLocation2'        => is_numeric( $attr['gradientLocationTablet2'] ) ? $attr['gradientLocationTablet2'] : $bgObjDesktop['gradientLocation2'],
	'gradientType'             => $attr['gradientType'],
	'gradientAngle'            => is_numeric( $attr['gradientAngleTablet'] ) ? $attr['gradientAngleTablet'] : $bgObjDesktop['gradientAngle'],
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
$bgObjMobile  = [
	'backgroundType'           => $attr['backgroundType'],
	'backgroundImage'          => ! empty( $attr['backgroundImageMobile'] ) ? $attr['backgroundImageMobile'] : ( ! empty( $attr['backgroundImageTablet'] ) ? $attr['backgroundImageTablet'] : $attr['backgroundImageDesktop'] ),
	'backgroundColor'          => $attr['backgroundColor'],
	'selectGradient'           => $attr['selectGradient'],
	'gradientValue'            => $attr['gradientValue'],
	'gradientColor1'           => $attr['gradientColor1'],
	'gradientColor2'           => $attr['gradientColor2'],
	'gradientLocation1'        => is_numeric( $attr['gradientLocationMobile1'] ) ? $attr['gradientLocationMobile1'] : $bgObjTablet['gradientLocation1'],
	'gradientLocation2'        => is_numeric( $attr['gradientLocationMobile2'] ) ? $attr['gradientLocationMobile2'] : $bgObjTablet['gradientLocation2'],
	'gradientType'             => $attr['gradientType'],
	'gradientAngle'            => is_numeric( $attr['gradientAngleMobile'] ) ? $attr['gradientAngleMobile'] : $bgObjTablet['gradientAngle'],
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

$popupBgCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjDesktop );
$popupBgCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjTablet );
$popupBgCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjMobile );

// Box Shadow CSS.
$boxShadowProperties       = [
	'horizontal' => $attr['boxShadowHOffset'],
	'vertical'   => $attr['boxShadowVOffset'],
	'blur'       => $attr['boxShadowBlur'],
	'spread'     => $attr['boxShadowSpread'],
	'color'      => $attr['boxShadowColor'],
	'position'   => $attr['boxShadowPosition'],
];
$boxShadowHoverProperties = [
	'horizontal' => $attr['boxShadowHOffsetHover'],
	'vertical'   => $attr['boxShadowVOffsetHover'],
	'blur'       => $attr['boxShadowBlurHover'],
	'spread'     => $attr['boxShadowSpreadHover'],
	'color'      => $attr['boxShadowColorHover'],
	'position'   => $attr['boxShadowPositionHover'],
	'alt_color'  => $attr['boxShadowColor'],
];

$boxShadowCss       = \Vexaltrix\Presentation\Blocks\BlockHelper::generateShadowCss( $boxShadowProperties );
$boxShadowHoverCss = \Vexaltrix\Presentation\Blocks\BlockHelper::generateShadowCss( $boxShadowHoverProperties );

$selectors = [
	'.vxt-popup-builder'                         => [
		'align-items'      => $popupPositionV,
		'justify-content'  => $popupPositionH,
		'background-color' => $attr['hasOverlay'] ? $attr['popupOverlayColor'] : '',
		'pointer-events'   => ( 'banner' === $attr['variantType'] || ( 'popup' === $attr['variantType'] && ! $attr['haltBackgroundInteraction'] ) ) ? 'none' : '',
	],
	' .vxt-popup-builder__wrapper'               => [
		'pointer-events' => 'auto',
	],
	' .vxt-popup-builder__wrapper--banner'       => [
		'height'     => $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeight'], $attr['popupHeightUnit'] ) : 'auto',
		'min-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeight'], $attr['popupHeightUnit'] ) : '',
	],
	' .vxt-popup-builder__wrapper--popup'        => [
		'height'     => $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeight'], $attr['popupHeightUnit'] ) : '',
		'max-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeight'], $attr['popupHeightUnit'] ) : '',
		'width'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupWidth'], $attr['popupWidthUnit'] ),
		'margin'     => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['popupMarginUnit'],
			$attr['popupMarginTop'],
			$attr['popupMarginRight'],
			$attr['popupMarginBottom'],
			$attr['popupMarginLeft']
		),
	],
	// Backward Compatibility - Close button CSS for v2.12.2 and below.
	' .vxt-popup-builder__close'                 => [
		'left'    => ( ( 'top-left' === $attr['closeIconPosition'] && ! is_rtl() ) || ( 'top-right' === $attr['closeIconPosition'] && is_rtl() ) ) ? 0 : '',
		'right'   => ( ( 'top-right' === $attr['closeIconPosition'] && ! is_rtl() ) || ( 'top-left' === $attr['closeIconPosition'] && is_rtl() ) ) ? 0 : '',
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['closePaddingUnit'],
			$attr['closePaddingTop'],
			$attr['closePaddingRight'],
			$attr['closePaddingBottom'],
			$attr['closePaddingLeft']
		),
	],
	// Backward Compatibility - Close button CSS for v2.12.2 and below.
	' .vxt-popup-builder__close svg'             => [
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'fill'        => $attr['closeIconColor'],
	],
	' button.vxt-popup-builder__close'           => [
		'left'    => ( ( 'top-left' === $attr['closeIconPosition'] && ! is_rtl() ) || ( 'top-right' === $attr['closeIconPosition'] && is_rtl() ) ) ? 0 : '',
		'right'   => ( ( 'top-right' === $attr['closeIconPosition'] && ! is_rtl() ) || ( 'top-left' === $attr['closeIconPosition'] && is_rtl() ) ) ? 0 : '',
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['closePaddingUnit'],
			$attr['closePaddingTop'],
			$attr['closePaddingRight'],
			$attr['closePaddingBottom'],
			$attr['closePaddingLeft']
		),
	],
	' button.vxt-popup-builder__close svg'       => [
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSize'], 'px' ),
		'fill'        => $attr['closeIconColor'],
	],
	' button.vxt-popup-builder__close:hover svg' => [
		'fill' => $attr['closeIconColorHover'],
	],
	' button.vxt-popup-builder__close:focus svg' => [
		'fill' => $attr['closeIconColorHover'],
	],
	' .vxt-popup-builder__container'             => array_merge(
		[
			'justify-content' => $attr['hasFixedHeight'] ? $attr['popupContentAlignmentV'] : '',
			'overflow-y'      => $attr['hasFixedHeight'] && ( 'center' === $attr['popupContentAlignmentV'] || 'flex-end' === $attr['popupContentAlignmentV'] ) ? 'hidden' : '',
			'box-shadow'      => $boxShadowCss,
			'padding'         => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
				$attr['popupPaddingUnit'],
				$attr['popupPaddingTop'],
				$attr['popupPaddingRight'],
				$attr['popupPaddingBottom'],
				$attr['popupPaddingLeft']
			),
		],
		$popupBgCss,
		$contentBorderCss
	),
	' .vxt-popup-builder__container:hover'       => [
		'box-shadow'   => $attr['useSeparateBoxShadows'] ? $boxShadowHoverCss : '',
		'border-color' => $attr['contentBorderHColor'],
	],
	' .vxt-popup-builder__container--banner'     => [
		'min-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeight'], $attr['popupHeightUnit'] ) : '',
	],
	' .vxt-popup-builder__container--popup'      => [
		'max-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeight'], $attr['popupHeightUnit'] ) : '',
	],
];

$tSelectors = [
	' .vxt-popup-builder__wrapper--banner'   => [
		'height'     => $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightTablet'], $attr['popupHeightUnitTablet'] ) : 'auto',
		'min-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightTablet'], $attr['popupHeightUnitTablet'] ) : '',
	],
	' .vxt-popup-builder__wrapper--popup'    => [
		'height'     => $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightTablet'], $attr['popupHeightUnitTablet'] ) : '',
		'max-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightTablet'], $attr['popupHeightUnitTablet'] ) : '',
		'width'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupWidthTablet'], $attr['popupWidthUnitTablet'] ),
		'margin'     => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['popupMarginUnitTablet'],
			$attr['popupMarginTopTablet'],
			$attr['popupMarginRightTablet'],
			$attr['popupMarginBottomTablet'],
			$attr['popupMarginLeftTablet']
		),
	],
	// Backward Compatibility - Close button CSS for v2.12.2 and below.
	' .vxt-popup-builder__close'             => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['closePaddingUnitTablet'],
			$attr['closePaddingTopTablet'],
			$attr['closePaddingRightTablet'],
			$attr['closePaddingBottomTablet'],
			$attr['closePaddingLeftTablet']
		),
	],
	// Backward Compatibility - Close button CSS for v2.12.2 and below.
	' .vxt-popup-builder__close svg'         => [
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeTablet'], 'px' ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeTablet'], 'px' ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeTablet'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeTablet'], 'px' ),
	],
	' button.vxt-popup-builder__close'       => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['closePaddingUnitTablet'],
			$attr['closePaddingTopTablet'],
			$attr['closePaddingRightTablet'],
			$attr['closePaddingBottomTablet'],
			$attr['closePaddingLeftTablet']
		),
	],
	' button.vxt-popup-builder__close svg'   => [
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeTablet'], 'px' ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeTablet'], 'px' ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeTablet'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeTablet'], 'px' ),
	],
	' .vxt-popup-builder__container'         => array_merge(
		[
			'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
				$attr['popupPaddingUnitTablet'],
				$attr['popupPaddingTopTablet'],
				$attr['popupPaddingRightTablet'],
				$attr['popupPaddingBottomTablet'],
				$attr['popupPaddingLeftTablet']
			),
		],
		$popupBgCssTablet,
		$contentBorderCssTablet
	),
	' .vxt-popup-builder__container--banner' => [
		'min-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightTablet'], $attr['popupHeightUnitTablet'] ) : '',
	],
	' .vxt-popup-builder__container--popup'  => [
		'max-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightTablet'], $attr['popupHeightUnitTablet'] ) : '',
	],
];
$mSelectors = [
	' .vxt-popup-builder__wrapper--banner'   => [
		'height'     => $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightMobile'], $attr['popupHeightUnitMobile'] ) : 'auto',
		'min-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightMobile'], $attr['popupHeightUnitMobile'] ) : '',
	],
	' .vxt-popup-builder__wrapper--popup'    => [
		'height'     => $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightMobile'], $attr['popupHeightUnitMobile'] ) : '',
		'max-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightMobile'], $attr['popupHeightUnitMobile'] ) : '',
		'width'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupWidthMobile'], $attr['popupWidthUnitMobile'] ),
		'margin'     => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['popupMarginUnitMobile'],
			$attr['popupMarginTopMobile'],
			$attr['popupMarginRightMobile'],
			$attr['popupMarginBottomMobile'],
			$attr['popupMarginLeftMobile']
		),
	],
	// Backward Compatibility - Close button CSS for v2.12.2 and below.
	' .vxt-popup-builder__close'             => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['closePaddingUnitMobile'],
			$attr['closePaddingTopMobile'],
			$attr['closePaddingRightMobile'],
			$attr['closePaddingBottomMobile'],
			$attr['closePaddingLeftMobile']
		),
	],
	// Backward Compatibility - Close button CSS for v2.12.2 and below.
	' .vxt-popup-builder__close svg'         => [
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeMobile'], 'px' ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeMobile'], 'px' ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeMobile'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeMobile'], 'px' ),
	],
	' button.vxt-popup-builder__close'       => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['closePaddingUnitMobile'],
			$attr['closePaddingTopMobile'],
			$attr['closePaddingRightMobile'],
			$attr['closePaddingBottomMobile'],
			$attr['closePaddingLeftMobile']
		),
	],
	' button.vxt-popup-builder__close svg'   => [
		'width'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeMobile'], 'px' ),
		'height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeMobile'], 'px' ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeMobile'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['closeIconSizeMobile'], 'px' ),
	],
	' .vxt-popup-builder__container'         => array_merge(
		[
			'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
				$attr['popupPaddingUnitMobile'],
				$attr['popupPaddingTopMobile'],
				$attr['popupPaddingRightMobile'],
				$attr['popupPaddingBottomMobile'],
				$attr['popupPaddingLeftMobile']
			),
		],
		$popupBgCssMobile,
		$contentBorderCssMobile
	),
	' .vxt-popup-builder__container--banner' => [
		'min-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightMobile'], $attr['popupHeightUnitMobile'] ) : '',
	],
	' .vxt-popup-builder__container--popup'  => [
		'max-height' => ! $attr['hasFixedHeight'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['popupHeightMobile'], $attr['popupHeightUnitMobile'] ) : '',
	],
];

// If Background Type or Background Image is not set, add the default background color.
// Tablet and Mobile Image Backgrounds are handled by the device hierarchy.
if ( 'none' === $attr['backgroundType'] || ( 'image' === $attr['backgroundType'] && ! $attr['backgroundImageDesktop'] ) ) {
	$selectors[' .vxt-popup-builder__container']['background-color'] = '#fff';
}

// If this is a Banner, add the required static CSS overrides.
if ( 'banner' === $attr['variantType'] ) {
	$selectors['.vxt-popup-builder']['width']  = '100%';
	$selectors['.vxt-popup-builder']['height'] = 'unset';
	// If this is a Push Banner, add the Push Banner CSS as well.
	if ( $attr['willPushContent'] ) {
		$selectors['.vxt-popup-builder']['align-items'] = 'flex-start';
		$selectors['.vxt-popup-builder']['position']    = 'relative';
		$selectors['.vxt-popup-builder']['transition']  = 'max-height 0.5s cubic-bezier(1, 0, 1, 1)';
		$selectors['.vxt-popup-builder']['max-height']  = 0;
		$selectors['.vxt-popup-builder']['opacity']     = 1;
		$selectors['.vxt-popup-builder']['z-index']     = 9999;
		// Else if this is not a Push Banner, add the Bottom Banner overrides if needed.
	} elseif ( 'flex-end' === $attr['popupPositionV'] ) {
		$selectors['.vxt-popup-builder']['top']    = 'unset';
		$selectors['.vxt-popup-builder']['bottom'] = 0;
	}
}

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getCombinedSelectors(
	'popup-builder', 
	[
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	],
	$attr
);

$blockSelector = '.vxt-block-' . $id;

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $blockSelector );
