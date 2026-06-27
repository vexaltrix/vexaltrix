<?php
/**
 * Frontend JS File.
 *
 * @since 2.2.0
 * @var mixed[] $attr
 * @var int $id
 * @package ugb
 */

$selector = '.vxt-block-' . $id;
ob_start();
?>
	window.addEventListener( 'DOMContentLoaded', function() {
		VexaltrixModal.init( '<?php echo esc_attr( $selector ); ?>' );
	});
<?php
$dynamicJs = apply_filters( 'vexaltrix_modal_frontend_dynamic_js', ob_get_clean(), $selector, $attr );
return $dynamicJs;
?>
