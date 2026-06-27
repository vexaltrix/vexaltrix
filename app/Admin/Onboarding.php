<?php
/**
 * Vexaltrix Onboarding.
 *
 * Registers Vexaltrix with the One Onboarding library and handles
 * completion hooks for analytics, consent, and lead capture.
 *
 * @since 2.19.23
 * @package Vexaltrix
 */

namespace Vexaltrix\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vexaltrix\\Admin\\Onboarding' ) ) {

	/**
	 * Class \Vexaltrix\Admin\Onboarding.
	 *
	 * @since 2.19.23
	 */
	class Onboarding {

		/**
		 * Instance.
		 *
		 * @var \Vexaltrix\Admin\Onboarding|null
		 * @since 2.19.23
		 */
		private static $instance = null;

		/**
		 * Get instance.
		 *
		 * @since 2.19.23
		 * @return \Vexaltrix\Admin\Onboarding
		 */
		public static function getInstance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @since 2.19.23
		 */
		private function __construct() {
			add_action( 'init', [ $this, 'registerOnboarding' ], 15 );
			add_filter( 'wp_privacy_personal_data_exporters', [ $this, 'registerDataExporter' ] );
			add_filter( 'wp_privacy_personal_data_erasers', [ $this, 'registerDataEraser' ] );
		}

		/**
		 * Register Vexaltrix with One Onboarding.
		 *
		 * @since 2.19.23
		 * @return void
		 */
		public function registerOnboarding() {
			if ( ! class_exists( '\One_Onboarding\Core\Register' ) ) {
				return;
			}

			\One_Onboarding\Core\Register::register_product(
				'vxt',
				[
					'title'       => __( 'Vexaltrix Onboarding', 'vexaltrix' ),
					'product'     => [
						'id'   => 'vxt',
						'name' => __('Vexaltrix', 'vexaltrix' ),
					],
					'logo'        => VXT_URL . 'assets/images/logos/vexaltrix.svg',
					'screens'     => [
						'welcome'   => [
							'heading'     => __( 'Welcome to Vexaltrix', 'vexaltrix' ),
							'description' => __( 'Build a fast, beautiful WordPress site—effortlessly.', 'vexaltrix' ),
							'banner'      => [
								'type'      => 'video',
								'url'       => 'https://www.youtube-nocookie.com/embed/GLNzTxArR6Y?showinfo=0&autoplay=1&modestbranding=1&rel=0',
								'title'     => __( 'Getting Started with Vexaltrix', 'vexaltrix' ),
								'thumbnail' => VXT_URL . 'assets/admin/images/placeholder.png',
							],
							'items'       => [
								__( 'Trusted by 1.8M+ websites worldwide', 'vexaltrix' ),
								__( 'Import ready-made patterns & templates', 'vexaltrix' ),
								__( 'Easy customization—no coding or design skills', 'vexaltrix' ),
								__( 'Drag & Drop blocks to build your layout', 'vexaltrix' ),
							],
						],
						'user-info' => [
							'description'    => __( 'Get helpful updates, new features, and tips to make your website better—while helping us improve Vexaltrix.', 'vexaltrix' ),
							'sourceOptions'  => [
								'wordpress' => __( 'WordPress Plugin Directory', 'vexaltrix' ),
								'google'    => __( 'Google Search', 'vexaltrix' ),
								'social'    => __( 'Social Media', 'vexaltrix' ),
								'youtube'   => __( 'YouTube', 'vexaltrix' ),
								'friend'    => __( 'A friend or colleague', 'vexaltrix' ),
								'other'     => __( 'Other', 'vexaltrix' ),
							],
							'benefitOptions' => [
								'design-flexibility'  => __( 'Advanced design flexibility without bloated builders', 'vexaltrix' ),
								'ai-and-templates'    => __( 'AI and templates help me design quickly', 'vexaltrix' ),
								'fast-loading'        => __( 'I need a fast-loading page builder', 'vexaltrix' ),
								'updates-and-support' => __( 'Regular updates and support from Brainstorm Force', 'vexaltrix' ),
								'other'               => __( 'Other (please specify)', 'vexaltrix' ),
							],
							'privacyPolicy'  => [
								'url'   => 'https://store.brainstormforce.com/usage-tracking/?utm_source=vexaltrix_dashboard&utm_medium=onboarding&utm_campaign=link',
								'label' => __( 'Privacy Policy', 'vexaltrix' ),
							],
							'optIn'          => [
								'description'  => __( 'Stay in the loop and help shape Vexaltrix! Get feature updates, and help us build a better Vexaltrix by sharing how you use the plugin.', 'vexaltrix' ),
								'learnMoreUrl' => 'https://store.brainstormforce.com/usage-tracking/?utm_source=vexaltrix_dashboard&utm_medium=onboarding&utm_campaign=link',
							],
						],
						'features'  => [
							'description' => __( 'Enable the features you need to design faster and build better with Vexaltrix.', 'vexaltrix' ),
							'featureList' => self::getFeatureList(),
							'upgradeUrl'  => 'https://wpvexaltrix.com/pricing/?utm_source=vexaltrix_dashboard&utm_medium=onboarding&utm_campaign=pro-features',
						],
						'add-ons'   => [
							'addonList' => self::getAddonList(),
						],
						'done'      => [
							'items' => [
								__( 'Create a Page', 'vexaltrix' ),
								__( 'Visit Dashboard', 'vexaltrix' ),
								__( 'View Documentation', 'vexaltrix' ),
							],
							'cta1'  => [
								'url'   => admin_url( 'post-new.php?post_type=page' ),
								'label' => __( 'Create a Page', 'vexaltrix' ),
							],
							'cta2'  => [
								'url'   => admin_url( 'admin.php?page=vexaltrix' ),
								'label' => __( 'Visit Dashboard', 'vexaltrix' ),
							],
							'cta3'  => [
								'url'   => 'https://wpvexaltrix.com/docs/?utm_source=vexaltrix_dashboard&utm_medium=onboarding',
								'label' => __( 'Docs & Help Center', 'vexaltrix' ),
							],
						],
					],
					'exit'        => [
						'url' => admin_url( 'admin.php?page=vexaltrix' ),
					],
					'colors'      => [],
					'option_name' => 'vexaltrix_onboarding',
					'pro_status'  => self::getProStatus(),
					'pro_slug'    => 'vexaltrix-pro',
				]
			);

			// Completion hooks.
			add_action( 'one_onboarding_completion_vxt', [ $this, 'handleOnboardingCompletion' ], 10, 2 );
			add_action( 'one_onboarding_plugin_activated', [ $this, 'handlePluginActivated' ] );
		}

		/**
		 * Get Vexaltrix Pro plugin status.
		 *
		 * @since 2.19.23
		 * @return string
		 */
		private static function getProStatus() {
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			if ( is_plugin_active( 'vexaltrix-pro/vexaltrix-pro.php' ) ) {
				return 'Activated';
			}

			$allPlugins = get_plugins();
			if ( isset( $allPlugins['vexaltrix-pro/vexaltrix-pro.php'] ) ) {
				return 'Installed';
			}

			return 'Not Installed';
		}

		/**
		 * Handle onboarding completion.
		 *
		 * @since 2.19.23
		 * @param array            $completionData Onboarding state, user info, product details.
		 * @param \WP_REST_Request $request         REST request object.
		 * @return void
		 */
		public function handleOnboardingCompletion( $completionData, $request ) {
			$screens = isset( $completionData['screens'] ) ? $completionData['screens'] : [];

			$isUserInfoSkipped = true;
			foreach ( $screens as $screen ) {
				if ( 'user-info' === $screen['id'] ) {
					$isUserInfoSkipped = isset( $screen['skipped'] ) ? $screen['skipped'] : true;
				}
			}

			// Update analytics opt-in and send lead if user-info was not skipped.
			if ( ! $isUserInfoSkipped ) {
				$userInfo = isset( $completionData['user_info'] ) ? $completionData['user_info'] : [];
				$optin     = ! empty( $userInfo['optIn'] );

				// Update analytics opt-in.
				update_site_option( 'vexaltrix_usage_optin', $optin ? 'yes' : 'no' );

				// Only send lead to CRM if user opted in.
				if ( $optin ) {
					self::generateLead( $userInfo );
				}
			}

			// Track onboarding completion event.
			if ( class_exists( 'Vexaltrix\\Core\\Analytics\\AnalyticsEvents' ) ) {
				$skippedSteps = [];
				foreach ( $screens as $screen ) {
					if ( ! empty( $screen['skipped'] ) ) {
						$skippedSteps[] = sanitize_text_field( $screen['id'] );
					}
				}

				$properties = [];
				if ( ! empty( $skippedSteps ) ) {
					$properties['skipped_steps'] = implode( ',', $skippedSteps );
				}

				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'onboarding_completed', '', $properties );
			}
		}

		/**
		 * Handle plugin activation from onboarding add-ons step.
		 *
		 * @since 2.19.23
		 * @param string $slug Plugin slug.
		 * @return void
		 */
		public function handlePluginActivated( $slug ) {
			if ( empty( $slug ) ) {
				return;
			}

			if ( class_exists( 'BSF_UTM_Analytics' ) && is_callable( [ 'BSF_UTM_Analytics', 'update_referer' ] ) ) {
				BSF_UTM_Analytics::update_referer( 'vexaltrix', $slug );
			}
		}

		/**
		 * Check if onboarding has been completed.
		 *
		 * @since 2.19.23
		 * @return bool
		 */
		public static function isOnboardingCompleted() {
			$data = get_option( 'vexaltrix_onboarding', [] );
			return ! empty( $data );
		}

		/**
		 * Get feature list for the features step.
		 *
		 * @since 2.19.23
		 * @return array<int, array<string, mixed>>
		 */
		public static function getFeatureList() {
			return [
				[
					'title'       => __( 'Design System (Global Styles)', 'vexaltrix' ),
					'description' => __( 'Set global colors and typography to keep your design consistent across your website.', 'vexaltrix' ),
				],
				[
					'title'       => __( 'Advanced Layout Controls', 'vexaltrix' ),
					'description' => __( 'Build flexible layouts with containers, spacing, and responsive controls.', 'vexaltrix' ),
				],
				[
					'title'       => __( 'Popup Builder', 'vexaltrix' ),
					'description' => __( 'Create engaging popups for promotions, announcements, and lead generation.', 'vexaltrix' ),
				],
				[
					'id'          => 'dynamic-content',
					'title'       => __( 'Dynamic Content', 'vexaltrix' ),
					'description' => __( 'Connect your content and display dynamic data across your website with ease.', 'vexaltrix' ),
					'isPro'       => true,
				],
				[
					'id'          => 'loop-builder',
					'title'       => __( 'Loop Builder', 'vexaltrix' ),
					'description' => __( 'Design custom layouts for blog posts, archives, and dynamic content.', 'vexaltrix' ),
					'isPro'       => true,
				],
				[
					'id'          => 'login-register',
					'title'       => __( 'Login & Registration Forms', 'vexaltrix' ),
					'description' => __( 'Create custom login and registration forms to manage user access on your website.', 'vexaltrix' ),
					'isPro'       => true,
				],
			];
		}

		/**
		 * Get addon SVG icons.
		 *
		 * @since 2.19.23
		 * @return array<string, string>
		 */
		private static function getAddonIcons() {
			return [
				'starter-templates' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="#6005FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
				'surerank'          => '<svg xmlns="http://www.w3.org/2000/svg" width="102" height="115" viewBox="0 0 102 115" fill="none"><path d="M101.177 42.6533C101.177 19.2953 82.3389 0.365723 59.094 0.365723H0.189453V114.516H10.088C27.2714 114.516 41.4519 101.621 43.5789 84.9269H43.6067L43.6762 67.2128H42.1887C30.2882 67.2128 20.6121 57.6852 20.2785 45.8106H20.2646V40.1666H25.895C33.7638 40.1666 40.7289 44.0783 44.9831 50.0575C49.0426 35.5984 62.2777 24.9951 77.9596 24.9951V30.639V38.2248C77.9596 54.1647 66.0174 67.101 50.1826 67.1988V84.9269C52.2401 101.663 66.4484 114.627 83.6735 114.627H101.204V80.694H77.4869C91.5284 73.8347 101.204 59.3756 101.204 42.6393L101.177 42.6533Z" fill="#4338CA"/></svg>',
				'sureforms'         => '<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 150 150" fill="none"><g clip-path="url(#sf)"><mask id="sfm" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="150" height="150"><path d="M150 0H0V150H150V0Z" fill="white"/></mask><g mask="url(#sfm)"><path d="M150 0H0V150H150V0Z" fill="#D54407"/><path d="M42.8579 32.1396H107.144V53.5683H53.5723L42.8579 64.2825V53.5683V32.1396Z" fill="white"/><path d="M42.8579 64.2839H96.4291V85.7124H53.5723L42.8579 96.4266V85.7124V64.2839Z" fill="white"/><path d="M42.8579 96.428H75.0007V117.856H42.8579V96.428Z" fill="white"/></g></g><defs><clipPath id="sf"><rect width="150" height="150" fill="white"/></clipPath></defs></svg>',
				'suremails'         => '<svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" viewBox="0 0 33 33" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.459 0.184H31.459C32.011 0.184 32.459 0.631 32.459 1.184V31.184C32.459 31.736 32.011 32.184 31.459 32.184H1.459C0.907 32.184 0.459 31.736 0.459 31.184V1.184C0.459 0.631 0.907 0.184 1.459 0.184ZM8.997 15.737C9.275 15.939 9.67 15.872 9.852 15.602C10.053 15.323 9.987 14.928 9.716 14.746L7.036 12.826C6.941 12.753 6.949 12.661 6.954 12.615C6.958 12.569 6.993 12.489 7.108 12.443L24.941 7.897C25.044 7.879 25.105 7.921 25.147 7.971C25.189 8.021 25.231 8.072 25.184 8.178L18.427 25.274C18.387 25.365 18.32 25.387 18.278 25.4C18.27 25.403 18.263 25.405 18.258 25.407C18.212 25.403 18.12 25.395 18.063 25.306L16.021 21.563C15.989 21.509 15.959 21.448 15.93 21.388C15.901 21.327 15.872 21.267 15.839 21.213C15.04 19.398 14.838 18.059 16.338 16.741L20.201 13.166C20.463 12.931 20.489 12.544 20.261 12.301C20.025 12.038 19.638 12.013 19.395 12.241L15.338 15.737C13.294 17.535 13.635 19.771 14.928 22.168L16.97 25.911C17.231 26.407 17.762 26.687 18.329 26.664C18.479 26.65 18.64 26.609 18.774 26.557C19.139 26.414 19.425 26.124 19.589 25.75L26.345 8.654C26.548 8.154 26.453 7.571 26.092 7.158C25.731 6.745 25.18 6.584 24.65 6.703L6.799 11.257C6.257 11.403 5.848 11.829 5.733 12.384C5.618 12.939 5.855 13.488 6.316 13.817L8.997 15.737Z" fill="#0E7EE8"/></svg>',
			];
		}

		/**
		 * Get add-on list for the add-ons step.
		 *
		 * @since 2.19.23
		 * @return array<int, array<string, string>>
		 */
		public static function getAddonList() {
			$icons = self::getAddonIcons();

			return [
				[
					'slug'        => 'astra-sites',
					'title'       => __( 'Starter Templates', 'vexaltrix' ),
					'logoSvg'     => $icons['starter-templates'],
					'description' => __( 'Launch websites quickly with 300+ professionally designed templates.', 'vexaltrix' ),
				],
				[
					'slug'        => 'sureforms',
					'title'       => __( 'SureForms', 'vexaltrix' ),
					'logoSvg'     => $icons['sureforms'],
					'description' => __( 'Create beautiful forms that feel conversational and keep users engaged.', 'vexaltrix' ),
				],
				[
					'slug'        => 'suremails',
					'title'       => __( 'SureMails', 'vexaltrix' ),
					'logoSvg'     => $icons['suremails'],
					'description' => __( 'Reliable email delivery so your emails actually reach the inbox.', 'vexaltrix' ),
				],
				[
					'slug'        => 'surerank',
					'title'       => __( 'SureRank', 'vexaltrix' ),
					'logoSvg'     => $icons['surerank'],
					'description' => __( 'Simple, lightweight SEO assistant to help your site rank higher.', 'vexaltrix' ),
				],
			];
		}

		/**
		 * Send lead data to BSF metrics server.
		 *
		 * @since 2.19.23
		 * @param array<string, mixed> $userInfo User info from onboarding.
		 * @return void
		 */
		private static function generateLead( $userInfo ) {
			if ( empty( $userInfo ) || ! is_array( $userInfo ) ) {
				return;
			}

			$body = [
				'first_name'   => isset( $userInfo['firstName'] ) && is_string( $userInfo['firstName'] ) ? sanitize_text_field( $userInfo['firstName'] ) : '',
				'last_name'    => isset( $userInfo['lastName'] ) && is_string( $userInfo['lastName'] ) ? sanitize_text_field( $userInfo['lastName'] ) : '',
				'email'        => isset( $userInfo['email'] ) && is_string( $userInfo['email'] ) ? sanitize_email( $userInfo['email'] ) : '',
				'source'       => isset( $userInfo['source'] ) && is_string( $userInfo['source'] ) ? sanitize_text_field( $userInfo['source'] ) : '',
				'new_user'     => isset( $userInfo['newUser'] ) && is_string( $userInfo['newUser'] ) ? sanitize_text_field( $userInfo['newUser'] ) : '',
				'benefit_id'   => isset( $userInfo['benefitId'] ) && is_string( $userInfo['benefitId'] ) ? sanitize_text_field( $userInfo['benefitId'] ) : '',
				'benefit_text' => isset( $userInfo['benefitText'] ) && is_string( $userInfo['benefitText'] ) ? sanitize_text_field( $userInfo['benefitText'] ) : '',
				'opt_in'       => ! empty( $userInfo['optIn'] ) ? 'yes' : 'no',
				'plugin'       => 'vexaltrix',
				'version'      => defined( 'VXT_VER' ) ? VXT_VER : '',
				'site_url'     => get_site_url(),
			];

			wp_remote_post(
				'https://metrics.brainstormforce.com/wp-json/bsf-metrics-server/v1/subscribe',
				[
					'body'      => wp_json_encode( $body ),
					'headers'   => [ 'Content-Type' => 'application/json' ],
					'blocking'  => false,
					'sslverify' => true,
				]
			);
		}

		/**
		 * Get onboarding analytics data for bsf_core_stats payload.
		 *
		 * @since 2.19.23
		 * @return array<string, mixed>
		 */
		public static function getOnboardingAnalyticsData() {
			$onboarding = get_option( 'vexaltrix_onboarding', [] );

			if ( ! is_array( $onboarding ) || empty( $onboarding ) ) {
				return [];
			}

			$data = [
				'boolean_values' => [
					'onboarding_completed' => true,
				],
			];

			// Extract skipped screens.
			if ( ! empty( $onboarding['screens'] ) && is_array( $onboarding['screens'] ) ) {
				$skipped = [];
				foreach ( $onboarding['screens'] as $screen ) {
					if ( ! empty( $screen['skipped'] ) && ! empty( $screen['id'] ) ) {
						$skipped[] = sanitize_text_field( $screen['id'] );
					}
				}
				if ( ! empty( $skipped ) ) {
					$data['onboarding_skipped_steps'] = $skipped;
				}
			}

			return $data;
		}

		/**
		 * Register personal data exporter for GDPR.
		 *
		 * @since 2.19.23
		 * @param array<string, array<string, mixed>> $exporters Registered exporters.
		 * @return array<string, array<string, mixed>>
		 */
		public function registerDataExporter( $exporters ) {
			$exporters['vexaltrix-onboarding'] = [
				'exporter_friendly_name' => __( 'Vexaltrix Onboarding Data', 'vexaltrix' ),
				'callback'               => [ $this, 'exportPersonalData' ],
			];
			return $exporters;
		}

		/**
		 * Register personal data eraser for GDPR.
		 *
		 * @since 2.19.23
		 * @param array<string, array<string, mixed>> $erasers Registered erasers.
		 * @return array<string, array<string, mixed>>
		 */
		public function registerDataEraser( $erasers ) {
			$erasers['vexaltrix-onboarding'] = [
				'eraser_friendly_name' => __( 'Vexaltrix Onboarding Data', 'vexaltrix' ),
				'callback'             => [ $this, 'erasePersonalData' ],
			];
			return $erasers;
		}

		/**
		 * Export personal data collected during onboarding.
		 *
		 * @since 2.19.23
		 * @param string $emailAddress Email address to export data for.
		 * @return array{data: array<int, array<string, mixed>>, done: bool}
		 */
		public function exportPersonalData( $emailAddress ) {
			$data       = [];
			$onboarding = get_option( 'vexaltrix_onboarding', [] );
			$userInfo  = is_array( $onboarding ) && isset( $onboarding['user_info'] ) && is_array( $onboarding['user_info'] ) ? $onboarding['user_info'] : [];

			if ( ! empty( $userInfo['email'] ) && $emailAddress === $userInfo['email'] ) {
				$data[] = [
					'group_id'    => 'vexaltrix-onboarding',
					'group_label' => __( 'Vexaltrix Onboarding', 'vexaltrix' ),
					'item_id'     => 'vexaltrix-onboarding-details',
					'data'        => [
						[
							'name'  => __( 'First Name', 'vexaltrix' ),
							'value' => isset( $userInfo['firstName'] ) && is_string( $userInfo['firstName'] ) ? $userInfo['firstName'] : '',
						],
						[
							'name'  => __( 'Last Name', 'vexaltrix' ),
							'value' => isset( $userInfo['lastName'] ) && is_string( $userInfo['lastName'] ) ? $userInfo['lastName'] : '',
						],
						[
							'name'  => __( 'Email', 'vexaltrix' ),
							'value' => is_string( $userInfo['email'] ) ? $userInfo['email'] : '',
						],
					],
				];
			}

			return [
				'data' => $data,
				'done' => true,
			];
		}

		/**
		 * Erase personal data collected during onboarding.
		 *
		 * @since 2.19.23
		 * @param string $emailAddress Email address to erase data for.
		 * @return array{items_removed: int, items_retained: int, messages: array<string>, done: bool}
		 */
		public function erasePersonalData( $emailAddress ) {
			$itemsRemoved = 0;
			$onboarding    = get_option( 'vexaltrix_onboarding', [] );
			$userInfo     = is_array( $onboarding ) && isset( $onboarding['user_info'] ) && is_array( $onboarding['user_info'] ) ? $onboarding['user_info'] : [];

			if ( ! empty( $userInfo['email'] ) && $emailAddress === $userInfo['email'] ) {
				delete_option( 'vexaltrix_onboarding' );
				$itemsRemoved = 1;
			}

			return [
				'items_removed'  => $itemsRemoved,
				'items_retained' => 0,
				'messages'       => [],
				'done'           => true,
			];
		}
	}
}
