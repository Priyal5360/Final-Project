<?php
/**
 * Controller of Ultimate member SMS notifications.
 *
 * @package miniorange-otp-verification/addons/umsmsnotification/controllers
 */

use OTP\Addons\UmSMSNotification\Helper\UltimateMemberNotificationsList;
use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationMessages;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$notification_settings = maybe_unserialize( get_umsn_option( 'notification_settings' ) );
$notification_settings = $notification_settings ? $notification_settings : UltimateMemberNotificationsList::instance();
$sms                   = '';

if ( isset( $_GET['sms'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the SMS Notification type, doesn't require nonce verification.
	$sms             = sanitize_text_field( wp_unslash( $_GET['sms'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the SMS Notification type, doesn't require nonce verification.
	$smsnotification = $controller . '/smsnotifications/';
	switch ( $_GET['sms'] ) {// phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the SMS Notification type, doesn't require nonce verification. 
		case 'um_new_customer_notif':
			include $smsnotification . 'um-new-customer-notif.php';
			break;
		case 'um_new_customer_admin_notif':
			include $smsnotification . 'um-new-customer-admin-notif.php';
			break;
	}
} else {
	include UMSN_DIR . '/views/um-sms-notification.php';
}


/**
 * Display the Ultimate Member SMS Notification table
 *
 * @param UltimateMemberNotificationsList $notifications - contains all the data of the ultimate member notifications notifications.
 */
function show_notifications_table( UltimateMemberNotificationsList $notifications ) {
	foreach ( $notifications as $notification => $property ) {
		$url = add_query_arg( array( 'sms' => $property->page ), ( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '' ) );

		echo '	<tr>
                    <td class="umsn-table-list-status">
                        <span class="' . ( $property->is_enabled ? 'status-enabled' : '' ) . '"></span>
                    </td>
                    <td class="umsn-table-list-name">
                        <a href="' . esc_url( $url ) . '">' . esc_attr( $property->title ) . '</a>';

						mo_draw_tooltip(
							UltimateMemberSMSNotificationMessages::showMessage( $property->tool_tip_header ),
							UltimateMemberSMSNotificationMessages::showMessage( $property->tool_tip_body )
						);

		echo '		</td>
                    <td class="umsn-table-list-recipient" style="word-wrap: break-word;">
                        ' . esc_html( $property->notification_type ) . '
                    </td>
                    <td class="umsn-table-list-status-actions">
                        <a class="button alignright tips" href="' . esc_url( $url ) . '">Configure</a>
                    </td>
                </tr>';
	}
}
