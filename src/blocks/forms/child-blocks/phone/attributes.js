/**
 * BLOCK: Vexaltrix Form - Phone Attributes
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
	phoneName: {
		type: 'string',
		default: __( 'Phone', 'vexaltrix' ),
	},
	phoneRequired: {
		type: 'boolean',
		default: false,
	},
	pattern: {
		type: 'string',
		default: __( '[0–9]{3}s?[0–9]{3}s?[0–9]{4}', 'vexaltrix' ),
	},
	selectPhoneCode: {
		type: 'string',
		default: '+44',
	},
	autocomplete: {
		type: 'string',
		default: 'tel-national',
	},
};
export default attributes;
