/**
 * BLOCK: Tabs Child - Save Block
 */

import { InnerBlocks } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes } = props;
	const { id } = attributes;

	return (
		<div className={ `vxt-tabs__body-container vxt-inner-tab-${ id }` } aria-labelledby={ `vxt-tabs__tab${ id }` }>
			<InnerBlocks.Content />
		</div>
	);
}
