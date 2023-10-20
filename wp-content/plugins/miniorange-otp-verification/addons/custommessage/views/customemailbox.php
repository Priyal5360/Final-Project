<?php
/**
 * Email shortcode view.
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
echo '   <div id="custom_email_box">
            <table style="width:100%">
                <tr>
                    <td>
                        <b>' . esc_html( mo_( 'From ID:' ) ) . '</b>
                        <div >
                            <input  ' . esc_attr( $disabled ) . '
                                    id="custom_email_from_id"
                                    class="mo_registration_table_textbox"
                                    style="border:1px solid #ddd"
                                    name="fromEmail"
                                    placeholder="' . esc_attr( mo_( 'Enter email address' ) ) . '"
                                    value = ""
                                    required/>
                        </div><br>
                        <b>' . esc_html( mo_( 'From Name:' ) ) . '</b>
                        <div >
                            <input  ' . esc_attr( $disabled ) . '
                                    id="custom_email_from_name"
                                    class="mo_registration_table_textbox"
                                    style="border:1px solid #ddd"
                                    name="fromName"
                                    placeholder="' . esc_attr( mo_( 'Enter Name' ) ) . '"
                                    value = ""
                                    required/>
                        </div><br>
                        <b>' . esc_html( mo_( 'Subject:' ) ) . '</b>
                        <div >
                            <input  ' . esc_attr( $disabled ) . '
                                    id="custom_email_subject"
                                    class="mo_registration_table_textbox"
                                    style="border:1px solid #ddd"
                                    name="subject"
                                    placeholder="' . esc_attr( mo_( 'Enter your OTP Email Subject' ) ) . '"
                                    value = ""
                                    required/>
                        </div><br>
                        <b>' . esc_html( mo_( 'To Email Address:' ) ) . '</b>
                        <div >
                            <input  ' . esc_attr( $disabled ) . '
                                    id="custom_email_to"
                                    class="mo_registration_table_textbox"
                                    style="border:1px solid #ddd"
                                    name="toEmail"
                                    placeholder="' . esc_attr( mo_( 'Enter semicolon (;) separated email-addresses to send the email to' ) ) . '"
                                    value = ""
                                    required/>
                        </div><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>' . esc_html( mo_( 'Body:' ) ) . '</b>';
						wp_editor( $content, $editor_id, $template_settings );
	echo '			</td>
                </tr>
            </table>
        </div>';
