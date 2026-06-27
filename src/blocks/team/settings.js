import { __ } from '@wordpress/i18n';
import UAGIconPicker from '@Components/icon-picker';
import renderSVG from '@Controls/renderIcon';

import TypographyControl from '@Components/typography';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import ResponsiveSlider from '@Components/responsive-slider';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import SpacingControl from '@Components/spacing-control';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGMediaPicker from '@Components/image';
import UAGTabsControl from '@Components/tabs';
import UAGSelectControl from '@Components/select-control';
import { getImageSize } from '@Utils/Helpers';
import presets from './presets';
import UAGPresets from '@Components/presets';
let imageSizeOptions = [
	{
		value: 'thumbnail',
		label: __( 'Thumbnail', 'vexaltrix' ),
	},
	{ value: 'medium', label: __( 'Medium', 'vexaltrix' ) },
	{ value: 'full', label: __( 'Large', 'vexaltrix' ) },
];

import { InspectorControls } from '@wordpress/block-editor';

import { ToggleControl, Icon } from '@wordpress/components';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UAGTextControl from '@Components/text-control';
import { memo } from '@wordpress/element';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const Settings = ( props ) => {
	const { setAttributes, attributes, deviceType } = props;

	const {
		align,
		tag,
		titleColor,
		prefixColor,
		descColor,
		titleFontFamily,
		titleFontWeight,
		titleFontSizeType,
		titleFontSize,
		titleFontSizeMobile,
		titleFontSizeTablet,
		titleLineHeightType,
		titleLineHeight,
		titleLineHeightMobile,
		titleLineHeightTablet,
		prefixFontFamily,
		prefixFontWeight,
		prefixFontSizeType,
		prefixFontSize,
		prefixFontSizeMobile,
		prefixFontSizeTablet,
		prefixLineHeightType,
		prefixLineHeight,
		prefixLineHeightMobile,
		prefixLineHeightTablet,
		descFontFamily,
		descFontWeight,
		descFontSizeType,
		descFontSize,
		descFontSizeMobile,
		descFontSizeTablet,
		descLineHeightType,
		descLineHeight,
		descLineHeightMobile,
		descLineHeightTablet,
		socialFontSize,
		socialFontSizeType,
		socialFontSizeMobile,
		socialFontSizeTablet,
		titleLoadGoogleFonts,
		prefixLoadGoogleFonts,
		descLoadGoogleFonts,
		image,
		imgStyle,
		imgAlign,
		imgSize,
		imgWidth,
		imgWidthTablet,
		imgWidthMobile,
		imgPosition,
		titleSpace,
		titleSpaceTablet,
		titleSpaceMobile,
		descSpace,
		descSpaceTablet,
		descSpaceMobile,
		prefixSpace,
		prefixSpaceTablet,
		prefixSpaceMobile,
		twitterIcon,
		fbIcon,
		linkedinIcon,
		pinIcon,
		twitterLink,
		fbLink,
		linkedinLink,
		pinLink,
		socialColor,
		socialHoverColor,
		socialSpace,
		socialSpaceTablet,
		socialSpaceMobile,
		socialTarget,
		socialEnable,
		stack,
		imageLeftMargin,
		imageRightMargin,
		imageTopMargin,
		imageBottomMargin,
		imageMarginTopTablet,
		imageMarginRightTablet,
		imageMarginBottomTablet,
		imageMarginLeftTablet,
		imageMarginTopMobile,
		imageMarginRightMobile,
		imageMarginBottomMobile,
		imageMarginLeftMobile,
		imageMarginUnit,
		tabletImageMarginUnit,
		mobileImageMarginUnit,
		spacingLink,
		titleTransform,
		titleDecoration,
		descTransform,
		descDecoration,
		prefixTransform,
		prefixDecoration,
		titleFontStyle,
		descFontStyle,
		prefixFontStyle,
		// lettter spacing
		titleLetterSpacing,
		titleLetterSpacingTablet,
		titleLetterSpacingMobile,
		titleLetterSpacingType,
		prefixLetterSpacing,
		prefixLetterSpacingTablet,
		prefixLetterSpacingMobile,
		prefixLetterSpacingType,
		descLetterSpacing,
		descLetterSpacingTablet,
		descLetterSpacingMobile,
		descLetterSpacingType,
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
			const new_img = getImageSize( media.sizes );
			imageSizeOptions = new_img;
		}
		setAttributes( { image: media } );
	};
	const presetSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Presets', 'vexaltrix' ) } initialOpen={ false }>
				<UAGPresets setAttributes={ setAttributes } presets={ presets } presetInputType="radioImage" />
			</UAGAdvancedPanelBody>
		);
	};
	/*
	 * Event to set Image as null while removing.
	 */
	const onRemoveImage = () => {
		setAttributes( { image: '' } );
	};

	if ( image && image.sizes ) {
		imageSizeOptions = getImageSize( image.sizes );
	}

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
	const getImagePanelBody = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) } initialOpen={ true }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Title Tag', 'vexaltrix' ) }
					data={ {
						value: tag,
						label: 'tag',
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
							value: 'div',
							label: __( 'Div', 'vexaltrix' ),
						},
					] }
				/>
				{ imgPosition === 'above' && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Alignment', 'vexaltrix' ) }
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
				) }
				<UAGMediaPicker
					onSelectImage={ onSelectImage }
					backgroundImage={ image }
					onRemoveImage={ onRemoveImage }
				/>
				{ image && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Image Position', 'vexaltrix' ) }
						data={ {
							value: imgPosition,
							label: 'imgPosition',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'left',
								icon: <Icon icon={ renderSVG( 'fa fa-align-left' ) } />,
								tooltip: __( 'Left', 'vexaltrix' ),
							},
							{
								value: 'above',
								icon: <Icon icon={ renderSVG( 'fa fa-align-center' ) } />,
								tooltip: __( 'Top', 'vexaltrix' ),
							},
							{
								value: 'right',
								icon: <Icon icon={ renderSVG( 'fa fa-align-right' ) } />,
								tooltip: __( 'Right', 'vexaltrix' ),
							},
						] }
						showIcons={ true }
					/>
				) }
				{ imgPosition !== 'above' && image && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Stack On', 'vexaltrix' ) }
						data={ {
							value: stack,
							label: 'stack',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'none',
								label: __( 'None', 'vexaltrix' ),
							},
							{
								value: 'tablet',
								label: __( 'Tablet', 'vexaltrix' ),
							},
							{
								value: 'mobile',
								label: __( 'Mobile', 'vexaltrix' ),
							},
						] }
					/>
				) }
				{ image && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Image Style', 'vexaltrix' ) }
						data={ {
							value: imgStyle,
							label: 'imgStyle',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'normal',
								label: __( 'Normal', 'vexaltrix' ),
							},
							{
								value: 'circle',
								label: __( 'Circle', 'vexaltrix' ),
							},
							{
								value: 'square',
								label: __( 'Square', 'vexaltrix' ),
							},
						] }
					/>
				) }

				{ imgPosition && imgPosition !== 'above' && image && (
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Vertical Alignment', 'vexaltrix' ) }
						data={ {
							value: imgAlign,
							label: 'imgAlign',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'top',
								label: __( 'Top', 'vexaltrix' ),
							},
							{
								value: 'middle',
								label: __( 'Middle', 'vexaltrix' ),
							},
						] }
					/>
				) }
				{ image && (
					<>
						<UAGSelectControl
							label={ __( 'Size', 'vexaltrix' ) }
							data={ {
								value: imgSize,
								label: 'imgSize',
							} }
							setAttributes={ setAttributes }
							options={ imageSizeOptions }
						/>
						<ResponsiveSlider
							label={ __( 'Width', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: imgWidth,
									label: 'imgWidth',
								},
								tablet: {
									value: imgWidthTablet,
									label: 'imgWidthTablet',
								},
								mobile: {
									value: imgWidthMobile,
									label: 'imgWidthMobile',
								},
							} }
							min={ 0 }
							max={ 500 }
							displayUnit={ false }
							setAttributes={ setAttributes }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const getSocialLinksPanelBody = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Social Links', 'vexaltrix' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Enable Social Links', 'vexaltrix' ) }
					checked={ socialEnable }
					onChange={ () => setAttributes( { socialEnable: ! socialEnable } ) }
				/>
				{ socialEnable && (
					<>
						<ToggleControl
							label={ __( 'Open Links in New Window', 'vexaltrix' ) }
							checked={ socialTarget }
							onChange={ () =>
								setAttributes( {
									socialTarget: ! socialTarget,
								} )
							}
						/>
						<p className="components-base-control__label">{ __( 'Item 1', 'vexaltrix' ) }</p>
						<UAGIconPicker
							label={ __( 'Icon', 'vexaltrix' ) }
							value={ twitterIcon }
							onChange={ ( value ) => setAttributes( { twitterIcon: value } ) }
						/>
						{ twitterIcon && (
							<>
								<UAGTextControl
									label={ __( 'URL', 'vexaltrix' ) }
									value={ twitterLink }
									data={ {
										value: twitterLink,
										label: 'twitterLink',
									} }
									setAttributes={ setAttributes }
									onChange={ ( value ) => setAttributes( { twitterLink: value } ) }
									placeholder={ __( 'Enter Item 1 URL', 'vexaltrix' ) }
								/>
							</>
						) }
						<p className="components-base-control__label">{ __( 'Item 2', 'vexaltrix' ) }</p>
						<UAGIconPicker
							label={ __( 'Icon', 'vexaltrix' ) }
							value={ fbIcon }
							onChange={ ( value ) => setAttributes( { fbIcon: value } ) }
						/>
						{ fbIcon && (
							<>
								<UAGTextControl
									label={ __( 'URL', 'vexaltrix' ) }
									value={ fbLink }
									data={ {
										value: fbLink,
										label: 'fbLink',
									} }
									setAttributes={ setAttributes }
									onChange={ ( value ) => setAttributes( { fbLink: value } ) }
									placeholder={ __( 'Enter Item 2 URL', 'vexaltrix' ) }
								/>
							</>
						) }
						<p className="components-base-control__label">{ __( 'Item 3', 'vexaltrix' ) }</p>
						<UAGIconPicker
							label={ __( 'Icon', 'vexaltrix' ) }
							value={ linkedinIcon }
							onChange={ ( value ) => setAttributes( { linkedinIcon: value } ) }
						/>
						{ linkedinIcon && (
							<>
								<UAGTextControl
									label={ __( 'URL', 'vexaltrix' ) }
									value={ linkedinLink }
									data={ {
										value: linkedinLink,
										label: 'linkedinLink',
									} }
									setAttributes={ setAttributes }
									onChange={ ( value ) => setAttributes( { linkedinLink: value } ) }
									placeholder={ __( 'Enter Item 3 URL', 'vexaltrix' ) }
								/>
							</>
						) }
						<p className="components-base-control__label">{ __( 'Item 4', 'vexaltrix' ) }</p>
						<UAGIconPicker
							label={ __( 'Icon', 'vexaltrix' ) }
							value={ pinIcon }
							onChange={ ( value ) => setAttributes( { pinIcon: value } ) }
						/>
						{ pinIcon && (
							<>
								<UAGTextControl
									label={ __( 'URL', 'vexaltrix' ) }
									value={ pinLink }
									data={ {
										value: pinLink,
										label: 'pinLink',
									} }
									setAttributes={ setAttributes }
									onChange={ ( value ) => setAttributes( { pinLink: value } ) }
									placeholder={ __( 'Enter Item 4 URL', 'vexaltrix' ) }
								/>
							</>
						) }
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const getTitlePanelColorSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Title', 'vexaltrix' ) } initialOpen={ true }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ titleColor ? titleColor : '' }
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

				<ResponsiveSlider
					label={ __( 'Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: titleSpace,
							label: 'titleSpace',
						},
						tablet: {
							value: titleSpaceTablet,
							label: 'titleSpaceTablet',
						},
						mobile: {
							value: titleSpaceMobile,
							label: 'titleSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const getPrefixPanelColorSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Designation', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ prefixColor ? prefixColor : '' }
					data={ {
						value: prefixColor,
						label: 'prefixColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: prefixLoadGoogleFonts,
						label: 'prefixLoadGoogleFonts',
					} }
					fontFamily={ {
						value: prefixFontFamily,
						label: 'prefixFontFamily',
					} }
					fontWeight={ {
						value: prefixFontWeight,
						label: 'prefixFontWeight',
					} }
					fontStyle={ {
						value: prefixFontStyle,
						label: 'prefixFontStyle',
					} }
					transform={ {
						value: prefixTransform,
						label: 'prefixTransform',
					} }
					decoration={ {
						value: prefixDecoration,
						label: 'prefixDecoration',
					} }
					fontSizeType={ {
						value: prefixFontSizeType,
						label: 'prefixFontSizeType',
					} }
					fontSize={ {
						value: prefixFontSize,
						label: 'prefixFontSize',
					} }
					fontSizeMobile={ {
						value: prefixFontSizeMobile,
						label: 'prefixFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: prefixFontSizeTablet,
						label: 'prefixFontSizeTablet',
					} }
					lineHeightType={ {
						value: prefixLineHeightType,
						label: 'prefixLineHeightType',
					} }
					lineHeight={ {
						value: prefixLineHeight,
						label: 'prefixLineHeight',
					} }
					lineHeightMobile={ {
						value: prefixLineHeightMobile,
						label: 'prefixLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: prefixLineHeightTablet,
						label: 'prefixLineHeightTablet',
					} }
					letterSpacing={ {
						value: prefixLetterSpacing,
						label: 'prefixLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: prefixLetterSpacingTablet,
						label: 'prefixLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: prefixLetterSpacingMobile,
						label: 'prefixLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: prefixLetterSpacingType,
						label: 'prefixLetterSpacingType',
					} }
				/>
				<ResponsiveSlider
					label={ __( 'Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: prefixSpace,
							label: 'prefixSpace',
						},
						tablet: {
							value: prefixSpaceTablet,
							label: 'prefixSpaceTablet',
						},
						mobile: {
							value: prefixSpaceMobile,
							label: 'prefixSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const getDescriptionPanelColorSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Description', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ descColor ? descColor : '' }
					data={ {
						value: descColor,
						label: 'descColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: descLoadGoogleFonts,
						label: 'descLoadGoogleFonts',
					} }
					fontFamily={ {
						value: descFontFamily,
						label: 'descFontFamily',
					} }
					fontWeight={ {
						value: descFontWeight,
						label: 'descFontWeight',
					} }
					fontStyle={ {
						value: descFontStyle,
						label: 'descFontStyle',
					} }
					transform={ {
						value: descTransform,
						label: 'descTransform',
					} }
					decoration={ {
						value: descDecoration,
						label: 'descDecoration',
					} }
					fontSizeType={ {
						value: descFontSizeType,
						label: 'descFontSizeType',
					} }
					fontSize={ {
						value: descFontSize,
						label: 'descFontSize',
					} }
					fontSizeMobile={ {
						value: descFontSizeMobile,
						label: 'descFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: descFontSizeTablet,
						label: 'descFontSizeTablet',
					} }
					lineHeightType={ {
						value: descLineHeightType,
						label: 'descLineHeightType',
					} }
					lineHeight={ {
						value: descLineHeight,
						label: 'descLineHeight',
					} }
					lineHeightMobile={ {
						value: descLineHeightMobile,
						label: 'descLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: descLineHeightTablet,
						label: 'descLineHeightTablet',
					} }
					letterSpacing={ {
						value: descLetterSpacing,
						label: 'descLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: descLetterSpacingTablet,
						label: 'descLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: descLetterSpacingMobile,
						label: 'descLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: descLetterSpacingType,
						label: 'descLetterSpacingType',
					} }
				/>
				<ResponsiveSlider
					label={ __( 'Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: descSpace,
							label: 'descSpace',
						},
						tablet: {
							value: descSpaceTablet,
							label: 'descSpaceTablet',
						},
						mobile: {
							value: descSpaceMobile,
							label: 'descSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const getSocialIconPanelColorSettings = () => {
		return (
			<>
				{ socialEnable && (
					<UAGAdvancedPanelBody title={ __( 'Social Icons', 'vexaltrix' ) } initialOpen={ false }>
						<ResponsiveSlider
							label={ __( 'Icon Size', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: socialFontSize,
									label: 'socialFontSize',
								},
								tablet: {
									value: socialFontSizeTablet,
									label: 'socialFontSizeTablet',
								},
								mobile: {
									value: socialFontSizeMobile,
									label: 'socialFontSizeMobile',
								},
							} }
							units={ [
								{
									name: __( 'Pixel', 'vexaltrix' ),
									unitValue: 'px',
								},
								{
									name: __( 'EM', 'vexaltrix' ),
									unitValue: 'em',
								},
							] }
							unit={ {
								value: socialFontSizeType,
								label: 'socialFontSizeType',
							} }
							min={ 0 }
							limitMax={ { px: 100, em: 100 } }
							displayUnit={ true }
							setAttributes={ setAttributes }
						/>
						<ResponsiveSlider
							label={ __( 'Icon Spacing', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: socialSpace,
									label: 'socialSpace',
								},
								tablet: {
									value: socialSpaceTablet,
									label: 'socialSpaceTablet',
								},
								mobile: {
									value: socialSpaceMobile,
									label: 'socialSpaceMobile',
								},
							} }
							min={ 0 }
							max={ 50 }
							displayUnit={ false }
							setAttributes={ setAttributes }
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
								<AdvancedPopColorControl
									label={ __( 'Color', 'vexaltrix' ) }
									colorValue={ socialColor ? socialColor : '' }
									data={ {
										value: socialColor,
										label: 'socialColor',
									} }
									setAttributes={ setAttributes }
								/>
							}
							hover={
								<AdvancedPopColorControl
									label={ __( 'Color', 'vexaltrix' ) }
									colorValue={ socialHoverColor ? socialHoverColor : '' }
									data={ {
										value: socialHoverColor,
										label: 'socialHoverColor',
									} }
									setAttributes={ setAttributes }
								/>
							}
							disableBottomSeparator={ true }
						/>
					</UAGAdvancedPanelBody>
				) }
			</>
		);
	};

	const getSpacingPanelBody = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
				<SpacingControl
					{ ...props }
					label={ __( 'Image Margin', 'vexaltrix' ) }
					valueTop={ {
						value: imageTopMargin,
						label: 'imageTopMargin',
					} }
					valueRight={ {
						value: imageRightMargin,
						label: 'imageRightMargin',
					} }
					valueBottom={ {
						value: imageBottomMargin,
						label: 'imageBottomMargin',
					} }
					valueLeft={ {
						value: imageLeftMargin,
						label: 'imageLeftMargin',
					} }
					valueTopTablet={ {
						value: imageMarginTopTablet,
						label: 'imageMarginTopTablet',
					} }
					valueRightTablet={ {
						value: imageMarginRightTablet,
						label: 'imageMarginRightTablet',
					} }
					valueBottomTablet={ {
						value: imageMarginBottomTablet,
						label: 'imageMarginBottomTablet',
					} }
					valueLeftTablet={ {
						value: imageMarginLeftTablet,
						label: 'imageMarginLeftTablet',
					} }
					valueTopMobile={ {
						value: imageMarginTopMobile,
						label: 'imageMarginTopMobile',
					} }
					valueRightMobile={ {
						value: imageMarginRightMobile,
						label: 'imageMarginRightMobile',
					} }
					valueBottomMobile={ {
						value: imageMarginBottomMobile,
						label: 'imageMarginBottomMobile',
					} }
					valueLeftMobile={ {
						value: imageMarginLeftMobile,
						label: 'imageMarginLeftMobile',
					} }
					unit={ {
						value: imageMarginUnit,
						label: 'imageMarginUnit',
					} }
					mUnit={ {
						value: mobileImageMarginUnit,
						label: 'mobileImageMarginUnit',
					} }
					tUnit={ {
						value: tabletImageMarginUnit,
						label: 'tabletImageMarginUnit',
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

	const getInspectorControls = () => {
		return (
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ getImagePanelBody() }
						{ getSocialLinksPanelBody() }
						{ presetSettings() }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
							proUpgradePanel() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ getTitlePanelColorSettings() }
						{ getPrefixPanelColorSettings() }
						{ getDescriptionPanelColorSettings() }
						{ getSocialIconPanelColorSettings() }
						{ image && getSpacingPanelBody() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		);
	};

	return <>{ getInspectorControls() }</>;
};

export default memo( Settings );
