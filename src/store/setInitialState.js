import apiFetch from '@wordpress/api-fetch';
import { dispatch } from '@wordpress/data';
import { store as vexaltrixStore } from '@Store';

const setInitialState = () => {
	apiFetch( {
		path: '/vexaltrix/v1/editor',
	} ).then( ( data ) => {
		const initialState = {
			initialStateSetFlag: true,
			globalBlockStyles: data.vexaltrix_global_block_styles,
			globalBlockStylesFontFamilies: data.vexaltrix_gbs_google_fonts_editor,
			enableQuickActionSidebar: data.vxt_enable_quick_action_sidebar, // 'enabled' | 'disabled' quick action sidebar.
			defaultAllowedQuickSidebarBlocks: data.vxt_ultimate_gutenberg_blocks_quick_sidebar_allowed_blocks, // Default blocks allowed in the quick action sidebar.
		};
		dispatch( vexaltrixStore ).updateInitialState( initialState );
	} );
};

export default setInitialState;
