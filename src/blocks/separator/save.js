/**
 * BLOCK: Separator - Save Block
 */
import { uagbClassNames } from '@Utils/Helpers';
import { useBlockProps } from '@wordpress/block-editor';
import renderSVG from '@Controls/renderIcon';
import renderCustomSVG from './separator-svg';

export default function save( props ) {
	const {
		attributes: {
			block_id,
			elementType,
			separatorText,
			separatorTextTag,
			separatorStyle,
			separatorIcon,
			blockTopPadding,
			blockRightPadding,
			blockLeftPadding,
			blockBottomPadding,
			blockTopPaddingTablet,
			blockRightPaddingTablet,
			blockLeftPaddingTablet,
			blockBottomPaddingTablet,
			blockTopPaddingMobile,
			blockRightPaddingMobile,
			blockLeftPaddingMobile,
			blockBottomPaddingMobile,
			blockTopMargin,
			blockRightMargin,
			blockLeftMargin,
			blockBottomMargin,
			blockTopMarginTablet,
			blockRightMarginTablet,
			blockLeftMarginTablet,
			blockBottomMarginTablet,
			blockTopMarginMobile,
			blockRightMarginMobile,
			blockLeftMarginMobile,
			blockBottomMarginMobile,
		},
	} = props;

	const spacingAttributes = [
		blockTopPadding,
		blockRightPadding,
		blockLeftPadding,
		blockBottomPadding,
		blockTopPaddingTablet,
		blockRightPaddingTablet,
		blockLeftPaddingTablet,
		blockBottomPaddingTablet,
		blockTopPaddingMobile,
		blockRightPaddingMobile,
		blockLeftPaddingMobile,
		blockBottomPaddingMobile,
		blockTopMargin,
		blockRightMargin,
		blockLeftMargin,
		blockBottomMargin,
		blockTopMarginTablet,
		blockRightMarginTablet,
		blockLeftMarginTablet,
		blockBottomMarginTablet,
		blockTopMarginMobile,
		blockRightMarginMobile,
		blockLeftMarginMobile,
		blockBottomMarginMobile,
	];

	const shouldAddWrapper = spacingAttributes.some( ( attribute ) => typeof attribute === 'number' );

	const customSVG = renderCustomSVG( separatorStyle );
	const CustomTag = `${ separatorTextTag }`;
	const blockProps = useBlockProps.save( {
		className: uagbClassNames( [
			`vxt-block-${ block_id }`,
			`${ elementType !== 'none' ? 'wp-block-vxt-separator--' + elementType : '' }`,
		] ),
	} );

	const InnerContent = () => (
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
	);

	return (
		<div { ...blockProps }>
			{ shouldAddWrapper ? (
				<div className="vxt-separator-spacing-wrapper">{ InnerContent() }</div>
			) : (
				InnerContent()
			) }
		</div>
	);
}
