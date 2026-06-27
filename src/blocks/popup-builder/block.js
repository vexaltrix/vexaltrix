/**
 * BLOCK: Popup Builder
 */

import VXT_Block_Icons from '@Controls/block-icons';
import './style.scss';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import variations from './variations';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { applyFilters } from '@wordpress/hooks';
import PreviewImage from '@Controls/previewImage';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';

if ( 'vexaltrix-popup' === window.typenow ) {
	let popupCommonData = {};
	popupCommonData = applyFilters( 'vexaltrix/popup-builder', addCommonDataToVexaltrixBlocks( popupCommonData ) );

	registerBlockType( 'vexaltrix/popup-builder', {
		...popupCommonData,
		apiVersion: 2,
		title: __( 'Popup Builder', 'vexaltrix' ),
		description: __( 'This block allows you to build a site-wide popup.', 'vexaltrix' ),
		icon: VXT_Block_Icons.popup_builder,
		keywords: [ __( 'popup', 'vexaltrix' ), __( 'builder', 'vexaltrix' ) ],
		supports: {
			anchor: true,
			multiple: false,
			reusable: false,
			lock: false,
		},
		category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
		attributes,
		edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="modal" /> : <Edit { ...props } /> ),
		save,
		variations,
		deprecated,
	} );
}
