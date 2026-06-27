<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksGfStylerGfont( $attr );

$attr['msgVrPadding']   = ( '' === $attr['msgVrPadding'] ) ? '0' : $attr['msgVrPadding'];
$attr['msgHrPadding']   = ( '' === $attr['msgHrPadding'] ) ? '0' : $attr['msgHrPadding'];
$attr['textAreaHeight'] = ( 'auto' === $attr['msgHrPadding'] ) ?
$attr['textAreaHeight'] : $attr['textAreaHeight'] . 'px';
$buttonTopPadding     = isset( $attr['buttontopPadding'] ) ? $attr['buttontopPadding'] : $attr['buttonVrPadding'];
$buttonBottomPadding  = isset( $attr['buttonbottomPadding'] ) ? $attr['buttonbottomPadding'] : $attr['buttonVrPadding'];
$buttonLeftPadding    = isset( $attr['buttonleftPadding'] ) ? $attr['buttonleftPadding'] : $attr['buttonHrPadding'];
$buttonRightPadding   = isset( $attr['buttonrightPadding'] ) ? $attr['buttonrightPadding'] : $attr['buttonHrPadding'];

$msgTopPadding    = isset( $attr['msgtopPadding'] ) ? $attr['msgtopPadding'] : $attr['msgVrPadding'];
$msgBottomPadding = isset( $attr['msgbottomPadding'] ) ? $attr['msgbottomPadding'] : $attr['msgVrPadding'];
$msgLeftPadding   = isset( $attr['msgleftPadding'] ) ? $attr['msgleftPadding'] : $attr['msgHrPadding'];
$msgRightPadding  = isset( $attr['msgrightPadding'] ) ? $attr['msgrightPadding'] : $attr['msgHrPadding'];

$fieldTopPadding    = isset( $attr['fieldtopPadding'] ) ? $attr['fieldtopPadding'] : $attr['fieldVrPadding'];
$fieldBottomPadding = isset( $attr['fieldbottomPadding'] ) ? $attr['fieldbottomPadding'] : $attr['fieldVrPadding'];
$fieldLeftPadding   = isset( $attr['fieldleftPadding'] ) ? $attr['fieldleftPadding'] : $attr['fieldHrPadding'];
$fieldRightPadding  = isset( $attr['fieldrightPadding'] ) ? $attr['fieldrightPadding'] : $attr['fieldHrPadding'];

