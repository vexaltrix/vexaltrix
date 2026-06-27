import { __ } from '@wordpress/i18n';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import { SelectControl, ToggleControl } from '@wordpress/components';
import styles from './editor.lazy.scss';
import GradientSettings from '@Components/gradient-settings';
import { useEffect, useState, useRef, useLayoutEffect } from '@wordpress/element';
import UAGMediaPicker from '@Components/image';
import ResponsiveSlider from '@Components/responsive-slider';
import ResponsiveSelectControl from '@Components/responsive-select';
import { useDeviceType } from '@Controls/getPreviewType';
import ResponsiveUAGImage from '@Components/responsive-image';
import ResponsiveUAGFocalPointPicker from '@Components/responsive-focal-point-picker';
import MultiButtonsControl from '@Components/multi-buttons-control';
import VXT_Block_Icons from '@Controls/block-icons';
import { getPanelIdFromRef } from '@Utils/Helpers';
import { select } from '@wordpress/data';
import UAGHelpText from '@Components/help-text';
import { applyFilters } from '@wordpress/hooks';
import Range from '@Components/range/Range';
import Separator from '@Components/separator';

const Background = ( props ) => {
	const { getSelectedBlock } = select( 'core/block-editor' );
	const [ panelNameForHook, setPanelNameForHook ] = useState( null );
	const panelRef = useRef( null );

	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const deviceType = useDeviceType().toLowerCase();

	const {
		setAttributes,
		overlayType,
		overlayOpacity,
		backgroundSize,
		backgroundRepeat,
		backgroundAttachment,
		backgroundPosition,
		backgroundImage,
		backgroundColor,
		backgroundVideoType,
		backgroundType,
		backgroundVideo,
		backgroundVideoColor,
		onOpacityChange,
		backgroundCustomSize,
		backgroundCustomSizeType,
		imageResponsive,
		gradientOverlay,
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
		backgroundVideoOpacity,
		help = false,
		backgroundOverlaySize,
		backgroundOverlayRepeat,
		backgroundOverlayAttachment,
		backgroundOverlayPosition,
		backgroundOverlayImage,
		backgroundImageColor,
		backgroundOverlayCustomSize,
		backgroundOverlayCustomSizeType,
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
		imageOverlayResponsive,
		label = __( 'Type', 'vexaltrix' ),
		backgroundVideoFallbackImage,
	} = props;

	const blockNameForHook = getSelectedBlock()?.name.split( '/' ).pop();
	useEffect( () => {
		setPanelNameForHook( getPanelIdFromRef( panelRef ) );
	}, [ blockNameForHook ] );

	const onRemoveImage = () => {
		setAttributes( { [ backgroundImage.label ]: null } );
	};

	const onSelectImage = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { [ backgroundImage.label ]: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			return;
		}

		setAttributes( { [ backgroundImage.label ]: media } );
	};

	const onRemoveVideo = () => {
		setAttributes( { [ backgroundVideo.label ]: null } );
	};

	const onSelectVideo = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { [ backgroundVideo.label ]: null } );
			return;
		}
		if ( ! media.type || 'video' !== media.type ) {
			return;
		}
		setAttributes( { [ backgroundVideo.label ]: media } );
	};

	const onRemoveBgFallbackImage = () => {
		setAttributes( { [ backgroundVideoFallbackImage.label ]: null } );
	};

	const onSelectBgFallbackImage = ( media ) => {
		if ( ! media?.url ) {
			setAttributes( { [ backgroundVideoFallbackImage.label ]: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			return;
		}

		setAttributes( { [ backgroundVideoFallbackImage.label ]: media } );
	};

	// For now, we are only rendering this setting if the current block is a Container.
	const currentBlock = select( 'core/block-editor' ).getSelectedBlock();

	const isContainer = 'vexaltrix/container' === currentBlock?.name;

	let overlayOptions = [];

	if ( isContainer ) {
		// Only allow specific overlay options for Container with different background types
		switch ( backgroundType.value ) {
			case 'color':
			case 'gradient':
				overlayOptions.push( {
					value: 'image',
					icon: VXT_Block_Icons.bg_image,
					tooltip: __( 'Image', 'vexaltrix' ),
				} );
				break;
			case 'image':
				overlayOptions.push(
					{
						value: 'color',
						icon: VXT_Block_Icons.bg_color,
						tooltip: __( 'Color', 'vexaltrix' ),
					},
					{
						value: 'gradient',
						icon: VXT_Block_Icons.bg_gradient,
						tooltip: __( 'Gradient', 'vexaltrix' ),
					},
					{
						value: 'image',
						icon: VXT_Block_Icons.bg_image,
						tooltip: __( 'Image', 'vexaltrix' ),
					}
				);
				break;
			case 'video':
				overlayOptions.push(
					{
						value: 'color',
						icon: VXT_Block_Icons.bg_color,
						tooltip: __( 'Color', 'vexaltrix' ),
					},
					{
						value: 'gradient',
						icon: VXT_Block_Icons.bg_gradient,
						tooltip: __( 'Gradient', 'vexaltrix' ),
					}
				);
				break;
		}
	} else {
		// Default overlay options for non-Container blocks
		overlayOptions = [
			{
				value: 'none',
				label: __( 'None', 'vexaltrix' ),
			},
			{
				value: 'color',
				label: __( 'Classic', 'vexaltrix' ),
			},
		];

		if ( gradientOverlay.value ) {
			overlayOptions.push( {
				value: 'gradient',
				label: __( 'Gradient', 'vexaltrix' ),
			} );
		}
	}

	const bgIconOptions = [
		{
			value: 'color',
			icon: VXT_Block_Icons.bg_color,
			tooltip: __( 'Color', 'vexaltrix' ),
		},
		{
			value: 'gradient',
			icon: VXT_Block_Icons.bg_gradient,
			tooltip: __( 'Gradient', 'vexaltrix' ),
		},
		{
			value: 'image',
			icon: VXT_Block_Icons.bg_image,
			tooltip: __( 'Image', 'vexaltrix' ),
		},
	];

	let bgSizeOptions = [
		{
			value: 'auto',
			label: __( 'Auto', 'vexaltrix' ),
		},
		{
			value: 'cover',
			label: __( 'Cover', 'vexaltrix' ),
		},
		{
			value: 'contain',
			label: __( 'Contain', 'vexaltrix' ),
		},
		{
			value: 'custom',
			label: __( 'Custom', 'vexaltrix' ),
		},
	];

	if ( ! backgroundCustomSize ) {
		bgSizeOptions = [
			{
				value: 'auto',
				label: __( 'Auto', 'vexaltrix' ),
			},
			{
				value: 'cover',
				label: __( 'Cover', 'vexaltrix' ),
			},
			{
				value: 'contain',
				label: __( 'Contain', 'vexaltrix' ),
			},
		];
	}

	if ( backgroundVideoType.value ) {
		bgIconOptions.push( {
			value: 'video',
			icon: VXT_Block_Icons.bg_video,
			tooltip: __( 'Video', 'vexaltrix' ),
		} );
	}

	const setImage =
		imageResponsive &&
		( backgroundImage.desktop?.value || backgroundImage.tablet?.value || backgroundImage.mobile?.value )
			? true
			: false;

	// Render Common Overlay Controls.
	const renderOverlayControls = () => {
		// Return early if the selected block is not a Container.
		if ( ! isContainer ) {
			return null;
		}

		return (
			<>
				<div className="uag-background-image-overlay-opacity">
					<Range
						label={ __( 'Overlay Opacity', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ overlayOpacity.value }
						data={ {
							value: overlayOpacity.value,
							label: overlayOpacity.label,
						} }
						min={ 0 }
						max={ 1 }
						step={ 0.05 }
						displayUnit={ false }
					/>
				</div>
			</>
		);
	};

	//Render Common Overlay Controls.
	const renderOverlayImageControls = () => {
		// Return early if the selected block is not a Container.
		if ( ! isContainer ) {
			return null;
		}

		const onRemoveOverlayImage = () => {
			setAttributes( { [ backgroundOverlayImage.label ]: null } );
		};

		const onSelectOverlayImage = ( media ) => {
			if ( ! media || ! media.url ) {
				setAttributes( { [ backgroundOverlayImage.label ]: null } );
				return;
			}

			if ( ! media.type || 'image' !== media.type ) {
				return;
			}

			setAttributes( { [ backgroundOverlayImage.label ]: media } );
		};

		const setOverlayImage =
			imageOverlayResponsive &&
			( backgroundOverlayImage.desktop?.value ||
				backgroundOverlayImage.tablet?.value ||
				backgroundOverlayImage.mobile?.value )
				? true
				: false;

		return (
			<>
				<div className="uag-background-image">
					{ ! imageOverlayResponsive && (
						<UAGMediaPicker
							onSelectImage={ onSelectOverlayImage }
							backgroundOverlayImage={ backgroundOverlayImage.value }
							onRemoveImage={ onRemoveOverlayImage }
							disableLabel={ true }
						/>
					) }
					{ ! imageOverlayResponsive && backgroundOverlayImage.value && (
						<>
							<div className="uag-background-image-position">
								<SelectControl
									label={ __( 'Image Position', 'vexaltrix' ) }
									value={ backgroundOverlayPosition.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ backgroundOverlayPosition.label ]: value,
										} )
									}
									options={ [
										{
											value: 'left top',
											label: __( 'Top Left', 'vexaltrix' ),
										},
										{
											value: 'center top',
											label: __( 'Top Center', 'vexaltrix' ),
										},
										{
											value: 'right top',
											label: __( 'Top Right', 'vexaltrix' ),
										},
										{
											value: 'center top',
											label: __( 'Center Top', 'vexaltrix' ),
										},
										{
											value: 'center center',
											label: __( 'Center Center', 'vexaltrix' ),
										},
										{
											value: 'center bottom',
											label: __( 'Center Bottom', 'vexaltrix' ),
										},
										{
											value: 'left bottom',
											label: __( 'Bottom Left', 'vexaltrix' ),
										},
										{
											value: 'center bottom',
											label: __( 'Bottom Center', 'vexaltrix' ),
										},
										{
											value: 'right bottom',
											label: __( 'Bottom Right', 'vexaltrix' ),
										},
									] }
								/>
							</div>
							<div className="uag-background-image-attachment">
								<SelectControl
									label={ __( 'Attachment', 'vexaltrix' ) }
									value={ backgroundOverlayAttachment.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ backgroundOverlayAttachment.label ]: value,
										} )
									}
									options={ [
										{
											value: 'fixed',
											label: __( 'Fixed', 'vexaltrix' ),
										},
										{
											value: 'scroll',
											label: __( 'Scroll', 'vexaltrix' ),
										},
									] }
								/>
							</div>
							<div className="uag-background-blend-mode">
								<SelectControl
									label={ __( 'Blend Mode', 'vexaltrix' ) }
									value={ overlayBlendMode.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ overlayBlendMode.label ]: value,
										} )
									}
									options={ [
										{
											value: 'normal',
											label: __( 'Normal', 'vexaltrix' ),
										},
										{
											value: 'multiply',
											label: __( 'Multiply', 'vexaltrix' ),
										},
										{
											value: 'screen',
											label: __( 'Screen', 'vexaltrix' ),
										},
										{
											value: 'overlay',
											label: __( 'Overlay', 'vexaltrix' ),
										},
										{
											value: 'darken',
											label: __( 'Darken', 'vexaltrix' ),
										},
										{
											value: 'lighten',
											label: __( 'Lighten', 'vexaltrix' ),
										},
										{
											value: 'color-dodge',
											label: __( 'Color Dodge', 'vexaltrix' ),
										},
										{
											value: 'saturation',
											label: __( 'Saturation', 'vexaltrix' ),
										},
										{
											value: 'color',
											label: __( 'Color', 'vexaltrix' ),
										},
									] }
								/>
							</div>
							<div className="uag-background-image-repeat">
								<SelectControl
									label={ __( 'Repeat', 'vexaltrix' ) }
									value={ backgroundOverlayRepeat.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ backgroundOverlayRepeat.label ]: value,
										} )
									}
									options={ [
										{
											value: 'no-repeat',
											label: __( 'No Repeat', 'vexaltrix' ),
										},
										{
											value: 'repeat',
											label: __( 'Repeat', 'vexaltrix' ),
										},
										{
											value: 'repeat-x',
											label: __( 'Repeat-x', 'vexaltrix' ),
										},
										{
											value: 'repeat-y',
											label: __( 'Repeat-y', 'vexaltrix' ),
										},
									] }
								/>
							</div>
							<div className="uag-background-image-size">
								<SelectControl
									label={ __( 'Size', 'vexaltrix' ) }
									value={ backgroundOverlaySize.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ backgroundOverlaySize.label ]: value,
										} )
									}
									options={ bgSizeOptions }
								/>
								{ 'custom' === backgroundOverlaySize.value && backgroundOverlayCustomSize && (
									<ResponsiveSlider
										label={ __( 'Width', 'vexaltrix' ) }
										data={ {
											desktop: {
												value: backgroundOverlayCustomSize.desktop.value,
												label: backgroundOverlayCustomSize.desktop.label,
											},
											tablet: {
												value: backgroundOverlayCustomSize.tablet.value,
												label: backgroundOverlayCustomSize.tablet.label,
											},
											mobile: {
												value: backgroundOverlayCustomSize.mobile.value,
												label: backgroundOverlayCustomSize.mobile.label,
											},
										} }
										min={ 0 }
										limitMax={ { px: 1600, '%': 100, em: 574 } }
										unit={ {
											value: backgroundOverlayCustomSizeType.value,
											label: backgroundOverlayCustomSizeType.label,
										} }
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
												name: __( 'EM', 'vexaltrix' ),
												unitValue: 'em',
											},
										] }
										setAttributes={ setAttributes }
									/>
								) }
							</div>
						</>
					) }
					{ imageOverlayResponsive && backgroundOverlayImage && (
						<ResponsiveUAGImage
							backgroundImage={ backgroundOverlayImage }
							setAttributes={ setAttributes }
						/>
					) }
					{ imageOverlayResponsive && backgroundOverlayImage && setOverlayImage && (
						<>
							<div className="uag-background-image-position">
								<MultiButtonsControl
									setAttributes={ setAttributes }
									label={ __( 'Image Position', 'vexaltrix' ) }
									data={ {
										value: customOverlayPosition.value,
										label: customOverlayPosition.label,
									} }
									options={ [
										{ value: 'default', label: __( 'Default', 'vexaltrix' ) },
										{ value: 'custom', label: __( 'Custom', 'vexaltrix' ) },
									] }
								/>
							</div>
							{ 'custom' !== customOverlayPosition.value && (
								<div className="uag-background-image-position">
									<ResponsiveUAGFocalPointPicker
										backgroundPosition={ backgroundOverlayPosition }
										setAttributes={ setAttributes }
										backgroundImage={ backgroundOverlayImage }
									/>
								</div>
							) }
							{ 'custom' === customOverlayPosition.value && (
								<>
									<div className="uag-background-image-position">
										<ResponsiveSlider
											label={ __( 'X Position', 'vexaltrix' ) }
											data={ {
												desktop: {
													value: xPositionOverlayDesktop.value,
													label: 'xPositionOverlayDesktop',
													unit: {
														value: xPositionOverlayType.value,
														label: 'xPositionOverlayType',
													},
												},
												tablet: {
													value: xPositionOverlayTablet.value,
													label: 'xPositionOverlayTablet',
													unit: {
														value: xPositionOverlayTypeTablet.value,
														label: 'xPositionOverlayTypeTablet',
													},
												},
												mobile: {
													value: xPositionOverlayMobile.value,
													label: 'xPositionOverlayMobile',
													unit: {
														value: xPositionOverlayTypeMobile.value,
														label: 'xPositionOverlayTypeMobile',
													},
												},
											} }
											limitMin={ { px: -800, '%': -100, em: -100, vw: -100 } }
											limitMax={ { px: 800, '%': 100, em: 100, vw: 100 } }
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
													name: __( 'EM', 'vexaltrix' ),
													unitValue: 'em',
												},
												{
													name: __( 'VW', 'vexaltrix' ),
													unitValue: 'vw',
												},
											] }
											setAttributes={ setAttributes }
										/>
									</div>
									<div className="uag-background-image-position">
										<ResponsiveSlider
											label={ __( 'Y Position', 'vexaltrix' ) }
											data={ {
												desktop: {
													value: yPositionOverlayDesktop.value,
													label: 'yPositionOverlayDesktop',
													unit: {
														value: yPositionOverlayType.value,
														label: 'yPositionOverlayType',
													},
												},
												tablet: {
													value: yPositionOverlayTablet.value,
													label: 'yPositionOverlayTablet',
													unit: {
														value: yPositionOverlayTypeTablet.value,
														label: 'yPositionOverlayTypeTablet',
													},
												},
												mobile: {
													value: yPositionOverlayMobile.value,
													label: 'yPositionOverlayMobile',
													unit: {
														value: yPositionOverlayTypeMobile.value,
														label: 'yPositionOverlayTypeMobile',
													},
												},
											} }
											limitMin={ { px: -800, '%': -100, em: -100, vh: -100 } }
											limitMax={ { px: 800, '%': 100, em: 100, vh: 100 } }
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
													name: __( 'EM', 'vexaltrix' ),
													unitValue: 'em',
												},
												{
													name: __( 'VH', 'vexaltrix' ),
													unitValue: 'vh',
												},
											] }
											setAttributes={ setAttributes }
										/>
									</div>
								</>
							) }
							<div className="uag-background-image-attachment">
								<ResponsiveSelectControl
									label={ __( 'Attachment', 'vexaltrix' ) }
									data={ backgroundOverlayAttachment }
									options={ {
										desktop: [
											{
												value: 'fixed',
												label: __( 'Fixed', 'vexaltrix' ),
											},
											{
												value: 'scroll',
												label: __( 'Scroll', 'vexaltrix' ),
											},
										],
									} }
									setAttributes={ setAttributes }
								/>
							</div>
							<div className="uag-background-blend-mode">
								<ResponsiveSelectControl
									label={ __( 'Blend Mode', 'vexaltrix' ) }
									data={ overlayBlendMode }
									options={ {
										desktop: [
											{
												value: 'normal',
												label: __( 'Normal', 'vexaltrix' ),
											},
											{
												value: 'multiply',
												label: __( 'Multiply', 'vexaltrix' ),
											},
											{
												value: 'screen',
												label: __( 'Screen', 'vexaltrix' ),
											},
											{
												value: 'overlay',
												label: __( 'Overlay', 'vexaltrix' ),
											},
											{
												value: 'darken',
												label: __( 'Darken', 'vexaltrix' ),
											},
											{
												value: 'lighten',
												label: __( 'Lighten', 'vexaltrix' ),
											},
											{
												value: 'color-dodge',
												label: __( 'Color Dodge', 'vexaltrix' ),
											},
											{
												value: 'saturation',
												label: __( 'Saturation', 'vexaltrix' ),
											},
											{
												value: 'color',
												label: __( 'Color', 'vexaltrix' ),
											},
										],
									} }
									setAttributes={ setAttributes }
								/>
							</div>
							<div className="uag-background-image-repeat">
								<ResponsiveSelectControl
									label={ __( 'Repeat', 'vexaltrix' ) }
									data={ backgroundOverlayRepeat }
									options={ {
										desktop: [
											{
												value: 'no-repeat',
												label: __( 'No Repeat', 'vexaltrix' ),
											},
											{
												value: 'repeat',
												label: __( 'Repeat', 'vexaltrix' ),
											},
											{
												value: 'repeat-x',
												label: __( 'Repeat-x', 'vexaltrix' ),
											},
											{
												value: 'repeat-y',
												label: __( 'Repeat-y', 'vexaltrix' ),
											},
										],
									} }
									setAttributes={ setAttributes }
								/>
							</div>
							<div className="uag-background-image-size">
								<ResponsiveSelectControl
									label={ __( 'Size', 'vexaltrix' ) }
									data={ backgroundOverlaySize }
									options={ {
										desktop: [
											{
												value: 'auto',
												label: __( 'Auto', 'vexaltrix' ),
											},
											{
												value: 'cover',
												label: __( 'Cover', 'vexaltrix' ),
											},
											{
												value: 'contain',
												label: __( 'Contain', 'vexaltrix' ),
											},
											{
												value: 'custom',
												label: __( 'Custom', 'vexaltrix' ),
											},
										],
									} }
									setAttributes={ setAttributes }
								/>
								{ 'custom' === backgroundOverlaySize[ deviceType ].value &&
									backgroundOverlayCustomSize && (
										<ResponsiveSlider
											label={ __( 'Width', 'vexaltrix' ) }
											data={ backgroundOverlayCustomSize }
											min={ 0 }
											limitMax={ { px: 1600, '%': 100, em: 574 } }
											unit={ {
												value: backgroundOverlayCustomSizeType.value,
												label: backgroundOverlayCustomSizeType.label,
											} }
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
													name: __( 'EM', 'vexaltrix' ),
													unitValue: 'em',
												},
											] }
											setAttributes={ setAttributes }
										/>
									) }
							</div>
						</>
					) }
					{ renderOverlayControls() }
				</div>
			</>
		);
	};

	const buttonControl = (
		<>
			<Separator />
			<div className="uag-background-image-overlay-type">
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Overlay Type', 'vexaltrix' ) }
					data={ {
						value: overlayType.value,
						label: overlayType.label,
					} }
					options={ overlayOptions }
					showIcons={ isContainer ? true : false }
					colorVariant="secondary"
					layoutVariant="inline"
				/>
			</div>
		</>
	);

	const overlayControls = (
		<>
			{ ( ( backgroundType.value === 'color' && backgroundColor.value ) ||
				( backgroundType.value === 'gradient' && gradientOverlay.value ) ) && (
				<>
					{ buttonControl }
					{ 'image' === overlayType.value && renderOverlayImageControls() }
				</>
			) }
			{ backgroundType.value === 'image' &&
				( ( imageResponsive && setImage ) || ( ! imageResponsive && backgroundImage?.value ) ) && (
					<>
						{ buttonControl }
						{ 'color' === overlayType.value && (
							<>
								<div className="uag-background-image-overlay-color">
									<AdvancedPopColorControl
										label={ __( 'Image Overlay Color', 'vexaltrix' ) }
										colorValue={ backgroundImageColor.value }
										data={ {
											value: backgroundImageColor.value,
											label: backgroundImageColor.label,
										} }
										setAttributes={ setAttributes }
									/>
								</div>
								{ renderOverlayControls() }
							</>
						) }
						{ 'gradient' === overlayType.value && (
							<>
								<div className="uag-background-image-overlay-gradient">
									<GradientSettings
										backgroundGradient={ props.backgroundGradient }
										setAttributes={ setAttributes }
										gradientType={ props.gradientType }
										backgroundGradientColor2={ props.backgroundGradientColor2 }
										backgroundGradientColor1={ props.backgroundGradientColor1 }
										backgroundGradientType={ props.backgroundGradientType }
										backgroundGradientLocation1={ props.backgroundGradientLocation1 }
										backgroundGradientLocationTablet1={ props.backgroundGradientLocationTablet1 }
										backgroundGradientLocationMobile1={ props.backgroundGradientLocationMobile1 }
										backgroundGradientLocation2={ props.backgroundGradientLocation2 }
										backgroundGradientLocationTablet2={ props.backgroundGradientLocationTablet2 }
										backgroundGradientLocationMobile2={ props.backgroundGradientLocationMobile2 }
										backgroundGradientAngle={ props.backgroundGradientAngle }
										backgroundGradientAngleTablet={ props.backgroundGradientAngleTablet }
										backgroundGradientAngleMobile={ props.backgroundGradientAngleMobile }
									/>
								</div>
								{ renderOverlayControls() }
							</>
						) }
						{ 'image' === overlayType.value && renderOverlayImageControls() }
					</>
				) }
			{ backgroundType.value === 'video' &&
				'video' === backgroundType.value &&
				backgroundVideo.value &&
				backgroundVideoType.value && (
					<div className="uag-background-video-overlay">
						{ overlayType && backgroundVideo && backgroundVideo.value && (
							<>
								{ buttonControl }
								{ 'color' === overlayType.value && (
									<>
										<div className="uag-background-image-overlay-color">
											<AdvancedPopColorControl
												label={ __( 'Image Overlay Color', 'vexaltrix' ) }
												colorValue={ backgroundVideoColor.value }
												data={ {
													value: backgroundVideoColor.value,
													label: backgroundVideoColor.label,
												} }
												setAttributes={ setAttributes }
												onOpacityChange={ onOpacityChange }
												backgroundVideoOpacity={ {
													value: backgroundVideoOpacity.value,
													label: backgroundVideoOpacity.label,
												} }
											/>
										</div>
										{ renderOverlayControls() }
									</>
								) }
								{ gradientOverlay.value && 'gradient' === overlayType.value && (
									<>
										<div className="uag-background-image-overlay-gradient">
											<GradientSettings
												backgroundGradient={ props.backgroundGradient }
												setAttributes={ setAttributes }
												gradientType={ props.gradientType }
												backgroundGradientColor2={ props.backgroundGradientColor2 }
												backgroundGradientColor1={ props.backgroundGradientColor1 }
												backgroundGradientType={ props.backgroundGradientType }
												backgroundGradientLocation1={ props.backgroundGradientLocation1 }
												backgroundGradientLocationTablet1={
													props.backgroundGradientLocationTablet1
												}
												backgroundGradientLocationMobile1={
													props.backgroundGradientLocationMobile1
												}
												backgroundGradientLocation2={ props.backgroundGradientLocation2 }
												backgroundGradientLocationTablet2={
													props.backgroundGradientLocationTablet2
												}
												backgroundGradientLocationMobile2={
													props.backgroundGradientLocationMobile2
												}
												backgroundGradientAngle={ props.backgroundGradientAngle }
												backgroundGradientAngleTablet={ props.backgroundGradientAngleTablet }
												backgroundGradientAngleMobile={ props.backgroundGradientAngleMobile }
											/>
										</div>
										{ renderOverlayControls() }
									</>
								) }
							</>
						) }
					</div>
				) }
		</>
	);

	const advancedControls = (
		<>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ label }
				data={ {
					value: backgroundType.value,
					label: backgroundType.label,
				} }
				options={ bgIconOptions }
				showIcons={ true }
				colorVariant="secondary"
				layoutVariant="inline"
			/>
			{ 'color' === backgroundType.value && (
				<div className="uag-background-color">
					<AdvancedPopColorControl
						label={ __( 'Color', 'vexaltrix' ) }
						colorValue={ backgroundColor.value ? backgroundColor.value : '' }
						data={ {
							value: backgroundColor.value,
							label: backgroundColor.label,
						} }
						setAttributes={ setAttributes }
					/>
				</div>
			) }
			{ 'image' === backgroundType.value && (
				<div className="uag-background-image">
					{ ! imageResponsive && (
						<UAGMediaPicker
							onSelectImage={ onSelectImage }
							backgroundImage={ backgroundImage.value }
							onRemoveImage={ onRemoveImage }
							disableLabel={ true }
						/>
					) }
					{ ! imageResponsive && backgroundImage.value && (
						<>
							<div className="uag-background-image-position">
								<SelectControl
									label={ __( 'Image Position', 'vexaltrix' ) }
									value={ backgroundPosition.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ backgroundPosition.label ]: value,
										} )
									}
									options={ [
										{
											value: 'left top',
											label: __( 'Top Left', 'vexaltrix' ),
										},
										{
											value: 'center top',
											label: __( 'Top Center', 'vexaltrix' ),
										},
										{
											value: 'right top',
											label: __( 'Top Right', 'vexaltrix' ),
										},
										{
											value: 'center top',
											label: __( 'Center Top', 'vexaltrix' ),
										},
										{
											value: 'center center',
											label: __( 'Center Center', 'vexaltrix' ),
										},
										{
											value: 'center bottom',
											label: __( 'Center Bottom', 'vexaltrix' ),
										},
										{
											value: 'left bottom',
											label: __( 'Bottom Left', 'vexaltrix' ),
										},
										{
											value: 'center bottom',
											label: __( 'Bottom Center', 'vexaltrix' ),
										},
										{
											value: 'right bottom',
											label: __( 'Bottom Right', 'vexaltrix' ),
										},
									] }
								/>
							</div>
							<div className="uag-background-image-attachment">
								<SelectControl
									label={ __( 'Attachment', 'vexaltrix' ) }
									value={ backgroundAttachment.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ backgroundAttachment.label ]: value,
										} )
									}
									options={ [
										{
											value: 'fixed',
											label: __( 'Fixed', 'vexaltrix' ),
										},
										{
											value: 'scroll',
											label: __( 'Scroll', 'vexaltrix' ),
										},
									] }
								/>
							</div>
							<div className="uag-background-image-repeat">
								<SelectControl
									label={ __( 'Repeat', 'vexaltrix' ) }
									value={ backgroundRepeat.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ backgroundRepeat.label ]: value,
										} )
									}
									options={ [
										{
											value: 'no-repeat',
											label: __( 'No Repeat', 'vexaltrix' ),
										},
										{
											value: 'repeat',
											label: __( 'Repeat', 'vexaltrix' ),
										},
										{
											value: 'repeat-x',
											label: __( 'Repeat-x', 'vexaltrix' ),
										},
										{
											value: 'repeat-y',
											label: __( 'Repeat-y', 'vexaltrix' ),
										},
									] }
								/>
							</div>
							<div className="uag-background-image-size">
								<SelectControl
									label={ __( 'Size', 'vexaltrix' ) }
									value={ backgroundSize.value }
									onChange={ ( value ) =>
										setAttributes( {
											[ backgroundSize.label ]: value,
										} )
									}
									options={ bgSizeOptions }
								/>
								{ 'custom' === backgroundSize.value && backgroundCustomSize && (
									<ResponsiveSlider
										label={ __( 'Width', 'vexaltrix' ) }
										data={ {
											desktop: {
												value: backgroundCustomSize.desktop.value,
												label: backgroundCustomSize.desktop.label,
											},
											tablet: {
												value: backgroundCustomSize.tablet.value,
												label: backgroundCustomSize.tablet.label,
											},
											mobile: {
												value: backgroundCustomSize.mobile.value,
												label: backgroundCustomSize.mobile.label,
											},
										} }
										min={ 0 }
										limitMax={ { px: 1600, '%': 100, em: 574 } }
										unit={ {
											value: backgroundCustomSizeType.value,
											label: backgroundCustomSizeType.label,
										} }
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
												name: __( 'EM', 'vexaltrix' ),
												unitValue: 'em',
											},
										] }
										setAttributes={ setAttributes }
									/>
								) }
							</div>
						</>
					) }
					{ imageResponsive && backgroundImage && (
						<ResponsiveUAGImage backgroundImage={ backgroundImage } setAttributes={ setAttributes } />
					) }
					{ imageResponsive && backgroundImage && setImage && (
						<>
							<div className="uag-background-image-position">
								<MultiButtonsControl
									setAttributes={ setAttributes }
									label={ __( 'Image Position', 'vexaltrix' ) }
									data={ {
										value: customPosition.value,
										label: customPosition.label,
									} }
									options={ [
										{ value: 'default', label: __( 'Default', 'vexaltrix' ) },
										{ value: 'custom', label: __( 'Custom', 'vexaltrix' ) },
									] }
								/>
							</div>
							{ 'custom' !== customPosition.value && (
								<div className="uag-background-image-position">
									<ResponsiveUAGFocalPointPicker
										backgroundPosition={ backgroundPosition }
										setAttributes={ setAttributes }
										backgroundImage={ backgroundImage }
									/>
								</div>
							) }
							{ 'custom' === customPosition.value && (
								<>
									<div className="uag-background-image-position">
										{ isContainer && (
											<div className="uag-background-image-axis-position">
												<ToggleControl
													label={ __( 'Centralized Position', 'vexaltrix' ) }
													checked={ centralizedPosition.value }
													onChange={ () =>
														setAttributes( {
															[ centralizedPosition.label ]: ! centralizedPosition.value,
														} )
													}
												/>
											</div>
										) }

										<ResponsiveSlider
											label={ __( 'X Position', 'vexaltrix' ) }
											data={ {
												desktop: {
													value: xPositionDesktop.value,
													label: 'xPositionDesktop',
													unit: {
														value: xPositionType.value,
														label: 'xPositionType',
													},
												},
												tablet: {
													value: xPositionTablet.value,
													label: 'xPositionTablet',
													unit: {
														value: xPositionTypeTablet.value,
														label: 'xPositionTypeTablet',
													},
												},
												mobile: {
													value: xPositionMobile.value,
													label: 'xPositionMobile',
													unit: {
														value: xPositionTypeMobile.value,
														label: 'xPositionTypeMobile',
													},
												},
											} }
											limitMin={ { px: -1000, '%': -100, em: -100, vw: -100 } }
											limitMax={ { px: 1000, '%': 100, em: 100, vw: 100 } }
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
													name: __( 'EM', 'vexaltrix' ),
													unitValue: 'em',
												},
												{
													name: __( 'VW', 'vexaltrix' ),
													unitValue: 'vw',
												},
											] }
											setAttributes={ setAttributes }
										/>
									</div>
									<div className="uag-background-image-position">
										<ResponsiveSlider
											label={ __( 'Y Position', 'vexaltrix' ) }
											data={ {
												desktop: {
													value: yPositionDesktop.value,
													label: 'yPositionDesktop',
													unit: {
														value: yPositionType.value,
														label: 'yPositionType',
													},
												},
												tablet: {
													value: yPositionTablet.value,
													label: 'yPositionTablet',
													unit: {
														value: yPositionTypeTablet.value,
														label: 'yPositionTypeTablet',
													},
												},
												mobile: {
													value: yPositionMobile.value,
													label: 'yPositionMobile',
													unit: {
														value: yPositionTypeMobile.value,
														label: 'yPositionTypeMobile',
													},
												},
											} }
											limitMin={ { px: -800, '%': -100, em: -100, vh: -100 } }
											limitMax={ { px: 800, '%': 100, em: 100, vh: 100 } }
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
													name: __( 'EM', 'vexaltrix' ),
													unitValue: 'em',
												},
												{
													name: __( 'VH', 'vexaltrix' ),
													unitValue: 'vh',
												},
											] }
											setAttributes={ setAttributes }
										/>
									</div>
								</>
							) }
							<div className="uag-background-image-attachment">
								<ResponsiveSelectControl
									label={ __( 'Attachment', 'vexaltrix' ) }
									data={ backgroundAttachment }
									options={ {
										desktop: [
											{
												value: 'fixed',
												label: __( 'Fixed', 'vexaltrix' ),
											},
											{
												value: 'scroll',
												label: __( 'Scroll', 'vexaltrix' ),
											},
										],
									} }
									setAttributes={ setAttributes }
								/>
							</div>
							<div className="uag-background-image-repeat">
								<ResponsiveSelectControl
									label={ __( 'Repeat', 'vexaltrix' ) }
									data={ backgroundRepeat }
									options={ {
										desktop: [
											{
												value: 'no-repeat',
												label: __( 'No Repeat', 'vexaltrix' ),
											},
											{
												value: 'repeat',
												label: __( 'Repeat', 'vexaltrix' ),
											},
											{
												value: 'repeat-x',
												label: __( 'Repeat-x', 'vexaltrix' ),
											},
											{
												value: 'repeat-y',
												label: __( 'Repeat-y', 'vexaltrix' ),
											},
										],
									} }
									setAttributes={ setAttributes }
								/>
							</div>
							<div className="uag-background-image-size">
								<ResponsiveSelectControl
									label={ __( 'Size', 'vexaltrix' ) }
									data={ backgroundSize }
									options={ {
										desktop: [
											{
												value: 'auto',
												label: __( 'Auto', 'vexaltrix' ),
											},
											{
												value: 'cover',
												label: __( 'Cover', 'vexaltrix' ),
											},
											{
												value: 'contain',
												label: __( 'Contain', 'vexaltrix' ),
											},
											{
												value: 'custom',
												label: __( 'Custom', 'vexaltrix' ),
											},
										],
									} }
									setAttributes={ setAttributes }
								/>
								{ 'custom' === backgroundSize[ deviceType ].value && backgroundCustomSize && (
									<ResponsiveSlider
										label={ __( 'Width', 'vexaltrix' ) }
										data={ backgroundCustomSize }
										min={ 0 }
										limitMax={ { px: 1600, '%': 100, em: 574 } }
										unit={ {
											value: backgroundCustomSizeType.value,
											label: backgroundCustomSizeType.label,
										} }
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
												name: __( 'EM', 'vexaltrix' ),
												unitValue: 'em',
											},
										] }
										setAttributes={ setAttributes }
									/>
								) }
							</div>
						</>
					) }
					{ ! isContainer &&
						overlayType &&
						backgroundImage &&
						( ( imageResponsive && setImage ) || ( ! imageResponsive && backgroundImage?.value ) ) && (
							<>
								<div className="uag-background-image-overlay-type">
									<MultiButtonsControl
										setAttributes={ setAttributes }
										label={ __( 'Overlay Type', 'vexaltrix' ) }
										data={ {
											value: overlayType.value,
											label: overlayType.label,
										} }
										className="vxt-multi-button-alignment-control"
										options={ overlayOptions }
										showIcons={ false }
									/>
								</div>
								{ 'color' === overlayType.value && (
									<>
										<div className="uag-background-image-overlay-color">
											<AdvancedPopColorControl
												label={ __( 'Image Overlay Color', 'vexaltrix' ) }
												colorValue={ backgroundImageColor.value }
												data={ {
													value: backgroundImageColor.value,
													label: backgroundImageColor.label,
												} }
												setAttributes={ setAttributes }
											/>
										</div>
										{ renderOverlayControls() }
									</>
								) }
								{ 'gradient' === overlayType.value && (
									<>
										<div className="uag-background-image-overlay-gradient">
											<GradientSettings
												backgroundGradient={ props.backgroundGradient }
												setAttributes={ setAttributes }
												gradientType={ props.gradientType }
												backgroundGradientColor2={ props.backgroundGradientColor2 }
												backgroundGradientColor1={ props.backgroundGradientColor1 }
												backgroundGradientType={ props.backgroundGradientType }
												backgroundGradientLocation1={ props.backgroundGradientLocation1 }
												backgroundGradientLocationTablet1={
													props.backgroundGradientLocationTablet1
												}
												backgroundGradientLocationMobile1={
													props.backgroundGradientLocationMobile1
												}
												backgroundGradientLocation2={ props.backgroundGradientLocation2 }
												backgroundGradientLocationTablet2={
													props.backgroundGradientLocationTablet2
												}
												backgroundGradientLocationMobile2={
													props.backgroundGradientLocationMobile2
												}
												backgroundGradientAngle={ props.backgroundGradientAngle }
												backgroundGradientAngleTablet={ props.backgroundGradientAngleTablet }
												backgroundGradientAngleMobile={ props.backgroundGradientAngleMobile }
											/>
										</div>
										{ renderOverlayControls() }
									</>
								) }
							</>
						) }
				</div>
			) }
			{ gradientOverlay.value && 'gradient' === backgroundType.value && (
				<div className="uag-background-gradient">
					<GradientSettings
						backgroundGradient={ props.backgroundGradient }
						gradientType={ props.gradientType }
						setAttributes={ props.setAttributes }
						backgroundGradientColor2={ props.backgroundGradientColor2 }
						backgroundGradientColor1={ props.backgroundGradientColor1 }
						backgroundGradientType={ props.backgroundGradientType }
						backgroundGradientLocation1={ props.backgroundGradientLocation1 }
						backgroundGradientLocationTablet1={ props.backgroundGradientLocationTablet1 }
						backgroundGradientLocationMobile1={ props.backgroundGradientLocationMobile1 }
						backgroundGradientLocation2={ props.backgroundGradientLocation2 }
						backgroundGradientLocationTablet2={ props.backgroundGradientLocationTablet2 }
						backgroundGradientLocationMobile2={ props.backgroundGradientLocationMobile2 }
						backgroundGradientAngle={ props.backgroundGradientAngle }
						backgroundGradientAngleTablet={ props.backgroundGradientAngleTablet }
						backgroundGradientAngleMobile={ props.backgroundGradientAngleMobile }
					/>
				</div>
			) }
			{ 'video' === backgroundType.value && backgroundVideoType.value && (
				<div className="uag-background-video">
					<UAGMediaPicker
						onSelectImage={ onSelectVideo }
						backgroundImage={ backgroundVideo.value }
						onRemoveImage={ onRemoveVideo }
						slug={ 'video' }
						label={ __( 'Video', 'vexaltrix' ) }
						allow={ [ 'video' ] }
					/>
				</div>
			) }
			{ backgroundVideoType?.value && 'video' === backgroundType.value && (
				<div className="uag-background-video-image-fallback">
					<UAGMediaPicker
						slug={ 'image' }
						allow={ [ 'image' ] }
						onSelectImage={ onSelectBgFallbackImage }
						backgroundImage={ backgroundVideoFallbackImage.value }
						onRemoveImage={ onRemoveBgFallbackImage }
						disableDynamicContent={ true }
						label={ __( 'Fallback Image', 'vexaltrix' ) }
						help={ __(
							'This cover image will replace the background video in case that the video could not be loaded.',
							'vexaltrix'
						) }
					/>
				</div>
			) }
			{ isContainer && overlayControls }
		</>
	);
	const controlName = 'background'; // there is no label props that's why keep hard coded label
	const controlBeforeDomElement = applyFilters(
		`vexaltrix.${ blockNameForHook }.${ panelNameForHook }.${ controlName }.before`,
		'',
		blockNameForHook
	);
	const controlAfterDomElement = applyFilters(
		`vexaltrix.${ blockNameForHook }.${ panelNameForHook }.${ controlName }`,
		'',
		blockNameForHook
	);

	return (
		<div ref={ panelRef } className="components-base-control">
			{ controlBeforeDomElement }
			<div className="uag-bg-select-control">
				{ advancedControls }
				<UAGHelpText text={ help } />
			</div>
			{ controlAfterDomElement }
		</div>
	);
};

export default Background;
