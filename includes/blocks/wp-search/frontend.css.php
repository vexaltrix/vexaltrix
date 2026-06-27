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
\Vexaltrix\Core\Blocks\BlockJs::blocksWpSearchGfont( $attr );

$selectors            = [];
$tSelectors          = [];
$mSelectors          = [];
$boxShadowPositionCSS = $attr['boxShadowPosition'];

if ( 'outset' === $attr['boxShadowPosition'] ) {
	$boxShadowPositionCSS = '';
}
$paddingInputTop          = isset( $attr['paddingInputTop'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputTop'], $attr['inputPaddingTypeDesktop'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['vinputPaddingDesktop'], $attr['inputPaddingTypeDesktop'] );
$paddingInputRight        = isset( $attr['paddingInputRight'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputRight'], $attr['inputPaddingTypeDesktop'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['hinputPaddingDesktop'], $attr['inputPaddingTypeDesktop'] );
$paddingInputBottom       = isset( $attr['paddingInputBottom'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputBottom'], $attr['inputPaddingTypeDesktop'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['vinputPaddingDesktop'], $attr['inputPaddingTypeDesktop'] );
$paddingInputLeft         = isset( $attr['paddingInputLeft'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputLeft'], $attr['inputPaddingTypeDesktop'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['hinputPaddingDesktop'], $attr['inputPaddingTypeDesktop'] );
$paddingInputTopTablet    = isset( $attr['paddingInputTopTablet'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputTopTablet'], $attr['tabletPaddingInputUnit'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['vinputPaddingTablet'], $attr['inputPaddingTypeDesktop'] );
$paddingInputRightTablet  = isset( $attr['paddingInputRightTablet'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputRightTablet'], $attr['tabletPaddingInputUnit'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['hinputPaddingTablet'], $attr['inputPaddingTypeDesktop'] );
$paddingInputBottomTablet = isset( $attr['paddingInputBottomTablet'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputBottomTablet'], $attr['tabletPaddingInputUnit'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['vinputPaddingTablet'], $attr['inputPaddingTypeDesktop'] );
$paddingInputLeftTablet   = isset( $attr['paddingInputLeftTablet'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputLeftTablet'], $attr['tabletPaddingInputUnit'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['hinputPaddingTablet'], $attr['inputPaddingTypeDesktop'] );
$paddingInputTopMobile    = isset( $attr['paddingInputTopMobile'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputTopMobile'], $attr['mobilePaddingInputUnit'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['vinputPaddingMobile'], $attr['inputPaddingTypeDesktop'] );
$paddingInputRightMobile  = isset( $attr['paddingInputRightMobile'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputRightMobile'], $attr['mobilePaddingInputUnit'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['hinputPaddingMobile'], $attr['inputPaddingTypeDesktop'] );
$paddingInputBottomMobile = isset( $attr['paddingInputBottomMobile'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputBottomMobile'], $attr['mobilePaddingInputUnit'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['vinputPaddingMobile'], $attr['inputPaddingTypeDesktop'] );
$paddingInputLeftMobile   = isset( $attr['paddingInputLeftMobile'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['paddingInputLeftMobile'], $attr['mobilePaddingInputUnit'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['hinputPaddingMobile'], $attr['inputPaddingTypeDesktop'] );

$iconSize       = \Vexaltrix\Support\Helper::getCssValue( $attr['iconSize'], $attr['iconSizeType'] );
$buttonIconSize = \Vexaltrix\Support\Helper::getCssValue( $attr['buttonIconSize'], $attr['buttonIconSizeType'] );
$inputCSS       = [
	'color'            => $attr['textColor'],
	'background-color' => $attr['inputBgColor'],
	'border'           => 0,
	'border-radius'    => '0px',
	'margin'           => 0,
	'outline'          => 'unset',
	'padding-top'      => $paddingInputTop,
	'padding-bottom'   => $paddingInputBottom,
	'padding-right'    => $paddingInputRight,
	'padding-left'     => $paddingInputLeft,
];


$inputBorderCSS       = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'input' );
$inputBorderCSS       = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$inputBorderCSS,
	( isset( $attr['borderWidth'] ) ? $attr['borderWidth'] : '' ),
	( isset( $attr['borderRadius'] ) ? $attr['borderRadius'] : '' ),
	( isset( $attr['borderColor'] ) ? $attr['borderColor'] : '' ),
	( isset( $attr['borderStyle'] ) ? $attr['borderStyle'] : '' )
);
$inputBorderCSSTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'input', 'tablet' );
$inputBorderCSSMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'input', 'mobile' );

$boxCSS = array_merge(
	$inputBorderCSS,
	[
		'outline'    => 'unset',
		'box-shadow' => \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $boxShadowPositionCSS,
		'transition' => 'all .5s',
	]
);
if ( 'px' === $attr['inputSizeType'] ) {
	$boxCSS['max-width'] = \Vexaltrix\Support\Helper::getCssValue( $attr['inputSize'], $attr['inputSizeType'] );
} else {
	$boxCSS['width'] = \Vexaltrix\Support\Helper::getCssValue( $attr['inputSize'], $attr['inputSizeType'] );
}
$iconColor = $attr['textColor'];

if ( $attr['iconColor'] && '' !== $attr['iconColor'] ) {
	$iconColor = $attr['iconColor'];
}

$selectors = [
	' .vxt-search-form__container .vxt-search-submit' => [
		'width'   => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonWidth'], $attr['buttonWidthType'] ),
		'padding' => 0,
		'border'  => 0,
	],
	' .vxt-search-form__container .vxt-search-form__input::placeholder' => [
		'color'   => $attr['textColor'],
		'opacity' => 0.6,
	],
	' .vxt-search-form__container .vxt-search-submit .vxt-wp-search-button-icon-wrap svg' => [
		'width'     => $buttonIconSize,
		'height'    => $buttonIconSize,
		'font-size' => $buttonIconSize,
		'fill'      => $attr['buttonIconColor'],
	],
	' .vxt-search-form__container .vxt-search-submit:hover .vxt-wp-search-button-icon-wrap svg' => [
		'fill' => $attr['buttonIconHoverColor'],
	],
	' .vxt-search-form__container .vxt-search-submit .vxt-wp-search-button-text' => [
		'color' => $attr['buttonTextColor'],
	],
	' .vxt-search-form__container .vxt-search-submit:hover .vxt-wp-search-button-text' => [
		'color' => $attr['buttonTextHoverColor'],
	],
	'.vxt-layout-input .vxt-wp-search-icon-wrap svg'  => [
		'width'     => $iconSize,
		'height'    => $iconSize,
		'font-size' => $iconSize,
		'fill'      => $iconColor,
	],
];

if ( 'input-button' === $attr['layout'] || 'input' === $attr['layout'] ) {
	$selectors[' .vxt-search-form__container .vxt-search-form__input'] = $inputCSS;

	$selectors[' .vxt-search-wrapper .vxt-search-form__container']       = $boxCSS;
	$selectors[' .vxt-search-wrapper .vxt-search-form__container:hover'] = [
		'border-color' => $attr['inputBorderHColor'],
	];

	if ( 'inset' === $attr['boxShadowPosition'] ) {
		$selectors[' .vxt-search-wrapper .vxt-search-form__input'] = [

			'box-shadow' => \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) . ' ' . \Vexaltrix\Support\Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) . ' ' . $attr['boxShadowColor'] . ' ' . $boxShadowPositionCSS,
		];
	}

	$selectors[' .vxt-search-form__container .vxt-wp-search-icon-wrap'] = [
		'background-color' => $attr['inputBgColor'],
		'padding-top'      => $paddingInputTop,
		'padding-bottom'   => $paddingInputBottom,
		'padding-left'     => $paddingInputLeft,
	];
}

$selectors['.vxt-layout-input-button .vxt-search-wrapper .vxt-search-form__container .vxt-search-submit']       = [
	'background-color' => $attr['buttonBgColor'],
];
$selectors['.vxt-layout-input-button .vxt-search-wrapper .vxt-search-form__container .vxt-search-submit:hover'] = [
	'background-color' => $attr['buttonBgHoverColor'],
];

$mSelectors = [
	' .vxt-search-wrapper .vxt-search-form__container' => $inputBorderCSSMobile,
	' .vxt-search-wrapper .vxt-search-form__container .vxt-search-form__input' => [
		'padding-top'    => $paddingInputTopMobile,
		'padding-bottom' => $paddingInputBottomMobile,
		'padding-right'  => $paddingInputRightMobile,
		'padding-left'   => $paddingInputLeftMobile,
	],
	' .vxt-search-form__container .vxt-wp-search-icon-wrap' => [
		'padding-top'    => $paddingInputTopMobile,
		'padding-bottom' => $paddingInputBottomMobile,
		'padding-left'   => $paddingInputLeftMobile,
	],
];

$tSelectors        = [
	' .vxt-search-wrapper .vxt-search-form__container' => $inputBorderCSSTablet,
	' .vxt-search-wrapper .vxt-search-form__container .vxt-search-form__input' => [
		'padding-top'    => $paddingInputTopTablet,
		'padding-bottom' => $paddingInputBottomTablet,
		'padding-right'  => $paddingInputRightTablet,
		'padding-left'   => $paddingInputLeftTablet,
	],
	' .vxt-search-form__container .vxt-wp-search-icon-wrap' => [
		'padding-top'    => $paddingInputTopTablet,
		'padding-bottom' => $paddingInputBottomTablet,
		'padding-left'   => $paddingInputLeftTablet,
	],
];
$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'input', ' .vxt-search-wrapper .vxt-search-form__container .vxt-search-form__input', $combinedSelectors );

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'button', ' .vxt-search-wrapper .vxt-search-form__container .vxt-search-submit .vxt-wp-search-button-text', $combinedSelectors );

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
