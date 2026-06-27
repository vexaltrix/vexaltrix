<?php
/**
 * Frontend JS File.
 *
 * @since 2.3.0
 * @var mixed[] $attr
 * @var int $id
 * @package ugb
 */

$selector   = '.vxt-block-' . $id . ' .vxt-swiper';
$blockName = 'slider';

$sliderOptions = apply_filters(
	'vxt_ultimate_gutenberg_blocks_slider_options',
	[
		'autoplay'   => $attr['autoplay'] ? [
			'delay'                => is_int( $attr['autoplaySpeed'] ) ? $attr['autoplaySpeed'] : (int) $attr['autoplaySpeed'],
			'disableOnInteraction' => 'click' === $attr['pauseOn'] ? true : false,
			'pauseOnMouseEnter'    => 'hover' === $attr['pauseOn'] ? true : false,
			'stopOnLastSlide'      => $attr['infiniteLoop'] ? false : true,
		] : false,
		'loop'       => is_bool( $attr['infiniteLoop'] ) ? $attr['infiniteLoop'] : true,
		'speed'      => is_int( $attr['transitionSpeed'] ) ? $attr['transitionSpeed'] : (int) $attr['transitionSpeed'],
		'effect'     => $attr['transitionEffect'],
		'direction'  => $attr['verticalMode'] ? 'vertical' : 'horizontal',
		'flipEffect' => [
			'slideShadows' => false,
		],
		'fadeEffect' => [
			'crossFade' => true,
		],
		'pagination' => (bool) $attr['displayDots'] ? [
			'el'          => '.vxt-block-' . $id . ' .swiper-pagination',
			'clickable'   => true,
			'hideOnClick' => false,
		] : false,
		'navigation' => (bool) $attr['displayArrows'] ? [
			'nextEl' => '.vxt-block-' . $id . ' .swiper-button-next',
			'prevEl' => '.vxt-block-' . $id . ' .swiper-button-prev',
		] : false,
	],
	$attr
);

ob_start();
?>
window.addEventListener("DOMContentLoaded", function(){
	var swiper = new Swiper( "<?php echo esc_attr( $selector ); ?>",
		<?php echo wp_json_encode( $sliderOptions ); ?>
	);
});

<?php

do_action( 'vexaltrix_after_slider_options_loaded', $attr );

return ob_get_clean();
?>
