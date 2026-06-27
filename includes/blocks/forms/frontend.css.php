<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined elsewhere.
 *
 * @var mixed[] $attr
 */

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksFormsGfont( $attr );

$selectors   = [];
$mSelectors = [];
$tSelectors = [];

$btnPaddingTop    = isset( $attr['paddingBtnTop'] ) ? $attr['paddingBtnTop'] : $attr['vPaddingSubmit'];
$btnPaddingBottom = isset( $attr['paddingBtnBottom'] ) ? $attr['paddingBtnBottom'] : $attr['vPaddingSubmit'];
$btnPaddingLeft   = isset( $attr['paddingBtnLeft'] ) ? $attr['paddingBtnLeft'] : $attr['hPaddingSubmit'];
$btnPaddingRight  = isset( $attr['paddingBtnRight'] ) ? $attr['paddingBtnRight'] : $attr['hPaddingSubmit'];

$paddingFieldTop    = isset( $attr['paddingFieldTop'] ) ? $attr['paddingFieldTop'] : $attr['vPaddingField'];
$paddingFieldBottom = isset( $attr['paddingFieldBottom'] ) ? $attr['paddingFieldBottom'] : $attr['vPaddingField'];
$paddingFieldLeft   = isset( $attr['paddingFieldLeft'] ) ? $attr['paddingFieldLeft'] : $attr['hPaddingField'];
$paddingFieldRight  = isset( $attr['paddingFieldRight'] ) ? $attr['paddingFieldRight'] : $attr['hPaddingField'];

$toggleSizeNumberTablet = is_numeric( $attr['toggleSizeTablet'] ) ? $attr['toggleSizeTablet'] : $attr['toggleSize'];
$toggleSizeNumberMobile = is_numeric( $attr['toggleSizeMobile'] ) ? $attr['toggleSizeMobile'] : $toggleSizeNumberTablet;

$toggleWidthSizeNumberTablet = is_numeric( $attr['toggleWidthSizeTablet'] ) ? $attr['toggleWidthSizeTablet'] : $attr['toggleWidthSize'];
$toggleWidthSizeNumberMobile = is_numeric( $attr['toggleWidthSizeMobile'] ) ? $attr['toggleWidthSizeMobile'] : $toggleWidthSizeNumberTablet;

$inputOverallBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'field' );
$inputOverallBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$inputOverallBorder,
	( isset( $attr['inputborderWidth'] ) ? $attr['inputborderWidth'] : '' ),
	( isset( $attr['inputborderRadius'] ) ? $attr['inputborderRadius'] : '' ),
	( isset( $attr['inputborderColor'] ) ? $attr['inputborderColor'] : '' ),
	( isset( $attr['inputborderStyle'] ) ? $attr['inputborderStyle'] : '' )
);
$inputOverallBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'field', 'tablet' );
$inputOverallBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'field', 'mobile' );
$inputUnderlineBorder      = ( isset( $attr['fieldBorderBottomWidth'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['fieldBorderBottomWidth'], 'px' ) : '' );

$successMessageBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'successMsg' );
$successMessageBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$successMessageBorder,
	( isset( $attr['successMessageBorderWidth'] ) ? $attr['successMessageBorderWidth'] : '' ),
	( isset( $attr['successMessageBorderRadius'] ) ? $attr['successMessageBorderRadius'] : '' ),
	( isset( $attr['successMessageBorderColor'] ) ? $attr['successMessageBorderColor'] : '' ),
	( isset( $attr['successMessageBorderStyle'] ) ? $attr['successMessageBorderStyle'] : '' )
);
$successMessageBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'successMsg', 'tablet' );
$successMessageBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'successMsg', 'mobile' );

$failedMessageBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'errorMsg' );
$failedMessageBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$failedMessageBorder,
	( isset( $attr['failedMessageBorderWidth'] ) ? $attr['failedMessageBorderWidth'] : '' ),
	( isset( $attr['failedMessageBorderRadius'] ) ? $attr['failedMessageBorderRadius'] : '' ),
	( isset( $attr['failedMessageBorderColor'] ) ? $attr['failedMessageBorderColor'] : '' ),
	( isset( $attr['failedMessageBorderStyle'] ) ? $attr['failedMessageBorderStyle'] : '' )
);
$failedMessageBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'errorMsg', 'tablet' );
$failedMessageBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'errorMsg', 'mobile' );

$toggleBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'checkBoxToggle' );
$toggleBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$toggleBorder,
	( isset( $attr['inputborderWidth'] ) ? $attr['inputborderWidth'] : '' ),
	( isset( $attr['inputborderRadius'] ) ? $attr['inputborderRadius'] : '' ),
	( isset( $attr['inputborderColor'] ) ? $attr['inputborderColor'] : '' ),
	( isset( $attr['inputborderStyle'] ) ? $attr['inputborderStyle'] : '' )
);
$toggleBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'checkBoxToggle', 'tablet' );
$toggleBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'checkBoxToggle', 'mobile' );

// Individual Toggle Border Width Fallback for Math Calculations.
$toggleBorderTopTabletFallback    = isset( $toggleBorderTablet['border-top-width'] ) ? ( ! empty( $toggleBorderTablet['border-top-width'] ) ? $toggleBorderTablet['border-top-width'] : $toggleBorder['border-top-width'] ) : $toggleBorder['border-top-width'];
$toggleBorderLeftTabletFallback   = isset( $toggleBorderTablet['border-left-width'] ) ? ( ! empty( $toggleBorderTablet['border-left-width'] ) ? $toggleBorderTablet['border-left-width'] : $toggleBorder['border-left-width'] ) : $toggleBorder['border-left-width'];
$toggleBorderRightTabletFallback  = isset( $toggleBorderTablet['border-right-width'] ) ? ( ! empty( $toggleBorderTablet['border-right-width'] ) ? $toggleBorderTablet['border-right-width'] : $toggleBorder['border-right-width'] ) : $toggleBorder['border-right-width'];
$toggleBorderBottomTabletFallback = isset( $toggleBorderTablet['border-bottom-width'] ) ? ( ! empty( $toggleBorderTablet['border-bottom-width'] ) ? $toggleBorderTablet['border-bottom-width'] : $toggleBorder['border-bottom-width'] ) : $toggleBorder['border-bottom-width'];
$toggleBorderTopMobileFallback    = isset( $toggleBorderMobile['border-top-width'] ) ? ( ! empty( $toggleBorderMobile['border-top-width'] ) ? $toggleBorderMobile['border-top-width'] : $toggleBorderTopTabletFallback ) : $toggleBorderTopTabletFallback;
$toggleBorderLeftMobileFallback   = isset( $toggleBorderMobile['border-left-width'] ) ? ( ! empty( $toggleBorderMobile['border-left-width'] ) ? $toggleBorderMobile['border-left-width'] : $toggleBorderLeftTabletFallback ) : $toggleBorderLeftTabletFallback;
$toggleBorderRightMobileFallback  = isset( $toggleBorderMobile['border-right-width'] ) ? ( ! empty( $toggleBorderMobile['border-right-width'] ) ? $toggleBorderMobile['border-right-width'] : $toggleBorderRightTabletFallback ) : $toggleBorderRightTabletFallback;
$toggleBorderBottomMobileFallback = isset( $toggleBorderMobile['border-bottom-width'] ) ? ( ! empty( $toggleBorderMobile['border-bottom-width'] ) ? $toggleBorderMobile['border-bottom-width'] : $toggleBorderBottomTabletFallback ) : $toggleBorderBottomTabletFallback;

