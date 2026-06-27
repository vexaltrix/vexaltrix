/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from '@Controls/generateCSS';
import generateCSSUnit from '@Controls/generateCSSUnit';
import getAttributeFallback, { getFallbackNumber } from '@Controls/getAttributeFallback';
import generateBorderCSS from '@Controls/generateBorderCSS';
import generateBackgroundCSS from '@Controls/generateBackgroundCSS';

function styling( attributes, clientId, name, deviceType ) {
	const blockName = name.replace( 'vexaltrix/', '' );
	const previewType = deviceType.toLowerCase();
	const {
		block_id,
		formPaddingTop,
		formPaddingRight,
		formPaddingBottom,
		formPaddingLeft,
		formPaddingTopTab,
		formPaddingRightTab,
		formPaddingBottomTab,
		formPaddingLeftTab,
		formPaddingTopMob,
		formPaddingRightMob,
		formPaddingBottomMob,
		formPaddingLeftMob,
		formPaddingUnit,
		formPaddingUnitTab,
		formPaddingUnitMob,
		buttonAlign,
		buttonAlignTablet,
		buttonAlignMobile,
		submitColor,
		submitColorHover,
		submitBgType,
		submitBgHoverType,
		submitBgColor,
		submitBgColorHover,
		toggleWidthSize,
		toggleWidthSizeTablet,
		toggleWidthSizeMobile,
		btnBorderHColor,
		submitTextFontFamily,
		submitTextFontWeight,
		submitTextFontSize,
		submitTextFontSizeType,
		submitTextFontSizeTablet,
		submitTextFontSizeMobile,
		submitTextLineHeightType,
		submitTextLineHeight,
		submitTextLineHeightTablet,
		submitTextLineHeightMobile,
		labelFontFamily,
		labelFontWeight,
		labelFontSize,
		labelFontSizeType,
		labelFontSizeTablet,
		labelFontSizeMobile,
		labelLineHeightType,
		labelLineHeight,
		labelLineHeightTablet,
		labelLineHeightMobile,
		inputFontFamily,
		inputFontWeight,
		inputFontSize,
		inputFontSizeType,
		inputFontSizeTablet,
		inputFontSizeMobile,
		inputLineHeightType,
		inputLineHeight,
		inputLineHeightTablet,
		inputLineHeightMobile,
		toggleColor,
		toggleActiveColor,
		toggleDotColor,
		toggleDotActiveColor,
		checkBoxToggleBorderStyle,
		checkBoxToggleBorderBottomWidth,
		toggleBorderRadius,
		checkBoxToggleBorderColor,
		checkBoxToggleBorderHColor,
		labelColor,
		labelHoverColor,
		inputColor,
		bgColor,
		bgHoverColor,
		bgActiveColor,
		inputplaceholderColor,
		inputplaceholderHoverColor,
		inputplaceholderActiveColor,
		fieldBorderHColor,
		fieldGap,
		fieldGapTablet,
		fieldGapMobile,
		formStyle,
		overallAlignment,
		overallAlignmentTablet,
		overallAlignmentMobile,
		labelAlignment,
		labelAlignmentTablet,
		labelAlignmentMobile,
		toggleSize,
		toggleSizeTablet,
		toggleSizeMobile,

		paddingBtnTop,
		paddingBtnRight,
		paddingBtnBottom,
		paddingBtnLeft,
		paddingBtnTopTablet,
		paddingBtnRightTablet,
		paddingBtnBottomTablet,
		paddingBtnLeftTablet,
		paddingBtnTopMobile,
		paddingBtnRightMobile,
		paddingBtnBottomMobile,
		paddingBtnLeftMobile,
		paddingBtnUnit,
		mobilePaddingBtnUnit,
		tabletPaddingBtnUnit,
		submitTextTransform,
		submitTextDecoration,
		labelTransform,
		labelDecoration,
		inputTransform,
		inputDecoration,
		fieldGapType,
		paddingFieldTop,
		paddingFieldRight,
		paddingFieldBottom,
		paddingFieldLeft,
		paddingFieldTopTablet,
		paddingFieldRightTablet,
		paddingFieldBottomTablet,
		paddingFieldLeftTablet,
		paddingFieldTopMobile,
		paddingFieldRightMobile,
		paddingFieldBottomMobile,
		paddingFieldLeftMobile,
		paddingFieldUnit,
		paddingFieldUnitmobile,
		paddingFieldUnitTablet,
		toggleSizeType,
		submitTextFontStyle,
		labelFontStyle,
		inputFontStyle,

		labelGap,
		labelGapTablet,
		labelGapMobile,
		labelGapUnit,

		displayLabels,
		labelLetterSpacing,
		labelLetterSpacingTablet,
		labelLetterSpacingMobile,
		labelLetterSpacingType,
		inputLetterSpacing,
		inputLetterSpacingTablet,
		inputLetterSpacingMobile,
		inputLetterSpacingType,
		submitTextLetterSpacing,
		submitTextLetterSpacingTablet,
		submitTextLetterSpacingMobile,
		submitTextLetterSpacingType,
		gradientHValue,
		gradientValue,
		gradientHColor1,
		gradientHColor2,
		gradientHLocation1,
		gradientHLocationTablet1,
		gradientHLocationMobile1,
		gradientHLocation2,
		gradientHLocationTablet2,
		gradientHLocationMobile2,
		gradientHType,
		gradientHAngle,
		gradientHAngleTablet,
		gradientHAngleMobile,
		selectHGradient,
		gradientColor1,
		gradientColor2,
		gradientLocation1,
		gradientLocationTablet1,
		gradientLocationMobile1,
		gradientLocation2,
		gradientLocationTablet2,
		gradientLocationMobile2,
		gradientType,
		gradientAngle,
		gradientAngleTablet,
		gradientAngleMobile,
		selectGradient,
		inheritFromTheme,
	} = attributes;

	let selectors = {};
	let tabletSelectors = {};
	let mobileSelectors = {};

	const fieldGapFallback = getFallbackNumber( fieldGap, 'fieldGap', blockName );
	const labelGapFallback = getFallbackNumber( labelGap, 'labelGap', blockName );

	// Used for Calculations, needs to be numeric.
	const toggleSizeNumber = getFallbackNumber( toggleSize, 'toggleSize', blockName );
	const toggleSizeNumberTablet = isNaN( toggleSizeTablet ) ? toggleSizeNumber : toggleSizeTablet;
	const toggleSizeNumberMobile = isNaN( toggleSizeMobile ) ? toggleSizeNumberTablet : toggleSizeMobile;
	const toggleSizeTabletFallback = getFallbackNumber( toggleSizeTablet, 'toggleSizeTablet', blockName );
	const toggleSizeMobileFallback = getFallbackNumber( toggleSizeMobile, 'toggleSizeMobile', blockName );

	// Used for Calculations, needs to be numeric.
	const toggleWidthSizeNumber = getFallbackNumber( toggleWidthSize, 'toggleWidthSize', blockName );
	const toggleWidthSizeNumberTablet = isNaN( toggleWidthSizeTablet ) ? toggleWidthSizeNumber : toggleWidthSizeTablet;
	const toggleWidthSizeNumberMobile = isNaN( toggleWidthSizeMobile )
		? toggleWidthSizeNumberTablet
		: toggleWidthSizeMobile;

	const inputBorder = generateBorderCSS( attributes, 'field' );
	const inputBorderTablet = generateBorderCSS( attributes, 'field', 'tablet' );
	const inputBorderMobile = generateBorderCSS( attributes, 'field', 'mobile' );

	const toggleBorder = generateBorderCSS( attributes, 'checkBoxToggle' );
	const toggleBorderTablet = generateBorderCSS( attributes, 'checkBoxToggle', 'tablet' );
	const toggleBorderMobile = generateBorderCSS( attributes, 'checkBoxToggle', 'mobile' );

	// Individual Toggle Border Radius Fallback for Inner Dot.
	let toggleBorderRadiusTLFallback = getAttributeFallback(
		toggleBorder[ 'border-top-left-radius' ],
		'checkBoxToggleBorderTopLeftRadius',
		blockName
	);
	let toggleBorderRadiusTRFallback = getAttributeFallback(
		toggleBorder[ 'border-top-right-radius' ],
		'checkBoxToggleBorderTopRightRadius',
		blockName
	);
	let toggleBorderRadiusBRFallback = getAttributeFallback(
		toggleBorder[ 'border-bottom-right-radius' ],
		'checkBoxToggleBorderBottomRightRadius',
		blockName
	);
	let toggleBorderRadiusBLFallback = getAttributeFallback(
		toggleBorder[ 'border-bottom-left-radius' ],
		'checkBoxToggleBorderBottomLeftRadius',
		blockName
	);
	toggleBorderRadiusTLFallback = isNaN( toggleBorderRadiusTLFallback )
		? toggleBorderRadiusTLFallback
		: `${ toggleBorderRadiusTLFallback }px`;
	toggleBorderRadiusTRFallback = isNaN( toggleBorderRadiusTRFallback )
		? toggleBorderRadiusTRFallback
		: `${ toggleBorderRadiusTRFallback }px`;
	toggleBorderRadiusBRFallback = isNaN( toggleBorderRadiusBRFallback )
		? toggleBorderRadiusBRFallback
		: `${ toggleBorderRadiusBRFallback }px`;
	toggleBorderRadiusBLFallback = isNaN( toggleBorderRadiusBLFallback )
		? toggleBorderRadiusBLFallback
		: `${ toggleBorderRadiusBLFallback }px`;
	const toggleBorderRadiusTLTabletFallback =
		'' !== toggleBorderTablet[ 'border-top-left-radius' ] && 'px' !== toggleBorderTablet[ 'border-top-left-radius' ]
			? toggleBorderTablet[ 'border-top-left-radius' ]
			: toggleBorderRadiusTLFallback;
	const toggleBorderRadiusTRTabletFallback =
		'' !== toggleBorderTablet[ 'border-top-right-radius' ] &&
		'px' !== toggleBorderTablet[ 'border-top-right-radius' ]
			? toggleBorderTablet[ 'border-top-right-radius' ]
			: toggleBorderRadiusTRFallback;
	const toggleBorderRadiusBRTabletFallback =
		'' !== toggleBorderTablet[ 'border-bottom-right-radius' ] &&
		'px' !== toggleBorderTablet[ 'border-bottom-right-radius' ]
			? toggleBorderTablet[ 'border-bottom-right-radius' ]
			: toggleBorderRadiusBRFallback;
	const toggleBorderRadiusBLTabletFallback =
		'' !== toggleBorderTablet[ 'border-bottom-left-radius' ] &&
		'px' !== toggleBorderTablet[ 'border-bottom-left-radius' ]
			? toggleBorderTablet[ 'border-bottom-left-radius' ]
			: toggleBorderRadiusBLFallback;
	const toggleBorderRadiusTLMobileFallback =
		'' !== toggleBorderMobile[ 'border-top-left-radius' ] && 'px' !== toggleBorderMobile[ 'border-top-left-radius' ]
			? toggleBorderMobile[ 'border-top-left-radius' ]
			: toggleBorderRadiusTLTabletFallback;
	const toggleBorderRadiusTRMobileFallback =
		'' !== toggleBorderMobile[ 'border-top-right-radius' ] &&
		'px' !== toggleBorderMobile[ 'border-top-right-radius' ]
			? toggleBorderMobile[ 'border-top-right-radius' ]
			: toggleBorderRadiusTRTabletFallback;
	const toggleBorderRadiusBRMobileFallback =
		'' !== toggleBorderMobile[ 'border-bottom-right-radius' ] &&
		'px' !== toggleBorderMobile[ 'border-bottom-right-radius' ]
			? toggleBorderMobile[ 'border-bottom-right-radius' ]
			: toggleBorderRadiusBRTabletFallback;
	const toggleBorderRadiusBLMobileFallback =
		'' !== toggleBorderMobile[ 'border-bottom-left-radius' ] &&
		'px' !== toggleBorderMobile[ 'border-bottom-left-radius' ]
			? toggleBorderMobile[ 'border-bottom-left-radius' ]
			: toggleBorderRadiusBLTabletFallback;

	// Individual Toggle Border Radius Fallback for Inner Dot.
	let toggleBorderTFallback =
		undefined !== toggleBorder[ 'border-top-width' ]
			? getAttributeFallback( toggleBorder[ 'border-top-width' ], 'checkBoxToggleBorderTopWidth', blockName )
			: '';
	let toggleBorderLFallback =
		undefined !== toggleBorder[ 'border-left-width' ]
			? getAttributeFallback( toggleBorder[ 'border-left-width' ], 'checkBoxToggleBorderLeftWidth', blockName )
			: '';
	let toggleBorderBFallback =
		undefined !== toggleBorder[ 'border-bottom-width' ]
			? getAttributeFallback(
					toggleBorder[ 'border-bottom-width' ],
					'checkBoxToggleBorderBottomWidth',
					blockName
			  )
			: '';
	let toggleBorderRFallback =
		undefined !== toggleBorder[ 'border-right-width' ]
			? getAttributeFallback( toggleBorder[ 'border-right-width' ], 'checkBoxToggleBorderBottomRight', blockName )
			: '';

	toggleBorderTFallback = isNaN( toggleBorderTFallback ) ? toggleBorderTFallback : `${ toggleBorderTFallback }px`;
	toggleBorderRFallback = isNaN( toggleBorderRFallback ) ? toggleBorderRFallback : `${ toggleBorderRFallback }px`;
	toggleBorderBFallback = isNaN( toggleBorderBFallback ) ? toggleBorderBFallback : `${ toggleBorderBFallback }px`;
	toggleBorderLFallback = isNaN( toggleBorderLFallback ) ? toggleBorderLFallback : `${ toggleBorderLFallback }px`;
	const toggleBorderTTabletFallback =
		'px' !== toggleBorderTablet[ 'border-top-width' ] && '' !== toggleBorderTablet[ 'border-top-width' ]
			? toggleBorderTablet[ 'border-top-width' ]
			: toggleBorderTFallback;
	const toggleBorderRTabletFallback =
		'px' !== toggleBorderTablet[ 'border-right-width' ] && '' !== toggleBorderTablet[ 'border-right-width' ]
			? toggleBorderTablet[ 'border-right-width' ]
			: toggleBorderRFallback;
	const toggleBorderBTabletFallback =
		'px' !== toggleBorderTablet[ 'border-bottom-width' ] && '' !== toggleBorderTablet[ 'border-bottom-width' ]
			? toggleBorderTablet[ 'border-bottom-width' ]
			: toggleBorderBFallback;
	const toggleBorderLTabletFallback =
		'px' !== toggleBorderTablet[ 'border-left-width' ] && '' !== toggleBorderTablet[ 'border-left-width' ]
			? toggleBorderTablet[ 'border-left-width' ]
			: toggleBorderLFallback;
	const toggleBorderTMobileFallback =
		'px' !== toggleBorderMobile[ 'border-top-width' ] && '' !== toggleBorderMobile[ 'border-top-width' ]
			? toggleBorderMobile[ 'border-top-width' ]
			: toggleBorderTTabletFallback;
	const toggleBorderRMobileFallback =
		'px' !== toggleBorderMobile[ 'border-right-width' ] && '' !== toggleBorderMobile[ 'border-right-width' ]
			? toggleBorderMobile[ 'border-right-width' ]
			: toggleBorderRTabletFallback;
	const toggleBorderBMobileFallback =
		'px' !== toggleBorderMobile[ 'border-bottom-width' ] && '' !== toggleBorderMobile[ 'border-bottom-width' ]
			? toggleBorderMobile[ 'border-bottom-width' ]
			: toggleBorderBTabletFallback;
	const toggleBorderLMobileFallback =
		'px' !== toggleBorderMobile[ 'border-left-width' ] && '' !== toggleBorderMobile[ 'border-left-width' ]
			? toggleBorderMobile[ 'border-left-width' ]
			: toggleBorderLTabletFallback;

	const submitBorder = generateBorderCSS( attributes, 'btn' );
	const submitBorderTablet = generateBorderCSS( attributes, 'btn', 'tablet' );
	const submitBorderMobile = generateBorderCSS( attributes, 'btn', 'mobile' );

	selectors = {
		'.vxt-forms__outer-wrap': {
			'padding-top': generateCSSUnit( formPaddingTop, formPaddingUnit ),
			'padding-right': generateCSSUnit( formPaddingRight, formPaddingUnit ),
			'padding-bottom': generateCSSUnit( formPaddingBottom, formPaddingUnit ),
			'padding-left': generateCSSUnit( formPaddingLeft, formPaddingUnit ),
		},
		' .vxt-forms-input': {
			'text-align': overallAlignment,
		},
		' .vxt-forms-input-label': {
			display: displayLabels ? 'block' : 'none',
			'text-align': labelAlignment,
		},

		' .vxt-forms-main-form .vxt-forms-field-set': {
			'margin-bottom': generateCSSUnit( fieldGapFallback, fieldGapType ),
		},
		' .vxt-forms-main-form .vxt-forms-input-label': {
			'font-size': generateCSSUnit( labelFontSize, labelFontSizeType ),
			'line-height': generateCSSUnit( labelLineHeight, labelLineHeightType ),
			'font-family': labelFontFamily,
			'font-style': labelFontStyle,
			'text-transform': labelTransform,
			'text-decoration': labelDecoration,
			'font-weight': labelFontWeight,
			color: labelColor,
			'margin-bottom': generateCSSUnit( labelGapFallback, labelGapUnit ),
			'letter-spacing': generateCSSUnit( labelLetterSpacing, labelLetterSpacingType ),
		},
		' .vxt-forms-main-form  .vxt-forms-input::placeholder': {
			'font-size': generateCSSUnit( inputFontSize, inputFontSizeType ),
			'line-height': generateCSSUnit( inputLineHeight, inputLineHeightType ),
			'font-family': inputFontFamily,
			'font-style': inputFontStyle,
			'text-transform': inputTransform,
			'text-decoration': inputDecoration,
			'font-weight': inputFontWeight,
			color: inputplaceholderColor,
			'letter-spacing': generateCSSUnit( inputLetterSpacing, inputLetterSpacingType ),
		},
		' .vxt-forms-main-form input': {
			'font-size': generateCSSUnit( inputFontSize, inputFontSizeType ),
			'line-height': generateCSSUnit( inputLineHeight, inputLineHeightType ),
			'font-family': inputFontFamily,
			'font-style': inputFontStyle,
			'text-transform': inputTransform,
			'text-decoration': inputDecoration,
			'font-weight': inputFontWeight,
			color: inputplaceholderColor,
			'letter-spacing': generateCSSUnit( inputLetterSpacing, inputLetterSpacingType ),
		},
		' .components-input-control__container': {
			'background-color': bgColor,
		},
		' .vxt-forms-main-form textarea': {
			'font-size': generateCSSUnit( inputFontSize, inputFontSizeType ),
			'line-height': generateCSSUnit( inputLineHeight, inputLineHeightType ),
			'font-family': inputFontFamily,
			'font-style': inputFontStyle,
			'text-transform': inputTransform,
			'text-decoration': inputDecoration,
			'font-weight': inputFontWeight,
			color: inputplaceholderColor,
			'letter-spacing': generateCSSUnit( inputLetterSpacing, inputLetterSpacingType ),
			'text-align': overallAlignment,
		},
		' .vxt-forms-main-form select': {
			'font-size': generateCSSUnit( inputFontSize, inputFontSizeType ),
			'line-height': generateCSSUnit( inputLineHeight, inputLineHeightType ),
			'font-family': inputFontFamily,
			'font-style': inputFontStyle,
			'text-transform': inputTransform,
			'text-decoration': inputDecoration,
			'font-weight': inputFontWeight,
			color: inputplaceholderColor,
			'letter-spacing': generateCSSUnit( inputLetterSpacing, inputLetterSpacingType ),
		},
		' .vxt-forms-main-form .vxt-forms-input:focus': {
			outline: ' none !important',
			border: fieldBorderHColor,
			'background-color': `${ bgActiveColor } !important`,
		},
		' .vxt-forms-main-form .components-select-control__input:focus': {
			'background-color': `${ bgActiveColor } !important`,
		},
		' .vxt-forms-main-form .vxt-forms-input:focus::placeholder': {
			color: `${ inputplaceholderActiveColor } !important`,
		},
		' .vxt-forms-main-form .vxt-forms-phone-flex': {
			height: `calc(${
				inputLineHeight ? generateCSSUnit( inputLineHeight, inputLineHeightType ) : '2em'
			} + ${ generateCSSUnit( paddingFieldTop, paddingFieldUnit ) } + ${ generateCSSUnit(
				paddingFieldBottom,
				paddingFieldUnit
			) })`,
		},
		' .vxt-switch': {
			// 20 is the min size of the toggle.
			// Space around the toggle dot is calculated as 1/6th the size of the toggle dot.
			height: `calc(${ toggleBorder[ 'border-bottom-width' ] } + ${
				toggleBorder[ 'border-top-width' ]
			} + ${ generateCSSUnit(
				parseInt( 20 + toggleWidthSizeNumber + ( 20 + toggleWidthSizeNumber ) / 3 ),
				'px'
			) })`,
			width: `calc(${ toggleBorder[ 'border-left-width' ] } + ${
				toggleBorder[ 'border-right-width' ]
			} + ${ generateCSSUnit(
				parseInt( ( 20 + toggleWidthSizeNumber ) * 2.5 + ( 20 + toggleWidthSizeNumber ) / 3 ),
				'px'
			) })`,
		},
		' .vxt-switch input:checked + .vxt-slider': {
			'background-color': toggleActiveColor,
			'border-color': checkBoxToggleBorderHColor,
		},
		' .vxt-switch input:checked + .vxt-slider:before': {
			'background-color': toggleDotActiveColor,
		},
		' .vxt-switch input:focus + .vxt-slider': {
			'box-shadow': '0 0 1px' + toggleActiveColor,
		},
		' .vxt-slider:before': {
			height: generateCSSUnit( 20 + toggleWidthSizeNumber, 'px' ),
			width: generateCSSUnit( 20 + toggleWidthSizeNumber, 'px' ),
			top: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumber ) / 6 ), 'px' ),
			bottom: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumber ) / 6 ), 'px' ),
			left: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumber ) / 6 ), 'px' ),
			'background-color': toggleDotColor,
			'border-radius': `${ toggleBorderRadiusTLFallback } ${ toggleBorderRadiusTRFallback } ${ toggleBorderRadiusBRFallback } ${ toggleBorderRadiusBLFallback }`,
		},
		' .vxt-slider.round': {
			'border-radius': generateCSSUnit( 20 + toggleWidthSizeNumber, 'px' ),
		},
		' .vxt-switch input:checked + .vxt-slider:before ': {
			transform: `translateX(${ generateCSSUnit(
				parseInt( ( 20 + toggleWidthSizeNumber ) * 2.5 - ( 20 + toggleWidthSizeNumber ) ),
				'px'
			) })`,
			'background-color': toggleDotActiveColor,
		},
		' .vxt-forms-radio-wrap input[type=radio]:checked + label:before': {
			'background-color': toggleDotActiveColor,
			'border-color': `${ checkBoxToggleBorderHColor } !important`,
			'box-shadow': `inset 0 0 0 4px ${ toggleActiveColor }`,
			'font-size': 'calc(' + toggleSizeNumber + toggleSizeType + ' / 1.2 )',
		},
		' .vxt-forms-radio-wrap input[type=radio] + label:before': {
			'background-color': toggleColor,
			width: generateCSSUnit( toggleSizeNumber, toggleSizeType ),
			height: generateCSSUnit( toggleSizeNumber, toggleSizeType ),
		},
		' .vxt-forms-radio-wrap > label': {
			color: inputColor,
		},
		' .vxt-forms-checkbox-wrap input[type=checkbox]:checked + label:before': {
			color: toggleDotActiveColor,
			'background-color': toggleActiveColor,
			'border-color': `${ checkBoxToggleBorderHColor } !important`,
			'font-size': 'calc(' + toggleSizeNumber + 'px / 1.2 )',
		},
		' .vxt-forms-checkbox-wrap input[type=checkbox] + label:before': {
			'background-color': toggleColor,
			'border-radius': generateCSSUnit( toggleBorderRadius, 'px' ),
			width: generateCSSUnit( toggleSizeNumber, 'px' ),
			height: generateCSSUnit( toggleSizeNumber, 'px' ),
		},
		' .vxt-forms-checkbox-wrap > label': {
			color: inputColor,
		},
		' .vxt-forms-accept-wrap input[type=checkbox]:checked + label:before': {
			color: toggleDotActiveColor,
			'background-color': toggleActiveColor,
			'border-color': `${ checkBoxToggleBorderHColor } !important`,
			'font-size': 'calc(' + toggleSizeNumber + 'px / 1.2 )',
		},
		' .vxt-forms-accept-wrap input[type=checkbox] + label:before': {
			'border-radius': generateCSSUnit( toggleBorderRadius, 'px' ),
			'background-color': toggleColor,
			width: generateCSSUnit( toggleSizeNumber, 'px' ),
			height: generateCSSUnit( toggleSizeNumber, 'px' ),
		},
		' .vxt-forms-accept-wrap > label': {
			color: inputColor,
		},
		// Hover Colors
		' .vxt-forms-field-set:hover .vxt-forms-input-label': {
			color: labelHoverColor,
		},
		' .vxt-forms-field-set:hover .vxt-forms-input': {
			'background-color': bgHoverColor,
			'border-color': fieldBorderHColor,
		},
		' .vxt-forms-field-set:hover .vxt-forms-input::placeholder': {
			color: inputplaceholderHoverColor,
		},
		' .vxt-forms-field-set .vxt-forms-input select': {
			color: inputColor,
		},
		' .vxt-forms-phone-flex:hover .components-base-control__field .components-select-control__input': {
			'background-color': bgHoverColor,
		},
		' .vxt-forms-phone-flex .components-base-control__field .components-select-control__input': {
			height: 'auto',
		},
	};

	if ( buttonAlign !== 'full' ) {
		selectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap' ] = {
			'text-align': buttonAlign,
		};
	} else {
		selectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap' ] = {
			display: 'grid',
		};
	}

	tabletSelectors = {
		'.vxt-forms__outer-wrap': {
			'padding-top': generateCSSUnit( formPaddingTopTab, formPaddingUnitTab ),
			'padding-right': generateCSSUnit( formPaddingRightTab, formPaddingUnitTab ),
			'padding-bottom': generateCSSUnit( formPaddingBottomTab, formPaddingUnitTab ),
			'padding-left': generateCSSUnit( formPaddingLeftTab, formPaddingUnitTab ),
		},
		' .vxt-forms-main-form .vxt-forms-field-set': {
			'margin-bottom': generateCSSUnit( fieldGapTablet, fieldGapType ),
		},
		' .vxt-forms-radio-wrap input[type=radio]:checked + label:before': {
			'font-size': 'calc(' + toggleSizeNumberTablet + toggleSizeType + ' / 1.2 )',
		},
		' .vxt-forms-radio-wrap input[type=radio] + label:before': {
			width: generateCSSUnit( toggleSizeTabletFallback, toggleSizeType ),
			height: generateCSSUnit( toggleSizeTabletFallback, toggleSizeType ),
		},
		' .vxt-forms-checkbox-wrap input[type=checkbox]:checked + label:before': {
			'font-size': 'calc(' + toggleSizeNumberTablet + 'px / 1.2 )',
		},
		' .vxt-forms-checkbox-wrap input[type=checkbox] + label:before': {
			width: generateCSSUnit( toggleSizeTabletFallback, 'px' ),
			height: generateCSSUnit( toggleSizeTabletFallback, 'px' ),
		},
		' .vxt-forms-accept-wrap input[type=checkbox]:checked + label:before': {
			'font-size': 'calc(' + toggleSizeNumberTablet + 'px / 1.2 )',
		},
		' .vxt-forms-accept-wrap input[type=checkbox] + label:before': {
			width: generateCSSUnit( toggleSizeTabletFallback, 'px' ),
			height: generateCSSUnit( toggleSizeTabletFallback, 'px' ),
		},
		' .vxt-switch': {
			height: `calc(${ toggleBorderTTabletFallback } + ${ toggleBorderBTabletFallback } + ${ generateCSSUnit(
				parseInt( 20 + toggleWidthSizeNumberTablet + ( 20 + toggleWidthSizeNumberTablet ) / 3 ),
				'px'
			) })`,
			width: `calc(${ toggleBorderLTabletFallback } + ${ toggleBorderRTabletFallback } + ${ generateCSSUnit(
				parseInt( ( 20 + toggleWidthSizeNumberTablet ) * 2.5 + ( 20 + toggleWidthSizeNumberTablet ) / 3 ),
				'px'
			) })`,
		},
		' .vxt-switch .vxt-slider:before': {
			height: generateCSSUnit( 20 + toggleWidthSizeNumberTablet, 'px' ),
			width: generateCSSUnit( 20 + toggleWidthSizeNumberTablet, 'px' ),
			top: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumberTablet ) / 6 ), 'px' ),
			bottom: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumberTablet ) / 6 ), 'px' ),
			left: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumberTablet ) / 6 ), 'px' ),
			'background-color': toggleDotColor,
			'border-radius': `${ toggleBorderRadiusTLTabletFallback } ${ toggleBorderRadiusTRTabletFallback } ${ toggleBorderRadiusBRTabletFallback } ${ toggleBorderRadiusBLTabletFallback }`,
		},
		' .vxt-slider.round': {
			'border-radius': generateCSSUnit( 20 + toggleWidthSizeNumberTablet, 'px' ),
		},
		' .vxt-switch input:checked + .vxt-slider:before ': {
			transform: `translateX(${ generateCSSUnit(
				parseInt( ( 20 + toggleWidthSizeNumberTablet ) * 2.5 - ( 20 + toggleWidthSizeNumberTablet ) ),
				'px'
			) })`,
		},
		' .vxt-forms-main-form .vxt-forms-input-label': {
			'font-size': generateCSSUnit( labelFontSizeTablet, labelFontSizeType ),
			'line-height': generateCSSUnit( labelLineHeightTablet, labelLineHeightType ),
			'margin-bottom': generateCSSUnit( labelGapTablet, labelGapUnit ),
			'letter-spacing': generateCSSUnit( labelLetterSpacingTablet, labelLetterSpacingType ),
		},
		' .vxt-forms-main-form  .vxt-forms-input::placeholder': {
			'font-size': generateCSSUnit( inputFontSizeTablet, inputFontSizeType ),
			'line-height': generateCSSUnit( inputLineHeightTablet, inputLineHeightType ),
			'letter-spacing': generateCSSUnit( inputLetterSpacingTablet, inputLetterSpacingType ),
		},
		' .vxt-forms-input': {
			'text-align': overallAlignmentTablet,
		},
		' .vxt-forms-input-label': {
			display: displayLabels ? 'block' : 'none',
			'text-align': labelAlignmentTablet,
		},
		' .vxt-forms-main-form textarea': {
			'text-align': overallAlignmentTablet,
		},
	};

	if ( buttonAlignTablet !== 'full' ) {
		tabletSelectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap' ] = {
			'text-align': buttonAlignTablet,
		};
	} else {
		tabletSelectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap' ] = {
			display: 'grid',
		};
	}

	mobileSelectors = {
		'.vxt-forms__outer-wrap': {
			'padding-top': generateCSSUnit( formPaddingTopMob, formPaddingUnitMob ),
			'padding-right': generateCSSUnit( formPaddingRightMob, formPaddingUnitMob ),
			'padding-bottom': generateCSSUnit( formPaddingBottomMob, formPaddingUnitMob ),
			'padding-left': generateCSSUnit( formPaddingLeftMob, formPaddingUnitMob ),
		},
		' .vxt-forms-radio-wrap input[type=radio]:checked + label:before': {
			'font-size': 'calc(' + toggleSizeNumberMobile + toggleSizeType + ' / 1.2 )',
		},
		' .vxt-forms-radio-wrap input[type=radio] + label:before': {
			width: generateCSSUnit( toggleSizeMobileFallback, toggleSizeType ),
			height: generateCSSUnit( toggleSizeMobileFallback, toggleSizeType ),
		},
		' .vxt-forms-checkbox-wrap input[type=checkbox]:checked + label:before': {
			'font-size': 'calc(' + toggleSizeNumberMobile + 'px / 1.2 )',
		},
		' .vxt-forms-checkbox-wrap input[type=checkbox] + label:before': {
			width: generateCSSUnit( toggleSizeMobileFallback, 'px' ),
			height: generateCSSUnit( toggleSizeMobileFallback, 'px' ),
		},
		' .vxt-forms-accept-wrap input[type=checkbox]:checked + label:before': {
			'font-size': 'calc(' + toggleSizeNumberMobile + 'px / 1.2 )',
		},
		' .vxt-forms-accept-wrap input[type=checkbox] + label:before': {
			width: generateCSSUnit( toggleSizeMobileFallback, 'px' ),
			height: generateCSSUnit( toggleSizeMobileFallback, 'px' ),
		},
		' .vxt-forms-main-form .vxt-forms-field-set': {
			'margin-bottom': generateCSSUnit( fieldGapMobile, fieldGapType ),
		},
		' .vxt-switch': {
			height: `calc(${ toggleBorderTMobileFallback } + ${ toggleBorderBMobileFallback } + ${ generateCSSUnit(
				parseInt( 20 + toggleWidthSizeNumberMobile + ( 20 + toggleWidthSizeNumberMobile ) / 3 ),
				'px'
			) })`,
			width: `calc(${ toggleBorderLMobileFallback } + ${ toggleBorderRMobileFallback } + ${ generateCSSUnit(
				parseInt( ( 20 + toggleWidthSizeNumberMobile ) * 2.5 + ( 20 + toggleWidthSizeNumberMobile ) / 3 ),
				'px'
			) })`,
		},
		' .vxt-switch .vxt-slider:before': {
			height: generateCSSUnit( 20 + toggleWidthSizeNumberMobile, 'px' ),
			width: generateCSSUnit( 20 + toggleWidthSizeNumberMobile, 'px' ),
			top: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumberMobile ) / 6 ), 'px' ),
			bottom: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumberMobile ) / 6 ), 'px' ),
			left: generateCSSUnit( parseInt( ( 20 + toggleWidthSizeNumberMobile ) / 6 ), 'px' ),
			'background-color': toggleDotColor,
			'border-radius': `${ toggleBorderRadiusTLMobileFallback } ${ toggleBorderRadiusTRMobileFallback } ${ toggleBorderRadiusBRMobileFallback } ${ toggleBorderRadiusBLMobileFallback }`,
		},
		' .vxt-slider.round': {
			'border-radius': generateCSSUnit( 20 + toggleWidthSizeNumberMobile, 'px' ),
		},
		' .vxt-switch input:checked + .vxt-slider:before ': {
			transform: `translateX(${ generateCSSUnit(
				parseInt( ( 20 + toggleWidthSizeNumberMobile ) * 2.5 - ( 20 + toggleWidthSizeNumberMobile ) ),
				'px'
			) })`,
		},
		' .vxt-forms-main-form .vxt-forms-input-label': {
			'font-size': generateCSSUnit( labelFontSizeMobile, labelFontSizeType ),
			'line-height': generateCSSUnit( labelLineHeightMobile, labelLineHeightType ),
			'margin-bottom': generateCSSUnit( labelGapMobile, labelGapUnit ),
			'letter-spacing': generateCSSUnit( labelLetterSpacingMobile, labelLetterSpacingType ),
		},
		' .vxt-forms-main-form  .vxt-forms-input::placeholder': {
			'font-size': generateCSSUnit( inputFontSizeMobile, inputFontSizeType ),
			'line-height': generateCSSUnit( inputLineHeightMobile, inputLineHeightType ),
			'letter-spacing': generateCSSUnit( inputLetterSpacingMobile, inputLetterSpacingType ),
		},
		' .vxt-forms-input': {
			'text-align': overallAlignmentMobile,
		},
		' .vxt-forms-input-label': {
			display: displayLabels ? 'block' : 'none',
			'text-align': labelAlignmentMobile,
		},
		' .vxt-forms-main-form textarea': {
			'text-align': overallAlignmentMobile,
		},
	};

	if ( buttonAlignMobile !== 'full' ) {
		mobileSelectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap' ] = {
			'text-align': buttonAlignMobile,
		};
	} else {
		mobileSelectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap' ] = {
			display: 'grid',
		};
	}

	if ( 'boxed' === formStyle ) {
		selectors[ ' .vxt-forms-main-form  .vxt-forms-input' ] = {
			...inputBorder,
			'background-color': bgColor,
			color: inputColor,
			'padding-top': generateCSSUnit( paddingFieldTop, paddingFieldUnit ),
			'padding-bottom': generateCSSUnit( paddingFieldBottom, paddingFieldUnit ),
			'padding-left': generateCSSUnit( paddingFieldLeft, paddingFieldUnit ),
			'padding-right': generateCSSUnit( paddingFieldRight, paddingFieldUnit ),
		};
		tabletSelectors[ ' .vxt-forms-main-form  .vxt-forms-input' ] = {
			...inputBorderTablet,
			'padding-top': generateCSSUnit( paddingFieldTopTablet, paddingFieldUnitTablet ),
			'padding-bottom': generateCSSUnit( paddingFieldBottomTablet, paddingFieldUnitTablet ),
			'padding-left': generateCSSUnit( paddingFieldLeftTablet, paddingFieldUnitTablet ),
			'padding-right': generateCSSUnit( paddingFieldRightTablet, paddingFieldUnitTablet ),
		};
		mobileSelectors[ ' .vxt-forms-main-form  .vxt-forms-input' ] = {
			...inputBorderMobile,
			'padding-top': generateCSSUnit( paddingFieldTopMobile, paddingFieldUnitmobile ),
			'padding-bottom': generateCSSUnit( paddingFieldBottomMobile, paddingFieldUnitmobile ),
			'padding-left': generateCSSUnit( paddingFieldLeftMobile, paddingFieldUnitmobile ),
			'padding-right': generateCSSUnit( paddingFieldRightMobile, paddingFieldUnitmobile ),
		};
		selectors[ ' .vxt-forms-main-form .vxt-forms-checkbox-wrap input[type=checkbox] + label:before' ] =
			toggleBorder;
		selectors[ ' .vxt-forms-main-form .vxt-forms-accept-wrap input[type=checkbox] + label:before' ] = toggleBorder;
		selectors[ ' .vxt-forms-main-form .vxt-forms-radio-wrap input[type=radio] + label:before' ] = toggleBorder;
		selectors[ ' .vxt-slider ' ] = {
			...toggleBorder,
			'background-color': toggleColor,
		};

		mobileSelectors[ ' .vxt-forms-main-form .vxt-forms-checkbox-wrap input[type=checkbox] + label:before' ] =
			toggleBorderMobile;
		mobileSelectors[ ' .vxt-forms-main-form .vxt-forms-accept-wrap input[type=checkbox] + label:before' ] =
			toggleBorderMobile;
		mobileSelectors[ ' .vxt-forms-main-form .vxt-forms-radio-wrap input[type=radio] + label:before' ] =
			toggleBorderMobile;
		mobileSelectors[ ' .vxt-slider ' ] = toggleBorderMobile;

		tabletSelectors[ ' .vxt-forms-main-form .vxt-forms-checkbox-wrap input[type=checkbox] + label:before' ] =
			toggleBorderTablet;
		tabletSelectors[ ' .vxt-forms-main-form .vxt-forms-accept-wrap input[type=checkbox] + label:before' ] =
			toggleBorderTablet;
		tabletSelectors[ ' .vxt-forms-main-form .vxt-forms-radio-wrap input[type=radio] + label:before' ] =
			toggleBorderTablet;
		tabletSelectors[ ' .vxt-slider ' ] = toggleBorderTablet;
		// Label Hovev Colors
	} else if ( 'underlined' === formStyle ) {
		selectors[ '.vxt-forms__outer-wrap .vxt-forms-main-form  .vxt-forms-input' ] = {
			'border-top-width': '0px',
			'border-right-width': '0px',
			'border-left-width': '0px',
			'border-top': 0,
			'border-left': 0,
			'border-right': 0,
			outline: 0,
			'border-radius': 0,
			background: 'transparent',
			...inputBorder,
			color: inputColor,
			'padding-top': generateCSSUnit( paddingFieldTop, paddingFieldUnit ),
			'padding-bottom': generateCSSUnit( paddingFieldBottom, paddingFieldUnit ),
			'padding-left': generateCSSUnit( paddingFieldLeft, paddingFieldUnit ),
			'padding-right': generateCSSUnit( paddingFieldRight, paddingFieldUnit ),
		};
		selectors[ ' .vxt-forms-main-form .vxt-forms-input:focus' ] = {
			'border-top-width': 0,
			'border-right-width': 0,
			'border-left-width': 0,
			'box-shadow': 'unset',
		};
		tabletSelectors[ '.vxt-forms__outer-wrap .vxt-forms-main-form  .vxt-forms-input' ] = {
			'padding-top': generateCSSUnit( paddingFieldTopTablet, paddingFieldUnitTablet ),
			'padding-bottom': generateCSSUnit( paddingFieldBottomTablet, paddingFieldUnitTablet ),
			'padding-left': generateCSSUnit( paddingFieldLeftTablet, paddingFieldUnitTablet ),
			'padding-right': generateCSSUnit( paddingFieldRightTablet, paddingFieldUnitTablet ),
			...inputBorderTablet,
		};
		mobileSelectors[ '.vxt-forms__outer-wrap .vxt-forms-main-form  .vxt-forms-input' ] = {
			'padding-top': generateCSSUnit( paddingFieldTopMobile, paddingFieldUnitmobile ),
			'padding-bottom': generateCSSUnit( paddingFieldBottomMobile, paddingFieldUnitmobile ),
			'padding-left': generateCSSUnit( paddingFieldLeftMobile, paddingFieldUnitmobile ),
			'padding-right': generateCSSUnit( paddingFieldRightMobile, paddingFieldUnitmobile ),
			...inputBorderMobile,
		};
		selectors[ ' .vxt-forms-main-form .vxt-forms-checkbox-wrap input[type=checkbox] + label:before' ] = {
			'border-bottom':
				generateCSSUnit( checkBoxToggleBorderBottomWidth, 'px' ) +
				' ' +
				checkBoxToggleBorderStyle +
				' ' +
				checkBoxToggleBorderColor,
		};
		selectors[ ' .vxt-forms-main-form .vxt-forms-accept-wrap input[type=checkbox] + label:before' ] = {
			'border-bottom':
				generateCSSUnit( checkBoxToggleBorderBottomWidth, 'px' ) +
				' ' +
				checkBoxToggleBorderStyle +
				' ' +
				checkBoxToggleBorderColor,
		};
		selectors[ ' .vxt-forms-main-form .vxt-forms-radio-wrap input[type=radio] + label:before' ] = {
			'border-bottom':
				generateCSSUnit( checkBoxToggleBorderBottomWidth, 'px' ) +
				' ' +
				checkBoxToggleBorderStyle +
				' ' +
				checkBoxToggleBorderColor,
		};
		selectors[ ' .vxt-slider ' ] = {
			'background-color': toggleColor,
			'border-bottom':
				generateCSSUnit( checkBoxToggleBorderBottomWidth, 'px' ) +
				' ' +
				checkBoxToggleBorderStyle +
				' ' +
				checkBoxToggleBorderColor,
		};
	}

	if ( ! inheritFromTheme ) {
		if ( 'color' === submitBgType ) {
			selectors[
				' .vxt-forms-main-form  .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button.wp-block-button__link'
			] = {
				'background-color': submitBgColor,
			};
		} else if ( 'gradient' === submitBgType ) {
			const backgroundAttributes = {
				backgroundType: 'gradient',
				gradientValue: gradientValue,
				gradientColor1: gradientColor1,
				gradientColor2: gradientColor2,
				gradientLocation1: gradientLocation1,
				gradientLocation2: gradientLocation2,
				gradientType: gradientType,
				gradientAngle: gradientAngle,
				selectGradient: selectGradient,
			};

			const backgroundAttributesTablet = {
				backgroundType: 'gradient',
				gradientValue: gradientValue,
				gradientColor1: gradientColor1,
				gradientColor2: gradientColor2,
				gradientLocation1:
					'number' === typeof gradientLocationTablet1
						? gradientLocationTablet1
						: backgroundAttributes.gradientLocation1,
				gradientLocation2:
					'number' === typeof gradientLocationTablet2
						? gradientLocationTablet2
						: backgroundAttributes.gradientLocation2,
				gradientType: gradientType,
				gradientAngle:
					'number' === typeof gradientAngleTablet ? gradientAngleTablet : backgroundAttributes.gradientAngle,
				selectGradient: selectGradient,
			};

			const backgroundAttributesMobile = {
				backgroundType: 'gradient',
				gradientValue: gradientValue,
				gradientColor1: gradientColor1,
				gradientColor2: gradientColor2,
				gradientLocation1:
					'number' === typeof gradientLocationMobile1
						? gradientLocationMobile1
						: backgroundAttributesTablet.gradientLocation1,
				gradientLocation2:
					'number' === typeof gradientLocationMobile2
						? gradientLocationMobile2
						: backgroundAttributesTablet.gradientLocation2,
				gradientType: gradientType,
				gradientAngle:
					'number' === typeof gradientAngleMobile
						? gradientAngleMobile
						: backgroundAttributesTablet.gradientAngle,
				selectGradient: selectGradient,
			};

			const btnBackground = generateBackgroundCSS( backgroundAttributes );
			const btnBackgroundTablet = generateBackgroundCSS( backgroundAttributesTablet );
			const btnBackgroundMobile = generateBackgroundCSS( backgroundAttributesMobile );

			selectors[
				' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button.wp-block-button__link'
			] = btnBackground;
			tabletSelectors[
				' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button.wp-block-button__link'
			] = btnBackgroundTablet;
			mobileSelectors[
				' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button.wp-block-button__link'
			] = btnBackgroundMobile;
		} else if ( 'transparent' === submitBgType ) {
			selectors[
				' .vxt-forms-main-form  .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button.wp-block-button__link'
			] = {
				background: 'transparent',
			};
		}
		//Hover
		if ( 'color' === submitBgHoverType ) {
			selectors[
				' .vxt-forms-main-form  .vxt-forms-main-submit-button-wrap:hover .vxt-forms-main-submit-button.wp-block-button__link'
			] = {
				background: submitBgColorHover,
			};
		} else if ( 'gradient' === submitBgHoverType ) {
			const hoverbackgroundAttributes = {
				backgroundType: 'gradient',
				gradientValue: gradientHValue,
				gradientColor1: gradientHColor1,
				gradientColor2: gradientHColor2,
				gradientLocation1: gradientHLocation1,
				gradientLocation2: gradientHLocation2,
				gradientType: gradientHType,
				gradientAngle: gradientHAngle,
				selectGradient: selectHGradient,
			};

			const hoverbackgroundAttributesTablet = {
				backgroundType: 'gradient',
				gradientValue: gradientHValue,
				gradientColor1: gradientHColor1,
				gradientColor2: gradientHColor2,
				gradientLocation1:
					'number' === typeof gradientHLocationTablet1
						? gradientHLocationTablet1
						: hoverbackgroundAttributes.gradientLocation1,
				gradientLocation2:
					'number' === typeof gradientHLocationTablet2
						? gradientHLocationTablet2
						: hoverbackgroundAttributes.gradientLocation2,
				gradientType: gradientHType,
				gradientAngle:
					'number' === typeof gradientHAngleTablet
						? gradientHAngleTablet
						: hoverbackgroundAttributes.gradientAngle,
				selectGradient: selectHGradient,
			};

			const hoverbackgroundAttributesMobile = {
				backgroundType: 'gradient',
				gradientValue: gradientHValue,
				gradientColor1: gradientHColor1,
				gradientColor2: gradientHColor2,
				gradientLocation1:
					'number' === typeof gradientHLocationMobile1
						? gradientHLocationMobile1
						: hoverbackgroundAttributesTablet.gradientLocation1,
				gradientLocation2:
					'number' === typeof gradientHLocationMobile2
						? gradientHLocationMobile2
						: hoverbackgroundAttributesTablet.gradientLocation2,
				gradientType: gradientHType,
				gradientAngle:
					'number' === typeof gradientHAngleMobile
						? gradientHAngleMobile
						: hoverbackgroundAttributesTablet.gradientAngle,
				selectGradient: selectHGradient,
			};

			const btnhBackground = generateBackgroundCSS( hoverbackgroundAttributes );
			const btnhBackgroundTablet = generateBackgroundCSS( hoverbackgroundAttributesTablet );
			const btnhBackgroundMobile = generateBackgroundCSS( hoverbackgroundAttributesMobile );

			selectors[
				' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap:hover .vxt-forms-main-submit-button.wp-block-button__link'
			] = btnhBackground;
			tabletSelectors[
				' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap:hover .vxt-forms-main-submit-button.wp-block-button__link'
			] = btnhBackgroundTablet;
			mobileSelectors[
				' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap:hover .vxt-forms-main-submit-button.wp-block-button__link'
			] = btnhBackgroundMobile;
		} else if ( 'transparent' === submitBgHoverType ) {
			selectors[
				' .vxt-forms-main-form  .vxt-forms-main-submit-button-wrap:hover .vxt-forms-main-submit-button.wp-block-button__link'
			] = {
				background: 'transparent',
			};
		}
		selectors[ '.vxt-forms__small-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button' ] = {
			padding: '5px 10px',
		};
		selectors[ '.vxt-forms__medium-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button' ] = {
			padding: '12px 24px',
		};
		selectors[ '.vxt-forms__large-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button' ] = {
			padding: '20px 30px',
		};
		selectors[ '.vxt-forms__extralarge-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button' ] = {
			padding: '30px 65px',
		};
		selectors[ '.vxt-forms__full-btn .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button' ] = {
			width: '100%',
			padding: '10px 15px',
		};
		selectors[
			' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link:not(.has-background)'
		] = {
			color: submitColor,
			'font-size': generateCSSUnit( submitTextFontSize, submitTextFontSizeType ),
			'line-height': generateCSSUnit( submitTextLineHeight, submitTextLineHeightType ),
			'font-family': submitTextFontFamily,
			'font-style': submitTextFontStyle,
			'text-transform': submitTextTransform,
			'text-decoration': submitTextDecoration,
			'font-weight': submitTextFontWeight,
			...submitBorder,
			'padding-top': generateCSSUnit( paddingBtnTop, paddingBtnUnit ),
			'padding-bottom': generateCSSUnit( paddingBtnBottom, paddingBtnUnit ),
			'padding-left': generateCSSUnit( paddingBtnLeft, paddingBtnUnit ),
			'padding-right': generateCSSUnit( paddingBtnRight, paddingBtnUnit ),
		};
		selectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button' ] = {
			color: submitColor,
			'font-size': generateCSSUnit( submitTextFontSize, submitTextFontSizeType ),
			'line-height': generateCSSUnit( submitTextLineHeight, submitTextLineHeightType ),
			'font-family': submitTextFontFamily,
			'font-style': submitTextFontStyle,
			'text-transform': submitTextTransform,
			'text-decoration': submitTextDecoration,
			'font-weight': submitTextFontWeight,
			...submitBorder,
			'padding-top': generateCSSUnit( paddingBtnTop, paddingBtnUnit ),
			'padding-bottom': generateCSSUnit( paddingBtnBottom, paddingBtnUnit ),
			'padding-left': generateCSSUnit( paddingBtnLeft, paddingBtnUnit ),
			'padding-right': generateCSSUnit( paddingBtnRight, paddingBtnUnit ),
			'letter-spacing': generateCSSUnit( submitTextLetterSpacing, submitTextLetterSpacingType ),
		};
		selectors[
			' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link:not(.has-background):hover'
		] = {
			color: submitColorHover,
			'border-color': btnBorderHColor,
		};
		selectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button:hover' ] = {
			color: submitColorHover,
			'border-color': btnBorderHColor,
		};
		tabletSelectors[
			' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link:not(.has-background)'
		] = submitBorderTablet;
		tabletSelectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button' ] = {
			'padding-top': generateCSSUnit( paddingBtnTopTablet, tabletPaddingBtnUnit ),
			'padding-bottom': generateCSSUnit( paddingBtnBottomTablet, tabletPaddingBtnUnit ),
			'padding-left': generateCSSUnit( paddingBtnLeftTablet, tabletPaddingBtnUnit ),
			'padding-right': generateCSSUnit( paddingBtnRightTablet, tabletPaddingBtnUnit ),
			'font-size': generateCSSUnit( submitTextFontSizeTablet, submitTextFontSizeType ),
			'line-height': generateCSSUnit( submitTextLineHeightTablet, submitTextLineHeightType ),
			'letter-spacing': generateCSSUnit( submitTextLetterSpacingTablet, submitTextLetterSpacingType ),
			...submitBorderTablet,
		};
		mobileSelectors[
			' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap.wp-block-button:not(.is-style-outline) .vxt-forms-main-submit-button.wp-block-button__link:not(.has-background)'
		] = submitBorderMobile;
		mobileSelectors[ ' .vxt-forms-main-form .vxt-forms-main-submit-button-wrap .vxt-forms-main-submit-button' ] = {
			'padding-top': generateCSSUnit( paddingBtnTopMobile, mobilePaddingBtnUnit ),
			'padding-bottom': generateCSSUnit( paddingBtnBottomMobile, mobilePaddingBtnUnit ),
			'padding-left': generateCSSUnit( paddingBtnLeftMobile, mobilePaddingBtnUnit ),
			'padding-right': generateCSSUnit( paddingBtnRightMobile, mobilePaddingBtnUnit ),
			'font-size': generateCSSUnit( submitTextFontSizeMobile, submitTextFontSizeType ),
			'line-height': generateCSSUnit( submitTextLineHeightMobile, submitTextLineHeightType ),
			...submitBorderMobile,
			'letter-spacing': generateCSSUnit( submitTextLetterSpacingMobile, submitTextLetterSpacingType ),
		};
	}

	let stylingCss = '';
	const base_selector = `.editor-styles-wrapper .vxt-block-${ block_id }`;
	stylingCss = generateCSS( selectors, base_selector );

	if ( 'tablet' === previewType || 'mobile' === previewType ) {
		stylingCss += generateCSS( tabletSelectors, `${ base_selector }`, true, 'tablet' );

		if ( 'mobile' === previewType ) {
			stylingCss += generateCSS( mobileSelectors, `${ base_selector }`, true, 'mobile' );
		}
	}
	return stylingCss;
}

export default styling;
