/**
 * BLOCK: Social Share
 */

import VXT_Block_Icons from '@Controls/block-icons';
import './style.scss';
import transform from './transform';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let socialShareCommonData = {};
socialShareCommonData = applyFilters(
	'vexaltrix/social-share',
	addCommonDataToVexaltrixBlocks( socialShareCommonData )
);
registerBlockType( 'vexaltrix/social-share', {
	...socialShareCommonData,
	title: __( 'Social Share', 'vexaltrix' ),
	description: __( 'Share your content on different social media platforms.', 'vexaltrix' ),
	icon: VXT_Block_Icons.social_share,
	keywords: [ __( 'social share', 'vexaltrix' ), __( 'icon', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="social-share" /> : <Edit { ...props } /> ),
	save,
	transform,
	deprecated,
} );
