/**
 * BLOCK: Heading
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { registerBlockType, createBlock } from '@wordpress/blocks';
import './format';
import colourNameToHex from '@Controls/changeColorNameToHex';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';

import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let headingCommonData = {};
headingCommonData = applyFilters( 'vexaltrix/advanced-heading', addCommonDataToVexaltrixBlocks( headingCommonData ) );
registerBlockType( 'vexaltrix/advanced-heading', {
	...headingCommonData,
	title: __( 'Heading', 'vexaltrix' ),
	description: __( 'Add heading, sub heading and a separator using one block.', 'vexaltrix' ),
	icon: VXT_Block_Icons.advanced_heading,
	keywords: [ __( 'creative heading', 'vexaltrix' ), __( 'uag', 'vexaltrix' ), __( 'heading', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	__experimentalLabel: ( atts, content ) => {
		const { context } = content;
		if ( context === 'list-view' && atts?.metadata?.name && atts.metadata.name ) {
			return atts.metadata.name;
		}

		const loopData = applyFilters( 'vxt_loop_data_source_label', '', atts );

		if ( loopData ) {
			return loopData;
		}

		// Heading content show.
		if ( atts.headingTitle ) {
			return atts.headingTitle;
		}

		return __( 'Heading', 'vexaltrix' );
	},
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="advanced-heading" /> : <Edit { ...props } />,
	save,
	deprecated,
	usesContext: [ 'postId', 'postType' ],
	transforms: {
		from: [
			{
				type: 'block',
				blocks: [ 'core/heading' ],
				transform: ( attribute ) => {
					return createBlock( 'vexaltrix/advanced-heading', {
						headingTitle: attribute.content,
						headingAlign: attribute.textAlign,
						headingColor: colourNameToHex( attribute.textColor ),
						blockBackground: colourNameToHex( attribute.backgroundColor ),
					} );
				},
			},
			{
				type: 'block',
				blocks: [ 'core/quote' ],
				transform: ( attribute ) => {
					return createBlock( 'vexaltrix/advanced-heading', {
						headingTitle: attribute.value,
						headingDesc: attribute.citation,
						headingAlign: attribute.align,
						headingColor: colourNameToHex( attribute.textColor ),
						blockBackground: colourNameToHex( attribute.backgroundColor ),
					} );
				},
			},
			{
				type: 'block',
				blocks: [ 'core/paragraph' ],
				transform: ( attribute ) => {
					return createBlock( 'vexaltrix/advanced-heading', {
						headingTitle: attribute.content,
						headingAlign: attribute.align,
						headingColor: colourNameToHex( attribute.textColor ),
						blockBackground: colourNameToHex( attribute.backgroundColor ),
					} );
				},
			},
			{
				type: 'block',
				blocks: [ 'core/list' ],
				transform: ( _attributes, childBlocks ) => {
					const newitems = [];
					childBlocks.forEach( ( item, i ) => {
						newitems.push( {
							text: childBlocks[ i ].attributes.content,
						} );
					} );

					return newitems.map( ( text ) =>
						createBlock( 'vexaltrix/advanced-heading', {
							headingTitle: text.text,
							headingColor: colourNameToHex( _attributes.textColor ),
							blockBackground: colourNameToHex( _attributes.backgroundColor ),
						} )
					);
				},
			},
		],
		to: [
			{
				type: 'block',
				blocks: [ 'core/heading' ],
				transform: ( attribute ) => {
					return createBlock( 'core/heading', {
						content: attribute.headingTitle,
						align: attribute.headingAlign,
					} );
				},
			},
			{
				type: 'block',
				blocks: [ 'core/quote' ],
				transform: ( attribute ) => {
					return createBlock( 'core/quote', {
						value: attribute.headingTitle,
						citation: attribute.headingDesc,
					} );
				},
			},
			{
				type: 'block',
				blocks: [ 'core/paragraph' ],
				transform: ( attribute ) => {
					return createBlock( 'core/paragraph', {
						content: attribute.headingTitle,
					} );
				},
			},
		],
	},
} );
