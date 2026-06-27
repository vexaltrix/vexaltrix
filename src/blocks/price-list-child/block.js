/**
 * BLOCK: Price List
 */

import VXT_Block_Icons from '@Controls/block-icons';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import attributes from './attributes';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let priceListChildCommonData = {};
priceListChildCommonData = applyFilters(
	'vexaltrix/restaurant-menu-child',
	addCommonDataToVexaltrixBlocks( priceListChildCommonData )
);
registerBlockType( 'vexaltrix/restaurant-menu-child', {
	...priceListChildCommonData,
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Price List-Child', 'vexaltrix' ), // Block title.
	description: __( 'Add information for this product.', 'vexaltrix' ), // Block description.
	icon: VXT_Block_Icons.restaurant_menu_child, // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	keywords: [ __( 'pricelist', 'vexaltrix' ), __( 'menu', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	parent: [ 'vexaltrix/restaurant-menu' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? (
			<PreviewImage image="price-list-child" isChildren={ true } />
		) : (
			<Edit { ...props } />
		),
	save,
	deprecated,
} );
