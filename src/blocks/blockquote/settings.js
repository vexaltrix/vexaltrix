import { memo } from '@wordpress/element';
import TypographyControl from '@Components/typography';
import { __ } from '@wordpress/i18n';
import Range from '@Components/range/Range.js';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import ResponsiveSlider from '@Components/responsive-slider';
import SpacingControl from '@Components/spacing-control';
import UAGTabsControl from '@Components/tabs';
import UAGMediaPicker from '@Components/image';
import MultiButtonsControl from '@Components/multi-buttons-control';
import renderSVG from '@Controls/renderIcon';
import UAGSelectControl from '@Components/select-control';
import { ToggleControl, Icon } from '@wordpress/components';
import { BlockControls, InspectorControls } from '@wordpress/block-editor';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UAGTextControl from '@Components/text-control';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const Settings = ( props ) => {
	const { setAttributes, attributes, deviceType } = props;

	const {
		skinStyle,
		align,
		authorColor,
		descColor,
		descFontSize,
		descFontSizeType,
		descFontSizeTablet,
		descFontSizeMobile,
		descFontFamily,
		descFontWeight,
		descFontStyle,
		descLineHeightType,
		descLineHeight,
		descLineHeightTablet,
		descLineHeightMobile,
		descLoadGoogleFonts,
		authorFontSize,
		authorFontSizeType,
		authorFontSizeTablet,
		authorFontSizeMobile,
		authorFontFamily,
		authorFontWeight,
		authorFontStyle,
		authorLineHeightType,
		authorLineHeight,
		authorLineHeightTablet,
		authorLineHeightMobile,
		authorLoadGoogleFonts,
		descSpace,
		descSpaceTablet,
		descSpaceMobile,
		authorSpace,
		authorSpaceTablet,
		authorSpaceMobile,
		borderColor,
		borderStyle,
		borderWidth,
		borderGap,
		borderGapTablet,
		borderGapMobile,
		verticalPadding,
		verticalPaddingTablet,
		verticalPaddingMobile,
		quoteColor,
		quoteBgColor,
		quoteSize,
		quoteSizeType,
		quoteSizeTablet,
		quoteSizeMobile,
		quotePadding,
		quotePaddingType,
		quotePaddingTablet,
		quotePaddingMobile,
		quoteBorderRadius,
		quoteStyle,
		enableTweet,
		tweetLinkColor,
		tweetBtnColor,
		tweetBtnHoverColor,
		tweetBtnBgColor,
		tweetBtnBgHoverColor,
		tweetBtnFontSize,
		tweetBtnFontSizeType,
		tweetBtnFontSizeTablet,
		tweetBtnFontSizeMobile,
		tweetBtnFontFamily,
		tweetBtnFontWeight,
		tweetBtnFontStyle,
		tweetBtnLineHeightType,
		tweetBtnLineHeight,
		tweetBtnLineHeightTablet,
		tweetBtnLineHeightMobile,
		tweetBtnLoadGoogleFonts,
		tweetIconSpacing,
		tweetIconSpacingUnit,
		iconView,
		iconSkin,
		iconLabel,
		iconShareVia,
		iconTargetUrl,
		customUrl,
		authorImage,
		authorImageWidth,
		authorImageWidthTablet,
		authorImageWidthMobile,
		authorImageWidthUnit,
		authorImageGap,
		authorImageGapTablet,
		authorImageGapMobile,
		authorImageGapUnit,
		authorImageSize,
		authorImgBorderRadius,
		authorImgBorderRadiusTablet,
		authorImgBorderRadiusMobile,
		authorImgPosition,
		quoteTopMargin,
		quoteBottomMargin,
		quoteLeftMargin,
		quoteRightMargin,
		quoteHoverColor,
		quoteBgHoverColor,
		borderHoverColor,
		authorImgBorderRadiusUnit,
		borderWidthUnit,
		quoteBorderRadiusUnit,
		quoteUnit,
		quotemobileUnit,
		quotetabletUnit,
		borderGapUnit,
		descSpaceUnit,
		authorSpaceUnit,
		verticalPaddingUnit,
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
		btnspacingLink,
		spacingLink,
		descTransform,
		authorTransform,
		tweetBtnTransform,
		descDecoration,
		authorDecoration,
		tweetBtnDecoration,
		quoteTopMarginTablet,
		quoteBottomMarginTablet,
		quoteLeftMarginTablet,
		quoteRightMarginTablet,
		quoteTopMarginMobile,
		quoteBottomMarginMobile,
		quoteLeftMarginMobile,
		quoteRightMarginMobile,
		author,
		descLetterSpacing,
		descLetterSpacingTablet,
		descLetterSpacingMobile,
		descLetterSpacingType,
		authorLetterSpacing,
		authorLetterSpacingTablet,
		authorLetterSpacingMobile,
		authorLetterSpacingType,
		tweetBtnLetterSpacing,
		tweetBtnLetterSpacingTablet,
		tweetBtnLetterSpacingMobile,
		tweetBtnLetterSpacingType,
	} = attributes;

	/*
	 * Event to set Image as null while removing.
	 */
	const onRemoveImage = () => {
		setAttributes( { authorImage: null } );
	};

	/*
	 * Event to set Image as while adding.
	 */
	const onSelectImage = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { authorImage: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			return;
		}

		setAttributes( { authorImage: media } );
	};

	const imageSizeOptions = [
		{
			value: 'thumbnail',
			label: __( 'Thumbnail', 'vexaltrix' ),
		},
		{
			value: 'medium',
			label: __( 'Medium', 'vexaltrix' ),
		},
		{
			value: 'full',
			label: __( 'Large', 'vexaltrix' ),
		},
	];

	// Image controls.
	const imageControls = (
		<>
			<UAGMediaPicker
				onSelectImage={ onSelectImage }
				backgroundImage={ authorImage }
				onRemoveImage={ onRemoveImage }
				label={ __( 'Author Image', 'vexaltrix' ) }
				slug={ 'author-image' }
			/>
			{ authorImage && authorImage.url !== 'null' && authorImage.url !== '' && (
				<>
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Author Image Position', 'vexaltrix' ) }
						data={ {
							value: authorImgPosition,
							label: 'authorImgPosition',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'left',
								label: 'Left',
							},
							{
								value: 'top',
								label: 'Top',
							},
							{
								value: 'right',
								label: 'Right',
							},
						] }
						showIcons={ false }
					/>
				</>
			) }
		</>
	);

	const quoteSettings = (
		<>
			<ResponsiveSlider
				label={ __( 'Quote Icon Size', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: quoteSize,
						label: 'quoteSize',
					},
					tablet: {
						value: quoteSizeTablet,
						label: 'quoteSizeTablet',
					},
					mobile: {
						value: quoteSizeMobile,
						label: 'quoteSizeMobile',
					},
				} }
				min={ 0 }
				max={ 50 }
				unit={ {
					value: quoteSizeType,
					label: 'quoteSizeType',
				} }
				setAttributes={ setAttributes }
			/>
			<ResponsiveSlider
				label={ __( 'Background Size', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: quotePadding,
						label: 'quotePadding',
					},
					tablet: {
						value: quotePaddingTablet,
						label: 'quotePaddingTablet',
					},
					mobile: {
						value: quotePaddingMobile,
						label: 'quotePaddingMobile',
					},
				} }
				min={ 0 }
				max={ 200 }
				unit={ {
					value: quotePaddingType,
					label: 'quotePaddingType',
				} }
				setAttributes={ setAttributes }
			/>
			{ quoteBgColor && (
				<Range
					label={ __( 'Quote Icon Border Radius', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ quoteBorderRadius }
					data={ {
						value: quoteBorderRadius,
						label: 'quoteBorderRadius',
					} }
					min={ 0 }
					max={ 100 }
					unit={ {
						value: quoteBorderRadiusUnit,
						label: 'quoteBorderRadiusUnit',
					} }
					units={ [
						{
							name: __( 'Pixel', 'vexaltrix' ),
							unitValue: 'px',
						},
						{
							name: __( 'Em', 'vexaltrix' ),
							unitValue: 'em',
						},
						{
							name: __( '%', 'vexaltrix' ),
							unitValue: '%',
						},
					] }
				/>
			) }
		</>
	);

	const skinSettings = (
		<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) }>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Type', 'vexaltrix' ) }
				data={ {
					value: skinStyle,
					label: 'skinStyle',
				} }
				className="vxt-multi-button-alignment-control"
				options={ [
					{
						value: 'border',
						label: __( 'Border', 'vexaltrix' ),
					},
					{
						value: 'quotation',
						label: __( 'Quotation', 'vexaltrix' ),
					},
				] }
				showIcons={ false }
			/>
			{ 'quotation' === skinStyle && (
				<>
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Quotation Type', 'vexaltrix' ) }
						data={ {
							value: quoteStyle,
							label: 'quoteStyle',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'style_1',
								label: __( 'Normal', 'vexaltrix' ),
							},
							{
								value: 'style_2',
								label: __( 'Inline', 'vexaltrix' ),
							},
						] }
						showIcons={ false }
					/>
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
				</>
			) }
			{ imageControls }
		</UAGAdvancedPanelBody>
	);

	const quoteStyling = (
		<UAGAdvancedPanelBody title={ __( 'Quote', 'vexaltrix' ) } initialOpen={ false }>
			<AdvancedPopColorControl
				label={ __( 'Quote Color', 'vexaltrix' ) }
				colorValue={ descColor ? descColor : '' }
				data={ {
					value: descColor,
					label: 'descColor',
				} }
				setAttributes={ setAttributes }
			/>
			<TypographyControl
				label={ __( 'Quote Typography', 'vexaltrix' ) }
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
				fontSizeType={ {
					value: descFontSizeType,
					label: 'descFontSizeType',
				} }
				fontSize={ { value: descFontSize, label: 'descFontSize' } }
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
				transform={ {
					value: descTransform,
					label: 'descTransform',
				} }
				decoration={ {
					value: descDecoration,
					label: 'descDecoration',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const authorStyling = (
		<UAGAdvancedPanelBody title={ __( 'Author', 'vexaltrix' ) } initialOpen={ false }>
			{ author !== '' && (
				<>
					<AdvancedPopColorControl
						label={ __( 'Author Color', 'vexaltrix' ) }
						colorValue={ authorColor ? authorColor : '' }
						data={ {
							value: authorColor,
							label: 'authorColor',
						} }
						setAttributes={ setAttributes }
					/>
					<TypographyControl
						label={ __( 'Author Typography', 'vexaltrix' ) }
						attributes={ attributes }
						setAttributes={ setAttributes }
						loadGoogleFonts={ {
							value: authorLoadGoogleFonts,
							label: 'authorLoadGoogleFonts',
						} }
						fontFamily={ {
							value: authorFontFamily,
							label: 'authorFontFamily',
						} }
						fontWeight={ {
							value: authorFontWeight,
							label: 'authorFontWeight',
						} }
						fontStyle={ {
							value: authorFontStyle,
							label: 'authorFontStyle',
						} }
						fontSizeType={ {
							value: authorFontSizeType,
							label: 'authorFontSizeType',
						} }
						fontSize={ {
							value: authorFontSize,
							label: 'authorFontSize',
						} }
						fontSizeMobile={ {
							value: authorFontSizeMobile,
							label: 'authorFontSizeMobile',
						} }
						fontSizeTablet={ {
							value: authorFontSizeTablet,
							label: 'authorFontSizeTablet',
						} }
						lineHeightType={ {
							value: authorLineHeightType,
							label: 'authorLineHeightType',
						} }
						lineHeight={ {
							value: authorLineHeight,
							label: 'authorLineHeight',
						} }
						lineHeightMobile={ {
							value: authorLineHeightMobile,
							label: 'authorLineHeightMobile',
						} }
						lineHeightTablet={ {
							value: authorLineHeightTablet,
							label: 'authorLineHeightTablet',
						} }
						letterSpacing={ {
							value: authorLetterSpacing,
							label: 'authorLetterSpacing',
						} }
						letterSpacingTablet={ {
							value: authorLetterSpacingTablet,
							label: 'authorLetterSpacingTablet',
						} }
						letterSpacingMobile={ {
							value: authorLetterSpacingMobile,
							label: 'authorLetterSpacingMobile',
						} }
						letterSpacingType={ {
							value: authorLetterSpacingType,
							label: 'authorLetterSpacingType',
						} }
						transform={ {
							value: authorTransform,
							label: 'authorTransform',
						} }
						decoration={ {
							value: authorDecoration,
							label: 'authorDecoration',
						} }
					/>
				</>
			) }
			{ authorImage && authorImage.url !== 'null' && authorImage.url !== '' && (
				<>
					<UAGSelectControl
						label={ __( 'Author Image Size', 'vexaltrix' ) }
						data={ {
							value: authorImageSize,
							label: 'authorImageSize',
						} }
						setAttributes={ setAttributes }
						options={ imageSizeOptions }
					/>
					<ResponsiveSlider
						label={ __( 'Author Image Width', 'vexaltrix' ) }
						data={ {
							desktop: {
								value: authorImageWidth,
								label: 'authorImageWidth',
							},
							tablet: {
								value: authorImageWidthTablet,
								label: 'authorImageWidthTablet',
							},
							mobile: {
								value: authorImageWidthMobile,
								label: 'authorImageWidthMobile',
							},
						} }
						min={ 0 }
						max={ 500 }
						unit={ {
							value: authorImageWidthUnit,
							label: 'authorImageWidthUnit',
						} }
						setAttributes={ setAttributes }
					/>
					<ResponsiveSlider
						label={ __( 'Image Border Radius', 'vexaltrix' ) }
						data={ {
							desktop: {
								value: authorImgBorderRadius,
								label: 'authorImgBorderRadius',
							},
							tablet: {
								value: authorImgBorderRadiusTablet,
								label: 'authorImgBorderRadiusTablet',
							},
							mobile: {
								value: authorImgBorderRadiusMobile,
								label: 'authorImgBorderRadiusMobile',
							},
						} }
						min={ 0 }
						max={ 50 }
						unit={ {
							value: authorImgBorderRadiusUnit,
							label: 'authorImgBorderRadiusUnit',
						} }
						units={ [
							{
								name: __( 'Pixel', 'vexaltrix' ),
								unitValue: 'px',
							},
							{
								name: __( '%', 'vexaltrix' ),
								unitValue: '%',
							},
						] }
						setAttributes={ setAttributes }
					/>
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const twitterSettings = (
		<UAGAdvancedPanelBody title={ __( 'Twitter Icon', 'vexaltrix' ) } initialOpen={ false }>
			<ToggleControl
				label={ __( 'Enable Icon', 'vexaltrix' ) }
				checked={ enableTweet }
				onChange={ () => setAttributes( { enableTweet: ! enableTweet } ) }
			/>
			{ enableTweet && (
				<>
					<UAGTextControl
						label={ __( 'Twitter Username', 'vexaltrix' ) }
						data={ {
							value: iconShareVia,
							label: 'iconShareVia',
						} }
						setAttributes={ setAttributes }
						value={ iconShareVia }
						onChange={ ( value ) =>
							setAttributes( {
								iconShareVia: value,
							} )
						}
					/>
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Icon View', 'vexaltrix' ) }
						data={ {
							value: iconView,
							label: 'iconView',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'icon_text',
								label: __( 'Both', 'vexaltrix' ),
							},
							{
								value: 'icon',
								label: __( 'Icon', 'vexaltrix' ),
							},
							{
								value: 'text',
								label: __( 'Text', 'vexaltrix' ),
							},
						] }
						showIcons={ false }
					/>
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Icon Style', 'vexaltrix' ) }
						data={ {
							value: iconSkin,
							label: 'iconSkin',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'classic',
								label: __( 'Classic', 'vexaltrix' ),
							},
							{
								value: 'bubble',
								label: __( 'Bubble', 'vexaltrix' ),
							},
							{
								value: 'link',
								label: __( 'Link', 'vexaltrix' ),
							},
						] }
						showIcons={ false }
					/>
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Target URL', 'vexaltrix' ) }
						data={ {
							value: iconTargetUrl,
							label: 'iconTargetUrl',
						} }
						className="vxt-multi-button-alignment-control"
						options={ [
							{
								value: 'current',
								label: __( 'Current Page', 'vexaltrix' ),
							},
							{
								value: 'custom',
								label: __( 'Custom URL', 'vexaltrix' ),
							},
						] }
						showIcons={ false }
					/>
					{ iconTargetUrl === 'custom' && (
						<UAGTextControl
							label={ __( 'URL', 'vexaltrix' ) }
							value={ customUrl }
							data={ {
								value: customUrl,
								label: 'customUrl',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) => setAttributes( { customUrl: value } ) }
						/>
					) }
				</>
			) }
			{ enableTweet && iconView !== 'icon' && (
				<>
					<UAGTextControl
						label={ __( 'Label', 'vexaltrix' ) }
						value={ iconLabel }
						data={ {
							value: iconLabel,
							label: 'iconLabel',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { iconLabel: value } ) }
					/>
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const spacingSettings = (
		<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
			{ authorImage && authorImage.url && (
				<ResponsiveSlider
					label={ __( 'Author - Image Gap', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: authorImageGap,
							label: 'authorImageGap',
						},
						tablet: {
							value: authorImageGapTablet,
							label: 'authorImageGapTablet',
						},
						mobile: {
							value: authorImageGapMobile,
							label: 'authorImageGapMobile',
						},
					} }
					min={ 0 }
					max={ 500 }
					unit={ {
						value: authorImageGapUnit,
						label: 'authorImageGapUnit',
					} }
					setAttributes={ setAttributes }
				/>
			) }
			{ skinStyle === 'quotation' && (
				<SpacingControl
					{ ...props }
					label={ __( 'Quote Icon Margin', 'vexaltrix' ) }
					valueTop={ {
						value: quoteTopMargin,
						label: 'quoteTopMargin',
					} }
					valueRight={ {
						value: quoteRightMargin,
						label: 'quoteRightMargin',
					} }
					valueBottom={ {
						value: quoteBottomMargin,
						label: 'quoteBottomMargin',
					} }
					valueLeft={ {
						value: quoteLeftMargin,
						label: 'quoteLeftMargin',
					} }
					valueTopTablet={ {
						value: quoteTopMarginTablet,
						label: 'quoteTopMarginTablet',
					} }
					valueRightTablet={ {
						value: quoteRightMarginTablet,
						label: 'quoteRightMarginTablet',
					} }
					valueBottomTablet={ {
						value: quoteBottomMarginTablet,
						label: 'quoteBottomMarginTablet',
					} }
					valueLeftTablet={ {
						value: quoteLeftMarginTablet,
						label: 'quoteLeftMarginTablet',
					} }
					valueTopMobile={ {
						value: quoteTopMarginMobile,
						label: 'quoteTopMarginMobile',
					} }
					valueRightMobile={ {
						value: quoteRightMarginMobile,
						label: 'quoteRightMarginMobile',
					} }
					valueBottomMobile={ {
						value: quoteBottomMarginMobile,
						label: 'quoteBottomMarginMobile',
					} }
					valueLeftMobile={ {
						value: quoteLeftMarginMobile,
						label: 'quoteLeftMarginMobile',
					} }
					unit={ {
						value: quoteUnit,
						label: 'quoteUnit',
					} }
					mUnit={ {
						value: quotemobileUnit,
						label: 'quotemobileUnit',
					} }
					tUnit={ {
						value: quotetabletUnit,
						label: 'quotetabletUnit',
					} }
					deviceType={ deviceType }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: spacingLink,
						label: 'spacingLink',
					} }
				/>
			) }
			{ skinStyle === 'border' && (
				<ResponsiveSlider
					label={ __( 'Border - Quote Gap', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: borderGap,
							label: 'borderGap',
						},
						tablet: {
							value: borderGapTablet,
							label: 'borderGapTablet',
						},
						mobile: {
							value: borderGapMobile,
							label: 'borderGapMobile',
						},
					} }
					min={ 0 }
					max={ 200 }
					unit={ {
						value: borderGapUnit,
						label: 'borderGapUnit',
					} }
					setAttributes={ setAttributes }
				/>
			) }
			<ResponsiveSlider
				label={ __( 'Quote Bottom Spacing', 'vexaltrix' ) }
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
				max={ 200 }
				unit={ {
					value: descSpaceUnit,
					label: 'descSpaceUnit',
				} }
				setAttributes={ setAttributes }
			/>
			{ align === 'center' && skinStyle !== 'border' && (
				<ResponsiveSlider
					label={ __( 'Author Bottom Spacing', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: authorSpace,
							label: 'authorSpace',
						},
						tablet: {
							value: authorSpaceTablet,
							label: 'authorSpaceTablet',
						},
						mobile: {
							value: authorSpaceMobile,
							label: 'authorSpaceMobile',
						},
					} }
					min={ 0 }
					max={ 200 }
					unit={ {
						value: authorSpaceUnit,
						label: 'authorSpaceUnit',
					} }
					setAttributes={ setAttributes }
				/>
			) }

			{ skinStyle === 'border' && (
				<>
					<ResponsiveSlider
						label={ __( 'Vertical Spacing', 'vexaltrix' ) }
						data={ {
							desktop: {
								value: verticalPadding,
								label: 'verticalPadding',
							},
							tablet: {
								value: verticalPaddingTablet,
								label: 'verticalPaddingTablet',
							},
							mobile: {
								value: verticalPaddingMobile,
								label: 'verticalPaddingMobile',
							},
						} }
						min={ 0 }
						max={ 500 }
						unit={ {
							value: verticalPaddingUnit,
							label: 'verticalPaddingUnit',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const generalStyle = () => {
		const tabOutputNormal = (
			<>
				<AdvancedPopColorControl
					label={ __( 'Icon Color', 'vexaltrix' ) }
					colorValue={ quoteColor ? quoteColor : '' }
					data={ {
						value: quoteColor,
						label: 'quoteColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Icon Background Color', 'vexaltrix' ) }
					colorValue={ quoteBgColor ? quoteBgColor : '' }
					data={ {
						value: quoteBgColor,
						label: 'quoteBgColor',
					} }
					setAttributes={ setAttributes }
				/>
			</>
		);
		const tabOutputHover = (
			<>
				<AdvancedPopColorControl
					label={ __( 'Icon Color', 'vexaltrix' ) }
					colorValue={ quoteHoverColor ? quoteHoverColor : '' }
					data={ {
						value: quoteHoverColor,
						label: 'quoteHoverColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Icon Background Color', 'vexaltrix' ) }
					colorValue={ quoteBgHoverColor ? quoteBgHoverColor : '' }
					data={ {
						value: quoteBgHoverColor,
						label: 'quoteBgHoverColor',
					} }
					setAttributes={ setAttributes }
				/>
			</>
		);
		return (
			<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) } initialOpen={ true }>
				{ skinStyle === 'border' && borderStyleSetting() }
				{ skinStyle === 'quotation' && quoteSettings }
				{ skinStyle === 'quotation' && (
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
						normal={ tabOutputNormal }
						hover={ tabOutputHover }
						disableBottomSeparator={ true }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const borderStyleSetting = () => {
		const tabOutputNormal = (
			<AdvancedPopColorControl
				label={ __( 'Border Color', 'vexaltrix' ) }
				colorValue={ borderColor ? borderColor : '' }
				data={ {
					value: borderColor,
					label: 'borderColor',
				} }
				setAttributes={ setAttributes }
			/>
		);
		const tabOutputHover = (
			<AdvancedPopColorControl
				label={ __( 'Border Color', 'vexaltrix' ) }
				colorValue={ borderHoverColor ? borderHoverColor : '' }
				data={ {
					value: borderHoverColor,
					label: 'borderHoverColor',
				} }
				setAttributes={ setAttributes }
			/>
		);
		return (
			<>
				<UAGSelectControl
					label={ __( 'Border Style', 'vexaltrix' ) }
					data={ {
						value: borderStyle,
						label: 'borderStyle',
					} }
					setAttributes={ setAttributes }
					options={ [
						{
							value: 'none',
							label: __( 'None', 'vexaltrix' ),
						},
						{
							value: 'solid',
							label: __( 'Solid', 'vexaltrix' ),
						},
						{
							value: 'dotted',
							label: __( 'Dotted', 'vexaltrix' ),
						},
						{
							value: 'dashed',
							label: __( 'Dashed', 'vexaltrix' ),
						},
						{
							value: 'double',
							label: __( 'Double', 'vexaltrix' ),
						},
						{
							value: 'groove',
							label: __( 'Groove', 'vexaltrix' ),
						},
						{
							value: 'inset',
							label: __( 'Inset', 'vexaltrix' ),
						},
						{
							value: 'outset',
							label: __( 'Outset', 'vexaltrix' ),
						},
						{
							value: 'ridge',
							label: __( 'Ridge', 'vexaltrix' ),
						},
					] }
				/>
				{ 'none' !== borderStyle && (
					<>
						<Range
							label={ __( 'Thickness', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ borderWidth }
							data={ {
								value: borderWidth,
								label: 'borderWidth',
							} }
							min={ 0 }
							max={ 50 }
							unit={ {
								value: borderWidthUnit,
								label: 'borderWidthUnit',
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
							normal={ tabOutputNormal }
							hover={ tabOutputHover }
							disableBottomSeparator={ true }
						/>
					</>
				) }
			</>
		);
	};
	const iconStyleSetting = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Twitter Icon', 'vexaltrix' ) } initialOpen={ false }>
				{ iconSkin === 'link' && (
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
								colorValue={ tweetLinkColor ? tweetLinkColor : '' }
								data={ {
									value: tweetLinkColor,
									label: 'tweetLinkColor',
								} }
								setAttributes={ setAttributes }
							/>
						}
						hover={
							<AdvancedPopColorControl
								label={ __( 'Color', 'vexaltrix' ) }
								colorValue={ tweetBtnHoverColor ? tweetBtnHoverColor : '' }
								data={ {
									value: tweetBtnHoverColor,
									label: 'tweetBtnHoverColor',
								} }
								setAttributes={ setAttributes }
							/>
						}
					/>
				) }
				{ iconSkin !== 'link' && (
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
									colorValue={ tweetBtnColor ? tweetBtnColor : '' }
									data={ {
										value: tweetBtnColor,
										label: 'tweetBtnColor',
									} }
									setAttributes={ setAttributes }
								/>
								<AdvancedPopColorControl
									label={ __( 'Background Color', 'vexaltrix' ) }
									colorValue={ tweetBtnBgColor ? tweetBtnBgColor : '' }
									data={ {
										value: tweetBtnBgColor,
										label: 'tweetBtnBgColor',
									} }
									setAttributes={ setAttributes }
								/>
							</>
						}
						hover={
							<>
								<AdvancedPopColorControl
									label={ __( 'Color', 'vexaltrix' ) }
									colorValue={ tweetBtnHoverColor ? tweetBtnHoverColor : '' }
									data={ {
										value: tweetBtnHoverColor,
										label: 'tweetBtnHoverColor',
									} }
									setAttributes={ setAttributes }
								/>
								<AdvancedPopColorControl
									label={ __( 'Background Color', 'vexaltrix' ) }
									colorValue={ tweetBtnBgHoverColor ? tweetBtnBgHoverColor : '' }
									data={ {
										value: tweetBtnBgHoverColor,
										label: 'tweetBtnBgHoverColor',
									} }
									setAttributes={ setAttributes }
								/>
							</>
						}
					/>
				) }
				{ iconView === 'icon_text' && (
					<Range
						label={ __( 'Icon & Text Spacing', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ tweetIconSpacing }
						data={ {
							value: tweetIconSpacing,
							label: 'tweetIconSpacing',
						} }
						min={ 0 }
						max={ 20 }
						unit={ {
							value: tweetIconSpacingUnit,
							label: 'tweetIconSpacingUnit',
						} }
						initialPosition={ 5 }
					/>
				) }
				{ iconSkin !== 'link' && (
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
							value: btnspacingLink,
							label: 'btnspacingLink',
						} }
					/>
				) }
				{ iconView !== 'icon' && (
					<TypographyControl
						label={ __( 'Typography', 'vexaltrix' ) }
						attributes={ attributes }
						setAttributes={ setAttributes }
						loadGoogleFonts={ {
							value: tweetBtnLoadGoogleFonts,
							label: 'tweetBtnLoadGoogleFonts',
						} }
						fontFamily={ {
							value: tweetBtnFontFamily,
							label: 'tweetBtnFontFamily',
						} }
						fontWeight={ {
							value: tweetBtnFontWeight,
							label: 'tweetBtnFontWeight',
						} }
						fontStyle={ {
							value: tweetBtnFontStyle,
							label: 'tweetBtnFontStyle',
						} }
						fontSizeType={ {
							value: tweetBtnFontSizeType,
							label: 'tweetBtnFontSizeType',
						} }
						fontSize={ {
							value: tweetBtnFontSize,
							label: 'tweetBtnFontSize',
						} }
						fontSizeMobile={ {
							value: tweetBtnFontSizeMobile,
							label: 'tweetBtnFontSizeMobile',
						} }
						fontSizeTablet={ {
							value: tweetBtnFontSizeTablet,
							label: 'tweetBtnFontSizeTablet',
						} }
						lineHeightType={ {
							value: tweetBtnLineHeightType,
							label: 'tweetBtnLineHeightType',
						} }
						lineHeight={ {
							value: tweetBtnLineHeight,
							label: 'tweetBtnLineHeight',
						} }
						lineHeightMobile={ {
							value: tweetBtnLineHeightMobile,
							label: 'tweetBtnLineHeightMobile',
						} }
						lineHeightTablet={ {
							value: tweetBtnLineHeightTablet,
							label: 'tweetBtnLineHeightTablet',
						} }
						letterSpacing={ {
							value: tweetBtnLetterSpacing,
							label: 'tweetBtnLetterSpacing',
						} }
						letterSpacingTablet={ {
							value: tweetBtnLetterSpacingTablet,
							label: 'tweetBtnLetterSpacingTablet',
						} }
						letterSpacingMobile={ {
							value: tweetBtnLetterSpacingMobile,
							label: 'tweetBtnLetterSpacingMobile',
						} }
						letterSpacingType={ {
							value: tweetBtnLetterSpacingType,
							label: 'tweetBtnLetterSpacingType',
						} }
						transform={ {
							value: tweetBtnTransform,
							label: 'tweetBtnTransform',
						} }
						decoration={ {
							value: tweetBtnDecoration,
							label: 'tweetBtnDecoration',
						} }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
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
	return (
		<>
			<BlockControls key="controls"></BlockControls>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ skinSettings }
						{ twitterSettings }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
							proUpgradePanel() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ generalStyle() }
						{ enableTweet && iconStyleSetting() }
						{ quoteStyling }
						{ authorStyling }
						{ spacingSettings }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};

export default memo( Settings );
