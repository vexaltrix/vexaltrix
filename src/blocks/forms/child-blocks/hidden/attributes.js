/**
 * BLOCK: Vexaltrix Form - Hidden Attributes
 */
import { __ } from '@wordpress/i18n';

const attributes = {
	isPreview: {
		type: 'boolean',
		default: false,
	},
	block_id: {
		type: 'string',
	},
	hidden_field_name: {
		type: 'string',
		default: __( 'Hidden Field Name', 'vexaltrix' ),
	},
	hidden_field_value: {
		type: 'string',
	},
};
export default attributes;
