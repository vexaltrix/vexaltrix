<?php
/**
 * Frontend JS File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$baseSelector = '.vxt-block-';
$selector      = $baseSelector . $id;
$jsAttr       = [
	'c_id'              => $attr['c_id'],
	'cookies'           => $attr['cookies'],
	'close_cookie_days' => $attr['close_cookie_days'],
	'noticeDismiss'     => $attr['noticeDismiss'],
	'icon'              => $attr['icon'],
];

ob_start();
?>
window.addEventListener( 'DOMContentLoaded', function() {
	VexaltrixInlineNotice.init( <?php echo wp_json_encode( $jsAttr ); ?>, '<?php echo esc_attr( $selector ); ?>' );
});
<?php
return ob_get_clean();
