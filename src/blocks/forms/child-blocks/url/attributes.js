/**
 * BLOCK: Vexaltrix Form - URL Attributes
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
	name: {
		type: 'string',
		default: __( 'URL', 'vexaltrix' ),
	},
	required: {
		type: 'boolean',
		default: false,
	},
	placeholder: {
		type: 'string',
		default: __( 'https://example.com', 'vexaltrix' ),
	},
	autocomplete: {
		type: 'string',
		default: 'url',
	},
};
export default attributes;
