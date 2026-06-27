/**
 * BLOCK: Vexaltrix Form - Email Attributes
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
		default: __( 'Email', 'vexaltrix' ),
	},
	required: {
		type: 'boolean',
		default: false,
	},
	placeholder: {
		type: 'string',
		default: __( 'example@mail.com', 'vexaltrix' ),
	},
	autocomplete: {
		type: 'string',
		default: 'email',
	},
};
export default attributes;
