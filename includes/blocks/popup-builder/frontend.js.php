<?php
/**
 * Frontend JS File.
 *
 * @since 2.6.0
 *
 * @package ugb
 */

$js       = '';
$popupId = get_the_ID();

$isPushBanner = ( 'banner' === $attr['variantType'] && $attr['willPushContent'] );
$popupTimer    = $isPushBanner ? 500 : 100;

// Render the JS Script to handle this popup on the current page.
ob_start();
?>
	window.addEventListener( 'DOMContentLoaded', function() {
		const blockScope = document.querySelector( '.vxt-block-<?php echo esc_attr( strval( $id ) ); ?>' );
		if ( ! blockScope ) {
			return;
		}
		const deviceWidth = ( window.innerWidth > 0 ) ? window.innerWidth : screen.width;
		if ( blockScope.classList.contains( 'uag-hide-desktop' ) && deviceWidth > 1024 ) {
			blockScope.remove();
			return;
		} else if ( blockScope.classList.contains( 'uag-hide-tab' ) && ( deviceWidth <= 1024 && deviceWidth > 768 ) ) {
			blockScope.remove();
			return;
		} else if ( blockScope.classList.contains( 'uag-hide-mob' ) && deviceWidth <= 768 ) {
			blockScope.remove();
			return;
		}

		<?php
			// Either check if the localStorage has been set before - If not, create it.
			// Or if this popup has an updated repetition number, reset the localStorage.
		?>
		let popupSesh = JSON.parse( localStorage.getItem( 'vexaltrixPopup<?php echo esc_attr( strval( $popupId ) ); ?>' ) );
		const repetition = <?php echo intval( get_post_meta( $popupId, 'vexaltrix-popup-repetition', true ) ); ?>;
		if ( null === popupSesh || repetition !== popupSesh[1] ) {
			<?php // [0] is the updating repetition number, [1] is the original repetition number. ?>		
			const repetitionArray = [
				repetition,
				repetition,
			];
			localStorage.setItem( 'vexaltrixPopup<?php echo esc_attr( strval( $popupId ) ); ?>', JSON.stringify( repetitionArray ) );
			popupSesh = JSON.parse( localStorage.getItem( 'vexaltrixPopup<?php echo esc_attr( strval( $popupId ) ); ?>' ) );
		}

		if ( 0 === popupSesh[0] ) {
			blockScope.remove();
			return;
		}

		const theBody = document.querySelector( 'body' );
		blockScope.style.display = 'flex';
		setTimeout( () => {
			<?php
			// If this is a banner with push, render the max height instead of opacity on timeout.
			if ( $isPushBanner ) {
				?>
					blockScope.style.maxHeight = '100vh';
				<?php
			} else {
				// If this is a popup which prevent background interaction, hide the scrollbar.
				if ( 'popup' === $attr['variantType'] && $attr['haltBackgroundInteraction'] ) :
					?>
						theBody.classList.add( 'vxt-popup-builder__body--overflow-hidden' );
						blockScope.classList.add( 'vexaltrix-popup--open' );
						<?php // Once this popup is active, create a focusable element to add focus onto the popup and then remove it. ?>
						const focusElement = document.createElement( 'button' );
						focusElement.style.position = 'absolute';
						focusElement.style.opacity = '0';
						const popupFocus = blockScope.insertBefore( focusElement, blockScope.firstChild );
						popupFocus.focus();
						popupFocus.remove();
					<?php endif; ?>
					blockScope.style.opacity = 1;
				<?php
			}
			?>
		}, 100 );

		<?php
			// If this is a banner with push, Add the unset bezier curve after animating.
		if ( $isPushBanner ) :
			?>
			setTimeout( () => {
				blockScope.style.transition = 'max-height 0.5s cubic-bezier(0, 1, 0, 1)';
			}, 600 );
		<?php endif; ?>

		const closePopup = ( event = null ) => {
			if ( event && blockScope !== event?.target ) {
				return;
			}
			if ( popupSesh[0] > 0 ) {
				popupSesh[0] -= 1;
				localStorage.setItem( 'vexaltrixPopup<?php echo esc_attr( strval( $popupId ) ); ?>', JSON.stringify( popupSesh ) );
			}
			<?php
				// If this is a banner with push, render the required animation instead of opacity.
			if ( $isPushBanner ) :
				?>
				blockScope.style.maxHeight = '';
			<?php else : ?>
				blockScope.style.opacity = 0;
			<?php endif; ?>
			setTimeout( () => {
				<?php
					// If this is a banner with push, remove the unset bezier curve.
				if ( $isPushBanner ) :
					?>
					blockScope.style.transition = '';
				<?php endif; ?>
				blockScope.remove();
				const allActivePopups = document.querySelectorAll( '.vxt-popup-builder.vexaltrix-popup--open' );
				if ( 0 === allActivePopups.length ) {
					theBody.classList.remove( 'vxt-popup-builder__body--overflow-hidden' );
				}
			}, <?php echo intval( $popupTimer ); ?> );
		};

		<?php
		if ( $attr['isDismissable'] ) :
			if ( $attr['hasOverlay'] && $attr['closeOverlayClick'] ) :
				?>
				blockScope.addEventListener( 'click', ( event ) => closePopup( event ) );
				<?php
				endif;
			if ( $attr['closeIcon'] ) :
				?>
				const closeButton = blockScope.querySelector( '.vxt-popup-builder__close' );
				closeButton.style.cursor = 'pointer';
				closeButton.addEventListener( 'click', () => closePopup() );
				<?php
				endif;
			if ( $attr['closeEscapePress'] && 'popup' === $attr['variantType'] && $attr['haltBackgroundInteraction'] ) :
				?>
				document.addEventListener( 'keyup', ( event ) => {
					if ( 27 === event.keyCode && blockScope.classList.contains( 'vexaltrix-popup--open' ) ) {
						return closePopup();
					}
				} );
				<?php
				endif;
			endif;
		?>

		const closingElements = blockScope.querySelectorAll( '.vexaltrix-popup-close-<?php echo esc_attr( strval( $popupId ) ); ?>' );
		for ( let i = 0; i < closingElements.length; i++ ) {
			closingElements[ i ].style.cursor = 'pointer';
			closingElements[ i ].addEventListener( 'click', () => closePopup() );
		}
	} );
<?php
$js = ob_get_clean();

$js = apply_filters( 'vexaltrix_pro_popup_frontend_js', $js, $id, $attr, $isPushBanner, $popupTimer );

return $js;
