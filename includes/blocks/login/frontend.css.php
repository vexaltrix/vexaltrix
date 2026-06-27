<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 1.0.0
 *
 * @package vexaltrix-pro
 */

// Add fonts.
vexaltrixPro\Core\Utils::blocks_login_gfont( $attr );

$isRtl = is_rtl();

$formBorderCss        = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'form' );
$formBorderCssTablet = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'form', 'tablet' );
$formBorderCssMobile = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'form', 'mobile' );

$fieldsBorderCss        = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'fields' );
$fieldsBorderCssTablet = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'fields', 'tablet' );
$fieldsBorderCssMobile = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'fields', 'mobile' );

$loginBorderCss        = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'login' );
$loginBorderCssTablet = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'login', 'tablet' );
$loginBorderCssMobile = Vexaltrix_Block_Helper::uagGenerateBorderCss( $attr, 'login', 'mobile' );

$fullWidthLoginBtn        = 'full' === $attr['alignLoginBtn'] ? [ 'width' => '100%' ] : [];
$fullWidthLoginBtnTablet = 'full' === $attr['alignLoginBtnTablet'] ? [ 'width' => '100%' ] : [];
$fullWidthLoginBtnMobile = 'full' === $attr['alignLoginBtnMobile'] ? [ 'width' => '100%' ] : [];



$fieldIconCss = [
	'width'        => Vexaltrix_Helper::getCssValue( $attr['fieldsIconSize'], $attr['fieldsIconSizeType'] ),
	'height'       => ( array_key_exists( 'border-top-width', $fieldsBorderCss ) && array_key_exists( 'border-bottom-width', $fieldsBorderCss ) ) ?
						'calc( 100% - ' . $fieldsBorderCss['border-top-width'] . ' - ' . $fieldsBorderCss['border-bottom-width'] . ' )'
						: '',
	'top'          => array_key_exists( 'border-top-width', $fieldsBorderCss ) ? $fieldsBorderCss['border-top-width'] : '',
	'bottom'       => array_key_exists( 'border-bottom-width', $fieldsBorderCss ) ? $fieldsBorderCss['border-bottom-width'] : '',
	'left'         => array_key_exists( 'border-left-width', $fieldsBorderCss ) ? $fieldsBorderCss['border-left-width'] : '',
	'right'        => array_key_exists( 'border-right-width', $fieldsBorderCss ) ? $fieldsBorderCss['border-right-width'] : '',
	'border-width' => Vexaltrix_Helper::getCssValue( $attr['fieldsIconBorderWidth'], 'px' ),
	'border-color' => $attr['fieldsIconBorderColor'],
	'fill'         => $attr['fieldsIconColor'],
];

$fieldIconCssTablet = [
	'height' => ( array_key_exists( 'border-top-width', $fieldsBorderCssTablet ) && array_key_exists( 'border-bottom-width', $fieldsBorderCssTablet ) ) ?
				'calc( 100% - ' . $fieldsBorderCssTablet['border-top-width'] . ' - ' . $fieldsBorderCssTablet['border-bottom-width'] . ' )' : '',
	'top'    => array_key_exists( 'border-top-width', $fieldsBorderCssTablet ) ? $fieldsBorderCssTablet['border-top-width'] : '',
	'bottom' => array_key_exists( 'border-bottom-width', $fieldsBorderCssTablet ) ? $fieldsBorderCssTablet['border-bottom-width'] : '',
	'left'   => array_key_exists( 'border-left-width', $fieldsBorderCssTablet ) ? $fieldsBorderCssTablet['border-left-width'] : '',
	'right'  => array_key_exists( 'border-right-width', $fieldsBorderCssTablet ) ? $fieldsBorderCssTablet['border-right-width'] : '',
];

$fieldIconCssMobile = [
	'height' => ( array_key_exists( 'border-top-width', $fieldsBorderCssTablet ) && array_key_exists( 'border-bottom-width', $fieldsBorderCssTablet ) ) ?
				'calc( 100% - ' . $fieldsBorderCssMobile['border-top-width'] . ' - ' . $fieldsBorderCssMobile['border-bottom-width'] . ' )' : '',
	'top'    => array_key_exists( 'border-top-width', $fieldsBorderCssMobile ) ? $fieldsBorderCssMobile['border-top-width'] : '',
	'bottom' => array_key_exists( 'border-bottom-width', $fieldsBorderCssMobile ) ? $fieldsBorderCssMobile['border-bottom-width'] : '',
	'left'   => array_key_exists( 'border-left-width', $fieldsBorderCssMobile ) ? $fieldsBorderCssMobile['border-left-width'] : '',
	'right'  => array_key_exists( 'border-right-width', $fieldsBorderCssMobile ) ? $fieldsBorderCssMobile['border-right-width'] : '',
];

$usernameIconInputSelector = '.wp-block-vexaltrix-pro-login.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login .vexaltrix-pro-login-form-username-wrap.vexaltrix-pro-login-form-username-wrap--have-icon input';
$passwordIconInputSelector = '.wp-block-vexaltrix-pro-login.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass .vexaltrix-pro-login-form-pass-wrap.vexaltrix-pro-login-form-pass-wrap--have-icon input';

// shadow.
$boxShadowPositionCss = $attr['boxShadowPosition'];

if ( 'outset' === $attr['boxShadowPosition'] ) {
	$boxShadowPositionCss = '';
}

$boxShadowPositionCssHover = $attr['boxShadowPositionHover'];

