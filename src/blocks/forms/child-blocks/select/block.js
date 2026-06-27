/**
 * BLOCK: Forms - Select
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
import Version2_7_2 from './2_7_2';
let selectCommonData = {};
selectCommonData = applyFilters( 'vexaltrix/forms-select', addCommonDataToVexaltrixBlocks( selectCommonData ) );
registerBlockType( 'vexaltrix/forms-select', {
	...selectCommonData,
	title: __( 'Select', 'vexaltrix' ),
	description: __( 'Add a select dropdown to list choices.', 'vexaltrix' ),
	icon: VXT_Block_Icons.select,
	parent: [ 'vexaltrix/forms' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	supports: {
		html: false,
	},
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="form-field" isChildren={ true } /> : <Edit { ...props } />,
	save,
	deprecated: [ Version2_7_2, Version ],
} );
