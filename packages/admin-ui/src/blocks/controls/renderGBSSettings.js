import GlobalBlockStyles from '@Components/global-block-link';

const renderGBSSettings = ( styling, setAttributes, attributes ) => {
	if (
		! vxt_ultimate_gutenberg_blocks_blocks_info?.vexaltrix_pro_status ||
		'enabled' !== vxt_ultimate_gutenberg_blocks_blocks_info?.vxt_enable_gbs_extension
	) {
		return null;
	}

	return <GlobalBlockStyles { ...{ setAttributes, styling, attributes } } />;
};

export default renderGBSSettings;
