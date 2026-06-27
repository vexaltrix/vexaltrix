import { memo } from '@wordpress/element';
import renderSVG from '@Controls/renderIcon';
import renderCustomSVG from './separator-svg';
import { useBlockProps } from '@wordpress/block-editor';
import { uagbClassNames } from '@Utils/Helpers';
import './style.scss';

const Render = ( props ) => {
	const {
		attributes: { block_id, elementType, separatorText, separatorTextTag, separatorStyle, separatorIcon },
		className,
		deviceType,
	} = props;

	const customSVG = renderCustomSVG( separatorStyle );
	const CustomTag = `${ separatorTextTag }`;

	const hasElement = `${ elementType !== 'none' ? 'wp-block-vxt-separator--' + elementType : '' }`;

	const blockProps = useBlockProps( {
		className: uagbClassNames( [
			className,
			`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
			`vxt-block-${ block_id }`,
			'wp-block-vxt-separator',
			hasElement,
		] ),
	} );

	return (
		<div { ...blockProps }>
			<div className="vxt-separator-spacing-wrapper">
				<div className="wp-block-vxt-separator__inner" style={ { '--my-background-image': `${ customSVG }` } }>
					{ elementType !== 'none' && (
						<div className="wp-block-vxt-separator-element">
							{ elementType === 'icon' ? (
								renderSVG( separatorIcon )
							) : (
								<CustomTag className="vxt-html-tag">{ separatorText }</CustomTag>
							) }
						</div>
					) }
				</div>
			</div>
		</div>
	);
};
export default memo( Render );
