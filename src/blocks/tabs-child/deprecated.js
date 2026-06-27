/**
 * BLOCK: Tabs - Deprecated Block
 */

import classnames from 'classnames';
import attributes from './attributes';

import { InnerBlocks } from '@wordpress/block-editor';

const deprecated = [
	{
		attributes,
		save( props ) {
			const { attributes, className } = props;

			const { id, block_id } = attributes;

			return (
				<div className="vxt-tabs__body-container">
					<div
						className={ classnames( className, `vxt-blocks__${ block_id }`, 'vxt-tabs__body' ) }
						aria-labelledby={ `vxt-tabs__tab${ id }` }
					>
						<InnerBlocks.Content />
					</div>
				</div>
			);
		},
	},
	{
		attributes,
		save( props ) {
			const { attributes, className } = props;
			const { id, block_id } = attributes;

			return (
				<div className={ `vxt-tabs__body-container vxt-tabs__inner-tab vxt-inner-tab-${ id }` }>
					<div
						className={ classnames( className, `vxt-blocks__${ block_id }`, 'vxt-tabs__body' ) }
						aria-labelledby={ `vxt-tabs__tab${ id }` }
					>
						<InnerBlocks.Content />
					</div>
				</div>
			);
		},
	},
];

export default deprecated;
