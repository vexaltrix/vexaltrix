<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined else where.
 *
 * @var mixed[] $attr
 */
$attr = isset( $attr ) ? $attr : [];

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksImageGalleryGfont( $attr );

// Arrow & Dots Default Color Fallback ( Not from Theme ).
$arrowDotColor = $attr['paginateColor'] ? $attr['paginateColor'] : '#007cba';

// Block Visibility Based on Layout Type.
$hideThisBlock = in_array( $attr['feedLayout'], [ 'carousel', 'masonry' ], true );

// Range Fallback.
$paginateDotDistanceFallback = is_numeric( $attr['paginateDotDistance'] ) ? $attr['paginateDotDistance'] : 0;

// Responsive Slider Fallback.
$gridImageGapTabletFallback = is_numeric( $attr['gridImageGapTab'] ) ? $attr['gridImageGapTab'] : $attr['gridImageGap'];
$gridImageGapMobileFallback = is_numeric( $attr['gridImageGapMob'] ) ? $attr['gridImageGapMob'] : $gridImageGapTabletFallback;

// Border Attributes.
$arrowBorderCss             = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'arrow' );
$arrowBorderCssTablet      = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'arrow', 'tablet' );
$arrowBorderCssMobile      = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'arrow', 'mobile' );
$btnBorderCss               = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn' );
$btnBorderCssTablet        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
$btnBorderCssMobile        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'mobile' );
$imageBorderCss             = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'image' );
$imageBorderCssTablet      = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'image', 'tablet' );
$imageBorderCssMobile      = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'image', 'mobile' );
$mainTitleBorderCss        = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'mainTitle' );
$mainTitleBorderCssTablet = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'mainTitle', 'tablet' );
$mainTitleBorderCssMobile = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'mainTitle', 'mobile' );

// Text Decoration compatibility CSS.
$textDecorationProp = '' === $attr['captionDecoration'] && defined( 'ASTRA_THEME_SETTINGS' ) && function_exists( 'astra_get_font_extras' ) && function_exists( 'astra_get_option' ) ? astra_get_font_extras( astra_get_option( 'body-font-extras' ), 'text-decoration' ) : $attr['captionDecoration'];

// Box Shadow CSS.

$imageBoxShadowCss       = (
	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBoxShadowHOffset'], 'px' )
) . ' ' . (
	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBoxShadowVOffset'], 'px' )
) . ' ' . (
	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBoxShadowBlur'], 'px' )
) . ' ' . (
	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBoxShadowSpread'], 'px' )
) . (
	$attr['imageBoxShadowColor'] ? ( ' ' . $attr['imageBoxShadowColor'] ) : ''
) . ' ' . (
	( 'inset' === $attr['imageBoxShadowPosition'] ) ? ( ' ' . $attr['imageBoxShadowPosition'] ) : ''
);
$imageBoxShadowHoverCss = (
	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBoxShadowHOffsetHover'], 'px' )
) . ' ' . (
	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBoxShadowVOffsetHover'], 'px' )
) . ' ' . (
	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBoxShadowBlurHover'], 'px' )
) . ' ' . (
	\Vexaltrix\Core\Support\Helper::getCssValue( $attr['imageBoxShadowSpreadHover'], 'px' )
) . (
	$attr['imageBoxShadowColorHover'] ? ( ' ' . $attr['imageBoxShadowColorHover'] ) : ''
) . ' ' . (
	( 'inset' === $attr['imageBoxShadowPositionHover'] ) ? ( ' ' . $attr['imageBoxShadowPositionHover'] ) : ''
);