// Individual Toggle Border Radius Fallback for Inner Dot.
$toggleBorderRadiusTlTabletFallback = isset( $toggleBorderTablet['border-top-left-radius'] ) ? ( ! empty( $toggleBorderTablet['border-top-left-radius'] ) ? $toggleBorderTablet['border-top-left-radius'] : $toggleBorder['border-top-left-radius'] ) : $toggleBorder['border-top-left-radius'];
$toggleBorderRadiusTrTabletFallback = isset( $toggleBorderTablet['border-top-right-radius'] ) ? ( ! empty( $toggleBorderTablet['border-top-right-radius'] ) ? $toggleBorderTablet['border-top-right-radius'] : $toggleBorder['border-top-right-radius'] ) : $toggleBorder['border-top-right-radius'];
$toggleBorderRadiusBlTabletFallback = isset( $toggleBorderTablet['border-bottom-left-radius'] ) ? ( ! empty( $toggleBorderTablet['border-bottom-left-radius'] ) ? $toggleBorderTablet['border-bottom-left-radius'] : $toggleBorder['border-bottom-left-radius'] ) : $toggleBorder['border-bottom-left-radius'];
$toggleBorderRadiusBrTabletFallback = isset( $toggleBorderTablet['border-bottom-right-radius'] ) ? ( ! empty( $toggleBorderTablet['border-bottom-right-radius'] ) ? $toggleBorderTablet['border-bottom-right-radius'] : $toggleBorder['border-bottom-right-radius'] ) : $toggleBorder['border-bottom-right-radius'];
$toggleBorderRadiusTlMobileFallback = isset( $toggleBorderMobile['border-top-left-radius'] ) ? ( ! empty( $toggleBorderMobile['border-top-left-radius'] ) ? $toggleBorderMobile['border-top-left-radius'] : $toggleBorderRadiusTlTabletFallback ) : $toggleBorderRadiusTlTabletFallback;
$toggleBorderRadiusTrMobileFallback = isset( $toggleBorderMobile['border-top-right-radius'] ) ? ( ! empty( $toggleBorderMobile['border-top-right-radius'] ) ? $toggleBorderMobile['border-top-right-radius'] : $toggleBorderRadiusTrTabletFallback ) : $toggleBorderRadiusTrTabletFallback;
$toggleBorderRadiusBlMobileFallback = isset( $toggleBorderMobile['border-bottom-left-radius'] ) ? ( ! empty( $toggleBorderMobile['border-bottom-left-radius'] ) ? $toggleBorderMobile['border-bottom-left-radius'] : $toggleBorderRadiusBlTabletFallback ) : $toggleBorderRadiusBlTabletFallback;
$toggleBorderRadiusBrMobileFallback = isset( $toggleBorderMobile['border-bottom-right-radius'] ) ? ( ! empty( $toggleBorderMobile['border-bottom-right-radius'] ) ? $toggleBorderMobile['border-bottom-right-radius'] : $toggleBorderRadiusBrTabletFallback ) : $toggleBorderRadiusBrTabletFallback;

$btnBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn' );
$btnBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$btnBorder,
	( isset( $attr['submitborderWidth'] ) ? $attr['submitborderWidth'] : '' ),
	( isset( $attr['submitborderRadius'] ) ? $attr['submitborderRadius'] : '' ),
	( isset( $attr['submitborderColor'] ) ? $attr['submitborderColor'] : '' ),
	( isset( $attr['submitborderStyle'] ) ? $attr['submitborderStyle'] : '' )
);
$btnBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
$btnBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'mobile' );

// fallback for forms select field.
$formsPaddingRightMobileFallback = (int) $attr['paddingFieldRightMobile'] + 30;
$formsPaddingRightTabletFallback = (int) $attr['paddingFieldRightTablet'] + 30;

