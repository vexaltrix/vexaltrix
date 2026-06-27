import React, { useEffect, useState } from 'react';
import { Button } from '@bsf/force-ui';
import { Check, X } from 'lucide-react';
import { __, sprintf } from '@wordpress/i18n';
import { sections } from './featuresData';
import { useDispatch } from 'react-redux';
import getApiData from '@Controls/getApiData';
import './Compare.scss';

const Compare = () => {
	const dispatch = useDispatch();

	const [ buttonText, setButtonText ] = useState();

	useEffect( () => {
		const currentButtonText = sprintf(
			/* translators: abbreviation for units */ __( '%s', 'vexaltrix' ),
			getVexaltrixProTitle()
		);

		setButtonText( currentButtonText );
	}, [] );

	// Function to open the pricing page in a new tab when the "Upgrade Now" button is clicked.
	const onUpgradeNowClick = () => {
		window.open(
			vexaltrixAdmin.vxt_links?.freeVsPro,
			'_blank'
		);
	};

	const getVexaltrixProTitle = () => {
		return 'Installed' === vexaltrixAdmin.pro_plugin_status
			? __( 'Activate Now', 'vexaltrix' )
			: __( 'Get Vexaltrix Pro Now', 'vexaltrix' );
	};

	const activatePro = () => {
		const isThisNull = vexaltrixAdmin.pro_plugin_status;

		if ( 'Install' !== isThisNull ) {
			// Create an object with the required data to activate the 'vexaltrix' Pro feature
			const data = {
				security: vexaltrixAdmin.pro_activate_nonce,
				value: 'vexaltrix',
			};
			setButtonText( vexaltrixAdmin.plugin_activating_text );
			// Call the getApiData function with the specified parameters
			const getApiFetchData = getApiData( {
				url: vexaltrixAdmin.ajax_url,
				action: 'vxt_pro_activate',
				data,
			} );

			// Wait for the API call to complete, update the state to show a notification, and reload the page
			getApiFetchData.then( () => {
				dispatch( { type: 'UPDATE_SETTINGS_SAVED_NOTIFICATION', payload: 'Vexaltrix Pro Activated!' } );
				setTimeout( () => {
					window.location.reload();
				}, 500 );
			} );
		} else {
			onUpgradeNowClick();
		}
	};

	const renderIcon = ( isAvailable ) => ( isAvailable ? <Check color="#16A34A" /> : <X color="#DC2626" /> );

	const getLabel = ( item, type ) => {
		if ( item.id === 10 && item.content === __( 'Navigation Menu', 'vexaltrix' ) ) {
			if ( type === 'pro' ) {
				return item.iconPro
					? __( 'Advanced', 'vexaltrix' )
					: __( 'Basic', 'vexaltrix' );
			}
			return item.iconPro
				? __( 'Basic', 'vexaltrix' )
				: __( 'Advanced', 'vexaltrix' );
		}
		return type === 'pro' ? renderIcon( item.iconFree ) : renderIcon( item.iconPro );
	};

	const renderItems = ( items ) =>
		items.map( ( item, idx ) => (
			<>
				<div key={ item.id } className="flex fle-row p-3 items-center justify-between gap-8 rounded-lg">
					<p className="text-sm text-text-secondary font-normal">{ item.content }</p>
					<div className="flex flex-row items-center justify-between lg:gap-36 md:gap-32 sm:gap-24 gap-10">
						<div className="text-sm text-text-primary font-medium flex justify-center items-center">
							{ getLabel( item, 'pro' ) }
						</div>
						<div className="text-sm text-text-primary font-medium flex justify-center items-center">
							{ getLabel( item, 'free' ) }
						</div>
					</div>
				</div>
				{ idx !== items.length - 1 ? (
					<hr className="w-full border-b-0 border-x-0 border-t border-solid border-t-border-subtle" />
				) : (
					<hr className="w-full border-b-0 border-x-0 border-t border-solid border-t-white mb-0" />
				) }
			</>
		) );

	return (
		<div
			className="rounded-lg bg-white w-full border-border-subtle mb-8 shadow-sm"
			style={ { border: '1px solid rgb(229, 231, 235)' } }
		>
			<div
				className="flex flex-col sm:flex-row custom:flex-col sm:items-center items-start custom:items-start justify-between sm:gap-0 gap-4 custom:gap-4 p-5"
				style={ { paddingBottom: '0' } }
			>
				<div className="flex flex-col">
					<div className="m-0 text-xl font-semibold sm:pt-4 custom:pt-0 pt-0 text-text-primary">
						{ __( 'Free VS Pro', 'vexaltrix' ) }
					</div>
					<p className="m-0 text-sm font-normal pt-1 text-text-secondary">
						{ __(
							'Compare the features to find the best option for your website.',
							'vexaltrix'
						) }
					</p>
				</div>
				<div className="flex items-center sm:p-1 p-0">
					{ vexaltrixAdmin.pro_plugin_status !== 'Activated' && (
						<Button
							iconPosition="right"
							variant="primary"
							style={ {
								color: 'white',
								transition: 'color 0.3s ease, border-color 0.3s ease',
								backgroundColor: '#6005ff',
								// fontSize: '16px',
								fontWeight: '600',
								// padding: '12px 16px',
							} }
							className="vxt-remove-ring text-[#6005FF] text-base px-4 py-3"
							onClick={ () => activatePro() }
						>
							{ buttonText }
						</Button>
					) }
				</div>
			</div>
			<div className="px-4 pb-4">
				<div className="flex flex-col pt-4">
					{ sections.map( ( section, idx ) => (
						<React.Fragment key={ section.title }>
							<div
								className={ `flex fle-row p-3 items-center justify-between rounded-lg ${
									idx !== 0 && 'mt-4'
								}` }
								style={ { backgroundColor: '#F9FAFB' } }
							>
								<p className="text-sm text-text-primary font-medium">{ section.title }</p>
								<div className="flex flex-row items-center lg:gap-36 md:gap-32 sm:gap-24 gap-10">
									<p className="text-sm text-text-primary font-medium">
										{ __( 'Free', 'vexaltrix' ) }
									</p>
									<p
										className="text-sm text-text-primary font-medium"
										style={ { marginRight: '50px' } }
									>
										{ __( 'Pro', 'vexaltrix' ) }
									</p>
								</div>
							</div>
							{ renderItems( section.items ) }
						</React.Fragment>
					) ) }
				</div>
			</div>
		</div>
	);
};

export default Compare;