$selectors = [

	// Feed Selectors.

	'.wp-block-vxt-image-gallery'                       => [
		'padding'    => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['feedMarginUnit'],
			$attr['feedMarginTop'],
			$attr['feedMarginRight'],
			$attr['feedMarginBottom'],
			$attr['feedMarginLeft']
		),
		'visibility' => $hideThisBlock ? 'hidden' : '',
	],

	// Control Settings.

	' .vexaltrix-image-gallery__control-arrows svg'        => [
		'fill' => $arrowDotColor,
	],
	' .vexaltrix-image-gallery__control-arrows svg:hover'  => [
		'fill' => $attr['paginateColorHover'],
	],
	' .vexaltrix-image-gallery__control-arrows--carousel'  => $arrowBorderCss,
	' .vexaltrix-image-gallery__control-arrows--carousel:hover' => [
		'border-color' => $attr['arrowBorderHColor'],
	],
	' .vexaltrix-image-gallery__control-arrows--carousel.slick-prev' => [
		'left' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['paginateArrowDistance'],
			$attr['paginateArrowDistanceUnit']
		),
	],
	' .vexaltrix-image-gallery__control-arrows--carousel.slick-next' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['paginateArrowDistance'],
			$attr['paginateArrowDistanceUnit']
		),
	],
	' .vexaltrix-image-gallery__layout--carousel ul.slick-dots' => [
		'top' => \Vexaltrix\Core\Support\Helper::getCssValue( $paginateDotDistanceFallback, 'px' ),
	],
	' .vexaltrix-image-gallery__layout--carousel ul.slick-dots li button:before' => [
		'color' => $arrowDotColor,
	],
	' .vexaltrix-image-gallery__layout--carousel ul.slick-dots li button:hover:before' => [
		'color' => $attr['paginateColorHover'],
	],
	' .vexaltrix-image-gallery__control-dots li button::before' => [
		'color' => $arrowDotColor,
	],
	' .vexaltrix-image-gallery__control-dots li button:hover::before' => [
		'color' => $attr['paginateColorHover'],
	],
	' .vexaltrix-image-gallery__control-loader'            => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue( $paginateDotDistanceFallback, $attr['paginateDotDistanceUnit'] ),
	],
	' .vexaltrix-image-gallery__control-loader div'        => [
		'background-color' => $attr['paginateColor'],
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paginateLoaderSize'], 'px' ),
		'height'           => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paginateLoaderSize'], 'px' ),
		'border-radius'    => '100%',
		'padding'          => 0,
	],
	' .vexaltrix-image-gallery__control-button'            => array_merge(
		[
			'margin-top'       => \Vexaltrix\Core\Support\Helper::getCssValue( $paginateDotDistanceFallback, $attr['paginateDotDistanceUnit'] ),
			'padding'          => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
				$attr['paginateButtonPaddingUnit'],
				$attr['paginateButtonPaddingTop'],
				$attr['paginateButtonPaddingRight'],
				$attr['paginateButtonPaddingBottom'],
				$attr['paginateButtonPaddingLeft']
			),
			'color'            => $attr['paginateButtonTextColor'],
			'background-color' => $attr['paginateColor'],
			'font-family'      => 'Default' === $attr['loadMoreFontFamily'] ? '' : $attr['loadMoreFontFamily'],
			'font-weight'      => $attr['loadMoreFontWeight'],
			'font-style'       => $attr['loadMoreFontStyle'],
			'text-decoration'  => $attr['loadMoreDecoration'],
			'text-transform'   => $attr['loadMoreTransform'],
			'font-size'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['loadMoreFontSize'], $attr['loadMoreFontSizeType'] ),
			'line-height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['loadMoreLineHeight'], $attr['loadMoreLineHeightType'] ),
		],
		$btnBorderCss
	),
	' .vexaltrix-image-gallery__control-button:hover'      => [
		'color'            => $attr['paginateButtonTextColorHover'],
		'background-color' => $attr['paginateColorHover'],
		'border-color'     => $attr['btnBorderHColor'],
	],

	// Media Wrapper Selectors.

	' .vexaltrix-image-gallery__layout--grid'              => [
		'grid-gap' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['gridImageGap'],
			$attr['gridImageGapUnit']
		),
	],
	' .vexaltrix-image-gallery__layout--isogrid'           => [
		'margin' => \Vexaltrix\Core\Support\Helper::getCssValue(
			-abs( $attr['gridImageGap'] / 2 ),
			$attr['gridImageGapUnit']
		),
	],
	' .vexaltrix-image-gallery__layout--isogrid .vexaltrix-image-gallery__media-wrapper--isotope' => [
		'padding' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['gridImageGap'] / 2,
			$attr['gridImageGapUnit']
		),
	],
	' .vexaltrix-image-gallery__layout--masonry'           => [
		'margin' => \Vexaltrix\Core\Support\Helper::getCssValue(
			-abs( $attr['gridImageGap'] / 2 ),
			$attr['gridImageGapUnit']
		),
	],
	' .vexaltrix-image-gallery__layout--masonry .vexaltrix-image-gallery__media-wrapper--isotope' => [
		'padding' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['gridImageGap'] / 2,
			$attr['gridImageGapUnit']
		),
	],
	' .vexaltrix-image-gallery__layout--carousel'          => [
		// Override Slick Slider Margin.
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$paginateDotDistanceFallback,
			'px'
		) . ' !important',
	],
	' .vexaltrix-image-gallery__layout--carousel .vexaltrix-image-gallery__media-wrapper' => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['gridImageGapUnit'],
			0,
			$attr['gridImageGap'] / 2
		),
	],
	' .vexaltrix-image-gallery__layout--carousel .slick-list' => [
		'margin' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['gridImageGapUnit'],
			0,
			-( $attr['gridImageGap'] / 2 )
		),
	],
	' .vexaltrix-image-gallery__layout--tiled'             => [
		'grid-gap' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['gridImageGap'],
			$attr['gridImageGapUnit']
		),
	],
	' .vexaltrix-image-gallery__media'                     => array_merge(
		$imageBorderCss,
		[
			'box-shadow' => $imageBoxShadowCss,
		]
	),
	' .vexaltrix-image-gallery__media:hover'               => [
		'border-color' => $attr['imageBorderHColor'],
	],
	' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media' => [
		'box-shadow' => $imageBoxShadowHoverCss,
	],
	' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media' => [
		'box-shadow'   => $imageBoxShadowHoverCss,
		'border-color' => $attr['imageBorderHColor'],
	],

	// Thumbnail Selectors.

	' .vexaltrix-image-gallery__media-thumbnail-blurrer'   => [
		'-webkit-backdrop-filter' => 'blur(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundBlurAmount'],
			'px'
		) . ')',
		'backdrop-filter'         => 'blur(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundBlurAmount'],
			'px'
		) . ')',
	],
	' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-blurrer' => [
		'-webkit-backdrop-filter' => 'blur(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundBlurAmountHover'],
			'px'
		) . ')',
		'backdrop-filter'         => 'blur(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundBlurAmountHover'],
			'px'
		) . ')',
	],
	' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-blurrer' => [
		'-webkit-backdrop-filter' => 'blur(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundBlurAmountHover'],
			'px'
		) . ')',
		'backdrop-filter'         => 'blur(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundBlurAmountHover'],
			'px'
		) . ')',
	],

	// Caption Wrapper Selectors.
	' .vexaltrix-image-gallery__media-thumbnail-caption-wrapper--overlay' => [
		'background-color' => $attr['imageDisplayCaption'] ? ( ( 'hover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : $attr['captionBackgroundColor'] ) : $attr['overlayColor'],
	],
	' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption-wrapper--overlay' => [  
		'background-color' => $attr['imageDisplayCaption'] ? ( ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' === $attr['captionVisibility'] && $attr['captionSeparateColors'] ) ? $attr['captionBackgroundColorHover'] : $attr['captionBackgroundColor'] ) ) : $attr['overlayColorHover'],  
	],
	' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-caption-wrapper--overlay' => [
		'background-color' => $attr['imageDisplayCaption'] ? ( ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' === $attr['captionVisibility'] && $attr['captionSeparateColors'] ) ? $attr['captionBackgroundColorHover'] : $attr['captionBackgroundColor'] ) ) : $attr['overlayColorHover'],
	],
	' .vexaltrix-image-gallery__media-thumbnail-caption-wrapper--bar-inside' => [
		'-webkit-align-items'     => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 1, 'flex' ),
		'align-items'             => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 1, 'flex' ),
		'-webkit-justify-content' => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 2, 'flex' ),
		'justify-content'         => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 2, 'flex' ),
	],

	// Caption Selectors.
	' .vexaltrix-image-gallery__media-thumbnail-caption a' => [
		'color' => ( 'hover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : $attr['captionColor'],
	],
	' .vexaltrix-image-gallery__media-thumbnail-caption'   => [
		'color'           => ( 'hover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : $attr['captionColor'],
		'text-align'      => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 2 ),
		'font-family'     => 'Default' === $attr['captionFontFamily'] ? '' : $attr['captionFontFamily'],
		'font-weight'     => $attr['captionFontWeight'],
		'font-style'      => $attr['captionFontStyle'],
		'text-decoration' => $textDecorationProp,
		'text-transform'  => $attr['captionTransform'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionFontSize'], $attr['captionFontSizeType'] ),
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionLineHeight'], $attr['captionLineHeightType'] ),
		'padding'         => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['captionPaddingUnit'],
			$attr['captionPaddingTop'],
			$attr['captionPaddingRight'],
			$attr['captionPaddingBottom'],
			$attr['captionPaddingLeft']
		),
	],
	' .vexaltrix-image-gallery__media-thumbnail-caption--overlay' => [
		'-webkit-align-items'     => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 1, 'flex' ),
		'align-items'             => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 1, 'flex' ),
		'-webkit-justify-content' => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 2, 'flex' ),
		'justify-content'         => \Vexaltrix\Presentation\Blocks\BlockHelper::getMatrixAlignment( $attr['imageCaptionAlignment'], 2, 'flex' ),
	],
	' .vexaltrix-image-gallery__media-thumbnail-caption--bar-inside' => array_merge(
		[
			'background-color' => ( 'hover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : $attr['captionBackgroundColor'],
		],
		$mainTitleBorderCss,
		[
			'border-color' => ( 'hover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : $attr['mainTitleBorderColor'],
		]
	),
	' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption--bar-inside' => [
		'background-color' => ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' === $attr['captionVisibility'] && $attr['captionSeparateColors'] ) ? $attr['captionBackgroundColorHover'] : $attr['captionBackgroundColor'] ),
		'border-color'     => ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'antiHover' !== $attr['captionVisibility'] ) ? $attr['mainTitleBorderHColor'] : $attr['mainTitleBorderColor'] ),
	],
	'vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-caption--bar-inside' => [
		'background-color' => ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' === $attr['captionVisibility'] && $attr['captionSeparateColors'] ) ? $attr['captionBackgroundColorHover'] : $attr['captionBackgroundColor'] ),
		'border-color'     => ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' !== $attr['captionVisibility'] || $attr['captionSeparateColors'] ) ? $attr['mainTitleBorderHColor'] : $attr['mainTitleBorderColor'] ),
	],
	' .vexaltrix-image-gallery__media-thumbnail-caption--bar-outside' => array_merge(
		[
			'background-color' => $attr['captionBackgroundColor'],
		],
		$mainTitleBorderCss
	),
	' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption--bar-outside' => [
		'background-color' => $attr['captionSeparateColors'] ? $attr['captionBackgroundColorHover'] : $attr['captionBackgroundColor'],
		'border-color'     => $attr['captionSeparateColors'] ? $attr['mainTitleBorderHColor'] : $attr['mainTitleBorderColor'],
	],
	' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-caption--bar-outside' => [
		'background-color' => $attr['captionSeparateColors'] ? $attr['captionBackgroundColorHover'] : $attr['captionBackgroundColor'],
		'border-color'     => $attr['captionSeparateColors'] ? $attr['mainTitleBorderHColor'] : $attr['mainTitleBorderColor'],
	],
	' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption' => [
		'color' => ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' === $attr['captionVisibility'] && $attr['captionSeparateColors'] ) ? $attr['captionColorHover'] : $attr['captionColor'] ),
	],
	' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-caption' => [
		'color' => ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' === $attr['captionVisibility'] && $attr['captionSeparateColors'] ) ? $attr['captionColorHover'] : $attr['captionColor'] ),
	],
	' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption a' => [
		'color' => ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' === $attr['captionVisibility'] && $attr['captionSeparateColors'] ) ? $attr['captionColorHover'] : $attr['captionColor'] ),
	],
	' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-caption a' => [
		'color' => ( 'antiHover' === $attr['captionVisibility'] ) ? 'rgba(0,0,0,0)' : ( ( 'always' === $attr['captionVisibility'] && $attr['captionSeparateColors'] ) ? $attr['captionColorHover'] : $attr['captionColor'] ),
	],

	// Lightbox Selectors.
	'+.vexaltrix-image-gallery__control-lightbox'          => [
		'background-color' => $attr['lightboxBackgroundColor'],
		'backdrop-filter'  => $attr['lightboxBackgroundEnableBlur'] ? 'blur( ' . $attr['lightboxBackgroundBlurAmount'] . 'px)' : '',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--caption' => [
		'color'           => $attr['lightboxCaptionColor'],
		'background'      => 'linear-gradient(rgba(0,0,0,0), ' . $attr['lightboxCaptionBackgroundColor'] . ')',
		'min-height'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxCaptionHeight'], 'px' ),
		'font-family'     => ( 'Default' === $attr['lightboxFontFamily'] ) ? '' : $attr['lightboxFontFamily'],
		'font-weight'     => $attr['lightboxFontWeight'],
		'font-style'      => $attr['lightboxFontStyle'],
		'text-decoration' => $attr['lightboxDecoration'],
		'text-transform'  => $attr['lightboxTransform'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxFontSize'], $attr['lightboxFontSizeType'] ),
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxLineHeight'], $attr['lightboxLineHeightType'] ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--thumbnails-wrapper' => [
		'background-color' => $attr['lightboxDisplayCaptions'] ? $attr['lightboxCaptionBackgroundColor'] : 'transparent',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--count' => [
		'top'         => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ),
		'left'        => is_rtl() ? '' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ),
		'right'       => is_rtl() ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ) : '',
		'color'       => $attr['lightboxIconColor'],
		'font-family' => ( 'Default' === $attr['lightboxFontFamily'] ) ? '' : $attr['lightboxFontFamily'],
		'font-weight' => 'normal',
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSize'], 'px' ) ? 'calc(' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSize'], 'px' ) . ' * 3 / 4 )' : '',
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSize'], 'px' ) ? 'calc(' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSize'], 'px' ) . ' * 3 / 4 )' : '',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--close' => [
		'top'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ),
		'right' => is_rtl() ? '' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ),
		'left'  => is_rtl() ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ) : '',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--close svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSize'], 'px' ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSize'], 'px' ),
		'fill'   => $attr['lightboxIconColor'],
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main .swiper-button-prev' => [
		'left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ),
		'color' => $attr['lightboxIconColor'],
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main .swiper-button-next' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ),
		'color' => $attr['lightboxIconColor'],
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main.swiper-rtl .swiper-button-prev' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ),
		'left'  => 'auto',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main.swiper-rtl .swiper-button-next' => [
		'left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistance'], 'px' ),
		'right' => 'auto',
	],
];

