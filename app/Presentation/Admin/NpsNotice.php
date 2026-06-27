<?php
/**
 * Vexaltrix NPS Notice.
 *
 * @since 2.18.0
 *
 * @package vexaltrix
 */

namespace Vexaltrix\Presentation\Admin;

use Vexaltrix\Core\Contracts\ServiceInterface;

use Nps_Survey;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vexaltrix\Presentation\Admin\\NpsNotice' ) ) :

	/**
	 * Class \Vexaltrix\Presentation\Admin\NpsNotice
	 */
	class NpsNotice implements ServiceInterface {
		/**
		 * Instance
		 *
		 * @since 2.18.0
		 * @var (Object) \Vexaltrix\Presentation\Admin\NpsNotice
		 */
		private static $instance = null;

		/**
		 * Get Instance
		 *
		 * @since 2.18.0
		 *
		 * @return object Class object.
		 */
		public static function getInstance() {
			return \Vexaltrix\Core\Container::getInstance()->get( self::class );
		}

		/**
		 * Constructor.
		 *
		 * @since 2.18.0
		 */
		private function __construct() {
			add_action( 'admin_footer', [ $this, 'showNpsNotice' ], 999 );
		}

		/**
		 * Render NPS Survey
		 *
		 * @since 2.18.0
		 * @return void
		 */
		public function showNpsNotice() {
			// Ensure the Nps_Survey class exists before proceeding.
			if ( ! class_exists( 'Nps_Survey' ) ) {
				return;
			}

			/* 
				Check if the constant WEEK_IN_SECONDS is already defined.
				This ensures that the constant is not redefined if it's already set by WordPress or other parts of the code.
			*/
			if ( ! defined( 'WEEK_IN_SECONDS' ) ) {
				// Define the WEEK_IN_SECONDS constant with the value of 604800 seconds (equivalent to 7 days).
				define( 'WEEK_IN_SECONDS', 604800 );
			}
			$allowedScreens = [ 'toplevel_page_vexaltrix', 'edit-vexaltrix-popup' ];

			// Display the NPS survey.
			Nps_Survey::show_nps_notice(
				'nps-survey-vexaltrix',
				[

					'show_if'          => true,
					'dismiss_timespan' => 2 * WEEK_IN_SECONDS,
					'display_after'    => 2 * WEEK_IN_SECONDS,
					'plugin_slug'      => 'vexaltrix',
					'show_on_screens'  => $allowedScreens,
					'message'          => [

						'logo'                        => esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/logos/vexaltrix.svg' ),
						'plugin_name'                 => __('Vexaltrix', 'vexaltrix' ),
						'nps_rating_message'          => __( 'How likely are you to recommend Vexaltrix to your friends or colleagues?', 'vexaltrix' ),
						'feedback_title'              => __( 'Thanks a lot for your feedback! 😍', 'vexaltrix' ),
						'feedback_content'            => __( 'Could you please do us a favor and give us a 5-star rating on WordPress? It would help others choose Vexaltrix with confidence. Thank you!', 'vexaltrix' ),
						'plugin_rating_link'          => esc_url( 'https://wordpress.org/support/plugin/vexaltrix/reviews/#new-post' ),
						'plugin_rating_title'         => __( 'Thank you for your feedback', 'vexaltrix' ),
						'plugin_rating_content'       => __( 'We value your input. How can we improve your experience?', 'vexaltrix' ),
						'plugin_rating_button_string' => __( 'Rate Vexaltrix', 'vexaltrix' ),

					],

				]
			);
		}
	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'presentation';
	}

	/**
	 * Service context.
	 *
	 * @return string
	 */
	public static function context(): string {
		return 'admin';
	}

	/**
	 * Boot priority.
	 *
	 * @return int
	 */
	public static function priority(): int {
		return 20;
	}

	/**
	 * Register actions and filters.
	 *
	 * @return void
	 */
	public function boot(): void {
		// Auto-generated boot method.
	}

}

	/**
	 * Initialize the class.
	 */
endif;
