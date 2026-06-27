import { ToggleControl, SelectControl, ExternalLink } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
const { enableConditionsForCoreBlocks, enableResponsiveConditionsForCoreBlocks } =
	vxt_ultimate_gutenberg_blocks_blocks_info;
import { useEffect } from '@wordpress/element';
import classnames from 'classnames';
import { updateUAGDay } from '@Utils/Helpers';
import { VXT_LINKS } from '@Store/constants';

const UserConditionOptions = ( props ) => {
	const { attributes, setAttributes } = props;
	const { UAGLoggedIn, UAGLoggedOut, UAGDisplayConditions, UAGSystem, Vexaltrixrowser, UAGUserRole, UAGDay } = attributes;

	const options = [
		{ value: 'monday', label: __( 'Monday', 'vexaltrix' ) },
		{ value: 'tuesday', label: __( 'Tuesday', 'vexaltrix' ) },
		{ value: 'wednesday', label: __( 'Wednesday', 'vexaltrix' ) },
		{ value: 'thursday', label: __( 'Thursday', 'vexaltrix' ) },
		{ value: 'friday', label: __( 'Friday', 'vexaltrix' ) },
		{ value: 'saturday', label: __( 'Saturday', 'vexaltrix' ) },
		{ value: 'sunday', label: __( 'Sunday', 'vexaltrix' ) },
	];

	const handleChange = ( e ) => {
		const { value, checked } = e.target;
		setAttributes( {
			UAGDay: checked ? [ ...UAGDay, value ] : updateUAGDay( UAGDay, value ),
		} );
	};

	return (
		<>
			<SelectControl
				label={ __( 'Display Conditions', 'vexaltrix' ) }
				value={ UAGDisplayConditions }
				onChange={ ( value ) => setAttributes( { UAGDisplayConditions: value } ) }
				options={ [
					{ value: 'none', label: __( 'None', 'vexaltrix' ) },
					{ value: 'userstate', label: __( 'User State', 'vexaltrix' ) },
					{ value: 'userRole', label: __( 'User Role', 'vexaltrix' ) },
					{ value: 'browser', label: __( 'Browser', 'vexaltrix' ) },
					{ value: 'os', label: __( 'Operating System', 'vexaltrix' ) },
					{ value: 'day', label: __( 'Day', 'vexaltrix' ) },
				] }
			/>
			{ UAGDisplayConditions === 'userstate' && (
				<>
					<ToggleControl
						label={ __( 'Hide From Logged In Users', 'vexaltrix' ) }
						checked={ UAGLoggedIn }
						onChange={ () => setAttributes( { UAGLoggedIn: ! attributes.UAGLoggedIn } ) }
					/>
					<ToggleControl
						label={ __( 'Hide From Logged Out Users', 'vexaltrix' ) }
						checked={ UAGLoggedOut }
						onChange={ () => setAttributes( { UAGLoggedOut: ! attributes.UAGLoggedOut } ) }
					/>
				</>
			) }
			{ UAGDisplayConditions === 'os' && (
				<>
					<SelectControl
						label={ __( 'Hide on Operating System', 'vexaltrix' ) }
						value={ UAGSystem }
						onChange={ ( value ) => setAttributes( { UAGSystem: value } ) }
						options={ [
							{ value: '', label: __( 'None', 'vexaltrix' ) },
							{ value: 'iphone', label: __( 'iOS', 'vexaltrix' ) },
							{ value: 'android', label: __( 'Android', 'vexaltrix' ) },
							{ value: 'windows', label: __( 'Windows', 'vexaltrix' ) },
							{ value: 'open_bsd', label: __( 'OpenBSD', 'vexaltrix' ) },
							{ value: 'sun_os', label: __( 'SunOS', 'vexaltrix' ) },
							{ value: 'linux', label: __( 'Linux', 'vexaltrix' ) },
							{ value: 'mac_os', label: __( 'Mac OS', 'vexaltrix' ) },
						] }
					/>
				</>
			) }
			{ UAGDisplayConditions === 'browser' && (
				<>
					<SelectControl
						label={ __( 'Hide on Browser', 'vexaltrix' ) }
						value={ Vexaltrixrowser }
						onChange={ ( value ) => setAttributes( { Vexaltrixrowser: value } ) }
						options={ [
							{ value: '', label: __( 'None', 'vexaltrix' ) },
							{ value: 'firefox', label: __( 'Mozilla Firefox', 'vexaltrix' ) },
							{ value: 'chrome', label: __( 'Google Chrome', 'vexaltrix' ) },
							{ value: 'opera_mini', label: __( 'Opera Mini', 'vexaltrix' ) },
							{ value: 'opera', label: __( 'Opera', 'vexaltrix' ) },
							{ value: 'safari', label: __( 'Safari', 'vexaltrix' ) },
							{ value: 'edge', label: __( 'Microsoft Edge', 'vexaltrix' ) },
						] }
					/>
				</>
			) }
			{ UAGDisplayConditions === 'userRole' && (
				<>
					<SelectControl
						label={ __( 'Hide for User Role', 'vexaltrix' ) }
						value={ UAGUserRole }
						onChange={ ( value ) => setAttributes( { UAGUserRole: value } ) }
						options={ vxt_ultimate_gutenberg_blocks_blocks_info.user_role }
					/>
				</>
			) }
			{ UAGDisplayConditions === 'day' && (
				<>
					<p>Select days you want to disable.</p>
					{ options.map( ( o, index ) => {
						return (
							<label key={ index } className="form-check-label" htmlFor="flexCheckDefault">
								<input
									type="checkbox"
									className="vxt-forms-checkbox"
									name={ o.value }
									value={ o.value }
									sunday
									onChange={ handleChange }
									checked={ UAGDay?.includes( o.value ) ? true : false }
								/>
								{ o.label }
							</label>
						);
					} ) }
				</>
			) }
		</>
	);
};

