<?php
/**
 * AddOn Name: Ultimate Member Password Reset through OTP
 * Plugin URI: http://miniorange.com
 * Description: Allow users to reset their password via OTP
 * Version: 1.0.0
 * Author: miniOrange
 * Author URI: http://miniorange.com
 * Text Domain: miniorange-otp-verification
 * License: GPL2
 *
 * @package     miniorange-otp-verification/addons.
 */

namespace OTP\Addons\PasswordReset;

use OTP\Addons\PasswordReset\Handler\UMPasswordResetAddOnHandler;
use OTP\Addons\PasswordReset\Helper\UMPasswordResetMessages;
use OTP\Helper\AddOnList;
use OTP\Objects\AddOnInterface;
use OTP\Objects\BaseAddOn;
use OTP\Traits\Instance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require 'autoload.php';
/**
 * This is the UM password reset addon class. This class handles all the
 * functionality related to addon. It extends the BaseAddOn
 * and implements the AddOnInterface class to implement some much needed functions.
 */
if ( ! class_exists( 'UltimateMemberPasswordReset' ) ) {
	/**
	 * UltimateMemberPasswordReset class
	 */
	final class UltimateMemberPasswordReset extends BaseAddOn implements AddOnInterface {

		use Instance;
		/**
		 * Initializes values
		 */
		public function __construct() {
			parent::__construct();
			add_action( 'admin_enqueue_scripts', array( $this, 'um_pr_notif_settings_style' ) );
			add_action( 'mo_otp_verification_delete_addon_options', array( $this, 'um_pr_notif_delete_options' ) );
		}

		/**
		 * This function is called to append our CSS file
		 * in the backend and frontend. Uses the admin_enqueue_scripts
		 * and enqueue_scripts WordPress hook.
		 */
		public function um_pr_notif_settings_style() {
			wp_enqueue_style( 'um_pr_notif_admin_settings_style', UMPR_CSS_URL, MOV_VERSION, true );
		}

		/**
		 * Initialize all handlers associated with the addon
		 */
		public function initialize_handlers() {
			$list = AddOnList::instance();

			$handler = UMPasswordResetAddOnHandler::instance();
			$list->add( $handler->getAddOnKey(), $handler );
		}

		/**
		 * Initialize all helper associated with the addon
		 */
		public function initializeHelpers() {
			UMPasswordResetMessages::instance();
		}
		/**
		 * Initialize all helper associated with the addon
		 */
		public function initialize_helpers() {
			UMPasswordResetMessages::instance();
		}


		/**
		 * This function hooks into the mo_otp_verification_add_on_controller
		 * hook to show ultimate notification settings page and forms for
		 * validation.
		 */
		public function show_addon_settings_page() {
			include UMPR_DIR . 'controllers/main-controller.php';
		}

		/**
		 * Function is called during deletion of the plugin to delete any options
		 * related to the add-on. This function hooks into the 'mo_otp_verification_delete_addon_options'
		 * hook of the OTP verification plugin.
		 */
		public function um_pr_notif_delete_options() {
			delete_site_option( 'mo_um_pr_pass_enable' );
			delete_site_option( 'mo_um_pr_pass_button_text' );
			delete_site_option( 'mo_um_pr_enabled_type' );
		}
	}
}
