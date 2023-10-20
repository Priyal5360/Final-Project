<?php
/**
 * Custom messages main controller.
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use \OTP\Addons\CustomMessage\Handler\CustomMessages;


$handler    = CustomMessages::instance();
$registerd  = $handler->moAddOnV();
$disabled   = ! $registerd ? 'disabled' : '';
$get_user   = wp_get_current_user();
$controller = MCM_DIR . 'controllers/';
$req_url    = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
$addon      = add_query_arg( array( 'page' => 'addon' ), remove_query_arg( 'addon', $req_url ) );

if ( isset( $_GET['addon'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the addon name, doesn't require nonce verification.
	switch ( $_GET['addon'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the addon name, doesn't require nonce verification.
		case 'custom':
			include $controller . 'custom.php';
			break;
	}
}
