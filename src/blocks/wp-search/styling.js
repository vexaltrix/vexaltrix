/**
 * Returns Dynamic Generated CSS
 */
import generateBorderCSS from '@Controls/generateBorderCSS';

import generateCSS from '@Controls/generateCSS';
import generateCSSUnit from '@Controls/generateCSSUnit';
import { getFallbackNumber } from '@Controls/getAttributeFallback';

function styling( attributes, name, deviceType ) {
	const blockName = name.replace( 'vexaltrix/', '' );
	const previewType = deviceType.toLowerCase();
	const {
		block_id,
		layout,
		inputSize,
		textColor,
		inputBgColor,
		boxShadowColor,
		boxShadowHOffset,
		boxShadowVOffset,
		boxShadowBlur,
		boxShadowSpread,
		boxShadowPosition,

		inputBorderHColor,

		buttonBgColor,
		buttonBgHoverColor,
		buttonIconColor,
		buttonIconHoverColor,
		buttonWidth,
		buttonIconSize,
		iconColor,
		iconSize,
		inputFontFamily,
		inputFontWeight,
		inputFontSize,
		inputFontSizeType,
		inputFontSizeTablet,
		inputFontSizeMobile,
		inputLineHeight,
		inputLineHeightType,
		inputLineHeightTablet,
		inputLineHeightMobile,
		inputPaddingTypeDesktop,
		buttonFontFamily,
		buttonFontWeight,
		buttonFontSize,
		buttonFontSizeType,
		buttonFontSizeTablet,
		buttonFontSizeMobile,
		buttonLineHeight,
		buttonLineHeightType,
		buttonLineHeightTablet,
		buttonLineHeightMobile,
		buttonTextColor,
		buttonTextHoverColor,
		inputSizeType,
		paddingInputTop,
		paddingInputRight,
		paddingInputBottom,
		paddingInputLeft,
		paddingInputTopTablet,
		paddingInputBottomTablet,
		paddingInputRightTablet,
		paddingInputLeftTablet,
		paddingInputTopMobile,
		paddingInputRightMobile,
		paddingInputBottomMobile,
		paddingInputLeftMobile,
		mobilePaddingInputUnit,
		tabletPaddingInputUnit,
		iconSizeType,
		inputTransform,
		inputDecoration,
		buttonTransform,
		buttonDecoration,
		buttonIconSizeType,
		buttonWidthType,
		inputFontStyle,
		buttonFontStyle,
	} = attributes;

	const inputSizeFallback = getFallbackNumber( inputSize, 'inputSize', blockName );
	const buttonWidthFallback = getFallbackNumber( buttonWidth, 'buttonWidth', blockName );
	const buttonIconSizeFallback = getFallbackNumber( buttonIconSize, 'buttonIconSize', blockName );
	const iconSizeFallback = getFallbackNumber( iconSize, 'iconSize', blockName );

	let boxShadowPositionCSS = boxShadowPosition;

	if ( 'outset' === boxShadowPosition ) {
		boxShadowPositionCSS = '';
	}

	let selectors = {};
	let tabletSelectors = {};
	let mobileSelectors = {};

	const $iconSize = generateCSSUnit( iconSizeFallback, iconSizeType );
	const $buttonIconSize = generateCSSUnit( buttonIconSizeFallback, buttonIconSizeType );

	const inputBorderCSS = generateBorderCSS( attributes, 'input' );
	const inputBorderCSSTablet = generateBorderCSS( attributes, 'input', 'tablet' );
	const inputBorderCSSMobile = generateBorderCSS( attributes, 'input', 'mobile' );

	const inputCSS = {
		color: textColor,
		'background-color': inputBgColor,
		'font-size': generateCSSUnit( inputFontSize, inputFontSizeType ),
		'line-height': generateCSSUnit( inputLineHeight, inputLineHeightType ),
		'font-family': inputFontFamily,
		'font-style': inputFontStyle,
		'font-weight': inputFontWeight,
		'text-decoration': inputDecoration,
		'text-transform': inputTransform,
		border: 0,
		'border-radius': '0px',
		margin: 0,
		outline: 'unset',
		'padding-top': generateCSSUnit( paddingInputTop, inputPaddingTypeDesktop ),
		'padding-bottom': generateCSSUnit( paddingInputBottom, inputPaddingTypeDesktop ),
		'padding-right': generateCSSUnit( paddingInputRight, inputPaddingTypeDesktop ),
		'padding-left': generateCSSUnit( paddingInputLeft, inputPaddingTypeDesktop ),
		transition: 'all .5s',
	};

	const boxCSS = {
		...inputBorderCSS,
		outline: 'unset',
		'box-shadow':
			generateCSSUnit( boxShadowHOffset, 'px' ) +
			' ' +
			generateCSSUnit( boxShadowVOffset, 'px' ) +
			' ' +
			generateCSSUnit( boxShadowBlur, 'px' ) +
			' ' +
			generateCSSUnit( boxShadowSpread, 'px' ) +
			' ' +
			boxShadowColor +
			' ' +
			boxShadowPositionCSS,
	};

	let tmpIconColor = textColor;

	if ( 'undefined' !== typeof iconColor && '' !== iconColor ) {
		tmpIconColor = iconColor;
	}

	boxCSS.width = generateCSSUnit( inputSizeFallback, inputSizeType );

	selectors = {
		' .vxt-search-form__container .vxt-search-submit': {
			width: generateCSSUnit( buttonWidthFallback, buttonWidthType ),
			padding: 0,
			border: 0,
		},
		' .vxt-search-form__container .vxt-search-form__input::placeholder': {
			color: textColor,
			opacity: 0.6,
		},
		' .vxt-search-form__container .vxt-search-submit .vxt-wp-search-button-icon-wrap svg': {
			width: $buttonIconSize,
			height: $buttonIconSize,
			'font-size': $buttonIconSize,
			fill: buttonIconColor,
		},
		' .vxt-search-form__container .vxt-search-submit .vxt-wp-search-button-text': {
			'font-size': generateCSSUnit( buttonFontSize, buttonFontSizeType ),
			'line-height': generateCSSUnit( buttonLineHeight, buttonLineHeightType ),
			'font-family': buttonFontFamily,
			'font-style': buttonFontStyle,
			'font-weight': buttonFontWeight,
			'text-decoration': buttonDecoration,
			'text-transform': buttonTransform,
			color: buttonTextColor,
		},
		' .vxt-search-form__container .vxt-search-submit:hover .vxt-wp-search-button-text': {
			color: buttonTextHoverColor,
		},
		' .vxt-search-form__container .vxt-search-submit:hover .vxt-wp-search-button-icon-wrap svg': {
			fill: buttonIconHoverColor,
		},
		'.vxt-layout-input .vxt-wp-search-icon-wrap svg': {
			width: $iconSize,
			height: $iconSize,
			'font-size': $iconSize,
			fill: tmpIconColor,
		},
	};

	if ( 'input-button' === layout || 'input' === layout ) {
		selectors[ ' .vxt-search-form__container .vxt-search-form__input' ] = inputCSS;

		selectors[ ' .vxt-search-wrapper .vxt-search-form__container' ] = boxCSS;
		selectors[ ' .vxt-search-wrapper .vxt-search-form__container:hover' ] = {
			'border-color': inputBorderHColor,
		};
		if ( 'inset' === boxShadowPosition ) {
			selectors[ ' .vxt-search-wrapper .vxt-search-form__input' ] = {
				'box-shadow':
					generateCSSUnit( boxShadowHOffset, 'px' ) +
					' ' +
					generateCSSUnit( boxShadowVOffset, 'px' ) +
					' ' +
					generateCSSUnit( boxShadowBlur, 'px' ) +
					' ' +
					generateCSSUnit( boxShadowSpread, 'px' ) +
					' ' +
					boxShadowColor +
					' ' +
					boxShadowPositionCSS,
			};
		}

		selectors[ ' .vxt-search-form__container .vxt-wp-search-icon-wrap' ] = {
			'background-color': inputBgColor,
			'padding-top': generateCSSUnit( paddingInputTop, inputPaddingTypeDesktop ),
			'padding-bottom': generateCSSUnit( paddingInputBottom, inputPaddingTypeDesktop ),
			'padding-left': generateCSSUnit( paddingInputLeft, inputPaddingTypeDesktop ),
		};
	}

	selectors[ '.vxt-layout-input-button .vxt-search-form__container .vxt-search-submit' ] = {
		'background-color': buttonBgColor,
	};
	selectors[ '.vxt-layout-input-button .vxt-search-form__container .vxt-search-submit:hover' ] = {
		'background-color': buttonBgHoverColor,
	};

	mobileSelectors = {
		' .vxt-search-wrapper .vxt-search-form__container': inputBorderCSSMobile,
		' .vxt-search-wrapper .vxt-search-form__container .vxt-search-form__input': {
			'font-size': generateCSSUnit( inputFontSizeMobile, inputFontSizeType ),
			'line-height': generateCSSUnit( inputLineHeightMobile, inputLineHeightType ),
			'padding-top': generateCSSUnit( paddingInputTopMobile, mobilePaddingInputUnit ),
			'padding-bottom': generateCSSUnit( paddingInputBottomMobile, mobilePaddingInputUnit ),
			'padding-right': generateCSSUnit( paddingInputRightMobile, mobilePaddingInputUnit ),
			'padding-left': generateCSSUnit( paddingInputLeftMobile, mobilePaddingInputUnit ),
		},
		' .vxt-search-form__container .vxt-wp-search-icon-wrap': {
			'padding-top': generateCSSUnit( paddingInputTopMobile, mobilePaddingInputUnit ),
			'padding-bottom': generateCSSUnit( paddingInputBottomMobile, mobilePaddingInputUnit ),
			'padding-left': generateCSSUnit( paddingInputLeftMobile, mobilePaddingInputUnit ),
		},
		' .vxt-search-wrapper .vxt-search-form__container .vxt-search-submit .vxt-wp-search-button-text': {
			'font-size': generateCSSUnit( buttonFontSizeMobile, buttonFontSizeType ),
			'line-height': generateCSSUnit( buttonLineHeightMobile, buttonLineHeightType ),
		},
	};

	tabletSelectors = {
		' .vxt-search-wrapper .vxt-search-form__container': inputBorderCSSTablet,
		' .vxt-search-wrapper .vxt-search-form__container .vxt-search-form__input': {
			'font-size': generateCSSUnit( inputFontSizeTablet, inputFontSizeType ),
			'line-height': generateCSSUnit( inputLineHeightTablet, inputLineHeightType ),
			'padding-top': generateCSSUnit( paddingInputTopTablet, tabletPaddingInputUnit ),
			'padding-bottom': generateCSSUnit( paddingInputBottomTablet, tabletPaddingInputUnit ),
			'padding-right': generateCSSUnit( paddingInputRightTablet, tabletPaddingInputUnit ),
			'padding-left': generateCSSUnit( paddingInputLeftTablet, tabletPaddingInputUnit ),
		},
		' .vxt-search-form__container .vxt-wp-search-icon-wrap': {
			'padding-top': generateCSSUnit( paddingInputTopTablet, tabletPaddingInputUnit ),
			'padding-bottom': generateCSSUnit( paddingInputBottomTablet, tabletPaddingInputUnit ),
			'padding-left': generateCSSUnit( paddingInputLeftTablet, tabletPaddingInputUnit ),
		},
		' .vxt-search-wrapper .vxt-search-form__container .vxt-search-submit .vxt-wp-search-button-text': {
			'font-size': generateCSSUnit( buttonFontSizeTablet, buttonFontSizeType ),
			'line-height': generateCSSUnit( buttonLineHeightTablet, buttonLineHeightType ),
		},
	};
	let stylingCss = '';
	const id = `.vxt-block-${ block_id }`;

	stylingCss = generateCSS( selectors, id );

	if ( 'tablet' === previewType || 'mobile' === previewType ) {
		stylingCss += generateCSS( tabletSelectors, `${ id }`, true, 'tablet' );

		if ( 'mobile' === previewType ) {
			stylingCss += generateCSS( mobileSelectors, `${ id }`, true, 'mobile' );
		}
	}
	return stylingCss;
}

export default styling;
