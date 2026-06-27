<?php
/**
 * Frontend JS File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined else where.
 *
 * @var mixed[] $attr
 */

if ( ! $attr['enableTweet'] ) {
	return '';
}

$target = $attr['iconTargetUrl'];

$baseSelector = ( isset( $attr['classMigrate'] ) && $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-blockquote-';
$selector      = $baseSelector . $id;

$shareLink = 'https://twitter.com/intent/tweet';
$text       = rawurlencode( $attr['descriptionText'] );

if ( ! empty( trim( $attr['author'] ) ) ) {
	$text .= ' — ' . $attr['author'];
}

$shareLink = add_query_arg( 'text', $text, $shareLink );

if ( 'current' === $target ) {
	$shareLink = add_query_arg( 'url', rawurlencode( home_url() . add_query_arg( false, false ) ), $shareLink );
} else {
	$shareLink = add_query_arg( 'url', rawurlencode( $attr['customUrl'] ), $shareLink );
}

if ( ! empty( trim( $attr['iconShareVia'] ) ) ) {
	$userName = $attr['iconShareVia'];
	if ( '@' === substr( $userName, 0, 1 ) ) {
		$userName = substr( $userName, 1 );
	}
	$shareLink = add_query_arg( 'via', rawurlencode( $userName ), $shareLink );
}
ob_start();
?>
var selector = document.querySelectorAll( '<?php echo esc_attr( $selector ); ?>' );
if ( selector.length > 0 ) {

	var blockquote__tweet = selector[0].getElementsByClassName("vxt-blockquote__tweet-button");

	if ( blockquote__tweet.length > 0 ) {

		blockquote__tweet[0].addEventListener("click",function(){	
			var request_url = "<?php echo esc_url_raw( $shareLink ); ?>";
			window.open( request_url );
		});
	}
}
<?php
return ob_get_clean();
?>
