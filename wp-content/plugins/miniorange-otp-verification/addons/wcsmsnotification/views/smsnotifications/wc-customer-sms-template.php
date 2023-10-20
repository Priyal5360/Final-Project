<?php
/**
 * View file to edit Customer SMS Template
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;

echo '	<div class="mo_registration_divided_layout mo-otp-full">
				<div class="mo_registration_table_layout mo-otp-center">';

					MoWcAddOnUtility::is_addon_activated();

	echo '			<table id="wc_customer_sms_template" style="width:100%">
						<form name="f" method="post" action="" id="' . esc_attr( $form_options ) . '">
							<input type="hidden" name="option" value="' . esc_attr( $form_options ) . '" />';
							wp_nonce_field( 'mo_admin_actions' );
	echo '						<tr>
								<td colspan="2">
									<h2>' . esc_attr( $sms_settings->page_header ) . '
									<span style="float:right;margin-top:-10px;">
										<a href="' . esc_url( $go_back_url ) . '" id="goBack" class="button button-primary button-large">
											' . esc_html( mo_( 'Go Back' ) ) . '
										</a>
										<input type="submit" name="save" id="save" ' . esc_attr( $disabled ) . ' 
										    class="button button-primary button-large" value="' . esc_attr( mo_( 'Save Settings' ) ) . '">
									</span>
									</h2>
									<hr>
								</td>
							</tr>
							<tr>
								<td colspan="2">' . esc_attr( $sms_settings->page_description ) . '</td>
							</tr>
							<tr>
								<td style="width:160px"><h4>' . esc_html( mo_( 'Enable/Disable' ) ) . '</h4></td>
								<td>
									<input class="" ' . esc_attr( $disabled ) . ' type="checkbox" name="' . esc_attr( $enable_disable_tag ) . '"
										id="' . esc_attr( $enable_disable_tag ) . '" style="" value="1" ' . esc_attr( $enable_disable ) . '>
									' . esc_html( mo_( 'Enable this SMS Notification' ) ) . '
								</td>
							</tr>
							<tr>
								<td>
									<h4 style="margin-top: -11px">' . esc_html( mo_( 'SMS Body' ) );
									mo_draw_tooltip( esc_html( mo_( 'AVAILABLE TAGS' ) ), $sms_settings->available_tags );
	echo '
									</h4>
								</td>
								<td>
									<textarea ' . esc_attr( $disabled ) . ' id="' . esc_attr( $textarea_tag ) . '" class="mo_registration_table_textbox"
										name="' . esc_attr( $textarea_tag ) . '" placeholder="' . esc_attr( $sms_settings->default_sms_body ) . '" />' . esc_html( $sms_settings->sms_body ) . '</textarea>
									<span id="characters">Remaining Characters : <span id="remaining">160</span></span>
									</td>
									</tr>
							<tr>
							</tr>';
echo '<tr>
								<td colspan="2">
									<div class="mo_otp_note">
										<b><u>' . esc_html( mo_( 'For Indian Traffic Only' ) ) . '</u>' . esc_html( mo_( ' : The above templates are the default registered templates. Do not make edits in the templates since it may lead to failure in delivery.' ) ) . '<br>' . esc_html( mo_( 'If you wish to customize the SMS Template, kindly contact us at ' ) ) . '<a style="cursor:pointer;" onClick="otpSupportOnClick();"><u> otpsupport@xecurify.com</u></a>.</b>
									</div>';

$html2 = '<tr>
								<td colspan="2">
									<div class="mo_otp_note">
										' . esc_html( mo_( 'You can have new line characters in your sms text body. To enter a new line character use the ' ) ) . '<b><i>%0a</i></b>' . esc_html( mo_( ' symbol. To enter a "#" character you can use the ' ) ) . '<b><i>%23</i></b>' . esc_html( mo_( ' symbol. To see a complete list of special characters that you can send in a SMS check with your gateway provider.' ) ) . '
									</div>';



echo '            
										<div class="mo_otp_note">
										' . esc_html( mo_( 'If you are looking for the extra ' ) ) . '<b>' . esc_html( mo_( 'Tags' ) ) . '</b>' . esc_html( mo_( ' in SMS Body, Please kindly contact us at ' ) ) . '<a style="cursor:pointer;" onClick="otpSupportOnClick();"><u> otpsupport@xecurify.com</u></a>.
									</div>
								</td>
							</tr>
						 </form>	
					</table>
				</div>
			</div>';
