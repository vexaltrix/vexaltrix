/**
 * BLOCK: FAQ - Schema - Child
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import './style.scss';
import deprecated from './deprecated';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let faqChildCommonData = {};
faqChildCommonData = applyFilters( 'vexaltrix/faq-child', addCommonDataToVexaltrixBlocks( faqChildCommonData ) );
registerBlockType( 'vexaltrix/faq-child', {
	...faqChildCommonData,
	title: __( 'FAQ Child', 'vexaltrix' ),
	description: __( 'Add a frequently asked question/accordion to display information.', 'vexaltrix' ),
	icon: VXT_Block_Icons.faq_child,
	parent: [ 'vexaltrix/faq' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="faq-child" isChildren={ true } /> : <Edit { ...props } />,
	supports: {
		anchor: true,
		html: false,
	},
	save: () => null,
	deprecated,
} );
