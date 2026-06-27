/**
 * BLOCK: Vexaltrix - Separator
 */
import VXT_Block_Icons from '@Controls/block-icons';
import './style.scss';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
import transforms from './transforms';
import deprecated from './deprecated';
const separatorCommonData = applyFilters( 'vexaltrix/separator', addCommonDataToVexaltrixBlocks( {} ) );

registerBlockType( 'vexaltrix/separator', {
	...separatorCommonData,
	apiVersion: 2,
	title: __( 'Separator', 'vexaltrix' ),
	description: __( 'Add a modern separator to divide your page content with icon/text.', 'vexaltrix' ),
	icon: VXT_Block_Icons.separator,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	keywords: [ __( 'divider', 'vexaltrix' ), __( 'separator', 'vexaltrix' ) ],
	attributes,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="separator" /> : <Edit { ...props } /> ),
	save,
	transforms,
	deprecated,
} );
