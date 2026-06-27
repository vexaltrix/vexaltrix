<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @var int $id
 *
 * @package ugb
 */

$gapTabletFallback = is_numeric( $attr['gapTablet'] ) ? $attr['gapTablet'] : $attr['gap'];
$gapMobileFallback = is_numeric( $attr['gapMobile'] ) ? $attr['gapMobile'] : $gapTabletFallback;

$alignment   = ( 'left' === $attr['align'] ) ? 'flex-start' : ( ( 'right' === $attr['align'] ) ? 'flex-end' : 'center' );
$tAlignment = ( 'left' === $attr['alignTablet'] ) ? 'flex-start' : ( ( 'right' === $attr['alignTablet'] ) ? 'flex-end' : 'center' );
$mAlignment = ( 'left' === $attr['alignMobile'] ) ? 'flex-start' : ( ( 'right' === $attr['alignMobile'] ) ? 'flex-end' : 'center' );

$mSelectors = [];
$tSelectors = [];

$imageSize   = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['size'], $attr['sizeType'] );
$mImageSize = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['sizeMobile'], $attr['sizeType'] );
$tImageSize = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['sizeTablet'], $attr['sizeType'] );

$selectors = [
	' .vxt-ss-repeater span.vxt-ss__link'           => [
		'color' => $attr['iconColor'],
	],
	' .vxt-ss-repeater a.vxt-ss__link'              => [ // Backward user case.
		'color' => $attr['iconColor'],
	],
	' .vxt-ss-repeater span.vxt-ss__link svg'       => [
		'fill' => $attr['iconColor'],
	],
	' .vxt-ss-repeater a.vxt-ss__link svg'          => [ // Backward user case.
		'fill' => $attr['iconColor'],
	],
	' .vxt-ss-repeater:hover span.vxt-ss__link'     => [
		'color' => $attr['iconHoverColor'],
	],
	' .vxt-ss-repeater:hover a.vxt-ss__link'        => [ // Backward user case.
		'color' => $attr['iconHoverColor'],
	],
	' .vxt-ss-repeater:hover span.vxt-ss__link svg' => [
		'fill' => $attr['iconHoverColor'],
	],
	' .vxt-ss-repeater:hover a.vxt-ss__link svg'    => [ // Backward user case.
		'fill' => $attr['iconHoverColor'],
	],
	' .vxt-ss-repeater.vxt-ss__wrapper'             => [
		'background' => $attr['iconBgColor'],
	],
	' .vxt-ss-repeater.vxt-ss__wrapper:hover'       => [
		'background' => $attr['iconBgHoverColor'],
	],
];

$selectors['.vxt-social-share__outer-wrap .block-editor-inner-blocks']   = [
	'text-align' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['align'] ),
];
$tSelectors['.vxt-social-share__outer-wrap .block-editor-inner-blocks'] = [
	'text-align' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['alignTablet'] ),
];
$mSelectors['.vxt-social-share__outer-wrap .block-editor-inner-blocks'] = [
	'text-align' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['alignMobile'] ),
];

$selectors['.vxt-social-share__layout-vertical .vxt-ss__wrapper']     = [
	'margin-left'   => 0,
	'margin-right'  => 0,
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['gap'] / 2 ), 'px' ),
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['gap'] / 2 ), 'px' ),
];
$selectors['.vxt-social-share__layout-vertical .vxt-ss__link']        = [
	'padding' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bgSize'], 'px' ),
];
$mSelectors['.vxt-social-share__layout-vertical .vxt-ss__wrapper']   = [
	'margin-left'   => 0,
	'margin-right'  => 0,
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( ( $gapMobileFallback / 2 ), 'px' ),
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $gapMobileFallback / 2 ), 'px' ),
];
$tSelectors['.vxt-social-share__layout-vertical .vxt-ss__wrapper']   = [
	'margin-left'   => 0,
	'margin-right'  => 0,
	'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( ( $gapTabletFallback / 2 ), 'px' ),
	'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $gapTabletFallback / 2 ), 'px' ),
];
$selectors['.vxt-social-share__layout-horizontal .vxt-ss__link']      = [
	'padding' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bgSize'], 'px' ),
];
$selectors['.vxt-social-share__layout-horizontal .vxt-ss__wrapper']   = [
	'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['gap'] / 2 ), 'px' ),
	'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['gap'] / 2 ), 'px' ),
];
$mSelectors['.vxt-social-share__layout-horizontal .vxt-ss__wrapper'] = [
	'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( $gapMobileFallback / 2 ), 'px' ),
	'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $gapMobileFallback / 2 ), 'px' ),
];
$tSelectors['.vxt-social-share__layout-horizontal .vxt-ss__wrapper'] = [
	'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( $gapTabletFallback / 2 ), 'px' ),
	'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $gapTabletFallback / 2 ), 'px' ),
];

