/**
 * BLOCK: Forms - Date
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
let dateCommonData = {};
dateCommonData = applyFilters( 'vexaltrix/forms-date', addCommonDataToVexaltrixBlocks( dateCommonData ) );
import Version2_4_1 from './2_4_1';
import Version2_7_2 from './2_7_2';

registerBlockType( 'vexaltrix/forms-date', {
	...dateCommonData,
	title: __( 'Datepicker', 'vexaltrix' ),
	description: __( 'Add a calendar based date picker in your form.', 'vexaltrix' ),
	icon: VXT_Block_Icons.datepicker,
	parent: [ 'vexaltrix/forms' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="form-field" isChildren={ true } /> : <Edit { ...props } />,
	supports: {
		anchor: true,
		html: false,
	},
	save,
	deprecated: [ Version2_7_2, Version2_4_1 ],
} );
