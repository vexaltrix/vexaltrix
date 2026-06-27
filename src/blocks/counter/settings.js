import { useEffect, useState } from '@wordpress/element';
import TypographyControl from '@Components/typography';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import SpacingControl from '@Components/spacing-control';
import { __ } from '@wordpress/i18n';
import { AlignmentToolbar, BlockControls, InspectorControls } from '@wordpress/block-editor';
import { Icon, ToggleControl } from '@wordpress/components';
import renderSVG from '@Controls/renderIcon';
import Range from '@Components/range/Range.js';
import ResponsiveSlider from '@Components/responsive-slider';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import BoxShadowControl from '@Components/box-shadow';
import UAGTabsControl from '@Components/tabs';
import { boxShadowPresets, boxShadowHoverPresets } from './presets';
import ResponsiveBorder from '@Components/responsive-border';
import UAGSelectControl from '@Components/select-control';
import UAGIconPicker from '@Components/icon-picker';
import UAGMediaPicker from '@Components/image';
import UAGNumberControl from '@Components/number-control';
import UAGTextControl from '@Components/text-control';
import { getImageSize } from '@Utils/Helpers';
import UAGPresets from '@Components/presets';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import defaultAttributes from './attributes';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

let imageSizeOptions = [
	{
		value: 'thumbnail',
		label: __( 'Thumbnail', 'vexaltrix' ),
	},
	{ value: 'medium', label: __( 'Medium', 'vexaltrix' ) },
	{ value: 'full', label: __( 'Large', 'vexaltrix' ) },
];