if ( 'outset' === $attr['boxShadowPositionHover'] ) {
	$boxShadowPositionCssHover = '';
}

$mSelectors = [];
$tSelectors = [];

$commonGradientObj = [
	'gradientValue'     => $attr['gradientValue'],
	'gradientColor1'    => $attr['gradientColor1'],
	'gradientColor2'    => $attr['gradientColor2'],
	'gradientType'      => $attr['gradientType'],
	'gradientLocation1' => $attr['gradientLocation1'],
	'gradientLocation2' => $attr['gradientLocation2'],
	'gradientAngle'     => $attr['gradientAngle'],
	'selectGradient'    => $attr['selectGradient'],
];

// Background.
$bgObjDesktop           = array_merge(
	[
		'backgroundType'           => $attr['backgroundType'],
		'backgroundImage'          => $attr['backgroundImageDesktop'],
		'backgroundColor'          => $attr['backgroundColor'],
		'backgroundRepeat'         => $attr['backgroundRepeatDesktop'],
		'backgroundPosition'       => $attr['backgroundPositionDesktop'],
		'backgroundSize'           => $attr['backgroundSizeDesktop'],
		'backgroundAttachment'     => $attr['backgroundAttachmentDesktop'],
		'backgroundImageColor'     => $attr['backgroundImageColor'],
		'overlayType'              => $attr['overlayType'],
		'backgroundCustomSize'     => $attr['backgroundCustomSizeDesktop'],
		'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
		'customPosition'           => $attr['customPosition'],
		'xPosition'                => $attr['xPositionDesktop'],
		'xPositionType'            => $attr['xPositionType'],
		'yPosition'                => $attr['yPositionDesktop'],
		'yPositionType'            => $attr['yPositionType'],
	],
	$commonGradientObj
);
$containerBgCssDesktop = Vexaltrix_Block_Helper::uagGetBackgroundObj( $bgObjDesktop );

$bgObjTablet           = array_merge(
	[
		'backgroundType'           => $attr['backgroundType'],
		'backgroundImage'          => $attr['backgroundImageTablet'],
		'backgroundColor'          => $attr['backgroundColor'],
		'backgroundRepeat'         => $attr['backgroundRepeatTablet'],
		'backgroundPosition'       => $attr['backgroundPositionTablet'],
		'backgroundSize'           => $attr['backgroundSizeTablet'],
		'backgroundAttachment'     => $attr['backgroundAttachmentTablet'],
		'backgroundImageColor'     => $attr['backgroundImageColor'],
		'overlayType'              => $attr['overlayType'],
		'backgroundCustomSize'     => $attr['backgroundCustomSizeTablet'],
		'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
		'customPosition'           => $attr['customPosition'],
		'xPosition'                => $attr['xPositionTablet'],
		'xPositionType'            => $attr['xPositionTypeTablet'],
		'yPosition'                => $attr['yPositionTablet'],
		'yPositionType'            => $attr['yPositionTypeTablet'],
	],
	$commonGradientObj
);
$containerBgCssTablet = Vexaltrix_Block_Helper::uagGetBackgroundObj( $bgObjTablet );

$bgObjMobile           = array_merge(
	[
		'backgroundType'           => $attr['backgroundType'],
		'backgroundImage'          => $attr['backgroundImageMobile'],
		'backgroundColor'          => $attr['backgroundColor'],
		'backgroundRepeat'         => $attr['backgroundRepeatMobile'],
		'backgroundPosition'       => $attr['backgroundPositionMobile'],
		'backgroundSize'           => $attr['backgroundSizeMobile'],
		'backgroundAttachment'     => $attr['backgroundAttachmentMobile'],
		'backgroundImageColor'     => $attr['backgroundImageColor'],
		'overlayType'              => $attr['overlayType'],
		'backgroundCustomSize'     => $attr['backgroundCustomSizeMobile'],
		'backgroundCustomSizeType' => $attr['backgroundCustomSizeType'],
		'customPosition'           => $attr['customPosition'],
		'xPosition'                => $attr['xPositionMobile'],
		'xPositionType'            => $attr['xPositionTypeMobile'],
		'yPosition'                => $attr['yPositionMobile'],
		'yPositionType'            => $attr['yPositionTypeMobile'],
	],
	$commonGradientObj
);
$containerBgCssMobile = Vexaltrix_Block_Helper::uagGetBackgroundObj( $bgObjMobile );

$formLabelStyle = [
	'font-family'     => $attr['labelFontFamily'],
	'font-style'      => $attr['labelFontStyle'],
	'text-decoration' => $attr['labelDecoration'],
	'text-transform'  => $attr['labelTransform'],
	'font-weight'     => $attr['labelFontWeight'],
	'font-size'       => Vexaltrix_Helper::getCssValue( $attr['labelFontSize'], $attr['labelFontSizeType'] ),
	'line-height'     => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeight'],
		$attr['labelLineHeightType']
	),
	'letter-spacing'  => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacing'], $attr['labelLetterSpacingType'] ),
	'color'           => $attr['labelColor'],
	'margin-top'      => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMargin'],
		$attr['labelMarginUnit']
	),
	'margin-right'    => Vexaltrix_Helper::getCssValue(
		$attr['labelRightMargin'],
		$attr['labelMarginUnit']
	),
	'margin-bottom'   => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMargin'],
		$attr['labelMarginUnit']
	),
	'margin-left'     => Vexaltrix_Helper::getCssValue(
		$attr['labelLeftMargin'],
		$attr['labelMarginUnit']
	),
];

