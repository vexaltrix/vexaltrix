/**
 * BLOCK: Lottie
 */

import Edit from './edit';
import VXT_Block_Icons from '@Controls/block-icons';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import attributes from './attributes';

import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let lottieCommonData = {};
lottieCommonData = applyFilters( 'vexaltrix/lottie', addCommonDataToVexaltrixBlocks( lottieCommonData ) );
registerBlockType( 'vexaltrix/lottie', {
	...lottieCommonData,
	title: __( 'Lottie Animation', 'vexaltrix' ),
	description: __( 'Add customizable lottie animation on your page.', 'vexaltrix' ),
	icon: VXT_Block_Icons.lottie,
	keywords: [ __( 'lottie', 'vexaltrix' ), __( 'animation', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	attributes,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="lottie" /> : <Edit { ...props } /> ),
	// Render via PHP
	save: () => null,
} );
