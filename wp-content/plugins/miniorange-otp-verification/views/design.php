<?php
/**
 * Load admin view for changing the CSS of pop ups.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Helper\MoUtility;

echo '

	 <div class="mo_registration_divided_layout" style="width:97%">
		<div class="mo_registration_table_layout mo-otp-full">
		    <table style="width:100%">
                <tr>
                    <td colspan="2">
                        <h2>' . esc_html( mo_( 'CUSTOMIZE THE OTP POP-UPS' ) ) . '
                        <span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div" 
                                data-show="false" 
                                data-toggle="design_instructions"></span>
                        </h2><hr/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <div class="mo_otp_note" id="design_instructions" style="color:#942828;">
                            ' . wp_kses(
							mo_(
								'<i> Configure your pop-ups below. Add scripts, images, css scripts or 
                                    change the popup entirely to your liking.</i>
                                    <br/><br/><b>NOTE:</b> Click on the Preview button to see how your pop up would look like.'
							),
							array(
								'i'  => array(),
								'br' => array(),
								'b'  => array(),
							)
						) . '
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="mo_registration_table_layout mo-otp-full">
            <table style="width:100%">
                <tr>
                    <td colspan="2">
                        <h3>
                            <i>DEFAULT POPUP</i>
                            <span style="float:right;margin-top:-10px;">
                                <input  type="button" 
                                        id="popupbutton" ' . esc_attr( $disabled ) . ' 
                                        class="button button-primary button-large" 
                                        data-popup="mo_preview_popup" 
                                        data-iframe="defaultPreview" 
                                        value="' . esc_attr( mo_( 'Preview' ) ) . '">
                                <input  type="button" 
                                        id="popupbutton"  ' . esc_attr( $disabled ) . ' 
                                        class="button button-primary button-large"
                                        data-popup="mo_popup_save" 
                                        data-iframe="defaultPreview" 
                                        value="' . esc_attr( mo_( 'Save' ) ) . '">
                                <span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div" 
                                        data-show="false" 
                                        data-toggle="default_popup"></span>
                            </span>
                        </h3> <hr>
                    </td>
                </tr>
            </table>
            <div id="default_popup">
                <table style="width:100%">
                    <tr>
                        <td colspan="2">
                            <div class="mo_otp_note" style="color:#942828;">
                        ' . wp_kses(
											mo_(
												'Make sure to have the following tags in the popup: 
                                                <b>{{JQUERY}}</b>,
                                                <b>{{GO_BACK_ACTION_CALL}}</b>, 
                                                <b>{{FORM_ID}}</b>, 
                                                <b>{{OTP_FIELD_NAME}}</b>, 
                                                <b>{{REQUIRED_FIELDS}}</b>, 
                                                <b>{{REQUIRED_FORMS_SCRIPTS}}</b>'
											),
											array( 'b' => array() )
										) .
							'</div>
                        </td>
                    </tr>
                    <tr>
                        <td width="45%">
                            <form   name="defaultPreview" 
                                    method="post" 
                                    action="' . esc_url( admin_post_url() ) . '" 
                                    target="defaultPreview">
                                <input type="hidden" id="popactionvalue" name="action" value="">
                                <input type="hidden" name="popuptype" value="' . esc_attr( $default_template_type ) . '"> ';

								wp_nonce_field( $nonce );
								wp_editor( $custom_default_popup, $editor_id, $template_settings );

echo '         
                        </td>
                        <td width="46%">
                                <iframe id="defaultPreview" 
                                        name="defaultPreview" 
                                        src="" style="width:100%;margin-top:1%;border-radius: 4px;background-color: #d8d7d7;height:467px">
                                </iframe>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mo_registration_table_layout mo-otp-full">
            <table style="width:100%">
                <tr>
                    <td colspan="2">
                        <h3>
                            <i>USER CHOICE POPUP</i>
                            <span style="float:right;margin-top:-10px;">
                                <input  type="button" 
                                        id="popupbutton" ' . esc_attr( $disabled ) . ' 
                                        class="button button-primary button-large" 
                                        data-popup="mo_preview_popup" 
                                        data-iframe="userchoicePreview" 
                                        value="' . esc_attr( mo_( 'Preview' ) ) . '">
                                <input  type="button" 
                                        id="popupbutton" ' . esc_attr( $disabled ) . '  
                                        class="button button-primary button-large"
                                        data-popup="mo_popup_save" 
                                        data-iframe="userchoicePreview" 
                                        value="' . esc_attr( mo_( 'Save' ) ) . '">
                                <span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div" 
                                        data-show="false" 
                                        data-toggle="userchoice_popup">
                                </span>
                            </span>
                        </h3> <hr>
                    </td>
                </tr>
            </table>
            <div id="userchoice_popup">
                <table style="width:100%">
                    <tr>
                        <td colspan="2">
                            <div class="mo_otp_note" style="color:#942828;">
                        ' . wp_kses(
											mo_(
												'Make sure to have the following tags in the popup:
                                                <b>{{JQUERY}}</b>, 
                                                <b>{{GO_BACK_ACTION_CALL}}</b>, 
                                                <b>{{FORM_ID}}</b>, 
                                                <b>{{REQUIRED_FIELDS}}</b>, 
                                                <b>{{REQUIRED_FORMS_SCRIPTS}}</b>'
											),
											array( 'b' => array() )
										) .
							'</div>
                        </td>
                    </tr>
                    <tr>
                        <td width="45%">
                            <form   name="userchoicePreview" 
                                    method="post" 
                                    action="' . esc_url( admin_post_url() ) . '" 
                                    target="userchoicePreview">
                                <input type="hidden" id="popactionvalue" name="action" value="">
                                <input type="hidden" name="popuptype" value="' . esc_attr( $userchoice_template_type ) . '"> ';

								wp_nonce_field( $nonce );

								wp_editor( $custom_userchoice_popup, $editor_id2, $template_settings2 );
echo '         
                        </td>
                        <td width="46%">
                                <iframe id="userchoicePreview" name="userchoicePreview" src="" 
                                    style="width:100%;margin-top:1%;border-radius: 4px;background-color: #d8d7d7;height:467px"></iframe>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mo_registration_table_layout mo-otp-full">
            <table style="width:100%">
                <tr>
                    <td colspan="2">
                        <h3>
                            <i>EXTERNAL POPUP</i>
                            <span style="float:right;margin-top:-10px;">
                                <input  type="button" 
                                        id="popupbutton" ' . esc_attr( $disabled ) . ' 
                                        class="button button-primary button-large" 
                                        data-popup="mo_preview_popup" 
                                        data-iframe="externalPreview" 
                                        value="' . esc_attr( mo_( 'Preview' ) ) . '">
                                <input  type="button" id="popupbutton" ' . esc_attr( $disabled ) . ' 
                                        class="button button-primary button-large"
                                        data-popup="mo_popup_save" 
                                        data-iframe="externalPreview" 
                                        value="' . esc_attr( mo_( 'Save' ) ) . '">
                                <span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div" 
                                        data-show="false" 
                                        data-toggle="external_popup"></span>
                            </span>
                        </h3> <hr>
                    </td>
                </tr>
            </table>
            <div id="external_popup">
                <table style="width:100%">
                    <tr>
                        <td colspan="2">
                            <div class="mo_otp_note" style="color:#942828;">
                        ' . wp_kses(
											mo_(
												'Make sure to have the following tags in the popup:
                                    <b>{{JQUERY}}</b>, 
                                    <b>{{GO_BACK_ACTION_CALL}}</b>, 
                                    <b>{{FORM_ID}}</b>, 
                                    <b>{{REQUIRED_FIELDS}}</b>, 
                                    <b>{{REQUIRED_FORMS_SCRIPTS}}</b>'
											),
											array( 'b' => array() )
										) .
							'</div>
                        </td>
                    </tr>
                    <tr>
                        <td width="45%">
                            <form   name="externalPreview" 
                                    method="post" 
                                    action="' . esc_url( admin_post_url() ) . '" 
                                    target="externalPreview">
                                <input type="hidden" id="popactionvalue" name="action" value="">
                                <input type="hidden" name="popuptype" value="' . esc_attr( $external_template_type ) . '"> ';

								wp_nonce_field( $nonce );
								wp_editor( $custom_external_popup, $editor_id3, $template_settings3 );
echo '         
                        </td>
                        <td width="46%">
                                <iframe id="externalPreview" name="externalPreview" src=""
                                    style="width:100%;margin-top:1%;border-radius: 4px;background-color: #d8d7d7;height:467px"></iframe>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mo_registration_table_layout mo-otp-full">
            <table style="width:100%">
                <tr>
                    <td colspan="2">
                        <h3>
                            <i>ERROR POPUP</i>
                            <span style="float:right;margin-top:-10px;">
                                <input  type="button" 
                                        id="popupbutton" ' . esc_attr( $disabled ) . ' 
                                        class="button button-primary button-large" 
                                        data-popup="mo_preview_popup" 
                                        data-iframe="errorPreview" 
                                        value="' . esc_attr( mo_( 'Preview' ) ) . '">
                                <input  type="button" 
                                        id="popupbutton" ' . esc_attr( $disabled ) . ' 
                                        class="button button-primary button-large"
                                        data-popup="mo_popup_save" 
                                        data-iframe="errorPreview" 
                                        value="' . esc_attr( mo_( 'Save' ) ) . '">
                                <span   class="mo-dashicons dashicons dashicons-arrow-up toggle-div" 
                                        data-show="false" 
                                        data-toggle="error_popup"></span>
                            </span>
                        </h3> <hr>
                    </td>
                </tr>
            </table>
            <div id="error_popup">
                <table style="width:100%">
                    <tr>
                        <td colspan="2">
                            <div class="mo_otp_note" style="color:#942828;">
                        ' . wp_kses(
											mo_(
												'Make sure to have the following tags in the popup:
                                    <b>{{JQUERY}}</b>, 
                                    <b>{{GO_BACK_ACTION_CALL}}</b>, 
                                    <b>{{REQUIRED_FORMS_SCRIPTS}}</b>'
											),
											array( 'b' => array() )
										) .
							'</div>
                        </td>
                    </tr>
                    <tr>
                        <td width="45%">
                            <form name="errorPreview" method="post" action="' . esc_url( admin_post_url() ) . '" target="errorPreview">
                                <input type="hidden" id="popactionvalue" name="action" value="">
                                <input type="hidden" name="popuptype" value="' . esc_attr( $error_template_type ) . '"> ';

								wp_nonce_field( $nonce );
								wp_editor( $error_popup, $editor_id4, $template_settings4 );

echo '         
                        </td>
                        <td width="46%">
                                <iframe id="errorPreview" name="errorPreview" 
                                    src=""
                                    style="width:100%;margin-top:1%;border-radius: 4px;background-color: #d8d7d7;height:467px"></iframe>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>';

echo '
		</div>
     </div>
     <script type="text/javascript">
        $mo = jQuery;
        $mo(document).ready(function(){    
            $mo("iframe").contents().find("body").append("' . wp_kses(
	$message,
	array(
		'div'  => array(
			'style' => array(),
		),
		'span' => array( 'style' => array() ),
		'br'   => array(),
	)
) . '");
            $mo("input:button[id=popupbutton]").click(function(){
                var iframe = $mo(this).data("iframe");
                var nonce = $mo("#_wpnonce").val();
                var popupAction = $mo(this).data("popup"); 
                var popupType = $mo("form[name="+iframe+"] input[name=\'popuptype\']").val();      
                var editorName = $mo("form[name="+iframe+"] textarea").attr("name");  
                var templatedata = $mo("form[name="+iframe+"] textarea").val();                           
                $mo("#"+iframe).contents().find("body").empty();
                $mo("#"+iframe).contents().find("body").append("' . wp_kses(
	$loaderimgdiv,
	array(
		'img' => array( 'src' => array() ),
		'div' => array( 'style' => array() ),
	)
) . '");
                var data = {form_name:iframe,popactionvalue:popupAction,popuptype: popupType,_wpnonce:nonce,action:popupAction};
                data[editorName] = templatedata;
                $mo.ajax({
                    url: "admin-post.php",
                    type:"POST",
                    data:data,
                    crossDomain:!0,
                    dataType:"json",
                    success:function(o){ 
                        $mo("#"+iframe).contents().find("body").empty();
                        $mo("#"+iframe).contents().find("body").append(o.message);
                    },
                    error:function(o,e,n){}
                });
            });
        });
    </script>';
