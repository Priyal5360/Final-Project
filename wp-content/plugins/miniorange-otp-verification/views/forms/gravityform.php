<?php
/**
 * Load admin view for Gravity form.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Helper\MoUtility;

echo '			<div class="mo_otp_form" id="' . esc_attr( get_mo_class( $handler ) ) . '">
			                    <input  type="checkbox" ' . esc_attr( $disabled ) . '
			                            id="gf_contact" class="app_enable"
			                            data-toggle="gf_contact_options"
			                            name="mo_customer_validation_gf_contact_enable"
			                            value="1" ' . esc_attr( $gf_enabled ) . ' /><strong>' . esc_html( $form_name ) . '</strong>';

echo '							<div class="mo_registration_help_desc" ' . esc_attr( $gf_hidden ) . ' id="gf_contact_options">
									<p><input 	type="radio" ' . esc_attr( $disabled ) . ' id="gf_contact_email" class="app_enable"
												data-toggle="gf_contact_email_instructions"
												name="mo_customer_validation_gf_contact_type"
												value="' . esc_attr( $gf_type_email ) . '"
												' . ( esc_attr( $gf_enabled_type ) === esc_attr( $gf_type_email ) ? 'checked' : '' ) . ' />
										<strong>' . esc_html( mo_( 'Enable Email Verification' ) ) . '</strong>
									</p>

										<div ' . ( esc_attr( $gf_enabled_type ) !== esc_attr( $gf_type_email ) ? 'style=display:none' : '' ) . '
										     class="mo_registration_help_desc" id="gf_contact_email_instructions" >
											' . esc_html( mo_( 'Follow the following steps to enable Email Verification for' ) ) . ' Gravity form:
											<ol>
												<li><a href="' . esc_url( $gf_field_list ) . '" target="_blank">
												    ' . esc_html( mo_( 'Click Here' ) ) . '</a> ' . esc_html( mo_( ' to see your list of the Gravity Forms.' ) ) . '
												</li>
												<li>' . esc_html( mo_( 'Click on the Edit option of your form' ) ) . '</li>
												<li>' . esc_html( mo_( 'Add an email field to your existing form' ) ) . '</li>
												<li>' . esc_html( mo_( 'Add a text field with label "Enter Validation Code" in your existing form.' ) ) . '</li>
												<li>' . esc_html( mo_( 'Click on the Edit option of your form' ) ) . '
												<li>' . esc_html( mo_( 'Add the form id of your form below for which you want to enable Email verification:' ) ) . '<br>
												<br/>' . esc_html( mo_( 'Add Form' ) ) . ' : <input  type="button"  value="+" ' . esc_attr( $disabled ) . '
                                                                                            onclick="add_gravity(\'email\',1);"
                                                                                            class="button button-primary" />&nbsp;
													    <input  type="button" value="-" ' . esc_attr( $disabled ) . '
													            onclick="remove_gravity(1);"
													            class="button button-primary" /><br/><br/>';

												$gf_form_results = get_multiple_form_select(
													$gf_otp_enabled,
													true,
													true,
													$disabled,
													1,
													'gravity',
													'Label'
												);
												$gfcounter1      = ! MoUtility::is_blank( $gf_form_results['counter'] ) ? max( $gf_form_results['counter'] - 1, 0 ) : 0;

												echo '
												</li>
												<li>' . esc_html( mo_( 'Click on the Save Button to save your settings and keep a track of your Form Ids.' ) ) . '</li>
											</ol>
									</div>
									<p><input 	type="radio" ' . esc_attr( $disabled ) . ' id="gf_contact_phone" class="app_enable"
												data-toggle="gf_contact_phone_instructions"
												name="mo_customer_validation_gf_contact_type"
												value="' . esc_attr( $gf_type_phone ) . '"
										' . ( esc_attr( $gf_enabled_type ) === esc_attr( $gf_type_phone ) ? 'checked' : '' ) . ' />
										<strong>' . esc_html( mo_( 'Enable Phone Verification' ) ) . '</strong>
									</p>
									<div ' . ( esc_attr( $gf_enabled_type ) !== esc_attr( $gf_type_phone ) ? 'style=display:none' : '' ) . ' class="mo_registration_help_desc" id="gf_contact_phone_instructions" >
											' . esc_html( mo_( 'Follow the following steps to enable phone Verification for Gravity form' ) ) . ':
											<ol>
												<li><a href="' . esc_url( $gf_field_list ) . '" target="_blank">
												    ' . esc_html( mo_( 'Click Here' ) ) . '</a> ' . esc_html( mo_( ' to see your list of the Gravity Forms.' ) ) . '</li>
												<li>' . esc_html( mo_( 'Click on the Edit option of your form' ) ) . '</li>
												<li>' . esc_html( mo_( 'Add an phone field to your existing form' ) ) . '</li>
												<li>' . esc_html( mo_( 'Add a text field with label "Enter Validation Code" in your existing form.' ) ) . '</li>
												<li>' . esc_html( mo_( 'Add the form id of your form below for which you want to enable Phone verification' ) ) . ':<br>
												<br/>' . esc_html( mo_( 'Add Form' ) ) . ' : <input type="button"  value="+" ' . esc_attr( $disabled ) . '
												                                            onclick="add_gravity(\'phone\',2);"
												                                            class="button button-primary"/>&nbsp;
                                                    <input  type="button" value="-" ' . esc_attr( $disabled ) . '
                                                            onclick="remove_gravity(2);"
                                                            class="button button-primary" /><br/><br/>';

												$gf_form_results = get_multiple_form_select(
													$gf_otp_enabled,
													true,
													true,
													$disabled,
													2,
													'gravity',
													'Label'
												);
												$gfcounter2      = ! MoUtility::is_blank( $gf_form_results['counter'] ) ? max( $gf_form_results['counter'] - 1, 0 ) : 0;


												echo '</li>


												<li>' . esc_html( mo_( 'Click on the Save Button to save your settings and keep a track of your Form Ids.' ) ) . '</li>
											</ol>
									</div>
									<p style="margin-left:2%;">
                                        <i><b>' . esc_html( mo_( 'Verification Button text' ) ) . ':</b></i>
                                        <input  class="mo_registration_table_textbox"
                                                name="mo_customer_validation_gf_button_text"
                                                type="text" value="' . esc_attr( $gf_button_text ) . '">
                                    </p>

								</div>
							</div>';


												multiple_from_select_script_generator( true, true, 'gravity', 'Label', array( $gfcounter1, $gfcounter2, 0 ) );
