/**
 * BLOCK: Social Share - Settings.
 */

import Range from '@Components/range/Range.js';
import ResponsiveSlider from '@Components/responsive-slider';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import MultiButtonsControl from '@Components/multi-buttons-control';
import { __ } from '@wordpress/i18n';
import renderSVG from '@Controls/renderIcon';
import { InspectorControls } from '@wordpress/block-editor';
import { Icon } from '@wordpress/components';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UAGTabsControl from '@Components/tabs';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import presets from './presets';
import UAGPresets from '@Components/presets';
import { memo } from '@wordpress/element';
const Settings = ( props ) => {
	const { attributes, setAttributes } = props;

	const {
		align,
		alignTablet,
		alignMobile,
		gap,
		gapTablet,
		gapMobile,
		stack,
		social_layout,
		borderRadius,
		borderRadiusTablet,
		borderRadiusMobile,
		size,
		sizeType,
		sizeMobile,
		sizeTablet,
		bgSize,
		iconColor,
		iconHoverColor,
		iconBgColor,
		iconBgHoverColor,
	} = attributes;

	const generalSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Content', 'vexaltrix' ) } initialOpen={ true }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Layout', 'vexaltrix' ) }
					data={ {
						value: social_layout,
						label: 'social_layout',
					} }
					className="uagb-multi-button-alignment-control"
					options={ [
						{
							value: 'horizontal',
							label: __( 'Horizontal', 'vexaltrix' ),
						},
						{
							value: 'vertical',
							label: __( 'Vertical', 'vexaltrix' ),
						},
					] }
					showIcons={ false }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Alignment', 'vexaltrix' ) }
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
					className="uagb-multi-button-alignment-control"
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
				{ 'horizontal' === social_layout && (
					<>
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'Stack On', 'vexaltrix' ) }
							data={ {
								value: stack,
								label: 'stack',
							} }
							className="uagb-multi-button-alignment-control"
							options={ [
								{
									value: 'none',
									label: __( 'None', 'vexaltrix' ),
								},
								{
									value: 'desktop',
									label: __( 'Desktop', 'vexaltrix' ),
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
							showIcons={ false }
							help={ __( 'Note: Choose on what breakpoint the Icons will stack.', 'vexaltrix' ) }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const spacingSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
				<ResponsiveSlider
					label={ __( 'Gap between Items', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: gap,
							label: 'gap',
						},
						tablet: {
							value: gapTablet,
							label: 'gapTablet',
						},
						mobile: {
							value: gapMobile,
							label: 'gapMobile',
						},
					} }
					min={ 0 }
					max={ 100 }
					displayUnit={ false }
					setAttributes={ setAttributes }
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

	const iconSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Icon', 'vexaltrix' ) } initialOpen={ true }>
				<ResponsiveSlider
					label={ __( 'Size', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: size,
							label: 'size',
						},
						tablet: {
							value: sizeTablet,
							label: 'sizeTablet',
						},
						mobile: {
							value: sizeMobile,
							label: 'sizeMobile',
						},
					} }
					min={ 0 }
					max={ 100 }
					unit={ {
						value: sizeType,
						label: 'sizeType',
					} }
					setAttributes={ setAttributes }
				/>
				<Range
					label={ __( 'Background Size', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ bgSize }
					data={ {
						value: bgSize,
						label: 'bgSize',
					} }
					min={ 0 }
					max={ 100 }
					displayUnit={ false }
					help={ __(
						'Note: Background Size option is useful when one adds background color to the icons.',
						'vexaltrix'
					) }
				/>
				<ResponsiveSlider
					label={ __( 'Border Radius', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: borderRadius,
							label: 'borderRadius',
						},
						tablet: {
							value: borderRadiusTablet,
							label: 'borderRadiusTablet',
						},
						mobile: {
							value: borderRadiusMobile,
							label: 'borderRadiusMobile',
						},
					} }
					min={ 0 }
					max={ 100 }
					displayUnit={ false }
					help={ __(
						'Note: Border Radius option is useful when one adds background color to the icons.',
						'vexaltrix'
					) }
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
								label={ __( 'Background Color', 'vexaltrix' ) }
								colorValue={ iconBgColor ? iconBgColor : '' }
								data={ {
									value: iconBgColor,
									label: 'iconBgColor',
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
								label={ __( 'Background Color', 'vexaltrix' ) }
								colorValue={ iconBgHoverColor ? iconBgHoverColor : '' }
								data={ {
									value: iconBgHoverColor,
									label: 'iconBgHoverColor',
								} }
								setAttributes={ setAttributes }
							/>
						</>
					}
					disableBottomSeparator={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	return (
		<InspectorControls>
			<InspectorTabs>
				<InspectorTab { ...UAGTabs.general }>
					{ generalSettings() }
					{ presetSettings() }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.style }>
					{ iconSettings() }
					{ spacingSettings() }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);
};

export default memo( Settings );
