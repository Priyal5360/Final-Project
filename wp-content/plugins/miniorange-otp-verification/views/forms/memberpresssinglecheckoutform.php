<?php
/**
 * Load admin view for MemberPress Single Checkout form.
 *
 * @package miniorange-otp-verification/views
 */

use OTP\Helper\MoUtility;


echo '	<div class="mo_otp_form" id="' . esc_attr( get_mo_class( $handler ) ) . '">
	        <input  type="checkbox" ' . esc_attr( $disabled ) . ' 
	                id="mrp_single" 
	                class="app_enable"  
	                data-toggle="mrp_single_options" 
	                name="mo_customer_validation_mrp_single_default_enable" 
	                value="1" ' . esc_attr( $mrp_single_registration ) . ' />
			<strong>' . esc_html( $form_name ) . '</strong>';

echo '		<div class="mo_registration_help_desc" ' . esc_attr( $mrp_single_default_hidden ) . ' id="mrp_single_options">
				<p>
					<b>' . esc_html( mo_( 'Choose between Phone or Email Verification' ) ) . '</b></p>
				<p>
					<input  type="radio" ' . esc_attr( $disabled ) . ' 
					        id="mrp_single_phone" 
					        class="app_enable" 
					        data-toggle="mrp_single_phone_options" 
					        name="mo_customer_validation_mrp_single_enable_type" 
					        value="' . esc_attr( $mrp_singlereg_phone_type ) . '"
						    ' . ( esc_attr( $mrp_single_default_type ) === esc_attr( $mrp_singlereg_phone_type ) ? 'checked' : '' ) . '/>
				    <strong>' . esc_html( mo_( 'Enable Phone Verification' ) ) . '</strong>
				</p>
				
				<div ' . ( esc_attr( $mrp_single_default_type ) !== esc_attr( $mrp_singlereg_phone_type ) ? 'style=display:none' : '' ) . ' 
				     class="mo_registration_help_desc" 
					 id="mrp_single_phone_options" >' . esc_html( mo_( 'Follow the following steps to enable Phone Verification' ) ) . ':
					<ol>
						<li><a href="' . esc_url( $mrp_single_fields ) . '" target="_blank">' . esc_html( mo_( 'Click here' ) ) . '</a> ' . esc_html( mo_( ' to add your list of fields.' ) ) . '</li>
						<li>' . wp_kses( mo_( 'Add a new Phone Field by clicking the <b>Add New Field</b> button.' ), array( 'b' => array() ) ) . '</li>
						<li>' . wp_kses( mo_( 'Give the <b>Field Name</b> for the new field.' ), array( 'b' => array() ) ) . '</li>		
						<li>' . wp_kses( mo_( 'Select the field <b>type</b> from the select box. Choose <b>Text Field</b>.' ), array( 'b' => array() ) ) . '</li>
						<li>' . wp_kses( mo_( 'Select <b>Show at Signup</b> and <b>Required</b> from the select box to the right.' ), array( 'b' => array() ) ) . '</li>
						<li>' . wp_kses( mo_( 'Remember the <b>Slug Name</b> from the right as you will need it later.' ), array( 'b' => array() ) ) . '</li>
						<li>' . wp_kses( mo_( 'Click on <b>Update Options</b> button to save your new field.' ), array( 'b' => array() ) ) . '</li>
						<li>' . wp_kses( mo_( 'Enter <b>Slug Name</b> of the phone field' ), array( 'b' => array() ) ) . '
						:<input class="mo_registration_table_textbox" 
						        id="mo_customer_validation_mrp_single_phone_field_key_1_1" 
						        name="mo_customer_validation_mrp_single_phone_field_key" 
						        type="text" 
						        value="' . esc_attr( $mrp_single_field_key ) . '">
						</li>
					</ol>
				</div>
				
				<p>
					<input  type="radio" ' . esc_attr( $disabled ) . ' 
					        id="mrp_single_email" 
					        class="app_enable" 
					        name="mo_customer_validation_mrp_single_enable_type" 
					        value="' . esc_attr( $mrp_singlereg_email_type ) . '"
						    ' . ( esc_attr( $mrp_single_default_type ) === esc_attr( $mrp_singlereg_email_type ) ? 'checked' : '' ) . '/>
					<strong>' . esc_html( mo_( 'Enable Email Verification' ) ) . '</strong>
				</p>
			</div>
		</div>';