export default function Settings( props ) {
	const { setAttributes, attributes, deviceType } = props;

	const {
		block_id,
		startNumber,
		endNumber,
		decimalPlaces,
		align,
		alignTablet,
		alignMobile,
		totalNumber,
		numberPrefix,
		numberSuffix,
		animationDuration,
		thousandSeparator,
		layout,
		// heading
		headingLoadGoogleFonts,
		headingFontFamily,
		headingFontWeight,
		headingFontStyle,
		headingFontSize,
		headingColor,
		headingTransform,
		headingDecoration,
		headingFontSizeType,
		headingFontSizeMobile,
		headingFontSizeTablet,
		headingLineHeight,
		headingLineHeightType,
		headingLineHeightMobile,
		headingLineHeightTablet,
		headingTopMargin,
		headingRightMargin,
		headingLeftMargin,
		headingBottomMargin,
		headingTopMarginTablet,
		headingRightMarginTablet,
		headingLeftMarginTablet,
		headingBottomMarginTablet,
		headingTopMarginMobile,
		headingRightMarginMobile,
		headingLeftMarginMobile,
		headingBottomMarginMobile,
		headingMarginUnit,
		headingMarginUnitTablet,
		headingMarginUnitMobile,
		headingMarginLink,
		headingLetterSpacingType,
		headingLetterSpacing,
		headingLetterSpacingTablet,
		headingLetterSpacingMobile,
		// Block Margin
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
		// Block Padding
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
		// Number
		numberLoadGoogleFonts,
		numberFontFamily,
		numberFontWeight,
		numberFontStyle,
		numberFontSize,
		numberColor,
		numberTransform,
		numberDecoration,
		numberFontSizeType,
		numberFontSizeMobile,
		numberFontSizeTablet,
		numberLineHeight,
		numberLineHeightType,
		numberLineHeightMobile,
		numberLineHeightTablet,
		numberTopMargin,
		numberRightMargin,
		numberLeftMargin,
		numberBottomMargin,
		numberTopMarginTablet,
		numberRightMarginTablet,
		numberLeftMarginTablet,
		numberBottomMarginTablet,
		numberTopMarginMobile,
		numberRightMarginMobile,
		numberLeftMarginMobile,
		numberBottomMarginMobile,
		numberMarginUnit,
		numberMarginUnitTablet,
		numberMarginUnitMobile,
		numberMarginLink,
		numberLetterSpacingType,
		numberLetterSpacing,
		numberLetterSpacingTablet,
		numberLetterSpacingMobile,
		// prefix
		prefixRightDistance,
		prefixRightDistanceTablet,
		prefixRightDistanceMobile,
		// suffix
		suffixLeftDistance,
		suffixLeftDistanceTablet,
		suffixLeftDistanceMobile,
		// circle
		circleSize,
		circleStokeSize,
		circleForeground,
		circleBackground,
		// bar
		barSize,
		barForeground,
		barBackground,
		barFlip,
		// box shadow
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
		// Icon/Image
		showIcon,
		icon,
		iconColor,
		iconBackgroundColor,
		iconHoverColor,
		iconBackgroundHoverColor,
		iconSize,
		iconSizeTablet,
		iconSizeMobile,
		iconSizeType,
		iconSizeTypeTablet,
		iconSizeTypeMobile,
		iconImgPosition,
		iconImage,
		imageSize,
		sourceType,
		imageWidthType,
		imageWidth,
		imageWidthTablet,
		imageWidthMobile,
		imageWidthUnit,
		imageWidthUnitTablet,
		imageWidthUnitMobile,
		// Icon Padding
		iconTopPadding,
		iconRightPadding,
		iconLeftPadding,
		iconBottomPadding,
		iconTopPaddingTablet,
		iconRightPaddingTablet,
		iconLeftPaddingTablet,
		iconBottomPaddingTablet,
		iconTopPaddingMobile,
		iconRightPaddingMobile,
		iconLeftPaddingMobile,
		iconBottomPaddingMobile,
		iconPaddingUnit,
		iconPaddingUnitTablet,
		iconPaddingUnitMobile,
		iconPaddingLink,
		// Icon Margin
		iconTopMargin,
		iconRightMargin,
		iconLeftMargin,
		iconBottomMargin,
		iconTopMarginTablet,
		iconRightMarginTablet,
		iconLeftMarginTablet,
		iconBottomMarginTablet,
		iconTopMarginMobile,
		iconRightMarginMobile,
		iconLeftMarginMobile,
		iconBottomMarginMobile,
		iconMarginUnit,
		iconMarginUnitTablet,
		iconMarginUnitMobile,
		iconMarginLink,
	} = attributes;

	useEffect( () => {
		// Since circle layout doesn't support other image positions.
		if ( layout === 'circle' && ( iconImgPosition !== 'top' || iconImgPosition !== 'bottom' ) ) {
			setAttributes( { iconImgPosition: 'top' } );
		}
	}, [ layout ] );

	// The following useEffect prevents validation errors,
	// especially when dynamic content numbers are used
	// since they are of type 'string' rather than 'number'.
	useEffect( () => {
		// In case number value is of type string, the save function goes for the default values,
		// which are stored in the markup, causing validation errors.
		const startValue = parseFloat( startNumber );
		const endValue = parseFloat( endNumber );
		const totalValue = parseFloat( totalNumber );

		setAttributes( { startNumber: startValue } );
		setAttributes( { endNumber: endValue } );
		setAttributes( { totalNumber: totalValue } );
	}, [ startNumber, endNumber, totalNumber ] );

	const [ minTotal, setMinTotal ] = useState( defaultAttributes.endNumber.default ); // Default for endNumber.

	const startFallback = getFallbackNumber( startNumber, 'startNumber', 'counter' );
	const endFallback = getFallbackNumber( endNumber, 'endNumber', 'counter' );

	useEffect( () => {
		if ( startFallback < endFallback ) {
			setMinTotal( endFallback );
		} else if ( startFallback > endFallback ) {
			setMinTotal( startFallback );
		} else {
			setMinTotal( endFallback );
		}
	}, [ startNumber, endNumber ] );

	// If total number is more than endnumber, set it to minTotal.
	useEffect( () => {
		if ( totalNumber < endNumber && startNumber < endNumber ) {
			setAttributes( { totalNumber: minTotal } );
		}
	}, [ minTotal ] );

	const numberIconPositionOptions = [
		{
			value: 'top',
			label: __( 'Top', 'vexaltrix' ),
		},
		{
			value: 'bottom',
			label: __( 'Bottom', 'vexaltrix' ),
		},
		{
			value: 'left-number',
			label: __( 'Left of Number', 'vexaltrix' ),
		},
		{
			value: 'right-number',
			label: __( 'Right of Number', 'vexaltrix' ),
		},
	];

	const circleIconPositionOptions = [
		{
			value: 'top',
			label: __( 'Top', 'vexaltrix' ),
		},
		{
			value: 'bottom',
			label: __( 'Bottom', 'vexaltrix' ),
		},
	];

	/*
	 * Event to set Image as while adding.
	 */
	const onSelectImage = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { iconImage: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			setAttributes( { iconImage: null } );
			return;
		}
		if ( media.sizes ) {
			const new_img = getImageSize( media.sizes );
			imageSizeOptions = new_img;
		}
		setAttributes( { iconImage: media } );
	};

	/*
	 * Event to set Image as null while removing.
	 */
	const onRemoveImage = () => {
		setAttributes( { iconImage: '' } );
	};

	if ( iconImage && iconImage.sizes ) {
		imageSizeOptions = getImageSize( iconImage.sizes );
	}

	const generalPanel = (
		<UAGAdvancedPanelBody title={ __( 'General', 'vexaltrix' ) } initialOpen={ true }>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Layout', 'vexaltrix' ) }
				data={ {
					value: layout,
					label: 'layout',
				} }
				options={ [
					{
						value: 'number',
						label: __( 'Number', 'vexaltrix' ),
					},
					{
						value: 'circle',
						label: __( 'Circle', 'vexaltrix' ),
					},
					{
						value: 'bars',
						label: __( 'Bar', 'vexaltrix' ),
					},
				] }
				showIcons={ false }
			/>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Alignment', 'vexaltrix' ) }
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
			{ layout === 'bars' && (
				<>
					<ToggleControl
						checked={ barFlip }
						onChange={ () => setAttributes( { barFlip: ! barFlip } ) }
						label={ __( 'Flip Title and Bar Positions', 'vexaltrix' ) }
					/>
				</>
			) }
			<UAGNumberControl
				label={ __( 'Starting Number', 'vexaltrix' ) }
				value={ startNumber }
				data={ {
					value: startNumber,
					label: 'startNumber',
				} }
				displayUnit={ false }
				setAttributes={ setAttributes }
				min={ layout !== 'number' ? 0 : false }
				required={ layout !== 'number' ? true : false }
				help={
					layout !== 'number'
						? __( 'Note: Please use positive values for Circle and Bar layouts.', 'vexaltrix' )
						: false
				}
				showControlHeader={ false }
				enableDynamicContent={ true }
				dynamicContentType="text"
				name="startNumber"
			/>
			<UAGNumberControl
				label={ __( 'Ending Number', 'vexaltrix' ) }
				value={ endNumber }
				data={ {
					value: endNumber,
					label: 'endNumber',
				} }
				displayUnit={ false }
				setAttributes={ setAttributes }
				min={ layout !== 'number' ? 0 : false }
				required={ layout !== 'number' ? true : false }
				help={
					layout !== 'number'
						? __( 'Note: Please use positive values for Circle and Bar layouts.', 'vexaltrix' )
						: false
				}
				showControlHeader={ false }
				enableDynamicContent={ true }
				dynamicContentType="text"
				name="endNumber"
			/>
			{ layout !== 'number' && (
				<UAGNumberControl
					label={ __( 'Total Number', 'vexaltrix' ) }
					value={ totalNumber }
					data={ {
						value: totalNumber,
						label: 'totalNumber',
					} }
					displayUnit={ false }
					setAttributes={ setAttributes }
					min={ minTotal }
					required={ true }
					help={ __(
						'Note: Total Number should be more than or equal to the Ending Number (or the Starting number in case you want to animate the Counter in reverse direction).',
						'vexaltrix'
					) }
					showControlHeader={ false }
					enableDynamicContent={ true }
					dynamicContentType="text"
					name="totalNumber"
				/>
			) }
			<Range
				label={ __( 'Decimal Places', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ decimalPlaces }
				data={ {
					value: decimalPlaces,
					label: 'decimalPlaces',
				} }
				min={ 0 }
				step={ 1 }
				max={ 10 }
				displayUnit={ false }
			/>
			<UAGTextControl
				variant="inline"
				label={ __( 'Number Prefix', 'vexaltrix' ) }
				value={ numberPrefix }
				data={ {
					value: numberPrefix,
					label: 'numberPrefix',
				} }
				setAttributes={ setAttributes }
				onChange={ ( value ) => setAttributes( { numberPrefix: value } ) }
			/>
			<UAGTextControl
				variant="inline"
				label={ __( 'Number Suffix', 'vexaltrix' ) }
				value={ numberSuffix }
				data={ {
					value: numberSuffix,
					label: 'numberSuffix',
				} }
				setAttributes={ setAttributes }
				onChange={ ( value ) => setAttributes( { numberSuffix: value } ) }
			/>
			<UAGNumberControl
				label={ __( 'Animation Duration', 'vexaltrix' ) }
				value={ animationDuration }
				data={ {
					value: animationDuration,
					label: 'animationDuration',
				} }
				displayUnit={ false }
				setAttributes={ setAttributes }
				min={ 1 }
				step={ 100 }
				required={ true }
				showControlHeader={ false }
			/>
			<UAGSelectControl
				label={ __( 'Thousand(s)', 'vexaltrix' ) }
				data={ {
					value: thousandSeparator,
					label: 'thousandSeparator',
				} }
				setAttributes={ setAttributes }
				options={ [
					{ value: '', label: __( 'None', 'vexaltrix' ) },
					{ value: ',', label: __( 'Comma', 'vexaltrix' ) },
					{ value: '.', label: __( 'Dot', 'vexaltrix' ) },
					{ value: ' ', label: __( 'Whitespace', 'vexaltrix' ) },
					{ value: "'", label: __( 'Apostrophe', 'vexaltrix' ) },
				] }
			/>
		</UAGAdvancedPanelBody>
	);

	const iconImagePanel = (
		<UAGAdvancedPanelBody title={ __( 'Image/Icon', 'vexaltrix' ) } initialOpen={ false }>
			<ToggleControl
				checked={ showIcon }
				onChange={ () => setAttributes( { showIcon: ! showIcon } ) }
				label={ __( 'Enable Icon/Image', 'vexaltrix' ) }
			/>
			{ showIcon && ( layout === 'circle' || layout === 'number' ) && (
				<UAGSelectControl
					label={ __( 'Select Position', 'vexaltrix' ) }
					data={ {
						value: iconImgPosition,
						label: 'iconImgPosition',
					} }
					setAttributes={ setAttributes }
					options={ layout === 'circle' ? circleIconPositionOptions : numberIconPositionOptions }
				/>
			) }
			{ showIcon && (
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Select Source', 'vexaltrix' ) }
					data={ {
						value: sourceType,
						label: 'sourceType',
					} }
					options={ [
						{
							value: 'icon',
							label: __( 'Icon', 'vexaltrix' ),
						},
						{
							value: 'image',
							label: __( 'Image', 'vexaltrix' ),
						},
					] }
				/>
			) }
			{ false !== showIcon && sourceType === 'icon' && (
				<>
					<UAGIconPicker
						label={ __( 'Icon', 'vexaltrix' ) }
						value={ icon }
						onChange={ ( value ) => setAttributes( { icon: value } ) }
					/>
				</>
			) }
			{ false !== showIcon && sourceType === 'image' && (
				<>
					<UAGMediaPicker
						onSelectImage={ onSelectImage }
						backgroundImage={ iconImage }
						onRemoveImage={ onRemoveImage }
						disableDynamicContent={ true }
					/>
					{ iconImage && iconImage.url !== 'null' && iconImage.url !== '' && (
						<UAGSelectControl
							label={ __( 'Image Size', 'vexaltrix' ) }
							data={ {
								value: imageSize,
								label: 'imageSize',
							} }
							setAttributes={ setAttributes }
							options={ imageSizeOptions }
						/>
					) }
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const iconImageStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Image/Icon', 'vexaltrix' ) } initialOpen={ false }>
			{ sourceType === 'image' && (
				<ToggleControl
					checked={ imageWidthType }
					onChange={ () =>
						setAttributes( {
							imageWidthType: ! imageWidthType,
						} )
					}
					label={ __( 'Custom Width', 'vexaltrix' ) }
					help={ __( 'Turn this off to inherit the natural width of Image.', 'vexaltrix' ) }
				/>
			) }
			{ sourceType === 'image' && imageWidthType && (
				<ResponsiveSlider
					label={ __( 'Image Width', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					data={ {
						desktop: {
							value: imageWidth,
							label: 'imageWidth',
							unit: {
								value: imageWidthUnit,
								label: 'imageWidthUnit',
							},
						},
						tablet: {
							value: imageWidthTablet,
							label: 'imageWidthTablet',
							unit: {
								value: imageWidthUnitTablet,
								label: 'imageWidthUnitTablet',
							},
						},
						mobile: {
							value: imageWidthMobile,
							label: 'imageWidthMobile',
							unit: {
								value: imageWidthUnitMobile,
								label: 'imageWidthUnitMobile',
							},
						},
					} }
					limitMin={ { px: 0, '%': 0, em: 0 } }
					limitMax={ { px: 500, '%': 100, em: 100 } }
					unit={ {
						value: imageWidthUnit,
						label: 'imageWidthUnit',
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
							name: __( 'EM', 'vexaltrix' ),
							unitValue: 'em',
						},
					] }
				/>
			) }
			{ sourceType === 'icon' && (
				<>
					<ResponsiveSlider
						label={ __( 'Width', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						data={ {
							desktop: {
								value: iconSize,
								label: 'iconSize',
								unit: {
									value: iconSizeType,
									label: 'iconSizeType',
								},
							},
							tablet: {
								value: iconSizeTablet,
								label: 'iconSizeTablet',
								unit: {
									value: iconSizeTypeTablet,
									label: 'iconSizeTypeTablet',
								},
							},
							mobile: {
								value: iconSizeMobile,
								label: 'iconSizeMobile',
								unit: {
									value: iconSizeTypeMobile,
									label: 'iconSizeTypeMobile',
								},
							},
						} }
						limitMin={ { px: 0, '%': 0, em: 0 } }
						limitMax={ { px: 500, '%': 100, em: 100 } }
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
							{
								name: __( 'EM', 'vexaltrix' ),
								unitValue: 'em',
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
									colorValue={ iconColor ? iconColor : '' }
									data={ {
										value: iconColor,
										label: 'iconColor',
									} }
									setAttributes={ setAttributes }
								/>
								<AdvancedPopColorControl
									label={ __( 'Icon Background Color', 'vexaltrix' ) }
									colorValue={ iconBackgroundColor ? iconBackgroundColor : '' }
									data={ {
										value: iconBackgroundColor,
										label: 'iconBackgroundColor',
									} }
									setAttributes={ setAttributes }
								/>
							</>
						}
						hover={
							<>
								<AdvancedPopColorControl
									label={ __( 'Color', 'vexaltrix' ) }
									colorValue={ iconHoverColor ? iconHoverColor : '' }
									data={ {
										value: iconHoverColor,
										label: 'iconHoverColor',
									} }
									setAttributes={ setAttributes }
								/>

								<AdvancedPopColorControl
									label={ __( 'Icon Background Color', 'vexaltrix' ) }
									colorValue={ iconBackgroundHoverColor ? iconBackgroundHoverColor : '' }
									data={ {
										value: iconBackgroundHoverColor,
										label: 'iconBackgroundHoverColor',
									} }
									setAttributes={ setAttributes }
								/>
							</>
						}
						disableBottomSeparator={ false }
					/>
				</>
			) }
			<ResponsiveBorder
				disabledBorderTitle={ false }
				setAttributes={ setAttributes }
				prefix={ 'iconWrap' }
				attributes={ attributes }
				deviceType={ deviceType }
				disableBottomSeparator={ false }
			/>
			<SpacingControl
				label={ __( 'Padding', 'vexaltrix' ) }
				valueTop={ {
					value: iconTopPadding,
					label: 'iconTopPadding',
				} }
				valueRight={ {
					value: iconRightPadding,
					label: 'iconRightPadding',
				} }
				valueBottom={ {
					value: iconBottomPadding,
					label: 'iconBottomPadding',
				} }
				valueLeft={ {
					value: iconLeftPadding,
					label: 'iconLeftPadding',
				} }
				valueTopTablet={ {
					value: iconTopPaddingTablet,
					label: 'iconTopPaddingTablet',
				} }
				valueRightTablet={ {
					value: iconRightPaddingTablet,
					label: 'iconRightPaddingTablet',
				} }
				valueBottomTablet={ {
					value: iconBottomPaddingTablet,
					label: 'iconBottomPaddingTablet',
				} }
				valueLeftTablet={ {
					value: iconLeftPaddingTablet,
					label: 'iconLeftPaddingTablet',
				} }
				valueTopMobile={ {
					value: iconTopPaddingMobile,
					label: 'iconTopPaddingMobile',
				} }
				valueRightMobile={ {
					value: iconRightPaddingMobile,
					label: 'iconRightPaddingMobile',
				} }
				valueBottomMobile={ {
					value: iconBottomPaddingMobile,
					label: 'iconBottomPaddingMobile',
				} }
				valueLeftMobile={ {
					value: iconLeftPaddingMobile,
					label: 'iconLeftPaddingMobile',
				} }
				unit={ {
					value: iconPaddingUnit,
					label: 'iconPaddingUnit',
				} }
				mUnit={ {
					value: iconPaddingUnitMobile,
					label: 'iconPaddingUnitMobile',
				} }
				tUnit={ {
					value: iconPaddingUnitTablet,
					label: 'iconPaddingUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: iconPaddingLink,
					label: 'iconPaddingLink',
				} }
			/>
			<SpacingControl
				label={ __( 'Margin', 'vexaltrix' ) }
				valueTop={ {
					value: iconTopMargin,
					label: 'iconTopMargin',
				} }
				valueRight={ {
					value: iconRightMargin,
					label: 'iconRightMargin',
				} }
				valueBottom={ {
					value: iconBottomMargin,
					label: 'iconBottomMargin',
				} }
				valueLeft={ {
					value: iconLeftMargin,
					label: 'iconLeftMargin',
				} }
				valueTopTablet={ {
					value: iconTopMarginTablet,
					label: 'iconTopMarginTablet',
				} }
				valueRightTablet={ {
					value: iconRightMarginTablet,
					label: 'iconRightMarginTablet',
				} }
				valueBottomTablet={ {
					value: iconBottomMarginTablet,
					label: 'iconBottomMarginTablet',
				} }
				valueLeftTablet={ {
					value: iconLeftMarginTablet,
					label: 'iconLeftMarginTablet',
				} }
				valueTopMobile={ {
					value: iconTopMarginMobile,
					label: 'iconTopMarginMobile',
				} }
				valueRightMobile={ {
					value: iconRightMarginMobile,
					label: 'iconRightMarginMobile',
				} }
				valueBottomMobile={ {
					value: iconBottomMarginMobile,
					label: 'iconBottomMarginMobile',
				} }
				valueLeftMobile={ {
					value: iconLeftMarginMobile,
					label: 'iconLeftMarginMobile',
				} }
				unit={ {
					value: iconMarginUnit,
					label: 'iconMarginUnit',
				} }
				mUnit={ {
					value: iconMarginUnitMobile,
					label: 'iconMarginUnitMobile',
				} }
				tUnit={ {
					value: iconMarginUnitTablet,
					label: 'iconMarginUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: iconMarginLink,
					label: 'iconMarginLink',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const headlineStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Headline', 'vexaltrix' ) } initialOpen={ false }>
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
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: headingLoadGoogleFonts,
					label: 'headingLoadGoogleFonts',
				} }
				fontFamily={ {
					value: headingFontFamily,
					label: 'headingFontFamily',
				} }
				fontWeight={ {
					value: headingFontWeight,
					label: 'headingFontWeight',
				} }
				fontStyle={ {
					value: headingFontStyle,
					label: 'headingFontStyle',
				} }
				transform={ {
					value: headingTransform,
					label: 'headingTransform',
				} }
				decoration={ {
					value: headingDecoration,
					label: 'headingDecoration',
				} }
				fontSizeType={ {
					value: headingFontSizeType,
					label: 'headingFontSizeType',
				} }
				fontSize={ {
					value: headingFontSize,
					label: 'headingFontSize',
				} }
				fontSizeMobile={ {
					value: headingFontSizeMobile,
					label: 'headingFontSizeMobile',
				} }
				fontSizeTablet={ {
					value: headingFontSizeTablet,
					label: 'headingFontSizeTablet',
				} }
				lineHeightType={ {
					value: headingLineHeightType,
					label: 'headingLineHeightType',
				} }
				lineHeight={ {
					value: headingLineHeight,
					label: 'headingLineHeight',
				} }
				lineHeightMobile={ {
					value: headingLineHeightMobile,
					label: 'headingLineHeightMobile',
				} }
				lineHeightTablet={ {
					value: headingLineHeightTablet,
					label: 'headingLineHeightTablet',
				} }
				letterSpacingType={ {
					value: headingLetterSpacingType,
					label: 'headingLetterSpacingType',
				} }
				letterSpacing={ {
					value: headingLetterSpacing,
					label: 'headingLetterSpacing',
				} }
				letterSpacingTablet={ {
					value: headingLetterSpacingTablet,
					label: 'headingLetterSpacingTablet',
				} }
				letterSpacingMobile={ {
					value: headingLetterSpacingMobile,
					label: 'headingLetterSpacingMobile',
				} }
			/>
			<SpacingControl
				label={ __( 'Margin', 'vexaltrix' ) }
				valueTop={ {
					value: headingTopMargin,
					label: 'headingTopMargin',
				} }
				valueRight={ {
					value: headingRightMargin,
					label: 'headingRightMargin',
				} }
				valueBottom={ {
					value: headingBottomMargin,
					label: 'headingBottomMargin',
				} }
				valueLeft={ {
					value: headingLeftMargin,
					label: 'headingLeftMargin',
				} }
				valueTopTablet={ {
					value: headingTopMarginTablet,
					label: 'headingTopMarginTablet',
				} }
				valueRightTablet={ {
					value: headingRightMarginTablet,
					label: 'headingRightMarginTablet',
				} }
				valueBottomTablet={ {
					value: headingBottomMarginTablet,
					label: 'headingBottomMarginTablet',
				} }
				valueLeftTablet={ {
					value: headingLeftMarginTablet,
					label: 'headingLeftMarginTablet',
				} }
				valueTopMobile={ {
					value: headingTopMarginMobile,
					label: 'headingTopMarginMobile',
				} }
				valueRightMobile={ {
					value: headingRightMarginMobile,
					label: 'headingRightMarginMobile',
				} }
				valueBottomMobile={ {
					value: headingBottomMarginMobile,
					label: 'headingBottomMarginMobile',
				} }
				valueLeftMobile={ {
					value: headingLeftMarginMobile,
					label: 'headingLeftMarginMobile',
				} }
				unit={ {
					value: headingMarginUnit,
					label: 'headingMarginUnit',
				} }
				mUnit={ {
					value: headingMarginUnitMobile,
					label: 'headingMarginUnitMobile',
				} }
				tUnit={ {
					value: headingMarginUnitTablet,
					label: 'headingMarginUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: headingMarginLink,
					label: 'headingMarginLink',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const numberStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Number', 'vexaltrix' ) } initialOpen={ false }>
			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ numberColor ? numberColor : '' }
				data={ {
					value: numberColor,
					label: 'numberColor',
				} }
				setAttributes={ setAttributes }
			/>
			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: numberLoadGoogleFonts,
					label: 'numberLoadGoogleFonts',
				} }
				fontFamily={ {
					value: numberFontFamily,
					label: 'numberFontFamily',
				} }
				fontWeight={ {
					value: numberFontWeight,
					label: 'numberFontWeight',
				} }
				fontStyle={ {
					value: numberFontStyle,
					label: 'numberFontStyle',
				} }
				transform={ {
					value: numberTransform,
					label: 'numberTransform',
				} }
				decoration={ {
					value: numberDecoration,
					label: 'numberDecoration',
				} }
				fontSizeType={ {
					value: numberFontSizeType,
					label: 'numberFontSizeType',
				} }
				fontSize={ {
					value: numberFontSize,
					label: 'numberFontSize',
				} }
				fontSizeMobile={ {
					value: numberFontSizeMobile,
					label: 'numberFontSizeMobile',
				} }
				fontSizeTablet={ {
					value: numberFontSizeTablet,
					label: 'numberFontSizeTablet',
				} }
				lineHeightType={ {
					value: numberLineHeightType,
					label: 'numberLineHeightType',
				} }
				lineHeight={ {
					value: numberLineHeight,
					label: 'numberLineHeight',
				} }
				lineHeightMobile={ {
					value: numberLineHeightMobile,
					label: 'numberLineHeightMobile',
				} }
				lineHeightTablet={ {
					value: numberLineHeightTablet,
					label: 'numberLineHeightTablet',
				} }
				letterSpacingType={ {
					value: numberLetterSpacingType,
					label: 'numberLetterSpacingType',
				} }
				letterSpacing={ {
					value: numberLetterSpacing,
					label: 'numberLetterSpacing',
				} }
				letterSpacingTablet={ {
					value: numberLetterSpacingTablet,
					label: 'numberLetterSpacingTablet',
				} }
				letterSpacingMobile={ {
					value: numberLetterSpacingMobile,
					label: 'numberLetterSpacingMobile',
				} }
			/>
			<SpacingControl
				label={ layout !== 'bars' ? __( 'Margin', 'vexaltrix' ) : __( 'Padding', 'vexaltrix' ) }
				valueTop={ {
					value: numberTopMargin,
					label: 'numberTopMargin',
				} }
				valueRight={ {
					value: numberRightMargin,
					label: 'numberRightMargin',
				} }
				valueBottom={ {
					value: numberBottomMargin,
					label: 'numberBottomMargin',
				} }
				valueLeft={ {
					value: numberLeftMargin,
					label: 'numberLeftMargin',
				} }
				valueTopTablet={ {
					value: numberTopMarginTablet,
					label: 'numberTopMarginTablet',
				} }
				valueRightTablet={ {
					value: numberRightMarginTablet,
					label: 'numberRightMarginTablet',
				} }
				valueBottomTablet={ {
					value: numberBottomMarginTablet,
					label: 'numberBottomMarginTablet',
				} }
				valueLeftTablet={ {
					value: numberLeftMarginTablet,
					label: 'numberLeftMarginTablet',
				} }
				valueTopMobile={ {
					value: numberTopMarginMobile,
					label: 'numberTopMarginMobile',
				} }
				valueRightMobile={ {
					value: numberRightMarginMobile,
					label: 'numberRightMarginMobile',
				} }
				valueBottomMobile={ {
					value: numberBottomMarginMobile,
					label: 'numberBottomMarginMobile',
				} }
				valueLeftMobile={ {
					value: numberLeftMarginMobile,
					label: 'numberLeftMarginMobile',
				} }
				unit={ {
					value: numberMarginUnit,
					label: 'numberMarginUnit',
				} }
				mUnit={ {
					value: numberMarginUnitMobile,
					label: 'numberMarginUnitMobile',
				} }
				tUnit={ {
					value: numberMarginUnitTablet,
					label: 'numberMarginUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: numberMarginLink,
					label: 'numberMarginLink',
				} }
			/>
			<ResponsiveSlider
				label={ __( 'Prefix Right Margin', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				data={ {
					desktop: {
						value: prefixRightDistance,
						label: 'prefixRightDistance',
					},
					tablet: {
						value: prefixRightDistanceTablet,
						label: 'prefixRightDistanceTablet',
					},
					mobile: {
						value: prefixRightDistanceMobile,
						label: 'prefixRightDistanceMobile',
					},
				} }
				min={ 0 }
				step={ 1 }
				max={ 100 }
				displayUnit={ false }
			/>
			<ResponsiveSlider
				label={ __( 'Suffix Left Margin', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				data={ {
					desktop: {
						value: suffixLeftDistance,
						label: 'suffixLeftDistance',
					},
					tablet: {
						value: suffixLeftDistanceTablet,
						label: 'suffixLeftDistanceTablet',
					},
					mobile: {
						value: suffixLeftDistanceMobile,
						label: 'suffixLeftDistanceMobile',
					},
				} }
				min={ 0 }
				step={ 1 }
				max={ 100 }
				displayUnit={ false }
			/>
		</UAGAdvancedPanelBody>
	);

	const circleStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Circle', 'vexaltrix' ) } initialOpen={ false }>
			<Range
				label={ __( 'Circle Size', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ circleSize }
				data={ {
					value: circleSize,
					label: 'circleSize',
				} }
				min={ 10 }
				step={ 10 }
				max={ 500 }
				displayUnit={ false }
			/>
			<Range
				label={ __( 'Stroke Size', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ circleStokeSize }
				data={ {
					value: circleStokeSize,
					label: 'circleStokeSize',
				} }
				min={ 0 }
				step={ 1 }
				max={ 100 }
				displayUnit={ false }
			/>
			<AdvancedPopColorControl
				label={ __( 'Progress Color', 'vexaltrix' ) }
				colorValue={ circleForeground ? circleForeground : '' }
				data={ {
					value: circleForeground,
					label: 'circleForeground',
				} }
				setAttributes={ setAttributes }
			/>
			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ circleBackground ? circleBackground : '' }
				data={ {
					value: circleBackground,
					label: 'circleBackground',
				} }
				setAttributes={ setAttributes }
			/>
		</UAGAdvancedPanelBody>
	);

	const barStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Bar', 'vexaltrix' ) } initialOpen={ false }>
			<Range
				label={ __( 'Bar Size', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ barSize }
				data={ {
					value: barSize,
					label: 'barSize',
				} }
				min={ 0 }
				step={ 1 }
				max={ 100 }
				displayUnit={ false }
			/>
			<AdvancedPopColorControl
				label={ __( 'Progress Color', 'vexaltrix' ) }
				colorValue={ barForeground ? barForeground : '' }
				data={ {
					value: barForeground,
					label: 'barForeground',
				} }
				setAttributes={ setAttributes }
			/>
			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ barBackground ? barBackground : '' }
				data={ {
					value: barBackground,
					label: 'barBackground',
				} }
				setAttributes={ setAttributes }
			/>
		</UAGAdvancedPanelBody>
	);

	const spacingPanel = (
		<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
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
		</UAGAdvancedPanelBody>
	);

	// We shall release the box-shadow feature later due to some technical challenges with the circle layout.

	const boxShadowSettings = (
		<UAGAdvancedPanelBody title={ __( 'Box Shadow', 'vexaltrix' ) } initialOpen={ false }>
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
		</UAGAdvancedPanelBody>
	);

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
			<BlockControls key="controls">
				<AlignmentToolbar value={ align } onChange={ ( value ) => setAttributes( { align: value } ) } />
			</BlockControls>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ generalPanel }
						{ /* No icons necessary for bar layout */ }
						{ layout !== 'bars' && iconImagePanel }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
							proUpgradePanel() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ numberStylePanel }
						{ headlineStylePanel }
						{ layout === 'circle' && circleStylePanel }
						{ layout === 'bars' && barStylePanel }
						{ layout !== 'bars' && showIcon && iconImageStylePanel }
						{ spacingPanel }
						{ /* We will be releasing the box-shadow feature later due to some technical challenges with circle layout*/ }
						{ /* {layout !== 'number' && boxShadowSettings} */ }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
}
