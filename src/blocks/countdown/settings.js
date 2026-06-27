import { __ } from '@wordpress/i18n';
import UAGTextControl from '@Components/text-control';
import ResponsiveSlider from '@Components/responsive-slider';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import MultiButtonsControl from '@Components/multi-buttons-control';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import TypographyControl from '@Components/typography';
import SpacingControl from '@Components/spacing-control';
import ResponsiveBorder from '@Components/responsive-border';
import renderSVG from '@Controls/renderIcon';
import renderCustomIcon from '@Controls/renderCustomIcon';
import UAGPresets from '@Components/presets';
import UAGTabsControl from '@Components/tabs';
import BoxShadowControl from '@Components/box-shadow';
import { countdownPresets, boxShadowPresets, boxShadowHoverPresets } from './presets';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import { Icon, ToggleControl, DateTimePicker } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import Separator from '@Components/separator';
import { getSettings as getDateSettings } from '@wordpress/date';
import { memo } from '@wordpress/element';
import renderGBSSettings from '@Controls/renderGBSSettings';
import styling from './styling';
import { applyFilters } from '@wordpress/hooks';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

function Settings( props ) {
	const isPro = vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status;
	const {
		setAttributes,
		attributes,
		attributes: {
			block_id,
			timerType,
			displayEndDateTime,
			showDays,
			showHours,
			showMinutes,
			showSeconds,
			showLabels,
			labelDays,
			labelHours,
			labelMinutes,
			labelSeconds,
			showSeparator,
			separatorType,
			ariaLiveType,
			// digit.
			digitLoadGoogleFonts,
			digitFontFamily,
			digitFontWeight,
			digitFontStyle,
			digitFontSize,
			digitColor,
			digitDecoration,
			digitFontSizeType,
			digitFontSizeTypeMobile,
			digitFontSizeTypeTablet,
			digitFontSizeMobile,
			digitFontSizeTablet,
			digitLineHeight,
			digitLineHeightType,
			digitLineHeightMobile,
			digitLineHeightTablet,
			digitLetterSpacing,
			digitLetterSpacingType,
			digitLetterSpacingMobile,
			digitLetterSpacingTablet,
			// label.
			labelLoadGoogleFonts,
			labelFontFamily,
			labelFontWeight,
			labelFontStyle,
			labelFontSize,
			labelColor,
			labelTransform,
			labelDecoration,
			labelFontSizeType,
			labelFontSizeTypeMobile,
			labelFontSizeTypeTablet,
			labelFontSizeMobile,
			labelFontSizeTablet,
			labelLineHeight,
			labelLineHeightType,
			labelLineHeightMobile,
			labelLineHeightTablet,
			labelLetterSpacing,
			labelLetterSpacingType,
			labelLetterSpacingMobile,
			labelLetterSpacingTablet,
			// Separator styling.
			separatorLoadGoogleFonts,
			separatorFontFamily,
			separatorFontWeight,
			separatorFontStyle,
			separatorFontSize,
			separatorColor,
			separatorFontSizeType,
			separatorFontSizeTypeMobile,
			separatorFontSizeTypeTablet,
			separatorFontSizeMobile,
			separatorFontSizeTablet,
			separatorLineHeight,
			separatorLineHeightType,
			separatorLineHeightMobile,
			separatorLineHeightTablet,
			separatorRightSpacing,
			separatorRightSpacingTablet,
			separatorRightSpacingMobile,
			separatorTopSpacing,
			separatorTopSpacingTablet,
			separatorTopSpacingMobile,
			// Block Margin.
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
			// Block Padding.
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
			// Box Padding.
			boxTopPadding,
			boxRightPadding,
			boxLeftPadding,
			boxBottomPadding,
			boxTopPaddingTablet,
			boxRightPaddingTablet,
			boxLeftPaddingTablet,
			boxBottomPaddingTablet,
			boxTopPaddingMobile,
			boxRightPaddingMobile,
			boxLeftPaddingMobile,
			boxBottomPaddingMobile,
			boxPaddingUnit,
			boxPaddingUnitTablet,
			boxPaddingUnitMobile,
			boxPaddingLink,
			// Overall Align.
			align,
			alignTablet,
			alignMobile,
			// Box Align.
			boxAlign,
			boxAlignTablet,
			boxAlignMobile,
			// Square Box.
			isSquareBox,
			// Label Vertical Alignment.
			labelVerticalAlignment,
			labelVerticalAlignmentTablet,
			labelVerticalAlignmentMobile,
			// Box Width.
			boxWidth,
			boxWidthTablet,
			boxWidthMobile,
			// Box Spacing.
			boxSpacing,
			boxSpacingTablet,
			boxSpacingMobile,
			// Internal Box Spacing.
			internalBoxSpacing,
			internalBoxSpacingTablet,
			internalBoxSpacingMobile,
			// Box Flex Direction.
			boxFlex,
			boxFlexTablet,
			boxFlexMobile,
			// Box Background.
			boxBgType,
			boxBgColor,
			// Box - Box Shadow.
			useSeparateBoxShadows,
			boxShadowColor,
			boxShadowHOffset,
			boxShadowVOffset,
			boxShadowBlur,
			boxShadowSpread,
			boxShadowPosition,
			boxShadowColorHover,
			boxShadowHOffsetHover,
			boxShadowVOffsetHover,
			boxShadowBlurHover,
			boxShadowSpreadHover,
			boxShadowPositionHover,
		},
		deviceType,
	} = props;

	// <------------------ OPTIONS/VALUES ------------------>
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

	const alignmentOptions = [
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
	];

	const flexAlignmentOptions = [
		{
			value: 'flex-start',
			icon: <Icon icon={ renderSVG( 'fa fa-align-left' ) } />,
			tooltip: __( 'Left', 'vexaltrix' ),
		},
		{
			value: 'center',
			icon: <Icon icon={ renderSVG( 'fa fa-align-center' ) } />,
			tooltip: __( 'Center', 'vexaltrix' ),
		},
		{
			value: 'flex-end',
			icon: <Icon icon={ renderSVG( 'fa fa-align-right' ) } />,
			tooltip: __( 'Right', 'vexaltrix' ),
		},
	];

	// This is to fetch the local system's offset from UTC and helps the user know their offset from 00:00UTC.

	const { timezone } = getDateSettings();

	const displayDatePanel = () => {
		let flag = true;
		if ( ! timerType ) {
			return false;
		}
		switch ( timerType ) {
			case 'date':
				flag = true;
				break;
			case 'evergreen':
				flag = isPro ? false : true;
				break;
		}
		return flag;
	};

	// <------------------ GENERAL TAB ------------------>
	const generalPanel = (
		<UAGAdvancedPanelBody panelId={ 'general' } title={ __( 'General', 'vexaltrix' ) } initialOpen={ true }>
			{ displayDatePanel() && (
				<div className="vxt-countdown__datetime-picker">
					<div>
						<h2>{ __( 'Timer End Date & Time', 'vexaltrix' ) }</h2>
					</div>
					<DateTimePicker
						className="vxt-date-picker"
						currentDate={ displayEndDateTime }
						onChange={ ( value ) => {
							// Make sure the time is set in UTC, so that we can easily remove the timezone offset from WP Settings.
							const UTCValue = value + 'Z';
							const d = new Date( UTCValue );

							// Remove the timezone offset received from WP Settings.
							d.setMilliseconds( d.getMilliseconds() - timezone.offset * 60 * 60 * 1000 );

							setAttributes( {
								endDateTime: d,
								endDateTimeCopy: d,
								displayEndDateTime: value,
							} );
						} }
						is12Hour={ true }
						__nextRemoveResetButton={ true }
						__nextRemoveHelpButton={ true }
					/>
				</div>
			) }
			<Separator />
			<ToggleControl
				label={ __( 'Show Days', 'vexaltrix' ) }
				checked={ showDays }
				onChange={ () => {
					if ( ! showHours && ! showMinutes && ! showSeconds ) {
						return;
					} // Prevent turning off the last toggle
					setAttributes( { showDays: ! showDays } );
				} }
			/>
			<ToggleControl
				label={ __( 'Show Hours', 'vexaltrix' ) }
				checked={ showHours }
				onChange={ () => {
					if ( ! showDays && ! showMinutes && ! showSeconds ) {
						return;
					} // Prevent turning off the last toggle
					setAttributes( { showHours: ! showHours } );
				} }
			/>
			<ToggleControl
				label={ __( 'Show Minutes', 'vexaltrix' ) }
				checked={ showMinutes }
				onChange={ () => {
					if ( ! showDays && ! showHours && ! showSeconds ) {
						return;
					} // Prevent turning off the last toggle
					setAttributes( { showMinutes: ! showMinutes } );
				} }
			/>
			<ToggleControl
				label={ __( 'Show Seconds', 'vexaltrix' ) }
				checked={ showSeconds }
				onChange={ () => {
					if ( ! showDays && ! showHours && ! showMinutes ) {
						return;
					} // Prevent turning off the last toggle
					setAttributes( { showSeconds: ! showSeconds } );
				} }
			/>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Aria Live Type', 'vexaltrix' ) }
				data={ {
					value: ariaLiveType,
					label: 'ariaLiveType',
				} }
				options={ [
					{
						value: 'off',
						label: __( 'Off', 'vexaltrix' ),
					},
					{
						value: 'polite',
						label: __( 'Polite', 'vexaltrix' ),
					},
					{
						value: 'assertive',
						label: __( 'Assertive', 'vexaltrix' ),
					},
				] }
			/>
		</UAGAdvancedPanelBody>
	);

	// <------------------ PRESETS TAB ------------------>
	const presetsPanel = (
		<UAGAdvancedPanelBody title={ __( 'Presets', 'vexaltrix' ) } initialOpen={ false }>
			<UAGPresets setAttributes={ setAttributes } presets={ countdownPresets } presetInputType="radioImage" />
		</UAGAdvancedPanelBody>
	);

	const labelGeneralPanel = (
		<UAGAdvancedPanelBody title={ __( 'Labels', 'vexaltrix' ) } initialOpen={ false }>
			<ToggleControl
				label={ __( 'Show Labels', 'vexaltrix' ) }
				checked={ showLabels }
				onChange={ () => setAttributes( { showLabels: ! showLabels } ) }
			/>
			{ showLabels && (
				<>
					{ showDays && (
						<UAGTextControl
							label={ __( 'Days', 'vexaltrix' ) }
							variant="full-width"
							value={ labelDays }
							data={ {
								value: labelDays,
								label: 'labelDays',
							} }
							setAttributes={ setAttributes }
						/>
					) }
					{ showHours && (
						<UAGTextControl
							label={ __( 'Hours', 'vexaltrix' ) }
							variant="full-width"
							value={ labelHours }
							data={ {
								value: labelHours,
								label: 'labelHours',
							} }
							setAttributes={ setAttributes }
						/>
					) }
					{ showMinutes && (
						<UAGTextControl
							label={ __( 'Minutes', 'vexaltrix' ) }
							variant="full-width"
							value={ labelMinutes }
							data={ {
								value: labelMinutes,
								label: 'labelMinutes',
							} }
							setAttributes={ setAttributes }
						/>
					) }
					{ showSeconds && (
						<UAGTextControl
							label={ __( 'Seconds', 'vexaltrix' ) }
							variant="full-width"
							value={ labelSeconds }
							data={ {
								value: labelSeconds,
								label: 'labelSeconds',
							} }
							setAttributes={ setAttributes }
						/>
					) }
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const separatorGeneralPanel = (
		<UAGAdvancedPanelBody title={ __( 'Separator', 'vexaltrix' ) } initialOpen={ false }>
			<ToggleControl
				label={ __( 'Show Separator', 'vexaltrix' ) }
				checked={ showSeparator }
				onChange={ () => setAttributes( { showSeparator: ! showSeparator } ) }
			/>
			{ showSeparator && (
				<>
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Separator Type', 'vexaltrix' ) }
						data={ {
							value: separatorType,
							label: 'separatorType',
						} }
						options={ [
							{
								value: ':',
								label: __( 'Colon', 'vexaltrix' ),
							},
							{
								value: '|',
								label: __( 'Line', 'vexaltrix' ),
							},
							{
								value: '/',
								label: __( 'Slash', 'vexaltrix' ),
							},
						] }
					/>
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	// <------------------ STYLE TAB ------------------>
	const boxStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Box', 'vexaltrix' ) } initialOpen={ true }>
			<ToggleControl
				label={ __( 'Square Shaped Box', 'vexaltrix' ) }
				checked={ isSquareBox }
				onChange={ () => setAttributes( { isSquareBox: ! isSquareBox } ) }
			/>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Overall Alignment', 'vexaltrix' ) }
				responsive={ true }
				data={ {
					desktop: {
						value: align,
						label: 'align',
					},
					tablet: {
						value: alignTablet,
						label: 'alignTablet',
					},
					mobile: {
						value: alignMobile,
						label: 'alignMobile',
					},
				} }
				className="vxt-multi-button-alignment-control"
				options={ alignmentOptions }
				showIcons={ true }
			/>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Inner Alignment', 'vexaltrix' ) }
				responsive={ true }
				data={ {
					desktop: {
						value: boxAlign,
						label: 'boxAlign',
					},
					tablet: {
						value: boxAlignTablet,
						label: 'boxAlignTablet',
					},
					mobile: {
						value: boxAlignMobile,
						label: 'boxAlignMobile',
					},
				} }
				className="vxt-multi-button-alignment-control"
				options={ flexAlignmentOptions }
				showIcons={ true }
			/>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Label Position', 'vexaltrix' ) }
				responsive={ true }
				data={ {
					desktop: {
						value: boxFlex,
						label: 'boxFlex',
					},
					tablet: {
						value: boxFlexTablet,
						label: 'boxFlexTablet',
					},
					mobile: {
						value: boxFlexMobile,
						label: 'boxFlexMobile',
					},
				} }
				className="vxt-multi-button-alignment-control"
				options={ [
					{
						value: 'row',
						icon: <Icon icon={ renderCustomIcon( 'flex-direction-row' ) } />,
						tooltip: __( 'Row', 'vexaltrix' ),
					},
					{
						value: 'column',
						icon: <Icon icon={ renderCustomIcon( 'flex-direction-column' ) } />,
						tooltip: __( 'Column', 'vexaltrix' ),
					},
				] }
				showIcons={ true }
			/>
			{ ! isSquareBox &&
				( ( deviceType === 'Desktop' && boxFlex === 'row' ) ||
					( deviceType === 'Tablet' && boxFlexTablet === 'row' ) ||
					( deviceType === 'Mobile' && boxFlexMobile === 'row' ) ) && (
					<>
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'Label Vertical Alignment', 'vexaltrix' ) }
							responsive={ true }
							data={ {
								desktop: {
									value: labelVerticalAlignment,
									label: 'labelVerticalAlignment',
								},
								tablet: {
									value: labelVerticalAlignmentTablet,
									label: 'labelVerticalAlignmentTablet',
								},
								mobile: {
									value: labelVerticalAlignmentMobile,
									label: 'labelVerticalAlignmentMobile',
								},
							} }
							className="vxt-multi-button-alignment-control"
							options={ [
								{
									value: 'start',
									label: __( 'Top', 'vexaltrix' ),
									// tooltip: __( 'Top', 'vexaltrix' ),
								},
								{
									value: 'center',
									label: __( 'Center', 'vexaltrix' ),
									// tooltip: __( 'Center', 'vexaltrix' ),
								},
								{
									value: 'end',
									label: __( 'Bottom', 'vexaltrix' ),
									// tooltip: __( 'Bottom', 'vexaltrix' ),
								},
							] }
							showIcons={ false }
							help={ __( 'This feature works best after adding line-height to the label.', 'vexaltrix' ) }
						/>
					</>
				) }
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Background Type', 'vexaltrix' ) }
				data={ {
					value: boxBgType,
					label: 'boxBgType',
				} }
				className="vxt-multi-button-alignment-control"
				options={ bgTypeOptions }
			/>
			{ boxBgType === 'color' && (
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ boxBgColor ? boxBgColor : '' }
					data={ {
						value: boxBgColor,
						label: 'boxBgColor',
					} }
					setAttributes={ setAttributes }
				/>
			) }
			<ResponsiveSlider
				label={ __( 'Box Width', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: boxWidth,
						label: 'boxWidth',
					},
					tablet: {
						value: boxWidthTablet,
						label: 'boxWidthTablet',
					},
					mobile: {
						value: boxWidthMobile,
						label: 'boxWidthMobile',
					},
				} }
				min={ 0 }
				max={ 250 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
			<ResponsiveSlider
				label={ __( 'Gap Between Boxes', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: boxSpacing,
						label: 'boxSpacing',
					},
					tablet: {
						value: boxSpacingTablet,
						label: 'boxSpacingTablet',
					},
					mobile: {
						value: boxSpacingMobile,
						label: 'boxSpacingMobile',
					},
				} }
				min={ 0 }
				max={ 200 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
			<ResponsiveSlider
				label={ __( 'Gap Between Digits & Labels', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: internalBoxSpacing,
						label: 'internalBoxSpacing',
					},
					tablet: {
						value: internalBoxSpacingTablet,
						label: 'internalBoxSpacingTablet',
					},
					mobile: {
						value: internalBoxSpacingMobile,
						label: 'internalBoxSpacingMobile',
					},
				} }
				min={ 0 }
				max={ 200 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
			<ResponsiveBorder
				disabledBorderTitle={ false }
				setAttributes={ setAttributes }
				prefix={ 'box' }
				attributes={ attributes }
				deviceType={ deviceType }
				disableBottomSeparator={ false }
			/>
			<SpacingControl
				label={ __( 'Padding', 'vexaltrix' ) }
				valueTop={ {
					value: boxTopPadding,
					label: 'boxTopPadding',
				} }
				valueRight={ {
					value: boxRightPadding,
					label: 'boxRightPadding',
				} }
				valueBottom={ {
					value: boxBottomPadding,
					label: 'boxBottomPadding',
				} }
				valueLeft={ {
					value: boxLeftPadding,
					label: 'boxLeftPadding',
				} }
				valueTopTablet={ {
					value: boxTopPaddingTablet,
					label: 'boxTopPaddingTablet',
				} }
				valueRightTablet={ {
					value: boxRightPaddingTablet,
					label: 'boxRightPaddingTablet',
				} }
				valueBottomTablet={ {
					value: boxBottomPaddingTablet,
					label: 'boxBottomPaddingTablet',
				} }
				valueLeftTablet={ {
					value: boxLeftPaddingTablet,
					label: 'boxLeftPaddingTablet',
				} }
				valueTopMobile={ {
					value: boxTopPaddingMobile,
					label: 'boxTopPaddingMobile',
				} }
				valueRightMobile={ {
					value: boxRightPaddingMobile,
					label: 'boxRightPaddingMobile',
				} }
				valueBottomMobile={ {
					value: boxBottomPaddingMobile,
					label: 'boxBottomPaddingMobile',
				} }
				valueLeftMobile={ {
					value: boxLeftPaddingMobile,
					label: 'boxLeftPaddingMobile',
				} }
				unit={ {
					value: boxPaddingUnit,
					label: 'boxPaddingUnit',
				} }
				mUnit={ {
					value: boxPaddingUnitMobile,
					label: 'boxPaddingUnitMobile',
				} }
				tUnit={ {
					value: boxPaddingUnitTablet,
					label: 'boxPaddingUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: boxPaddingLink,
					label: 'boxPaddingLink',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const digitStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Digit', 'vexaltrix' ) } initialOpen={ false }>
			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ digitColor ? digitColor : '' }
				data={ {
					value: digitColor,
					label: 'digitColor',
				} }
				setAttributes={ setAttributes }
			/>
			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: digitLoadGoogleFonts,
					label: 'digitLoadGoogleFonts',
				} }
				fontFamily={ {
					value: digitFontFamily,
					label: 'digitFontFamily',
				} }
				fontWeight={ {
					value: digitFontWeight,
					label: 'digitFontWeight',
				} }
				fontStyle={ {
					value: digitFontStyle,
					label: 'digitFontStyle',
				} }
				disableTransform={ true }
				decoration={ {
					value: digitDecoration,
					label: 'digitDecoration',
				} }
				fontSizeType={ {
					value: digitFontSizeType,
					label: 'digitFontSizeType',
				} }
				fontSizeTypeTablet={ {
					value: digitFontSizeTypeTablet,
					label: 'digitFontSizeTypeTablet',
				} }
				fontSizeTypeMobile={ {
					value: digitFontSizeTypeMobile,
					label: 'digitFontSizeTypeMobile',
				} }
				fontSize={ {
					value: digitFontSize,
					label: 'digitFontSize',
				} }
				fontSizeMobile={ {
					value: digitFontSizeMobile,
					label: 'digitFontSizeMobile',
				} }
				fontSizeTablet={ {
					value: digitFontSizeTablet,
					label: 'digitFontSizeTablet',
				} }
				lineHeightType={ {
					value: digitLineHeightType,
					label: 'digitLineHeightType',
				} }
				lineHeight={ {
					value: digitLineHeight,
					label: 'digitLineHeight',
				} }
				lineHeightMobile={ {
					value: digitLineHeightMobile,
					label: 'digitLineHeightMobile',
				} }
				lineHeightTablet={ {
					value: digitLineHeightTablet,
					label: 'digitLineHeightTablet',
				} }
				letterSpacingType={ {
					value: digitLetterSpacingType,
					label: 'digitLetterSpacingType',
				} }
				letterSpacing={ {
					value: digitLetterSpacing,
					label: 'digitLetterSpacing',
				} }
				letterSpacingMobile={ {
					value: digitLetterSpacingMobile,
					label: 'digitLetterSpacingMobile',
				} }
				letterSpacingTablet={ {
					value: digitLetterSpacingTablet,
					label: 'digitLetterSpacingTablet',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const labelStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Label', 'vexaltrix' ) } initialOpen={ false }>
			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ labelColor ? labelColor : '' }
				data={ {
					value: labelColor,
					label: 'labelColor',
				} }
				setAttributes={ setAttributes }
			/>
			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: labelLoadGoogleFonts,
					label: 'labelLoadGoogleFonts',
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
				transform={ {
					value: labelTransform,
					label: 'labelTransform',
				} }
				decoration={ {
					value: labelDecoration,
					label: 'labelDecoration',
				} }
				fontSizeType={ {
					value: labelFontSizeType,
					label: 'labelFontSizeType',
				} }
				fontSizeTypeTablet={ {
					value: labelFontSizeTypeTablet,
					label: 'labelFontSizeTypeTablet',
				} }
				fontSizeTypeMobile={ {
					value: labelFontSizeTypeMobile,
					label: 'labelFontSizeTypeMobile',
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
				letterSpacingType={ {
					value: labelLetterSpacingType,
					label: 'labelLetterSpacingType',
				} }
				letterSpacing={ {
					value: labelLetterSpacing,
					label: 'labelLetterSpacing',
				} }
				letterSpacingMobile={ {
					value: labelLetterSpacingMobile,
					label: 'labelLetterSpacingMobile',
				} }
				letterSpacingTablet={ {
					value: labelLetterSpacingTablet,
					label: 'labelLetterSpacingTablet',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const separatorStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Separator', 'vexaltrix' ) } initialOpen={ false }>
			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ separatorColor ? separatorColor : '' }
				data={ {
					value: separatorColor,
					label: 'separatorColor',
				} }
				setAttributes={ setAttributes }
			/>
			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: separatorLoadGoogleFonts,
					label: 'separatorLoadGoogleFonts',
				} }
				fontFamily={ {
					value: separatorFontFamily,
					label: 'separatorFontFamily',
				} }
				fontWeight={ {
					value: separatorFontWeight,
					label: 'separatorFontWeight',
				} }
				fontStyle={ {
					value: separatorFontStyle,
					label: 'separatorFontStyle',
				} }
				disableTransform={ true }
				disableDecoration={ true }
				fontSizeType={ {
					value: separatorFontSizeType,
					label: 'separatorFontSizeType',
				} }
				fontSizeTypeTablet={ {
					value: separatorFontSizeTypeTablet,
					label: 'separatorFontSizeTypeTablet',
				} }
				fontSizeTypeMobile={ {
					value: separatorFontSizeTypeMobile,
					label: 'separatorFontSizeTypeMobile',
				} }
				fontSize={ {
					value: separatorFontSize,
					label: 'separatorFontSize',
				} }
				fontSizeMobile={ {
					value: separatorFontSizeMobile,
					label: 'separatorFontSizeMobile',
				} }
				fontSizeTablet={ {
					value: separatorFontSizeTablet,
					label: 'separatorFontSizeTablet',
				} }
				lineHeightType={ {
					value: separatorLineHeightType,
					label: 'separatorLineHeightType',
				} }
				lineHeight={ {
					value: separatorLineHeight,
					label: 'separatorLineHeight',
				} }
				lineHeightMobile={ {
					value: separatorLineHeightMobile,
					label: 'separatorLineHeightMobile',
				} }
				lineHeightTablet={ {
					value: separatorLineHeightTablet,
					label: 'separatorLineHeightTablet',
				} }
			/>
			<ResponsiveSlider
				label={ __( 'Separator Right Spacing', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: separatorRightSpacing,
						label: 'separatorRightSpacing',
					},
					tablet: {
						value: separatorRightSpacingTablet,
						label: 'separatorRightSpacingTablet',
					},
					mobile: {
						value: separatorRightSpacingMobile,
						label: 'separatorRightSpacingMobile',
					},
				} }
				min={ 0 }
				max={ 300 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
			<ResponsiveSlider
				label={ __( 'Separator Top Spacing', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: separatorTopSpacing,
						label: 'separatorTopSpacing',
					},
					tablet: {
						value: separatorTopSpacingTablet,
						label: 'separatorTopSpacingTablet',
					},
					mobile: {
						value: separatorTopSpacingMobile,
						label: 'separatorTopSpacingMobile',
					},
				} }
				min={ 0 }
				max={ 300 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
		</UAGAdvancedPanelBody>
	);

	const boxShadowSettings = (
		<UAGAdvancedPanelBody title={ __( 'Box Shadow', 'vexaltrix' ) } initialOpen={ false }>
			<ToggleControl
				label={ __( 'Separate Hover Shadow', 'vexaltrix' ) }
				checked={ useSeparateBoxShadows }
				onChange={ () => setAttributes( { useSeparateBoxShadows: ! useSeparateBoxShadows } ) }
			/>
			{ useSeparateBoxShadows ? (
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
							<UAGPresets
								setAttributes={ setAttributes }
								presets={ boxShadowPresets }
								presetInputType="radioImage"
							/>
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
						</>
					}
					hover={
						<>
							<UAGPresets
								setAttributes={ setAttributes }
								presets={ boxShadowHoverPresets }
								presetInputType="radioImage"
							/>
							<BoxShadowControl
								blockId={ block_id }
								setAttributes={ setAttributes }
								label={ __( 'Box Shadow', 'vexaltrix' ) }
								boxShadowColor={ {
									value: boxShadowColorHover,
									label: 'boxShadowColorHover',
									title: __( 'Color', 'vexaltrix' ),
								} }
								boxShadowHOffset={ {
									value: boxShadowHOffsetHover,
									label: 'boxShadowHOffsetHover',
									title: __( 'Horizontal', 'vexaltrix' ),
								} }
								boxShadowVOffset={ {
									value: boxShadowVOffsetHover,
									label: 'boxShadowVOffsetHover',
									title: __( 'Vertical', 'vexaltrix' ),
								} }
								boxShadowBlur={ {
									value: boxShadowBlurHover,
									label: 'boxShadowBlurHover',
									title: __( 'Blur', 'vexaltrix' ),
								} }
								boxShadowSpread={ {
									value: boxShadowSpreadHover,
									label: 'boxShadowSpreadHover',
									title: __( 'Spread', 'vexaltrix' ),
								} }
								boxShadowPosition={ {
									value: boxShadowPositionHover,
									label: 'boxShadowPositionHover',
									title: __( 'Position', 'vexaltrix' ),
								} }
							/>
						</>
					}
					disableBottomSeparator={ true }
				/>
			) : (
				<>
					<UAGPresets
						setAttributes={ setAttributes }
						presets={ boxShadowPresets }
						presetInputType="radioImage"
					/>
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
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const spacingStylePanel = (
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

	return (
		<>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general } parentProps={ props }>
						{ generalPanel }
						{ labelGeneralPanel }
						{ separatorGeneralPanel }
						{ /* Expiry settings from Pro */ }
						{ applyFilters( 'vexaltrix.countdown.expiry-settings' ) }
						{ presetsPanel }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status && (
							<UAGAdvancedPanelBody className="block-editor-block-inspector__upgrade_pro vxt-upgrade_pro-tab">
								<UpgradeComponent
									control={ {
										title: __(
											'Take Countdown Block to the next level with powerful features',
											'vexaltrix'
										),
										choices: [
											{
												title: __( 'Evergreen mode', 'vexaltrix' ),
												description: '',
											},
											{
												title: __( 'Expiry options', 'vexaltrix' ),
												description: '',
											},
										],
										renderAs: 'list',
										campaign: 'countdown',
									} }
								/>
							</UAGAdvancedPanelBody>
						) }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style } parentProps={ props }>
						{ boxStylePanel }
						{ digitStylePanel }
						{ showLabels && labelStylePanel }
						{ showSeparator && separatorStylePanel }
						{ boxShadowSettings }
						{ spacingStylePanel }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }>
						{ renderGBSSettings( styling, setAttributes, attributes ) }
					</InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
}

export default memo( Settings );
