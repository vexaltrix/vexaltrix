/**
 * BLOCK: Gravity Form Styler
 */

// Import block dependencies and components.
import { renderLegacyBlockEditorIcon } from '@Controls/block-icons';
import Edit from './edit';
import './style.scss';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let gfStylerCommonData = {};
gfStylerCommonData = applyFilters( 'vexaltrix/gf-styler', addCommonDataToVexaltrixBlocks( gfStylerCommonData ) );
if (
	vxt_ultimate_gutenberg_blocks_blocks_info.gf_is_active &&
	'yes' === vxt_ultimate_gutenberg_blocks_blocks_info.enable_legacy_blocks
) {
	registerBlockType( 'vexaltrix/gf-styler', {
		...gfStylerCommonData,
		title: __( 'Gravity Form Designer', 'vexaltrix' ), // Block title.
		description: __( 'Highly customize and style your forms created by Gravity Forms.', 'vexaltrix' ), // Block description.
		icon: renderLegacyBlockEditorIcon( 'gf_styler' ),
		keywords: [
			__( 'GF styler', 'vexaltrix' ),
			__( 'gravity form styler', 'vexaltrix' ),
			__( 'uag', 'vexaltrix' ),
		],
		supports: {
			anchor: true,
		},
		category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
		edit: ( props ) =>
			props.attributes.isPreview ? <PreviewImage image="gravity-form-styler" /> : <Edit { ...props } />,
		save() {
			return null;
		},
	} );
}
