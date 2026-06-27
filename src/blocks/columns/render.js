/**
 * BLOCK: Columns - Editor Render.
 */

import classnames from 'classnames';
import shapes from './shapes';
import { useMemo, memo } from '@wordpress/element';

const ALLOWED_BLOCKS = [ 'vexaltrix/column' ];
import { InnerBlocks } from '@wordpress/block-editor';

const Render = ( props ) => {
	const { attributes, isSelected, className, deviceType } = props;

	const {
		stack,
		align,
		vAlign,
		tag,
		columnGap,
		backgroundType,
		backgroundVideo,
		columns,
		bottomType,
		topType,
		bottomFlip,
		topFlip,
		reverseTablet,
		reverseMobile,
		topContentAboveShape,
		bottomContentAboveShape,
		contentWidth,
		block_id,
	} = attributes;

	const getColumnsTemplate = useMemo( () => {
		const childColumns = [];

		for ( let i = 0; i < columns; i++ ) {
			childColumns.push( [ 'vexaltrix/column', { id: i + 1 } ] );
		}

		return childColumns;
	}, [ columns ] );

	const topDividerHtml = topType !== 'none' && (
		<div
			className={ classnames(
				'vxt-columns__shape',
				'vxt-columns__shape-top',
				{ 'vxt-columns__shape-flip': topFlip === true },
				{
					'vxt-columns__shape-above-content': topContentAboveShape === true,
				}
			) }
		>
			{ shapes[ topType ] }
		</div>
	);

	const bottomDividerHtml = bottomType !== 'none' && (
		<div
			className={ classnames(
				'vxt-columns__shape',
				'vxt-columns__shape-bottom',
				{ 'vxt-columns__shape-flip': bottomFlip === true },
				{
					'vxt-columns__shape-above-content': bottomContentAboveShape === true,
				}
			) }
			data-negative="false"
		>
			{ shapes[ bottomType ] }
		</div>
	);

	const reverseTabletClass = reverseTablet ? 'vxt-columns__reverse-tablet' : '';

	const reverseMobileClass = reverseMobile ? 'vxt-columns__reverse-mobile' : '';

	const CustomTag = `${ tag }`;

	const active = isSelected ? 'active' : 'not-active';

	const bgType = undefined !== backgroundType ? `vxt-columns__background-${ backgroundType }` : '';

	const verticalAlign = undefined !== vAlign ? `vxt-columns__valign-${ vAlign }` : '';

	const alignType = undefined !== align ? `align${ align }` : '';

	return (
		<CustomTag
			className={ classnames(
				className,
				'vxt-columns__wrap',
				`${ bgType }`,
				`vxt-columns__edit-${ active }`,
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-columns__stack-${ stack }`,
				`${ verticalAlign }`,
				`vxt-columns__gap-${ columnGap }`,
				`${ alignType }`,
				reverseTabletClass,
				reverseMobileClass,
				`vxt-block-${ block_id }`,
				`vxt-columns__max_width-${ contentWidth }`
			) }
		>
			<div className="vxt-columns__overlay"></div>
			{ topDividerHtml }
			{ 'video' === backgroundType && (
				<div className="vxt-columns__video-wrap">
					{ backgroundVideo && (
						<video autoPlay loop muted playsinline>
							<source src={ backgroundVideo.url } type="video/mp4" />
						</video>
					) }
				</div>
			) }
			<div className={ classnames( 'vxt-columns__inner-wrap', `vxt-columns__columns-${ columns }` ) }>
				<InnerBlocks template={ getColumnsTemplate } templateLock="all" allowedBlocks={ ALLOWED_BLOCKS } />
			</div>
			{ bottomDividerHtml }
		</CustomTag>
	);
};

export default memo( Render );