$formInputStyle = array_merge(
	[
		'font-family'     => $attr['fieldsFontFamily'],
		'font-style'      => $attr['fieldsFontStyle'],
		'text-decoration' => $attr['fieldsDecoration'],
		'text-transform'  => $attr['fieldsTransform'],
		'font-weight'     => $attr['fieldsFontWeight'],
		'font-size'       => Vexaltrix_Helper::getCssValue( $attr['fieldsFontSize'], $attr['fieldsFontSizeType'] ),
		'letter-spacing'  => Vexaltrix_Helper::getCssValue( $attr['fieldsLetterSpacing'], $attr['fieldsLetterSpacingType'] ),
		'line-height'     => Vexaltrix_Helper::getCssValue( $attr['fieldsLineHeight'], $attr['fieldsLineHeightType'] ),
		'background'      => $attr['fieldsBackground'],
		'color'           => $attr['fieldsColor'],
		'padding-top'     => Vexaltrix_Helper::getCssValue( $attr['paddingFieldTop'], $attr['paddingFieldUnit'] ),
		'padding-bottom'  => Vexaltrix_Helper::getCssValue( $attr['paddingFieldBottom'], $attr['paddingFieldUnit'] ),
		'padding-left'    => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeft'], $attr['paddingFieldUnit'] ),
		'padding-right'   => Vexaltrix_Helper::getCssValue( $attr['paddingFieldRight'], $attr['paddingFieldUnit'] ),
		'text-align'      => $attr['overallAlignment'],
	],
	$fieldsBorderCss
);

$formInputStyleTablet = array_merge(
	[
		'font-size'      => Vexaltrix_Helper::getCssValue( $attr['fieldsFontSizeTablet'], $attr['fieldsFontSizeType'] ),
		'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['fieldsLetterSpacingTablet'], $attr['fieldsLetterSpacingType'] ),
		'line-height'    => Vexaltrix_Helper::getCssValue( $attr['fieldsLineHeightTablet'], $attr['fieldsLineHeightType'] ),
		'padding-top'    => Vexaltrix_Helper::getCssValue( $attr['paddingFieldTopTablet'], $attr['paddingFieldUnitTablet'] ),
		'padding-bottom' => Vexaltrix_Helper::getCssValue( $attr['paddingFieldBottomTablet'], $attr['paddingFieldUnitTablet'] ),
		'padding-left'   => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeftTablet'], $attr['paddingFieldUnitTablet'] ),
		'padding-right'  => Vexaltrix_Helper::getCssValue( $attr['paddingFieldRightTablet'], $attr['paddingFieldUnitTablet'] ),
	],
	$fieldsBorderCssTablet
);

$formInputStyleMobile = array_merge(
	[
		'font-size'      => Vexaltrix_Helper::getCssValue( $attr['fieldsFontSizeMobile'], $attr['fieldsFontSizeType'] ),
		'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['fieldsLetterSpacingMobile'], $attr['fieldsLetterSpacingType'] ),
		'line-height'    => Vexaltrix_Helper::getCssValue( $attr['fieldsLineHeightMobile'], $attr['fieldsLineHeightType'] ),
		'padding-top'    => Vexaltrix_Helper::getCssValue( $attr['paddingFieldTopMobile'], $attr['paddingFieldUnitmobile'] ),
		'padding-bottom' => Vexaltrix_Helper::getCssValue( $attr['paddingFieldBottomMobile'], $attr['paddingFieldUnitmobile'] ),
		'padding-left'   => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeftMobile'], $attr['paddingFieldUnitmobile'] ),
		'padding-right'  => Vexaltrix_Helper::getCssValue( $attr['paddingFieldRightMobile'], $attr['paddingFieldUnitmobile'] ),
	],
	$fieldsBorderCssMobile
);



