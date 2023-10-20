<?php
/**
 * Email form view.
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
echo '	<div class="mo_registration_divided_layout mo-otp-full">
	        <div class="mo_registration_table_layout mo-otp-half">
				<form name="f" method="post" action="' . esc_url( $post_url ) . '">
					<table class="mo_registration_settings_table" style="width: 100%;">
						<input type="hidden" name="action" value="mo_customer_validation_admin_custom_email_notif" />';
						wp_nonce_field( $nonce );
echo '					<tr>
							<td>
								<h2>' . esc_html( mo_( 'SEND CUSTOM EMAIL MESSAGE' ) ) . '
									<span style="float:right;margin-top:-10px;">
									    <a  href="' . esc_attr( $addon ) . '"
									        id="goBack"
									        class="button button-primary button-large">
									        ' . esc_html( mo_( 'Go Back' ) ) . '
									    </a>
										<input  name="save"
										        id="save" ' . esc_attr( $disabled ) . '
										        class="button button-primary button-large"
											    value="' . esc_attr( mo_( 'Send Message' ) ) . '"
											    type="submit">
										<span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div"
										        data-show="false"
										        data-toggle="custom_email"></span>
									</span>
								</h2>
								<hr/>
							</td>
						</tr>
					</table>';
					require 'customemailbox.php';
echo '</form>
			</div>';
