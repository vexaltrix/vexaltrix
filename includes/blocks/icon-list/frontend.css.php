<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
// We have used the same buttons gfont function because the inputs to these functions are same.
// If need be please add a new function for Info Box and go ahead.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksButtonsGfont( $attr );

$fontSizeFallback = is_numeric( $attr['fontSize'] ) ? $attr['fontSize'] : 16;

// Responsive Fallback Values that Need to be Numeric for Math.
$sizeTabletFallback      = is_numeric( $attr['sizeTablet'] ) ? $attr['sizeTablet'] : $attr['size'];
$sizeMobileFallback      = is_numeric( $attr['sizeMobile'] ) ? $attr['sizeMobile'] : $sizeTabletFallback;
$bgSizeTabletFallback   = is_numeric( $attr['bgSizeTablet'] ) ? $attr['bgSizeTablet'] : $attr['bgSize'];
$bgSizeMobileFallback   = is_numeric( $attr['bgSizeMobile'] ) ? $attr['bgSizeMobile'] : $bgSizeTabletFallback;
$tborderFallback          = is_numeric( $attr['borderTablet'] ) ? $attr['borderTablet'] : $attr['border'];
$mborderFallback          = is_numeric( $attr['borderMobile'] ) ? $attr['borderMobile'] : $tborderFallback;
$fontSizeTabletFallback = is_numeric( $attr['fontSizeTablet'] ) ? $attr['fontSizeTablet'] : $fontSizeFallback;
$fontSizeMobileFallback = is_numeric( $attr['fontSizeMobile'] ) ? $attr['fontSizeMobile'] : $fontSizeTabletFallback;
$tgapFallback             = is_numeric( $attr['gapTablet'] ) ? $attr['gapTablet'] : $attr['gap'];
$mgapFallback             = is_numeric( $attr['gapMobile'] ) ? $attr['gapMobile'] : $tgapFallback;

$alignment        = ( 'left' === $attr['align'] ) ? 'flex-start' : ( ( 'right' === $attr['align'] ) ? 'flex-end' : 'center' );
$alignmentTablet = ( 'left' === $attr['alignTablet'] ) ? 'flex-start' : ( ( 'right' === $attr['alignTablet'] ) ? 'flex-end' : ( ( 'center' === $attr['alignTablet'] ) ? 'center' : $alignment ) );
$alignmentMobile = ( 'left' === $attr['alignMobile'] ) ? 'flex-start' : ( ( 'right' === $attr['alignMobile'] ) ? 'flex-end' : ( ( 'center' === $attr['alignMobile'] ) ? 'center' : $alignmentTablet ) );


$iconLayout        = $attr['icon_layout'];
$iconLayoutTablet = ! empty( $attr['iconLayoutTablet'] ) ? $attr['iconLayoutTablet'] : $iconLayout;
$iconLayoutMobile = ! empty( $attr['iconLayoutMobile'] ) ? $attr['iconLayoutMobile'] : $iconLayoutTablet;

$mSelectors = [];
$tSelectors = [];

$iconSize   = \Vexaltrix\Core\Support\Helper::getCssValue( $attr['size'], $attr['sizeType'] );
$mIconSize = \Vexaltrix\Core\Support\Helper::getCssValue( $sizeMobileFallback, $attr['sizeType'] );
$tIconSize = \Vexaltrix\Core\Support\Helper::getCssValue( $sizeTabletFallback, $attr['sizeType'] );

// The Math ( 3 * Icon Size ) / 5 aligns perfectly with the current defaults ( Font Size: 16px, Line Height: 1.8em ).
$halfSize        = 3 * $attr['size'] / 5;
$halfSizeTablet = 3 * $sizeTabletFallback / 5;
$halfSizeMobile = 3 * $sizeMobileFallback / 5;

$position        = 'top' === $attr['iconPosition'] ? 'flex-start' : 'center';
$tabletPosition = '';
$mobilePosition = '';

if ( 'top' === $attr['iconPositionTablet'] ) {
	$tabletPosition = 'flex-start';
} elseif ( 'middle' === $attr['iconPositionTablet'] ) {
	$tabletPosition = 'center';
} else {
	$tabletPosition = $position;
}

if ( 'top' === $attr['iconPositionMobile'] ) {
	$mobilePosition = 'flex-start';
} elseif ( 'middle' === $attr['iconPositionMobile'] ) {
	$mobilePosition = 'center';
} else {
	$mobilePosition = $tabletPosition;
}

