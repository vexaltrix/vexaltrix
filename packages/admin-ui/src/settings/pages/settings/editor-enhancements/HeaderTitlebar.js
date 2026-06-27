import { __ } from '@wordpress/i18n';
import { useCallback } from '@wordpress/element';
import { useSelector, useDispatch } from 'react-redux';
import { debounce } from '@Utils/Helpers';
import getApiData from '@Controls/getApiData';

import SettingsItem from '../SettingsItem';
import { Switch } from '@bsf/force-ui';

const HeaderTitlebar = () => {
	const enableHeaderTitlebar = useSelector( ( state ) => state.enableHeaderTitlebar );
	const dispatch = useDispatch();

	const headerTitlebarStatus = 'enabled' === enableHeaderTitlebar;

	// Debounce function to limit the rate of execution of a function.
	const debouncedApiCall = useCallback(
		debounce( ( status ) => {
			const data = {
				security: vexaltrixAdmin.enable_header_titlebar_nonce,
				value: status,
			};

			const getApiDataFetch = getApiData( {
				url: vexaltrixAdmin.ajax_url,
				action: 'vxt_enable_header_titlebar',
				data,
			} );

			getApiDataFetch.then( () => {} );
		}, 300 ), // Adjust the delay as needed.
		[ enableHeaderTitlebar ]
	);

	const updateHeaderTitlebarStatus = () => {
		const assetStatus = enableHeaderTitlebar === 'disabled' ? 'enabled' : 'disabled';
		dispatch( { type: 'UPDATE_ENABLE_HEADER_TITLEBAR', payload: assetStatus } );
		dispatch( { type: 'UPDATE_SETTINGS_SAVED_NOTIFICATION', payload: 'Successfully saved!' } );
		debouncedApiCall( assetStatus ); // Call the debounced function.
	};

	return (
		<>
			<SettingsItem
				title={ __( 'Move Title to Top', 'vexaltrix' ) }
				settingText={ __(
					'Move the page title to the top, allowing you to have a much more cleaner editor.',
					'vexaltrix'
				) }
			>
				<Switch
					value={ headerTitlebarStatus }
					onChange={ updateHeaderTitlebarStatus }
					size="md"
					className="vxt-remove-ring border-none"
				/>
			</SettingsItem>
			<hr className="w-full border-b-0 border-x-0 border-t border-solid border-t-border-subtle" />
		</>
	);
};

export default HeaderTitlebar;
