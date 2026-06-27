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
\Vexaltrix\Core\Blocks\BlockJs::blocksInfoBoxGfont( $attr );

$mSelectors = [];
$tSelectors = [];

$rtlSelectors   = [];
$rtlTSelectors = [];
$rtlMSelectors = [];

$attr['iconSizeTablet'] = is_numeric( $attr['iconSizeTablet'] ) ? $attr['iconSizeTablet'] : $attr['iconSize'];
$attr['iconSizeMobile'] = is_numeric( $attr['iconSizeMobile'] ) ? $attr['iconSizeMobile'] : $attr['iconSizeTablet'];

$attr['ctaIconSpaceTablet'] = is_numeric( $attr['ctaIconSpaceTablet'] ) ? $attr['ctaIconSpaceTablet'] : $attr['ctaIconSpace'];
$attr['ctaIconSpaceMobile'] = is_numeric( $attr['ctaIconSpaceMobile'] ) ? $attr['ctaIconSpaceMobile'] : $attr['ctaIconSpaceTablet'];

$attr['imageWidthTablet'] = is_numeric( $attr['imageWidthTablet'] ) ? $attr['imageWidthTablet'] : $attr['imageWidth'];
$attr['imageWidthMobile'] = is_numeric( $attr['imageWidthMobile'] ) ? $attr['imageWidthMobile'] : $attr['imageWidthTablet'];

$ctaIconSize    = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaFontSize'], $attr['ctaFontSizeType'] );
$mCtaIconSize  = isset( $attr['ctaFontSizeMobile'] ) && isset( $attr['ctaFontSizeTypeMobile'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['ctaFontSizeMobile'], $attr['ctaFontSizeTypeMobile'] ) : $ctaIconSize;
$tCtaIconSize  = isset( $attr['ctaFontSizeTablet'] ) && isset( $attr['ctaFontSizeTypeTablet'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['ctaFontSizeTablet'], $attr['ctaFontSizeTypeTablet'] ) : $ctaIconSize;
$iconSize        = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeType'] );
$iconSizeTablet = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSizeTablet'], $attr['iconSizeType'] );
$iconSizeMobile = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSizeMobile'], $attr['iconSizeType'] );

$iconPaddingTop          = is_int( $attr['iconTopMargin'] ) ? $attr['iconTopMargin'] : 0;
$iconPaddingBottom       = is_int( $attr['iconBottomMargin'] ) ? $attr['iconBottomMargin'] : 0;
$iconPaddingLeft         = is_int( $attr['iconLeftMargin'] ) ? $attr['iconLeftMargin'] : 0;
$iconPaddingRight        = is_int( $attr['iconRightMargin'] ) ? $attr['iconRightMargin'] : 0;
$boxSizingIcon           = ( '%' === $attr['iconSizeType'] ) ? 'border-box' : 'content-box';
$boxSizingImage          = ( '%' === $attr['imageWidthUnit'] ) ? 'border-box' : 'content-box';
$boxSizingImageTablet   = ( '%' === $attr['imageWidthUnitTablet'] ) ? 'border-box' : 'content-box';
$boxSizingImageMobile   = ( '%' === $attr['imageWidthUnitMobile'] ) ? 'border-box' : 'content-box';
$infoboxBorderCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'infobox' );
$infoboxBorderCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'infobox', 'tablet' );
$infoboxBorderCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'infobox', 'mobile' );