$selectors = [
	// Desktop Icon Size CSS starts.
	' .vxt-icon-list__source-image' => [
		'width' => $iconSize,
	],
	' .wp-block-vxt-icon-list-child .vxt-icon-list__source-wrap svg' => [
		'width'     => $iconSize,
		'height'    => $iconSize,
		'font-size' => $iconSize,
		'color'     => $attr['iconColor'],
		'fill'      => $attr['iconColor'],
	],
	' .wp-block-vxt-icon-list-child .vxt-icon-list__source-wrap' => array_merge(
		[
			'background'    => $attr['iconBgColor'],
			'border-color'  => $attr['iconBorderColor'],
			'padding'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bgSize'], $attr['bgSizeType'] ),
			'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderRadius'], 'px' ),
			'border-style'  => ( $attr['border'] > 0 ) ? 'solid' : '',
			'border-width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['border'], $attr['borderType'] ),
			'align-self'    => $position,
		]
	),
	' .wp-block-vxt-icon-list-child .vxt-icon-list__label' => [
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSize'], $attr['fontSizeType'] ),
		'font-family'     => $attr['fontFamily'],
		'text-transform'  => $attr['fontTransform'],
		'text-decoration' => $attr['fontDecoration'] . '!important',
		'font-style'      => $attr['fontStyle'],
		'font-weight'     => $attr['fontWeight'],
		'line-height'     => $attr['lineHeight'] . $attr['lineHeightType'],
	],
	' .vxt-icon-list__wrap'         => [
		'display'           => 'flex',
		'flex-direction'    => 'row',
		'justify-content'   => $alignment,
		'-webkit-box-pack'  => $alignment,
		'-ms-flex-pack'     => $alignment,
		'-webkit-box-align' => 'center',
		'-ms-flex-align'    => 'center',
		'align-items'       => 'center',
		'margin-top'        => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockTopMargin'],
			$attr['blockMarginUnit']
		),
		'margin-right'      => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockRightMargin'],
			$attr['blockMarginUnit']
		),
		'margin-bottom'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockBottomMargin'],
			$attr['blockMarginUnit']
		),
		'margin-left'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockLeftMargin'],
			$attr['blockMarginUnit']
		),
		'padding-top'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockTopPadding'],
			$attr['blockPaddingUnit']
		),
		'padding-right'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockRightPadding'],
			$attr['blockPaddingUnit']
		),
		'padding-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockBottomPadding'],
			$attr['blockPaddingUnit']
		),
		'padding-left'      => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockLeftPadding'],
			$attr['blockPaddingUnit']
		),
	],
	' .wp-block-vxt-icon-list-child:hover .vxt-icon-list__source-wrap svg' => [
		'color' => $attr['iconHoverColor'],
		'fill'  => $attr['iconHoverColor'],
	],
	' .wp-block-vxt-icon-list-child:hover .vxt-icon-list__label' => [
		'color' => $attr['labelHoverColor'],
	],
	' .wp-block-vxt-icon-list-child:hover .vxt-icon-list__source-wrap' => [
		'background'   => $attr['iconBgHoverColor'],
		'border-color' => $attr['iconBorderHoverColor'],
	],
	' .vxt-icon-list__label'        => [
		'text-align' => $attr['align'],
	],
];


