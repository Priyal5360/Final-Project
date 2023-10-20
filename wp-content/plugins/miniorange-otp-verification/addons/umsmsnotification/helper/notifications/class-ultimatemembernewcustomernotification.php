<?php
/**
 * Ultimate Member New Customer Notifications helper
 *
 * @package miniorange-otp-verification/addons/umsmsnotification/helper/notifications
 */

namespace OTP\Addons\UmSMSNotification\Helper\Notifications;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;

/**
 * This class is used to handle all the settings and function related
 * to the UltimateMember New Customer SMS Notification. It initializes the
 * notification related settings and implements the functionality for
 * sending the SMS to the user.
 *
 * @param mixed $instance.
 */
if ( ! class_exists( 'UltimateMemberNewCustomerNotification' ) ) {
	/**
	 * UltimateMemberNewCustomerNotification class
	 */
	class UltimateMemberNewCustomerNotification extends SMSNotification {

		/**
		 * Instance.
		 *
		 * @var mixed $insatance Instance.
		 */
		public static $instance;
		/**
		 * Initializes values
		 */
		protected function __construct() {
			parent::__construct();
			$this->title             = 'New Account';
			$this->page              = 'um_new_customer_notif';
			$this->is_enabled        = false;
			$this->tool_tip_header   = 'NEW_UM_CUSTOMER_NOTIF_HEADER';
			$this->tool_tip_body     = 'NEW_UM_CUSTOMER_NOTIF_BODY';
			$this->recipient         = 'mobile_number';
			$this->sms_body          = UltimateMemberSMSNotificationMessages::showMessage(
				UltimateMemberSMSNotificationMessages::NEW_UM_CUSTOMER_SMS
			);
			$this->default_sms_body  = UltimateMemberSMSNotificationMessages::showMessage(
				UltimateMemberSMSNotificationMessages::NEW_UM_CUSTOMER_SMS
			);
			$this->available_tags    = '{site-name},{username},{accountpage-url},{login-url},{email},{firtname},{lastname}';
			$this->page_header       = mo_( 'NEW ACCOUNT NOTIFICATION SETTINGS' );
			$this->page_description  = mo_( 'SMS notifications settings for New Account creation SMS sent to the users' );
			$this->notification_type = mo_( 'Customer' );
			self::$instance          = $this;
		}


		/**
		 * Checks if there exists an existing instance of the class.
		 * If not then creates an instance and returns it.
		 */
		public static function getInstance() {
			return null === self::$instance ? new self() : self::$instance;
		}


		/**
		 * Initialize all the variables required to modify the sms template
		 * and send the SMS to the user. Checks if the SMS notification
		 * has been enabled and send SMS to the user. Do not send SMS
		 * if phone number of the customer doesn't exist.
		 *
		 * @param  array $args all the arguments required to send SMS.
		 */
		public function send_sms( array $args ) {
			if ( ! $this->is_enabled ) {
				return;
			}
			$this->set_notif_in_session( $this->page );
			$username     = um_user( 'user_login' );
			$phone_number = $args[ $this->recipient ];
			$profile_url  = um_user_profile_url();
			$login_url    = um_get_core_page( 'login' );
			$first_name   = um_user( 'first_name' );
			$last_name    = um_user( 'last_name' );
			$email        = um_user( 'user_email' );

			$replaced_string = array(
				'site-name'       => get_bloginfo(),
				'username'        => $username,
				'accountpage-url' => $profile_url,
				'login-url'       => $login_url,
				'firstname'       => $first_name,
				'lastname'        => $last_name,
				'email'           => $email,
			);
			$replaced_string = apply_filters( 'mo_um_new_customer_notif_string_replace', $replaced_string );
			$sms_body        = MoUtility::replace_string( $replaced_string, $this->sms_body );

			if ( MoUtility::is_blank( $phone_number ) ) {
				return;
			}
			MoUtility::send_phone_notif( $phone_number, $sms_body );
		}
	}
}
