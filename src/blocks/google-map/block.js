/**
 * BLOCK: Google Map
 */

import VXT_Block_Icons from '@Controls/block-icons';
import './style.scss';
import Edit from './edit';
import deprecated from './deprecated';
import attributes from './attributes';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';

wp.vxt_ultimate_gutenberg_blocks_google_api_key = 'AIzaSyAsd_d46higiozY-zNqtr7zdA81Soswje4';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let googleMapCommonData = {};
googleMapCommonData = applyFilters( 'vexaltrix/google-map', addCommonDataToVexaltrixBlocks( googleMapCommonData ) );
registerBlockType( 'vexaltrix/google-map', {
	...googleMapCommonData,
	title: __( 'Google Maps', 'vexaltrix' ),
	description: __( 'Show a Google Map location on your website.', 'vexaltrix' ),
	icon: VXT_Block_Icons.google_map,
	keywords: [ __( 'google', 'vexaltrix' ), __( 'maps', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="google-maps" /> : <Edit { ...props } /> ),
	// Render via PHP
	save: () => null,
	deprecated,
} );