$selectors = [
	' .vxt-ifb-icon'                                     => [
		'width'       => $iconSize,
		'line-height' => $iconSize,
	],
	' .vxt-ifb-icon > span'                              => [
		'font-size'   => $iconSize,
		'width'       => $iconSize,
		'line-height' => $iconSize,
		'color'       => $attr['iconColor'],
	],
	' .vxt-ifb-icon svg'                                 => [ // For Backword.
		'fill' => $attr['iconColor'],
	],
	'.vxt-infobox__content-wrap .vxt-ifb-icon-wrap svg' => [
		'width'       => $iconSize,
		'height'      => $iconSize,
		'line-height' => $iconSize,
		'font-size'   => $iconSize,
		'color'       => $attr['iconColor'],
		'fill'        => $attr['iconColor'],
	],
	' .vxt-ifb-content .vxt-ifb-icon-wrap svg'          => [
		'line-height' => $iconSize,
		'font-size'   => $iconSize,
		'color'       => $attr['iconColor'],
		'fill'        => $attr['iconColor'],
	],
	' .vxt-iconbox-icon-wrap'                            => [
		'margin'          => 'auto',
		'display'         => 'inline-flex',
		'align-items'     => 'center',
		'justify-content' => 'center',
		'box-sizing'      => 'content-box',
		'width'           => $iconSize,
		'height'          => $iconSize,
		'line-height'     => $iconSize,
		'padding-left'    => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-right'   => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
		'padding-top'     => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingTop, $attr['iconMarginUnit'] ),
		'padding-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingBottom, $attr['iconMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-icon-wrap > svg' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingTop, $attr['iconMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingBottom, $attr['iconMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-icon-wrap > svg' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingTop, $attr['iconMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingBottom, $attr['iconMarginUnit'] ),
	],
	' .vxt-ifb-content .vxt-ifb-left-title-image svg'   => [
		'width'       => $iconSize,
		'line-height' => $iconSize,
		'font-size'   => $iconSize,
		'color'       => $attr['iconColor'],
		'fill'        => $attr['iconColor'],
	],
	' .vxt-ifb-content .vxt-ifb-right-title-image svg'  => [
		'width'       => $iconSize,
		'line-height' => $iconSize,
		'font-size'   => $iconSize,
		'color'       => $attr['iconColor'],
		'fill'        => $attr['iconColor'],
	],
	' .vxt-ifb-content .vxt-ifb-icon-wrap svg:hover'    => [
		'fill'  => $attr['iconHover'],
		'color' => $attr['iconHover'],
	],
	'.vxt-infobox-icon-right .vxt-ifb-icon-wrap > svg:hover' => [
		'fill'  => $attr['iconHover'],
		'color' => $attr['iconHover'],
	],
	'.vxt-infobox-icon-left .vxt-ifb-icon-wrap > svg:hover' => [
		'fill'  => $attr['iconHover'],
		'color' => $attr['iconHover'],
	],
	' .vxt-infbox__link-to-all:hover ~.vxt-ifb-content .vxt-ifb-icon-wrap svg' => [
		'fill' => $attr['iconHover'],
	],
	'.vxt-infbox__link-to-all:hover ~.vxt-infobox__content-wrap svg' => [
		'fill' => $attr['iconHover'],
	],
	' .vxt-infbox__link-to-all:focus ~.vxt-ifb-content .vxt-ifb-icon-wrap svg' => [
		'fill' => $attr['iconHover'],
	],
	'.vxt-infbox__link-to-all:focus ~.vxt-infobox__content-wrap svg' => [
		'fill' => $attr['iconHover'],
	],
	// Img Style.
	' .vxt-infobox__content-wrap .vxt-ifb-imgicon-wrap' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingTop, $attr['iconMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingBottom, $attr['iconMarginUnit'] ),
	],
	' .vxt-infobox .vxt-ifb-image-content img'          => [
		'border-radius' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconimgBorderRadius'], $attr['iconimgBorderRadiusUnit'] ),
	],
	'.vxt-infobox__content-wrap img'                     => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingTop, $attr['iconMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingBottom, $attr['iconMarginUnit'] ),
		'border-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconimgBorderRadius'], $attr['iconimgBorderRadiusUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-right-title-image > img' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingTop, $attr['iconMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingBottom, $attr['iconMarginUnit'] ),
		'border-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconimgBorderRadius'], $attr['iconimgBorderRadiusUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-left-title-image > img' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingTop, $attr['iconMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingBottom, $attr['iconMarginUnit'] ),
		'border-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconimgBorderRadius'], $attr['iconimgBorderRadiusUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content > img' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingTop, $attr['iconMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingBottom, $attr['iconMarginUnit'] ),
		'border-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconimgBorderRadius'], $attr['iconimgBorderRadiusUnit'] ),
	],
	// Prefix Style.
	' .vxt-ifb-title-wrap .vxt-ifb-title-prefix'        => [
		'color'         => $attr['prefixColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixSpace'], $attr['prefixSpaceUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixTopMargin'], $attr['prefixSpaceUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixLeftMargin'], $attr['prefixSpaceUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixRightMargin'], $attr['prefixSpaceUnit'] ),
	],
	// Title Style.
	'.wp-block-vxt-info-box .vxt-ifb-title'             => [
		'color'         => $attr['headingColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headSpace'], $attr['headSpaceUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['headTopMargin'], $attr['headSpaceUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['headLeftMargin'], $attr['headSpaceUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['headRightMargin'], $attr['headSpaceUnit'] ),
	],
	// Description Style.
	'.wp-block-vxt-info-box .vxt-ifb-desc'              => [
		'color'         => $attr['subHeadingColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadSpace'], $attr['subHeadSpaceUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadTopMargin'], $attr['subHeadSpaceUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadLeftMargin'], $attr['subHeadSpaceUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadRightMargin'], $attr['subHeadSpaceUnit'] ),
	],
	// Seperator.
	' .vxt-ifb-separator'                                => [
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorWidth'], $attr['separatorWidthType'] ),
		'border-top-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorThickness'], $attr['thicknessUnit'] ),
		'border-top-color' => $attr['seperatorColor'],
		'border-top-style' => $attr['seperatorStyle'],
		'margin-bottom'    => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorSpace'], $attr['seperatorSpaceUnit'] ),
		'margin-top'       => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorTopMargin'], $attr['seperatorSpaceUnit'] ),
		'margin-left'      => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorLeftMargin'], $attr['seperatorSpaceUnit'] ),
		'margin-right'     => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorRightMargin'], $attr['seperatorSpaceUnit'] ),
	],
	' .vxt-infobox__content-wrap .vxt-ifb-separator'    => [
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorWidth'], $attr['separatorWidthType'] ),
		'border-top-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorThickness'], $attr['thicknessUnit'] ),
		'border-top-color' => $attr['seperatorColor'],
		'border-top-style' => $attr['seperatorStyle'],
	],
	// CTA icon space for Backword compatibility.
	' .vxt-ifb-align-icon-after'                         => [
		'margin-left' => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpace'], 'px' ),
	],
	' .vxt-ifb-align-icon-before'                        => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpace'], 'px' ),
	],
	// image svg.
	'.vxt-infobox__content-wrap .vxt-ifb-content svg'   => [
		'box-sizing' => $boxSizingIcon,
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content img'   => [
		'box-sizing' => $boxSizingImage,
	],
	'.vxt-infobox__content-wrap'                         => $infoboxBorderCss,
	'.vxt-infobox__content-wrap:hover'                   => [
		'border-color' => $attr['infoboxBorderHColor'],
	], 
];

