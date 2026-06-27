<?php
/**
 * Vexaltrix - Popup Builder
 *
 * @package Vexaltrix
 *
 * @since 2.6.0
 */

namespace Vexaltrix\BlocksConfig\PopupBuilder;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\BlocksConfig\PopupBuilder\PopupBuilder.
 *
 * @since 2.6.0
 */
class PopupBuilder {

	/**
	 * Post ID Member Variable.
	 *
	 * @var int $postId
	 *
	 * @since 2.6.0
	 */
	protected $popupId;

	/**
	 * Member Variable for all Popup IDs needed to be rendered on the given page.
	 *
	 * @var array $popupIds
	 *
	 * @since 2.6.0
	 */
	protected $popupIds;

	/**
	 * Constructor to Default the Current Instance's Post ID and add the Shortcode if needed.
	 * 
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function __construct() {
		$this->popupId   = 0;
		$this->popupIds = [];

		if ( ! shortcode_exists( 'vexaltrix_popup' ) ) {
			add_shortcode( 'vexaltrix_popup', [ $this, 'vexaltrixPopupShortcode' ] );
		}
	}

	/**
	 * Create Instance for the Admin Dashboard.
	 *
	 * @return object  Initialized object of this class.
	 *
	 * @since 2.6.0
	 */
	public static function createForAdmin() {
		$instance = new self();
		add_action( 'vxt_after_menu_register', [ $instance, 'addPopupBuilderSubmenu' ] );
		return $instance;
	}

	/**
	 * Create Instance with Script Generation.
	 *
	 * @return object  Initialized object of this class.
	 *
	 * @since 2.6.0
	 */
	public static function generateScripts() {
		$instance = new self();
		add_action( 'wp_enqueue_scripts', [ $instance, 'enqueuePopupScriptsForPost' ], 1 );
		return $instance;
	}

	/**
	 * Add the Popup Builder Submenu to the Vexaltrix Menu.
	 *
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function addPopupBuilderSubmenu() {
		add_submenu_page(
			'vexaltrix',
			__( 'Popup Builder', 'vexaltrix' ),
			__( 'Popup Builder', 'vexaltrix' ),
			'manage_options',
			'edit.php?post_type=vexaltrix-popup'
		);
	}

	/**
	 * Enqueue all popup scripts for the current post.
	 *
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function enqueuePopupScriptsForPost() {
		if ( ! is_front_page() ) {
			$this->popupId = get_the_ID();
		}
		$elementorPreviewActive = false;
		if ( defined( 'ELEMENTOR_VERSION' ) ) { // Check if elementor is active.
			$elementorPreviewActive = \Elementor\Plugin::$instance->preview->is_preview_mode(); 
		}
		if ( 'vexaltrix-popup' === get_post_type( $this->popupId ) || $elementorPreviewActive ) {
			return;
		}
		$this->enqueuePopupScripts();
	}

	/**
	 * Generate Shortcode Content.
	 *
	 * @param array $attr   The shortcode attributes.
	 * @return string|void  The output buffer or void for early return.
	 *
	 * @since 2.6.0
	 */
	public function vexaltrixPopupShortcode( $attr ) {
		$attr = shortcode_atts(
			[
				'id' => 0,
			],
			$attr,
			'vexaltrix_popup'
		);

		if ( empty( $attr['id'] ) ) {
			return;
		}

		$popup = get_post( $attr['id'] );
		if ( ! ( $popup instanceof WP_Post ) ) {
			return;
		}

		// Prevent unauthorized access to non-published (private/draft) popups via shortcode.
		if ( 'publish' !== $popup->post_status && ! current_user_can( 'read_post', $popup->ID ) ) {
			return;
		}
		
		$popupType = get_post_meta( $attr['id'], 'vexaltrix-popup-type', true );
		if ( 'unset' === $popupType ) {
			return;
		}

		$popupEnabled = get_post_meta( $attr['id'], 'vexaltrix-popup-enabled', true );
		if ( ! $popupEnabled ) {
			return;
		}

		ob_start();
		echo do_shortcode( do_blocks( $popup->post_content ) );
		$output = ob_get_clean();

		return is_string( $output ) ? $output : '';
	}

