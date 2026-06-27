import { __ } from '@wordpress/i18n';
const attributes = {
	isPreview: {
		type: 'boolean',
		default: false,
	},
	block_id: {
		type: 'string',
	},
	id: {
		type: 'number',
		default: 0,
	},
	header: {
		type: 'html',
	},
	tabActive: {
		type: 'number',
	},
	tabHeaders: {
		type: 'array',
		default: [ __( 'Tab 1', 'vexaltrix' ), __( 'Tab 2', 'vexaltrix' ), __( 'Tab 3', 'vexaltrix' ) ],
	},
};
export default attributes;
