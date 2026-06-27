/**
 * BLOCK: Popup Builder - Render Block in the Editor.
 */

import { memo } from '@wordpress/element';
import { select } from '@wordpress/data';
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { getBlockTypes } from '@wordpress/blocks';
import renderSVG from '@Controls/renderIcon';
import { uagbClassNames } from '@Utils/Helpers';
import { __ } from '@wordpress/i18n';

const Render = ( props ) => {
	const { clientId, className, attributes, setAttributes, deviceType } = props;

	const {
		// ------------------------- BLOCK SETTINGS.
		block_id,
		variantType,
		// ------------------------- POPUP SETTINGS.
		isDismissable,
		// ------------------------- CLOSE SETTINGS.
		closeIcon,
	} = attributes;

	const { getBlockOrder } = select( 'core/block-editor' );

	const excludeBlocks = [
		'vexaltrix/how-to-step',
		'vexaltrix/buttons-child',
		'vexaltrix/faq-child',
		'vexaltrix/content-timeline-child',
		'vexaltrix/icon-list-child',
		'vexaltrix/social-share-child',
		'vexaltrix/restaurant-menu-child',
		'vexaltrix/tabs-child',
		'vexaltrix/post-image',
		'vexaltrix/post-taxonomy',
		'vexaltrix/post-title',
		'vexaltrix/post-meta',
		'vexaltrix/post-excerpt',
		'vexaltrix/post-button',
		'vexaltrix/forms-name',
		'vexaltrix/forms-email',
		'vexaltrix/forms-hidden',
		'vexaltrix/forms-phone',
		'vexaltrix/forms-textarea',
		'vexaltrix/forms-url',
		'vexaltrix/forms-select',
		'vexaltrix/forms-radio',
		'vexaltrix/forms-checkbox',
		'vexaltrix/forms-toggle',
		'vexaltrix/forms-date',
		'vexaltrix/forms-accept',
		'vexaltrix/modal',
		'vexaltrix/slider-child',
		'vexaltrix/popup-builder',
	];

	const blockProps = useBlockProps( {
		className: uagbClassNames( [
			className,
			`vxt-block-${ block_id }`,
			`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
			'vxt-popup-builder',
		] ),
	} );

	const ariaLabel = 'popup' === variantType ? __( 'Close Popup', 'vexaltrix' ) : __( 'Close Info Bar', 'vexaltrix' );

	const hasChildBlocks = getBlockOrder( clientId ).length > 0;
	const ALLOWED_BLOCKS = getBlockTypes()
		.map( ( block ) => block.name )
		.filter( ( blockName ) => ! excludeBlocks.includes( blockName ) );
	const innerBlocksParams = {
		allowedBlocks: ALLOWED_BLOCKS,
		templateLock: false,
		renderAppender: hasChildBlocks ? undefined : InnerBlocks.ButtonBlockAppender,
	};

	return (
		<div { ...blockProps }>
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
					<InnerBlocks { ...innerBlocksParams } />
				</div>
				{ isDismissable && closeIcon && (
					<button className="vxt-popup-builder__close" aria-label={ ariaLabel }>
						{ renderSVG( closeIcon, setAttributes ) }
					</button>
				) }
			</div>
		</div>
	);
};
export default memo( Render );
