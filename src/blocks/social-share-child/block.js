/**
 * BLOCK: Social Share Child
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import './style.scss';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let socialShareChildCommonData = {};
socialShareChildCommonData = applyFilters(
	'vexaltrix/social-share-child',
	addCommonDataToVexaltrixBlocks( socialShareChildCommonData )
);
registerBlockType( 'vexaltrix/social-share-child', {
	...socialShareChildCommonData,
	title: __( 'Social Share Child', 'vexaltrix' ),
	description: __( 'Share your content on this social media platform .', 'vexaltrix' ),
	icon: VXT_Block_Icons.social_share_child,
	parent: [ 'vexaltrix/social-share' ],
	keywords: [ __( 'social share', 'vexaltrix' ), __( 'icon', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	supports: {
		html: false,
	},
	edit: ( props ) =>
		props.attributes.isPreview ? (
			<PreviewImage image="social-share-child" isChildren={ true } />
		) : (
			<Edit { ...props } />
		),
	save,
	deprecated,
} );