$selectors = [
	'.vxt-forms__outer-wrap'                              => [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingTop'], $attr['formPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingRight'], $attr['formPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingBottom'], $attr['formPaddingUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingLeft'], $attr['formPaddingUnit'] ),
	],
	' .vxt-forms-main-form textarea'                      => [
		'text-align' => $attr['overallAlignment'],
	],
	' .vxt-forms-input'                                   => [
		'text-align' => $attr['overallAlignment'],
	],
	' .vxt-forms-input-label'                             => [
		'display'    => $attr['displayLabels'] ? 'block' : 'none',
		'text-align' => null === $attr['labelAlignment'] ? $attr['overallAlignment'] : $attr['labelAlignment'],
	],
	' .vxt-forms-main-form .vxt-forms-field-set'         => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldGap'], $attr['fieldGapType'] ),
	],
	' .vxt-forms-main-form .vxt-forms-input-label'       => [
		'color'         => $attr['labelColor'],
		'font-size'     => \Vexaltrix\Support\Helper::getCssValue( $attr['labelFontSize'], $attr['labelFontSizeType'] ),
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['labelGap'], $attr['labelGapUnit'] ),
	],
	' .vxt-forms-success-message'                         => array_merge(
		[
			'background-color' => $attr['successMessageBGColor'],
			'color'            => $attr['successMessageTextColor'],
		],
		$successMessageBorder
	),
	' .vxt-forms-success-message:hover'                   => [
		'border-color' => $attr['successMsgBorderHColor'],
	],
	' .vxt-forms-failed-message'                          => array_merge(
		[
			'background-color' => $attr['failedMessageBGColor'],
			'color'            => $attr['failedMessageTextColor'],
		],
		$failedMessageBorder
	),
	' .vxt-forms-failed-message:hover'                    => [
		'border-color' => $attr['errorMsgBorderHColor'],
	],
	' .vxt-forms-main-form .vxt-forms-input:focus'       => [
		'outline'          => ' none !important',
		'border-color'     => ! empty( $attr['fieldBorderHColor'] ) ? $attr['fieldBorderHColor'] : $attr['inputborderHoverColor'],
		'background-color' => $attr['bgActiveColor'] . ' !important',
	],
	' .vxt-forms-main-form .vxt-forms-input:focus::placeholder' => [
		'color' => $attr['inputplaceholderActiveColor'] . ' !important',
	],
	// Hover Colors.
	' .vxt-forms-field-set:hover .vxt-forms-input-label' => [
		'color' => $attr['labelHoverColor'],
	],
	' .vxt-forms-field-set:hover .vxt-forms-input'       => [
		'background-color' => $attr['bgHoverColor'],
		'border-color'     => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['submitborderHoverColor'],
	],
	' .vxt-forms-field-set:hover .vxt-forms-input::placeholder' => [
		'color' => $attr['inputplaceholderHoverColor'],
	],
	' .vxt-slider.round'                                  => [
		// Important is added to override the usual border radius we set with a completely round one.
		'border-radius' => \Vexaltrix\Support\Helper::getCssValue( 20 + $attr['toggleWidthSize'], 'px' ) . ' !important',
	],
	// Drop icon position css.
	// select control color.
	' .vxt-form-phone-country'                            => [
		'background'          => 'url(data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgd2lkdGg9JzE4cHgnIGhlaWdodD0nMThweCcgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA1MTIgNTEyIj48cGF0aCBkPSJtMzk2LjYgMTYwIDE5LjQgMjAuN0wyNTYgMzUyIDk2IDE4MC43bDE5LjMtMjAuN0wyNTYgMzEwLjV6IiBmaWxsPSIjMWQyMzI3IiBjbGFzcz0iZmlsbC0wMDAwMDAiPjwvcGF0aD48L3N2Zz4=) no-repeat',
		'-moz-appearance'     => 'none !important',
		'-webkit-appearance'  => ' none !important',
		'background-position' => ' top 50% right ' . \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldRight'], $attr['paddingFieldUnit'] ),
		'appearance'          => 'none !important',
		'color'               => $attr['inputplaceholderColor'],
	],

	' .vxt-forms-field-set:hover .vxt-form-phone-country' => [
		'color' => $attr['inputplaceholderHoverColor'],
	],
];

if ( 'full' !== $attr['buttonAlign'] ) {
	$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap'] = [
		'text-align' => $attr['buttonAlign'],
	];
} else {
	$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap'] = [
		'display' => 'grid',
	];
}

$tSelectors = [
	'.vxt-forms__outer-wrap'                        => [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingTopTab'], $attr['formPaddingUnitTab'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingRightTab'], $attr['formPaddingUnitTab'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingBottomTab'], $attr['formPaddingUnitTab'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingLeftTab'], $attr['formPaddingUnitTab'] ),
	],
	' .vxt-forms-main-form .vxt-forms-field-set'   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldGapTablet'], $attr['fieldGapType'] ),
	],
	' .vxt-forms-main-form .vxt-forms-input-label' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['labelGapTablet'], $attr['labelGapUnit'] ),
	],
	' .vxt-slider.round'                            => [
		// Important is added to override the usual border radius we set with a completely round one.
		'border-radius' => \Vexaltrix\Support\Helper::getCssValue( 20 + $toggleWidthSizeNumberTablet, 'px' ) . ' !important',
	],
	' .vxt-forms-success-message'                   => $successMessageBorderTablet,
	' .vxt-forms-failed-message'                    => $failedMessageBorderTablet,
	// Drop icon position css.
	' .vxt-form-phone-country'                      => [
		'background-position' => 'top 50% right ' . \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldRightTablet'] ? $attr['paddingFieldRightTablet'] : 12, $attr['paddingFieldUnitTablet'] ),
		'padding-right'       => \Vexaltrix\Support\Helper::getCssValue( $formsPaddingRightTabletFallback, $attr['paddingFieldUnitTablet'] ),
	],
	' .vxt-forms-main-form textarea'                => [
		'text-align' => $attr['overallAlignmentTablet'],
	],
	' .vxt-forms-input'                             => [
		'text-align' => $attr['overallAlignmentTablet'],
	],
	' .vxt-forms-input-label'                       => [
		'text-align' => $attr['labelAlignmentTablet'],
	],
];

if ( 'full' !== $attr['buttonAlignTablet'] ) {
	$tSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap'] = [
		'text-align' => $attr['buttonAlignTablet'],
	];
} else {
	$tSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap'] = [
		'display' => 'grid',
	];
}

