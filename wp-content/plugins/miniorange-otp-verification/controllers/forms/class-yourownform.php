<?php
/**
 * Load admin view for YourOwnForm.
 *
 * @package miniorange-otp-verification/controller/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Handler\Forms\YourOwnForm;

$handler                  = YourOwnForm::instance();
$custom_form_enabled      = (bool) $handler->is_form_enabled() ? 'checked' : '';
$custom_form_hidden       = 'checked' === $custom_form_enabled ? '' : 'hidden';
$custom_form_enabled_type = $handler->get_otp_type_enabled();
$custom_form_field_list   = admin_url() . 'admin.php?page=custom_form';
$custom_form_field_key    = $handler->get_email_key_details();
$custom_form_type_phone   = $handler->get_phone_html_tag();
$custom_form_type_email   = $handler->get_email_html_tag();
$form_name                = $handler->get_form_name();
$button_text              = $handler->get_button_text();



$custom_form_submit_selector = $handler->getSubmitKeyDetails();
$custom_form_field_selector  = $handler->getFieldKeyDetails();

require_once MOV_DIR . 'views/forms/yourownform.php';
