/**
 * BLOCK: Popup Builder - Render Block on the Front-end.
 */

import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { uagbClassNames } from '@Utils/Helpers';
import renderSVG from '@Controls/renderIcon';
import { __ } from '@wordpress/i18n';

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
	const ariaLabel = 'popup' === variantType ? __( 'Close Popup', 'vexaltrix' ) : __( 'Close Info Bar', 'vexaltrix' );

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
					<div
						className={ uagbClassNames( [
							'vxt-popup-builder__container',
							`vxt-popup-builder__container--${ variantType }`,
						] ) }
					>
						<InnerBlocks.Content />
					</div>
					{ isDismissable && closeIcon && (
						<button className="vxt-popup-builder__close" aria-label={ ariaLabel }>
							{ renderSVG( closeIcon ) }
						</button>
					) }
				</div>
			</div>
		)
	);
}
