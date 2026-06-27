import './masonry-gallery';
import './advanced-settings';
import './copy-paste-styles';
import './condition-block';
import './vxt-selected-block-editor-css';
import './quick-action-sidebar';
import { registerPlugin } from '@wordpress/plugins';
import VexaltrixPageSettingsPopup from './vxt-page-settings-popup';
import { select } from '@wordpress/data';
if ( select( 'core/editor' ) ) {
	// If Gutenberg editor, then only.
	registerPlugin( 'vexaltrix-page-level-settings', { render: VexaltrixPageSettingsPopup } );
}