$selectors = [
	' .gform_wrapper form'                                 => [
		'text-align' => $attr['align'],
	],
	' .gform_wrapper .gfield_label'                        => [
		'color' => $attr['fieldLabelColor'],
	],
	' .wp-block-vxt-gf-styler form:not(input)'            => [
		'color' => $attr['fieldLabelColor'],
	],
	' .gform_heading'                                      => [
		'text-align' => $attr['titleDescAlignment'],
	],
	' .gform_wrapper input:not([type=submit])'             => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'border-style'     => $attr['fieldBorderStyle'],
		'border-color'     => $attr['fieldBorderColor'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldLeftPadding, $attr['fieldpaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldRightPadding, $attr['fieldpaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldTopPadding, $attr['fieldpaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldBottomPadding, $attr['fieldpaddingUnit'] ),
		'margin-top'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacing'],
			'px'
		),
		'margin-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacing'],
			'px'
		),
		'text-align'       => $attr['align'],
	],
	// Focus.
	' .gform_wrapper.gravity-theme input:not([type=submit]):focus' => [
		'border-color' => $attr['fieldBorderFocusColor'],
	],
	' .gform_wrapper.gravity-theme select:focus'           => [
		'border-color' => $attr['fieldBorderFocusColor'],
	],
	' .gform_wrapper.gravity-theme textarea:focus'         => [
		'border-color' => $attr['fieldBorderFocusColor'],
	],
	' input[type=button]'                                  => [
		'color'            => $attr['buttonTextColor'],
		'background-color' => $attr['buttonBgColor'],
		'border-color'     => $attr['buttonBorderColor'],
		'border-style'     => $attr['buttonBorderStyle'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['buttonBorderWidth'],
			'px'
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['buttonBorderRadius'],
			$attr['buttonBorderRadiusType']
		),
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $buttonLeftPadding, $attr['buttonpaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $buttonRightPadding, $attr['buttonpaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $buttonTopPadding, $attr['buttonpaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $buttonBottomPadding, $attr['buttonpaddingUnit'] ),
	],
	' input[type=button]:hover'                            => [
		'color'            => $attr['buttonTextHoverColor'],
		'background-color' => $attr['buttonBgHoverColor'],
		'border-color'     => $attr['buttonBorderHoverColor'],
	],
	' input[type=button]:focus'                            => [
		'color'            => $attr['buttonTextHoverColor'],
		'background-color' => $attr['buttonBgHoverColor'],
		'border-color'     => $attr['buttonBorderHoverColor'],
	],
	' .gform_wrapper select '                              => [
		'background-color' => $attr['fieldBgColor'],
		'border-style'     => $attr['fieldBorderStyle'],
		'border-color'     => $attr['fieldBorderColor'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
		'margin-top'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacing'],
			'px'
		),
		'margin-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacing'],
			'px'
		),
		'color'            => $attr['fieldInputColor'],
		'text-align'       => $attr['align'],
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldLeftPadding, $attr['fieldpaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldRightPadding, $attr['fieldpaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldTopPadding, $attr['fieldpaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldBottomPadding, $attr['fieldpaddingUnit'] ),
	],
	' .chosen-container-single span'                       => [
		'background-color' => $attr['fieldBgColor'],
		'border-style'     => $attr['fieldBorderStyle'],
		'border-color'     => $attr['fieldBorderColor'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
		'margin-top'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacing'],
			'px'
		),
		'margin-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacing'],
			'px'
		),
		'color'            => $attr['fieldInputColor'],
		'text-align'       => $attr['align'],
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldLeftPadding, $attr['fieldpaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldRightPadding, $attr['fieldpaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldTopPadding, $attr['fieldpaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldBottomPadding, $attr['fieldpaddingUnit'] ),
	],
	' .chosen-container-single.chosen-container-active .chosen-single span' => [
		'margin-bottom' => 0,
	],
	' select.wpgf-form-control.wpgf-select:not([multiple="multiple"])' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldLeftPadding, $attr['fieldpaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldRightPadding, $attr['fieldpaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldTopPadding, $attr['fieldpaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldBottomPadding, $attr['fieldpaddingUnit'] ),
	],
	' select.wpgf-select[multiple="multiple"] option'      => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldLeftPadding, $attr['fieldpaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldRightPadding, $attr['fieldpaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldTopPadding, $attr['fieldpaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldBottomPadding, $attr['fieldpaddingUnit'] ),
	],
	' .gform_wrapper .gfield textarea'                     => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'border-color'     => $attr['fieldBorderColor'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
		'border-style'     => $attr['fieldBorderStyle'],
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldLeftPadding, $attr['fieldpaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldRightPadding, $attr['fieldpaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldTopPadding, $attr['fieldpaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $fieldBottomPadding, $attr['fieldpaddingUnit'] ),
		'margin-top'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacing'],
			'px'
		),
		'margin-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacing'],
			'px'
		),
		'text-align'       => $attr['align'],
		'height'           => $attr['textAreaHeight'],
	],

	' .gform_wrapper.gravity-theme .gfield textarea.large:focus' => [
		'border-color' => $attr['fieldBorderFocusColor'],
	],
	' textarea::placeholder'                               => [
		'color'      => $attr['fieldInputColor'],
		'text-align' => $attr['align'],
	],
	' input::placeholder'                                  => [
		'color'      => $attr['fieldInputColor'],
		'text-align' => $attr['align'],
	],
	' .gform_wrapper.gravity-theme .gfield_label'          => [
		'color'           => $attr['fieldLabelColor'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelFontSize'], $attr['labelFontSizeType'] ),
		'font-family'     => $attr['labelFontFamily'],
		'text-transform'  => $attr['labelTransform'],
		'text-decoration' => $attr['labelDecoration'] . '!important',
		'font-style'      => $attr['labelFontStyle'],
		'font-weight'     => $attr['labelFontWeight'],
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelLineHeight'], $attr['labelLineHeightType'] ),
	],
	' form .gfield_radio label.gfield_label'               => [
		'color'           => $attr['fieldLabelColor'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelFontSize'], $attr['labelFontSizeType'] ),
		'font-family'     => $attr['labelFontFamily'],
		'text-transform'  => $attr['labelTransform'],
		'text-decoration' => $attr['labelDecoration'] . '!important',
		'font-style'      => $attr['labelFontStyle'],
		'font-weight'     => $attr['labelFontWeight'],
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelLineHeight'], $attr['labelLineHeightType'] ),
	],
	' form .gfield_checkbox label.gfield_label'            => [
		'color'           => $attr['fieldLabelColor'],
		'font-size'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelFontSize'], $attr['labelFontSizeType'] ),
		'font-family'     => $attr['labelFontFamily'],
		'text-transform'  => $attr['labelTransform'],
		'text-decoration' => $attr['labelDecoration'] . '!important',
		'font-style'      => $attr['labelFontStyle'],
		'font-weight'     => $attr['labelFontWeight'],
		'line-height'     => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['labelLineHeight'], $attr['labelLineHeightType'] ),
	],
	' .gform_wrapper.gravity-theme .gfield_checkbox '      => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacing'],
			'px'
		),
	],
	' .gform_wrapper.gravity-theme .gfield_radio '         => [
		'margin-top' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacing'],
			'px'
		),
	],

	// Submit button.
	' input.gform_button'                                  => [
		'color'            => $attr['buttonTextColor'],
		'background-color' => $attr['buttonBgColor'],
		'border-color'     => $attr['buttonBorderColor'],
		'border-style'     => $attr['buttonBorderStyle'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['buttonBorderWidth'],
			'px'
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['buttonBorderRadius'],
			$attr['buttonBorderRadiusType']
		),
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $buttonLeftPadding, $attr['buttonpaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $buttonRightPadding, $attr['buttonpaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $buttonTopPadding, $attr['buttonpaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $buttonBottomPadding, $attr['buttonpaddingUnit'] ),
	],

	' .gform_footer.top_label input[type="submit"]'        => [
		'font-size' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonFontSize'], $attr['buttonFontSizeType'] ),
	],

	' input.gform_button:hover'                            => [
		'color'            => $attr['buttonTextHoverColor'],
		'background-color' => $attr['buttonBgHoverColor'],
		'border-color'     => $attr['buttonBorderHoverColor'],
	],
	' input.gform_button:focus'                            => [
		'color'            => $attr['buttonTextHoverColor'],
		'background-color' => $attr['buttonBgHoverColor'],
		'border-color'     => $attr['buttonBorderHoverColor'],
	],

	// Check box Radio.
	' .gfield_checkbox input[type="checkbox"]:checked + label:before' => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'font-size'        => 'calc( ' . $attr['fieldVrPadding'] . 'px / 1.2 )',
		'border-color'     => $attr['fieldBorderFocusColor'],
	],
	' .gfield_checkbox input[type="checkbox"] + label:before' => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'height'           => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldVrPadding'], 'px' ),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldVrPadding'], 'px' ),
		'border-style'     => $attr['fieldBorderStyle'],
		'border-color'     => $attr['fieldBorderColor'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
		'font-size'        => 'calc( ' . $attr['fieldVrPadding'] . 'px / 1.2 )',
	],
	' input[type="checkbox"]:checked + label:before'       => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'font-size'        => 'calc( ' . $attr['fieldVrPadding'] . 'px / 1.2 )',
		'border-color'     => $attr['fieldBorderFocusColor'],
	],
	' input[type="checkbox"] + label:before'               => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'height'           => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldVrPadding'], 'px' ),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldVrPadding'], 'px' ),
		'font-size'        => 'calc( ' . $attr['fieldVrPadding'] . 'px / 1.2 )',
		'border-color'     => $attr['fieldBorderColor'],
		'border-style'     => $attr['fieldBorderStyle'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
	],
	' .wp-block-vxt-gf-styler .gform_wrapper .ginput_container_select select' => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
	],
	' .gfield_radio input[type="radio"] + label:before'    => [
		'background-color' => $attr['fieldBgColor'],
		'color'            => $attr['fieldInputColor'],
		'height'           => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldVrPadding'], 'px' ),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldVrPadding'], 'px' ),
		'border-style'     => $attr['fieldBorderStyle'],
		'border-color'     => $attr['fieldBorderColor'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
	],
	' .gfield_radio input[type="radio"]:checked + label:before' => [
		'border-color' => $attr['fieldBorderFocusColor'],
	],

	// Underline border.
	' .vxt-gf-styler__field-style-underline .gform_wrapper input:not([type=submit])' => [
		'border-style'        => 'none',
		'border-bottom-color' => $attr['fieldBorderColor'],
		'border-bottom-style' => 'solid',
		'border-bottom-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
	],
	' .vxt-gf-styler__field-style-underline .gform_wrapper .gfield textarea' => [
		'background-color'    => $attr['fieldBgColor'],
		'color'               => $attr['fieldInputColor'],
		'border-style'        => 'none',
		'border-bottom-color' => $attr['fieldBorderColor'],
		'border-bottom-style' => 'solid',
		'border-bottom-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
	],
	' .vxt-gf-styler__field-style-underline select'       => [
		'border-style'        => 'none',
		'border-bottom-color' => $attr['fieldBorderColor'],
		'border-bottom-style' => 'solid',
		'border-bottom-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
	],
	' .vxt-gf-styler__field-style-underline textarea'     => [
		'border-style'        => 'none',
		'border-bottom-color' => $attr['fieldBorderColor'],
		'border-bottom-style' => 'solid',
		'border-bottom-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidth'],
			$attr['fieldBorderWidthType']
		),
		'border-radius'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderRadius'],
			$attr['fieldBorderRadiusType']
		),
	],

	' .vxt-gf-styler__check-style-enabled .gfield_checkbox input[type="checkbox"] + label:before' => [
		'border-style' => 'solid',
	],
	' .vxt-gf-styler__check-style-enabled input[type="radio"] + label:before' => [
		'border-style' => 'solid',
	],
	' .vxt-gf-styler__field-style-box .gfield_checkbox input[type="checkbox"]:checked + label:before' => [
		'border-style'  => 'solid',
		'border-width'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidth'],
			'px'
		),
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderRadius'],
			$attr['radioCheckBorderRadiusType']
		),
		'font-size'     => 'calc( ' . $attr['radioCheckSize'] . 'px / 1.2 )',
	],
	' .vxt-gf-styler__field-style-box input[type="checkbox"]:checked + label:before' => [
		'border-style'  => 'solid',
		'border-width'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidth'],
			'px'
		),
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderRadius'],
			$attr['radioCheckBorderRadiusType']
		),
		'font-size'     => 'calc( ' . $attr['radioCheckSize'] . 'px / 1.2 )',
	],
	' .gfield_radio input[type="radio"]:checked + label:before' => [
		'background-color' => $attr['fieldInputColor'],
	],

	// Override check box.
	' .vxt-gf-styler__check-style-enabled .gfield_checkbox input[type="checkbox"] + label:before' => [
		'background-color' => $attr['radioCheckBgColor'],
		'color'            => $attr['radioCheckSelectColor'],
		'height'           => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSize'],
			'px'
		),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSize'],
			'px'
		),
		'font-size'        => 'calc( ' . $attr['radioCheckSize'] . 'px / 1.2 )',
		'border-color'     => $attr['radioCheckBorderColor'],
		'border-style'     => 'solid',
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidth'],
			'px'
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderRadius'],
			$attr['radioCheckBorderRadiusType']
		),
	],
	' .vxt-gf-styler__check-style-enabled .gfield_checkbox input[type="checkbox"]:checked + label:before' => [
		'border-color' => $attr['fieldBorderFocusColor'],
	],
	' .vxt-gf-styler__check-style-enabled input[type="checkbox"] + label:before' => [
		'background-color' => $attr['radioCheckBgColor'],
		'color'            => $attr['radioCheckSelectColor'],
		'height'           => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSize'],
			'px'
		),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSize'],
			'px'
		),
		'font-size'        => 'calc( ' . $attr['radioCheckSize'] . 'px / 1.2 )',
		'border-color'     => $attr['radioCheckBorderColor'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidth'],
			'px'
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderRadius'],
			$attr['radioCheckBorderRadiusType']
		),
	],
	' .vxt-gf-styler__check-style-enabled input[type="checkbox"]:checked + label:before' => [
		'border-color' => $attr['fieldBorderFocusColor'],
	],

	' .vxt-gf-styler__check-style-enabled input[type="radio"] + label:before' => [
		'background-color' => $attr['radioCheckBgColor'],
		'color'            => $attr['radioCheckSelectColor'],
		'height'           => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSize'],
			'px'
		),
		'width'            => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSize'],
			'px'
		),
		'font-size'        => 'calc( ' . $attr['radioCheckSize'] . 'px / 1.2 )',
		'border-color'     => $attr['radioCheckBorderColor'],
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidth'],
			'px'
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderRadius'],
			$attr['radioCheckBorderRadiusType']
		),
	],
	' .vxt-gf-styler__check-style-enabled .gfield_radio input[type="radio"]:checked + label:before' => [
		'background-color' => $attr['radioCheckSelectColor'],
		'border-color'     => $attr['fieldBorderFocusColor'],
	],
	' .vxt-gf-styler__check-style-enabled form .gfield_radio label' => [
		'color' => $attr['radioCheckLableColor'],
	],
	' .vxt-gf-styler__check-style-enabled form .gfield_checkbox label' => [
		'color' => $attr['radioCheckLableColor'],
	],
	// Validation Errors.
	' .gform_wrapper .gfield_description.validation_message' => [
		'color' => $attr['validationMsgColor'],
	],
	' .vxt-gf-styler__error-yes .gform_wrapper .gfield.gfield_error' => [
		'background-color' => $attr['validationMsgBgColor'],
	],

	' .vxt-gf-styler__error-yes .gform_wrapper .gfield_error .ginput_container input' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes .gform_wrapper .gfield_error .ginput_container select' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes .gform_wrapper .gfield_error .ginput_container .chosen-single' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes .gform_wrapper .gfield_error .ginput_container textarea' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes .gform_wrapper li.gfield.gfield_error' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes .gform_wrapper li.gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes li.gfield_error .gfield_checkbox input[type="checkbox"] + label:before' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes li.gfield_error .ginput_container_consent input[type="checkbox"] + label:before' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes li.gfield_error .gfield_radio input[type="radio"] + label:before' => [
		'border-color' => $attr['highlightBorderColor'],
	],

	' .vxt-gf-styler__error-yes .gform_wrapper li.gfield_error input[type="text"]' => [
		'border' => $attr['fieldBorderWidth'] . $attr['fieldBorderWidthType'] . ' ' . $attr['fieldBorderStyle'] . ' ' . $attr['fieldBorderColor'] . '!important',
	],

	' .uael-gf-style-underline.vxt-gf-styler__error-yes .gform_wrapper li.gfield_error input[type="text"]' => [
		'border-width' => $attr['fieldBorderWidth'] . $attr['fieldBorderWidthType'] . ' !important',
		'border-style' => 'solid !important',
		'border-color' => $attr['fieldBorderColor'] . '!important',
	],

	' .gform_wrapper.gravity-theme div.validation_message' => [
		'color'            => $attr['errorMsgColor'],
		'background-color' => $attr['errorMsgBgColor'],
		'border-color'     => $attr['errorMsgBorderColor'],
		'border-style'     => 'solid',
		'border-width'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['msgBorderSize'],
			'px'
		),
		'border-radius'    => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['msgBorderRadius'],
			$attr['msgBorderRadiusType']
		),
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $msgLeftPadding, $attr['msgpaddingUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $msgRightPadding, $attr['msgpaddingUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $msgTopPadding, $attr['msgpaddingUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $msgBottomPadding, $attr['msgpaddingUnit'] ),
	],

	' .gform_confirmation_message'                         => [
		'color' => $attr['successMsgColor'],
	],
];

