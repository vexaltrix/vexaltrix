/**
 * Tailwind config specific to the ADMIN app.
 * Extends the shared preset, only scanning content under src/admin and related packages.
 *
 * Uses `important: '#vexaltrix-admin-root'` so every Tailwind utility class
 * only "wins" within the scope of the admin app's root element, preventing
 * it from leaking out and breaking the wp-admin UI.
 *
 * @type {import('tailwindcss').Config}
 */
const preset = require( './preset' );

module.exports = {
	presets: [ preset ],
	important: '#vexaltrix-admin-root',
	content: [ '../../src/admin/**/*.{js,jsx,ts,tsx}', '../../packages/shared/src/**/*.{js,jsx,ts,tsx}' ],
};
