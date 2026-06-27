/**
 * BLOCK: Forms - Accept
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
let acceptCommonData = {};
acceptCommonData = applyFilters( 'vexaltrix/forms-accept', addCommonDataToVexaltrixBlocks( acceptCommonData ) );
import Version2_7_2 from './2_7_2';

registerBlockType( 'vexaltrix/forms-accept', {
	...acceptCommonData,
	title: __( 'Accept', 'vexaltrix' ),
	description: __( 'Add a consent statement with a checkbox in your form.', 'vexaltrix' ),
	icon: VXT_Block_Icons.accept,
	parent: [ 'vexaltrix/forms' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="form-accept" isChildren={ true } /> : <Edit { ...props } />,
	supports: {
		anchor: true,
		html: false,
	},
	save,
	deprecated: [ Version2_7_2 ],
} );
