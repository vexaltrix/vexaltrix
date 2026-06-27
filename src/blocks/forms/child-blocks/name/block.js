/**
 * BLOCK: Forms - Name
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

let nameCommonData = {};
nameCommonData = applyFilters( 'vexaltrix/forms-name', addCommonDataToVexaltrixBlocks( nameCommonData ) );
registerBlockType( 'vexaltrix/forms-name', {
	...nameCommonData,
	title: __( 'Name', 'vexaltrix' ),
	description: __( 'Add a name field in your form.', 'vexaltrix' ),
	icon: VXT_Block_Icons.name,
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
	deprecated: [ Version2_7_2, Version ],
} );