$mSelectors = [
	'.vxt-forms__outer-wrap'                        => [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingTopMob'], $attr['formPaddingUnitMob'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingRightMob'], $attr['formPaddingUnitMob'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingBottomMob'], $attr['formPaddingUnitMob'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['formPaddingLeftMob'], $attr['formPaddingUnitMob'] ),
	],
	' .vxt-forms-main-form .vxt-forms-field-set'   => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldGapMobile'], $attr['fieldGapType'] ),
	],
	' .vxt-forms-main-form .vxt-forms-input-label' => [
		'margin-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['labelGapMobile'], $attr['labelGapUnit'] ),
	],
	' .vxt-slider.round'                            => [
		// Important is added to override the usual border radius we set with a completely round one.
		'border-radius' => \Vexaltrix\Support\Helper::getCssValue( 20 + $toggleWidthSizeNumberMobile, 'px' ) . ' !important',
	],
	' .vxt-forms-success-message'                   => $successMessageBorderMobile,
	' .vxt-forms-failed-message'                    => $failedMessageBorderMobile,

	// Drop icon position css.
	' .vxt-form-phone-country'                      => [
		'background-position' => 'top 50% right ' . \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldRightMobile'] ? $attr['paddingFieldRightMobile'] : 6, $attr['paddingFieldUnitmobile'] ),
		'padding-right'       => \Vexaltrix\Support\Helper::getCssValue( $formsPaddingRightMobileFallback, $attr['paddingFieldUnitmobile'] ),
	],
	' .vxt-forms-main-form textarea'                => [
		'text-align' => $attr['overallAlignmentMobile'],
	],
	' .vxt-forms-input'                             => [
		'text-align' => $attr['overallAlignmentMobile'],
	],
	' .vxt-forms-input-label'                       => [
		'text-align' => $attr['labelAlignmentMobile'],
	],
];
if ( 'full' !== $attr['buttonAlignMobile'] ) {
	$mSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap'] = [
		'text-align' => $attr['buttonAlignMobile'],
	];
} else {
	$mSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap'] = [
		'display' => 'grid',
	];
}
// Checkbox Field css.
$selectors[' .vxt-forms-checkbox-wrap input[type=checkbox] + label:before'] = [
	'background-color' => $attr['toggleColor'],
	'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSize'], $attr['toggleSizeType'] ),
	'height'           => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSize'], $attr['toggleSizeType'] ),
];
$selectors[' .vxt-forms-checkbox-wrap > label']                             = [
	'color' => $attr['inputColor'],
];

// Radio Button Field css.
$selectors[' .vxt-forms-radio-wrap input[type=radio] + label:before'] = [
	'background-color' => $attr['toggleColor'],
	'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSize'], $attr['toggleSizeType'] ),
	'height'           => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSize'], $attr['toggleSizeType'] ),
];
$selectors[' .vxt-forms-radio-wrap > label']                          = [
	'color' => $attr['inputColor'],
];

// Toggle Field css.
$selectors[' .vxt-slider']                                     = [
	'background-color' => $attr['toggleColor'],
];
$selectors[' .vxt-forms-main-form .vxt-switch']               = [
	'height' => 'calc(' . $toggleBorder['border-top-width'] . ' + ' . $toggleBorder['border-bottom-width'] . ' + ' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( 20 + $attr['toggleWidthSize'] + ( ( 20 + $attr['toggleWidthSize'] ) / 3 ) ),
		'px'
	) . ')',
	'width'  => 'calc(' . $toggleBorder['border-left-width'] . ' + ' . $toggleBorder['border-right-width'] . ' + ' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( ( ( 20 + $attr['toggleWidthSize'] ) * 2.5 ) + ( ( 20 + $attr['toggleWidthSize'] ) / 3 ) ),
		'px'
	) . ')',
];
$selectors[' .vxt-forms-main-form .vxt-slider:before']        = [
	'height'           => \Vexaltrix\Support\Helper::getCssValue( 20 + $attr['toggleWidthSize'], 'px' ),
	'width'            => \Vexaltrix\Support\Helper::getCssValue( 20 + $attr['toggleWidthSize'], 'px' ),
	'top'              => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $attr['toggleWidthSize'] ) / 6 ), 'px' ),
	'bottom'           => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $attr['toggleWidthSize'] ) / 6 ), 'px' ),
	'left'             => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $attr['toggleWidthSize'] ) / 6 ), 'px' ),
	'background-color' => $attr['toggleDotColor'],
	'border-radius'    => $toggleBorder['border-top-left-radius'] . ' ' . $toggleBorder['border-top-right-radius'] . ' ' . $toggleBorder['border-bottom-right-radius'] . ' ' . $toggleBorder['border-bottom-left-radius'],
];
$selectors[' .vxt-switch input:checked + .vxt-slider']        = [
	'background-color' => $attr['toggleActiveColor'],
	'border-color'     => ! empty( $attr['checkBoxToggleBorderHColor'] ) ? $attr['checkBoxToggleBorderHColor'] : $attr['inputborderHoverColor'],
];
$selectors[' .vxt-switch input:checked + .vxt-slider:before'] = [
	'transform'        => 'translateX(' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( ( ( ( 20 + $attr['toggleWidthSize'] ) * 2.5 ) - ( 20 + $attr['toggleWidthSize'] ) ) ),
		'px'
	) . ')',
	'background-color' => $attr['toggleDotActiveColor'],
];
$selectors[' .vxt-switch input:focus + .vxt-slider']          = [
	'box-shadow' => '0 0 1px' . $attr['toggleActiveColor'],
];

// Accept Field css.
$selectors[' .vxt-forms-accept-wrap input[type=checkbox] + label:before'] = [
	'background-color' => $attr['toggleColor'],
	'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSize'], $attr['toggleSizeType'] ),
	'height'           => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSize'], $attr['toggleSizeType'] ),
];
$selectors[' .vxt-forms-accept-wrap > label']                             = [
	'color' => $attr['inputColor'],
];

