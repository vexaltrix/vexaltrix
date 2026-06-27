/**
 * BLOCK: Testimonial
 */

import VXT_Block_Icons from '@Controls/block-icons';
import Edit from './edit';
import save from './save';
import attributes from './attributes';
import deprecated from './deprecated';
import './style.scss';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let testimonialCommonData = {};
testimonialCommonData = applyFilters(
	'vexaltrix/testimonial',
	addCommonDataToVexaltrixBlocks( testimonialCommonData )
);
registerBlockType( 'vexaltrix/testimonial', {
	...testimonialCommonData,
	title: __( 'Testimonials', 'vexaltrix' ), // Block title.
	description: __( 'Display customer testimonials in customizable layouts.', 'vexaltrix' ), // Block description.
	icon: VXT_Block_Icons.testimonial, // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	keywords: [ __( 'testimonial', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="testimonial" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
