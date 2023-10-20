<?php
/**
 * Addon main controllers.
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use OTP\Addons\PasswordReset\Handler\UMPasswordResetAddOnHandler;


$handler    = UMPasswordResetAddOnHandler::instance();
$registered = $handler->moAddOnV();
$disabled   = ! $registered ? 'disabled' : '';
$get_user   = wp_get_current_user();
$controller = UMPR_DIR . 'controllers/';
$addon      = add_query_arg(
	array( 'page' => 'addon' ),
	remove_query_arg(
		'addon',
		( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : null
		)
	)
);

if ( isset( $_GET['addon'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the addon name, doesn't require nonce verification.
	switch ( $_GET['addon'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the addon name, doesn't require nonce verification.
		case 'umpr_notif':
			include $controller . 'umpasswordreset.php';
			break;
	}
}
