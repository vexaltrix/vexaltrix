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

if ( ! function_exists( 'generateBackgroundObject' ) ) {
	/**
	 * Generate background object for a specific device
	 *
	 * @since 2.19.8
	 *
	 * @param array  $attr Block attributes.
	 * @param string $fallbackImage Fallback image URL.
	 * @param string $device Device type (desktop, tablet, mobile).
	 * @return array Background object.
	 */
	function generateBackgroundObject( $attr, $fallbackImage, $device = 'desktop' ) {
		$suffix = ucfirst( $device );
		$suffix = 'desktop' === $device ? '' : $suffix;

		// Safely get values with defaults.
		$backgroundRepeat         = isset( $attr[ 'backgroundRepeat' . $suffix ] ) ? $attr[ 'backgroundRepeat' . $suffix ] : 'no-repeat';
		$backgroundPosition       = isset( $attr[ 'backgroundPosition' . $suffix ] ) ? $attr[ 'backgroundPosition' . $suffix ] : 'center';
		$backgroundSize           = isset( $attr[ 'backgroundSize' . $suffix ] ) ? $attr[ 'backgroundSize' . $suffix ] : 'cover';
		$backgroundAttachment     = isset( $attr[ 'backgroundAttachment' . $suffix ] ) ? $attr[ 'backgroundAttachment' . $suffix ] : 'scroll';
		$backgroundCustomSize     = isset( $attr[ 'backgroundCustomSize' . $suffix ] ) ? $attr[ 'backgroundCustomSize' . $suffix ] : '';
		$backgroundImageColor     = isset( $attr['backgroundImageColor'] ) ? $attr['backgroundImageColor'] : '';
		$overlayType              = isset( $attr['overlayType'] ) ? $attr['overlayType'] : 'none';
		$backgroundCustomSizeType = isset( $attr['backgroundCustomSizeType'] ) ? $attr['backgroundCustomSizeType'] : 'px';

		return [
			'backgroundType'           => 'image',
			'backgroundImage'          => [
				'type' => 'image',
				'url'  => $fallbackImage,
			],
			'backgroundRepeat'         => $backgroundRepeat,
			'backgroundPosition'       => $backgroundPosition,
			'backgroundSize'           => $backgroundSize,
			'backgroundAttachment'     => $backgroundAttachment,
			'backgroundImageColor'     => $backgroundImageColor,
			'overlayType'              => $overlayType,
			'backgroundCustomSize'     => $backgroundCustomSize,
			'backgroundCustomSizeType' => $backgroundCustomSizeType,
		];
	}
}

// For Global Block Styles.
$baseSelector = ! empty( $isGbs ) && ! empty( $gbsClass ) ? $gbsClass : '.vxt-block-' . $id;

$innerContentCustomWidthTabletFallback = is_numeric( $attr['innerContentCustomWidthTablet'] ) ? $attr['innerContentCustomWidthTablet'] : $attr['innerContentCustomWidthDesktop'];
$innerContentCustomWidthMobileFallback = is_numeric( $attr['innerContentCustomWidthMobile'] ) ? $attr['innerContentCustomWidthMobile'] : $innerContentCustomWidthTabletFallback;

$boxShadowPositionCss = $attr['boxShadowPosition'];

if ( 'outset' === $attr['boxShadowPosition'] ) {
	$boxShadowPositionCss = '';
}

$boxShadowPositionCssHover = $attr['boxShadowPositionHover'];

if ( 'outset' === $attr['boxShadowPositionHover'] ) {
	$boxShadowPositionCssHover = '';
}

$border        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'container' );
$borderTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'container', 'tablet' );
$borderMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'container', 'mobile' );

// If there's no border-color, set it to inherit.
if ( empty( $border['border-color'] ) ) {
	$border['border-color'] = 'inherit';
}

$containerBgOverlayCss        = [];
$containerBgOverlayCssMobile = [];
$containerBgOverlayCssTablet = [];

// When overlay is present, we need to handle background differently.
if ( $attr['overlayType'] && 'none' !== $attr['overlayType'] ) {
	// For overlay, we need to get the background CSS without the overlay merged in.
	// We'll handle the overlay separately for the ::before pseudo-element.
	$tempAttr                = $attr;
	$tempAttr['overlayType'] = 'none'; // Temporarily disable overlay to get just the background.
	
	$containerBgCssDesktop = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $tempAttr );
	$containerBgCssTablet  = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $tempAttr, 'Tablet' );
	$containerBgCssMobile  = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $tempAttr, 'Mobile' );
	
	// Get the overlay CSS for the pseudo-element.
	$containerBgOverlayCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $attr, 'Desktop', 'yes' );
	$containerBgOverlayCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $attr, 'Tablet', 'yes' );
	$containerBgOverlayCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $attr, 'Mobile', 'yes' );
} else {
	// No overlay, use the regular background CSS.
	$containerBgCssDesktop = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $attr );
	$containerBgCssTablet  = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $attr, 'Tablet' );
	$containerBgCssMobile  = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $attr, 'Mobile' );
}

$videoBgCss = \Vexaltrix\Presentation\Blocks\BlockHelper::getBackgroundCssByDevice( $attr, 'Desktop', 'no' );

// Tablet.
$leftPaddingTablet   = '' !== $attr['leftPaddingTablet'] ? $attr['leftPaddingTablet'] : $attr['leftPaddingDesktop'];
$rightPaddingTablet  = '' !== $attr['rightPaddingTablet'] ? $attr['rightPaddingTablet'] : $attr['rightPaddingDesktop'];
$topPaddingTablet    = '' !== $attr['topPaddingTablet'] ? $attr['topPaddingTablet'] : $attr['topPaddingDesktop'];
$bottomPaddingTablet = '' !== $attr['bottomPaddingTablet'] ? $attr['bottomPaddingTablet'] : $attr['bottomPaddingDesktop'];

