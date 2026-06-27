import { __ } from '@wordpress/i18n';

const UpsellImage = () => {
	let imgUrl = vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_url;
	imgUrl += '/assets/images/upsell/globalBanner.svg';

	return <img src={ imgUrl } alt="Upsell Cover" className="max-w-full h-auto" />;
};

export const vexaltrixProFeatures = {
	'advanced-animations': {
		image: <UpsellImage />,
		title: __( 'Unlock Advanced Animations', 'vexaltrix' ),
		header: __( 'Make your pages visually stunning with advanced animations that capture attention.', 'vexaltrix' ),
		description: __(
			'Take your website’s visual appeal to the next level with smooth, highly customizable animations. Control pacing, delays, and effects effortlessly.',
			'vexaltrix'
		),
		shortDesc: __( 'Smooth animations with precise control.', 'vexaltrix' ),
		features: [
			__( 'Set delay and duration for animations', 'vexaltrix' ),
			__( 'Customize animation pacing and easing', 'vexaltrix' ),
			__( 'Repeat animations on scroll', 'vexaltrix' ),
			__( 'Animate nested blocks seamlessly', 'vexaltrix' ),
		],
	},
	modal: {
		image: <UpsellImage />,
		title: __( 'Get Modal Pro', 'vexaltrix' ),
		header: __(
			'Boost engagement with highly customizable modals that demand attention. Create modals with triggers, transitions, and animations.',
			'vexaltrix'
		),
		description: __(
			'Add professional, high-converting modals with advanced triggers, seamless animations, and flexible customization.',
			'vexaltrix'
		),
		shortDesc: __( 'Customizable modals with dynamic triggers.', 'vexaltrix' ),
		features: [
			__( 'Advanced triggers like exit intent and delay', 'vexaltrix' ),
			__( 'Off-canvas and full-screen display options', 'vexaltrix' ),
			__( 'Smooth entrance and exit effects', 'vexaltrix' ),
			__( 'Cookie-based automatic triggering for conversions', 'vexaltrix' ),
		],
	},
	'popup-builder': {
		image: <UpsellImage />,
		title: __( 'Unlock Popup Builder Pro', 'vexaltrix' ),
		header: __( 'Create high-converting popups with powerful targeting and trigger options.', 'vexaltrix' ),
		description: __(
			'Design and display engaging popups with advanced triggers, precise targeting, and seamless controls to boost conversions and engagement.',
			'vexaltrix'
		),
		shortDesc: __( 'Advanced popup triggers and targeting options.', 'vexaltrix' ),
		features: [
			__( 'Control triggers: page load, exit intent, or custom class', 'vexaltrix' ),
			__( 'Display popups site-wide or on specific pages', 'vexaltrix' ),
			__( 'Set custom delays and frequency controls', 'vexaltrix' ),
		],
	},
	countdown: {
		image: <UpsellImage />,
		title: __( 'Get Countdown Pro', 'vexaltrix' ),
		header: __(
			'Increase urgency and boost conversions with advanced countdown timers. Perfect for sales, events, and promotions.',
			'vexaltrix'
		),
		description: __(
			'Create real-time urgency with highly customizable countdown timers, evergreen deadlines, and smart expiry options.',
			'vexaltrix'
		),
		shortDesc: __( 'Advanced countdown timers with smart options.', 'vexaltrix' ),
		features: [
			__( 'Evergreen countdown with auto-reset', 'vexaltrix' ),
			__( 'Fixed date and time countdowns', 'vexaltrix' ),
			__( 'Customizable expiry actions', 'vexaltrix' ),
		],
	},
	'image-gallery': {
		image: <UpsellImage />,
		title: __( 'Get Image Gallery Pro', 'vexaltrix' ),
		header: __(
			'Transform your image galleries into interactive experiences with custom click actions and animations.',
			'vexaltrix'
		),
		description: __(
			'Engage your audience with interactive image galleries featuring custom redirections, lightboxes, and effects.',
			'vexaltrix'
		),
		shortDesc: __( 'Clickable images with custom actions.', 'vexaltrix' ),
		features: [
			__( 'Redirect users with custom click actions', 'vexaltrix' ),
			__( 'Built-in lightbox and modal options', 'vexaltrix' ),
			__( 'Multiple layout styles and hover effects', 'vexaltrix' ),
		],
	},
	'post-grid': {
		image: <UpsellImage />,
		title: __( 'Unlock Loop Builder', 'vexaltrix' ),
		header: __( 'Customize post layouts like never before with powerful loop builder options.', 'vexaltrix' ),
		description: __(
			'Design stunning post grids with dynamic content, flexible layouts, and seamless integrations.',
			'vexaltrix'
		),
		shortDesc: __( 'Fully customizable post loops with Loop Builder.', 'vexaltrix' ),
		features: [
			__( 'Drag-and-drop design with Vexaltrix blocks', 'vexaltrix' ),
			__( 'ACF, Custom Fields, and Taxonomy integration', 'vexaltrix' ),
			__( 'Advanced filtering and sorting', 'vexaltrix' ),
		],
	},
	'dynamic-content': {
		image: <UpsellImage />,
		title: __( 'Unlock Dynamic Content Pro', 'vexaltrix' ),
		header: __(
			'Deliver personalized content dynamically based on user behavior. Make your pages more relevant and engaging.',
			'vexaltrix'
		),
		description: __(
			'Tailor content dynamically for users based on preferences, interactions, and data sources. Create truly personalized experiences.',
			'vexaltrix'
		),
		shortDesc: __( 'Experience dynamic content with Vexaltrix Pro. No more static displays.', 'vexaltrix' ),
		features: [
			__( 'Dynamic text and images from any source', 'vexaltrix' ),
			__( 'Global updates: Change once, reflect everywhere', 'vexaltrix' ),
			__( 'Smart fallback options for dynamic content', 'vexaltrix' ),
		],
	},
	slider: {
		image: <UpsellImage />,
		title: __( 'Get Slider Pro', 'vexaltrix' ),
		header: __( 'Create Stunning Sliders with Enhanced Customization', 'vexaltrix' ),
		description: __( 'Take full control over your slider designs with advanced settings.', 'vexaltrix' ),
		shortDesc: __( 'Fully customizable sliders.', 'vexaltrix' ),
		features: [
			__( 'Slide-per-view option', 'vexaltrix' ),
			__( 'Custom navigation styles', 'vexaltrix' ),
			__( 'Unique navigation slugs', 'vexaltrix' ),
		],
	},
};