	/**
	 * Enqueue all the Vexaltrix Popup Scripts needed on the given post.
	 *
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function enqueuePopupScripts() {
		$args   = [
			'post_type'      => 'vexaltrix-popup',
			'posts_per_page' => -1,
			'meta_query'     => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				[
					'key'     => 'vexaltrix-popup-enabled', // The meta key.
					'value'   => true, // The meta value to compare with.
					'compare' => '=', // The comparison type.
					'type'    => 'BOOLEAN', // The meta value type.
				],
			],
		];
		$popups = new WP_Query( $args );

		while ( $popups->have_posts() ) :
			$popups->the_post();

			$popupId = get_the_ID();

			$renderThisPopup = apply_filters( 'vexaltrix_pro_popup_display_filters', true, $this->popupId );

			if ( $renderThisPopup ) {
				$currentPopupAssets = new \Vexaltrix\Assets\PostAssets( $popupId );
				$currentPopupAssets->enqueueScripts();
				if ( is_array( $this->popupIds ) ) {
					array_push( $this->popupIds, $popupId );
				}
			}
		endwhile;
		wp_reset_postdata();
		add_action( 'wp_body_open', [ $this, 'generatePopupShortcode' ] );
	}

	/**
	 * Generate the popup shortcodes needed.
	 *
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function generatePopupShortcode() {
		if ( is_array( $this->popupIds ) && ! empty( $this->popupIds ) ) {
			foreach ( $this->popupIds as $popupId ) {
				echo do_shortcode( '[vexaltrix_popup id=' . esc_attr( $popupId ) . ']' );
			}
		}
	}

	/**
	 * Adds or removes list table column headings for the Popup Builder.
	 *
	 * @param array $columns  Array of columns.
	 * @return array
	 *
	 * @since 2.6.0
	 */
	public static function popupBuilderAdminHeadings( $columns ) {
		unset( $columns['date'] );
		unset( $columns['author'] );

		$columns['vexaltrix_popup_type'] = __( 'Type', 'vexaltrix' );
		$columns['author']             = __( 'Author', 'vexaltrix' );

		$updatedColumns = apply_filters( 'vexaltrix_pro_admin_popup_list_titles', $columns );
		if ( ! is_array( $updatedColumns ) || empty( $updatedColumns ) ) {
			$updatedColumns = $columns;
		}

		$updatedColumns['vexaltrix_popup_toggle'] = __( 'Enable/Disable', 'vexaltrix' );

		return $updatedColumns;
	}

	/**
	 * Adds the custom list table column content for the Popup Builder.
	 *
	 * @param string $column   Name of the column.
	 * @param int    $postId  Post id.
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function popupBuilderAdminContent( $column, $postId ) {
		switch ( $column ) {
			case 'vexaltrix_popup_type':
				$layout = get_post_meta( $postId, 'vexaltrix-popup-type', true );
				if ( ! is_string( $layout ) ) {
					break;
				}
				switch ( $layout ) {
					case 'banner':
						echo esc_html__( 'Info Bar', 'vexaltrix' );
						break;
					case 'popup':
						echo esc_html__( 'Popup', 'vexaltrix' );
						break;
					default:
						echo esc_html__( 'Unset', 'vexaltrix' );
						break;
				}
				break;
			case 'vexaltrix_popup_toggle':
				$layout = get_post_meta( $postId, 'vexaltrix-popup-type', true );
				if ( ! is_string( $layout ) ) {
					break;
				}
				$enabled      = get_post_meta( $postId, 'vexaltrix-popup-enabled', true );
				$toggleClass = 'vexaltrix-popup-builder__switch';
				if ( is_rtl() ) {
					$toggleClass .= ' is-rtl-toggle';
				}

				if ( 'unset' === $layout ) {
					$toggleClass .= ' vexaltrix-popup-builder__switch--disabled';
				} elseif ( $enabled ) {
					$toggleClass .= ' vexaltrix-popup-builder__switch--active';
				}

				echo '<div class="' . esc_attr( $toggleClass ) . '" data-popupId="' . esc_attr( $postId ) . '"><span></span></div>';
				break;
			default:
				do_action( 'vexaltrix_pro_admin_popup_list_content', $column, $postId );
				break;
		}
	}

	/**
	 * Enqueues scripts for the Toggle Button in the Popup Table.
	 *
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function popupToggleScripts() {

		global $pagenow;

		$screen = get_current_screen();

		if ( 'vexaltrix-popup' === $screen->post_type && 'edit.php' === $pagenow ) {
			$extension = SCRIPT_DEBUG ? '' : '.min';
			wp_register_script(
				'vxt-popup-builder-admin-js',
				VXT_URL . 'assets/js/popup-builder-admin' . $extension . '.js',
				[],
				VXT_VER,
				false
			);
			wp_register_style(
				'vxt-popup-builder-admin-css',
				VXT_URL . 'assets/css/popup-builder-admin' . $extension . '.css',
				[],
				VXT_VER
			);

			wp_localize_script(
				'vxt-popup-builder-admin-js',
				'vxt_ultimate_gutenberg_blocks_popup_builder_admin',
				[
					'ajax_url'                       => admin_url( 'admin-ajax.php' ),
					'vxt_ultimate_gutenberg_blocks_popup_builder_admin_nonce' => wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_popup_builder_admin_nonce' ),
				]
			);
			wp_enqueue_script( 'vxt-popup-builder-admin-js' );
			wp_enqueue_style( 'vxt-popup-builder-admin-css' );
		}
	}

	/**
	 * Update the Current Popup's Meta from Admin Table.
	 *
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function updatePopupStatus() {
		check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_popup_builder_admin_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error();
		}

		if ( ! isset( $_POST['enabled'] ) || ! isset( $_POST['popupId'] ) ) {
			wp_send_json_error();
		}

		$enabled  = rest_sanitize_boolean( sanitize_text_field( $_POST['enabled'] ) );
		$popupId = sanitize_text_field( $_POST['popupId'] );

		update_post_meta( $popupId, 'vexaltrix-popup-enabled', $enabled );

		wp_send_json_success();
	}
}
