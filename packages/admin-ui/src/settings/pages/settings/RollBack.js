import React, { useState } from 'react';
import { __, sprintf } from '@wordpress/i18n';
import RollBackConfirmPopup from './RollBackConfirmPopup';
import { Container, Label } from '@bsf/force-ui';
// import ConfirmationPopup from '@Common/components/ConfirmationPopup';

const RollBack = () => {
	const previousVersions = Array.isArray( vexaltrixAdmin?.global_data?.uag_previous_versions )
		? vexaltrixAdmin.global_data.uag_previous_versions
		: [];
	const hasPreviousVersions = previousVersions.length > 0;

	const [ previousVersionSelect, setPreviousVersion ] = useState( previousVersions[ 0 ]?.value || '' );
	const [ openPopup, setopenPopup ] = useState( false );
	const [ confirmPopup, setconfirmPopup ] = useState( false );

	const rollbackButtonClickHandler = () => {
		setopenPopup( true );
	};

	return (
		<>
			<SettingsItem
				title={ __( 'Rollback to Previous Version', 'vexaltrix' ) }
				settingText={ sprintf(
					/* translators: abbreviation for units */
					__(
						'Experiencing an issue with Vexaltrix version %s? Roll back to a previous version to help troubleshoot the issue.',
						'vexaltrix'
					),
					vexaltrixAdmin.plugin_ver
				) }
			>
				<div className="flex items-center">
					<select
						id="location"
						name="location"
						className="block h-9 mr-2 sm:text-sm vexaltrix-admin__input-field vexaltrix-admin__dropdown"
						disabled={ ! hasPreviousVersions }
						value={ previousVersionSelect }
						onBlur={ ( e ) => {
							setPreviousVersion( e.target.value );
						} }
						onChange={ ( e ) => {
							setPreviousVersion( e.target.value );
						} }
					>
						{ ! hasPreviousVersions && (
							<option value="">{ __( 'No previous versions available', 'vexaltrix' ) }</option>
						) }
						{ previousVersions.map( ( version ) => {
							return (
								<option key={ version.value } value={ version.value }>
									{ version.label }
								</option>
							);
						} ) }
					</select>
					<button
						type="button"
						className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-vexaltrix transition focus:bg-vexaltrix-hover hover:bg-vexaltrix-hover focus:outline-none h-9 cursor-pointer"
						onClick={ rollbackButtonClickHandler }
						disabled={ ! hasPreviousVersions }
					>
						{ confirmPopup && (
							<svg
								className="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
								xmlns="http://www.w3.org/2000/svg"
								fill="none"
								viewBox="0 0 24 24"
							>
								<circle
									className="opacity-25"
									cx="12"
									cy="12"
									r="10"
									stroke="currentColor"
									strokeWidth="4"
								></circle>
								<path
									className="opacity-75"
									fill="currentColor"
									d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
								></path>
							</svg>
						) }
						{ __( 'Rollback', 'vexaltrix' ) }
					</button>
				</div>
			</SettingsItem>

			<hr className="w-full border-b-0 border-x-0 border-t border-solid border-t-border-subtle" />

			<RollBackConfirmPopup
				{ ...{
					openPopup,
					setopenPopup,
					previousVersionSelect,
					setconfirmPopup,
					popupContent: {
						title: __( 'Rollback to Previous Version', 'vexaltrix' ),
						description: sprintf(
							// translators: %1$s: selected version of Vexaltrix.
							__(
								'Are you sure you want to rollback to Vexaltrix v%1$s?',
								'vexaltrix'
							),
							previousVersionSelect
						),
					},
					popupAccept: {
						label: __( 'Rollback', 'vexaltrix' ),
					},
					popupCancel: {
						label: __( 'Cancel', 'vexaltrix' ),
					},
				} }
			/>
		</>
	);
};

const SettingsItem = ( { title, settingText, currentSetting, children } ) => {
	return (
		<Container
			align="center"
			className="mb-0.5 w-full flex justify-between flex-col lg:flex-row lg:items-center items-start"
		>
			<Container.Item className="space-y-1 max-w-[360px]">
				<Label className="font-semibold mb-1" htmlFor="default-width" size="md">
					{ title }
				</Label>
				<Label className="m-0 font-normal" size="sm" tag="p" variant="help">
					{ settingText }
				</Label>
				{ currentSetting && (
					<Label className="m-0 italic font-normal" size="sm" tag="p" variant="help">
						{ currentSetting }
					</Label>
				) }
			</Container.Item>

			{ children }
		</Container>
	);
};

export default RollBack;
