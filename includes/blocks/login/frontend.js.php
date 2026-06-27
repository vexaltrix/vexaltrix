<?php
/**
 * Frontend JS File.
 *
 * @since 1.0.0
 *
 * @package vexaltrix-pro
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined else where.
 *
 * @var mixed[] $attr
 * @var string $id
 */

$formSelector = '#vexaltrix-pro-login-form-' . $id;
$selector      = '.vxt-block-' . $id;  // Block selector.

$loginBlock          = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_login_block', [] );
$thisFieldErrorMsg = [
	'username' => sprintf(
		// translators: %s: Attribute User Name Label value or This Field.
		__( '%s cannot be blank.', 'vexaltrix-pro' ),
		! empty( $attr['usernameLabel'] ) && is_string( $attr['usernameLabel'] ) ? esc_html( $attr['usernameLabel'] ) : __( 'This Field', 'vexaltrix-pro' )
	),
	'password' => sprintf(
		// translators: %s: Attribute Password Label value or This Field.
		__( '%s cannot be blank.', 'vexaltrix-pro' ),
		! empty( $attr['passwordLabel'] ) && is_string( $attr['passwordLabel'] ) ? esc_html( $attr['passwordLabel'] ) : __( 'This Field', 'vexaltrix-pro' )
	),
];
$loginBlockOptions  = apply_filters(
	'uagb_pro_login_options',
	[
		'ajax_url'             => esc_url( admin_url( 'admin-ajax.php' ) ),
		'post_id'              => get_the_ID(),
		'block_id'             => $id,
		'enableReCaptcha'      => $attr['reCaptchaEnable'],
		'recaptchaVersion'     => $attr['reCaptchaType'],
		'recaptchaSiteKey'     => \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_recaptcha_site_key_' . $attr['reCaptchaType'], '' ),
		'loginRedirectURL'     => esc_url( ( isset( $attr['redirectAfterLoginURL']['url'] ) && $attr['redirectAfterLoginURL']['url'] ? $attr['redirectAfterLoginURL']['url'] : home_url( '/' ) ) ),
		'logoutRedirectURL'    => esc_url( ( isset( $attr['redirectAfterLogoutURL']['url'] ) && $attr['redirectAfterLogoutURL']['url'] ? $attr['redirectAfterLogoutURL']['url'] : home_url( '/' ) ) ),
		'this_field_error_msg' => $thisFieldErrorMsg,
	],
	$id
);
ob_start();
?>
window.addEventListener( 'load', function() {
	VexaltrixLogin.init( '<?php echo esc_attr( $formSelector ); ?>', '<?php echo esc_attr( $selector ); ?>', <?php echo wp_json_encode( $loginBlockOptions ); ?> );
});
<?php
return ob_get_clean();
?>
