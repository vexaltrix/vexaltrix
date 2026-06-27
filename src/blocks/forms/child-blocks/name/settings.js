import { __ } from '@wordpress/i18n';
import { memo } from '@wordpress/element';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import UAGSelectControl from '@Components/select-control';
import { ToggleControl } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';

import UAGTextControl from '@Components/text-control';

const Settings = ( props ) => {
	const { attributes, setAttributes } = props;

	const { nameRequired, placeholder, autocomplete } = attributes;

	const nameInspectorControls = () => {
		return (
			<UAGAdvancedPanelBody initialOpen={ true }>
				<UAGSelectControl
					label={ __( 'Autocomplete', 'vexaltrix' ) }
					data={ {
						value: autocomplete,
						label: 'autocomplete',
					} }
					setAttributes={ setAttributes }
					help={ __(
						'Duplicated name fields must be assigned distinct label names to send the data.',
						'vexaltrix'
					) }
				>
					<option value="off">{ __( 'Off', 'vexaltrix' ) }</option>
					<option value="name">{ __( 'Full Name', 'vexaltrix' ) }</option>
					<optgroup label="Name Breakdown">
						<option value="honorific-prefix">{ __( 'Prefix', 'vexaltrix' ) }</option>
						<option value="given-name">{ __( 'First Name', 'vexaltrix' ) }</option>
						<option value="additional-name">{ __( 'Middle Name', 'vexaltrix' ) }</option>
						<option value="family-name">{ __( 'Last Name', 'vexaltrix' ) }</option>
						<option value="honorific-suffix">{ __( 'Suffix', 'vexaltrix' ) }</option>
					</optgroup>
					<option value="username">{ __( 'Username', 'vexaltrix' ) }</option>
					<option value="nickname">{ __( 'Nickname', 'vexaltrix' ) }</option>
					<option value="organization">{ __( 'Company Name', 'vexaltrix' ) }</option>
					<option value="organization-title">{ __( 'Job Title', 'vexaltrix' ) }</option>
					<optgroup label="Address Lines">
						<option value="address-line1">{ __( 'Address Line 1', 'vexaltrix' ) }</option>
						<option value="address-line2">{ __( 'Address Line 2', 'vexaltrix' ) }</option>
						<option value="address-line3">{ __( 'Address Line 3', 'vexaltrix' ) }</option>
					</optgroup>
					<option value="country-name">{ __( 'Country', 'vexaltrix' ) }</option>
					<option value="postal-code">{ __( 'Postal / ZIP Code', 'vexaltrix' ) }</option>
				</UAGSelectControl>
				<UAGTextControl
					label="Placeholder"
					value={ placeholder }
					data={ {
						value: placeholder,
						label: 'placeholder',
					} }
					setAttributes={ setAttributes }
					onChange={ ( value ) => setAttributes( { placeholder: value } ) }
					placeholder={ __( 'Placeholder', 'vexaltrix' ) }
				/>
				<ToggleControl
					label={ __( 'Required', 'vexaltrix' ) }
					checked={ nameRequired }
					onChange={ () => setAttributes( { nameRequired: ! nameRequired } ) }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	return (
		<InspectorControls>
			<InspectorTabs tabs={ [ 'general', 'advance' ] }>
				<InspectorTab { ...UAGTabs.general }>{ nameInspectorControls() }</InspectorTab>
				<InspectorTab { ...UAGTabs.advance }></InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);
};
export default memo( Settings );
