/**
 * BLOCK: Icon List
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import './style.scss';

import { __ } from '@wordpress/i18n';
import transforms from './transforms';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let iconListCommonData = {};
iconListCommonData = applyFilters( 'vexaltrix/icon-list', addCommonDataToVexaltrixBlocks( iconListCommonData ) );
registerBlockType( 'vexaltrix/icon-list', {
	...iconListCommonData,
	title: __( 'Icon List', 'vexaltrix' ),
	description: __( 'Create a list highlighted with icons/images.', 'vexaltrix' ),
	icon: VXT_Block_Icons.icon_list,
	keywords: [ __( 'icon list', 'vexaltrix' ), __( 'image list', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="icon-list" /> : <Edit { ...props } /> ),
	save,
	deprecated,
	transforms,
} );
