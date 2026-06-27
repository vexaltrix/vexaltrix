/**
 * BLOCK: Contact Form 7 Styler
 */

// Import block dependencies and components.
import { renderLegacyBlockEditorIcon } from '@Controls/block-icons';

// Import icon.
import Edit from './edit';

import './style.scss';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let CF7CommonData = {};
CF7CommonData = applyFilters( 'cf7-styler', addCommonDataToVexaltrixBlocks( CF7CommonData ) );
if (
	vxt_ultimate_gutenberg_blocks_blocks_info.cf7_is_active &&
	'yes' === vxt_ultimate_gutenberg_blocks_blocks_info.enable_legacy_blocks
) {
	registerBlockType( 'vexaltrix/cf7-styler', {
		...CF7CommonData,
		title: __( 'Contact Form 7 Designer', 'vexaltrix' ), // Block title.
		description: __( 'Highly customize and style your Contact Form 7 forms .', 'vexaltrix' ), // Block description.
		icon: renderLegacyBlockEditorIcon( 'cf7_styler' ),
		keywords: [
			__( 'CF7 styler', 'vexaltrix' ),
			__( 'contact form styler', 'vexaltrix' ),
			__( 'uag', 'vexaltrix' ),
		],
		supports: {
			anchor: true,
		},
		category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
		edit: ( props ) =>
			props.attributes.isPreview ? <PreviewImage image="contact-form-7-styler" /> : <Edit { ...props } />,
		save: () => null,
	} );
}
