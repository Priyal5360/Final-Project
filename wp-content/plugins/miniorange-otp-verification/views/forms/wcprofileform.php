<?php
/**
 * Load admin view for WcProfileForm.
 *
 * @package miniorange-otp-verification/views/forms
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Helper\MoMessages;

echo '       <div class="mo_otp_form" id="' . esc_attr( get_mo_class( $handler ) ) . '">
                    <input  type="checkbox" ' . esc_attr( $disabled ) . '
                            id="wc_ac_default" 
                            data-toggle="wc_ac_default_options" 
                            class="app_enable" 
                            name="mo_customer_validation_wc_profile_enable" 
                            value="1" ' . esc_attr( $wc_acc_enabled ) . ' />
                    <strong>' . esc_html( $form_name ) . '</strong>';

echo '           <div class="mo_registration_help_desc"
                     ' . esc_attr( $wc_acc_hidden ) . '
                     id="wc_ac_default_options">        
                                <p>
                                <input  type ="radio" ' . esc_attr( $disabled ) . '
                                id ="wc_profile_page" 
                                class="app_enable" 
                                name = "mo_customer_validation_wc_profile_enable_type" 
                                value= "' . esc_attr( $wc_acc_type_email ) . '"
                                data-toggle="wc_profile_email_instructions" 
                                ' . ( esc_attr( $wc_acc_enabled_type ) === esc_attr( $wc_acc_type_email ) ? 'checked' : '' ) . '/>
                            <strong>' . esc_html( mo_( 'Email Verification' ) ) . '</strong>
                            <i>' . esc_html( mo_( '( On change of Email Address )' ) ) . '</i>
                        </p>
                        <p>
                            <input  type ="radio" ' . esc_attr( $disabled ) . '
                                    id ="wc_profile_page" 
                                    class="app_enable" 
                                    name = "mo_customer_validation_wc_profile_enable_type" 
                                    value= "' . esc_attr( $wc_acc_type_phone ) . '"
                                    data-toggle="wc_profile_phone_instructions" 
                                    ' . ( esc_attr( $wc_acc_enabled_type ) === esc_attr( $wc_acc_type_phone ) ? 'checked' : '' ) . '/>
                            <strong>' . esc_html( mo_( 'Phone Verification' ) ) . '</strong>
                            <i>' . esc_html( mo_( '(On change of mobile number)' ) ) . '</i>
                            <div    ' . ( esc_attr( $wc_acc_enabled_type ) !== esc_attr( $wc_acc_type_phone ) ? 'hidden' : '' ) . '
                                    id="wc_profile_phone_instructions" 
                                    class="mo_registration_help_desc">
                                ' . esc_html( mo_( 'Follow the following steps to enable OTP Verification and save the user phone number in the database' ) ) . ':
                                
                                <ol>
                                    <li>' . esc_html( mo_( 'Enter the phone User Meta Key' ) );

									mo_draw_tooltip(
										MoMessages::showMessage( MoMessages::META_KEY_HEADER ),
										MoMessages::showMessage( MoMessages::META_KEY_BODY )
									);

									echo '                           : <input    class="mo_registration_table_textbox"
                                                id="mo_customer_validation_wc_profile_phone_key_1_0"
                                                name="mo_customer_validation_wc_profile_phone_key"
                                                type="text"
                                                value="' . esc_attr( $wc_profile_field_key ) . '">
                                    <div class="mo_otp_note">
                                        ' . esc_attr(
													mo_(
														"If you don't know the metaKey against which the phone " .
														'number is stored for all your users then put the default value as phone.'
													)
												) . '
                                    </div>
                                    <li>' . esc_html( mo_( 'Click on the Save Button to save your settings.' ) ) . '</li>
                                </ol>
                            
                                <input  type="checkbox" ' . esc_attr( $disabled ) . '
                                        id="wc_profile_admin" 
                                        name="mo_customer_validation_wc_profile_restrict_duplicates"    
                                        value="1"
                                        ' . esc_attr( $wc_acc_restrict_duplicates ) . ' />
                                <strong>
                                    ' . esc_html( mo_( 'Do not allow users to use the same phone number for multiple accounts.' ) ) . '
                                </strong>
                            </div>                                
                        </p>
                        <p>
                             <i><b>' . esc_html( mo_( 'Verification Button text' ) ) . ':</b></i>
                             <input class="mo_registration_table_textbox" 
                                    name="mo_customer_validation_wc_profile_button_text" 
                                    data-toggle="wc_both_instructions"
                                    type="text" 
                                    value="' . esc_attr( $wc_acc_button_text ) . '">
                        </p>
                            
                </div>
            </div>';