$selectors = [
	'.wp-block-vexaltrix-pro-login'                       => array_merge(
		[
			'width'          => Vexaltrix_Helper::getCssValue( $attr['formWidth'], $attr['formWidthType'] ),
			'padding-top'    => Vexaltrix_Helper::getCssValue( $attr['formTopPadding'], $attr['formPaddingUnit'] ),
			'padding-right'  => Vexaltrix_Helper::getCssValue( $attr['formRightPadding'], $attr['formPaddingUnit'] ),
			'padding-bottom' => Vexaltrix_Helper::getCssValue( $attr['formBottomPadding'], $attr['formPaddingUnit'] ),
			'padding-left'   => Vexaltrix_Helper::getCssValue( $attr['formLeftPadding'], $attr['formPaddingUnit'] ),
			'text-align'     => $attr['overallAlignment'],
			'box-shadow'     =>
				Vexaltrix_Helper::getCssValue( $attr['boxShadowHOffset'], 'px' ) .
				' ' .
				Vexaltrix_Helper::getCssValue( $attr['boxShadowVOffset'], 'px' ) .
				' ' .
				Vexaltrix_Helper::getCssValue( $attr['boxShadowBlur'], 'px' ) .
				' ' .
				Vexaltrix_Helper::getCssValue( $attr['boxShadowSpread'], 'px' ) .
				' ' .
				$attr['boxShadowColor'] .
				' ' .
				$boxShadowPositionCss,
		],
		$formBorderCss,
		$containerBgCssDesktop
	),
	'.wp-block-vexaltrix-pro-login:hover'                 => [
		'border-color' => $attr['formBorderHColor'],
	],
	' .vexaltrix-pro-login-form__field-error-message'     => [
		'text-align' => $attr['overallAlignment'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login' => [
		'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpace'], $attr['formRowsGapSpaceUnit'] ),
	],
	'.wp-block-vexaltrix-pro-login .wp-block-vexaltrix-pro-login__logged-in-message' => [
		'font-family'     => $attr['labelFontFamily'],
		'font-style'      => $attr['labelFontStyle'],
		'text-decoration' => $attr['labelDecoration'],
		'text-transform'  => $attr['labelTransform'],
		'font-weight'     => $attr['labelFontWeight'],
		'font-size'       => Vexaltrix_Helper::getCssValue( $attr['labelFontSize'], $attr['labelFontSizeType'] ),
		'line-height'     => Vexaltrix_Helper::getCssValue(
			$attr['labelLineHeight'],
			$attr['labelLineHeightType']
		),
		'letter-spacing'  => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacing'], $attr['labelLetterSpacingType'] ),
		'color'           => $attr['labelColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login label' => $formLabelStyle,
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login label:hover' => [
		'color' => $attr['labelHoverColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login input' => $formInputStyle,
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login input:hover' => [
		'border-color' => $attr['fieldsBorderHColor'],
		'background'   => $attr['fieldsBackgroundHover'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login input:focus' => [
		'background' => $attr['fieldsBackgroundActive'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login input::placeholder' => [
		'color' => $attr['placeholderColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login input:hover::placeholder' => [
		'color' => $attr['placeholderColorHover'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login input:focus::placeholder' => [
		'color' => $attr['placeholderColorActive'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass input::placeholder' => [
		'color' => $attr['placeholderColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass input:hover::placeholder' => [
		'color' => $attr['placeholderColorHover'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass input:focus::placeholder' => [
		'color' => $attr['placeholderColorActive'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__recaptcha' => [
		'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpace'], $attr['formRowsGapSpaceUnit'] ),
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass' => [
		'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpace'], $attr['formRowsGapSpaceUnit'] ),
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass button' => [
		'color'        => $attr['eyeIconColor'],
		'margin-right' => array_key_exists( 'border-right-width', $fieldsBorderCss ) && ( ! $isRtl ) ? 'calc( ' . $fieldsBorderCss['border-right-width'] . ' + 5px )' : '',
		'margin-left'  => array_key_exists( 'border-left-width', $fieldsBorderCss ) && $isRtl ? 'calc( ' . $fieldsBorderCss['border-left-width'] . ' + 5px )' : '',
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass button span' => [
		'font-size' => Vexaltrix_Helper::getCssValue( $attr['eyeIconSize'], $attr['eyeIconSizeType'] ),
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass label' => $formLabelStyle,
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass label:hover' => [
		'color' => $attr['labelHoverColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass input' => $formInputStyle,
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass input:hover' => [
		'color'        => $attr['labelHoverColor'],
		'border-color' => $attr['fieldsBorderHColor'],
		'background'   => $attr['fieldsBackgroundHover'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass input:focus' => [
		'background' => $attr['fieldsBackgroundActive'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot' => [
		'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpace'], $attr['formRowsGapSpaceUnit'] ),
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-forgot-password' => [
		'margin-top'    => Vexaltrix_Helper::getCssValue( $attr['labelTopMargin'], $attr['labelMarginUnit'] ),
		'margin-right'  => Vexaltrix_Helper::getCssValue( $attr['labelRightMargin'], $attr['labelMarginUnit'] ),
		'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['labelBottomMargin'], $attr['labelMarginUnit'] ),
		// Left margin not required.
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-forgot-password a' => array_merge(
		$formLabelStyle,
		[
			'margin' => 'unset',
			'color'  => $attr['linkColor'],
		]
	),
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-forgot-password a:hover' => [
		'color' => $attr['linkHColor'],
	],

	$usernameIconInputSelector                       => [
		'padding-left' => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeft'], $attr['paddingFieldUnit'] ),
	],

	$passwordIconInputSelector                       => [
		'padding-left' => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeft'], $attr['paddingFieldUnit'] ),
	],

	// Field icon - Username.
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form .vexaltrix-pro-login-form-username-wrap--have-icon > svg' => array_merge(
		$fieldIconCss
	),

	// Field icon - Password.
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form .vexaltrix-pro-login-form__user-pass .vexaltrix-pro-login-form-pass-wrap--have-icon > svg' => array_merge(
		$fieldIconCss
	),

	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-rememberme label' => array_merge(
		$formLabelStyle,
		[
			'margin' => 'unset',
		]
	),
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-rememberme label:hover' => [
		'color' => $attr['labelHoverColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-rememberme' => [
		'margin-top'    => Vexaltrix_Helper::getCssValue( $attr['labelTopMargin'], $attr['labelMarginUnit'] ),
		// Right margin not required.
		'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['labelBottomMargin'], $attr['labelMarginUnit'] ),
		'margin-left'   => Vexaltrix_Helper::getCssValue( $attr['labelLeftMargin'], $attr['labelMarginUnit'] ),
	],
	// checkbox.
	' .vexaltrix-pro-login-form-rememberme .vexaltrix-pro-login-form-rememberme__checkmark' => [
		'width'         => Vexaltrix_Helper::getCssValue( $attr['checkboxSize'], 'px' ),
		'height'        => Vexaltrix_Helper::getCssValue( $attr['checkboxSize'], 'px' ),
		'background'    => $attr['checkboxBackgroundColor'],
		'border-width'  => Vexaltrix_Helper::getCssValue( $attr['checkboxBorderWidth'], 'px' ),
		'border-radius' => Vexaltrix_Helper::getCssValue( $attr['checkboxBorderRadius'], 'px' ),
		'border-color'  => $attr['checkboxBorderColor'],
	],
	' .vexaltrix-pro-login-form-rememberme .vexaltrix-pro-login-form-rememberme__checkmark:after' => [
		'font-size' => Vexaltrix_Helper::getCssValue( $attr['checkboxSize'] / 2, 'px' ),
		'color'     => $attr['checkboxColor'],
	],
	// If the user clicks on the checkbox, light it up with some box shadow to portray some interaction!
	' .vexaltrix-pro-login-form-rememberme input[type="checkbox"]:focus + .vexaltrix-pro-login-form-rememberme__checkmark' => [
		'box-shadow' => $attr['checkboxGlowEnable'] && $attr['checkboxGlowColor'] ? ( '0 0 0 1px ' . $attr['checkboxGlowColor'] ) : '',
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-register:hover' => [
		'color' => $attr['linkHColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__submit' => [
		'justify-content' => $attr['alignLoginBtn'],
		'margin-bottom'   => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpace'], $attr['formRowsGapSpaceUnit'] ),
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button' => array_merge(
		[
			'font-family'     => $attr['loginFontFamily'],
			'font-style'      => $attr['loginFontStyle'],
			'text-decoration' => $attr['loginDecoration'],
			'text-transform'  => $attr['loginTransform'],
			'font-weight'     => $attr['loginFontWeight'],
			'font-size'       => Vexaltrix_Helper::getCssValue( $attr['loginFontSize'], $attr['loginFontSizeType'] ),
			'letter-spacing'  => Vexaltrix_Helper::getCssValue( $attr['loginLetterSpacing'], $attr['loginLetterSpacingType'] ),
			'line-height'     => Vexaltrix_Helper::getCssValue( $attr['loginLineHeight'], $attr['loginLineHeightType'] ),
			'background'      => $attr['loginBackground'],
			'color'           => $attr['loginColor'],
			'padding-top'     => Vexaltrix_Helper::getCssValue( $attr['loginTopPadding'], $attr['loginPaddingUnit'] ),
			'padding-right'   => Vexaltrix_Helper::getCssValue( $attr['loginRightPadding'], $attr['loginPaddingUnit'] ),
			'padding-bottom'  => Vexaltrix_Helper::getCssValue( $attr['loginBottomPadding'], $attr['loginPaddingUnit'] ),
			'padding-left'    => Vexaltrix_Helper::getCssValue( $attr['loginLeftPadding'], $attr['loginPaddingUnit'] ),
			'column-gap'      => Vexaltrix_Helper::getCssValue( $attr['ctaIconSpace'], $attr['ctaIconSpaceType'] ),

		],
		$fullWidthLoginBtn,
		$loginBorderCss
	),
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button:hover' => [
		'border-color' => $attr['loginBorderHColor'],
		'background'   => $attr['loginHBackground'],
		'color'        => $attr['loginHColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button:hover svg' => [
		'fill' => $attr['loginHColor'],
	],

	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-status .vexaltrix-pro-login-form-status__success' => [
		'border-left-color' => $attr['successMessageBorderColor'],
		'background-color'  => $attr['successMessageBackground'],
		'color'             => $attr['successMessageColor'],
	],
	'.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-status .vexaltrix-pro-login-form-status__error' => [
		'border-left-color' => $attr['errorMessageBorderColor'],
		'background-color'  => $attr['errorMessageBackground'],
		'color'             => $attr['errorMessageColor'],
	],



	// Info Link.
	' .wp-block-vexaltrix-pro-login-info'                 => [
		'color'           => $attr['registerInfoColor'],
		'font-family'     => $attr['registerInfoFontFamily'],
		'font-style'      => $attr['registerInfoFontStyle'],
		'text-decoration' => $attr['registerInfoDecoration'],
		'text-transform'  => $attr['registerInfoTransform'],
		'font-weight'     => $attr['registerInfoFontWeight'],
		'font-size'       => Vexaltrix_Helper::getCssValue( $attr['registerInfoFontSize'], $attr['registerInfoFontSizeType'] ),
		'letter-spacing'  => Vexaltrix_Helper::getCssValue( $attr['registerInfoLetterSpacing'], $attr['registerInfoLetterSpacingType'] ),
	],
	' .wp-block-vexaltrix-pro-login-info a'               => [
		'color' => $attr['linkColor'],
	],
	' .wp-block-vexaltrix-pro-login__logged-in-message a' => [
		'color' => $attr['linkColor'],
	],
	' .wp-block-vexaltrix-pro-login-info:hover'           => [
		'color' => $attr['registerInfoHoverColor'],
	],
	' .wp-block-vexaltrix-pro-login__logged-in-message a:hover' => [
		'color' => $attr['linkHColor'],
	],
];

// If hover blur or hover color are set, show the hover shadow.
if ( ( ( '' !== $attr['boxShadowBlurHover'] ) && ( null !== $attr['boxShadowBlurHover'] ) ) || '' !== $attr['boxShadowColorHover'] ) {

	$selectors['.wp-block-vexaltrix-pro-login:hover']['box-shadow'] = Vexaltrix_Helper::getCssValue( $attr['boxShadowHOffsetHover'], 'px' ) .
																' ' .
																Vexaltrix_Helper::getCssValue( $attr['boxShadowVOffsetHover'], 'px' ) .
																' ' .
																Vexaltrix_Helper::getCssValue( $attr['boxShadowBlurHover'], 'px' ) .
																' ' .
																Vexaltrix_Helper::getCssValue( $attr['boxShadowSpreadHover'], 'px' ) .
																' ' .
																$attr['boxShadowColorHover'] .
																' ' .
																$boxShadowPositionCssHover;

}

// tablet.
$tSelectors['.wp-block-vexaltrix-pro-login'] = array_merge(
	[
		'width'          => Vexaltrix_Helper::getCssValue( $attr['formWidthTablet'], $attr['formWidthTypeTablet'] ),
		'padding-top'    => Vexaltrix_Helper::getCssValue( $attr['formTopPaddingTablet'], $attr['formPaddingUnitTablet'] ),
		'padding-right'  => Vexaltrix_Helper::getCssValue( $attr['formRightPaddingTablet'], $attr['formPaddingUnitTablet'] ),
		'padding-bottom' => Vexaltrix_Helper::getCssValue( $attr['formBottomPaddingTablet'], $attr['formPaddingUnitTablet'] ),
		'padding-left'   => Vexaltrix_Helper::getCssValue( $attr['formLeftPaddingTablet'], $attr['formPaddingUnitTablet'] ),
	],
	$containerBgCssTablet,
	$formBorderCssTablet
);

$tSelectors[' .wp-block-vexaltrix-pro-login-info']                                     = [
	'font-size'      => Vexaltrix_Helper::getCssValue( $attr['registerInfoFontSizeTablet'], $attr['registerInfoFontSizeType'] ),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['registerInfoLetterSpacingTablet'], $attr['registerInfoLetterSpacingType'] ),
];
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login label'] = [
	'font-size'      => Vexaltrix_Helper::getCssValue(
		$attr['labelFontSizeTablet'],
		$attr['labelFontSizeType']
	),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacingTablet'], $attr['labelLetterSpacingType'] ),
	'line-height'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeightTablet'],
		$attr['labelLineHeightType']
	),
	'margin-top'     => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-right'   => Vexaltrix_Helper::getCssValue(
		$attr['labelRightMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-bottom'  => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-left'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLeftMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
];

$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass label'] = [
	'font-size'      => Vexaltrix_Helper::getCssValue(
		$attr['labelFontSizeTablet'],
		$attr['labelFontSizeType']
	),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacingTablet'], $attr['labelLetterSpacingType'] ),
	'line-height'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeightTablet'],
		$attr['labelLineHeightType']
	),
	'margin-top'     => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-right'   => Vexaltrix_Helper::getCssValue(
		$attr['labelRightMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-bottom'  => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-left'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLeftMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
];


$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login input'] = $formInputStyleTablet;
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass input']  = $formInputStyleTablet;

$tSelectors[ $usernameIconInputSelector ] = [
	'padding-left' => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeftTablet'], $attr['paddingFieldUnitTablet'] ),
];

$tSelectors[ $passwordIconInputSelector ] = [
	'padding-left' => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeftTablet'], $attr['paddingFieldUnitTablet'] ),
];

// Field Icon - Username.
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-username-wrap--have-icon > svg'] = array_merge(
	$fieldIconCssTablet
);

// Field Icon - Password.
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass .vexaltrix-pro-login-form-pass-wrap--have-icon > svg'] = array_merge(
	$fieldIconCssTablet
);

$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass button'] = [
	'margin-right' => array_key_exists( 'border-right-width', $fieldsBorderCssTablet ) && ( ! $isRtl ) ? $fieldsBorderCssTablet['border-right-width'] : '',
	'margin-left'  => array_key_exists( 'border-left-width', $fieldsBorderCssTablet ) && $isRtl ? $fieldsBorderCssTablet['border-left-width'] : '',
];

$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot .vexaltrix-pro-login-form-rememberme'] = [
	'margin-top'    => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	// Right margin not required.
	'margin-bottom' => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-left'   => Vexaltrix_Helper::getCssValue(
		$attr['labelLeftMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
];

$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot .vexaltrix-pro-login-form-rememberme label'] = [
	'font-size'      => Vexaltrix_Helper::getCssValue(
		$attr['labelFontSizeTablet'],
		$attr['labelFontSizeType']
	),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacingTablet'], $attr['labelLetterSpacingType'] ),
	'line-height'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeightTablet'],
		$attr['labelLineHeightType']
	),
];

