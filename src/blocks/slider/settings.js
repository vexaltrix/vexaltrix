import { useEffect, memo } from '@wordpress/element';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import Range from '@Components/range/Range.js';
import ResponsiveSlider from '@Components/responsive-slider';
import UAGSelectControl from '@Components/select-control';
import { __ } from '@wordpress/i18n';

import { InspectorControls, BlockControls } from '@wordpress/block-editor';
import BoxShadowControl from '@Components/box-shadow';
import SpacingControl from '@Components/spacing-control';
import Background from '@Components/background';
import ResponsiveBorder from '@Components/responsive-border';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import MultiButtonsControl from '@Components/multi-buttons-control';
import { Icon, ToggleControl, ToolbarGroup, ToolbarButton } from '@wordpress/components';
import renderCustomIcon from '@Controls/renderCustomIcon';
import UAGTabsControl from '@Components/tabs';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control';
import { boxShadowPresets, boxShadowHoverPresets } from './presets';
import UAGPresets from '@Components/presets';
import { createBlock } from '@wordpress/blocks';
import { applyFilters } from '@wordpress/hooks';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const Settings = ( props ) => {
	const { attributes, setAttributes, deviceType, insertBlock, block, swiperInstance } = props;
	const {
		block_id,
		pauseOn,
		infiniteLoop,
		transitionSpeed,
		displayArrows,
		displayDots,
		autoplay,
		autoplaySpeed,
		transitionEffect,

		backgroundType,
		backgroundImageDesktop,
		backgroundImageTablet,
		backgroundImageMobile,
		backgroundColor,
		backgroundPositionDesktop,
		backgroundPositionTablet,
		backgroundPositionMobile,
		backgroundAttachmentDesktop,
		backgroundAttachmentTablet,
		backgroundAttachmentMobile,
		backgroundRepeatDesktop,
		backgroundRepeatTablet,
		backgroundRepeatMobile,
		backgroundSizeDesktop,
		backgroundSizeTablet,
		backgroundSizeMobile,
		backgroundImageColor,
		gradientValue,
		useSeparateBoxShadows,
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

		topPaddingDesktop,
		bottomPaddingDesktop,
		leftPaddingDesktop,
		rightPaddingDesktop,
		topPaddingTablet,
		bottomPaddingTablet,
		leftPaddingTablet,
		rightPaddingTablet,
		topPaddingMobile,
		bottomPaddingMobile,
		leftPaddingMobile,
		rightPaddingMobile,
		paddingType,
		paddingTypeTablet,
		paddingTypeMobile,
		paddingLink,
		topMarginDesktop,
		bottomMarginDesktop,
		leftMarginDesktop,
		rightMarginDesktop,
		topMarginTablet,
		bottomMarginTablet,
		leftMarginTablet,
		rightMarginTablet,
		topMarginMobile,
		bottomMarginMobile,
		leftMarginMobile,
		rightMarginMobile,
		marginType,
		marginTypeTablet,
		marginTypeMobile,
		marginLink,

		backgroundCustomSizeDesktop,
		backgroundCustomSizeTablet,
		backgroundCustomSizeMobile,
		backgroundCustomSizeType,
		overlayType,
		customPosition,
		xPositionDesktop,
		xPositionTablet,
		xPositionMobile,
		xPositionType,
		xPositionTypeTablet,
		xPositionTypeMobile,
		yPositionDesktop,
		yPositionTablet,
		yPositionMobile,
		yPositionType,
		yPositionTypeTablet,
		yPositionTypeMobile,
		arrowSize,
		arrowSizeTablet,
		arrowSizeMobile,
		arrowPadding,
		arrowPaddingTablet,
		arrowPaddingMobile,
		arrowColor,
		arrowBgColor,
		arrowDistance,
		arrowDistanceTablet,
		arrowDistanceMobile,
		verticalAlign,
		dotsMarginTop,
		dotsMarginTopTablet,
		dotsMarginTopMobile,
		minHeight,
		minHeightTablet,
		minHeightMobile,
	} = attributes;

	// This useEffect ensures that background size is set to cover, so as to ensure color takes up entire width and height,
	// in case bg type was set to Image before and given a custom width and height.
	useEffect( () => {
		if ( backgroundType === 'color' ) {
			setAttributes( {
				backgroundSizeDesktop: 'cover',
				backgroundSizeTablet: 'cover',
				backgroundSizeMobile: 'cover',
			} );
		}
	}, [ backgroundType ] );

	const getBlockControls = () => {
		return (
			<BlockControls>
				<ToolbarGroup>
					<ToolbarButton
						icon="insert"
						label={ __( 'Add Slide', 'vexaltrix' ) }
						onClick={ () => {
							insertBlock(
								createBlock( 'vexaltrix/slider-child' ),
								block.innerBlocks.length,
								block.clientId
							);

							setAttributes( { slideItem: attributes.slideItem + 1 } );
							swiperInstance.activeIndex = attributes.slideItem + 1;
						} }
					/>
				</ToolbarGroup>
			</BlockControls>
		);
	};

	const verticalAlignOptions = [
		{
			value: 'start',
			tooltip: __( 'Top', 'vexaltrix' ),
			icon: <Icon icon={ renderCustomIcon( `flex-column-start` ) } />,
		},
		{
			value: 'center',
			tooltip: __( 'Center', 'vexaltrix' ),
			icon: <Icon icon={ renderCustomIcon( `flex-column-center` ) } />,
		},
		{
			value: 'end',
			tooltip: __( 'Bottom', 'vexaltrix' ),
			icon: <Icon icon={ renderCustomIcon( `flex-column-end` ) } />,
		},
	];

	const generalSettings = () => {
		const toggleInfiniteLoop = () => {
			setAttributes( { infiniteLoop: ! infiniteLoop } );
		};

		const toggleAutoplay = () => {
			setAttributes( { autoplay: ! autoplay } );
		};

		const toggleDisplayArrows = () => {
			setAttributes( { displayArrows: ! displayArrows } );
		};

		const toggleDisplayDots = () => {
			setAttributes( { displayDots: ! displayDots } );
		};

		const afterNavigationOptions = applyFilters( 'vexaltrix.slider.tab_general.displayDots.after', '', props );
		const afterAutoPlayOptions = applyFilters( 'vexaltrix.slider.tab_general.autoplay.after', '', props );
		const afterTransitionOptions = applyFilters( 'vexaltrix.slider.tab_general.transitionSpeed.after', '', props );

		const sliderSettings = () => {
			return (
				<>
					<UAGAdvancedPanelBody title={ __( 'Slider', 'vexaltrix' ) } initialOpen={ true }>
						<ToggleControl
							label={ __( 'Autoplay', 'vexaltrix' ) }
							checked={ autoplay }
							onChange={ toggleAutoplay }
							help={ __(
								"Above setting will only take effect once you are on the live page, and not while you're editing.",
								'vexaltrix'
							) }
						/>
						{ autoplay === true && (
							<>
								<Range
									label={ __( 'Autoplay Speed (ms)', 'vexaltrix' ) }
									setAttributes={ setAttributes }
									value={ autoplaySpeed }
									data={ {
										value: autoplaySpeed,
										label: 'autoplaySpeed',
									} }
									min={ 0 }
									max={ 15000 }
									displayUnit={ false }
								/>
								<MultiButtonsControl
									setAttributes={ setAttributes }
									label={ __( 'Pause On', 'vexaltrix' ) }
									data={ {
										value: pauseOn,
										label: 'pauseOn',
									} }
									options={ [
										{
											value: 'hover',
											label: __( 'Hover', 'vexaltrix' ),
										},
										{
											value: 'click',
											label: __( 'Interaction', 'vexaltrix' ),
										},
										{
											value: 'none',
											label: __( 'None', 'vexaltrix' ),
										},
									] }
									help={ __(
										"Above setting will only take effect once you are on the live page, and not while you're editing.",
										'vexaltrix'
									) }
								/>
							</>
						) }
						{ afterAutoPlayOptions }
						<ToggleControl
							label={ __( 'Infinite Loop', 'vexaltrix' ) }
							checked={ infiniteLoop }
							onChange={ toggleInfiniteLoop }
							help={ __(
								"Above setting will only take effect once you are on the live page, and not while you're editing.",
								'vexaltrix'
							) }
						/>
						<ResponsiveSlider
							label={ __( 'Minimum Height', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: minHeight,
									label: 'minHeight',
								},
								tablet: {
									value: minHeightTablet,
									label: 'minHeightTablet',
								},
								mobile: {
									value: minHeightMobile,
									label: 'minHeightMobile',
								},
							} }
							min={ 100 }
							max={ 1000 }
							displayUnit={ false }
							setAttributes={ setAttributes }
						/>
						<UAGSelectControl
							label={ __( 'Transition Effect', 'vexaltrix' ) }
							data={ {
								value: transitionEffect,
								label: 'transitionEffect',
							} }
							onChange={ ( value ) => setAttributes( { transitionEffect: value } ) }
							setAttributes={ setAttributes }
							help={ __(
								"Above setting will only take effect once you are on the live page, and not while you're editing.",
								'vexaltrix'
							) }
						>
							<option value="slide">{ __( 'Slide', 'vexaltrix' ) }</option>
							<option value="fade">{ __( 'Fade', 'vexaltrix' ) }</option>
							<option value="flip">{ __( 'Flip', 'vexaltrix' ) }</option>
						</UAGSelectControl>
						<Range
							label={ __( 'Transition Speed (ms)', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ transitionSpeed }
							data={ {
								value: transitionSpeed,
								label: 'transitionSpeed',
							} }
							onChange={ ( value ) => setAttributes( { transitionSpeed: value } ) }
							min={ 100 }
							max={ 9999 }
							displayUnit={ false }
						/>
						{ afterTransitionOptions }
					</UAGAdvancedPanelBody>
					<UAGAdvancedPanelBody title={ __( 'Navigation', 'vexaltrix' ) } initialOpen={ false }>
						<ToggleControl
							label={ __( 'Arrows', 'vexaltrix' ) }
							checked={ displayArrows }
							onChange={ toggleDisplayArrows }
						/>
						<ToggleControl
							label={ __( 'Dots', 'vexaltrix' ) }
							checked={ displayDots }
							onChange={ toggleDisplayDots }
						/>
						{ afterNavigationOptions }
					</UAGAdvancedPanelBody>
				</>
			);
		};

		return <>{ sliderSettings() }</>;
	};

	const contentSettings = () => {
		return (
			<>
				<UAGAdvancedPanelBody title={ __( 'Content', 'vexaltrix' ) } initialOpen={ true }>
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Vertical Alignment', 'vexaltrix' ) }
						data={ {
							value: verticalAlign,
							label: 'verticalAlign',
						} }
						options={ verticalAlignOptions }
						showIcons={ true }
						responsive={ false }
					/>
				</UAGAdvancedPanelBody>
			</>
		);
	};

	const backgroundSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Background', 'vexaltrix' ) } initialOpen={ false }>
				<Background
					setAttributes={ setAttributes }
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
					backgroundImageColor={ {
						value: backgroundImageColor,
						label: 'backgroundImageColor',
					} }
					backgroundSize={ {
						desktop: {
							value: backgroundSizeDesktop,
							label: 'backgroundSizeDesktop',
						},
						tablet: {
							value: backgroundSizeTablet,
							label: 'backgroundSizeTablet',
						},
						mobile: {
							value: backgroundSizeMobile,
							label: 'backgroundSizeMobile',
						},
					} }
					backgroundCustomSize={ {
						desktop: {
							value: backgroundCustomSizeDesktop,
							label: 'backgroundCustomSizeDesktop',
						},
						tablet: {
							value: backgroundCustomSizeTablet,
							label: 'backgroundCustomSizeTablet',
						},
						mobile: {
							value: backgroundCustomSizeMobile,
							label: 'backgroundCustomSizeMobile',
						},
					} }
					backgroundCustomSizeType={ {
						value: backgroundCustomSizeType,
						label: 'backgroundCustomSizeType',
					} }
					backgroundRepeat={ {
						desktop: {
							value: backgroundRepeatDesktop,
							label: 'backgroundRepeatDesktop',
						},
						tablet: {
							value: backgroundRepeatTablet,
							label: 'backgroundRepeatTablet',
						},
						mobile: {
							value: backgroundRepeatMobile,
							label: 'backgroundRepeatMobile',
						},
					} }
					backgroundAttachment={ {
						desktop: {
							value: backgroundAttachmentDesktop,
							label: 'backgroundAttachmentDesktop',
						},
						tablet: {
							value: backgroundAttachmentTablet,
							label: 'backgroundAttachmentTablet',
						},
						mobile: {
							value: backgroundAttachmentMobile,
							label: 'backgroundAttachmentMobile',
						},
					} }
					backgroundPosition={ {
						desktop: {
							value: backgroundPositionDesktop,
							label: 'backgroundPositionDesktop',
						},
						tablet: {
							value: backgroundPositionTablet,
							label: 'backgroundPositionTablet',
						},
						mobile: {
							value: backgroundPositionMobile,
							label: 'backgroundPositionMobile',
						},
					} }
					backgroundImage={ {
						desktop: {
							value: backgroundImageDesktop,
							label: 'backgroundImageDesktop',
						},
						tablet: {
							value: backgroundImageTablet,
							label: 'backgroundImageTablet',
						},
						mobile: {
							value: backgroundImageMobile,
							label: 'backgroundImageMobile',
						},
					} }
					imageResponsive={ true }
					backgroundColor={ {
						value: backgroundColor,
						label: 'backgroundColor',
					} }
					backgroundType={ {
						value: backgroundType,
						label: 'backgroundType',
					} }
					overlayType={ {
						value: overlayType,
						label: 'overlayType',
					} }
					gradientOverlay={ {
						value: true,
					} }
					customPosition={ {
						value: customPosition,
						label: 'customPosition',
					} }
					xPositionDesktop={ {
						value: xPositionDesktop,
						label: 'xPositionDesktop',
					} }
					xPositionTablet={ {
						value: xPositionTablet,
						label: 'xPositionTablet',
					} }
					xPositionMobile={ {
						value: xPositionMobile,
						label: 'xPositionMobile',
					} }
					xPositionType={ {
						value: xPositionType,
						label: 'xPositionType',
					} }
					xPositionTypeTablet={ {
						value: xPositionTypeTablet,
						label: 'xPositionTypeTablet',
					} }
					xPositionTypeMobile={ {
						value: xPositionTypeMobile,
						label: 'xPositionTypeMobile',
					} }
					yPositionDesktop={ {
						value: yPositionDesktop,
						label: 'yPositionDesktop',
					} }
					yPositionTablet={ {
						value: yPositionTablet,
						label: 'yPositionTablet',
					} }
					yPositionMobile={ {
						value: yPositionMobile,
						label: 'yPositionMobile',
					} }
					yPositionType={ {
						value: yPositionType,
						label: 'yPositionType',
					} }
					yPositionTypeTablet={ {
						value: yPositionTypeTablet,
						label: 'yPositionTypeTablet',
					} }
					yPositionTypeMobile={ {
						value: yPositionTypeMobile,
						label: 'yPositionTypeMobile',
					} }
					backgroundVideoType={ {
						value: false,
					} }
					{ ...props }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const borderSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Border', 'vexaltrix' ) } initialOpen={ false }>
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'slider' }
					attributes={ attributes }
					deviceType={ deviceType }
					disableBottomSeparator={ true }
					disabledBorderTitle={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const boxShadowSettings = () => {
		return (
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
	};

	const spacingSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
				<SpacingControl
					{ ...props }
					label={ __( 'Padding', 'vexaltrix' ) }
					valueTop={ {
						value: topPaddingDesktop,
						label: 'topPaddingDesktop',
					} }
					valueRight={ {
						value: rightPaddingDesktop,
						label: 'rightPaddingDesktop',
					} }
					valueBottom={ {
						value: bottomPaddingDesktop,
						label: 'bottomPaddingDesktop',
					} }
					valueLeft={ {
						value: leftPaddingDesktop,
						label: 'leftPaddingDesktop',
					} }
					valueTopTablet={ {
						value: topPaddingTablet,
						label: 'topPaddingTablet',
					} }
					valueRightTablet={ {
						value: rightPaddingTablet,
						label: 'rightPaddingTablet',
					} }
					valueBottomTablet={ {
						value: bottomPaddingTablet,
						label: 'bottomPaddingTablet',
					} }
					valueLeftTablet={ {
						value: leftPaddingTablet,
						label: 'leftPaddingTablet',
					} }
					valueTopMobile={ {
						value: topPaddingMobile,
						label: 'topPaddingMobile',
					} }
					valueRightMobile={ {
						value: rightPaddingMobile,
						label: 'rightPaddingMobile',
					} }
					valueBottomMobile={ {
						value: bottomPaddingMobile,
						label: 'bottomPaddingMobile',
					} }
					valueLeftMobile={ {
						value: leftPaddingMobile,
						label: 'leftPaddingMobile',
					} }
					unit={ {
						value: paddingType,
						label: 'paddingType',
					} }
					mUnit={ {
						value: paddingTypeMobile,
						label: 'paddingTypeMobile',
					} }
					tUnit={ {
						value: paddingTypeTablet,
						label: 'paddingTypeTablet',
					} }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: paddingLink,
						label: 'paddingLink',
					} }
				/>
				<SpacingControl
					{ ...props }
					label={ __( 'Margin', 'vexaltrix' ) }
					valueTop={ {
						value: topMarginDesktop,
						label: 'topMarginDesktop',
					} }
					valueRight={ {
						value: rightMarginDesktop,
						label: 'rightMarginDesktop',
					} }
					valueBottom={ {
						value: bottomMarginDesktop,
						label: 'bottomMarginDesktop',
					} }
					valueLeft={ {
						value: leftMarginDesktop,
						label: 'leftMarginDesktop',
					} }
					valueTopTablet={ {
						value: topMarginTablet,
						label: 'topMarginTablet',
					} }
					valueRightTablet={ {
						value: rightMarginTablet,
						label: 'rightMarginTablet',
					} }
					valueBottomTablet={ {
						value: bottomMarginTablet,
						label: 'bottomMarginTablet',
					} }
					valueLeftTablet={ {
						value: leftMarginTablet,
						label: 'leftMarginTablet',
					} }
					valueTopMobile={ {
						value: topMarginMobile,
						label: 'topMarginMobile',
					} }
					valueRightMobile={ {
						value: rightMarginMobile,
						label: 'rightMarginMobile',
					} }
					valueBottomMobile={ {
						value: bottomMarginMobile,
						label: 'bottomMarginMobile',
					} }
					valueLeftMobile={ {
						value: leftMarginMobile,
						label: 'leftMarginMobile',
					} }
					unit={ {
						value: marginType,
						label: 'marginType',
					} }
					mUnit={ {
						value: marginTypeMobile,
						label: 'marginTypeMobile',
					} }
					tUnit={ {
						value: marginTypeTablet,
						label: 'marginTypeTablet',
					} }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: marginLink,
						label: 'marginLink',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const navigationSettings = () => {
		return (
			<>
				<UAGAdvancedPanelBody title={ __( 'Arrows and Dots', 'vexaltrix' ) } initialOpen={ false }>
					<AdvancedPopColorControl
						label={ __( 'Color', 'vexaltrix' ) }
						colorValue={ arrowColor }
						data={ {
							value: arrowColor,
							label: 'arrowColor',
						} }
						setAttributes={ setAttributes }
					/>
					<AdvancedPopColorControl
						label={ __( 'Background Color', 'vexaltrix' ) }
						colorValue={ arrowBgColor }
						data={ {
							value: arrowBgColor,
							label: 'arrowBgColor',
						} }
						setAttributes={ setAttributes }
					/>
					{ displayArrows && (
						<>
							<ResponsiveSlider
								label={ __( 'Size', 'vexaltrix' ) }
								data={ {
									desktop: {
										value: arrowSize,
										label: 'arrowSize',
									},
									tablet: {
										value: arrowSizeTablet,
										label: 'arrowSizeTablet',
									},
									mobile: {
										value: arrowSizeMobile,
										label: 'arrowSizeMobile',
									},
								} }
								min={ 0 }
								max={ 100 }
								displayUnit={ false }
								setAttributes={ setAttributes }
							/>
							<ResponsiveSlider
								label={ __( 'Padding', 'vexaltrix' ) }
								data={ {
									desktop: {
										value: arrowPadding,
										label: 'arrowPadding',
									},
									tablet: {
										value: arrowPaddingTablet,
										label: 'arrowPaddingTablet',
									},
									mobile: {
										value: arrowPaddingMobile,
										label: 'arrowPaddingMobile',
									},
								} }
								min={ 0 }
								max={ 80 }
								displayUnit={ false }
								setAttributes={ setAttributes }
							/>
							<ResponsiveSlider
								label={ __( 'Arrow Distance from Edges', 'vexaltrix' ) }
								data={ {
									desktop: {
										value: arrowDistance,
										label: 'arrowDistance',
									},
									tablet: {
										value: arrowDistanceTablet,
										label: 'arrowDistanceTablet',
									},
									mobile: {
										value: arrowDistanceMobile,
										label: 'arrowDistanceMobile',
									},
								} }
								min={ -50 }
								max={ 50 }
								displayUnit={ false }
								setAttributes={ setAttributes }
							/>
						</>
					) }
					{ displayDots && (
						<ResponsiveSlider
							label={ __( 'Top Margin for Dots', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: dotsMarginTop,
									label: 'dotsMarginTop',
								},
								tablet: {
									value: dotsMarginTopTablet,
									label: 'dotsMarginTopTablet',
								},
								mobile: {
									value: dotsMarginTopMobile,
									label: 'dotsMarginTopMobile',
								},
							} }
							min={ -100 }
							max={ 100 }
							displayUnit={ false }
							setAttributes={ setAttributes }
						/>
					) }
					{ displayArrows && (
						<ResponsiveBorder
							setAttributes={ setAttributes }
							prefix={ 'slider-arrow' }
							attributes={ attributes }
							deviceType={ deviceType }
							disableBottomSeparator={ true }
						/>
					) }
				</UAGAdvancedPanelBody>
			</>
		);
	};

	const afterNavigationStyleOptions = applyFilters( 'vexaltrix.slider.tab_style.NavigationStyle.after', '', props );

	return (
		<>
			{ getBlockControls() }
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ generalSettings() }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status && (
							<UAGAdvancedPanelBody className="block-editor-block-inspector__upgrade_pro vxt-upgrade_pro-tab">
								<UpgradeComponent
									control={ {
										title: __(
											'Take Slider Block to the next level with powerful features',
											'vexaltrix'
										),
										choices: [
											{
												title: __( 'Slides per view', 'vexaltrix' ),
												description: '',
											},
											{
												title: __( 'Gap between slides', 'vexaltrix' ),
												description: '',
											},
											{
												title: __( 'Custom class-based navigation', 'vexaltrix' ),
												description: '',
											},
											{
												title: __( 'URL hash-based navigation', 'vexaltrix' ),
												description: '',
											},
										],
										renderAs: 'list',
										campaign: 'slider',
									} }
								/>
							</UAGAdvancedPanelBody>
						) }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ contentSettings() }
						{ backgroundSettings() }
						{ borderSettings() }
						{ boxShadowSettings() }
						{ spacingSettings() }
						{ ( displayArrows || displayDots ) && navigationSettings() }
						{ afterNavigationStyleOptions }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};
export default memo( Settings );
