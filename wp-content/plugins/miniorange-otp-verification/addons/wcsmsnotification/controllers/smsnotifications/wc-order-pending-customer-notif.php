<?php
/**
 * Load view for Customer Order Pending SMS Notification
 *
 * @package miniorange-otp-verification/addons
 */

use OTP\Helper\MoUtility;
use OTP\Helper\MoMessages;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$go_back_url        = remove_query_arg( array( 'sms' ), ( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : site_url() ) );
$sms_settings       = $notification_settings->get_wc_order_pending_notif();
$enable_disable_tag = $sms_settings->page . '_enable';
$textarea_tag       = $sms_settings->page . '_smsbody';
$recipient_tag      = $sms_settings->page . '_recipient';
$form_options       = $sms_settings->page . '_settings';

if ( MoUtility::are_form_options_being_saved( $form_options ) ) {
	if ( ! current_user_can( 'manage_options' ) || ! check_admin_referer( 'mo_admin_actions' ) ) {
		wp_die( esc_attr( MoMessages::showMessage( MoMessages::INVALID_OP ) ) );
	}
	$is_enabled = array_key_exists( $enable_disable_tag, $_POST ) ? true : false;
	$sms        = isset( $_POST[ $textarea_tag ] ) ? ( MoUtility::is_blank( sanitize_text_field( wp_unslash( $_POST[ $textarea_tag ] ) ) ) ? $sms_settings->default_sms_body : MoUtility::sanitize_check( $textarea_tag, $_POST ) ) : $sms_settings->default_sms_body;

	$notification_settings->get_wc_order_pending_notif()->set_is_enabled( $is_enabled );
		$notification_settings->get_wc_order_pending_notif()->set_sms_body( $sms );

	update_wc_option( 'notification_settings', $notification_settings );
	$sms_settings = $notification_settings->get_wc_order_pending_notif();
}

$recipient_value = $sms_settings->recipient;
$enable_disable  = $sms_settings->is_enabled ? 'checked' : '';

/* store all the available Tags */
$sms_settings->available_tags = '{site-name},{order-number},{username},{order-date}';
$sms_settings->available_tags = apply_filters( 'available_prem_tags', $sms_settings->available_tags, 'wc_premium_tags' );
$sms_settings->available_tags = apply_filters( 'mo_billing_tags', $sms_settings->available_tags );
$sms_settings->available_tags = apply_filters( 'mo_shipping_tags', $sms_settings->available_tags );

require MSN_DIR . '/views/smsnotifications/wc-customer-sms-template.php';
