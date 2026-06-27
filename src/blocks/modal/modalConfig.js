import { __ } from '@wordpress/i18n';

// when click for first time on button this defaultContent will get loaded.
export const defaultContent = [
	[
		'vexaltrix/info-box',
		{
			icon: 'circle-check',
			iconBottomMargin: 15,
			infoBoxTitle: __( 'Engage Your Visitors!', 'vexaltrix' ),
			headFontWeight: 500,
			headSpace: 10,
			headingDesc: __(
				'Click here to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis pulvinar dapibus.',
				'vexaltrix'
			),
			subHeadSpace: 30,
			ctaType: 'button',
			btnBorderStyle: 'none',
			showCtaIcon: false,
			ctaText: __( 'Call To Action', 'vexaltrix' ),
			paddingBtnTop: 14,
			paddingBtnRight: 28,
			paddingBtnBottom: 14,
			paddingBtnLeft: 28,
			btnBorderTopLeftRadius: 3,
			btnBorderTopRightRadius: 3,
			btnBorderBottomLeftRadius: 3,
			btnBorderBottomRightRadius: 3,
		},
	],
];

// excludeBlocks are blocks that restricted to use as child block inside Modal.
export const excludeBlocks = [
	'vexaltrix/modal',
	// Vexaltrix Child Blocks.
	'vexaltrix/how-to-step',
	'vexaltrix/buttons-child',
	'vexaltrix/faq-child',
	'vexaltrix/content-timeline-child',
	'vexaltrix/icon-list-child',
	'vexaltrix/social-share-child',
	'vexaltrix/restaurant-menu-child',
	'vexaltrix/tabs-child',
	'vexaltrix/post-image',
	'vexaltrix/post-taxonomy',
	'vexaltrix/post-title',
	'vexaltrix/post-meta',
	'vexaltrix/post-excerpt',
	'vexaltrix/post-button',
	'vexaltrix/forms-name',
	'vexaltrix/forms-email',
	'vexaltrix/forms-hidden',
	'vexaltrix/forms-phone',
	'vexaltrix/forms-textarea',
	'vexaltrix/forms-url',
	'vexaltrix/forms-select',
	'vexaltrix/forms-radio',
	'vexaltrix/forms-checkbox',
	'vexaltrix/forms-toggle',
	'vexaltrix/forms-date',
	'vexaltrix/forms-accept',
	'vexaltrix/slider-child',
	// Vexaltrix Pro Child Blocks.
	'vexaltrix/register-email',
	'vexaltrix/register-first-name',
	'vexaltrix/register-last-name',
	'vexaltrix/register-password',
	'vexaltrix/register-reenter-password',
	'vexaltrix/register-terms',
	'vexaltrix/register-username',
];
