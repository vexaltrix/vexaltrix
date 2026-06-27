<?php
/**
 * Frontend JS File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$baseSelector = 'vxt-block-';
$selector      = $baseSelector . $id;

ob_start();
?>
window.addEventListener( 'DOMContentLoaded', function() {
	VexaltrixLottie._run( <?php echo wp_json_encode( $attr ); ?>, '<?php echo esc_attr( $selector ); ?>' );
});
<?php
return ob_get_clean();
?>
