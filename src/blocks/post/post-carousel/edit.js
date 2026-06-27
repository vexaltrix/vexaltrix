/**
 * External dependencies
 */

import styling from '.././styling';
import { __ } from '@wordpress/i18n';
import { useState, useEffect, useMemo } from '@wordpress/element';
import TypographyControl from '@Components/typography';
import { decodeEntities } from '@wordpress/html-entities';
import ResponsiveBorder from '@Components/responsive-border';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import SpacingControl from '@Components/spacing-control';
import Range from '@Components/range/Range.js';
import ResponsiveSlider from '@Components/responsive-slider';
import UAGTabsControl from '@Components/tabs';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UAGSelectControl from '@Components/select-control';
import renderSVG from '@Controls/renderIcon';
import presets, { buttonsPresets } from './presets';
import UAGPresets from '@Components/presets';
import scrollBlockToView from '@Controls/scrollBlockToView';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import UAGNumberControl from '@Components/number-control';
import responsiveConditionPreview from '@Controls/responsiveConditionPreview';
import apiFetch from '@wordpress/api-fetch';
import UAGTextControl from '@Components/text-control';
import DynamicCSSLoader from '@Components/dynamic-css-loader';
import DynamicFontLoader from '.././dynamicFontLoader';
import { compose } from '@wordpress/compose';
import AddStaticStyles from '@Controls/AddStaticStyles';
const MAX_POSTS_COLUMNS = 8;
import addInitialAttr from '@Controls/addInitialAttr';
import Settings from './settings';
import Render from './render';
import { Placeholder, Spinner, ToggleControl, Icon } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import { useSelect, useDispatch } from '@wordpress/data';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const VexaltrixPostCarousel = ( props ) => {
	const {
		isSelected,
		attributes,
		attributes: {
			align,
			displayPostTitle,
			displayPostDate,
			displayPostComment,
			displayPostExcerpt,
			displayPostAuthor,
			displayPostImage,
			displayPostTaxonomy,
			imgSize,
			imgPosition,
			displayPostLink,
			newTab,
			ctaText,
			columns,
			tcolumns,
			mcolumns,
			rowGap,
			rowGapTablet,
			rowGapMobile,
			bgType,
			bgColor,
			titleColor,
			titleTag,
			titleFontSize,
			titleFontSizeType,
			titleFontSizeMobile,
			titleFontSizeTablet,
			titleFontFamily,
			titleFontWeight,
			titleFontStyle,
			titleLineHeightType,
			titleLineHeight,
			titleLineHeightTablet,
			titleLineHeightMobile,
			titleLoadGoogleFonts,
			metaFontSize,
			metaFontSizeType,
			metaFontSizeMobile,
			metaFontSizeTablet,
			metaFontFamily,
			metaFontWeight,
			metaFontStyle,
			metaLineHeightType,
			metaLineHeight,
			metaLineHeightTablet,
			metaLineHeightMobile,
			metaLoadGoogleFonts,
			excerptFontSize,
			excerptFontSizeType,
			excerptFontSizeTablet,
			excerptFontSizeMobile,
			excerptFontFamily,
			excerptFontWeight,
			excerptFontStyle,
			excerptLineHeightType,
			excerptLineHeight,
			excerptLineHeightTablet,
			excerptLineHeightMobile,
			excerptLoadGoogleFonts,
			ctaFontSize,
			ctaFontSizeType,
			ctaFontSizeTablet,
			ctaFontSizeMobile,
			ctaFontFamily,
			ctaFontWeight,
			ctaFontStyle,
			ctaLineHeightType,
			ctaLineHeight,
			ctaLineHeightTablet,
			ctaLineHeightMobile,
			ctaLoadGoogleFonts,
			metaColor,
			excerptColor,
			ctaColor,
			ctaBgType,
			ctaBgHType,
			ctaBgColor,
			ctaHColor,
			ctaBgHColor,
			imageBottomSpace,
			imageBottomSpaceTablet,
			imageBottomSpaceMobile,
			taxonomyBottomSpace,
			taxonomyBottomSpaceTablet,
			taxonomyBottomSpaceMobile,
			titleBottomSpace,
			titleBottomSpaceTablet,
			titleBottomSpaceMobile,
			metaBottomSpace,
			metaBottomSpaceTablet,
			metaBottomSpaceMobile,
			excerptBottomSpace,
			excerptBottomSpaceTablet,
			excerptBottomSpaceMobile,
			ctaBottomSpace,
			ctaBottomSpaceTablet,
			ctaBottomSpaceMobile,
			autoplay,
			autoplaySpeed,
			pauseOnHover,
			infiniteLoop,
			transitionSpeed,
			arrowDots,
			arrowSize,
			arrowColor,
			arrowBorderSize,
			arrowBorderRadius,
			arrowDistance,
			arrowDistanceTablet,
			arrowDistanceMobile,
			excerptLength,
			overlayOpacity,
			bgOverlayColor,
			linkBox,
			postDisplaytext,
			displayPostContentRadio,
			titleTransform,
			metaTransform,
			excerptTransform,
			ctaTransform,
			titleDecoration,
			metaDecoration,
			excerptDecoration,
			ctaDecoration,
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
			spacingLink,
			spacingLinkPadding,
			contentPaddingUnit,
			mobilePaddingUnit,
			tabletPaddingUnit,
			imageBottomSpaceUnit,
			titleBottomSpaceUnit,
			taxonomyBottomSpaceUnit,
			metaBottomSpaceUnit,
			ctaBottomSpaceUnit,
			excerptBottomSpaceUnit,
			rowGapUnit,
			taxStyle,
			taxDivider,
			displayPostTaxonomyAboveTitle,
			hideTaxonomyIcon,
			highlightedTextColor,
			highlightedTextBgColor,
			titleLetterSpacing,
			titleLetterSpacingTablet,
			titleLetterSpacingMobile,
			titleLetterSpacingType,
			metaLetterSpacing,
			metaLetterSpacingTablet,
			metaLetterSpacingMobile,
			metaLetterSpacingType,
			excerptLetterSpacing,
			excerptLetterSpacingTablet,
			excerptLetterSpacingMobile,
			excerptLetterSpacingType,
			ctaLetterSpacing,
			ctaLetterSpacingTablet,
			ctaLetterSpacingMobile,
			ctaLetterSpacingType,
			enableOffset,
			// row spacing controls between content and dots
			dotsMarginTop,
			dotsMarginTopTablet,
			dotsMarginTopMobile,
			dotsMarginTopUnit,
			btnVPadding,
			btnHPadding,
			paddingBtnTop,
			paddingBtnBottom,
			paddingBtnRight,
			paddingBtnLeft,
			contentPadding,
			contentPaddingMobile,
			contentPaddingTablet,
			paddingTop,
			paddingBottom,
			paddingLeft,
			paddingRight,
			paddingTopTablet,
			paddingRightTablet,
			paddingBottomTablet,
			paddingLeftTablet,
			paddingTopMobile,
			paddingRightMobile,
			paddingBottomMobile,
			paddingLeftMobile,
			// backward compatibility added
			columnGap,
			columnGapTablet,
			columnGapMobile,

			borderStyle,
			borderWidth,
			borderRadius,
			borderColor,
			borderHColor,
			btnBorderTopWidth,
			btnBorderLeftWidth,
			btnBorderRightWidth,
			btnBorderBottomWidth,
			btnBorderTopLeftRadius,
			btnBorderTopRightRadius,
			btnBorderBottomLeftRadius,
			btnBorderBottomRightRadius,
			btnBorderColor,
			btnBorderHColor,
			btnBorderStyle,
			blockName,
			categories,
			postsToShow,
			postsOffset,
			order,
			orderBy,
			postType,
			taxonomyType,
			excludeCurrentPost,
			allTaxonomyStore,
			UAGHideDesktop,
			UAGHideTab,
			UAGHideMob,
			equalHeight,
			block_id,
			inheritFromThemeBtn,
			buttonType,
		},
		setAttributes,
		deviceType,
		clientId,
	} = props;

	const [ state, setState ] = useState( {
		isEditing: false,
		innerBlocks: [],
	} );

	const [ isTaxonomyLoading, setIsTaxonomyLoading ] = useState( false );

	useEffect( () => {
		const { block } = props;
		setState( { innerBlocks: block } );

		if ( btnVPadding ) {
			if ( undefined === paddingBtnTop ) {
				setAttributes( { paddingBtnTop: btnVPadding } );
			}
			if ( undefined === paddingBtnBottom ) {
				setAttributes( { paddingBtnBottom: btnVPadding } );
			}
		}
		if ( btnHPadding ) {
			if ( undefined === paddingBtnRight ) {
				setAttributes( { paddingBtnRight: btnHPadding } );
			}
			if ( undefined === paddingBtnLeft ) {
				setAttributes( { paddingBtnLeft: btnHPadding } );
			}
		}
		if ( contentPadding ) {
			if ( undefined === paddingTop ) {
				setAttributes( { paddingTop: contentPadding } );
			}
			if ( undefined === paddingBottom ) {
				setAttributes( { paddingBottom: contentPadding } );
			}
			if ( undefined === paddingRight ) {
				setAttributes( { paddingRight: contentPadding } );
			}
			if ( undefined === paddingLeft ) {
				setAttributes( { paddingLeft: contentPadding } );
			}
		}
		if ( contentPaddingTablet ) {
			if ( undefined === paddingTopTablet ) {
				setAttributes( {
					paddingTopTablet: contentPaddingTablet,
				} );
			}
			if ( undefined === paddingBottomTablet ) {
				setAttributes( {
					paddingBottomTablet: contentPaddingTablet,
				} );
			}
			if ( undefined === paddingRightTablet ) {
				setAttributes( {
					paddingRightTablet: contentPaddingTablet,
				} );
			}
			if ( undefined === paddingLeftTablet ) {
				setAttributes( {
					paddingLeftTablet: contentPaddingTablet,
				} );
			}
		}
		if ( contentPaddingMobile ) {
			if ( undefined === paddingTopMobile ) {
				setAttributes( {
					paddingTopMobile: contentPaddingMobile,
				} );
			}
			if ( undefined === paddingBottomMobile ) {
				setAttributes( {
					paddingBottomMobile: contentPaddingMobile,
				} );
			}
			if ( undefined === paddingRightMobile ) {
				setAttributes( {
					paddingRightMobile: contentPaddingMobile,
				} );
			}
			if ( undefined === paddingLeftMobile ) {
				setAttributes( {
					paddingLeftMobile: contentPaddingMobile,
				} );
			}
		}

		if ( borderWidth ) {
			if ( undefined === btnBorderTopWidth ) {
				setAttributes( {
					btnBorderTopWidth: borderWidth,
				} );
			}
			if ( undefined === btnBorderLeftWidth ) {
				setAttributes( { btnBorderLeftWidth: borderWidth } );
			}
			if ( undefined === btnBorderRightWidth ) {
				setAttributes( { btnBorderRightWidth: borderWidth } );
			}
			if ( undefined === btnBorderBottomWidth ) {
				setAttributes( { btnBorderBottomWidth: borderWidth } );
			}
		}

		if ( borderRadius ) {
			if ( undefined === btnBorderTopLeftRadius ) {
				setAttributes( { btnBorderTopLeftRadius: borderRadius } );
			}
			if ( undefined === btnBorderTopRightRadius ) {
				setAttributes( { btnBorderTopRightRadius: borderRadius } );
			}
			if ( undefined === btnBorderBottomLeftRadius ) {
				setAttributes( { btnBorderBottomLeftRadius: borderRadius } );
			}
			if ( undefined === btnBorderBottomRightRadius ) {
				setAttributes( { btnBorderBottomRightRadius: borderRadius } );
			}
		}

		if ( borderColor ) {
			if ( undefined === btnBorderColor ) {
				setAttributes( { btnBorderColor: borderColor } );
			}
		}

		if ( borderHColor ) {
			if ( undefined === btnBorderHColor ) {
				setAttributes( { btnBorderHColor: borderHColor } );
			}
		}

		if ( borderStyle ) {
			if ( undefined === btnBorderStyle ) {
				setAttributes( { btnBorderStyle: borderStyle } );
			}
		}

		if ( columnGap && columnGap !== 20 ) {
			setAttributes( { dotsMarginTop: columnGap } );
		}

		if ( columnGapTablet ) {
			setAttributes( { dotsMarginTopTablet: columnGapTablet } );
		}

		if ( columnGapMobile ) {
			setAttributes( { dotsMarginTopMobile: columnGapMobile } );
		}
	}, [] );

	useEffect( () => {
		if ( equalHeight ) {
			vxt_ultimate_gutenberg_blocks_carousel_height( block_id );
		} else {
			vxt_ultimate_gutenberg_blocks_carousel_unset_height( block_id ); // eslint-disable-line no-undef
		}
	}, [ attributes, deviceType ] );
	const currentTheme = vxt_ultimate_gutenberg_blocks_blocks_info.current_theme;
	const isAstraBasedTheme = vxt_ultimate_gutenberg_blocks_blocks_info.is_astra_based_theme;

	let blockStyling = useMemo( () => styling( attributes, clientId, deviceType ), [ attributes, deviceType ] );

	blockStyling +=
		'.uagb-block-' +
		block_id +
		'.uagb-post-grid ul.slick-dots li.slick-active button:before, .uagb-block-' +
		block_id +
		'.uagb-slick-carousel ul.slick-dots li button:before { color: ' +
		attributes.arrowColor +
		'; }';

	useEffect( () => {
		scrollBlockToView();
	}, [ deviceType ] );

	useEffect( () => {
		responsiveConditionPreview( props );
	}, [ UAGHideDesktop, UAGHideTab, UAGHideMob, deviceType ] );

	const onSelectPostType = ( value ) => {
		setAttributes( { postType: value } );
		setAttributes( { categories: '' } );
		setAttributes( { taxonomyType: 'category' } );
	};

	const onSelectTaxonomyType = ( value ) => {
		setAttributes( { taxonomyType: value } );
		setAttributes( { categories: '' } );
	};

	const onSelectOffset = ( value ) => {
		setAttributes( { enableOffset: value } );
	};
	let categoriesList = [];
	const { latestPosts, taxonomyList, block } = useSelect( ( select ) => {
		const { getEntityRecords } = select( 'core' );

		if ( ! allTaxonomyStore && ! isTaxonomyLoading ) {
			setIsTaxonomyLoading( true );
			// We are not using the our wrapper getApiData function here because we need to pass any form data.
			apiFetch( {
				path: '/vexaltrix/v1/all_taxonomy',
			} ).then( ( data ) => {
				setAttributes( { allTaxonomyStore: data } );
				setIsTaxonomyLoading( false );
			} );
		}
		const allTaxonomy = allTaxonomyStore;
		const currentTax = allTaxonomy ? allTaxonomy[ postType ] : undefined;

		let rest_base = '';

		if ( 'undefined' !== typeof currentTax ) {
			if ( 'undefined' !== typeof currentTax.taxonomy[ taxonomyType ] ) {
				rest_base =
					currentTax.taxonomy[ taxonomyType ].rest_base === false ||
					currentTax.taxonomy[ taxonomyType ].rest_base === null
						? currentTax.taxonomy[ taxonomyType ].name
						: currentTax.taxonomy[ taxonomyType ].rest_base;
			}

			if ( '' !== taxonomyType ) {
				if (
					'undefined' !== typeof currentTax.terms &&
					'undefined' !== typeof currentTax.terms[ taxonomyType ]
				) {
					categoriesList = currentTax.terms[ taxonomyType ];
				}
			}
		}

		const latestPostsQuery = {
			order,
			orderby: orderBy,
			per_page: getFallbackNumber( postsToShow, 'postsToShow', blockName ),
			offset: getFallbackNumber( postsOffset, 'postsOffset', blockName ),
		};

		if ( excludeCurrentPost ) {
			const getStore = select( 'core/editor' );
			latestPostsQuery.exclude = getStore?.getCurrentPostId ? getStore.getCurrentPostId() : null;
		}

		const category = [];
		const temp = parseInt( categories );
		category.push( temp );
		const catlenght = categoriesList.length;
		for ( let i = 0; i < catlenght; i++ ) {
			if ( categoriesList[ i ].id === temp ) {
				if ( categoriesList[ i ].child.length !== 0 ) {
					categoriesList[ i ].child.forEach( ( element ) => {
						category.push( element );
					} );
				}
			}
		}
		const { getBlocks } = select( 'core/block-editor' );
		if ( undefined !== categories && '' !== categories ) {
			latestPostsQuery[ rest_base ] = undefined === categories || '' === categories ? categories : category;
		}
		return {
			latestPosts: getEntityRecords( 'postType', postType, latestPostsQuery ),
			categoriesList,
			taxonomyList: 'undefined' !== typeof currentTax ? currentTax.taxonomy : [],
			block: getBlocks( clientId ),
		};
	} );

	const { replaceInnerBlocks } = useDispatch( 'core/block-editor' );

	const columnsFallback = getFallbackNumber( columns, 'columns', blockName );

	const taxonomyListOptions = [
		{
			value: '',
			label: __( 'All', 'vexaltrix' ),
		},
	];

	const categoryListOptions = [ { value: '', label: __( 'All', 'vexaltrix' ) } ];

	const bgTypeOptions = [
		{
			value: 'transparent',
			label: __( 'Transparent', 'vexaltrix' ),
		},
		{
			value: 'color',
			label: __( 'Color', 'vexaltrix' ),
		},
	];

	if ( taxonomyList ) {
		Object.keys( taxonomyList ).map( ( item ) => {
			return taxonomyListOptions.push( {
				value: taxonomyList[ item ].name,
				label: decodeEntities( taxonomyList[ item ].label ),
			} );
		} );
	}

	if ( categoriesList ) {
		Object.keys( categoriesList ).map( ( item ) => {
			return categoryListOptions.push( {
				value: categoriesList[ item ].id,
				label: decodeEntities( categoriesList[ item ].name ),
			} );
		} );
	}
	const presetSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Presets', 'vexaltrix' ) } initialOpen={ false }>
				<UAGPresets setAttributes={ setAttributes } presets={ presets } presetInputType="radioImage" />
			</UAGAdvancedPanelBody>
		);
	};
	const togglePreview = () => {
		setState( { isEditing: ! state.isEditing } );
		if ( ! state.isEditing ) {
			__( 'Showing All Post Grid Layout.', 'vexaltrix' );
		}
	};

	const hasPosts = Array.isArray( latestPosts ) && latestPosts.length;

	const getGeneralPanelBody = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'General', 'vexaltrix' ) } initialOpen={ true }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Text Alignment', 'vexaltrix' ) }
					data={ {
						value: align,
						label: 'align',
					} }
					className="uagb-multi-button-alignment-control"
					options={ [
						{
							value: 'left',
							icon: <Icon icon={ renderSVG( 'fa fa-align-left' ) } />,
							tooltip: __( 'Left', 'vexaltrix' ),
						},
						{
							value: 'center',
							icon: <Icon icon={ renderSVG( 'fa fa-align-center' ) } />,
							tooltip: __( 'Center', 'vexaltrix' ),
						},
						{
							value: 'right',
							icon: <Icon icon={ renderSVG( 'fa fa-align-right' ) } />,
							tooltip: __( 'Right', 'vexaltrix' ),
						},
					] }
					showIcons={ true }
				/>
				<UAGSelectControl
					label={ __( 'Post Type', 'vexaltrix' ) }
					data={ {
						value: postType,
					} }
					onChange={ onSelectPostType }
					options={ vxt_ultimate_gutenberg_blocks_blocks_info.post_types }
				/>
				{ '' !== taxonomyList && (
					<UAGSelectControl
						label={ __( 'Taxonomy', 'vexaltrix' ) }
						data={ {
							value: taxonomyType,
						} }
						onChange={ onSelectTaxonomyType }
						options={ taxonomyListOptions }
					/>
				) }
				{ '' != categoriesList && (
					<>
						<UAGSelectControl
							label={ taxonomyList[ taxonomyType ].label }
							data={ {
								value: categories,
								label: 'categories',
							} }
							setAttributes={ setAttributes }
							options={ categoryListOptions }
						/>
					</>
				) }
				<ToggleControl
					label={ __( 'Exclude Current Post', 'vexaltrix' ) }
					checked={ excludeCurrentPost }
					onChange={ () =>
						setAttributes( {
							excludeCurrentPost: ! excludeCurrentPost,
						} )
					}
				/>
				<UAGNumberControl
					label={ __( 'Posts Per Page', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ postsToShow }
					data={ {
						value: postsToShow,
						label: 'postsToShow',
					} }
					min={ 1 }
					max={ 100 }
					displayUnit={ false }
					showControlHeader={ false }
				/>
				<ToggleControl
					label={ __( 'Offset Starting Post', 'vexaltrix' ) }
					checked={ enableOffset }
					onChange={ onSelectOffset }
					help={
						<>
							{ ! enableOffset &&
								__(
									'Note: The offset will skip the number of posts set, and will use the next post as the starting post.',
									'vexaltrix'
								) }
						</>
					}
				/>
				{ enableOffset && (
					<UAGNumberControl
						label={ __( 'Offset By', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ postsOffset }
						data={ {
							value: postsOffset,
							label: 'postsOffset',
						} }
						min={ 0 }
						max={ 100 }
						displayUnit={ false }
						help={
							<>
								{ enableOffset &&
									__(
										'Note: The offset will skip the number of posts set, and will use the next post as the starting post.',
										'vexaltrix'
									) }
							</>
						}
					/>
				) }
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Order By', 'vexaltrix' ) }
					data={ {
						value: orderBy,
						label: 'orderBy',
					} }
					options={ [
						{
							value: 'date',
							label: __( 'Date', 'vexaltrix' ),
						},
						{
							value: 'title',
							label: __( 'Title', 'vexaltrix' ),
						},
						{
							value: 'rand',
							label: __( 'Random', 'vexaltrix' ),
						},
						{
							value: 'menu_order',
							label: __( 'Menu Order', 'vexaltrix' ),
						},
					] }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Order', 'vexaltrix' ) }
					data={ {
						value: order,
						label: 'order',
					} }
					options={ [
						{
							value: 'desc',
							label: __( 'Descending', 'vexaltrix' ),
						},
						{
							value: 'asc',
							label: __( 'Ascending', 'vexaltrix' ),
						},
					] }
				/>
				<ResponsiveSlider
					label={ __( 'Columns', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: columns,
							label: 'columns',
						},
						tablet: {
							value: tcolumns,
							label: 'tcolumns',
						},
						mobile: {
							value: mcolumns,
							label: 'mcolumns',
						},
					} }
					min={ 1 }
					max={ MAX_POSTS_COLUMNS }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
				{ columnsFallback > 1 && (
					<ToggleControl
						label={ __( 'Equal Height', 'vexaltrix' ) }
						checked={ equalHeight }
						onChange={ () => setAttributes( { equalHeight: ! equalHeight } ) }
						help={ __(
							"Note: Above setting will only take effect once you are on the live page, and not while you're editing.",
							'vexaltrix'
						) }
					/>
				) }
				<h2>{ __( 'If Posts Not Found', 'vexaltrix' ) }</h2>
				<UAGTextControl
					autoComplete="off"
					label={ __( 'Display Message', 'vexaltrix' ) }
					value={ postDisplaytext }
					data={ {
						value: postDisplaytext,
						label: 'postDisplaytext',
					} }
					setAttributes={ setAttributes }
					onChange={ ( value ) => setAttributes( { postDisplaytext: value } ) }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const getCarouselPanelBody = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Carousel', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Pause On Hover', 'vexaltrix' ) }
					checked={ pauseOnHover }
					onChange={ () => setAttributes( { pauseOnHover: ! pauseOnHover } ) }
				/>
				<ToggleControl
					label={ __( 'Autoplay', 'vexaltrix' ) }
					checked={ autoplay }
					onChange={ () => setAttributes( { autoplay: ! autoplay } ) }
				/>
				{ autoplay === true && (
					<Range
						label={ __( 'Autoplay Speed (ms)', 'vexaltrix' ) }
						value={ autoplaySpeed }
						data={ {
							value: autoplaySpeed,
							label: 'autoplaySpeed',
						} }
						setAttributes={ setAttributes }
						displayUnit={ false }
						min={ 100 }
						max={ 5000 }
					/>
				) }
				<ToggleControl
					label={ __( 'Infinite Loop', 'vexaltrix' ) }
					checked={ infiniteLoop }
					onChange={ () => setAttributes( { infiniteLoop: ! infiniteLoop } ) }
				/>
				<Range
					label={ __( 'Transition Speed (ms)', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					displayUnit={ false }
					value={ transitionSpeed }
					data={ {
						value: transitionSpeed,
						label: 'transitionSpeed',
					} }
					min={ 100 }
					max={ 5000 }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Arrows & Dots Type', 'vexaltrix' ) }
					data={ {
						value: arrowDots,
						label: 'arrowDots',
					} }
					options={ [
						{
							value: 'arrows',
							label: __( 'Arrows', 'vexaltrix' ),
						},
						{
							value: 'dots',
							label: __( 'Dots', 'vexaltrix' ),
						},
						{
							value: 'arrows_dots',
							label: __( 'Both', 'vexaltrix' ),
						},
					] }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const getImagePanelBody = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Image', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Show Featured Image', 'vexaltrix' ) }
					checked={ displayPostImage }
					onChange={ () =>
						setAttributes( {
							displayPostImage: ! displayPostImage,
						} )
					}
				/>
				{ displayPostImage === true && (
					<UAGSelectControl
						label={ __( 'Sizes', 'vexaltrix' ) }
						data={ {
							value: imgSize,
							label: 'imgSize',
						} }
						setAttributes={ setAttributes }
						options={ vxt_ultimate_gutenberg_blocks_blocks_info.image_sizes }
					/>
				) }
				{ displayPostImage === true && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Position', 'vexaltrix' ) }
						data={ {
							value: imgPosition,
							label: 'imgPosition',
						} }
						options={ [
							{
								value: 'top',
								label: __( 'Top', 'vexaltrix' ),
							},
							{
								value: 'background',
								label: __( 'Background', 'vexaltrix' ),
							},
						] }
					/>
				) }
				{ displayPostImage === true && imgPosition === 'background' && (
					<ToggleControl
						label={ __( 'Link Complete Box', 'vexaltrix' ) }
						checked={ linkBox }
						onChange={ () => setAttributes( { linkBox: ! linkBox } ) }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const getContentPanelBody = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Content', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Show Title', 'vexaltrix' ) }
					checked={ displayPostTitle }
					onChange={ () =>
						setAttributes( {
							displayPostTitle: ! displayPostTitle,
						} )
					}
				/>
				<ToggleControl
					label={ __( 'Show Author', 'vexaltrix' ) }
					checked={ displayPostAuthor }
					onChange={ () =>
						setAttributes( {
							displayPostAuthor: ! displayPostAuthor,
						} )
					}
				/>
				<ToggleControl
					label={ __( 'Show Date', 'vexaltrix' ) }
					checked={ displayPostDate }
					onChange={ () => setAttributes( { displayPostDate: ! displayPostDate } ) }
				/>
				<ToggleControl
					label={ __( 'Show Comment', 'vexaltrix' ) }
					checked={ displayPostComment }
					onChange={ () =>
						setAttributes( {
							displayPostComment: ! displayPostComment,
						} )
					}
				/>
				<ToggleControl
					label={ __( 'Show Taxonomy', 'vexaltrix' ) }
					checked={ displayPostTaxonomy }
					onChange={ () =>
						setAttributes( {
							displayPostTaxonomy: ! displayPostTaxonomy,
						} )
					}
				/>
				{ displayPostTaxonomy && (
					<>
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'Taxonomy Position', 'vexaltrix' ) }
							data={ {
								value: displayPostTaxonomyAboveTitle,
								label: 'displayPostTaxonomyAboveTitle',
							} }
							options={ [
								{
									value: 'withMeta',
									label: __( 'With Meta', 'vexaltrix' ),
								},
								{
									value: 'aboveTitle',
									label: __( 'Above Title', 'vexaltrix' ),
								},
							] }
						/>
						{ 'aboveTitle' === displayPostTaxonomyAboveTitle && (
							<>
								<MultiButtonsControl
									setAttributes={ setAttributes }
									label={ __( 'Taxonomy Style', 'vexaltrix' ) }
									data={ {
										value: taxStyle,
										label: 'taxStyle',
									} }
									options={ [
										{
											value: 'default',
											label: __( 'Normal', 'vexaltrix' ),
										},
										{
											value: 'highlighted',
											label: __( 'Highlighted', 'vexaltrix' ),
										},
									] }
								/>
								{ 'default' === taxStyle && (
									<UAGTextControl
										label={ __( 'Taxonomy Divider', 'vexaltrix' ) }
										value={ taxDivider }
										data={ {
											value: taxDivider,
											label: 'taxDivider',
										} }
										setAttributes={ setAttributes }
										onChange={ ( value ) =>
											setAttributes( {
												taxDivider: value,
											} )
										}
									/>
								) }
							</>
						) }
					</>
				) }
				<ToggleControl
					label={ __( 'Show Meta Icon', 'vexaltrix' ) }
					checked={ hideTaxonomyIcon }
					onChange={ () =>
						setAttributes( {
							hideTaxonomyIcon: ! hideTaxonomyIcon,
						} )
					}
				/>
				<ToggleControl
					label={ __( 'Show Excerpt', 'vexaltrix' ) }
					checked={ displayPostExcerpt }
					onChange={ () =>
						setAttributes( {
							displayPostExcerpt: ! displayPostExcerpt,
						} )
					}
				/>
				{ displayPostExcerpt && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Show:', 'vexaltrix' ) }
						data={ {
							value: displayPostContentRadio,
							label: 'displayPostContentRadio',
						} }
						options={ [
							{
								label: __( 'Excerpt', 'vexaltrix' ),
								value: 'excerpt',
							},
							{
								label: __( 'Full post', 'vexaltrix' ),
								value: 'full_post',
							},
						] }
					/>
				) }
				{ displayPostExcerpt && displayPostContentRadio === 'excerpt' && (
					<Range
						label={ __( 'Max number of words in excerpt', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ excerptLength }
						data={ {
							value: excerptLength,
							label: 'excerptLength',
						} }
						min={ 1 }
						max={ 100 }
						displayUnit={ false }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const getReadMoreLinkPanelBody = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Read More Link', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Show Read More Link', 'vexaltrix' ) }
					checked={ displayPostLink }
					onChange={ () => setAttributes( { displayPostLink: ! displayPostLink } ) }
				/>
				{ displayPostLink && (
					<>
						<ToggleControl
							checked={ inheritFromThemeBtn }
							onChange={ () => setAttributes( { inheritFromThemeBtn: ! inheritFromThemeBtn } ) }
							label={ __( 'Inherit From Theme', 'vexaltrix' ) }
						/>
						{ inheritFromThemeBtn && ( 'Astra' === currentTheme || isAstraBasedTheme ) && (
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Button Type', 'vexaltrix' ) }
								data={ {
									value: buttonType,
									label: 'buttonType',
								} }
								options={ [
									{
										value: 'primary',
										label: __( 'Primary', 'vexaltrix' ),
									},
									{
										value: 'secondary',
										label: __( 'Secondary', 'vexaltrix' ),
									},
								] }
							/>
						) }
						<ToggleControl
							label={ __( 'Open Links in New Tab', 'vexaltrix' ) }
							checked={ newTab }
							onChange={ () => setAttributes( { newTab: ! newTab } ) }
						/>
						<UAGTextControl
							label={ __( 'Text', 'vexaltrix' ) }
							value={ ctaText }
							data={ {
								value: ctaText,
								label: 'ctaText',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) => setAttributes( { ctaText: value } ) }
						/>
						{ ! inheritFromThemeBtn && (
							<UAGPresets
								setAttributes={ setAttributes }
								presets={ buttonsPresets }
								presetInputType="radioImage"
							/>
						) }
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const spacingSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) } initialOpen={ true }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Background Type', 'vexaltrix' ) }
					value={ bgType }
					data={ {
						value: bgType,
						label: 'bgType',
					} }
					className="uagb-multi-button-alignment-control"
					options={ bgTypeOptions }
				/>
				{ bgType === 'color' && (
					<AdvancedPopColorControl
						label={ __( 'Background Color', 'vexaltrix' ) }
						colorValue={ bgColor }
						data={ {
							value: bgColor,
							label: 'bgColor',
						} }
						setAttributes={ setAttributes }
					/>
				) }
				<ResponsiveSlider
					label={ __( 'Column Gap', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: rowGap,
							label: 'rowGap',
						},
						tablet: {
							value: rowGapTablet,
							label: 'rowGapTablet',
						},
						mobile: {
							value: rowGapMobile,
							label: 'rowGapMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					unit={ {
						value: rowGapUnit,
						label: 'rowGapUnit',
					} }
					setAttributes={ setAttributes }
				/>
				<SpacingControl
					{ ...props }
					label={ __( 'Content Padding', 'vexaltrix' ) }
					valueTop={ {
						value: paddingTop,
						label: 'paddingTop',
					} }
					valueRight={ {
						value: paddingRight,
						label: 'paddingRight',
					} }
					valueBottom={ {
						value: paddingBottom,
						label: 'paddingBottom',
					} }
					valueLeft={ {
						value: paddingLeft,
						label: 'paddingLeft',
					} }
					valueTopTablet={ {
						value: paddingTopTablet,
						label: 'paddingTopTablet',
					} }
					valueRightTablet={ {
						value: paddingRightTablet,
						label: 'paddingRightTablet',
					} }
					valueBottomTablet={ {
						value: paddingBottomTablet,
						label: 'paddingBottomTablet',
					} }
					valueLeftTablet={ {
						value: paddingLeftTablet,
						label: 'paddingLeftTablet',
					} }
					valueTopMobile={ {
						value: paddingTopMobile,
						label: 'paddingTopMobile',
					} }
					valueRightMobile={ {
						value: paddingRightMobile,
						label: 'paddingRightMobile',
					} }
					valueBottomMobile={ {
						value: paddingBottomMobile,
						label: 'paddingBottomMobile',
					} }
					valueLeftMobile={ {
						value: paddingLeftMobile,
						label: 'paddingLeftMobile',
					} }
					unit={ {
						value: contentPaddingUnit,
						label: 'contentPaddingUnit',
					} }
					mUnit={ {
						value: mobilePaddingUnit,
						label: 'mobilePaddingUnit',
					} }
					tUnit={ {
						value: tabletPaddingUnit,
						label: 'tabletPaddingUnit',
					} }
					deviceType={ deviceType }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: spacingLinkPadding,
						label: 'spacingLinkPadding',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const imageStyle = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Image', 'vexaltrix' ) } initialOpen={ false }>
				{ imgPosition === 'background' && (
					<>
						<AdvancedPopColorControl
							label={ __( 'Background Overlay Color', 'vexaltrix' ) }
							colorValue={ bgOverlayColor }
							data={ {
								value: bgOverlayColor,
								label: 'bgOverlayColor',
							} }
							setAttributes={ setAttributes }
						/>
						<Range
							label={ __( 'Overlay Opacity', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ overlayOpacity }
							data={ {
								value: overlayOpacity,
								label: 'overlayOpacity',
							} }
							min={ 0 }
							max={ 100 }
							displayUnit={ false }
						/>
					</>
				) }
				{ imgPosition === 'top' && (
					<ResponsiveSlider
						label={ __( 'Bottom Spacing', 'vexaltrix' ) }
						data={ {
							desktop: {
								value: imageBottomSpace,
								label: 'imageBottomSpace',
							},
							tablet: {
								value: imageBottomSpaceTablet,
								label: 'imageBottomSpaceTablet',
							},
							mobile: {
								value: imageBottomSpaceMobile,
								label: 'imageBottomSpaceMobile',
							},
						} }
						min={ 0 }
						max={ 50 }
						unit={ {
							value: imageBottomSpaceUnit,
							label: 'imageBottomSpaceUnit',
						} }
						setAttributes={ setAttributes }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const taxonomyStyle = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Taxonomy', 'vexaltrix' ) } initialOpen={ false }>
				{ 'aboveTitle' === displayPostTaxonomyAboveTitle && 'highlighted' === taxStyle && (
					<>
						<AdvancedPopColorControl
							label={ __( 'Taxonomy Text Color', 'vexaltrix' ) }
							colorValue={ highlightedTextColor }
							data={ {
								value: highlightedTextColor,
								label: 'highlightedTextColor',
							} }
							setAttributes={ setAttributes }
						/>
						<AdvancedPopColorControl
							label={ __( 'Highlighted Color', 'vexaltrix' ) }
							colorValue={ highlightedTextBgColor }
							data={ {
								value: highlightedTextBgColor,
								label: 'highlightedTextBgColor',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				) }
				<ResponsiveSlider
					label={ __( 'Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: taxonomyBottomSpace,
							label: 'taxonomyBottomSpace',
						},
						tablet: {
							value: taxonomyBottomSpaceTablet,
							label: 'taxonomyBottomSpaceTablet',
						},
						mobile: {
							value: taxonomyBottomSpaceMobile,
							label: 'taxonomyBottomSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					unit={ {
						value: taxonomyBottomSpaceUnit,
						label: 'taxonomyBottomSpaceUnit',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const titleStyle = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Title', 'vexaltrix' ) } initialOpen={ false }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'HTML Tag', 'vexaltrix' ) }
					data={ {
						value: titleTag,
						label: 'titleTag',
					} }
					options={ [
						{
							value: 'h1',
							label: __( 'H1', 'vexaltrix' ),
						},
						{
							value: 'h2',
							label: __( 'H2', 'vexaltrix' ),
						},
						{
							value: 'h3',
							label: __( 'H3', 'vexaltrix' ),
						},
						{
							value: 'h4',
							label: __( 'H4', 'vexaltrix' ),
						},
						{
							value: 'h5',
							label: __( 'H5', 'vexaltrix' ),
						},
						{
							value: 'h6',
							label: __( 'H6', 'vexaltrix' ),
						},
						{
							value: 'span',
							label: __( 'Span', 'vexaltrix' ),
						},
						{
							value: 'p',
							label: __( 'P', 'vexaltrix' ),
						},
					] }
				/>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ titleColor }
					data={ {
						value: titleColor,
						label: 'titleColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: titleLoadGoogleFonts,
						label: 'titleLoadGoogleFonts',
					} }
					fontFamily={ {
						value: titleFontFamily,
						label: 'titleFontFamily',
					} }
					fontWeight={ {
						value: titleFontWeight,
						label: 'titleFontWeight',
					} }
					fontStyle={ {
						value: titleFontStyle,
						label: 'titleFontStyle',
					} }
					fontSizeType={ {
						value: titleFontSizeType,
						label: 'titleFontSizeType',
					} }
					fontSize={ {
						value: titleFontSize,
						label: 'titleFontSize',
					} }
					fontSizeMobile={ {
						value: titleFontSizeMobile,
						label: 'titleFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: titleFontSizeTablet,
						label: 'titleFontSizeTablet',
					} }
					lineHeightType={ {
						value: titleLineHeightType,
						label: 'titleLineHeightType',
					} }
					lineHeight={ {
						value: titleLineHeight,
						label: 'titleLineHeight',
					} }
					lineHeightMobile={ {
						value: titleLineHeightMobile,
						label: 'titleLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: titleLineHeightTablet,
						label: 'titleLineHeightTablet',
					} }
					letterSpacing={ {
						value: titleLetterSpacing,
						label: 'titleLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: titleLetterSpacingTablet,
						label: 'titleLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: titleLetterSpacingMobile,
						label: 'titleLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: titleLetterSpacingType,
						label: 'titleLetterSpacingType',
					} }
					transform={ {
						value: titleTransform,
						label: 'titleTransform',
					} }
					decoration={ {
						value: titleDecoration,
						label: 'titleDecoration',
					} }
				/>
				<ResponsiveSlider
					label={ __( 'Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: titleBottomSpace,
							label: 'titleBottomSpace',
						},
						tablet: {
							value: titleBottomSpaceTablet,
							label: 'titleBottomSpaceTablet',
						},
						mobile: {
							value: titleBottomSpaceMobile,
							label: 'titleBottomSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					unit={ {
						value: titleBottomSpaceUnit,
						label: 'titleBottomSpaceUnit',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const metaStyle = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Meta', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ metaColor }
					data={ {
						value: metaColor,
						label: 'metaColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: metaLoadGoogleFonts,
						label: 'metaLoadGoogleFonts',
					} }
					fontFamily={ {
						value: metaFontFamily,
						label: 'metaFontFamily',
					} }
					fontWeight={ {
						value: metaFontWeight,
						label: 'metaFontWeight',
					} }
					fontStyle={ {
						value: metaFontStyle,
						label: 'metaFontStyle',
					} }
					fontSizeType={ {
						value: metaFontSizeType,
						label: 'metaFontSizeType',
					} }
					fontSize={ {
						value: metaFontSize,
						label: 'metaFontSize',
					} }
					fontSizeMobile={ {
						value: metaFontSizeMobile,
						label: 'metaFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: metaFontSizeTablet,
						label: 'metaFontSizeTablet',
					} }
					lineHeightType={ {
						value: metaLineHeightType,
						label: 'metaLineHeightType',
					} }
					lineHeight={ {
						value: metaLineHeight,
						label: 'metaLineHeight',
					} }
					lineHeightMobile={ {
						value: metaLineHeightMobile,
						label: 'metaLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: metaLineHeightTablet,
						label: 'metaLineHeightTablet',
					} }
					letterSpacing={ {
						value: metaLetterSpacing,
						label: 'metaLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: metaLetterSpacingTablet,
						label: 'metaLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: metaLetterSpacingMobile,
						label: 'metaLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: metaLetterSpacingType,
						label: 'metaLetterSpacingType',
					} }
					transform={ {
						value: metaTransform,
						label: 'metaTransform',
					} }
					decoration={ {
						value: metaDecoration,
						label: 'metaDecoration',
					} }
				/>
				<ResponsiveSlider
					label={ __( 'Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: metaBottomSpace,
							label: 'metaBottomSpace',
						},
						tablet: {
							value: metaBottomSpaceTablet,
							label: 'metaBottomSpaceTablet',
						},
						mobile: {
							value: metaBottomSpaceMobile,
							label: 'metaBottomSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					unit={ {
						value: metaBottomSpaceUnit,
						label: 'metaBottomSpaceUnit',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const excerptStyle = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Excerpt', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ excerptColor }
					data={ {
						value: excerptColor,
						label: 'excerptColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: excerptLoadGoogleFonts,
						label: 'excerptLoadGoogleFonts',
					} }
					fontFamily={ {
						value: excerptFontFamily,
						label: 'excerptFontFamily',
					} }
					fontWeight={ {
						value: excerptFontWeight,
						label: 'excerptFontWeight',
					} }
					fontStyle={ {
						value: excerptFontStyle,
						label: 'excerptFontStyle',
					} }
					fontSizeType={ {
						value: excerptFontSizeType,
						label: 'excerptFontSizeType',
					} }
					fontSize={ {
						value: excerptFontSize,
						label: 'excerptFontSize',
					} }
					fontSizeMobile={ {
						value: excerptFontSizeMobile,
						label: 'excerptFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: excerptFontSizeTablet,
						label: 'excerptFontSizeTablet',
					} }
					lineHeightType={ {
						value: excerptLineHeightType,
						label: 'excerptLineHeightType',
					} }
					lineHeight={ {
						value: excerptLineHeight,
						label: 'excerptLineHeight',
					} }
					lineHeightMobile={ {
						value: excerptLineHeightMobile,
						label: 'excerptLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: excerptLineHeightTablet,
						label: 'excerptLineHeightTablet',
					} }
					letterSpacing={ {
						value: excerptLetterSpacing,
						label: 'excerptLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: excerptLetterSpacingTablet,
						label: 'excerptLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: excerptLetterSpacingMobile,
						label: 'excerptLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: excerptLetterSpacingType,
						label: 'excerptLetterSpacingType',
					} }
					transform={ {
						value: excerptTransform,
						label: 'excerptTransform',
					} }
					decoration={ {
						value: excerptDecoration,
						label: 'excerptDecoration',
					} }
				/>
				<ResponsiveSlider
					label={ __( 'Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: excerptBottomSpace,
							label: 'excerptBottomSpace',
						},
						tablet: {
							value: excerptBottomSpaceTablet,
							label: 'excerptBottomSpaceTablet',
						},
						mobile: {
							value: excerptBottomSpaceMobile,
							label: 'excerptBottomSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					unit={ {
						value: excerptBottomSpaceUnit,
						label: 'excerptBottomSpaceUnit',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const readMoreLinkStyleSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Read More Link', 'vexaltrix' ) } initialOpen={ false }>
				{ ! inheritFromThemeBtn && (
					<>
						<UAGTabsControl
							tabs={ [
								{
									name: 'normal',
									title: __( 'Normal', 'vexaltrix' ),
								},
								{
									name: 'hover',
									title: __( 'Hover', 'vexaltrix' ),
								},
							] }
							normal={
								<>
									<AdvancedPopColorControl
										label={ __( 'Color', 'vexaltrix' ) }
										colorValue={ ctaColor }
										data={ {
											value: ctaColor,
											label: 'ctaColor',
										} }
										setAttributes={ setAttributes }
									/>
									<MultiButtonsControl
										setAttributes={ setAttributes }
										label={ __( 'Background Type', 'vexaltrix' ) }
										data={ {
											value: ctaBgType,
											label: 'ctaBgType',
										} }
										className="uagb-multi-button-alignment-control"
										options={ bgTypeOptions }
									/>
									{ ctaBgType === 'color' && (
										<AdvancedPopColorControl
											label={ __( 'Background Color', 'vexaltrix' ) }
											colorValue={ ctaBgColor }
											data={ {
												value: ctaBgColor,
												label: 'ctaBgColor',
											} }
											setAttributes={ setAttributes }
										/>
									) }
								</>
							}
							hover={
								<>
									<AdvancedPopColorControl
										label={ __( 'Color', 'vexaltrix' ) }
										colorValue={ ctaHColor }
										data={ {
											value: ctaHColor,
											label: 'ctaHColor',
										} }
										setAttributes={ setAttributes }
									/>
									<MultiButtonsControl
										setAttributes={ setAttributes }
										label={ __( 'Background Type', 'vexaltrix' ) }
										data={ {
											value: ctaBgHType,
											label: 'ctaBgHType',
										} }
										className="uagb-multi-button-alignment-control"
										options={ bgTypeOptions }
									/>
									{ ctaBgHType === 'color' && (
										<AdvancedPopColorControl
											label={ __( 'Background Color', 'vexaltrix' ) }
											colorValue={ ctaBgHColor }
											data={ {
												value: ctaBgHColor,
												label: 'ctaBgHColor',
											} }
											setAttributes={ setAttributes }
										/>
									) }
								</>
							}
							disableBottomSeparator={ false }
						/>
						<TypographyControl
							label={ __( 'Typography', 'vexaltrix' ) }
							attributes={ attributes }
							setAttributes={ setAttributes }
							loadGoogleFonts={ {
								value: ctaLoadGoogleFonts,
								label: 'ctaLoadGoogleFonts',
							} }
							fontFamily={ {
								value: ctaFontFamily,
								label: 'ctaFontFamily',
							} }
							fontWeight={ {
								value: ctaFontWeight,
								label: 'ctaFontWeight',
							} }
							fontStyle={ {
								value: ctaFontStyle,
								label: 'ctaFontStyle',
							} }
							fontSizeType={ {
								value: ctaFontSizeType,
								label: 'ctaFontSizeType',
							} }
							fontSize={ {
								value: ctaFontSize,
								label: 'ctaFontSize',
							} }
							fontSizeMobile={ {
								value: ctaFontSizeMobile,
								label: 'ctaFontSizeMobile',
							} }
							fontSizeTablet={ {
								value: ctaFontSizeTablet,
								label: 'ctaFontSizeTablet',
							} }
							lineHeightType={ {
								value: ctaLineHeightType,
								label: 'ctaLineHeightType',
							} }
							lineHeight={ {
								value: ctaLineHeight,
								label: 'ctaLineHeight',
							} }
							lineHeightMobile={ {
								value: ctaLineHeightMobile,
								label: 'ctaLineHeightMobile',
							} }
							lineHeightTablet={ {
								value: ctaLineHeightTablet,
								label: 'ctaLineHeightTablet',
							} }
							letterSpacing={ {
								value: ctaLetterSpacing,
								label: 'ctaLetterSpacing',
							} }
							letterSpacingTablet={ {
								value: ctaLetterSpacingTablet,
								label: 'ctaLetterSpacingTablet',
							} }
							letterSpacingMobile={ {
								value: ctaLetterSpacingMobile,
								label: 'ctaLetterSpacingMobile',
							} }
							letterSpacingType={ {
								value: ctaLetterSpacingType,
								label: 'ctaLetterSpacingType',
							} }
							transform={ {
								value: ctaTransform,
								label: 'ctaTransform',
							} }
							decoration={ {
								value: ctaDecoration,
								label: 'ctaDecoration',
							} }
						/>
						<ResponsiveBorder
							setAttributes={ setAttributes }
							prefix={ 'btn' }
							attributes={ attributes }
							deviceType={ deviceType }
							disabledBorderTitle={ false }
						/>
						<SpacingControl
							{ ...props }
							label={ __( 'Padding', 'vexaltrix' ) }
							valueTop={ {
								value: paddingBtnTop,
								label: 'paddingBtnTop',
							} }
							valueRight={ {
								value: paddingBtnRight,
								label: 'paddingBtnRight',
							} }
							valueBottom={ {
								value: paddingBtnBottom,
								label: 'paddingBtnBottom',
							} }
							valueLeft={ {
								value: paddingBtnLeft,
								label: 'paddingBtnLeft',
							} }
							valueTopTablet={ {
								value: paddingBtnTopTablet,
								label: 'paddingBtnTopTablet',
							} }
							valueRightTablet={ {
								value: paddingBtnRightTablet,
								label: 'paddingBtnRightTablet',
							} }
							valueBottomTablet={ {
								value: paddingBtnBottomTablet,
								label: 'paddingBtnBottomTablet',
							} }
							valueLeftTablet={ {
								value: paddingBtnLeftTablet,
								label: 'paddingBtnLeftTablet',
							} }
							valueTopMobile={ {
								value: paddingBtnTopMobile,
								label: 'paddingBtnTopMobile',
							} }
							valueRightMobile={ {
								value: paddingBtnRightMobile,
								label: 'paddingBtnRightMobile',
							} }
							valueBottomMobile={ {
								value: paddingBtnBottomMobile,
								label: 'paddingBtnBottomMobile',
							} }
							valueLeftMobile={ {
								value: paddingBtnLeftMobile,
								label: 'paddingBtnLeftMobile',
							} }
							unit={ {
								value: paddingBtnUnit,
								label: 'paddingBtnUnit',
							} }
							mUnit={ {
								value: mobilePaddingBtnUnit,
								label: 'mobilePaddingBtnUnit',
							} }
							tUnit={ {
								value: tabletPaddingBtnUnit,
								label: 'tabletPaddingBtnUnit',
							} }
							deviceType={ deviceType }
							attributes={ attributes }
							setAttributes={ setAttributes }
							link={ {
								value: spacingLink,
								label: 'spacingLink',
							} }
						/>
					</>
				) }
				<ResponsiveSlider
					label={ __( 'Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: ctaBottomSpace,
							label: 'ctaBottomSpace',
						},
						tablet: {
							value: ctaBottomSpaceTablet,
							label: 'ctaBottomSpaceTablet',
						},
						mobile: {
							value: ctaBottomSpaceMobile,
							label: 'ctaBottomSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 300 }
					unit={ {
						value: ctaBottomSpaceUnit,
						label: 'ctaBottomSpaceUnit',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const carouselStyle = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Arrow and Dots', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ arrowColor }
					data={ {
						value: arrowColor,
						label: 'arrowColor',
					} }
					setAttributes={ setAttributes }
				/>
				{ 'dots' !== arrowDots && (
					<>
						<Range
							label={ __( 'Size', 'vexaltrix' ) }
							value={ arrowSize }
							data={ {
								value: arrowSize,
								label: 'arrowSize',
							} }
							min={ 0 }
							max={ 50 }
							setAttributes={ setAttributes }
							displayUnit={ false }
						/>
						<Range
							label={ __( 'Border Size', 'vexaltrix' ) }
							value={ arrowBorderSize }
							data={ {
								value: arrowBorderSize,
								label: 'arrowBorderSize',
							} }
							min={ 0 }
							max={ 50 }
							setAttributes={ setAttributes }
							displayUnit={ false }
						/>
						<Range
							label={ __( 'Border Radius', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							displayUnit={ false }
							value={ arrowBorderRadius }
							data={ {
								value: arrowBorderRadius,
								label: 'arrowBorderRadius',
							} }
							min={ 0 }
							max={ 50 }
						/>
						<ResponsiveSlider
							label={ __( 'Arrow Distance from Edges', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: arrowDistance,
									label: 'arrowDistance',
								},
								tablet: {
									value: arrowDistanceTablet,
									label: 'arrowDistanceTablet',
								},
								mobile: {
									value: arrowDistanceMobile,
									label: 'arrowDistanceMobile',
								},
							} }
							min={ -50 }
							max={ 50 }
							displayUnit={ false }
							setAttributes={ setAttributes }
						/>
						<ResponsiveSlider
							label={ __( 'Top Margin for Dots', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: dotsMarginTop,
									label: 'dotsMarginTop',
								},
								tablet: {
									value: dotsMarginTopTablet,
									label: 'dotsMarginTopTablet',
								},
								mobile: {
									value: dotsMarginTopMobile,
									label: 'dotsMarginTopMobile',
								},
							} }
							min={ 1 }
							max={ 50 }
							unit={ {
								value: dotsMarginTopUnit,
								label: 'dotsMarginTopUnit',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const inspectorControls = (
		<InspectorControls>
			<InspectorTabs>
				<InspectorTab { ...UAGTabs.general }>
					{ getGeneralPanelBody() }
					{ getCarouselPanelBody() }
					{ getImagePanelBody() }
					{ getContentPanelBody() }
					{ getReadMoreLinkPanelBody() }
					{ presetSettings() }
					{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status && (
						<UAGAdvancedPanelBody className="block-editor-block-inspector__upgrade_pro uagb-upgrade_pro-tab">
							<UpgradeComponent
								control={ {
									title: __(
										'Take Post Blocks to the next level with the Loop Builder',
										'vexaltrix'
									),
									choices: [
										{
											title: __( 'More customizability', 'vexaltrix' ),
											description: '',
										},
										{
											title: __( 'Blocks inside the Post Items', 'vexaltrix' ),
											description: '',
										},
										{
											title: __(
												'Include and Exclude option for Taxonomy/Posts/Authors',
												'vexaltrix'
											),
											description: '',
										},
										{
											title: __( 'Show sticky posts', 'vexaltrix' ),
											description: '',
										},
										{
											title: __( 'Multiple Layouts', 'vexaltrix' ),
											description: '',
										},
									],
									renderAs: 'list',
									campaign: 'post-carousel',
								} }
							/>
						</UAGAdvancedPanelBody>
					) }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.style }>
					{ spacingSettings() }
					{ 'aboveTitle' === displayPostTaxonomyAboveTitle && taxonomyStyle() }
					{ displayPostTitle && titleStyle() }
					{ ( displayPostAuthor || displayPostDate || displayPostComment || displayPostTaxonomy ) &&
						metaStyle() }
					{ displayPostExcerpt && excerptStyle() }
					{ displayPostLink && readMoreLinkStyleSettings() }
					{ displayPostImage && imageStyle() }
					{ carouselStyle() }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);

	if ( ! hasPosts ) {
		return (
			<>
				{ inspectorControls }
				<Placeholder icon="admin-post" label={ __( 'Post Carousel', 'vexaltrix' ) }>
					{ ! Array.isArray( latestPosts ) ? <Spinner /> : postDisplaytext }
				</Placeholder>
			</>
		);
	}

	return (
		<>
			<DynamicCSSLoader { ...{ blockStyling } } />
			<DynamicFontLoader { ...{ attributes } } />
			{ isSelected && (
				<Settings
					state={ state }
					togglePreview={ togglePreview }
					inspectorControls={ inspectorControls }
					{ ...props }
				/>
			) }
			<Render
				{ ...props }
				state={ state }
				setState={ setState }
				togglePreview={ togglePreview }
				latestPosts={ latestPosts }
				categoriesList={ categoriesList }
				replaceInnerBlocks={ replaceInnerBlocks }
				block={ block }
			/>
		</>
	);
};

export default compose( addInitialAttr, AddStaticStyles )( VexaltrixPostCarousel );
