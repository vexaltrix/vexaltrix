/**
 * Tailwind config specific to the FRONTEND.
 * Extends the shared preset, only scanning content under src/frontend and related packages.
 *
 * Uses `prefix: 'vxl-'` so every generated utility class has its own
 * prefix (e.g. vxl-flex, vxl-text-vxl-primary-500), avoiding conflicts
 * with the CSS of whatever theme is currently active on the frontend.
 *
 * @type {import('tailwindcss').Config}
 */
const preset = require( './preset' );

module.exports = {
	presets: [ preset ],
	prefix: 'vxl-',
	content: [
		'../../src/frontend/**/*.{js,jsx,ts,tsx}',
		'../../packages/shared/src/**/*.{js,jsx,ts,tsx}',
		'../../packages/blocks/src/**/*.{js,jsx,ts,tsx}',
	],
};
