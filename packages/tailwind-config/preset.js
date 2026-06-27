/**
 * Shared preset for both admin and frontend.
 *
 * IMPORTANT: corePlugins.preflight = false so Tailwind does not reset
 * global styles (which would break the native UI of wp-admin / the theme).
 *
 * @type {import('tailwindcss').Config}
 */
module.exports = {
	content: [],
	corePlugins: {
		preflight: false,
	},
	theme: {
		extend: {
			colors: {
				'vxl-primary': {
					50: '#eef6ff',
					100: '#d9ecff',
					200: '#bcdcff',
					300: '#8ec5ff',
					400: '#58a4ff',
					500: '#2f80ff',
					600: '#175ff2',
					700: '#124ad6',
					800: '#163fad',
					900: '#173a89',
					950: '#112454',
				},
				'vxl-surface': '#ffffff',
				'vxl-muted': '#6b7280',
			},
			fontFamily: {
				sans: [
					'-apple-system',
					'BlinkMacSystemFont',
					'"Segoe UI"',
					'Roboto',
					'Helvetica',
					'Arial',
					'sans-serif',
				],
			},
			borderRadius: {
				vxl: '0.5rem',
			},
			boxShadow: {
				vxl: '0 1px 2px 0 rgb(0 0 0 / 0.05), 0 1px 3px 0 rgb(0 0 0 / 0.06)',
			},
		},
	},
	plugins: [],
};
