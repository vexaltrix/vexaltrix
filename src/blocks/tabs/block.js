/**
 * BLOCK: Tabs Block
 */

import VXT_Block_Icons from '@Controls/block-icons';
import './style.scss';
import attributes from './attributes';
import Edit from './edit';
import deprecated from './deprecated';
import save from './save';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let tabsCommonData = {};
tabsCommonData = applyFilters( 'vexaltrix/tabs', addCommonDataToVexaltrixBlocks( tabsCommonData ) );
registerBlockType( 'vexaltrix/tabs', {
	...tabsCommonData,
	title: __( 'Tabs', 'vexaltrix' ),
	description: __( 'Display your content under different tabs.', 'vexaltrix' ),
	icon: VXT_Block_Icons.tabs,
	keywords: [ __( 'tabs', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="tabs" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