const UserResponsiveConditionOptions = ( props ) => {
	const { attributes, setAttributes } = props;
	const { UAGHideDesktop, UAGHideMob, UAGHideTab, UAGResponsiveConditions, UAGDisplayConditions } = attributes;

	useEffect( () => {
		if ( 'responsiveVisibility' !== UAGDisplayConditions && ! UAGResponsiveConditions ) {
			setAttributes( {
				UAGHideDesktop: false,
				UAGHideTab: false,
				UAGHideMob: false,
			} );
		}
	}, [] );

	return (
		<>
			<hr className="vxt-editor__separator" />
			<p className="components-base-control__label">{ __( 'Responsive Conditions', 'vexaltrix' ) }</p>
			<>
				<ToggleControl
					label={ __( 'Hide on Desktop', 'vexaltrix' ) }
					checked={ UAGHideDesktop }
					onChange={ () =>
						setAttributes( {
							UAGHideDesktop: ! attributes.UAGHideDesktop,
							UAGResponsiveConditions: true,
						} )
					}
				/>
				<ToggleControl
					label={ __( 'Hide on Tablet', 'vexaltrix' ) }
					checked={ UAGHideTab }
					onChange={ () =>
						setAttributes( {
							UAGHideTab: ! attributes.UAGHideTab,
							UAGResponsiveConditions: true,
						} )
					}
				/>
				<ToggleControl
					label={ __( 'Hide on Mobile', 'vexaltrix' ) }
					checked={ UAGHideMob }
					onChange={ () =>
						setAttributes( {
							UAGHideMob: ! attributes.UAGHideMob,
							UAGResponsiveConditions: true,
						} )
					}
				/>
			</>
		</>
	);
};

const AdvancedControlsBlock = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		const { InspectorAdvancedControls } = wp.blockEditor;

		const blockName = props.name;
		const isCore = blockName.includes( 'core/' );

		const blockType = [
			'vexaltrix/*',
			'wpforms/form-selector',
			'formidable/simple-form',
			'formidable/calculator',
			'llms/lesson-navigation',
			'llms/pricing-table',
			'llms/course-syllabus',
			'llms/instructors',
			'core/archives',
			'core/calendar',
			'core/latest-comments',
			'core/tag-cloud',
			'core/rss',
			'real-media-library/gallery',
			'core/legacy-widget',
			'core/navigation',
			'core/search',
			'core/file',
			'vexaltrix/sure-forms',
			'vexaltrix/sure-cart-product',
			'vexaltrix/sure-cart-checkout',
		];

		return (
			<>
				<BlockEdit { ...props } />
				{ isCore && ! blockType.includes( blockName ) && (
					<InspectorAdvancedControls>
						<p className="components-base-control__help">
							{ __(
								"Below setting will only take effect once you are on the live page, and not while you're editing.",
								'vexaltrix'
							) }
						</p>
						<ExternalLink href={ `${ VXT_LINKS.VXT_URL }/docs/display-conditions-blocks/` }>
							{ __( 'Filter to disable responsive/display condition.', 'vexaltrix' ) }
						</ExternalLink>
						{ '1' === enableResponsiveConditionsForCoreBlocks && UserResponsiveConditionOptions( props ) }
						<hr className="vxt-editor__separator" />
						{ UserConditionOptions( props ) }
					</InspectorAdvancedControls>
				) }
			</>
		);
	};
}, 'AdvancedControlsBlock' );

function ApplyExtraClassCore( extraProps, blockType, attributes ) {
	const { UAGHideDesktop, UAGHideTab, UAGHideMob, UAGDisplayConditions, UAGResponsiveConditions } = attributes;

	const isCore = blockType.name.includes( 'core/' );

	if ( 'responsiveVisibility' === UAGDisplayConditions || ( UAGResponsiveConditions && isCore ) ) {
		if ( UAGHideDesktop ) {
			extraProps.className = classnames( extraProps.className, 'uag-hide-desktop' );
		}

		if ( UAGHideTab ) {
			extraProps.className = classnames( extraProps.className, 'uag-hide-tab' );
		}

		if ( UAGHideMob ) {
			extraProps.className = classnames( extraProps.className, 'uag-hide-mob' );
		}
	}

	return extraProps;
}

if ( '1' === enableConditionsForCoreBlocks ) {
	addFilter( 'editor.BlockEdit', 'vexaltrix/advanced-control-block', AdvancedControlsBlock );

	addFilter( 'blocks.getSaveContent.extraProps', 'vexaltrix/apply-extra-class-core', ApplyExtraClassCore );
}
