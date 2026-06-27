/**
 * External dependencies
 */
import { useEffect, useState, useMemo } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import styling from '.././styling';
import TypographyControl from '@Components/typography';
import ResponsiveBorder from '@Components/responsive-border';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import SpacingControl from '@Components/spacing-control';
import Range from '@Components/range/Range.js';
import ResponsiveSlider from '@Components/responsive-slider';
import UAGTabsControl from '@Components/tabs';
import renderSVG from '@Controls/renderIcon';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGSelectControl from '@Components/select-control';
import { VXT_LINKS } from '@Store/constants';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import scrollBlockToView from '@Controls/scrollBlockToView';
import { buttonsPresets } from './presets';
import UAGPresets from '@Components/presets';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import { decodeEntities } from '@wordpress/html-entities';
import UAGNumberControl from '@Components/number-control';
import responsiveConditionPreview from '@Controls/responsiveConditionPreview';
import apiFetch from '@wordpress/api-fetch';
import UAGTextControl from '@Components/text-control';
import DynamicCSSLoader from '@Components/dynamic-css-loader';
import DynamicFontLoader from '.././dynamicFontLoader';
import { compose } from '@wordpress/compose';
import AddStaticStyles from '@Controls/AddStaticStyles';
import addInitialAttr from '@Controls/addInitialAttr';
import Settings from './settings';
import Render from './render';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const MAX_POSTS_COLUMNS = 8;

import { Placeholder, Spinner, ToggleControl, Icon, ExternalLink } from '@wordpress/components';

import { InspectorControls } from '@wordpress/block-editor';

import { useSelect, useDispatch } from '@wordpress/data';