$tSelectors = [
	'.wp-block-vxt-image-gallery'                      => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['feedMarginUnitTab'],
			$attr['feedMarginTopTab'],
			$attr['feedMarginRightTab'],
			$attr['feedMarginBottomTab'],
			$attr['feedMarginLeftTab']
		),
	],
	' .vexaltrix-image-gallery__control-arrows--carousel' => $arrowBorderCssTablet,
	' .vexaltrix-image-gallery__control-button'           => array_merge(
		[
			'padding'     => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
				$attr['paginateButtonPaddingUnitTab'],
				$attr['paginateButtonPaddingTopTab'],
				$attr['paginateButtonPaddingRightTab'],
				$attr['paginateButtonPaddingBottomTab'],
				$attr['paginateButtonPaddingLeftTab']
			),
			'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['loadMoreFontSizeTab'], $attr['loadMoreFontSizeType'] ),
			'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['loadMoreLineHeightTab'], $attr['loadMoreLineHeightType'] ),
		],
		$btnBorderCssTablet
	),
	' .vexaltrix-image-gallery__layout--grid'             => [
		'grid-gap' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$gridImageGapTabletFallback,
			$attr['gridImageGapUnitTab']
		),
	],
	' .vexaltrix-image-gallery__layout--isogrid'          => [
		'margin' => \Vexaltrix\Core\Support\Helper::getCssValue(
			-abs( $gridImageGapTabletFallback / 2 ),
			$attr['gridImageGapUnitTab']
		),
	],
	' .vexaltrix-image-gallery__layout--isogrid .vexaltrix-image-gallery__media-wrapper--isotope' => [
		'padding' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$gridImageGapTabletFallback / 2,
			$attr['gridImageGapUnitTab']
		),
	],
	' .vexaltrix-image-gallery__layout--masonry'          => [
		'margin' => \Vexaltrix\Core\Support\Helper::getCssValue(
			-abs( $gridImageGapTabletFallback / 2 ),
			$attr['gridImageGapUnitTab']
		),
	],
	' .vexaltrix-image-gallery__layout--masonry .vexaltrix-image-gallery__media-wrapper--isotope' => [
		'padding' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$gridImageGapTabletFallback / 2,
			$attr['gridImageGapUnitTab']
		),
	],
	' .vexaltrix-image-gallery__layout--carousel .vexaltrix-image-gallery__media-wrapper' => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['gridImageGapUnitTab'],
			0,
			$gridImageGapTabletFallback
		),
	],
	' .vexaltrix-image-gallery__layout--carousel .slick-list' => [
		'margin' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['gridImageGapUnitTab'],
			0,
			-$gridImageGapTabletFallback
		),
	],
	' .vexaltrix-image-gallery__layout--tiled'            => [
		'grid-gap' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$gridImageGapTabletFallback,
			$attr['gridImageGapUnitTab']
		),
	],
	' .vexaltrix-image-gallery__media'                    => $imageBorderCssTablet,
	' .vexaltrix-image-gallery__media-thumbnail-caption'  => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionFontSizeTab'], $attr['captionFontSizeType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionLineHeightTab'], $attr['captionLineHeightType'] ),
		'padding'     => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['captionPaddingUnit'],
			$attr['captionPaddingTop'],
			$attr['captionPaddingRight'],
			$attr['captionPaddingBottom'],
			$attr['captionPaddingLeft']
		),
	],
	' .vexaltrix-image-gallery__media-thumbnail-caption--bar-inside' => $mainTitleBorderCssTablet,
	' .vexaltrix-image-gallery__media-thumbnail-caption--bar-outside' => $mainTitleBorderCssTablet,
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--caption' => [
		'min-height'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxCaptionHeightTablet'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxFontSizeTab'], $attr['lightboxFontSizeType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxLineHeightTab'], $attr['lightboxLineHeightType'] ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--count' => [
		'top'         => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ),
		'left'        => is_rtl() ? '' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ),
		'right'       => is_rtl() ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ) : '',
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeTablet'], 'px' ) ? 'calc(' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeTablet'], 'px' ) . ' * 3 / 4 )' : '',
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeTablet'], 'px' ) ? 'calc(' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeTablet'], 'px' ) . ' * 3 / 4 )' : '',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--close' => [
		'top'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ),
		'right' => is_rtl() ? '' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ),
		'left'  => is_rtl() ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ) : '',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--close svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeTablet'], 'px' ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeTablet'], 'px' ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main .swiper-button-prev' => [
		'left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main .swiper-button-next' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main.swiper-rtl .swiper-button-prev' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ),
		'left'  => 'auto',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main.swiper-rtl .swiper-button-next' => [
		'left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceTablet'], 'px' ),
		'right' => 'auto',
	],
];