$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot .vexaltrix-pro-login-form-forgot-password'] = [
	'margin-top'    => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-right'  => Vexaltrix_Helper::getCssValue(
		$attr['labelRightMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	'margin-bottom' => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMarginTablet'],
		$attr['labelMarginUnitTablet']
	),
	// Margin left not required.
];

$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot .vexaltrix-pro-login-form-forgot-password a'] = [
	'font-size'      => Vexaltrix_Helper::getCssValue(
		$attr['labelFontSizeTablet'],
		$attr['labelFontSizeType']
	),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacingTablet'], $attr['labelLetterSpacingType'] ),
	'line-height'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeightTablet'],
		$attr['labelLineHeightType']
	),
];
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__submit'] = [
	'justify-content' => $attr['alignLoginBtnTablet'],
];

$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button'] = array_merge(
	[
		'font-size'      => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeTablet'],
			$attr['loginFontSizeType']
		),
		'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['loginLetterSpacingTablet'], $attr['loginLetterSpacingType'] ),
		'line-height'    => Vexaltrix_Helper::getCssValue(
			$attr['loginLineHeightTablet'],
			$attr['loginLineHeightType']
		),
		'padding-top'    => Vexaltrix_Helper::getCssValue(
			$attr['loginTopPaddingTablet'],
			$attr['loginPaddingUnitTablet']
		),
		'padding-right'  => Vexaltrix_Helper::getCssValue(
			$attr['loginRightPaddingTablet'],
			$attr['loginPaddingUnitTablet']
		),
		'padding-bottom' => Vexaltrix_Helper::getCssValue(
			$attr['loginBottomPaddingTablet'],
			$attr['loginPaddingUnitTablet']
		),
		'padding-left'   => Vexaltrix_Helper::getCssValue(
			$attr['loginLeftPaddingTablet'],
			$attr['loginPaddingUnitTablet']
		),
		'column-gap'     => Vexaltrix_Helper::getCssValue( $attr['ctaIconSpaceTablet'], $attr['ctaIconSpaceType'] ),
	],
	$fullWidthLoginBtnTablet,
	$loginBorderCssTablet
);


