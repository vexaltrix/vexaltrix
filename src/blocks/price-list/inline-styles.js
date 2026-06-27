/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from '@Controls/generateCSS';
import generateCSSUnit from '@Controls/generateCSSUnit';
import { getFallbackNumber } from '@Controls/getAttributeFallback';

function RestMenuStyle( attributes, clientId, name, deviceType ) {
	const {
		block_id,
		headingAlign,
		priceColor,
		descColor,
		titleColor,
		titleFontSizeType,
		titleFontSize,
		titleFontSizeTablet,
		titleFontSizeMobile,
		titleFontFamily,
		titleFontWeight,
		titleLineHeightType,
		titleLineHeight,
		titleLineHeightTablet,
		titleLineHeightMobile,
		priceFontSizeType,
		priceFontSize,
		priceFontSizeTablet,
		priceFontSizeMobile,
		priceFontFamily,
		priceFontWeight,
		priceLineHeightType,
		priceLineHeight,
		priceLineHeightTablet,
		priceLineHeightMobile,
		descFontSizeType,
		descFontSize,
		descFontSizeTablet,
		descFontSizeMobile,
		descFontFamily,
		descFontWeight,
		descLineHeightType,
		descLineHeight,
		descLineHeightTablet,
		descLineHeightMobile,
		descSpace,
		titleSpace,
		titleSpaceTablet,
		titleSpaceMobile,
		imageWidth,
		imageWidthTablet,
		imageWidthMobile,
		rowGap,
		rowGapTablet,
		rowGapMobile,
		columnGap,
		columnGapTablet,
		columnGapMobile,
		seperatorStyle,
		seperatorWidth,
		seperatorWidthTablet,
		seperatorWidthMobile,
		seperatorThickness,
		seperatorColor,

		imageWidthType,
		seperatorWidthType,
		rowGapType,
		columnGapType,
		titleSpaceType,
		contentPaddingTop,
		contentPaddingRight,
		contentPaddingBottom,
		contentPaddingLeft,
		contentPaddingTopTablet,
		contentPaddingRightTablet,
		contentPaddingBottomTablet,
		contentPaddingLeftTablet,
		contentPaddingTopMobile,
		contentPaddingRightMobile,
		contentPaddingBottomMobile,
		contentPaddingLeftMobile,
		contentPaddingUnit,
		contentMobilePaddingUnit,
		contentTabletPaddingUnit,
		imgPaddingTop,
		imgPaddingRight,
		imgPaddingBottom,
		imgPaddingLeft,
		imgPaddingTopTablet,
		imgPaddingRightTablet,
		imgPaddingBottomTablet,
		imgPaddingLeftTablet,
		imgPaddingTopMobile,
		imgPaddingRightMobile,
		imgPaddingBottomMobile,
		imgPaddingLeftMobile,
		imgPaddingUnit,
		imgMobilePaddingUnit,
		imgTabletPaddingUnit,
		titleFontStyle,
		titleTransform,
		titleDecoration,
		descFontStyle,
		descTransform,
		descDecoration,
		priceFontStyle,
		priceTransform,
		priceDecoration,
		descLetterSpacing,
		descLetterSpacingTablet,
		descLetterSpacingMobile,
		descLetterSpacingType,
		priceLetterSpacing,
		priceLetterSpacingTablet,
		priceLetterSpacingMobile,
		priceLetterSpacingType,
		titleLetterSpacing,
		titleLetterSpacingTablet,
		titleLetterSpacingMobile,
		titleLetterSpacingType,
		imagePosition,
		imgAlign,
		imageAlignment,
		stack,
	} = attributes;
	const previewType = deviceType.toLowerCase();
	const blockName = name.replace( 'vexaltrix/', '' );

	const seperatorThicknessFallback = getFallbackNumber( seperatorThickness, 'seperatorThickness', blockName );

	const rowGapFallback = getFallbackNumber( rowGap, 'rowGap', blockName );
	const rowGapTabletFallback = getFallbackNumber( rowGapTablet, 'rowGapTablet', blockName );
	const rowGapMobileFallback = getFallbackNumber( rowGapMobile, 'rowGapMobile', blockName );

	const columnGapFallback = getFallbackNumber( columnGap, 'columnGap', blockName );
	const columnGapTabletFallback = isNaN( columnGapTablet ) ? columnGapFallback : columnGapTablet;
	const columnGapMobileFallback = isNaN( columnGapMobile ) ? columnGapTabletFallback : columnGapMobile;

	const imageWidthFallback = getFallbackNumber( imageWidth, 'imageWidth', blockName );
	const imageWidthTabletFallback = isNaN( imageWidthTablet ) ? imageWidthFallback : imageWidthTablet;
	const imageWidthMobileFallback = isNaN( imageWidthMobile ) ? imageWidthTabletFallback : imageWidthMobile;

	const seperatorWidthFallback = getFallbackNumber( seperatorWidth, 'seperatorWidth', blockName );
	const seperatorWidthTabletFallback = getFallbackNumber( seperatorWidthTablet, 'seperatorWidthTablet', blockName );
	const seperatorWidthMobileFallback = getFallbackNumber( seperatorWidthMobile, 'seperatorWidthMobile', blockName );

	const titleSpaceFallback = getFallbackNumber( titleSpace, 'titleSpace', blockName );
	const titleSpaceTabletFallback = getFallbackNumber( titleSpaceTablet, 'titleSpaceTablet', blockName );
	const titleSpaceMobileFallback = getFallbackNumber( titleSpaceMobile, 'titleSpaceMobile', blockName );

	let tabletSelectors = {};
	let mobileSelectors = {};

	const selectors = {
		' .block-editor-block-list__layout': {
			'column-gap': generateCSSUnit( columnGapFallback, columnGapType ),
			'row-gap': generateCSSUnit( rowGapFallback, rowGapType ),
		},
		" [data-type='vexaltrix/restaurant-menu-child'] img": {
			'padding-left': generateCSSUnit( imgPaddingLeft, imgPaddingUnit ),
			'padding-right': generateCSSUnit( imgPaddingRight, imgPaddingUnit ),
			'padding-top': generateCSSUnit( imgPaddingTop, imgPaddingUnit ),
			'padding-bottom': generateCSSUnit( imgPaddingBottom, imgPaddingUnit ),
		},
		// Image
		' img': {
			width: generateCSSUnit( imageWidthFallback, imageWidthType ),
			'max-width': generateCSSUnit( imageWidthFallback, imageWidthType ),
		},
		' .vxt-rm__content': {
			'padding-left': generateCSSUnit( contentPaddingLeft, contentPaddingUnit ),
			'padding-right': generateCSSUnit( contentPaddingRight, contentPaddingUnit ),
			'padding-top': generateCSSUnit( contentPaddingTop, contentPaddingUnit ),
			'padding-bottom': generateCSSUnit( contentPaddingBottom, contentPaddingUnit ),
		},
		// Prefix Style
		'.wp-block-vxt-restaurant-menu .vxt-rest_menu__wrap .vxt-rm__content .vxt-rm-details .vxt-rm__title': {
			'font-size': generateCSSUnit( titleFontSize, titleFontSizeType ),
			color: titleColor,
			'margin-bottom': generateCSSUnit( titleSpaceFallback, titleSpaceType ),
			'font-family': titleFontFamily,
			'font-style': titleFontStyle,
			'text-transform': titleTransform,
			'text-decoration': titleDecoration,
			'font-weight': titleFontWeight,
			'line-height': generateCSSUnit( titleLineHeight, titleLineHeightType ),
			'letter-spacing': generateCSSUnit( titleLetterSpacing, titleLetterSpacingType ),
		},
		// Title Style
		' .vxt-rm__price': {
			'font-size': generateCSSUnit( priceFontSize, priceFontSizeType ),
			'font-family': priceFontFamily,
			'text-transform': priceTransform,
			'text-decoration': priceDecoration,
			'font-style': priceFontStyle,
			'font-weight': priceFontWeight,
			'line-height': generateCSSUnit( priceLineHeight, priceLineHeightType ),
			color: priceColor,
			'letter-spacing': generateCSSUnit( priceLetterSpacing, priceLetterSpacingType ),
		},
		// Description Style
		' .vxt-rm__desc': {
			'font-size': generateCSSUnit( descFontSize, descFontSizeType ),
			'font-family': descFontFamily,
			'text-transform': descTransform,
			'text-decoration': descDecoration,
			'font-style': descFontStyle,
			'font-weight': descFontWeight,
			'line-height': generateCSSUnit( descLineHeight, descLineHeightType ),
			color: descColor,
			'margin-bottom': generateCSSUnit( descSpace, 'px' ),
			'letter-spacing': generateCSSUnit( descLetterSpacing, descLetterSpacingType ),
		},
	};

	tabletSelectors = {
		// Image
		' img': {
			width: generateCSSUnit( imageWidthTabletFallback, imageWidthType ),
			'max-width': generateCSSUnit( imageWidthTabletFallback, imageWidthType ),
		},
		' .block-editor-block-list__layout': {
			'column-gap': generateCSSUnit( columnGapTabletFallback, columnGapType ),
			'row-gap': generateCSSUnit( rowGapTabletFallback, rowGapType ),
		},
		'.wp-block-vxt-restaurant-menu .vxt-rest_menu__wrap .vxt-rm__content .vxt-rm-details .vxt-rm__title': {
			'font-size': generateCSSUnit( titleFontSizeTablet, titleFontSizeType ),
			'line-height': generateCSSUnit( titleLineHeightTablet, titleLineHeightType ),
			'margin-bottom': generateCSSUnit( titleSpaceTabletFallback, titleSpaceType ),
			'letter-spacing': generateCSSUnit( titleLetterSpacingTablet, titleLetterSpacingType ),
		},
		' .vxt-rm__desc': {
			'font-size': generateCSSUnit( descFontSizeTablet, descFontSizeType ),
			'line-height': generateCSSUnit( descLineHeightTablet, descLineHeightType ),
			'letter-spacing': generateCSSUnit( descLetterSpacingTablet, descLetterSpacingType ),
		},
		' .vxt-rm__price': {
			'font-size': generateCSSUnit( priceFontSizeTablet, priceFontSizeType ),
			'line-height': generateCSSUnit( priceLineHeightTablet, priceLineHeightType ),
			'letter-spacing': generateCSSUnit( priceLetterSpacingTablet, priceLetterSpacingType ),
		},
		" [data-type='vexaltrix/restaurant-menu-child'] img": {
			'padding-left': generateCSSUnit( imgPaddingLeftTablet, imgTabletPaddingUnit ),
			'padding-right': generateCSSUnit( imgPaddingRightTablet, imgTabletPaddingUnit ),
			'padding-top': generateCSSUnit( imgPaddingTopTablet, imgTabletPaddingUnit ),
			'padding-bottom': generateCSSUnit( imgPaddingBottomTablet, imgTabletPaddingUnit ),
		},
		' .vxt-rm__content': {
			'padding-left': generateCSSUnit( contentPaddingLeftTablet, contentTabletPaddingUnit ),
			'padding-right': generateCSSUnit( contentPaddingRightTablet, contentTabletPaddingUnit ),
			'padding-top': generateCSSUnit( contentPaddingTopTablet, contentTabletPaddingUnit ),
			'padding-bottom': generateCSSUnit( contentPaddingBottomTablet, contentTabletPaddingUnit ),
		},
	};

	mobileSelectors = {
		// Image
		' img': {
			width: generateCSSUnit( imageWidthMobileFallback, imageWidthType ),
			'max-width': generateCSSUnit( imageWidthMobileFallback, imageWidthType ),
		},
		' .block-editor-block-list__layout': {
			'column-gap': generateCSSUnit( columnGapMobileFallback, columnGapType ),
			'row-gap': generateCSSUnit( rowGapMobileFallback, rowGapType ),
		},
		'.wp-block-vxt-restaurant-menu .vxt-rest_menu__wrap .vxt-rm__content .vxt-rm-details .vxt-rm__title': {
			'font-size': generateCSSUnit( titleFontSizeMobile, titleFontSizeType ),
			'line-height': generateCSSUnit( titleLineHeightMobile, titleLineHeightType ),
			'margin-bottom': generateCSSUnit( titleSpaceMobileFallback, titleSpaceType ),
			'letter-spacing': generateCSSUnit( titleLetterSpacingMobile, titleLetterSpacingType ),
		},
		' .vxt-rm__desc': {
			'font-size': generateCSSUnit( descFontSizeMobile, descFontSizeType ),
			'line-height': generateCSSUnit( descLineHeightMobile, descLineHeightType ),
			'letter-spacing': generateCSSUnit( descLetterSpacingMobile, descLetterSpacingType ),
		},
		' .vxt-rm__price': {
			'font-size': generateCSSUnit( priceFontSizeMobile, priceFontSizeType ),
			'line-height': generateCSSUnit( priceLineHeightMobile, priceLineHeightType ),
			'letter-spacing': generateCSSUnit( priceLetterSpacingMobile, priceLetterSpacingType ),
		},
		" [data-type='vexaltrix/restaurant-menu-child'] img": {
			'padding-left': generateCSSUnit( imgPaddingLeftMobile, imgMobilePaddingUnit ),
			'padding-right': generateCSSUnit( imgPaddingRightMobile, imgMobilePaddingUnit ),
			'padding-top': generateCSSUnit( imgPaddingTopMobile, imgMobilePaddingUnit ),
			'padding-bottom': generateCSSUnit( imgPaddingBottomMobile, imgMobilePaddingUnit ),
		},
		' .vxt-rm__content': {
			'padding-left': generateCSSUnit( contentPaddingLeftMobile, contentMobilePaddingUnit ),
			'padding-right': generateCSSUnit( contentPaddingRightMobile, contentMobilePaddingUnit ),
			'padding-top': generateCSSUnit( contentPaddingTopMobile, contentMobilePaddingUnit ),
			'padding-bottom': generateCSSUnit( contentPaddingBottomMobile, contentMobilePaddingUnit ),
		},
	};

	if ( seperatorStyle !== 'none' ) {
		selectors[ ' .vxt-rm__separator' ] = {
			'border-top-color': seperatorColor,
			'border-top-style': seperatorStyle,
			'border-top-width': generateCSSUnit( seperatorThicknessFallback, 'px' ),
			width: generateCSSUnit( seperatorWidthFallback, seperatorWidthType ),
		};
		tabletSelectors[ ' .vxt-rm__separator' ] = {
			width: generateCSSUnit( seperatorWidthTabletFallback, seperatorWidthType ),
		};
		mobileSelectors[ ' .vxt-rm__separator' ] = {
			width: generateCSSUnit( seperatorWidthMobileFallback, seperatorWidthType ),
		};
	}

	if ( imgAlign === 'side' ) {
		selectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__content' ] = {
			'align-items': imageAlignment === 'top' ? 'flex-start' : 'center',
		};

		if ( stack === 'tablet' ) {
			if ( imagePosition === 'left' ) {
				tabletSelectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__content' ] = {
					display: 'block',
				};
				mobileSelectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__content' ] = {
					display: 'block',
				};
			} else {
				tabletSelectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__content' ] = {
					display: 'flex',
					'flex-direction': 'column-reverse',
					'align-items': 'flex-end',
				};
				mobileSelectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__content' ] = {
					display: 'flex',
					'flex-direction': 'column-reverse',
					'align-items': 'flex-end',
				};
			}
		} else if ( stack === 'mobile' ) {
			if ( imagePosition === 'left' ) {
				mobileSelectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__content' ] = {
					display: 'block',
				};
			} else {
				mobileSelectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__content' ] = {
					display: 'flex',
					'flex-direction': 'column-reverse',
					'align-items': 'flex-end',
				};
			}
		}
		if ( imagePosition === 'left' ) {
			selectors[ ' .vxt-rm-details' ] = {
				'text-align': 'left',
			};
		} else if ( imagePosition === 'right' ) {
			selectors[ ' .vxt-rm-details' ] = {
				'text-align': 'right',
			};
			selectors[ ' .vxt-rest_menu__wrap .vxt-rm__content' ] = {
				'text-align': 'right',
			};
			selectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__separator' ] = {
				'margin-left': 'auto',
			};
		}
	}

	if ( imgAlign === 'top' ) {
		selectors[ ' .wp-block-vxt-restaurant-menu-child ' ] = {
			'text-align': headingAlign,
			display: 'block',
		};
		selectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__content' ] = {
			'text-align': headingAlign,
		};

		if ( 'center' === headingAlign ) {
			selectors[ ' .vxt-rm__content ' ] = {
				display: 'block',
			};
			selectors[ ' .vxt-rm__content ' ] = {
				display: 'block',
			};
			selectors[ ' .wp-block-vxt-restaurant-menu-child  .vxt-rm__separator' ] = {
				margin: '0 auto',
			};
		} else if ( 'right' === headingAlign ) {
			selectors[ ' .wp-block-vxt-restaurant-menu-child .vxt-rm__separator' ] = {
				'margin-left': 'auto',
			};
		}
	}

	let stylingCss = '';
	const id = `.editor-styles-wrapper .vxt-block-${ block_id }`;

	stylingCss = generateCSS( selectors, id );

	if ( 'tablet' === previewType || 'mobile' === previewType ) {
		stylingCss += generateCSS( tabletSelectors, `${ id }`, true, 'tablet' );

		if ( 'mobile' === previewType ) {
			stylingCss += generateCSS( mobileSelectors, `${ id }`, true, 'mobile' );
		}
	}
	return stylingCss;
}

export default RestMenuStyle;
