/**
 * BLOCK: Forms - Hidden
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import { __ } from '@wordpress/i18n';
import deprecated from './deprecated';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let hiddenCommonData = {};
hiddenCommonData = applyFilters( 'vexaltrix/forms-hidden', addCommonDataToVexaltrixBlocks( hiddenCommonData ) );
registerBlockType( 'vexaltrix/forms-hidden', {
	...hiddenCommonData,
	title: __( 'Hidden', 'vexaltrix' ),
	description: __( 'Add a hidden field in your form to pass data.', 'vexaltrix' ),
	icon: VXT_Block_Icons.hidden,
	parent: [ 'vexaltrix/forms' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="form-hidden" isChildren={ true } /> : <Edit { ...props } />,
	supports: {
		anchor: true,
		html: false,
	},
	save,
	deprecated,
} );
