<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Core\Blocks\BlockJs::blocksCf7StylerGfont( $attr );

$messageTopPaddingDekstop    = isset( $attr['messageTopPaddingDesktop'] ) ? $attr['messageTopPaddingDesktop'] : $attr['msgVrPadding'];
$messageBottomPaddingDekstop = isset( $attr['messageBottomPaddingDesktop'] ) ? $attr['messageBottomPaddingDesktop'] : $attr['msgVrPadding'];
$messageLeftPaddingDekstop   = isset( $attr['messageLeftPaddingDesktop'] ) ? $attr['messageLeftPaddingDesktop'] : $attr['msgHrPadding'];
$messageRightPaddingDekstop  = isset( $attr['messageRightPaddingDesktop'] ) ? $attr['messageRightPaddingDesktop'] : $attr['msgHrPadding'];

$buttonTopPaddingDekstop    = isset( $attr['buttonTopPaddingDesktop'] ) ? $attr['buttonTopPaddingDesktop'] : $attr['buttonVrPadding'];
$buttonBottomPaddingDekstop = isset( $attr['buttonBottomPaddingDesktop'] ) ? $attr['buttonBottomPaddingDesktop'] : $attr['buttonVrPadding'];
$buttonLeftPaddingDekstop   = isset( $attr['buttonLeftPaddingDesktop'] ) ? $attr['buttonLeftPaddingDesktop'] : $attr['buttonHrPadding'];
$buttonRightPaddingDekstop  = isset( $attr['buttonRightPaddingDesktop'] ) ? $attr['buttonRightPaddingDesktop'] : $attr['buttonHrPadding'];

