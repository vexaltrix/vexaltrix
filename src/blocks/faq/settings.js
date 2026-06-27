/**
 * BLOCK: FAQ
 */
import { memo } from '@wordpress/element';
import renderSVG from '@Controls/renderIcon';
import TypographyControl from '@Components/typography';
import ResponsiveSlider from '@Components/responsive-slider';
import MultiButtonsControl from '@Components/multi-buttons-control';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import SpacingControl from '@Components/spacing-control';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import { __ } from '@wordpress/i18n';
import ResponsiveBorder from '@Components/responsive-border';
import { select } from '@wordpress/data';
import UAGIconPicker from '@Components/icon-picker';
import UAGTabsControl from '@Components/tabs';

import { InspectorControls } from '@wordpress/block-editor';

import { ToggleControl, Icon } from '@wordpress/components';
import presets from './presets';
import UAGPresets from '@Components/presets';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';

const Settings = ( props ) => {
	const { attributes, setAttributes, deviceType, clientId } = props;
	const {
		layout,
		inactiveOtherItems,
		expandFirstItem,
		enableSchemaSupport,
		rowsGap,
		rowsGapTablet,
		rowsGapMobile,
		rowsGapUnit,
		columnsGap,
		columnsGapTablet,
		columnsGapMobile,
		columnsGapUnit,
		align,
		enableSeparator,
		boxBgType,
		boxBgHoverType,
		boxBgColor,
		questionTextColor,
		questionTextBgColor,
		questionTextActiveColor,
		questionTextActiveBgColor,
		questionPaddingTypeDesktop,
		questionPaddingTypeMobile,
		questionPaddingTypeTablet,
		answerTextColor,
		answerPaddingTypeDesktop,
		answerPaddingTypeMobile,
		answerPaddingTypeTablet,
		iconColor,
		iconActiveColor,
		gapBtwIconQUestion,
		gapBtwIconQUestionTablet,
		gapBtwIconQUestionMobile,
		questionloadGoogleFonts,
		questionFontFamily,
		questionFontWeight,
		questionFontSizeType,
		questionFontSize,
		questionFontSizeMobile,
		questionFontSizeTablet,
		questionLineHeightType,
		questionLineHeight,
		questionLineHeightMobile,
		questionLineHeightTablet,
		answerloadGoogleFonts,
		answerFontFamily,
		answerFontWeight,
		answerFontSizeType,
		answerFontSize,
		answerFontSizeMobile,
		answerFontSizeTablet,
		answerLineHeightType,
		answerLineHeight,
		answerLineHeightMobile,
		answerLineHeightTablet,
		icon,
		iconActive,
		iconAlign,
		iconSizeType,
		iconSizeMobile,
		iconSizeTablet,
		iconSize,
		columns,
		tcolumns,
		mcolumns,
		enableToggle,
		equalHeight,
		questionLeftPaddingTablet,
		hquestionPaddingTablet,
		vquestionPaddingTablet,
		questionBottomPaddingTablet,
		questionLeftPaddingDesktop,
		hquestionPaddingDesktop,
		vquestionPaddingDesktop,
		questionBottomPaddingDesktop,
		questionLeftPaddingMobile,
		hquestionPaddingMobile,
		vquestionPaddingMobile,
		questionBottomPaddingMobile,
		headingTag,
		answerSpacingLink,
		questionSpacingLink,
		answerTopPadding,
		answerRightPadding,
		answerBottomPadding,
		answerLeftPadding,
		answerTopPaddingTablet,
		answerRightPaddingTablet,
		answerBottomPaddingTablet,
		answerLeftPaddingTablet,
		answerTopPaddingMobile,
		answerRightPaddingMobile,
		answerBottomPaddingMobile,
		answerLeftPaddingMobile,
		answerFontStyle,
		answerTransform,
		answerDecoration,
		questionFontStyle,
		questionTransform,
		questionDecoration,
		// letter spacing
		questionLetterSpacing,
		questionLetterSpacingTablet,
		questionLetterSpacingMobile,
		questionLetterSpacingType,
		answerLetterSpacing,
		answerLetterSpacingTablet,
		answerLetterSpacingMobile,
		answerLetterSpacingType,
		boxBgHoverColor,
		iconBgColor,
		iconBgSize,
		iconBgSizeTablet,
		iconBgSizeMobile,
		iconBgSizeType,
		// padding
		blockTopPadding,
		blockRightPadding,
		blockLeftPadding,
		blockBottomPadding,
		blockTopPaddingTablet,
		blockRightPaddingTablet,
		blockLeftPaddingTablet,
		blockBottomPaddingTablet,
		blockTopPaddingMobile,
		blockRightPaddingMobile,
		blockLeftPaddingMobile,
		blockBottomPaddingMobile,
		blockPaddingUnit,
		blockPaddingUnitTablet,
		blockPaddingUnitMobile,
		blockPaddingLink,
		// margin
		blockTopMargin,
		blockRightMargin,
		blockLeftMargin,
		blockBottomMargin,
		blockTopMarginTablet,
		blockRightMarginTablet,
		blockLeftMarginTablet,
		blockBottomMarginTablet,
		blockTopMarginMobile,
		blockRightMarginMobile,
		blockLeftMarginMobile,
		blockBottomMarginMobile,
		blockMarginUnit,
		blockMarginUnitTablet,
		blockMarginUnitMobile,
		blockMarginLink,
	} = attributes;

	const onchangeIcon = ( value ) => {
		const getChildBlocks = select( 'core/block-editor' ).getBlocks( clientId );
		getChildBlocks.forEach( ( faqChild ) => {
			faqChild.attributes.icon = value;
		} );

		setAttributes( { icon: value } );
	};
	const onchangeActiveIcon = ( value ) => {
		const getChildBlocks = select( 'core/block-editor' ).getBlocks( clientId );

		getChildBlocks.forEach( ( faqChild ) => {
			faqChild.attributes.iconActive = value;
		} );

		setAttributes( { iconActive: value } );
	};
	const onchangeLayout = ( value ) => {
		const getChildBlocks = select( 'core/block-editor' ).getBlocks( clientId );

		getChildBlocks.forEach( ( faqChild ) => {
			faqChild.attributes.layout = value;
		} );

		setAttributes( { layout: value } );
	};
	const onchangeTag = ( value ) => {
		const getChildBlocks = select( 'core/block-editor' ).getBlocks( clientId );

		getChildBlocks.forEach( ( faqChild ) => {
			faqChild.attributes.headingTag = value;
		} );

		setAttributes( { headingTag: value } );
	};

	const faqGeneralSettings = () => {
		return (
			<UAGAdvancedPanelBody
				title={ __( 'General', 'vexaltrix' ) }
				initialOpen={ true }
				className="vxt_ultimate_gutenberg_blocks__url-panel-body"
			>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Layout', 'vexaltrix' ) }
					data={ {
						value: layout,
						label: 'layout',
					} }
					onChange={ onchangeLayout }
					options={ [
						{
							value: 'accordion',
							label: __( 'Accordion', 'vexaltrix' ),
						},
						{
							value: 'grid',
							label: __( 'Grid', 'vexaltrix' ),
						},
					] }
				/>
				{ 'accordion' === layout && (
					<>
						<ToggleControl
							label={ __( 'Collapse other items', 'vexaltrix' ) }
							checked={ inactiveOtherItems }
							onChange={ () =>
								setAttributes( {
									inactiveOtherItems: ! inactiveOtherItems,
								} )
							}
						/>
						{ true === inactiveOtherItems && (
							<ToggleControl
								label={ __( 'Expand First Item', 'vexaltrix' ) }
								checked={ expandFirstItem }
								onChange={ () =>
									setAttributes( {
										expandFirstItem: ! expandFirstItem,
									} )
								}
							/>
						) }
						<ToggleControl
							label={ __( 'Enable Toggle', 'vexaltrix' ) }
							checked={ enableToggle }
							onChange={ () =>
								setAttributes( {
									enableToggle: ! enableToggle,
								} )
							}
						/>
					</>
				) }
				<ToggleControl
					label={ __( 'Enable Schema Support', 'vexaltrix' ) }
					checked={ enableSchemaSupport }
					onChange={ () =>
						setAttributes( {
							enableSchemaSupport: ! enableSchemaSupport,
						} )
					}
				/>
				<ToggleControl
					label={ __( 'Enable Separator', 'vexaltrix' ) }
					checked={ enableSeparator }
					onChange={ () => setAttributes( { enableSeparator: ! enableSeparator } ) }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Question Tag', 'vexaltrix' ) }
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
						{
							value: 'span',
							label: __( 'Span', 'vexaltrix' ),
						},
						{
							value: 'p',
							label: __( 'P', 'vexaltrix' ),
						},
					] }
					onChange={ ( value ) => onchangeTag( value ) }
				/>
				{ 'grid' === layout && (
					<ResponsiveSlider
						label={ __( 'Columns', 'vexaltrix' ) }
						data={ {
							desktop: {
								value: columns,
								label: 'columns',
								min: 1,
								max: 6,
							},
							tablet: {
								value: tcolumns,
								label: 'tcolumns',
								min: 1,
								max: 4,
							},
							mobile: {
								value: mcolumns,
								label: 'mcolumns',
								min: 1,
								max: 2,
							},
						} }
						min={ 1 }
						max={ 6 }
						displayUnit={ false }
						setAttributes={ setAttributes }
					/>
				) }
				{ 'grid' === layout && (
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
			</UAGAdvancedPanelBody>
		);
	};

	const faqIconSettings = () => {
		return (
			<UAGAdvancedPanelBody
				title={ __( 'Icon', 'vexaltrix' ) }
				initialOpen={ false }
				className="vxt_ultimate_gutenberg_blocks__url-panel-body"
			>
				<UAGIconPicker
					label={ __( 'Inactive Icon', 'vexaltrix' ) }
					value={ icon }
					onChange={ ( value ) => onchangeIcon( value ) }
				/>
				<UAGIconPicker
					label={ __( 'Active Icon', 'vexaltrix' ) }
					value={ iconActive }
					onChange={ ( value ) => onchangeActiveIcon( value ) }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Icon Alignment', 'vexaltrix' ) }
					data={ {
						value: iconAlign,
						label: 'iconAlign',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: 'row',
							icon: <Icon icon={ renderSVG( 'fa fa-align-left' ) } />,
							tooltip: __( 'Left', 'vexaltrix' ),
						},
						{
							value: 'row-reverse',
							icon: <Icon icon={ renderSVG( 'fa fa-align-right' ) } />,
							tooltip: __( 'Right', 'vexaltrix' ),
						},
					] }
					showIcons={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const faqQuestionSettings = () => {
		return (
			<UAGAdvancedPanelBody
				title={ __( 'Question', 'vexaltrix' ) }
				initialOpen={ false }
				className="vxt_ultimate_gutenberg_blocks__url-panel-body"
			>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: questionloadGoogleFonts,
						label: 'questionloadGoogleFonts',
					} }
					fontFamily={ {
						value: questionFontFamily,
						label: 'questionFontFamily',
					} }
					fontWeight={ {
						value: questionFontWeight,
						label: 'questionFontWeight',
					} }
					fontStyle={ {
						value: questionFontStyle,
						label: 'questionFontStyle',
					} }
					transform={ {
						value: questionTransform,
						label: 'questionTransform',
					} }
					decoration={ {
						value: questionDecoration,
						label: 'questionDecoration',
					} }
					fontSizeType={ {
						value: questionFontSizeType,
						label: 'questionFontSizeType',
					} }
					fontSize={ {
						value: questionFontSize,
						label: 'questionFontSize',
					} }
					fontSizeMobile={ {
						value: questionFontSizeMobile,
						label: 'questionFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: questionFontSizeTablet,
						label: 'questionFontSizeTablet',
					} }
					lineHeightType={ {
						value: questionLineHeightType,
						label: 'questionLineHeightType',
					} }
					lineHeight={ {
						value: questionLineHeight,
						label: 'questionLineHeight',
					} }
					lineHeightMobile={ {
						value: questionLineHeightMobile,
						label: 'questionLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: questionLineHeightTablet,
						label: 'questionLineHeightTablet',
					} }
					letterSpacing={ {
						value: questionLetterSpacing,
						label: 'questionLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: questionLetterSpacingTablet,
						label: 'questionLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: questionLetterSpacingMobile,
						label: 'questionLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: questionLetterSpacingType,
						label: 'questionLetterSpacingType',
					} }
				/>
				{ 'accordion' === layout && (
					<UAGTabsControl
						tabs={ [
							{
								name: 'normal',
								title: __( 'Normal', 'vexaltrix' ),
							},
							{
								name: 'active',
								title: __( 'Active/Hover', 'vexaltrix' ),
							},
						] }
						normal={
							<>
								<AdvancedPopColorControl
									label={ __( 'Text Color', 'vexaltrix' ) }
									colorValue={ questionTextColor }
									data={ {
										value: questionTextColor,
										label: 'questionTextColor',
									} }
									setAttributes={ setAttributes }
								/>
								<AdvancedPopColorControl
									label={ __( 'Background Color', 'vexaltrix' ) }
									colorValue={ questionTextBgColor }
									data={ {
										value: questionTextBgColor,
										label: 'questionTextBgColor',
									} }
									setAttributes={ setAttributes }
								/>
							</>
						}
						active={
							<>
								<AdvancedPopColorControl
									label={ __( 'Text Color', 'vexaltrix' ) }
									colorValue={ questionTextActiveColor }
									data={ {
										value: questionTextActiveColor,
										label: 'questionTextActiveColor',
									} }
									setAttributes={ setAttributes }
								/>
								<AdvancedPopColorControl
									label={ __( 'Background Color', 'vexaltrix' ) }
									colorValue={ questionTextActiveBgColor }
									data={ {
										value: questionTextActiveBgColor,
										label: 'questionTextActiveBgColor',
									} }
									setAttributes={ setAttributes }
								/>
							</>
						}
					/>
				) }
				{ 'grid' === layout && (
					<>
						<AdvancedPopColorControl
							label={ __( 'Text Color', 'vexaltrix' ) }
							colorValue={ questionTextColor }
							data={ {
								value: questionTextColor,
								label: 'questionTextColor',
							} }
							setAttributes={ setAttributes }
						/>
						<AdvancedPopColorControl
							label={ __( 'Background Color', 'vexaltrix' ) }
							colorValue={ questionTextBgColor }
							data={ {
								value: questionTextBgColor,
								label: 'questionTextBgColor',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				) }
				<SpacingControl
					{ ...props }
					label={ __( 'Padding', 'vexaltrix' ) }
					valueTop={ {
						value: vquestionPaddingDesktop,
						label: 'vquestionPaddingDesktop',
					} }
					valueRight={ {
						value: hquestionPaddingDesktop,
						label: 'hquestionPaddingDesktop',
					} }
					valueBottom={ {
						value: questionBottomPaddingDesktop,
						label: 'questionBottomPaddingDesktop',
					} }
					valueLeft={ {
						value: questionLeftPaddingDesktop,
						label: 'questionLeftPaddingDesktop',
					} }
					valueTopTablet={ {
						value: vquestionPaddingTablet,
						label: 'vquestionPaddingTablet',
					} }
					valueRightTablet={ {
						value: hquestionPaddingTablet,
						label: 'hquestionPaddingTablet',
					} }
					valueBottomTablet={ {
						value: questionBottomPaddingTablet,
						label: 'questionBottomPaddingTablet',
					} }
					valueLeftTablet={ {
						value: questionLeftPaddingTablet,
						label: 'questionLeftPaddingTablet',
					} }
					valueTopMobile={ {
						value: vquestionPaddingMobile,
						label: 'vquestionPaddingMobile',
					} }
					valueRightMobile={ {
						value: hquestionPaddingMobile,
						label: 'hquestionPaddingMobile',
					} }
					valueBottomMobile={ {
						value: questionBottomPaddingMobile,
						label: 'questionBottomPaddingMobile',
					} }
					valueLeftMobile={ {
						value: questionLeftPaddingMobile,
						label: 'questionLeftPaddingMobile',
					} }
					unit={ {
						value: questionPaddingTypeDesktop,
						label: 'questionPaddingTypeDesktop',
					} }
					mUnit={ {
						value: questionPaddingTypeMobile,
						label: 'questionPaddingTypeMobile',
					} }
					tUnit={ {
						value: questionPaddingTypeTablet,
						label: 'questionPaddingTypeTablet',
					} }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: questionSpacingLink,
						label: 'questionSpacingLink',
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
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const faqAnswerSettings = () => {
		return (
			<UAGAdvancedPanelBody
				title={ __( 'Answer', 'vexaltrix' ) }
				initialOpen={ false }
				className="vxt_ultimate_gutenberg_blocks__url-panel-body"
			>
				<AdvancedPopColorControl
					label={ __( 'Text Color', 'vexaltrix' ) }
					colorValue={ answerTextColor }
					data={ {
						value: answerTextColor,
						label: 'answerTextColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: answerloadGoogleFonts,
						label: 'answerloadGoogleFonts',
					} }
					fontFamily={ {
						value: answerFontFamily,
						label: 'answerFontFamily',
					} }
					fontWeight={ {
						value: answerFontWeight,
						label: 'answerFontWeight',
					} }
					fontStyle={ {
						value: answerFontStyle,
						label: 'answerFontStyle',
					} }
					transform={ {
						value: answerTransform,
						label: 'answerTransform',
					} }
					decoration={ {
						value: answerDecoration,
						label: 'answerDecoration',
					} }
					fontSizeType={ {
						value: answerFontSizeType,
						label: 'answerFontSizeType',
					} }
					fontSize={ {
						value: answerFontSize,
						label: 'answerFontSize',
					} }
					fontSizeMobile={ {
						value: answerFontSizeMobile,
						label: 'answerFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: answerFontSizeTablet,
						label: 'answerFontSizeTablet',
					} }
					lineHeightType={ {
						value: answerLineHeightType,
						label: 'answerLineHeightType',
					} }
					lineHeight={ {
						value: answerLineHeight,
						label: 'answerLineHeight',
					} }
					lineHeightMobile={ {
						value: answerLineHeightMobile,
						label: 'answerLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: answerLineHeightTablet,
						label: 'answerLineHeightTablet',
					} }
					letterSpacing={ {
						value: answerLetterSpacing,
						label: 'answerLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: answerLetterSpacingTablet,
						label: 'answerLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: answerLetterSpacingMobile,
						label: 'answerLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: answerLetterSpacingType,
						label: 'answerLetterSpacingType',
					} }
				/>
				<SpacingControl
					{ ...props }
					label={ __( 'Padding', 'vexaltrix' ) }
					valueTop={ {
						value: answerTopPadding,
						label: 'answerTopPadding',
					} }
					valueRight={ {
						value: answerRightPadding,
						label: 'answerRightPadding',
					} }
					valueBottom={ {
						value: answerBottomPadding,
						label: 'answerBottomPadding',
					} }
					valueLeft={ {
						value: answerLeftPadding,
						label: 'answerLeftPadding',
					} }
					valueTopTablet={ {
						value: answerTopPaddingTablet,
						label: 'answerTopPaddingTablet',
					} }
					valueRightTablet={ {
						value: answerRightPaddingTablet,
						label: 'answerRightPaddingTablet',
					} }
					valueBottomTablet={ {
						value: answerBottomPaddingTablet,
						label: 'answerBottomPaddingTablet',
					} }
					valueLeftTablet={ {
						value: answerLeftPaddingTablet,
						label: 'answerLeftPaddingTablet',
					} }
					valueTopMobile={ {
						value: answerTopPaddingMobile,
						label: 'answerTopPaddingMobile',
					} }
					valueRightMobile={ {
						value: answerRightPaddingMobile,
						label: 'answerRightPaddingMobile',
					} }
					valueBottomMobile={ {
						value: answerBottomPaddingMobile,
						label: 'answerBottomPaddingMobile',
					} }
					valueLeftMobile={ {
						value: answerLeftPaddingMobile,
						label: 'answerLeftPaddingMobile',
					} }
					unit={ {
						value: answerPaddingTypeDesktop,
						label: 'answerPaddingTypeDesktop',
					} }
					mUnit={ {
						value: answerPaddingTypeMobile,
						label: 'answerPaddingTypeMobile',
					} }
					tUnit={ {
						value: answerPaddingTypeTablet,
						label: 'answerPaddingTypeTablet',
					} }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: answerSpacingLink,
						label: 'answerSpacingLink',
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
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const commonStyle = () => {
		return (
			<UAGAdvancedPanelBody
				title={ __( 'Container', 'vexaltrix' ) }
				initialOpen={ true }
				className="vxt_ultimate_gutenberg_blocks__url-panel-body"
			>
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
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Background Type', 'vexaltrix' ) }
								data={ {
									value: boxBgType,
									label: 'boxBgType',
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
								] }
							/>
							{ boxBgType === 'color' && (
								<AdvancedPopColorControl
									label={ __( 'Background Color', 'vexaltrix' ) }
									colorValue={ boxBgColor }
									data={ {
										value: boxBgColor,
										label: 'boxBgColor',
									} }
									setAttributes={ setAttributes }
								/>
							) }
						</>
					}
					hover={
						<>
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Background Type', 'vexaltrix' ) }
								data={ {
									value: boxBgHoverType,
									label: 'boxBgHoverType',
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
								] }
							/>
							{ boxBgHoverType === 'color' && (
								<AdvancedPopColorControl
									label={ __( 'Background Color', 'vexaltrix' ) }
									colorValue={ boxBgHoverColor }
									data={ {
										value: boxBgHoverColor,
										label: 'boxBgHoverColor',
									} }
									setAttributes={ setAttributes }
								/>
							) }
						</>
					}
				/>
				<ResponsiveSlider
					label={ __( 'Rows Gap', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: rowsGap,
							label: 'rowsGap',
						},
						tablet: {
							value: rowsGapTablet,
							label: 'rowsGapTablet',
						},
						mobile: {
							value: rowsGapMobile,
							label: 'rowsGapMobile',
						},
					} }
					min={ 0 }
					max={ 50 }
					unit={ {
						value: rowsGapUnit,
						label: 'rowsGapUnit',
					} }
					units={ [
						{
							name: __( 'Pixel', 'vexaltrix' ),
							unitValue: 'px',
						},
					] }
					setAttributes={ setAttributes }
				/>
				{ 'grid' === layout && (
					<>
						<ResponsiveSlider
							label={ __( 'Columns Gap', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: columnsGap,
									label: 'columnsGap',
								},
								tablet: {
									value: columnsGapTablet,
									label: 'columnsGapTablet',
								},
								mobile: {
									value: columnsGapMobile,
									label: 'columnsGapMobile',
								},
							} }
							min={ 0 }
							max={ 50 }
							unit={ {
								value: columnsGapUnit,
								label: 'columnsGapUnit',
							} }
							units={ [
								{
									name: __( 'Pixel', 'vexaltrix' ),
									unitValue: 'px',
								},
							] }
							setAttributes={ setAttributes }
						/>
						<ToggleControl
							label={ __( 'Equal Height', 'vexaltrix' ) }
							checked={ equalHeight }
							onChange={ () => setAttributes( { equalHeight: ! equalHeight } ) }
						/>
					</>
				) }
				<hr className="vxt-editor__separator" />
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'overall' }
					disabledBorderTitle={ false }
					attributes={ attributes }
					deviceType={ deviceType }
					disableBottomSeparator={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const iconStyle = () => {
		if ( 'accordion' !== layout ) {
			return '';
		}
		return (
			<UAGAdvancedPanelBody
				title={ __( 'Icon', 'vexaltrix' ) }
				initialOpen={ false }
				className="vxt_ultimate_gutenberg_blocks__url-panel-body"
			>
				<ResponsiveSlider
					label={ __( 'Size', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: iconSize,
							label: 'iconSize',
						},
						tablet: {
							value: iconSizeTablet,
							label: 'iconSizeTablet',
						},
						mobile: {
							value: iconSizeMobile,
							label: 'iconSizeMobile',
						},
					} }
					min={ 0 }
					max={ 100 }
					unit={ {
						value: iconSizeType,
						label: 'iconSizeType',
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
				<ResponsiveSlider
					label={ __( 'Background Size', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: iconBgSize,
							label: 'iconBgSize',
						},
						tablet: {
							value: iconBgSizeTablet,
							label: 'iconBgSizeTablet',
						},
						mobile: {
							value: iconBgSizeMobile,
							label: 'iconBgSizeMobile',
						},
					} }
					min={ 0 }
					max={ 100 }
					unit={ {
						value: iconBgSizeType,
						label: 'iconBgSizeType',
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
				<ResponsiveSlider
					label={ __( 'Gap between Icon and Question', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: gapBtwIconQUestion,
							label: 'gapBtwIconQUestion',
						},
						tablet: {
							value: gapBtwIconQUestionTablet,
							label: 'gapBtwIconQUestionTablet',
						},
						mobile: {
							value: gapBtwIconQUestionMobile,
							label: 'gapBtwIconQUestionMobile',
						},
					} }
					min={ -100 }
					max={ 100 }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ iconColor }
					data={ {
						value: iconColor,
						label: 'iconColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Active Color', 'vexaltrix' ) }
					colorValue={ iconActiveColor }
					data={ {
						value: iconActiveColor,
						label: 'iconActiveColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Background Color', 'vexaltrix' ) }
					colorValue={ iconBgColor }
					data={ {
						value: iconBgColor,
						label: 'iconBgColor',
					} }
					setAttributes={ setAttributes }
				/>
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'icon' }
					disabledBorderTitle={ false }
					attributes={ attributes }
					deviceType={ deviceType }
					disableBottomSeparator={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const presetSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Presets', 'vexaltrix' ) } initialOpen={ false }>
				<UAGPresets setAttributes={ setAttributes } presets={ presets } presetInputType="radioImage" />
			</UAGAdvancedPanelBody>
		);
	};

	const spacingStylePanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
				<SpacingControl
					label={ __( 'Padding', 'vexaltrix' ) }
					valueTop={ {
						value: blockTopPadding,
						label: 'blockTopPadding',
					} }
					valueRight={ {
						value: blockRightPadding,
						label: 'blockRightPadding',
					} }
					valueBottom={ {
						value: blockBottomPadding,
						label: 'blockBottomPadding',
					} }
					valueLeft={ {
						value: blockLeftPadding,
						label: 'blockLeftPadding',
					} }
					valueTopTablet={ {
						value: blockTopPaddingTablet,
						label: 'blockTopPaddingTablet',
					} }
					valueRightTablet={ {
						value: blockRightPaddingTablet,
						label: 'blockRightPaddingTablet',
					} }
					valueBottomTablet={ {
						value: blockBottomPaddingTablet,
						label: 'blockBottomPaddingTablet',
					} }
					valueLeftTablet={ {
						value: blockLeftPaddingTablet,
						label: 'blockLeftPaddingTablet',
					} }
					valueTopMobile={ {
						value: blockTopPaddingMobile,
						label: 'blockTopPaddingMobile',
					} }
					valueRightMobile={ {
						value: blockRightPaddingMobile,
						label: 'blockRightPaddingMobile',
					} }
					valueBottomMobile={ {
						value: blockBottomPaddingMobile,
						label: 'blockBottomPaddingMobile',
					} }
					valueLeftMobile={ {
						value: blockLeftPaddingMobile,
						label: 'blockLeftPaddingMobile',
					} }
					unit={ {
						value: blockPaddingUnit,
						label: 'blockPaddingUnit',
					} }
					mUnit={ {
						value: blockPaddingUnitMobile,
						label: 'blockPaddingUnitMobile',
					} }
					tUnit={ {
						value: blockPaddingUnitTablet,
						label: 'blockPaddingUnitTablet',
					} }
					deviceType={ deviceType }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: blockPaddingLink,
						label: 'blockPaddingLink',
					} }
				/>
				<SpacingControl
					label={ __( 'Margin', 'vexaltrix' ) }
					valueTop={ {
						value: blockTopMargin,
						label: 'blockTopMargin',
					} }
					valueRight={ {
						value: blockRightMargin,
						label: 'blockRightMargin',
					} }
					valueBottom={ {
						value: blockBottomMargin,
						label: 'blockBottomMargin',
					} }
					valueLeft={ {
						value: blockLeftMargin,
						label: 'blockLeftMargin',
					} }
					valueTopTablet={ {
						value: blockTopMarginTablet,
						label: 'blockTopMarginTablet',
					} }
					valueRightTablet={ {
						value: blockRightMarginTablet,
						label: 'blockRightMarginTablet',
					} }
					valueBottomTablet={ {
						value: blockBottomMarginTablet,
						label: 'blockBottomMarginTablet',
					} }
					valueLeftTablet={ {
						value: blockLeftMarginTablet,
						label: 'blockLeftMarginTablet',
					} }
					valueTopMobile={ {
						value: blockTopMarginMobile,
						label: 'blockTopMarginMobile',
					} }
					valueRightMobile={ {
						value: blockRightMarginMobile,
						label: 'blockRightMarginMobile',
					} }
					valueBottomMobile={ {
						value: blockBottomMarginMobile,
						label: 'blockBottomMarginMobile',
					} }
					valueLeftMobile={ {
						value: blockLeftMarginMobile,
						label: 'blockLeftMarginMobile',
					} }
					unit={ {
						value: blockMarginUnit,
						label: 'blockMarginUnit',
					} }
					mUnit={ {
						value: blockMarginUnitMobile,
						label: 'blockMarginUnitMobile',
					} }
					tUnit={ {
						value: blockMarginUnitTablet,
						label: 'blockMarginUnitTablet',
					} }
					deviceType={ deviceType }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: blockMarginLink,
						label: 'blockMarginLink',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	return (
		<>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ faqGeneralSettings() }
						{ 'accordion' === layout && faqIconSettings() }
						{ presetSettings() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ commonStyle() }
						{ iconStyle() }
						{ faqQuestionSettings() }
						{ faqAnswerSettings() }
						{ spacingStylePanel() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};

export default memo( Settings );
