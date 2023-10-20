<?php
/**
 * Load admin view for Ultimate member new customer notifications.
 *
 * @package miniorange-otp-verification/addons/umsmsnotification/controllers/smsnotifications
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use OTP\Helper\MoUtility;
use OTP\Helper\MoMessages;

$go_back_url        = remove_query_arg( array( 'sms' ), ( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '' ) );
$sms_settings       = $notification_settings->get_um_new_customer_notif();
$enable_disable_tag = $sms_settings->page . '_enable';
$textarea_tag       = $sms_settings->page . '_smsbody';
$recipient_tag      = $sms_settings->page . '_recipient';
$form_options       = $sms_settings->page . '_settings';

if ( MoUtility::are_form_options_being_saved( $form_options ) ) {
	if ( ! current_user_can( 'manage_options' ) || ! check_admin_referer( 'mo_admin_actions' ) ) {
			wp_die( esc_attr( MoMessages::showMessage( MoMessages::INVALID_OP ) ) );
	}
	$is_enabled      = array_key_exists( $enable_disable_tag, $_POST ) ? true : false;
	$recipient_value = MoUtility::sanitize_check( $recipient_tag, $_POST );
	$textar_tag      = isset( $_POST [ $textarea_tag ] ) ? sanitize_textarea_field( wp_unslash( $_POST [ $textarea_tag ] ) ) : null;
	$sms             = MoUtility::is_blank( $textar_tag ) ? $sms_settings->default_sms_body : MoUtility::sanitize_check( $textarea_tag, $_POST );
	$notification_settings->get_um_new_customer_notif()->set_is_enabled( $is_enabled );
	$notification_settings->get_um_new_customer_notif()->set_recipient( $recipient_value );
	$notification_settings->get_um_new_customer_notif()->set_sms_body( $sms );

	update_umsn_option( 'notification_settings', $notification_settings );
	$sms_settings = $notification_settings->get_um_new_customer_notif();
}

$recipient_value = maybe_unserialize( $sms_settings->recipient );
$recipient_value = MoUtility::is_blank( $recipient_value ) ? 'mobile_number' : $recipient_value;
$enable_disable  = $sms_settings->is_enabled ? 'checked' : '';

require UMSN_DIR . '/views/smsnotifications/um-customer-sms-template.php';
