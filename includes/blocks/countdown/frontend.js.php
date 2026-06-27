<?php
/**
 * Frontend JS File.
 *
 * @since 2.4.0
 *
 * @package ugb
 */

$selector = '.vxt-block-' . $id;

$countdownOptions = apply_filters(
	'vxt_ultimate_gutenberg_blocks_countdown_options',
	[
		'block_id'       => $attr['block_id'],
		'endDateTime'    => $attr['endDateTime'],
		'showDays'       => $attr['showDays'],
		'showHours'      => $attr['showHours'],
		'showMinutes'    => $attr['showMinutes'],
		'isFrontend'     => true,
		'timerEndAction' => $attr['timerEndAction'],
		'redirectURL'    => $attr['redirectURL'],
	],
	$id,
	$attr
);

ob_start();
?>
window.addEventListener( 'load', function() {
	VexaltrixCountdown.init( '<?php echo esc_attr( $selector ); ?>', <?php echo wp_json_encode( $countdownOptions ); ?> );
});
<?php
$dynamicJs = apply_filters( 'vexaltrix_countdown_frontend_dynamic_js', ob_get_clean(), $selector, $countdownOptions );
return $dynamicJs;
?>
