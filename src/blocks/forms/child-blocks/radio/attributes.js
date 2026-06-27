/**
 * BLOCK: Vexaltrix Form - Radio Attributes
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
	radioName: {
		type: 'string',
		default: __( 'RadioBox Title', 'vexaltrix' ),
	},
	radioRequired: {
		type: 'boolean',
		default: false,
	},
	options: {
		type: 'array',
		default: [
			{
				optiontitle: __( 'Option Name 1', 'vexaltrix' ),
				optionvalue: __( 'Option Value 1', 'vexaltrix' ),
			},
		],
	},
	layout: {
		type: 'string',
		default: 'round',
	},
};
export default attributes;
