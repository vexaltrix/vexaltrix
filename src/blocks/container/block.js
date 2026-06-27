/**
 * BLOCK: Container
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { variations } from './variationPicker';
import transforms from './transforms';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let containerCommonData = {};
containerCommonData = applyFilters( 'vexaltrix/container', addCommonDataToVexaltrixBlocks( containerCommonData ) );
registerBlockType( 'vexaltrix/container', {
	...containerCommonData,
	apiVersion: 2,
	title: __( 'Container', 'vexaltrix' ),
	description: __( 'Create beautiful layouts with flexbox powered container block.', 'vexaltrix' ),
	icon: VXT_Block_Icons.container,
	keywords: [ __( 'container', 'vexaltrix' ), __( 'uag', 'vexaltrix' ), __( 'flex', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	variations,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="container" /> : <Edit { ...props } /> ),
	save,
	deprecated,
	transforms,
} );
