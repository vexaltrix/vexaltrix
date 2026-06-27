/**
 * BLOCK: Blockquote - Save Block
 */

import classnames from 'classnames';
import VXT_Block_Icons from '@Controls/block-icons';
import TweetButtonCTA from './components/TweetButtonCTA';
import Description from './components/Description';
import AuthorText from './components/AuthorText';
import AuthorImage from './components/AuthorImage';

export default function save( props ) {
	const {
		block_id,
		skinStyle,
		align,
		quoteStyle,
		iconSkin,
		authorImage,
		enableTweet,
		iconView,
		author,
		descriptionText,
		authorImgPosition,
		stack,
	} = props.attributes;
	return (
		<div
			className={ classnames(
				props.className,
				`vxt-block-${ block_id }`,
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
				{ descriptionText !== '' && (
					<Description attributes={ props.attributes } setAttributes="not_set" props={ props } />
				) }
				<footer>
					<div
						className={ classnames(
							'vxt-blockquote__author-wrap',
							authorImage !== '' ? `vxt-blockquote__author-at-${ authorImgPosition }` : ''
						) }
					>
						<AuthorImage attributes={ props.attributes } />
						{ author !== '' && (
							<AuthorText attributes={ props.attributes } setAttributes="not_set" props={ props } />
						) }
					</div>
					{ enableTweet && <TweetButtonCTA attributes={ props.attributes } /> }
				</footer>
			</blockquote>
		</div>
	);
}
