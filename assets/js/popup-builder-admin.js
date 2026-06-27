// Vexaltrix Popup JS Actions Needed in the Admin CPT Page.

// Click Event to Enable or Disable Related Popup.
const VexaltrixToggelSwitch = ( event ) => {
	const element = event.target;
	// If the current toggle is on, this is false - else this is true.
	const updatedStatus = element.classList.contains( 'vexaltrix-popup-builder__switch--active' ) ? 'false' : 'true';

	const mediaData = new FormData();
	mediaData.append( 'action', 'vxt_update_popup_status' );
	mediaData.append(
		'nonce',
		vxt_ultimate_gutenberg_blocks_popup_builder_admin.vxt_ultimate_gutenberg_blocks_popup_builder_admin_nonce
	);
	mediaData.append( 'post_id', element.dataset.post_id );
	mediaData.append( 'enabled', updatedStatus );

	fetch( vxt_ultimate_gutenberg_blocks_popup_builder_admin.ajax_url, {
		method: 'POST',
		credentials: 'same-origin',
		body: mediaData,
	} )
		.then( ( resp ) => resp.json() )
		.then( ( data ) => {
			if ( false === data.success ) {
				return;
			}
			// If the API Fetch was successful, invert the toggle.
			if ( 'false' === updatedStatus ) {
				element.classList.remove( 'vexaltrix-popup-builder__switch--active' );
			} else {
				element.classList.add( 'vexaltrix-popup-builder__switch--active' );
			}
		} );
};

// Bind Related Click Events on Load.
document.addEventListener( 'DOMContentLoaded', () => {
	// Bind all the Toggles.
	const vexaltrixToggles = document.querySelectorAll( '.vexaltrix-popup-builder__switch' );
	for ( let vexaltrixToggleCount = 0; vexaltrixToggleCount < vexaltrixToggles.length; vexaltrixToggleCount++ ) {
		vexaltrixToggles[ vexaltrixToggleCount ].addEventListener(
			'click',
			( event ) => VexaltrixToggelSwitch( event ),
			false
		);
	}
} );
