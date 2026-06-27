window.addEventListener( 'DOMContentLoaded', uagbTimelineInit );
window.addEventListener( 'resize', uagbTimelineInit );
window.addEventListener( 'scroll', uagbTimelineInit );
document.addEventListener( 'UAGTimelineEditor', uagbTimelineInit );
// Callback function for all event listeners.
function uagbTimelineInit() {
	const iframeEl = document.querySelector( `iframe[name='editor-canvas']` );
	let mainDiv;
	if ( iframeEl ) {
		mainDiv = iframeEl.contentDocument.querySelectorAll( '.vxt-timeline' );
	} else {
		mainDiv = document.querySelectorAll( '.vxt-timeline' );
	}

	const timeline = mainDiv;
	if ( timeline.length === 0 ) {
		return;
	}

	for ( const content of timeline ) {
		const lineInner = content.querySelector( '.vxt-timeline__line__inner' );
		const lineOuter = content.querySelector( '.vxt-timeline__line' );
		const iconClass = content.querySelectorAll( '.vxt-timeline__marker' );
		const timelineField = content.querySelector( '.vxt-timeline__field:nth-last-child(2)' );
		const cardLast = timelineField
			? timelineField
			: content.querySelector( '.block-editor-block-list__block:last-child' );
		const timelineStartIcon = iconClass[ 0 ];
		const timelineEndIcon = iconClass[ iconClass.length - 1 ];

		setTimeout( () => {
			lineOuter.style.top = timelineStartIcon?.offsetTop + 'px';
		}, 300 );
		const timelineCardHeight = cardLast?.offsetHeight;

		if ( content.classList.contains( 'vxt-timeline__arrow-center' ) ) {
			lineOuter.style.bottom = timelineEndIcon?.offsetTop + 'px';
		} else if ( content.classList.contains( 'vxt-timeline__arrow-top' ) ) {
			const topHeight = timelineCardHeight - timelineEndIcon?.offsetTop;
			lineOuter.style.bottom = topHeight + 'px';
		} else if ( content.classList.contains( 'vxt-timeline__arrow-bottom' ) ) {
			const bottomHeight = timelineCardHeight - timelineEndIcon?.offsetTop;
			lineOuter.style.bottom = bottomHeight + 'px';
		}

		const connectorHeight = 3 * iconClass[ 0 ]?.offsetHeight;

		const viewportHeight = document?.documentElement?.clientHeight;

		const viewportHeightHalf = viewportHeight / 2 + connectorHeight;

		const body = document.body;
		const html = document.documentElement;

		const height = Math.max(
			body.scrollHeight,
			body.offsetHeight,
			html.clientHeight,
			html.scrollHeight,
			html.offsetHeight
		);

		const timelineEndIconOffsetBottom = height - timelineEndIcon?.getBoundingClientRect()?.top;

		const totalTimelineLineHeight =
			height - timelineStartIcon?.getBoundingClientRect()?.top - timelineEndIconOffsetBottom;

		const startFlag =
			timelineStartIcon?.getBoundingClientRect()?.top +
			window?.scrollY -
			( window?.innerHeight - window?.innerHeight / 3 );

		if ( startFlag < document?.documentElement?.scrollTop ) {
			const tscrollPerc =
				( ( document?.documentElement?.scrollTop - startFlag ) / totalTimelineLineHeight ) * 100;
			const percHeight = ( totalTimelineLineHeight / 100 ) * tscrollPerc;

			if ( percHeight < totalTimelineLineHeight + 60 ) {
				lineInner.style.height = percHeight + 'px';
			}
		}

		// Icon bg color and icon color

		let timelineIconPos, timelineCardPos;
		let timelineIconTop, timelineCardTop;
		const timelineIcon = content.querySelectorAll( '.vxt-timeline__marker' );

		let animateBorder = content.querySelectorAll( '.vxt-timeline__field' );

		if ( animateBorder.length === 0 ) {
			animateBorder = content.querySelectorAll( '.vxt-timeline__animate-border' );
		}

		for ( let j = 0; j < timelineIcon.length; j++ ) {
			timelineIconPos = timelineIcon[ j ].lastElementChild.getBoundingClientRect().top + window.scrollY;
			timelineCardPos = animateBorder[ j ].lastElementChild.getBoundingClientRect().top + window.scrollY;

			timelineIconTop = timelineIconPos - document.documentElement.scrollTop;
			timelineCardTop = timelineCardPos - document.documentElement.scrollTop;

			if ( timelineCardTop < viewportHeightHalf ) {
				animateBorder[ j ].classList.remove( 'out-view' );
				animateBorder[ j ].classList.add( 'in-view' );
			} else {
				// Remove classes if element is below than half of viewport.
				animateBorder[ j ].classList.add( 'out-view' );
				animateBorder[ j ].classList.remove( 'in-view' );
			}

			if ( timelineIconTop < viewportHeightHalf ) {
				// Add classes if element is above than half of viewport.
				timelineIcon[ j ].classList.remove( 'vxt-timeline__out-view-icon' );
				timelineIcon[ j ].classList.add( 'vxt-timeline__in-view-icon' );
			} else {
				// Remove classes if element is below than half of viewport.
				timelineIcon[ j ].classList.add( 'vxt-timeline__out-view-icon' );
				timelineIcon[ j ].classList.remove( 'vxt-timeline__in-view-icon' );
			}
		}
	}
}

