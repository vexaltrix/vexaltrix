/**
 * BLOCK: Counter
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';

import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let counterCommonData = {};
counterCommonData = applyFilters( 'vexaltrix/counter', addCommonDataToVexaltrixBlocks( counterCommonData ) );
registerBlockType( 'vexaltrix/counter', {
	...counterCommonData,
	title: __( 'Counter', 'vexaltrix' ),
	description: __( 'This block allows you to add number counter.', 'vexaltrix' ),
	icon: VXT_Block_Icons.counter,
	keywords: [ __( 'counter', 'vexaltrix' ), __( 'number', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="counter" /> : <Edit { ...props } /> ),
	save,
} );
