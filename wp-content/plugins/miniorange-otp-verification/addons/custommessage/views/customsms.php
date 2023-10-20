<?php
/**
 * SMS form.
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
echo '    <div class="mo_registration_table_layout mo-otp-half">
			    <form name="f" method="post" action="' . esc_url( $post_url ) . '">
					<table class="mo_registration_settings_table" style="width: 100%;">
						<input type="hidden" name="action" value="mo_customer_validation_admin_custom_phone_notif" />
						';
						wp_nonce_field( $nonce, 'security' );
echo '					<tr>
							<td>
								<h2>' . esc_html( mo_( 'SEND CUSTOM SMS MESSAGE' ) ) . '
									<span style="float:right;margin-top:-10px;">
                                        <a  href="' . esc_url( $addon ) . '"
                                            id="goBack"
                                            class="button button-primary button-large">
                                            ' . esc_html( mo_( 'Go Back' ) ) . '
                                        </a>
										<input  name="save"
										        id="save" 
										        ' . esc_attr( $disabled ) . '
										        class="button button-primary button-large"
											    value="' . esc_attr( mo_( 'Send Message' ) ) . '"
											    type="submit">
										<span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div"
										        data-show="false"
										        data-toggle="custom_sms"></span>
									</span>
								</h2>
								<hr/>
							</td>
						</tr>
					</table>';
					require 'customSMSBox.php';
echo '</form>
			</div>
			<div class="mo_registration_table_layout mo-otp-half" style="margin-left:1.4em"> 
			    <h2>' . esc_html( mo_( 'SHORTCODES' ) ) . '</h2>
			    <hr/>
                <div class="mo_otp_note">
                    <p >
                        ' . esc_html(
					mo_(
						'You can use the following shortcode to show custom email and sms forms on
                                your frontend. Users can use this form to send custom messages. Only logged in users
                                can send Messages.'
					)
				) . '
                    </p>
                    <ol>
                        <li><b>[mo_custom_sms]</b></li>
                        <li><b>[mo_custom_email]</b></li>
                    </ol>
                </div>
            </div>
		</div>';
