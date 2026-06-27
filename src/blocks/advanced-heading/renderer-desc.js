import { RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { applyFilters } from '@wordpress/hooks';
import { createBlock } from '@wordpress/blocks';

const RendererDesc = ( props ) => {
	const { setAttributes, attributes, context, onReplace, mergeBlocks, descriptionHasDynamicContent } = props;

	let { headingDesc } = props.attributes;

	let allowedFormats = false;

	// Check if this has dynamic content.
	if ( descriptionHasDynamicContent ) {
		const renderedMarkup = applyFilters( `uag_render_text_loop_data`, headingDesc, context );
		if ( renderedMarkup !== '' ) {
			allowedFormats = [ 'vexaltrix/dynamic-content' ];
			headingDesc = renderedMarkup;
		}
	}

	const propsOnSplit = ( value ) =>
		value
			? createBlock( 'vexaltrix/advanced-heading', { ...attributes, headingDesc: value } )
			: createBlock( 'core/paragraph' );

	return (
		<RichText
			tagName="p"
			placeholder={ __( 'Write a Description', 'vexaltrix' ) }
			value={ headingDesc }
			className="uagb-desc-text"
			onChange={ ( value ) => setAttributes( { headingDesc: value } ) }
			allowedFormats={ allowedFormats }
			onMerge={ mergeBlocks }
			onSplit={ propsOnSplit }
			onReplace={ onReplace }
			onRemove={ () => onReplace( [] ) }
		/>
	);
};
export default RendererDesc;