if ( 'boxed' === $attr['formStyle'] ) {
	$selectors[' .vxt-forms-main-form  .vxt-forms-checkbox-wrap input[type=checkbox] + label:before'] = $toggleBorder;
	$selectors[' .vxt-forms-main-form .vxt-forms-checkbox-wrap > input']                              = [
		'color' => $attr['inputColor'],
	];
	$selectors[' .vxt-forms-main-form  .vxt-forms-radio-wrap input[type=radio] + label:before']       = $toggleBorder;
	$selectors[' .vxt-forms-main-form .vxt-forms-radio-wrap > input']                                 = [
		'color' => $attr['inputColor'],
	];
	$selectors[' .vxt-forms-main-form .vxt-slider'] = $toggleBorder;
	$selectors[' .vxt-forms-main-form  .vxt-forms-accept-wrap input[type=checkbox] + label:before'] = $toggleBorder;
	$selectors[' .vxt-forms-main-form .vxt-forms-accept-wrap > input']                              = [
		'color' => $attr['inputColor'],
	];
	$selectors[' .vxt-forms-main-form .vxt-forms-input']                         = array_merge(
		[
			'background-color' => $attr['bgColor'],
			'color'            => $attr['inputColor'],
		],
		$inputOverallBorder
	);
	$selectors[' .vxt-forms-main-form .vxt-forms-input.vxt-form-phone-country'] = [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( ( $paddingFieldTop - 1 ), $attr['paddingFieldUnit'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( ( $paddingFieldBottom - 1 ), $attr['paddingFieldUnit'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldLeft, $attr['paddingFieldUnit'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldRight, $attr['paddingFieldUnit'] ),
	];

	$selectors[' .vxt-forms-input:hover']        = [
		'border-color' => ! empty( $attr['fieldBorderHColor'] ) ? $attr['fieldBorderHColor'] : $attr['inputborderHoverColor'],
	];
	$selectors[' .vxt-forms-input::placeholder'] = [
		'color' => $attr['inputplaceholderColor'],
	];

	$tSelectors[' .vxt-forms-main-form  .vxt-forms-checkbox-wrap input[type=checkbox] + label:before'] = $toggleBorderTablet;
	$tSelectors[' .vxt-forms-main-form  .vxt-forms-radio-wrap input[type=radio] + label:before']       = $toggleBorderTablet;
	$tSelectors[' .vxt-forms-main-form .vxt-slider'] = $toggleBorderTablet;
	$tSelectors[' .vxt-forms-main-form  .vxt-forms-accept-wrap input[type=checkbox] + label:before'] = $toggleBorderTablet;
	$tSelectors[' .vxt-forms-main-form .vxt-forms-input'] = $inputOverallBorderTablet;

	$mSelectors[' .vxt-forms-main-form  .vxt-forms-checkbox-wrap input[type=checkbox] + label:before'] = $toggleBorderMobile;
	$mSelectors[' .vxt-forms-main-form  .vxt-forms-radio-wrap input[type=radio] + label:before']       = $toggleBorderMobile;
	$mSelectors[' .vxt-forms-main-form .vxt-slider'] = $toggleBorderMobile;
	$mSelectors[' .vxt-forms-main-form  .vxt-forms-accept-wrap input[type=checkbox] + label:before'] = $toggleBorderMobile;
	$mSelectors[' .vxt-forms-main-form .vxt-forms-input'] = $inputOverallBorderMobile;
}

$selectors[' .vxt-forms-main-form  .vxt-forms-input']   = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldTop, $attr['paddingFieldUnit'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldBottom, $attr['paddingFieldUnit'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldLeft, $attr['paddingFieldUnit'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldRight, $attr['paddingFieldUnit'] ),
];
$tSelectors[' .vxt-forms-main-form  .vxt-forms-input'] = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldTopTablet'], $attr['paddingFieldUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldBottomTablet'], $attr['paddingFieldUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldLeftTablet'], $attr['paddingFieldUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldRightTablet'], $attr['paddingFieldUnitTablet'] ),

];
$tSelectors[' .vxt-forms-main-form  .vxt-forms-input.vxt-form-phone-country'] = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldTopTablet'], $attr['paddingFieldUnitTablet'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldBottomTablet'], $attr['paddingFieldUnitTablet'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldLeftTablet'], $attr['paddingFieldUnitTablet'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldRightTablet'], $attr['paddingFieldUnitTablet'] ),

];
$tSelectors[' .vxt-switch input:checked + .vxt-slider:before']                 = [
	'transform' => 'translateX(' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( ( ( ( 20 + $toggleWidthSizeNumberTablet ) * 2.5 ) - ( 20 + $toggleWidthSizeNumberTablet ) ) ),
		'px'
	) . ')',
];
$mSelectors[' .vxt-forms-main-form  .vxt-forms-input.vxt-form-phone-country'] = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldTopMobile'], $attr['paddingFieldUnitmobile'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldBottomMobile'], $attr['paddingFieldUnitmobile'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldLeftMobile'], $attr['paddingFieldUnitmobile'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldRightMobile'], $attr['paddingFieldUnitmobile'] ),

];
$mSelectors[' .vxt-forms-main-form  .vxt-forms-input']         = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldTopMobile'], $attr['paddingFieldUnitmobile'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldBottomMobile'], $attr['paddingFieldUnitmobile'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldLeftMobile'], $attr['paddingFieldUnitmobile'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingFieldRightMobile'], $attr['paddingFieldUnitmobile'] ),
];
$mSelectors[' .vxt-switch input:checked + .vxt-slider:before'] = [
	'transform' => 'translateX(' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( ( ( ( 20 + $toggleWidthSizeNumberMobile ) * 2.5 ) - ( 20 + $toggleWidthSizeNumberMobile ) ) ),
		'px'
	) . ')',
];
if ( 'underlined' === $attr['formStyle'] ) {
	$selectors[' .vxt-forms-main-form  .vxt-forms-accept-wrap input[type=checkbox] + label:before']   = [
		'border-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['checkBoxToggleBorderBottomWidth'], 'px' ) . ' ' . $attr['checkBoxToggleBorderStyle'] . ' ' . $attr['checkBoxToggleBorderColor'],
	];
	$selectors[' .vxt-forms-main-form  .vxt-forms-checkbox-wrap input[type=checkbox] + label:before'] = [
		'border-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['checkBoxToggleBorderBottomWidth'], 'px' ) . ' ' . $attr['checkBoxToggleBorderStyle'] . ' ' . $attr['checkBoxToggleBorderColor'],
	];
	$selectors[' .vxt-forms-main-form .vxt-slider'] = [
		'border-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['checkBoxToggleBorderBottomWidth'], 'px' ) . ' ' . $attr['checkBoxToggleBorderStyle'] . ' ' . $attr['checkBoxToggleBorderColor'],
	];
	$selectors[' .vxt-forms-main-form  .vxt-forms-radio-wrap input[type=radio] + label:before'] = [
		'border-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['checkBoxToggleBorderBottomWidth'], 'px' ) . ' ' . $attr['checkBoxToggleBorderStyle'] . ' ' . $attr['checkBoxToggleBorderColor'],
	];
	$selectors[' .vxt-forms-main-form  .vxt-forms-input']                                       = array_merge(
		[
			'border-top'     => 0,
			'border-left'    => 0,
			'border-right'   => 0,
			'outline'        => 0,
			'border-radius'  => 0,
			'background'     => 'transparent',
			'border-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldBorderBottomWidth'], 'px' ) . ' ' . $attr['fieldBorderStyle'] . ' ' . $attr['fieldBorderColor'],
			'color'          => $attr['inputColor'],
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldTop, $attr['paddingFieldUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldBottom, $attr['paddingFieldUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldLeft, $attr['paddingFieldUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $paddingFieldRight, $attr['paddingFieldUnit'] ),
		],
		$inputOverallBorder
	);
	$selectors['.vxt-forms__outer-wrap .vxt-forms-main-form  .vxt-forms-input']                = [
		'border-top-width'    => 0,
		'border-right-width'  => 0,
		'border-left-width'   => 0,
		'border-bottom-width' => $inputUnderlineBorder,
	];
	$selectors[' .vxt-forms-input:hover']        = [
		'border-color' => ! empty( $attr['fieldBorderHColor'] ) ? $attr['fieldBorderHColor'] : $attr['inputborderHoverColor'],
	];
	$selectors[' .vxt-forms-input::placeholder'] = [
		'color' => $attr['inputplaceholderColor'],
	];
}