$leftMarginTablet   = '' !== $attr['leftMarginTablet'] ? $attr['leftMarginTablet'] : $attr['leftMarginDesktop'];
$rightMarginTablet  = '' !== $attr['rightMarginTablet'] ? $attr['rightMarginTablet'] : $attr['rightMarginDesktop'];
$topMarginTablet    = '' !== $attr['topMarginTablet'] ? $attr['topMarginTablet'] : $attr['topMarginDesktop'];
$bottomMarginTablet = '' !== $attr['bottomMarginTablet'] ? $attr['bottomMarginTablet'] : $attr['bottomMarginDesktop'];

$columnGapTablet = ! empty( $attr['columnGapTablet'] ) ? $attr['columnGapTablet'] : $attr['columnGapDesktop'];

// Mobile.
$leftPaddingMobile   = '' !== $attr['leftPaddingMobile'] ? $attr['leftPaddingMobile'] : $leftPaddingTablet;
$rightPaddingMobile  = '' !== $attr['rightPaddingMobile'] ? $attr['rightPaddingMobile'] : $rightPaddingTablet;
$topPaddingMobile    = '' !== $attr['topPaddingMobile'] ? $attr['topPaddingMobile'] : $topPaddingTablet;
$bottomPaddingMobile = '' !== $attr['bottomPaddingMobile'] ? $attr['bottomPaddingMobile'] : $bottomPaddingTablet;

$leftMarginMobile   = '' !== $attr['leftMarginMobile'] ? $attr['leftMarginMobile'] : $leftMarginTablet;
$rightMarginMobile  = '' !== $attr['rightMarginMobile'] ? $attr['rightMarginMobile'] : $rightMarginTablet;
$topMarginMobile    = '' !== $attr['topMarginMobile'] ? $attr['topMarginMobile'] : $topMarginTablet;
$bottomMarginMobile = '' !== $attr['bottomMarginMobile'] ? $attr['bottomMarginMobile'] : $bottomMarginTablet;

$columnGapMobile = ! empty( $attr['columnGapMobile'] ) ? $attr['columnGapMobile'] : $columnGapTablet;

$orderTablet = 'initial' !== $attr['orderTablet'] ? $attr['orderTablet'] : $attr['orderDesktop'];
$orderMobile = 'initial' !== $attr['orderMobile'] ? $attr['orderMobile'] : $orderTablet;

$customOrderTablet = '' !== $attr['customOrderTablet'] ? $attr['customOrderTablet'] : $attr['customOrderDesktop'];
$customOrderMobile = '' !== $attr['customOrderMobile'] ? $attr['customOrderMobile'] : $customOrderTablet;

$isLayoutGrid        = 'grid' === $attr['layout'];
$hasInnerBlocksWrap = 'alignwide' === $attr['innerContentWidth'] && 'alignfull' === $attr['contentWidth'];

$shouldMergeInnerContainerCss = ( $attr['isBlockRootParent'] && ! $hasInnerBlocksWrap ) || ! $attr['isBlockRootParent'] || 'alignwide' !== $attr['innerContentWidth'];

$containerCss       = array_merge(
	[
		'min-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeightDesktop'], $attr['minHeightType'] ),
		'box-shadow'     =>
				\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) .
				' ' .
				\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) .
				' ' .
				\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) .
				' ' .
				\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) .
				' ' .
				$attr['boxShadowColor'] .
				' ' .
				$boxShadowPositionCss,
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingDesktop'], $attr['paddingType'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingDesktop'], $attr['paddingType'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingDesktop'], $attr['paddingType'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingDesktop'], $attr['paddingType'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginDesktop'], $attr['marginType'] ) . ' !important',
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginDesktop'], $attr['marginType'] ) . ' !important',
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginDesktop'], $attr['marginType'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginDesktop'], $attr['marginType'] ),
		'overflow'       => $attr['overflow'],
		'order'          => 'custom' === $attr['orderDesktop'] ? $attr['customOrderDesktop'] : $attr['orderDesktop'],
	],
	$border
);
$containerCss       = array_merge( $containerCss, $containerBgCssDesktop );
$innerContainerCss = [
	'flex-direction'  => $attr['directionDesktop'],
	'align-items'     => $attr['alignItemsDesktop'],
	'justify-content' => $attr['justifyContentDesktop'],
	'flex-wrap'       => $attr['wrapDesktop'],
	'align-content'   => $attr['alignContentDesktop'],
];

// Keeping $inner_container_css empty array because it will be used when layout is grid.
if ( $isLayoutGrid ) {
	$innerContainerCss = [];
}

if ( $shouldMergeInnerContainerCss ) {
	$containerCss = array_merge( $containerCss, $innerContainerCss );
}

// Handle backward opacity for video.
// If this was saved in the updated version, backgroundVideoOpacity will be 0, and this will be skipped.
if ( 'video' === $attr['backgroundType'] && ! empty( $attr['backgroundVideoOpacity'] ) ) {
	$attr['overlayOpacity'] = $attr['backgroundVideoOpacity'];
}

$backgroundVideoOpacityValue = ( isset( $attr['overlayOpacity'] ) && 'none' !== $attr['overlayType'] && ( ( 'color' === $attr['overlayType'] && ! empty( $attr['backgroundVideoColor'] ) ) || ( 'gradient' === $attr['overlayType'] && ! empty( $attr['gradientValue'] ) ) ) ) ? 1 - $attr['overlayOpacity'] : 1;
$bgVideoImageFallback        = ! empty( $attr['backgroundVideoFallbackImage']['url'] ) ? $attr['backgroundVideoFallbackImage']['url'] : '';

