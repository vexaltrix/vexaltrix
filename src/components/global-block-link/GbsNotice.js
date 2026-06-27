import { __ } from '@wordpress/i18n';

const GbsNotice = ( { globalBlockStyleId, globalBlockStyleName } ) => {
	if (
		'enabled' === vxt_ultimate_gutenberg_blocks_blocks_info?.vxt_enable_gbs_extension &&
		globalBlockStyleId &&
		globalBlockStyleName
	) {
		return (
			<div className="vexaltrix-gbs-notice">
				<span className="vexaltrix-gbs-notice-text">{ __( 'Global block style added', 'vexaltrix' ) }</span>
			</div>
		);
	}
	return null;
};

export default GbsNotice;
