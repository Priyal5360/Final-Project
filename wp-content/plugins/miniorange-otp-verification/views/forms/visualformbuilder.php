<?php
/**
 * Load admin view for VisualFormBuilderForm.
 *
 * @package miniorange-otp-verification/views/forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Helper\MoUtility;

echo '	<div class="mo_otp_form" id="' . esc_attr( get_mo_class( $handler ) ) . '">
	        <input  type="checkbox" ' . esc_attr( $disabled ) . '
	                id="visual_form" 
	                class="app_enable" 
	                data-toggle="visual_form_options" 
	                name="mo_customer_validation_visual_form_enable" 
	                value="1" ' . esc_attr( $visual_form_enabled ) . ' />
            <strong>' . esc_html( $form_name ) . '</strong>';

echo '		<div    class="mo_registration_help_desc" ' . esc_attr( $visual_form_hidden ) . '
		            id="visual_form_options">
                <p>
                    <input  type="radio" ' . esc_attr( $disabled ) . '
                            id="visual_form_email" 
                            class="app_enable" 
                            data-toggle="vfe_instructions" 
                            name="mo_customer_validation_visual_form_enable_type" 
                            value="' . esc_attr( $visual_form_type_email ) . '"
                            ' . ( esc_attr( $visual_form_enabled_type ) === esc_attr( $visual_form_type_email ) ? 'checked' : '' ) . ' />
                    <strong>' . esc_html( mo_( 'Enable Email Verification' ) ) . '</strong>
                </p>
                <div    ' . ( esc_attr( $visual_form_enabled_type ) !== esc_attr( $visual_form_type_email ) ? 'hidden' : '' ) . '
                        class="mo_registration_help_desc" id="vfe_instructions" >
                        ' . esc_html( mo_( 'Follow the following steps to enable Email Verification for visual Form' ) ) . ':
                        <ol>
                            <li>
                                <a href="' . esc_url( $visual_form_list ) . '" target="_blank">
                                    ' . esc_html( mo_( 'Click Here' ) ) .
								'</a> ' . esc_html( mo_( ' to see your list of forms' ) ) . '
                            </li>
                            <li>' . wp_kses( mo_( "Note your form's Form ID and Click on the <b>Edit</b> option of your visual form." ), array( 'b' => array() ) ) . '</li>
                            <li>' . esc_html( mo_( 'Add an Email Field to your form. Note the Field Name/Label of the email field.' ) ) . '</li>
                            <li>' . esc_html( mo_( 'Make the Email Field Required.' ) ) . '</li>
                            <li>' . esc_html( mo_( 'Enter your Form ID and the Email Field Name/Label below' ) ) . ':<br>
                                <br/>' . esc_html( mo_( 'Add Form ' ) ) .
								': <input   type="button"
                                            value="+" ' . esc_attr( $disabled ) . '
                                            onclick="add_visual(\'email\',1);" 
                                            class="button button-primary" />&nbsp;
                                    <input  type="button" 
                                            value="-" 
                                            ' . esc_attr( $disabled ) . '
                                            onclick="remove_visual(1);" 
                                            class="button button-primary" /><br/><br/>';

								$form_results = get_multiple_form_select(
									$visual_form_otp_enabled,
									false,
									true,
									$disabled,
									1,
									'visual',
									'Label'
								);
								$counter1     = ! MoUtility::is_blank( $form_results['counter'] )
											? max( $form_results['counter'] - 1, 0 ) : 0;

								echo '						</li>
                            <li>' . esc_html( mo_( 'Click on the Save Button to save your settings' ) ) . '</li>
                        </ol>
                </div>
                <p>
                    <input  type="radio" ' . esc_attr( $disabled ) . '
                            id="visual_form_phone" 
                            class="app_enable" 
                            data-toggle="vfp_instructions" 
                            name="mo_customer_validation_visual_form_enable_type" 
                            value="' . esc_attr( $visual_form_type_phone ) . '"
                            ' . ( esc_attr( $visual_form_enabled_type ) === esc_attr( $visual_form_type_phone ) ? 'checked' : '' ) . ' />
                    <strong>' . esc_html( mo_( 'Enable Phone Verification' ) ) . '</strong>
                </p>
                <div    ' . ( esc_attr( $visual_form_enabled_type ) !== esc_attr( $visual_form_type_phone ) ? 'hidden' : '' ) . '
                        class="mo_registration_help_desc" id="vfp_instructions" >
                        ' . esc_html( mo_( 'Follow the following steps to enable Phone Verification for visual Form' ) ) . ':
                        <ol>
                            <li>
                                <a href="' . esc_url( $visual_form_list ) . '" target="_blank">' .
									esc_html( mo_( 'Click Here' ) ) .
								'</a> ' .
								esc_html( mo_( ' to see your list of forms' ) ) . '
                            </li>
                            <li>' . wp_kses( mo_( "Note your form's Form ID and Click on the <b>Edit</b> option of your visual form." ), array( 'b' => array() ) ) . '</li>
                            <li>' . esc_html( mo_( 'Add a Phone Field to your form. Note the Field Name/Label of the phone field.' ) ) . '</li>
                            <li>' . esc_html( mo_( 'Make the Phone Field Required.' ) ) . '</li>
                            <li>' . esc_html( mo_( 'Enter your Form ID and the Phone Field Name/Label below' ) ) . ':<br>
                                <br/>' . esc_html( mo_( 'Add Form ' ) ) .
								':  <input  type="button"
                                            value="+" ' . esc_attr( $disabled ) . '
                                            onclick="add_visual(\'phone\',2);" 
                                            class="button button-primary" />&nbsp;
                                    <input  type="button" 
                                            value="-" 
                                            ' . esc_attr( $disabled ) . '
                                            onclick="remove_visual(2);" 
                                            class="button button-primary" /><br/><br/>';

								$form_results = get_multiple_form_select(
									$visual_form_otp_enabled,
									false,
									true,
									$disabled,
									2,
									'visual',
									'Label'
								);
								$counter2     = ! MoUtility::is_blank( $form_results['counter'] )
											? max( $form_results['counter'] - 1, 0 ) : 0;
								echo '						</li>
                            <li>' . esc_html( mo_( 'Click on the Save Button to save your settings' ) ) . '</li>
                        </ol>
                </div>
                <p style="margin-left:2%;">
					<i><b>' . esc_html( mo_( 'Verification Button text' ) ) . ':</b></i>
					<input  class="mo_registration_table_textbox" 
					        name="mo_customer_validation_visual_form_button_text" 
					        type="text" 
					        value="' . esc_attr( $button_text ) . '"
				</p>
                </div>
                </div>';

								multiple_from_select_script_generator(
									false,
									true,
									'visual',
									'Label',
									array( $counter1, $counter2, 0 )
								);
