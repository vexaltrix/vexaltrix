<?php
/**
 * Vexaltrix Forms.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\BlocksConfig\Forms;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\BlocksConfig\\Forms\\Forms' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\BlocksConfig\Forms\Forms.
	 */
	class Forms {


		/**
		 * Member Variable
		 *
		 * @since 1.22.0
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @since 1.22.0
		 * @var settings
		 */
		private static $settings;

		/**
		 *  Initiator
		 *
		 * @since 1.22.0
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 *
		 * Constructor
		 *
		 * @since 1.22.0
		 */
		public function __construct() {
			add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_process_forms', [ $this, 'processForms' ] );
			add_action( 'wp_ajax_nopriv_vxt_ultimate_gutenberg_blocks_process_forms', [ $this, 'processForms' ] );

		}

		/**
		 * Return the blocks content for reusable block.
		 *
		 * @param int $reusableRefId reference id of reusable block.
		 * @since 2.6.2
		 * @return array
		 */
		public function reusableBlockContentOnPage( $reusableRefId ) {
			if ( is_int( $reusableRefId ) ) {
				$content = get_post_field( 'post_content', $reusableRefId );
				return parse_blocks( $content );
			}
			return [];
		}

		/**
		 * Generates ids for all wp template part.
		 *
		 * @param array $blockAttr attributes array.
		 * @since 2.6.2
		 * @return integer|boolean
		 */
		public function getFseTemplatePart( $blockAttr ) {
			if ( empty( $blockAttr['slug'] ) ) {
				return false;
			}

			$id              = false;
			$slug            = $blockAttr['slug'];
			$templatesParts = get_block_templates( [ 'slugs__in' => $slug ], 'wp_template_part' );
			foreach ( $templatesParts as $templatesPart ) {
				if ( $slug === $templatesPart->slug ) {
					$id = $templatesPart->wp_id;
					break;
				}
			}
			return $id;
		}

		/**
		 * Return array of validated attributes.
		 *
		 * @param array  $blockAttr of Block.
		 * @param string $blockId of Block.
		 * @since 2.6.2
		 * @return array
		 */
		public function vxtUltimateGutenbergBlocksFormsBlockAttrCheck( $blockAttr, $blockId ) {
			if ( ! empty( $blockAttr['ref'] ) ) {
				$reusableBlocksContent = $this->reusableBlockContentOnPage( $blockAttr['ref'] );
				$blockAttr              = $this->recursiveInnerForms( $reusableBlocksContent, $blockId );
			}

			if ( ! empty( $blockAttr['slug'] ) ) {
				$id                      = $this->getFseTemplatePart( $blockAttr );
				$reusableBlocksContent = $this->reusableBlockContentOnPage( $id );
				$blockAttr              = $this->recursiveInnerForms( $reusableBlocksContent, $blockId );
			}

			return ( is_array( $blockAttr ) && $blockAttr['block_id'] === $blockId ) ? $blockAttr : false;
		}

		/**
		 *  Get the Inner blocks array.
		 *
		 * @since 2.3.5
		 * @access private
		 *
		 * @param  array  $blocksArray Block Array.
		 * @param  string $blockId of Block.
		 *
		 * @return mixed $recursiveInnerForms inner blocks Array.
		 */
		private function recursiveInnerForms( $blocksArray, $blockId ) {
			if ( empty( $blocksArray ) ) {
				return;
			}

			foreach ( $blocksArray as $blocks ) {
				if ( empty( $blocks ) ) {
					continue;
				}

				if ( ! empty( $blocks['attrs'] ) && isset( $blocks['blockName'] ) && ( 'vexaltrix/forms' === $blocks['blockName'] || 'core/block' === $blocks['blockName'] || 'core/template-part' === $blocks['blockName'] ) ) {
					$blocksAttrs = $this->vxtUltimateGutenbergBlocksFormsBlockAttrCheck( $blocks['attrs'], $blockId );
					if ( ! $blocksAttrs ) {
						continue;
					}
					return $blocksAttrs;
				} else {
					if ( is_array( $blocks['innerBlocks'] ) && ! empty( $blocks['innerBlocks'] ) ) {
						foreach ( $blocks['innerBlocks'] as $j => $innerBlock ) {
							if ( ! empty( $innerBlock['attrs'] ) && isset( $innerBlock['blockName'] ) && ( 'vexaltrix/forms' === $innerBlock ['blockName'] || 'core/block' === $innerBlock['blockName'] || 'core/template-part' === $blocks['blockName'] ) ) {
								$innerBlockAttrs = $this->vxtUltimateGutenbergBlocksFormsBlockAttrCheck( $innerBlock['attrs'], $blockId );
								if ( ! $innerBlockAttrs ) {
									continue;
								}
								return $innerBlockAttrs;
							} else {
								$tempAttrs = $this->recursiveInnerForms( $innerBlock['innerBlocks'], $blockId );
								if ( ! empty( $tempAttrs ) && isset( $tempAttrs['block_id'] ) && $tempAttrs['block_id'] === $blockId ) {
									return $tempAttrs;
								}
							}
						}
					}
				}
			}
		}

		/**
		 *
		 * Form Process Initiated.
		 *
		 * @since 1.22.0
		 */
		public function processForms() {
			check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_forms_ajax_nonce', 'nonce' );

			$options = [
				'recaptchaSiteKeyV2'   => \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_site_key_v2', '' ),
				'recaptchaSiteKeyV3'   => \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_site_key_v3', '' ),
				'recaptchaSecretKeyV2' => \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_secret_key_v2', '' ),
				'recaptchaSecretKeyV3' => \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_secret_key_v3', '' ),
			];

			if ( empty( $_POST['post_id'] ) || empty( $_POST['block_id'] ) ) {
				wp_send_json_error( 400 );
			}
			$currentBlockAttributes = false;
			$blockId                 = sanitize_text_field( $_POST['block_id'] );

			$postContent = get_post_field( 'post_content', sanitize_text_field( $_POST['post_id'] ) );

			if ( has_block( 'vexaltrix/forms', $postContent ) || has_block( 'core/block', $postContent ) ) {
				$blocks = parse_blocks( $postContent );
				if ( ! empty( $blocks ) && is_array( $blocks ) ) {
					$currentBlockAttributes = $this->recursiveInnerForms( $blocks, $blockId );
				}
			}
			if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) {
				$wpQueryArgs        = [
					'post_status' => [ 'publish' ],
					'post_type'   => [ 'wp_template', 'wp_template_part' ],
				];
				$templateQuery       = new WP_Query( $wpQueryArgs );
				$templateQueryPosts = $templateQuery->posts;
				if ( ! empty( $templateQueryPosts ) && is_array( $templateQueryPosts ) ) {
					foreach ( $templateQueryPosts as $post ) {
						if ( ! function_exists( '_build_block_template_result_from_post' ) ) {
							continue;
						}
						$template = _build_block_template_result_from_post( $post );
						if ( is_wp_error( $template ) ) {
							continue;
						}
						$templatePostContent = $template->content . ( ! empty( $postContent ) ? $postContent : '' );
						$templateContent      = parse_blocks( $templatePostContent );
						if ( get_template() === $template->theme && ! empty( $templateContent ) && is_array( $templateContent ) ) {
							$currentBlockAttributes = $this->recursiveInnerForms( $templateContent, $blockId );
							if ( is_array( $currentBlockAttributes ) && $currentBlockAttributes['block_id'] === $blockId ) {
								break;
							}
						}
					}
				}
			}

			$widgetContent = get_option( 'widget_block' );
			if ( ! empty( $widgetContent ) && is_array( $widgetContent ) && empty( $currentBlockAttributes ) ) {
				foreach ( $widgetContent as $value ) {
					if ( ! is_array( $value ) || empty( $value['content'] ) ) {
						continue;
					}
					if ( has_block( 'vexaltrix/forms', $value['content'] ) ) {
						$currentBlockAttributes = $this->recursiveInnerForms( parse_blocks( $value['content'] ), $blockId );
						if ( is_array( $currentBlockAttributes ) && $currentBlockAttributes['block_id'] === $blockId ) {
							break;
						}
					}
				}
			}

			// Check for $currentBlockAttributes is not set and check for Advanced Hooks.
			if ( empty( $currentBlockAttributes ) && defined( 'ASTRA_ADVANCED_HOOKS_POST_TYPE' ) ) {

				$option = [
					'location'  => 'ast-advanced-hook-location',
					'exclusion' => 'ast-advanced-hook-exclusion',
					'users'     => 'ast-advanced-hook-users',
				];

				$result = Astra_Target_Rules_Fields::getInstance()->get_posts_by_conditions( ASTRA_ADVANCED_HOOKS_POST_TYPE, $option );

				if ( ! empty( $result ) && is_array( $result ) ) {
					$postIds = array_keys( $result );

					foreach ( $postIds as $postId ) {

						$customPost = get_post( $postId );

						if ( ! $customPost instanceof WP_Post ) {
							continue;
						}

						$postContent = $customPost->post_content;
						if ( has_block( 'vexaltrix/forms', $postContent ) ) {
							$blocks = parse_blocks( $postContent );
							if ( ! empty( $blocks ) && is_array( $blocks ) ) {
								$currentBlockAttributes = $this->recursiveInnerForms( $blocks, $blockId );
								if ( is_array( $currentBlockAttributes ) && $currentBlockAttributes['block_id'] === $blockId ) {
									break;
								}
							}
						}
					}
				}
			}

			if ( empty( $currentBlockAttributes ) ) {
				wp_send_json_error( 400 );
			}
			$adminEmail = get_option( 'admin_email' );
			if ( is_array( $currentBlockAttributes ) ) {
				if ( isset( $currentBlockAttributes['afterSubmitToEmail'] ) && empty( trim( $currentBlockAttributes['afterSubmitToEmail'] ) ) && is_string( $adminEmail ) ) {
					$currentBlockAttributes['afterSubmitToEmail'] = sanitize_email( $adminEmail );
				}
				if ( ! isset( $currentBlockAttributes['reCaptchaType'] ) ) {
					$currentBlockAttributes['reCaptchaType'] = 'v2';
				}
				// bail if recaptcha is enabled and recaptchaType is not set.
				if ( ! empty( $currentBlockAttributes['reCaptchaEnable'] ) && empty( $currentBlockAttributes['reCaptchaType'] ) ) {
					wp_send_json_error( 400 );
				}

				if ( 'v2' === $currentBlockAttributes['reCaptchaType'] ) {

					$googleRecaptchaSiteKey   = $options['recaptchaSiteKeyV2'];
					$googleRecaptchaSecretKey = $options['recaptchaSecretKeyV2'];

				} elseif ( 'v3' === $currentBlockAttributes['reCaptchaType'] ) {

					$googleRecaptchaSiteKey   = $options['recaptchaSiteKeyV3'];
					$googleRecaptchaSecretKey = $options['recaptchaSecretKeyV3'];

				}

				if ( ! empty( $currentBlockAttributes['reCaptchaEnable'] ) && ! empty( $googleRecaptchaSecretKey ) && ! empty( $googleRecaptchaSiteKey ) ) {

					// Google recaptcha secret key verification starts.
					$googleRecaptcha = isset( $_POST['captcha_response'] ) ? sanitize_text_field( $_POST['captcha_response'] ) : '';
					$remoteip         = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '';

					// calling google recaptcha api.
					$googleUrl = 'https://www.google.com/recaptcha/api/siteverify';

					$errors = new WP_Error();

					if ( empty( $googleRecaptcha ) || empty( $remoteip ) ) {

						$errors->add( 'invalid_api', __( 'Please try logging in again to verify that you are not a robot.', 'vexaltrix' ) );
						return $errors;

					} else {
						$googleResponse = wp_safe_remote_get(
							add_query_arg(
								[
									'secret'   => $googleRecaptchaSecretKey,
									'response' => $googleRecaptcha,
									'remoteip' => $remoteip,
								],
								$googleUrl
							)
						);
						if ( is_wp_error( $googleResponse ) ) {

							$errors->add( 'invalid_recaptcha', __( 'Please try logging in again to verify that you are not a robot.', 'vexaltrix' ) );
							return $errors;

						} else {
							$googleResponse        = wp_remote_retrieve_body( $googleResponse );
							$decodeGoogleResponse = json_decode( $googleResponse );

							if ( false === $decodeGoogleResponse->success ) {
								wp_send_json_error( 400 );
							}
						}
					}
				}
			}

			if ( empty( $googleRecaptchaSecretKey ) && ! empty( $googleRecaptchaSiteKey ) ) {
				wp_send_json_error( 400 );
			}
			if ( ! empty( $googleRecaptchaSecretKey ) && empty( $googleRecaptchaSiteKey ) ) {
				wp_send_json_error( 400 );
			}
			// sanitizing form_data elements in later stage.
			$formData = isset( $_POST['form_data'] ) ? json_decode( wp_unslash( $_POST['form_data'] ), true ) : []; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			if ( ! is_array( $formData ) ) {
				$formData = [];
			}

			$body  = '';
			$body .= '<div style="border: 50px solid #f6f6f6;">';
			$body .= '<div style="padding: 15px;">';

			foreach ( $formData as $key => $value ) {

				if ( $key ) {

					if ( is_array( $value ) && stripos( wp_json_encode( $value ), '+' ) !== false ) {

						$val   = implode( '', $value );
						$body .= '<p><strong>' . str_replace( '_', ' ', ucwords( esc_html( $key ) ) ) . '</strong> - ' . esc_html( $val ) . '</p>';

					} elseif ( is_array( $value ) ) {

						$val   = implode( ', ', $value );
						$body .= '<p><strong>' . str_replace( '_', ' ', ucwords( esc_html( $key ) ) ) . '</strong> - ' . esc_html( $val ) . '</p>';

					} else {
						$body .= '<p><strong>' . str_replace( '_', ' ', ucwords( esc_html( $key ) ) ) . '</strong> - ' . esc_html( $value ) . '</p>';
					}
				}
			}
			$body .= '<p style="text-align:center;">This e-mail was sent from a ' . get_bloginfo( 'name' ) . ' ( ' . site_url() . ' )</p>';
			$body .= '</div>';
			$body .= '</div>';
			if ( is_array( $currentBlockAttributes ) ) {
				$this->sendEmail( $body, $formData, $currentBlockAttributes );
			}

		}

		/**
		 * Validate emails from $to, $cc and $bcc.
		 *
		 * @param array $emails array.
		 * @since 2.7.0
		 * @return array
		 */
		public function getValidEmails( $emails ) {
			$validEmails = [];

			if ( is_array( $emails ) ) {
				foreach ( $emails as $email ) {
					$email = trim( $email );
					$email = sanitize_email( $email );

					if ( is_email( $email ) ) {
						$validEmails[] = $email;
					}
				}
			}

			return $validEmails;
		}


		/**
		 *
		 * Trigger Mail.
		 *
		 * @param string $body Email Body.
		 * @param array  $formData Form data array.
		 * @param array  $args Extra Data.
		 *
		 * @since 1.22.0
		 */
		public function sendEmail( $body, $formData, $args ) {
			$to      = isset( $args['afterSubmitToEmail'] ) ? trim( $args['afterSubmitToEmail'] ) : sanitize_email( get_option( 'admin_email' ) );
			$cc      = isset( $args['afterSubmitCcEmail'] ) ? trim( $args['afterSubmitCcEmail'] ) : '';
			$bcc     = isset( $args['afterSubmitBccEmail'] ) ? trim( $args['afterSubmitBccEmail'] ) : '';
			$subject = isset( $args['afterSubmitEmailSubject'] ) ? $args['afterSubmitEmailSubject'] : __( 'Form Submission', 'vexaltrix' );

			if ( ! empty( $to ) && is_string( $to ) ) {
				$toEmails = $this->getValidEmails( explode( ',', $to ) );
			}

			if ( ! empty( $cc ) && is_string( $cc ) ) {
				$ccEmails = $this->getValidEmails( explode( ',', $cc ) );
			}

			if ( ! empty( $bcc ) && is_string( $bcc ) ) {
				$bccEmails = $this->getValidEmails( explode( ',', $bcc ) );
			}

			if ( empty( $toEmails ) ) {
				wp_send_json_success( 400 );
			}

			$senderEmailAddress = ! empty( $formData['Email'] ) ? sanitize_email( $formData['Email'] ) : 'example@mail.com';

			$headers = [ 'Content-Type: text/html; charset=UTF-8', 'From: Email <' . $senderEmailAddress . '>' ];

			foreach ( $toEmails as $email ) {
				$headers[] = 'Reply-To: ' . get_bloginfo( 'name' ) . ' <' . $email . '>';
			}

			if ( ! empty( $ccEmails ) ) {
				foreach ( $ccEmails as $email ) {
					$headers[] = 'Cc: ' . $email;
				}
			}

			if ( ! empty( $bccEmails ) ) {
				foreach ( $bccEmails as $email ) {
					$headers[] = 'Bcc: ' . $email;
				}
			}

			$successfulMail = wp_mail( $toEmails, $subject, $body, $headers );

			if ( $successfulMail ) {
				do_action( 'vxt_ultimate_gutenberg_blocks_form_success', $formData );
				wp_send_json_success( 200 );
			} else {
				wp_send_json_success( 400 );
			}
		}


		/**
		 * Validates that a given URL uses the HTTPS scheme and is well-formed.
		 *
		 * This function checks that the provided URL is properly structured and
		 * uses the secure HTTPS protocol. If the URL passes validation, it returns
		 * an escaped version of the URL. Otherwise, it returns an empty string.
		 *
		 * @param string $url The URL to be validated.
		 * 
		 * @since 2.16.5
		 * @return string Escaped URL if valid and uses HTTPS; otherwise, an empty string.
		 */
		public static function validateConfirmationUrl( $url ) {
			// First, we check that the URL starts with 'https://' to
			// ensure that the URL is using the secure HTTPS protocol.
			// 
			// Additionally, use the filter_var() function to validate that the URL
			// conforms to the proper URL structure. This function takes two
			// arguments: the URL to be validated and a filter constant. The
			// FILTER_VALIDATE_URL constant is used to validate that the URL is
			// well-formed.
			// 
			// If the URL is not valid, then return an empty string. This will
			// prevent the function from attempting to parse the URL and extract
			// its components.
			if ( strpos( $url, 'https://' ) !== 0 || ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
				// Return an empty string if the URL is invalid.
				return '';
			}
			$parsedUrl = wp_parse_url( $url );

			// Check if the URL is well-formed and uses HTTPS.
			// 
			// wp_parse_url() is a WordPress function that takes a URL and
			// breaks it down into its component parts. It returns an array
			// containing the following keys:
			// - host: The hostname of the URL (e.g. example.com)
			// - scheme: The protocol used in the URL (e.g. http or https)
			// - port: The port number used in the URL (if applicable)
			// - user: The username used in the URL (if applicable)
			// - pass: The password used in the URL (if applicable)
			// - path: The path used in the URL (e.g. /about)
			// - query: The query string used in the URL (e.g. ?name=John)
			// - fragment: The fragment used in the URL (e.g. #top)
			//
			// We need to check that $parsedUrl is an array, and that it
			// contains the 'host' and 'scheme' keys. If any of these checks
			// fail, we return an empty string.
			//
			// If the URL is well-formed and uses HTTPS, we escape the URL
			// using WordPress's esc_url() function, and return the result.
			if ( is_array( $parsedUrl ) 
			&& isset( $parsedUrl['host'] ) 
			&& isset( $parsedUrl['scheme'] ) &&
			'https' === $parsedUrl['scheme']
			) {
				// If the URL is well-formed and uses HTTPS, return an escaped
				// version of the URL.
				return esc_url( $url );
			}

			// Return an empty string if validation fails.
			return '';
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\Forms\\Forms' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
