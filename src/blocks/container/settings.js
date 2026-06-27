import { memo } from '@wordpress/element';

import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import ResponsiveSlider from '@Components/responsive-slider';
import { __ } from '@wordpress/i18n';

import { InspectorControls, __experimentalLinkControl as LinkControl } from '@wordpress/block-editor';
import BoxShadowControl from '@Components/box-shadow';
import SpacingControl from '@Components/spacing-control';
import Background from '@Components/background';
import ResponsiveBorder from '@Components/responsive-border';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGSelectControl from '@Components/select-control';
import UAGTextControl from '@Components/text-control';
import { Icon, ToggleControl } from '@wordpress/components';
import renderCustomIcon from '@Controls/renderCustomIcon';
import UAGTabsControl from '@Components/tabs';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control';
import Range from '@Components/range/Range';
import { boxShadowPresets, boxShadowHoverPresets } from './presets';
import UAGPresets from '@Components/presets';
import renderGBSSettings from '@Controls/renderGBSSettings';
import { ChildrenWidthDropdown } from './utils';
import styling from './styling';
import { GridSettings } from './components';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const Settings = ( props ) => {
	const { attributes, setAttributes, deviceType } = props;
	const {
		block_id,
		htmlTag,
		htmlTagLink,
		widthDesktop,
		widthTablet,
		widthMobile,
		widthType,
		minHeightDesktop,
		minHeightTablet,
		minHeightMobile,
		minHeightType,
		directionDesktop,
		directionTablet,
		directionMobile,
		alignItemsDesktop,
		alignItemsTablet,
		alignItemsMobile,
		justifyContentDesktop,
		justifyContentTablet,
		justifyContentMobile,
		wrapDesktop,
		wrapTablet,
		wrapMobile,
		alignContentDesktop,
		alignContentTablet,
		alignContentMobile,

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
		rowGapDesktop,
		rowGapTablet,
		rowGapMobile,
		rowGapType,
		rowGapTypeTablet,
		rowGapTypeMobile,
		columnGapDesktop,
		columnGapTablet,
		columnGapMobile,
		columnGapType,
		columnGapTypeTablet,
		columnGapTypeMobile,
		contentWidth,
		isBlockRootParent,
		innerContentWidth,
		innerContentCustomWidthDesktop,
		innerContentCustomWidthTablet,
		innerContentCustomWidthMobile,
		innerContentCustomWidthType,
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
		topContentAboveShape,
		bottomContentAboveShape,
		backgroundCustomSizeDesktop,
		backgroundCustomSizeTablet,
		backgroundCustomSizeMobile,
		backgroundCustomSizeType,
		overlayType,
		overlayOpacity,
		customPosition,
		centralizedPosition,
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
		backgroundVideoColor,
		backgroundVideo,
		topInvert,
		bottomInvert,

		textColor,
		linkColor,
		linkHoverColor,

		gradientOverlayColor1,
		gradientOverlayColor2,
		gradientOverlayLocation1,
		gradientOverlayLocationTablet1,
		gradientOverlayLocationMobile1,
		gradientOverlayLocation2,
		gradientOverlayLocationTablet2,
		gradientOverlayLocationMobile2,
		gradientOverlayType,
		gradientOverlayAngle,
		gradientOverlayAngleTablet,
		gradientOverlayAngleMobile,
		selectOverlayGradient,
		backgroundOverlayColor,
		backgroundSizeOverlayDesktop,
		backgroundSizeOverlayTablet,
		backgroundSizeOverlayMobile,
		backgroundCustomSizeOverlayDesktop,
		backgroundCustomSizeOverlayTablet,
		backgroundCustomSizeOverlayMobile,
		backgroundCustomOverlaySizeType,
		backgroundRepeatOverlayDesktop,
		backgroundRepeatOverlayTablet,
		backgroundRepeatOverlayMobile,
		backgroundAttachmentOverlayDesktop,
		backgroundAttachmentOverlayTablet,
		backgroundAttachmentOverlayMobile,
		backgroundPositionOverlayDesktop,
		backgroundPositionOverlayTablet,
		backgroundPositionOverlayMobile,
		backgroundOverlayImageDesktop,
		backgroundOverlayImageTablet,
		backgroundOverlayImageMobile,
		customOverlayPosition,
		xPositionOverlayDesktop,
		xPositionOverlayTablet,
		xPositionOverlayMobile,
		xPositionOverlayType,
		xPositionOverlayTypeTablet,
		xPositionOverlayTypeMobile,
		yPositionOverlayDesktop,
		yPositionOverlayTablet,
		yPositionOverlayMobile,
		yPositionOverlayType,
		yPositionOverlayTypeTablet,
		yPositionOverlayTypeMobile,
		overlayBlendMode,
		overlayBlendModeTablet,
		overlayBlendModeMobile,

		// responsive
		innerContentCustomWidthTypeTablet,
		innerContentCustomWidthTypeMobile,
		widthTypeTablet,
		widthTypeMobile,
		minHeightTypeTablet,
		minHeightTypeMobile,
		topHeightType,
		topHeightTypeTablet,
		topHeightTypeMobile,
		bottomHeightType,
		bottomHeightTypeTablet,
		bottomHeightTypeMobile,

		overflow,
		topDividerWidthType,
		bottomDividerWidthType,
		topDividerHeightType,
		bottomDividerHeightType,
		equalHeight,
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
		backgroundVideoFallbackImage,
		layout,
		linkTarget,
	} = attributes;

	const isPro = vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status;

	let currentDirection = directionDesktop?.split( '-' )?.[ 0 ];

	if ( attributes[ 'direction' + deviceType ] && attributes[ 'direction' + deviceType ].split( '-' )[ 0 ] ) {
		currentDirection = attributes[ 'direction' + deviceType ].split( '-' )[ 0 ];
	}

	const currentOppAxisDirection = 'row' === currentDirection ? 'column' : 'row';

	const verticalAlignmentHint = __( 'Define the vertical alignment inside this container.', 'vexaltrix' );
	const horizontalAlignmentHint = __( 'Define the horizontal alignment inside this container.', 'vexaltrix' );
	const alignContentHint =
		'row' === currentDirection
			? __( 'Define the vertical alignment of every line of blocks inside this flex container.', 'vexaltrix' )
			: __( 'Define the horizontal alignment of every line of blocks inside this flex container.', 'vexaltrix' );

	const onChangeHeight = ( value ) => {
		setAttributes( { equalHeight: value } );
		if ( value ) {
			setAttributes( { alignItemsDesktop: 'stretch' } );
			setAttributes( { alignItemsTablet: 'stretch' } );
			setAttributes( { alignItemsMobile: 'stretch' } );
		} else {
			setAttributes( { alignItemsDesktop: 'center' } );
			setAttributes( { alignItemsTablet: 'center' } );
			setAttributes( { alignItemsMobile: 'center' } );
		}
	};
	const onChangeAlign = ( value ) => {
		setAttributes( { equalHeight: 'stretch' === value } );
	};
	const generalSettings = () => {
		const directionOptions = [
			{
				value: 'row',
				tooltip: __( 'Row', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( 'flex-direction-row' ) } />,
			},
			{
				value: 'column',
				tooltip: __( 'Column', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( 'flex-direction-column' ) } />,
			},
			{
				value: 'row-reverse',
				tooltip: __( 'Row Reverse', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( 'flex-direction-row-reverse' ) } />,
			},
			{
				value: 'column-reverse',
				tooltip: __( 'Column Reverse', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( 'flex-direction-column-reverse' ) } />,
			},
		];

		const alignItemsOptions = [
			{
				value: 'flex-start',
				tooltip: __( 'Flex Start', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-start` ) } />,
			},
			{
				value: 'center',
				tooltip: __( 'Center', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-center` ) } />,
			},
			{
				value: 'flex-end',
				tooltip: __( 'Flex End', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-end` ) } />,
			},
			{
				value: 'stretch',
				tooltip: __( 'Stretch', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-strech` ) } />,
			},
		];

		const justifyContentOptions = [
			{
				value: 'flex-start',
				tooltip: __( 'Flex Start', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentDirection }-start` ) } />,
			},
			{
				value: 'center',
				tooltip: __( 'Center', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentDirection }-center` ) } />,
			},
			{
				value: 'flex-end',
				tooltip: __( 'Flex End', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentDirection }-end` ) } />,
			},
			{
				value: 'space-between',
				tooltip: __( 'Space Between', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentDirection }-space-between` ) } />,
			},
			{
				value: 'space-around',
				tooltip: __( 'Space Around', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentDirection }-space-around` ) } />,
			},
			{
				value: 'space-evenly',
				tooltip: __( 'Space Evenly', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentDirection }-space-evenly` ) } />,
			},
		];

		const alignContentOptions = [
			{
				value: 'flex-start',
				tooltip: __( 'Flex Start', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-start` ) } />,
			},
			{
				value: 'center',
				tooltip: __( 'Center', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-center` ) } />,
			},
			{
				value: 'flex-end',
				tooltip: __( 'Flex End', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-end` ) } />,
			},
			{
				value: 'space-between',
				tooltip: __( 'Space Between', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-space-between` ) } />,
			},
			{
				value: 'space-around',
				tooltip: __( 'Space Around', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-space-around` ) } />,
			},
			{
				value: 'space-evenly',
				tooltip: __( 'Space Evenly', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( `flex-${ currentOppAxisDirection }-space-evenly` ) } />,
			},
		];

		const wrapOptions = [
			{
				value: 'wrap',
				tooltip: __( 'Wrap', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( 'flex-wrap' ) } />,
			},
			{
				value: 'nowrap',
				tooltip: __( 'No Wrap', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( 'flex-no-wrap' ) } />,
			},
			{
				value: 'wrap-reverse',
				tooltip: __( 'Wrap Reverse', 'vexaltrix' ),
				icon: <Icon icon={ renderCustomIcon( 'flex-wrap-reverse' ) } />,
			},
		];

		const contentWidthOptions = [
			{
				value: 'alignfull',
				label: __( 'Full Width', 'vexaltrix' ),
			},
			{
				value: 'alignwide',
				label: __( 'Boxed', 'vexaltrix' ),
			},
			{
				value: 'default',
				label: __( 'Custom', 'vexaltrix' ),
			},
		];

		const overflowOptions = [
			{
				value: 'visible',
				label: __( 'Visible', 'vexaltrix' ),
			},
			{
				value: 'hidden',
				label: __( 'Hidden', 'vexaltrix' ),
			},
			{
				value: 'auto',
				label: __( 'Auto', 'vexaltrix' ),
			},
		];

		const innerContentWidthOptions = [
			{
				value: 'alignwide',
				label: __( 'Boxed', 'vexaltrix' ),
			},
			{
				value: 'alignfull',
				label: __( 'Full Width', 'vexaltrix' ),
			},
		];

		const onWidthChange = () => {
			setAttributes( { widthSetByUser: true } );
		};

		return (
			<>
				<UAGAdvancedPanelBody title={ __( 'Container Type', 'vexaltrix' ) } initialOpen={ true }>
					{ isBlockRootParent && (
						<>
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Container Width', 'vexaltrix' ) }
								data={ {
									value: contentWidth,
									label: 'contentWidth',
								} }
								options={ contentWidthOptions }
								showIcons={ false }
								responsive={ false }
							/>
							{ 'alignfull' === contentWidth && (
								<>
									<MultiButtonsControl
										setAttributes={ setAttributes }
										label={ __( 'Content Width', 'vexaltrix' ) }
										data={ {
											value: innerContentWidth,
											label: 'innerContentWidth',
										} }
										options={ innerContentWidthOptions }
										showIcons={ false }
										responsive={ false }
									/>
									{ 'alignwide' === innerContentWidth && (
										<ResponsiveSlider
											label={ __( 'Content Box Width', 'vexaltrix' ) }
											data={ {
												desktop: {
													value: innerContentCustomWidthDesktop,
													label: 'innerContentCustomWidthDesktop',
													unit: {
														value: innerContentCustomWidthType,
														label: 'innerContentCustomWidthType',
													},
												},
												tablet: {
													value: innerContentCustomWidthTablet,
													label: 'innerContentCustomWidthTablet',
													unit: {
														value: innerContentCustomWidthTypeTablet,
														label: 'innerContentCustomWidthTypeTablet',
													},
												},
												mobile: {
													value: innerContentCustomWidthMobile,
													label: 'innerContentCustomWidthMobile',
													unit: {
														value: innerContentCustomWidthTypeMobile,
														label: 'innerContentCustomWidthTypeMobile',
													},
												},
											} }
											min={ 0 }
											limitMax={ { px: 1600, '%': 100, vw: 100 } }
											units={ [
												{
													name: __( 'PX', 'vexaltrix' ),
													unitValue: 'px',
												},
												{
													name: __( '%', 'vexaltrix' ),
													unitValue: '%',
												},
												{
													name: __( 'VW', 'vexaltrix' ),
													unitValue: 'vw',
												},
											] }
											unit={ {
												value: innerContentCustomWidthType,
												label: 'innerContentCustomWidthType',
											} }
											setAttributes={ setAttributes }
										/>
									) }
								</>
							) }
						</>
					) }
					{ ( ( isBlockRootParent && 'default' === contentWidth ) || ! isBlockRootParent ) && (
						<>
							<ResponsiveSlider
								label={ __( 'Custom Width', 'vexaltrix' ) }
								data={ {
									desktop: {
										value: widthDesktop,
										label: 'widthDesktop',
										unit: {
											value: widthType,
											label: 'widthType',
										},
									},
									tablet: {
										value: widthTablet,
										label: 'widthTablet',
										unit: {
											value: widthTypeTablet,
											label: 'widthTypeTablet',
										},
									},
									mobile: {
										value: widthMobile,
										label: 'widthMobile',
										unit: {
											value: widthTypeMobile,
											label: 'widthTypeMobile',
										},
									},
								} }
								min={ 0 }
								unit={ {
									value: widthType,
									label: 'widthType',
								} }
								limitMax={ { px: 1600, '%': 100, vw: 100 } }
								units={ [
									{
										name: __( 'PX', 'vexaltrix' ),
										unitValue: 'px',
									},
									{
										name: __( '%', 'vexaltrix' ),
										unitValue: '%',
									},
									{
										name: __( 'VW', 'vexaltrix' ),
										unitValue: 'vw',
									},
								] }
								setAttributes={ setAttributes }
								onChange={ onWidthChange }
							/>
						</>
					) }
					<ResponsiveSlider
						label={ __( 'Minimum Height', 'vexaltrix' ) }
						data={ {
							desktop: {
								value: minHeightDesktop,
								label: 'minHeightDesktop',
								unit: {
									value: minHeightType,
									label: 'minHeightType',
								},
							},
							tablet: {
								value: minHeightTablet,
								label: 'minHeightTablet',
								unit: {
									value: minHeightTypeTablet,
									label: 'minHeightTypeTablet',
								},
							},
							mobile: {
								value: minHeightMobile,
								label: 'minHeightMobile',
								unit: {
									value: minHeightTypeMobile,
									label: 'minHeightTypeMobile',
								},
							},
						} }
						min={ 0 }
						limitMax={ { px: 1000, vh: 100 } }
						unit={ {
							value: minHeightType,
							label: 'minHeightType',
						} }
						units={ [
							{
								name: __( 'PX', 'vexaltrix' ),
								unitValue: 'px',
							},
							{
								name: __( 'VH', 'vexaltrix' ),
								unitValue: 'vh',
							},
						] }
						setAttributes={ setAttributes }
					/>
					<ToggleControl
						label={ __( 'Equal Height', 'vexaltrix' ) }
						checked={ equalHeight }
						onChange={ ( value ) => onChangeHeight( value ) }
						help={ __( 'Enabling this will change the Align Items value to Stretch.', 'vexaltrix' ) }
					/>
					<UAGSelectControl
						label={ __( 'HTML Tag', 'vexaltrix' ) }
						data={ {
							value: htmlTag,
							label: 'htmlTag',
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
								value: 'figure',
								label: __( 'figure', 'vexaltrix' ),
							},
							{
								value: 'figcaption',
								label: __( 'figcaption', 'vexaltrix' ),
							},
							{
								value: 'summary',
								label: __( 'summary', 'vexaltrix' ),
							},
							{
								value: 'nav',
								label: __( 'nav', 'vexaltrix' ),
							},
							{
								value: 'a',
								label: __( 'link', 'vexaltrix' ),
							},
						] }
					/>
					{ htmlTag === 'a' &&
						( isPro ? (
							<>
								<UAGTextControl
									label={ __( 'Link', 'vexaltrix' ) }
									enableDynamicContent={ true }
									name="htmlTagLink"
									value={ htmlTagLink?.url }
									onChange={ ( value ) =>
										setAttributes( { htmlTagLink: { ...htmlTagLink, url: value } } )
									}
									data={ { value: htmlTagLink?.url, label: 'htmlTagLink' } }
								/>
								<ToggleControl
									checked={ linkTarget }
									onChange={ () => setAttributes( { linkTarget: ! linkTarget } ) }
									label={ __( 'Open in new window', 'vexaltrix' ) }
								/>
							</>
						) : (
							<LinkControl
								searchInputPlaceholder={ __( 'Search here…', 'vexaltrix' ) }
								value={ htmlTagLink }
								settings={ [
									{
										id: 'opensInNewTab',
										title: __( 'Open in new window', 'vexaltrix' ),
									},
									{ id: 'noFollow', title: __( 'Add nofollow', 'vexaltrix' ) },
								] }
								onChange={ ( link ) => setAttributes( { htmlTagLink: link } ) }
								withCreateSuggestion={ true }
								createSuggestion={ ( inputValue ) =>
									setAttributes( {
										post: {
											...attributes.post,
											title: inputValue,
											type: 'custom-url',
											id: Date.now(),
											url: inputValue,
										},
									} )
								}
								createSuggestionButtonText={ ( newValue ) =>
									`${ __( 'New:', 'vexaltrix' ) } ${ newValue }`
								}
								onRemove={ () => setAttributes( { htmlTagLink: undefined } ) }
							/>
						) ) }
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Overflow', 'vexaltrix' ) }
						data={ {
							value: overflow,
							label: 'overflow',
						} }
						options={ overflowOptions }
						showIcons={ false }
						responsive={ false }
					/>
				</UAGAdvancedPanelBody>
				<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) } initialOpen={ false }>
					<MultiButtonsControl
						data={ {
							value: layout || 'flex',
							label: 'layout',
						} }
						options={ [
							{
								value: 'flex',
								label: __( 'Flex', 'vexaltrix' ),
							},
							{
								value: 'grid',
								label: __( 'Grid', 'vexaltrix' ),
							},
						] }
						onChange={ ( value ) => {
							// If user is switching from flex to grid then we need to set the default values for grid take from flex.
							setAttributes( { layout: value } );
						} }
					/>
					{ 'grid' === layout ? (
						<GridSettings { ...props } />
					) : (
						<>
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Direction', 'vexaltrix' ) }
								data={ {
									desktop: {
										value: directionDesktop,
										label: 'directionDesktop',
									},
									tablet: {
										value: directionTablet,
										label: 'directionTablet',
									},
									mobile: {
										value: directionMobile,
										label: 'directionMobile',
									},
								} }
								options={ directionOptions }
								showIcons={ true }
								responsive={ true }
								help={ __(
									'Define the direction in which blocks inside this container will be placed one after the other.',
									'vexaltrix'
								) }
							/>

							<ChildrenWidthDropdown
								attributes={ attributes }
								setAttributes={ setAttributes }
								deviceType={ deviceType }
								isColumn={ false }
							/>
							<ChildrenWidthDropdown
								attributes={ attributes }
								setAttributes={ setAttributes }
								deviceType={ deviceType }
								isColumn={ true }
							/>

							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Align Items', 'vexaltrix' ) }
								data={ {
									desktop: {
										value: alignItemsDesktop,
										label: 'alignItemsDesktop',
									},
									tablet: {
										value: alignItemsTablet,
										label: 'alignItemsTablet',
									},
									mobile: {
										value: alignItemsMobile,
										label: 'alignItemsMobile',
									},
								} }
								options={ alignItemsOptions }
								showIcons={ true }
								onChange={ onChangeAlign( alignItemsDesktop ) }
								responsive={ true }
								help={
									'row' === currentOppAxisDirection ? horizontalAlignmentHint : verticalAlignmentHint
								}
							/>
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Justify Content', 'vexaltrix' ) }
								data={ {
									desktop: {
										value: justifyContentDesktop,
										label: 'justifyContentDesktop',
									},
									tablet: {
										value: justifyContentTablet,
										label: 'justifyContentTablet',
									},
									mobile: {
										value: justifyContentMobile,
										label: 'justifyContentMobile',
									},
								} }
								options={ justifyContentOptions }
								showIcons={ true }
								responsive={ true }
								help={ 'row' === currentDirection ? horizontalAlignmentHint : verticalAlignmentHint }
							/>
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Wrap', 'vexaltrix' ) }
								data={ {
									desktop: {
										value: wrapDesktop,
										label: 'wrapDesktop',
									},
									tablet: {
										value: wrapTablet,
										label: 'wrapTablet',
									},
									mobile: {
										value: wrapMobile,
										label: 'wrapMobile',
									},
								} }
								options={ wrapOptions }
								showIcons={ true }
								responsive={ true }
								help={ __(
									'Define whether the items are forced in a single line (No Wrap) or can be flowed into multiple lines (Wrap).',
									'vexaltrix'
								) }
							/>
							{ ( 'wrap' === attributes[ 'wrap' + deviceType ] ||
								'wrap-reverse' === attributes[ 'wrap' + deviceType ] ) && (
								<MultiButtonsControl
									setAttributes={ setAttributes }
									label={ __( 'Align Content', 'vexaltrix' ) }
									data={ {
										desktop: {
											value: alignContentDesktop,
											label: 'alignContentDesktop',
										},
										tablet: {
											value: alignContentTablet,
											label: 'alignContentTablet',
										},
										mobile: {
											value: alignContentMobile,
											label: 'alignContentMobile',
										},
									} }
									options={ alignContentOptions }
									showIcons={ true }
									responsive={ true }
									help={ alignContentHint }
								/>
							) }
						</>
					) }
				</UAGAdvancedPanelBody>
			</>
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
					backgroundOverlayGradientColor1={ {
						value: gradientOverlayColor1,
						label: 'gradientOverlayColor1',
					} }
					gradientType={ {
						value: selectGradient,
						label: 'selectGradient',
					} }
					backgroundGradientColor2={ {
						value: gradientColor2,
						label: 'gradientColor2',
					} }
					backgroundOverlayGradientColor2={ {
						value: gradientOverlayColor2,
						label: 'gradientOverlayColor2',
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
					backgroundOverlayGradientLocation1={ {
						value: gradientOverlayLocation1,
						label: 'gradientOverlayLocation1',
					} }
					backgroundOverlayGradientLocationTablet1={ {
						value: gradientOverlayLocationTablet1,
						label: 'gradientOverlayLocationTablet1',
					} }
					backgroundOverlayGradientLocationMobile1={ {
						value: gradientOverlayLocationMobile1,
						label: 'gradientOverlayLocationMobile1',
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
					backgroundOverlayGradientLocation2={ {
						value: gradientOverlayLocation2,
						label: 'gradientOverlayLocation2',
					} }
					backgroundOverlayGradientLocationTablet2={ {
						value: gradientOverlayLocationTablet2,
						label: 'gradientOverlayLocationTablet2',
					} }
					backgroundOverlayGradientLocationMobile2={ {
						value: gradientOverlayLocationMobile2,
						label: 'gradientOverlayLocationMobile2',
					} }
					backgroundGradientType={ {
						value: gradientType,
						label: 'gradientType',
					} }
					backgroundOverlayGradientType={ {
						value: gradientOverlayType,
						label: 'gradientOverlayType',
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
					backgroundOverlayGradientAngle={ {
						value: gradientOverlayAngle,
						label: 'gradientOverlayAngle',
					} }
					backgroundOverlayGradientAngleTablet={ {
						value: gradientOverlayAngleTablet,
						label: 'gradientOverlayAngleTablet',
					} }
					backgroundOverlayGradientAngleMobile={ {
						value: gradientOverlayAngleMobile,
						label: 'gradientOverlayAngleMobile',
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
					imageOverlayResponsive={ true }
					backgroundColor={ {
						value: backgroundColor,
						label: 'backgroundColor',
					} }
					backgroundOverlayColor={ {
						value: backgroundOverlayColor,
						label: 'backgroundOverlayColor',
					} }
					backgroundType={ {
						value: backgroundType,
						label: 'backgroundType',
					} }
					overlayType={ {
						value: overlayType,
						label: 'overlayType',
					} }
					overlayOpacity={ {
						value: overlayOpacity,
						label: 'overlayOpacity',
					} }
					gradientOverlay={ {
						value: true,
					} }
					customPosition={ {
						value: customPosition,
						label: 'customPosition',
					} }
					centralizedPosition={ {
						value: centralizedPosition,
						label: 'centralizedPosition',
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
						value: overlayOpacity,
						label: 'overlayOpacity',
					} }
					backgroundVideoFallbackImage={ {
						value: backgroundVideoFallbackImage,
						label: 'backgroundVideoFallbackImage',
					} }
					overlayGradientType={ {
						value: selectOverlayGradient,
						label: 'selectOverlayGradient',
					} }
					backgroundOverlaySize={ {
						desktop: {
							value: backgroundSizeOverlayDesktop,
							label: 'backgroundSizeOverlayDesktop',
						},
						tablet: {
							value: backgroundSizeOverlayTablet,
							label: 'backgroundSizeOverlayTablet',
						},
						mobile: {
							value: backgroundSizeOverlayMobile,
							label: 'backgroundSizeOverlayMobile',
						},
					} }
					backgroundOverlayCustomSize={ {
						desktop: {
							value: backgroundCustomSizeOverlayDesktop,
							label: 'backgroundCustomSizeOverlayDesktop',
						},
						tablet: {
							value: backgroundCustomSizeOverlayTablet,
							label: 'backgroundCustomSizeOverlayTablet',
						},
						mobile: {
							value: backgroundCustomSizeOverlayMobile,
							label: 'backgroundCustomSizeOverlayMobile',
						},
					} }
					backgroundOverlayCustomSizeType={ {
						value: backgroundCustomOverlaySizeType,
						label: 'backgroundCustomOverlaySizeType',
					} }
					backgroundOverlayRepeat={ {
						desktop: {
							value: backgroundRepeatOverlayDesktop,
							label: 'backgroundRepeatOverlayDesktop',
						},
						tablet: {
							value: backgroundRepeatOverlayTablet,
							label: 'backgroundRepeatOverlayTablet',
						},
						mobile: {
							value: backgroundRepeatOverlayMobile,
							label: 'backgroundRepeatOverlayMobile',
						},
					} }
					backgroundOverlayAttachment={ {
						desktop: {
							value: backgroundAttachmentOverlayDesktop,
							label: 'backgroundAttachmentOverlayDesktop',
						},
						tablet: {
							value: backgroundAttachmentOverlayTablet,
							label: 'backgroundAttachmentOverlayTablet',
						},
						mobile: {
							value: backgroundAttachmentOverlayMobile,
							label: 'backgroundAttachmentOverlayMobile',
						},
					} }
					backgroundOverlayPosition={ {
						desktop: {
							value: backgroundPositionOverlayDesktop,
							label: 'backgroundPositionOverlayDesktop',
						},
						tablet: {
							value: backgroundPositionOverlayTablet,
							label: 'backgroundPositionOverlayTablet',
						},
						mobile: {
							value: backgroundPositionOverlayMobile,
							label: 'backgroundPositionOverlayMobile',
						},
					} }
					backgroundOverlayImage={ {
						desktop: {
							value: backgroundOverlayImageDesktop,
							label: 'backgroundOverlayImageDesktop',
						},
						tablet: {
							value: backgroundOverlayImageTablet,
							label: 'backgroundOverlayImageTablet',
						},
						mobile: {
							value: backgroundOverlayImageMobile,
							label: 'backgroundOverlayImageMobile',
						},
					} }
					customOverlayPosition={ {
						value: customOverlayPosition,
						label: 'customOverlayPosition',
					} }
					xPositionOverlayDesktop={ {
						value: xPositionOverlayDesktop,
						label: 'xPositionOverlayDesktop',
					} }
					xPositionOverlayTablet={ {
						value: xPositionOverlayTablet,
						label: 'xPositionOverlayTablet',
					} }
					xPositionOverlayMobile={ {
						value: xPositionOverlayMobile,
						label: 'xPositionOverlayMobile',
					} }
					xPositionOverlayType={ {
						value: xPositionOverlayType,
						label: 'xPositionOverlayType',
					} }
					xPositionOverlayTypeTablet={ {
						value: xPositionOverlayTypeTablet,
						label: 'xPositionOverlayTypeTablet',
					} }
					xPositionOverlayTypeMobile={ {
						value: xPositionOverlayTypeMobile,
						label: 'xPositionOverlayTypeMobile',
					} }
					yPositionOverlayDesktop={ {
						value: yPositionOverlayDesktop,
						label: 'yPositionOverlayDesktop',
					} }
					yPositionOverlayTablet={ {
						value: yPositionOverlayTablet,
						label: 'yPositionOverlayTablet',
					} }
					yPositionOverlayMobile={ {
						value: yPositionOverlayMobile,
						label: 'yPositionOverlayMobile',
					} }
					yPositionOverlayType={ {
						value: yPositionOverlayType,
						label: 'yPositionOverlayType',
					} }
					yPositionOverlayTypeTablet={ {
						value: yPositionOverlayTypeTablet,
						label: 'yPositionOverlayTypeTablet',
					} }
					yPositionOverlayTypeMobile={ {
						value: yPositionOverlayTypeMobile,
						label: 'yPositionOverlayTypeMobile',
					} }
					overlayBlendMode={ {
						desktop: {
							value: overlayBlendMode,
							label: 'overlayBlendMode',
						},
						tablet: {
							value: overlayBlendModeTablet,
							label: 'overlayBlendModeTablet',
						},
						mobile: {
							value: overlayBlendModeMobile,
							label: 'overlayBlendModeMobile',
						},
					} }
					onOpacityChange={ ( opacity ) => setAttributes( { overlayOpacity: opacity } ) }
					{ ...props }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const linkColorMarkup = (
		<AdvancedPopColorControl
			label={ __( 'Link Color', 'vexaltrix' ) }
			colorValue={ linkColor }
			data={ {
				value: linkColor,
				label: 'linkColor',
			} }
			setAttributes={ setAttributes }
		/>
	);

	const linkHoverColorMarkup = (
		<AdvancedPopColorControl
			label={ __( 'Link Color', 'vexaltrix' ) }
			colorValue={ linkHoverColor }
			data={ {
				value: linkHoverColor,
				label: 'linkHoverColor',
			} }
			setAttributes={ setAttributes }
		/>
	);

	const colorSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Color', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Text Color', 'vexaltrix' ) }
					colorValue={ textColor }
					data={ {
						value: textColor,
						label: 'textColor',
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
					] }
					normal={ linkColorMarkup }
					hover={ linkHoverColorMarkup }
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
					prefix={ 'container' }
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
	};

	const marginHelpText =
		'alignwide' === contentWidth
			? __( 'The left-right margins will be inherited from theme for boxed containers.', 'vexaltrix' )
			: __( 'The left-right margins will not be applied for full-width containers.', 'vexaltrix' );

	const spacingSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
				<ResponsiveSlider
					label={ __( 'Row Gap', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: rowGapDesktop,
							label: 'rowGapDesktop',
							unit: {
								value: rowGapType,
								label: 'rowGapType',
							},
						},
						tablet: {
							value: rowGapTablet,
							label: 'rowGapTablet',
							unit: {
								value: rowGapTypeTablet,
								label: 'rowGapTypeTablet',
							},
						},
						mobile: {
							value: rowGapMobile,
							label: 'rowGapMobile',
							unit: {
								value: rowGapTypeMobile,
								label: 'rowGapTypeMobile',
							},
						},
					} }
					min={ 0 }
					max={ 200 }
					units={ [
						{
							name: __( 'PX', 'vexaltrix' ),
							unitValue: 'px',
						},
						{
							name: __( '%', 'vexaltrix' ),
							unitValue: '%',
						},
						{
							name: __( 'VW', 'vexaltrix' ),
							unitValue: 'vw',
						},
					] }
					setAttributes={ setAttributes }
				/>
				<ResponsiveSlider
					label={ __( 'Column Gap', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: columnGapDesktop,
							label: 'columnGapDesktop',
							unit: {
								value: columnGapType,
								label: 'columnGapType',
							},
						},
						tablet: {
							value: columnGapTablet,
							label: 'columnGapTablet',
							unit: {
								value: columnGapTypeTablet,
								label: 'columnGapTypeTablet',
							},
						},
						mobile: {
							value: columnGapMobile,
							label: 'columnGapMobile',
							unit: {
								value: columnGapTypeMobile,
								label: 'columnGapTypeMobile',
							},
						},
					} }
					min={ 0 }
					max={ 200 }
					units={ [
						{
							name: __( 'PX', 'vexaltrix' ),
							unitValue: 'px',
						},
						{
							name: __( '%', 'vexaltrix' ),
							unitValue: '%',
						},
						{
							name: __( 'VW', 'vexaltrix' ),
							unitValue: 'vw',
						},
					] }
					setAttributes={ setAttributes }
				/>
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
					help={ 'default' !== contentWidth && marginHelpText }
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
							min={ 0 }
							max={ 100 }
							unit={ {
								value: topDividerWidthType,
								label: 'topDividerWidthType',
							} }
							units={ [
								{
									name: __( '%', 'vexaltrix' ),
									unitValue: '%',
								},
							] }
						/>
						<ResponsiveSlider
							label={ __( 'Height', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: topHeight,
									label: 'topHeight',
									unit: {
										value: topHeightType,
										label: 'topHeightType',
									},
								},
								tablet: {
									value: topHeightTablet,
									label: 'topHeightTablet',
									unit: {
										value: topHeightTypeTablet,
										label: 'topHeightTypeTablet',
									},
								},
								mobile: {
									value: topHeightMobile,
									label: 'topHeightMobile',
									unit: {
										value: topHeightTypeMobile,
										label: 'topHeightTypeMobile',
									},
								},
							} }
							min={ 0 }
							max={ 500 }
							unit={ {
								value: topDividerHeightType,
								label: 'topDividerHeightType',
							} }
							units={ [
								{
									name: __( 'PX', 'vexaltrix' ),
									unitValue: 'px',
								},
							] }
							setAttributes={ setAttributes }
						/>
						<ToggleControl
							label={ __( 'Flip', 'vexaltrix' ) }
							checked={ topFlip }
							onChange={ () => setAttributes( { topFlip: ! topFlip } ) }
						/>
						<ToggleControl
							label={ __( 'Invert', 'vexaltrix' ) }
							checked={ topInvert }
							onChange={ () =>
								setAttributes( {
									topInvert: ! topInvert,
								} )
							}
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
							min={ 0 }
							max={ 100 }
							unit={ {
								value: bottomDividerWidthType,
								label: 'bottomDividerWidthType',
							} }
							units={ [
								{
									name: __( '%', 'vexaltrix' ),
									unitValue: '%',
								},
							] }
						/>
						<ResponsiveSlider
							label={ __( 'Height', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: bottomHeight,
									label: 'bottomHeight',
									unit: {
										value: bottomHeightType,
										label: 'bottomHeightType',
									},
								},
								tablet: {
									value: bottomHeightTablet,
									label: 'bottomHeightTablet',
									unit: {
										value: bottomHeightTypeTablet,
										label: 'bottomHeightTypeTablet',
									},
								},
								mobile: {
									value: bottomHeightMobile,
									label: 'bottomHeightMobile',
									unit: {
										value: bottomHeightTypeMobile,
										label: 'bottomHeightTypeMobile',
									},
								},
							} }
							min={ 0 }
							max={ 500 }
							unit={ {
								value: bottomDividerHeightType,
								label: 'bottomDividerHeightType',
							} }
							units={ [
								{
									name: __( 'PX', 'vexaltrix' ),
									unitValue: 'px',
								},
							] }
							setAttributes={ setAttributes }
						/>
						<ToggleControl
							label={ __( 'Flip', 'vexaltrix' ) }
							checked={ bottomFlip }
							onChange={ () => setAttributes( { bottomFlip: ! bottomFlip } ) }
						/>
						<ToggleControl
							label={ __( 'Invert', 'vexaltrix' ) }
							checked={ bottomInvert }
							onChange={ () =>
								setAttributes( {
									bottomInvert: ! bottomInvert,
								} )
							}
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
		<InspectorControls>
			<InspectorTabs>
				<InspectorTab { ...UAGTabs.general } parentProps={ props }>
					{ generalSettings() }
					{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
						proUpgradePanel() }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.style } parentProps={ props }>
					{ backgroundSettings() }
					{ colorSettings() }
					{ borderSettings() }
					{ boxShadowSettings() }
					{ shapeDividersSettings() }
					{ spacingSettings() }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.advance } parentProps={ props }>
					{ renderGBSSettings( styling, setAttributes, attributes ) }
				</InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);
};
export default memo( Settings );
