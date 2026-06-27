import { DynamicImage } from './assets/images';
import React from 'react';
import { __ } from '@wordpress/i18n';
import { useSelector, useDispatch } from 'react-redux';

import getApiData from '@Controls/getApiData';
import { Container, Label, Badge } from '@bsf/force-ui';
import UpgradeNotices from '@Settings/pages/settings/UpgradeToPro';

const propTypes = {};

const defaultProps = {};

export default function DynamicContent() {
	const dispatch = useDispatch();
	const dynamicContentMode = useSelector( ( state ) => state.dynamicContentMode );

	const dynamicContentHandler = ( value ) => {
		dispatch( { type: 'UPDATE_DYNAMIC_CONTENT_MODE', payload: value } );
		// Create an object with the security and value properties
		const data = {
			security: vexaltrixAdmin.dynamic_content_mode_nonce,
			value,
		};
		// Call the getApiData function with the specified parameters
		const getApiFetchData = getApiData( {
			url: vexaltrixAdmin.ajax_url,
			action: 'uag_dynamic_content_mode',
			data,
		} );
		// Wait for the API call to complete, then update the state to show a notification that the settings have been saved
		getApiFetchData.then( () => {
			dispatch( {
				type: 'UPDATE_SETTINGS_SAVED_NOTIFICATION',
				payload: __( 'Successfully saved!', 'vexaltrix' ),
			} );
		} );
	};

	const dynamicModalData = {
		title: __( 'Unlock Dynamic Content', 'vexaltrix' ),
		Image: DynamicImage,
		header: __( 'Dynamic Content, Tailored for Every Visitor', 'vexaltrix' ),
		description: __(
			'Tailored content for individual users based on their preferences and behavior anywhere on your website.',
			'vexaltrix'
		),
		features: [
			__( 'Text and images anywhere from any source', 'vexaltrix' ),
			__( 'Update once to reflect changes everywhere', 'vexaltrix' ),
			__( 'Dynamic content fallback', 'vexaltrix' ),
		],
	};

	return (
		<>
			{ vexaltrixAdmin.pro_plugin_status !== 'Activated' ? (
				<UpgradeNotices
					title={
						<div className="flex gap-2 items-center">
							{ __( 'Dynamic Content', 'vexaltrix' ) }
							<Badge
								label={ __( 'PRO', 'vexaltrix' ) }
								size="xxs"
								type="pill"
								variant="inverse"
							/>
						</div>
					}
					description={ __(
						'Choose how you want to display dynamic content settings',
						'vexaltrix'
					) }
					upgradeText={ __(
						'delivers relevant content for higher engagement.',
						'vexaltrix'
					) }
					upgradeBold={ __( 'Personalized content', 'vexaltrix' ) }
					modalData={ dynamicModalData }
					dynamicContent={ true }
				/>
			) : (
				<>
					<SettingsItem
						title={ __( 'Dynamic Content', 'vexaltrix' ) }
						settingText={ __(
							'Choose how you want to display dynamic content settings.',
							'vexaltrix'
						) }
					>
						<div
							className="flex justify-center items-center rounded-sm overflow-hidden"
							style={ { border: '1px solid #e5e7eb', borderRadius: '0.25rem' } }
						>
							<div
								onClick={ () => dynamicContentHandler( 'popup' ) }
								className={ `${
									dynamicContentMode === 'popup'
										? 'text-text-inverse bg-background-brand'
										: 'text-text-secondary'
								} p-2 cursor-pointer` }
								style={ { border: 'none', borderRight: '1px solid #e5e7eb' } }
							>
								Popup
							</div>
							<div
								onClick={ () => dynamicContentHandler( 'sidebar' ) }
								className={ `${
									dynamicContentMode === 'popup'
										? 'text-text-secondary'
										: 'text-text-inverse bg-background-brand'
								} p-2 cursor-pointer` }
								style={ { border: 'none' } }
							>
								Sidebar
							</div>
						</div>
					</SettingsItem>
					<hr className="w-full border-b-0 border-x-0 border-t border-solid border-t-border-subtle" />
				</>
			) }
		</>
	);
}

const SettingsItem = ( { title, settingText, children } ) => {
	return (
		<Container
			align="center"
			className="mb-0.5 w-full flex lg:items-center items-start justify-between lg:flex-row flex-col"
		>
			<Container.Item className="space-y-1 lg:max-w-[480px]">
				<Label className="font-semibold mb-1" htmlFor="default-width" size="md">
					{ title }
				</Label>
				<Label className="m-0 font-normal" size="sm" tag="p" variant="help">
					{ settingText }
				</Label>
			</Container.Item>

			{ children }
		</Container>
	);
};



DynamicContent.propTypes = propTypes;
DynamicContent.defaultProps = defaultProps;
