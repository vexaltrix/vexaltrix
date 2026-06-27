import { __ } from '@wordpress/i18n';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import UAGMediaPicker from '@Components/image';
import { InspectorControls } from '@wordpress/block-editor';
import TypographyControl from '@Components/typography';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import UAGSelectControl from '@Components/select-control';
import { getImageSize } from '@Utils/Helpers';
import { ToggleControl } from '@wordpress/components';
let imageSizeOptions = [
	{
		value: 'thumbnail',
		label: __( 'Thumbnail', 'vexaltrix' ),
	},
	{ value: 'medium', label: __( 'Medium', 'vexaltrix' ) },
	{ value: 'full', label: __( 'Large', 'vexaltrix' ) },
];
import { memo } from '@wordpress/element';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UAGTextControl from '@Components/text-control';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const Settings = ( props ) => {
	const { attributes, setAttributes } = props;

	const {
		url,
		urlType,
		image,
		imageSize,
		urlText,
		urlFontSize,
		urlFontSizeType,
		urlFontSizeMobile,
		urlFontSizeTablet,
		urlFontFamily,
		urlFontWeight,
		urlLoadGoogleFonts,

		titleFontSize,
		titleFontSizeType,
		titleFontSizeMobile,
		titleFontSizeTablet,
		titleFontFamily,
		titleFontWeight,
		titleLoadGoogleFonts,

		descriptionFontSize,
		descriptionFontSizeType,
		descriptionFontSizeMobile,
		descriptionFontSizeTablet,
		descriptionFontFamily,
		descriptionFontWeight,
		descriptionLoadGoogleFonts,

		urlTarget,
		imgPosition,
		titleColor,
		descriptionColor,
		urlColor,

		urlFontStyle,
		urlTransform,
		urlDecoration,
		titleFontStyle,
		titleTransform,
		titleDecoration,
		descriptionFontStyle,
		descriptionTransform,
		descriptionDecoration,
		titleLetterSpacing,
		titleLetterSpacingTablet,
		titleLetterSpacingMobile,
		titleLetterSpacingType,
		descriptionLetterSpacing,
		descriptionLetterSpacingTablet,
		descriptionLetterSpacingMobile,
		descriptionLetterSpacingType,
		titleLineHeight,
		titleLineHeightTablet,
		titleLineHeightMobile,
		titleLineHeightType,
		descriptionLineHeight,
		descriptionLineHeightType,
		descriptionLineHeightTablet,
		descriptionLineHeightMobile,
		urlLineHeight,
		urlLineHeightTablet,
		urlLineHeightMobile,
		urlLineHeightType,
		urlLetterSpacing,
		urlLetterSpacingTablet,
		urlLetterSpacingMobile,
		urlLetterSpacingType,
	} = attributes;
	/*
	 * Event to set Image as while adding.
	 */
	const onSelectImage = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { image: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			setAttributes( { image: null } );
			return;
		}
		if ( media.sizes ) {
			imageSizeOptions = getImageSize( media.sizes );
		}
		setAttributes( { image: media } );
	};

	/*
	 * Event to set Image as null while removing.
	 */
	const onRemoveImage = () => {
		setAttributes( { image: '' } );
	};

	imageSizeOptions.map( ( item ) => {
		item.label = item.label.replace( /\w/, ( firstLetter ) => firstLetter.toUpperCase() );
		return item;
	} );

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

	const imageControls = () => {
		return (
			<UAGAdvancedPanelBody initialOpen={ true } title={ __( 'Image', 'vexaltrix' ) }>
				<UAGMediaPicker
					onSelectImage={ onSelectImage }
					backgroundImage={ image }
					onRemoveImage={ onRemoveImage }
					disableLabel={ true }
				/>
				{ image && image.url !== 'null' && image.url !== '' && (
					<>
						<UAGSelectControl
							label={ __( 'Image Size', 'vexaltrix' ) }
							data={ {
								value: imageSize,
								label: 'imageSize',
							} }
							setAttributes={ setAttributes }
							options={ imageSizeOptions }
						/>
						<UAGSelectControl
							label={ __( 'Select Position', 'vexaltrix' ) }
							data={ {
								value: imgPosition,
								label: 'imgPosition',
							} }
							setAttributes={ setAttributes }
							options={ [
								{ value: 'above-title', label: __( 'Above Title', 'vexaltrix' ) },
								{ value: 'left-title', label: __( 'Left of Title', 'vexaltrix' ) },
								{
									value: 'right-title',
									label: __( 'Right of Title', 'vexaltrix' ),
								},
							] }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const urlControls = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Add Link', 'vexaltrix' ) } initialOpen={ false }>
				<UAGSelectControl
					label={ __( 'Type', 'vexaltrix' ) }
					data={ {
						value: urlType,
						label: 'urlType',
					} }
					setAttributes={ setAttributes }
					options={ [
						{ value: 'text', label: __( 'Text', 'vexaltrix' ) },
						{ value: 'all', label: __( 'Complete Box', 'vexaltrix' ) },
						{ value: 'none', label: __( 'None', 'vexaltrix' ) },
					] }
				/>
				{ urlType === 'text' && (
					<>
						<UAGTextControl
							label={ __( 'Text', 'vexaltrix' ) }
							value={ urlText }
							data={ {
								value: urlText,
								label: 'urlText',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) => setAttributes( { urlText: value } ) }
						/>
					</>
				) }
				{ urlType !== 'none' && (
					<>
						<UAGTextControl
							label={ __( 'Link', 'vexaltrix' ) }
							value={ url }
							data={ {
								value: url,
								label: 'url',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) => setAttributes( { url: value } ) }
						/>
						<ToggleControl
							label={ __( 'Open in new window', 'vexaltrix' ) }
							checked={ urlTarget }
							onChange={ () => setAttributes( { urlTarget: ! urlTarget } ) }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const linkStyle = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Link', 'vexaltrix' ) } initialOpen={ true }>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: urlLoadGoogleFonts,
						label: 'urlLoadGoogleFonts',
					} }
					fontFamily={ {
						value: urlFontFamily,
						label: 'urlFontFamily',
					} }
					fontWeight={ {
						value: urlFontWeight,
						label: 'urlFontWeight',
					} }
					fontStyle={ {
						value: urlFontStyle,
						label: 'urlFontStyle',
					} }
					transform={ {
						value: urlTransform,
						label: 'urlTransform',
					} }
					decoration={ {
						value: urlDecoration,
						label: 'urlDecoration',
					} }
					fontSizeType={ {
						value: urlFontSizeType,
						label: 'urlFontSizeType',
					} }
					fontSize={ {
						value: urlFontSize,
						label: 'urlFontSize',
					} }
					fontSizeMobile={ {
						value: urlFontSizeMobile,
						label: 'urlFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: urlFontSizeTablet,
						label: 'urlFontSizeTablet',
					} }
					lineHeightType={ {
						value: urlLineHeightType,
						label: 'urlLineHeightType',
					} }
					lineHeight={ {
						value: urlLineHeight,
						label: 'urlLineHeight',
					} }
					lineHeightMobile={ {
						value: urlLineHeightMobile,
						label: 'urlLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: urlLineHeightTablet,
						label: 'urlLineHeightTablet',
					} }
					letterSpacing={ {
						value: urlLetterSpacing,
						label: 'urlLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: urlLetterSpacingTablet,
						label: 'urlLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: urlLetterSpacingMobile,
						label: 'urlLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: urlLetterSpacingType,
						label: 'urlLetterSpacingType',
					} }
				/>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ urlColor ? urlColor : '' }
					data={ {
						value: urlColor,
						label: 'urlColor',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const titleStyle = () => {
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
					transform={ {
						value: titleTransform,
						label: 'titleTransform',
					} }
					decoration={ {
						value: titleDecoration,
						label: 'titleDecoration',
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
			</UAGAdvancedPanelBody>
		);
	};

	const descriptionStyle = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Description', 'vexaltrix' ) } initialOpen={ false }>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: descriptionLoadGoogleFonts,
						label: 'descriptionLoadGoogleFonts',
					} }
					fontFamily={ {
						value: descriptionFontFamily,
						label: 'descriptionFontFamily',
					} }
					fontWeight={ {
						value: descriptionFontWeight,
						label: 'descriptionFontWeight',
					} }
					fontStyle={ {
						value: descriptionFontStyle,
						label: 'descriptionFontStyle',
					} }
					transform={ {
						value: descriptionTransform,
						label: 'descriptionTransform',
					} }
					decoration={ {
						value: descriptionDecoration,
						label: 'descriptionDecoration',
					} }
					fontSizeType={ {
						value: descriptionFontSizeType,
						label: 'descriptionFontSizeType',
					} }
					fontSize={ {
						value: descriptionFontSize,
						label: 'descriptionFontSize',
					} }
					fontSizeMobile={ {
						value: descriptionFontSizeMobile,
						label: 'descriptionFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: descriptionFontSizeTablet,
						label: 'descriptionFontSizeTablet',
					} }
					lineHeightType={ {
						value: descriptionLineHeightType,
						label: 'descriptionLineHeightType',
					} }
					lineHeight={ {
						value: descriptionLineHeight,
						label: 'descriptionLineHeight',
					} }
					lineHeightMobile={ {
						value: descriptionLineHeightMobile,
						label: 'descriptionLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: descriptionLineHeightTablet,
						label: 'descriptionLineHeightTablet',
					} }
					letterSpacing={ {
						value: descriptionLetterSpacing,
						label: 'descriptionLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: descriptionLetterSpacingTablet,
						label: 'descriptionLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: descriptionLetterSpacingMobile,
						label: 'descriptionLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: descriptionLetterSpacingType,
						label: 'descriptionLetterSpacingType',
					} }
				/>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ descriptionColor ? descriptionColor : '' }
					data={ {
						value: descriptionColor,
						label: 'descriptionColor',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	return (
		<>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ imageControls() }
						{ urlControls() }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
							proUpgradePanel() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ titleStyle() }
						{ descriptionStyle() }
						{ urlType === 'text' && linkStyle() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};
export default memo( Settings );
