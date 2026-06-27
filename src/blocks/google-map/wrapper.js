import { applyFilters } from '@wordpress/hooks';
import { select } from '@wordpress/data';

export function GoogleMapsWrapper( ChildComponent ) {
	return ( props ) => {
		const { attributes, context } = props;
		if ( ! attributes?.dynamicContent?.address?.enable ) {
			return <ChildComponent { ...props } />;
		}

		const [ postTypeData = '', postIDData ] = ( attributes?.dynamicContent?.address?.source || '' ).split( '|' );

		const [ scscope = '', scmeta = '' ] = ( attributes?.dynamicContent?.address?.field || '' ).split( '|' );

		// Get the post type of the current post
		const getStore = select( 'core/editor' );
		const currentPostType = getStore?.getCurrentPostType ? getStore.getCurrentPostType() : null;

		const postType = 'current_post' === scscope ? currentPostType : postTypeData;
		// Converting data to string so that we can match it with filter data format.
		const dynamicString = `<span data-vexaltrix-dc-field="${ attributes?.dynamicContent?.address?.field }" data-vexaltrix-dc-advanced="${ attributes?.dynamicContent?.address?.advanced }" data-vexaltrix-dc-source="${ postType }|${ attributes?.dynamicContent?.address?.postId }" class="uag-pro-dynamic-content">${ attributes?.address }</span>`;

		const dynamicAddress = applyFilters( 'uag_render_text_loop_data', dynamicString, context );
		props = { ...props, ...{ attributes: { ...attributes, address: dynamicAddress } } };
		return <ChildComponent { ...props } />;
	};
}