$rtlSelectors = [
	' .vxt-iconbox-icon-wrap'                            => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-icon-wrap > svg' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-icon-wrap > svg' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap img'                     => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-right-title-image > img' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-left-title-image > img' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content > img' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingLeft, $attr['iconMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $iconPaddingRight, $attr['iconMarginUnit'] ),
	],
];

if ( 'Stacked' === $attr['iconView'] ) {
	$selectors[' .vxt-iconbox-icon-wrap.vxt-infobox-shape-circle'] = [
		'background-color' => $attr['iconBackgroundColor'],
		'border-radius'    => '50%',
	];
	$selectors[' .vxt-iconbox-icon-wrap.vxt-infobox-shape-squre']  = [
		'background-color' => $attr['iconBackgroundColor'],
	];
	$selectors[' .vxt-iconbox-icon-wrap:hover']                     = [
		'background-color' => $attr['iconBackgroundHoverColor'] . ' !important',
	];
} elseif ( 'Framed' === $attr['iconView'] ) {
	$selectors[' .vxt-iconbox-icon-wrap.vxt-infobox-shape-circle'] = [
		'border'        => $attr['iconBorderWidth'] . 'px solid ' . $attr['iconBackgroundColor'],
		'border-radius' => '50%',
	];
	$selectors[' .vxt-iconbox-icon-wrap.vxt-infobox-shape-squre']  = [
		'border' => $attr['iconBorderWidth'] . 'px solid ' . $attr['iconBackgroundColor'],
	];
	$selectors[' .vxt-iconbox-icon-wrap:hover']                     = [
		'border' => $attr['iconBorderWidth'] . 'px solid ' . $attr['iconBackgroundHoverColor'],
	];
}
if ( 'text' === $attr['ctaType'] && ! $attr['inheritFromTheme'] ) {
	$selectors[' div.vxt-ifb-button-wrapper a.vxt-infobox-cta-link']       = [
		'text-decoration' => $attr['ctaDecoration'],
		'color'           => $attr['ctaLinkColor'],
	];
	$selectors[' div.vxt-ifb-button-wrapper a.vxt-infobox-cta-link:hover'] = [
		'color' => $attr['ctaLinkHoverColor'],
	];
	$selectors[' div.vxt-ifb-button-wrapper a.vxt-infobox-cta-link:focus'] = [
		'color' => $attr['ctaLinkHoverColor'],
	];
	$selectors[' .vxt-infobox-cta-link:hover svg']                          = [
		'fill' => $attr['ctaLinkHoverColor'],
	];
	$selectors[' .vxt-infobox-cta-link:focus svg']                          = [
		'fill' => $attr['ctaLinkHoverColor'],
	];
	$selectors[' .vxt-infobox-cta-link svg']                                = [
		'font-size'   => $ctaIconSize,
		'height'      => $ctaIconSize,
		'width'       => $ctaIconSize,
		'line-height' => $ctaIconSize,
		'fill'        => $attr['ctaLinkColor'],
	];
}

