/**
 * ADVANCED SETTINGS: Position - Settings Panel.
 *
 * This will render all positional settings for all blocks.
 *
 * Current Support:
 * Positions --> Sticky
 * Blocks    --> Container
 */
import StickyPositionalSettings from './positional-settings/sticky-settings';
import { ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';

const RenderAdvancedPositionPanel = ( props ) => {
	const {
		attributes: { UAGPosition },
		setAttributes,
	} = props;
	return (
		<UAGAdvancedPanelBody
			title={ __( 'Sticky', 'vexaltrix' ) }
			initialOpen={ false }
			className="block-editor-block-inspector__advanced vxt-extention-tab"
		>
			<ToggleControl
				label={ __( 'Sticky Container', 'vexaltrix' ) }
				checked={ 'sticky' === UAGPosition }
				onChange={ () => setAttributes( { UAGPosition: 'sticky' === UAGPosition ? '' : 'sticky' } ) }
				help={ __( 'Changes affect the frontend only', 'vexaltrix' ) }
			/>
			{ 'sticky' === UAGPosition && <StickyPositionalSettings { ...props } /> }
		</UAGAdvancedPanelBody>
	);
};

export default RenderAdvancedPositionPanel;
