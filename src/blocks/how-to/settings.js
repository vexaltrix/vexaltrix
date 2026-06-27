import TypographyControl from '@Components/typography';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import Range from '@Components/range/Range.js';
import UAGMediaPicker from '@Components/image';
import { getImageSize } from '@Utils/Helpers';
import renderSVG from '@Controls/renderIcon';
import { ToggleControl, ExternalLink, Icon } from '@wordpress/components';
import MultiButtonsControl from '@Components/multi-buttons-control';
import ResponsiveSlider from '@Components/responsive-slider';
import UAGSelectControl from '@Components/select-control';
import { VXT_LINKS } from '@Store/constants';
let imageSizeOptions = [
	{
		value: 'thumbnail',
		label: __( 'Thumbnail', 'vexaltrix' ),
	},
	{ value: 'medium', label: __( 'Medium', 'vexaltrix' ) },
	{ value: 'full', label: __( 'Large', 'vexaltrix' ) },
];
import { memo } from '@wordpress/element';

import { getFallbackNumber } from '@Controls/getAttributeFallback';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const Settings = ( props ) => {
	// Setup the attributes
	const {
		attributes,
		setAttributes,
		attributes: {
			overallAlignment,
			showEstcost,
			showTotaltime,
			showMaterials,
			showTools,
			showTotaltimecolor,
			tools_count,
			material_count,
			tools,
			materials,
			mainimage,
			imgSize,
			headingColor,
			subHeadingColor,
			headingTag,
			headFontFamily,
			headFontWeight,
			headFontSizeType,
			headFontSize,
			headFontSizeMobile,
			headFontSizeTablet,
			headLineHeightType,
			headLineHeight,
			headLineHeightMobile,
			headLineHeightTablet,
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
			headLoadGoogleFonts,
			subHeadLoadGoogleFonts,
			//Total time.
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
			priceLoadGoogleFonts,
			timeSpace,
			costSpace,
			row_gap,
			rowGapTablet,
			rowGapMobile,
			step_gap,
			timeInHours,
			timeInDays,
			timeInMonths,
			timeInYears,
			timeInMins,
			time,
			priceFontStyle,
			priceTransform,
			priceDecoration,
			headFontStyle,
			headTransform,
			headDecoration,
			subHeadFontStyle,
			subHeadTransform,
			subHeadDecoration,
			// letter spacing
			headLetterSpacing,
			headLetterSpacingTablet,
			headLetterSpacingMobile,
			headLetterSpacingType,
			priceLetterSpacing,
			priceLetterSpacingTablet,
			priceLetterSpacingMobile,
			priceLetterSpacingType,
			subHeadLetterSpacing,
			subHeadLetterSpacingTablet,
			subHeadLetterSpacingMobile,
			subHeadLetterSpacingType,
		},
	} = props;

	/*
	 * Event to set Image as while adding.
	 */
	const onSelectImage = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { mainimage: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			setAttributes( { mainimage: null } );
			return;
		}

		setAttributes( { mainimage: media } );
	};

	/*
	 * Event to set Image as null while removing.
	 */
	const onRemoveImage = () => {
		setAttributes( { mainimage: '' } );
	};

	if ( mainimage && mainimage.sizes ) {
		imageSizeOptions = getImageSize( mainimage.sizes );
	}

	const minsValue = timeInMins ? timeInMins : time;

	const proUpgradePanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Dynamic Content', 'vexaltrix' ) }>
				<UpgradeComponent
					control={ {
						title: __(
							'Experience dynamic content with Vexaltrix Pro. No more static displays. Personalize your user experience.',
							'vexaltrix'
						),
						renderAs: 'list',
						campaign: 'dynamic-content',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const titleSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Title', 'vexaltrix' ) } initialOpen={ true }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Tag', 'vexaltrix' ) }
					data={ {
						value: headingTag,
						label: 'headingTag',
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
					] }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Text Alignment', 'vexaltrix' ) }
					data={ {
						value: overallAlignment,
						label: 'overallAlignment',
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
			</UAGAdvancedPanelBody>
		);
	};
	const imageSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Image', 'vexaltrix' ) } initialOpen={ false }>
				<UAGMediaPicker
					onSelectImage={ onSelectImage }
					backgroundImage={ mainimage }
					onRemoveImage={ onRemoveImage }
					disableLabel={ true }
				/>
				{ mainimage && mainimage.url !== 'null' && mainimage.url !== '' && (
					<UAGSelectControl
						label={ __( 'Image Size', 'vexaltrix' ) }
						data={ {
							value: imgSize,
							label: 'imgSize',
						} }
						setAttributes={ setAttributes }
						options={ imageSizeOptions }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const timeSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Time', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Show Total Time', 'vexaltrix' ) }
					checked={ showTotaltime }
					onChange={ () => setAttributes( { showTotaltime: ! showTotaltime } ) }
					help={ __( 'Note: Time is recommended field for schema. It should be ON', 'vexaltrix' ) }
				/>
				{ showTotaltime && (
					<>
						<Range
							label={ __( 'Years', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ timeInYears }
							data={ {
								value: timeInYears,
								label: 'timeInYears',
							} }
							min={ 1 }
							max={ 10 }
							displayUnit={ false }
						/>
						<Range
							label={ __( 'Months', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ timeInMonths }
							data={ {
								value: timeInMonths,
								label: 'timeInMonths',
							} }
							min={ 1 }
							max={ 12 }
							displayUnit={ false }
						/>
						<Range
							label={ __( 'Days', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ timeInDays }
							data={ {
								value: timeInDays,
								label: 'timeInDays',
							} }
							min={ 1 }
							max={ 31 }
							displayUnit={ false }
						/>
						<Range
							label={ __( 'Hours', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ timeInHours }
							data={ {
								value: timeInHours,
								label: 'timeInHours',
							} }
							min={ 1 }
							max={ 24 }
							displayUnit={ false }
						/>
						<Range
							label={ __( 'Minutes', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ minsValue }
							data={ {
								value: timeInMins,
								label: 'timeInMins',
							} }
							min={ 1 }
							max={ 60 }
							displayUnit={ false }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const costSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Cost', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Show Estimated Cost', 'vexaltrix' ) }
					checked={ showEstcost }
					onChange={ () => setAttributes( { showEstcost: ! showEstcost } ) }
					help={ __( 'Note: Cost is recommended field for schema.It should be ON', 'vexaltrix' ) }
				/>
				<ExternalLink href={ VXT_LINKS.CURRENCY_LIST }>
					{ __( 'Click here to find your countrys ISO code.', 'vexaltrix' ) }
				</ExternalLink>
			</UAGAdvancedPanelBody>
		);
	};
	const toolsSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Tools', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Show Tools', 'vexaltrix' ) }
					checked={ showTools }
					onChange={ () => setAttributes( { showTools: ! showTools } ) }
					help={ __( 'Note: This is recommended field for schema.It should be ON', 'vexaltrix' ) }
				/>
				{ showTools && (
					<Range
						label={ __( 'Number of Tools', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ tools_count }
						data={ {
							value: tools_count,
							label: 'tools_count',
						} }
						onChange={ ( newCount ) => {
							const cloneIcons = [ ...tools ];
							const newCountFallback = getFallbackNumber( newCount, 'tools_count', 'how-to' );

							if ( cloneIcons.length < newCountFallback ) {
								const incAmount = Math.abs( newCountFallback - cloneIcons.length );

								{
									for ( let i = 0; i < incAmount; i++ ) {
										cloneIcons.push( {
											add_required_tools: '- A Computer' + ( cloneIcons.length + 1 ),
										} );
									}
								}

								setAttributes( { tools: cloneIcons } );
							} else {
								const incAmount = Math.abs( newCountFallback - cloneIcons.length );
								const data_new = cloneIcons;
								for ( let i = 0; i < incAmount; i++ ) {
									data_new.pop();
								}
								setAttributes( { tools: data_new } );
							}
							setAttributes( { tools_count: newCountFallback } );
						} }
						min={ 1 }
						max={ 50 }
						displayUnit={ false }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const materialsSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Materials', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Show Materials', 'vexaltrix' ) }
					checked={ showMaterials }
					onChange={ () => setAttributes( { showMaterials: ! showMaterials } ) }
					help={ __( 'Note: This is recommended field for schema.It should be ON', 'vexaltrix' ) }
				/>
				{ showMaterials && (
					<Range
						label={ __( 'Number of Materials', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ material_count }
						data={ {
							value: material_count,
							label: 'material_count',
						} }
						onChange={ ( newCount ) => {
							const cloneIcons = [ ...materials ];
							const newCountFallback = getFallbackNumber( newCount, 'material_count', 'how-to' );

							if ( cloneIcons.length < newCountFallback ) {
								const incAmount = Math.abs( newCountFallback - cloneIcons.length );

								{
									for ( let i = 0; i < incAmount; i++ ) {
										cloneIcons.push( {
											add_required_materials: '- A WordPress Website' + ( cloneIcons.length + 1 ),
										} );
									}
								}

								setAttributes( { materials: cloneIcons } );
							} else {
								const incAmount = Math.abs( newCountFallback - cloneIcons.length );
								const data_new = cloneIcons;
								for ( let i = 0; i < incAmount; i++ ) {
									data_new.pop();
								}
								setAttributes( { materials: data_new } );
							}
							setAttributes( { material_count: newCountFallback } );
						} }
						min={ 1 }
						max={ 50 }
						displayUnit={ false }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const headingColorSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Heading', 'vexaltrix' ) } initialOpen={ true }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ headingColor ? headingColor : '' }
					data={ {
						value: headingColor,
						label: 'headingColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: headLoadGoogleFonts,
						label: 'headLoadGoogleFonts',
					} }
					fontFamily={ {
						value: headFontFamily,
						label: 'headFontFamily',
					} }
					fontWeight={ {
						value: headFontWeight,
						label: 'headFontWeight',
					} }
					fontStyle={ {
						value: headFontStyle,
						label: 'headFontStyle',
					} }
					transform={ {
						value: headTransform,
						label: 'headTransform',
					} }
					decoration={ {
						value: headDecoration,
						label: 'headDecoration',
					} }
					fontSizeType={ {
						value: headFontSizeType,
						label: 'headFontSizeType',
					} }
					fontSize={ { value: headFontSize, label: 'headFontSize' } }
					fontSizeMobile={ {
						value: headFontSizeMobile,
						label: 'headFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: headFontSizeTablet,
						label: 'headFontSizeTablet',
					} }
					lineHeightType={ {
						value: headLineHeightType,
						label: 'headLineHeightType',
					} }
					lineHeight={ {
						value: headLineHeight,
						label: 'headLineHeight',
					} }
					lineHeightMobile={ {
						value: headLineHeightMobile,
						label: 'headLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: headLineHeightTablet,
						label: 'headLineHeightTablet',
					} }
					letterSpacing={ {
						value: headLetterSpacing,
						label: 'headLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: headLetterSpacingTablet,
						label: 'headLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: headLetterSpacingMobile,
						label: 'headLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: headLetterSpacingType,
						label: 'headLetterSpacingType',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const secheadingColorSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Secondary Heading', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ showTotaltimecolor ? showTotaltimecolor : '' }
					data={ {
						value: showTotaltimecolor,
						label: 'showTotaltimecolor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: priceLoadGoogleFonts,
						label: 'priceLoadGoogleFonts',
					} }
					fontFamily={ {
						value: priceFontFamily,
						label: 'priceFontFamily',
					} }
					fontWeight={ {
						value: priceFontWeight,
						label: 'priceFontWeight',
					} }
					fontStyle={ {
						value: priceFontStyle,
						label: 'priceFontStyle',
					} }
					transform={ {
						value: priceTransform,
						label: 'priceTransform',
					} }
					decoration={ {
						value: priceDecoration,
						label: 'priceDecoration',
					} }
					fontSizeType={ {
						value: priceFontSizeType,
						label: 'priceFontSizeType',
					} }
					fontSize={ {
						value: priceFontSize,
						label: 'priceFontSize',
					} }
					fontSizeMobile={ {
						value: priceFontSizeMobile,
						label: 'priceFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: priceFontSizeTablet,
						label: 'priceFontSizeTablet',
					} }
					lineHeightType={ {
						value: priceLineHeightType,
						label: 'priceLineHeightType',
					} }
					lineHeight={ {
						value: priceLineHeight,
						label: 'priceLineHeight',
					} }
					lineHeightMobile={ {
						value: priceLineHeightMobile,
						label: 'priceLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: priceLineHeightTablet,
						label: 'priceLineHeightTablet',
					} }
					letterSpacing={ {
						value: priceLetterSpacing,
						label: 'priceLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: priceLetterSpacingTablet,
						label: 'priceLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: priceLetterSpacingMobile,
						label: 'priceLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: priceLetterSpacingType,
						label: 'priceLetterSpacingType',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const descriptionColorSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Description', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ subHeadingColor ? subHeadingColor : '' }
					data={ {
						value: subHeadingColor,
						label: 'subHeadingColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: subHeadLoadGoogleFonts,
						label: 'subHeadLoadGoogleFonts',
					} }
					fontFamily={ {
						value: subHeadFontFamily,
						label: 'subHeadFontFamily',
					} }
					fontWeight={ {
						value: subHeadFontWeight,
						label: 'subHeadFontWeight',
					} }
					fontStyle={ {
						value: subHeadFontStyle,
						label: 'subHeadFontStyle',
					} }
					transform={ {
						value: subHeadTransform,
						label: 'subHeadTransform',
					} }
					decoration={ {
						value: subHeadDecoration,
						label: 'subHeadDecoration',
					} }
					fontSizeType={ {
						value: subHeadFontSizeType,
						label: 'subHeadFontSizeType',
					} }
					fontSize={ {
						value: subHeadFontSize,
						label: 'subHeadFontSize',
					} }
					fontSizeMobile={ {
						value: subHeadFontSizeMobile,
						label: 'subHeadFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: subHeadFontSizeTablet,
						label: 'subHeadFontSizeTablet',
					} }
					lineHeightType={ {
						value: subHeadLineHeightType,
						label: 'subHeadLineHeightType',
					} }
					lineHeight={ {
						value: subHeadLineHeight,
						label: 'subHeadLineHeight',
					} }
					lineHeightMobile={ {
						value: subHeadLineHeightMobile,
						label: 'subHeadLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: subHeadLineHeightTablet,
						label: 'subHeadLineHeightTablet',
					} }
					letterSpacing={ {
						value: subHeadLetterSpacing,
						label: 'subHeadLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: subHeadLetterSpacingTablet,
						label: 'subHeadLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: subHeadLetterSpacingMobile,
						label: 'subHeadLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: subHeadLetterSpacingType,
						label: 'subHeadLetterSpacingType',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const spacingSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
				{ showTotaltime && (
					<Range
						label={ __( 'Time Margin', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ timeSpace }
						data={ {
							value: timeSpace,
							label: 'timeSpace',
						} }
						min={ 0 }
						max={ 50 }
						displayUnit={ false }
					/>
				) }
				{ showEstcost && (
					<Range
						label={ __( 'Cost Margin', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ costSpace }
						data={ {
							value: costSpace,
							label: 'costSpace',
						} }
						min={ 0 }
						max={ 50 }
						displayUnit={ false }
					/>
				) }
				<ResponsiveSlider
					label={ __( 'Row Gap', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: row_gap,
							label: 'row_gap',
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
					max={ 200 }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
				<Range
					label={ __( 'Gap Between Steps', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ step_gap }
					data={ {
						value: step_gap,
						label: 'step_gap',
					} }
					min={ 0 }
					max={ 200 }
					displayUnit={ false }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	return (
		<>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ titleSettings() }
						{ imageSettings() }
						{ timeSettings() }
						{ costSettings() }
						{ toolsSettings() }
						{ materialsSettings() }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
							proUpgradePanel() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ headingColorSettings() }
						{ secheadingColorSettings() }
						{ descriptionColorSettings() }
						{ spacingSettings() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};

export default memo( Settings );