$mSelectors = [
	'.wp-block-vxt-image-gallery'                      => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['feedMarginUnitMob'],
			$attr['feedMarginTopMob'],
			$attr['feedMarginRightMob'],
			$attr['feedMarginBottomMob'],
			$attr['feedMarginLeftMob']
		),
	],
	' .vexaltrix-image-gallery__control-arrows--carousel' => $arrowBorderCssMobile,
	' .vexaltrix-image-gallery__control-button'           => array_merge(
		[
			'padding'     => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
				$attr['paginateButtonPaddingUnitMob'],
				$attr['paginateButtonPaddingTopMob'],
				$attr['paginateButtonPaddingRightMob'],
				$attr['paginateButtonPaddingBottomMob'],
				$attr['paginateButtonPaddingLeftMob']
			),
			'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['loadMoreFontSizeMob'], $attr['loadMoreFontSizeType'] ),
			'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['loadMoreLineHeightMob'], $attr['loadMoreLineHeightType'] ),
		],
		$btnBorderCssMobile
	),
	' .vexaltrix-image-gallery__layout--grid'             => [
		'grid-gap' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$gridImageGapMobileFallback,
			$attr['gridImageGapUnitMob']
		),
	],
	' .vexaltrix-image-gallery__layout--isogrid'          => [
		'margin' => \Vexaltrix\Core\Support\Helper::getCssValue(
			-abs( $gridImageGapMobileFallback / 2 ),
			$attr['gridImageGapUnitMob']
		),
	],
	' .vexaltrix-image-gallery__layout--isogrid .vexaltrix-image-gallery__media-wrapper--isotope' => [
		'padding' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$gridImageGapMobileFallback / 2,
			$attr['gridImageGapUnitMob']
		),
	],
	' .vexaltrix-image-gallery__layout--masonry'          => [
		'margin' => \Vexaltrix\Core\Support\Helper::getCssValue(
			-abs( $gridImageGapMobileFallback / 2 ),
			$attr['gridImageGapUnitMob']
		),
	],
	' .vexaltrix-image-gallery__layout--masonry .vexaltrix-image-gallery__media-wrapper--isotope' => [
		'padding' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$gridImageGapMobileFallback / 2,
			$attr['gridImageGapUnitMob']
		),
	],
	' .vexaltrix-image-gallery__layout--carousel .vexaltrix-image-gallery__media-wrapper' => [
		'padding' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['gridImageGapUnitMob'],
			0,
			$gridImageGapMobileFallback
		),
	],
	' .vexaltrix-image-gallery__layout--carousel .slick-list' => [
		'margin' => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['gridImageGapUnitMob'],
			0,
			-$gridImageGapMobileFallback
		),
	],
	' .vexaltrix-image-gallery__layout--tiled .vexaltrix-image-gallery__media-wrapper' => [
		'grid-gap' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$gridImageGapMobileFallback,
			$attr['gridImageGapUnitMob']
		),
	],
	' .vexaltrix-image-gallery__media'                    => $imageBorderCssMobile,
	' .vexaltrix-image-gallery__media-thumbnail-caption'  => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionFontSizeMob'], $attr['captionFontSizeType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['captionLineHeightMob'], $attr['captionLineHeightType'] ),
		'padding'     => \Vexaltrix\Presentation\Blocks\BlockHelper::generateSpacing(
			$attr['captionPaddingUnit'],
			$attr['captionPaddingTop'],
			$attr['captionPaddingRight'],
			$attr['captionPaddingBottom'],
			$attr['captionPaddingLeft']
		),
	],
	' .vexaltrix-image-gallery__media-thumbnail-caption--bar-inside' => $mainTitleBorderCssMobile,
	' .vexaltrix-image-gallery__media-thumbnail-caption--bar-outside' => $mainTitleBorderCssMobile,
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--caption' => [
		'min-height'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxCaptionHeightMobile'], 'px' ),
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxFontSizeMob'], $attr['lightboxFontSizeType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxLineHeightMob'], $attr['lightboxLineHeightType'] ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--count' => [
		'top'         => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ),
		'left'        => is_rtl() ? '' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ),
		'right'       => is_rtl() ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ) : '',
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeMobile'], 'px' ) ? 'calc(' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeMobile'], 'px' ) . ' * 3 / 4 )' : '',
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeMobile'], 'px' ) ? 'calc(' . \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeMobile'], 'px' ) . ' * 3 / 4 )' : '',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--close' => [
		'top'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ),
		'right' => is_rtl() ? '' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ),
		'left'  => is_rtl() ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ) : '',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--close svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeMobile'], 'px' ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxIconSizeMobile'], 'px' ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main .swiper-button-prev' => [
		'left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main .swiper-button-next' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ),
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main.swiper-rtl .swiper-button-prev' => [
		'right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ),
		'left'  => 'auto',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main.swiper-rtl .swiper-button-next' => [
		'left'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lightboxEdgeDistanceMobile'], 'px' ),
		'right' => 'auto',
	],
	// Arrow Size can be implemented for all other screen sizes if needed.
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main .swiper-button-prev::after' => [
		'font-size' => '24px',
	],
	'+.vexaltrix-image-gallery__control-lightbox .vexaltrix-image-gallery__control-lightbox--main .swiper-button-next::after' => [
		'font-size' => '24px',
	],
];

