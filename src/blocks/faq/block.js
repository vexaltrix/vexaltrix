/**
 * BLOCK: FAQ - Schema
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import './style.scss';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';
import { addFilter, applyFilters } from '@wordpress/hooks';
import { withSelect } from '@wordpress/data';
import { compose, createHigherOrderComponent } from '@wordpress/compose';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';

/**
 * Override the default block element to add	wrapper props.
 *
 * @param {Function} BlockListBlock Original component
 * @return {Function} Wrapped component
 */

const enhance = compose(
	withSelect( ( select ) => {
		return {
			selected: select( 'core/block-editor' ).getSelectedBlock(),
		};
	} )
);
/**
 * Add custom UAG attributes to selected blocks
 *
 * @param {Function} BlockEdit Original component.
 * @return {string} Wrapped component.
 */
const withFaq = createHigherOrderComponent( ( BlockEdit ) => {
	return enhance( ( { ...props } ) => {
		return <BlockEdit { ...props } />;
	} );
}, 'withFaq' );

import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let faqCommonData = {};
faqCommonData = applyFilters( 'vexaltrix/faq', addCommonDataToVexaltrixBlocks( faqCommonData ) );
registerBlockType( 'vexaltrix/faq', {
	...faqCommonData,
	title: __( 'FAQ', 'vexaltrix' ),
	description: __( 'Add accordions/FAQ schema to your page.', 'vexaltrix' ),
	icon: VXT_Block_Icons.faq,
	keywords: [
		__( 'faq', 'vexaltrix' ),
		__( 'schema', 'vexaltrix' ),
		__( 'uag', 'vexaltrix' ),
		__( 'accordion', 'vexaltrix' ),
	],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	deprecated,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="faq" /> : <Edit { ...props } /> ),
	supports: {
		anchor: true,
		html: false,
	},
	save,
} );

addFilter( 'editor.BlockEdit', 'vexaltrix/faq', withFaq );
