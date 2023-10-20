<?php
/**
 * Load view for SMS Notifications List
 *
 * @package miniorange-otp-verification/addons
 */

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\WooCommerceNotificationsList;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$notification_settings = get_wc_option( 'notification_settings' );
$notification_settings = $notification_settings ? maybe_unserialize( $notification_settings )
												: WooCommerceNotificationsList::instance();
$sms                   = '';

if ( isset( $_GET['sms'] ) ) {// phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the SMS Notification type, doesn't require nonce verification.
	$sms             = sanitize_text_field( wp_unslash( $_GET['sms'] ) );// phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the SMS Notification type, doesn't require nonce verification.
	$smsnotification = $controller . '/smsnotifications/';
	switch ( $_GET['sms'] ) {// phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the SMS Notification type, doesn't require nonce verification.
		case 'wc_new_customer_notif':
			include $smsnotification . 'wc-new-customer-notif.php';
			break;
		case 'wc_customer_note_notif':
			include $smsnotification . 'wc-customer-note-notif.php';
			break;
		case 'wc_order_cancelled_notif':
			include $smsnotification . 'wc-order-cancelled-customer-notif.php';
			break;
		case 'wc_order_completed_notif':
			include $smsnotification . 'wc-order-completed-customer-notif.php';
			break;
		case 'wc_order_failed_notif':
			include $smsnotification . 'wc-order-failed-customer-notif.php';
			break;
		case 'wc_order_on_hold_notif':
			include $smsnotification . 'wc-order-onhold-customer-notif.php';
			break;
		case 'wc_order_processing_notif':
			include $smsnotification . 'wc-order-processing-customer-notif.php';
			break;
		case 'wc_order_refunded_notif':
			include $smsnotification . 'wc-order-refunded-customer-notif.php';
			break;
		case 'wc_admin_order_status_notif':
			include $smsnotification . 'wc-order-status-admin-notif.php';
			break;
		case 'wc_order_pending_notif':
			include $smsnotification . 'wc-order-pending-customer-notif.php';
			break;
	}
} else {
	include MSN_DIR . '/views/wc-sms-notification.php';
}

/**
 * This function is used to display rows in the notification table for the admin to get an
 * overview of all the SMS notifications that are going out because of the plugin. It displays
 * if the notification is enabled, who the recipient is , the type of SMS notification etc.
 *
 * @param WooCommerceNotificationsList $notifications The list of all notifications for WooCommerce.
 */
function show_notifications_table( WooCommerceNotificationsList $notifications ) {
	foreach ( $notifications as $notification => $property ) {
		$url = add_query_arg( array( 'sms' => $property->page ), isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( ( $_SERVER['REQUEST_URI'] ) ) ) : site_url() );

		echo '	<tr>
                    <td class="msn-table-list-status">
                        <span class="' . ( $property->is_enabled ? 'status-enabled' : '' ) . '"></span>
                    </td>
                    <td class="msn-table-list-name">
                        <a href="' . esc_url( $url ) . '">' . esc_attr( $property->title ) . '</a>';

						mo_draw_tooltip(
							MoWcAddOnMessages::showMessage( $property->tool_tip_header ),
							MoWcAddOnMessages::showMessage( $property->tool_tip_body )
						);

		echo '		</td>
                    <td class="msn-table-list-recipient" style="word-wrap: break-word;">
                        ' . esc_html( $property->notification_type ) . '
                    </td>
                    <td class="msn-table-list-status-actions">
                        <a class="button alignright tips" href="' . esc_url( $url ) . '">Configure</a>
                    </td>
                </tr>';
	}
}
