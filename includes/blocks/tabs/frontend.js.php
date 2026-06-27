<?php
/**
 * Frontend JS File.
 *
 * @since 2.0.0
 * @var int $id
 *
 * @package ugb
 */

$selector = '.vxt-block-' . $id;
ob_start();
?>
window.addEventListener( 'load', function() {
	VexaltrixTabs.init( '<?php echo esc_attr( $selector ); ?>' );
	VexaltrixTabs.anchorTabId( '<?php echo esc_attr( $selector ); ?>' );
});
window.addEventListener( 'hashchange', function() {
	VexaltrixTabs.anchorTabId( '<?php echo esc_attr( $selector ); ?>' );
}, false );
<?php
return ob_get_clean();
?>
