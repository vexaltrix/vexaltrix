/**
 * Block Icon : Render.
 */
import { memo } from '@wordpress/element';
import renderSVG from '@Controls/renderIcon';
import { useBlockProps } from '@wordpress/block-editor';

const Render = ( props ) => {
	const { attributes, setAttributes, deviceType } = props;
	const {
		icon,
		block_id,
		iconAccessabilityMode,
		iconAccessabilityDesc,
		iconBottomMargin,
		iconLeftMargin,
		iconRightMargin,
		iconTopMargin,
		iconTopTabletMargin,
		iconRightTabletMargin,
		iconLeftTabletMargin,
		iconBottomTabletMargin,
		iconTopMobileMargin,
		iconRightMobileMargin,
		iconLeftMobileMargin,
		iconBottomMobileMargin,
	} = attributes;

	const extraProps = {
		...( iconAccessabilityMode !== 'presentation' && {
			role: iconAccessabilityMode === 'svg' ? 'graphics-symbol' : 'image',
			'aria-label': iconAccessabilityDesc,
		} ),
		'aria-hidden': iconAccessabilityMode === 'presentation',
	};

	const marginVariables = [
		iconBottomMargin,
		iconLeftMargin,
		iconRightMargin,
		iconTopMargin,
		iconTopTabletMargin,
		iconRightTabletMargin,
		iconLeftTabletMargin,
		iconBottomTabletMargin,
		iconTopMobileMargin,
		iconRightMobileMargin,
		iconLeftMobileMargin,
		iconBottomMobileMargin,
	];
	const hasMargin = marginVariables.some( ( margin ) => typeof margin === 'number' );
	const iconSvg = icon ? icon : 'circle-check';
	const iconHtml = renderSVG( iconSvg, setAttributes, extraProps );
	const marginClass = hasMargin ? 'wp-block-vxt-icon--has-margin' : '';

	const blockProps = useBlockProps( {
		className: `vxt-block-${ block_id } vxt-icon-wrapper vxt-editor-preview-mode-${ deviceType.toLowerCase() } ${ marginClass }`,
	} );

	const renderSvgWrapper = () => <span className="vxt-svg-wrapper">{ iconHtml }</span>;

	return (
		<div { ...blockProps }>
			{ hasMargin ? <div className="vxt-icon-margin-wrapper">{ renderSvgWrapper() }</div> : renderSvgWrapper() }
		</div>
	);
};
export default memo( Render );
