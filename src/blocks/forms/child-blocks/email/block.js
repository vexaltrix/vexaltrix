/**
 * BLOCK: Forms - Email
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
let emailCommonData = {};
emailCommonData = applyFilters( 'vexaltrix/forms-email', addCommonDataToVexaltrixBlocks( emailCommonData ) );
import Version from './deprecated/';
import Version2_7_2 from './2_7_2';

registerBlockType( 'vexaltrix/forms-email', {
	...emailCommonData,
	title: __( 'Email', 'vexaltrix' ),
	description: __( 'Add an email address field in your form.', 'vexaltrix' ),
	icon: VXT_Block_Icons.email,
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
