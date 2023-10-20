<?php
/**
 * AddOn Name: Ultimate Member SMS Notification
 * Plugin URI: http://miniorange.com
 * Description: Send out SMS notifications to admins and users.
 * Version: 1.0.0
 * Author: miniOrange
 * Author URI: http://miniorange.com
 * Text Domain: miniorange-otp-verification
 * License: GPL2
 *
 * @package miniorange-otp-verification/addons/umsmsnotification
 */

namespace OTP\Addons\UmSMSNotification;

use OTP\Addons\UmSMSNotification\Handler\UltimateMemberSMSNotificationsHandler;
use OTP\Addons\UmSMSNotification\Helper\UltimateMemberNotificationsList;
use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationMessages;
use OTP\Helper\AddOnList;
use OTP\Objects\AddOnInterface;
use OTP\Objects\BaseAddOn;
use OTP\Traits\Instance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require 'autoload.php';

/**
 * This is the constant class which consists of the necessary function used in the addon.
 */
if ( ! class_exists( 'UltimateMemberSmsNotification' ) ) {
	/**
	 * UltimateMemberSmsNotification class
	 */
	final class UltimateMemberSmsNotification extends BaseAddon implements AddOnInterface {

		use Instance;
		/**
		 * Initializes values
		 */
		public function __construct() {
			parent::__construct();
			add_action( 'admin_enqueue_scripts', array( $this, 'um_sms_notif_settings_style' ) );
			add_action( 'mo_otp_verification_delete_addon_options', array( $this, 'um_sms_notif_delete_options' ) );
		}

		/**
		 * This function is called to append our CSS file
		 * in the backend and frontend. Uses the admin_enqueue_scripts
		 * and enqueue_scripts WordPress hook.
		 */
		public function um_sms_notif_settings_style() {
			wp_enqueue_style( 'um_sms_notif_admin_settings_style', UMSN_CSS_URL, MOV_VERSION, true );
		}

		/**
		 * Initialize all handlers associated with the addon
		 */
		public function initialize_handlers() {
			$list = AddOnList::instance();

			$handler = UltimateMemberSMSNotificationsHandler::instance();
			$list->add( $handler->getAddOnKey(), $handler );
		}

		/**
		 * Initialize all helper associated with the addon
		 */
		public function initialize_helpers() {
			UltimateMemberSMSNotificationMessages::instance();
			UltimateMemberNotificationsList::instance();
		}


		/**
		 * This function hooks into the mo_otp_verification_add_on_controller
		 * hook to show ultimate notification settings page and forms for
		 * validation.
		 */
		public function show_addon_settings_page() {
			include UMSN_DIR . '/controllers/main-controller.php';
		}

		/**
		 * Function is called during deletion of the plugin to delete any options
		 * related to the add-on. This function hooks into the 'mo_otp_verification_delete_addon_options'
		 * hook of the OTP verification plugin.
		 */
		public function um_sms_notif_delete_options() {
			delete_site_option( 'mo_um_sms_notification_settings' );
		}
	}
}
