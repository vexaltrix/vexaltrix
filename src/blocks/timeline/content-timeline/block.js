import VXT_Block_Icons from '@Controls/block-icons';
//  Import CSS.
import '.././style.scss';
import deprecated from './deprecated';
import save from './save';
import attributes from './attributes';
import Edit from './edit';

// Components
import { __ } from '@wordpress/i18n';

// Register block controls
import { registerBlockType } from '@wordpress/blocks';

import { addFilter, applyFilters } from '@wordpress/hooks';
import { withSelect } from '@wordpress/data';
import { compose, createHigherOrderComponent } from '@wordpress/compose';
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
const withcontentTimeline = createHigherOrderComponent( ( BlockEdit ) => {
	return enhance( ( { ...props } ) => {
		return <BlockEdit { ...props } />;
	} );
}, 'withcontentTimeline' );

import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let contentTimelineCommonData = {};
contentTimelineCommonData = applyFilters(
	'vexaltrix/content-timeline',
	addCommonDataToVexaltrixBlocks( contentTimelineCommonData )
);
registerBlockType( 'vexaltrix/content-timeline', {
	...contentTimelineCommonData,
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __( 'Content Timeline', 'vexaltrix' ), // Block title.
	description: __( 'Create a timeline displaying contents of your site.', 'vexaltrix' ), // Block description.
	icon: VXT_Block_Icons.content_timeline, // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	keywords: [ __( 'Content Timeline', 'vexaltrix' ), __( 'Timeline', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="content-timeline" /> : <Edit { ...props } />,
	save,
	deprecated,
} );

addFilter( 'editor.BlockEdit', 'vexaltrix/content-timeline', withcontentTimeline );