if ( $attr['childMigrate'] ) {
	$selectors[' .wp-block-vxt-icon-list-child'] = [
		'font-family'     => $attr['fontFamily'],
		'text-transform'  => $attr['fontTransform'],
		'text-decoration' => $attr['fontDecoration'] . '!important',
		'font-style'      => $attr['fontStyle'],
		'font-weight'     => $attr['fontWeight'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSize'], $attr['fontSizeType'] ),
		'line-height'     => $attr['lineHeight'] . $attr['lineHeightType'],
	];
}


$tSelectors = [
	' .vxt-icon-list__source-image' => [
		'width' => $tIconSize,
	],
	' .wp-block-vxt-icon-list-child .vxt-icon-list__source-wrap svg' => [
		'width'     => $tIconSize,
		'height'    => $tIconSize,
		'font-size' => $tIconSize,
	],
	' .wp-block-vxt-icon-list-child .vxt-icon-list__source-wrap ' => array_merge(
		[
			'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderRadiusTablet'], $attr['borderRadiusType'] ),
			'padding'       => \Vexaltrix\Core\Support\Helper::getCssValue( $bgSizeTabletFallback, 'px' ),
			'border-style'  => ( $tborderFallback > 0 ) ? 'solid' : '',
			'border-width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $tborderFallback, $attr['borderType'] ),
			'align-self'    => $tabletPosition,
		]
	),
	' .wp-block-vxt-icon-list-child .vxt-icon-list__label' => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSizeTablet'], $attr['fontSizeType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeightTablet'], $attr['lineHeightType'] ),
	],
	' .vxt-icon-list__wrap'         => [
		'display'           => 'flex',
		'flex-direction'    => 'row',
		'justify-content'   => $alignmentTablet,
		'-webkit-box-pack'  => $alignmentTablet,
		'-ms-flex-pack'     => $alignmentTablet,
		'-webkit-box-align' => 'center',
		'-ms-flex-align'    => 'center',
		'align-items'       => 'center',
		'margin-top'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-right'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-bottom'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'margin-left'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginTablet'], $attr['blockMarginUnitTablet'] ),
		'padding-top'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockTopPaddingTablet'],
			$attr['blockPaddingUnitTablet']
		),
		'padding-right'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockRightPaddingTablet'],
			$attr['blockPaddingUnitTablet']
		),
		'padding-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockBottomPaddingTablet'],
			$attr['blockPaddingUnitTablet']
		),
		'padding-left'      => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockLeftPaddingTablet'],
			$attr['blockPaddingUnitTablet']
		),
	],
	' .vxt-icon-list__label'        => [
		'text-align' => $attr['alignTablet'],
	],
];


$mSelectors = [
	' .vxt-icon-list__source-image' => [
		'width' => $mIconSize,
	],
	' .vxt-icon-list__label'        => [
		'text-align' => $attr['alignMobile'],
	],
	' .wp-block-vxt-icon-list-child .vxt-icon-list__source-wrap svg' => [
		'width'     => $mIconSize,
		'height'    => $mIconSize,
		'font-size' => $mIconSize,
	],
	' .wp-block-vxt-icon-list-child .vxt-icon-list__source-wrap' => array_merge(
		[
			'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderRadiusMobile'], $attr['borderRadiusType'] ),
			'padding'       => \Vexaltrix\Core\Support\Helper::getCssValue( $bgSizeMobileFallback, 'px' ),
			'border-style'  => ( $mborderFallback > 0 ) ? 'solid' : '',
			'border-width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $mborderFallback, $attr['borderType'] ),
			'align-self'    => $mobilePosition,
		]
	),
	' .wp-block-vxt-icon-list-child .vxt-icon-list__label' => [
		'font-size'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSizeMobile'], $attr['fontSizeType'] ),
		'line-height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeightMobile'], $attr['lineHeightType'] ),
	],
	' .vxt-icon-list__wrap'         => [
		'display'           => 'flex',
		'flex-direction'    => 'row',
		'justify-content'   => $alignmentMobile,
		'-webkit-box-pack'  => $alignmentMobile,
		'-ms-flex-pack'     => $alignmentMobile,
		'-webkit-box-align' => 'center',
		'-ms-flex-align'    => 'center',
		'align-items'       => 'center',
		'margin-top'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockTopMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-right'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockRightMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-bottom'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockBottomMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'margin-left'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['blockLeftMarginMobile'], $attr['blockMarginUnitMobile'] ),
		'padding-top'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockTopPaddingMobile'],
			$attr['blockPaddingUnitMobile']
		),
		'padding-right'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockRightPaddingMobile'],
			$attr['blockPaddingUnitMobile']
		),
		'padding-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockBottomPaddingMobile'],
			$attr['blockPaddingUnitMobile']
		),
		'padding-left'      => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['blockLeftPaddingMobile'],
			$attr['blockPaddingUnitMobile']
		),
	],
];

$selectors[' .wp-block-vxt-icon-list-child .vxt-icon-list__label'] = [
	'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSize'], $attr['fontSizeType'] ),
	'font-family'     => $attr['fontFamily'],
	'text-transform'  => $attr['fontTransform'],
	'text-decoration' => $attr['fontDecoration'] . '!important',
	'font-style'      => $attr['fontStyle'],
	'font-weight'     => $attr['fontWeight'],
	'line-height'     => $attr['lineHeight'] . $attr['lineHeightType'],
	'letter-spacing'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelLetterSpacing'], $attr['labelLetterSpacingType'] ),
	'color'           => $attr['labelColor'],
];

$mSelectors[' .wp-block-vxt-icon-list-child .vxt-icon-list__label'] = [
	'font-size'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSizeMobile'], $attr['fontSizeType'] ),
	'line-height'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeightMobile'], $attr['lineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelLetterSpacingMobile'], $attr['labelLetterSpacingType'] ),
];

