/**
 * BLOCK: Buttons - Child
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import deprecated from './deprecated';
import Edit from './edit';
import save from './save';
import './style.scss';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let buttonsChildCommonData = {};
buttonsChildCommonData = applyFilters(
	'vexaltrix/buttons-child',
	addCommonDataToVexaltrixBlocks( buttonsChildCommonData )
);
registerBlockType( 'vexaltrix/buttons-child', {
	...buttonsChildCommonData,
	title: __( 'Button', 'vexaltrix' ),
	description: __( 'This block allows you to style button.', 'vexaltrix' ),
	icon: VXT_Block_Icons.buttons_child,
	parent: [ 'vexaltrix/buttons' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="buttons-child" isChildren={ true } /> : <Edit { ...props } />,
	save,
	deprecated,
	usesContext: [ 'queryId', 'query', 'queryContext', 'attrs', 'postId', 'postType' ],
	supports: {
		anchor: true,
		html: false,
	},
} );
