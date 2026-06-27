import { __ } from '@wordpress/i18n';

import { memo } from '@wordpress/element';
import renderSVG from '@Controls/renderIcon';
import TypographyControl from '@Components/typography';
import BoxShadowControl from '@Components/box-shadow';
import ResponsiveBorder from '@Components/responsive-border';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import SpacingControl from '@Components/spacing-control';
import Range from '@Components/range/Range.js';
import ResponsiveSlider from '@Components/responsive-slider';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGSelectControl from '@Components/select-control';
import UAGTabsControl from '@Components/tabs';
import { Icon, ToggleControl } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';

import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import boxShadowPresets from './presets';
import UAGPresets from '@Components/presets';

import UAGTextControl from '@Components/text-control';

import getApiData from '@Controls/getApiData';

const Settings = ( props ) => {
	// Caching all Props.
	const { attributes, setAttributes, taxonomyList, termsList, deviceType } = props;

	// Caching all attributes.
	const {
		block_id,
		postType,
		taxonomyType,
		layout,
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
		contentPaddingLink,
		titleBottomSpace,
		titleBottomSpaceTablet,
		titleBottomSpaceMobile,
		alignment,
		listStyle,
		listTextColor,
		hoverlistTextColor,
		listBottomMargin,
		listStyleColor,
		hoverlistStyleColor,
		noTaxDisplaytext,
		boxShadowColor,
		boxShadowHOffset,
		boxShadowVOffset,
		boxShadowBlur,
		boxShadowSpread,
		boxShadowPosition,
		showCount,
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
		countFontSize,
		countFontSizeType,
		countFontSizeMobile,
		countFontSizeTablet,
		countFontFamily,
		countFontWeight,
		countFontStyle,
		countLineHeightType,
		countLineHeight,
		countLineHeightTablet,
		countLineHeightMobile,
		countLoadGoogleFonts,
		listFontSize,
		listFontSizeType,
		listFontSizeMobile,
		listFontSizeTablet,
		listFontFamily,
		listFontWeight,
		listFontStyle,
		listLineHeightType,
		listLineHeight,
		listLineHeightTablet,
		listLineHeightMobile,
		listLoadGoogleFonts,
		showEmptyTaxonomy,
		listDisplayStyle,
		showhierarchy,
		titleTag,
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
		seperatorHoverColor,
	} = attributes;

	const taxonomy_list_setting = showEmptyTaxonomy ? taxonomyList : termsList;
	const taxonomyListOptions = [
		{
			value: '',
			label: __( 'Select Taxonomy', 'vexaltrix' ),
		},
	];

	if ( '' !== taxonomy_list_setting && undefined !== taxonomy_list_setting ) {
		Object.keys( taxonomy_list_setting ).map( ( item ) => {
			return taxonomyListOptions.push( {
				value: taxonomyList[ item ].name,
				label: taxonomyList[ item ].label,
			} );
		} );
	}

	// All Controls.
	const colorControl = (
		<>
			<AdvancedPopColorControl
				label={ __( 'Text Color', 'vexaltrix' ) }
				colorValue={ listTextColor ? listTextColor : '' }
				data={ {
					value: listTextColor,
					label: 'listTextColor',
				} }
				setAttributes={ setAttributes }
			/>
			<br />

			{ 'none' !== listStyle && (
				<>
					<AdvancedPopColorControl
						label={ __( 'Bullet/Numbers Color', 'vexaltrix' ) }
						colorValue={ listStyleColor ? listStyleColor : '' }
						data={ {
							value: listStyleColor,
							label: 'listStyleColor',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			) }
		</>
	);
	const colorControlHover = (
		<>
			<AdvancedPopColorControl
				label={ __( 'Text Color', 'vexaltrix' ) }
				colorValue={ hoverlistTextColor ? hoverlistTextColor : '' }
				data={ {
					value: hoverlistTextColor,
					label: 'hoverlistTextColor',
				} }
				setAttributes={ setAttributes }
			/>
			<br />
			{ 'none' !== listStyle && (
				<>
					<AdvancedPopColorControl
						label={ __( 'Bullet/Numbers Color', 'vexaltrix' ) }
						colorValue={ hoverlistStyleColor ? hoverlistStyleColor : '' }
						data={ {
							value: hoverlistStyleColor,
							label: 'hoverlistStyleColor',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			) }
		</>
	);

	const onSelectPostType = ( value ) => {
		// Create an object with the nonce property
		const data = {
			nonce: vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_ajax_nonce,
		};
		// Call the getApiData function with the specified parameters
		const getApiFetchData = getApiData( {
			url: vxt_ultimate_gutenberg_blocks_blocks_info.ajax_url,
			action: 'vxt_ultimate_gutenberg_blocks_get_taxonomy',
			data,
		} );
		// Wait for the API call to complete, then update the attributes
		getApiFetchData.then( ( _data ) => {
			setAttributes( { listInJson: _data } );
			setAttributes( { postType: value } );
			setAttributes( { categories: '' } );
			setAttributes( { taxonomyType: '' } );
		} );
	};

	const onSelectTaxonomyType = ( value ) => {
		setAttributes( { taxonomyType: value } );
		setAttributes( { categories: '' } );
	};

	const generalPanel = () => {
		let tempTitleTag = titleTag;
		if ( '' === titleTag ) {
			tempTitleTag = 'h4';

			if ( 'list' === layout ) {
				tempTitleTag = 'div';
			}
		}
		return (
			<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) } initialOpen={ false }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Heading Tag', 'vexaltrix' ) }
					data={ {
						value: tempTitleTag,
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
							value: 'div',
							label: __( 'Div', 'vexaltrix' ),
						},
					] }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Layout', 'vexaltrix' ) }
					data={ {
						value: layout,
						label: 'layout',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: 'grid',
							label: 'Grid',
						},
						{
							value: 'list',
							label: 'List',
						},
					] }
					showIcons={ false }
				/>
				{ 'grid' === layout && (
					<ResponsiveSlider
						label={ __( 'Columns', 'vexaltrix' ) }
						data={ {
							desktop: {
								value: columns,
								label: 'columns',
								min: 1,
								max: 4,
							},
							tablet: {
								value: tcolumns,
								label: 'tcolumns',
								min: 1,
								max: 3,
							},
							mobile: {
								value: mcolumns,
								label: 'mcolumns',
								min: 1,
								max: 2,
							},
						} }
						min={ 1 }
						max={ 4 }
						displayUnit={ false }
						setAttributes={ setAttributes }
					/>
				) }
				{ 'list' === layout && (
					<>
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'Display Style', 'vexaltrix' ) }
							data={ {
								value: listDisplayStyle,
								label: 'listDisplayStyle',
							} }
							className="vxt-multi-button-alignment-control"
							options={ [
								{
									value: 'list',
									label: 'List',
								},
								{
									value: 'dropdown',
									label: 'Dropdown',
								},
							] }
							showIcons={ false }
						/>
					</>
				) }
				{ 'grid' === layout && (
					<>
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'Alignment', 'vexaltrix' ) }
							data={ {
								value: alignment,
								label: 'alignment',
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
				{ 'list' === layout && 'dropdown' !== listDisplayStyle && (
					<>
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'List Style', 'vexaltrix' ) }
							data={ {
								value: listStyle,
								label: 'listStyle',
							} }
							className="vxt-multi-button-alignment-control"
							options={ [
								{
									value: 'disc',
									icon: <Icon icon={ renderSVG( 'fa fa-list-ul' ) } />,
									tooltip: __( 'Bullet', 'vexaltrix' ),
								},
								{
									value: 'decimal',
									icon: <Icon icon={ renderSVG( 'fa fa-list-ol' ) } />,
									tooltip: __( 'Numbers', 'vexaltrix' ),
								},
								{
									value: 'none',
									icon: <Icon icon={ renderSVG( 'fa fa-bars' ) } />,
									tooltip: __( 'None', 'vexaltrix' ),
								},
							] }
							showIcons={ true }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const postQueryPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Query', 'vexaltrix' ) } initialOpen={ true }>
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
				{ '' === taxonomyList && (
					<UAGTextControl
						autoComplete="off"
						label={ __( 'Display Message', 'vexaltrix' ) }
						value={ noTaxDisplaytext }
						data={ {
							value: noTaxDisplaytext,
							label: 'noTaxDisplaytext',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { noTaxDisplaytext: value } ) }
						help={ __( 'If taxonomy Not Found', 'vexaltrix' ) }
					/>
				) }

				<ToggleControl
					label={ __( 'Show Empty Taxonomy', 'vexaltrix' ) }
					checked={ showEmptyTaxonomy }
					onChange={ () =>
						setAttributes( {
							showEmptyTaxonomy: ! showEmptyTaxonomy,
						} )
					}
				/>
				<ToggleControl
					label={ __( 'Show Posts Count', 'vexaltrix' ) }
					checked={ showCount }
					onChange={ () => setAttributes( { showCount: ! showCount } ) }
				/>
				{ 'list' === layout && 'list' === listDisplayStyle && 'post_tag' !== taxonomyType && (
					<ToggleControl
						label={ __( 'Show Hierarchy', 'vexaltrix' ) }
						checked={ showhierarchy }
						onChange={ () =>
							setAttributes( {
								showhierarchy: ! showhierarchy,
							} )
						}
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const titleColorPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Title', 'vexaltrix' ) } initialOpen={ true }>
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
					transform={ {
						value: titleTransform,
						label: 'titleTransform',
					} }
					decoration={ {
						value: titleDecoration,
						label: 'titleDecoration',
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
				/>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ titleColor ? titleColor : '' }
					data={ {
						value: titleColor,
						label: 'titleColor',
					} }
					setAttributes={ setAttributes }
				/>
				{ showCount && (
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
						displayUnit={ false }
						setAttributes={ setAttributes }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const countColorPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Count', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ countColor ? countColor : '' }
					data={ {
						value: countColor,
						label: 'countColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: countLoadGoogleFonts,
						label: 'countLoadGoogleFonts',
					} }
					fontFamily={ {
						value: countFontFamily,
						label: 'countFontFamily',
					} }
					fontWeight={ {
						value: countFontWeight,
						label: 'countFontWeight',
					} }
					fontStyle={ {
						value: countFontStyle,
						label: 'countFontStyle',
					} }
					fontSizeType={ {
						value: countFontSizeType,
						label: 'countFontSizeType',
					} }
					fontSize={ {
						value: countFontSize,
						label: 'countFontSize',
					} }
					fontSizeMobile={ {
						value: countFontSizeMobile,
						label: 'countFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: countFontSizeTablet,
						label: 'countFontSizeTablet',
					} }
					lineHeightType={ {
						value: countLineHeightType,
						label: 'countLineHeightType',
					} }
					lineHeight={ {
						value: countLineHeight,
						label: 'countLineHeight',
					} }
					lineHeightMobile={ {
						value: countLineHeightMobile,
						label: 'countLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: countLineHeightTablet,
						label: 'countLineHeightTablet',
					} }
					transform={ {
						value: countTransform,
						label: 'countTransform',
					} }
					decoration={ {
						value: countDecoration,
						label: 'countDecoration',
					} }
					letterSpacing={ {
						value: countLetterSpacing,
						label: 'countLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: countLetterSpacingTablet,
						label: 'countLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: countLetterSpacingMobile,
						label: 'countLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: countLetterSpacingType,
						label: 'countLetterSpacingType',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const bgColorPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Background', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ bgColor ? bgColor : '' }
					data={ {
						value: bgColor,
						label: 'bgColor',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const spacingPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
				{ 'grid' === layout && (
					<>
						<ResponsiveSlider
							label={ __( 'Row Gap', 'vexaltrix' ) }
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
							min={ 1 }
							max={ 50 }
							displayUnit={ false }
							setAttributes={ setAttributes }
						/>
						<ResponsiveSlider
							label={ __( 'Column Gap', 'vexaltrix' ) }
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
							min={ 1 }
							max={ 50 }
							displayUnit={ false }
							setAttributes={ setAttributes }
						/>
						<SpacingControl
							{ ...props }
							label={ __( 'Padding', 'vexaltrix' ) }
							valueTop={ {
								value: contentTopPadding,
								label: 'contentTopPadding',
							} }
							valueRight={ {
								value: contentRightPadding,
								label: 'contentRightPadding',
							} }
							valueBottom={ {
								value: contentBottomPadding,
								label: 'contentBottomPadding',
							} }
							valueLeft={ {
								value: contentLeftPadding,
								label: 'contentLeftPadding',
							} }
							valueTopTablet={ {
								value: contentTopPaddingTablet,
								label: 'contentTopPaddingTablet',
							} }
							valueRightTablet={ {
								value: contentRightPaddingTablet,
								label: 'contentRightPaddingTablet',
							} }
							valueBottomTablet={ {
								value: contentBottomPaddingTablet,
								label: 'contentBottomPaddingTablet',
							} }
							valueLeftTablet={ {
								value: contentLeftPaddingTablet,
								label: 'contentLeftPaddingTablet',
							} }
							valueTopMobile={ {
								value: contentTopPaddingMobile,
								label: 'contentTopPaddingMobile',
							} }
							valueRightMobile={ {
								value: contentRightPaddingMobile,
								label: 'contentRightPaddingMobile',
							} }
							valueBottomMobile={ {
								value: contentBottomPaddingMobile,
								label: 'contentBottomPaddingMobile',
							} }
							valueLeftMobile={ {
								value: contentLeftPaddingMobile,
								label: 'contentLeftPaddingMobile',
							} }
							unit={ {
								value: contentPaddingUnit,
								label: 'contentPaddingUnit',
							} }
							mUnit={ {
								value: mobileContentPaddingUnit,
								label: 'mobileContentPaddingUnit',
							} }
							tUnit={ {
								value: tabletContentPaddingUnit,
								label: 'tabletContentPaddingUnit',
							} }
							deviceType={ deviceType }
							attributes={ attributes }
							setAttributes={ setAttributes }
							link={ {
								value: contentPaddingLink,
								label: 'contentPaddingLink',
							} }
						/>
					</>
				) }
				{ 'list' === layout && (
					<Range
						label={ __( 'Bottom Margin', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ listBottomMargin }
						data={ {
							value: listBottomMargin,
							label: 'listBottomMargin',
						} }
						min={ 0 }
						max={ 100 }
						displayUnit={ false }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const borderPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Border', 'vexaltrix' ) } initialOpen={ false }>
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'overall' }
					attributes={ attributes }
					deviceType={ deviceType }
					disableBottomSeparator={ true }
					disabledBorderTitle={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const listPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'List', 'vexaltrix' ) } initialOpen={ false }>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: listLoadGoogleFonts,
						label: 'listLoadGoogleFonts',
					} }
					fontFamily={ {
						value: listFontFamily,
						label: 'listFontFamily',
					} }
					fontWeight={ {
						value: listFontWeight,
						label: 'listFontWeight',
					} }
					fontStyle={ {
						value: listFontStyle,
						label: 'listFontStyle',
					} }
					fontSizeType={ {
						value: listFontSizeType,
						label: 'listFontSizeType',
					} }
					fontSize={ {
						value: listFontSize,
						label: 'listFontSize',
					} }
					fontSizeMobile={ {
						value: listFontSizeMobile,
						label: 'listFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: listFontSizeTablet,
						label: 'listFontSizeTablet',
					} }
					lineHeightType={ {
						value: listLineHeightType,
						label: 'listLineHeightType',
					} }
					lineHeight={ {
						value: listLineHeight,
						label: 'listLineHeight',
					} }
					lineHeightMobile={ {
						value: listLineHeightMobile,
						label: 'listLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: listLineHeightTablet,
						label: 'listLineHeightTablet',
					} }
					transform={ {
						value: listTransform,
						label: 'listTransform',
					} }
					decoration={ {
						value: listDecoration,
						label: 'listDecoration',
					} }
					letterSpacing={ {
						value: listLetterSpacing,
						label: 'listLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: listLetterSpacingTablet,
						label: 'listLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: listLetterSpacingMobile,
						label: 'listLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: listLetterSpacingType,
						label: 'listLetterSpacingType',
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
					normal={ colorControl }
					hover={ colorControlHover }
					disableBottomSeparator={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const separatorPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Separator', 'vexaltrix' ) } initialOpen={ false }>
				<UAGSelectControl
					label={ __( 'Separator Style', 'vexaltrix' ) }
					data={ {
						value: seperatorStyle,
						label: 'seperatorStyle',
					} }
					setAttributes={ setAttributes }
					options={ [
						{ value: 'none', label: __( 'None', 'vexaltrix' ) },
						{ value: 'solid', label: __( 'Solid', 'vexaltrix' ) },
						{ value: 'dotted', label: __( 'Dotted', 'vexaltrix' ) },
						{ value: 'dashed', label: __( 'Dashed', 'vexaltrix' ) },
						{ value: 'double', label: __( 'Double', 'vexaltrix' ) },
						{ value: 'groove', label: __( 'Groove', 'vexaltrix' ) },
						{ value: 'inset', label: __( 'Inset', 'vexaltrix' ) },
						{ value: 'outset', label: __( 'Outset', 'vexaltrix' ) },
						{ value: 'ridge', label: __( 'Ridge', 'vexaltrix' ) },
					] }
				/>
				{ 'none' !== seperatorStyle && (
					<>
						<Range
							label={ __( 'Separator Width (%)', 'vexaltrix' ) }
							value={ seperatorWidth }
							min={ 0 }
							max={ 100 }
							setAttributes={ setAttributes }
							data={ {
								value: seperatorWidth,
								label: 'seperatorWidth',
							} }
							displayUnit={ false }
						/>
						<Range
							label={ __( 'Separator Thickness', 'vexaltrix' ) }
							value={ seperatorThickness }
							min={ 0 }
							max={ 20 }
							setAttributes={ setAttributes }
							data={ {
								value: seperatorThickness,
								label: 'seperatorThickness',
							} }
							displayUnit={ false }
						/>
						<AdvancedPopColorControl
							label={ __( 'Color', 'vexaltrix' ) }
							colorValue={ seperatorColor ? seperatorColor : '' }
							data={ {
								value: seperatorColor,
								label: 'seperatorColor',
							} }
							setAttributes={ setAttributes }
						/>
						<AdvancedPopColorControl
							label={ __( 'Hover Color', 'vexaltrix' ) }
							colorValue={ seperatorHoverColor ? seperatorHoverColor : '' }
							data={ {
								value: seperatorHoverColor,
								label: 'seperatorHoverColor',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const boxShadowPanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Box Shadow', 'vexaltrix' ) } initialOpen={ false }>
				<UAGPresets setAttributes={ setAttributes } presets={ boxShadowPresets } presetInputType="radioImage" />
				<BoxShadowControl
					blockId={ block_id }
					setAttributes={ setAttributes }
					label={ __( 'Box Shadow', 'vexaltrix' ) }
					boxShadowColor={ {
						value: boxShadowColor,
						label: 'boxShadowColor',
						title: __( 'Color', 'vexaltrix' ),
					} }
					boxShadowHOffset={ {
						value: boxShadowHOffset,
						label: 'boxShadowHOffset',
						title: __( 'Horizontal', 'vexaltrix' ),
					} }
					boxShadowVOffset={ {
						value: boxShadowVOffset,
						label: 'boxShadowVOffset',
						title: __( 'Vertical', 'vexaltrix' ),
					} }
					boxShadowBlur={ {
						value: boxShadowBlur,
						label: 'boxShadowBlur',
						title: __( 'Blur', 'vexaltrix' ),
					} }
					boxShadowSpread={ {
						value: boxShadowSpread,
						label: 'boxShadowSpread',
						title: __( 'Spread', 'vexaltrix' ),
					} }
					boxShadowPosition={ {
						value: boxShadowPosition,
						label: 'boxShadowPosition',
						title: __( 'Position', 'vexaltrix' ),
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const inspectorControlsSettings = (
		<InspectorControls>
			<InspectorTabs>
				<InspectorTab { ...UAGTabs.general }>
					{ postQueryPanel() }
					{ generalPanel() }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.style }>
					{ 'grid' === layout && 'dropdown' !== listDisplayStyle && titleColorPanel() }
					{ 'grid' === layout && 'dropdown' !== listDisplayStyle && showCount && countColorPanel() }
					{ 'grid' === layout && 'dropdown' !== listDisplayStyle && bgColorPanel() }
					{ 'grid' === layout && 'dropdown' !== listDisplayStyle && borderPanel() }
					{ 'grid' === layout && 'dropdown' !== listDisplayStyle && boxShadowPanel() }
					{ 'list' === layout && 'dropdown' !== listDisplayStyle && listPanel() }
					{ 'list' === layout && 'dropdown' !== listDisplayStyle && separatorPanel() }
					{ 'dropdown' !== listDisplayStyle && spacingPanel() }
					{ 'list' === layout && 'dropdown' === listDisplayStyle && (
						<p className="vxt-settings-notice">
							{ __( 'There is no style available for the currently selected layout.', 'vexaltrix' ) }
						</p>
					) }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);

	return <>{ inspectorControlsSettings }</>;
};

export default memo( Settings );
