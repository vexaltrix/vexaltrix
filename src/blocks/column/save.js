/**
 * BLOCK: Column - Frontend Render.
 */

import classnames from 'classnames';

import { InnerBlocks } from '@wordpress/block-editor';

export default function save( { attributes, className } ) {
	const { block_id, backgroundType, align, alignMobile, alignTablet } = attributes;

	const alignClass = 'center' === align ? '' : `vxt-column__align-${ align }`;
	const alignClassMobile = '' === alignMobile ? '' : `vxt-column__align-mobile-${ alignMobile }`;
	const alignClassTablet = '' === alignTablet ? '' : `vxt-column__align-tablet-${ alignTablet }`;

	return (
		<div
			className={ classnames(
				className,
				'vxt-column__wrap',
				`vxt-column__background-${ backgroundType }`,
				alignClass,
				alignClassMobile,
				alignClassTablet,
				`vxt-block-${ block_id }`
			) }
		>
			<div className="vxt-column__overlay"></div>
			<InnerBlocks.Content />
		</div>
	);
}
