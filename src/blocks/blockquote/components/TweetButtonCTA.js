import VXT_Block_Icons from '@Controls/block-icons';

function TweetButtonCTA( props ) {
	const { attributes } = props;

	return (
		<a
			onClick={ ( e ) => e.preventDefault() }
			href="/"
			className="vxt-blockquote__tweet-button"
			target="_blank"
			rel="noopener noreferrer"
		>
			{ attributes.iconView === 'icon_text' && (
				<>
					{ VXT_Block_Icons.quote_tweet_icon }
					{ attributes.iconLabel }
				</>
			) }

			{ attributes.iconView === 'icon' && <>{ VXT_Block_Icons.quote_tweet_icon }</> }

			{ attributes.iconView === 'text' && <>{ attributes.iconLabel }</> }
		</a>
	);
}

export default TweetButtonCTA;