$tSelectors = [
	' .vxt-gf-styler__field-style-box .gfield_checkbox input[type="checkbox"]:checked + label:before' => [
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidthTablet'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeTablet'] . 'px / 1.2 )',
	],
	' .vxt-gf-styler__field-style-box input[type="checkbox"]:checked + label:before' => [
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidthTablet'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeTablet'] . 'px / 1.2 )',
	],
	' .vxt-gf-styler__check-style-enabled .gfield_checkbox input[type="checkbox"] + label:before' => [
		'height'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeTablet'],
			'px'
		),
		'width'        => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeTablet'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeTablet'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidthTablet'],
			'px'
		),
	],
	' .vxt-gf-styler__check-style-enabled input[type="checkbox"] + label:before' => [
		'height'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeTablet'],
			'px'
		),
		'width'        => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeTablet'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeTablet'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidth'],
			'px'
		),
	],
	' .vxt-gf-styler__check-style-enabled input[type="radio"] + label:before' => [
		'height'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeTablet'],
			'px'
		),
		'width'        => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeTablet'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeTablet'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidthTablet'],
			'px'
		),
	],
	' form.wpgf-form:not(input)'                           => [
		'color' => $attr['fieldLabelColor'],
	],
	' .gform_wrapper.gravity-theme input:not([type=submit])' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldleftTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldrightTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldtopTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldbottomTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacingTablet'],
			'px'
		),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacingTablet'],
			'px'
		),
		'border-width'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidthTablet'],
			$attr['fieldBorderWidthType']
		),
	],
	' .gform_wrapper.gravity-theme .gfield textarea.large' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldleftTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldrightTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldtopTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldbottomTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacingTablet'],
			'px'
		),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacingTablet'],
			'px'
		),
		'height'         => 'auto' === $attr['textAreaHeightTablet'] ? $attr['textAreaHeightTablet'] : \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['textAreaHeightTablet'],
			'px'
		),
		'border-width'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidthTablet'],
			$attr['fieldBorderWidthType']
		),
	],
	' input.gform_button'                                  => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonleftTabletPadding'], $attr['buttontabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonrightTabletPadding'], $attr['buttontabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttontopTabletPadding'], $attr['buttontabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonbottomTabletPadding'], $attr['buttontabletPaddingUnit'] ),
		'border-width'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['buttonBorderWidthTablet'],
			'px'
		),
	],
	' .gform_wrapper.gravity-theme div.validation_message' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['msgleftTabletPadding'], $attr['msgtabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['msgrightTabletPadding'], $attr['msgtabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['msgtopTabletPadding'], $attr['msgtabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['msgbottomTabletPadding'], $attr['msgtabletPaddingUnit'] ),
	],
	' .gform_wrapper.gravity-theme select '                => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldleftTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldrightTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldtopTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldbottomTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacingTablet'],
			'px'
		),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacingTablet'],
			'px'
		),
		'border-width'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidthTablet'],
			$attr['fieldBorderWidthType']
		),
	],
];

