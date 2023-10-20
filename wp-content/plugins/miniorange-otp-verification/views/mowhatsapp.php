<?php
/**
 * Load admin view for WhatsApp Tab.
 *
 * @package miniorange-otp-verification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Helper\MoUtility;
use OTP\Helper\MoConstants;
use OTP\Helper\MoAddonListContent;
use OTP\Helper\TransactionCost;

$country_list = TransactionCost::get_only_country_list();

	$circle_icon = '
        <svg class="min-w-[8px] min-h-[8px]" width="8" height="8" viewBox="0 0 18 18" fill="none">
            <circle id="a89fc99c6ce659f06983e2283c1865f1" cx="9" cy="9" r="7" stroke="rgb(99 102 241)" stroke-width="4"></circle>
        </svg>
    ';

echo '
<div>
    <div id="mo-new-pricing-page" class="mo-new-pricing-page mt-mo-4 bg-white rounded-md">

        <!--  TABS  -->
        <div class="mo-tab-container" style="padding-top: 0px; padding-bottom: 0px;">
            <img class = "mo_support_form_new_feature mo_otp_new_feature_class" style="height:50px;width:50px;margin-top:10px"src="' . esc_url( MOV_URL ) . 'includes/images/mowhatsapp.png">
            <h2 style="margin-top:30px; font-size:1.300rem;">&nbsp&nbsp' . esc_html( mo_( 'WHATSAPP FOR OTP VERIFICATION AND NOTIFICATIONS' ) ) . '</h2>          
        </div>

        <!--  TABS CONTENT  -->
        <div>
            <!--  PRICING SECTION  -->
            <section id="mo_otp_plans_pricing_table">
                <div class="bg-slate-50">
                    

                    <div class="whatsapp-test-configuration" style="background-color: #f8fafc;padding-left: 4%;">
                      <div style="width:50%;margin-top: -1%;">
                      <p class="mo_wa_note" style="">' . esc_html( mo_( 'This feature allows you to configure WhatsApp for OTP Verification as well as sending notifications and alerts via WhatsApp.' ) ) . '
                      </p>
                      </div>

                      <div style="margin-top: -50px;margin-left: 5%;">
                      <form name="f" method="post" action="" id="mo_whatsapp_settings">
					  <input type="hidden" id="mo_admin_actions" name="mo_admin_actions" value="' . esc_attr( wp_create_nonce( 'mo_admin_actions' ) ) . '"/>';
						echo ' <div style="margin-top: 12%;">
                        <div class="grow test-configuration" id="wa_test_configuration">
                                        <div class="flex" style="align-items: flex-end;margin-top: 15%;">
                                          <div style="margin:auto;">
                                            <b>Phone Number:</b>
                                          </div>
                                          <div>
                                            <input type="text" id="wa_test_configuration_phone" name="wa_test_configuration_phone"  style="margin-left: 25px;"placeholder="+1xxxxxxxxxx">
                                            <span style="float:right;margin-top:-7px;margin-left: 45px;">
                                                <input 	class="w-full mo-button primary"  type="button" 
                                                        name="mo_gateway_submit" ' . esc_attr( $whatsapp_disabled ) . '
                                                        id="whatsapp_gateway_submit"
                                                        value="Test WhatsApp"
                                                        class="button button-primary button-large" style="margin-top: 5px;color: white;height: 35px;width: 120px;"/>
                                            </span>
                                          </div>
                                        </div>
                                                
                                        <div name="mo_test_config_hide_response" class="flex" style="visibility: hidden;padding-top:1%;" id="test_config_hide_response" >
                                          <div>
                                            <b>Gateway Response:</b>
                                          </div>	
                                          <div style="width:78%">
                                                <textarea readonly' . esc_attr( $whatsapp_disabled ) . ' id="test_config_response"
                                                    class="mo_registration_table_textbox" 
                                                    name="mo_test_configuration_response" 
                                                    rows="1" placeholder="Your Gateway Response" required;
                                                ></textarea>
                                          </div>
                                        </div>
                        </div>
                    </div>
                  </form>
                        </div>
                    </div>
                    
                    <div class="mo-section-header bg-slate-100">
                        <h4 id="mo-section-heading" class="grow" style="padding-left: 4%;">WhatsApp Plans:</h4>
                    </div>
                    <div class="mo-whatsapp-snippet-grid">
                        
                        <div class="mo-whatsapp-card">
                        <div class="card">
                        <form name="f" method="post" action="" id="mo_whatsapp_settings">';
						wp_nonce_field( 'whatsappnonce', 'mo_whatsapp_nonce' );
						echo '<div>
                                <h3 style="text-align:center;">miniOrange Business Account</h3>
                                <div class="my-mo-4 flex gap-mo-4">
                                    <div class="flex">
                                        <h4 class="m-mo-0" style="padding-left: 106px;">(Transaction based Pricing)</h4>
                                    </div>
                                </div>
                            </div> 

                            <ul class="mt-mo-6 grow" >
                                <li class="feature-snippet">
                                    <span class="mt-mo-1" style="margin-top: -1.75rem;">' . wp_kses( $circle_icon, MoUtility::mo_allow_svg_array() ) . '</span>
                                    <p class="m-mo-0">You can use the default miniOrange Business account to send OTP/SMS and Notifications over Whatsapp.</p>
                                </li>
                                
                                <li class="feature-snippet">
                                    <span class="mt-mo-1" style="margin-top: -1.75rem;">' . wp_kses( $circle_icon, MoUtility::mo_allow_svg_array() ) . '</span>
                                    <p class="m-mo-0"><b>Transaction based pricing</b> - depends on the number of transcation you will purchase and your target country.</p>
                                </li> 
                                
                                
                                <li class="feature-snippet">
                                    <span class="mt-mo-1" style="margin-top: 0.25rem;">' . wp_kses( $circle_icon, MoUtility::mo_allow_svg_array() ) . '</span>
                                    <p class="m-mo-0">Select your target country to see the WhatsApp pricing.</p>                                 
                                </li> 

                                <li class="feature-snippet" style="display: table;margin: 0 auto;width: 100%;padding-left: 2.5rem;">
                                    <select name="languages" id="country" style="width:100%;">
                                    <option name="choosecountry">Select you country</option>';
$number_of_countries = count( $country_list );
for ( $i = 0; $i < $number_of_countries; $i++ ) {
	echo '<option value="' . esc_attr( $country_list[ $i ] ) . '">' . esc_attr( $country_list[ $i ] ) . '</option>';
}
									echo '
                                    </select>
                                    <select name="transactions" id="wapricing" style="width:100%;">
                                    <option id="loading">Check Transaction Pricing<option>
                                    <option id="loading">Select a country to check pricing</option>
                                    </select>
                                </li>
                            </ul>
                            </form>
                            <button class="w-full mo-button primary" style="margin-left: 18px;" onclick="mo_wahtsapp_pricing();">Contact us if you want to use miniOrange business account</button>
                            </div>
                        </div>

                        <div class="mo-whatsapp-card">
                            <div class="card">
                            <div>
                                <h3 style="text-align:center;">Own Business Account</h3>
                                <div class="my-mo-4 flex gap-mo-4">
                                    <div class="flex">
                                        <h1 class="m-mo-0" style="padding-left: 200px;">$35</h1><span style="font-size:1rem; margin-top:3%;"><i>/Month</i></span>
                                    </div>
                                </div>
                            </div>    
                            
                            <ul class="mt-mo-6 grow" style="padding-bottom: 25%;">
                                <li class="flex gap-mo-4">
                                    <span class="mt-mo-1">
                                        <span class="mt-mo-1">' . wp_kses( $circle_icon, MoUtility::mo_allow_svg_array() ) . '</span>
                                    </span> 
                                    <p class="m-mo-0">You can use your own WhatsApp Business account for sending OTP and Notifications.</p>
                                </li>
                                
                                <li class="feature-snippet">
                                    <span class="mt-mo-1">' . wp_kses( $circle_icon, MoUtility::mo_allow_svg_array() ) . '</span>
                                    <p class="m-mo-0">The registration of your WhatApp Business account to our BSPs.</p>
                                </li> 
                                
                                <li class="feature-snippet">
                                    <span class="mt-mo-1">' . wp_kses( $circle_icon, MoUtility::mo_allow_svg_array() ) . '</span>
                                    <p class="m-mo-0">Integration of WhatsApp business APIs with OTP plugin</b></p>
                                </li>

                                <li class="feature-snippet">
                                    <span class="mt-mo-1">' . wp_kses( $circle_icon, MoUtility::mo_allow_svg_array() ) . '</span>
                                    <p class="m-mo-0">Enable OTP Verification and Notifications over WhatsApp and SMS.</b></p>
                                </li>
                                
                            </ul>
                            
                            <button class="w-full mo-button primary" style="margin:auto;" onclick="otpSupportOnClick(\'Hi! I am interested in using WhatsApp for my website and want to use my own business account, can you please share the payment link?\');">Contact us if you want to use your own business account</button>
                            </div>
                        </div>
                </div>     
            </section> 
        </div>
    </div>
    </div>';


	echo '
    <script>
    $mo = jQuery;
    function mo_wahtsapp_pricing()
    {   
        var country = document.getElementById("country");
        var pricing = document.getElementById("wapricing").value;
        var transactionToPurchase= pricing.replace("-","for");
        if(country.value == "Select you country" || pricing.value == "Check Transaction Pricing")
        {
            var queryReplaced = "Hi! I am interested in using miniOrange business account for sending OTP over WhatsApp, can you please share the payment link? My target country is " + "(Country not Selected)"+ " and want to purchase " + "(Number of transactions not selected)" +" .";
        }
        else{
            var queryReplaced = "Hi! I am interested in using miniOrange business account for sending OTP over WhatsApp, can you please share the payment link? My target country is " + country.value + " and want to purchase " + transactionToPurchase +" .";
        }
        otpSupportOnClick(queryReplaced);
    }
    </script>';



