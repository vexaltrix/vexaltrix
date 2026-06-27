<?php
/**
 * Frontend JS File.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

$selector = '.vxt-block-' . $id;

$counterOptions = apply_filters(
	'vxt_ultimate_gutenberg_blocks_counter_options',
	[
		'layout'            => $attr['layout'],
		'heading'           => $attr['heading'],
		'numberPrefix'      => $attr['numberPrefix'],
		'numberSuffix'      => $attr['numberSuffix'],
		'startNumber'       => $attr['startNumber'],
		'endNumber'         => $attr['endNumber'],
		'totalNumber'       => $attr['totalNumber'],
		'decimalPlaces'     => $attr['decimalPlaces'],
		'animationDuration' => $attr['animationDuration'],
		'thousandSeparator' => $attr['thousandSeparator'],
		'circleSize'        => $attr['circleSize'],
		'circleStokeSize'   => $attr['circleStokeSize'],
		'isFrontend'        => $attr['isFrontend'],
	],
	$id
);

ob_start();
?>
window.addEventListener( 'load', function() {
	VexaltrixCounter.init( '<?php echo esc_attr( $selector ); ?>', <?php echo wp_json_encode( $counterOptions ); ?> );
});
<?php
return ob_get_clean();
?>
