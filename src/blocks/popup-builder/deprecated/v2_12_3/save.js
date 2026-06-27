/**
 * BLOCK: Popup Builder - Render Block on the Front-end - v2.12.3
 */

import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { uagbClassNames } from '@Utils/Helpers';
import renderSVG from '@Controls/renderIcon';

export default function save( props ) {
	const { attributes } = props;

	const {
		// ------------------------- BLOCK SETTINGS.
		block_id,
		variationSelected,
		variantType,
		// ------------------------- POPUP SETTINGS.
		isDismissable,
		// ------------------------- CLOSE SETTINGS.
		closeIcon,
	} = attributes;

	const blockProps = useBlockProps.save();

	return (
		variationSelected && (
			<div
				id={ blockProps.id }
				className={ uagbClassNames( [ blockProps.className, `vxt-block-${ block_id }`, 'vxt-popup-builder' ] ) }
			>
				<div
					className={ uagbClassNames( [
						'vxt-popup-builder__wrapper',
						`vxt-popup-builder__wrapper--${ variantType }`,
					] ) }
				>
					{ isDismissable && closeIcon && (
						<div className="vxt-popup-builder__close">{ renderSVG( closeIcon ) }</div>
					) }
					<div
						className={ uagbClassNames( [
							'vxt-popup-builder__container',
							`vxt-popup-builder__container--${ variantType }`,
						] ) }
					>
						<InnerBlocks.Content />
					</div>
				</div>
			</div>
		)
	);
}
