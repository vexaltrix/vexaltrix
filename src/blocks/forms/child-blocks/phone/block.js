/**
 * BLOCK: Forms - Phone
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
import Version_2_13_2 from './2_13_2/index';

let phoneCommonData = {};
phoneCommonData = applyFilters( 'vexaltrix/forms-phone', addCommonDataToVexaltrixBlocks( phoneCommonData ) );
registerBlockType( 'vexaltrix/forms-phone', {
	...phoneCommonData,
	title: __( 'Phone', 'vexaltrix' ),
	description: __( 'Add a phone number field in your form.', 'vexaltrix' ),
	icon: VXT_Block_Icons.phone,
	parent: [ 'vexaltrix/forms' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="form-phone" isChildren={ true } /> : <Edit { ...props } />,
	supports: {
		anchor: true,
		html: false,
	},
	save,
	deprecated: [ Version2_7_2, Version, Version_2_13_2 ],
} );
