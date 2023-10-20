<?php
/**
 * Load admin view for OTP Settings Tab.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;

echo '	<div class="mo_registration_divided_layout mo-otp-full">
			<form name="f" method="post" action="" id="mo_otp_verification_settings">
			    <input type="hidden" name="option" value="mo_otp_extra_settings" />';

				wp_nonce_field( $nonce );

echo '			<div style="display:flow-root">
                    <div class="mo_registration_table_layout mo-otp-half">
                        <table style="width:100%">
                            <tr>
                                <td>
                                    <h3>
                                        ' . esc_html( mo_( 'COUNTRY CODE: ' ) ) . '
                                        <span style="float:right;margin-top:-10px;">
                                            <input  type="submit" ' . esc_attr( $disabled ) . '
                                                    name="save"
                                                    class="button button-primary button-large"
                                                    value="' . esc_attr( mo_( 'Save Settings' ) ) . '"/>
                                                <span   class="dashicons dashicons-arrow-up toggle-div"
                                                        data-show="false"
                                                        data-toggle="country_code_settings"></span>
                                        </span>
                                    </h3><hr>
                                </td>
                            </tr>
                        </table>
					    <div id="country_code_settings">
                            <table style="width:100%">
                                <tr>
                                    <td><strong>' . esc_html( mo_( 'Select Default Country Code' ) ) . ': </strong></td>
                                    <td>';
										get_country_code_dropdown();
echo '</td>
                                    <td>';
										mo_draw_tooltip(
											MoMessages::showMessage( MoMessages::COUNTRY_CODE_HEAD ),
											MoMessages::showMessage( MoMessages::COUNTRY_CODE_BODY )
										);
										echo '</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><style="margin-left:1%">' . esc_html( mo_( 'Country Code' ) ) . ': <span id="country_code"></span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input  type="checkbox" ' . esc_attr( $disabled ) . '
                                                name="show_dropdown_on_form"
                                                id="dropdownEnable"
                                                value="1"' . esc_attr( $show_dropdown_on_form ) . ' />
                                        ' . esc_html( mo_( 'Show a country code dropdown on the phone field.' ) ) . '
                                    </td>
                                </tr>
                                <tr><td colspan="3"></td></tr>
                                <tr><td colspan="3"></td></tr>
                            </table>
                        </div>
                    </div>
                    <div id="otpLengthValidity" class="mo_registration_table_layout mo-otp-half">';

										echo '	            <table style="width:100%">
                            <tr>
                                <td colspan="2">
                                    <h3>
                                        ' . esc_html( mo_( 'OTP PROPERTIES: ' ) ) . '
                                        <span style="float:right;margin-top:-10px;">';
										if ( ! $show_transaction_options ) {
											echo '                                           <input  type="submit" ' . esc_attr( $disabled ) . '
                                                            name="save"
                                                            class="button button-primary button-large"
                                                            value="' . esc_attr( mo_( 'Save Settings' ) ) . '"/>';
										}
										echo '                                       <span  class="dashicons dashicons-arrow-up toggle-div"
                                                        data-show="false"
                                                        data-toggle="otp_settings">
                                                </span>
                                        </span>
                                    </h3>
                                    <hr>
                                </td>
                            </tr>
                        </table>
                        <div id="otp_settings">';

										if ( $show_transaction_options ) {
											echo '<table>
                                <tr>
                                    <td><strong>' . esc_html( mo_( 'OTP LENGTH: ' ) ) . '</strong></td>
                                    <td><strong>' . esc_html( mo_( 'OTP VALIDITY (in mins): ' ) ) . '</strong></td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="mo_otp_note" style="padding:10px;">
                                            <div class="mo_otp_dropdown_note">
                                                <a href="' . esc_url( MoConstants::FAQ_BASE_URL ) . 'change-length-otp/" target="_blank">
                                                    ' . esc_html( mo_( 'Click here to see how you can change OTP Length' ) ) . '
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <div class="mo_otp_note" style="padding:10px;">
                                            <div class="mo_otp_dropdown_note">
                                                <a href="' . esc_url( MoConstants::FAQ_BASE_URL ) . 'change-time-otp-stays-valid/" target="_blank">
                                                    ' . esc_html( mo_( 'Click here to see how you can change OTP Validity' ) ) . '</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
										} else {

											echo '<table>
                                <tr>
                                    <td><strong><i>' . esc_html( mo_( 'OTP LENGTH: ' ) ) . '</i></strong></td>
                                    <td><strong><i>' . esc_html( mo_( 'OTP VALIDITY (in mins): ' ) ) . '</i></strong></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input  type="text"
                                                class="mo_registration_table_textbox"
                                                value="' . esc_attr( $mo_otp_length ) . '"
                                                name="mo_otp_length"/>
                                        <div class="mo_otp_note" style="color:#942828;">
                                            <i>' . esc_html( mo_( 'Enter the length that you want the OTP to be. Default is 5' ) ) . '</i>
                                        </div>
                                    </td>
                                    <td>
                                        <input  type="text"
                                                class="mo_registration_table_textbox"
                                                value="' . esc_attr( $mo_otp_validity ) . '"
                                                name="mo_otp_validity"/>
                                        <div class="mo_otp_note" style="color:#942828;">
                                            <i>' . esc_html( mo_( 'Enter the time in minutes an OTP will stay valid for. Default is 5 mins' ) ) . '</i>
                                        </div>
                                    </td>
                                </tr>';
										}

										echo '    		    </table>
                        </div>
                    </div>
                </div>
                <div style="display:flow-root">
                    <div id="blockedEmailList" class="mo_registration_table_layout mo-otp-half">
                        <table style="width:100%">
                            <tr>
                                <td colspan="2">
                                    <h3>
                                        ' . esc_html( mo_( 'BLOCKED EMAIL DOMAINS: ' ) ) . '
                                        <span style="float:right;margin-top:-10px;">
                                            <input  type="submit" ' . esc_attr( $disabled ) . '
                                                    name="save"
                                                    class="button button-primary button-large"
                                                    value="' . esc_attr( mo_( 'Save Settings' ) ) . '"/>
                                            <span   class="dashicons dashicons-arrow-up toggle-div"
                                                    data-show="false"
                                                    data-toggle="blocked_email_settings">
                                            </span>
                                        </span>
                                    </h3><hr>
                                </td>
                            </tr>
                        </table>
                        <div id="blocked_email_settings">
                            <table style="width:100%">
                                <tr>
                                    <td colspan="2">
                                        <textarea   name="mo_otp_blocked_email_domains"
                                                    rows="5"
                                                    placeholder="' . esc_attr(
														mo_(
															' Enter semicolon separated domains that
                                                    you want to block. Eg. gmail.com '
														)
													) . '">' .
											esc_attr( $otp_blocked_email_domains ) .
										'</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="blockedPhoneList" class="mo_registration_table_layout mo-otp-half">
                        <table style="width:100%">
                            <tr>
                                <td colspan="2">
                                    <h3>
                                        ' . esc_html( mo_( 'BLOCKED PHONE NUMBERS: ' ) ) . '
                                        <span style="float:right;margin-top:-10px;">
                                            <input  type="submit" ' . esc_attr( $disabled ) . '
                                                    name="save"
                                                    class="button button-primary button-large"
                                                    value="' . esc_attr( mo_( 'Save Settings' ) ) . '"/>
                                            <span   class="dashicons dashicons-arrow-up toggle-div"
                                                    data-show="false"
                                                    data-toggle="blocked_sms_settings"></span>
                                        </span>
                                    </h3><hr>
                                </td>
                            </tr>
                        </table>
                        <div id="blocked_sms_settings">
                            <table style="width:100%">
                                <tr>
                                    <td colspan="2">
                                        <textarea   name="mo_otp_blocked_phone_numbers"
                                                    rows="5"
                                                    placeholder="' . esc_attr(
														mo_(
															' Enter semicolon separated phone numbers
                                                    (with country code) that you want to block. Eg. +1XXXXXXXX '
														)
													) . '">' .
										esc_attr( $otp_blocked_phones ) .
										'</textarea>
                                    </td>
                                </tr>
                            </table>


                        </div>

                    </div>
                </div>';
										echo '<div style="display:flow-root">
	        <div id="chosenOtpType" class="mo_registration_table_layout mo-otp-half">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <h3>
                                    ' . esc_html( mo_( 'CUSTOMIZE THE OTP FORMAT:' ) ) . '
										<span style="float:right;margin-top:-10px;">
                                        <input  type="submit" ' . esc_attr( $alphanumeric_disabled ) . '
                                                name="save"
                                                class="button button-primary button-large"
                                                value="' . esc_attr( mo_( 'Save Settings' ) ) . '"/>
                                    </span>
                                </h3><hr>
                            </td>

                             <tr>
                             <td> 
                                 <div>
                                        <i><b>Note</b>: This feature enables admins to customize the OTP Format, including lowercase, uppercase, and numeric characters.<b> For eg: aB23Fm</b></i>
                                    </div>
                         </td>
                    </tr>



                        </tr>';

										$html = '<tr>
						 <td class="generated-otp-type-card mo-plan-ui">
										 <div class="mo_premium_option_text">
											<span style="color:red;">*</span>
												This is a Enterprise Plan feature. Check <a href="' . esc_url( $license_url ) . '">Licensing Tab</a> to learn more.
												 </a>
										 </div>
                    </td>
                          </tr>';

										$html = apply_filters( 'mo_alphanumeric_card_ui', $html );

										echo wp_kses(
											$html,
											array(
												'tr'    => array(),
												'td'    => array( 'class' => array() ),
												'div'   => array( 'class' => array() ),
												'span'  => array( 'style' => array() ),
												'input' => array(
													'type' => array(),
													'name' => array(),
													'class' => array(),
													'checked' => array(),
													'value' => array(),
												),
												'a'     => array( 'href' => array() ),
											)
										);

										echo '       </table>
            </div>';


										echo '
            <div id="globallyBannedPhone" class="mo_registration_table_layout mo-otp-half">
                    <table style="width:100%">
                        <tr>
                            <td>
                                <h3>
                                    ' . esc_html( mo_( 'GLOBALLY BANNED PHONE NUMBERS:' ) ) . '
                                        <span style="float:right;margin-top:-10px;">
                                        <input  type="submit" ' . esc_attr( $globallybanned_disabled ) . '
                                                name="save"
                                                class="button button-primary button-large"
                                                value="' . esc_attr( mo_( 'Save Settings' ) ) . '"/>
                                    </span>
                                </h3><hr>
                            </td>


                        <tr>
                             <td>
                                 <div >
                                        <i><b>Note</b>: This feature enables admins to block the use of globally banned phone number formats, hence increases security.<b> For eg: +1111111111 will get blocked.</b></i>
                                    </div>
                             </td>
                        </tr>


                        </tr>';

										$html1 = '<tr>
                             <td class="globally-banned-phone-card mo-plan-ui">
                                 <div class="mo_premium_option_text">
                                    <span style="color:red;">*</span>
                                        This is a Enterprise Plan feature. Check <a href="' . esc_url( $license_url ) . '">Licensing Tab</a> to learn more.
                                         </a>
                                 </div>
                                  </td>
                          </tr>';

										$html1 = apply_filters( 'mo_globally_banned_phone_view', $html1 );

										echo wp_kses(
											$html1,
											array(
												'tr'    => array(),
												'td'    => array( 'class' => array() ),
												'div'   => array( 'class' => array() ),
												'input' => array(
													'type' => array(),
													'name' => array(),
													'class' => array(),
													'checked' => array(),
													'value' => array(),
												),
												'span'  => array( 'style' => array() ),
												'a'     => array( 'href' => array() ),
											)
										);
										echo '       </table>
            </div>
            </div>';

										$master_otp_view_for_non_enterprise_plan = '<tr>
                                 <td  colspan="2" class="globally-banned-phone-card mo-plan-ui">
                                                 <div class="mo_premium_option_text">
                                                    <span style="color:red;">*</span>
                                                        This is a Enterprise Plan feature. Check <a href="' . esc_url( $license_url ) . '">Licensing Tab</a> to learn more.
                                                         </a>
                                                 </div>
                                 </td>
                         </tr>';

										$master_otp_ui_filter = apply_filters( 'mo_masterotp_card_ui', $master_otp_view_for_non_enterprise_plan, $disabled );

										echo '
            <div id="masterotp" class="mo_registration_table_layout mo-otp-half">
                    <table style="width:100%">
                        <tr>
                            <td colspan="2">
                                <h3>
                                    ' . esc_html( mo_( 'MASTER OTP' ) ) . '
                                        <span style="float:right;margin-top:-10px;">
                                        <input  type="submit" ' . esc_attr( $master_otp_disabled ) . '
                                                name="save"
                                                class="button button-primary button-large"
                                                value="' . esc_attr( mo_( 'Save Settings' ) ) . '"/>
                                    </span>
                                </h3><hr>
                            </td>
                            <tr>
                                <td> 
                                    <div>
                                       <i><b>Note</b>: Allows users to login with Master OTP in case of any gateway/OTP delivery failure.</i>
                                    </div>
                                </td>
                            </tr>
                        </tr>
                    ' . wp_kses(
													$master_otp_ui_filter,
													array(
														'tr'   => array(),
														'i'   => array(),
														'button'      => array(),
														'b'   => array(),
														'strong'     => array(),
														'td'   => array( 'class' => array() ),
														'input' => array(
															'type' => array(),
															'name' => array(),
															'class' => array(),
															'checked' => array(),
															'value' => array(),
														),
														'div'  => array( 'class' => array() ),
														'span' => array( 'style' => array() ),
														'table' => array( 'style' => array() ),
														'a'    => array( 'href' => array() ),
													)
												) . '
            </table>
            </div>
            </form>
        </div>';
