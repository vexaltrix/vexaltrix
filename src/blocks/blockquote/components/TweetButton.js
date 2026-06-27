import VXT_Block_Icons from '@Controls/block-icons';
const TweetButton = ( { attributes } ) => (
	<a href="/" className="vxt-blockquote__tweet-button" target="_blank" rel="noopener noreferrer">
		{ attributes.iconView === 'icon_text' && (
			<>
				{ VXT_Block_Icons.quote_tweet_icon }
				<span className="vxt-blockquote__tweet-label">{ attributes.iconLabel }</span>
			</>
		) }

		{ attributes.iconView === 'icon' && <>{ VXT_Block_Icons.quote_tweet_icon }</> }

		{ attributes.iconView === 'text' && (
			<>
				<span className="vxt-blockquote__tweet-label">{ attributes.iconLabel }</span>
			</>
		) }
	</a>
);

export default TweetButton;
