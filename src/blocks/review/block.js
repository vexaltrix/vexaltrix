/**
 * BLOCK: Rating Block.
 */
import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import './style.scss';
import { __ } from '@wordpress/i18n';
import deprecated from './deprecated';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let reviewCommonData = {};
reviewCommonData = applyFilters( 'vexaltrix/review', addCommonDataToVexaltrixBlocks( reviewCommonData ) );
registerBlockType( 'vexaltrix/review', {
	...reviewCommonData,
	title: __( 'Review', 'vexaltrix' ),
	description: __( 'Add reviews to items with Schema support.', 'vexaltrix' ),
	icon: VXT_Block_Icons.review,
	keywords: [
		__( 'ratings', 'vexaltrix' ),
		__( 'review', 'vexaltrix' ),
		__( 'schema', 'vexaltrix' ),
		__( 'uag', 'vexaltrix' ),
	],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="review" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
