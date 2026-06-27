<?php
/**
 * Frontend JS File.
 * 
 * @var int $id
 * @since 2.13.1
 *
 * @package ugb
 */

$selector = '.vxt-block-' . $id;

ob_start();
?>
window.addEventListener( 'load', function() {
	VexaltrixButtonChild.init( '<?php echo esc_attr( $selector ); ?>' );
});
<?php
return ob_get_clean();
?>