$mSelectors = [
	' .vxt-ifb-title-wrap .vxt-ifb-title-prefix'         => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixMobileSpace'], $attr['prefixMobileMarginUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixMarginTopMobile'], $attr['prefixMobileMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixMarginLeftMobile'], $attr['prefixMobileMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixMarginRightMobile'], $attr['prefixMobileMarginUnit'] ),
	],
	'.wp-block-vxt-info-box .vxt-ifb-title'              => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headMobileSpace'], $attr['headMobileMarginUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['headMarginTopMobile'], $attr['headMobileMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['headMarginLeftMobile'], $attr['headMobileMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['headMarginRightMobile'], $attr['headMobileMarginUnit'] ),
	],
	'.wp-block-vxt-info-box .vxt-ifb-desc'               => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadMobileSpace'], $attr['subHeadMobileMarginUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadMarginTopMobile'], $attr['subHeadMobileMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadMarginLeftMobile'], $attr['subHeadMobileMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadMarginRightMobile'], $attr['subHeadMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-separator'      => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorMobileSpace'], $attr['separatorMobileMarginUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorMarginTopMobile'], $attr['separatorMobileMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorMarginLeftMobile'], $attr['separatorMobileMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorMarginRightMobile'], $attr['separatorMobileMarginUnit'] ),
	],
	' .vxt-infobox-cta-link svg'                          => [
		'font-size'   => $mCtaIconSize,
		'height'      => $mCtaIconSize,
		'width'       => $mCtaIconSize,
		'line-height' => $mCtaIconSize,
	],
	'.vxt-infobox__content-wrap .vxt-ifb-icon-wrap > svg' => [
		'width'          => $iconSizeMobile,
		'height'         => $iconSizeMobile,
		'line-height'    => $iconSizeMobile,
		'font-size'      => $iconSizeMobile,
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-icon-wrap > svg' => [
		'line-height'    => $iconSizeMobile,
		'font-size'      => $iconSizeMobile,
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-right-title-image img' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-left-title-image img' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap > svg'                    => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	' .vxt-ifb-content > svg'                             => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	' .vxt-ifb-content .vxt-ifb-left-title-image > svg'  => [
		'width'          => $iconSizeMobile,
		'line-height'    => $iconSizeMobile,
		'font-size'      => $iconSizeMobile,
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	' .vxt-ifb-content .vxt-ifb-right-title-image > svg' => [
		'width'          => $iconSizeMobile,
		'line-height'    => $iconSizeMobile,
		'font-size'      => $iconSizeMobile,
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap img'                      => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),
	],
	' .vxt-ifb-separator'                                 => [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorWidthMobile'], $attr['separatorWidthType'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content img'    => [
		'box-sizing' => $boxSizingImageMobile,
	],
	' .vxt-ifb-icon'                                      => [
		'width'       => $iconSizeMobile,
		'line-height' => $iconSizeMobile,
	],
	' .vxt-ifb-icon > span'                               => [
		'font-size'   => $iconSizeMobile,
		'width'       => $iconSizeMobile,
		'line-height' => $iconSizeMobile,
	],
	' .vxt-iconbox-icon-wrap'                             => [
		'width'          => $iconSizeMobile,
		'height'         => $iconSizeMobile,
		'line-height'    => $iconSizeMobile,
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomMobile'], $attr['iconMobileMarginUnit'] ),

	],
	'.vxt-infobox__content-wrap'                          => $infoboxBorderCssMobile, 
];

$rtlMSelectors = [
	'.vxt-infobox__content-wrap .vxt-ifb-icon-wrap > svg' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-icon-wrap > svg' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-right-title-image img' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-left-title-image img' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap > svg'                    => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
	' .vxt-ifb-content > svg'                             => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
	' .vxt-ifb-content .vxt-ifb-left-title-image > svg'  => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
	' .vxt-ifb-content .vxt-ifb-right-title-image > svg' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap img'                      => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftMobile'], $attr['iconMobileMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightMobile'], $attr['iconMobileMarginUnit'] ),
	],
];

