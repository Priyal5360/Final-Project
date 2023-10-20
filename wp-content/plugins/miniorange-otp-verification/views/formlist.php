<?php
/**
 * Load admin view for header of forms.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;

$class_name  = 'YourOwnForm';
$class_name  = $class_name . '#' . $class_name;
$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
$url         = add_query_arg(
	array(
		'page' => 'mosettings',
		'form' => $class_name,
	),
	$request_uri
);

echo '			<div class="mo_registration_table_layout"';
echo esc_html( $form_name ) ? 'hidden' : '';
echo '		         id="form_search">
					<table style="width:100%">
						<tr>
							<td colspan="2">
								<h2>
								    ' . esc_html( mo_( 'SELECT YOUR FORM FROM THE LIST BELOW' ) ) . ':';
echo '							    
							        <span style="float:right;margin-top:-10px;">
							            <a  class="show_configured_forms button button-primary button-large" 
                                            href="' . esc_url( $moaction ) . '">
                                            ' . esc_html( mo_( 'Show All Enabled Forms' ) ) . '
                                        </a>
                                        <span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div" 
                                                data-show="false" 
                                                data-toggle="modropdown"></span>
                                    </span>
                                </h2> ';
echo '                          <b><span style=\"color:#0085ba\"><a style = "text-decoration: none;" href="' . esc_url( $url ) . '" data-form="YourOwnForm#YourOwnForm">Not able to find your form.</a></span></b>';
echo '                                      <span class="tooltip">
                                                <span class="dashicons dashicons-editor-help"></span>
                                                <span class="tooltiptext">
                                                    <span class="header"><b><i>' . esc_html( MoMessages::showMessage( MoMessages::FORM_NOT_AVAIL_HEAD ) ) . '</i></b></span><br/><br/>
                                                    <span class="body">We are actively adding support for more forms. Please contact us using the support form on your right or email us at <a onClick="otpSupportOnClick();""><span style="color:white"><u>' . esc_html( MoConstants::FEEDBACK_EMAIL ) . '</u>.</span></a> While contacting us please include enough information about your registration form and how you intend to use this plugin. We will respond promptly.</span>
                                                </span>
                                              </span>';

echo '							</td>
						</tr>
						<tr>
							<td colspan="2">';
								get_otp_verification_form_dropdown();
echo '							
							</td>
						</tr>
					</table>
				</div>';
