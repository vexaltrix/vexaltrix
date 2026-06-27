/**
 * BLOCK: Marketing Button
 */
import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import './style.scss';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let marketingButtonCommonData = {};
marketingButtonCommonData = applyFilters(
	'vexaltrix/marketing-button',
	addCommonDataToVexaltrixBlocks( marketingButtonCommonData )
);
registerBlockType( 'vexaltrix/marketing-button', {
	...marketingButtonCommonData,
	title: __( 'Marketing Button', 'vexaltrix' ),
	description: __( 'Add a marketing call to action button with a short description.', 'vexaltrix' ),
	icon: VXT_Block_Icons.marketing_button,

	keywords: [ __( 'marketing button', 'vexaltrix' ), __( 'cta', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="marketing-button" /> : <Edit { ...props } />,
	save,
	deprecated,
} );
