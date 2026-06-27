<?php
/**
 * Frontend JS File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @var int $id
 * @package ugb
 */

$baseSelector = ( isset( $attr['classMigrate'] ) && $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-social-share-';
$selector      = $baseSelector . $id;
global $post;
// Get the featured image.
if ( has_post_thumbnail() ) {
	$thumbnailId   = get_post_thumbnail_id( $post->ID );
	$thumbnailData = $thumbnailId ? wp_get_attachment_image_src( $thumbnailId, 'large', true ) : '';
	$thumbnail      = is_array( $thumbnailData ) ? strval( current( $thumbnailData ) ) : '';
} else {
	$thumbnail = '';
}
ob_start();
?>
var ssLinksParent = document.querySelector( '<?php echo esc_attr( $selector ); ?>' );
ssLinksParent?.addEventListener( 'keyup', function ( e ) {
var link = e.target.closest( '.vxt-ss__link' );
if ( link && e.keyCode === 13 ) {
	handleSocialLinkClick( link );
}
});

ssLinksParent?.addEventListener( 'click', function ( e ) {
var link = e.target.closest( '.vxt-ss__link' );
if ( link ) {
	handleSocialLinkClick( link );
}
});

function handleSocialLinkClick( link ) {
var social_url = link.dataset.href;
var target = "";
if ( social_url == "mailto:?body=" ) {
	target = "_self";
}
var request_url = "";
if ( social_url.indexOf("/pin/create/link/?url=") !== -1 ) {
	request_url = social_url + encodeURIComponent( window.location.href ) + "&media=" + '<?php echo esc_url( $thumbnail ); ?>';
} else {
	request_url = social_url + encodeURIComponent( window.location.href );
}
window.open( request_url, target );
}
<?php
return ob_get_clean();
?>