$selectors[' .wp-block-vxt-social-share-child ']   = [
	'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderRadius'], 'px' ),
];
$mSelectors[' .wp-block-vxt-social-share-child '] = [
	'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderRadiusMobile'], 'px' ),
];
$tSelectors[' .wp-block-vxt-social-share-child '] = [
	'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderRadiusTablet'], 'px' ),
];

$selectors[' .vxt-ss__source-wrap'] = [
	'width' => $imageSize,
];

$selectors[' .vxt-ss__source-wrap svg'] = [
	'width'  => $imageSize,
	'height' => $imageSize,
];

$selectors[' .vxt-ss__source-image'] = [
	'width' => $imageSize,
];

$selectors[' .vxt-ss__source-icon'] = [
	'width'     => $imageSize,
	'height'    => $imageSize,
	'font-size' => $imageSize,
];

$tSelectors[' .vxt-ss__source-wrap'] = [
	'width'       => $tImageSize,
	'height'      => $tImageSize,
	'line-height' => $tImageSize,
];

$tSelectors[' .vxt-ss__source-wrap svg'] = [
	'width'  => $tImageSize,
	'height' => $tImageSize,
];

$tSelectors[' .vxt-ss__source-image'] = [
	'width' => $tImageSize,
];

$tSelectors[' .vxt-ss__source-icon'] = [
	'width'       => $tImageSize,
	'height'      => $tImageSize,
	'font-size'   => $tImageSize,
	'line-height' => $tImageSize,
];

$mSelectors[' .vxt-ss__source-wrap'] = [
	'width'       => $mImageSize,
	'height'      => $mImageSize,
	'line-height' => $mImageSize,
];

$mSelectors[' .vxt-ss__source-wrap svg'] = [
	'width'  => $mImageSize,
	'height' => $mImageSize,
];

$mSelectors[' .vxt-ss__source-image'] = [
	'width' => $mImageSize,
];

$mSelectors[' .vxt-ss__source-icon'] = [
	'width'       => $mImageSize,
	'height'      => $mImageSize,
	'font-size'   => $mImageSize,
	'line-height' => $mImageSize,
];


$selectors['.vxt-social-share__outer-wrap'] = [
	'justify-content'   => $alignment,
	'-webkit-box-pack'  => $alignment,
	'-ms-flex-pack'     => $alignment,
	'-webkit-box-align' => $alignment,
	'-ms-flex-align'    => $alignment,
	'align-items'       => $alignment,
];

$tSelectors['.vxt-social-share__outer-wrap'] = [
	'justify-content'   => $tAlignment,
	'-webkit-box-pack'  => $tAlignment,
	'-ms-flex-pack'     => $tAlignment,
	'-webkit-box-align' => $tAlignment,
	'-ms-flex-align'    => $tAlignment,
	'align-items'       => $tAlignment,
];

$mSelectors['.vxt-social-share__outer-wrap'] = [
	'justify-content'   => $mAlignment,
	'-webkit-box-pack'  => $mAlignment,
	'-ms-flex-pack'     => $mAlignment,
	'-webkit-box-align' => $mAlignment,
	'-ms-flex-align'    => $mAlignment,
	'align-items'       => $mAlignment,
];

