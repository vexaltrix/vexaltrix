/**
 * BLOCK: Separator - Save Block
 */
import { uagbClassNames } from '@Utils/Helpers';
import { useBlockProps } from '@wordpress/block-editor';
import renderSVG from '@Controls/renderIcon';
import renderCustomSVG from '../../separator-svg';

export default function save( props ) {
	const {
		attributes: { block_id, elementType, separatorText, separatorTextTag, separatorStyle, separatorIcon },
	} = props;

	const customSVG = renderCustomSVG( separatorStyle );
	const CustomTag = `${ separatorTextTag }`;
	const blockProps = useBlockProps.save( {
		className: uagbClassNames( [
			`vxt-block-${ block_id }`,
			`${ elementType !== 'none' ? 'wp-block-vxt-separator--' + elementType : '' }`,
		] ),
	} );

	return (
		<div { ...blockProps }>
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
	);
}
