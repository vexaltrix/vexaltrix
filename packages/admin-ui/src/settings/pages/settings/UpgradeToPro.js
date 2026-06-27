import { __, sprintf } from '@wordpress/i18n';
import { useDispatch } from 'react-redux';
import getApiData from '@Controls/getApiData';
import { Container, Button } from '@bsf/force-ui';
import { ArrowUpRight } from 'lucide-react';
import React, { useState } from 'react';
import ProModal from '../../../common/components/ProModal';

const UpgradeNotices = ( { title, description, upgradeText, upgradeBold, modalData, dynamicContent = false } ) => {
	const dispatch = useDispatch();
	const [ isModalOpen, setIsModalOpen ] = useState( false );

	if ( vexaltrixAdmin.vexaltrix_pro_ver ) {
		return '';
	}

	const onUpgradeLinkTrigger = () => {
		window.open(
			vexaltrixAdmin.vxt_links?.setting,
			'_blank'
		);
	};

	const activatePro = ( e ) => {
		const isThisNull = vexaltrixAdmin.pro_plugin_status;

		if ( 'Install' !== isThisNull ) {
			// Create an object with the required data to activate the 'vexaltrix' Pro feature
			const data = {
				security: vexaltrixAdmin.pro_activate_nonce,
				value: 'vexaltrix',
			};
			e.target.innerText = vexaltrixAdmin.plugin_activating_text + '…';
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
			onUpgradeLinkTrigger();
		}
	};

	const getVexaltrixProTitle = () => {
		return 'Installed' === vexaltrixAdmin.pro_plugin_status
			? __( 'Activate Now', 'vexaltrix' )
			: __( 'Upgrade Now', 'vexaltrix' );
	};

	const translatedVexaltrixProTitle = sprintf(
		/* translators: abbreviation for units */
		__( '%s', 'vexaltrix' ),
		getVexaltrixProTitle()
	);

	const translatedDesc = sprintf(
		/* translators: abbreviation for units */
		__( 'You are using %1$s version, %2$s', 'vexaltrix' ),
		'<span class="text-text-primary font-medium">Free</span>',
		description
	);

	const allPlansData = {
		'Vexaltrix Pro': modalData,
		'Essential Toolkit': { ...modalData, features: [
			__( 'Vexaltrix Pro', 'vexaltrix' ),
			__( 'Astra Pro', 'vexaltrix' ),
			__( 'Premium Starter Templates', 'vexaltrix' ),
			__( 'Ultimate Addons for Elementor', 'vexaltrix' ),
			__( 'Elementor Premium Templates', 'vexaltrix' ),
			__( 'Seamless Page Building', 'vexaltrix' ),
		] },
		'Business Toolkit': { ...modalData, features: [
			__( 'Essential Toolkit', 'vexaltrix' ),
			__( 'SureFeedback', 'vexaltrix' ),
			__( 'SureWriter Pro', 'vexaltrix' ),
			__( 'SureTriggers Pro', 'vexaltrix' ),
			__( 'CartFlows Starter', 'vexaltrix' ),
			__( 'ZipWP Pro', 'vexaltrix' ),
		] },
	}

	return (
		<Container
			align="stretch"
			className="bg-background-primary rounded-lg"
			containerType="flex"
			direction="column"
			gap="sm"
			justify="start"
		>
			<div className="flex justify-between items-center">
				<Container.Item className="flex flex-col space-y-2 shrink" style={ { flexShrink: '1' } }>
					<p className="font-semibold m-0" style={ { fontSize: '1rem' } }>{ title }</p>
					{ ! dynamicContent && <p
						className="text-sm font-normal m-0 text-text-tertiary"
						dangerouslySetInnerHTML={ { __html: translatedDesc } }
					></p> }
					{ dynamicContent && <p
						className="text-sm font-normal m-0 text-text-tertiary"
					>{ description }</p> }
				</Container.Item>

				{ dynamicContent && (
					<div
						className="text-text-tertiary flex justify-center items-center rounded-sm overflow-hidden cursor-not-allowed"
						style={ { border: '1px solid #e5e7eb', borderRadius: '0.25rem' } }
					>
						<div
							className="text-text-tertiary p-2"
							style={ { border: 'none', borderRight: '1px solid #e5e7eb' } }
						>
							{ __( 'Popup', 'vexaltrix' ) }
						</div>
						<div className="text-text-tertiary p-2" style={ { border: 'none' } }>
							{ __( 'Sidebar', 'vexaltrix' ) }
						</div>
					</div>
				) }
			</div>

			<div className="flex flex-col sm:flex-row sm:items-center items-start justify-between gap-2 rounded-xl bg-[#F3F0FF] p-3" style={ { border: '1px solid #D6CDFF' } }>
				<span className="text-sm sm:flex sm:items-center sm:gap-1">
					<strong className="font-semibold">{ upgradeBold }</strong> { upgradeText }
				</span>

				<Button
					className="vxt-remove-ring items-start"
					icon={ React.cloneElement( <ArrowUpRight />, { className: 'w-3.5 h-3.5' } ) }
					iconPosition="right"
					size="xs"
					tag="button"
					type="button"
					variant="link"
					onClick={ ( e ) => {
						if ( 'Installed' === vexaltrixAdmin.pro_plugin_status ) {
							activatePro( e );
						} else {
							setIsModalOpen( true );
						}
					} }
				>
					{ translatedVexaltrixProTitle }
				</Button>
			</div>

			{ isModalOpen && (
				<ProModal setIsModalOpen={ setIsModalOpen } activatePro={ activatePro } modalData={ allPlansData } />
			) }
		</Container>
	);
};

export default UpgradeNotices;
