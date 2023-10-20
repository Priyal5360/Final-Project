<?php
/**
 * Load admin view for Account Tab.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Handler\MoActionHandlerHandler;

echo '	<div class="wrap">
			<div><img style="float:left;" src="' . esc_url( MOV_LOGO_URL ) . '"></div>
			<div class="otp-header">
				' . esc_html( mo_( 'OTP Verification' ) ) . '
				<a class="add-new-h2" id="accountButton" href="' . esc_url( $profile_url ) . '">' . esc_html( mo_( 'Account' ) ) . '</a>
                <a class="add-new-h2" id="LicensingPlanButton" style="background-color:orange;color:black;" href="' . esc_url( $license_url ) . '">' . esc_html( mo_( 'Licensing Plans' ) ) . '</a>
				<a class="add-new-h2" id="faqButton" href="' . esc_url( $help_url ) . '" target="_blank">' . esc_html( mo_( 'FAQs' ) ) . '</a>';


echo '          <a class="mo-otp-demo add-new-h2" onClick="otpSupportOnClick(\'Hi! I am interested in using your plugin and would like to get a demo of the features and functionality. Please schedule a demo for the plugin. \');" id="demoButton">' . esc_html( mo_( 'Need a Demo?' ) ) . '</a>
	            <div class="mo-otp-help-button static" style="z-index:10">';

if ( $is_logged_in && ( 'MoGateway' === $gateway_type || $is_free_plugin ) ) {
	echo '           
                   <div id="mo_check_transactions" class=" flex  mr-mo-2 mb-mo-2 text-sm font-medium text-gray-900 bg-gray-50 rounded border border-gray-200 "> <div class="rounded	 px-mo-1 text-center" style="border-right: 3px groov; background-color: black;
				   "> <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" style="margin-top:5px;backgroud-color:black" class="w-mo-5 mr-mo-1 h-mo-5">
				   <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0112.548-3.364l1.903 1.903h-3.183a.75.75 0 100 1.5h4.992a.75.75 0 00.75-.75V4.356a.75.75 0 00-1.5 0v3.18l-1.9-1.9A9 9 0 003.306 9.67a.75.75 0 101.45.388zm15.408 3.352a.75.75 0 00-.919.53 7.5 7.5 0 01-12.548 3.364l-1.902-1.903h3.183a.75.75 0 000-1.5H2.984a.75.75 0 00-.75.75v4.992a.75.75 0 001.5 0v-3.18l1.9 1.9a9 9 0 0015.059-4.035.75.75 0 00-.53-.918z" clip-rule="evenodd" />
                 </svg> </div>	<div   class=" flex py-mo-1.5 px-mo-3 text-center bg-slate-200 hover:bg-slate-900 cursor-pointer"> ' . esc_html( mo_( 'Transactions' ) ) . '</div>  <div class="py-mo-1.5 px-mo-3 text-center text-sm items-center font-semibold ">Email ' . esc_attr( $remaining_email ) . '  |  SMS ' . esc_attr( $remaining_sms ) . '</div></div>
                   ';
};



echo '  </div>
            </div>
		<form id="mo_check_transactions_form" style="display:none;" action="" method="post">';

			wp_nonce_field( 'mo_check_transactions_form', '_nonce' );
echo '<input type="hidden" name="option" value="mo_check_transactions" />
        </form></div>';

echo '	<div id="tab">
			<h2 class="nav-tab-wrapper">';

foreach ( $tab_details->tab_details as $motabs ) {
	if ( $motabs->show_in_nav ) {
		echo '<a  class="nav-tab 
                        ' . ( $active_tab === $motabs->menu_slug ? 'nav-tab-active' : '' ) . '" 
                        href="' . esc_url( $motabs->url ) . '"            
                        style="' . esc_attr( $motabs->css ) . '"
                        id="' . esc_attr( $motabs->id ) . '">
                        ' . esc_attr( $motabs->tab_name ) . '
                    </a>';
	}
}

		echo '</h2>';

if ( $is_logged_in && is_array( $modal_notice ) && $remaining_sms + $remaining_email <= 50 && ( 'MoGateway' === $gateway_type || $is_free_plugin ) ) {
	$remaining_total = $remaining_sms + $remaining_email;
	foreach ( $modal_notice as $key => $value ) {
		if ( in_array( $value, $modal_notice, true ) && $remaining_total <= $value && $remaining_total >= $key ) {
			MoActionHandlerHandler::mo_check_transactions();
			show_low_transaction_alert( $remaining_sms, $remaining_email, $key );
			break;
		}
	}
} else {
	$array = array(
		'21' => '50',
		'2'  => '10',
		'0'  => '1',
	);
	update_mo_option( 'mo_transaction_notice', $array );
}

if ( ! $registered ) {
	echo '<div  style="background-color:rgba(255,5,0,0.29);font-size:0.9em;" 
                        class="notice notice-error">
                        <h2>' . wp_kses( $register_msg, array( 'a' => array( 'href' => array() ) ) ) . '</h2>
                  </div>';
} elseif ( ! $activated ) {
	echo '<div  style="background-color:rgba(255,5,0,0.29);font-size:0.9em;" 
                        class="notice notice-error">
                        <h2>' . wp_kses( $activation_msg, array( 'a' => array( 'href' => array() ) ) ) . '</h2>
                  </div>';
} elseif ( ! $gatewayconfigured ) {
	echo '<div  style="background-color:rgba(255,5,0,0.29);font-size:0.9em;" 
                        class="notice notice-error">
                        <h2>' . wp_kses( $gateway_msg, array( 'a' => array( 'href' => array() ) ) ) . '</h2>
                  </div>';
}
if ( 'mo_hide_sms_notice' !== $is_sms_notice_closed ) {
	echo '<div  style="background-color:#ffffff;font-size:0.9em; border-left-color: #6088ff;"
                        class="notice mo_sms_notice is-dismissible">
                        <h2>Due to recent changes in the SMS Delivery rules by the government of some countries like Singapore, Israel, etc , you might face issues with SMS Delivery. In this case, contact us at <a style="cursor:pointer;" onclick="otpSupportOnClick();">otpsupport@xecurify.com</a>.</h2>
          </div>';
}
