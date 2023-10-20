<?php
/**
 * Load controller for SMS Notifications view
 *
 * @package miniorange-otp-verification/addons
 */

use OTP\Addons\WcSMSNotification\Handler\WooCommerceNotifications;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	$registerd       = WooCommerceNotifications::instance()->moAddOnV();
	$disabled        = ! $registerd ? 'disabled' : '';
	$mo_current_user = wp_get_current_user();
	$controller      = MSN_DIR . 'controllers/';
	$url             = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
	$addon           = add_query_arg( array( 'page' => 'addon' ), remove_query_arg( 'addon', $url ) );

if ( isset( $_GET['addon'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the addon name, doesn't require nonce verification.
	switch ( $_GET['addon'] ) {  // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the addon name, doesn't require nonce verification.
		case 'woocommerce_notif':
			include $controller . 'wc-sms-notification.php';
			break;
	}
}