if ( ! $attr['childMigrate'] ) {

	$defaults = VXT_DIR . 'includes/blocks/social-share-child/attributes.php';

	if ( file_exists( $defaults ) ) {
		$defaultAttr = include $defaults;
	}

	$defaultAttr = ( ! empty( $defaultAttr ) && is_array( $defaultAttr ) ) ? $defaultAttr : [];

	foreach ( $attr['socials'] as $key => $socials ) {

		$socials                        = array_merge( $defaultAttr, (array) $socials );
		$socials['icon_color']          = ( isset( $socials['icon_color'] ) ) ? $socials['icon_color'] : '';
		$socials['icon_hover_color']    = ( isset( $socials['icon_hover_color'] ) ) ? $socials['icon_hover_color'] : '';
		$socials['icon_bg_color']       = ( isset( $socials['icon_bg_color'] ) ) ? $socials['icon_bg_color'] : '';
		$socials['icon_bg_hover_color'] = ( isset( $socials['icon_bg_hover_color'] ) ) ? $socials['icon_bg_hover_color'] : '';

		if ( $attr['social_count'] <= $key ) {
			break;
		}

		$childSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getSocialShareChildSelectors( $socials, $key, $attr['childMigrate'] );
		$selectors       = array_merge( $selectors, (array) $childSelectors );
	}
}

if ( 'horizontal' === $attr['social_layout'] ) {

	if ( 'desktop' === $attr['stack'] ) {

		$selectors[' .vxt-ss__wrapper']   = [
			'margin-left'   => 0,
			'margin-right'  => 0,
			'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gap'], 'px' ),
		];
		$tSelectors[' .vxt-ss__wrapper'] = [
			'margin-left'   => 0,
			'margin-right'  => 0,
			'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapTablet'], 'px' ),
		];
		$mSelectors[' .vxt-ss__wrapper'] = [
			'margin-left'   => 0,
			'margin-right'  => 0,
			'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapMobile'], 'px' ),
		];

		$selectors['.vxt-social-share__outer-wrap'] = [
			'flex-direction'    => 'column',
			'justify-content'   => $alignment,
			'-webkit-box-pack'  => $alignment,
			'-ms-flex-pack'     => $alignment,
			'-webkit-box-align' => $alignment,
			'-ms-flex-align'    => $alignment,
			'align-items'       => $alignment,
		];

		$tSelectors['.vxt-social-share__outer-wrap'] = [
			'flex-direction'    => 'column',
			'justify-content'   => $tAlignment,
			'-webkit-box-pack'  => $tAlignment,
			'-ms-flex-pack'     => $tAlignment,
			'-webkit-box-align' => $tAlignment,
			'-ms-flex-align'    => $tAlignment,
			'align-items'       => $tAlignment,
		];

		$mSelectors['.vxt-social-share__outer-wrap'] = [
			'flex-direction'    => 'column',
			'justify-content'   => $mAlignment,
			'-webkit-box-pack'  => $mAlignment,
			'-ms-flex-pack'     => $mAlignment,
			'-webkit-box-align' => $mAlignment,
			'-ms-flex-align'    => $mAlignment,
			'align-items'       => $mAlignment,
		];

	} elseif ( 'tablet' === $attr['stack'] ) {

		$tSelectors[' .vxt-ss__wrapper'] = [
			'margin-left'   => 0,
			'margin-right'  => 0,
			'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapTablet'], 'px' ),
		];

		$tSelectors['.vxt-social-share__outer-wrap'] = [
			'flex-direction'    => 'column',
			'justify-content'   => $tAlignment,
			'-webkit-box-pack'  => $tAlignment,
			'-ms-flex-pack'     => $tAlignment,
			'-webkit-box-align' => $tAlignment,
			'-ms-flex-align'    => $tAlignment,
			'align-items'       => $tAlignment,
		];

	} elseif ( 'mobile' === $attr['stack'] ) {

		$mSelectors[' .vxt-ss__wrapper'] = [
			'margin-left'   => 0,
			'margin-right'  => 0,
			'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapMobile'], 'px' ),
		];

		$mSelectors['.vxt-social-share__outer-wrap'] = [
			'flex-direction'    => 'column',
			'justify-content'   => $mAlignment,
			'-webkit-box-pack'  => $mAlignment,
			'-ms-flex-pack'     => $mAlignment,
			'-webkit-box-align' => $mAlignment,
			'-ms-flex-align'    => $mAlignment,
			'align-items'       => $mAlignment,
		];
	}
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-social-share-';

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
