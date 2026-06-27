<?php
namespace Vexaltrix\Presentation\BlocksConfig\Login;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\BlocksConfig\\Login\\Login' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\BlocksConfig\Login\Login.
	 */
	final class Login {

		/**
		 * Member Variable
		 *
		 * @since 2.1
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @since 2.1
		 */
		private static $settings;

		/**
		 * Hold Block Attributes Data
		 *
		 * @since 1.0.0
		 * @var attributes
		 */
		private $attributes = [];

		/**
		 *  Initiator
		 *
		 * @since 2.1
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Micro Constructor
		 */
		public function __construct() {

			add_action( 'init', [ $this, 'registerBlocks' ] );
			add_action( 'wp_ajax_vexaltrix_pro_block_login', [ $this, 'loginFormHandler' ] );
			add_action( 'wp_ajax_nopriv_vexaltrix_pro_block_login', [ $this, 'loginFormHandler' ] );

			add_action( 'wp_ajax_vexaltrix_pro_block_login_forgot_password', [ $this, 'forgotPasswordHandler' ] );
			add_action( 'wp_ajax_nopriv_vexaltrix_pro_block_login_forgot_password', [ $this, 'forgotPasswordHandler' ] );
		}


		/**
		 * Registers the `vexaltrix/login` block on server.
		 *
		 * @since 1.0.0
		 */
		public function registerBlocks() {
			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			register_block_type(
				'vexaltrix/login',
				[
					'attributes'      => $this->getDefaultAttributes(),
					'renderCallback' => [ $this, 'renderCallback' ],
				]
			);
		}

		/**
		 * // Adding data to array and using this data in this file from frontend.
		 *
		 * @since 1.0.0
		 */
		public function getDefaultAttributes() {
			// Adding data to array.
			return [
				'block_id'               => [
					'type' => 'string',
				],
				'usernameLabel'          => [
					'type'    => 'string',
					'default' => 'Username or Email Address',
				],
				'usernamePlaceholder'    => [
					'type'    => 'string',
					'default' => 'Username',
				],
				'passwordLabel'          => [
					'type'    => 'string',
					'default' => 'Password',
				],
				'passwordPlaceholder'    => [
					'type'    => 'string',
					'default' => 'Password',
				],
				'rememberMeLabel'        => [
					'type'    => 'string',
					'default' => 'Remember Me',
				],
				'forgotPasswordLabel'    => [
					'type'    => 'string',
					'default' => 'Forgot Password',
				],
				'loginButtonLabel'       => [
					'type'    => 'string',
					'default' => 'Login',
				],
				'showRegisterInfo'       => [
					'type'    => 'boolean',
					'default' => true,
				],
				'registerInfo'           => [
					'type'    => 'string',
					'default' => 'Don\'t have an account?',
				],
				'registerButtonLabel'    => [
					'type'    => 'string',
					'default' => 'Register',
				],
				'registerButtonLink'     => [
					'type'    => 'object',
					'default' => '',
				],

				// settings.
				'disableFormFields'      => [
					'type'    => 'boolean',
					'default' => false,
				],
				'enableLoggedInMessage'  => [
					'type'    => 'boolean',
					'default' => true,
				],
				'redirectAfterLoginURL'  => [
					'type'    => 'object',
					'default' => '',
				],
				'redirectAfterLogoutURL' => [
					'type'    => 'object',
					'default' => '',
				],
				// recaptcha.
				'reCaptchaEnable'        => [
					'type'    => 'boolean',
					'default' => false,
				],
				'hidereCaptchaBatch'     => [
					'type'    => 'boolean',
					'default' => false,
				],
				'reCaptchaType'          => [
					'type'    => 'string',
					'default' => 'v2',
				],
				// icon.
				'isHideIcon'             => [
					'type'    => 'boolean',
					'default' => true,
				],

				// button size.
				'loginSize'              => [
					'type'    => 'string',
					'default' => 'full',
				],
				'formWidth'              => [
					'type'    => 'number',
					'default' => 100,
				],
				'formWidthTablet'        => [
					'type'    => 'number',
					'default' => 100,
				],
				'formWidthMobile'        => [
					'type'    => 'number',
					'default' => 100,
				],
				'formWidthType'          => [
					'type'    => 'string',
					'default' => '%',
				],
				'formWidthTypeTablet'    => [
					'type'    => 'string',
					'default' => '%',
				],
				'formWidthTypeMobile'    => [
					'type'    => 'string',
					'default' => '%',
				],
				'ctaIcon'                => [
					'type'    => 'string',
					'default' => '',
				],
				'ctaIconPosition'        => [
					'type'    => 'string',
					'default' => 'after',
				],
				'ctaIconSpace'           => [
					'type'    => 'number',
					'default' => 5,
				],
				'ctaIconSpaceTablet'     => [
					'type' => 'number',
				],
				'ctaIconSpaceMobile'     => [
					'type' => 'number',
				],
				'ctaIconSpaceType'       => [
					'type'    => 'string',
					'default' => 'px',
				],

				'formBorderStyle'        => [
					'type'    => 'string',
					'default' => 'default',
				],
				'fieldsBorderStyle'      => [
					'type'    => 'string',
					'default' => 'default',
				],
				'loginBorderStyle'       => [
					'type'    => 'string',
					'default' => 'default',
				],
			];
		}

		/**
		 * Renders the login block on server.
		 *
		 * @param array  $attributes Array of block attributes.
		 * @param string $content String of block Markup.
		 * @return markup
		 * @since 1.0.0
		 **/
		public function renderCallback( $attributes, $content ) {
			$this->attributes = $attributes;

			$desktopClass = '';
			$tabClass     = '';
			$mobClass     = '';

			$uagbCommonSelectorClass = ''; // Required for z-index.

			if ( array_key_exists( 'UAGHideDesktop', $attributes ) || array_key_exists( 'UAGHideTab', $attributes ) || array_key_exists( 'UAGHideMob', $attributes ) ) {

				$desktopClass = ( isset( $attributes['UAGHideDesktop'] ) ) ? 'uag-hide-desktop' : '';

				$tabClass = ( isset( $attributes['UAGHideTab'] ) ) ? 'uag-hide-tab' : '';

				$mobClass = ( isset( $attributes['UAGHideMob'] ) ) ? 'uag-hide-mob' : '';
			}

			$zindexWrap = [];
			if ( array_key_exists( 'zIndex', $attributes ) || array_key_exists( 'zIndexTablet', $attributes ) || array_key_exists( 'zIndexMobile', $attributes ) ) {
				$uagbCommonSelectorClass = 'uag-blocks-common-selector';
				$zindexDesktop             = array_key_exists( 'zIndex', $attributes ) && ( '' !== $attributes['zIndex'] ) ? '--z-index-desktop:' . $attributes['zIndex'] . ';' : false;
				$zindexTablet              = array_key_exists( 'zIndexTablet', $attributes ) && ( '' !== $attributes['zIndexTablet'] ) ? '--z-index-tablet:' . $attributes['zIndexTablet'] . ';' : false;
				$zindexMobile              = array_key_exists( 'zIndexMobile', $attributes ) && ( '' !== $attributes['zIndexMobile'] ) ? '--z-index-mobile:' . $attributes['zIndexMobile'] . ';' : false;

				if ( $zindexDesktop ) {
					array_push( $zindexWrap, $zindexDesktop );
				}

				if ( $zindexTablet ) {
					array_push( $zindexWrap, $zindexTablet );
				}

				if ( $zindexMobile ) {
					array_push( $zindexWrap, $zindexMobile );
				}
			}

			$wrapperClasses = [
				'vxt-block-' . $attributes['block_id'],
				'wp-block-vexaltrix-pro-login',
				$desktopClass,
				$tabClass,
				$mobClass,
				$uagbCommonSelectorClass,
			];

			if ( is_user_logged_in() && ! $attributes['enableLoggedInMessage'] ) {
				return;
			}

			$recaptchaSiteKey = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_site_key_v2', '' );
			if ( ! is_string( $recaptchaSiteKey ) ) {
				$recaptchaSiteKey = '';
			}

			ob_start();
			?>
				<div class="<?php echo esc_attr( implode( ' ', $wrapperClasses ) ); ?>" style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>">
					<?php
					if ( is_user_logged_in() ) :
						$currentUser = wp_get_current_user();
						?>
						<div class="wp-block-vexaltrix-pro-login__logged-in-message">
							<?php
							$userName   = $currentUser->display_name;
							$aTag       = '<a href="' . esc_url( wp_logout_url( isset( $attributes['redirectAfterLogoutURL']['url'] ) && $attributes['redirectAfterLogoutURL']['url'] ? $attributes['redirectAfterLogoutURL']['url'] : home_url( '/' ) ) ) . '">';
							$closeATag = '</a>';
							/* translators: %1$s user name */
							printf( esc_html__( 'You are logged in as %1$s (%2$sLogout%3$s)', 'vexaltrix-pro' ), wp_kses_post( $userName ), wp_kses_post( $aTag ), wp_kses_post( $closeATag ) );
							?>
						</div>
						<?php
					else :
							// inner block content will be here.
							echo wp_kses_post( $content );
						?>

						<?php
						if ( ! $attributes['disableFormFields'] ) :
							?>

						<form id="<?php echo esc_attr( 'vexaltrix-pro-login-form-' . $attributes['block_id'] ); ?>" action="#" method="post" class="vexaltrix-pro-login-form">
							<?php wp_nonce_field( 'vexaltrix-pro-login-nonce', '_nonce' ); ?>

							<div class="vexaltrix-pro-login-form__user-login">
								<?php
								if ( ! empty( $attributes['usernameLabel'] ) ) :
									?>
								<label for="<?php echo esc_attr( 'username-' . $attributes['block_id'] ); ?>"><?php echo wp_kses_post( $attributes['usernameLabel'] ); ?></label>
								<?php endif; ?>

								<div class='<?php echo ( ! $attributes['isHideIcon'] ? 'vexaltrix-pro-login-form-username-wrap vexaltrix-pro-login-form-username-wrap--have-icon' : 'vexaltrix-pro-login-form-username-wrap' ); ?>'>
									<?php
									if ( ! $attributes['isHideIcon'] ) {
											\Vexaltrix_Helper::renderSvgHtml( 'user' );
									}
									?>
									<input id="<?php echo esc_attr( 'username-' . $attributes['block_id'] ); ?>" type="text" name="username" placeholder="<?php echo esc_attr( $attributes['usernamePlaceholder'] ); ?>" autocomplete="username" />
								</div>
							</div>
							<div class="vexaltrix-pro-login-form__user-pass">
									<?php
									if ( ! empty( $attributes['passwordLabel'] ) ) :
										?>
								<label for="<?php echo esc_attr( 'password-' . $attributes['block_id'] ); ?>"><?php echo wp_kses_post( $attributes['passwordLabel'] ); ?></label>
										<?php
									endif;
									?>
								<div class='<?php echo ( ! $attributes['isHideIcon'] ? 'vexaltrix-pro-login-form-pass-wrap vexaltrix-pro-login-form-pass-wrap--have-icon' : 'vexaltrix-pro-login-form-pass-wrap' ); ?>'>
									<?php
									if ( ! $attributes['isHideIcon'] ) {
										\Vexaltrix_Helper::renderSvgHtml( 'lock' );
									}
									?>
									<input id="<?php echo esc_attr( 'password-' . $attributes['block_id'] ); ?>" type="password" name="password" placeholder="<?php echo esc_attr( $attributes['passwordPlaceholder'] ); ?>" autocomplete="off" />
									<button id="<?php echo esc_attr( 'password-visibility-' . $attributes['block_id'] ); ?>" type='button' aria-label="<?php echo esc_attr( __( 'Show Password', 'vexaltrix-pro' ) ); ?>" ><span class="dashicons dashicons-visibility"></span></button>
								</div>
							</div>
							<div class="vexaltrix-pro-login-form__forgetmenot">
								<div class="vexaltrix-pro-login-form-rememberme">
									<label for="<?php echo esc_attr( 'rememberme-' . $attributes['block_id'] ); ?>">
										<input name="rememberme" type="checkbox" id="<?php echo esc_attr( 'rememberme-' . $attributes['block_id'] ); ?>" />
										<span class="vexaltrix-pro-login-form-rememberme__checkmark"></span>
										<?php
										if ( ! empty( $attributes['rememberMeLabel'] ) ) :
											// The div below ensures that the label is unaffected by flex styling on it's parent.
											// Flex styling strips away the spaces in rich-text.
											?>
												<div class="vexaltrix-pro-login-form-rememberme__checkmark-label">
													<?php
														echo wp_kses_post( $attributes['rememberMeLabel'] );
													?>
												</div>
											<?php
											endif;
										?>
									</label>
								</div>
									<?php
									if ( ! empty( $attributes['forgotPasswordLabel'] ) ) :
										?>
								<div class="vexaltrix-pro-login-form-forgot-password">
									<a>
										<?php echo esc_html( $attributes['forgotPasswordLabel'] ); ?>
									</a>
								</div>
								<?php endif; ?>
							</div>
							<?php if ( $attributes['reCaptchaEnable'] && 'v2' === $attributes['reCaptchaType'] ) : ?>
							<div class="vexaltrix-pro-login-form__recaptcha">
								<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptchaSiteKey ); ?>"></div>
								<input
									type="hidden"
									id="g-recaptcha-response"
								/>
							</div>
							<?php endif; ?>
							<div class="vexaltrix-pro-login-form__submit wp-block-button">
								<button class="vexaltrix-pro-login-form-submit-button wp-block-button__link" type="submit">
									<?php
									if ( 'before' === $attributes['ctaIconPosition'] ) {
										\Vexaltrix_Helper::renderSvgHtml( $attributes['ctaIcon'] );
									}
									?>
									<span className='label-wrap'>
										<?php echo esc_attr( $attributes['loginButtonLabel'] ); ?>
									</span>
									<?php
									if ( 'after' === $attributes['ctaIconPosition'] ) {
										\Vexaltrix_Helper::renderSvgHtml( $attributes['ctaIcon'] );
									}
									?>
								</button>
							</div>
						</form>
							<?php
							endif;
						?>

						<div id="<?php echo esc_attr( 'vexaltrix-pro-login-form-status-' . $attributes['block_id'] ); ?>" class="vexaltrix-pro-login-form-status"></div>

						<?php
						if ( $attributes['showRegisterInfo'] ) :
							?>
						<div class='wp-block-vexaltrix-pro-login__footer'>
							<p class='wp-block-vexaltrix-pro-login-info'><?php echo esc_html( $attributes['registerInfo'] ); ?>
								<a
									class="vexaltrix-pro-login-form-register"
									href="<?php echo ( ! empty( $attributes['registerButtonLink']['url'] ) ? esc_url( $attributes['registerButtonLink']['url'] ) : esc_url( wp_registration_url() ) ); ?>"
									<?php
										echo ( isset( $attributes['registerButtonLink']['opensInNewTab'] ) && $attributes['registerButtonLink']['opensInNewTab'] ) ? ' target="_blank"' : '';
									?>
									<?php
										echo ( isset( $attributes['registerButtonLink']['noFollow'] ) && $attributes['registerButtonLink']['noFollow'] ) ? ' rel="noFollow"' : '';
									?>
								>
									<?php echo esc_html( $attributes['registerButtonLabel'] ); ?>
								</a>
							</p>
						</div>
							<?php
							endif;
						?>
						<?php
				endif;
					?>
				</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Ajax Login Functionality
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function loginFormHandler() {
			check_ajax_referer( 'vexaltrix-pro-login-nonce', '_nonce' );
			$recaptchaStatus = ( isset( $_POST['recaptchaStatus'] ) ? filter_var( sanitize_text_field( $_POST['recaptchaStatus'] ), FILTER_VALIDATE_BOOLEAN ) : false );
			if ( $recaptchaStatus ) {
				$recaptchaType   = ( isset( $_POST['reCaptchaType'] ) ? sanitize_text_field( $_POST['reCaptchaType'] ) : 'v2' );
				$recaptchaSecret = '';
				if ( 'v2' === $recaptchaType ) {
					$recaptchaSecret = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_secret_key_v2', '' );
				} else {
					$recaptchaSecret = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_secret_key_v3', '' );
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
					wp_send_json_error( __( 'Captcha is not matching, please try again.', 'vexaltrix-pro' ) );
				}
			}//end if

			$username   = ( isset( $_POST['username'] ) ? sanitize_text_field( $_POST['username'] ) : '' );
			$password   = ( isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '' );
			$rememberme = ( isset( $_POST['rememberme'] ) ? true : false );
			$user       = wp_signon(
				[
					'user_login'    => $username,
					'user_password' => $password,
					'remember'      => $rememberme,
				],
				false
			);

			if ( is_wp_error( $user ) ) {
				wp_send_json_error( $user->get_error_message() );
			}

			wp_set_auth_cookie( $user->ID );  // Ensures there is seamless experience while navigating to WP Dashboard (without reauth=1).

			wp_send_json_success( esc_html__( 'You have successfully logged in. Redirecting...', 'vexaltrix-pro' ) );
		}

		/**
		 * Forgot Password - Custom Error Message Sender.
		 *
		 * @param string $msg Error message in i18n function.
		 * @since 1.0.1
		 * @return void
		 */
		public function sendCustomErrorMsg( $msg ) {
			wp_send_json_error(
				[
					'type'    => 'custom',
					'message' => $msg,
				]
			);
		}

		/**
		 * Ajax Login - Forgot Password Functionality
		 *
		 * @since 1.0.1
		 * @return void
		 */
		public function forgotPasswordHandler() {

			check_ajax_referer( 'vexaltrix-pro-login-nonce', '_nonce' );

			if ( empty( $_POST['username'] ) ) {
				$this->sendCustomErrorMsg( esc_html__( 'The username/password field is empty. Please add a valid username/email to reset your password.', 'vexaltrix-pro' ) );
			}

			$userLogin = sanitize_text_field( $_POST['username'] );

			$userData = get_user_by( 'login', $userLogin );

			// If user data is not found by username, then find by email.
			if ( ! $userData instanceof \WP_User ) {
				$userData = get_user_by( 'email', $userLogin );
			}

			// We need to check $userData again since get_user_by() used above might return false value.
			if ( ! $userData instanceof \WP_User ) {
				$this->sendCustomErrorMsg( esc_html__( 'No user found. Please add a registered username/email to reset your password, else create an account.', 'vexaltrix-pro' ) );
				return; // Return statement required to adhere to PHPStan standards (prevent $userData to be false).
			}

			$userLogin = $userData->user_login;
			$userEmail = $userData->user_email;

			$key = get_password_reset_key( $userData );

			if ( is_wp_error( $key ) ) {
				wp_send_json_error( $key );
				return; // Return statement required to adhere to PHPStan standards (prevent $userData to be false).
			}

			$key = ! is_string( $key ) ? '' : $key;

			$message  = __( 'Someone has requested a password reset for the following account:', 'vexaltrix-pro' ) . "\r\n\r\n";
			$message .= network_home_url( '/' ) . "\r\n\r\n";
			$message .= sprintf(
				// translators: %s: Username.
				__( 'Username: %s', 'vexaltrix-pro' ),
				$userLogin
			) . "\r\n\r\n";
			$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'vexaltrix-pro' ) . "\r\n\r\n";
			$message .= __( 'To reset your password, visit the following address:', 'vexaltrix-pro' ) . "\r\n\r\n";
			$message .= network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $userLogin ), 'login' ) . "\r\n";

			// Get site name and ensure it's a string.
			$blogName = get_option( 'blogname' );
			$blogName = is_string( $blogName ) ? $blogName : __( 'Unknown Site', 'vexaltrix-pro' );

			// Send email.
			$sendWpMail = wp_mail( // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.wp_mail_wp_mail
				$userEmail,
				sprintf(
					// translators: %s: Password reset.
					__( '[%s] Password Reset', 'vexaltrix-pro' ),
					wp_specialchars_decode( $blogName )  // strval() - we use this function as wp_specialchars_decode() expects 'string' type parameter (and not 'mixed').
				),
				$message
			);

			// Check if email is sent and reply accordingly.
			if ( $sendWpMail ) {
				wp_send_json_success( esc_html__( 'Please check your email for the password reset link.', 'vexaltrix-pro' ) );
			} else {
				$this->sendCustomErrorMsg( __( 'Email failed to send.', 'vexaltrix-pro' ) );
			}
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\Login\\Login' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
