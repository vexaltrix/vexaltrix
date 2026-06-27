import { ToggleControl, SelectControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { addFilter, applyFilters } from '@wordpress/hooks';
import ResponsiveSlider from '@Components/responsive-slider';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import classnames from 'classnames';
import { useEffect } from '@wordpress/element';
import { AnimationList, AnimationSelectControlObject } from '@Blocks/extensions/animations-extension/animation-list';
import { createHigherOrderComponent } from '@wordpress/compose';
import { select } from '@wordpress/data';
import Select from 'react-select';
import { updateUAGDay } from '@Utils/Helpers';
import RenderAdvancedPositionPanel from '@Blocks/extensions/advanced-positioning';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const { enableConditions, enableResponsiveConditions, enableAnimationsExtension } =
	vxt_ultimate_gutenberg_blocks_blocks_info;

const UserConditionOptions = ( props ) => {
	const { attributes, setAttributes } = props;
	const { UAGLoggedIn, UAGLoggedOut, UAGDisplayConditions, UAGSystem, Vexaltrixrowser, UAGUserRole, UAGDay } = attributes;

	const handleChange = ( e ) => {
		const { value, checked } = e.target;
		setAttributes( {
			UAGDay: checked ? [ ...UAGDay, value ] : updateUAGDay( UAGDay, value ),
		} );
	};

	const options = [
		{ value: 'monday', label: __( 'Monday', 'vexaltrix' ) },
		{ value: 'tuesday', label: __( 'Tuesday', 'vexaltrix' ) },
		{ value: 'wednesday', label: __( 'Wednesday', 'vexaltrix' ) },
		{ value: 'thursday', label: __( 'Thursday', 'vexaltrix' ) },
		{ value: 'friday', label: __( 'Friday', 'vexaltrix' ) },
		{ value: 'saturday', label: __( 'Saturday', 'vexaltrix' ) },
		{ value: 'sunday', label: __( 'Sunday', 'vexaltrix' ) },
	];
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
						onChange={ () =>
							setAttributes( {
								UAGLoggedIn: ! attributes.UAGLoggedIn,
							} )
						}
					/>
					<ToggleControl
						label={ __( 'Hide From Logged Out Users', 'vexaltrix' ) }
						checked={ UAGLoggedOut }
						onChange={ () =>
							setAttributes( {
								UAGLoggedOut: ! attributes.UAGLoggedOut,
							} )
						}
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
							{
								value: 'firefox',
								label: __( 'Mozilla Firefox', 'vexaltrix' ),
							},
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
					<p>{ __( 'Select days you want to disable.', 'vexaltrix' ) }</p>
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

const zIndexOptions = ( props ) => {
	const { attributes, setAttributes } = props;
	const { zIndex, zIndexTablet, zIndexMobile } = attributes;

	return (
		<>
			<ResponsiveSlider
				label={ __( 'Z-Index', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: zIndex,
						label: 'zIndex',
					},
					tablet: {
						value: zIndexTablet,
						label: 'zIndexTablet',
					},
					mobile: {
						value: zIndexMobile,
						label: 'zIndexMobile',
					},
				} }
				min={ -100 }
				max={ 1000 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
			<p className="components-base-control__help">
				{ __(
					"Above setting will only take effect once you are on the live page, and not while you're editing.",
					'vexaltrix'
				) }
			</p>
		</>
	);
};

const ResponsiveConditionOptions = ( props ) => {
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

const animationOptions = ( props ) => {
	const {
		clientId,
		name,
		attributes: { UAGAnimationType, UAGAnimationTime, UAGAnimationDelay, UAGAnimationEasing },
		setAttributes,
	} = props;

	// Get the easing functions from Pro.
	const AnimationEasingFunctions = applyFilters( 'vexaltrix.animations-extension.easing-pro-options', '', name );

	// Function to trigger animation in editor (when changing animation type or clicking on play button).
	// animationType - holds UAGAnimationType attribute by default but sometimes the attribute is not updated instantaneously, so we pass in the value from the Animation Type select component.
	const playAnimation = ( animationType = UAGAnimationType ) => {
		// For responsive preview.
		const editorIframe = document.querySelector( 'iframe[name="editor-canvas"]' );
		const innerDoc = editorIframe?.contentDocument || editorIframe?.contentWindow.document;

		// Get block and the setTimeout code to clear from previous usage. Also check responsive preview.
		const animatedBlock = editorIframe
			? innerDoc.getElementById( 'block-' + clientId )
			: document.getElementById( 'block-' + clientId );

		const aosWaitPreviousCode = parseInt( localStorage.getItem( `aosWaitTimeoutCode-${ clientId }` ) );
		const aosRemoveClassesTimeoutPreviousCode = parseInt(
			localStorage.getItem( `aosRemoveClassesTimeoutCode-${ clientId }` )
		);

		// If the animation is played previously, remove the AOS class and attribute first.
		// We ensure that the AOS class and attribute is removed in case the user repeated taps the play button.
		if ( aosWaitPreviousCode ) {
			animatedBlock.removeAttribute( 'data-aos' );
			animatedBlock.classList.remove( 'aos-animate' );
		}

		// transition duration is set to 0s, cause the block first goes to the last frame (animated in reverse) when the AOS attribute is added and this should be instantaneous.
		animatedBlock.style.transitionDuration = '0s';
		// Add back the AOS attribute.
		animatedBlock.setAttribute( 'data-aos', animationType );

		// Due to CSS conflicts across themes in the editor, we set the easing using JS.
		// Also we only provide default 'ease' in the free version, so if the easing function list is empty then use the default 'ease' function.
		animatedBlock.style.transitionTimingFunction = AnimationEasingFunctions
			? AnimationEasingFunctions[ UAGAnimationEasing ]
			: 'cubic-bezier(.250, .100, .250, 1)';

		// Clear previous timeouts.
		clearTimeout( aosWaitPreviousCode );
		clearTimeout( aosRemoveClassesTimeoutPreviousCode );

		// Add the aos-animate class to play the animation with the given duration.
		const aosWait = setTimeout( () => {
			// Astra theme overrides (or even other themes may) the transition duration to a fixed value.
			// Hence we do the calculation on the next line.
			animatedBlock.style.transitionDuration = UAGAnimationTime / 1000 + 's';
			animatedBlock.classList.add( 'aos-animate' );
		}, 0 );

		// Remove the classes and attributes after the animation has played.
		// Keeping the classes and attributes after the animation has played can lead to buggy behavior in the editor.
		const aosRemoveClasses = setTimeout( () => {
			animatedBlock.removeAttribute( 'data-aos' );
			animatedBlock.classList.remove( 'aos-animate' );
			animatedBlock.style.transitionDuration = '';
			animatedBlock.style.transitionTimingFunction = '';
		}, UAGAnimationDelay + UAGAnimationTime );

		// Set local storage so we can fetch the value during later usage to clear the intervals.
		localStorage.setItem( `aosWaitTimeoutCode-${ clientId }`, aosWait );
		localStorage.setItem( `aosRemoveClassesTimeoutCode-${ clientId }`, aosRemoveClasses );
	};

	// Adding playAnimation function to props for using in the pro plugin.
	props = {
		...props,
		playAnimation,
	};

	const proAnimationOptions = applyFilters( 'vexaltrix.animations-extension.pro-options', props );

	// Check proAnimationOptions is valid react element or not.
	const proValidOptions =
		proAnimationOptions.$$typeof === Symbol.for( 'react.element' ) && proAnimationOptions?.props?.children
			? true
			: null;

	return (
		<>
			<Select
				placeholder={ __( 'Animation Type', 'vexaltrix' ) }
				onChange={ ( selection ) => {
					setAttributes( { UAGAnimationType: selection.value } );
					// Play animation when the animation type is changed.
					// We pass in 'value' since the UAGAnimationType may still hold the old animation type value.
					playAnimation( selection.value );
				} }
				options={ AnimationList }
				value={
					UAGAnimationType !== ''
						? AnimationSelectControlObject[ UAGAnimationType ]
						: AnimationSelectControlObject.none
				}
				defaultValue={
					UAGAnimationType !== ''
						? AnimationSelectControlObject[ UAGAnimationType ]
						: AnimationSelectControlObject.none
				}
				isSearchable={ true }
				className="vxt-animation-type-searchable-select"
				// Library specific prop.
				classNamePrefix="vxt-animation-type-select"
			/>
			{ proValidOptions && proAnimationOptions }

			{ ! vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status && <br /> }

			{ UAGAnimationType && ! proValidOptions && (
				<Button className="vxt-animation__play-button" onClick={ () => playAnimation() } variant="tertiary">
					{ __( 'Preview', 'vexaltrix' ) }
				</Button>
			) }
		</>
	);
};

function ApplyExtraClass( extraProps, blockType, attributes ) {
	const {
		UAGHideDesktop,
		UAGHideTab,
		UAGHideMob,
		zIndex,
		zIndexTablet,
		zIndexMobile,
		UAGDisplayConditions,
		UAGResponsiveConditions,
		layout,
	} = attributes;

	//Filter to add responsive condition compatibility for third party blocks.
	const blockTypes = applyFilters( 'vxt_reponsive_conditions_compatible_blocks', [ 'vexaltrix/' ] );

	let isResponsiveCompatibleBlock = false;
	for ( const type of blockTypes ) {
		if ( blockType.name.includes( type ) ) {
			isResponsiveCompatibleBlock = true;
			break;
		}
	}

	if (
		'responsiveVisibility' === UAGDisplayConditions ||
		( UAGResponsiveConditions && isResponsiveCompatibleBlock )
	) {
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

	if ( zIndex || zIndexTablet || zIndexMobile ) {
		//Adding a common selector for blocks where z-index is applied.
		extraProps.className = classnames( extraProps.className, 'uag-blocks-common-selector' );
		extraProps.style = {
			'--z-index-desktop': zIndex + ';',
			'--z-index-tablet': zIndexTablet + ';',
			'--z-index-mobile': zIndexMobile + ';',
		};
	}

	// For adding layout class to the block, block should be a container block and layout should be either grid or flex.
	if ( 'vexaltrix/container' === blockType?.name && ( 'grid' === layout || 'flex' === layout ) ) {
		extraProps.className = classnames( extraProps.className, 'vxt-layout-' + layout );
	}

	return extraProps;
}

// This adds AOS related data attributes to Gutenberg wrapper in editor.
const withAOSWrapperProps = createHigherOrderComponent( ( BlockListBlock ) => {
	return ( props ) => {
		const { attributes } = props;
		const {
			UAGAnimationType,
			UAGAnimationTime,
			UAGAnimationDelay,
			UAGAnimationEasing,
			UAGAnimationRepeat,
			layout,
		} = attributes;

		const wrapperProps = {
			...props.wrapperProps,
		};

		if ( UAGAnimationType !== '' ) {
			wrapperProps[ 'data-aos-duration' ] = UAGAnimationTime;
			wrapperProps[ 'data-aos-delay' ] = UAGAnimationDelay;
			wrapperProps[ 'data-aos-easing' ] = UAGAnimationEasing;
			if ( ! UAGAnimationRepeat ) {
				wrapperProps[ 'data-aos-once' ] = 'true';
			}
		}

		if ( [ 'grid', 'flex' ].includes( layout ) ) {
			wrapperProps.className = classnames( wrapperProps.className, 'vxt-layout-' + layout );
		}

		return <BlockListBlock { ...props } wrapperProps={ wrapperProps } />;
	};
}, 'withAOSWrapperProps' );

//For UAG Blocks.
addFilter( 'vxt_advance_tab_content', 'vexaltrix/advanced-display-condition', function ( content, props ) {
	if ( ! props ) {
		return content;
	}

	const { isSelected, name } = props;

	const excludeBlocks = [
		'vexaltrix/buttons-child',
		'vexaltrix/faq-child',
		'vexaltrix/icon-list-child',
		'vexaltrix/social-share-child',
		'vexaltrix/restaurant-menu-child',
		'vexaltrix/slider-child',
		'vexaltrix/sure-forms',
		'vexaltrix/sure-cart-product',
		'vexaltrix/sure-cart-checkout',
	];

	const excludeDisplayConditionBlocks = [ 'vexaltrix/popup-builder' ];

	const excludeDeprecatedBlocks = [
		// Legacy Blocks.
		'vexaltrix/cf7-styler',
		'vexaltrix/wp-search',
		'vexaltrix/gf-styler',
		'vexaltrix/columns',
		'vexaltrix/section',
		// Other Blocks without Z-index settings.
		'vexaltrix/popup-builder',
	];

	const excludeBlocksAnimations = [
		'vexaltrix/content-timeline-child',
		'vexaltrix/slider-child',
		'vexaltrix/content-timeline-child',
		'vexaltrix/popup-builder',
		'vexaltrix/sure-forms',
		'vexaltrix/sure-cart-product',
		'vexaltrix/sure-cart-checkout',
	];

	// To disable animations WITHIN some blocks.
	const excludeAnimationsWithin = [
		'vexaltrix/tabs',
		'vexaltrix/tabs-child',
		'vexaltrix/countdown',
		'vexaltrix/modal',
		'vexaltrix/popup-builder',
	];

	const getParentBlocks = select( 'core/block-editor' ).getBlockParents( props.clientId );

	let notHasDisallowedParentForAnimations = true;

	// Currently we are disallowing animations feature in Tabs & Countdown blocks.
	if ( getParentBlocks.length ) {
		for ( let i = 0; i < getParentBlocks.length; i++ ) {
			const currentParent = select( 'core/block-editor' ).getBlock( getParentBlocks[ i ] );

			if ( excludeAnimationsWithin.includes( currentParent.name ) ) {
				notHasDisallowedParentForAnimations = false;
				break;
			}
		}
	}

	return (
		<>
			{ isSelected && 'vexaltrix/container' === name && <RenderAdvancedPositionPanel { ...props } /> }
			{ isSelected &&
				'enabled' === enableAnimationsExtension &&
				! excludeDeprecatedBlocks.includes( name ) &&
				! excludeBlocksAnimations.includes( name ) &&
				notHasDisallowedParentForAnimations && (
					<UAGAdvancedPanelBody
						title={ __( 'Animations', 'vexaltrix' ) }
						initialOpen={ ! 'vexaltrix/container' === name }
						className="block-editor-block-inspector__advanced vxt-extention-tab"
					>
						{ animationOptions( props ) }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status && (
							<UpgradeComponent
								control={ {
									title: __(
										'Take Animations to the next level with powerful design features',
										'vexaltrix'
									),
									choices: [
										{
											title: __( 'Set delays and durations', 'vexaltrix' ),
											description: '',
										},
										{
											title: __( 'Change animation pacing', 'vexaltrix' ),
											description: '',
										},
										{
											title: __( 'Repeat on scroll', 'vexaltrix' ),
											description: '',
										},
										{
											title: __(
												'Animate all nested blocks inside containers with delays',
												'vexaltrix'
											),
											description: '',
										},
									],
									renderAs: 'list',
									campaign: 'advanced-animations',
								} }
							/>
						) }
					</UAGAdvancedPanelBody>
				) }
			{ isSelected && ! excludeBlocks.includes( name ) && (
				<>
					{ 'enabled' === enableConditions && ! excludeDisplayConditionBlocks.includes( name ) && (
						<UAGAdvancedPanelBody
							title={ __( 'Display Conditions', 'vexaltrix' ) }
							initialOpen={ false }
							className="block-editor-block-inspector__advanced vxt-extention-tab"
						>
							{ UserConditionOptions( props ) }
							<p className="components-base-control__help">
								{ __(
									"Above setting will only take effect once you are on the live page, and not while you're editing.",
									'vexaltrix'
								) }
							</p>
						</UAGAdvancedPanelBody>
					) }
					{ 'enabled' === enableResponsiveConditions && (
						<UAGAdvancedPanelBody
							title={ __( 'Responsive Conditions', 'vexaltrix' ) }
							initialOpen={ false }
							className="block-editor-block-inspector__advanced vxt-extention-tab"
						>
							{ ResponsiveConditionOptions( props ) }
							<p className="components-base-control__help">
								{ __(
									"Above setting will only take effect once you are on the live page, and not while you're editing.",
									'vexaltrix'
								) }
							</p>
						</UAGAdvancedPanelBody>
					) }
					{ ! excludeDeprecatedBlocks.includes( name ) && (
						<UAGAdvancedPanelBody
							title={ __( 'Z-Index', 'vexaltrix' ) }
							initialOpen={ false }
							className="block-editor-block-inspector__advanced vxt-extention-tab"
						>
							{ zIndexOptions( props ) }
						</UAGAdvancedPanelBody>
					) }
				</>
			) }
		</>
	);
} );

addFilter( 'editor.BlockListBlock', 'vexaltrix/with-aos-wrapper-props', withAOSWrapperProps );
addFilter( 'blocks.getSaveContent.extraProps', 'vexaltrix/apply-extra-class', ApplyExtraClass );
