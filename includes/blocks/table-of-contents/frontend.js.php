<?php
/**
 * Frontend JS File.
 *
 * @since 2.0.0
 * @var mixed[] $attr
 * @var int $id
 *
 * @package ugb
 */

$baseSelector = ( isset( $attr['classMigrate'] ) && $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-toc-';
$selector      = $baseSelector . $id;

$attrsNeededInJs = [
	'mappingHeaders'        => $attr['mappingHeaders'],
	'scrollToTop'           => $attr['scrollToTop'],
	'makeCollapsible'       => $attr['makeCollapsible'],
	'enableCollapsableList' => $attr['enableCollapsableList'],
	'initialCollapse'       => $attr['initialCollapse'],
	'markerView'            => $attr['markerView'],
	'isFrontend'            => true,
	'initiallyCollapseList' => $attr['initiallyCollapseList'],
];

ob_start();
?>
window.addEventListener( 'load', function(){
	VexaltrixTableOfContents._run( <?php echo wp_json_encode( $attrsNeededInJs ); ?>, '<?php echo esc_attr( $selector ); ?>' );
} );
<?php
return ob_get_clean();
?>
