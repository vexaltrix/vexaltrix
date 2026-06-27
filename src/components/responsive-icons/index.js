document.addEventListener( 'load', vexaltrix_responsive_icons );
document.addEventListener( 'DOMContentLoaded', vexaltrix_responsive_icons );

import DeviceIcons from './device-icons';

function vexaltrix_responsive_icons() {
	if ( vxt_ultimate_gutenberg_blocks_blocks_info.wp_version > '6.2.2' ) {
		// Don't show the Vexaltrix Responsive Icons if WP version is greater than 6.2.2.
		return;
	}
	wp.data.subscribe( function () {
		setTimeout( function () {
			vexaltrix_responsive_icon();
		}, 500 );
	} );
}

function vexaltrix_responsive_icon() {
	if ( ! document.querySelector( '.edit-post-header__settings' ) ) {
		return null;
	}
	if ( document.querySelector( '.vexaltrix-responsive-icons__wrap' ) ) {
		return null;
	}

	const buttonWrapper = document.createElement( 'div' );
	buttonWrapper.classList.add( 'vexaltrix-responsive-icons__wrap' );

	document
		.querySelector( '.edit-post-header__settings' )
		.insertBefore( buttonWrapper, document.querySelector( '.edit-post-header__settings' ).firstChild );
	wp.element.render( <DeviceIcons />, document.querySelector( '.vexaltrix-responsive-icons__wrap' ) );
}
