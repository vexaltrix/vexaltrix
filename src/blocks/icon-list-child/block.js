/**
 * BLOCK: Icon List - Child
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import './style.scss';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let iconListChildCommonData = {};
iconListChildCommonData = applyFilters(
	'vexaltrix/icon-list-child',
	addCommonDataToVexaltrixBlocks( iconListChildCommonData )
);
registerBlockType( 'vexaltrix/icon-list-child', {
	...iconListChildCommonData,
	title: __( 'List Item', 'vexaltrix' ),
	description: __( 'Add and customize content for this list component.', 'vexaltrix' ),
	icon: VXT_Block_Icons.icon_list_child,
	parent: [ 'vexaltrix/icon-list' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	supports: {
		html: false,
	},
	edit: ( props ) =>
		props.attributes.isPreview ? (
			<PreviewImage image="icon-list-child" isChildren={ true } />
		) : (
			<Edit { ...props } />
		),
	save,
	deprecated,
} );
