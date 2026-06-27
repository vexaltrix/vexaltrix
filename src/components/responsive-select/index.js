/**
 * External dependencies
 */
import { useLayoutEffect, useEffect, useState, useRef } from '@wordpress/element';
import { SelectControl } from '@wordpress/components';
import { useDeviceType } from '@Controls/getPreviewType';
import ResponsiveToggle from '../responsive-toggle';
import { select } from '@wordpress/data';
import { getIdFromString, getPanelIdFromRef } from '@Utils/Helpers';
import styles from './editor.lazy.scss';
import UAGHelpText from '@Components/help-text';
import { applyFilters } from '@wordpress/hooks';

const ResponsiveSelectControl = ( props ) => {
	const [ panelNameForHook, setPanelNameForHook ] = useState( null );
	const panelRef = useRef( null );

	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { getSelectedBlock } = select( 'core/block-editor' );

	const blockNameForHook = getSelectedBlock()?.name.split( '/' ).pop();
	useEffect( () => {
		setPanelNameForHook( getPanelIdFromRef( panelRef ) );
	}, [ blockNameForHook ] );

	const { label, data, setAttributes, options, help = false } = props;

	const responsive = true;

	const deviceType = useDeviceType();

	const output = {};
	output.Desktop = (
		<SelectControl
			value={ data.desktop.value }
			onChange={ ( value ) => setAttributes( { [ data.desktop.label ]: value } ) }
			options={ options.desktop }
		/>
	);
	output.Tablet = (
		<SelectControl
			value={ data.tablet.value }
			onChange={ ( value ) => setAttributes( { [ data.tablet.label ]: value } ) }
			options={ options.tablet || options.desktop }
		/>
	);
	output.Mobile = (
		<SelectControl
			value={ data.mobile.value }
			onChange={ ( value ) => setAttributes( { [ data.mobile.label ]: value } ) }
			options={ options.mobile || options.desktop }
		/>
	);

	const controlName = getIdFromString( props.label );
	const controlBeforeDomElement = applyFilters(
		`vexaltrix.${ blockNameForHook }.${ panelNameForHook }.${ controlName }.before`,
		'',
		blockNameForHook
	);
	const controlAfterDomElement = applyFilters(
		`vexaltrix.${ blockNameForHook }.${ panelNameForHook }.${ controlName }`,
		'',
		blockNameForHook
	);

	return (
		<div ref={ panelRef } className="vxt-responsive-select-control components-base-control">
			{ controlBeforeDomElement }
			<div className="vxt-size-type-field-tabs">
				<div className="vxt-control__header">
					<ResponsiveToggle label={ label } responsive={ responsive } />
				</div>
				{ output[ deviceType ] ? output[ deviceType ] : output.Desktop }
			</div>
			<UAGHelpText text={ help } />
			{ controlAfterDomElement }
		</div>
	);
};

export default ResponsiveSelectControl;
