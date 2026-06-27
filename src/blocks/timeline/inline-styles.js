/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from '@Controls/generateCSS';
import generateCSSUnit from '@Controls/generateCSSUnit';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import { getLogicalTextAlign } from '@Utils/Helpers';

function contentTimelineStyle( attributes, clientId, name, deviceType ) {
	const blockName = name.replace( 'vexaltrix/', '' );
	const previewType = deviceType.toLowerCase();
	const {
		block_id,
		dateBottomspace,
		dateBottomspaceTablet,
		dateBottomspaceMobile,
		backgroundColor,
		separatorColor,
		separatorFillColor,
		separatorBg,
		separatorBorder,
		borderFocus,
		separatorwidth,
		borderwidth,
		connectorBgsize,
		borderRadius,
		borderRadiusTablet,
		borderRadiusMobile,
		iconColor,
		dateFontSizeType,
		dateFontSize,
		dateFontSizeTablet,
		dateFontSizeMobile,
		dateFontFamily,
		dateFontWeight,
		dateLineHeightType,
		dateLineHeight,
		dateLineHeightTablet,
		dateLineHeightMobile,
		dateColor,
		iconSize,
		iconFocus,
		iconBgFocus,
		headFontSizeType,
		headFontSize,
		headFontSizeTablet,
		headFontSizeMobile,
		headFontFamily,
		headFontWeight,
		headLineHeightType,
		headLineHeight,
		headLineHeightTablet,
		headLineHeightMobile,
		align,
		alignTablet,
		alignMobile,
		headingColor,
		headSpace,
		headSpaceTablet,
		headSpaceMobile,
		subHeadFontSizeType,
		subHeadFontSize,
		subHeadFontSizeTablet,
		subHeadFontSizeMobile,
		subHeadFontFamily,
		subHeadFontWeight,
		subHeadLineHeightType,
		subHeadLineHeight,
		subHeadLineHeightTablet,
		subHeadLineHeightMobile,
		subHeadingColor,
		authorSpace,
		authorSpaceTablet,
		authorSpaceMobile,
		authorColor,
		authorFontSizeType,
		authorFontSize,
		authorFontSizeTablet,
		authorFontSizeMobile,
		authorFontFamily,
		authorFontWeight,
		authorLineHeightType,
		authorLineHeight,
		authorLineHeightTablet,
		authorLineHeightMobile,
		ctaColor,
		ctaFontSizeType,
		ctaFontSize,
		ctaFontSizeTablet,
		ctaFontSizeMobile,
		ctaFontFamily,
		ctaFontWeight,
		ctaLineHeightType,
		ctaLineHeight,
		ctaLineHeightTablet,
		ctaLineHeightMobile,
		ctaBackground,
		topMarginMobile,
		rightMarginMobile,
		bottomMarginMobile,
		leftMarginMobile,
		mobileMarginUnit,
		topPadding,
		rightPadding,
		bottomPadding,
		leftPadding,
		topPaddingTablet,
		rightPaddingTablet,
		bottomPaddingTablet,
		leftPaddingTablet,
		topPaddingMobile,
		rightPaddingMobile,
		bottomPaddingMobile,
		leftPaddingMobile,
		paddingUnit,
		mobilePaddingUnit,
		tabletPaddingUnit,
		headFontStyle,
		authorFontStyle,
		subHeadFontStyle,
		dateFontStyle,
		ctaFontStyle,
		headTransform,
		authorTransform,
		subHeadTransform,
		dateTransform,
		ctaTransform,
		headDecoration,
		authorDecoration,
		subHeadDecoration,
		dateDecoration,
		ctaDecoration,

		ctaBottomSpacing,
		ctaBottomSpacingTablet,
		ctaBottomSpacingMobile,
		headTopSpacing,
		headTopSpacingTablet,
		headTopSpacingMobile,
		headLetterSpacing,
		headLetterSpacingTablet,
		headLetterSpacingMobile,
		headLetterSpacingType,
		subHeadLetterSpacing,
		subHeadLetterSpacingTablet,
		subHeadLetterSpacingMobile,
		subHeadLetterSpacingType,
		dateLetterSpacing,
		dateLetterSpacingTablet,
		dateLetterSpacingMobile,
		dateLetterSpacingType,
		ctaLetterSpacing,
		ctaLetterSpacingTablet,
		ctaLetterSpacingMobile,
		ctaLetterSpacingType,
		authorLetterSpacing,
		authorLetterSpacingTablet,
		authorLetterSpacingMobile,
		authorLetterSpacingType,
		verticalSpace,
		verticalSpaceTablet,
		verticalSpaceMobile,
		verticalSpaceUnit,
		verticalSpaceUnitTablet,
		verticalSpaceUnitMobile,
		horizontalSpace,
		horizontalSpaceTablet,
		horizontalSpaceMobile,
		horizontalSpaceUnit,
		horizontalSpaceUnitTablet,
		horizontalSpaceUnitMobile,
		inheritFromTheme,
	} = attributes;

	const iconSizeFallback = getFallbackNumber( iconSize, 'iconSize', blockName );
	const connectorBgSizeFallback = getFallbackNumber( connectorBgsize, 'connectorBgsize', blockName );
	const borderWidthFallback = getFallbackNumber( borderwidth, 'borderwidth', blockName );
	const separatorWidthFallback = getFallbackNumber( separatorwidth, 'separatorwidth', blockName );
	const borderRadiusFallback = getFallbackNumber( borderRadius, 'borderRadius', blockName );
	const headTopSpacingFallback = getFallbackNumber( headTopSpacing, 'headTopSpacing', blockName );
	const headSpaceFallback = getFallbackNumber( headSpace, 'headSpace', blockName );
	const authorSpaceFallback = getFallbackNumber( authorSpace, 'authorSpace', blockName );
	const dateBottomSpaceFallback = getFallbackNumber( dateBottomspace, 'dateBottomspace', blockName );
	const ctaBottomSpacingFallback = getFallbackNumber( ctaBottomSpacing, 'ctaBottomSpacing', blockName );

	let selectors = {
		' .vxt-timeline__heading': {
			'font-size': generateCSSUnit( headFontSize, headFontSizeType ),
			'font-family': headFontFamily,
			'font-weight': headFontWeight,
			'line-height': generateCSSUnit( headLineHeight, headLineHeightType ),
			'font-style': headFontStyle,
			'text-decoration': headDecoration,
			'text-transform': headTransform,
			'text-align': getLogicalTextAlign( align ),
			color: headingColor,
			'margin-bottom': generateCSSUnit( headSpaceFallback, 'px' ),
			'margin-top': generateCSSUnit( headTopSpacingFallback, 'px' ),
			'letter-spacing': generateCSSUnit( headLetterSpacing, headLetterSpacingType ),
		},
		' .vxt-timeline__heading a': {
			'font-size': generateCSSUnit( headFontSize, headFontSizeType ),
			'font-family': headFontFamily,
			'font-weight': headFontWeight,
			'line-height': generateCSSUnit( headLineHeight, headLineHeightType ),
			'font-style': headFontStyle,
			'text-decoration': headDecoration,
			'text-transform': headTransform,
			'text-align': getLogicalTextAlign( align ),
			color: headingColor,
			'margin-bottom': generateCSSUnit( headSpaceFallback, 'px' ),
			'letter-spacing': generateCSSUnit( headLetterSpacing, headLetterSpacingType ),
		},
		' .vxt-timeline-desc-content': {
			'font-size': generateCSSUnit( subHeadFontSize, subHeadFontSizeType ),
			'font-family': subHeadFontFamily,
			'font-weight': subHeadFontWeight,
			'line-height': generateCSSUnit( subHeadLineHeight, subHeadLineHeightType ),
			'font-style': subHeadFontStyle,
			'text-decoration': subHeadDecoration,
			'text-transform': subHeadTransform,
			'text-align': getLogicalTextAlign( align ),
			color: subHeadingColor,
			'margin-top': generateCSSUnit( authorSpaceFallback, 'px' ),
			'letter-spacing': generateCSSUnit( subHeadLetterSpacing, subHeadLetterSpacingType ),
		},
		' .vxt-timeline__author-link + .vxt-timeline__link_parent': {
			'margin-top': generateCSSUnit( authorSpaceFallback, 'px' ),
		},
		' .vxt-timeline__day-new': {
			'text-align': getLogicalTextAlign( align ),
		},
		' .vxt-timeline__date-inner': {
			'text-align': getLogicalTextAlign( align ),
		},
		'.vxt-timeline__center-block .vxt-timeline__day-right .vxt-timeline__arrow:after': {
			'border-left-color': backgroundColor,
		},
		'.vxt-timeline__right-block .vxt-timeline__day-right .vxt-timeline__arrow:after': {
			'border-left-color': backgroundColor,
		},
		'.vxt-timeline__center-block .vxt-timeline__day-left .vxt-timeline__arrow:after': {
			'border-right-color': backgroundColor,
		},
		'.vxt-timeline__left-block .vxt-timeline__day-left .vxt-timeline__arrow:after': {
			'border-right-color': backgroundColor,
		},
		' .vxt-timeline__line__inner': {
			'background-color': separatorFillColor,
		},
		' .vxt-timeline__line': {
			'background-color': separatorColor,
			width: generateCSSUnit( separatorWidthFallback, 'px' ),
		},
		'.vxt-timeline__right-block .vxt-timeline__line': {
			'inset-inline-end': 'calc( ' + connectorBgSizeFallback + 'px / 2 )',
		},
		'.vxt-timeline__left-block .vxt-timeline__line': {
			'inset-inline-start': 'calc( ' + connectorBgSizeFallback + 'px / 2 )',
		},
		' .vxt-timeline__marker': {
			'background-color': separatorBg,
			'min-height': generateCSSUnit( connectorBgSizeFallback, 'px' ),
			'min-width': generateCSSUnit( connectorBgSizeFallback, 'px' ),
			'line-height': generateCSSUnit( connectorBgSizeFallback, 'px' ),
			border: borderWidthFallback + 'px solid' + separatorBorder,
		},
		'.vxt-timeline__center-block .vxt-timeline__marker': {
			'margin-left': generateCSSUnit( horizontalSpace, horizontalSpaceUnit ),
			'margin-right': generateCSSUnit( horizontalSpace, horizontalSpaceUnit ),
		},
		'.vxt-timeline__left-block .vxt-timeline__left .vxt-timeline__arrow': {
			height: generateCSSUnit( connectorBgSizeFallback, 'px' ),
		},
		'.vxt-timeline__right-block .vxt-timeline__right .vxt-timeline__arrow': {
			height: generateCSSUnit( connectorBgSizeFallback, 'px' ),
		},
		'.vxt-timeline__center-block .vxt-timeline__left .vxt-timeline__arrow': {
			height: generateCSSUnit( connectorBgSizeFallback, 'px' ),
		},
		'.vxt-timeline__center-block .vxt-timeline__right .vxt-timeline__arrow': {
			height: generateCSSUnit( connectorBgSizeFallback, 'px' ),
		},
		' .vxt-timeline__field:not(:last-child)': {
			'margin-bottom': generateCSSUnit( verticalSpace, verticalSpaceUnit ),
		},
		' .vxt-timeline__date-hide.vxt-timeline__inner-date-new': {
			'margin-bottom': generateCSSUnit( dateBottomSpaceFallback, 'px' ),
			color: dateColor,
			'font-size': generateCSSUnit( dateFontSize, dateFontSizeType ),
			'font-family': dateFontFamily,
			'font-weight': dateFontWeight,
			'line-height': generateCSSUnit( dateLineHeight, dateLineHeightType ),
			'font-style': dateFontStyle,
			'text-decoration': dateDecoration,
			'text-transform': dateTransform,
			'text-align': getLogicalTextAlign( align ),
			'letter-spacing': generateCSSUnit( dateLetterSpacing, dateLetterSpacingType ),
		},
		' .vxt-timeline__date-hide.vxt-timeline__date-inner': {
			'margin-bottom': generateCSSUnit( dateBottomSpaceFallback, 'px' ),
			color: dateColor,
			'font-size': generateCSSUnit( dateFontSize, dateFontSizeType ),
			'font-family': dateFontFamily,
			'font-weight': dateFontWeight,
			'line-height': generateCSSUnit( dateLineHeight, dateLineHeightType ),
			'font-style': dateFontStyle,
			'text-decoration': dateDecoration,
			'text-transform': dateTransform,
			'text-align': getLogicalTextAlign( align ),
			'letter-spacing': generateCSSUnit( dateLetterSpacing, dateLetterSpacingType ),
		},
		'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-left': {
			'margin-left': generateCSSUnit( horizontalSpace, horizontalSpaceUnit ),
		},
		'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-right': {
			'margin-right': generateCSSUnit( horizontalSpace, horizontalSpaceUnit ),
		},
		' .vxt-timeline__date-new': {
			color: dateColor,
			'font-size': generateCSSUnit( dateFontSize, dateFontSizeType ),
			'font-family': dateFontFamily,
			'font-weight': dateFontWeight,
			'line-height': generateCSSUnit( dateLineHeight, dateLineHeightType ),
			'font-style': dateFontStyle,
			'text-decoration': dateDecoration,
			'text-transform': dateTransform,
			'letter-spacing': generateCSSUnit( dateLetterSpacing, dateLetterSpacingType ),
		},
		' .vxt-timeline__events-inner-new': {
			'background-color': backgroundColor,
			'border-radius': generateCSSUnit( borderRadiusFallback, 'px' ),
		},
		' .vxt-timeline__events-inner--content': {
			'padding-left': generateCSSUnit( leftPadding, paddingUnit ),
			'padding-right': generateCSSUnit( rightPadding, paddingUnit ),
			'padding-top': generateCSSUnit( topPadding, paddingUnit ),
			'padding-bottom': generateCSSUnit( bottomPadding, paddingUnit ),
			'text-align': getLogicalTextAlign( align ),
		},
		' svg': {
			color: iconColor,
			'font-size': generateCSSUnit( iconSizeFallback, 'px' ),
			width: generateCSSUnit( iconSizeFallback, 'px' ),
		},
		' .vxt-timeline__marker.vxt-timeline__in-view-icon': {
			background: iconBgFocus,
			'border-color': borderFocus,
		},
		' .vxt-timeline__marker.vxt-timeline__in-view-icon svg': {
			color: iconFocus,
			fill: iconFocus,
		},
		' .vxt-timeline__icon-new svg': {
			fill: iconColor,
		},

		//Author and CTA
		' .dashicons-admin-users': {
			'font-size': generateCSSUnit( authorFontSize, authorFontSizeType ),
			'font-weight': authorFontWeight,
			'line-height': generateCSSUnit( authorLineHeight, authorLineHeightType ),
			color: authorColor,
			'font-style': authorFontStyle,
			'text-decoration': authorDecoration,
			'text-transform': authorTransform,
			'letter-spacing': generateCSSUnit( authorLetterSpacing, authorLetterSpacingType ),
		},
		' .vxt-timeline__author-link': {
			'font-size': generateCSSUnit( authorFontSize, authorFontSizeType ),
			'font-family': authorFontFamily,
			'font-weight': authorFontWeight,
			'line-height': generateCSSUnit( authorLineHeight, authorLineHeightType ),
			color: authorColor,
			'font-style': authorFontStyle,
			'text-decoration': authorDecoration,
			'text-transform': authorTransform,
			'text-align': getLogicalTextAlign( align ),
			'letter-spacing': generateCSSUnit( authorLetterSpacing, authorLetterSpacingType ),
		},
		' .vxt-timeline__link_parent': {
			'text-align': getLogicalTextAlign( align ),
		},
		' .vxt-timeline__link': {
			'text-align': getLogicalTextAlign( align ),
			'margin-bottom': generateCSSUnit( ctaBottomSpacingFallback, 'px' ),
		},
		' .vxt-timeline__image a': {
			'text-align': getLogicalTextAlign( align ),
		},
		' a.vxt-timeline__image': {
			'text-align': getLogicalTextAlign( align ),
		},
	};

	/* Generate Responsive CSS for timeline */
	let tabletSelectors = {
		' .vxt-timeline__day-new': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		' .vxt-timeline__date-inner': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		' .vxt-timeline__date-hide.vxt-timeline__date-inner': {
			'text-align': getLogicalTextAlign( alignTablet ),
			'font-size': generateCSSUnit( dateFontSizeTablet, dateFontSizeType ),
			'line-height': generateCSSUnit( dateLineHeightTablet, dateLineHeightType ),
			'margin-bottom': generateCSSUnit( dateBottomspaceTablet, 'px' ),
			'letter-spacing': generateCSSUnit( dateLetterSpacingTablet, dateLetterSpacingType ),
		},
		' .vxt-timeline__date-hide.vxt-timeline__inner-date-new': {
			'text-align': getLogicalTextAlign( alignTablet ),
			'font-size': generateCSSUnit( dateFontSizeTablet, dateFontSizeType ),
			'line-height': generateCSSUnit( dateLineHeightTablet, dateLineHeightType ),
			'margin-bottom': generateCSSUnit( dateBottomspaceTablet, 'px' ),
			'letter-spacing': generateCSSUnit( dateLetterSpacingTablet, dateLetterSpacingType ),
		},
		' .vxt-timeline__date-new': {
			'font-size': generateCSSUnit( dateFontSizeTablet, dateFontSizeType ),
			'line-height': generateCSSUnit( dateLineHeightTablet, dateLineHeightType ),
			'margin-bottom': generateCSSUnit( dateBottomspaceTablet, 'px' ),
			'letter-spacing': generateCSSUnit( dateLetterSpacingTablet, dateLetterSpacingType ),
		},
		' .vxt-timeline__heading': {
			'text-align': getLogicalTextAlign( alignTablet ),
			'font-size': generateCSSUnit( headFontSizeTablet, headFontSizeType ),
			'line-height': generateCSSUnit( headLineHeightTablet, headLineHeightType ),
			'margin-bottom': generateCSSUnit( headSpaceTablet, 'px' ),
			'margin-top': generateCSSUnit( headTopSpacingTablet, 'px' ),
			'letter-spacing': generateCSSUnit( headLetterSpacingTablet, headLetterSpacingType ),
		},
		' .vxt-timeline__heading a': {
			'text-align': getLogicalTextAlign( alignTablet ),
			'font-size': generateCSSUnit( headFontSizeTablet, headFontSizeType ),
			'line-height': generateCSSUnit( headLineHeightTablet, headLineHeightType ),
			'margin-bottom': generateCSSUnit( headSpaceTablet, 'px' ),
			'margin-top': generateCSSUnit( headTopSpacingTablet, 'px' ),
			'letter-spacing': generateCSSUnit( headLetterSpacingTablet, headLetterSpacingType ),
		},
		' .vxt-timeline-desc-content': {
			'text-align': getLogicalTextAlign( alignTablet ),
			'font-size': generateCSSUnit( subHeadFontSizeTablet, subHeadFontSizeType ),
			'line-height': generateCSSUnit( subHeadLineHeightTablet, subHeadLineHeightType ),
			'margin-top': generateCSSUnit( authorSpaceTablet, 'px' ),
			'letter-spacing': generateCSSUnit( subHeadLetterSpacingTablet, subHeadLetterSpacingType ),
		},
		' .vxt-timeline__author-link + .vxt-timeline__link_parent': {
			'margin-top': generateCSSUnit( authorSpaceTablet, 'px' ),
		},
		'.vxt-timeline__center-block .vxt-timeline__marker': {
			'margin-left': generateCSSUnit( horizontalSpaceTablet, horizontalSpaceUnitTablet ),
			'margin-right': generateCSSUnit( horizontalSpaceTablet, horizontalSpaceUnitTablet ),
		},
		'.vxt-timeline__left-block .vxt-timeline__day-new.vxt-timeline__day-left': {
			'margin-left': generateCSSUnit( horizontalSpaceTablet, horizontalSpaceUnitTablet ),
		},
		'.vxt-timeline__right-block .vxt-timeline__day-new.vxt-timeline__day-right': {
			'margin-right': generateCSSUnit( horizontalSpaceTablet, horizontalSpaceUnitTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__day-right .vxt-timeline__arrow:after':
			{
				'border-right-color': backgroundColor,
			},
		// Responsive alignment CSS

		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__heading': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline-desc-content': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__day-new': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__date-inner': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__date-hide.vxt-timeline__date-inner':
			{
				'text-align': getLogicalTextAlign( alignTablet ),
			},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__author-link': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__link_parent': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__link': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet .vxt-timeline__image a': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-tablet a.vxt-timeline__image': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},

		// CTA AUTHOR.
		' .dashicons-admin-users': {
			'font-size': generateCSSUnit( authorFontSizeTablet, authorFontSizeType ),
			'line-height': generateCSSUnit( authorLineHeightTablet, authorLineHeightType ),
			'letter-spacing': generateCSSUnit( authorLetterSpacingTablet, authorLetterSpacingType ),
		},
		' .vxt-timeline__link_parent': {
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		' .vxt-timeline__author-link': {
			'text-align': getLogicalTextAlign( alignTablet ),
			'font-size': generateCSSUnit( authorFontSizeTablet, authorFontSizeType ),
			'line-height': generateCSSUnit( authorLineHeightTablet, authorLineHeightType ),
			'letter-spacing': generateCSSUnit( authorLetterSpacingTablet, authorLetterSpacingType ),
		},
		' .vxt-timeline__link': {
			'text-align': getLogicalTextAlign( alignTablet ),
			'margin-bottom': generateCSSUnit( ctaBottomSpacingTablet, 'px' ),
		},
		' .vxt-timeline__events-inner-new': {
			'border-radius': generateCSSUnit( borderRadiusTablet, 'px' ),
		},
		' .vxt-timeline__events-inner--content': {
			'padding-left': generateCSSUnit( leftPaddingTablet, tabletPaddingUnit ),
			'padding-right': generateCSSUnit( rightPaddingTablet, tabletPaddingUnit ),
			'padding-top': generateCSSUnit( topPaddingTablet, tabletPaddingUnit ),
			'padding-bottom': generateCSSUnit( bottomPaddingTablet, tabletPaddingUnit ),
			'text-align': getLogicalTextAlign( alignTablet ),
		},
		' .vxt-timeline__field:not(:last-child)': {
			'margin-bottom': generateCSSUnit( verticalSpaceTablet, verticalSpaceUnitTablet ),
		},
	};

	let mobileSelectors = {
		' .vxt-timeline__day-new': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		' .vxt-timeline__date-inner': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		' .vxt-timeline__date-hide.vxt-timeline__date-inner': {
			'text-align': getLogicalTextAlign( alignMobile ),
			'font-size': generateCSSUnit( dateFontSizeMobile, dateFontSizeType ),
			'line-height': generateCSSUnit( dateLineHeightMobile, dateLineHeightType ),
			'margin-bottom': generateCSSUnit( dateBottomspaceMobile, 'px' ),
			'letter-spacing': generateCSSUnit( dateLetterSpacingMobile, dateLetterSpacingType ),
		},
		' .vxt-timeline__date-hide.vxt-timeline__inner-date-new': {
			'text-align': getLogicalTextAlign( alignMobile ),
			'font-size': generateCSSUnit( dateFontSizeMobile, dateFontSizeType ),
			'line-height': generateCSSUnit( dateLineHeightMobile, dateLineHeightType ),
			'margin-bottom': generateCSSUnit( dateBottomspaceMobile, 'px' ),
			'letter-spacing': generateCSSUnit( dateLetterSpacingMobile, dateLetterSpacingType ),
		},
		' .vxt-timeline__date-new': {
			'font-size': generateCSSUnit( dateFontSizeMobile, dateFontSizeType ),
			'line-height': generateCSSUnit( dateLineHeightMobile, dateLineHeightType ),
			'margin-bottom': generateCSSUnit( dateBottomspaceMobile, 'px' ),
			'letter-spacing': generateCSSUnit( dateLetterSpacingMobile, dateLetterSpacingType ),
		},
		' .vxt-timeline__heading': {
			'text-align': getLogicalTextAlign( alignMobile ),
			'font-size': generateCSSUnit( headFontSizeMobile, headFontSizeType ),
			'line-height': generateCSSUnit( headLineHeightMobile, headLineHeightType ),
			'margin-bottom': generateCSSUnit( headSpaceMobile, 'px' ),
			'margin-top': generateCSSUnit( headTopSpacingMobile, 'px' ),
			'letter-spacing': generateCSSUnit( headLetterSpacingMobile, headLetterSpacingType ),
		},
		' .vxt-timeline__heading a': {
			'text-align': getLogicalTextAlign( alignMobile ),
			'font-size': generateCSSUnit( headFontSizeMobile, headFontSizeType ),
			'line-height': generateCSSUnit( headLineHeightMobile, headLineHeightType ),
			'margin-bottom': generateCSSUnit( headSpaceMobile, 'px' ),
			'margin-top': generateCSSUnit( headTopSpacingMobile, 'px' ),
			'letter-spacing': generateCSSUnit( headLetterSpacingMobile, headLetterSpacingType ),
		},
		' .vxt-timeline-desc-content': {
			'text-align': getLogicalTextAlign( alignMobile ),
			'font-size': generateCSSUnit( subHeadFontSizeMobile, subHeadFontSizeType ),
			'line-height': generateCSSUnit( subHeadLineHeightMobile, subHeadLineHeightType ),
			'margin-top': generateCSSUnit( authorSpaceMobile, 'px' ),
			'letter-spacing': generateCSSUnit( subHeadLetterSpacingMobile, subHeadLetterSpacingType ),
		},
		' .vxt-timeline__author-link + .vxt-timeline__link_parent': {
			'margin-top': generateCSSUnit( authorSpaceMobile, 'px' ),
		},
		'.vxt-timeline__center-block .vxt-timeline__marker': {
			'margin-left': generateCSSUnit( horizontalSpaceMobile, horizontalSpaceUnitMobile ),
			'margin-right': generateCSSUnit( horizontalSpaceMobile, horizontalSpaceUnitMobile ),
		},
		'.vxt-timeline__center-block .vxt-timeline__day-new.vxt-timeline__day-left': {
			'margin-left': generateCSSUnit( leftMarginMobile, mobileMarginUnit ),
			'margin-right': generateCSSUnit( rightMarginMobile, mobileMarginUnit ),
			'margin-top': generateCSSUnit( topMarginMobile, mobileMarginUnit ),
			'margin-bottom': generateCSSUnit( bottomMarginMobile, mobileMarginUnit ),
		},
		'.vxt-timeline__center-block .vxt-timeline__day-new.vxt-timeline__day-right': {
			'margin-left': generateCSSUnit( leftMarginMobile, mobileMarginUnit ),
			'margin-right': generateCSSUnit( rightMarginMobile, mobileMarginUnit ),
			'margin-top': generateCSSUnit( topMarginMobile, mobileMarginUnit ),
			'margin-bottom': generateCSSUnit( bottomMarginMobile, mobileMarginUnit ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__day-right .vxt-timeline__arrow:after':
			{
				'border-right-color': backgroundColor,
			},

		//Responsive alignment CSS

		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__heading': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline-desc-content': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__day-new': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__date-inner': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__date-hide.vxt-timeline__date-inner':
			{
				'text-align': getLogicalTextAlign( alignMobile ),
			},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__author-link': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__link_parent': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__link': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile .vxt-timeline__image a': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		'.vxt-timeline__center-block.vxt-timeline__responsive-mobile a.vxt-timeline__image': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},

		// CTA  AUthor
		' .dashicons-admin-users': {
			'font-size': generateCSSUnit( authorFontSizeMobile, authorFontSizeType ),
			'line-height': generateCSSUnit( authorLineHeightMobile, authorLineHeightType ),
			'letter-spacing': generateCSSUnit( authorLetterSpacingMobile, authorLetterSpacingType ),
		},
		' .vxt-timeline__link_parent': {
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		' .vxt-timeline__author-link': {
			'text-align': getLogicalTextAlign( alignMobile ),
			'font-size': generateCSSUnit( authorFontSizeMobile, authorFontSizeType ),
			'line-height': generateCSSUnit( authorLineHeightMobile, authorLineHeightType ),
			'letter-spacing': generateCSSUnit( authorLetterSpacingMobile, authorLetterSpacingType ),
		},
		' .vxt-timeline__link': {
			'text-align': getLogicalTextAlign( alignMobile ),
			'margin-bottom': generateCSSUnit( ctaBottomSpacingMobile, 'px' ),
		},
		' .vxt-timeline__events-inner--content': {
			'padding-left': generateCSSUnit( leftPaddingMobile, mobilePaddingUnit ),
			'padding-right': generateCSSUnit( rightPaddingMobile, mobilePaddingUnit ),
			'padding-top': generateCSSUnit( topPaddingMobile, mobilePaddingUnit ),
			'padding-bottom': generateCSSUnit( bottomPaddingMobile, mobilePaddingUnit ),
			'text-align': getLogicalTextAlign( alignMobile ),
		},
		' .vxt-timeline__events-inner-new': {
			'border-radius': generateCSSUnit( borderRadiusMobile, 'px' ),
		},
		' .vxt-timeline__field:not(:last-child)': {
			'margin-bottom': generateCSSUnit( verticalSpaceMobile, verticalSpaceUnitMobile ),
		},
	};

	if ( ! inheritFromTheme ) {
		selectors = {
			...selectors,
			' .vxt-timeline__link_parent .vxt-timeline__link': {
				'font-size': generateCSSUnit( ctaFontSize, ctaFontSizeType ),
				'font-family': ctaFontFamily,
				'font-weight': ctaFontWeight,
				'line-height': generateCSSUnit( ctaLineHeight, ctaLineHeightType ),
				color: ctaColor,
				'background-color': ctaBackground,
				'font-style': ctaFontStyle,
				'text-decoration': ctaDecoration,
				'text-transform': ctaTransform,
				'letter-spacing': generateCSSUnit( ctaLetterSpacing, ctaLetterSpacingType ),
			},
		};
		tabletSelectors = {
			...tabletSelectors,
			' .vxt-timeline__link_parent .vxt-timeline__link': {
				'font-size': generateCSSUnit( ctaFontSizeTablet, ctaFontSizeType ),
				'line-height': generateCSSUnit( ctaLineHeightTablet, ctaLineHeightType ),
				'letter-spacing': generateCSSUnit( ctaLetterSpacingTablet, ctaLetterSpacingType ),
			},
		};
		mobileSelectors = {
			...mobileSelectors,
			' .vxt-timeline__link_parent .vxt-timeline__link': {
				'font-size': generateCSSUnit( ctaFontSizeMobile, ctaFontSizeType ),
				'line-height': generateCSSUnit( ctaLineHeightMobile, ctaLineHeightType ),
				'letter-spacing': generateCSSUnit( ctaLetterSpacingMobile, ctaLetterSpacingType ),
			},
		};
	}

	let stylingCss = '';
	const id = `.editor-styles-wrapper .vxt-block-${ block_id }.vxt-timeline__outer-wrap`;

	stylingCss = generateCSS( selectors, id );

	if ( 'tablet' === previewType || 'mobile' === previewType ) {
		stylingCss += generateCSS( tabletSelectors, `${ id }`, true, 'tablet' );

		if ( 'mobile' === previewType ) {
			stylingCss += generateCSS( mobileSelectors, `${ id }`, true, 'mobile' );
		}
	}
	return stylingCss;
}

export default contentTimelineStyle;
