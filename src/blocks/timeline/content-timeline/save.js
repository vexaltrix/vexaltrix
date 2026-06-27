/**
 * BLOCK: Timeline - Save Block
 */

import classnames from 'classnames';
import ContentTmClasses from '.././classes';

import { InnerBlocks } from '@wordpress/block-editor';

export default function save( props ) {
	const { block_id } = props.attributes;

	return (
		<div
			className={ classnames(
				props.className,
				'vxt-timeline__outer-wrap',
				`vxt-block-${ block_id }`,
				'vxt-timeline__content-wrap',
				...ContentTmClasses( props.attributes )
			) }
		>
			<InnerBlocks.Content />
			<div className="vxt-timeline__line">
				<div className="vxt-timeline__line__inner"></div>
			</div>
		</div>
	);
}