$tSelectors[' .wp-block-vxt-icon-list-child .vxt-icon-list__label'] = [
	'font-size'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSizeTablet'], $attr['fontSizeType'] ),
	'line-height'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeightTablet'], $attr['lineHeightType'] ),
	'letter-spacing' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelLetterSpacingTablet'], $attr['labelLetterSpacingType'] ),
];

if ( 'horizontal' === $iconLayout ) {
	$selectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child'] = [
		'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['gap'] / 2 ), $attr['gapType'] ),
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $attr['gap'] / 2 ), $attr['gapType'] ),
		'display'      => 'inline-flex',
	];

	$selectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child:first-child'] = [
		'margin-left' => 0,
	];
	$selectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child:last-child']  = [
		'margin-right' => 0,
	];
} elseif ( 'vertical' === $iconLayout ) {
	$selectors[' .vxt-icon-list__wrap']['flex-direction']    = 'column';
	$selectors[' .vxt-icon-list__wrap']['align-items']       = $alignment;
	$selectors[' .vxt-icon-list__wrap']['-webkit-box-align'] = $alignment;
	$selectors[' .vxt-icon-list__wrap']['-ms-flex-align']    = $alignment;
	$selectors[' .vxt-icon-list__wrap']['justify-content']   = 'center';
	$selectors[' .vxt-icon-list__wrap']['-webkit-box-pack']  = 'center';
	$selectors[' .vxt-icon-list__wrap']['-ms-flex-pack']     = 'center';

	$selectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child'] = [
		'margin-left'   => 0,
		'margin-right'  => 0,
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gap'], $attr['gapType'] ),
	];
}

if ( 'horizontal' === $iconLayoutTablet ) {
	$tSelectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child']             = [
		'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( $tgapFallback / 2 ), $attr['gapType'] ),
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $tgapFallback / 2 ), $attr['gapType'] ),
		'display'      => 'inline-flex',
	];
	$tSelectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child:first-child'] = [
		'margin-left' => 0,
	];

} elseif ( 'vertical' === $iconLayoutTablet ) {
	$tSelectors[' .vxt-icon-list__wrap']['flex-direction']    = 'column';
	$tSelectors[' .vxt-icon-list__wrap']['align-items']       = $alignmentTablet;
	$tSelectors[' .vxt-icon-list__wrap']['-webkit-box-align'] = $alignmentTablet;
	$tSelectors[' .vxt-icon-list__wrap']['-ms-flex-align']    = $alignmentTablet;
	$tSelectors[' .vxt-icon-list__wrap']['justify-content']   = 'center';
	$tSelectors[' .vxt-icon-list__wrap']['-webkit-box-pack']  = 'center';
	$tSelectors[' .vxt-icon-list__wrap']['-ms-flex-pack']     = 'center';

	$tSelectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child'] = [
		'margin-left'   => 0,
		'margin-right'  => 0,
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $tgapFallback, $attr['gapType'] ),
	];
}


if ( 'horizontal' === $iconLayoutMobile ) {
	$mSelectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child']             = [
		'margin-left'  => \Vexaltrix\Core\Support\Helper::getCssValue( ( $mgapFallback / 2 ), $attr['gapType'] ),
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( ( $mgapFallback / 2 ), $attr['gapType'] ),
		'display'      => 'inline-flex',
	];
	$mSelectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child:first-child'] = [
		'margin-left' => 0,
	];
} elseif ( 'vertical' === $iconLayoutMobile ) {
	$mSelectors[' .vxt-icon-list__wrap']['flex-direction']    = 'column';
	$mSelectors[' .vxt-icon-list__wrap']['align-items']       = $alignmentMobile;
	$mSelectors[' .vxt-icon-list__wrap']['-webkit-box-align'] = $alignmentMobile;
	$mSelectors[' .vxt-icon-list__wrap']['-ms-flex-align']    = $alignmentMobile;
	$mSelectors[' .vxt-icon-list__wrap']['justify-content']   = 'center';
	$mSelectors[' .vxt-icon-list__wrap']['-webkit-box-pack']  = 'center';
	$mSelectors[' .vxt-icon-list__wrap']['-ms-flex-pack']     = 'center';

	$mSelectors['.wp-block-vxt-icon-list .wp-block-vxt-icon-list-child'] = [
		'margin-left'   => 0,
		'margin-right'  => 0,
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $mgapFallback, $attr['gapType'] ),
	];
}