// Element Active CSS.
$selectors[' .vxt-forms-checkbox-wrap input[type=checkbox]:checked + label:before'] = [
	'color'            => $attr['toggleDotActiveColor'],
	'background-color' => $attr['toggleActiveColor'],
	'border-color'     => $attr['checkBoxToggleBorderHColor'],
	'font-size'        => 'calc(' . $attr['toggleSize'] . $attr['toggleSizeType'] . ' / 1.2)',
];
$selectors[' .vxt-forms-radio-wrap input[type=radio]:checked + label:before']       = [
	'background-color' => $attr['toggleDotActiveColor'],
	'border-color'     => $attr['checkBoxToggleBorderHColor'],
	'box-shadow'       => 'inset 0 0 0 4px ' . $attr['toggleActiveColor'],
	'font-size'        => 'calc(' . $attr['toggleSize'] . 'px / 1.2)',
];
$selectors[' .vxt-forms-accept-wrap input[type=checkbox]:checked + label:before']   = [
	'color'            => $attr['toggleDotActiveColor'],
	'background-color' => $attr['toggleActiveColor'],
	'border-color'     => $attr['checkBoxToggleBorderHColor'],
	'font-size'        => 'calc(' . $attr['toggleSize'] . $attr['toggleSizeType'] . ' / 1.2)',
];

// Checkbox Field css.
$tSelectors[' .vxt-forms-checkbox-wrap input[type=checkbox]:checked + label:before'] = [
	'font-size' => 'calc(' . $toggleSizeNumberTablet . $attr['toggleSizeType'] . ' / 1.2)',
];
$tSelectors[' .vxt-forms-checkbox-wrap input[type=checkbox] + label:before']         = [
	'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeTablet'], $attr['toggleSizeType'] ),
	'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeTablet'], $attr['toggleSizeType'] ),
];
// Radio Button Field css.
$tSelectors[' .vxt-forms-radio-wrap input[type=radio]:checked + label:before'] = [
	'font-size' => 'calc(' . $toggleSizeNumberTablet . 'px / 1.2)',
];
$tSelectors[' .vxt-forms-radio-wrap input[type=radio] + label:before']         = [
	'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeTablet'], $attr['toggleSizeType'] ),
	'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeTablet'], $attr['toggleSizeType'] ),
];
// Accept Field css.
$tSelectors[' .vxt-forms-accept-wrap input[type=checkbox]:checked + label:before'] = [
	'font-size' => 'calc(' . $toggleSizeNumberTablet . $attr['toggleSizeType'] . ' / 1.2)',
];
$tSelectors[' .vxt-forms-accept-wrap input[type=checkbox] + label:before']         = [
	'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeTablet'], $attr['toggleSizeType'] ),
	'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeTablet'], $attr['toggleSizeType'] ),
];
$tSelectors[' .vxt-forms-main-form .vxt-switch']                                  = [
	'height' => 'calc(' . $toggleBorderTopTabletFallback . ' + ' . $toggleBorderBottomTabletFallback . ' + ' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( 20 + $toggleWidthSizeNumberTablet + ( ( 20 + $toggleWidthSizeNumberTablet ) / 3 ) ),
		'px'
	) . ')',
	'width'  => 'calc(' . $toggleBorderLeftTabletFallback . ' + ' . $toggleBorderRightTabletFallback . ' + ' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( ( ( 20 + $toggleWidthSizeNumberTablet ) * 2.5 ) + ( ( 20 + $toggleWidthSizeNumberTablet ) / 3 ) ),
		'px'
	) . ')',
];
$tSelectors[' .vxt-forms-main-form .vxt-slider:before']                           = [
	'height'        => 'calc(20px + ' . $toggleWidthSizeNumberTablet . 'px)',
	'width'         => 'calc(20px + ' . $toggleWidthSizeNumberTablet . 'px)',
	'top'           => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $toggleWidthSizeNumberTablet ) / 6 ), 'px' ),
	'bottom'        => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $toggleWidthSizeNumberTablet ) / 6 ), 'px' ),
	'left'          => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $toggleWidthSizeNumberTablet ) / 6 ), 'px' ),
	'border-radius' => $toggleBorderRadiusTlTabletFallback . ' ' . $toggleBorderRadiusTrTabletFallback . ' ' . $toggleBorderRadiusBrTabletFallback . ' ' . $toggleBorderRadiusBlTabletFallback,
];