$fieldTopPaddingDekstop = isset( $attr['fieldTopPaddingDesktop'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['fieldTopPaddingDesktop'], $attr['fieldPaddingTypeDesktop'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['fieldVrPadding'], $attr['fieldPaddingTypeDesktop'] );

$fieldBottomPaddingDekstop = isset( $attr['fieldBottomPaddingDesktop'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['fieldBottomPaddingDesktop'], $attr['fieldPaddingTypeDesktop'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['fieldVrPadding'], $attr['fieldPaddingTypeDesktop'] );

$fieldLeftPaddingDekstop = isset( $attr['fieldLeftPaddingDesktop'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['fieldLeftPaddingDesktop'], $attr['fieldPaddingTypeDesktop'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['fieldHrPadding'], $attr['fieldPaddingTypeDesktop'] );

$fieldRightPaddingDekstop = isset( $attr['fieldRightPaddingDesktop'] ) ? \Vexaltrix\Support\Helper::getCssValue( $attr['fieldRightPaddingDesktop'], $attr['fieldPaddingTypeDesktop'] ) : \Vexaltrix\Support\Helper::getCssValue( $attr['fieldHrPadding'], $attr['fieldPaddingTypeDesktop'] );

$fieldVrPadding = isset( $attr['fieldTopPaddingDesktop'] ) ? $attr['fieldTopPaddingDesktop'] : $attr['fieldVrPadding'];

$border        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'input' );
$border        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$border,
	( isset( $attr['fieldBorderWidth'] ) ? $attr['fieldBorderWidth'] : '' ),
	( isset( $attr['fieldBorderRadius'] ) ? $attr['fieldBorderRadius'] : '' ),
	( isset( $attr['fieldBorderColor'] ) ? $attr['fieldBorderColor'] : '' ),
	( isset( $attr['fieldBorderStyle'] ) ? $attr['fieldBorderStyle'] : '' )
);
$borderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'input', 'tablet' );
$borderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'input', 'mobile' );

$btnBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn' );
$btnBorder        = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateDeprecatedBorderCss(
	$btnBorder,
	( isset( $attr['buttonBorderWidth'] ) ? $attr['buttonBorderWidth'] : '' ),
	( isset( $attr['buttonBorderRadius'] ) ? $attr['buttonBorderRadius'] : '' ),
	( isset( $attr['buttonBorderColor'] ) ? $attr['buttonBorderColor'] : '' ),
	( isset( $attr['buttonBorderStyle'] ) ? $attr['buttonBorderStyle'] : '' )
);
$btnBorderTablet = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'tablet' );
$btnBorderMobile = \Vexaltrix\Core\Blocks\BlockHelper::uagGenerateBorderCss( $attr, 'btn', 'mobile' );

$selectors = [
	' .wpcf7 .wpcf7-form'                                 => [
		'text-align' => $attr['align'],
	],
	' .wpcf7 form.wpcf7-form:not(input)'                  => [
		'color' => $attr['fieldLabelColor'],
	],
	' .wpcf7 input:not([type=submit])'                    => array_merge(
		[
			'background-color' => $attr['fieldBgColor'],
			'color'            => $attr['fieldInputColor'],
			'padding-left'     => $fieldLeftPaddingDekstop,
			'padding-right'    => $fieldRightPaddingDekstop,
			'padding-top'      => $fieldTopPaddingDekstop,
			'padding-bottom'   => $fieldBottomPaddingDekstop,
			'margin-top'       => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldLabelSpacing'], 'px' ),
			'margin-bottom'    => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldSpacing'], 'px' ),
			'text-align'       => $attr['align'],
		],
		$border
	),
	' .wpcf7 select'                                      => array_merge(
		[
			'background-color' => $attr['fieldBgColor'],
			'color'            => $attr['fieldLabelColor'],
			'margin-top'       => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldLabelSpacing'], 'px' ),
			'margin-bottom'    => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldSpacing'], 'px' ),
			'text-align'       => $attr['align'],
		],
		$border
	),
	' .wpcf7 select.wpcf7-form-control.wpcf7-select:not([multiple="multiple"])' => [
		'padding-left'   => $fieldLeftPaddingDekstop,
		'padding-right'  => $fieldRightPaddingDekstop,
		'padding-top'    => $fieldTopPaddingDekstop,
		'padding-bottom' => $fieldBottomPaddingDekstop,
	],
	' .wpcf7 select.wpcf7-select[multiple="multiple"] option' => [
		'padding-left'   => $fieldLeftPaddingDekstop,
		'padding-right'  => $fieldRightPaddingDekstop,
		'padding-top'    => $fieldTopPaddingDekstop,
		'padding-bottom' => $fieldBottomPaddingDekstop,
	],
	' .wpcf7 textarea'                                    => array_merge(
		[
			'background-color' => $attr['fieldBgColor'],
			'color'            => $attr['fieldInputColor'],
			'padding-left'     => $fieldLeftPaddingDekstop,
			'padding-right'    => $fieldRightPaddingDekstop,
			'padding-top'      => $fieldTopPaddingDekstop,
			'padding-bottom'   => $fieldBottomPaddingDekstop,
			'margin-top'       => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldLabelSpacing'], 'px' ),
			'margin-bottom'    => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldSpacing'], 'px' ),
			'text-align'       => $attr['align'],
		],
		$border
	),
	' .wpcf7 textarea::placeholder'                       => [
		'color'      => $attr['fieldInputColor'],
		'text-align' => $attr['align'],
	],
	' .wpcf7 input::placeholder'                          => [
		'color'      => $attr['fieldInputColor'],
		'text-align' => $attr['align'],
	],

	// Focus.
	' .wpcf7 form input:not([type=submit]):focus'         => [
		'border-color' => ! empty( $attr['inputBorderHColor'] ) ? $attr['inputBorderHColor'] : $attr['fieldBorderFocusColor'],
	],
	' .wpcf7 form select:focus'                           => [
		'border-color' => ! empty( $attr['inputBorderHColor'] ) ? $attr['inputBorderHColor'] : $attr['fieldBorderFocusColor'],
	],
	' .wpcf7 textarea:focus'                              => [
		'border-color' => ! empty( $attr['inputBorderHColor'] ) ? $attr['inputBorderHColor'] : $attr['fieldBorderFocusColor'],
	],

	// Submit button.
	' .wpcf7 input.wpcf7-form-control.wpcf7-submit'       => array_merge(
		[
			'color'            => $attr['buttonTextColor'],
			'background-color' => $attr['buttonBgColor'],
			'padding-left'     => \Vexaltrix\Support\Helper::getCssValue( $buttonLeftPaddingDekstop, $attr['buttonPaddingTypeDesktop'] ),
			'padding-right'    => \Vexaltrix\Support\Helper::getCssValue( $buttonRightPaddingDekstop, $attr['buttonPaddingTypeDesktop'] ),
			'padding-top'      => \Vexaltrix\Support\Helper::getCssValue( $buttonTopPaddingDekstop, $attr['buttonPaddingTypeDesktop'] ),
			'padding-bottom'   => \Vexaltrix\Support\Helper::getCssValue( $buttonBottomPaddingDekstop, $attr['buttonPaddingTypeDesktop'] ),
		],
		$btnBorder
	),
	' .wpcf7 input.wpcf7-form-control.wpcf7-submit:hover' => [
		'color'            => $attr['buttonTextHoverColor'],
		'background-color' => $attr['buttonBgHoverColor'],
		'border-color'     => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['buttonBorderHoverColor'],
	],
	' .wpcf7 input.wpcf7-form-control.wpcf7-submit:focus' => [
		'color'            => $attr['buttonTextHoverColor'],
		'background-color' => $attr['buttonBgHoverColor'],
		'border-color'     => ! empty( $attr['btnBorderHColor'] ) ? $attr['btnBorderHColor'] : $attr['buttonBorderHoverColor'],
	],

	// Check box Radio.
	' .wpcf7 .wpcf7-checkbox input[type="checkbox"]:checked + span:before' => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'font-size'        => 'calc( ' . $fieldVrPadding . 'px / 1.2 )',
		'border-color'     => $attr['inputBorderHColor'],
	],
	' .wpcf7 .wpcf7-checkbox input[type="checkbox"] + span:before' => array_merge(
		[
			'background-color' => $attr['fieldBgColor'],
			'color'            => $attr['fieldInputColor'],
			'height'           => $fieldTopPaddingDekstop,
			'width'            => $fieldTopPaddingDekstop,
			'font-size'        => 'calc( ' . $fieldVrPadding . 'px / 1.2 )',
		],
		$border
	),
	' .wpcf7 .wpcf7-acceptance input[type="checkbox"]:checked + span:before' => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'font-size'        => 'calc( ' . $fieldVrPadding . 'px / 1.2 )',
		'border-color'     => $attr['inputBorderHColor'],
	],
	' .wpcf7 .wpcf7-acceptance input[type="checkbox"] + span:before' => array_merge(
		[
			'background-color' => $attr['fieldBgColor'],
			'color'            => $attr['fieldInputColor'],
			'height'           => $fieldTopPaddingDekstop,
			'width'            => $fieldTopPaddingDekstop,
			'font-size'        => 'calc( ' . $fieldVrPadding . 'px / 1.2 )',
		],
		$border
	),
	' .wpcf7 .wpcf7-radio input[type="radio"] + span:before' => [
		'background-color'    => $attr['fieldBgColor'],
		'color'               => $attr['fieldInputColor'],
		'height'              => $fieldTopPaddingDekstop,
		'width'               => $fieldTopPaddingDekstop,
		'border-style'        => $attr['inputBorderStyle'],
		'border-color'        => $attr['inputBorderColor'],
		'border-top-width'    => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopWidth'], 'px' ),
		'border-left-width'   => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderLeftWidth'], 'px' ),
		'border-right-width'  => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderRightWidth'], 'px' ),
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidth'], 'px' ),
	],
	' .wpcf7 .wpcf7-radio input[type="radio"]:checked + span:before' => [
		'border-color' => $attr['inputBorderHColor'],
	],

	// Underline border.
	' .vxt-cf7-styler__field-style-underline .wpcf7 input:not([type=submit])' => [
		'border-style'               => 'none',
		'border-bottom-color'        => $attr['inputBorderColor'],
		'border-bottom-style'        => $attr['inputBorderStyle'],
		'border-bottom-width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidth'], 'px' ),
		'border-top-left-radius'     => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopLeftRadius'], 'px' ),
		'border-top-right-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopRightRadius'], 'px' ),
		'border-bottom-right-radius' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomRightRadius'], 'px' ),
		'border-bottom-left-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomLeftRadius'], 'px' ),
	],
	' .vxt-cf7-styler__field-style-underline textarea'   => [
		'border-style'               => 'none',
		'border-bottom-color'        => $attr['inputBorderColor'],
		'border-bottom-style'        => $attr['inputBorderStyle'],
		'border-bottom-width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidth'], 'px' ),
		'border-top-left-radius'     => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopLeftRadius'], 'px' ),
		'border-top-right-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopRightRadius'], 'px' ),
		'border-bottom-right-radius' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomRightRadius'], 'px' ),
		'border-bottom-left-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomLeftRadius'], 'px' ),
	],
	' .vxt-cf7-styler__field-style-underline select'     => [
		'border-style'               => 'none',
		'border-bottom-color'        => $attr['inputBorderColor'],
		'border-bottom-style'        => $attr['inputBorderStyle'],
		'border-bottom-width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidth'], 'px' ),
		'border-top-left-radius'     => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopLeftRadius'], 'px' ),
		'border-top-right-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopRightRadius'], 'px' ),
		'border-bottom-right-radius' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomRightRadius'], 'px' ),
		'border-bottom-left-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomLeftRadius'], 'px' ),
	],
	' .vxt-cf7-styler__field-style-underline .wpcf7-checkbox input[type="checkbox"] + span:before' => [
		'border-style' => $attr['inputBorderStyle'],
	],
	' .vxt-cf7-styler__field-style-underline .wpcf7 input[type="radio"] + span:before' => [
		'border-style' => $attr['inputBorderStyle'],
	],
	' .vxt-cf7-styler__field-style-underline .wpcf7-acceptance input[type="checkbox"] + span:before' => [
		'border-style' => $attr['inputBorderStyle'],
	],
	' .vxt-cf7-styler__field-style-box .wpcf7-checkbox input[type="checkbox"]:checked + span:before' => array_merge(
		[
			'font-size' => 'calc( ' . $fieldVrPadding . 'px / 1.2 )',
		],
		$border
	),
	' .vxt-cf7-styler__field-style-box .wpcf7-acceptance input[type="checkbox"]:checked + span:before' => array_merge(
		[
			'font-size' => 'calc( ' . $fieldVrPadding . 'px / 1.2 )',
		],
		$border
	),
	' .wpcf7-radio input[type="radio"]:checked + span:before' => [
		'background-color' => $attr['fieldInputColor'],
	],

	// Override check box.
	' .vxt-cf7-styler__check-style-enabled .wpcf7 .wpcf7-checkbox input[type="checkbox"] + span:before' => [
		'background-color' => $attr['radioCheckBgColor'],
		'color'            => $attr['radioCheckSelectColor'],
		'height'           => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSize'], 'px' ),
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSize'], 'px' ),
		'font-size'        => 'calc( ' . $attr['radioCheckSize'] . 'px / 1.2 )',
		'border-color'     => $attr['radioCheckBorderColor'],
		'border-width'     => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidth'], 'px' ),
		'border-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderRadius'], $attr['radioCheckBorderRadiusType'] ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 .wpcf7-checkbox input[type="checkbox"]:checked + span:before' => [
		'border-color' => $attr['inputBorderHColor'],
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 .wpcf7-acceptance input[type="checkbox"] + span:before' => [
		'background-color' => $attr['radioCheckBgColor'],
		'color'            => $attr['radioCheckSelectColor'],
		'height'           => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSize'], 'px' ),
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSize'], 'px' ),
		'font-size'        => 'calc( ' . $attr['radioCheckSize'] . 'px / 1.2 )',
		'border-color'     => $attr['radioCheckBorderColor'],
		'border-width'     => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidth'], 'px' ),
		'border-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderRadius'], $attr['radioCheckBorderRadiusType'] ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 .wpcf7-acceptance input[type="checkbox"]:checked + span:before' => [
		'border-color' => $attr['inputBorderHColor'],
	],

	' .vxt-cf7-styler__check-style-enabled .wpcf7 input[type="radio"] + span:before' => [
		'background-color' => $attr['radioCheckBgColor'],
		'color'            => $attr['radioCheckSelectColor'],
		'height'           => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSize'], 'px' ),
		'width'            => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSize'], 'px' ),
		'font-size'        => 'calc( ' . $attr['radioCheckSize'] . 'px / 1.2 )',
		'border-color'     => $attr['radioCheckBorderColor'],
		'border-width'     => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidth'], 'px' ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7-radio input[type="radio"]:checked + span:before' => [
		'background-color' => $attr['radioCheckSelectColor'],
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 form .wpcf7-list-item-label' => [
		'color' => $attr['radioCheckLableColor'],
	],
	' span.wpcf7-not-valid-tip'                           => [
		'color' => $attr['validationMsgColor'],
	],
	' .vxt-cf7-styler__highlight-border input.wpcf7-form-control.wpcf7-not-valid' => [
		'border-color' => $attr['highlightBorderColor'],
	],
	' .vxt-cf7-styler__highlight-border .wpcf7-form-control.wpcf7-not-valid .wpcf7-list-item-label:before' => [
		'border-color' => $attr['highlightBorderColor'] . '!important',
	],
	' .vxt-cf7-styler__highlight-style-bottom_right .wpcf7-form-control-wrap .wpcf7-not-valid-tip' => [
		'background-color' => $attr['validationMsgBgColor'],
	],
	' .wpcf7 form .wpcf7-response-output'                 => [
		'border-width'   => \Vexaltrix\Support\Helper::getCssValue( $attr['msgBorderSize'], $attr['msgBorderSizeUnit'] ),
		'border-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['msgBorderRadius'], $attr['msgBorderRadiusType'] ),
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $messageTopPaddingDekstop, $attr['messagePaddingTypeDesktop'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $messageBottomPaddingDekstop, $attr['messagePaddingTypeDesktop'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $messageLeftPaddingDekstop, $attr['messagePaddingTypeDesktop'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $messageRightPaddingDekstop, $attr['messagePaddingTypeDesktop'] ),
	],
	' .wpcf7 form.failed .wpcf7-response-output'          => [
		'background-color' => $attr['errorMsgBgColor'],
		'border-color'     => $attr['errorMsgBorderColor'],
		'color'            => $attr['errorMsgColor'],
	],
	' .wpcf7 form.invalid .wpcf7-response-output, .wpcf7 form.unaccepted .wpcf7-response-output' => [
		'background-color' => $attr['errorMsgBgColor'],
		'border-color'     => $attr['errorMsgBorderColor'],
		'color'            => $attr['errorMsgColor'],
	],
	' .wpcf7 form.sent .wpcf7-response-output'            => [
		'background-color' => $attr['successMsgBgColor'],
		'border-color'     => $attr['successMsgBorderColor'],
		'color'            => $attr['successMsgColor'],
	],

];

$fieldPaddingTablet = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldTopPaddingTablet'], $attr['fieldPaddingTypeTablet'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldBottomPaddingTablet'], $attr['fieldPaddingTypeTablet'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldLeftPaddingTablet'], $attr['fieldPaddingTypeTablet'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldRightPaddingTablet'], $attr['fieldPaddingTypeTablet'] ),
	'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldLabelSpacingTablet'], 'px' ),
	'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldSpacingTablet'], 'px' ),
];

