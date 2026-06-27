/**
 * BLOCK: Countdown
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import deprecated from './deprecated';
import Edit from './edit';
import save from './save';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';

import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let countdownCommonData = {};
countdownCommonData = applyFilters( 'vexaltrix/countdown', addCommonDataToVexaltrixBlocks( countdownCommonData ) );
registerBlockType( 'vexaltrix/countdown', {
	...countdownCommonData,
	apiVersion: 2,
	title: __( 'Countdown', 'vexaltrix' ),
	description: __( 'Create a sense of urgency among your visitors.', 'vexaltrix' ),
	icon: VXT_Block_Icons.countdown,
	keywords: [
		__( 'countdown', 'vexaltrix' ),
		__( 'timer', 'vexaltrix' ),
		__( 'sale', 'vexaltrix' ),
		__( 'offer', 'vexaltrix' ),
		__( 'discount', 'vexaltrix' ),
	],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="countdown" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
