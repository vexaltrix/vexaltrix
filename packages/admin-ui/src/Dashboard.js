import React from 'react';
import { createRoot } from 'react-dom/client';
import '@Common/common.scss';
import SettingsWrap from '@Settings/SettingsWrap';
import { Provider } from 'react-redux';
import globalDataStore from '@Admin/store/globalDataStore';
import setInitialState  from '@Utils/setInitialState';

document.addEventListener( 'DOMContentLoaded', () => {
	const rootId = vexaltrixAdmin?.rootId || 'vxt-dashboard-app';
	const rootEl = document.getElementById( rootId );

	if ( !rootEl ) {
		console.error( `Element with id '${rootId}' not found.` );
		return;
	}

	const currentState = globalDataStore.getState();

	if ( ! currentState.initialStateSetFlag ) {

		setInitialState( globalDataStore );
	}

  	createRoot( rootEl ).render(
		<Provider store={globalDataStore}>
			<SettingsWrap/>
		</Provider>
	);
} );
