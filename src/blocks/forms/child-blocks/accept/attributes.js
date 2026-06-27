/**
 * BLOCK: Vexaltrix Form - Accept Attributes
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
	acceptRequired: {
		type: 'boolean',
		default: false,
	},
	acceptText: {
		type: 'string',
		default: __( 'I have read and agree to the Privacy Policy.', 'vexaltrix' ),
	},
	showLink: {
		type: 'boolean',
		default: false,
	},
	linkLabel: {
		type: 'string',
		default: __( 'Privacy Policy', 'vexaltrix' ),
	},
	link: {
		type: 'string',
		default: '#',
	},
	linkInNewTab: {
		type: 'boolean',
		default: true,
	},
};
export default attributes;
