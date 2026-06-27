/**
 * Hook for calling the plugin's settings REST API (GET + POST).
 * Uses @wordpress/api-fetch, which automatically attaches the nonce (X-WP-Nonce).
 */

import apiFetch from '@wordpress/api-fetch';
import { useCallback, useEffect, useState } from '@wordpress/element';
import { ENDPOINTS } from '../constants';

/**
 * @return {{
 *   settings: Record<string, any>,
 *   isLoading: boolean,
 *   isSaving: boolean,
 *   error: Error|null,
 *   updateSettings: (data: Record<string, any>) => Promise<void>,
 *   refetch: () => Promise<void>,
 * }} Settings state and helpers.
 */
export function useSettings() {
	const [ settings, setSettings ] = useState( {} );
	const [ isLoading, setIsLoading ] = useState( true );
	const [ isSaving, setIsSaving ] = useState( false );
	const [ error, setError ] = useState( null );

	const fetchSettings = useCallback( async () => {
		setIsLoading( true );
		setError( null );

		try {
			const response = await apiFetch( { path: `/${ ENDPOINTS.SETTINGS }` } );
			setSettings( response?.data ?? {} );
		} catch ( err ) {
			setError( err );
		} finally {
			setIsLoading( false );
		}
	}, [] );

	const updateSettings = useCallback( async ( data ) => {
		setIsSaving( true );
		setError( null );

		try {
			const response = await apiFetch( {
				path: `/${ ENDPOINTS.SETTINGS }`,
				method: 'POST',
				data,
			} );
			setSettings( response?.data ?? {} );
		} catch ( err ) {
			setError( err );
			throw err;
		} finally {
			setIsSaving( false );
		}
	}, [] );

	useEffect( () => {
		fetchSettings();
	}, [ fetchSettings ] );

	return {
		settings,
		isLoading,
		isSaving,
		error,
		updateSettings,
		refetch: fetchSettings,
	};
}
