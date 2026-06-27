function slideUp( target, duration ) {
	target.style.transitionProperty = 'height, margin, padding';
	target.style.transitionDuration = duration + 'ms';
	target.style.boxSizing = 'border-box';
	target.style.height = target.offsetHeight + 'px';
	target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	window.setTimeout( function () {
		target.style.display = 'none';
		target.style.removeProperty( 'height' );
		target.style.removeProperty( 'padding-top' );
		target.style.removeProperty( 'padding-bottom' );
		target.style.removeProperty( 'margin-top' );
		target.style.removeProperty( 'margin-bottom' );
		target.style.removeProperty( 'overflow' );
		target.style.removeProperty( 'transition-duration' );
		target.style.removeProperty( 'transition-property' );
	}, duration );
}

function slideDown( target, duration ) {
	target.style.removeProperty( 'display' );
	let display = window.getComputedStyle( target ).display;

	if ( display === 'none' ) {
		display = 'block';
	}

	target.style.display = display;
	const height = target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	target.offsetHeight;
	target.style.boxSizing = 'border-box';
	target.style.transitionProperty = 'height, margin, padding';
	target.style.transitionDuration = duration + 'ms';
	target.style.height = height + 'px';
	target.style.removeProperty( 'padding-top' );
	target.style.removeProperty( 'padding-bottom' );
	target.style.removeProperty( 'margin-top' );
	target.style.removeProperty( 'margin-bottom' );
	window.setTimeout( function () {
		target.style.removeProperty( 'height' );
		target.style.removeProperty( 'overflow' );
		target.style.removeProperty( 'transition-duration' );
		target.style.removeProperty( 'transition-property' );
	}, duration );
}

function setupFAQ() {
	const pattern = new RegExp( '^[\\w\\-]+$' );
	const hashval = window.location.hash.substring( 1 );
	const expandFirstelements = document.getElementsByClassName( 'vxt-faq-expand-first-true' );
	const inactiveOtherelements = document.getElementsByClassName( 'vxt-faq-inactive-other-false' );

	if (
		document.getElementById( hashval ) !== undefined &&
		document.getElementById( hashval ) !== null &&
		document.getElementById( hashval ) !== '' &&
		pattern.test( hashval )
	) {
		const elementToOpen = document.getElementById( hashval );

		if ( elementToOpen !== undefined ) {
			elementToOpen.classList.add( 'vxt-faq-item-active' );
			elementToOpen.setAttribute( 'aria-expanded', true );
			const faqContent = elementToOpen.getElementsByClassName( 'vxt-faq-content' )[ 0 ];
			if ( faqContent ) {
				slideDown( faqContent, 500 );
			}
		}
	} else {
		for ( let item = 0; item < expandFirstelements.length; item++ ) {
			if ( true === expandFirstelements[ item ].classList.contains( 'vxt-faq-layout-accordion' ) ) {
				let faqItem = expandFirstelements[ item ].querySelectorAll(
					'.vxt-faq-child__outer-wrap.vxt-faq-item'
				)[ 0 ];

				if ( ! faqItem ) {
					faqItem = expandFirstelements[ item ].querySelectorAll(
						'.vxt-faq-child__outer-wrap .vxt-faq-item'
					)[ 0 ];
				}

				faqItem.classList.add( 'vxt-faq-item-active' );

				faqItem.setAttribute( 'aria-expanded', true );
				faqItem.querySelectorAll( '.vxt-faq-content' )[ 0 ].style.display = 'block';
			}
		}
	}
	for ( let item = 0; item < inactiveOtherelements.length; item++ ) {
		if ( true === inactiveOtherelements[ item ].classList.contains( 'vxt-faq-layout-accordion' ) ) {
			let otherItems = inactiveOtherelements[ item ].querySelectorAll(
				'.vxt-faq-child__outer-wrap.vxt-faq-item'
			);

			if ( ! otherItems || 0 === otherItems.length ) {
				otherItems = inactiveOtherelements[ item ].querySelectorAll(
					'.vxt-faq-child__outer-wrap .vxt-faq-item'
				);
			}

			for ( let childItem = 0; childItem < otherItems.length; childItem++ ) {
				otherItems[ childItem ].classList.add( 'vxt-faq-item-active' );
				otherItems[ childItem ].setAttribute( 'aria-expanded', true );
				otherItems[ childItem ].querySelectorAll( '.vxt-faq-content' )[ 0 ].style.display = 'block';
			}
		}
	}
}

window.addEventListener( 'load', function () {
	setupFAQ();

	const accordionElements = document.getElementsByClassName( 'vxt-faq-layout-accordion' );
	for ( let item = 0; item < accordionElements.length; item++ ) {
		const questionButtons = accordionElements[ item ].querySelectorAll( '.vxt-faq-questions-button' );
		const faqItems = accordionElements[ item ].querySelectorAll( '.vxt-faq-item' );

		for ( let button = 0; button < questionButtons.length; button++ ) {
			questionButtons[ button ].addEventListener( 'click', function ( e ) {
				faqClick( e, this.parentElement, questionButtons );
			} );
		}

		for ( let button = 0; button < faqItems.length; button++ ) {
			faqItems[ button ].addEventListener( 'keyup', function ( e ) {
				faqClick( e, this, questionButtons );
			} );
		}
	}
} );

function faqClick( e, faqItem, questionButtons ) {
	if ( e.keyCode === 13 || e.keyCode === 32 || e.button === 0 ) {
		// enter || spacebar || left mouse click.
		if ( faqItem.classList.contains( 'vxt-faq-item-active' ) ) {
			faqItem.classList.remove( 'vxt-faq-item-active' );
			faqItem.setAttribute( 'aria-expanded', false );
			slideUp( faqItem.getElementsByClassName( 'vxt-faq-content' )[ 0 ], 500 );
		} else {
			const parent = e.currentTarget.closest( '.wp-block-vxt-faq' );
			let faqToggle = 'true';
			if ( parent.classList.contains( 'wp-block-vxt-faq' ) ) {
				faqToggle = parent.getAttribute( 'data-faqtoggle' );
			}
			faqItem.classList.add( 'vxt-faq-item-active' );
			faqItem.setAttribute( 'aria-expanded', true );
			slideDown( faqItem.getElementsByClassName( 'vxt-faq-content' )[ 0 ], 500 );
			if ( 'true' === faqToggle ) {
				questionButtons = parent.querySelectorAll( '.vxt-faq-content' );
				for ( let buttonChild = 0; buttonChild < questionButtons.length; buttonChild++ ) {
					const buttonItem = questionButtons[ buttonChild ].parentElement;
					if ( buttonItem === faqItem ) {
						continue;
					}
					buttonItem.classList.remove( 'vxt-faq-item-active' );
					buttonItem.setAttribute( 'aria-expanded', false );
					slideUp( buttonItem.getElementsByClassName( 'vxt-faq-content' )[ 0 ], 500 );
				}
			}
		}
	}
}
