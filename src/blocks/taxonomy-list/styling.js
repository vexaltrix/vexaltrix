/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from '@Controls/generateCSS';
import generateCSSUnit from '@Controls/generateCSSUnit';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import generateBorderCSS from '@Controls/generateBorderCSS';

function styling( attributes, name, deviceType ) {
	const blockName = name.replace( 'vexaltrix/', '' );
	const previewType = deviceType.toLowerCase();
	const {
		block_id,
		columns,
		tcolumns,
		mcolumns,
		bgColor,
		titleColor,
		countColor,
		rowGap,
		rowGapTablet,
		rowGapMobile,
		columnGap,
		columnGapTablet,
		columnGapMobile,
		contentTopPadding,
		contentRightPadding,
		contentBottomPadding,
		contentLeftPadding,
		contentTopPaddingTablet,
		contentRightPaddingTablet,
		contentBottomPaddingTablet,
		contentLeftPaddingTablet,
		contentTopPaddingMobile,
		contentRightPaddingMobile,
		contentBottomPaddingMobile,
		contentLeftPaddingMobile,
		contentPaddingUnit,
		mobileContentPaddingUnit,
		tabletContentPaddingUnit,
		titleBottomSpace,
		titleBottomSpaceTablet,
		titleBottomSpaceMobile,
		alignment,
		listStyle,
		seperatorHoverColor,
		listTextColor,
		hoverlistTextColor,
		listBottomMargin,
		listStyleColor,
		hoverlistStyleColor,
		boxShadowColor,
		boxShadowHOffset,
		boxShadowVOffset,
		boxShadowBlur,
		boxShadowSpread,
		boxShadowPosition,
		titleFontSize,
		titleFontSizeType,
		titleFontSizeMobile,
		titleFontSizeTablet,
		titleFontFamily,
		titleFontWeight,
		titleLineHeightType,
		titleLineHeight,
		titleLineHeightTablet,
		titleLineHeightMobile,
		countFontSize,
		countFontSizeType,
		countFontSizeMobile,
		countFontSizeTablet,
		countFontFamily,
		countFontWeight,
		countLineHeightType,
		countLineHeight,
		countLineHeightTablet,
		countLineHeightMobile,
		listFontSize,
		listFontSizeType,
		listFontSizeMobile,
		listFontSizeTablet,
		listFontFamily,
		listFontWeight,
		listLineHeightType,
		listLineHeight,
		listLineHeightTablet,
		listLineHeightMobile,
		overallBorderHColor,
		titleFontStyle,
		countFontStyle,
		listFontStyle,
		titleTransform,
		countTransform,
		listTransform,
		titleDecoration,
		countDecoration,
		listDecoration,
		// letter spacing
		titleLetterSpacing,
		titleLetterSpacingTablet,
		titleLetterSpacingMobile,
		titleLetterSpacingType,
		countLetterSpacing,
		countLetterSpacingTablet,
		countLetterSpacingMobile,
		countLetterSpacingType,
		listLetterSpacing,
		listLetterSpacingTablet,
		listLetterSpacingMobile,
		listLetterSpacingType,
		seperatorStyle,
		seperatorWidth,
		seperatorThickness,
		seperatorColor,
	} = attributes;

	const listBottomMarginFallback = getFallbackNumber( listBottomMargin, 'listBottomMargin', blockName );
	const columnsFallback = getFallbackNumber( columns, 'columns', blockName );
	const tcolumnsFallback = getFallbackNumber( tcolumns, 'tcolumns', blockName );
	const mcolumnsFallback = getFallbackNumber( mcolumns, 'mcolumns', blockName );
	const titleBottomSpaceFallback = getFallbackNumber( titleBottomSpace, 'titleBottomSpace', blockName );
	const rowGapFallback = getFallbackNumber( rowGap, 'rowGap', blockName );
	const columnGapFallback = getFallbackNumber( columnGap, 'columnGap', blockName );

	const overallBorderCSS = generateBorderCSS( attributes, 'overall', '' );
	const overallBorderCSSTablet = generateBorderCSS( attributes, 'overall', 'tablet' );
	const overallBorderCSSMobile = generateBorderCSS( attributes, 'overall', 'mobile' );

	let selectors = {};
	let tabletSelectors = {};
	let mobileSelectors = {};

	let boxShadowPositionCSS = boxShadowPosition;

	if ( 'outset' === boxShadowPosition ) {
		boxShadowPositionCSS = '';
	}

	selectors = {
		//grid layout styling
		'.vxt-taxonomy__outer-wrap.vxt-layout-grid': {
			display: 'grid',
			'grid-template-columns': 'repeat(' + columnsFallback + ', 1fr)',
			'grid-column-gap': generateCSSUnit( columnGapFallback, 'px' ),
			'grid-row-gap': generateCSSUnit( rowGapFallback, 'px' ),
		},

		'.vxt-layout-grid .vxt-taxomony-box': {
			'padding-top': generateCSSUnit( contentTopPadding, contentPaddingUnit ),
			'padding-bottom': generateCSSUnit( contentBottomPadding, contentPaddingUnit ),
			'padding-left': generateCSSUnit( contentLeftPadding, contentPaddingUnit ),
			'padding-right': generateCSSUnit( contentRightPadding, contentPaddingUnit ),
			'background-color': bgColor,
			'text-align': alignment,
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
		},
		'.vxt-layout-grid .vxt-tax-link': {
			color: countColor,
			'font-size': generateCSSUnit( countFontSize, countFontSizeType ),
			'font-family': countFontFamily,
			'font-weight': countFontWeight,
			'line-height': generateCSSUnit( countLineHeight, countLineHeightType ),
			'font-style': countFontStyle,
			'text-decoration': countDecoration,
			'text-transform': countTransform,
			'letter-spacing': generateCSSUnit( countLetterSpacing, countLetterSpacingType ),
			'pointer-events': 'none',
		},
		'.vxt-layout-grid .vxt-tax-title': {
			color: titleColor,
			'margin-top': '0',
			'margin-bottom': generateCSSUnit( titleBottomSpaceFallback, 'px' ),
			'font-size': generateCSSUnit( titleFontSize, titleFontSizeType ),
			'font-family': titleFontFamily,
			'font-weight': titleFontWeight,
			'line-height': generateCSSUnit( titleLineHeight, titleLineHeightType ),
			'font-style': titleFontStyle,
			'text-decoration': titleDecoration,
			'text-transform': titleTransform,
			'letter-spacing': generateCSSUnit( titleLetterSpacing, titleLetterSpacingType ),
		},
		'.vxt-layout-list .vxt-tax-list': {
			'list-style': listStyle,
			color: listStyleColor,
			'font-size': generateCSSUnit( listFontSize, listFontSizeType ),
			'font-family': listFontFamily,
			'font-weight': listFontWeight,
			'line-height': generateCSSUnit( listLineHeight, listLineHeightType ),
			'font-style': listFontStyle,
			'text-decoration': listDecoration,
			'text-transform': listTransform,
			'letter-spacing': generateCSSUnit( listLetterSpacing, listLetterSpacingType ),
		},
		'.vxt-layout-list .vxt-tax-list:hover': {
			// For Bullets.
			color: hoverlistStyleColor,
		},
		'.vxt-layout-list .vxt-tax-link-wrap:hover': {
			// For Numbers.
			color: hoverlistStyleColor,
		},
		'.vxt-layout-list .vxt-tax-list a.vxt-tax-link': {
			color: listTextColor,
		},
		'.vxt-layout-list .vxt-tax-list a.vxt-tax-link:hover': {
			color: hoverlistTextColor,
		},
		'.vxt-layout-list .vxt-tax-list .vxt-tax-link-wrap': {
			'margin-bottom': generateCSSUnit( listBottomMarginFallback, 'px' ),
		},
		/* start Backword */
		//grid layout styling
		' .vxt-taxonomy-wrap.vxt-layout-grid': {
			display: 'grid',
			'grid-template-columns': 'repeat(' + columnsFallback + ', 1fr)',
			'grid-column-gap': generateCSSUnit( columnGapFallback, 'px' ),
			'grid-row-gap': generateCSSUnit( rowGapFallback, 'px' ),
		},
		' .vxt-layout-grid .vxt-taxomony-box': {
			'padding-top': generateCSSUnit( contentTopPadding, contentPaddingUnit ),
			'padding-bottom': generateCSSUnit( contentBottomPadding, contentPaddingUnit ),
			'padding-left': generateCSSUnit( contentLeftPadding, contentPaddingUnit ),
			'padding-right': generateCSSUnit( contentRightPadding, contentPaddingUnit ),
			'background-color': bgColor,
			'text-align': alignment,
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
		},
		' .vxt-layout-grid .vxt-tax-title': {
			color: titleColor,
			'margin-top': '0',
			'margin-bottom': generateCSSUnit( titleBottomSpaceFallback, 'px' ),
			'font-size': generateCSSUnit( titleFontSize, titleFontSizeType ),
			'font-family': titleFontFamily,
			'font-weight': titleFontWeight,
			'line-height': generateCSSUnit( titleLineHeight, titleLineHeightType ),
			'font-style': titleFontStyle,
			'text-decoration': titleDecoration,
			'text-transform': titleTransform,
		},
		' .vxt-layout-grid .vxt-tax-link': {
			color: countColor,
			'font-size': generateCSSUnit( countFontSize, countFontSizeType ),
			'font-family': countFontFamily,
			'font-weight': countFontWeight,
			'line-height': generateCSSUnit( countLineHeight, countLineHeightType ),
			'font-style': countFontStyle,
			'text-decoration': countDecoration,
			'text-transform': countTransform,
		},
		//List layout styling.
		' .vxt-layout-list .vxt-tax-list': {
			'list-style': listStyle,
			color: listStyleColor,
			'font-size': generateCSSUnit( listFontSize, listFontSizeType ),
			'font-family': listFontFamily,
			'font-weight': listFontWeight,
			'line-height': generateCSSUnit( listLineHeight, listLineHeightType ),
			'font-style': listFontStyle,
			'text-decoration': listDecoration,
			'text-transform': listTransform,
		},
		' .vxt-layout-list .vxt-tax-list:hover': {
			color: hoverlistStyleColor,
		},
		' .vxt-layout-list .vxt-tax-list a.vxt-tax-link': {
			color: listTextColor,
		},
		' .vxt-layout-list .vxt-tax-list a.vxt-tax-link:hover': {
			color: hoverlistTextColor,
		},
		' .vxt-layout-list .vxt-tax-list .vxt-tax-link-wrap': {
			'margin-bottom': generateCSSUnit( listBottomMarginFallback, 'px' ),
		},
		/* End Backword */
	};
	if ( seperatorStyle !== 'none' ) {
		/* start Backword */
		selectors[ ' .vxt-layout-list .vxt-tax-separator' ] = {
			'border-top-color': seperatorColor,
			'border-top-style': seperatorStyle,
			'border-top-width': generateCSSUnit( seperatorThickness, 'px' ),
			width: generateCSSUnit( seperatorWidth, '%' ),
		};
		selectors[ ' .vxt-layout-list .vxt-tax-separator:hover' ] = {
			'border-top-color': seperatorHoverColor,
		};
		/* End Backword */
		selectors[ '.vxt-layout-list .vxt-tax-separator' ] = {
			'border-top-color': seperatorColor,
			'border-top-style': seperatorStyle,
			'border-top-width': generateCSSUnit( seperatorThickness, 'px' ),
			width: generateCSSUnit( seperatorWidth, '%' ),
		};
		selectors[ '.vxt-layout-list .vxt-tax-separator:hover' ] = {
			'border-top-color': seperatorHoverColor,
		};
	}
	/* start Backword */
	selectors[ ' .vxt-layout-list .vxt-tax-separator:hover' ] = {
		'border-top-color': seperatorHoverColor,
	};
	/* End Backword */
	selectors[ '.vxt-layout-list .vxt-tax-separator:hover' ] = {
		'border-top-color': seperatorHoverColor,
	};

	selectors[ ' .vxt-taxomony-box' ] = overallBorderCSS;
	selectors[ ' .vxt-taxomony-box:hover' ] = {
		'border-color': overallBorderHColor,
	};

	mobileSelectors = {
		'.vxt-taxonomy__outer-wrap.vxt-layout-grid': {
			'grid-template-columns': 'repeat(' + mcolumnsFallback + ', 1fr)',
			'grid-column-gap': generateCSSUnit( columnGapMobile, 'px' ),
			'grid-row-gap': generateCSSUnit( rowGapMobile, 'px' ),
		},
		'.vxt-layout-grid .vxt-taxomony-box': {
			'padding-top': generateCSSUnit( contentTopPaddingMobile, mobileContentPaddingUnit ),
			'padding-bottom': generateCSSUnit( contentBottomPaddingMobile, mobileContentPaddingUnit ),
			'padding-left': generateCSSUnit( contentLeftPaddingMobile, mobileContentPaddingUnit ),
			'padding-right': generateCSSUnit( contentRightPaddingMobile, mobileContentPaddingUnit ),
			...overallBorderCSSMobile,
		},
		'.vxt-layout-grid .vxt-tax-title': {
			'font-size': generateCSSUnit( titleFontSizeMobile, titleFontSizeType ),
			'line-height': generateCSSUnit( titleLineHeightMobile, titleLineHeightType ),
			'margin-bottom': generateCSSUnit( titleBottomSpaceMobile, 'px' ),
			'letter-spacing': generateCSSUnit( titleLetterSpacingMobile, titleLetterSpacingType ),
		},
		'.vxt-layout-grid .vxt-tax-link': {
			'font-size': generateCSSUnit( countFontSizeMobile, countFontSizeType ),
			'line-height': generateCSSUnit( countLineHeightMobile, countLineHeightType ),
			'letter-spacing': generateCSSUnit( countLetterSpacingMobile, countLetterSpacingType ),
		},
		'.vxt-layout-list .vxt-tax-list': {
			'font-size': generateCSSUnit( listFontSizeMobile, listFontSizeType ),
			'line-height': generateCSSUnit( listLineHeightMobile, listLineHeightType ),
			'letter-spacing': generateCSSUnit( listLetterSpacingMobile, listLetterSpacingType ),
		},
		/* For Backword */
		' .vxt-taxonomy-wrap.vxt-layout-grid': {
			'grid-template-columns': 'repeat(' + mcolumnsFallback + ', 1fr)',
		},
		' .vxt-layout-grid .vxt-taxomony-box': {
			'padding-top': generateCSSUnit( contentTopPaddingMobile, mobileContentPaddingUnit ),
			'padding-bottom': generateCSSUnit( contentBottomPaddingMobile, mobileContentPaddingUnit ),
			'padding-left': generateCSSUnit( contentLeftPaddingMobile, mobileContentPaddingUnit ),
			'padding-right': generateCSSUnit( contentRightPaddingMobile, mobileContentPaddingUnit ),
		},
		' .vxt-layout-grid .vxt-tax-title': {
			'font-size': generateCSSUnit( titleFontSizeMobile, titleFontSizeType ),
			'line-height': generateCSSUnit( titleLineHeightMobile, titleLineHeightType ),
		},
		' .vxt-layout-grid .vxt-tax-link': {
			'font-size': generateCSSUnit( countFontSizeMobile, countFontSizeType ),
			'line-height': generateCSSUnit( countLineHeightMobile, countLineHeightType ),
		},
		' .vxt-layout-list .vxt-tax-list': {
			'font-size': generateCSSUnit( listFontSizeMobile, listFontSizeType ),
			'line-height': generateCSSUnit( listLineHeightMobile, listLineHeightType ),
		},
		/* End Backword */
	};

	tabletSelectors = {
		'.vxt-taxonomy__outer-wrap.vxt-layout-grid': {
			'grid-template-columns': 'repeat(' + tcolumnsFallback + ', 1fr)',
			'grid-column-gap': generateCSSUnit( columnGapTablet, 'px' ),
			'grid-row-gap': generateCSSUnit( rowGapTablet, 'px' ),
		},
		'.vxt-layout-grid .vxt-taxomony-box': {
			'padding-top': generateCSSUnit( contentTopPaddingTablet, tabletContentPaddingUnit ),
			'padding-bottom': generateCSSUnit( contentBottomPaddingTablet, tabletContentPaddingUnit ),
			'padding-left': generateCSSUnit( contentLeftPaddingTablet, tabletContentPaddingUnit ),
			'padding-right': generateCSSUnit( contentRightPaddingTablet, tabletContentPaddingUnit ),
			...overallBorderCSSTablet,
		},
		'.vxt-layout-grid .vxt-tax-title': {
			'font-size': generateCSSUnit( titleFontSizeTablet, titleFontSizeType ),
			'line-height': generateCSSUnit( titleLineHeightTablet, titleLineHeightType ),

			'margin-bottom': generateCSSUnit( titleBottomSpaceTablet, 'px' ),
			'letter-spacing': generateCSSUnit( titleLetterSpacingTablet, titleLetterSpacingType ),
		},
		'.vxt-layout-grid .vxt-tax-link': {
			'font-size': generateCSSUnit( countFontSizeTablet, countFontSizeType ),
			'line-height': generateCSSUnit( countLineHeightTablet, countLineHeightType ),
			'letter-spacing': generateCSSUnit( countLetterSpacingTablet, countLetterSpacingType ),
		},
		'.vxt-layout-list .vxt-tax-list': {
			'font-size': generateCSSUnit( listFontSizeTablet, listFontSizeType ),
			'line-height': generateCSSUnit( listLineHeightTablet, listLineHeightType ),
			'letter-spacing': generateCSSUnit( listLetterSpacingTablet, listLetterSpacingType ),
		},
		/* For Backword. */
		' .vxt-taxonomy-wrap.vxt-layout-grid': {
			'grid-template-columns': 'repeat(' + tcolumnsFallback + ', 1fr)',
		},
		' .vxt-layout-grid .vxt-taxomony-box': {
			'padding-top': generateCSSUnit( contentTopPaddingTablet, tabletContentPaddingUnit ),
			'padding-bottom': generateCSSUnit( contentBottomPaddingTablet, tabletContentPaddingUnit ),
			'padding-left': generateCSSUnit( contentLeftPaddingTablet, tabletContentPaddingUnit ),
			'padding-right': generateCSSUnit( contentRightPaddingTablet, tabletContentPaddingUnit ),
		},
		' .vxt-layout-grid .vxt-tax-title': {
			'font-size': generateCSSUnit( titleFontSizeTablet, titleFontSizeType ),
			'line-height': generateCSSUnit( titleLineHeightTablet, titleLineHeightType ),
		},
		' .vxt-layout-grid .vxt-tax-link': {
			'font-size': generateCSSUnit( countFontSizeTablet, countFontSizeType ),
			'line-height': generateCSSUnit( countLineHeightTablet, countLineHeightType ),
		},
		' .vxt-layout-list .vxt-tax-list': {
			'font-size': generateCSSUnit( listFontSizeTablet, listFontSizeType ),
			'line-height': generateCSSUnit( listLineHeightTablet, listLineHeightType ),
		},
		/* End Backword */
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
