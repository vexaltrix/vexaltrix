<?php
/**
 * Frontend JS File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$selector = '.vxt-block-' . $id;

$timelineAlignment       = $attr['timelinAlignment'];
$timelineAlignmentTablet = ! empty( $attr['timelinAlignmentTablet'] ) ? $attr['timelinAlignmentTablet'] : $attr['timelinAlignment'];
$timelineAlignmentMobile = ! empty( $attr['timelinAlignmentMobile'] ) ? $attr['timelinAlignmentMobile'] : $timelineAlignmentTablet;

$jsAttr = [
	'block_id'               => $attr['block_id'],
	'timelinAlignment'       => $timelineAlignment,
	'timelinAlignmentTablet' => $timelineAlignmentTablet,
	'timelinAlignmentMobile' => $timelineAlignmentMobile,
];
ob_start();
?>
window.addEventListener("DOMContentLoaded", function(){
	VexaltrixTimelineClasses( <?php echo wp_json_encode( $jsAttr ); ?>, '<?php echo esc_attr( $selector ); ?>' );
});
window.addEventListener("resize", function(){
	VexaltrixTimelineClasses( <?php echo wp_json_encode( $jsAttr ); ?>, '<?php echo esc_attr( $selector ); ?>' );
});
<?php
return ob_get_clean();
?>