$mSelectors = [
	' .vxt-gf-styler__field-style-box .gfield_checkbox input[type="checkbox"]:checked + label:before' => [
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidthMobile'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeMobile'] . 'px / 1.2 )',
	],
	' .vxt-gf-styler__field-style-box input[type="checkbox"]:checked + label:before' => [
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidthMobile'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeMobile'] . 'px / 1.2 )',
	],
	' .vxt-gf-styler__check-style-enabled .gfield_checkbox input[type="checkbox"] + label:before' => [
		'height'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeMobile'],
			'px'
		),
		'width'        => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeMobile'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeMobile'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidthMobile'],
			'px'
		),
	],
	' .vxt-gf-styler__check-style-enabled input[type="checkbox"] + label:before' => [
		'height'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeMobile'],
			'px'
		),
		'width'        => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeMobile'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeMobile'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidth'],
			'px'
		),
	],
	' .vxt-gf-styler__check-style-enabled input[type="radio"] + label:before' => [
		'height'       => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeMobile'],
			'px'
		),
		'width'        => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckSizeMobile'],
			'px'
		),
		'font-size'    => 'calc( ' . $attr['radioCheckSizeMobile'] . 'px / 1.2 )',
		'border-width' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['radioCheckBorderWidthMobile'],
			'px'
		),
	],
	' .gform_wrapper.gravity-theme input:not([type=submit])' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldleftMobilePadding'], $attr['fieldmobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldrightMobilePadding'], $attr['fieldmobilePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldtopMobilePadding'], $attr['fieldmobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldbottomMobilePadding'], $attr['fieldmobilePaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacingMobile'],
			'px'
		),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacingMobile'],
			'px'
		),
		'border-width'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidthMobile'],
			$attr['fieldBorderWidthType']
		),
	],
	' .gform_wrapper.gravity-theme .gfield textarea.large' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldleftMobilePadding'], $attr['fieldmobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldrightMobilePadding'], $attr['fieldmobilePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldtopMobilePadding'], $attr['fieldmobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldbottomMobilePadding'], $attr['fieldmobilePaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacingMobile'],
			'px'
		),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacingMobile'],
			'px'
		),
		'height'         => 'auto' === $attr['textAreaHeightMobile'] ? $attr['textAreaHeightMobile'] : \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['textAreaHeightMobile'],
			'px'
		),
		'border-width'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidthMobile'],
			$attr['fieldBorderWidthType']
		),
	],
	' input.gform_button'                                  => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonleftMobilePadding'], $attr['buttonmobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonrightMobilePadding'], $attr['buttonmobilePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttontopMobilePadding'], $attr['buttonmobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['buttonbottomMobilePadding'], $attr['buttonmobilePaddingUnit'] ),
		'border-width'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['buttonBorderWidthMobile'],
			'px'
		),
	],
	' .gform_wrapper.gravity-theme div.validation_message' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['msgleftMobilePadding'], $attr['msgmobilePaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['msgrightMobilePadding'], $attr['msgmobilePaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['msgtopMobilePadding'], $attr['msgmobilePaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['msgbottomMobilePadding'], $attr['msgmobilePaddingUnit'] ),
	],
	' .gform_wrapper.gravity-theme select '                => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldleftTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldrightTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldtopTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['fieldbottomTabletPadding'], $attr['fieldtabletPaddingUnit'] ),
		'margin-top'     => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldLabelSpacingTablet'],
			'px'
		),
		'margin-bottom'  => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldSpacingTablet'],
			'px'
		),
		'border-width'   => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['fieldBorderWidthTablet'],
			$attr['fieldBorderWidthType']
		),
	],
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'validationMsg', ' .gform_wrapper.gravity-theme .validation_message', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'validationMsg', ' span.wpgf-not-valid-tip', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'successMsg', ' .gform_confirmation_message', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'msg', ' .gform_wrapper div.validation_error', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'msg', ' .wpgf-response-output', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'button', ' input.gform_button, input.gform_previous_button, input.gform_next_button', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'label', ' form .gfield_checkbox label.gfield_label', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'label', ' form .gfield_radio label.gfield_label', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'label', ' .gform_wrapper.gravity-theme label.gfield_label', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'input', ' textarea', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'input', ' select', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'input', ' .gform_wrapper.gravity-theme input:not([type=submit])', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'radioCheck', ' .vxt-gf-styler__check-style-enabled form .gfield_checkbox label', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'input', ' .chosen-container-single span', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'radioCheck', ' .vxt-gf-styler__check-style-enabled form .gfield_radio label', $combinedSelectors );

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, '.vxt-block-' . $id );
