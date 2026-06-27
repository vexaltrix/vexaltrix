import React, { useState } from 'react';
import { Container, Button, Badge, Dialog } from '@bsf/force-ui';
import apiFetch from '@wordpress/api-fetch';
import { __, sprintf } from '@wordpress/i18n';

const ExtendWebsiteItem = ( { plugin } ) => {
	const { path, slug, siteUrl, icon, type, name, zipUrl, desc, isFree, status, settings_url } = plugin;
	const [ isDialogOpen, setIsDialogOpen ] = useState( false );
	const [ pluginData, setPluginData ] = useState( null );

	const translatedActivated = __( 'Activated', 'vexaltrix' );
	const translatedActive = __( 'Activate', 'vexaltrix' );

	const getAction = ( pluginStatus ) => {
		if ( pluginStatus === 'Activated' ) {
			return 'site_redirect';
		} else if ( pluginStatus === 'Installed' ) {
			return 'vxt_ultimate_gutenberg_blocks_recommended_plugin_activate';
		}
		return 'vxt_ultimate_gutenberg_blocks_recommended_plugin_install';
	};

	const handlePluginAction = ( e ) => {
		const action = e.currentTarget.dataset.action;
		const formData = new window.FormData();
		const currentPluginData = {
			init: e.currentTarget.dataset.init,
			type: e.currentTarget.dataset.type,
			slug: e.currentTarget.dataset.slug,
			name: e.currentTarget.dataset.pluginname,
		};

		switch ( action ) {
			case 'vxt_ultimate_gutenberg_blocks_recommended_plugin_activate':
				// Confirmation only for theme activation
				if ( currentPluginData.type === 'theme' ) {
					// Show dialog for confirmation
					setPluginData( currentPluginData );
					setIsDialogOpen( true );
				} else {
					// Directly activate for non-theme plugins
					activatePlugin( currentPluginData );
				}
				break;

			case 'vxt_ultimate_gutenberg_blocks_recommended_plugin_install':
				// Installation process without any confirmation
				formData.append(
					'action',
					currentPluginData.type === 'theme'
						? 'vxt_ultimate_gutenberg_blocks_recommended_theme_install'
						: 'vxt_ultimate_gutenberg_blocks_recommended_plugin_install'
				);
				formData.append( '_ajax_nonce', vexaltrixAdmin.installer_nonce );
				formData.append( 'slug', currentPluginData.slug );

				e.target.innerText = __( 'Installing..', 'vexaltrix' );

				apiFetch( {
					url: vexaltrixAdmin.ajax_url,
					method: 'POST',
					body: formData,
				} ).then( ( data ) => {
					if ( data.success || data.errorCode === 'folder_exists' ) {
						e.target.innerText = __( 'Installed', 'vexaltrix' );

						if ( currentPluginData.type === 'theme' ) {
							// Change button state to "Activate" after successful installation.
							const buttonElement = document.querySelector( `[data-slug="${ currentPluginData.slug }"]` );
							buttonElement.dataset.action = 'vxt_ultimate_gutenberg_blocks_recommended_plugin_activate';
							e.target.innerText = translatedActive;
						} else {
							activatePlugin( currentPluginData );
						}
					} else {
						e.target.innerText = __( 'Install', 'vexaltrix' );
					}
				} );
				break;

			case 'site_redirect':
				// Do nothing.
				break;

			default:
				// Do nothing.
				break;
		}
	};

	const activatePlugin = ( currentPluginData ) => {
		setIsDialogOpen( false );
		const formData = new window.FormData();
		formData.append( 'action', 'vxt_ultimate_gutenberg_blocks_recommended_plugin_activate' );
		formData.append( 'nonce', vexaltrixAdmin.installer_nonce );
		formData.append( 'plugin', currentPluginData.init );
		formData.append( 'type', currentPluginData.type );
		formData.append( 'slug', currentPluginData.slug );

		const buttonElement = document.querySelector( `[data-slug="${ currentPluginData.slug }"]` );
		const spanElement = buttonElement.querySelector( 'span' );

		spanElement.innerText = __( 'Activating..', 'vexaltrix' );

		apiFetch( {
			url: vexaltrixAdmin.ajax_url,
			method: 'POST',
			body: formData,
		} ).then( ( data ) => {
			if ( data.success ) {
				if ( spanElement ) {
					// Check if spanElement is not null.
					buttonElement.style.color = '#16A34A';
					buttonElement.dataset.action = 'site_redirect';
					buttonElement.classList.add( 'vxt-plugin-activated' );
					spanElement.innerText = translatedActivated;
					window.open( settings_url, '_blank' );
				}
			} else {
				const button = document.querySelector( `[data-slug="${ pluginData.slug }"]` );
				if ( button ) {
					// Check if buttonElement is not null.
					const span = button.querySelector( 'span' );
					if ( span ) {
						// Check if spanElement is not null.
						span.innerText = translatedActive;
					}
				}
			}
		} );
	};

	const getStatusLabel = ( pluginStatus ) => {
		if ( pluginStatus === 'Activated' ) {
			return translatedActivated;
		}

		if ( pluginStatus === 'Installed' ) {
			return translatedActive;
		}

		return pluginStatus;
	};

	const translatedName = sprintf(
		/* translators: abbreviation for units */ __( '%s', 'vexaltrix' ),
		name
	)

	const translatedDesc = sprintf(
		/* translators: abbreviation for units */ __( '%s', 'vexaltrix' ),
		desc
	)

	return (
		<Container align="center" containerType="flex" direction="column" justify="between">
			<div className="flex items-center justify-between w-full">
				<div className="h-5 w-5 icon">{ icon() }</div>

				<div className="flex items-center justify-between gap-2">
					{ isFree && (
						<Badge
							label={ __( 'Free', 'vexaltrix' ) }
							size="xs"
							type="pill"
							variant="green"
						/>
					) }
					<Button
						size="xs"
						variant="link"
						className="cursor-pointer vxt-remove-ring"
						onClick={ handlePluginAction } // Trigger action on click
						data-plugin={ zipUrl }
						data-type={ type }
						data-pluginname={ name }
						data-slug={ slug }
						data-site={ siteUrl }
						data-init={ path }
						data-action={ getAction( status ) }
						style={ {
							color: status === 'Activated' ? '#16A34A' : '#6005FF',
						} }
					>
						{ getStatusLabel( status ) }
					</Button>
					<Dialog design="simple" open={ isDialogOpen } setOpen={ setIsDialogOpen }>
						<Dialog.Backdrop />
						<Dialog.Panel>
							<Dialog.Header>
								<div className="flex items-center justify-between">
									<Dialog.Title>
										{ __( 'Activate Theme', 'vexaltrix' ) }
									</Dialog.Title>
								</div>
								<Dialog.Description>
									{ __(
										'Are you sure you want to switch your current theme to Astra?',
										'vexaltrix'
									) }
								</Dialog.Description>
							</Dialog.Header>
							<Dialog.Footer>
								<Button onClick={ () => activatePlugin( pluginData ) } className="vxt-remove-ring">
									{ __( 'Yes', 'vexaltrix' ) }
								</Button>
								<Button variant="outline" onClick={ () => setIsDialogOpen( false ) } className="vxt-remove-ring">
									{ __( 'Close', 'vexaltrix' ) }
								</Button>
							</Dialog.Footer>
						</Dialog.Panel>
					</Dialog>
				</div>
			</div>

			<div className="flex flex-col w-full">
				<div
					className="text-sm font-medium text-text-primary pb-1 m-0 cursor-pointer"
					onClick={ () => window.open( plugin.siteurl, '_blank' ) }
				>
					{ translatedName }
				</div>
				<p className="text-sm font-medium text-text-tertiary m-0">
					{ translatedDesc }
				</p>
			</div>
		</Container>
	);
};

export default ExtendWebsiteItem;