// Checkbox Field css.
$mSelectors[' .vxt-forms-checkbox-wrap input[type=checkbox]:checked + label:before'] = [
	'font-size' => 'calc(' . $toggleSizeNumberMobile . $attr['toggleSizeType'] . ' / 1.2)',
];
$mSelectors[' .vxt-forms-checkbox-wrap input[type=checkbox] + label:before']         = [
	'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeMobile'], $attr['toggleSizeType'] ),
	'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeMobile'], $attr['toggleSizeType'] ),
];
// Radio Button Field css.
$mSelectors[' .vxt-forms-radio-wrap input[type=radio]:checked + label:before'] = [
	'font-size' => 'calc(' . $toggleSizeNumberMobile . 'px / 1.2)',
];
$mSelectors[' .vxt-forms-radio-wrap input[type=radio] + label:before']         = [
	'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeMobile'], $attr['toggleSizeType'] ),
	'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeMobile'], $attr['toggleSizeType'] ),
];
// Accept Field css.
$mSelectors[' .vxt-forms-accept-wrap input[type=checkbox]:checked + label:before'] = [
	'font-size' => 'calc(' . $toggleSizeNumberMobile . $attr['toggleSizeType'] . ' / 1.2)',
];
$mSelectors[' .vxt-forms-accept-wrap input[type=checkbox] + label:before']         = [
	'width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeMobile'], $attr['toggleSizeType'] ),
	'height' => \Vexaltrix\Support\Helper::getCssValue( $attr['toggleSizeMobile'], $attr['toggleSizeType'] ),
];
$mSelectors[' .vxt-forms-main-form .vxt-switch']                                  = [
	'height' => 'calc(' . $toggleBorderTopMobileFallback . ' + ' . $toggleBorderBottomMobileFallback . ' + ' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( 20 + $toggleWidthSizeNumberMobile + ( ( 20 + $toggleWidthSizeNumberMobile ) / 3 ) ),
		'px'
	) . ')',
	'width'  => 'calc(' . $toggleBorderLeftMobileFallback . ' + ' . $toggleBorderRightMobileFallback . ' + ' . \Vexaltrix\Support\Helper::getCssValue(
		(int) ( ( ( 20 + $toggleWidthSizeNumberMobile ) * 2.5 ) + ( ( 20 + $toggleWidthSizeNumberMobile ) / 3 ) ),
		'px'
	) . ')',
];
$mSelectors[' .vxt-forms-main-form .vxt-slider:before']                           = [
	'height'        => 'calc(20px + ' . $toggleWidthSizeNumberMobile . 'px)',
	'width'         => 'calc(20px + ' . $toggleWidthSizeNumberMobile . 'px)',
	'top'           => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $toggleWidthSizeNumberMobile ) / 6 ), 'px' ),
	'bottom'        => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $toggleWidthSizeNumberMobile ) / 6 ), 'px' ),
	'left'          => \Vexaltrix\Support\Helper::getCssValue( (int) ( ( 20 + $toggleWidthSizeNumberMobile ) / 6 ), 'px' ),
	'border-radius' => $toggleBorderRadiusTlMobileFallback . ' ' . $toggleBorderRadiusTrMobileFallback . ' ' . $toggleBorderRadiusBrMobileFallback . ' ' . $toggleBorderRadiusBlMobileFallback,
];