// Background Effect based styling.
switch ( $attr['captionBackgroundEffect'] ) {
	case 'none':
		$selectors[' .vexaltrix-image-gallery__media-thumbnail']['-webkit-filter'] = 'none';
		$selectors[' .vexaltrix-image-gallery__media-thumbnail']['filter']         = 'none';
		break;
	case 'grayscale':
	case 'sepia':
		$selectors[' .vexaltrix-image-gallery__media-thumbnail']['-webkit-filter'] = $attr['captionBackgroundEffect'] . '(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundEffectAmount'],
			'%'
		) . ')';
		$selectors[' .vexaltrix-image-gallery__media-thumbnail']['filter']         = $attr['captionBackgroundEffect'] . '(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundEffectAmount'],
			'%'
		) . ')';
		break;
};
switch ( $attr['captionBackgroundEffectHover'] ) {
	case 'none':
		$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail']['-webkit-filter']         = 'none';
		$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail']['filter']                 = 'none';
		$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail']['-webkit-filter'] = 'none';
		$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail']['filter']         = 'none';
		break;
	case 'grayscale':
	case 'sepia':
		$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail']['-webkit-filter']         = $attr['captionBackgroundEffectHover'] . '(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundEffectAmountHover'],
			'%'
		) . ')';
		$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail']['filter']                 = $attr['captionBackgroundEffectHover'] . '(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundEffectAmountHover'],
			'%'
		) . ')';
		$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail']['-webkit-filter'] = $attr['captionBackgroundEffectHover'] . '(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundEffectAmountHover'],
			'%'
		) . ')';
		$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail']['filter']         = $attr['captionBackgroundEffectHover'] . '(' . \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionBackgroundEffectAmountHover'],
			'%'
		) . ')';
		break;
};
if ( ! $attr['captionBackgroundEnableBlur'] ) {
	$selectors[' .vexaltrix-image-gallery__media-thumbnail-blurrer']['-webkit-backdrop-filter'] = 'none';
	$selectors[' .vexaltrix-image-gallery__media-thumbnail-blurrer']['backdrop-filter']         = 'none';
	$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-blurrer']['-webkit-backdrop-filter']         = 'none';
	$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-blurrer']['backdrop-filter']                 = 'none';
	$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-blurrer']['-webkit-backdrop-filter'] = 'none';
	$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-blurrer']['backdrop-filter']         = 'none';
}

