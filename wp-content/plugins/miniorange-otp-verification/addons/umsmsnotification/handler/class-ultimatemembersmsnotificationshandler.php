<?php
/**
 * Load admin view for Ultimate Member SMS Notification addon.
 *
 * @package miniorange-otp-verification/addons/umsmsnotification/handler
 */

namespace OTP\Addons\UmSMSNotification\Handler;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	use OTP\Addons\UmSMSNotification\Helper\UltimateMemberNotificationsList;
	use OTP\Objects\BaseAddOnHandler;
	use OTP\Traits\Instance;
	use OTP\Helper\MoFormDocs;

/**
 * The class is used to handle all Ultimate Member Notifications related functionality.
 * This class hooks into all the available notification hooks and filters of
 * Ultimate Member to provide the possibility of SMS notifications.
 */
if ( ! class_exists( 'UltimateMemberSMSNotificationsHandler' ) ) {
	/**
	 * UltimateMemberSMSNotificationsHandler class
	 */
	class UltimateMemberSMSNotificationsHandler extends BaseAddOnHandler {

		use Instance;

		/**
		 * Instance of the UltimateMemberNotificationList Class.
		 *
		 * @var UltimateMemberNotificationsList instance of the UltimateMemberNotificationsList Class */
		private $notification_settings;

		/**
		 * Constructor checks if add-on has been enabled by the admin and initializes
		 * all the class variables. This function also defines all the hooks to
		 * hook into to make the add-on functionality work.
		 */
		protected function __construct() {
			parent::__construct();
			if ( ! $this->moAddOnV() ) {
				return;
			}
			$this->notification_settings = get_umsn_option( 'notification_settings' )
			? get_umsn_option( 'notification_settings' ) : UltimateMemberNotificationsList::instance();
			add_action( 'um_registration_complete', array( $this, 'mo_send_new_customer_sms_notif' ), 1, 2 );
		}


		/**
		 * This function hooks into the um_send_registration_notification hook
		 * to send an SMS notification to the user when he successfully creates an
		 * account using the checkout or registration page.
		 *
		 * @param mixed $user_id  user id of the user created.
		 * @param array $args     the extra arguments passed by the hook.
		 */
		public function mo_send_new_customer_sms_notif( $user_id, array $args ) {
			$this->notification_settings->get_um_new_customer_notif()->send_sms( array_merge( array( 'customer_id' => $user_id ), $args ) );
			$this->notification_settings->get_um_new_user_admin_notif()->send_sms( array_merge( array( 'customer_id' => $user_id ), $args ) );
		}


		/**
		 * Unhook all the emails that we will be sending sms notifications for.
		 */
		private function unhook() {
			remove_action( 'um_registration_complete', 'um_send_registration_notification' );
		}


		/** Set Addon Key */
		public function set_addon_key() {
			$this->add_on_key = 'um_sms_notification_addon';
		}

		/** Set AddOn Desc */
		public function set_add_on_desc() {
			$this->add_on_desc = mo_(
				'Allows your site to send custom SMS notifications to your customers.'
				. 'Click on the settings button to the right to see the list of notifications that go out.'
			);
		}

		/** Set an AddOnName */
		public function set_add_on_name() {
			$this->addon_name = mo_( 'Ultimate Member SMS Notification' );
		}

		/** Set an Addon Docs link */
		public function set_add_on_docs() {
			$this->add_on_docs = MoFormDocs::ULTIMATEMEMBER_SMS_NOTIFICATION_LINK['guideLink'];
		}

		/** Set an Addon Video link */
		public function set_add_on_video() {
			$this->add_on_video = MoFormDocs::ULTIMATEMEMBER_SMS_NOTIFICATION_LINK['videoLink'];
		}
		/** Set Settings Page URL */
		public function set_settings_url() {
			$this->settings_url = add_query_arg( array( 'addon' => 'um_notif' ), isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : null );
		}
	}
}
