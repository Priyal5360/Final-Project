<?php
/**Load adminstrator changes for MoOffer
 *
 * @package miniorange-otp-verification/helper
 */

namespace OTP\Helper;

use OTP\Traits\Instance;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This function is used to show offers for plugin in WordPress. You
 * can decide the style show for your offer based on the
 * type of the message you want to show.
 */
if ( ! class_exists( 'MoOffer' ) ) {
	/**
	 * MoOffer class
	 */
	class MoOffer {


		use Instance;


		/**Constructor to declare variables of the class on initialization
		 *
		 * @param string $price_div exception code.
		 * @param string $new_price_array message to show.
		 * @param string $festival_name code of message to show.
		 **/
		public static function show_offer_pricing( $price_div, $new_price_array, $festival_name ) {
			$style  = self::provide_style();
			$script = self::provide_script( $price_div, $new_price_array, $festival_name );

				return $style . $script;
		}

		/** Function for loader content
		 *
		 * @param string $festival_name festival name.
		 * @return mixed */
		public static function provide_loader_content( $festival_name ) {
			$loader_html = '<div id="mo_loader_div"><div class="mo_loading"></div><div class="content"><label id="mo_offer_label" style="min-width:max-content">' . $festival_name . ' </label>&nbsp;<img id="mo_offer_icon" alt="O" src="' . MOV_ICON_GIF . '"><label id="mo_offer_label">ffers</label>&nbsp;<label id="mo_offer_label">Loading&#8230;</label></div></div>';
			return $loader_html;
		}

		/** Function for Script content
		 *
		 * @param string $price_div pricing division.
		 * @param string $new_price_array offer price.
		 * @return mixed */
		public static function provide_script( $price_div, $new_price_array ) {
			$script_start_tag   = '<script>';
			$loader_message     = 'document.onreadystatechange = function() { 
				    		if (document.readyState !== "complete") { 
				        		document.querySelector("#mo_loader_div").style.visibility = "visible"; 
				    		} else { 
				    			setTimeout(function(){
				    				document.querySelector("#mo_loader_div").style.display = "none";
				    				document.getElementById("mo_otp_plans_pricing_table").scrollIntoView()
				    		},2000)
				    		} 
						};';
			$price_slash_script = 'jQuery(document).ready(function () {
								var index = 0;
								var new_price_array = ' . wp_json_encode( $new_price_array ) . ';
								jQuery("' . $price_div . '").each(function(){
								var price = jQuery(this).text();
								// jQuery(this).empty();
								// jQuery("<b>"+price+"&nbsp;</b>").insertAfter(this);
								jQuery(this).append("&nbsp;<a title=\"Upcoming Price\"><b style=\"color:#505050;font-size:35px\" class=\"mo_strikethrough\" id=\"mo_new_price\">"+ new_price_array[index++]+"</b></a>");
								});
						}); ';

			$script_end_tag = '</script>';

				return $script_start_tag . $price_slash_script . $script_end_tag;

		}

		/** Function for loader content
		 *
		 * @return mixed */
		public static function provide_style() {
			$style = '<style>
					.mo_strikethrough{position:relative}.mo_strikethrough:before{position:absolute;content:"";left:0;top:50%;right:0;border-top:5px solid;border-color:inherit;color:#505050;-webkit-transform:rotate(-5deg);-moz-transform:rotate(-5deg);-ms-transform:rotate(-5deg);-o-transform:rotate(-5deg);transform:rotate(-15deg)}.mo-pricing-slashed{text-decoration:line-through;color:#000}#mo_offer_label{font-size:21px}#mo_offer_icon{height:100%;width:100%}.mo_loading{position:fixed;z-index:999;height:2em;width:2em;overflow:show;margin:auto;}.content{display:inline-flex;position:fixed;z-index:999;height:2em;width:2em;overflow:show;margin:auto;top:0;left:0;bottom:0;right:0}.mo_loading:before{content:"";display:block;position:fixed;top:0;left:inherit;width:100%;height:100%;background:radial-gradient(rgba(20,20,20,.8),rgba(0,0,0,.8));background:-webkit-radial-gradient(rgb(255 253 253 / 1000%),rgb(236 236 236 / 100%))}
					</style>';
			return $style;
		}

	}
}
