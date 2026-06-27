const addBlockEditorDynamicStyles = () => {
	setTimeout( () => {
		const getAllIFrames = document.getElementsByTagName( 'iframe' );
		if ( ! getAllIFrames?.length ) {
			return;
		}

		const cloneLinkTag = ( linkId ) => {
			const getTag = document.getElementById( linkId );
			return getTag ? getTag.cloneNode( true ) : false;
		};

		const cloneStyleTag = ( styleId ) => {
			const getStyleTag = document.getElementById( styleId );
			return getStyleTag ? getStyleTag.textContent : false;
		};

		const dashiconsCss = cloneLinkTag( 'dashicons-css' );
		const blockCssCss = cloneLinkTag( 'vxt-block-css-css' );
		const slickStyle = cloneLinkTag( 'vxt-slick-css-css' );
		const swiperStyle = cloneLinkTag( 'vxt-swiper-css-css' );
		const aosStyle = cloneLinkTag( 'vxt-aos-css-css' );

		const editorStyle = cloneStyleTag( 'vexaltrix-editor-styles' );
		const editorProStyle = cloneStyleTag( 'vexaltrix-pro-editor-styles' );
		const spacingStyle = cloneStyleTag( 'vxt-blocks-editor-spacing-style' );
		const editorCustomStyle = cloneStyleTag( 'vxt-blocks-editor-custom-css' );

		for ( const iterateIFrames of getAllIFrames ) {
			// Skip the iframe with the specific name.
			if ( vxt_ultimate_gutenberg_blocks_blocks_info.exclude_crops_iframes.includes( iterateIFrames.name ) ) {
				continue;
			}
			try {
				const iframeDocument = iterateIFrames?.contentWindow?.document || iterateIFrames?.contentDocument;
				if ( ! iframeDocument?.head ) {
					continue;
				}

				const copyLinkTag = ( clonedTag, tagId ) => {
					if ( ! clonedTag ) {return;}
					const isExistTag = iframeDocument.getElementById( tagId );
					if ( isExistTag ) {return;}
					iframeDocument.head.appendChild( clonedTag );
				};

				const copyStyleTag = ( clonedTag, tagId ) => {
					if ( ! clonedTag ) {return;}
					const isExistTag = iframeDocument.getElementById( tagId );
					if ( ! isExistTag ) {
						const node = document.createElement( 'style' );
						node.setAttribute( 'id', tagId );
						node.textContent = clonedTag;
						iframeDocument.head.appendChild( node );
					} else {
						isExistTag.textContent = clonedTag;
					}
				};

				copyLinkTag( blockCssCss, 'vxt-block-css-css' );
				copyLinkTag( dashiconsCss, 'dashicons-css' );
				copyLinkTag( slickStyle, 'vxt-slick-css-css' );
				copyLinkTag( swiperStyle, 'vxt-swiper-css-css' );
				copyLinkTag( aosStyle, 'vxt-aos-css-css' );

				copyStyleTag( editorStyle, 'vexaltrix-editor-styles' );
				copyStyleTag( editorProStyle, 'vexaltrix-pro-editor-styles' );
				copyStyleTag( spacingStyle, 'vxt-blocks-editor-spacing-style' );
				copyStyleTag( editorCustomStyle, 'vxt-blocks-editor-custom-css' );
			} catch ( e ) {
				// Ignore cross-origin access errors.
			}
		} // Loop end.
	} );
};

export default addBlockEditorDynamicStyles;
