<?php
/**
 * Loads admin view for PremiumForms.
 *
 * @package miniorange-otp-verification/controller/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Handler\Forms\PremiumForms;
use OTP\Helper\PremiumFeatureList;

$handler   = PremiumForms::instance();
$form_name = $handler->get_form_name();
get_plugin_form_link( $handler->get_form_documents() );
require_once MOV_DIR . 'views/forms/premiumforms.php';

