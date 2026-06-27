import { __ } from '@wordpress/i18n';
import renderSVG from '@Controls/renderIcon';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import MultiButtonsControl from '@Components/multi-buttons-control';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import ResponsiveSlider from '@Components/responsive-slider';
import Range from '@Components/range/Range.js';
import UAGMediaPicker from '@Components/image';
import UAGTabsControl from '@Components/tabs';
import { InspectorControls, BlockControls, MediaReplaceFlow } from '@wordpress/block-editor';

import { ToggleControl, ToolbarGroup, Icon } from '@wordpress/components';

import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UAGTextControl from '@Components/text-control';
import { memo, createInterpolateElement } from '@wordpress/element';
import { VXT_LINKS } from '@Store/constants';

const Settings = ( props ) => {
	const { loopLottie, reverseDirection } = props;

	const {
		setAttributes,
		attributes: {
			lottieSource,
			align,
			height,
			heightTablet,
			heightMob,
			width,
			widthTablet,
			widthMob,
			backgroundColor,
			loop,
			speed,
			reverse,
			jsonLottie,
			lottieURl,
			playOn,
			backgroundHColor,
		},
	} = props;

	/*
	 * Event to set Lottie as while adding.
	 */
	const onSelectLottie = ( media ) => {
		if ( ! media || ! media?.url ) {
			setAttributes( { jsonLottie: null } );
			return;
		}
		setAttributes( { jsonLottie: media, lottieURl: media?.url, lottieSource: 'library' } );
	};

	const controlsSettings = (
		<>
			<UAGAdvancedPanelBody title={ __( 'General', 'vexaltrix' ) } initialOpen={ true }>
				<p className="vxt-lotie-editor-notice">
					{ createInterpolateElement(
						__(
							'<span>Note: You can see sample Lottie animations <a>here on this</a> website.</span>',
							'vexaltrix'
						),
						{
							span: <span />,

							a: <a href={ VXT_LINKS.LOTTIE_FILES } target="_blank" rel="noopener noreferrer" />,
						}
					) }
				</p>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'File Source', 'vexaltrix' ) }
					data={ {
						value: lottieSource,
						label: 'lottieSource',
					} }
					options={ [
						{
							value: 'library',
							label: __( 'Library', 'vexaltrix' ),
						},
						{
							value: 'url',
							label: __( 'URL', 'vexaltrix' ),
						},
					] }
				/>
				{ lottieSource === 'upload' && (
					<UAGMediaPicker
						backgroundImage={ jsonLottie }
						onSelectImage={ onSelectLottie }
						slug={ 'lottie' }
						label={ __( 'Lottie Animation', 'vexaltrix' ) }
						allow={ [ 'application/json' ] }
						disableRemove={ true }
					/>
				) }
				{ lottieSource === 'library' && (
					<UAGMediaPicker
						backgroundImage={ jsonLottie }
						onSelectImage={ onSelectLottie }
						slug={ 'lottie' }
						label={ __( 'Lottie Animation', 'vexaltrix' ) }
						allow={ [ 'application/json' ] }
						disableRemove={ true }
					/>
				) }
				{ lottieSource === 'url' && (
					<UAGTextControl
						label={ __( 'Lottie Animation URL', 'vexaltrix' ) }
						value={ lottieURl }
						data={ {
							value: lottieURl,
							label: 'lottieURl',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { lottieURl: value } ) }
					/>
				) }
				<p className="vxt-settings-notice">
					{ __(
						'Add ALLOW_UNFILTERED_UPLOADS to upload Lottie JSON files. Disable it after upload for better security.',
						'vexaltrix'
					) }
				</p>
			</UAGAdvancedPanelBody>
			<UAGAdvancedPanelBody title={ __( 'Content', 'vexaltrix' ) } initialOpen={ false }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Play On', 'vexaltrix' ) }
					data={ {
						value: playOn,
						label: 'playOn',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: 'none',
							label: __( 'Default', 'vexaltrix' ),
						},
						{
							value: 'hover',
							label: __( 'Hover', 'vexaltrix' ),
						},
						{
							value: 'click',
							label: __( 'Click', 'vexaltrix' ),
						},
						{
							value: 'scroll',
							label: __( 'Viewport', 'vexaltrix' ),
						},
					] }
					help={
						'scroll' === playOn || 'none' === playOn
							? __(
									"This setting will only take effect once you are on the live page, and not while you're editing.",
									'vexaltrix'
							  )
							: ''
					}
				/>
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
				<ToggleControl
					label={ __( 'Loop', 'vexaltrix' ) }
					checked={ loop }
					onChange={ loopLottie }
					help={ __(
						"Enabling this will show the animation in the loop. This setting will only take effect once you are on the live page, and not while you're editing.",
						'vexaltrix'
					) }
				/>
				<Range
					label={ __( 'Speed', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ speed }
					data={ {
						value: speed,
						label: 'speed',
					} }
					min={ 1 }
					max={ 50 }
					displayUnit={ false }
					help={ __( 'This setting will only take effect once you refresh the editor page.', 'vexaltrix' ) }
				/>
				{ loop && (
					<ToggleControl
						label={ __( 'Reverse', 'vexaltrix' ) }
						checked={ reverse }
						onChange={ reverseDirection }
						help={ __( 'Direction of animation.', 'vexaltrix' ) }
					/>
				) }
			</UAGAdvancedPanelBody>
		</>
	);

	const styleSettings = (
		<UAGAdvancedPanelBody title={ __( 'Background', 'vexaltrix' ) } initialOpen={ true }>
			<ResponsiveSlider
				label={ __( 'Width', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: width,
						label: 'width',
					},
					tablet: {
						value: widthTablet,
						label: 'widthTablet',
					},
					mobile: {
						value: widthMob,
						label: 'widthMob',
					},
				} }
				min={ 0 }
				max={ 1000 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
			<ResponsiveSlider
				label={ __( 'Height', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: height,
						label: 'height',
					},
					tablet: {
						value: heightTablet,
						label: 'heightTablet',
					},
					mobile: {
						value: heightMob,
						label: 'heightMob',
					},
				} }
				min={ 0 }
				max={ 1000 }
				displayUnit={ false }
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
					<AdvancedPopColorControl
						label={ __( 'Background Color', 'vexaltrix' ) }
						colorValue={ backgroundColor ? backgroundColor : '' }
						data={ {
							value: backgroundColor,
							label: 'backgroundColor',
						} }
						setAttributes={ setAttributes }
					/>
				}
				hover={
					<AdvancedPopColorControl
						label={ __( 'Background Color', 'vexaltrix' ) }
						colorValue={ backgroundHColor ? backgroundHColor : '' }
						data={ {
							value: backgroundHColor,
							label: 'backgroundHColor',
						} }
						setAttributes={ setAttributes }
					/>
				}
				disableBottomSeparator={ true }
			/>
		</UAGAdvancedPanelBody>
	);

	if ( ! vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_mime_type ) {
		return (
			<div className="vxt-show-notice">
				<span>
					{ __(
						'Lottie block requires the file type JSON to be uploaded to media files. Seems like your website has disabled this file type. Please refer',
						'vexaltrix'
					) }
					<a href={ vxt_ultimate_gutenberg_blocks_blocks_info.docsUrl } target="__blank">
						{ ' ' }
						{ __( 'this document', 'vexaltrix' ) }{ ' ' }
					</a>
					{ __( 'to know more about it.', 'vexaltrix' ) }
				</span>
			</div>
		);
	}

	const onSelectLottieURL = ( mediaURL ) => {
		setAttributes( { lottieURl: mediaURL, lottieSource: 'url' } );
	};

	const getBlockControls = () => {
		return (
			<BlockControls>
				<ToolbarGroup>
					<MediaReplaceFlow
						mediaURL={ lottieURl }
						allowedTypes={ [ 'application/json' ] }
						accept={ [ 'application/json' ] }
						onSelectURL={ ( value ) => onSelectLottieURL( value ) }
						onSelect={ onSelectLottie }
					/>
				</ToolbarGroup>
			</BlockControls>
		);
	};

	return (
		<>
			{ getBlockControls() }
			<InspectorControls>
				<InspectorTabs tabs={ [ 'general', 'style', 'advance' ] }>
					<InspectorTab { ...UAGTabs.general }>{ controlsSettings }</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>{ styleSettings }</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};

export default memo( Settings );
