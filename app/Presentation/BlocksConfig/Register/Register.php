<?php
namespace Vexaltrix\Presentation\BlocksConfig\Register;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use vexaltrixPro\BlocksConfig\Utils\RecaptchaVerifier;

/**
 * Class Login.
 */
class Register {

	/**
	 * Member Variable
	 *
	 * @since 2.1
	 * @var instance
	 */
	private static $instance;

	/**
	 *  Initiator
	 *
	 * @since 2.1
	 */
	public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

	/**
	 * Block Name
	 *
	 * @since 1.0.0
	 * @var blockName
	 */
	private $blockName = 'vexaltrix/register';

	/**
	 * Hold Block Attributes Data
	 *
	 * @since 1.0.0
	 * @var attributes
	 */
	private $attributes = [];

	/**
	 * Hold Email Settings
	 *
	 * @since 1.0.0
	 * @var emailSettings
	 */
	private $emailSettings = [];

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'registerBlocks' ] );
		add_action( 'wp_ajax_vexaltrix_pro_block_register', [ $this, 'registerNewUser' ] );
		add_action( 'wp_ajax_nopriv_vexaltrix_pro_block_register', [ $this, 'registerNewUser' ] );
		add_action( 'wp_ajax_nopriv_vexaltrix_pro_block_register_unique_username_and_email', [ $this, 'uniqueUsernameAndEmail' ] );
		add_action( 'wp_ajax_vexaltrix_pro_block_register_get_roles', [ $this, 'getRoles' ] );
		add_filter( 'wp_new_user_notification_email', [ $this, 'customWpNewUserNotificationEmail' ], 10, 3 );

		if ( ! is_admin() ) {
			add_filter( 'renderBlock', [ $this, 'registerRenderBlock' ], 11, 2 );
		}
	}

	/**
	 * Registers the `uagb/register` block on server.
	 *
	 * @since 1.0.0
	 */
	public function registerBlocks() {
		// Check if the register function exists.
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		register_block_type(
			$this->blockName,
			[
				'attributes'      => $this->getDefaultAttributes(),
				'renderCallback' => [ $this, 'renderCallback' ],
			]
		);
	}

	/**
	 * Block Default Attributes
	 *
	 * @return array
	 * @since 1.0.0
	 */
	private function getDefaultAttributes() {
		return [
			'block_id'                     => [
				'type' => 'string',
			],
			'newUserRole'                  => [
				'type'    => 'string',
				'default' => '',
			],
			'afterRegisterActions'         => [
				'type'    => 'array',
				'default' => [ 'autoLogin' ],
			],
			// email.
			'emailTemplateType'            => [
				'type'    => 'string',
				'default' => 'default',
			],
			'emailTemplateSubject'         => [
				'type'    => 'string',
				'default' => 'Thank you for registering with "{{site_title}}"!',
			],
			'emailTemplateMessage'         => [
				'type' => 'string',
			],
			'emailTemplateMessageType'     => [
				'type'    => 'string',
				'default' => 'html',
			],
			// Email - error.
			'messageInvalidEmailError'     => [
				'type'    => 'string',
				'default' => __( 'You have used an invalid email', 'vexaltrix-pro' ),
			],
			'messageEmailMissingError'     => [
				'type'    => 'string',
				'default' => __( 'Email is missing or invalid', 'vexaltrix-pro' ),
			],
			'messageEmailAlreadyUsedError' => [
				'type'    => 'string',
				'default' => __( 'The provided email is already registered with another account. Please login or reset password or use another email.', 'vexaltrix-pro' ),
			],
			// Username - error.
			'messageInvalidUsernameError'  => [
				'type'    => 'string',
				'default' => __( 'You have used an invalid username', 'vexaltrix-pro' ),
			],
			'messageUsernameAlreadyUsed'   => [
				'type'    => 'string',
				'default' => __( 'Invalid username provided or the username is already registered.', 'vexaltrix-pro' ),
			],
			// Password - error.
			'messageInvalidPasswordError'  => [
				'type'    => 'string',
				'default' => __( 'Your password is invalid.', 'vexaltrix-pro' ),
			],
			'messagePasswordConfirmError'  => [
				'type'    => 'string',
				'default' => __( 'Your passwords do not match.', 'vexaltrix-pro' ),
			],
			// reCaptcha.
			'reCaptchaEnable'              => [
				'type'    => 'boolean',
				'default' => false,
			],
			'reCaptchaType'                => [
				'type'    => 'string',
				'default' => 'v2',
			],
			'hidereCaptchaBatch'           => [
				'type'    => 'boolean',
				'default' => false,
			],
			// Terms - error.
			'messageTermsError'            => [
				'type'    => 'string',
				'default' => __( 'Please accept the Terms and Conditions, and try again.', 'vexaltrix-pro' ),
			],
			'messageOtherError'            => [
				'type'    => 'string',
				'default' => __( 'Something went wrong!', 'vexaltrix-pro' ),
			],
			// success - message.
			'messageSuccessRegistration'   => [
				'type'    => 'string',
				'default' => __( 'Registration completed successfully. Check your inbox for password if you did not provide it while registering.', 'vexaltrix-pro' ),
			],

			// fields border defaults.
			'fieldBorderStyle'             => [
				'type'    => 'string',
				'default' => 'solid',
			],
			'fieldBorderTopLeftRadius'     => [
				'type'    => 'number',
				'default' => 3,
			],
			'fieldBorderTopRightRadius'    => [
				'type'    => 'number',
				'default' => 3,
			],
			'fieldBorderBottomLeftRadius'  => [
				'type'    => 'number',
				'default' => 3,
			],
			'fieldBorderBottomRightRadius' => [
				'type'    => 'number',
				'default' => 3,
			],
			'fieldBorderTopWidth'          => [
				'type'    => 'number',
				'default' => 1,
			],
			'fieldBorderRightWidth'        => [
				'type'    => 'number',
				'default' => 1,
			],
			'fieldBorderBottomWidth'       => [
				'type'    => 'number',
				'default' => 1,
			],
			'fieldBorderLeftWidth'         => [
				'type'    => 'number',
				'default' => 1,
			],
			'fieldBorderColor'             => [
				'type'    => 'string',
				'default' => '#E9E9E9',
			],
		];
	}

	/**
	 * Renders the register block on server.
	 *
	 * @param array  $attributes Array of block attributes.
	 * @param string $content String of block Content.
	 * @return markup
	 * @since 1.0.0
	 */
	public function renderCallback( $attributes, $content ) {
		$wrapperClasses = [
			'vxt-block-' . $attributes['block_id'],
			'wp-block-vexaltrix-pro-register',
			'wp-block-vexaltrix-pro-register__logged-in-message',
		];

		if ( ! get_option( 'users_can_register' ) ) {
			return;
		}

		if ( is_user_logged_in() ) {
			$currentUser = wp_get_current_user();
			ob_start();
			?>
				<div class="<?php echo esc_attr( implode( ' ', $wrapperClasses ) ); ?>">
					<?php
						$userName   = $currentUser->display_name;
						$aTag       = '<a href="' . esc_url( wp_logout_url( ! empty( $attributes['redirectAfterLogoutURL'] ) ? $attributes['redirectAfterLogoutURL'] : home_url( '/' ) ) ) . '">';
						$closeATag = '</a>';
						/* translators: %1$s user name */
						printf( esc_html__( 'You are logged in as %1$s (%2$sLogout%3$s)', 'vexaltrix-pro' ), wp_kses_post( $userName ), wp_kses_post( $aTag ), wp_kses_post( $closeATag ) );
					?>
				</div>
			<?php
			return ob_get_clean();
		}

		// Replace the value of the input tag with the actual value.
		$actualValue = wp_create_nonce( 'vexaltrix-pro-register-nonce' );

		// add nonce.
		$content = str_replace( '<input type="hidden" name="_nonce" value="ssr_nonce_replace"/>', '<input type="hidden" name="_nonce" value="' . $actualValue . '"/>', $content );
		// add recaptcha sitekey.
		$recaptchaEnable = (bool) ( isset( $attributes['reCaptchaEnable'] ) ? $attributes['reCaptchaEnable'] : false );
		if ( $recaptchaEnable ) {
			$recaptchaType = ( isset( $attributes['reCaptchaType'] ) ? $attributes['reCaptchaType'] : 'v2' );
			if ( 'v2' === $recaptchaType ) {
				$uagRecaptchaSiteKeyV2 = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_recaptcha_site_key_v2', '' );

				if ( ! is_string( $uagRecaptchaSiteKeyV2 ) ) {
					$uagRecaptchaSiteKeyV2 = '';
				}

				$content = str_replace( 'ssr_sitekey_replace', $uagRecaptchaSiteKeyV2, $content );
			}
		}

		return $content;
	}


	/**
	 * Get all attributes from post content recursively.
	 *
	 * @param array  $blocks     Blocks array.
	 * @param string $blockName Block Name.
	 * @param string $blockId   Block ID.
	 * @return array
	 * @since 1.1.4
	 */
	public function getBlockAttributesRecursive( $blocks, $blockName, $blockId ) {
		$attributes = [];
		foreach ( $blocks as $block ) {
			if ( $block['blockName'] === $blockName && $block['attrs']['block_id'] === $blockId ) {
				$attributes[ $blockName ] = $block['attrs'];
				if ( is_array( $block['innerBlocks'] ) && count( $block['innerBlocks'] ) ) {
					foreach ( $block['innerBlocks'] as $innerBlock ) {
						if ( isset( $innerBlock['attrs']['name'] ) ) {
							$attributes[ $innerBlock['attrs']['name'] ] = $innerBlock['attrs'];
						}
					}
				}
				return $attributes; // Found the block, return its attributes.
			} elseif ( is_array( $block['innerBlocks'] ) && count( $block['innerBlocks'] ) ) {
				// If the block is not found at this level, check inner blocks recursively.
				$innerAttributes = $this->getBlockAttributesRecursive( $block['innerBlocks'], $blockName, $blockId );
				if ( ! empty( $innerAttributes ) ) {
					return $innerAttributes; // Found the block in inner blocks, return its attributes.
				}
			}
		}
		return $attributes; // Block not found in this branch.
	}

	/**
	 * Wrapper function to initiate recursive block attribute retrieval.
	 *
	 * @param string $content    post content.
	 * @param string $blockName Block Name.
	 * @param string $blockId   Block ID.
	 * @return array
	 * @since 1.0.0
	 */
	public function getBlockAttributes( $content, $blockName, $blockId ) {
		$blocks = parse_blocks( $content );
		if ( empty( $blocks ) ) {
			return [];
		}
		return $this->getBlockAttributesRecursive( $blocks, $blockName, $blockId );
	}


	/**
	 * Register new user
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function registerNewUser() {
		check_ajax_referer( 'vexaltrix-pro-register-nonce', '_nonce' );

		$allowRegister = get_option( 'users_can_register' );
		if ( ! $allowRegister ) {
			wp_send_json_error( esc_html__( 'Sorry, the site admin has disabled new user registration', 'vexaltrix-pro' ) );
		}

		$error      = [];
		$postId    = ( isset( $_POST['post_id'] ) ? sanitize_text_field( $_POST['post_id'] ) : '' );
		$blockId   = ( isset( $_POST['block_id'] ) ? sanitize_text_field( $_POST['block_id'] ) : '' );
		$firstName = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
		$lastName  = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
		$username   = isset( $_POST['username'] ) ? sanitize_user( $_POST['username'], true ) : '';
		$email      = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
		$password   = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';

		$contentPost = get_post( intval( $postId ) );
		if ( ! $contentPost instanceof \WP_Post ) {
			wp_send_json_error( __( 'Not a valid post.', 'vexaltrix-pro' ) );
			die();
		}
		$this->saved_attributes = $this->getBlockAttributes( $contentPost->post_content, $this->blockName, $blockId );
		$defaultAttributes     = $this->getDefaultAttributes();

		// verify reCaptcha.
		$recaptchaEnable = isset( $this->saved_attributes[ $this->blockName ]['reCaptchaEnable'] ) ? $this->saved_attributes[ $this->blockName ]['reCaptchaEnable'] : $defaultAttributes['reCaptchaEnable']['default'];
		if ( $recaptchaEnable ) {
			$recaptchaType   = isset( $this->saved_attributes[ $this->blockName ]['reCaptchaType'] ) ? $this->saved_attributes[ $this->blockName ]['reCaptchaType'] : $defaultAttributes['reCaptchaType']['default'];
			$recaptchaSecret = '';
			if ( 'v2' === $recaptchaType ) {
				$recaptchaSecret = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_recaptcha_secret_key_v2', '' );
			} else {
				$recaptchaSecret = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_recaptcha_secret_key_v3', '' );
			}

			if ( ! is_string( $recaptchaSecret ) ) {
				$recaptchaSecret = '';
			}

			$recaptchaVerifier   = new RecaptchaVerifier();
			$gRecaptchaResponse = ( isset( $_POST['g-recaptcha-response'] ) ? sanitize_text_field( $_POST['g-recaptcha-response'] ) : '' );
			$remoteAddr          = filter_input( INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP );
			$remoteAddr          = is_string( $remoteAddr ) ? $remoteAddr : '';
			$verify               = $recaptchaVerifier->verify( $gRecaptchaResponse, $remoteAddr, $recaptchaSecret );
			if ( false === $verify ) {
				wp_send_json_error( [ 'g-recaptcha-response' => __( 'Captcha is not matching, please try again.', 'vexaltrix-pro' ) ] );
			}
		}//end if

		// Password.
		if ( empty( $password ) ) {
			$password = wp_generate_password();
		} elseif ( isset( $_POST['reenter_password'] ) && $password !== $_POST['reenter_password'] ) {
			$error['password'] = isset( $this->saved_attributes[ $this->blockName ]['messagePasswordConfirmError'] ) ? $this->saved_attributes[ $this->blockName ]['messagePasswordConfirmError'] : $defaultAttributes['messagePasswordConfirmError']['default'];
		} elseif ( false !== strpos( wp_unslash( $password ), '\\' ) ) {
			$error['password'] = __( 'Password may not contain the character "\\"', 'vexaltrix-pro' );
		}

		// check required field.
		if ( empty( $firstName ) && isset( $this->saved_attributes['first_name']['required'] ) && $this->saved_attributes['first_name']['required'] ) {
			$error['first_name'] = esc_html__( 'This field is required.', 'vexaltrix-pro' );
		}
		if ( empty( $lastName ) && isset( $this->saved_attributes['last_name']['required'] ) && $this->saved_attributes['last_name']['required'] ) {
			$error['last_name'] = esc_html__( 'This field is required.', 'vexaltrix-pro' );
		}

		// User.
		if ( isset( $this->saved_attributes['username']['required'] ) && $this->saved_attributes['username']['required'] ) {
			if ( empty( $username ) ) {
				$error['username'] = isset( $this->saved_attributes[ $this->blockName ]['messageInvalidUsernameError'] ) ? $this->saved_attributes[ $this->blockName ]['messageInvalidUsernameError'] : $defaultAttributes['messageInvalidUsernameError']['default'];
			} elseif ( username_exists( $username ) ) {
				$error['username'] = isset( $this->saved_attributes[ $this->blockName ]['messageUsernameAlreadyUsed'] ) ? $this->saved_attributes[ $this->blockName ]['messageUsernameAlreadyUsed'] : $defaultAttributes['messageUsernameAlreadyUsed']['default'];
			}
		}

		// Email.
		if ( empty( $email ) ) {
			$error['email'] = isset( $this->saved_attributes[ $this->blockName ]['messageEmailMissingError'] ) ? $this->saved_attributes[ $this->blockName ]['messageEmailMissingError'] : $defaultAttributes['messageEmailMissingError']['default'];
		} elseif ( $email && ! is_email( $email ) ) {
			$error['email'] = isset( $this->saved_attributes[ $this->blockName ]['messageInvalidEmailError'] ) ? $this->saved_attributes[ $this->blockName ]['messageInvalidEmailError'] : $defaultAttributes['messageInvalidEmailError']['default'];
		} elseif ( email_exists( $email ) ) {
			$error['email'] = isset( $this->saved_attributes[ $this->blockName ]['messageEmailAlreadyUsedError'] ) ? $this->saved_attributes[ $this->blockName ]['messageEmailAlreadyUsedError'] : $defaultAttributes['messageEmailAlreadyUsedError']['default'];
		}

		// terms.
		if ( isset( $this->saved_attributes['terms']['required'] ) && $this->saved_attributes['terms']['required'] ) {
			$terms = (bool) isset( $_POST['terms'] ) ? sanitize_text_field( $_POST['terms'] ) : false;
			if ( ! $terms ) {
				$error['terms'] = isset( $this->saved_attributes[ $this->blockName ]['messageTermsError'] ) ? $this->saved_attributes[ $this->blockName ]['messageTermsError'] : $defaultAttributes['messageTermsError']['default'];
			}
		}
		// get all roles.
		$getAllRoles = array_keys( $this->getAllRoles() );
		// role.
		$defaultRole = get_option( 'default_role' );
		$role         = $defaultRole;
		if ( isset( $this->saved_attributes[ $this->blockName ]['newUserRole'] ) && ! empty( $this->saved_attributes[ $this->blockName ]['newUserRole'] ) ) {
			$role = $this->saved_attributes[ $this->blockName ]['newUserRole'];
			// check if role is valid.
			$role = in_array( $role, $getAllRoles ) ? $role : $defaultRole;
		}
		// apply filter.
		$role = apply_filters( 'vexaltrix_pro_registration_form_change_new_user_role', $role );

		// Email.
		if (
			isset( $this->saved_attributes[ $this->blockName ]['afterRegisterActions'] ) &&
			in_array( 'sendMail', $this->saved_attributes[ $this->blockName ]['afterRegisterActions'], true ) &&
			'custom' === $this->saved_attributes[ $this->blockName ]['emailTemplateType']
		) {
			// form data.
			$this->emailSettings['user_login'] = $username;
			$this->emailSettings['user_pass']  = $password;
			$this->emailSettings['user_email'] = $email;
			$this->emailSettings['first_name'] = $firstName;
			$this->emailSettings['last_name']  = $lastName;

			// email.
			$this->emailSettings['subject'] = isset( $this->saved_attributes[ $this->blockName ]['emailTemplateSubject'] ) ? $this->saved_attributes[ $this->blockName ]['emailTemplateSubject'] : $defaultAttributes['emailTemplateSubject']['default'];
			$this->emailSettings['message'] = isset( $this->saved_attributes[ $this->blockName ]['emailTemplateMessage'] ) ? $this->saved_attributes[ $this->blockName ]['emailTemplateMessage'] : $defaultAttributes['emailTemplateMessage']['default'];
			$headers                         = isset( $this->saved_attributes[ $this->blockName ]['emailTemplateMessageType'] ) ? $this->saved_attributes[ $this->blockName ]['emailTemplateMessageType'] : $defaultAttributes['emailTemplateMessageType']['default'];

			$this->emailSettings['headers'] = 'Content-Type: text/' . ( 'plain' === $headers ? $headers : 'html; charset=UTF-8\r\n' );
		}

		// Create username from email.
		if ( empty( $username ) ) {
			$username = $this->createUsername( $email, '' );
			$username = sanitize_user( $username );
		}

		// have error.
		if ( count( $error ) ) {
			wp_send_json_error( $error );
		}

		$userArgs = apply_filters(
			'vexaltrix_pro_block_register_insert_user_args',
			[
				'user_login'      => $username,
				'user_pass'       => $password,
				'user_email'      => $email,
				'first_name'      => $firstName,
				'last_name'       => $lastName,
				'user_registered' => gmdate( 'Y-m-d H:i:s' ),
				'role'            => $role,
			]
		);

		$result = wp_insert_user( $userArgs );

		wp_set_auth_cookie( $result );  // Ensures there is seamless experience while navigating to WP Dashboard (without reauth=1).

		/**
		 * Fires after a new user has been created.
		 *
		 * @since 1.18.0
		 *
		 * @param int    $userId ID of the newly created user.
		 * @param string $notify  Type of notification that should happen. See wp_send_new_user_notifications()
		 *                        for more information on possible values.
		 */
		do_action( 'edit_user_created_user', $result, 'both' );

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( $result );
		}

		$message      = isset( $this->saved_attributes[ $this->blockName ]['messageSuccessRegistration'] ) ? $this->saved_attributes[ $this->blockName ]['messageSuccessRegistration'] : $defaultAttributes['messageSuccessRegistration']['default'];
		$redirectUrl = isset( $this->saved_attributes[ $this->blockName ]['autoLoginRedirectURL']['url'] ) && $this->saved_attributes[ $this->blockName ]['autoLoginRedirectURL']['url'] ? esc_url( $this->saved_attributes[ $this->blockName ]['autoLoginRedirectURL']['url'] ) : esc_url( home_url( '/' ) );

		/* Login user after registration and redirect to home page if not currently logged in */
		$afterRegisterActions = isset( $this->saved_attributes[ $this->blockName ]['afterRegisterActions'] ) ? $this->saved_attributes[ $this->blockName ]['afterRegisterActions'] : $defaultAttributes['afterRegisterActions']['default'];
		if ( in_array( 'autoLogin', $afterRegisterActions, true ) ) {
			$creds                  = [];
			$creds['user_login']    = $username;
			$creds['user_password'] = $password;
			$creds['remember']      = true;
			$loginUser             = wp_signon( $creds, false );
			if ( ! is_wp_error( $loginUser ) ) {
				wp_send_json_success(
					[
						'message'      => $message,
						'redirect_url' => $redirectUrl,
					]
				);
			}

			$error['other'] = isset( $this->saved_attributes[ $this->blockName ]['messageOtherError'] ) ? $this->saved_attributes[ $this->blockName ]['messageOtherError'] : $defaultAttributes['messageOtherError']['default'];
			wp_send_json_error( $error );
		}
		wp_send_json_success(
			[
				'message'      => $message,
				'redirect_url' => $redirectUrl,
			]
		);
	}

	/**
	 * Ajax Login Functionality
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function uniqueUsernameAndEmail() {
		check_ajax_referer( 'vexaltrix-pro-register-nonce', 'security' );
		$fieldName  = ( isset( $_POST['field_name'] ) ? sanitize_key( $_POST['field_name'] ) : '' );
		$fieldValue = ( isset( $_POST['field_value'] ) ? sanitize_text_field( $_POST['field_value'] ) : '' );
		if ( 'username' === $fieldName ) {
			if ( username_exists( $fieldValue ) ) {
				wp_send_json_success(
					[
						'has_error' => true,
						'attribute' => 'messageUsernameAlreadyUsed',
					]
				);
			}
		} elseif ( 'email' === $fieldName ) {
			if ( ! is_email( $fieldValue ) ) {
				wp_send_json_success(
					[
						'has_error' => true,
						'attribute' => 'messageInvalidEmailError',
					]
				);
			} elseif ( email_exists( $fieldValue ) ) {
				wp_send_json_success(
					[
						'has_error' => true,
						'attribute' => 'messageEmailAlreadyUsedError',
					]
				);
			}
		}//end if
		wp_send_json_success(
			[
				'has_error' => false,
				'attribute' => '',
			]
		);
	}

	/**
	 * Get all roles.
	 *
	 * @return array $allRoles.
	 * @since 1.1.5
	 */
	public function getAllRoles() {
		$allRoles = new \WP_Roles();
		$allRoles = $allRoles->get_names();

		// Roles to remove.
		$rolesToRemove = [ 'administrator', 'editor' ];

		// Remove the specified roles from the array.
		foreach ( $rolesToRemove as $role ) {
			if ( isset( $allRoles[ $role ] ) ) {
				unset( $allRoles[ $role ] );
			}
		}

		return $allRoles;
	}

	/**
	 * Ajax Login Functionality
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function getRoles() {
		check_ajax_referer( 'vexaltrix_pro_ajax_nonce', 'security' );
		$allRoles = $this->getAllRoles();
		$response  = [
			[
				'value' => 'default',
				'label' => esc_html__( '– Select –', 'vexaltrix-pro' ),
			],
		];
		foreach ( $allRoles as $value => $label ) {
			$response[] = [
				'value' => $value,
				'label' => $label,
			];
		}
		wp_send_json_success( $response );
	}

	/**
	 * Modify Email Template.
	 *
	 * @param array  $wpNewUserNotificationEmail email data.
	 * @param object $user User object.
	 * @param string $blogname website name.
	 * @return array
	 * @since 1.0.0
	 */
	public function customWpNewUserNotificationEmail( $wpNewUserNotificationEmail, $user, $blogname ) {
		if (
			isset( $this->saved_attributes[ $this->blockName ]['afterRegisterActions'] ) &&
			in_array( 'sendMail', $this->saved_attributes[ $this->blockName ]['afterRegisterActions'], true ) &&
			'custom' === $this->saved_attributes[ $this->blockName ]['emailTemplateType']
		) {

			$wpNewUserNotificationEmail['subject'] = preg_replace( '/\{{site_title}}/', $blogname, $this->emailSettings['subject'] );

			$message = $this->emailSettings['message'];

			$find = [ '/\{{login_url}}/', '/\[field=password\]/', '/\[field=username\]/', '/\[field=email\]/', '/\[field=first_name\]/', '/\[field=last_name\]/', '/\{{site_title}}/' ];

			$replacement = [ esc_url( wp_login_url( get_permalink() ) ), $this->emailSettings['user_pass'], $this->emailSettings['user_login'], $this->emailSettings['user_email'], $this->emailSettings['first_name'], $this->emailSettings['last_name'], $blogname ];

			if ( isset( $this->emailSettings['user_pass'] ) ) {
				$message = preg_replace( $find, $replacement, $message );
			}

			$wpNewUserNotificationEmail['message'] = $message;

			$wpNewUserNotificationEmail['headers'] = $this->emailSettings['headers'];
		}
		return $wpNewUserNotificationEmail;
	}

	/**
	 * Generate User name from email.
	 *
	 * @param string $email email.
	 * @param string $suffix emial suffix.
	 * @return string
	 * @since 1.0.0
	 */
	public function createUsername( $email, $suffix ) {

		$usernameParts = [];

		// If there are no parts, e.g. name had unicode chars, or was not provided, fallback to email.
		if ( empty( $usernameParts ) ) {
			$emailParts    = explode( '@', $email );
			$emailUsername = $emailParts[0];

			// Exclude common prefixes.
			if ( in_array(
				$emailUsername,
				[
					'sales',
					'hello',
					'mail',
					'contact',
					'info',
				],
				true
			) ) {
				// Get the domain part.
				$emailUsername = $emailParts[1];
			}

			$usernameParts[] = sanitize_user( $emailUsername, true );
		}//end if
		$username = strtolower( implode( '', $usernameParts ) );

		if ( $suffix ) {
			$username .= $suffix;
		}

		if ( username_exists( $username ) ) {
			// Generate something unique to append to the username in case of a conflict with another user.
			$suffix = '-' . zeroise( wp_rand( 0, 9999 ), 4 );
			return $this->createUsername( $email, $suffix );
		}

		return $username;
	}

	/**
	 * Render block function for Register.
	 *
	 * @param string $blockContent The block content.
	 * @param array  $block The block data.
	 * @since 1.0.0
	 * @return string|null|boolean Returns the new block content.
	 */
	public function registerRenderBlock( $blockContent, $block ) {

		// If not register block, skip it.
		if ( ( 'uagb/register' !== $block['blockName'] ) ) {
			return $blockContent;
		}

		$countOfInnerblocks = count( $block['innerBlocks'] );

		// Array of child-block names.
		$innerblocksList = [];

		// Add child-block names to $innerblocksList.
		for ( $i = 0; $i < $countOfInnerblocks; $i++ ) {
			array_push( $innerblocksList, $block['innerBlocks'][ $i ]['blockName'] );
		}

		// Since email is the minimum required field to create an account, don't render the form if email field isn't present.
		if ( ! in_array( 'uagb/register-email', $innerblocksList ) ) {
			return null;
		}

		// If re-enter password field is present but the normal password field isn't, don't render it (re-enter password field).
		if (
			! in_array( 'uagb/register-password', $innerblocksList ) &&
			in_array( 'uagb/register-reenter-password', $innerblocksList )
		) {
			// Iterate through innerblocks till re-enter password field is found.
			foreach ( $block['innerBlocks'] as $innerblock ) {
				// If the current innerblock is re-enter password, don't render it.
				if ( ( 'uagb/register-reenter-password' === $innerblock['blockName'] ) ) {
					$blockContent = str_replace( $innerblock['innerContent'], '', $blockContent );
				}
			}
		}

		return $blockContent;
	}
}
