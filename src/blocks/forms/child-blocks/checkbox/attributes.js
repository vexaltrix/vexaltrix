/**
 * BLOCK: Forms - Checkbox - Attribute
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
	checkboxName: {
		type: 'string',
		default: __( 'Checkbox Title', 'vexaltrix' ),
	},
	checkboxRequired: {
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
};
export default attributes;