$tSelectors = [
	' .vxt-ifb-title-wrap .vxt-ifb-title-prefix'         => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixTabletSpace'], $attr['prefixTabletMarginUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixMarginTopTablet'], $attr['prefixTabletMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixMarginLeftTablet'], $attr['prefixTabletMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixMarginRightTablet'], $attr['prefixTabletMarginUnit'] ),
	],
	'.wp-block-vxt-info-box .vxt-ifb-title'              => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['headTabletSpace'], $attr['headTabletMarginUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['headMarginTopTablet'], $attr['headTabletMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['headMarginLeftTablet'], $attr['headTabletMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['headMarginRightTablet'], $attr['headTabletMarginUnit'] ),
	],
	'.wp-block-vxt-info-box .vxt-ifb-desc'               => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadTabletSpace'], $attr['subHeadTabletMarginUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadMarginTopTablet'], $attr['subHeadTabletMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadMarginLeftTablet'], $attr['subHeadTabletMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['subHeadMarginRightTablet'], $attr['subHeadTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-separator'      => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorTabletSpace'], $attr['separatorTabletMarginUnit'] ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorMarginTopTablet'], $attr['separatorTabletMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorMarginLeftTablet'], $attr['separatorTabletMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['separatorMarginRightTablet'], $attr['separatorTabletMarginUnit'] ),
	],
	' .vxt-infobox-cta-link svg'                          => [
		'font-size'   => $tCtaIconSize,
		'height'      => $tCtaIconSize,
		'width'       => $tCtaIconSize,
		'line-height' => $tCtaIconSize,
	],
	'.vxt-infobox__content-wrap .vxt-ifb-icon-wrap > svg' => [
		'width'          => $iconSizeTablet,
		'height'         => $iconSizeTablet,
		'line-height'    => $iconSizeTablet,
		'font-size'      => $iconSizeTablet,
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-icon-wrap > svg' => [
		'line-height'    => $iconSizeTablet,
		'font-size'      => $iconSizeTablet,
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-right-title-image img' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-left-title-image img' => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap > svg'                    => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	' .vxt-ifb-content > svg'                             => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	' .vxt-infobox-icon-right:hover > svg'                => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	' .vxt-infobox-icon-left:hover > svg'                 => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap img'                      => [
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),
	],
	' .vxt-ifb-separator'                                 => [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['seperatorWidthTablet'], $attr['separatorWidthType'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content img'    => [
		'box-sizing' => $boxSizingImageTablet,
	],
	' .vxt-ifb-icon'                                      => [
		'width'       => $iconSizeTablet,
		'line-height' => $iconSizeTablet,
	],
	' .vxt-ifb-icon > span'                               => [
		'font-size'   => $iconSizeTablet,
		'width'       => $iconSizeTablet,
		'line-height' => $iconSizeTablet,
	],
	' .vxt-iconbox-icon-wrap'                             => [
		'width'          => $iconSizeTablet,
		'height'         => $iconSizeTablet,
		'line-height'    => $iconSizeTablet,
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginTopTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginBottomTablet'], $attr['iconTabletMarginUnit'] ),

	],
	' .vxt-ifb-content .vxt-ifb-left-title-image > svg'  => [
		'width'       => $iconSizeTablet,
		'line-height' => $iconSizeTablet,
		'font-size'   => $iconSizeTablet,
	],
	' .vxt-ifb-content .vxt-ifb-right-title-image > svg' => [
		'width'       => $iconSizeTablet,
		'line-height' => $iconSizeTablet,
		'font-size'   => $iconSizeTablet,
	],
	'.vxt-infobox__content-wrap'                          => $infoboxBorderCssTablet, 
];

$rtlTSelectors = [
	'.vxt-infobox__content-wrap .vxt-ifb-icon-wrap > svg' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-icon-wrap > svg' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-right-title-image img' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap .vxt-ifb-content .vxt-ifb-left-title-image img' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap > svg'     => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
	' .vxt-ifb-content > svg'              => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
	' .vxt-infobox-icon-right:hover > svg' => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
	' .vxt-infobox-icon-left:hover > svg'  => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
	'.vxt-infobox__content-wrap img'       => [
		'padding-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginLeftTablet'], $attr['iconTabletMarginUnit'] ),
		'padding-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['iconMarginRightTablet'], $attr['iconTabletMarginUnit'] ),
	],
];

if ( 'above-title' === $attr['iconimgPosition'] || 'below-title' === $attr['iconimgPosition'] ) { // For backward user.
	$selectors[' .vxt-infobox__content-wrap'] = [
		'text-align' => $attr['headingAlign'],
	];
}

if ( 'above-title' === $attr['iconimgPosition'] ) {
	$selectors['.vxt-infobox-icon-above-title']   = [
		'text-align' => $attr['headingAlign'],
	];
	$tSelectors['.vxt-infobox-icon-above-title'] = [
		'text-align' => $attr['headingAlignTablet'],
	];
	$mSelectors['.vxt-infobox-icon-above-title'] = [
		'text-align' => $attr['headingAlignMobile'],
	];
} elseif ( 'below-title' === $attr['iconimgPosition'] ) {
	$selectors['.vxt-infobox-icon-below-title']   = [
		'text-align' => $attr['headingAlign'],
	];
	$tSelectors['.vxt-infobox-icon-below-title'] = [
		'text-align' => $attr['headingAlignTablet'],
	];
	$mSelectors['.vxt-infobox-icon-below-title'] = [
		'text-align' => $attr['headingAlignMobile'],
	];
}

// Default text-align values from attributes.
$headingAlign        = $attr['headingAlign'];
$headingAlignTablet = $attr['headingAlignTablet'];
$headingAlignMobile = $attr['headingAlignMobile'];

// Adjust alignment dynamically for RTL.
$headingAlign        = ( 'left' === $headingAlign ) ? 'right' : ( 'right' === $headingAlign ? 'left' : $headingAlign );
$headingAlignTablet = ( 'left' === $headingAlignTablet ) ? 'right' : ( 'right' === $headingAlignTablet ? 'left' : $headingAlignTablet );
$headingAlignMobile = ( 'left' === $headingAlignMobile ) ? 'right' : ( 'right' === $headingAlignMobile ? 'left' : $headingAlignMobile );

// Alignment CSS for RTL.
if ( 'above-title' === $attr['iconimgPosition'] || 'below-title' === $attr['iconimgPosition'] ) { // For backward users.
	$rtlSelectors['.vxt-infobox__content-wrap'] = [
		'text-align' => $headingAlign,
	];
}
// Alignment CSS for RTL.
if ( 'above-title' !== $attr['iconimgPosition'] && 'below-title' !== $attr['iconimgPosition'] ) { // For backward users.
	$rtlSelectors['.vxt-infobox-left']  = [
		'text-align' => 'right',
	];
	$rtlSelectors['.vxt-infobox-right'] = [
		'text-align' => 'left',
	];
}

