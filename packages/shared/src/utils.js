/**
 * Utility functions shared between admin and frontend.
 */

/**
 * Get the config (apiUrl, nonce, siteUrl, ...) injected into window via
 * wp_localize_script. Use the matching global name
 * (vexaltrixAdmin | vexaltrixFrontend).
 *
 * @param {('vexaltrixAdmin'|'vexaltrixFrontend')} globalName Name of the global variable on window.
 * @return {Record<string, any>} Localized config data.
 */
export function getLocalizedConfig( globalName ) {
	if ( typeof window === 'undefined' || ! window[ globalName ] ) {
		return {};
	}

	return window[ globalName ];
}

/**
 * Conditionally join class names, similar to the `clsx` library but minimal.
 *
 * @param {...(string|false|null|undefined)} classes
 * @return {string} Joined class names.
 */
export function cx( ...classes ) {
	return classes.filter( Boolean ).join( ' ' );
}

/**
 * Debounce a function — useful for search inputs, resize handlers, etc.
 *
 * @param {Function} fn
 * @param {number}   delay
 * @return {Function} Debounced function.
 */
export function debounce( fn, delay = 300 ) {
	let timeoutId;

	return function debounced( ...args ) {
		clearTimeout( timeoutId );
		timeoutId = setTimeout( () => fn.apply( this, args ), delay );
	};
}