// Caption Type based styling.
if ( $attr['imageDisplayCaption'] && ( 'bar-outside' === $attr['captionDisplayType'] ) ) {
	if ( 'top' === $attr['imageCaptionAlignment01'] ) {
		$selectors[' .vexaltrix-image-gallery__media-thumbnail-caption-wrapper']['margin-bottom'] = \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionGap'],
			$attr['captionGapUnit']
		);
	} else {
		$selectors[' .vexaltrix-image-gallery__media-thumbnail-caption-wrapper']['margin-top'] = \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['captionGap'],
			$attr['captionGapUnit']
		);
	}
}

// Grid based styling.
if ( 'grid' === $attr['feedLayout'] && $attr['feedPagination'] ) {
	$selectors[' .vexaltrix-image-gallery__control-wrapper']['margin-top'] = \Vexaltrix\Core\Support\Helper::getCssValue(
		$paginateDotDistanceFallback,
		$attr['paginateDotDistanceUnit']
	);
}

// Carousel based styling.
if ( 'carousel' === $attr['feedLayout'] ) {
	if ( $attr['carouselSquares'] ) {
		$selectors[' .vexaltrix-image-gallery__media--carousel']['aspect-ratio']            = 1;
		$selectors[' .vexaltrix-image-gallery__media-thumbnail--carousel']['height']        = '100%';
		$selectors[' .vexaltrix-image-gallery__media-thumbnail--carousel']['width']         = '100%';
		$selectors[' .vexaltrix-image-gallery__media-thumbnail--carousel']['-o-object-fit'] = 'cover';
		$selectors[' .vexaltrix-image-gallery__media-thumbnail--carousel']['object-fit']    = 'cover';
	}
} else {
	$selectors[' .vexaltrix-image-gallery__iso-ref-wrapper']['overflow'] = 'auto';
}