if ( 'above-title' === $attr['iconimgPosition'] ) {
	$rtlSelectors['.vxt-infobox-icon-above-title']   = [
		'text-align' => $headingAlign,
	];
	$rtlTSelectors['.vxt-infobox-icon-above-title'] = [
		'text-align' => $headingAlignTablet,
	];
	$rtlMSelectors['.vxt-infobox-icon-above-title'] = [
		'text-align' => $headingAlignMobile,
	];
} elseif ( 'below-title' === $attr['iconimgPosition'] ) {
	$rtlSelectors['.vxt-infobox-icon-below-title']   = [
		'text-align' => $headingAlign,
	];
	$rtlTSelectors['.vxt-infobox-icon-below-title'] = [
		'text-align' => $headingAlignTablet,
	];
	$rtlMSelectors['.vxt-infobox-icon-below-title'] = [
		'text-align' => $headingAlignMobile,
	];
}

if ( 'left' === $attr['iconimgPosition'] || 'right' === $attr['iconimgPosition'] ) {
	if ( 'none' === $attr['stack'] ) {
		$tSelectors[' .vxt-infobox-margin-wrapper'] = [
			'display' => 'flex',
		];
		$mSelectors[' .vxt-infobox-margin-wrapper'] = [
			'display' => 'flex',
		];
	} elseif ( 'mobile' === $attr['stack'] ) {
		$tSelectors[' .vxt-infobox-margin-wrapper'] = [
			'display' => 'flex',
		];
		$mSelectors[' .vxt-infobox-margin-wrapper'] = [
			'display' => 'block',
		];
	}
}

$selectors['.vxt-infobox__content-wrap:not(.wp-block-vxt-info-box--has-margin)']                          = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPadding'], $attr['blockPaddingUnit'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPadding'], $attr['blockPaddingUnit'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPadding'], $attr['blockPaddingUnit'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPadding'], $attr['blockPaddingUnit'] ),
];
$selectors['.vxt-infobox__content-wrap.wp-block-vxt-info-box--has-margin .vxt-infobox-margin-wrapper']   = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPadding'], $attr['blockPaddingUnit'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPadding'], $attr['blockPaddingUnit'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPadding'], $attr['blockPaddingUnit'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPadding'], $attr['blockPaddingUnit'] ),
	'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopMargin'], $attr['blockMarginUnit'] ),
	'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightMargin'], $attr['blockMarginUnit'] ),
	'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomMargin'], $attr['blockMarginUnit'] ),
	'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftMargin'], $attr['blockMarginUnit'] ),
];
$tSelectors['.vxt-infobox__content-wrap:not(.wp-block-vxt-info-box--has-margin)']                        = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
];
$tSelectors['.vxt-infobox__content-wrap.wp-block-vxt-info-box--has-margin .vxt-infobox-margin-wrapper'] = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPaddingTablet'], $attr['blockPaddingUnitTablet'] ),
	'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomMarginTablet'], $attr['blockMarginUnitTablet'] ),
	'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftMarginTablet'], $attr['blockMarginUnitTablet'] ),
];
$mSelectors['.vxt-infobox__content-wrap:not(.wp-block-vxt-info-box--has-margin)']                        = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
];
$mSelectors['.vxt-infobox__content-wrap.wp-block-vxt-info-box--has-margin .vxt-infobox-margin-wrapper'] = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftPaddingMobile'], $attr['blockPaddingUnitMobile'] ),
	'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['blockTopMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-right'   => \Vexaltrix\Support\Helper::getCssValue( $attr['blockRightMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['blockBottomMarginMobile'], $attr['blockMarginUnitMobile'] ),
	'margin-left'    => \Vexaltrix\Support\Helper::getCssValue( $attr['blockLeftMarginMobile'], $attr['blockMarginUnitMobile'] ),

];


if ( $attr['imageWidthType'] ) {
	// Image.
	$selectors[' .vxt-ifb-content .vxt-ifb-image-content > img']          = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthUnit'] ),
	];
	$selectors['.vxt-infobox__content-wrap .vxt-ifb-image-content > img'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthUnit'] ),
	];
	$selectors[' .vxt-ifb-content .vxt-ifb-left-title-image > img']       = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthUnit'] ),
	];
	$selectors[' .vxt-ifb-content .vxt-ifb-right-title-image > img']      = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidth'], $attr['imageWidthUnit'] ),
	];
	$mSelectors[' .vxt-ifb-content .vxt-ifb-image-content img']          = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthUnitMobile'] ),
	];
	$mSelectors['.vxt-infobox__content-wrap .vxt-ifb-image-content img'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthUnitMobile'] ),
	];
	$mSelectors[' .vxt-ifb-content .vxt-ifb-left-title-image img']       = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthUnitMobile'] ),
	];
	$mSelectors[' .vxt-ifb-content .vxt-ifb-right-title-image img']      = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthMobile'], $attr['imageWidthUnitMobile'] ),
	];
	$tSelectors[' .vxt-ifb-content .vxt-ifb-image-content img']          = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthUnitTablet'] ),
	];
	$tSelectors['.vxt-infobox__content-wrap .vxt-ifb-image-content img'] = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthUnitTablet'] ),
	];
	$tSelectors[' .vxt-ifb-content .vxt-ifb-left-title-image img']       = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthUnitTablet'] ),
	];
	$tSelectors[' .vxt-ifb-content .vxt-ifb-right-title-image img']      = [
		'width' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageWidthTablet'], $attr['imageWidthUnitTablet'] ),
	];

}

