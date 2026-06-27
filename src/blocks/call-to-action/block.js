/**
 * BLOCK: Call To Action.
 */

// Import block dependencies and components.
import VXT_Block_Icons from '@Controls/block-icons';

// Import icon.
import Edit from './edit';
import save from './save';
import attributes from './attributes';
import deprecated from './deprecated';
import './style.scss';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let CallToActionCommonData = {};
CallToActionCommonData = applyFilters(
	'vexaltrix/call-to-action',
	addCommonDataToVexaltrixBlocks( CallToActionCommonData )
);
registerBlockType( 'vexaltrix/call-to-action', {
	...CallToActionCommonData,
	title: __( 'Call To Action', 'vexaltrix' ),
	description: __( 'Add a button along with heading and description.', 'vexaltrix' ),
	icon: VXT_Block_Icons.call_to_action,
	keywords: [ __( 'cta', 'vexaltrix' ), __( 'call to action', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="call-to-action" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
