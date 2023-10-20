<?php
/**Load administrator changes for PremiumFeatureList
 *
 * @package miniorange-otp-verification/helper
 */

namespace OTP\Helper;

use OTP\Objects\BaseAddOnHandler;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Traits\Instance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This is the constant class which lists all the texts
 * that need to be supported for the Premium addon List.
 */
if ( ! class_exists( 'PremiumFeatureList' ) ) {
	/**
	 * PremiumFeatureList class
	 */
	final class PremiumFeatureList {

		use Instance;
		/** Variable declaration
		 *
		 * @var $premium_addon
		 */
		private $premium_addon;

		/** Variable declaration
		 *
		 * @var $premium_forms
		 */
		private $premium_forms;

		/** Variable declaration
		 *
		 * @var $addon_name
		 */
		private $addon_name;

		/**Constructor
		 **/
		private function __construct() {
			$this->premium_addon = array(
				'otp_control'               => array(
					'name'        => 'Limit OTP Request ',
					'description' => 'Allows you to block OTP from being sent out before the set timer is up. Click on the button below for further details.',
				),
				'wp_sms_notification_addon' => array(
					'name'        => 'WordPress SMS Notification to Admin & User on Registration',
					'description' => 'Allows your site to send out custom SMS notifications to Customers and Administrators when a new user registers on your Wordpress site. Click on the button below for further details.',
				),
				'wc_pass_reset_addon'       => array(
					'name'        => 'WooCommerce Password Reset Over OTP ',
					'description' => 'Allows your users to reset their password using OTP instead of email links. Click on the button below for further details.',
				),
				'wp_pass_reset_addon'       => array(
					'name'        => 'WordPress Password Reset Over OTP',
					'description' => 'Allows your users to reset their password using OTP instead of email links. Click on the button below for further details.',
				),
				'mo_country_code_dropdown'  => array(
					'name'        => 'Country Code Dropdown ',
					'description' => 'Allows you to enable the country code dropdown on any field of your choice.Includes the country code and the country flag for selection.',
				),
			);

			$this->premium_forms = array(
				'ELEMENTOR_PRO'                 => 'Elementor Pro Forms ',
				'USERREG'                       => 'User Registration Forms - WP Everest ',
				'JETENGINEFORM'                 => 'Jet Engine Form ',
				'WCFM'                          => 'WooCommerce Frontend Manager Form (WCFM) ',
				'HOUSEZ_THEME'                  => 'Houzez - Real Estate Theme ',
				'AR_MEMBER_FORM'                => 'ARMember Form ',
				'WP_USER_MANAGER_FORM'          => 'WP User Manager Form ',
				'TUTOR_LMS_LOGIN'               => 'Tutor LMS Login Form',
				'TUTOR_LMS_INSTRUCTOR_REG_FORM' => 'Tutor LMS Instructor Registration Form',
				'TUTOR_LMS_STUDENT_REG_FORM'    => 'Tutor LMS Student Registration Form',
			);

		}


		/**
		 * Function called to get the addon names
		 */
		public function get_add_on_name() {
			return $this->addon_name; }
		/**
		 * Function called to get the premium addon list
		 */
		public function get_premium_add_on_list() {
			return $this->premium_addon; }

		/**
		 * Function called to get the premium form list
		 */
		public function get_premium_forms() {
			return $this->premium_forms; }

	}
}