$selectors = [
	$baseSelector . '.wp-block-vxt-container'           => [
		'color' => $attr['textColor'],
	],
	$baseSelector . '.wp-block-vxt-container *'         => [
		'color' => $attr['textColor'],
	],
	$baseSelector . ' a'                                 => [
		'color' => $attr['linkColor'],
	],
	$baseSelector . ' a:hover'                           => [
		'color' => $attr['linkHoverColor'],
	],
	$baseSelector . ' .vxt-container__shape-top svg'    => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topHeight'], 'px' ),
	],
	$baseSelector . ' .vxt-container__shape.vxt-container__shape-top .vxt-container__shape-fill' => [
		'fill' => \Vexaltrix\Core\Support\Helper::hex2rgba( $attr['topColor'], ( isset( $attr['topDividerOpacity'] ) && '' !== $attr['topDividerOpacity'] ) ? $attr['topDividerOpacity'] : 100 ),
	],
	$baseSelector . ' .vxt-container__shape-bottom svg' => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomHeight'], 'px' ),
	],
	$baseSelector . ' .vxt-container__shape.vxt-container__shape-bottom .vxt-container__shape-fill' => [
		'fill' => \Vexaltrix\Core\Support\Helper::hex2rgba( $attr['bottomColor'], ( isset( $attr['bottomDividerOpacity'] ) && '' !== $attr['bottomDividerOpacity'] ) ? $attr['bottomDividerOpacity'] : 100 ),
	],
	$baseSelector . ' .vxt-container__video-wrap video' => [
		'opacity' => $backgroundVideoOpacityValue,
	],
];

if ( $bgVideoImageFallback ) {
	$selectors[ $baseSelector . ' .vxt-container__video-wrap video' ]['background']      = 'url(' . $bgVideoImageFallback . ') 50% 50%;';
	$selectors[ $baseSelector . ' .vxt-container__video-wrap video' ]['background-size'] = 'cover';
}

if ( '' !== $attr['topWidth'] ) {
	$selectors[ $baseSelector . ' .vxt-container__shape-top svg' ]['width'] = 'calc( ' . $attr['topWidth'] . '% + 1.3px )';
}

if ( '' !== $attr['bottomWidth'] ) {
	$selectors[ $baseSelector . ' .vxt-container__shape-bottom svg' ]['width'] = 'calc( ' . $attr['bottomWidth'] . '% + 1.3px )';
}

$containerTabletCss = array_merge(
	[
		'min-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeightTablet'], $attr['minHeightTypeTablet'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingTablet, $attr['paddingTypeTablet'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingTablet, $attr['paddingTypeTablet'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $topMarginTablet, $attr['marginTypeTablet'] ) . ' !important',
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomMarginTablet, $attr['marginTypeTablet'] ) . ' !important',
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMarginTablet, $attr['marginTypeTablet'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMarginTablet, $attr['marginTypeTablet'] ),
		'order'          => 'custom' === $orderTablet ? $customOrderTablet : $orderTablet,
	],
	$borderTablet
);

if ( ! empty( $containerBgCssTablet ) ) {
	$containerTabletCss = array_merge( $containerTabletCss, $containerBgCssTablet );
}

$innerContainerTabletCss = [
	'flex-direction'  => $attr['directionTablet'],
	'align-items'     => $attr['alignItemsTablet'],
	'justify-content' => $attr['justifyContentTablet'],
	'flex-wrap'       => $attr['wrapTablet'],
	'align-content'   => $attr['alignContentTablet'],
];

// Keeping $inner_container_tablet_css empty array because it will be used when layout is grid.
if ( $isLayoutGrid ) {
	$innerContainerTabletCss = [];
}

if ( $shouldMergeInnerContainerCss && ! $isLayoutGrid ) {
	$containerTabletCss = array_merge( $containerTabletCss, $innerContainerTabletCss );
}

$tSelectors = [
	$baseSelector . ' .vxt-container__shape-bottom svg' => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomHeightTablet'], 'px' ),
	],
	$baseSelector . ' .vxt-container__shape-top svg'    => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topHeightTablet'], 'px' ),
	],
];

$containerMobileCss = array_merge(
	[
		'min-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeightMobile'], $attr['minHeightTypeMobile'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingMobile, $attr['paddingTypeMobile'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingMobile, $attr['paddingTypeMobile'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $topMarginMobile, $attr['marginTypeMobile'] ) . ' !important',
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomMarginMobile, $attr['marginTypeMobile'] ) . ' !important',
		'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMarginMobile, $attr['marginTypeMobile'] ),
		'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMarginMobile, $attr['marginTypeMobile'] ),
		'row-gap'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapMobile'], $attr['rowGapTypeMobile'] ),
		'column-gap'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapMobile'], $attr['columnGapTypeMobile'] ),
		'order'          => 'custom' === $orderMobile ? $customOrderMobile : $orderMobile,
	],
	$borderMobile
);

if ( ! empty( $containerBgCssMobile ) ) {
	$containerMobileCss = array_merge( $containerMobileCss, $containerBgCssMobile );
}

$innerContainerMobileCss = [
	'flex-direction'  => $attr['directionMobile'],
	'align-items'     => $attr['alignItemsMobile'],
	'justify-content' => $attr['justifyContentMobile'],
	'flex-wrap'       => $attr['wrapMobile'],
	'align-content'   => $attr['alignContentMobile'],
];

// Keeping $inner_container_mobile_css empty array because it will be used when layout is grid.
if ( $isLayoutGrid ) {
	$innerContainerMobileCss = [];
}

if ( $shouldMergeInnerContainerCss && ! $isLayoutGrid ) {
	$containerMobileCss = array_merge( $containerMobileCss, $innerContainerMobileCss );
}

$mSelectors = [
	$baseSelector . ' .vxt-container__shape-bottom svg' => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomHeightMobile'], 'px' ),
	],
	$baseSelector . ' .vxt-container__shape-top svg'    => [
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topHeightMobile'], 'px' ),
	],
];

