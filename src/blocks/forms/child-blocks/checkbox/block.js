/**
 * BLOCK: Forms - Checkbox
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let checkboxCommonData = {};
checkboxCommonData = applyFilters( 'vexaltrix/forms-checkbox', addCommonDataToVexaltrixBlocks( checkboxCommonData ) );
import Version from './deprecated/';
import Version2_7_2 from './2_7_2';

registerBlockType( 'vexaltrix/forms-checkbox', {
	...checkboxCommonData,
	title: __( 'Checkbox', 'vexaltrix' ),
	description: __( 'Add checkboxes to allow multiple choices from options.', 'vexaltrix' ),
	icon: VXT_Block_Icons.checkbox,
	parent: [ 'vexaltrix/forms' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="form-checkbox" isChildren={ true } /> : <Edit { ...props } />,
	supports: {
		anchor: true,
		html: false,
	},
	save,
	deprecated: [ Version2_7_2, Version ],
} );
