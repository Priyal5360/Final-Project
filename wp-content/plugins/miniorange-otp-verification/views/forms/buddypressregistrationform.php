<?php
/**
 * Load admin view for Buddy Press Registyration form.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Helper\MoMessages;


echo '		<div class="mo_otp_form" id="' . esc_attr( get_mo_class( $handler ) ) . '">
		        <input  type="checkbox" 
		                ' . esc_attr( $disabled ) . ' 
		                id="bbp_default" 
		                class="app_enable" 
		                data-toggle="bbp_default_options" 
		                name="mo_customer_validation_bbp_default_enable" value="1"
		                ' . esc_attr( $bbp_enabled ) . ' />
                <strong>' . esc_html( $form_name ) . '</strong>
                <div class="mo_registration_help_desc" ' . esc_attr( $bbp_hidden ) . ' id="bbp_default_options">
					<p>
					    <input  type="checkbox" 
					            ' . esc_attr( $disabled ) . ' 
					            class="form_options" 
					            ' . esc_attr( $automatic_activation ) . ' 
					            id="bbp_disable_activation_link" 
						        name="mo_customer_validation_bbp_disable_activation" 
						        value="1"/> 
						&nbsp;<strong>' . esc_html( mo_( 'Automatically activate users after verification' ) ) . '</strong><br/>
						
						<i>' . esc_html( mo_( '( No activation email would be sent after verification )' ) ) . '</i>
                    </p>
					<b>' . esc_html( mo_( 'Choose between Phone or Email Verification' ) ) . '</b>
					<p>
					    <input  type="radio" 
					            ' . esc_attr( $disabled ) . ' 
					            data-toggle="bbp_phone_instructions" 
					            id="bbp_phone" 
					            class="form_options app_enable" 
						        name="mo_customer_validation_bbp_enable_type" 
						        value="' . esc_attr( $bbp_type_phone ) . '"
							    ' . ( esc_attr( $bbp_enable_type ) === esc_attr( $bbp_type_phone ) ? 'checked' : '' ) . ' />
                        <strong>' . esc_html( mo_( 'Enable Phone verification' ) ) . '</strong>
						
						<div    ' . ( esc_attr( $bbp_enable_type ) !== esc_attr( $bbp_type_phone ) ? 'hidden' : '' ) . ' 
						        id="bbp_phone_instructions" 
						        class="mo_registration_help_desc">' .
							esc_html( mo_( 'Follow the following steps to enable Phone Verification' ) ) . ':
							<ol>
								<li>
								    <a href="' . esc_url( $bbp_fields ) . '" target="_blank">' . esc_html( mo_( 'Click here' ) ) . '</a> ' .
									esc_html( mo_( ' to see your list of fields.' ) ) . '
                                </li>
								<li>' . wp_kses( mo_( 'Add a new Phone Field by clicking the <b>Add New Field</b> button.' ), array( 'b' => array() ) ) . '</li>
								<li>' . wp_kses( mo_( 'Give the <b>Field Name</b> and <b>Description</b> for the new field.  Remember the Field Name as you will need it later.' ), array( 'b' => array() ) ) . ' </li>
								<li>' . wp_kses( mo_( 'Select the field <b>type</b> from the select box. Choose <b>Text Field</b>.' ), array( 'b' => array() ) ) . '</li>
								<li>' . wp_kses( mo_( 'Select the field <b>requirement</b> from the select box to the right.' ), array( 'b' => array() ) ) . '</li>
								<li>' . wp_kses( mo_( 'Click on <b>Save</b> button to save your new field.' ), array( 'b' => array() ) ) . '</li>
								<li>' . esc_html( mo_( 'Enter the Name of the phone field' ) ) . ':<input  class="mo_registration_table_textbox" id="mo_customer_validation_bbp_phone_key_1_0" name="mo_customer_validation_bbp_phone_key" type="text" value="' . esc_attr( $bbp_field_key ) . '">
                                </li>
							</ol>
							<input  type="checkbox" 
							        ' . esc_attr( $disabled ) . ' 
							        id="mo_customer_validation_bbp_restrict_duplicates_1_0" 
							        name="mo_customer_validation_bbp_restrict_duplicates" 
							        value="1"
							        ' . esc_attr( $restrict_duplicates ) . '/>
				            <strong>' . esc_html( mo_( 'Do not allow users to use the same phone number for multiple accounts.' ) ) . '</strong>
						</div>
					</p>
					<p>
					    <input  type="radio" 
					            ' . esc_attr( $disabled ) . ' 
					            id="bbp_email" 
					            class="form_options app_enable" 
						        name="mo_customer_validation_bbp_enable_type" 
						        value="' . esc_attr( $bbp_type_email ) . '"
						        ' . ( esc_attr( $bbp_enable_type ) === esc_attr( $bbp_type_email ) ? 'checked' : '' ) . ' />
						<strong>' . esc_html( mo_( 'Enable Email verification' ) ) . '</strong>
					</p>
					<p>
					    <input  type="radio" 
					            ' . esc_attr( $disabled ) . ' 
					            data-toggle="bbp_both_instructions" 
					            id="bbp_both" 
					            class="form_options app_enable" 
						        name="mo_customer_validation_bbp_enable_type" 
						        value="' . esc_attr( $bbp_type_both ) . '"
							    ' . ( esc_attr( $bbp_enable_type ) === esc_attr( $bbp_type_both ) ? 'checked' : '' ) . ' />
                        <strong>' . esc_html( mo_( 'Let the user choose' ) ) . '</strong>';

						mo_draw_tooltip(
							MoMessages::showMessage( MoMessages::INFO_HEADER ),
							MoMessages::showMessage( MoMessages::ENABLE_BOTH_BODY )
						);

						echo '				<div ' . ( esc_attr( $bbp_enable_type ) !== esc_attr( $bbp_type_both ) ? 'hidden' : '' ) . ' id="bbp_both_instructions" class="mo_registration_help_desc">
						' . esc_html( mo_( 'Follow the following steps to enable Email and Phone Verification' ) ) . ':
						<ol>
							<li>
							    <a href="' . esc_url( $bbp_fields ) . '" target="_blank">' . esc_html( mo_( 'Click here' ) ) . '</a> ' .
								esc_html( mo_( ' to see your list of fields.' ) ) . '
                            </li>
							<li>' . wp_kses( mo_( 'Add a new Phone Field by clicking the <b>Add New Field</b> button.' ), array( 'b' => array() ) ) . '</li>
							<li>' .
									wp_kses( mo_( 'Give the <b>Field Name</b> and <b>Description</b> for the new field. Remember the Field Name as you will need it later.' ), array( 'b' => array() ) ) .
							'</li>
							<li>' . wp_kses( mo_( 'Select the field <b>type</b> from the select box. Choose <b>Text Field</b>.' ), array( 'b' => array() ) ) . '</li>
							<li>' . wp_kses( mo_( 'Select the field <b>requirement</b> from the select box to the right.' ), array( 'b' => array() ) ) . '</li>
							<li>' . wp_kses( mo_( 'Click on <b>Save</b> button to save your new field.' ), array( 'b' => array() ) ) . '</li>
							<li>' . esc_html( mo_( 'Enter the Name of the phone field' ) ) . ': <input  class="mo_registration_table_textbox" id="mo_customer_validation_bbp_phone_key_2_0" name="mo_customer_validation_bbp_phone_key" type="text" value="' . esc_attr( $bbp_field_key ) . '">
                            </li>
						</ol>
						<input  type="checkbox" 
                                ' . esc_attr( $disabled ) . ' 
                                id="mo_customer_validation_bbp_restrict_duplicates_2_0" 
                                name="mo_customer_validation_bbp_restrict_duplicates"
                                value="1"
                                ' . esc_attr( $restrict_duplicates ) . '/>
                        <strong>' . esc_html( mo_( 'Do not allow users to use the same phone number for multiple accounts.' ) ) . '</strong>
					</div>
					</p>
				</div>
			</div>';


