/**
 * BLOCK: Columns - Frontend Render.
 */

import classnames from 'classnames';
import shapes from './shapes';

import { InnerBlocks } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes, className } = props;

	const {
		block_id,
		tag,
		backgroundType,
		backgroundVideo,
		align,
		columns,
		stack,
		vAlign,
		columnGap,
		topType,
		bottomType,
		bottomFlip,
		topFlip,
		reverseTablet,
		reverseMobile,
		topContentAboveShape,
		bottomContentAboveShape,
		contentWidth,
	} = attributes;

	const CustomTag = `${ tag }`;

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

	const bgType = undefined !== backgroundType ? `vxt-columns__background-${ backgroundType }` : '';

	const verticalAlign = undefined !== vAlign ? `vxt-columns__valign-${ vAlign }` : '';

	const alignType = undefined !== align ? `align${ align }` : '';

	return (
		<CustomTag
			className={ classnames(
				className,
				'vxt-columns__wrap',
				`${ bgType }`,
				`vxt-columns__stack-${ stack }`,
				`${ verticalAlign }`,
				`vxt-columns__gap-${ columnGap }`,
				`${ alignType }`,
				reverseTabletClass,
				reverseMobileClass,
				`vxt-block-${ block_id }`,
				`vxt-columns__columns-${ columns }`,
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
				<InnerBlocks.Content />
			</div>
			{ bottomDividerHtml }
		</CustomTag>
	);
}