$tSelectors = [
	' .wpcf7 input:not([type=submit])'                  => array_merge(
		$borderTablet,
		$fieldPaddingTablet
	),
	' .wpcf7 select'                                    => array_merge(
		$borderTablet,
		$fieldPaddingTablet
	),
	' .wpcf7 .wpcf7-checkbox input[type="checkbox"] + span:before' => array_merge(
		$borderTablet,
		$fieldPaddingTablet
	),
	' .wpcf7 .wpcf7-acceptance input[type="checkbox"] + span:before' => array_merge(
		$borderTablet,
		$fieldPaddingTablet
	),
	' .vxt-cf7-styler__field-style-box .wpcf7-checkbox input[type="checkbox"]:checked + span:before' => array_merge(
		$borderTablet,
		$fieldPaddingTablet
	),
	' .vxt-cf7-styler__field-style-box .wpcf7-acceptance input[type="checkbox"]:checked + span:before' => array_merge(
		$borderTablet,
		$fieldPaddingTablet
	),
	' .wpcf7 textarea'                                  => array_merge(
		$borderTablet,
		$fieldPaddingTablet
	),
	' .vxt-cf7-styler__check-style-enabled .wpcf7 .wpcf7-checkbox input[type="checkbox"] + span:before' => [
		'height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeTablet'], 'px' ),
		'width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeTablet'], 'px' ),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeTablet'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidthTablet'], 'px' ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 .wpcf7-acceptance input[type="checkbox"] + span:before' => [
		'height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeTablet'], 'px' ),
		'width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeTablet'], 'px' ),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeTablet'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidthTablet'], 'px' ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 input[type="radio"] + span:before' => [
		'height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeTablet'], 'px' ),
		'width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeTablet'], 'px' ),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeTablet'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidthTablet'], 'px' ),
	],
	' .wpcf7 form.wpcf7-form:not(input)'                => [
		'color' => $attr['fieldLabelColor'],
	],
	' .wpcf7-response-output'                           => [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['messageTopPaddingTablet'], $attr['messagePaddingTypeTablet'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['messageBottomPaddingTablet'], $attr['messagePaddingTypeTablet'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['messageLeftPaddingTablet'], $attr['messagePaddingTypeTablet'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['messageRightPaddingTablet'], $attr['messagePaddingTypeTablet'] ),
	],
	' .wpcf7 input.wpcf7-form-control.wpcf7-submit'     => array_merge(
		[
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonTopPaddingTablet'], $attr['buttonPaddingTypeTablet'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonBottomPaddingTablet'], $attr['buttonPaddingTypeTablet'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonLeftPaddingTablet'], $attr['buttonPaddingTypeTablet'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonRightPaddingTablet'], $attr['buttonPaddingTypeTablet'] ),
		],
		$btnBorderTablet
	),
	// underline border.
	' .vxt-cf7-styler__field-style-underline .wpcf7 input:not([type=submit])' => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthTablet'], 'px' ),
	],
	' .vxt-cf7-styler__field-style-underline select'   => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthTablet'], 'px' ),
	],
	" .vxt-cf7-styler__field-style-underline .wpcf7-checkbox input[type='checkbox'] + span:before" => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthTablet'], 'px' ),
	],
	" .vxt-cf7-styler__field-style-underline .wpcf7 input[type='radio'] + span:before" => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthTablet'], 'px' ),
	],
	" .vxt-cf7-styler__field-style-underline .wpcf7-acceptance input[type='checkbox'] + span:before" => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthTablet'], 'px' ),
	],
	' .vxt-cf7-styler__field-style-underline textarea' => [
		'border-style'               => 'none',
		'border-bottom-color'        => $attr['inputBorderColor'],
		'border-bottom-style'        => $attr['inputBorderStyle'],
		'border-bottom-width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthTablet'], 'px' ),
		'border-top-left-radius'     => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopLeftRadiusTablet'], 'px' ),
		'border-top-right-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopRightRadiusTablet'], 'px' ),
		'border-bottom-right-radius' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomRightRadiusTablet'], 'px' ),
		'border-bottom-left-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomLeftRadiusTablet'], 'px' ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 input:not([type=submit])' => $fieldPaddingTablet,
	' .vxt-cf7-styler__check-style-enabled .wpcf7 select.wpcf7-form-control.wpcf7-select:not([multiple="multiple"])' => $fieldPaddingTablet,
	' .vxt-cf7-styler__check-style-enabled .wpcf7 select.wpcf7-select[multiple="multiple"] option' => $fieldPaddingTablet,
	' .vxt-cf7-styler__check-style-enabled .wpcf7 textarea' => $fieldPaddingTablet,


];

