import { select, dispatch } from '@wordpress/data';
import { useRef, useEffect, useState, useLayoutEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import editorStyles from './editor.lazy.scss';

export const applyScopedCSS = ( customCSS ) => {
	if ( 'string' !== typeof customCSS ) {
		return;
	}
	// This makes sure CSS only gets applied to blocks and not the editor elements.
	const scopedCSS = customCSS
		.replace( /\\/g, '' ) // Removes all backslashes.
		.split( '}' )
		.map( ( rule ) => ( rule.trim() ? `.block-editor-block-list__layout ${ rule }}` : '' ) )
		.join( ' ' );

	const isExistStyle = document.getElementById( 'vxt-blocks-editor-custom-css' );

	if ( ! isExistStyle ) {
		const node = document.createElement( 'style' );
		node.setAttribute( 'id', 'vxt-blocks-editor-custom-css' );
		node.textContent = scopedCSS;
		document.head.appendChild( node );
	} else {
		isExistStyle.textContent = scopedCSS;
	}
};

const PageCustomCSS = () => {
	const tabRef = useRef( null );
	const [ customCSS, setCustomCSS ] = useState(
		select( 'core/editor' ).getEditedPostAttribute( 'meta' )?._uag_custom_page_level_css
	);

	useLayoutEffect( () => {
		editorStyles.use();
		return () => {
			editorStyles.unuse();
		};
	}, [] );

	useEffect( () => {
		applyScopedCSS( customCSS );
	}, [ customCSS ] );

	useEffect( () => {
		return () => {
			const vexaltrixCustomCSSPanel = document.querySelector( '.vexaltrix-custom-css-panel' );
			const editors = vexaltrixCustomCSSPanel?.querySelectorAll( '.CodeMirror-wrap' );

			if ( editors ) {
				editors?.forEach( ( editor ) => {
					editor?.remove();
				} );
			}
		};
	}, [] );

	useEffect( () => {
		const vexaltrixCustomCSSPanel = document.querySelector( '.vexaltrix-custom-css-panel' );
		const editors = vexaltrixCustomCSSPanel?.querySelectorAll( '.CodeMirror-wrap' );

		if ( editors ) {
			editors?.forEach( ( editor ) => {
				editor?.remove();
			} );
		}

		const editor = wp?.codeEditor?.initialize( tabRef?.current, {
			...wp.codeEditor.defaultSettings.codemirror,
			scrollbarStyle: null,
		} );

		const codeMirrorEditor = document.querySelector( '.vexaltrix-css-editor .CodeMirror-code' );

		if ( codeMirrorEditor ) {
			codeMirrorEditor?.addEventListener( 'keyup', function () {
				editor?.codemirror?.save();
				const value = editor?.codemirror?.getValue();
				setCustomCSS( value );
				dispatch( 'core/editor' ).editPost( { meta: { _uag_custom_page_level_css: value } } );
			} );
		}
	}, [ tabRef ] );

	return (
		<>
			<p className="vexaltrix-custom-css-notice">
				{ __( 'Add your own CSS code here to customize the page as per your expectations.', 'vexaltrix' ) }
			</p>
			<hr></hr>
			<p className="vexaltrix-custom-css-example vexaltrix-custom-css-notice">
				{ vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_custom_css_example }
			</p>
			<div id="vexaltrix-css-editor" className="vexaltrix-css-editor">
				<textarea value={ customCSS } ref={ tabRef }></textarea>
			</div>
		</>
	);
};

export default PageCustomCSS;
