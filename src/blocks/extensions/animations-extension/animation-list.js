/**
 * EXTENSION: Animations Extension - List of animations available.
 */

import { __ } from '@wordpress/i18n';

export const AnimationList = [
	// None.
	{ value: '', label: __( 'None', 'vexaltrix' ) },

	// Fade.
	{
		label: __( 'Fade', 'vexaltrix' ),
		options: [
			{ value: 'fade', label: __( 'Fade', 'vexaltrix' ) },
			{ value: 'fade-down', label: __( 'Fade Down', 'vexaltrix' ) },
			{ value: 'fade-up', label: __( 'Fade Up', 'vexaltrix' ) },
			{ value: 'fade-left', label: __( 'Fade Left', 'vexaltrix' ) },
			{ value: 'fade-right', label: __( 'Fade Right', 'vexaltrix' ) },
		],
	},

	// Flip.
	{
		label: __( 'Flip', 'vexaltrix' ),
		options: [
			{ value: 'flip-down', label: __( 'Flip Down', 'vexaltrix' ) },
			{ value: 'flip-up', label: __( 'Flip Up', 'vexaltrix' ) },
			{ value: 'flip-left', label: __( 'Flip Left', 'vexaltrix' ) },
			{ value: 'flip-right', label: __( 'Flip Right', 'vexaltrix' ) },
		],
	},

	// Slide.
	{
		label: __( 'Slide', 'vexaltrix' ),
		options: [
			{ value: 'slide-down', label: __( 'Slide Down', 'vexaltrix' ) },
			{ value: 'slide-up', label: __( 'Slide Up', 'vexaltrix' ) },
			{ value: 'slide-left', label: __( 'Slide Left', 'vexaltrix' ) },
			{ value: 'slide-right', label: __( 'Slide Right', 'vexaltrix' ) },
		],
	},

	// Zoom-In.
	{
		label: __( 'Zoom-In', 'vexaltrix' ),
		options: [
			{ value: 'zoom-in', label: __( 'Zoom-In', 'vexaltrix' ) },
			{ value: 'zoom-in-down', label: __( 'Zoom-In Down', 'vexaltrix' ) },
			{ value: 'zoom-in-up', label: __( 'Zoom-In Up', 'vexaltrix' ) },
			{ value: 'zoom-in-left', label: __( 'Zoom-In Left', 'vexaltrix' ) },
			{ value: 'zoom-in-right', label: __( 'Zoom-In Right', 'vexaltrix' ) },
		],
	},

	// Zoom-Out.
	{
		label: __( 'Zoom-Out', 'vexaltrix' ),
		options: [
			{ value: 'zoom-out', label: __( 'Zoom-Out', 'vexaltrix' ) },
			{ value: 'zoom-out-down', label: __( 'Zoom-Out Down', 'vexaltrix' ) },
			{ value: 'zoom-out-up', label: __( 'Zoom-Out Up', 'vexaltrix' ) },
			{ value: 'zoom-out-left', label: __( 'Zoom-Out Left', 'vexaltrix' ) },
			{ value: 'zoom-out-right', label: __( 'Zoom-Out Right', 'vexaltrix' ) },
		],
	},
];

export const AnimationSelectControlObject = {
	// None.
	none: { value: '', label: __( 'None', 'vexaltrix' ) },

	// Fade.
	fade: { value: 'fade', label: __( 'Fade', 'vexaltrix' ) },
	'fade-down': { value: 'fade-down', label: __( 'Fade Down', 'vexaltrix' ) },
	'fade-up': { value: 'fade-up', label: __( 'Fade Up', 'vexaltrix' ) },
	'fade-left': { value: 'fade-left', label: __( 'Fade Left', 'vexaltrix' ) },
	'fade-right': { value: 'fade-right', label: __( 'Fade Right', 'vexaltrix' ) },

	// Flip.
	'flip-down': { value: 'flip-down', label: __( 'Flip Down', 'vexaltrix' ) },
	'flip-up': { value: 'flip-up', label: __( 'Flip Up', 'vexaltrix' ) },
	'flip-left': { value: 'flip-left', label: __( 'Flip Left', 'vexaltrix' ) },
	'flip-right': { value: 'flip-right', label: __( 'Flip Right', 'vexaltrix' ) },

	// Slide.
	'slide-down': { value: 'slide-down', label: __( 'Slide Down', 'vexaltrix' ) },
	'slide-up': { value: 'slide-up', label: __( 'Slide Up', 'vexaltrix' ) },
	'slide-left': { value: 'slide-left', label: __( 'Slide Left', 'vexaltrix' ) },
	'slide-right': { value: 'slide-right', label: __( 'Slide Right', 'vexaltrix' ) },

	// Zoom.
	'zoom-in': { value: 'zoom-in', label: __( 'Zoom-In', 'vexaltrix' ) },
	'zoom-in-down': { value: 'zoom-in-down', label: __( 'Zoom-In Down', 'vexaltrix' ) },
	'zoom-in-up': { value: 'zoom-in-up', label: __( 'Zoom-In Up', 'vexaltrix' ) },
	'zoom-in-left': { value: 'zoom-in-left', label: __( 'Zoom-In Left', 'vexaltrix' ) },
	'zoom-in-right': { value: 'zoom-in-right', label: __( 'Zoom-In Right', 'vexaltrix' ) },

	'zoom-out': { value: 'zoom-out', label: __( 'Zoom-Out', 'vexaltrix' ) },
	'zoom-out-down': { value: 'zoom-out-down', label: __( 'Zoom-Out Down', 'vexaltrix' ) },
	'zoom-out-up': { value: 'zoom-out-up', label: __( 'Zoom-Out Up', 'vexaltrix' ) },
	'zoom-out-left': { value: 'zoom-out-left', label: __( 'Zoom-Out Left', 'vexaltrix' ) },
	'zoom-out-right': { value: 'zoom-out-right', label: __( 'Zoom-Out Right', 'vexaltrix' ) },
};
