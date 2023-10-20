<?php
/**
 * Load admin view for Ultimate Member Registration form.
 *
 * @package miniorange-otp-verification/views
 */

use OTP\Helper\MoMessages;

echo '		<div class="mo_otp_form" id="' . esc_attr( get_mo_class( $handler ) ) . '">
		        <input  type="checkbox" ' . esc_attr( $disabled ) . ' 
		                id="um_default" 
		                data-toggle="um_default_options" 
		                class="app_enable" 
		                name="mo_customer_validation_um_default_enable" 
		                value="1"
					    ' . esc_attr( $um_enabled ) . ' /><strong>' . esc_html( $form_name ) . '</strong>';

echo '		<div class="mo_registration_help_desc" ' . esc_attr( $um_hidden ) . ' id="um_default_options">
				<b>' . esc_html( mo_( 'Choose between Phone or Email Verification' ) ) . '</b>
				
				<p>
                    <input  type ="checkbox" 
                            ' . esc_attr( $disabled ) . ' 
                            id ="um_mo_view" 
                            data-toggle = "um_mo_ajax_view_option" 
                            class="app_enable" 
                            name = "mo_customer_validation_um_is_ajax_form" 
                            value= "1"
                            ' . esc_attr( $is_ajax_mode_enabled ) . '/>
                    <Strong>' . esc_html( mo_( 'Do not show a popup. Validate user on the form itself.' ) ) . '</strong>
                    
                    <!--------------------------------------------------------------------------------------------
                                                           UM AJAX OPTIONS
                    --------------------------------------------------------------------------------------------->
                    <div  ' . ( esc_attr( $is_ajax_form ) ? '' : 'style=display:none' ) . ' 
                           id="um_mo_ajax_view_option" 
                           class="mo_registration_help_desc">
                        <div class="mo_otp_note" style="color:red">
                            ' . esc_html(
						mo_(
							'This mode does not work with Let the user choose option. 
                                    Please use either phone or email only.'
						)
					) . '
                        </div>   
                        ' . esc_html( mo_( 'You will need to add a verification field on your form, for users to enter their OTP.' ) ) . '
                        <ol>
							<li>
							    <a href="' . esc_url( $um_forms ) . '"  target="_blank">' .
								esc_html( mo_( 'Click Here' ) ) .
								'</a> ' . esc_html( mo_( ' to see your list of forms' ) ) . '
							</li>
							<li>' . wp_kses( mo_( 'Click on the <b>Edit link</b> of your form.' ), array( 'b' => array() ) ) . '</li>
							<li>
							    ' . wp_kses( mo_( 'Add a new <b>OTP Verification</b> Field. Note the meta key and enter it below.' ), array( 'b' => array() ) ) . '
                            </li>
							<li>' . wp_kses( mo_( 'Click on <b>update</b> to save your form.' ), array( 'b' => array() ) ) . '</li>
						</ol>
						<p style="margin-left:2%;">
                            <i><b>' . esc_html( mo_( 'Verification Field Meta Key' ) ) . ':</b></i>
                            <input  class="mo_registration_table_textbox" 
                                    name="mo_customer_validation_um_verify_meta_key" 
                                    type="text" 
                                    value="' . esc_attr( $um_otp_meta_key ) . '">					
                        </p>
                        <p style="margin-left:2%;">
                            <i><b>' . esc_html( mo_( 'Verification Button text' ) ) . ':</b></i>
                            <input  class="mo_registration_table_textbox" 
                                    name="mo_customer_validation_um_button_text" 
                                    type="text" 
                                    value="' . esc_attr( $um_button_text ) . '">					
                        </p>
                    </div>
			    </p>
			    
				<p>
					<input  type="radio" ' . esc_attr( $disabled ) . ' 
					        id="um_phone" 
					        data-toggle="um_phone_instructions" 
					        class="app_enable" 
					        name="mo_customer_validation_um_enable_type" 
					        value="' . esc_attr( $um_type_phone ) . '"
					        ' . ( esc_attr( $um_enabled_type ) === esc_attr( $um_type_phone ) ? 'checked' : '' ) . '/>
				    <strong>' . esc_html( mo_( 'Enable Phone Verification' ) ) . '</strong>
					
					<div ' . ( esc_attr( $um_enabled_type ) !== esc_attr( $um_type_phone ) ? 'style=display:none' : '' ) . ' 
					     id="um_phone_instructions" 
					     class="mo_registration_help_desc">
						 ' . esc_html( mo_( 'Follow the following steps to enable Phone Verification' ) ) . ':
						<ol>
							<li>
							    <a href="' . esc_url( $um_forms ) . '" target="_blank">' .
									esc_html( mo_( 'Click Here' ) ) . '
							    </a> ' . esc_html( mo_( ' to see your list of forms' ) ) . '
							</li>
							<li>' . wp_kses( mo_( 'Click on the <b>Edit link</b> of your form.' ), array( 'b' => array() ) ) . '</li>
							<li>' . wp_kses( mo_( 'Add a new <b>Mobile Number</b> Field from the list of predefined fields.' ), array( 'b' => array() ) ) . '</li>
							<li>' . esc_html( mo_( 'Enter the phone User Meta Key' ) );

									mo_draw_tooltip(
										MoMessages::showMessage( MoMessages::META_KEY_HEADER ),
										MoMessages::showMessage( MoMessages::META_KEY_BODY )
									);

									echo ' <input class="mo_registration_table_textbox" id="mo_customer_validation_um_phone_key_1_0" name="mo_customer_validation_um_phone_key" type="text" value="' . esc_attr( $um_register_field_key ) . '"><div class="mo_otp_note">
                                        ' . esc_html(
										mo_(
											"If you don't know the metaKey against which the phone number 
                                                is stored for all your users then put the default value as phone."
										)
									) . '
									</div>
						    </li>
						</ol>
							<input  type="checkbox" ' . esc_attr( $disabled ) . ' 
							        name="mo_customer_validation_um_restrict_duplicates" 
							        value="1"' . esc_attr( $um_restrict_duplicates ) . '/>
							 <strong>' . esc_html( mo_( 'Do not allow users to use the same phone number for multiple accounts.' ) ) . '</strong>
						
				        
					</div>
				</p>
				
				<p>
					<input  type="radio" ' . esc_attr( $disabled ) . ' 
					        id="um_email" 
					        class="app_enable" 
					        name="mo_customer_validation_um_enable_type" 
					        value="' . esc_attr( $um_type_email ) . '"
					        ' . ( esc_attr( $um_enabled_type ) === esc_attr( $um_type_email ) ? 'checked' : '' ) . ' />
				    <strong>' . esc_html( mo_( 'Enable Email Verification' ) ) . '</strong>
				</p>
				
				<p>
					<input  type="radio" ' . esc_attr( $disabled ) . ' 
					        id="um_both" 
					        data-toggle="um_both_instructions" 
					        class="app_enable" 
					        name="mo_customer_validation_um_enable_type" 
					        value="' . esc_attr( $um_type_both ) . '"
						    ' . ( esc_attr( $um_enabled_type ) === esc_attr( $um_type_both ) ? 'checked' : '' ) . ' />
				    <strong>' . esc_html( mo_( 'Let the user choose' ) ) . '</strong>';

									mo_draw_tooltip(
										MoMessages::showMessage( MoMessages::INFO_HEADER ),
										MoMessages::showMessage( MoMessages::ENABLE_BOTH_BODY )
									);

									echo '				
                    <div ' . ( esc_attr( $um_enabled_type ) !== esc_attr( $um_type_both ) ? 'style=display:none' : '' ) . ' 
                        id="um_both_instructions" 
                        class="mo_registration_help_desc">
						' . esc_html( mo_( 'Follow the following steps to enable Email and Phone Verification' ) ) . ':
						<ol>
							<li>
							    <a href="' . esc_url( $um_forms ) . '">' .
									esc_html( mo_( 'Click Here' ) ) . '
							    </a> ' . esc_html( mo_( ' to see your list of forms' ) ) . '
							</li>
							<li>' . wp_kses( mo_( 'Click on the <b>Edit link</b> of your form.' ), array( 'b' => array() ) ) . '</li>
							<li>' . wp_kses( mo_( 'Add a new <b>Mobile Number</b> Field from the list of predefined fields.' ), array( 'b' => array() ) ) . '</li>
							<li>' . esc_html( mo_( 'Enter the phone User Meta Key' ) );

									mo_draw_tooltip(
										MoMessages::showMessage( MoMessages::META_KEY_HEADER ),
										MoMessages::showMessage( MoMessages::META_KEY_BODY )
									);

									echo '					            : <input class="mo_registration_table_textbox" id="mo_customer_validation_um_phone_key_2_0" name="mo_customer_validation_um_phone_key" type="text" value="' . esc_attr( $um_register_field_key ) . '"><div class="mo_otp_note">
                                        ' . esc_attr(
										mo_(
											"If you don't know the metaKey against which the phone number 
                                                is stored for all your users then put the default value as phone."
										)
									) . '
									</div>
							</li>
						</ol>
						<input  type="checkbox" ' . esc_attr( $disabled ) . ' 
						        name="mo_customer_validation_um_restrict_duplicates" 
						        value="1"' . esc_attr( $um_restrict_duplicates ) . '/>
						<strong>' . esc_html( mo_( 'Do not allow users to use the same phone number for multiple accounts.' ) ) . '</strong>
					</div>
				</p>
			</div>
		</div>';
