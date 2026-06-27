/**
 * BLOCK: Forms - Toggle
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
import Version from './deprecated/';
import Version2_4_1 from './2_4_1';
import Version2_7_2 from './2_7_2';
let toggleCommonData = {};
toggleCommonData = applyFilters( 'vexaltrix/forms-toggle', addCommonDataToVexaltrixBlocks( toggleCommonData ) );
registerBlockType( 'vexaltrix/forms-toggle', {
	...toggleCommonData,
	title: __( 'Toggle', 'vexaltrix' ),
	description: __( 'Add a toggle button in your form.', 'vexaltrix' ),
	icon: VXT_Block_Icons.toggle,
	parent: [ 'vexaltrix/forms' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="form-toggle" isChildren={ true } /> : <Edit { ...props } />,
	supports: {
		anchor: true,
		html: false,
	},
	save,
	deprecated: [ Version2_7_2, Version2_4_1, Version ],
} );