if ( ! $isLayoutGrid ) {
	// Add row and column gap if layout is not grid.
	$containerCss['row-gap']          = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapDesktop'], $attr['rowGapType'] );
	$containerCss['column-gap']       = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapDesktop'], $attr['columnGapType'] );
	$innerContainerCss['row-gap']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapDesktop'], $attr['rowGapType'] );
	$innerContainerCss['column-gap'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapDesktop'], $attr['columnGapType'] );

	// for tablet devices.
	$containerTabletCss['row-gap']          = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapTablet'], $attr['rowGapTypeTablet'] );
	$containerTabletCss['column-gap']       = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapTablet'], $attr['columnGapTypeTablet'] );
	$innerContainerTabletCss['row-gap']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapTablet'], $attr['rowGapTypeTablet'] );
	$innerContainerTabletCss['column-gap'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapTablet'], $attr['columnGapTypeTablet'] );

	// for mobile devices.
	$containerMobileCss['row-gap']          = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapMobile'], $attr['rowGapTypeMobile'] );
	$containerMobileCss['column-gap']       = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapMobile'], $attr['columnGapTypeMobile'] );
	$innerContainerMobileCss['row-gap']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapMobile'], $attr['rowGapTypeMobile'] );
	$innerContainerMobileCss['column-gap'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapMobile'], $attr['columnGapTypeMobile'] );
}

	// Add max-width and width if layout is not grid.
	$selectors[ '.vxt-is-root-container .vxt-block-' . $id ] = [ // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		'max-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthDesktop'], $attr['widthType'] ),
		'width'     => '100%',
	];

	$tSelectors[ '.vxt-is-root-container ' . $baseSelector ] = [ // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		'max-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthTablet'], $attr['widthTypeTablet'] ),
		'width'     => '100%',
	];

	$mSelectors[ '.vxt-is-root-container ' . $baseSelector ] = [ // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		'max-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthMobile'], $attr['widthTypeMobile'] ),
		'width'     => '100%',
	];

	if ( $hasInnerBlocksWrap ) {
		$selectors[ '.vxt-is-root-container.alignfull' . $baseSelector . ' > .vxt-container-inner-blocks-wrap' ] = array_merge(
			[ // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			'--inner-content-custom-width' => 'min( 100%, ' . $attr['innerContentCustomWidthDesktop'] . $attr['innerContentCustomWidthType'] . ')',
			'max-width'                    => 'var(--inner-content-custom-width)',
			'width'                        => '100%',
			],
			$innerContainerCss
		);

		$tSelectors[ '.vxt-is-root-container.alignfull' . $baseSelector . ' > .vxt-container-inner-blocks-wrap' ] = array_merge(
			[ // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			'--inner-content-custom-width' => 'min( 100%, ' . $innerContentCustomWidthTabletFallback . $attr['innerContentCustomWidthTypeTablet'] . ')',
			'max-width'                    => 'var(--inner-content-custom-width)',
			'width'                        => '100%',
			],
			$innerContainerTabletCss
		);

		$mSelectors[ '.vxt-is-root-container.alignfull' . $baseSelector . ' > .vxt-container-inner-blocks-wrap' ] = array_merge(
			[ // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			'--inner-content-custom-width' => 'min( 100%, ' . $innerContentCustomWidthMobileFallback . $attr['innerContentCustomWidthTypeMobile'] . ')',
			'max-width'                    => 'var(--inner-content-custom-width)',
			'width'                        => '100%',
			],
			$innerContainerMobileCss
		);
	}

	if ( $isLayoutGrid ) {
		$gridBaseSelector      = $baseSelector . '.vxt-layout-grid';
		$containerBaseSelector = $hasInnerBlocksWrap && $attr['isBlockRootParent'] ? $gridBaseSelector . ' > .vxt-container-inner-blocks-wrap' : $gridBaseSelector;
		$gridCss                = [];
		
		$gridCss['row-gap']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapDesktop'], $attr['rowGapType'] );
		$gridCss['column-gap'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapDesktop'], $attr['columnGapType'] );

		// Grid css for desktop.
		$selectors[ $containerBaseSelector ] = array_merge( $gridCss, \Vexaltrix\Presentation\Blocks\BlockHelper::gridCssObject( $attr, 'Desktop' ) );

		// Grid css for tablet.
		$gridCssTablet = [];

		$gridCssTablet['row-gap']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapTablet'], $attr['rowGapTypeTablet'] );
		$gridCssTablet['column-gap'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapTablet'], $attr['columnGapTypeTablet'] );
		
		$tSelectors[ $containerBaseSelector ] = array_merge( $gridCssTablet, \Vexaltrix\Presentation\Blocks\BlockHelper::gridCssObject( $attr, 'Tablet' ) );

		// Grid css for mobile.
		$gridCssMobile = [];

		$gridCssMobile['row-gap']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapMobile'], $attr['rowGapTypeMobile'] );
		$gridCssMobile['column-gap'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapMobile'], $attr['columnGapTypeMobile'] );

		$mSelectors[ $containerBaseSelector ] = array_merge( $gridCssMobile, \Vexaltrix\Presentation\Blocks\BlockHelper::gridCssObject( $attr, 'Mobile' ) );
	}

	if ( 'video' === $attr['backgroundType'] ) {
		$selectors[ $baseSelector . ' .vxt-container__video-wrap' ]   = array_merge( $videoBgCss, $border );
		$tSelectors[ $baseSelector . ' .vxt-container__video-wrap' ] = $borderTablet;
		$mSelectors[ $baseSelector . ' .vxt-container__video-wrap' ] = $borderMobile;

		$selectorClass = '.wp-block-vxt-container' . $baseSelector;

		$selectors[ $baseSelector . ' > div:not(.vxt-container__video-wrap):not(.vxt-container__shape)' ] = [
			'position' => 'relative',
		];
		$selectors[ $selectorClass ]   = $innerContainerCss;
		$tSelectors[ $selectorClass ] = $innerContainerTabletCss;
		$mSelectors[ $selectorClass ] = $innerContainerMobileCss;

		$selectors[ $baseSelector ]   = [
			'min-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeightDesktop'], $attr['minHeightType'] ),
			'box-shadow'     =>
					\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) .
					' ' .
					\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) .
					' ' .
					\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) .
					' ' .
					\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) .
					' ' .
					$attr['boxShadowColor'] .
					' ' .
					$boxShadowPositionCss,
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPaddingDesktop'], $attr['paddingType'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPaddingDesktop'], $attr['paddingType'] ),
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPaddingDesktop'], $attr['paddingType'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPaddingDesktop'], $attr['paddingType'] ),
			'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginDesktop'], $attr['marginType'] ) . ' !important',
			'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginDesktop'], $attr['marginType'] ) . ' !important',
			'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginDesktop'], $attr['marginType'] ),
			'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginDesktop'], $attr['marginType'] ),
			'row-gap'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapDesktop'], $attr['rowGapType'] ),
			'column-gap'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapDesktop'], $attr['columnGapType'] ),
			'overflow'       => $attr['overflow'],
		];
		$tSelectors[ $baseSelector ] = [
			'min-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeightTablet'], $attr['minHeightTypeTablet'] ),
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPaddingTablet, $attr['paddingTypeTablet'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPaddingTablet, $attr['paddingTypeTablet'] ),
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingTablet, $attr['paddingTypeTablet'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingTablet, $attr['paddingTypeTablet'] ),
			'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $topMarginTablet, $attr['marginTypeTablet'] ) . ' !important',
			'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomMarginTablet, $attr['marginTypeTablet'] ) . ' !important',
			'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMarginTablet, $attr['marginTypeTablet'] ),
			'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMarginTablet, $attr['marginTypeTablet'] ),
			'row-gap'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapTablet'], $attr['rowGapTypeTablet'] ),
			'column-gap'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapTablet'], $attr['columnGapTypeTablet'] ),
		];
		$mSelectors[ $baseSelector ] = [
			'min-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['minHeightMobile'], $attr['minHeightTypeMobile'] ),
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $topPaddingMobile, $attr['paddingTypeMobile'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomPaddingMobile, $attr['paddingTypeMobile'] ),
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $leftPaddingMobile, $attr['paddingTypeMobile'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $rightPaddingMobile, $attr['paddingTypeMobile'] ),
			'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue( $topMarginMobile, $attr['marginTypeMobile'] ) . ' !important',
			'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue( $bottomMarginMobile, $attr['marginTypeMobile'] ) . ' !important',
			'margin-left'    => \Vexaltrix\Core\Support\Helper::getCssValue( $leftMarginMobile, $attr['marginTypeMobile'] ),
			'margin-right'   => \Vexaltrix\Core\Support\Helper::getCssValue( $rightMarginMobile, $attr['marginTypeMobile'] ),
			'row-gap'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rowGapMobile'], $attr['rowGapTypeMobile'] ),
			'column-gap'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['columnGapMobile'], $attr['columnGapTypeMobile'] ),
		];
		$selectors[ '.wp-block-vxt-container' . $baseSelector . ':hover .vxt-container__video-wrap' ] = [
			'border-color' => $attr['containerBorderHColor'],
		];
		// If hover blur or hover color are set, show the hover shadow.
		if ( ( ( '' !== $attr['boxShadowBlurHover'] ) && ( null !== $attr['boxShadowBlurHover'] ) ) || '' !== $attr['boxShadowColorHover'] ) {

			$selectors[ $baseSelector . ':hover ' ]['box-shadow'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffsetHover'], 'px' ) .
																	' ' .
																	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffsetHover'], 'px' ) .
																	' ' .
																	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlurHover'], 'px' ) .
																	' ' .
																	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpreadHover'], 'px' ) .
																	' ' .
																	$attr['boxShadowColorHover'] .
																	' ' .
																	$boxShadowPositionCssHover;

		}
	} else {
		$selectors[ $baseSelector ]   = $containerCss; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$tSelectors[ $baseSelector ] = $containerTabletCss; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$mSelectors[ $baseSelector ] = $containerMobileCss; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$selectors[ '.wp-block-vxt-container' . $baseSelector . ':hover' ] = [
			'border-color' => $attr['containerBorderHColor'],
		];
		// If hover blur or hover color are set, show the hover shadow.
		if ( ( ( '' !== $attr['boxShadowBlurHover'] ) && ( null !== $attr['boxShadowBlurHover'] ) ) || '' !== $attr['boxShadowColorHover'] ) {

			$selectors[ $baseSelector . ':hover' ]['box-shadow'] = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowHOffsetHover'], 'px' ) .
																	' ' .
																	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowVOffsetHover'], 'px' ) .
																	' ' .
																	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowBlurHover'], 'px' ) .
																	' ' .
																	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['boxShadowSpreadHover'], 'px' ) .
																	' ' .
																	$attr['boxShadowColorHover'] .
																	' ' .
																	$boxShadowPositionCssHover;

		}
	}

	if ( 'default' === $attr['contentWidth'] ) {
		$selectors[ $baseSelector ]['max-width']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthDesktop'], $attr['widthType'] ) . ' !important';
		$selectors[ $baseSelector ]['margin-left']  = ( '' !== $attr['leftMarginDesktop'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginDesktop'], $attr['marginType'] ) . ' !important' : '' );
		$selectors[ $baseSelector ]['margin-right'] = ( '' !== $attr['rightMarginDesktop'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginDesktop'], $attr['marginType'] ) . ' !important' : '' );
		// FSE container width compatibility.
		$commonFullwidthRestrictions = ( 'auto' !== $attr['childrenWidthDesktop'] && ! $isLayoutGrid );

		$isFseContainer = ( $commonFullwidthRestrictions && wp_is_block_theme() && ! get_queried_object() );

		// WooCommerce template pages.
		$isCheckout              = function_exists( 'is_checkout' ) && is_checkout();
		$isCart                  = function_exists( 'is_cart' ) && is_cart();
		$isOrderConfirmation    = function_exists( 'is_order_received_page' ) && is_order_received_page();
		$isProductCatalog       = function_exists( 'is_shop' ) && is_shop();
		$isProductSearch        = function_exists( 'is_product_search' ) && is_product_search();
		$isProductsByAttribute = function_exists( 'is_product_taxonomy' ) && is_product_taxonomy();
		$isProductsByCategory  = function_exists( 'is_product_category' ) && is_product_category();
		$isProductsByTag       = function_exists( 'is_product_tag' ) && is_product_tag();
		$isSingleProduct        = function_exists( 'is_product' ) && is_product();

		$requiresFullwidth = $commonFullwidthRestrictions && (
			$isFseContainer ||
			$isCheckout ||
			$isCart ||
			$isOrderConfirmation ||
			$isProductCatalog ||
			$isProductSearch ||
			$isProductsByAttribute ||
			$isProductsByCategory ||
			$isProductsByTag ||
			$isSingleProduct
		);

		// Add the FSE compatibility width when required.
		$selectors[ $baseSelector ]['width'] = $requiresFullwidth ? '100%' : '';

		$tSelectors[ $baseSelector ]['max-width']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthTablet'], $attr['widthTypeTablet'] ) . ' !important';
		$tSelectors[ $baseSelector ]['margin-left']  = ( '' !== $attr['leftMarginTablet'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $leftMarginTablet, $attr['marginTypeTablet'] ) . ' !important' : '' );
		$tSelectors[ $baseSelector ]['margin-right'] = ( '' !== $attr['rightMarginTablet'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $rightMarginTablet, $attr['marginTypeTablet'] ) . ' !important' : '' );

		$mSelectors[ $baseSelector ]['max-width']    = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['widthMobile'], $attr['widthTypeMobile'] ) . ' !important';
		$mSelectors[ $baseSelector ]['margin-left']  = ( '' !== $attr['leftMarginMobile'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $leftMarginMobile, $attr['marginTypeMobile'] ) . ' !important' : '' );
		$mSelectors[ $baseSelector ]['margin-right'] = ( '' !== $attr['rightMarginMobile'] ? \Vexaltrix\Core\Support\Helper::getCssValue( $rightMarginMobile, $attr['marginTypeMobile'] ) . ' !important' : '' );
	}

	// Add the overlay CSS if needed.
	if (
	! empty( $attr['overlayType'] )
	&& 'none' !== $attr['overlayType']
	&& ! empty( $containerBgOverlayCss )
	&& is_array( $containerBgOverlayCss )
	) {
		$desktopBorderWidth = [
			'top'    => is_numeric( $attr['containerBorderTopWidth'] ) ? $attr['containerBorderTopWidth'] : 0,
			'right'  => is_numeric( $attr['containerBorderRightWidth'] ) ? $attr['containerBorderRightWidth'] : 0,
			'bottom' => is_numeric( $attr['containerBorderBottomWidth'] ) ? $attr['containerBorderBottomWidth'] : 0,
			'left'   => is_numeric( $attr['containerBorderLeftWidth'] ) ? $attr['containerBorderLeftWidth'] : 0,
		];
		$tabletBorderWidth  = [
			'top'    => is_numeric( $attr['containerBorderTopWidthTablet'] ) ? $attr['containerBorderTopWidthTablet'] : $desktopBorderWidth['top'],
			'right'  => is_numeric( $attr['containerBorderRightWidthTablet'] ) ? $attr['containerBorderRightWidthTablet'] : $desktopBorderWidth['right'],
			'bottom' => is_numeric( $attr['containerBorderBottomWidthTablet'] ) ? $attr['containerBorderBottomWidthTablet'] : $desktopBorderWidth['bottom'],
			'left'   => is_numeric( $attr['containerBorderLeftWidthTablet'] ) ? $attr['containerBorderLeftWidthTablet'] : $desktopBorderWidth['left'],
		];
		$mobileBorderWidth  = [
			'top'    => is_numeric( $attr['containerBorderTopWidthMobile'] ) ? $attr['containerBorderTopWidthMobile'] : $tabletBorderWidth['top'],
			'right'  => is_numeric( $attr['containerBorderRightWidthMobile'] ) ? $attr['containerBorderRightWidthMobile'] : $tabletBorderWidth['right'],
			'bottom' => is_numeric( $attr['containerBorderBottomWidthMobile'] ) ? $attr['containerBorderBottomWidthMobile'] : $tabletBorderWidth['bottom'],
			'left'   => is_numeric( $attr['containerBorderLeftWidthMobile'] ) ? $attr['containerBorderLeftWidthMobile'] : $tabletBorderWidth['left'],
		];

		$selectors   = array_merge(
			$selectors,
			[
				$baseSelector . '::before'       => array_merge(
					[
						'content'        => '""',
						'position'       => 'absolute',
						'pointer-events' => 'none',
						'top'            => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $desktopBorderWidth['top'], 'px' ),
						'left'           => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $desktopBorderWidth['left'], 'px' ),
						'width'          => 'calc(100% + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $desktopBorderWidth['left'], 'px' ) . ' + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $desktopBorderWidth['right'], 'px' ) . ')',
						'height'         => 'calc(100% + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $desktopBorderWidth['top'], 'px' ) . ' + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $desktopBorderWidth['bottom'], 'px' ) . ')',
					],
					$border,
					$containerBgOverlayCss
				),
				$baseSelector . ':hover::before' => [
					'border-color' => $attr['containerBorderHColor'],
				],
			]
		);
		$tSelectors = array_merge(
			$tSelectors,
			[
				$baseSelector . '::before' => array_merge(
					[
						'top'    => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $tabletBorderWidth['top'], 'px' ),
						'left'   => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $tabletBorderWidth['left'], 'px' ),
						'width'  => 'calc(100% + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $tabletBorderWidth['left'], 'px' ) . ' + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $tabletBorderWidth['right'], 'px' ) . ')',
						'height' => 'calc(100% + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $tabletBorderWidth['top'], 'px' ) . ' + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $tabletBorderWidth['bottom'], 'px' ) . ')',
					],
					$borderTablet,
					$containerBgOverlayCssTablet
				),
			]
		);
		$mSelectors = array_merge(
			$mSelectors,
			[
				$baseSelector . '::before' => array_merge(
					[
						'top'    => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $mobileBorderWidth['top'], 'px' ),
						'left'   => '-' . \Vexaltrix\Core\Support\Helper::getCssValue( $mobileBorderWidth['left'], 'px' ),
						'width'  => 'calc(100% + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $mobileBorderWidth['left'], 'px' ) . ' + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $mobileBorderWidth['right'], 'px' ) . ')',
						'height' => 'calc(100% + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $mobileBorderWidth['top'], 'px' ) . ' + ' . \Vexaltrix\Core\Support\Helper::getCssValue( $mobileBorderWidth['bottom'], 'px' ) . ')',
					],
					$borderMobile,
					$containerBgOverlayCssMobile
				),
			]
		);
		if ( 'image' === $attr['overlayType'] ) {
			$tSelectors[ $baseSelector . '::before' ] = array_merge(
				$tSelectors[ $baseSelector . '::before' ],
				$containerBgOverlayCssTablet
			);
			$mSelectors[ $baseSelector . '::before' ] = array_merge(
				$mSelectors[ $baseSelector . '::before' ],
				$containerBgOverlayCssMobile
			);
		};
	}//end if;

	$zIndex        = isset( $attr['zIndex'] ) ? $attr['zIndex'] : '';
	$zIndexTablet = isset( $attr['zIndexTablet'] ) ? $attr['zIndexTablet'] : '';
	$zIndexMobile = isset( $attr['zIndexMobile'] ) ? $attr['zIndexMobile'] : '';

	$selectors[ $baseSelector . '.uag-blocks-common-selector' ] = [
		'--z-index-desktop' => $zIndex,
		'--z-index-tablet'  => $zIndexTablet,
		'--z-index-mobile'  => $zIndexMobile,
	];

	$autoWidth = [ 'width' => 'auto !important' ];
	$setWidth  = [ 'width' => '100%' ];

	$baseWidthSelector = $baseSelector . '.wp-block-vxt-container > *:not( .wp-block-vxt-column ):not( .wp-block-vxt-section ):not( .vxt-container__shape ):not( .vxt-container__video-wrap ):not( .vxt-slider-container ):not( .vexaltrix-container-link-overlay ):not(.vexaltrix-image-gallery__control-lightbox):not(.wp-block-vxt-lottie):not(.vxt-container-inner-blocks-wrap)';

	$baseWidthSelector2 = $baseSelector . '.wp-block-vxt-container > .vxt-container-inner-blocks-wrap > *:not( .wp-block-vxt-column ):not( .wp-block-vxt-section ):not( .vxt-container__shape ):not( .vxt-container__video-wrap ):not( .vxt-slider-container ):not(.vexaltrix-image-gallery__control-lightbox)';

	// Add auto width to the inner blocks in desktop.
	if ( ! empty( $attr['directionDesktop'] ) ) {
		if ( 'auto' === $attr['childrenWidthDesktop'] ) {
			$selectors[ $baseWidthSelector ]   = $autoWidth;
			$selectors[ $baseWidthSelector2 ] = $autoWidth;
		}
	}

	// Add auto width to the inner blocks in tablet.
	if ( ! empty( $attr['directionTablet'] ) ) {
		if ( 'auto' === $attr['childrenWidthTablet'] ) {
			$tSelectors[ $baseWidthSelector ]   = $autoWidth;
			$tSelectors[ $baseWidthSelector2 ] = $autoWidth;
		} else {
			$tSelectors[ $baseWidthSelector ]   = $setWidth;
			$tSelectors[ $baseWidthSelector2 ] = $setWidth;
		}
	}

	// Add auto width to the inner blocks in mobile.
	if ( ! empty( $attr['directionMobile'] ) ) {
		if ( 'auto' === $attr['childrenWidthMobile'] ) {
			$mSelectors[ $baseWidthSelector ]   = $autoWidth;
			$mSelectors[ $baseWidthSelector2 ] = $autoWidth;
		} else {
			$mSelectors[ $baseWidthSelector ]   = $setWidth;
			$mSelectors[ $baseWidthSelector2 ] = $setWidth;
		}
	}

	if ( ! empty( $attr['isGridCssInParent'] ) ) {
		$gridChildrenCSS       = [];
		$gridChildrenCSSTab    = [
			// Add default css for the Tablet.
			'grid-column' => 'span 1',
			'grid-row'    => 'span 1',
		];
		$gridChildrenCSSMobile = [
			// Add default css for the Mobile.
			'grid-column' => 'span 1',
			'grid-row'    => 'span 1',
		];
	
		if ( ! empty( $attr['gridSettingType'] ) && 'advance' === $attr['gridSettingType'] ) {
			// For desktop.
			if ( ! empty( $attr['gridColumnStart'] ) && ! empty( $attr['gridColumnEnd'] ) ) {
				$gridChildrenCSS['grid-column'] = $attr['gridColumnStart'] . ' / ' . $attr['gridColumnEnd'];
			}

			if ( ! empty( $attr['gridRowStart'] ) && ! empty( $attr['gridRowEnd'] ) ) {
				$gridChildrenCSS['grid-row'] = $attr['gridRowStart'] . ' / ' . $attr['gridRowEnd'];
			}

			// For tablet.
			if ( ! empty( $attr['gridColumnStartTablet'] ) && ! empty( $attr['gridColumnEndTablet'] ) ) {
				$gridChildrenCSSTab['grid-column'] = $attr['gridColumnStartTablet'] . ' / ' . $attr['gridColumnEndTablet'];
			}

			if ( ! empty( $attr['gridRowStartTablet'] ) && ! empty( $attr['gridRowEndTablet'] ) ) {
				$gridChildrenCSSTab['grid-row'] = $attr['gridRowStartTablet'] . ' / ' . $attr['gridRowEndTablet'];
			}

			// For mobile.
			if ( ! empty( $attr['gridColumnStartMobile'] ) && ! empty( $attr['gridColumnEndMobile'] ) ) {
				$gridChildrenCSSMobile['grid-column'] = $attr['gridColumnStartMobile'] . ' / ' . $attr['gridColumnEndMobile'];
			}

			if ( ! empty( $attr['gridRowStartMobile'] ) && ! empty( $attr['gridRowEndMobile'] ) ) {
				$gridChildrenCSSMobile['grid-row'] = $attr['gridRowStartMobile'] . ' / ' . $attr['gridRowEndMobile'];
			}   
		} else {
			// For desktop.
			if ( ! empty( $attr['gridColumnSpan'] ) ) {
				$gridChildrenCSS['grid-column'] = 'span ' . $attr['gridColumnSpan'];
			}

			if ( ! empty( $attr['gridRowSpan'] ) ) {
				$gridChildrenCSS['grid-row'] = 'span ' . $attr['gridRowSpan'];
			}

			// For tablet.
			if ( ! empty( $attr['gridColumnSpanTablet'] ) ) {
				$gridChildrenCSSTab['grid-column'] = 'span ' . $attr['gridColumnSpanTablet'];
			}

			if ( ! empty( $attr['gridRowSpanTablet'] ) ) {
				$gridChildrenCSSTab['grid-row'] = 'span ' . $attr['gridRowSpanTablet'];
			}

			// For mobile.
			if ( ! empty( $attr['gridColumnSpanMobile'] ) ) {
				$gridChildrenCSSMobile['grid-column'] = 'span ' . $attr['gridColumnSpanMobile'];
			}

			if ( ! empty( $attr['gridRowSpanMobile'] ) ) {
				$gridChildrenCSSMobile['grid-row'] = 'span ' . $attr['gridRowSpanMobile'];
			}
		}

		// For desktop.
		if ( ! empty( $attr['gridAlignItems'] ) ) {
			$gridChildrenCSS['align-self'] = $attr['gridAlignItems'];
		}

		if ( ! empty( $attr['gridJustifyItems'] ) ) {
			$gridChildrenCSS['justify-self'] = $attr['gridJustifyItems'];
		}

		// For tablet.
		if ( ! empty( $attr['gridAlignItemsTablet'] ) ) {
			$gridChildrenCSSTab['align-self'] = $attr['gridAlignItemsTablet'];
		}

		if ( ! empty( $attr['gridJustifyItemsTablet'] ) ) {
			$gridChildrenCSSTab['justify-self'] = $attr['gridJustifyItemsTablet'];
		}

		// For mobile.
		if ( ! empty( $attr['gridAlignItemsMobile'] ) ) {
			$gridChildrenCSSMobile['align-self'] = $attr['gridAlignItemsMobile'];
		}

		if ( ! empty( $attr['gridJustifyItemsMobile'] ) ) {
			$gridChildrenCSSMobile['justify-self'] = $attr['gridJustifyItemsMobile'];
		}

		$selectors[ $baseSelector ]   = array_merge( $selectors[ $baseSelector ], $gridChildrenCSS );
		$tSelectors[ $baseSelector ] = array_merge( $tSelectors[ $baseSelector ], $gridChildrenCSSTab );
		$mSelectors[ $baseSelector ] = array_merge( $mSelectors[ $baseSelector ], $gridChildrenCSSMobile );
	}

	// Add dynamic content fallback handling.
	if ( ! empty( $attr['dynamicContent']['bgImage']['enable'] ) ) {
		$dynamicContent = $attr['dynamicContent']['bgImage'];
		
		// Get the fallback image from the advanced field.
		$fallbackImage = '';
		if ( ! empty( $dynamicContent['advanced'] ) ) {
			$advancedParts = explode( '|', $dynamicContent['advanced'] );
			if ( count( $advancedParts ) > 1 ) {
				$fallbackImage = $advancedParts[1];
			}
		}

		if ( $fallbackImage ) {
			// Generate background objects for each device.
			$bgObjDesktop           = generateBackgroundObject( $attr, $fallbackImage, 'desktop' );
			$containerBgCssDesktop = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjDesktop, 'no' );

			// Add the CSS to the selectors if it exists.
			if ( ! empty( $containerBgCssDesktop ) ) {
				$selectors[ $baseSelector ] = array_merge(
					isset( $selectors[ $baseSelector ] ) ? $selectors[ $baseSelector ] : [],
					$containerBgCssDesktop
				);
			}

			// Add tablet version if needed.
			if ( isset( $attr['backgroundRepeatTablet'] ) && ! empty( $attr['backgroundRepeatTablet'] ) ) {
				$bgObjTablet           = generateBackgroundObject( $attr, $fallbackImage, 'tablet' );
				$containerBgCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjTablet, 'no' );
				
				if ( ! empty( $containerBgCssTablet ) ) {
					$tSelectors[ $baseSelector ] = array_merge(
						isset( $tSelectors[ $baseSelector ] ) ? $tSelectors[ $baseSelector ] : [],
						$containerBgCssTablet
					);
				}
			}

			// Add mobile version if needed.
			if ( isset( $attr['backgroundRepeatMobile'] ) && ! empty( $attr['backgroundRepeatMobile'] ) ) {
				$bgObjMobile           = generateBackgroundObject( $attr, $fallbackImage, 'mobile' );
				$containerBgCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjMobile, 'no' );
				
				if ( ! empty( $containerBgCssMobile ) ) {
					$mSelectors[ $baseSelector ] = array_merge(
						isset( $mSelectors[ $baseSelector ] ) ? $mSelectors[ $baseSelector ] : [],
						$containerBgCssMobile
					);
				}
			}
		}
	}

	$combinedSelectors = [
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	];

	return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.wp-block-vxt-container' );
