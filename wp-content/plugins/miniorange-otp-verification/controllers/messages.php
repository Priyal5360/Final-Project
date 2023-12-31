<?php
/**
 * Loads admin view for common message tab.
 *
 * @package miniorange-otp-verification
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;

$nonce                = $admin_handler->get_nonce_value();
$otp_success_email    = get_mo_option( 'success_email_message', 'mo_otp_' ) ? get_mo_option( 'success_email_message', 'mo_otp_' ) : MoMessages::showMessage( MoMessages::OTP_SENT_EMAIL );
$otp_success_phone    = get_mo_option( 'success_phone_message', 'mo_otp_' ) ? get_mo_option( 'success_phone_message', 'mo_otp_' ) : MoMessages::showMessage( MoMessages::OTP_SENT_PHONE );
$otp_error_phone      = get_mo_option( 'error_phone_message', 'mo_otp_' ) ? get_mo_option( 'error_phone_message', 'mo_otp_' ) : MoMessages::showMessage( MoMessages::ERROR_OTP_PHONE );
$otp_error_email      = get_mo_option( 'error_email_message', 'mo_otp_' ) ? get_mo_option( 'error_email_message', 'mo_otp_' ) : MoMessages::showMessage( MoMessages::ERROR_OTP_EMAIL );
$phone_invalid_format = get_mo_option( 'invalid_phone_message', 'mo_otp_' ) ? get_mo_option( 'invalid_phone_message', 'mo_otp_' ) : MoMessages::showMessage( MoMessages::ERROR_PHONE_FORMAT );
$email_invalid_format = get_mo_option( 'invalid_email_message', 'mo_otp_' ) ? get_mo_option( 'invalid_email_message', 'mo_otp_' ) : MoMessages::showMessage( MoMessages::ERROR_EMAIL_FORMAT );
$invalid_otp          = MoUtility::get_invalid_otp_method();
$otp_blocked_email    = get_mo_option( 'blocked_email_message', 'mo_otp_' ) ? get_mo_option( 'blocked_email_message', 'mo_otp_' ) : MoMessages::showMessage( MoMessages::ERROR_EMAIL_BLOCKED );
$otp_blocked_phone    = get_mo_option( 'blocked_phone_message', 'mo_otp_' ) ? get_mo_option( 'blocked_phone_message', 'mo_otp_' ) : MoMessages::showMessage( MoMessages::ERROR_PHONE_BLOCKED );

require_once MOV_DIR . 'views/messages.php';
