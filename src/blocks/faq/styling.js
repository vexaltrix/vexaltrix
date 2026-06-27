/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from '@Controls/generateCSS';
import generateCSSUnit from '@Controls/generateCSSUnit';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import generateBorderCSS from '@Controls/generateBorderCSS';

function styling( attributes, clientId, name, deviceType ) {
	const blockName = name.replace( 'vexaltrix/', '' );
	const previewType = deviceType.toLowerCase();
	const {
		block_id,
		layout,
		inactiveOtherItems,
		expandFirstItem,
		rowsGap,
		rowsGapTablet,
		rowsGapMobile,
		rowsGapUnit,
		columnsGapUnit,
		columnsGap,
		columnsGapTablet,
		columnsGapMobile,
		align,
		enableSeparator,
		boxBgType,
		boxBgHoverType,
		boxBgColor,
		boxBgHoverColor,
		overallBorderHColor,
		overallBorderColor,
		overallBorderTopWidth,
		questionTextColor,
		questionTextBgColor,
		questionTextActiveColor,
		questionTextActiveBgColor,
		questionPaddingTypeDesktop,
		questionPaddingTypeMobile,
		questionPaddingTypeTablet,
		vquestionPaddingMobile,
		vquestionPaddingTablet,
		vquestionPaddingDesktop,
		hquestionPaddingMobile,
		hquestionPaddingTablet,
		hquestionPaddingDesktop,
		answerTextColor,
		answerPaddingTypeDesktop,
		answerPaddingTypeMobile,
		answerPaddingTypeTablet,
		answerTopPadding,
		answerBottomPadding,
		answerRightPadding,
		answerLeftPadding,
		answerTopPaddingTablet,
		answerBottomPaddingTablet,
		answerRightPaddingTablet,
		answerLeftPaddingTablet,
		answerTopPaddingMobile,
		answerBottomPaddingMobile,
		answerRightPaddingMobile,
		answerLeftPaddingMobile,
		iconColor,
		iconActiveColor,
		gapBtwIconQUestion,
		gapBtwIconQUestionTablet,
		gapBtwIconQUestionMobile,
		questionFontFamily,
		questionFontWeight,
		questionFontSizeType,
		questionFontSize,
		questionFontSizeMobile,
		questionFontSizeTablet,
		questionLineHeightType,
		questionLineHeight,
		questionLineHeightMobile,
		questionLineHeightTablet,
		answerFontFamily,
		answerFontWeight,
		answerFontSizeType,
		answerFontSize,
		answerFontSizeMobile,
		answerFontSizeTablet,
		answerLineHeightType,
		answerLineHeight,
		answerLineHeightMobile,
		answerLineHeightTablet,
		iconAlign,
		iconSize,
		iconSizeType,
		iconSizeMobile,
		iconSizeTablet,
		columns,
		tcolumns,
		mcolumns,
		questionLeftPaddingTablet,
		questionBottomPaddingTablet,
		questionLeftPaddingDesktop,
		questionBottomPaddingDesktop,
		questionLeftPaddingMobile,
		questionBottomPaddingMobile,
		answerFontStyle,
		answerTransform,
		answerDecoration,
		questionFontStyle,
		questionTransform,
		questionDecoration,
		// letter spacing
		questionLetterSpacing,
		questionLetterSpacingTablet,
		questionLetterSpacingMobile,
		questionLetterSpacingType,
		answerLetterSpacing,
		answerLetterSpacingTablet,
		answerLetterSpacingMobile,
		answerLetterSpacingType,
		iconBgColor,
		iconBgSize,
		iconBgSizeTablet,
		iconBgSizeMobile,
		iconBgSizeType,
		iconBorderHColor,
		// padding
		blockTopPadding,
		blockRightPadding,
		blockLeftPadding,
		blockBottomPadding,
		blockTopPaddingTablet,
		blockRightPaddingTablet,
		blockLeftPaddingTablet,
		blockBottomPaddingTablet,
		blockTopPaddingMobile,
		blockRightPaddingMobile,
		blockLeftPaddingMobile,
		blockBottomPaddingMobile,
		blockPaddingUnit,
		blockPaddingUnitTablet,
		blockPaddingUnitMobile,
		// margin
		blockTopMargin,
		blockRightMargin,
		blockLeftMargin,
		blockBottomMargin,
		blockTopMarginTablet,
		blockRightMarginTablet,
		blockLeftMarginTablet,
		blockBottomMarginTablet,
		blockTopMarginMobile,
		blockRightMarginMobile,
		blockLeftMarginMobile,
		blockBottomMarginMobile,
		blockMarginUnit,
		blockMarginUnitTablet,
		blockMarginUnitMobile,
	} = attributes;

	const borderCSS = generateBorderCSS( attributes, 'overall', '' );
	const borderCSSTablet = generateBorderCSS( attributes, 'overall', 'tablet' );
	const borderCSSMobile = generateBorderCSS( attributes, 'overall', 'mobile' );

	const iconBorderCSS = generateBorderCSS( attributes, 'icon', '' );
	const iconBorderCSSTablet = generateBorderCSS( attributes, 'icon', 'tablet' );
	const iconBorderCSSMobile = generateBorderCSS( attributes, 'icon', 'mobile' );

	let selectors = {};
	let tabletSelectors = {};
	let mobileSelectors = {};
	let iconColorTemp = iconColor;
	let iconActiveColorTemp = iconActiveColor;

	if ( 'undefined' === typeof iconColor || '' === iconColor ) {
		iconColorTemp = questionTextColor;
	}
	if ( 'undefined' === typeof iconActiveColor || '' === iconActiveColor ) {
		iconActiveColorTemp = questionTextActiveColor;
	}

	selectors = {
		' .vxt-icon svg': {
			width: generateCSSUnit( getFallbackNumber( iconSize, 'iconSize', blockName ), iconSizeType ),
			height: generateCSSUnit( getFallbackNumber( iconSize, 'iconSize', blockName ), iconSizeType ),
			'font-size': generateCSSUnit( getFallbackNumber( iconSize, 'iconSize', blockName ), iconSizeType ),
			fill: iconColorTemp,
		},
		' .vxt-icon-active svg': {
			width: generateCSSUnit( getFallbackNumber( iconSize, 'iconSize', blockName ), iconSizeType ),
			height: generateCSSUnit( getFallbackNumber( iconSize, 'iconSize', blockName ), iconSizeType ),
			'font-size': generateCSSUnit( getFallbackNumber( iconSize, 'iconSize', blockName ), iconSizeType ),
			fill: iconActiveColorTemp,
		},
		' .vxt-faq-child__outer-wrap': {
			'margin-bottom': generateCSSUnit( getFallbackNumber( rowsGap, 'rowsGap', blockName ), rowsGapUnit ),
		},
		'.vxt-faq-layout-grid .block-editor-inner-blocks .block-editor-block-list__layout': {
			'grid-column-gap': generateCSSUnit(
				getFallbackNumber( columnsGap, 'columnsGap', blockName ),
				columnsGapUnit
			),
			'grid-row-gap': generateCSSUnit( getFallbackNumber( rowsGap, 'rowsGap', blockName ), rowsGapUnit ),
		},
		' .vxt-faq-item': {
			'background-color': boxBgType === 'color' ? boxBgColor : 'transparent',
			...borderCSS,
		},
		' .vxt-faq-item:hover': {
			'background-color': boxBgHoverType === 'color' ? boxBgHoverColor : 'transparent',
			'border-color': overallBorderHColor,
		},
		' .vxt-faq-item .vxt-question': {
			color: questionTextColor,
		},
		' .vxt-faq-item.vxt-faq-item-active .vxt-question': {
			color: questionTextActiveColor,
		},
		' .vxt-faq-item:hover .vxt-question': {
			color: questionTextActiveColor,
		},
		' .vxt-faq-item.vxt-faq-item-active .vxt-faq-questions-button': {
			'background-color': questionTextActiveBgColor,
		},
		' .vxt-faq-item:hover .vxt-faq-questions-button': {
			'background-color': questionTextActiveBgColor,
		},
		' .vxt-faq-questions-button': {
			'padding-top': generateCSSUnit( vquestionPaddingDesktop, questionPaddingTypeDesktop ),
			'padding-bottom': generateCSSUnit( questionBottomPaddingDesktop, questionPaddingTypeDesktop ),
			'padding-right': generateCSSUnit( hquestionPaddingDesktop, questionPaddingTypeDesktop ),
			'padding-left': generateCSSUnit( questionLeftPaddingDesktop, questionPaddingTypeDesktop ),
			'background-color': questionTextBgColor,
		},
		' .vxt-faq-content': {
			'padding-top': generateCSSUnit( answerTopPadding, answerPaddingTypeDesktop ),
			'padding-bottom': generateCSSUnit( answerBottomPadding, answerPaddingTypeDesktop ),
			'padding-right': generateCSSUnit( answerRightPadding, answerPaddingTypeDesktop ),
			'padding-left': generateCSSUnit( answerLeftPadding, answerPaddingTypeDesktop ),
		},
		'.vxt-faq-icon-row .vxt-faq-item .vxt-faq-icon-wrap': {
			'margin-right': generateCSSUnit(
				getFallbackNumber( gapBtwIconQUestion, 'gapBtwIconQUestion', blockName ),
				'px'
			),
		},
		'.vxt-faq-icon-row-reverse .vxt-faq-item .vxt-faq-icon-wrap': {
			'margin-left': generateCSSUnit(
				getFallbackNumber( gapBtwIconQUestion, 'gapBtwIconQUestion', blockName ),
				'px'
			),
		},
		' .vxt-faq-item .vxt-faq-icon-wrap': {
			'background-color': iconBgColor,
			padding: generateCSSUnit( iconBgSize, iconBgSizeType ),
			...iconBorderCSS,
		},
		' .vxt-faq-item .vxt-faq-icon-wrap:hover': {
			'border-color': iconBorderHColor,
		},
		' .vxt-faq-item:hover .vxt-icon svg': {
			fill: iconActiveColorTemp,
		},
		' .vxt-faq-item .vxt-faq-questions-button.vxt-faq-questions': {
			'flex-direction': iconAlign,
		},
		' .vxt-faq-questions-button .vxt-question': {
			'font-size': generateCSSUnit( questionFontSize, questionFontSizeType ),
			'line-height': generateCSSUnit( questionLineHeight, questionLineHeightType ),
			'font-family': questionFontFamily,
			'font-style': questionFontStyle,
			'text-decoration': questionDecoration,
			'text-transform': questionTransform,
			'font-weight': questionFontWeight,
			'letter-spacing': generateCSSUnit( questionLetterSpacing, questionLetterSpacingType ),
		},
		' .vxt-faq-item .vxt-faq-content': {
			'font-size': generateCSSUnit( answerFontSize, answerFontSizeType ),
			'line-height': generateCSSUnit( answerLineHeight, answerLineHeightType ),
			'font-family': answerFontFamily,
			'font-style': answerFontStyle,
			'text-decoration': answerDecoration,
			'text-transform': answerTransform,
			'font-weight': answerFontWeight,
			color: answerTextColor,
			'letter-spacing': generateCSSUnit( answerLetterSpacing, answerLetterSpacingType ),
		},
		'.vxt-faq__outer-wrap': {
			'margin-top': generateCSSUnit( blockTopMargin, blockMarginUnit ),
			'margin-right': generateCSSUnit( blockRightMargin, blockMarginUnit ),
			'margin-bottom': generateCSSUnit( blockBottomMargin, blockMarginUnit ),
			'margin-left': generateCSSUnit( blockLeftMargin, blockMarginUnit ),
			'padding-top': generateCSSUnit( blockTopPadding, blockPaddingUnit ),
			'padding-right': generateCSSUnit( blockRightPadding, blockPaddingUnit ),
			'padding-bottom': generateCSSUnit( blockBottomPadding, blockPaddingUnit ),
			'padding-left': generateCSSUnit( blockLeftPadding, blockPaddingUnit ),
		},
	};

	tabletSelectors = {
		' .vxt-faq-questions-button': {
			'padding-top': generateCSSUnit( vquestionPaddingTablet, questionPaddingTypeTablet ),
			'padding-bottom': generateCSSUnit( questionBottomPaddingTablet, questionPaddingTypeTablet ),
			'padding-right': generateCSSUnit( hquestionPaddingTablet, questionPaddingTypeTablet ),
			'padding-left': generateCSSUnit( questionLeftPaddingTablet, questionPaddingTypeTablet ),
		},
		' .vxt-faq-item .vxt-faq-icon-wrap': {
			padding: generateCSSUnit( iconBgSizeTablet, iconBgSizeType ),
			...iconBorderCSSTablet,
		},
		' .vxt-faq-item': {
			...borderCSSTablet,
		},
		' .vxt-faq-content': {
			'padding-top': generateCSSUnit( answerTopPaddingTablet, answerPaddingTypeTablet ),
			'padding-bottom': generateCSSUnit( answerBottomPaddingTablet, answerPaddingTypeTablet ),
			'padding-right': generateCSSUnit( answerRightPaddingTablet, answerPaddingTypeTablet ),
			'padding-left': generateCSSUnit( answerLeftPaddingTablet, answerPaddingTypeTablet ),
		},
		' .vxt-faq-questions-button .vxt-question': {
			'font-size': generateCSSUnit( questionFontSizeTablet, questionFontSizeType ),
			'line-height': generateCSSUnit( questionLineHeightTablet, questionLineHeightType ),
			'letter-spacing': generateCSSUnit( questionLetterSpacingTablet, questionLetterSpacingType ),
		},
		' .vxt-faq-item .vxt-faq-content': {
			'font-size': generateCSSUnit( answerFontSizeTablet, answerFontSizeType ),
			'line-height': generateCSSUnit( answerLineHeightTablet, answerLineHeightType ),
			'letter-spacing': generateCSSUnit( answerLetterSpacingTablet, answerLetterSpacingType ),
		},
		' .vxt-icon svg': {
			width: generateCSSUnit( iconSizeTablet, iconSizeType ),
			height: generateCSSUnit( iconSizeTablet, iconSizeType ),
			'font-size': generateCSSUnit( iconSizeTablet, iconSizeType ),
		},
		'.vxt-faq-icon-row .vxt-faq-item .vxt-faq-icon-wrap': {
			'margin-right': generateCSSUnit( gapBtwIconQUestionTablet, 'px' ),
		},
		'.vxt-faq-icon-row-reverse .vxt-faq-item .vxt-faq-icon-wrap': {
			'margin-left': generateCSSUnit( gapBtwIconQUestionTablet, 'px' ),
		},
		' .vxt-icon-active svg': {
			width: generateCSSUnit( iconSizeTablet, iconSizeType ),
			height: generateCSSUnit( iconSizeTablet, iconSizeType ),
			'font-size': generateCSSUnit( iconSizeTablet, iconSizeType ),
		},
		' .vxt-faq-child__outer-wrap': {
			'margin-bottom': generateCSSUnit( rowsGapTablet, rowsGapUnit ),
		},
		'.vxt-faq-layout-grid .block-editor-inner-blocks .block-editor-block-list__layout': {
			'grid-column-gap': generateCSSUnit( columnsGapTablet, columnsGapUnit ),
			'grid-row-gap': generateCSSUnit( rowsGapTablet, rowsGapUnit ),
		},
		'.vxt-faq__outer-wrap': {
			'margin-top': generateCSSUnit( blockTopMarginTablet, blockMarginUnitTablet ),
			'margin-right': generateCSSUnit( blockRightMarginTablet, blockMarginUnitTablet ),
			'margin-bottom': generateCSSUnit( blockBottomMarginTablet, blockMarginUnitTablet ),
			'margin-left': generateCSSUnit( blockLeftMarginTablet, blockMarginUnitTablet ),
			'padding-top': generateCSSUnit( blockTopPaddingTablet, blockPaddingUnitTablet ),
			'padding-right': generateCSSUnit( blockRightPaddingTablet, blockPaddingUnitTablet ),
			'padding-bottom': generateCSSUnit( blockBottomPaddingTablet, blockPaddingUnitTablet ),
			'padding-left': generateCSSUnit( blockLeftPaddingTablet, blockPaddingUnitTablet ),
		},
	};

	mobileSelectors = {
		' .vxt-faq-item': {
			...borderCSSMobile,
		},
		' .vxt-faq-item .vxt-faq-icon-wrap': {
			padding: generateCSSUnit( iconBgSizeMobile, iconBgSizeType ),
			...iconBorderCSSMobile,
		},
		'.vxt-faq-icon-row .vxt-faq-item .vxt-faq-icon-wrap': {
			'margin-right': generateCSSUnit( gapBtwIconQUestionMobile, 'px' ),
		},
		'.vxt-faq-icon-row-reverse .vxt-faq-item .vxt-faq-icon-wrap': {
			'margin-left': generateCSSUnit( gapBtwIconQUestionMobile, 'px' ),
		},
		' .vxt-faq-questions-button': {
			'padding-top': generateCSSUnit( vquestionPaddingMobile, questionPaddingTypeMobile ),
			'padding-bottom': generateCSSUnit( questionBottomPaddingMobile, questionPaddingTypeMobile ),
			'padding-right': generateCSSUnit( hquestionPaddingMobile, questionPaddingTypeMobile ),
			'padding-left': generateCSSUnit( questionLeftPaddingMobile, questionPaddingTypeMobile ),
		},
		' .vxt-faq-content': {
			'padding-top': generateCSSUnit( answerTopPaddingMobile, answerPaddingTypeMobile ),
			'padding-bottom': generateCSSUnit( answerBottomPaddingMobile, answerPaddingTypeMobile ),
			'padding-right': generateCSSUnit( answerRightPaddingMobile, answerPaddingTypeMobile ),
			'padding-left': generateCSSUnit( answerLeftPaddingMobile, answerPaddingTypeMobile ),
		},
		' .vxt-faq-questions-button .vxt-question': {
			'font-size': generateCSSUnit( questionFontSizeMobile, questionFontSizeType ),
			'line-height': generateCSSUnit( questionLineHeightMobile, questionLineHeightType ),
			'letter-spacing': generateCSSUnit( questionLetterSpacingMobile, questionLetterSpacingType ),
		},
		' .vxt-faq-item .vxt-faq-content': {
			'font-size': generateCSSUnit( answerFontSizeMobile, answerFontSizeType ),
			'line-height': generateCSSUnit( answerLineHeightMobile, answerLineHeightType ),
			'letter-spacing': generateCSSUnit( answerLetterSpacingMobile, answerLetterSpacingType ),
		},
		' .vxt-icon svg': {
			width: generateCSSUnit( iconSizeMobile, iconSizeType ),
			height: generateCSSUnit( iconSizeMobile, iconSizeType ),
			'font-size': generateCSSUnit( iconSizeMobile, iconSizeType ),
		},
		' .vxt-icon-active svg': {
			width: generateCSSUnit( iconSizeMobile, iconSizeType ),
			height: generateCSSUnit( iconSizeMobile, iconSizeType ),
			'font-size': generateCSSUnit( iconSizeMobile, iconSizeType ),
		},
		' .vxt-faq-child__outer-wrap': {
			'margin-bottom': generateCSSUnit( rowsGapMobile, rowsGapUnit ),
		},
		'.vxt-faq-layout-grid .block-editor-inner-blocks .block-editor-block-list__layout': {
			'grid-column-gap': generateCSSUnit( columnsGapMobile, columnsGapUnit ),
			'grid-row-gap': generateCSSUnit( rowsGapMobile, rowsGapUnit ),
		},
		'.vxt-faq__outer-wrap': {
			'margin-top': generateCSSUnit( blockTopMarginMobile, blockMarginUnitMobile ),
			'margin-right': generateCSSUnit( blockRightMarginMobile, blockMarginUnitMobile ),
			'margin-bottom': generateCSSUnit( blockBottomMarginMobile, blockMarginUnitMobile ),
			'margin-left': generateCSSUnit( blockLeftMarginMobile, blockMarginUnitMobile ),
			'padding-top': generateCSSUnit( blockTopPaddingMobile, blockPaddingUnitMobile ),
			'padding-right': generateCSSUnit( blockRightPaddingMobile, blockPaddingUnitMobile ),
			'padding-bottom': generateCSSUnit( blockBottomPaddingMobile, blockPaddingUnitMobile ),
			'padding-left': generateCSSUnit( blockLeftPaddingMobile, blockPaddingUnitMobile ),
		},
	};

	if ( 'accordion' === layout && true === inactiveOtherItems ) {
		selectors[ ' .block-editor-block-list__layout .vxt-faq-child__outer-wrap .vxt-faq-content ' ] = {
			display: 'none',
		};
	}
	if ( 'accordion' === layout && false === inactiveOtherItems ) {
		selectors[
			' .block-editor-inner-blocks .vxt-faq-child__outer-wrap.vxt-faq-item .vxt-faq-questions-button .vxt-icon-active'
		] = {
			display: 'flex',
		};
		selectors[
			' .block-editor-inner-blocks .vxt-faq-child__outer-wrap.vxt-faq-item .vxt-faq-questions-button .vxt-icon'
		] = {
			display: 'none',
		};
	}
	if ( 'accordion' === layout && true === expandFirstItem ) {
		selectors[
			' .block-editor-block-list__layout > div:first-child > .vxt-faq-child__outer-wrap .vxt-faq-content '
		] = {
			display: 'block',
		};
		selectors[
			' .block-editor-block-list__layout > div:first-child > .vxt-faq-child__outer-wrap.vxt-faq-item .vxt-faq-questions-button .vxt-icon-active '
		] = {
			display: 'flex',
		};
		selectors[
			' .block-editor-block-list__layout > div:first-child > .vxt-faq-child__outer-wrap.vxt-faq-item .vxt-faq-questions-button .vxt-icon '
		] = {
			display: 'none',
		};
	}
	if ( true === enableSeparator ) {
		selectors[ '.vxt-faq__outer-wrap .vxt-faq-child__outer-wrap .vxt-faq-content ' ] = {
			'border-style': 'solid',
			'border-top-color': overallBorderColor,
			'border-top-width': generateCSSUnit( overallBorderTopWidth, 'px' ),
		};
		selectors[ '.vxt-faq__outer-wrap .vxt-faq-child__outer-wrap .vxt-faq-content:hover ' ] = {
			'border-top-color': overallBorderHColor,
		};
	}
	if ( 'grid' === layout ) {
		selectors[ ' .block-editor-block-list__layout .vxt-faq-child__outer-wrap ' ] = {
			'text-align': align,
		};
		selectors[ '.vxt-faq-layout-grid .block-editor-inner-blocks > .block-editor-block-list__layout ' ] = {
			'grid-template-columns': 'repeat(' + getFallbackNumber( columns, 'columns', blockName ) + ', 1fr)',
		};
		tabletSelectors[ '.vxt-faq-layout-grid .block-editor-inner-blocks > .block-editor-block-list__layout ' ] = {
			'grid-template-columns': 'repeat(' + getFallbackNumber( tcolumns, 'tcolumns', blockName ) + ', 1fr)',
		};
		mobileSelectors[ '.vxt-faq-layout-grid .block-editor-inner-blocks > .block-editor-block-list__layout ' ] = {
			'grid-template-columns': 'repeat(' + getFallbackNumber( mcolumns, 'mcolumns', blockName ) + ', 1fr)',
		};
	}

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
