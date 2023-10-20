<?php
/**
 * Load admin view for set up guides and marketed plugins.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;

echo '<div class="mo_registration_table_layout mo-otp-left">';
echo '      <table style ="width:100%">
				<tr>
					<td colspan="2">
						<h2>' . esc_html( mo_( 'SET UP GUIDE' ) ) . '
							</span>
							<span style="float:right;margin-top:-10px;">
								<span   class="mo-dashicons dashicons dashicons-arrow-down toggle-div" 
										data-show="false" 
										data-toggle="mo_setup_guide">                                            
								</span>
							</span>
						</h2>
						Need help in plugin setup? Follow this guide: <a style="cursor:pointer;" href =' . esc_url( 'https://plugins.miniorange.com/step-by-step-guide-for-wordpress-otp-verification' ) . ' target = "_blank"><span> Setup Guide</span></a>.
						<br>
						<br>
						You can check our supported Forms and their guide: <a style="cursor:pointer;" href =' . esc_url( 'https://plugins.miniorange.com/otp-verification-forms' ) . ' target = "_blank"><span>Supported Forms</span></a>.
						<hr>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div id="mo_setup_guide" hidden >
							<div class="mo_otp_note">
								<b><div>
									' . esc_html( mo_( 'HOW DO I USE THE PLUGIN' ) ) . '
									</div></b>
									<hr>    
								<div id="how_to_use_the_otp_plugin" >
									' . esc_html( mo_( 'By following these easy steps you can verify your users email or phone number instantly' ) ) . ':
									<ol>
										<li>' . esc_html( mo_( 'Select the form from the list.' ) );
echo '                                     <span class="tooltip">
												<span style="display: contents; color:#2271b1;  font-size:15px" ;">[cannot find your form?]</span>
												<span class="tooltiptext">
													<span class="header"><b><i>' . esc_html( MoMessages::showMessage( MoMessages::FORM_NOT_AVAIL_HEAD ) ) . '</i></b></span><br/><br/>
													<span class="body">We are actively adding support for more forms. Please contact us using the support form on your right or email us at <a onClick="otpSupportOnClick();" href="#"><span style="color:white"><u>' . esc_attr( MoConstants::FEEDBACK_EMAIL ) . '</u>.</span></a> While contacting us please include enough information about your registration form and how you intend to use this plugin. We will respond promptly.</span>
												</span>
											  </span>';
echo '                                   </li>
										<li>' . esc_html( mo_( 'Save your form settings from under the Form Settings section.' ) ) . '</li>
										<li>' . esc_html( mo_( 'To add a dropdown to your phone field or select a default country code check the ' ) ) . '
											<i><a href="' . esc_url( $otp_settings ) . '" target="_blank">' . esc_html( mo_( 'OTP Settings Tab' ) ) . '</a></i></li>
										<li>' . esc_html( mo_( 'To customize your SMS/Email messages/gateway check under' ) ) . '
										   <i><a href="' . esc_url( $config ) . '" target="_blank">' . esc_html( mo_( 'SMS/Email Templates Tab' ) ) . '</a></i></li>
										<li>' . esc_html( mo_( 'You are ready to test OTP Verification on your form!' ) ) . '</li>
										<li>' . esc_html( mo_( 'For any query related to custom SMS/Email messages/gateway check our' ) ) . ' 
										   <i><a href="' . esc_url( $help_url ) . '" target="_blank"> ' . esc_html( mo_( 'FAQs' ) ) . '</a></i></li>
										</i>
									</ol>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>';
echo '       <table style="width:100%">
				<tr>
					<td colspan="2">
						<h2>' . esc_html( mo_( 'PREMIUM FEATURES' ) ) . '
							<span style="float:right;margin-top:-10px;">
								<span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div" 
										data-show="false" 
										data-toggle="mo_otp_new_features">                                            
								</span>
							</span>
						</h2> 
						To know more, please kindly contact us at <a style="cursor:pointer;" onClick="otpSupportOnClick();"><u> otpsupport@xecurify.com</u></a>.
						<hr>
					</td>
				</tr>

				<tr>
					<td colspan="2">
			<div id="mo_otp_new_features">

			
			<div class = "mo_new_feature_table">
			<table>
			<tr>
			<td> <img class = "mo_support_form_new_firebase_feature mo_otp_new_feature_class" src="' . esc_url( MOV_URL ) . 'includes/images/mo_firebase.png"></td>
			<td> <div class = "mo_otp_new_feature_class_note"> <b>Use Firebase as your Custom SMS gateway to send One Time Passcodes for Phone Verification. </b></div> </td>
			</tr>
			</table>
			</div>
			
			<div class = "mo_new_feature_table">
			<table>
			<tr>
			<td> <img class = "mo_support_form_new_feature mo_otp_new_feature_class" src="' . esc_url( MOV_URL ) . 'includes/images/mo_wcfm.jpeg"></td>
			<td> <div class = "mo_otp_new_feature_class_note"> <b>Phone or Email Verification via OTP on the WCFM Vendor Registration and WCFM Vendor Membership Forms.</b></div> </td>
			</tr>
			</table>
			</div>

			<div class = "mo_new_feature_table">
			<table>
			<tr>
			<td> <img class = "mo_support_form_new_feature mo_otp_new_feature_class" src="' . esc_url( MOV_URL ) . 'includes/images/mo_elementor_pro.jpg"></td>
			<td> <div class = "mo_otp_new_feature_class_note"> <b>Phone or Email Verification via OTP on Elementor PRO form.</b></div> </td>
			</tr>
			</table>
			</div>

			<div class = "mo_new_feature_table">
			<table>
			<tr>
			<td> <img class = "mo_support_form_new_feature mo_otp_new_feature_class" src="' . esc_url( MOV_URL ) . 'includes/images/mo_aws_sns.png"></td>
			<td> <div class = "mo_otp_new_feature_class_note"> <b>Use AWS SNS as your Custom SMS gateway to send One Time Passcodes, Custom messages or SMS Notifications.</b> </div> </td>
			</tr>
			</table>
			</div>

			<div class = "mo_new_feature_table">
			<table>
			<tr>
			<td> <img class = "mo_support_form_new_feature mo_otp_new_feature_class" src="' . esc_url( MOV_URL ) . 'includes/images/mo_user_reg.png"></td>
			<td> <div class = "mo_otp_new_feature_class_note"> <b>Phone or Email Verification via OTP on User Registration forms- WPEverest. </b></div> </td>
			</tr>
			</table>
			</div>

			<div class = "mo_new_feature_table">
			<table>
			<tr>
			<td> <img class = "mo_support_form_new_feature mo_otp_new_feature_class" src="' . esc_url( MOV_URL ) . 'includes/images/mo_social_login.png"></td>
			<td> <div class = "mo_otp_new_feature_class_note"> <b>Support for OTP Verification to be initiated after login/registration through Social media. </b></div> </td>
			</tr>
			</table>
			</div>


							   </div>
							   </td>
							   </tr>

				</table>';


echo '       <table style="width:100%">
				<tr>
					<td colspan="2">
						<h2>' . esc_html( mo_( 'FREQUENTLY ASKED QUESTIONS' ) ) . '
							<span style="float:right;margin-top:-10px;">
								<span   class="mo-dashicons dashicons dashicons-arrow-down toggle-div" 
										data-show="false" 
										data-toggle="mo_form_instructions">                                            
								</span>
							</span>
						</h2> <hr>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div id="mo_form_instructions" hidden>
							<div class="mo_otp_note">
								<b><div class="mo_otp_dropdown_note" data-toggle="wp_dropdown">
									' . esc_html( mo_( 'HOW DO I SHOW A COUNTRY CODE DROP-DOWN ON MY FORM?' ) ) . '
									</div></b>
								<div id="wp_dropdown" hidden >
									 ' . wp_kses(
										mo_(
											'To enable a country dropdown for your phone number field simply enable the option from the Country Code Settings under <i><a href="' . esc_url( $otp_settings ) . '">OTP Settings Tab</a></i>'
										),
										array(
											'a' => array( 'href' => array() ),
											'i' => array(),
										)
									) . '
								</div>
							</div>
							<div class="mo_otp_note">
								<b><div class="mo_otp_dropdown_note" data-toggle="mo_payment_method">
								 ' . esc_html( mo_( 'SUPPORTED PAYMENT METHODS FOR OTP VERIFICATION' ) ) . '
									</div>
								</b>
								<div id="mo_payment_method" hidden> ' . esc_html( mo_( 'Two types of methods which we support;' ) ) . ' <br> <b>' . esc_html( mo_( ' A. Default Method:' ) ) . '</b> 
									<ul>
										<li>' . esc_html( mo_( 'Payment by Credit card/International debit card.' ) ) . '</li>
										<li>' . wp_kses( mo_( 'If payment is done through Credit Card/Intrnational debit card, the license would be made automatically once payment is completed. For guide <a href="' . MoConstants::FAQ_PAY_URL . '">Click Here.</a>' ), array( 'a' => array( 'href' => array() ) ) ) . ' </li>
									</ul> ' .
									' <b>' . esc_html( mo_( 'B. Alternative Methods:' ) ) . '</b>
									<ol>
										<li> ' . wp_kses( mo_( ' <b> Paypal: </b> use the following PayPal id for payment via PayPal . ' ), array( 'b' => array() ) ) . ' ' . wp_kses( mo_( ' < i style="color:#0073aa"> info@xecurify.com </i> ' ), array( 'i' => array( 'style' => array() ) ) ) . ' </li>    
										<li> ' . wp_kses(
											mo_( "<b> Net Banking: </b> if you want to use net banking for payment then contact us at < i style='color:#0073aa'>" ),
											array(
												'b' => array(),
												'i' => array( 'style' => array() ),
											)
										) . esc_attr( MoConstants::SUPPORT_EMAIL ) . wp_kses( mo_( ' </i> so that we will provide you bank details . ' ), array( 'i' => array() ) ) . ' </li> 
									<ol>'
									. esc_html( mo_( 'Once you Paid through any of the above methods, please inform us so that we can confirm and update your License ' ) ) . wp_kses( mo_( ' < b> Note: </b> There is an additional 18 % GST applicable via PayPal and Bank Transfer ' ), array( 'b' => array() ) ) . ' <br> ' . wp_kses(
										mo_( 'for more information about payment methods visit < i>< a href=' . esc_url( MoConstants::FAQ_PAY_URL ) . '> Supported Payment Methods . </a></i> ' ),
										array(
											'a' => array( 'href' => array() ),
											'i' => array(),
										)
									) . ' 
								</div>
							</div>';
echo '						<div class="mo_otp_note">
								<b> 
									<div class="mo_otp_dropdown_note" data-toggle="wp_sms_email_template">
									' . esc_html( mo_( 'HOW do I CHANGE THE BODY OF THE SMS and EMAIL GOING OUT ? ' ) ) . '
									</div> 
								</b>
								<div id="wp_sms_email_template" hidden >
									' . wp_kses(
										mo_( 'You can change the body of the SMS and Email going out to users by following instructions under the < i > <a href = "' . esc_url( $config ) . '" > SMS / Email Template Tab </a> </i> ' ),
										array(
											'a' => array( 'href' => array() ),
											'i' => array(),
										)
									) . '
								</div>
							</div>
							<div class= "mo_otp_note" >
								<!-- <div class="mo_corner_ribbon shadow">' . esc_html( mo_( 'new ' ) ) . '</div> -->
								<b> <div class= "mo_otp_dropdown_note notification" data-toggle= "wc_sms_notif_addon">
									' . esc_html( mo_( 'LOOKING for A WOOCOMMERCE or ULTIMATE MEMBER SMS NOTIFICATION PLUGIN ? ' ) ) . '
									</div> 
								</b>
								<div id="wc_sms_notif_addon" hidden >
									' . wp_kses(
										mo_( ' < b > Looking for a plugin that will send out SMS notifications to users and admin for WooCommerce or Ultimate Member ? < / b > We have a separate add - on for that . Check the < i > < a href = "' . esc_url( $addon ) . '" > AddOns Tab < / a > < / i > for more information . ' ),
										array(
											'a' => array( 'href' => array() ),
											'b' => array(),
											'i' => array(),
										)
									) . '
								</div>
							</div>
							<div class="mo_otp_note" >
								<b><div class="mo_otp_dropdown_note" data-toggle="wp_sms_transaction_upgrade" >
									' . esc_html( mo_( 'HOW do I BUY MORE TRANSACTIONS ? HOW do I UPGRADE ? ' ) ) . '
									</div></b>
								<div id= "wp_sms_transaction_upgrade" hidden >
									' . wp_kses(
										mo_( 'You can upgrade and recharge at any time . You can even configure any external SMS / Email gateway provider with the plugin . < i > < a href = "' . esc_url( $license_url ) . '" > Click Here < / i > < / a > or the upgrade button on the top of the page to check our pricing and plans . ' ),
										array(
											'a' => array( 'href' => array() ),
											'i' => array(),
										)
									) . '
								</div>
							</div>
							<div class="mo_otp_note">
								<b> <div class = "mo_otp_dropdown_note" data-toggle="wp_design_custom">
									' . esc_html( mo_( 'HOW do I CHANGE THE DESIGN OF THE POPUP ? ' ) ) . '
									</div> 
								</b>
								<div id="wp_design_custom" hidden >
									' . wp_kses(
										mo_( 'if you wish to change how the popup looks to match your sites look and feel then you can do so from the < i > < a href = "' . esc_url( $design ) . '" > PopUp Design Tab . < / a > < / i > ' ),
										array(
											'a' => array( 'href' => array() ),
											'i' => array(),
										)
									) . '
								</div>
							</div>
							<div class= "mo_otp_note">
								<b> <div class="mo_otp_dropdown_note" data-toggle="wp_sms_integration">
									' . esc_html( mo_( 'NEED TO ENABLE OTP VERIFICATION ON A CUSTOM FORM ? ' ) ) . '
									</div></b>
								<div id="wp_sms_integration" hidden >
									' . wp_kses(
										mo_( 'if you wish to integrate the plugin with your form then please contact us at < a onclick="otpSupportOnClick();"> < i > "' . esc_url( $support ) . '" < / i > < / a > or use the support form to send us a query . ' ),
										array(
											'a' => array(
												'href'    => array(),
												'onclick' => array(),
											),
											'i' => array(),
										)
									) . ' 
								</div>
							</div>
							<div class="mo_otp_note">
								<b> <div class="mo_otp_dropdown_note" data-toggle="wp_reports" >
									' . esc_html( mo_( 'NEED TO TRACK TRANSACTIONS ? ' ) ) . '
									</div></b>
								<div id= "wp_reports" hidden>
									<div>
										<b> ' . esc_html( mo_( 'Follow these steps to view your transactions : ' ) ) . ' </b>
										<ol>
											<li> ' . esc_html( mo_( 'Click on the button below . ' ) ) . ' </li>
											<li> ' . esc_html( mo_( 'Login using the credentials you used to register for this plugin . ' ) ) . ' </li>
											<li> ' . wp_kses(
												mo_( 'You will be presented with <i> <b> View Transactions </b> </i> page . ' ),
												array(
													'b' => array(),
													'i' => array(),
												)
											) . ' </li>
											<li> ' . esc_html( mo_( 'From this page you can track your remaining transactions' ) ) . ' </li>
										</ol>
										<div style="margin-top:2%;text-align:center">
											<input type="button"
													title   = "' . esc_attr( mo_( 'Need to be registered for this option to be available' ) ) . '"
													value   = "' . esc_attr( mo_( 'View Transactions' ) ) . '"
													onclick = "extraSettings(\'' . esc_js( MoConstants::HOSTNAME ) . '\',\'' . esc_attr( MoConstants::VIEW_TRANSACTIONS ) . '\');"
													class   = "button button-primary button-large" style="margin-right:3%;" >
										</div>
									</div>
									<form id="showExtraSettings" action= "' . esc_attr( MoConstants::HOSTNAME ) . '/moas/login" target = "_blank" method = "post" >
									   <input type="hidden" id="extraSettingsUsername" name="username" value = "' . esc_attr( $email ) . '" / >
									   <input type="hidden" id="extraSettingsRedirectURL" name="redirectUrl" value="" / >
									   <input type="hidden" id="" name="requestOrigin" value="' . esc_attr( $plan_type ) . '" / >
									</form>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table> </div> ';
