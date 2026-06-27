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
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksButtonsGfont( $attr );

$mSelectors = [];
$tSelectors = [];
$selectors   = [];

$buttonDesktopPadding = [];
$buttonTabletPadding  = [];
$buttonMobilePadding  = [];

if ( ! $attr['inheritGap'] ) {
	if ( 'desktop' === $attr['stack'] ) {
		// High specificity needed here as to make it uniform as across all the device breakpoints as for other device breakpoints this was taking the higher specificity.
		$selectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap ']   = [
			'flex-direction' => 'column',
			'gap'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gap'], 'px' ),
		];
		$tSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap '] = [
			'gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapTablet'], 'px' ),
		];
		$mSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap '] = [
			'gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapMobile'], 'px' ),
		];

	} elseif ( 'tablet' === $attr['stack'] ) {

		$selectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap  .vxt-buttons__wrap '] = [
			'gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gap'], 'px' ),
		];
		$tSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap'] = [
			'flex-direction' => 'column',
			'gap'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapTablet'], 'px' ),
		];
		$mSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap'] = [
			'flex-direction' => 'column',
			'gap'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapMobile'], 'px' ),
		];

	} elseif ( 'mobile' === $attr['stack'] ) {

		$selectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap ']  = [
			'flex-direction' => 'row',
			'gap'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gap'], 'px' ),
		];
		$tSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap'] = [
			'gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapTablet'], 'px' ),
		];
		$mSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap'] = [
			'flex-direction' => 'column',
			'gap'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapMobile'], 'px' ),
		];

	} elseif ( 'none' === $attr['stack'] ) {
		$selectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap ']  = [
			'gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gap'], 'px' ),
		];
		$tSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap'] = [
			'gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapTablet'], 'px' ),
		];
		$mSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap'] = [
			'gap' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['gapMobile'], 'px' ),
		];
	}
}

if ( $attr['inheritGap'] ) {
	if ( 'desktop' === $attr['stack'] ) {
		$selectors[' .vxt-buttons__wrap '] = [
			'flex-direction' => 'column',
		];
	} elseif ( 'tablet' === $attr['stack'] ) {

		$tSelectors[' .vxt-buttons__wrap'] = [
			'flex-direction' => 'column',
		];
		$mSelectors[' .vxt-buttons__wrap'] = [
			'flex-direction' => 'column',
		];

	} elseif ( 'mobile' === $attr['stack'] ) {

		$selectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap ']  = [
			'flex-direction' => 'row',
		];
		$mSelectors['.wp-block-vxt-buttons.vxt-buttons__outer-wrap .vxt-buttons__wrap'] = [
			'flex-direction' => 'column',
		];
	}
}

if ( $attr['flexWrap'] ) {
	$selectors[' .vxt-buttons__wrap ']['flex-wrap'] = 'wrap';
}

$vAlign = '';
switch ( $attr['verticalAlignment'] ) {
	case 'top':
		$vAlign = 'flex-start';
		break;
	case 'bottom':
		$vAlign = 'flex-end';
		break;
	default:
		$vAlign = 'center';
		break;
}
if ( 'full' !== $attr['align'] ) {
	$selectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap '] = [
		'justify-content' => $attr['align'],
		'align-items'     => $vAlign,
	];
} else {
	$selectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap']                   = [
		'width'       => '100%',
		'align-items' => $vAlign,
	];
	$selectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap .wp-block-button '] = [
		'width' => '100%',
	];
}

if ( 'full' !== $attr['alignTablet'] ) {
	$tSelectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap ']                 = [
		'justify-content' => $attr['alignTablet'],
		'align-items'     => $vAlign,
	];
	$tSelectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap .wp-block-button'] = [
		'width' => 'auto',
	];
} else {
	$tSelectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap']                   = [
		'width' => '100%',
	];
	$tSelectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap .wp-block-button '] = [
		'width' => '100%',
	];
}

if ( 'full' !== $attr['alignMobile'] ) {
	$mSelectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap ']                 = [
		'justify-content' => $attr['alignMobile'],
		'align-items'     => $vAlign,
	];
	$mSelectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap .wp-block-button'] = [
		'width' => 'auto',
	];
} else {
	$mSelectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap']                   = [
		'width' => '100%',
	];
	$mSelectors['.vxt-buttons__outer-wrap .vxt-buttons__wrap .wp-block-button '] = [
		'width' => '100%',
	];
}

