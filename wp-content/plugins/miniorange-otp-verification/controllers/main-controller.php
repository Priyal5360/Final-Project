<?php
/**
 * Loads the tab view and initializes other controllers.
 *
 * @package miniorange-otp-verification
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Handler\MoActionHandlerHandler;
use OTP\Helper\MoUtility;
use OTP\Objects\TabDetails;

$registered        = MoUtility::micr();
$activated         = MoUtility::mclv();
$gatewayconfigured = MoUtility::is_gateway_config();
$plan              = MoUtility::micv();
$disabled          = ( ( $registered && $activated ) || ( strcmp( MOV_TYPE, 'MiniOrangeGateway' ) === 0 ) ) ? '' : 'disabled';
$mo_current_user   = wp_get_current_user();
$email             = get_mo_option( 'admin_email' );
$phone             = get_mo_option( 'admin_phone' );
$controller        = MOV_DIR . 'controllers/';
$admin_handler     = MoActionHandlerHandler::instance();


$tab_details = TabDetails::instance();

require_once $controller . 'navbar.php';
echo "<div class='mo-opt-content'>
        <div id='moblock' class='mo_customer_validation-modal-backdrop dashboard'>" .
			"<img src='" . esc_url( MOV_LOADER_URL ) . "'>" .
		'</div>';

if ( isset( $_GET['page'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the tab name, doesn't require nonce verification.

	foreach ( $tab_details->tab_details as $mo_tabs ) {
		if ( sanitize_text_field( wp_unslash( $_GET['page'] ) ) === $mo_tabs->menu_slug ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the tab name, doesn't require nonce verification.
			require_once $controller . $mo_tabs->view;
		}
	}

	do_action( 'mo_otp_verification_add_on_controller' );
	require_once $controller . 'support.php';
}

echo '</div>';

echo '   <div class="mo_otp_footer"> 
  <div class="mo-otp-mail-button">
  <img src="' . esc_url( MOV_MAIL_LOGO ) . '" class="show_support_form" id="helpButton"></div>
  <button type="button" class="mo-otp-help-button-text">Hello there!<br>Need Help? Drop us an Email</button>
  </div>';

