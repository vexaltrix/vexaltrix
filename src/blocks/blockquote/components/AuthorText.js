import { RichText } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { createBlock } from '@wordpress/blocks';

const AuthorText = ( { attributes, setAttributes, props } ) => {
	if ( setAttributes !== 'not_set' ) {
		return (
			<RichText
				tagName="div"
				value={ attributes.author }
				placeholder={ __( 'Author', 'vexaltrix' ) }
				className="vxt-blockquote__author"
				onChange={ ( value ) =>
					setAttributes( {
						author: value,
					} )
				}
				onMerge={ props.mergeBlocks }
				onSplit={
					props.insertBlocksAfter
						? ( before, after, ...blocks ) => {
								setAttributes( {
									content: before,
								} );
								props.insertBlocksAfter( [
									...blocks,
									createBlock( 'core/paragraph', {
										content: after,
									} ),
								] );
						  }
						: undefined
				}
				onRemove={ () => props.onReplace( [] ) }
			/>
		);
	}

	return <RichText.Content tagName="cite" value={ attributes.author } className="vxt-blockquote__author" />;
};

export default AuthorText;
