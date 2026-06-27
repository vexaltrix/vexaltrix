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
\Vexaltrix\Core\Blocks\BlockJs::blocksTeamGfont( $attr );

$socialSpaceTabletFallback = is_numeric( $attr['socialSpaceTablet'] ) ? $attr['socialSpaceTablet'] : $attr['socialSpace'];
$socialSpaceMobileFallback = is_numeric( $attr['socialSpaceMobile'] ) ? $attr['socialSpaceMobile'] : $socialSpaceTabletFallback;

$mSelectors = [];
$tSelectors = [];

$imageTopMargin    = isset( $attr['imageTopMargin'] ) ? $attr['imageTopMargin'] : $attr['imgTopMargin'];
$imageBottomMargin = isset( $attr['imageBottomMargin'] ) ? $attr['imageBottomMargin'] : $attr['imgBottomMargin'];
$imageLeftMargin   = isset( $attr['imageLeftMargin'] ) ? $attr['imageLeftMargin'] : $attr['imgLeftMargin'];
$imageRightMargin  = isset( $attr['imageRightMargin'] ) ? $attr['imageRightMargin'] : $attr['imgRightMargin'];

$iconSize   = \Vexaltrix\Support\Helper::getCssValue( $attr['socialFontSize'], $attr['socialFontSizeType'] );
$mIconSize = \Vexaltrix\Support\Helper::getCssValue( $attr['socialFontSizeMobile'], $attr['socialFontSizeType'] );
$tIconSize = \Vexaltrix\Support\Helper::getCssValue( $attr['socialFontSizeTablet'], $attr['socialFontSizeType'] );