$ctaIconSpacing        = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpace'], $attr['ctaIconSpaceType'] );
$ctaIconSpacingTablet = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpaceTablet'], $attr['ctaIconSpaceType'] );
$ctaIconSpacingMobile = \Vexaltrix\Support\Helper::getCssValue( $attr['ctaIconSpaceMobile'], $attr['ctaIconSpaceType'] );

if ( 'after' === $attr['ctaIconPosition'] ) {
	$selectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg ']      = [
		'margin-left' => $ctaIconSpacing,
	];
	$tSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg ']    = [
		'margin-left' => $ctaIconSpacingTablet,
	];
	$mSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg ']    = [
		'margin-left' => $ctaIconSpacingMobile,
	];
	$rtlSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg']   = [
		'margin-right' => $ctaIconSpacing,
		'margin-left'  => '0px',
	];
	$rtlTSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg'] = [
		'margin-right' => $ctaIconSpacingTablet,
		'margin-left'  => '0px',
	];
	$rtlMSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg'] = [
		'margin-right' => $ctaIconSpacingMobile,
		'margin-left'  => '0px',
	];
} else {
	$selectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg']       = [
		'margin-right' => $ctaIconSpacing,
	];
	$tSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg']     = [
		'margin-right' => $ctaIconSpacingTablet,
	];
	$mSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg']     = [
		'margin-right' => $ctaIconSpacingMobile,
	];
	$rtlSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg']   = [
		'margin-left'  => $ctaIconSpacing,
		'margin-right' => '0px',
	];
	$rtlTSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg'] = [
		'margin-left'  => $ctaIconSpacingTablet,
		'margin-right' => '0px',
	];
	$rtlMSelectors['.vxt-infobox__content-wrap .vxt-infobox-cta-link > svg'] = [
		'margin-left'  => $ctaIconSpacingMobile,
		'margin-right' => '0px',
	];
}

if ( '%' === $attr['imageWidthUnit'] ) {
	$selectors[' .vxt-ifb-content .vxt-ifb-image-content > img']['box-sizing'] = 'border-box';
}

