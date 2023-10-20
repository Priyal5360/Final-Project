<?php
/**
 * Addon controller.
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use OTP\Addons\PasswordReset\Handler\UMPasswordResetHandler;
use OTP\Handler\MoActionHandlerHandler;


$handler = UMPasswordResetHandler::instance();

$admin_handler     = MoActionHandlerHandler::instance();
$umpr_enabled      = $handler->is_form_enabled() ? 'checked' : '';
$umpr_hidden       = 'checked' === $umpr_enabled ? '' : 'hidden';
$umpr_enabled_type = $handler->get_otp_type_enabled();
$umpr_type_phone   = $handler->get_phone_html_tag();
$umpr_type_email   = $handler->get_email_html_tag();
$form_name         = $handler->get_form_name();
$umpr_button_text  = $handler->get_button_text();
$nonce             = $admin_handler->get_nonce_value();
$form_option       = $handler->get_form_option();
$umpr_field_key    = $handler->get_phone_key_details();
$umpr_only_phone   = $handler->getIsOnlyPhoneReset() ? 'checked' : '';

require UMPR_DIR . 'views/umpasswordreset.php';
