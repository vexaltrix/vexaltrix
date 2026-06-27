/**
 * BLOCK: Buttons - Save Block
 */

import classnames from 'classnames';
import { InnerBlocks } from '@wordpress/block-editor';

export default function save( props ) {
	const { className } = props;
	const { block_id, buttonSize, buttonSizeTablet, buttonSizeMobile } = props.attributes;

	return (
		<div
			className={ classnames(
				className,
				'vxt-buttons__outer-wrap',
				`vxt-btn__${ buttonSize }-btn`,
				`vxt-btn-tablet__${ buttonSizeTablet }-btn`,
				`vxt-btn-mobile__${ buttonSizeMobile }-btn`,
				`vxt-block-${ block_id }`
			) }
		>
			<div className="vxt-buttons__wrap vxt-buttons-layout-wrap">
				<InnerBlocks.Content />
			</div>
		</div>
	);
}
