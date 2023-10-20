<?php
/**
 * Loads support form view.
 *
 * @package miniorange-otp-verification
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Helper\MoConstants;

$nonce   = $admin_handler->get_nonce_value();
$email   = get_mo_option( 'admin_email' );
$phone   = get_mo_option( 'admin_phone' );
$phone   = $phone ? $phone : '';
$support = MoConstants::FEEDBACK_EMAIL;

require_once MOV_DIR . 'views/support.php';
