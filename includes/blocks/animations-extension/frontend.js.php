<?php
/**
 * Frontend JS File.
 *
 * @since 2.6.0
 *
 * @package ugb
 */

$selector = '.vxt-block-' . $id;

$animationData = apply_filters(
	'vxt_ultimate_gutenberg_blocks_animation_data',
	[
		'UAGAnimationType' => $attr['UAGAnimationType'],
	],
	$id
);

ob_start();
?>
window.addEventListener( 'load', function() {
	VexaltrixAnimation.init( <?php echo wp_json_encode( $animationData ); ?> );
} );
<?php
return ob_get_clean();
?>
