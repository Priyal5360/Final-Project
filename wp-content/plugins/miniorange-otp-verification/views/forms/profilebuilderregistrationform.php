<?php
/**
 * Load admin view for Profile builder Registration form.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use OTP\Helper\MoMessages;

echo ' 	<div class="mo_otp_form" id="' . esc_attr( get_mo_class( $handler ) ) . '"><input type="checkbox" ' . esc_attr( $disabled ) . ' id="pb_default" class="app_enable" name="mo_customer_validation_pb_default_enable" value="1" data-toggle="pb_default_options"
			' . esc_attr( $pb_enabled ) . ' /><strong>' . esc_html( $form_name ) . '</strong>';

	echo '	<div class="mo_registration_help_desc" ' . esc_attr( $pb_hidden ) . ' id="pb_default_options">
				<b>' . esc_html( mo_( 'Choose between Phone or Email Verification' ) ) . '</b>
				<p>
					<input type="radio" ' . esc_attr( $disabled ) . ' id="pb_phone" class="app_enable" data-toggle="pb_phone_options" name="mo_customer_validation_pb_enable_type" value="' . esc_attr( $pb_reg_type_phone ) . '"
						' . ( esc_attr( $pb_enable_type ) === esc_attr( $pb_reg_type_phone ) ? 'checked' : '' ) . '/>
						<strong>' . esc_html( mo_( 'Enable Phone Verification' ) ) . ' <i>' . esc_html( mo_( '( Requires Hobbyist Version )' ) ) . '</i></strong>
				</p>
				<div ' . ( esc_attr( $pb_enable_type, ) !== esc_attr( $pb_reg_type_phone, ) ? 'hidden' : '' ) . ' id="pb_phone_options" class="pb_form mo_registration_help_desc" >
					<ol>
						<li><a href="' . esc_url( $pb_fields ) . '"  target="_blank">' . esc_html( mo_( 'Click Here' ) ) . '</a> ' . esc_html( mo_( ' to see your list of fields' ) ) . '</li>
						<li>' . esc_html( mo_( 'Choose a phone field from the Field Dropdown' ) ) . '</li>
						<li>' . esc_html( mo_( 'Keep track of the Meta Name of the phone field as you will need it later on.' ) ) . '</li>
						<li>' . esc_html( mo_( 'Make sure to mark the phone field as required.' ) ) . '</li>
						<li>' . esc_html( mo_( 'Enter the meta name of your phone field' ) ) . ': <input class="mo_registration_table_textbox" id="mo_customer_validation_pb_phone_field_key" name="mo_customer_validation_pb_phone_field_key" type="text" value="' . esc_attr( $pb_phone_key, ) . '"></li>
					</ol>
				</div>
				<p>
					<input type="radio" ' . esc_attr( $disabled ) . ' id="pb_email" class="app_enable" name="mo_customer_validation_pb_enable_type" value="' . esc_attr( $pb_reg_type_email ) . '"
						' . ( esc_attr( $pb_enable_type ) === esc_attr( $pb_reg_type_email ) ? 'checked' : '' ) . '/>
						<strong>' . esc_html( mo_( 'Enable Email Verification' ) ) . '</strong>
				</p>
				<p>
					<input type="radio" ' . esc_attr( $disabled ) . ' id="pb_both" class="app_enable" name="mo_customer_validation_pb_enable_type" data-toggle="pb_both_options"
						value="' . esc_attr( $pb_reg_type_both ) . '" ' . ( esc_attr( $pb_enable_type ) === esc_attr( $pb_reg_type_both ) ? 'checked' : '' ) . '/>
						<strong>' . esc_html( mo_( 'Let the user choose' ) ) . '</strong>';
							mo_draw_tooltip(
								MoMessages::showMessage( MoMessages::INFO_HEADER ),
								MoMessages::showMessage( MoMessages::ENABLE_BOTH_BODY )
							);
							echo '			</p>
				<div ' . ( esc_attr( $pb_enable_type ) !== esc_attr( $pb_reg_type_both ) ? 'hidden' : '' ) . ' id="pb_both_options" class="pb_form mo_registration_help_desc" >
					<ol>
						<li><a href="' . esc_url( $pb_fields ) . '"  target="_blank">' . esc_html( mo_( 'Click Here' ) ) . '</a> ' . esc_html( mo_( ' to see your list of fields' ) ) . '</li>
						<li>' . esc_html( mo_( 'Choose a phone field from the Field Dropdown' ) ) . '</li>
						<li>' . esc_html( mo_( 'Keep track of the Meta Name of the phone field as you will need it later on.' ) ) . '</li>
						<li>' . esc_html( mo_( 'Make sure to mark the phone field as required.' ) ) . '</li>
						<li>' . esc_html( mo_( 'Enter the meta name of your phone field' ) ) . ': <input class="mo_registration_table_textbox" id="mo_customer_validation_pb_phone_field_key1" name="mo_customer_validation_pb_phone_field_key" type="text" value="' . esc_attr( $pb_phone_key ) . '"></li>
					</ol>
				</div>
			</div>';

							echo ' 	</div>';
