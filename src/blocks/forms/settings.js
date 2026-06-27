import { __ } from '@wordpress/i18n';
import { memo } from '@wordpress/element';
import TypographyControl from '@Components/typography';
import ResponsiveBorder from '@Components/responsive-border';
import MultiButtonsControl from '@Components/multi-buttons-control';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import SpacingControl from '@Components/spacing-control';
import ResponsiveSlider from '@Components/responsive-slider';
import { InspectorControls } from '@wordpress/block-editor';
import renderSVG from '@Controls/renderIcon';
import UAGTabsControl from '@Components/tabs';
import UAGSelectControl from '@Components/select-control';
import GradientSettings from '@Components/gradient-settings';
import { ToggleControl, Icon } from '@wordpress/components';
import formsPresets, { buttonsPresets } from './presets';
import UAGPresets from '@Components/presets';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UAGTextControl from '@Components/text-control';

const Settings = ( props ) => {
	const { attributes, setAttributes, deviceType } = props;
	const {
		formPaddingTop,
		formPaddingRight,
		formPaddingBottom,
		formPaddingLeft,
		formPaddingTopTab,
		formPaddingRightTab,
		formPaddingBottomTab,
		formPaddingLeftTab,
		formPaddingTopMob,
		formPaddingRightMob,
		formPaddingBottomMob,
		formPaddingLeftMob,
		formPaddingUnit,
		formPaddingUnitTab,
		formPaddingUnitMob,
		formPaddingLink,
		formLabel,
		buttonAlign,
		buttonAlignTablet,
		buttonAlignMobile,
		buttonSize,
		confirmationType,
		confirmationMessage,
		failedMessage,
		confirmationUrl,
		afterSubmitToEmail,
		afterSubmitCcEmail,
		afterSubmitBccEmail,
		afterSubmitEmailSubject,
		submitColor,
		submitColorHover,
		submitBgType,
		submitBgHoverType,
		submitBgColor,
		submitBgColorHover,
		submitTextloadGoogleFonts,
		submitTextFontFamily,
		submitTextFontWeight,
		submitTextFontSize,
		submitTextFontSizeType,
		submitTextFontSizeTablet,
		submitTextFontSizeMobile,
		submitTextLineHeightType,
		submitTextLineHeight,
		submitTextLineHeightTablet,
		submitTextLineHeightMobile,
		inheritFromTheme,
		submitButtonType,
		labelloadGoogleFonts,
		labelFontFamily,
		labelFontWeight,
		labelFontSize,
		labelFontSizeType,
		labelFontSizeTablet,
		labelFontSizeMobile,
		labelLineHeightType,
		labelLineHeight,
		labelLineHeightTablet,
		labelLineHeightMobile,
		inputloadGoogleFonts,
		inputFontFamily,
		inputFontWeight,
		inputFontSize,
		inputFontSizeType,
		inputFontSizeTablet,
		inputFontSizeMobile,
		inputLineHeightType,
		inputLineHeight,
		inputLineHeightTablet,
		inputLineHeightMobile,
		toggleSize,
		toggleSizeTablet,
		toggleSizeMobile,
		toggleWidthSize,
		toggleWidthSizeTablet,
		toggleWidthSizeMobile,
		toggleColor,
		toggleActiveColor,
		toggleDotColor,
		toggleDotActiveColor,
		labelColor,
		labelHoverColor,
		inputColor,
		bgColor,
		bgHoverColor,
		bgActiveColor,
		inputplaceholderColor,
		inputplaceholderHoverColor,
		inputplaceholderActiveColor,
		fieldGap,
		fieldGapTablet,
		fieldGapMobile,
		formStyle,
		overallAlignment,
		overallAlignmentTablet,
		overallAlignmentMobile,
		labelAlignment,
		labelAlignmentTablet,
		labelAlignmentMobile,
		reCaptchaEnable,
		reCaptchaType,
		successMessageTextColor,
		successMessageBGColor,
		failedMessageTextColor,
		failedMessageBGColor,

		paddingBtnTop,
		paddingBtnRight,
		paddingBtnBottom,
		paddingBtnLeft,
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
		paddingspacingLink,
		submitTextTransform,
		submitTextDecoration,
		labelTransform,
		labelDecoration,
		inputTransform,
		inputDecoration,
		fieldGapType,
		paddingFieldTop,
		paddingFieldRight,
		paddingFieldBottom,
		paddingFieldLeft,
		paddingFieldTopTablet,
		paddingFieldRightTablet,
		paddingFieldBottomTablet,
		paddingFieldLeftTablet,
		paddingFieldTopMobile,
		paddingFieldRightMobile,
		paddingFieldBottomMobile,
		paddingFieldLeftMobile,
		paddingFieldUnit,
		paddingFieldUnitmobile,
		paddingFieldUnitTablet,
		paddingFieldLink,
		toggleSizeType,
		submitTextFontStyle,
		labelFontStyle,
		inputFontStyle,
		hidereCaptchaBatch,

		labelGap,
		labelGapTablet,
		labelGapMobile,
		labelGapUnit,

		displayLabels,
		labelLetterSpacing,
		labelLetterSpacingTablet,
		labelLetterSpacingMobile,
		labelLetterSpacingType,
		inputLetterSpacing,
		inputLetterSpacingTablet,
		inputLetterSpacingMobile,
		inputLetterSpacingType,
		submitTextLetterSpacing,
		submitTextLetterSpacingTablet,
		submitTextLetterSpacingMobile,
		submitTextLetterSpacingType,
		gradientValue,
		gradientHValue,
		gradientHColor1,
		selectHGradient,
		gradientHColor2,
		gradientHLocation1,
		gradientHLocationTablet1,
		gradientHLocationMobile1,
		gradientHLocation2,
		gradientHLocationTablet2,
		gradientHLocationMobile2,
		gradientHType,
		gradientHAngle,
		gradientHAngleTablet,
		gradientHAngleMobile,
		gradientColor1,
		gradientColor2,
		gradientLocation1,
		gradientLocationTablet1,
		gradientLocationMobile1,
		gradientLocation2,
		gradientLocationTablet2,
		gradientLocationMobile2,
		gradientType,
		gradientAngle,
		gradientAngleTablet,
		gradientAngleMobile,
		selectGradient,
	} = attributes;

	const currentTheme = vxt_ultimate_gutenberg_blocks_blocks_info.current_theme;

	const presetSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Presets', 'vexaltrix' ) } initialOpen={ false }>
				<UAGPresets setAttributes={ setAttributes } presets={ formsPresets } presetInputType="radioImage" />
			</UAGAdvancedPanelBody>
		);
	};
	const submitGeneral = () => (
		<UAGAdvancedPanelBody
			title={ __( 'Submit Button', 'vexaltrix' ) }
			initialOpen={ false }
			// className="vxt_ultimate_gutenberg_blocks__url-panel-body"
		>
			<ToggleControl
				label={ __( 'Inherit From Theme', 'vexaltrix' ) }
				checked={ inheritFromTheme }
				onChange={ () => setAttributes( { inheritFromTheme: ! inheritFromTheme } ) }
			/>
			{ inheritFromTheme && 'Astra' === currentTheme && (
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Button Type', 'vexaltrix' ) }
					data={ {
						value: submitButtonType,
						label: 'submitButtonType',
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
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Button Alignment', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: buttonAlign,
						label: 'buttonAlign',
					},
					tablet: {
						value: buttonAlignTablet,
						label: 'buttonAlignTablet',
					},
					mobile: {
						value: buttonAlignMobile,
						label: 'buttonAlignMobile',
					},
				} }
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
					{
						value: 'full',
						icon: <Icon icon={ renderSVG( 'fa fa-align-justify' ) } />,
						tooltip: __( 'Full Width', 'vexaltrix' ),
					},
				] }
				showIcons={ true }
				responsive={ true }
			/>
			{ ! inheritFromTheme && (
				<UAGPresets setAttributes={ setAttributes } presets={ buttonsPresets } presetInputType="radioImage" />
			) }
		</UAGAdvancedPanelBody>
	);
	const generalSettings = () => {
		return (
			<UAGAdvancedPanelBody
				title={ __( 'General', 'vexaltrix' ) }
				initialOpen={ true }
				className="vxt_ultimate_gutenberg_blocks__url-panel-body"
			>
				<ToggleControl
					label={ __( 'Show Labels', 'vexaltrix' ) }
					checked={ displayLabels }
					onChange={ () => setAttributes( { displayLabels: ! displayLabels } ) }
				/>
				<UAGTextControl
					label={ __( 'Hidden Field Label', 'vexaltrix' ) }
					value={ formLabel }
					data={ {
						value: formLabel,
						label: 'formLabel',
					} }
					setAttributes={ setAttributes }
					onChange={ ( value ) =>
						setAttributes( {
							formLabel: value,
						} )
					}
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Style', 'vexaltrix' ) }
					data={ {
						value: formStyle,
						label: 'formStyle',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: 'boxed',
							label: 'Boxed',
						},
						{
							value: 'underlined',
							label: 'Underlined',
						},
					] }
					showIcons={ false }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Label Alignment', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: labelAlignment,
							label: 'labelAlignment',
						},
						tablet: {
							value: labelAlignmentTablet,
							label: 'labelAlignmentTablet',
						},
						mobile: {
							value: labelAlignmentMobile,
							label: 'labelAlignmentMobile',
						},
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
					responsive={ true }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Placeholder Alignment', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: overallAlignment,
							label: 'overallAlignment',
						},
						tablet: {
							value: overallAlignmentTablet,
							label: 'overallAlignmentTablet',
						},
						mobile: {
							value: overallAlignmentMobile,
							label: 'overallAlignmentMobile',
						},
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
					responsive={ true }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Confirmation Type', 'vexaltrix' ) }
					data={ {
						value: confirmationType,
						label: 'confirmationType',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: 'message',
							label: 'Message',
						},
						{
							value: 'url',
							label: 'URL Text',
						},
					] }
					showIcons={ false }
				/>
				{ 'message' === confirmationType && (
					<>
						<UAGTextControl
							variant="textarea"
							setAttributes={ setAttributes }
							label={ __( 'Success Message Text', 'vexaltrix' ) }
							help={ __(
								'Enter a message you want to display after successfull form submission',
								'vexaltrix'
							) }
							value={ confirmationMessage }
							data={ {
								value: confirmationMessage,
								label: 'confirmationMessage',
							} }
							onChange={ ( value ) =>
								setAttributes( {
									confirmationMessage: value,
								} )
							}
						/>
						<UAGTextControl
							variant="textarea"
							setAttributes={ setAttributes }
							label={ __( 'Error Message Text', 'vexaltrix' ) }
							help={ __(
								'Enter a message you want to display after unsuccessfull form submission',
								'vexaltrix'
							) }
							value={ failedMessage }
							data={ {
								value: failedMessage,
								label: 'failedMessage',
							} }
							onChange={ ( value ) =>
								setAttributes( {
									failedMessage: value,
								} )
							}
						/>
					</>
				) }
				{ 'url' === confirmationType && (
					<UAGTextControl
						label={ __( 'Success Redirect URL', 'vexaltrix' ) }
						help={ __(
							'Enter a URL you want to redirect your page to after form Submission',
							'vexaltrix'
						) }
						value={ confirmationUrl }
						data={ {
							value: confirmationUrl,
							label: 'confirmationUrl',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) =>
							setAttributes( {
								confirmationUrl: value,
							} )
						}
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const successMessageStyle = () =>
		'message' === confirmationType && (
			<>
				<AdvancedPopColorControl
					label={ __( 'Text Color', 'vexaltrix' ) }
					colorValue={ successMessageTextColor ? successMessageTextColor : '' }
					data={ {
						value: successMessageTextColor,
						label: 'successMessageTextColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Background Color', 'vexaltrix' ) }
					colorValue={ successMessageBGColor ? successMessageBGColor : '' }
					data={ {
						value: successMessageBGColor,
						label: 'successMessageBGColor',
					} }
					setAttributes={ setAttributes }
				/>
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'successMsg' }
					disabledBorderTitle={ false }
					attributes={ attributes }
					deviceType={ deviceType }
					disableBottomSeparator={ true }
				/>
			</>
		);
	const failedMessageStyle = () =>
		'message' === confirmationType && (
			<>
				<AdvancedPopColorControl
					label={ __( 'Text Color', 'vexaltrix' ) }
					colorValue={ failedMessageTextColor ? failedMessageTextColor : '' }
					data={ {
						value: failedMessageTextColor,
						label: 'failedMessageTextColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Background Color', 'vexaltrix' ) }
					colorValue={ failedMessageBGColor ? failedMessageBGColor : '' }
					data={ {
						value: failedMessageBGColor,
						label: 'failedMessageBGColor',
					} }
					setAttributes={ setAttributes }
				/>
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'errorMsg' }
					disabledBorderTitle={ false }
					attributes={ attributes }
					deviceType={ deviceType }
					disableBottomSeparator={ true }
				/>
			</>
		);

	const afterSubmitActions = () => {
		return (
			<UAGAdvancedPanelBody
				title={ __( 'Actions', 'vexaltrix' ) }
				initialOpen={ false }
				className="vxt_ultimate_gutenberg_blocks__url-panel-body"
			>
				<p className="vxt-form-notice">
					{ __(
						'Note: Enter an e-mail address to receive submissions. Defaults to the site e-mail address.',
						'vexaltrix'
					) }
				</p>
				<UAGTabsControl
					tabs={ [
						{
							name: 'to',
							title: __( 'To', 'vexaltrix' ),
						},
						{
							name: 'cc',
							title: __( 'CC', 'vexaltrix' ),
						},
						{
							name: 'bcc',
							title: __( 'BCC', 'vexaltrix' ),
						},
					] }
					to={
						<UAGTextControl
							label={ __( 'Email Address', 'vexaltrix' ) }
							placeholder={ __( 'Email', 'vexaltrix' ) }
							value={ afterSubmitToEmail }
							data={ {
								value: afterSubmitToEmail,
								label: 'afterSubmitToEmail',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) =>
								setAttributes( {
									afterSubmitToEmail: value,
								} )
							}
						/>
					}
					cc={
						<UAGTextControl
							label={ __( 'Email Address', 'vexaltrix' ) }
							placeholder={ __( 'Email', 'vexaltrix' ) }
							value={ afterSubmitCcEmail }
							data={ {
								value: afterSubmitCcEmail,
								label: 'afterSubmitCcEmail',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) =>
								setAttributes( {
									afterSubmitCcEmail: value,
								} )
							}
						/>
					}
					bcc={
						<UAGTextControl
							label={ __( 'Email Address', 'vexaltrix' ) }
							placeholder={ __( 'Email', 'vexaltrix' ) }
							value={ afterSubmitBccEmail }
							data={ {
								value: afterSubmitBccEmail,
								label: 'afterSubmitBccEmail',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) =>
								setAttributes( {
									afterSubmitBccEmail: value,
								} )
							}
						/>
					}
					disableBottomSeparator={ false }
				/>
				<UAGTextControl
					label={ __( 'Subject', 'vexaltrix' ) }
					placeholder={ __( 'Subject', 'vexaltrix' ) }
					value={ afterSubmitEmailSubject }
					data={ {
						value: afterSubmitEmailSubject,
						label: 'afterSubmitEmailSubject',
					} }
					setAttributes={ setAttributes }
					onChange={ ( value ) =>
						setAttributes( {
							afterSubmitEmailSubject: value,
						} )
					}
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const labelStyling = () => (
		<UAGAdvancedPanelBody title={ __( 'Label', 'vexaltrix' ) } initialOpen={ true }>
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
							colorValue={ labelColor ? labelColor : '' }
							data={ {
								value: labelColor,
								label: 'labelColor',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				}
				hover={
					<>
						<AdvancedPopColorControl
							label={ __( 'Color', 'vexaltrix' ) }
							colorValue={ labelHoverColor ? labelHoverColor : '' }
							data={ {
								value: labelHoverColor,
								label: 'labelHoverColor',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				}
			/>
			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				attributes={ attributes }
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: labelloadGoogleFonts,
					label: 'labelloadGoogleFonts',
				} }
				fontFamily={ {
					value: labelFontFamily,
					label: 'labelFontFamily',
				} }
				fontWeight={ {
					value: labelFontWeight,
					label: 'labelFontWeight',
				} }
				fontStyle={ {
					value: labelFontStyle,
					label: 'labelFontStyle',
				} }
				fontSizeType={ {
					value: labelFontSizeType,
					label: 'labelFontSizeType',
				} }
				fontSize={ {
					value: labelFontSize,
					label: 'labelFontSize',
				} }
				fontSizeMobile={ {
					value: labelFontSizeMobile,
					label: 'labelFontSizeMobile',
				} }
				fontSizeTablet={ {
					value: labelFontSizeTablet,
					label: 'labelFontSizeTablet',
				} }
				lineHeightType={ {
					value: labelLineHeightType,
					label: 'labelLineHeightType',
				} }
				lineHeight={ {
					value: labelLineHeight,
					label: 'labelLineHeight',
				} }
				lineHeightMobile={ {
					value: labelLineHeightMobile,
					label: 'labelLineHeightMobile',
				} }
				lineHeightTablet={ {
					value: labelLineHeightTablet,
					label: 'labelLineHeightTablet',
				} }
				letterSpacing={ {
					value: labelLetterSpacing,
					label: 'labelLetterSpacing',
				} }
				letterSpacingTablet={ {
					value: labelLetterSpacingTablet,
					label: 'labelLetterSpacingTablet',
				} }
				letterSpacingMobile={ {
					value: labelLetterSpacingMobile,
					label: 'labelLetterSpacingMobile',
				} }
				letterSpacingType={ {
					value: labelLetterSpacingType,
					label: 'labelLetterSpacingType',
				} }
				transform={ {
					value: labelTransform,
					label: 'labelTransform',
				} }
				decoration={ {
					value: labelDecoration,
					label: 'labelDecoration',
				} }
			/>
			<ResponsiveSlider
				label={ __( 'Row Spacing', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: fieldGap,
						label: 'fieldGap',
					},
					tablet: {
						value: fieldGapTablet,
						label: 'fieldGapTablet',
					},
					mobile: {
						value: fieldGapMobile,
						label: 'fieldGapMobile',
					},
				} }
				min={ 0 }
				max={ 100 }
				unit={ {
					value: fieldGapType,
					label: 'fieldGapType',
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
					{
						name: __( 'em', 'vexaltrix' ),
						unitValue: 'em',
					},
				] }
				setAttributes={ setAttributes }
			/>
			<ResponsiveSlider
				label={ __( 'Label Bottom Margin', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: labelGap,
						label: 'labelGap',
					},
					tablet: {
						value: labelGapTablet,
						label: 'labelGapTablet',
					},
					mobile: {
						value: labelGapMobile,
						label: 'labelGapMobile',
					},
				} }
				min={ 0 }
				max={ 100 }
				unit={ {
					value: labelGapUnit,
					label: 'labelGapUnit',
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
					{
						name: __( 'em', 'vexaltrix' ),
						unitValue: 'em',
					},
				] }
				setAttributes={ setAttributes }
			/>
		</UAGAdvancedPanelBody>
	);

	const inputStyling = () => (
		<UAGAdvancedPanelBody
			title={ __( 'Input', 'vexaltrix' ) }
			// If displayLabels is false, this panel would be shown first and hence it's initialOpen should be set to true.
			initialOpen={ ! displayLabels }
		>
			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ inputColor ? inputColor : '' }
				data={ {
					value: inputColor,
					label: 'inputColor',
				} }
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
					{
						name: 'active',
						title: __( 'Active', 'vexaltrix' ),
					},
				] }
				normal={
					<>
						<AdvancedPopColorControl
							label={ __( 'Placeholder Color', 'vexaltrix' ) }
							colorValue={ inputplaceholderColor ? inputplaceholderColor : '' }
							data={ {
								value: inputplaceholderColor,
								label: 'inputplaceholderColor',
							} }
							setAttributes={ setAttributes }
						/>
						{ 'underlined' !== formStyle && (
							<AdvancedPopColorControl
								label={ __( 'Background Color', 'vexaltrix' ) }
								colorValue={ bgColor ? bgColor : '' }
								data={ {
									value: bgColor,
									label: 'bgColor',
								} }
								setAttributes={ setAttributes }
							/>
						) }
					</>
				}
				hover={
					<>
						<AdvancedPopColorControl
							label={ __( 'Placeholder Color', 'vexaltrix' ) }
							colorValue={ inputplaceholderHoverColor ? inputplaceholderHoverColor : '' }
							data={ {
								value: inputplaceholderHoverColor,
								label: 'inputplaceholderHoverColor',
							} }
							setAttributes={ setAttributes }
						/>
						{ 'underlined' !== formStyle && (
							<AdvancedPopColorControl
								label={ __( 'Background Color', 'vexaltrix' ) }
								colorValue={ bgHoverColor ? bgHoverColor : '' }
								data={ {
									value: bgHoverColor,
									label: 'bgHoverColor',
								} }
								setAttributes={ setAttributes }
							/>
						) }
					</>
				}
				active={
					<>
						<AdvancedPopColorControl
							label={ __( 'Placeholder Color', 'vexaltrix' ) }
							colorValue={ inputplaceholderActiveColor ? inputplaceholderActiveColor : '' }
							data={ {
								value: inputplaceholderActiveColor,
								label: 'inputplaceholderActiveColor',
							} }
							setAttributes={ setAttributes }
						/>
						{ 'underlined' !== formStyle && (
							<AdvancedPopColorControl
								label={ __( 'Background Color', 'vexaltrix' ) }
								colorValue={ bgActiveColor ? bgActiveColor : '' }
								data={ {
									value: bgActiveColor,
									label: 'bgActiveColor',
								} }
								setAttributes={ setAttributes }
							/>
						) }
					</>
				}
				disableBottomSeparator={ false }
			/>
			<ResponsiveBorder
				setAttributes={ setAttributes }
				prefix={ 'field' }
				disabledBorderTitle={ false }
				attributes={ attributes }
				deviceType={ deviceType }
			/>
			<SpacingControl
				{ ...props }
				label={ __( 'Input Padding', 'vexaltrix' ) }
				valueTop={ {
					value: paddingFieldTop,
					label: 'paddingFieldTop',
				} }
				valueRight={ {
					value: paddingFieldRight,
					label: 'paddingFieldRight',
				} }
				valueBottom={ {
					value: paddingFieldBottom,
					label: 'paddingFieldBottom',
				} }
				valueLeft={ {
					value: paddingFieldLeft,
					label: 'paddingFieldLeft',
				} }
				valueTopTablet={ {
					value: paddingFieldTopTablet,
					label: 'paddingFieldTopTablet',
				} }
				valueRightTablet={ {
					value: paddingFieldRightTablet,
					label: 'paddingFieldRightTablet',
				} }
				valueBottomTablet={ {
					value: paddingFieldBottomTablet,
					label: 'paddingFieldBottomTablet',
				} }
				valueLeftTablet={ {
					value: paddingFieldLeftTablet,
					label: 'paddingFieldLeftTablet',
				} }
				valueTopMobile={ {
					value: paddingFieldTopMobile,
					label: 'paddingFieldTopMobile',
				} }
				valueRightMobile={ {
					value: paddingFieldRightMobile,
					label: 'paddingFieldRightMobile',
				} }
				valueBottomMobile={ {
					value: paddingFieldBottomMobile,
					label: 'paddingFieldBottomMobile',
				} }
				valueLeftMobile={ {
					value: paddingFieldLeftMobile,
					label: 'paddingFieldLeftMobile',
				} }
				unit={ {
					value: paddingFieldUnit,
					label: 'paddingFieldUnit',
				} }
				mUnit={ {
					value: paddingFieldUnitmobile,
					label: 'paddingFieldUnitmobile',
				} }
				tUnit={ {
					value: paddingFieldUnitTablet,
					label: 'paddingFieldUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: paddingFieldLink,
					label: 'paddingFieldLink',
				} }
			/>
			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				attributes={ attributes }
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: inputloadGoogleFonts,
					label: 'inputloadGoogleFonts',
				} }
				fontFamily={ {
					value: inputFontFamily,
					label: 'inputFontFamily',
				} }
				fontWeight={ {
					value: inputFontWeight,
					label: 'inputFontWeight',
				} }
				fontStyle={ {
					value: inputFontStyle,
					label: 'inputFontStyle',
				} }
				fontSizeType={ {
					value: inputFontSizeType,
					label: 'inputFontSizeType',
				} }
				fontSize={ {
					value: inputFontSize,
					label: 'inputFontSize',
				} }
				fontSizeMobile={ {
					value: inputFontSizeMobile,
					label: 'inputFontSizeMobile',
				} }
				fontSizeTablet={ {
					value: inputFontSizeTablet,
					label: 'inputFontSizeTablet',
				} }
				lineHeightType={ {
					value: inputLineHeightType,
					label: 'inputLineHeightType',
				} }
				lineHeight={ {
					value: inputLineHeight,
					label: 'inputLineHeight',
				} }
				lineHeightMobile={ {
					value: inputLineHeightMobile,
					label: 'inputLineHeightMobile',
				} }
				lineHeightTablet={ {
					value: inputLineHeightTablet,
					label: 'inputLineHeightTablet',
				} }
				letterSpacing={ {
					value: inputLetterSpacing,
					label: 'inputLetterSpacing',
				} }
				letterSpacingTablet={ {
					value: inputLetterSpacingTablet,
					label: 'inputLetterSpacingTablet',
				} }
				letterSpacingMobile={ {
					value: inputLetterSpacingMobile,
					label: 'inputLetterSpacingMobile',
				} }
				letterSpacingType={ {
					value: inputLetterSpacingType,
					label: 'inputLetterSpacingType',
				} }
				transform={ {
					value: inputTransform,
					label: 'inputTransform',
				} }
				decoration={ {
					value: inputDecoration,
					label: 'inputDecoration',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const elementStyling = () => (
		<UAGAdvancedPanelBody
			title={ __( 'Checkbox/Toggle/Radio', 'vexaltrix' ) }
			initialOpen={ false }
			// className="vxt_ultimate_gutenberg_blocks__url-panel-body"
		>
			<ResponsiveSlider
				label={ __( 'Checkbox/Radio Size', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: toggleSize,
						label: 'toggleSize',
					},
					tablet: {
						value: toggleSizeTablet,
						label: 'toggleSizeTablet',
					},
					mobile: {
						value: toggleSizeMobile,
						label: 'toggleSizeMobile',
					},
				} }
				min={ 0 }
				max={ 50 }
				unit={ {
					value: toggleSizeType,
					label: 'toggleSizeType',
				} }
				setAttributes={ setAttributes }
			/>
			<ResponsiveSlider
				label={ __( 'Toggle Size', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: toggleWidthSize,
						label: 'toggleWidthSize',
					},
					tablet: {
						value: toggleWidthSizeTablet,
						label: 'toggleWidthSizeTablet',
					},
					mobile: {
						value: toggleWidthSizeMobile,
						label: 'toggleWidthSizeMobile',
					},
				} }
				min={ 0 }
				max={ 50 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
			<p className="vxt-form-notice">
				{ __(
					'Note: It is required to set border style and border width for toggle. Else you will not able to resize the toggle.',
					'vexaltrix'
				) }
			</p>
			<UAGTabsControl
				tabs={ [
					{
						name: 'normal',
						title: __( 'Normal', 'vexaltrix' ),
					},
					{
						name: 'active',
						title: __( 'Active', 'vexaltrix' ),
					},
				] }
				normal={
					<>
						<AdvancedPopColorControl
							label={ __( 'Background Color', 'vexaltrix' ) }
							colorValue={ toggleColor ? toggleColor : '' }
							data={ {
								value: toggleColor,
								label: 'toggleColor',
							} }
							setAttributes={ setAttributes }
						/>
						<AdvancedPopColorControl
							label={ __( 'Element Color', 'vexaltrix' ) }
							colorValue={ toggleDotColor ? toggleDotColor : '' }
							data={ {
								value: toggleDotColor,
								label: 'toggleDotColor',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				}
				active={
					<>
						<AdvancedPopColorControl
							label={ __( 'Background Color', 'vexaltrix' ) }
							colorValue={ toggleActiveColor ? toggleActiveColor : '' }
							data={ {
								value: toggleActiveColor,
								label: 'toggleActiveColor',
							} }
							setAttributes={ setAttributes }
						/>
						<AdvancedPopColorControl
							label={ __( 'Element Color', 'vexaltrix' ) }
							colorValue={ toggleDotActiveColor ? toggleDotActiveColor : '' }
							data={ {
								value: toggleDotActiveColor,
								label: 'toggleDotActiveColor',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				}
				disableBottomSeparator={ false }
			/>
			<ResponsiveBorder
				setAttributes={ setAttributes }
				prefix={ 'checkBoxToggle' }
				disabledBorderTitle={ false }
				attributes={ attributes }
				deviceType={ deviceType }
				borderHoverColorLabel={ __( 'Color', 'vexaltrix' ) }
				hoverTabLabel={ __( 'Active', 'vexaltrix' ) }
				disableBottomSeparator={ true }
				borderRadiusHelp={ __(
					'Border radius will be applied to Radio & Toggle only when the layout for those blocks is set to Square.',
					'vexaltrix'
				) }
			/>
		</UAGAdvancedPanelBody>
	);

	const submitStyling = () => (
		<UAGAdvancedPanelBody
			title={ __( 'Submit Button', 'vexaltrix' ) }
			initialOpen={ false }
			// className="vxt_ultimate_gutenberg_blocks__url-panel-body"
		>
			{ ! inheritFromTheme && (
				<>
					<UAGSelectControl
						label={ __( 'Button Size', 'vexaltrix' ) }
						data={ {
							value: buttonSize,
							label: 'buttonSize',
						} }
						setAttributes={ setAttributes }
						options={ [
							{
								value: 'default',
								label: __( 'Default', 'vexaltrix' ),
							},
							{
								value: 'small',
								label: __( 'Small', 'vexaltrix' ),
							},
							{
								value: 'medium',
								label: __( 'Medium', 'vexaltrix' ),
							},
							{
								value: 'large',
								label: __( 'Large', 'vexaltrix' ),
							},
							{
								value: 'extralarge',
								label: __( 'Extra Large', 'vexaltrix' ),
							},
							{
								value: 'full',
								label: __( 'Full', 'vexaltrix' ),
							},
						] }
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
									label={ __( 'Color', 'vexaltrix' ) }
									colorValue={ submitColor ? submitColor : '' }
									data={ {
										value: submitColor,
										label: 'submitColor',
									} }
									setAttributes={ setAttributes }
								/>
								<MultiButtonsControl
									setAttributes={ setAttributes }
									label={ __( 'Background Type', 'vexaltrix' ) }
									data={ {
										value: submitBgType,
										label: 'submitBgType',
									} }
									className="vxt-multi-button-alignment-control"
									options={ [
										{
											value: 'transparent',
											label: __( 'Transparent', 'vexaltrix' ),
										},
										{
											value: 'color',
											label: __( 'Color', 'vexaltrix' ),
										},
										{
											value: 'gradient',
											label: __( 'Gradient', 'vexaltrix' ),
										},
									] }
								/>
								{ submitBgType === 'color' && (
									<AdvancedPopColorControl
										label={ __( 'Background Color', 'vexaltrix' ) }
										colorValue={ submitBgColor ? submitBgColor : '' }
										data={ {
											value: submitBgColor,
											label: 'submitBgColor',
										} }
										setAttributes={ setAttributes }
									/>
								) }
								{ 'gradient' === submitBgType && (
									<GradientSettings
										backgroundGradient={ {
											value: gradientValue,
											label: 'gradientValue',
										} }
										backgroundGradientColor1={ {
											value: gradientColor1,
											label: 'gradientColor1',
										} }
										gradientType={ {
											value: selectGradient,
											label: 'selectGradient',
										} }
										backgroundGradientColor2={ {
											value: gradientColor2,
											label: 'gradientColor2',
										} }
										backgroundGradientLocation1={ {
											value: gradientLocation1,
											label: 'gradientLocation1',
										} }
										backgroundGradientLocationTablet1={ {
											value: gradientLocationTablet1,
											label: 'gradientLocationTablet1',
										} }
										backgroundGradientLocationMobile1={ {
											value: gradientLocationMobile1,
											label: 'gradientLocationMobile1',
										} }
										backgroundGradientLocation2={ {
											value: gradientLocation2,
											label: 'gradientLocation2',
										} }
										backgroundGradientLocationTablet2={ {
											value: gradientLocationTablet2,
											label: 'gradientLocationTablet2',
										} }
										backgroundGradientLocationMobile2={ {
											value: gradientLocationMobile2,
											label: 'gradientLocationMobile2',
										} }
										backgroundGradientType={ {
											value: gradientType,
											label: 'gradientType',
										} }
										backgroundGradientAngle={ {
											value: gradientAngle,
											label: 'gradientAngle',
										} }
										backgroundGradientAngleTablet={ {
											value: gradientAngleTablet,
											label: 'gradientAngleTablet',
										} }
										backgroundGradientAngleMobile={ {
											value: gradientAngleMobile,
											label: 'gradientAngleMobile',
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
									colorValue={ submitColorHover ? submitColorHover : '' }
									data={ {
										value: submitColorHover,
										label: 'submitColorHover',
									} }
									setAttributes={ setAttributes }
								/>
								<MultiButtonsControl
									setAttributes={ setAttributes }
									label={ __( 'Background Type', 'vexaltrix' ) }
									data={ {
										value: submitBgHoverType,
										label: 'submitBgHoverType',
									} }
									className="vxt-multi-button-alignment-control"
									options={ [
										{
											value: 'transparent',
											label: __( 'Transparent', 'vexaltrix' ),
										},
										{
											value: 'color',
											label: __( 'Color', 'vexaltrix' ),
										},
										{
											value: 'gradient',
											label: __( 'Gradient', 'vexaltrix' ),
										},
									] }
								/>
								{ submitBgHoverType === 'color' && (
									<AdvancedPopColorControl
										label={ __( 'Background Color', 'vexaltrix' ) }
										colorValue={ submitBgColorHover ? submitBgColorHover : '' }
										data={ {
											value: submitBgColorHover,
											label: 'submitBgColorHover',
										} }
										setAttributes={ setAttributes }
									/>
								) }
								{ 'gradient' === submitBgHoverType && (
									<GradientSettings
										backgroundGradient={ {
											value: gradientHValue,
											label: 'gradientHValue',
										} }
										backgroundGradientColor1={ {
											value: gradientHColor1,
											label: 'gradientHColor1',
										} }
										gradientType={ {
											value: selectHGradient,
											label: 'selectHGradient',
										} }
										backgroundGradientColor2={ {
											value: gradientHColor2,
											label: 'gradientHColor2',
										} }
										backgroundGradientLocation1={ {
											value: gradientHLocation1,
											label: 'gradientHLocation1',
										} }
										backgroundGradientLocationTablet1={ {
											value: gradientHLocationTablet1,
											label: 'gradientHLocationTablet1',
										} }
										backgroundGradientLocationMobile1={ {
											value: gradientHLocationMobile1,
											label: 'gradientHLocationMobile1',
										} }
										backgroundGradientLocation2={ {
											value: gradientHLocation2,
											label: 'gradientHLocation2',
										} }
										backgroundGradientLocationTablet2={ {
											value: gradientHLocationTablet2,
											label: 'gradientHLocationTablet2',
										} }
										backgroundGradientLocationMobile2={ {
											value: gradientHLocationMobile2,
											label: 'gradientHLocationMobile2',
										} }
										backgroundGradientType={ {
											value: gradientHType,
											label: 'gradientHType',
										} }
										backgroundGradientAngle={ {
											value: gradientHAngle,
											label: 'gradientHAngle',
										} }
										backgroundGradientAngleTablet={ {
											value: gradientHAngleTablet,
											label: 'gradientHAngleTablet',
										} }
										backgroundGradientAngleMobile={ {
											value: gradientHAngleMobile,
											label: 'gradientHAngleMobile',
										} }
										setAttributes={ setAttributes }
									/>
								) }
							</>
						}
					/>
					<TypographyControl
						label={ __( 'Typography', 'vexaltrix' ) }
						attributes={ attributes }
						setAttributes={ setAttributes }
						loadGoogleFonts={ {
							value: submitTextloadGoogleFonts,
							label: 'submitTextloadGoogleFonts',
						} }
						fontFamily={ {
							value: submitTextFontFamily,
							label: 'submitTextFontFamily',
						} }
						fontWeight={ {
							value: submitTextFontWeight,
							label: 'submitTextFontWeight',
						} }
						fontStyle={ {
							value: submitTextFontStyle,
							label: 'submitTextFontStyle',
						} }
						fontSizeType={ {
							value: submitTextFontSizeType,
							label: 'submitTextFontSizeType',
						} }
						fontSize={ {
							value: submitTextFontSize,
							label: 'submitTextFontSize',
						} }
						fontSizeMobile={ {
							value: submitTextFontSizeMobile,
							label: 'submitTextFontSizeMobile',
						} }
						fontSizeTablet={ {
							value: submitTextFontSizeTablet,
							label: 'submitTextFontSizeTablet',
						} }
						lineHeightType={ {
							value: submitTextLineHeightType,
							label: 'submitTextLineHeightType',
						} }
						lineHeight={ {
							value: submitTextLineHeight,
							label: 'submitTextLineHeight',
						} }
						lineHeightMobile={ {
							value: submitTextLineHeightMobile,
							label: 'submitTextLineHeightMobile',
						} }
						lineHeightTablet={ {
							value: submitTextLineHeightTablet,
							label: 'submitTextLineHeightTablet',
						} }
						letterSpacing={ {
							value: submitTextLetterSpacing,
							label: 'submitTextLetterSpacing',
						} }
						letterSpacingTablet={ {
							value: submitTextLetterSpacingTablet,
							label: 'submitTextLetterSpacingTablet',
						} }
						letterSpacingMobile={ {
							value: submitTextLetterSpacingMobile,
							label: 'submitTextLetterSpacingMobile',
						} }
						letterSpacingType={ {
							value: submitTextLetterSpacingType,
							label: 'submitTextLetterSpacingType',
						} }
						transform={ {
							value: submitTextTransform,
							label: 'submitTextTransform',
						} }
						decoration={ {
							value: submitTextDecoration,
							label: 'submitTextDecoration',
						} }
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
							value: paddingspacingLink,
							label: 'paddingspacingLink',
						} }
					/>
					<ResponsiveBorder
						setAttributes={ setAttributes }
						prefix={ 'btn' }
						disabledBorderTitle={ false }
						attributes={ attributes }
						deviceType={ deviceType }
						disableBottomSeparator={ true }
					/>
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const messageStyling = () => (
		<UAGAdvancedPanelBody
			title={ __( 'Messages', 'vexaltrix' ) }
			initialOpen={ false }
			// className="vxt_ultimate_gutenberg_blocks__url-panel-body"
		>
			<UAGTabsControl
				tabs={ [
					{
						name: 'success',
						title: __( 'Success', 'vexaltrix' ),
					},
					{
						name: 'error',
						title: __( 'Error', 'vexaltrix' ),
					},
				] }
				success={ successMessageStyle() }
				error={ failedMessageStyle() }
				disableBottomSeparator={ true }
			/>
		</UAGAdvancedPanelBody>
	);

	const spaceStyling = () => (
		<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
			<SpacingControl
				{ ...props }
				label={ __( 'Form Padding', 'vexaltrix' ) }
				valueTop={ {
					value: formPaddingTop,
					label: 'formPaddingTop',
				} }
				valueRight={ {
					value: formPaddingRight,
					label: 'formPaddingRight',
				} }
				valueBottom={ {
					value: formPaddingBottom,
					label: 'formPaddingBottom',
				} }
				valueLeft={ {
					value: formPaddingLeft,
					label: 'formPaddingLeft',
				} }
				valueTopTablet={ {
					value: formPaddingTopTab,
					label: 'formPaddingTopTab',
				} }
				valueRightTablet={ {
					value: formPaddingRightTab,
					label: 'formPaddingRightTab',
				} }
				valueBottomTablet={ {
					value: formPaddingBottomTab,
					label: 'formPaddingBottomTab',
				} }
				valueLeftTablet={ {
					value: formPaddingLeftTab,
					label: 'formPaddingLeftTab',
				} }
				valueTopMobile={ {
					value: formPaddingTopMob,
					label: 'formPaddingTopMob',
				} }
				valueRightMobile={ {
					value: formPaddingRightMob,
					label: 'formPaddingRightMob',
				} }
				valueBottomMobile={ {
					value: formPaddingBottomMob,
					label: 'formPaddingBottomMob',
				} }
				valueLeftMobile={ {
					value: formPaddingLeftMob,
					label: 'formPaddingLeftMob',
				} }
				unit={ {
					value: formPaddingUnit,
					label: 'formPaddingUnit',
				} }
				tUnit={ {
					value: formPaddingUnitTab,
					label: 'formPaddingUnitTab',
				} }
				mUnit={ {
					value: formPaddingUnitMob,
					label: 'formPaddingUnitMob',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: formPaddingLink,
					label: 'formPaddingLink',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const googleReCaptcha = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Google reCAPTCHA', 'vexaltrix' ) } initialOpen={ false }>
				<p className="vxt-form-notice">
					{ __(
						'P.S. Note that If you are using two forms on the same page with the different reCAPTCHA versions (V2 checkbox and V3), it will create conflicts between the versions. Kindly avoid using different versions on same page.',
						'vexaltrix'
					) }
				</p>
				<ToggleControl
					label={ __( 'Enable reCAPTCHA', 'vexaltrix' ) }
					checked={ reCaptchaEnable }
					onChange={ () =>
						setAttributes( {
							reCaptchaEnable: ! reCaptchaEnable,
						} )
					}
				/>
				{ reCaptchaEnable && (
					<>
						<p className="vxt-form-notice">
							{ __( 'Please configure the Google reCAPTCHA Site & Secret key from', 'vexaltrix' ) }
							<a
								target="_blank"
								href={ `${ vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_home_url }/wp-admin/admin.php?page=vexaltrix&path=settings&settings=block-settings` }
								rel="noreferrer"
							>
								{ __( 'here.', 'vexaltrix' ) }
							</a>
						</p>
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'Select Version', 'vexaltrix' ) }
							data={ {
								value: reCaptchaType,
								label: 'reCaptchaType',
							} }
							className="vxt-multi-button-alignment-control"
							options={ [
								{
									value: 'v2',
									label: 'V2',
									tooltip: __( 'V2', 'vexaltrix' ),
								},
								{
									value: 'v3',
									label: 'V3',
									tooltip: __( 'V3', 'vexaltrix' ),
								},
							] }
							showIcons={ false }
						/>
					</>
				) }
				{ reCaptchaEnable && 'v3' === reCaptchaType && (
					<ToggleControl
						label={ __( 'Hide reCAPTCHA Badge', 'vexaltrix' ) }
						checked={ hidereCaptchaBatch }
						onChange={ () =>
							setAttributes( {
								hidereCaptchaBatch: ! hidereCaptchaBatch,
							} )
						}
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	return (
		<>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ generalSettings() }
						{ submitGeneral() }
						{ afterSubmitActions() }
						{ googleReCaptcha() }
						{ presetSettings() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ displayLabels && labelStyling() }
						{ inputStyling() }
						{ elementStyling() }
						{ ! inheritFromTheme && submitStyling() }
						{ messageStyling() }
						{ spaceStyling() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};

export default memo( Settings );