const VexaltrixPostMasonry = ( props ) => {
	const {
		isSelected,
		setAttributes,
		attributes,
		attributes: {
			btnVPadding,
			btnHPadding,
			contentPadding,
			contentPaddingMobile,
			contentPaddingTablet,
			vpaginationButtonPaddingMobile,
			vpaginationButtonPaddingTablet,
			vpaginationButtonPaddingDesktop,
			hpaginationButtonPaddingMobile,
			hpaginationButtonPaddingTablet,
			hpaginationButtonPaddingDesktop,
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
			allTaxonomyStore,
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
			order,
			orderBy,
			categories,
			postsToShow,
			rowGap,
			rowGapTablet,
			rowGapMobile,
			columnGap,
			columnGapTablet,
			columnGapMobile,
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
			excerptLength,
			overlayOpacity,
			bgOverlayColor,
			linkBox,
			postType,
			taxonomyType,
			postDisplaytext,
			paginationType,
			paginationEventType,
			buttonText,
			paginationAlign,
			paginationTextColor,
			paginationTextHoverColor,
			paginationMasonryBgColor,
			paginationBgHoverColor,
			paginationFontSize,
			loaderColor,
			loaderSize,
			paginationButtonPaddingTop,
			paginationButtonPaddingRight,
			paginationButtonPaddingBottom,
			paginationButtonPaddingLeft,
			paginationButtonPaddingTopTablet,
			paginationButtonPaddingRightTablet,
			paginationButtonPaddingBottomTablet,
			paginationButtonPaddingLeftTablet,
			paginationButtonPaddingTopMobile,
			paginationButtonPaddingRightMobile,
			paginationButtonPaddingBottomMobile,
			paginationButtonPaddingLeftMobile,
			mobilepaginationButtonPaddingType,
			tabletpaginationButtonPaddingType,
			paginationButtonPaddingType,
			displayPostContentRadio,
			excludeCurrentPost,
			rowGapUnit,
			columnGapUnit,
			imageBottomSpaceUnit,
			taxonomyBottomSpaceUnit,
			titleBottomSpaceUnit,
			metaBottomSpaceUnit,
			ctaBottomSpaceUnit,
			titleTransform,
			metaTransform,
			excerptTransform,
			ctaTransform,
			titleDecoration,
			metaDecoration,
			excerptDecoration,
			ctaDecoration,
			paddingBtnTop,
			paddingBtnBottom,
			paddingBtnLeft,
			paddingBtnRight,
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
			mobilePaddingUnit,
			tabletPaddingUnit,
			excerptBottomSpaceUnit,
			contentPaddingUnit,
			postsOffset,
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
			UAGHideDesktop,
			UAGHideTab,
			UAGHideMob,
		},
		deviceType,
		clientId,
	} = props;

	const [ state, setState ] = useState( {
		isEditing: false,
		innerBlocks: [],
	} );

	const [ isTaxonomyLoading, setIsTaxonomyLoading ] = useState( false );

	useEffect( () => {
		if ( vpaginationButtonPaddingDesktop ) {
			if ( ! paginationButtonPaddingTop ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingTop: vpaginationButtonPaddingDesktop,
				} ) );
			}
			if ( ! paginationButtonPaddingBottom ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingBottom: vpaginationButtonPaddingDesktop,
				} ) );
			}
		}
		if ( hpaginationButtonPaddingDesktop ) {
			if ( ! paginationButtonPaddingRight ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingRight: hpaginationButtonPaddingDesktop,
				} ) );
			}
			if ( ! paginationButtonPaddingLeft ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingLeft: hpaginationButtonPaddingDesktop,
				} ) );
			}
		}
		if ( vpaginationButtonPaddingTablet ) {
			if ( ! paginationButtonPaddingTopTablet ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingTopTablet: vpaginationButtonPaddingTablet,
				} ) );
			}
			if ( ! paginationButtonPaddingBottomTablet ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingBottomTablet: vpaginationButtonPaddingTablet,
				} ) );
			}
		}
		if ( hpaginationButtonPaddingTablet ) {
			if ( ! paginationButtonPaddingRightTablet ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingRightTablet: hpaginationButtonPaddingTablet,
				} ) );
			}
			if ( ! paginationButtonPaddingLeftTablet ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingLeftTablet: hpaginationButtonPaddingTablet,
				} ) );
			}
		}
		if ( vpaginationButtonPaddingMobile ) {
			if ( ! paginationButtonPaddingTopMobile ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingTopMobile: vpaginationButtonPaddingMobile,
				} ) );
			}
			if ( ! paginationButtonPaddingBottomMobile ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingBottomMobile: vpaginationButtonPaddingMobile,
				} ) );
			}
		}
		if ( hpaginationButtonPaddingMobile ) {
			if ( ! paginationButtonPaddingRightMobile ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingRightMobile: hpaginationButtonPaddingMobile,
				} ) );
			}
			if ( ! paginationButtonPaddingLeftMobile ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paginationButtonPaddingLeftMobile: hpaginationButtonPaddingMobile,
				} ) );
			}
		}
		if ( btnVPadding ) {
			if ( undefined === paddingBtnTop ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingBtnTop: btnVPadding,
				} ) );
			}
			if ( undefined === paddingBtnBottom ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingBtnBottom: btnVPadding,
				} ) );
			}
		}
		if ( btnHPadding ) {
			if ( undefined === paddingBtnRight ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingBtnRight: btnHPadding,
				} ) );
			}
			if ( undefined === paddingBtnLeft ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingBtnLeft: btnHPadding,
				} ) );
			}
		}
		if ( contentPadding ) {
			if ( undefined === paddingTop ) {
				// setAttributes( { paddingTop: contentPadding } );
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingTop: contentPadding,
				} ) );
			}
			if ( undefined === paddingBottom ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingBottom: contentPadding,
				} ) );
			}
			if ( undefined === paddingRight ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingRight: contentPadding,
				} ) );
			}
			if ( undefined === paddingLeft ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingLeft: contentPadding,
				} ) );
			}
		}
		if ( contentPaddingTablet ) {
			if ( undefined === paddingTopTablet ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingTopTablet: contentPaddingTablet,
				} ) );
			}
			if ( undefined === paddingBottomTablet ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingBottomTablet: contentPaddingTablet,
				} ) );
			}
			if ( undefined === paddingRightTablet ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingRightTablet: contentPaddingTablet,
				} ) );
			}
			if ( undefined === paddingLeftTablet ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingLeftTablet: contentPaddingTablet,
				} ) );
			}
		}
		if ( contentPaddingMobile ) {
			if ( undefined === paddingTopMobile ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingTopMobile: contentPaddingMobile,
				} ) );
			}
			if ( undefined === paddingBottomMobile ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingBottomMobile: contentPaddingMobile,
				} ) );
			}
			if ( undefined === paddingRightMobile ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingRightMobile: contentPaddingMobile,
				} ) );
			}
			if ( undefined === paddingLeftMobile ) {
				setAttributes( ( prevAttributes ) => ( {
					...prevAttributes,
					paddingLeftMobile: contentPaddingMobile,
				} ) );
			}
		}
	}, [] );

	useEffect( () => {
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

		// Replacement for componentDidUpdate.
	}, [ attributes ] );

	useEffect( () => {
		scrollBlockToView();
	}, [ deviceType ] );

	useEffect( () => {
		responsiveConditionPreview( props );
	}, [ UAGHideDesktop, UAGHideTab, UAGHideMob, deviceType ] );

	const blockStyling = useMemo( () => styling( attributes, clientId, deviceType ), [ attributes, deviceType ] );

	const togglePreview = () => {
		setState( { isEditing: ! state.isEditing } );
		if ( ! state.isEditing ) {
			__( 'Showing All Post Masonry Layout.', 'vexaltrix' );
		}
	};

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
		setAttributes( { paginationType: 'none' } ); // setting up pagination none when enableOffset is true.
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

		// let categoriesList = [];
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
	const onChangePostsOffset = ( value ) => {
		setAttributes( { postsOffset: value } );
	};
	const hasPosts = Array.isArray( latestPosts ) && latestPosts.length;

	const generalSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'General', 'vexaltrix' ) } initialOpen={ true }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Text Alignment', 'vexaltrix' ) }
					data={ {
						value: align,
						label: 'align',
					} }
					className="vxt-multi-button-alignment-control"
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
							{ ! enableOffset && (
								<>
									{ __(
										'Note: Enabling this will disable the Pagination. Setting the offset parameter overrides/ignores the paged parameter and breaks pagination.',
										'vexaltrix'
									) }
									<ExternalLink href={ VXT_LINKS.WP_QUERY_PAGINATION_DOCS }>
										{ __( 'Read more', 'vexaltrix' ) }
									</ExternalLink>
								</>
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
						onChange={ onChangePostsOffset }
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
					min={ 0 }
					max={ MAX_POSTS_COLUMNS }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
				{ ! enableOffset && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Pagination', 'vexaltrix' ) }
						data={ {
							value: paginationType,
							label: 'paginationType',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'none',
								label: 'None',
							},
							{
								value: 'infinite',
								label: 'Infinite',
							},
						] }
						showIcons={ false }
					/>
				) }
				{ 'infinite' === paginationType && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Infinite Load Event', 'vexaltrix' ) }
						data={ {
							value: paginationEventType,
							label: 'paginationEventType',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'button',
								label: 'Button',
							},
							{
								value: 'scroll',
								label: 'Scroll',
							},
						] }
						showIcons={ false }
					/>
				) }
				{ 'infinite' === paginationType && 'button' === paginationEventType && (
					<>
						<UAGTextControl
							autoComplete="off"
							label={ __( 'Button Text', 'vexaltrix' ) }
							value={ buttonText }
							data={ {
								value: buttonText,
								label: 'buttonText',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) => setAttributes( { buttonText: value } ) }
						/>
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'Pagination Button Alignment', 'vexaltrix' ) }
							data={ {
								value: paginationAlign,
								label: 'paginationAlign',
							} }
							className="vxt-multi-button-alignment-control"
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
					</>
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
	const paginationSettings = () => {
		if ( 'infinite' === paginationType ) {
			return (
				<UAGAdvancedPanelBody
					title={ __( 'Pagination', 'vexaltrix' ) }
					initialOpen={ false }
					className="vxt_ultimate_gutenberg_blocks__url-panel-body"
				>
					{ 'button' === paginationEventType && (
						<>
							<Range
								label={ __( 'Font Size', 'vexaltrix' ) }
								value={ paginationFontSize }
								data={ {
									value: paginationFontSize,
									label: 'paginationFontSize',
								} }
								setAttributes={ setAttributes }
								min={ 0 }
								max={ 100 }
								displayUnit={ false }
							/>
							<SpacingControl
								{ ...props }
								label={ __( 'Padding', 'vexaltrix' ) }
								valueTop={ {
									value: paginationButtonPaddingTop,
									label: 'paginationButtonPaddingTop',
								} }
								valueRight={ {
									value: paginationButtonPaddingRight,
									label: 'paginationButtonPaddingRight',
								} }
								valueBottom={ {
									value: paginationButtonPaddingBottom,
									label: 'paginationButtonPaddingBottom',
								} }
								valueLeft={ {
									value: paginationButtonPaddingLeft,
									label: 'paginationButtonPaddingLeft',
								} }
								valueTopTablet={ {
									value: paginationButtonPaddingTopTablet,
									label: 'paginationButtonPaddingTopTablet',
								} }
								valueRightTablet={ {
									value: paginationButtonPaddingRightTablet,
									label: 'paginationButtonPaddingRightTablet',
								} }
								valueBottomTablet={ {
									value: paginationButtonPaddingBottomTablet,
									label: 'paginationButtonPaddingBottomTablet',
								} }
								valueLeftTablet={ {
									value: paginationButtonPaddingLeftTablet,
									label: 'paginationButtonPaddingLeftTablet',
								} }
								valueTopMobile={ {
									value: paginationButtonPaddingTopMobile,
									label: 'paginationButtonPaddingTopMobile',
								} }
								valueRightMobile={ {
									value: paginationButtonPaddingRightMobile,
									label: 'paginationButtonPaddingRightMobile',
								} }
								valueBottomMobile={ {
									value: paginationButtonPaddingBottomMobile,
									label: 'paginationButtonPaddingBottomMobile',
								} }
								valueLeftMobile={ {
									value: paginationButtonPaddingLeftMobile,
									label: 'paginationButtonPaddingLeftMobile',
								} }
								unit={ {
									value: paginationButtonPaddingType,
									label: 'paginationButtonPaddingType',
								} }
								mUnit={ {
									value: mobilepaginationButtonPaddingType,
									label: 'mobilepaginationButtonPaddingType',
								} }
								tUnit={ {
									value: tabletpaginationButtonPaddingType,
									label: 'tabletpaginationButtonPaddingType',
								} }
								deviceType={ deviceType }
								attributes={ attributes }
								setAttributes={ setAttributes }
								link={ {
									value: spacingLink,
									label: 'spacingLink',
								} }
							/>
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
											label={ __( 'Text Color', 'vexaltrix' ) }
											colorValue={ paginationTextColor }
											data={ {
												value: paginationTextColor,
												label: 'paginationTextColor',
											} }
											setAttributes={ setAttributes }
										/>
										<AdvancedPopColorControl
											label={ __( 'Background Color', 'vexaltrix' ) }
											colorValue={ paginationMasonryBgColor }
											data={ {
												value: paginationMasonryBgColor,
												label: 'paginationMasonryBgColor',
											} }
											setAttributes={ setAttributes }
										/>
									</>
								}
								hover={
									<>
										<AdvancedPopColorControl
											label={ __( 'Text Color', 'vexaltrix' ) }
											colorValue={ paginationTextHoverColor }
											data={ {
												value: paginationTextHoverColor,
												label: 'paginationTextHoverColor',
											} }
											setAttributes={ setAttributes }
										/>
										<AdvancedPopColorControl
											label={ __( 'Background Color', 'vexaltrix' ) }
											colorValue={ paginationBgHoverColor }
											data={ {
												value: paginationBgHoverColor,
												label: 'paginationBgHoverColor',
											} }
											setAttributes={ setAttributes }
										/>
									</>
								}
								disableBottomSeparator={ false }
							/>
							<ResponsiveBorder
								setAttributes={ setAttributes }
								prefix={ 'paginationMasonry' }
								attributes={ attributes }
								deviceType={ deviceType }
								disableBottomSeparator={ true }
								disabledBorderTitle={ false }
							/>
						</>
					) }
					{ 'scroll' === paginationEventType && (
						<>
							<AdvancedPopColorControl
								label={ __( 'Loader Color', 'vexaltrix' ) }
								colorValue={ loaderColor }
								data={ {
									value: loaderColor,
									label: 'loaderColor',
								} }
								setAttributes={ setAttributes }
							/>
							<Range
								label={ __( 'Loader Size', 'vexaltrix' ) }
								setAttributes={ setAttributes }
								value={ loaderSize }
								data={ {
									value: loaderSize,
									label: 'loaderSize',
								} }
								min={ 1 }
								max={ 50 }
								displayUnit={ false }
							/>
						</>
					) }
				</UAGAdvancedPanelBody>
			);
		}

		return '';
	};
	const imageSettings = () => {
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
	const contentSettings = () => {
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
	const readMoreLinkSettings = () => {
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
						<UAGPresets
							setAttributes={ setAttributes }
							presets={ buttonsPresets }
							presetInputType="radioImage"
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const spacingSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) } initialOpen={ true }>
				<AdvancedPopColorControl
					label={ __( 'Background Color', 'vexaltrix' ) }
					colorValue={ bgColor }
					data={ {
						value: bgColor,
						label: 'bgColor',
					} }
					setAttributes={ setAttributes }
				/>
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
				<ResponsiveSlider
					label={ __( 'Row Gap', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: columnGap,
							label: 'columnGap',
						},
						tablet: {
							value: columnGapTablet,
							label: 'columnGapTablet',
						},
						mobile: {
							value: columnGapMobile,
							label: 'columnGapMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					unit={ {
						value: columnGapUnit,
						label: 'columnGapUnit',
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
								className="vxt-multi-button-alignment-control"
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
								className="vxt-multi-button-alignment-control"
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
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'btn' }
					attributes={ attributes }
					deviceType={ deviceType }
				/>
				<SpacingControl
					{ ...props }
					label={ __( 'Button Padding', 'vexaltrix' ) }
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
			</UAGAdvancedPanelBody>
		);
	};

	const inspectorControls = (
		<InspectorControls>
			<InspectorTabs>
				<InspectorTab { ...UAGTabs.general }>
					{ generalSettings() }
					{ imageSettings() }
					{ contentSettings() }
					{ readMoreLinkSettings() }
					{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status && (
						<UAGAdvancedPanelBody className="block-editor-block-inspector__upgrade_pro vxt-upgrade_pro-tab">
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
									campaign: 'post-masonry',
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
					{ paginationSettings() }
					{ displayPostImage === true && imageStyle() }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);

	if ( ! hasPosts ) {
		return (
			<>
				{ inspectorControls }
				<Placeholder icon="admin-post" label={ __( 'Post Masonry', 'vexaltrix' ) }>
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
					{ ...props }
					state={ state }
					inspectorControls={ inspectorControls }
					togglePreview={ togglePreview }
					taxonomyList={ taxonomyList }
					categoriesList={ categoriesList }
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

export default compose( addInitialAttr, AddStaticStyles )( VexaltrixPostMasonry );
