<?php
/**
 * Frontend JS File.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

$blockName = 'image-gallery';
$selector   = '.vxt-block-' . $id;
$js         = '';

$isRtl = is_rtl();

$slickOptions = apply_filters(
	'vxt_ultimate_gutenberg_blocks_image_gallery_slick_options',
	[
		'arrows'        => is_bool( $attr['paginateUseArrows'] ) ? $attr['paginateUseArrows'] : true,
		'dots'          => is_bool( $attr['paginateUseDots'] ) ? $attr['paginateUseDots'] : true,
		'initialSlide'  => is_int( $attr['carouselStartAt'] ) ? $attr['carouselStartAt'] : (int) $attr['carouselStartAt'],
		'infinite'      => is_bool( $attr['carouselLoop'] ) ? $attr['carouselLoop'] : true,
		'autoplay'      => is_bool( $attr['carouselAutoplay'] ) ? $attr['carouselAutoplay'] : true,
		'autoplaySpeed' => is_int( $attr['carouselAutoplaySpeed'] ) ? $attr['carouselAutoplaySpeed'] : (int) $attr['carouselAutoplaySpeed'],
		'pauseOnHover'  => is_bool( $attr['carouselPauseOnHover'] ) ? $attr['carouselPauseOnHover'] : true,
		'speed'         => is_int( $attr['carouselTransitionSpeed'] ) ? $attr['carouselTransitionSpeed'] : (int) $attr['carouselTransitionSpeed'],
		'slidesToShow'  => is_int( $attr['columnsDesk'] ) ? $attr['columnsDesk'] : (int) $attr['columnsDesk'],
		'prevArrow'     => "<button type='button' data-role='none' class='vexaltrix-image-gallery__control-arrows vexaltrix-image-gallery__control-arrows--carousel slick-prev slick-arrow' aria-label='Previous' tabindex='0' role='button'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 512' width='" . esc_attr( $attr['paginateArrowSize'] ) . "' height='" . esc_attr( $attr['paginateArrowSize'] ) . "'><path d='M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z'></path></svg></button>",
		'nextArrow'     => "<button type='button' data-role='none' class='vexaltrix-image-gallery__control-arrows vexaltrix-image-gallery__control-arrows--carousel slick-next slick-arrow' aria-label='Previous' tabindex='0' role='button'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 512' width='" . esc_attr( $attr['paginateArrowSize'] ) . "' height='" . esc_attr( $attr['paginateArrowSize'] ) . "'><path d='M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z'></path></svg></button>",
		'rtl'           => $isRtl,
		'responsive'    => [
			[
				'breakpoint' => 1024,
				'settings'   => [
					'slidesToShow' => is_int( $attr['columnsTab'] ) ? $attr['columnsTab'] : (int) $attr['columnsTab'],
				],
			],
			[
				'breakpoint' => 767,
				'settings'   => [
					'slidesToShow' => is_int( $attr['columnsMob'] ) ? $attr['columnsMob'] : (int) $attr['columnsMob'],
				],
			],
		],
	],
	$id
);

// The Thumbnail Swiper Association is handled in the JS in Class Vexaltrix Image Gallery.
$lightboxOptions = apply_filters(
	'vxt_ultimate_gutenberg_blocks_image_gallery_lightbox_options',
	[
		'lazy'          => true,
		'slidesPerView' => 1,
		'navigation'    => [
			'nextEl' => $selector . '+.vexaltrix-image-gallery__control-lightbox .swiper-button-next',
			'prevEl' => $selector . '+.vexaltrix-image-gallery__control-lightbox .swiper-button-prev',
		],
		'keyboard'      => [
			'enabled' => true,
		],
	],
	$id
);

$thumbnailOptions = apply_filters(
	'vxt_ultimate_gutenberg_blocks_image_gallery_thumbnail_options',
	[
		'centeredSlides'        => true,
		'slidesPerView'         => 5,
		'slideToClickedSlide'   => true,
		'watchSlidesProgres'    => true,
		'watchSlidesVisibility' => true,
		// Swiper Breakpoints go Upward.
		'breakpoints'           => [
			768  => [
				'slidesPerView' => 7,
			],
			1024 => [
				'slidesPerView' => 9,
			],
		],
	],
	$id
);

$settings           = wp_json_encode( $slickOptions );
$lightboxSettings  = is_array( $lightboxOptions ) ? $lightboxOptions : [];
$thumbnailSettings = ( ! empty( $attr['lightboxThumbnails'] ) && is_array( $thumbnailOptions ) ) ? $thumbnailOptions : [];

if ( $attr['mediaGallery'] ) {
	switch ( $attr['feedLayout'] ) {
		case 'grid':
			$js = $attr['feedPagination']
				? \Vexaltrix\BlocksConfig\ImageGallery\ImageGallery::renderFrontendGridPagination( $id, $attr, $selector, $lightboxSettings, $thumbnailSettings )
				: '';
			break;
		case 'masonry':
			$js = \Vexaltrix\BlocksConfig\ImageGallery\ImageGallery::renderFrontendMasonryLayout( $id, $attr, $selector, $lightboxSettings, $thumbnailSettings );
			break;
		case 'carousel':
			$js = \Vexaltrix\BlocksConfig\ImageGallery\ImageGallery::renderFrontendCarouselLayout( $id, $settings, $selector );
			break;
		case 'tiled':
			$js = \Vexaltrix\BlocksConfig\ImageGallery\ImageGallery::renderFrontendTiledLayout( $id );
			break;
	}
	switch ( $attr['imageClickEvent'] ) {
		case 'lightbox':
			$js .= \Vexaltrix\BlocksConfig\ImageGallery\ImageGallery::renderFrontendLightbox( $id, $attr, $lightboxSettings, $thumbnailSettings, $selector );
			break;
		case 'image':
			$js .= \Vexaltrix\BlocksConfig\ImageGallery\ImageGallery::renderImageClick( $id, $attr );
			break;
		case 'url':
			$js = apply_filters( 'vxt_ultimate_gutenberg_blocks_image_gallery_pro_custom_url_js', $js, $id, $attr );
			break;
	}
}

// Touch device detection: add class for CSS overrides on phones/tablets.
// Only for 'antiHover' and 'always' — 'hover' (Show On Hover) stays hidden by design.
if ( $attr['imageDisplayCaption'] && 'hover' !== $attr['captionVisibility'] ) {
	$js .= 'jQuery(document).ready(function(){if(window.matchMedia&&window.matchMedia("(hover:none)").matches){jQuery(".wp-block-vxt-image-gallery' . $selector . '").addClass("vexaltrix-touch-device");}});';
}

return $js;