function VexaltrixTimelineClasses( attributes, id ) {
	const timeline = document.querySelectorAll( id );

	if ( timeline.length === 0 ) {
		return;
	}

	const deviceWidth = Math.max( window.screen.width, window.innerWidth );

	for ( const content of timeline ) {
		content.classList.remove(
			'vxt-timeline__left-block',
			'vxt-timeline__right-block',
			'vxt-timeline__center-block'
		);

		let device = '';

		if ( deviceWidth <= vxt_ultimate_gutenberg_blocks_timeline_data.mobile_breakpoint ) {
			device = 'Mobile';
		} else if ( deviceWidth <= vxt_ultimate_gutenberg_blocks_timeline_data.tablet_breakpoint ) {
			device = 'Tablet';
		}

		if ( 'left' === attributes[ 'timelinAlignment' + device ] ) {
			content.classList.add( 'vxt-timeline__left-block' );
		} else if ( 'right' === attributes[ 'timelinAlignment' + device ] ) {
			content.classList.add( 'vxt-timeline__right-block' );
		} else {
			content.classList.add( 'vxt-timeline__center-block' );
		}

		let timelineChild = content.querySelectorAll( '.wp-block-vxt-content-timeline-child' );
		let childIndex = 0;

		if ( 0 === timelineChild.length ) {
			timelineChild = content.querySelectorAll( '.vxt-timeline__field' );
		}

		for ( const child of timelineChild ) {
			child.classList.remove( 'vxt-timeline__left', 'vxt-timeline__right' );
			const timelineMarker = child.querySelectorAll( '.vxt-timeline__marker' )[ 0 ];
			timelineMarker.classList.remove( 'vxt-timeline__left', 'vxt-timeline__right' );

			const timeLineEventInner = child.querySelectorAll( '.vxt-timeline__events-inner-new' )[ 0 ];

			timeLineEventInner.classList.remove( 'vxt-timeline__day-right', 'vxt-timeline__day-left' );

			if ( 'left' === attributes[ 'timelinAlignment' + device ] ) {
				child.classList.add( 'vxt-timeline__left' );
				timelineMarker.classList.add( 'vxt-timeline__left' );
				timeLineEventInner.classList.add( 'vxt-timeline__day-left' );
			} else if ( 'right' === attributes[ 'timelinAlignment' + device ] ) {
				child.classList.add( 'vxt-timeline__right' );
				timelineMarker.classList.add( 'vxt-timeline__left' );
				timeLineEventInner.classList.add( 'vxt-timeline__day-right' );
			} else if ( 'center' === attributes[ 'timelinAlignment' + device ] ) {
				if ( childIndex % 2 === 0 ) {
					child.classList.add( 'vxt-timeline__right' );
					timelineMarker.classList.add( 'vxt-timeline__right' );
					timeLineEventInner.classList.add( 'vxt-timeline__day-right' );
				} else {
					child.classList.add( 'vxt-timeline__left' );
					timelineMarker.classList.add( 'vxt-timeline__left' );
					timeLineEventInner.classList.add( 'vxt-timeline__day-left' );
				}
			}

			childIndex++;
		}
	}
}
