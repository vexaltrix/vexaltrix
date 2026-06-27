/**
 * BLOCK: Star Rating
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
let starRatingCommonData = {};
starRatingCommonData = applyFilters( 'vexaltrix/star-rating', addCommonDataToVexaltrixBlocks( starRatingCommonData ) );
registerBlockType( 'vexaltrix/star-rating', {
	...starRatingCommonData,
	title: __( 'Star Ratings', 'vexaltrix' ),
	description: __( 'Display customizable star ratings on your page.', 'vexaltrix' ),
	icon: VXT_Block_Icons.star_rating,
	keywords: [ __( 'rating', 'vexaltrix' ), __( 'star rating', 'vexaltrix' ), __( 'review', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="star-rating" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
