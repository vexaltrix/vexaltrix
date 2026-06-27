/**
 * BLOCK: Social Share - Settings.
 */

// Import classes
import UAGIconPicker from '@Components/icon-picker';
import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import UAGSelectControl from '@Components/select-control';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGTabsControl from '@Components/tabs';
import UAGMediaPicker from '@Components/image';
import { memo } from '@wordpress/element';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';

const Settings = ( props ) => {
	const { attributes, setAttributes } = props;

	const { type, image_icon, icon, image, icon_color, icon_hover_color, icon_bg_color, icon_bg_hover_color } =
		attributes;

	/*
	 * Event to set Image as while adding.
	 */
	const onSelectImage = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { image: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			setAttributes( { image: null } );
			return;
		}

		setAttributes( { image: media } );
	};

	/*
	 * Event to set Image as null while removing.
	 */
	const onRemoveImage = () => {
		setAttributes( { image: '' } );
	};

	const onChangeType = ( value ) => {
		const icon_mapping = {
			facebook: 'fab fa-facebook',
			twitter: 'fab fa-twitter-square',
			google: 'fab fa-google-plus-square',
			pinterest: 'fab fa-pinterest-square',
			linkedin: 'fab fa-linkedin',
			digg: 'fab fa-digg',
			blogger: 'fab fa-blogger',
			reddit: 'fab fa-reddit-square',
			stumbleupon: 'fab fa-stumbleupon-circle',
			tumblr: 'fab fa-tumblr-square',
			myspace: 'fas fa-user-friends',
			email: 'fas fa-envelope',
			pocket: 'fab fa-get-pocket',
			vk: 'fab fa-vk',
			odnoklassniki: 'fab fa-odnoklassniki',
			skype: 'fab fa-skype',
			telegram: 'fab fa-telegram',
			whatsapp: 'fab fa-whatsapp',
			xing: 'fab fa-xing',
			buffer: 'fab fa-buffer',
		};

		setAttributes( { type: value } );

		setAttributes( { icon: icon_mapping[ value ] } );
	};

	const generalSettings = () => {
		return (
			<UAGAdvancedPanelBody initialOpen={ true }>
				<UAGSelectControl
					label={ __( 'Type', 'vexaltrix' ) }
					data={ {
						value: type,
					} }
					onChange={ onChangeType }
					options={ [
						{
							value: 'facebook',
							label: __( 'Facebook', 'vexaltrix' ),
						},
						{
							value: 'twitter',
							label: __( 'Twitter / X', 'vexaltrix' ),
						},
						{
							value: 'google',
							label: __( 'Google Currents', 'vexaltrix' ),
						},
						{
							value: 'pinterest',
							label: __( 'Pinterest', 'vexaltrix' ),
						},
						{
							value: 'linkedin',
							label: __( 'LinkedIn', 'vexaltrix' ),
						},
						{
							value: 'digg',
							label: __( 'Digg', 'vexaltrix' ),
						},
						{
							value: 'blogger',
							label: __( 'Blogger', 'vexaltrix' ),
						},
						{
							value: 'reddit',
							label: __( 'Reddit', 'vexaltrix' ),
						},
						{
							value: 'stumbleupon',
							label: __( 'StumbleUpon', 'vexaltrix' ),
						},
						{
							value: 'tumblr',
							label: __( 'Tumblr', 'vexaltrix' ),
						},
						{
							value: 'myspace',
							label: __( 'Myspace', 'vexaltrix' ),
						},
						{
							value: 'email',
							label: __( 'Email', 'vexaltrix' ),
						},
						{
							value: 'pocket',
							label: __( 'Pocket', 'vexaltrix' ),
						},
						{
							value: 'vk',
							label: __( 'VK', 'vexaltrix' ),
						},
						{
							value: 'odnoklassniki',
							label: __( 'Odnoklassniki', 'vexaltrix' ),
						},
						{
							value: 'skype',
							label: __( 'Skype', 'vexaltrix' ),
						},
						{
							value: 'telegram',
							label: __( 'Telegram', 'vexaltrix' ),
						},
						{
							value: 'whatsapp',
							label: __( 'WhatsApp', 'vexaltrix' ),
						},
						{
							value: 'xing',
							label: __( 'Xing', 'vexaltrix' ),
						},
						{
							value: 'buffer',
							label: __( 'Buffer', 'vexaltrix' ),
						},
					] }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Image / Icon', 'vexaltrix' ) }
					data={ {
						value: image_icon,
						label: 'image_icon',
					} }
					className="vxt-multi-button-alignment-control"
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
					showIcons={ false }
				/>
				{ 'icon' === image_icon && (
					<>
						<UAGIconPicker
							label={ __( 'Icon', 'vexaltrix' ) }
							value={ icon }
							onChange={ ( value ) => setAttributes( { icon: value } ) }
						/>
					</>
				) }
				{ 'image' === image_icon && (
					<UAGMediaPicker
						onSelectImage={ onSelectImage }
						backgroundImage={ image }
						onRemoveImage={ onRemoveImage }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};
	const iconColorSettings = () => {
		let colorControl = '';
		let colorControlHover = '';

		if ( 'image' === image_icon ) {
			colorControl = (
				<>
					<AdvancedPopColorControl
						label={ __( 'Background Color', 'vexaltrix' ) }
						colorValue={ icon_bg_color ? icon_bg_color : '' }
						data={ {
							value: icon_bg_color,
							label: 'icon_bg_color',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			);
			colorControlHover = (
				<>
					<AdvancedPopColorControl
						label={ __( 'Background Color', 'vexaltrix' ) }
						colorValue={ icon_bg_hover_color ? icon_bg_hover_color : '' }
						data={ {
							value: icon_bg_hover_color,
							label: 'icon_bg_hover_color',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			);
		} else {
			colorControl = (
				<>
					<AdvancedPopColorControl
						label={ __( 'Color', 'vexaltrix' ) }
						colorValue={ icon_color ? icon_color : '' }
						data={ {
							value: icon_color,
							label: 'icon_color',
						} }
						setAttributes={ setAttributes }
					/>
					<AdvancedPopColorControl
						label={ __( 'Background Color', 'vexaltrix' ) }
						colorValue={ icon_bg_color ? icon_bg_color : '' }
						data={ {
							value: icon_bg_color,
							label: 'icon_bg_color',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			);
			colorControlHover = (
				<>
					<AdvancedPopColorControl
						label={ __( 'Color', 'vexaltrix' ) }
						colorValue={ icon_hover_color ? icon_hover_color : '' }
						data={ {
							value: icon_hover_color,
							label: 'icon_hover_color',
						} }
						setAttributes={ setAttributes }
					/>
					<AdvancedPopColorControl
						label={ __( 'Background Color', 'vexaltrix' ) }
						colorValue={ icon_bg_hover_color ? icon_bg_hover_color : '' }
						data={ {
							value: icon_bg_hover_color,
							label: 'icon_bg_hover_color',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			);
		}
		return (
			<UAGAdvancedPanelBody title={ __( 'Icon Color', 'vexaltrix' ) } initialOpen={ true }>
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
					normal={ colorControl }
					hover={ colorControlHover }
					disableBottomSeparator={ true }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	return (
		<InspectorControls>
			<InspectorTabs>
				<InspectorTab { ...UAGTabs.general }>{ generalSettings() }</InspectorTab>
				<InspectorTab { ...UAGTabs.style }>{ iconColorSettings() }</InspectorTab>
				<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);
};

export default memo( Settings );
