/**
 * BLOCK: Content Timeline Child
 */

import VXT_Block_Icons from '@Controls/block-icons';
import '.././style.scss';
import './style.scss';
import save from './save';
import attributes from './attributes';
import Edit from './edit';
import deprecated from './deprecated';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let contentTimelineChildCommonData = {};
contentTimelineChildCommonData = applyFilters(
	'vexaltrix/content-timeline-child',
	addCommonDataToVexaltrixBlocks( contentTimelineChildCommonData )
);
registerBlockType( 'vexaltrix/content-timeline-child', {
	...contentTimelineChildCommonData,
	title: __( 'Content Timeline Child', 'vexaltrix' ),
	description: __( 'Add and customize content of this timeline.', 'vexaltrix' ),
	icon: VXT_Block_Icons.content_timeline_child,
	parent: [ 'vexaltrix/content-timeline' ],
	keywords: [ __( 'Content Timeline', 'vexaltrix' ), __( 'Timeline', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	supports: {
		html: false,
	},
	attributes,
	edit: ( props ) =>
		props.attributes.isPreview ? (
			<PreviewImage image="content-timeline-child" isChildren={ true } />
		) : (
			<Edit { ...props } />
		),
	save,
	deprecated,
} );
