import apiFetch from '@wordpress/api-fetch';

const setInitialState = ( store ) => {
    apiFetch( {
        path: '/vxt-ugb/v1/admin/commonsettings/',
    } ).then( ( data ) => {
        const initialState = {
            initialStateSetFlag : true,
			activeSettingsNavigationTab: 'license',
			settingsSavedNotification: '',
            blocksStatuses : data.blocks_activation_and_deactivation,
            enableFileGeneration : data.enable_file_generation,
            enableTemplates : data.enable_templates_button,
			enableOnPageCSS : data.enable_on_page_css_button,
            enableBeta : data.enable_beta_updates,
            enableSelectedFontFamilies : data.load_select_font_globally,
            selectedFontFamilies :  data.select_font_globally,
            enableFSEFontFamilies : data.load_fse_font_globally,
            enableLoadFontsLocally : data.load_gfonts_locally,
            enablePreloadLocalFonts : data.preload_local_fonts,
            enableCollapsePanels : data.collapse_panels,
            enableCopyPasteStyles : data.copy_paste,
            enableDisplayConditions: data.enable_block_condition,
            enableMasonryExtension: data.enable_masonry_gallery,
			enableQuickActionSidebarExtension: data.enable_quick_action_sidebar,
            enableDynamicContentExtension: data.enable_dynamic_content,
            dynamicContentMode: data.dynamic_content_mode,
			enableResponsiveConditions: data.enable_block_responsive,
			contentWidth: data.vxt_content_width,
			siteKeyV2: data.recaptcha_site_key_v2,
			secretKeyV2: data.recaptcha_secret_key_v2,
			siteKeyV3: data.recaptcha_site_key_v3,
			secretKeyV3: data.recaptcha_secret_key_v3,
			visibilityMode: data.vxt_visibility_mode,
			visibilityPage: data.visibility_page,
			blocksEditorSpacing: data.vxt_blocks_editor_spacing,
			containerGlobalPadding: data.vxt_container_global_padding,
			containerGlobalElementsGap: data.vxt_container_global_elements_gap,
			enableFontAwesome5: data.vxt_load_font_awesome_5,
			enableAutoBlockRecovery: data.vxt_auto_block_recovery,
			enableLegacyBlocks: data.vxt_enable_legacy_blocks,
			social: data.social,
            instaLinkedAccounts: data?.insta_linked_accounts,
            coreBlocks: data.vexaltrix_core_blocks,
            enableAnimationsExtension: data.vxt_enable_animations_extension,
            vexaltrixFSEFonts: data.vexaltrix_global_fse_fonts,
            vexaltrixIsBlockTheme: data.wp_is_block_theme,
            themeFonts: data.theme_fonts,
            btnInheritFromTheme: data.vxt_btn_inherit_from_theme,
	        enableGBSExtension: data.vxt_enable_gbs_extension,
            zipAiModules: data.zip_ai_modules,
			enableBSFAnalyticsOption: data.enable_bsf_analytics_option,
        };

        store.dispatch( {type: 'UPDATE_INITIAL_STATE', payload: initialState} );

    } );
};

export default setInitialState;
