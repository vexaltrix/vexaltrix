/**
 * BLOCK: How To - Step
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let stepCommonData = {};
stepCommonData = applyFilters( 'vexaltrix/how-to-step', addCommonDataToVexaltrixBlocks( stepCommonData ) );
registerBlockType( 'vexaltrix/how-to-step', {
	...stepCommonData,
	title: __( 'Step', 'vexaltrix' ),
	description: __( 'Add relevant content for this step.', 'vexaltrix' ),
	icon: VXT_Block_Icons.how_to_step,
	parent: [ 'vexaltrix/how-to' ],
	attributes,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="how-to-step" isChildren={ true } /> : <Edit { ...props } />,
	supports: {
		anchor: true,
		html: false,
	},
	save,
	deprecated,
} );