if ( ! $attr['inheritFromTheme'] ) {
	
	$ctaBorderCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn' );
	$ctaBorderCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
		$ctaBorderCss,
		( isset( $attr['ctaBorderWidth'] ) ? $attr['ctaBorderWidth'] : '' ),
		( isset( $attr['ctaBorderRadius'] ) ? $attr['ctaBorderRadius'] : '' ),
		( isset( $attr['ctaBorderColor'] ) ? $attr['ctaBorderColor'] : '' ),
		( isset( $attr['ctaBorderStyle'] ) ? $attr['ctaBorderStyle'] : '' )
	);
	$ctaBorderCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
	$ctaBorderCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'mobile' );

	if ( 'button' === $attr['ctaType'] ) {
		$selectors[' div.vxt-ifb-button-wrapper a.vxt-infobox-cta-link'] = [
			'text-decoration' => $attr['ctaDecoration'],
		];
		$selectors[' .vxt-infobox-cta-link svg']                          = [
			'font-size'   => $ctaIconSize,
			'height'      => $ctaIconSize,
			'width'       => $ctaIconSize,
			'line-height' => $ctaIconSize,
		];
		$selectors['.wp-block-vxt-info-box .wp-block-button.vxt-ifb-button-wrapper .vxt-infobox-cta-link'] =
		[
			'color'            => $attr['ctaBtnLinkColor'],
			'background-color' => $attr['ctaBgColor'],
			'padding-top'      => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnTop'], $attr['paddingBtnUnit'] ),
			'padding-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnBottom'], $attr['paddingBtnUnit'] ),
			'padding-left'     => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnLeft'], $attr['paddingBtnUnit'] ),
			'padding-right'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnRight'], $attr['paddingBtnUnit'] ),
	
		];
		$selectors['.wp-block-vxt-info-box.vxt-infobox__content-wrap .wp-block-button.vxt-ifb-button-wrapper .vxt-infobox-cta-link.wp-block-button__link'] = array_merge(
			[
				'color'            => $attr['ctaBtnLinkColor'],
				'background-color' => ( 'color' === $attr['ctaBgType'] ) ? $attr['ctaBgColor'] : 'transparent',
				'padding-top'      => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnTop'], $attr['paddingBtnUnit'] ),
				'padding-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnBottom'], $attr['paddingBtnUnit'] ),
				'padding-left'     => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnLeft'], $attr['paddingBtnUnit'] ),
				'padding-right'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnRight'], $attr['paddingBtnUnit'] ),
			],
			$ctaBorderCss
		);
		$selectors[' .vxt-ifb-button-wrapper .vxt-infobox-cta-link svg'] = [
			'fill' => $attr['ctaBtnLinkColor'],
		];
	
		$selectors['.wp-block-vxt-info-box.vxt-infobox__content-wrap .wp-block-button.vxt-ifb-button-wrapper .vxt-infobox-cta-link.wp-block-button__link:hover'] = [
			'color'            => $attr['ctaLinkHoverColor'],
			'background-color' => ( 'color' === $attr['ctaBgHoverType'] ) ? $attr['ctaBgHoverColor'] : 'transparent',
			'border-color'     => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['ctaBorderhoverColor'],
		];
		$selectors[' .vxt-infobox-cta-link:hover'] = [
			'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['ctaBorderhoverColor'],
		];
		$selectors[' .wp-block-button.vxt-ifb-button-wrapper .vxt-infobox-cta-link:hover > svg'] = [
			'fill' => $attr['ctaLinkHoverColor'],
		];
		$selectors['.wp-block-vxt-info-box.vxt-infobox__content-wrap .wp-block-button.vxt-ifb-button-wrapper .vxt-infobox-cta-link.wp-block-button__link:focus'] = [
			'color'            => $attr['ctaLinkHoverColor'],
			'background-color' => ( 'color' === $attr['ctaBgHoverType'] ) ? $attr['ctaBgHoverColor'] : 'transparent',
			'border-color'     => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['ctaBorderhoverColor'],
		];
		$selectors[' .vxt-infobox-cta-link:focus'] = [
			'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['ctaBorderhoverColor'],
		];
		$selectors[' .vxt-infobox-cta-link']       = $ctaBorderCss;
		$tSelectors[' .vxt-infobox-cta-link']     = $ctaBorderCssTablet;
		$mSelectors[' .vxt-infobox-cta-link']     = $ctaBorderCssMobile;

		$tSelectors['.wp-block-vxt-info-box.vxt-infobox__content-wrap .wp-block-button.vxt-ifb-button-wrapper .vxt-infobox-cta-link.wp-block-button__link'] = [
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnTopTablet'], $attr['tabletPaddingBtnUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnBottomTablet'], $attr['tabletPaddingBtnUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnLeftTablet'], $attr['tabletPaddingBtnUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnRightTablet'], $attr['tabletPaddingBtnUnit'] ),
		];

		$mSelectors['.wp-block-vxt-info-box.vxt-infobox__content-wrap .wp-block-button.vxt-ifb-button-wrapper .vxt-infobox-cta-link.wp-block-button__link'] = [
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnTopMobile'], $attr['mobilePaddingBtnUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnBottomMobile'], $attr['mobilePaddingBtnUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnLeftMobile'], $attr['mobilePaddingBtnUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnRightMobile'], $attr['mobilePaddingBtnUnit'] ),
		];
	
	}
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedRtlSelectors = [
	'desktop' => $rtlSelectors,
	'tablet'  => $rtlTSelectors,
	'mobile'  => $rtlMSelectors,
];

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'head', ' .vxt-ifb-title', $combinedSelectors );
if ( $attr['enableMultilineParagraph'] ) {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'subHead', ' .vxt-ifb-desc p', $combinedSelectors );
} else {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'subHead', ' .vxt-ifb-desc', $combinedSelectors );
}
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'prefix', ' .vxt-ifb-title-prefix', $combinedSelectors );

if ( ! $attr['inheritFromTheme'] ) { 
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'cta', ' .vxt-infobox-cta-link', $combinedSelectors );
}

// Determine the base selector for normal CSS.
// If 'classMigrate' is true, use the '.vxt-block-' class; otherwise, use the '#vxt-infobox-' ID.
$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-infobox-';

// Determine the base selector for RTL CSS.
// If 'classMigrate' is true, use '[dir=rtl] .vxt-block-' class; otherwise, use '[dir=rtl] #vxt-infobox-' ID.
$baseSelectorRtl = ( $attr['classMigrate'] ) ? '[dir=rtl] .vxt-block-' : '[dir=rtl] #vxt-infobox-';

// Generate the normal CSS for desktop, tablet, and mobile devices.
$normalCss = \Vexaltrix\Support\Helper::generateAllCss(
	$combinedSelectors,    // Combined selectors for normal CSS.
	$baseSelector . $id,   // Selector with appended ID.
	isset( $gbsClass ) ? $gbsClass : '' // Optional GBS class if provided.
);

// Generate the RTL CSS for desktop, tablet, and mobile devices.
$rtlCss = \Vexaltrix\Support\Helper::generateAllCss(
	$combinedRtlSelectors, // Combined selectors specifically for RTL CSS.
	$baseSelectorRtl . $id, // RTL selector with appended ID.
	isset( $gbsClass ) ? $gbsClass : '' // Optional GBS class if provided.
);

// Combine both normal and RTL CSS arrays by concatenating their values for each device type.
// The 'mergeCssArrays' function handles concatenation for 'desktop', 'tablet', and 'mobile'.
$mergedCss = \Vexaltrix\Support\Helper::mergeCssArrays( $normalCss, $rtlCss );

// Return the merged CSS array.
return $mergedCss;