$fieldPaddingMobile = [
	'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldTopPaddingMobile'], $attr['fieldPaddingTypeMobile'] ),
	'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldBottomPaddingMobile'], $attr['fieldPaddingTypeMobile'] ),
	'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldLeftPaddingMobile'], $attr['fieldPaddingTypeMobile'] ),
	'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldRightPaddingMobile'], $attr['fieldPaddingTypeMobile'] ),
	'margin-top'     => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldLabelSpacingMobile'], 'px' ),
	'margin-bottom'  => \Vexaltrix\Support\Helper::getCssValue( $attr['fieldSpacingMobile'], 'px' ),
];

$mSelectors = [
	' .wpcf7 input:not([type=submit])'                  => array_merge(
		$borderMobile,
		$fieldPaddingMobile
	),
	' .wpcf7 select'                                    => array_merge(
		$borderMobile,
		$fieldPaddingMobile
	),
	' .wpcf7 .wpcf7-checkbox input[type="checkbox"] + span:before' => array_merge(
		$borderMobile,
		$fieldPaddingMobile
	),
	' .wpcf7 .wpcf7-acceptance input[type="checkbox"] + span:before' => array_merge(
		$borderMobile,
		$fieldPaddingMobile
	),
	' .vxt-cf7-styler__field-style-box .wpcf7-checkbox input[type="checkbox"]:checked + span:before' => array_merge(
		$borderMobile,
		$fieldPaddingMobile
	),
	' .vxt-cf7-styler__field-style-box .wpcf7-acceptance input[type="checkbox"]:checked + span:before' => array_merge(
		$borderMobile,
		$fieldPaddingMobile
	),
	' .wpcf7 textarea'                                  => array_merge(
		$borderMobile,
		$fieldPaddingMobile
	),
	' .vxt-cf7-styler__check-style-enabled .wpcf7 .wpcf7-checkbox input[type="checkbox"] + span:before' => [
		'height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeMobile'], 'px' ),
		'width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeMobile'], 'px' ),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeMobile'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidthMobile'], 'px' ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 .wpcf7-acceptance input[type="checkbox"] + span:before' => [
		'height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeMobile'], 'px' ),
		'width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeMobile'], 'px' ),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeMobile'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidthMobile'], 'px' ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 input[type="radio"] + span:before' => [
		'height'       => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeMobile'], 'px' ),
		'width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckSizeMobile'], 'px' ),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeMobile'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['radioCheckBorderWidthMobile'], 'px' ),
	],
	' .wpcf7-response-output'                           => [
		'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['messageTopPaddingMobile'], $attr['messagePaddingTypeMobile'] ),
		'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['messageBottomPaddingMobile'], $attr['messagePaddingTypeMobile'] ),
		'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['messageLeftPaddingMobile'], $attr['messagePaddingTypeMobile'] ),
		'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['messageRightPaddingMobile'], $attr['messagePaddingTypeMobile'] ),
	],
	' .wpcf7 input.wpcf7-form-control.wpcf7-submit'     => array_merge(
		[
			'padding-top'    => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonTopPaddingMobile'], $attr['buttonPaddingTypeMobile'] ),
			'padding-bottom' => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonBottomPaddingMobile'], $attr['buttonPaddingTypeMobile'] ),
			'padding-left'   => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonLeftPaddingMobile'], $attr['buttonPaddingTypeMobile'] ),
			'padding-right'  => \Vexaltrix\Support\Helper::getCssValue( $attr['buttonRightPaddingMobile'], $attr['buttonPaddingTypeMobile'] ),
		],
		$btnBorderMobile
	),
	' .wpcf7 form.wpcf7-form:not(input)'                => [
		'color' => $attr['fieldLabelColor'],
	],
	// underline border.
	' .vxt-cf7-styler__field-style-underline .wpcf7 input:not([type=submit])' => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthMobile'], 'px' ),
	],
	' .vxt-cf7-styler__field-style-underline select'   => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthMobile'], 'px' ),
	],
	" .vxt-cf7-styler__field-style-underline .wpcf7-checkbox input[type='checkbox'] + span:before" => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthMobile'], 'px' ),
	],
	" .vxt-cf7-styler__field-style-underline .wpcf7 input[type='radio'] + span:before" => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthMobile'], 'px' ),
	],
	" .vxt-cf7-styler__field-style-underline .wpcf7-acceptance input[type='checkbox'] + span:before" => [
		'border-style'        => 'none',
		'border-bottom-style' => $attr['inputBorderStyle'],
		'border-bottom-width' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthMobile'], 'px' ),
	],
	' .vxt-cf7-styler__field-style-underline textarea' => [
		'border-style'               => 'none',
		'border-bottom-color'        => $attr['inputBorderColor'],
		'border-bottom-style'        => $attr['inputBorderStyle'],
		'border-bottom-width'        => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomWidthMobile'], 'px' ),
		'border-top-left-radius'     => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopLeftRadiusMobile'], 'px' ),
		'border-top-right-radius'    => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderTopRightRadiusMobile'], 'px' ),
		'border-bottom-right-radius' => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomRightRadiusMobile'], 'px' ),
		'border-bottom-left-radius'  => \Vexaltrix\Support\Helper::getCssValue( $attr['inputBorderBottomLeftRadiusMobile'], 'px' ),
	],
	' .vxt-cf7-styler__check-style-enabled .wpcf7 input:not([type=submit])' => $fieldPaddingMobile,
	' .wpcf7 select.wpcf7-form-control.wpcf7-select:not([multiple="multiple"])' => $fieldPaddingMobile,
	' .wpcf7 select.wpcf7-select[multiple="multiple"] option' => $fieldPaddingMobile,
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'radioCheck', ' .vxt-cf7-styler__check-style-enabled .wpcf7 form .wpcf7-list-item-label', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'validationMsg', ' span.wpcf7-not-valid-tip', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'msg', ' .wpcf7-response-output', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'button', ' .wpcf7 input.wpcf7-form-control.wpcf7-submit', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'label', ' .wpcf7 form .wpcf7-list-item-label', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'label', ' .wpcf7 form label', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'input', ' .wpcf7 select', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'input', ' .wpcf7 textarea', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Support\Helper::getTypographyCss( $attr, 'input', ' .wpcf7 input:not([type=submit])', $combinedSelectors );

return \Vexaltrix\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
