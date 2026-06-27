/**
 * BLOCK: Slider
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
let sliderCommonData = {};
sliderCommonData = applyFilters( 'vexaltrix/slider', addCommonDataToVexaltrixBlocks( sliderCommonData ) );
registerBlockType( 'vexaltrix/slider', {
	...sliderCommonData,
	apiVersion: 2,
	title: __( 'Slider', 'vexaltrix' ),
	description: __( 'Create beautiful sliders with slider block.', 'vexaltrix' ),
	icon: VXT_Block_Icons.slider,
	keywords: [ __( 'slider', 'vexaltrix' ), __( 'uag', 'vexaltrix' ), __( 'flex', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="slider" /> : <Edit { ...props } /> ),
	save,
} );
