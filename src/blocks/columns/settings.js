/**
 * BLOCK: Columns - Settings.
 */
import { __ } from '@wordpress/i18n';
import { memo } from '@wordpress/element';
import BoxShadowControl from '@Components/box-shadow';
import MultiButtonsControl from '@Components/multi-buttons-control';
import SpacingControl from '@Components/spacing-control';
import Background from '@Components/background';
import ResponsiveBorder from '@Components/responsive-border';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import Range from '@Components/range/Range.js';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import UAGSelectControl from '@Components/select-control';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import ResponsiveSlider from '@Components/responsive-slider';
import UAGTabsControl from '@Components/tabs';
import { InspectorControls } from '@wordpress/block-editor';
import { ToggleControl } from '@wordpress/components';

import UAGAdvancedPanelBody from '@Components/advanced-panel-body';

const Settings = ( props ) => {
	const { attributes, setAttributes, deviceType } = props;

	const {
		block_id,
		stack,
		align,
		vAlign,
		contentWidth,
		width,
		widthType,
		tag,
		columnGap,
		topMarginDesktop,
		rightMarginDesktop,
		leftMarginDesktop,
		bottomMarginDesktop,
		topMarginMobile,
		rightMarginMobile,
		leftMarginMobile,
		bottomMarginMobile,
		topMarginTablet,
		rightMarginTablet,
		leftMarginTablet,
		bottomMarginTablet,
		topPadding,
		bottomPadding,
		leftPadding,
		rightPadding,
		topPaddingTablet,
		bottomPaddingTablet,
		leftPaddingTablet,
		rightPaddingTablet,
		topPaddingMobile,
		bottomPaddingMobile,
		leftPaddingMobile,
		rightPaddingMobile,
		backgroundType,
		backgroundImage,
		backgroundVideo,
		backgroundColor,
		backgroundPosition,
		backgroundAttachment,
		backgroundRepeat,
		backgroundSize,
		backgroundVideoColor,
		backgroundVideoOpacity,
		backgroundImageColor,
		gradientValue,
		gradientColor1,
		gradientColor2,
		gradientLocation1,
		gradientLocation2,
		gradientType,
		gradientAngle,
		selectGradient,
		overlayType,
		columns,
		bottomType,
		bottomColor,
		bottomHeight,
		bottomHeightTablet,
		bottomHeightMobile,
		bottomWidth,
		topType,
		topColor,
		topHeight,
		topHeightTablet,
		topHeightMobile,
		topWidth,
		bottomFlip,
		topFlip,
		reverseTablet,
		reverseMobile,
		topContentAboveShape,
		bottomContentAboveShape,
		mobileMarginType,
		tabletMarginType,
		desktopMarginType,
		mobilePaddingType,
		tabletPaddingType,
		desktopPaddingType,
		paddingLink,
		marginLink,
		boxShadowColor,
		boxShadowHOffset,
		boxShadowVOffset,
		boxShadowBlur,
		boxShadowSpread,
		boxShadowPosition,
	} = attributes;

	const layoutSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) }>
				<Range
					label={ __( 'Columns', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ columns }
					data={ {
						value: columns,
						label: 'columns',
					} }
					min={ 0 }
					max={ 6 }
					displayUnit={ false }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Content Width', 'vexaltrix' ) }
					data={ {
						value: align,
						label: 'align',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: '',
							label: 'None',
						},
						{
							value: 'wide',
							label: 'Wide',
						},
						{
							value: 'full',
							label: 'Full Width',
						},
					] }
					showIcons={ false }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Vertical Alignment', 'vexaltrix' ) }
					data={ {
						value: vAlign,
						label: 'vAlign',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: 'top',
							label: 'Top',
						},
						{
							value: 'center',
							label: 'Middle',
						},
						{
							value: 'bottom',
							label: 'Bottom',
						},
					] }
					showIcons={ false }
				/>
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
							label: __( 'Tablet & Mobile', 'vexaltrix' ),
						},
						{
							value: 'mobile',
							label: __( 'Mobile', 'vexaltrix' ),
						},
					] }
					showIcons={ false }
					help={ __( 'Note: Choose on what breakpoint the columns will stack.', 'vexaltrix' ) }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Container Width', 'vexaltrix' ) }
					data={ {
						value: contentWidth,
						label: 'contentWidth',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: 'theme',
							label: __( 'Theme Container Width', 'vexaltrix' ),
						},
						{
							value: 'custom',
							label: __( 'Custom', 'vexaltrix' ),
						},
					] }
					showIcons={ false }
				/>
				{ contentWidth === 'custom' && (
					<>
						<Range
							label={ __( 'Inner Width', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ width }
							data={ {
								value: width,
								label: 'width',
							} }
							min={ 0 }
							max={ '%' === widthType ? 100 : 2000 }
							unit={ {
								value: widthType,
								label: 'widthType',
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
					</>
				) }
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Gap', 'vexaltrix' ) }
					data={ {
						value: columnGap,
						label: 'columnGap',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: '10',
							label: __( 'Default', 'vexaltrix' ),
							tooltip: __( 'Default (10px)', 'vexaltrix' ),
						},
						{
							value: '0',
							label: __( 'None', 'vexaltrix' ),
							tooltip: __( 'No Gap (0px)', 'vexaltrix' ),
						},
						{
							value: '5',
							label: __( 'S', 'vexaltrix' ),
							tooltip: __( 'Narrow (5px)', 'vexaltrix' ),
						},
						{
							value: '15',
							label: __( 'M', 'vexaltrix' ),
							tooltip: __( 'Extended (15px)', 'vexaltrix' ),
						},
						{
							value: '20',
							label: __( 'L', 'vexaltrix' ),
							tooltip: __( 'Wide (20px)', 'vexaltrix' ),
						},
						{
							value: '30',
							label: __( 'XL', 'vexaltrix' ),
							tooltip: __( 'Wider (30px)', 'vexaltrix' ),
						},
					] }
					showIcons={ false }
					help={ __( 'Note: The individual Column Gap can be managed from Column Settings.', 'vexaltrix' ) }
				/>
				<UAGSelectControl
					label={ __( 'HTML Tag', 'vexaltrix' ) }
					data={ {
						value: tag,
						label: 'tag',
					} }
					setAttributes={ setAttributes }
					options={ [
						{
							value: 'div',
							label: __( 'div', 'vexaltrix' ),
						},
						{
							value: 'header',
							label: __( 'header', 'vexaltrix' ),
						},
						{
							value: 'footer',
							label: __( 'footer', 'vexaltrix' ),
						},
						{
							value: 'main',
							label: __( 'main', 'vexaltrix' ),
						},
						{
							value: 'article',
							label: __( 'article', 'vexaltrix' ),
						},
						{
							value: 'section',
							label: __( 'section', 'vexaltrix' ),
						},
						{
							value: 'aside',
							label: __( 'aside', 'vexaltrix' ),
						},
						{
							value: 'nav',
							label: __( 'nav', 'vexaltrix' ),
						},
					] }
				/>
				<ToggleControl
					label={ __( 'Reverse Columns (Tablet & Mobile)', 'vexaltrix' ) }
					checked={ reverseTablet }
					onChange={ () => setAttributes( { reverseTablet: ! reverseTablet } ) }
				/>
				<ToggleControl
					label={ __( 'Reverse Columns (Mobile)', 'vexaltrix' ) }
					checked={ reverseMobile }
					onChange={ () => setAttributes( { reverseMobile: ! reverseMobile } ) }
				/>
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
						value: topPadding,
						label: 'topPadding',
					} }
					valueRight={ {
						value: rightPadding,
						label: 'rightPadding',
					} }
					valueBottom={ {
						value: bottomPadding,
						label: 'bottomPadding',
					} }
					valueLeft={ {
						value: leftPadding,
						label: 'leftPadding',
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
						value: desktopPaddingType,
						label: 'desktopPaddingType',
					} }
					mUnit={ {
						value: mobilePaddingType,
						label: 'mobilePaddingType',
					} }
					tUnit={ {
						value: tabletPaddingType,
						label: 'tabletPaddingType',
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
						value: desktopMarginType,
						label: 'desktopMarginType',
					} }
					mUnit={ {
						value: mobileMarginType,
						label: 'mobileMarginType',
					} }
					tUnit={ {
						value: tabletMarginType,
						label: 'tabletMarginType',
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
	const backgroundSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Background', 'vexaltrix' ) } initialOpen={ true }>
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
					backgroundGradientLocation2={ {
						value: gradientLocation2,
						label: 'gradientLocation2',
					} }
					backgroundGradientType={ {
						value: gradientType,
						label: 'gradientType',
					} }
					backgroundGradientAngle={ {
						value: gradientAngle,
						label: 'gradientAngle',
					} }
					backgroundImageColor={ {
						value: backgroundImageColor,
						label: 'backgroundImageColor',
					} }
					overlayType={ {
						value: overlayType,
						label: 'overlayType',
					} }
					gradientOverlay={ {
						value: true,
					} }
					backgroundSize={ {
						value: backgroundSize,
						label: 'backgroundSize',
					} }
					backgroundRepeat={ {
						value: backgroundRepeat,
						label: 'backgroundRepeat',
					} }
					backgroundAttachment={ {
						value: backgroundAttachment,
						label: 'backgroundAttachment',
					} }
					backgroundPosition={ {
						value: backgroundPosition,
						label: 'backgroundPosition',
					} }
					backgroundImage={ {
						value: backgroundImage,
						label: 'backgroundImage',
					} }
					backgroundColor={ {
						value: backgroundColor,
						label: 'backgroundColor',
					} }
					backgroundType={ {
						value: backgroundType,
						label: 'backgroundType',
					} }
					backgroundVideoType={ {
						value: true,
					} }
					backgroundVideo={ {
						value: backgroundVideo,
						label: 'backgroundVideo',
					} }
					backgroundVideoColor={ {
						value: backgroundVideoColor,
						label: 'backgroundVideoColor',
					} }
					backgroundVideoOpacity={ {
						value: backgroundVideoOpacity,
						label: 'backgroundVideoOpacity',
					} }
					onOpacityChange={ ( opacity ) => setAttributes( { backgroundVideoOpacity: opacity } ) }
					{ ...props }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const shapeDividersSettings = () => {
		const dividers = [
			{
				value: 'none',
				label: __( 'None', 'vexaltrix' ),
			},
			{
				value: 'tilt',
				label: __( 'Tilt', 'vexaltrix' ),
			},
			{
				value: 'mountains',
				label: __( 'Mountains', 'vexaltrix' ),
			},
			{
				value: 'wave_brush',
				label: __( 'Wave Brush', 'vexaltrix' ),
			},
			{
				value: 'waves',
				label: __( 'Waves', 'vexaltrix' ),
			},
			{
				value: 'wave_pattern',
				label: __( 'Waves Pattern', 'vexaltrix' ),
			},
			{
				value: 'triangle',
				label: __( 'Triangle', 'vexaltrix' ),
			},
			{
				value: 'drops',
				label: __( 'Drops', 'vexaltrix' ),
			},
			{
				value: 'clouds',
				label: __( 'Clouds', 'vexaltrix' ),
			},
			{
				value: 'zigzag',
				label: __( 'ZigZag', 'vexaltrix' ),
			},
			{
				value: 'pyramids',
				label: __( 'Pyramids', 'vexaltrix' ),
			},
			{
				value: 'triangle_asymmetrical',
				label: __( 'Triangle Asymmetrical', 'vexaltrix' ),
			},
			{
				value: 'tilt_opacity',
				label: __( 'Tilt Opacity', 'vexaltrix' ),
			},
			{
				value: 'fan_opacity',
				label: __( 'Fan Opacity', 'vexaltrix' ),
			},
			{
				value: 'curve',
				label: __( 'Curve', 'vexaltrix' ),
			},
			{
				value: 'curve_asymmetrical',
				label: __( 'Curve Asymmetrical', 'vexaltrix' ),
			},
			{
				value: 'curve_reverse',
				label: __( 'Curve Reverse', 'vexaltrix' ),
			},
			{
				value: 'curve_asym_reverse',
				label: __( 'Curve Asymmetrical Reverse', 'vexaltrix' ),
			},
			{
				value: 'arrow',
				label: __( 'Arrow', 'vexaltrix' ),
			},
			{
				value: 'arrow_split',
				label: __( 'Arrow Split', 'vexaltrix' ),
			},
			{
				value: 'book',
				label: __( 'Book', 'vexaltrix' ),
			},
		];

		const topSettings = (
			<>
				<UAGSelectControl
					label={ __( 'Type', 'vexaltrix' ) }
					data={ {
						value: topType,
						label: 'topType',
					} }
					setAttributes={ setAttributes }
					options={ dividers }
				/>
				{ topType !== 'none' && (
					<>
						<AdvancedPopColorControl
							label={ __( 'Color', 'vexaltrix' ) }
							colorValue={ topColor }
							data={ {
								value: topColor,
								label: 'topColor',
							} }
							setAttributes={ setAttributes }
						/>
						<Range
							label={ __( 'Width', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ topWidth }
							data={ {
								value: topWidth,
								label: 'topWidth',
							} }
							min={ 100 }
							max={ 2000 }
							displayUnit={ false }
						/>
						<ResponsiveSlider
							label={ __( 'Height', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: topHeight,
									label: 'topHeight',
								},
								tablet: {
									value: topHeightTablet,
									label: 'topHeightTablet',
								},
								mobile: {
									value: topHeightMobile,
									label: 'topHeightMobile',
								},
							} }
							min={ 0 }
							max={ 500 }
							displayUnit={ false }
							setAttributes={ setAttributes }
						/>
						<ToggleControl
							label={ __( 'Flip', 'vexaltrix' ) }
							checked={ topFlip }
							onChange={ () => setAttributes( { topFlip: ! topFlip } ) }
						/>
						<ToggleControl
							label={ __( 'Bring To Front', 'vexaltrix' ) }
							checked={ topContentAboveShape }
							onChange={ () =>
								setAttributes( {
									topContentAboveShape: ! topContentAboveShape,
								} )
							}
						/>
					</>
				) }
			</>
		);

		const bottomSettings = (
			<>
				<UAGSelectControl
					label={ __( 'Type', 'vexaltrix' ) }
					data={ {
						value: bottomType,
						label: 'bottomType',
					} }
					setAttributes={ setAttributes }
					options={ dividers }
				/>
				{ bottomType !== 'none' && (
					<>
						<AdvancedPopColorControl
							label={ __( 'Color', 'vexaltrix' ) }
							colorValue={ bottomColor }
							data={ {
								value: bottomColor,
								label: 'bottomColor',
							} }
							setAttributes={ setAttributes }
						/>
						<Range
							label={ __( 'Width', 'vexaltrix' ) }
							setAttributes={ setAttributes }
							value={ bottomWidth }
							data={ {
								value: bottomWidth,
								label: 'bottomWidth',
							} }
							min={ 100 }
							max={ 2000 }
							displayUnit={ false }
						/>
						<ResponsiveSlider
							label={ __( 'Height', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: bottomHeight,
									label: 'bottomHeight',
								},
								tablet: {
									value: bottomHeightTablet,
									label: 'bottomHeightTablet',
								},
								mobile: {
									value: bottomHeightMobile,
									label: 'bottomHeightMobile',
								},
							} }
							min={ 0 }
							max={ 500 }
							displayUnit={ false }
							setAttributes={ setAttributes }
						/>
						<ToggleControl
							label={ __( 'Flip', 'vexaltrix' ) }
							checked={ bottomFlip }
							onChange={ () => setAttributes( { bottomFlip: ! bottomFlip } ) }
						/>
						<ToggleControl
							label={ __( 'Bring To Front', 'vexaltrix' ) }
							checked={ bottomContentAboveShape }
							onChange={ () =>
								setAttributes( {
									bottomContentAboveShape: ! bottomContentAboveShape,
								} )
							}
						/>
					</>
				) }
			</>
		);

		return (
			<UAGAdvancedPanelBody title={ __( 'Shape Dividers', 'vexaltrix' ) } initialOpen={ false }>
				<UAGTabsControl
					tabs={ [
						{
							name: 'top',
							title: __( 'Top', 'vexaltrix' ),
						},
						{
							name: 'bottom',
							title: __( 'Bottom', 'vexaltrix' ),
						},
					] }
					top={ topSettings }
					bottom={ bottomSettings }
					disableBottomSeparator={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const borderSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Border', 'vexaltrix' ) } initialOpen={ false }>
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'columns' }
					attributes={ attributes }
					deviceType={ deviceType }
					disabledBorderTitle={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const boxShadowSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Box Shadow', 'vexaltrix' ) } initialOpen={ false }>
				<BoxShadowControl
					blockId={ block_id }
					setAttributes={ setAttributes }
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
			</UAGAdvancedPanelBody>
		);
	};
	return (
		<InspectorControls>
			<InspectorTabs>
				<InspectorTab { ...UAGTabs.general }>{ layoutSettings() }</InspectorTab>
				<InspectorTab { ...UAGTabs.style }>
					{ backgroundSettings() }
					{ shapeDividersSettings() }
					{ borderSettings() }
					{ boxShadowSettings() }
					{ spacingSettings() }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);
};

export default memo( Settings );
