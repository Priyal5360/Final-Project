<?php
/**
 * Load admin view for Configured Forms.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo '<div class="mo_registration_table_layout"';
				echo ! $show_configured_forms ? 'hidden' : '';
echo '          id="configured_forms">
                <table style="width:100%">
                    <tr>
                        <td>
                            <h2>
                                <i>' . esc_html( mo_( 'CONFIGURED FORMS' ) ) . '</i>
                                <span style="float:right;margin-top:-10px;">
                                    <a class="show_form_list button button-primary button-large"
                                        href="' . esc_url( $forms_list_page ) . '">
                                        ' . esc_html( mo_( 'Show Forms List' ) ) . '
                                    </a>
                                    <input  name="save" id="ov_settings_button_config" 
                                            class="button button-primary button-large" ' . esc_attr( $disabled ) . ' 
                                            value="' . esc_attr( mo_( 'Save Settings' ) ) . '" type="submit">
                                    <span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div" 
                                            data-show="false" 
                                            data-toggle="configured_mo_forms">                                                
                                    </span>
                                </span>	
                            </h2><hr>
                        </td>
                    </tr>
                </table>
                <div id="configured_mo_forms">';
					show_configured_form_details( $controller, $disabled, $page_list );
	echo '				</div>
            </div>';
