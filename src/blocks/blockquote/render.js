import classnames from 'classnames';
import VXT_Block_Icons from '@Controls/block-icons';
import { useLayoutEffect, memo } from '@wordpress/element';
import Description from './components/Description';
import AuthorImage from './components/AuthorImage';
import AuthorText from './components/AuthorText';
import TweetButtonCTA from './components/TweetButtonCTA';
import styles from './editor.lazy.scss';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { className, setAttributes, attributes, deviceType } = props;

	const {
		block_id,
		skinStyle,
		align,
		stack,
		quoteStyle,
		enableTweet,
		iconView,
		iconSkin,
		authorImage,
		authorImgPosition,
	} = attributes;

	return (
		<div
			className={ classnames(
				className,
				`vxt-block-${ block_id }`,
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-blockquote__skin-${ skinStyle }`,
				skinStyle !== 'border' ? `vxt-blockquote__align-${ align }` : '',
				skinStyle === 'quotation' ? `vxt-blockquote__style-${ quoteStyle }` : '',
				enableTweet
					? `vxt-blockquote__with-tweet vxt-blockquote__tweet-style-${ iconSkin } vxt-blockquote__tweet-${ iconView }`
					: '',
				`vxt-blockquote__stack-img-${ stack }`
			) }
		>
			<blockquote className="vxt-blockquote">
				{ skinStyle === 'quotation' && (
					<span className="vxt-blockquote__icon">{ VXT_Block_Icons.quote_inline_icon }</span>
				) }
				<Description attributes={ attributes } setAttributes={ setAttributes } props={ props } />
				<footer>
					<div
						className={ classnames(
							'vxt-blockquote__author-wrap',
							authorImage !== '' ? `vxt-blockquote__author-at-${ authorImgPosition }` : ''
						) }
					>
						<AuthorImage attributes={ attributes } />

						<AuthorText attributes={ attributes } setAttributes={ setAttributes } props={ props } />
					</div>
					{ enableTweet && <TweetButtonCTA attributes={ attributes } /> }
				</footer>
			</blockquote>
		</div>
	);
};

export default memo( Render );
