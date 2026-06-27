/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from '@Controls/generateCSS';
import generateCSSUnit from '@Controls/generateCSSUnit';

function styling( attributes, deviceType ) {
	const previewType = deviceType.toLowerCase();
	const {
		block_id,
		starColor,
		descColor,
		titleColor,
		contentColor,
		headFontFamily,
		headFontWeight,
		headFontSizeType,
		headLineHeightType,
		headFontSize,
		headFontSizeTablet,
		headFontSizeMobile,
		headLineHeight,
		headLineHeightTablet,
		headLineHeightMobile,
		subHeadFontFamily,
		subHeadFontWeight,
		subHeadFontSize,
		subHeadFontSizeType,
		subHeadFontSizeMobile,
		subHeadFontSizeTablet,
		subHeadLineHeight,
		subHeadLineHeightType,
		subHeadLineHeightMobile,
		subHeadLineHeightTablet,
		contentFontFamily,
		contentFontWeight,
		contentFontSizeType,
		contentLineHeightType,
		contentFontSize,
		contentFontSizeTablet,
		contentFontSizeMobile,
		contentLineHeight,
		contentLineHeightTablet,
		contentLineHeightMobile,
		topPadding,
		bottomPadding,
		rightPadding,
		leftPadding,
		//Mobile
		paddingTopMobile,
		paddingBottomMobile,
		paddingRightMobile,
		paddingLeftMobile,
		//Tablet
		paddingTopTablet,
		paddingBottomTablet,
		paddingRightTablet,
		paddingLeftTablet,
		paddingUnit,
		mobilePaddingUnit,
		tabletPaddingUnit,
		authorColor,
		summaryColor,
		starActiveColor,
		starOutlineColor,
		overallAlignment,
		headTransform,
		headDecoration,
		subHeadTransform,
		subHeadDecoration,
		contentTransform,
		contentDecoration,
		headFontStyle,
		subHeadFontStyle,
		contentFontStyle,
		headLetterSpacing,
		headLetterSpacingTablet,
		headLetterSpacingMobile,
		headLetterSpacingType,
		subHeadLetterSpacing,
		subHeadLetterSpacingTablet,
		subHeadLetterSpacingMobile,
		subHeadLetterSpacingType,
		contentLetterSpacing,
		contentLetterSpacingTablet,
		contentLetterSpacingMobile,
		contentLetterSpacingType,
	} = attributes;

	let tabletSelectors = {};
	let mobileSelectors = {};

	const selectors = {
		' .vxt-star-inner-container svg': {
			fill: starColor,
		},
		' .vxt-avg-review-star-inner-container svg': {
			fill: starColor,
		},
		' .vxt-rating-title': {
			'font-size': generateCSSUnit( headFontSize, headFontSizeType ),
			'font-weight': headFontWeight,
			'font-family': headFontFamily,
			'font-style': headFontStyle,
			'text-decoration': headDecoration,
			'text-transform': headTransform,
			'line-height': generateCSSUnit( headLineHeight, headLineHeightType ),
			'letter-spacing': generateCSSUnit( headLetterSpacing, headLetterSpacingType ),
			color: titleColor,
		},
		' .vxt_ultimate_gutenberg_blocks_review_entry': {
			'font-size': generateCSSUnit( headFontSize, headFontSizeType ),
			'font-weight': headFontWeight,
			'font-family': headFontFamily,
			'font-style': headFontStyle,
			'text-decoration': headDecoration,
			'text-transform': headTransform,
			'line-height': generateCSSUnit( headLineHeight, headLineHeightType ),
			'letter-spacing': generateCSSUnit( headLetterSpacing, headLetterSpacingType ),
		},
		' .vxt-rating-desc': {
			'font-size': generateCSSUnit( subHeadFontSize, subHeadFontSizeType ),
			'font-weight': subHeadFontWeight,
			'font-family': subHeadFontFamily,
			'font-style': subHeadFontStyle,
			'text-decoration': subHeadDecoration,
			'text-transform': subHeadTransform,
			'line-height': generateCSSUnit( subHeadLineHeight, subHeadLineHeightType ),
			'letter-spacing': generateCSSUnit( subHeadLetterSpacing, subHeadLetterSpacingType ),
			color: descColor,
		},
		' .vxt-rating-author': {
			'font-size': generateCSSUnit( subHeadFontSize, subHeadFontSizeType ),
			'font-weight': subHeadFontWeight,
			'font-family': subHeadFontFamily,
			'font-style': subHeadFontStyle,
			'text-decoration': subHeadDecoration,
			'text-transform': subHeadTransform,
			'line-height': generateCSSUnit( subHeadLineHeight, subHeadLineHeightType ),
			'letter-spacing': generateCSSUnit( subHeadLetterSpacing, subHeadLetterSpacingType ),
			color: authorColor,
		},
		' .vxt_ultimate_gutenberg_blocks_review_block': {
			'padding-left': generateCSSUnit( leftPadding, paddingUnit ),
			'padding-right': generateCSSUnit( rightPadding, paddingUnit ),
			'padding-top': generateCSSUnit( topPadding, paddingUnit ),
			'padding-bottom': generateCSSUnit( bottomPadding, paddingUnit ),
			'text-align': overallAlignment,
		},
		' .vxt_ultimate_gutenberg_blocks_review_summary, p.rich-text.block-editor-rich-text__editable.vxt_ultimate_gutenberg_blocks_review_summary_title':
			{
				'font-size': generateCSSUnit( contentFontSize, contentFontSizeType ),
				'font-weight': contentFontWeight,
				'font-family': contentFontFamily,
				'font-style': contentFontStyle,
				'text-decoration': contentDecoration,
				'text-transform': contentTransform,
				'line-height': generateCSSUnit( contentLineHeight, contentLineHeightType ),
				'letter-spacing': generateCSSUnit( contentLetterSpacing, contentLetterSpacingType ),
				color: summaryColor,
			},
		' .vxt_ultimate_gutenberg_blocks_review_entry .rich-text': {
			color: contentColor,
		},
		' .vxt_ultimate_gutenberg_blocks_review_entry .star, .vxt_ultimate_gutenberg_blocks_review_average_stars .star':
			{
				fill: starColor,
			},
		' .vxt_ultimate_gutenberg_blocks_review_entry path, .vxt_ultimate_gutenberg_blocks_review_average_stars path': {
			stroke: starOutlineColor,
			fill: starActiveColor,
		},
	};

	mobileSelectors = {
		' .vxt-rating-title, .vxt_ultimate_gutenberg_blocks_review_entry': {
			'font-size': generateCSSUnit( headFontSizeMobile, headFontSizeType ),
			'line-height': generateCSSUnit( headLineHeightMobile, headLineHeightType ),
			'letter-spacing': generateCSSUnit( headLetterSpacingMobile, headLetterSpacingType ),
		},
		' .vxt-rating-desc, .vxt-rating-author': {
			'font-size': generateCSSUnit( subHeadFontSizeMobile, subHeadFontSizeType ),
			'line-height': generateCSSUnit( subHeadLineHeightMobile, subHeadLineHeightType ),
			'letter-spacing': generateCSSUnit( subHeadLetterSpacingMobile, subHeadLetterSpacingType ),
		},
		' .vxt_ultimate_gutenberg_blocks_review_summary, p.rich-text.block-editor-rich-text__editable.vxt_ultimate_gutenberg_blocks_review_summary_title':
			{
				'font-size': generateCSSUnit( contentFontSizeMobile, contentFontSizeType ),
				'line-height': generateCSSUnit( contentLineHeightMobile, contentLineHeightType ),
				'letter-spacing': generateCSSUnit( contentLetterSpacingMobile, contentLetterSpacingType ),
			},
		' .vxt_ultimate_gutenberg_blocks_review_block': {
			'padding-left': generateCSSUnit( paddingLeftMobile, mobilePaddingUnit ),
			'padding-right': generateCSSUnit( paddingRightMobile, mobilePaddingUnit ),
			'padding-top': generateCSSUnit( paddingTopMobile, mobilePaddingUnit ),
			'padding-bottom': generateCSSUnit( paddingBottomMobile, mobilePaddingUnit ),
		},
	};

	tabletSelectors = {
		' .vxt-rating-title, .vxt_ultimate_gutenberg_blocks_review_entry': {
			'font-size': generateCSSUnit( headFontSizeTablet, headFontSizeType ),
			'line-height': generateCSSUnit( headLineHeightTablet, headLineHeightType ),
			'letter-spacing': generateCSSUnit( headLetterSpacingTablet, headLetterSpacingType ),
		},
		' .vxt-rating-desc, .vxt-rating-author': {
			'font-size': generateCSSUnit( subHeadFontSizeTablet, subHeadFontSizeType ),
			'line-height': generateCSSUnit( subHeadLineHeightTablet, subHeadLineHeightType ),
			'letter-spacing': generateCSSUnit( subHeadLetterSpacingTablet, subHeadLetterSpacingType ),
		},
		' .vxt_ultimate_gutenberg_blocks_review_summary, p.rich-text.block-editor-rich-text__editable.vxt_ultimate_gutenberg_blocks_review_summary_title':
			{
				'font-size': generateCSSUnit( contentFontSizeTablet, contentFontSizeType ),
				'line-height': generateCSSUnit( contentLineHeightTablet, contentLineHeightType ),
				'letter-spacing': generateCSSUnit( contentLetterSpacingTablet, contentLetterSpacingType ),
			},
		' .vxt_ultimate_gutenberg_blocks_review_block': {
			'padding-left': generateCSSUnit( paddingLeftTablet, tabletPaddingUnit ),
			'padding-right': generateCSSUnit( paddingRightTablet, tabletPaddingUnit ),
			'padding-top': generateCSSUnit( paddingTopTablet, tabletPaddingUnit ),
			'padding-bottom': generateCSSUnit( paddingBottomTablet, tabletPaddingUnit ),
		},
	};

	const baseSelector = `.editor-styles-wrapper .vxt-block-${ block_id }`;

	let stylingCss = generateCSS( selectors, baseSelector );

	if ( 'tablet' === previewType || 'mobile' === previewType ) {
		stylingCss += generateCSS( tabletSelectors, `${ baseSelector }`, true, 'tablet' );

		if ( 'mobile' === previewType ) {
			stylingCss += generateCSS( mobileSelectors, `${ baseSelector }`, true, 'mobile' );
		}
	}
	return stylingCss;
}

export default styling;