if ( ! $attr['inheritFromTheme'] ) {
	$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link '] = array_merge(
		[
			'font-size'      => \Vexaltrix\Support\Helper::getCssValue( $attr['submitTextFontSize'], $attr['submitTextFontSizeType'] ),
			'color'          => $attr['submitColor'],
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTop, $attr['paddingBtnUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottom, $attr['paddingBtnUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeft, $attr['paddingBtnUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRight, $attr['paddingBtnUnit'] ),
		],
		$btnBorder
	);


	$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button '] = array_merge(
		[
			'font-size'      => \Vexaltrix\Support\Helper::getCssValue( $attr['submitTextFontSize'], $attr['submitTextFontSizeType'] ),
			'color'          => $attr['submitColor'],
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingTop, $attr['paddingBtnUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingBottom, $attr['paddingBtnUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingLeft, $attr['paddingBtnUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $btnPaddingRight, $attr['paddingBtnUnit'] ),
		],
		$btnBorder
	);

	$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link:hover '] = [
		'color'        => $attr['submitColorHover'],
		'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['submitborderHoverColor'],
	];

	$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button:hover'] = [
		'color'        => $attr['submitColorHover'],
		'border-color' => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['submitborderHoverColor'],
	];

	$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link:focus '] = [
		'color'            => $attr['submitColorHover'],
		'background-color' => ( 'color' === $attr['submitBgHoverType'] ) ? $attr['submitBgColorHover'] : 'transparent',
		'border-color'     => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['submitborderHoverColor'],
	];

	$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button:focus'] = [
		'color'            => $attr['submitColorHover'],
		'background-color' => ( 'color' === $attr['submitBgHoverType'] ) ? $attr['submitBgColorHover'] : 'transparent',
		'border-color'     => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['submitborderHoverColor'],
	];

	$selectors['.vxt-forms__full-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button']                  = [
		'width'   => '100%',
		'padding' => '10px 15px',
	];
	$selectors['.vxt-forms__small-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button']['padding']      = '5px 10px';
	$selectors['.vxt-forms__medium-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button']['padding']     = '12px 24px';
	$selectors['.vxt-forms__large-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button']['padding']      = '20px 30px';
	$selectors['.vxt-forms__extralarge-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button']['padding'] = '30px 65px';

	if ( 'transparent' === $attr['submitBgType'] ) {

		$selectors['  .vxt-forms-main-form .wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link']['background'] = 'transparent';
	
	} elseif ( 'color' === $attr['submitBgType'] ) {
	
		$selectors[' .vxt-forms-main-form .wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link']['background'] = $attr['submitBgColor'];
	
	} elseif ( 'gradient' === $attr['submitBgType'] ) {
		$bgObj        = [
			'backgroundType'    => 'gradient',
			'gradientValue'     => $attr['gradientValue'],
			'gradientColor1'    => $attr['gradientColor1'],
			'gradientColor2'    => $attr['gradientColor2'],
			'gradientType'      => $attr['gradientType'],
			'gradientLocation1' => $attr['gradientLocation1'],
			'gradientLocation2' => $attr['gradientLocation2'],
			'gradientAngle'     => $attr['gradientAngle'],
			'selectGradient'    => $attr['selectGradient'],
		];
		$bgObjTablet = [
			'backgroundType'    => 'gradient',
			'gradientValue'     => $attr['gradientValue'],
			'gradientColor1'    => $attr['gradientColor1'],
			'gradientColor2'    => $attr['gradientColor2'],
			'gradientType'      => $attr['gradientType'],
			'gradientLocation1' => is_numeric( $attr['gradientLocationTablet1'] ) ? $attr['gradientLocationTablet1'] : $bgObj['gradientLocation1'],
			'gradientLocation2' => is_numeric( $attr['gradientLocationTablet2'] ) ? $attr['gradientLocationTablet2'] : $bgObj['gradientLocation2'],
			'gradientAngle'     => is_numeric( $attr['gradientAngleTablet'] ) ? $attr['gradientAngleTablet'] : $bgObj['gradientAngle'], 
			'selectGradient'    => $attr['selectGradient'],
		];
		$bgObjMobile = [
			'backgroundType'    => 'gradient',
			'gradientValue'     => $attr['gradientValue'],
			'gradientColor1'    => $attr['gradientColor1'],
			'gradientColor2'    => $attr['gradientColor2'],
			'gradientType'      => $attr['gradientType'],
			'gradientLocation1' => is_numeric( $attr['gradientLocationMobile1'] ) ? $attr['gradientLocationMobile1'] : $bgObjTablet['gradientLocation1'],
			'gradientLocation2' => is_numeric( $attr['gradientLocationMobile2'] ) ? $attr['gradientLocationMobile2'] : $bgObjTablet['gradientLocation2'],
			'gradientAngle'     => is_numeric( $attr['gradientAngleMobile'] ) ? $attr['gradientAngleMobile'] : $bgObjTablet['gradientAngle'],
			'selectGradient'    => $attr['selectGradient'],
		];
	
		$btnBgCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgObj );
		$btnBgCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjTablet );
		$btnBgCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgObjMobile );
		$selectors['  .vxt-forms-main-form .wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link']   = $btnBgCss;
		$tSelectors['  .vxt-forms-main-form .wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link'] = $btnBgCssTablet;
		$mSelectors['  .vxt-forms-main-form .wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link'] = $btnBgCssMobile;
	}

	// Hover.
	if ( 'transparent' === $attr['submitBgHoverType'] ) {
	
		$selectors['  .vxt-forms-main-form .wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link:hover'] = [
			'background' => 'transparent',
		];
	
	} elseif ( 'color' === $attr['submitBgHoverType'] ) {
	
		$selectors['  .vxt-forms-main-form .wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link:hover'] = [
			'background' => $attr['submitBgColorHover'],
		];
	
	} elseif ( 'gradient' === $attr['submitBgHoverType'] ) {
		$bgHoverObj = [
			'backgroundType'    => 'gradient',
			'gradientValue'     => $attr['gradientHValue'],
			'gradientColor1'    => $attr['gradientHColor1'],
			'gradientColor2'    => $attr['gradientHColor2'],
			'gradientType'      => $attr['gradientHType'],
			'gradientLocation1' => $attr['gradientHLocation1'],
			'gradientLocation2' => $attr['gradientHLocation2'],
			'gradientAngle'     => $attr['gradientHAngle'],
			'selectGradient'    => $attr['selectHGradient'],
		];

		$bgHoverObjTablet = [
			'backgroundType'    => 'gradient',
			'gradientValue'     => $attr['gradientHValue'],
			'gradientColor1'    => $attr['gradientHColor1'],
			'gradientColor2'    => $attr['gradientHColor2'],
			'gradientType'      => $attr['gradientHType'],
			'gradientLocation1' => $attr['gradientHLocationTablet1'] ? $attr['gradientHLocationTablet1'] : $bgHoverObj['gradientLocation1'],
			'gradientLocation2' => $attr['gradientHLocationTablet2'] ? $attr['gradientHLocationTablet2'] : $bgHoverObj['gradientLocation2'],
			'gradientAngle'     => $attr['gradientHAngleTablet'] ? $attr['gradientHAngleTablet'] : $bgHoverObj['gradientAngle'],
			'selectGradient'    => $attr['selectHGradient'],
		];

		$bgHoverObjMobile = [
			'backgroundType'    => 'gradient',
			'gradientValue'     => $attr['gradientHValue'],
			'gradientColor1'    => $attr['gradientHColor1'],
			'gradientColor2'    => $attr['gradientHColor2'],
			'gradientType'      => $attr['gradientHType'],
			'gradientLocation1' => $attr['gradientHLocationMobile1'] ? $attr['gradientHLocationMobile1'] : $bgHoverObjTablet['gradientLocation1'],
			'gradientLocation2' => $attr['gradientHLocationMobile2'] ? $attr['gradientHLocationMobile2'] : $bgHoverObjTablet['gradientLocation2'],
			'gradientAngle'     => $attr['gradientHAngleMobile'] ? $attr['gradientHAngleMobile'] : $bgHoverObjTablet['gradientAngle'],
			'selectGradient'    => $attr['selectHGradient'],
		];

		$btnHoverBgCss        = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgHoverObj );
		$btnHoverBgCssTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgHoverObjTablet );
		$btnHoverBgCssMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGetBackgroundObj( $bgHoverObjMobile );

		$selectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button.wp-block-button__link:hover']   = $btnHoverBgCss;
		$tSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button.wp-block-button__link:hover'] = $btnHoverBgCssTablet;
		$mSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button.wp-block-button__link:hover'] = $btnHoverBgCssMobile;
	}

	$tSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button'] = array_merge(
		[
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnTopTablet'], $attr['tabletPaddingBtnUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnBottomTablet'], $attr['tabletPaddingBtnUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnLeftTablet'], $attr['tabletPaddingBtnUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnRightTablet'], $attr['tabletPaddingBtnUnit'] ),
		],
		$btnBorderTablet
	);

	$tSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link '] = $btnBorderTablet;


	$mSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button'] = array_merge(
		[
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnTopMobile'], $attr['mobilePaddingBtnUnit'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnBottomMobile'], $attr['mobilePaddingBtnUnit'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnLeftMobile'], $attr['mobilePaddingBtnUnit'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['paddingBtnRightMobile'], $attr['mobilePaddingBtnUnit'] ),
		],
		$btnBorderMobile
	);

	$mSelectors[' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link '] = $btnBorderMobile;
};

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

if ( ! $attr['inheritFromTheme'] ) {
	$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'submitText', ' .vxt-forms-main-form .vxt-forms-main-submit-button', $combinedSelectors );
}

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'label', ' .vxt-forms-main-form .vxt-forms-input-label', $combinedSelectors );

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'input', ' .vxt-forms-main-form  .vxt-forms-input::placeholder', $combinedSelectors );

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'input', ' .vxt-forms-main-form  .vxt-forms-input', $combinedSelectors );

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