if ( ! $attr['childMigrate'] ) {

	$defaults = VXT_DIR . 'includes/blocks/icon-list-child/attributes.php';

	if ( file_exists( $defaults ) ) {
		$defaultAttr = include $defaults;
	}

	$defaultAttr = ( ! empty( $defaultAttr ) && is_array( $defaultAttr ) ) ? $defaultAttr : [];

	foreach ( $attr['icons'] as $key => $icon ) {

		$wrapper = ( ! $attr['childMigrate'] ) ? ' .vxt-icon-list__repeater-' . $key . '.wp-block-vxt-icon-list-child' : ' .wp-block-vxt-icon-list-child';

		$selectors[ $wrapper ]                                     = [
			'font-family'     => $attr['fontFamily'],
			'text-transform'  => $attr['fontTransform'],
			'text-decoration' => $attr['fontDecoration'] . '!important',
			'font-style'      => $attr['fontStyle'],
			'font-weight'     => $attr['fontWeight'],
			'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSize'], $attr['sizeType'] ),
			'line-height'     => $attr['lineHeight'] . $attr['lineHeightType'],
		];
		$mSelectorsChild[ $wrapper . ' .vxt-icon-list__label' ] = [
			'font-family'     => $attr['fontFamily'],
			'text-transform'  => $attr['fontTransform'],
			'text-decoration' => $attr['fontDecoration'] . '!important',
			'font-style'      => $attr['fontStyle'],
			'font-weight'     => $attr['fontWeight'],
			'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSizeMobile'], $attr['sizeType'] ),
			'line-height'     => $attr['lineHeightMobile'] . $attr['lineHeightType'],
		];
		$tSelectorsChild[ $wrapper . ' .vxt-icon-list__label' ] = [
			'font-family'     => $attr['fontFamily'],
			'text-transform'  => $attr['fontTransform'],
			'text-decoration' => $attr['fontDecoration'] . '!important',
			'font-style'      => $attr['fontStyle'],
			'font-weight'     => $attr['fontWeight'],
			'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSizeTablet'], $attr['sizeType'] ),
			'line-height'     => $attr['lineHeightTablet'] . $attr['lineHeightType'],
		];

		if ( $attr['icon_count'] <= $key ) {
			break;
		}

		$icon = array_merge( $defaultAttr, (array) $icon );

		$childSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getIconListChildSelectors( $icon, $key, $attr['childMigrate'] );
		$selectors       = array_merge( $selectors, (array) $childSelectors );
		$tSelectors     = array_merge( $tSelectors, (array) $tSelectorsChild );
		$mSelectors     = array_merge( $mSelectors, (array) $mSelectorsChild );
	}
}

if ( 'right' === $attr['align'] && $attr['hideLabel'] ) {
	$selectors[' .vxt-icon-list__source-wrap']   = [
		'margin-right' => '0px',
	];
	$mSelectors[' .vxt-icon-list__source-wrap'] = [
		'margin-right' => '0px',
	];
	$tSelectors[' .vxt-icon-list__source-wrap'] = [
		'margin-right' => '0px',
	];
} else {
	if ( 'before' === $attr['iconPlacement'] && ! $attr['hideLabel'] ) {
		$selectors[' .vxt-icon-list__source-wrap']   = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['inner_gap'], $attr['innerGapType'] ),
		];
		$mSelectors[' .vxt-icon-list__source-wrap'] = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['innerGapMobile'], $attr['innerGapType'] ),
		];
		$tSelectors[' .vxt-icon-list__source-wrap'] = [
			'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['innerGapTablet'], $attr['innerGapType'] ),
		];
	} elseif ( 'after' === $attr['iconPlacement'] && ! $attr['hideLabel'] ) {
		$selectors[' .vxt-icon-list__source-wrap']    = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['inner_gap'], $attr['innerGapType'] ),
		];
		$mSelectors[' .vxt-icon-list__source-wrap']  = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['innerGapMobile'], $attr['innerGapType'] ),
		];
		$tSelectors[' .vxt-icon-list__source-wrap']  = [
			'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['innerGapTablet'], $attr['innerGapType'] ),
		];
		$selectors[' .wp-block-vxt-icon-list-child '] = [
			'flex-direction' => 'row-reverse',
		];
	}
	if ( 'center' === $attr['align'] ) {
		$selectors[' .wp-block-vxt-icon-list-child'] = [
			'text-align' => 'center',
		];
	}
}


$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = ( $attr['classMigrate'] ) ? '.wp-block-vxt-icon-list.vxt-block-' : '#vxt-icon-list-';

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
