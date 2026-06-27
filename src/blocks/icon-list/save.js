/**
 * BLOCK: Column - Save Block
 */

// Import block dependencies and components.
import classnames from 'classnames';

import { InnerBlocks } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes, className } = props;

	const { block_id } = attributes;

	return (
		<div className={ classnames( className, `vxt-block-${ block_id }` ) }>
			<div className="vxt-icon-list__wrap">
				<InnerBlocks.Content />
			</div>
		</div>
	);
}