// Masonry based styling.
if ( 'masonry' === $attr['feedLayout'] && $attr['feedPagination'] && ! $attr['paginateUseLoader'] ) {
	$selectors[' .vexaltrix-image-gallery__control-wrapper']['-webkit-justify-content'] = $attr['paginateButtonAlign'];
	$selectors[' .vexaltrix-image-gallery__control-wrapper']['justify-content']         = $attr['paginateButtonAlign'];
	$selectors[' .vexaltrix-image-gallery__control-wrapper']['-webkit-align-items']     = 'center';
	$selectors[' .vexaltrix-image-gallery__control-wrapper']['align-items']             = 'center';
}

// New Zoom Effect on Hover.
switch ( $attr['imageZoomType'] ) {
	case 'zoom-in':
		if ( $attr['imageEnableZoom'] ) {
			$selectors[' .vexaltrix-image-gallery__media-thumbnail']['transform'] = 'scale3d(1.005, 1.005, 1.005)';
			$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail']['transform']         = 'scale3d(1.1, 1.1, 1.1)';
			$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail']['transform'] = 'scale3d(1.1, 1.1, 1.1)';
		}
		break;
	case 'zoom-out':
		if ( $attr['imageEnableZoom'] ) {
			$selectors[' .vexaltrix-image-gallery__media-thumbnail']['transform'] = 'scale3d(1.1, 1.1, 1.1)';
			$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail']['transform']         = 'scale3d(1.005, 1.005, 1.005)';
			$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail']['transform'] = 'scale3d(1.005, 1.005, 1.005)';
		}
		break;
}