// mobile.
$mSelectors['.wp-block-vexaltrix-pro-login'] = array_merge(
	[
		'width'          => Vexaltrix_Helper::getCssValue( $attr['formWidthMobile'], $attr['formWidthTypeMobile'] ),
		'padding-top'    => Vexaltrix_Helper::getCssValue(
			$attr['formTopPaddingMobile'],
			$attr['formPaddingUnitMobile']
		),
		'padding-right'  => Vexaltrix_Helper::getCssValue(
			$attr['formRightPaddingMobile'],
			$attr['formPaddingUnitMobile']
		),
		'padding-bottom' => Vexaltrix_Helper::getCssValue(
			$attr['formBottomPaddingMobile'],
			$attr['formPaddingUnitMobile']
		),
		'padding-left'   => Vexaltrix_Helper::getCssValue(
			$attr['formLeftPaddingMobile'],
			$attr['formPaddingUnitMobile']
		),
	],
	$containerBgCssMobile,
	$formBorderCssMobile
);

$tSelectors[' .wp-block-vexaltrix-pro-login-info']                                     = [
	'font-size'      => Vexaltrix_Helper::getCssValue( $attr['registerInfoFontSizeMobile'], $attr['registerInfoFontSizeType'] ),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['registerInfoLetterSpacingMobile'], $attr['registerInfoLetterSpacingType'] ),
];
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login label'] = [
	'font-size'      => Vexaltrix_Helper::getCssValue(
		$attr['labelFontSizeMobile'],
		$attr['labelFontSizeType']
	),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacingMobile'], $attr['labelLetterSpacingType'] ),
	'line-height'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeightMobile'],
		$attr['labelLineHeightType']
	),
	'margin-top'     => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-right'   => Vexaltrix_Helper::getCssValue(
		$attr['labelRightMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-bottom'  => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-left'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLeftMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
];

