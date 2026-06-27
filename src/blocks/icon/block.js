/**
 * BLOCK: Icon
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import './style.scss';
import deprecated from './deprecated';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let iconCommonData = {};
iconCommonData = applyFilters( 'vexaltrix/icon', addCommonDataToVexaltrixBlocks( iconCommonData ) );
registerBlockType( 'vexaltrix/icon', {
	...iconCommonData,
	apiVersion: 2,
	title: __( 'Icon', 'vexaltrix' ),
	description: __( 'Add stunning customizable icons to your website.', 'vexaltrix' ),
	icon: VXT_Block_Icons.icon,
	keywords: [
		// More keywords can be added.
		__( 'icon', 'vexaltrix' ),
		__( 'uag', 'vexaltrix' ),
	],
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="icon" /> : <Edit { ...props } /> ),
	save: () => null,
	deprecated,
} );
