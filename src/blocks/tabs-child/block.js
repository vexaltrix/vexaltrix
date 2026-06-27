/**
 * BLOCK: Tabs Child Block
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
let tabsChildCommonData = {};
tabsChildCommonData = applyFilters( 'vexaltrix/tabs-child', addCommonDataToVexaltrixBlocks( tabsChildCommonData ) );
registerBlockType( 'vexaltrix/tabs-child', {
	...tabsChildCommonData,
	title: __( 'Tabs child', 'vexaltrix' ),
	description: __( 'Display your content in a tab.', 'vexaltrix' ),
	parent: [ 'vexaltrix/tabs' ],
	icon: VXT_Block_Icons.tabs_child,
	keywords: [ __( 'tabs', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="tabs-child" isChildren={ true } /> : <Edit { ...props } />,
	save,
	deprecated,
} );