$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass label'] = [
	'font-size'      => Vexaltrix_Helper::getCssValue(
		$attr['labelFontSizeMobile'],
		$attr['labelFontSizeType']
	),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacingMobile'], $attr['labelLetterSpacingType'] ),
	'line-height'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeightMobile'],
		$attr['labelLineHeightType']
	),
	'margin-top'     => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-right'   => Vexaltrix_Helper::getCssValue(
		$attr['labelRightMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-bottom'  => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-left'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLeftMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
];

$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login input'] = $formInputStyleMobile;
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass input']  = $formInputStyleMobile;

$mSelectors[ $usernameIconInputSelector ] = [
	'padding-left' => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeftMobile'], $attr['paddingFieldUnitmobile'] ),
];

$mSelectors[ $passwordIconInputSelector ] = [
	'padding-left' => Vexaltrix_Helper::getCssValue( $attr['paddingFieldLeftMobile'], $attr['paddingFieldUnitmobile'] ),
];

// Field Icon - Username.
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-username-wrap--have-icon > svg'] = array_merge(
	$fieldIconCssMobile
);

// Field Icon - Password.
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass .vexaltrix-pro-login-form-pass-wrap--have-icon > svg'] = array_merge(
	$fieldIconCssMobile
);

$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass button'] = [
	'margin-right' => array_key_exists( 'border-right-width', $fieldsBorderCssMobile ) && ( ! $isRtl ) ? $fieldsBorderCssMobile['border-right-width'] : '',
	'margin-left'  => array_key_exists( 'border-left-width', $fieldsBorderCssMobile ) && $isRtl ? $fieldsBorderCssMobile['border-left-width'] : '',
];

$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot .vexaltrix-pro-login-form-rememberme'] = [
	'margin-top'    => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	// Right margin not required.
	'margin-bottom' => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-left'   => Vexaltrix_Helper::getCssValue(
		$attr['labelLeftMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
];

$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot .vexaltrix-pro-login-form-rememberme label'] = [
	'font-size'      => Vexaltrix_Helper::getCssValue(
		$attr['labelFontSizeMobile'],
		$attr['labelFontSizeType']
	),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacingMobile'], $attr['labelLetterSpacingType'] ),
	'line-height'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeightMobile'],
		$attr['labelLineHeightType']
	),
];

