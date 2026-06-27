<?php
/**
 * Frontend JS File.
 *
 * @since 2.8.0
 * @package ugb
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined elsewhere.
 *
 * @var int $id  The block ID.
 */

$selector = '.vxt-block-' . $id;
$js       = '';

if ( ! empty( $attr['UAGPosition'] ) && is_string( $attr['UAGPosition'] ) ) {
	$positionAttrs = array_merge(
		$attr,
		[
			'UAGStickyLocation'   => ! empty( $attr['UAGStickyLocation'] ) ? $attr['UAGStickyLocation'] : 'top',
			'UAGStickyRestricted' => ! empty( $attr['UAGStickyRestricted'] ) ? $attr['UAGStickyRestricted'] : false,
			'UAGStickyOffset'     => ( ! empty( $attr['UAGStickyOffset'] ) && is_numeric( $attr['UAGStickyOffset'] ) ) ? $attr['UAGStickyOffset'] : 0,
		]
	);

	ob_start();
	?>
	window.addEventListener("load", function(){
		VexaltrixBlockPositioning.init( <?php echo wp_json_encode( $positionAttrs ); ?>, "<?php echo esc_attr( $selector ); ?>" );
	});
	<?php

	$js = ob_get_clean();
}

return $js;
?>