$selectors = [
	' p.vxt-team__desc'                    => [
		'color'         => $attr['descColor'],
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpace'], 'px' ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixSpace'], 'px' ),
	],
	' .vxt-team__prefix'                   => [
		'color' => $attr['prefixColor'],
	],
	' .vxt-team__social-icon a'            => [
		'color'       => $attr['socialColor'],
		'font-size'   => $iconSize,
		'width'       => $iconSize,
		'height'      => $iconSize,
		'line-height' => $iconSize,
	],
	' .vxt-team__social-icon svg'          => [
		'fill'   => $attr['socialColor'],
		'width'  => $iconSize,
		'height' => $iconSize,
	],
	' .vxt-team__social-icon:hover a'      => [
		'color' => $attr['socialHoverColor'],
	],
	' .vxt-team__social-icon:hover svg'    => [
		'fill' => $attr['socialHoverColor'],
	],
	'.vxt-team__image-position-left .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpace'], 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-right .vxt-team__social-icon' => [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpace'], 'px' ),
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-center .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( ( $attr['socialSpace'] / 2 ), 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( ( $attr['socialSpace'] / 2 ), 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-left .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpace'], 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-right .vxt-team__social-icon' => [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpace'], 'px' ),
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	' .vxt-team__image-wrap'               => [ // For Backword.
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $imageTopMargin, $attr['imageMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $imageBottomMargin, $attr['imageMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $imageLeftMargin, $attr['imageMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $imageRightMargin, $attr['imageMarginUnit'] ),
		'width'         => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidth'], 'px' ),
		'height'        => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidth'], 'px' ),
	],
	'.vxt-team__image-position-left > img' => [ // When Image position is left.
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $imageTopMargin, $attr['imageMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $imageBottomMargin, $attr['imageMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $imageLeftMargin, $attr['imageMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $imageRightMargin, $attr['imageMarginUnit'] ),
		'width'         => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidth'], 'px' ),
		'height'        => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidth'], 'px' ),
	],
	'.vxt-team__image-position-right .vxt-team__content + img' => [ // When Image position is right.
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $imageTopMargin, $attr['imageMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $imageBottomMargin, $attr['imageMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $imageLeftMargin, $attr['imageMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $imageRightMargin, $attr['imageMarginUnit'] ),
		'width'         => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidth'], 'px' ),
		'height'        => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidth'], 'px' ),
	],
	'.vxt-team__image-position-above img'  => [ // When Image position is above.
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $imageTopMargin, $attr['imageMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $imageBottomMargin, $attr['imageMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $imageLeftMargin, $attr['imageMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $imageRightMargin, $attr['imageMarginUnit'] ),
		'width'         => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidth'], 'px' ),
		'height'        => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidth'], 'px' ),
	],

];

if ( 'above' === $attr['imgPosition'] ) {
	if ( 'center' === $attr['align'] ) {
		$selectors[' .vxt-team__image-wrap']['margin-left']      = 'auto';
		$selectors[' .vxt-team__image-wrap']['margin-right']     = 'auto';
		$selectors[' .vxt-team__social-list']['justify-content'] = 'center';
	} elseif ( 'left' === $attr['align'] ) {
		$selectors[' .vxt-team__image-wrap']['margin-right']     = 'auto';
		$selectors[' .vxt-team__social-list']['justify-content'] = 'flex-start';
	} elseif ( 'right' === $attr['align'] ) {
		$selectors[' .vxt-team__image-wrap']['margin-left']      = 'auto';
		$selectors[' .vxt-team__social-list']['justify-content'] = 'flex-end';
	}
}

if ( 'above' !== $attr['imgPosition'] ) {
	if ( 'middle' === $attr['imgAlign'] ) {
		$selectors[' .vxt-team__image-wrap']['align-self'] = 'center';
		$selectors[' img']['align-self']                    = 'center';
		$selectors[' .vxt-team__content']                  = [ 'align-self' => 'center' ];
	} else {
		$selectors[' img']['align-self'] = 'flex-start';
	}
}

$selectors[ ' ' . $attr['tag'] . '.vxt-team__title' ] = [
	'color'         => $attr['titleColor'],
	'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpace'], 'px' ),
];

$mSelectors = [
	'.vxt-team__image-position-left > img' => [ // When Image position is left.
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthMobile'], 'px' ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthMobile'], 'px' ),
	],
	' p.vxt-team__desc'                    => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpaceMobile'], 'px' ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixSpaceMobile'], 'px' ),
	],
	'.vxt-team__image-position-right .vxt-team__content + img' => [ // When Image position is right.
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthMobile'], 'px' ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthMobile'], 'px' ),
	],
	'.vxt-team__image-position-above img'  => [ // When Image position is above.
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthMobile'], 'px' ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthMobile'], 'px' ),
	],
	' .vxt-team__social-icon a'            => [
		'font-size'   => $mIconSize,
		'width'       => $mIconSize,
		'height'      => $mIconSize,
		'line-height' => $mIconSize,
	],
	' .vxt-team__social-icon svg'          => [
		'width'  => $mIconSize,
		'height' => $mIconSize,
	],
	' .vxt-team__image-wrap'               => [
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['imageMarginTopMobile'], $attr['mobileImageMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageMarginBottomMobile'], $attr['mobileImageMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['imageMarginLeftMobile'], $attr['mobileImageMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imageMarginRightMobile'], $attr['mobileImageMarginUnit'] ),
	],
	'.vxt-team__image-position-left .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpaceMobile'], 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-right .vxt-team__social-icon' => [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpaceMobile'], 'px' ),
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-center .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( ( $socialSpaceMobileFallback / 2 ), 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( ( $socialSpaceMobileFallback / 2 ), 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-left .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpaceMobile'], 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-right .vxt-team__social-icon' => [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpaceMobile'], 'px' ),
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
];
$mSelectors[ ' ' . $attr['tag'] . '.vxt-team__title' ] = [
	'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpaceMobile'], 'px' ),
];
$tSelectors = [
	'.vxt-team__image-position-left > img' => [ // When Image position is left.
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthTablet'], 'px' ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthTablet'], 'px' ),
	],
	' p.vxt-team__desc'                    => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['descSpaceTablet'], 'px' ),
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['prefixSpaceTablet'], 'px' ),
	],
	'.vxt-team__image-position-right .vxt-team__content + img' => [ // When Image position is right.
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthTablet'], 'px' ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthTablet'], 'px' ),
	],
	'.vxt-team__image-position-above img'  => [ // When Image position is above.
		'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthTablet'], 'px' ),
		'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['imgWidthTablet'], 'px' ),
	],
	' .vxt-team__social-icon a'            => [
		'font-size'   => $tIconSize,
		'width'       => $tIconSize,
		'height'      => $tIconSize,
		'line-height' => $tIconSize,
	],
	' .vxt-team__social-icon svg'          => [
		'width'  => $tIconSize,
		'height' => $tIconSize,
	],
	' .vxt-team__image-wrap'               => [
		'margin-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['imageMarginTopTablet'], $attr['tabletImageMarginUnit'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['imageMarginBottomTablet'], $attr['tabletImageMarginUnit'] ),
		'margin-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['imageMarginLeftTablet'], $attr['tabletImageMarginUnit'] ),
		'margin-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['imageMarginRightTablet'], $attr['tabletImageMarginUnit'] ),
	],
	'.vxt-team__image-position-left .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpaceTablet'], 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-right .vxt-team__social-icon' => [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpaceTablet'], 'px' ),
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-center .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( ( $socialSpaceTabletFallback / 2 ), 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( ( $socialSpaceTabletFallback / 2 ), 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-left .vxt-team__social-icon' => [
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpaceTablet'], 'px' ),
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
	'.vxt-team__image-position-above.vxt-team__align-right .vxt-team__social-icon' => [
		'margin-left'  => \Vexaltrix\Support\Helper::getCssValue( $attr['socialSpaceTablet'], 'px' ),
		'margin-right' => \Vexaltrix\Support\Helper::getCssValue( 0, 'px' ),
	],
];
$tSelectors[ ' ' . $attr['tag'] . '.vxt-team__title' ] = [
	'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['titleSpaceTablet'], 'px' ),
];
$combinedSelectors                                      = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'title', ' ' . $attr['tag'] . '.vxt-team__title', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'prefix', ' .vxt-team__prefix', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'desc', ' p.vxt-team__desc', $combinedSelectors );

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-team-';

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
