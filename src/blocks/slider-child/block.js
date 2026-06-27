/**
 * BLOCK: Slider Child
 */

import VXT_Block_Icons from '@Controls/block-icons';
import save from './save';
import attributes from './attributes';
import Edit from './edit';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import deprecated from './deprecated';

import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let sliderChildCommonData = {};
sliderChildCommonData = applyFilters(
	'vexaltrix/slider-child',
	addCommonDataToVexaltrixBlocks( sliderChildCommonData )
);
registerBlockType( 'vexaltrix/slider-child', {
	...sliderChildCommonData,
	title: __( 'Slider Child', 'vexaltrix' ),
	description: __( 'Add and customize content of this slide.', 'vexaltrix' ),
	icon: VXT_Block_Icons.slider_child,
	parent: [ 'vexaltrix/slider' ],
	keywords: [ __( 'slider', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	supports: {
		html: false,
	},
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="slider-child" isChildren={ true } /> : <Edit { ...props } />,
	save,
	deprecated,
} );
