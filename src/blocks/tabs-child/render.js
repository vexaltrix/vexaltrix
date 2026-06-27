import { InnerBlocks } from '@wordpress/block-editor';
import { memo } from '@wordpress/element';

const Render = ( props ) => {
	const { attributes } = props;
	const { tabActive, id } = attributes;

	return (
		<div
			className={ `vxt-tabs__body-container vxt-inner-tab-${ id }` }
			style={ { display: id === tabActive ? 'block' : 'none' } }
			aria-labelledby={ `vxt-tabs__tab${ id }` }
		>
			<InnerBlocks
				template={ [
					[
						'core/paragraph',
						{
							content:
								'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
						},
					],
				] }
				templateLock={ false }
			/>
		</div>
	);
};
export default memo( Render );