if ( $attr['childMigrate'] ) {

	$buttonDesktopStyle = [ // For Backword user.
		'font-family'     => $attr['fontFamily'],
		'text-transform'  => $attr['fontTransform'],
		'text-decoration' => $attr['fontDecoration'],
		'font-style'      => $attr['fontStyle'],
		'font-weight'     => $attr['fontWeight'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSize'], $attr['fontSizeType'] ),
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeight'], $attr['lineHeightType'] ),
		'letter-spacing'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontLetterSpacing'], $attr['fontLetterSpacingType'] ),
	];

	if ( 'default' === $attr['buttonSize'] ) {
		$buttonDesktopPadding = [
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topPadding'], $attr['paddingUnit'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomPadding'], $attr['paddingUnit'] ),
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftPadding'], $attr['paddingUnit'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightPadding'], $attr['paddingUnit'] ),
		];
		$buttonTabletPadding  = [
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topTabletPadding'], $attr['tabletPaddingUnit'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomTabletPadding'], $attr['tabletPaddingUnit'] ),
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftTabletPadding'], $attr['tabletPaddingUnit'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightTabletPadding'], $attr['tabletPaddingUnit'] ),
		];
		$buttonMobilePadding  = [
			'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMobilePadding'], $attr['mobilePaddingUnit'] ),
			'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMobilePadding'], $attr['mobilePaddingUnit'] ),
			'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMobilePadding'], $attr['mobilePaddingUnit'] ),
			'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMobilePadding'], $attr['mobilePaddingUnit'] ),
		];
	}

	$buttonTabletStyle = [
		'font-size'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSizeTablet'], $attr['fontSizeTypeTablet'] ),
		'line-height'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeightTablet'], $attr['lineHeightType'] ),
		'letter-spacing' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontLetterSpacingTablet'], $attr['fontLetterSpacingType'] ),
	];

	$buttonMobileStyle = [
		'font-size'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontSizeMobile'], $attr['fontSizeTypeMobile'] ),
		'line-height'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['lineHeightMobile'], $attr['lineHeightType'] ),
		'letter-spacing' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fontLetterSpacingMobile'], $attr['fontLetterSpacingType'] ),
	];

	$buttonDesktopStyle = $buttonDesktopPadding ? array_merge( $buttonDesktopStyle, $buttonDesktopPadding ) : $buttonDesktopStyle;
	$buttonTabletStyle  = $buttonTabletPadding ? array_merge( $buttonTabletStyle, $buttonTabletPadding ) : $buttonTabletStyle;
	$buttonMobileStyle  = $buttonMobilePadding ? array_merge( $buttonMobileStyle, $buttonMobilePadding ) : $buttonMobileStyle;

	$selectors[' .vxt-buttons-repeater:not(.wp-block-button__link)']                 = $buttonDesktopStyle; // For Backword user.
	$selectors[' .vxt-button__wrapper .vxt-buttons-repeater.wp-block-button__link'] = $buttonDesktopStyle; // For New User.
	$selectors[' .vxt-button__wrapper .vxt-buttons-repeater.ast-outline-button']    = $buttonDesktopStyle; // For Secondary color from Astra Customizer.
	$tSelectors[' .vxt-buttons-repeater:not(.wp-block-button__link)']               = $buttonTabletStyle; // For Backword user.
	$tSelectors[' .vxt-buttons-repeater.wp-block-button__link']                     = $buttonTabletStyle; // For New User.
	$mSelectors[' .vxt-buttons-repeater:not(.wp-block-button__link)']               = $buttonMobileStyle; // For Backword user.
	$mSelectors[' .vxt-buttons-repeater.wp-block-button__link']                     = $buttonMobileStyle; // For New User.

	$selectors[' .vxt-button__wrapper'] = [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMargin'], $attr['marginType'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMargin'], $attr['marginType'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMargin'], $attr['marginType'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMargin'], $attr['marginType'] ),
	];

	$tSelectors[' .vxt-button__wrapper'] = [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginTablet'], $attr['marginType'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginTablet'], $attr['marginType'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginTablet'], $attr['marginType'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginTablet'], $attr['marginType'] ),
	];

	$mSelectors[' .vxt-button__wrapper'] = [
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['topMarginMobile'], $attr['marginType'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['bottomMarginMobile'], $attr['marginType'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['leftMarginMobile'], $attr['marginType'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['rightMarginMobile'], $attr['marginType'] ),
	];
}

if ( ! $attr['childMigrate'] ) {

	$defaults = VXT_DIR . 'includes/blocks/buttons-child/attributes.php';

	if ( file_exists( $defaults ) ) {
		$defaultAttr = include $defaults;
	}

	$defaultAttr = ( ! empty( $defaultAttr ) && is_array( $defaultAttr ) ) ? $defaultAttr : [];

	foreach ( $attr['buttons'] as $key => $button ) {

		if ( $attr['btn_count'] <= $key ) {
			break;
		}

		$button = array_merge( $defaultAttr, $button );

		$wrapper = ( ! $attr['childMigrate'] ) ? ' .vxt-buttons-repeater-' . $key . '.vxt-button__wrapper' : ' .vxt-buttons-repeater';

		$selectors[ $wrapper ] = [
			'font-family'     => $attr['fontFamily'],
			'text-transform'  => $attr['fontTransform'],
			'text-decoration' => $attr['fontDecoration'],
			'font-style'      => $attr['fontStyle'],
			'font-weight'     => $attr['fontWeight'],
		];

		$childSelectors = \Vexaltrix\Presentation\Blocks\BlockHelper::getButtonsChildSelectors( $button, $key, $attr['childMigrate'] );
		$selectors       = array_merge( $selectors, $childSelectors['selectors'] );
		$tSelectors     = array_merge( $tSelectors, $childSelectors['t_selectors'] );
		$mSelectors     = array_merge( $mSelectors, $childSelectors['m_selectors'] );
	}
}

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-buttons-';

return \Vexaltrix\Core\Support\Helper::generateAllCss( 
	$combinedSelectors,
	$baseSelector . $id,
	isset( $gbsClass ) ? $gbsClass : ''
);
