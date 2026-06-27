import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import { uagbClassNames } from '@Utils/Helpers';

const addStyleClass = createHigherOrderComponent( ( BlockListBlock ) => {
	return ( props ) => {
		const {
			className,
			attributes: { globalBlockStyleId },
		} = props;

		if ( ! globalBlockStyleId || ( globalBlockStyleId && '' === globalBlockStyleId ) ) {
			return <BlockListBlock { ...props } />;
		}

		return (
			<BlockListBlock
				{ ...props }
				className={ uagbClassNames( [ className, `vexaltrix-gbs-${ globalBlockStyleId }` ] ) }
			/>
		);
	};
}, 'addStyleClass' );

addFilter( 'editor.BlockListBlock', 'vexaltrix/gbs-class-editor', addStyleClass );
