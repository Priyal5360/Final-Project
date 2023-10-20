<?php
/**
 * Load admin view for Pie Registration form.
 *
 * @package miniorange-otp-verification/handler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Helper\MoMessages;

echo ' 	<div class="mo_otp_form" id="' . esc_attr( get_mo_class( $handler ) ) . '">
 	        <input  type="checkbox" ' . esc_attr( $disabled ) . ' 
 	                id="pie_default" 
 	                class="app_enable" 
 	                data-toggle="pie_default_options" 
 	                name="mo_customer_validation_pie_default_enable" 
 	                value="1"
 	                ' . esc_attr( $pie_enabled ) . ' />
            <strong>' . esc_html( $form_name ) . '</strong>';

echo '		<div    class="mo_registration_help_desc" ' . esc_attr( $pie_hidden ) . ' 
		            id="pie_default_options">
			    <b>' . esc_html( mo_( 'Choose between Phone or Email Verification' ) ) . '</b>
                <p>
                    <input  type="radio" ' . esc_attr( $disabled ) . ' 
                            id="pie_phone" 
                            data-form="pie_phone" 
                            class="form_options app_enable" 
                            name="mo_customer_validation_pie_enable_type" 
                            value="' . esc_attr( $pie_type_phone ) . '" 
                            data-toggle="pie_phone_field"
                            ' . ( esc_attr( $pie_enable_type ) !== esc_attr( $pie_type_phone ) ? 'checked' : '' ) . ' />
                    <strong>' . esc_html( mo_( 'Enable Phone Verification' ) ) . '</strong>
                </p>
                <div ' . ( esc_attr( $pie_enable_type ) !== esc_attr( $pie_type_phone ) ? 'hidden' : '' ) . ' 
                        id="pie_phone_field" class="pie_form mo_registration_help_desc" >
                        ' . esc_html( mo_( 'Enter the label of the phone field' ) ) . ': 
                        <input  class="mo_registration_table_textbox" 
                                id="mo_customer_validation_pie_phone_field_key" 
                                name="mo_customer_validation_pie_phone_field_key" 
                                type="text" 
                                value="' . esc_attr( $pie_field_key ) . '">
                        <div class="mo_otp_note">'
							. wp_kses(
								mo_( '<b>Note :</b> Keep Phone field <i>required</i> and format set to <i>international</i>.' ),
								array(
									'b' => array(),
									'i' => array(),
								)
							) . '
                        </div>
                </div>
                <p>
                    <input  type="radio" ' . esc_attr( $disabled ) . ' 
                            id="pie_email" 
                            class="app_enable" 
                            name="mo_customer_validation_pie_enable_type" 
                            value="' . esc_attr( $pie_type_email ) . '"
                            ' . ( esc_attr( $pie_enable_type ) === esc_attr( $pie_type_email ) ? 'checked' : '' ) . ' />
                    <strong>' . esc_html( mo_( 'Enable Email Verification' ) ) . '</strong>
                </p>
                <p>
                    <input  type="radio" ' . esc_attr( $disabled ) . ' 
                            id="pie_both" 
                            data-form="pie_both" 
                            class="form_options app_enable" 
                            name="mo_customer_validation_pie_enable_type" 
                            value="' . esc_attr( $pie_type_both ) . '" 
                            data-toggle="pie_phone_field"
                            ' . ( esc_attr( $pie_enable_type ) === esc_attr( $pie_type_both ) ? 'checked' : '' ) . ' />
                    <strong>' . esc_html( mo_( 'Let the user choose' ) ) . '</strong>';

					mo_draw_tooltip(
						MoMessages::showMessage( MoMessages::INFO_HEADER ),
						MoMessages::showMessage( MoMessages::ENABLE_BOTH_BODY )
					);

					echo '			<div    ' . ( esc_attr( $pie_enable_type ) !== esc_attr( $pie_type_both ) ? 'hidden' : '' ) . ' 
                            class="pie_form mo_registration_help_desc" id="pie_both_field" >
                            ' . esc_html( mo_( 'Enter the label of the phone field' ) ) . ': 
                            <input  class="mo_registration_table_textbox" 
                                    id="mo_customer_validation_pie_phone_field_key1" 
                                    name="mo_customer_validation_pie_phone_field_key" 
                                    type="text" 
                                    value="' . esc_attr( $pie_field_key ) . '">
                            <div class="mo_otp_note">' .
								wp_kses(
									mo_( '<b>Note :</b> Keep Phone field <i>required</i> and format set to <i>international</i>.' ),
									array(
										'b' => array(),
										'i' => array(),
									)
								) .
							'</div>
                    </div>      						
                </p>
            </div>
        </div>';
