import { __ } from '@wordpress/i18n';
import { useSelector, useDispatch } from 'react-redux';
import getApiData from '@Controls/getApiData';
import { Container, Label, Switch } from '@bsf/force-ui';
import { VXT_LINKS } from '@Store/constants';

const BSFAnalyticsOption = () => {

	const dispatch = useDispatch();

	const enableBSFAnalyticsOption = useSelector( ( state ) => state.enableBSFAnalyticsOption );
	const enableBSFAnalyticsOptionStatus = 'no' === enableBSFAnalyticsOption ? false : true;

	const updateEnableBSFAnalyticsOptionStatus = () => {

		let assetStatus;
		if ( enableBSFAnalyticsOption === 'no' ) {
			assetStatus = 'yes';
		} else {
			assetStatus = 'no';
		}

		dispatch( { type: 'UPDATE_ENABLE_BSF_ANALYTICS_OPTION', payload: assetStatus } );

		// Create an object with the security and value properties
		const data = {
			security: vexaltrixAdmin.enable_bsf_analytics_option_nonce,
			value: assetStatus,
		};
		// Call the getApiData function with the specified parameters
		const getApiFetchData = getApiData( {
			url: vexaltrixAdmin.ajax_url,
			action: 'vxt_enable_bsf_analytics_option',
			data,
		} );
		// Wait for the API call to complete, then update the state to show a notification that the settings have been saved
		getApiFetchData.then( () => {
			dispatch( { type: 'UPDATE_SETTINGS_SAVED_NOTIFICATION', payload: __( 'Successfully saved!', 'vexaltrix' ) } );
		} );
	};

	const renderText = () => (
		<p className='m-0'>
			{__( 'Help shape the future of Vexaltrix. Share how you use the plugin so we can build features that matter, fix issues faster, and make smarter decisions.', 'vexaltrix' )}
			{' '}
			<a
				href={ `${ VXT_LINKS.VXT_STORE_URL }/usage-tracking/?utm_source=vexaltrix_dashboard&utm_medium=settings&utm_campaign=usage_tracking` }
				target="_blank"
				rel="noreferrer"
				className="text-vexaltrix focus:text-vexaltrix-hover active:text-vexaltrix-hover hover:text-vexaltrix-hover"
			>
				{__( 'Learn more.', 'vexaltrix' )}
			</a>
		</p>
	);

	return (
		<SettingsItem
			title={__( 'Contribute to Vexaltrix', 'vexaltrix' )}
			settingText={renderText}
		>
			<Switch
				value={enableBSFAnalyticsOptionStatus}
				onChange={updateEnableBSFAnalyticsOptionStatus}
				size="md"
				className="vxt-remove-ring border-none"
			/>
		</SettingsItem>
	);
};
const SettingsItem = ( { title, settingText, children } ) => {
	return (
		<Container
			align="center"
			className="mb-0.5 w-full flex justify-between lg:flex-row flex-col lg:items-center items-start"
		>
			<Container.Item className="space-y-1 lg:max-w-[480px]">
				<Label className="font-semibold mb-1" htmlFor="default-width" size="md">
					{title}
				</Label>
				{settingText && (
				<Label className="m-0 font-normal" size="sm" tag="p" variant="help">
					{settingText()}
				</Label>
				)}
			</Container.Item>

			{children}
		</Container>
	);
};
export default BSFAnalyticsOption;
