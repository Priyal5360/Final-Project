<?php
/**
 * View file for Customer Order Message
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

	echo '
			<div id="custom_order_sms_meta_box">
				<input type="hidden" id="post_ID" name="post_ID" value="' . esc_attr( get_the_ID() ) . '">
				<div id="jsonMsg" hidden></div>
				' . esc_html( mo_( 'Billing Phone' ) ) . ': <input type="text" id="billing_phone" name="billing_phone" value="' . esc_attr( $phone_numbers ) . '" style="width:100%"/><br><br>';


	echo '<tr>
                <td>
                <b>' . esc_html( mo_( 'Choose Template: ' ) ) . '</b><br>
                 <input type="radio" class="mo_custom_message_enable" id="mo_custom_msg_template1" checked="checked" name="mo_customer_validation_custom_message_template1" value="Template1">
                                    <label for="mo_custom_msg_template1">Template 1</label>&nbsp


                 <input type="radio" class="mo_custom_message_enable" id="mo_custom_msg_template2" name="mo_customer_validation_custom_message_template2"  value="Template2">
                                    <label for="mo_custom_msg_template2">Template 2</label>&nbsp
                </td>
                </tr>
                <p>
					<textarea type="text" name="mo_wc_custom_order_msg" id="mo_wc_custom_order_msg" class="mo_registration_table_textbox" style="width: 100%;" 
						rows="4" value="">You have received a message from {#var#}</textarea>
				</p>
				<p>
					<a class="button button-primary" id="mo_custom_order_send_message">' . esc_html( mo_( 'Send SMS' ) ) . '</a>
	        		<span id="characters" style="font-size:12px;float:right;">Remaining Characters : <span id="remaining">160</span> </span>
	        	</p>
			</div>

			<div class="mo_otp_note">
				<b>' . esc_html( mo_( 'Note : Only {##var##} of the template is editable. Do not replace the other fixed values.' ) ) . '<br></b>
                        </div>
                        <div class="mo_otp_note">
							<li>' . esc_html( mo_( 'For Template 1 : <b><u>You have received a message from</u></b> WordPress.domain.com. Please check your dashboard for account status.' ) ) . '</li>							
                            <li>' . esc_html( mo_( 'For Template 2 : <b><u>Hello</u></b> David, thank you for creating an account with us.' ) ) . '</i></li>
							<b>' . esc_html( mo_( 'Highlighted text in the examples above are compulsory in the message body.' ) ) . '</b>
                        </div>
                        <div class="mo_otp_note"><b>If you wish to customize the Template, contact us at <u>otpsupport@xecurify.com</u></b>.
                        </div>';

	$html2 = '<p>
					<textarea type="text" name="mo_wc_custom_order_msg" id="mo_wc_custom_order_msg" class="mo_registration_table_textbox" style="width: 100%;" 
						rows="4" value="" placeholder="' . esc_attr( mo_( 'Your custom message to be sent to the user' ) ) . '""></textarea>
				</p>
				<p>
					<a class="button button-primary" id="mo_custom_order_send_message">' . esc_html( mo_( 'Send SMS' ) ) . '</a>
	        		<span id="characters" style="font-size:12px;float:right;">Remaining Characters : <span id="remaining">160</span> </span>
	        	</p>
			</div>';




	echo '           

			<script>
				jQuery(document).ready(function () {  
					window.intlTelInput(document.querySelector("#billing_phone"));
				});
			</script>';
