import { useLayoutEffect, useEffect, useState, useRef } from '@wordpress/element';
import Separator from '@Components/separator';
import { useSelect } from '@wordpress/data';
import { TextControl, TextareaControl } from '@wordpress/components';
import ResponsiveToggle from '../responsive-toggle';
import styles from './editor.lazy.scss';
import classnames from 'classnames';
import { getIdFromString, getPanelIdFromRef } from '@Utils/Helpers';
import UAGReset from '../reset';
import UAGHelpText from '@Components/help-text';
import { applyFilters } from '@wordpress/hooks';

const UAGTextControl = ( props ) => {
	const [ panelNameForHook, setPanelNameForHook ] = useState( null );
	const panelRef = useRef( null );
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const selectedBlock = useSelect( ( select ) => {
		return select( 'core/block-editor' ).getSelectedBlock();
	}, [] );

	const blockNameForHook = selectedBlock?.name.split( '/' ).pop();
	useEffect( () => {
		setPanelNameForHook( getPanelIdFromRef( panelRef ) );
	}, [ blockNameForHook ] );

	const registerTextExtender =
		props.enableDynamicContent && props.name
			? applyFilters( 'uagb.registerTextExtender', '', selectedBlock?.name, props.name, props.dynamicContentType )
			: null;

	const isEnableDynamicContent = () => {
		if ( ! props.enableDynamicContent || ! props.name ) {
			return false;
		}
		const dynamicContent = selectedBlock?.attributes?.dynamicContent;
		if ( dynamicContent && dynamicContent?.[ props.name ]?.enable === true ) {
			return true;
		}
		return false;
	};

	const handleOnChange = ( newValue ) => {
		if ( props.name && props?.setAttributes ) {
			props.setAttributes( { [ props.name ]: newValue } );
		} else if ( props?.setAttributes ) {
			props?.setAttributes( {
				[ props?.data?.label ]: newValue,
			} );
		}
		if ( props?.onChange ) {
			props?.onChange( newValue );
		}
	};

	const resetValues = ( defaultValues ) => {
		if ( props?.onChange ) {
			props?.onChange( defaultValues[ props?.data?.label ] );
		}
	};

	const HeaderControls = () => {
		return (
			<div className="vxt-control__header">
				<ResponsiveToggle label={ props?.label } />
				<div className="vxt-number-control__actions vxt-control__actions">
					<UAGReset
						onReset={ resetValues }
						attributeNames={ [ props?.data?.label ] }
						setAttributes={ props?.setAttributes }
					/>
				</div>
			</div>
		);
	};

	const controlName = getIdFromString( props.label ); // there is no label props that's why keep hard coded label
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
		<div ref={ panelRef } className="components-base-control">
			{ controlBeforeDomElement }
			<div
				className={ classnames(
					'components-base-control vxt-text-control vxt-size-type-field-tabs',
					isEnableDynamicContent() ? ' vxt-text-control--open-dynamic-content' : '',
					props.className
				) }
			>
				{ props?.variant !== 'inline' && props?.showHeaderControls && <HeaderControls /> }
				<div
					className={ classnames(
						'vxt-text-control__controls',
						'vxt-text-control__controls-' + props?.variant
					) }
				>
					{ ! isEnableDynamicContent() && (
						<>
							{ props?.variant !== 'textarea' && (
								<TextControl
									label={
										props?.variant === 'inline' ||
										( props?.variant !== 'inline' && ! props?.showHeaderControls )
											? props?.label
											: false
									}
									type={ props?.type }
									value={ props?.value }
									onChange={ handleOnChange }
									autoComplete={ props?.autoComplete }
									readOnly={ isEnableDynamicContent() }
									placeholder={ props?.placeholder }
									onKeyUp={ props?.onKeyUp }
								/>
							) }
							{ props?.variant === 'textarea' && (
								<TextareaControl
									label={ ! props?.showHeaderControls ? props?.label : false }
									value={ props?.value }
									onChange={ handleOnChange }
									autoComplete={ props?.autoComplete }
									readOnly={ isEnableDynamicContent() }
								/>
							) }
						</>
					) }
					{ isEnableDynamicContent() && props?.variant === 'inline' && (
						<div className="components-base-control">
							<div className="components-base-control__field">
								<label className="components-base-control__label">{ props.label }</label>
							</div>
						</div>
					) }
					{ registerTextExtender }
				</div>

				<UAGHelpText text={ props.help } />
				{ isEnableDynamicContent() && <Separator /> }
			</div>
			{ controlAfterDomElement }
		</div>
	);
};

UAGTextControl.defaultProps = {
	label: '',
	type: 'text',
	className: '',
	allowReset: true,
	resetFallbackValue: '',
	placeholder: null,
	variant: 'full-width',
	autoComplete: 'off',
	showHeaderControls: true,
	dynamicContentType: 'url', // url | text
	enableDynamicContent: false,
	help: false,
};

export default UAGTextControl;