$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot .vexaltrix-pro-login-form-forgot-password'] = [
	'margin-top'    => Vexaltrix_Helper::getCssValue(
		$attr['labelTopMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-right'  => Vexaltrix_Helper::getCssValue(
		$attr['labelRightMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	'margin-bottom' => Vexaltrix_Helper::getCssValue(
		$attr['labelBottomMarginMobile'],
		$attr['labelMarginUnitMobile']
	),
	// Margin left not required.
];

$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot .vexaltrix-pro-login-form-forgot-password a'] = [
	'font-size'      => Vexaltrix_Helper::getCssValue(
		$attr['labelFontSizeMobile'],
		$attr['labelFontSizeType']
	),
	'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['labelLetterSpacingMobile'], $attr['labelLetterSpacingType'] ),
	'line-height'    => Vexaltrix_Helper::getCssValue(
		$attr['labelLineHeightMobile'],
		$attr['labelLineHeightType']
	),
];
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__submit']       = [
	'justify-content' => $attr['alignLoginBtnMobile'],
];
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button'] = array_merge(
	[
		'font-size'      => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeMobile'],
			$attr['loginFontSizeType']
		),
		'letter-spacing' => Vexaltrix_Helper::getCssValue( $attr['loginLetterSpacingMobile'], $attr['loginLetterSpacingType'] ),
		'line-height'    => Vexaltrix_Helper::getCssValue(
			$attr['loginLineHeightMobile'],
			$attr['loginLineHeightType']
		),
		'padding-top'    => Vexaltrix_Helper::getCssValue(
			$attr['loginTopPaddingMobile'],
			$attr['loginPaddingUnitMobile']
		),
		'padding-right'  => Vexaltrix_Helper::getCssValue(
			$attr['loginRightPaddingMobile'],
			$attr['loginPaddingUnitMobile']
		),
		'padding-bottom' => Vexaltrix_Helper::getCssValue(
			$attr['loginBottomPaddingMobile'],
			$attr['loginPaddingUnitMobile']
		),
		'padding-left'   => Vexaltrix_Helper::getCssValue(
			$attr['loginLeftPaddingMobile'],
			$attr['loginPaddingUnitMobile']
		),
		'column-gap'     => Vexaltrix_Helper::getCssValue( $attr['ctaIconSpaceMobile'], $attr['ctaIconSpaceType'] ),
	],
	$fullWidthLoginBtnMobile,
	$loginBorderCssMobile
);



if ( 'before' === $attr['ctaIconPosition'] ) {
	$selectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button svg']   = [
		'width'  => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSize'],
			$attr['loginFontSizeType']
		),
		'height' => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSize'],
			$attr['loginFontSizeType']
		),
		'fill'   => $attr['loginColor'],
	];
	$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button svg'] = [
		'width'  => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeTablet'],
			$attr['loginFontSizeType']
		),
		'height' => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeTablet'],
			$attr['loginFontSizeType']
		),
	];
	$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button svg'] = [
		'width'  => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeMobile'],
			$attr['loginFontSizeType']
		),
		'height' => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeMobile'],
			$attr['loginFontSizeType']
		),
	];
}//end if
if ( 'after' === $attr['ctaIconPosition'] ) {
	$selectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button svg']   = [
		'width'  => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSize'],
			$attr['loginFontSizeType']
		),
		'height' => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSize'],
			$attr['loginFontSizeType']
		),
		'fill'   => $attr['loginColor'],
	];
	$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button svg'] = [
		'width'  => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeTablet'],
			$attr['loginFontSizeType']
		),
		'height' => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeTablet'],
			$attr['loginFontSizeType']
		),
	];
	$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form-submit-button svg'] = [
		'width'  => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeMobile'],
			$attr['loginFontSizeType']
		),
		'height' => Vexaltrix_Helper::getCssValue(
			$attr['loginFontSizeMobile'],
			$attr['loginFontSizeType']
		),
	];
}//end if

// Grouping together Row Gap Selectors - Tablet.
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login']  = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceTablet'], $attr['formRowsGapSpaceUnit'] ),
];
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__recaptcha']   = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceTablet'], $attr['formRowsGapSpaceUnit'] ),
];
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass']   = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceTablet'], $attr['formRowsGapSpaceUnit'] ),
];
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot'] = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceTablet'], $attr['formRowsGapSpaceUnit'] ),
];
$tSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__submit']      = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceTablet'], $attr['formRowsGapSpaceUnit'] ),
];

// Grouping together Row Gap Selectors - Mobile.
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-login']  = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceMobile'], $attr['formRowsGapSpaceUnit'] ),
];
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__recaptcha']   = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceMobile'], $attr['formRowsGapSpaceUnit'] ),
];
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__user-pass']   = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceMobile'], $attr['formRowsGapSpaceUnit'] ),
];
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__forgetmenot'] = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceMobile'], $attr['formRowsGapSpaceUnit'] ),
];
$mSelectors['.wp-block-vexaltrix-pro-login .vexaltrix-pro-login-form__submit']      = [
	'margin-bottom' => Vexaltrix_Helper::getCssValue( $attr['formRowsGapSpaceMobile'], $attr['formRowsGapSpaceUnit'] ),
];


$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$baseSelector = '.vxt-block-';

return Vexaltrix_Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