// Box Shadow Application Based on Type.
if ( 'outset' === $attr['imageBoxShadowPosition'] ) {
	$selectors[' .vexaltrix-image-gallery__media']['box-shadow']                   = $imageBoxShadowCss;
	$selectors[' .vexaltrix-image-gallery__media-thumbnail-blurrer']['box-shadow'] = '0 0 transparent' . (
		( 'inset' === $attr['imageBoxShadowPositionHover'] ) ? ( ' ' . $attr['imageBoxShadowPositionHover'] ) : ''
	);
} else {
	$selectors[' .vexaltrix-image-gallery__media-thumbnail-blurrer']['box-shadow'] = $imageBoxShadowCss;
	$selectors[' .vexaltrix-image-gallery__media']['box-shadow']                   = '0 0 transparent' . (
		( 'inset' === $attr['imageBoxShadowPositionHover'] ) ? ( ' ' . $attr['imageBoxShadowPositionHover'] ) : ''
	);
}

if ( 'outset' === $attr['imageBoxShadowPositionHover'] ) {
	$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media']['box-shadow']                           = $imageBoxShadowHoverCss;
	$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-blurrer']['box-shadow']         = '0 0 transparent' . (
		( 'inset' === $attr['imageBoxShadowPosition'] ) ? ( ' ' . $attr['imageBoxShadowPosition'] ) : ''
	);
	$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media']['box-shadow']                   = $imageBoxShadowHoverCss;
	$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-blurrer']['box-shadow'] = '0 0 transparent' . (
		( 'inset' === $attr['imageBoxShadowPosition'] ) ? ( ' ' . $attr['imageBoxShadowPosition'] ) : ''
	);
} else {
	$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-blurrer']['box-shadow']         = $imageBoxShadowHoverCss;
	$selectors[' .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media']['box-shadow']                           = '0 0 transparent' . (
		( 'inset' === $attr['imageBoxShadowPosition'] ) ? ( ' ' . $attr['imageBoxShadowPosition'] ) : ''
	);
	$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media-thumbnail-blurrer']['box-shadow'] = $imageBoxShadowHoverCss;
	$selectors[' .vexaltrix-image-gallery__media-wrapper:focus-visible .vexaltrix-image-gallery__media']['box-shadow']                   = '0 0 transparent' . (
		( 'inset' === $attr['imageBoxShadowPosition'] ) ? ( ' ' . $attr['imageBoxShadowPosition'] ) : ''
	);
}

// Slick Dot Positioning in the Editor.
$selectors[' .vexaltrix-image-gallery__layout--carousel .slick-dots']['margin-bottom'] = '30px !important';

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getCombinedSelectors(
	'image-gallery',
	[
		'desktop' => $selectors,
		'tablet'  => $tSelectors,
		'mobile'  => $mSelectors,
	],
	$attr
);

$baseSelector = '.vxt-block-';

$cssOutput = \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );

// Touch device caption fix: on devices without hover (phones/tablets),
// "Hide On Hover" captions must stay visible (users can't hover to hide them).
// "Show On Hover" is left as-is — respects user's intent to keep captions hidden.
// Transition + GPU fix for 'antiHover' and 'always' prevents iOS Safari flicker.
if ( $attr['imageDisplayCaption'] && 'hover' !== $attr['captionVisibility'] ) {
	$blockSel  = $baseSelector . $id;
	$touchSel  = '.vexaltrix-touch-device' . $blockSel;
	$captionBg = $attr['captionBackgroundColor'] ? $attr['captionBackgroundColor'] : $attr['overlayColor'];

	$rules = '';
	// Color overrides: force visible caption colors on :hover for 'antiHover' mode.
	if ( 'antiHover' === $attr['captionVisibility'] ) {
		$rules .= '{sel} .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption{color:' . $attr['captionColor'] . ' !important;}';
		$rules .= '{sel} .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption a{color:' . $attr['captionColor'] . ' !important;}';
		$rules .= '{sel} .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption-wrapper--overlay{background-color:' . $captionBg . ' !important;}';
		$rules .= '{sel} .vexaltrix-image-gallery__media-wrapper:hover .vexaltrix-image-gallery__media-thumbnail-caption--bar-inside{background-color:' . $attr['captionBackgroundColor'] . ' !important;}';
	}

	// Transition + GPU compositing fix (prevents iOS Safari repaint flash
	// during Slick carousel translate3d slide animation).
	$rules .= '{sel} .vexaltrix-image-gallery__media-thumbnail-caption,'
		. '{sel} .vexaltrix-image-gallery__media-thumbnail-caption-wrapper{transition:none !important;-webkit-backface-visibility:hidden;backface-visibility:hidden;}';
	$rules .= '{sel} .vexaltrix-image-gallery__media-thumbnail-caption-wrapper--overlay,'
		. '{sel} .vexaltrix-image-gallery__media-thumbnail-caption--bar-inside{-webkit-backface-visibility:hidden;backface-visibility:hidden;-webkit-transform:translateZ(0);transform:translateZ(0);}';

	// JS class-based detection (matchMedia for hover:none).
	$cssOutput['desktop'] .= str_replace( '{sel}', $touchSel, $rules );
	// CSS media query fallback: covers all touch-only devices.
	$cssOutput['desktop'] .= '@media(hover:none),(pointer:coarse){' . str_replace( '{sel}', $blockSel, $rules ) . '}';
}

return $cssOutput;
