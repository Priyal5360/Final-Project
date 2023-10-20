<?php
/**
 * Main Controller of Ultimate member SMS notifications.
 *
 * @package miniorange-otp-verification/addons/umsmsnotification/controllers
 */

use OTP\Addons\UmSMSNotification\Handler\UltimateMemberSMSNotificationsHandler;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$handler         = UltimateMemberSMSNotificationsHandler::instance();
$registerd       = $handler->moAddOnV();
$disabled        = ! $registerd ? 'disabled' : '';
$mo_current_user = wp_get_current_user();
$controller      = UMSN_DIR . 'controllers/';
$addon           = add_query_arg( array( 'page' => 'addon' ), remove_query_arg( 'addon', ( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '' ) ) );

if ( isset( $_GET['addon'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the addon name, doesn't require nonce verification.
	switch ( $_GET['addon'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the addon name, doesn't require nonce verification.
		case 'um_notif':
			include $controller . 'um-sms-notification.php';
			break;
	}
}
