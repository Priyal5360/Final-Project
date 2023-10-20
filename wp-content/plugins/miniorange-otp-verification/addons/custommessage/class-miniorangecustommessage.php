<?php
/**
 * Addon initiallizers.
 *
 * @package miniorange-otp-verification/addons
 */

namespace OTP\Addons\CustomMessage;

use OTP\Addons\CustomMessage\Handler\CustomMessages;
use OTP\Addons\CustomMessage\Handler\CustomMessagesShortcode;
use OTP\Helper\AddOnList;
use OTP\Objects\AddOnInterface;
use OTP\Objects\BaseAddOn;
use OTP\Traits\Instance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
require 'autoload.php';

/** Initialize the addon */
if ( ! class_exists( 'MiniOrangeCustomMessage' ) ) {
	/**
	 * MiniOrangeCustomMessage class
	 */
	class MiniOrangeCustomMessage extends BaseAddOn implements AddOnInterface {

		use Instance;

		/** Initialize all handlers associated with the addon */
		public function initialize_handlers() {
			$list = AddOnList::instance();

			$handler = CustomMessages::instance();
			$list->add( $handler->getAddOnKey(), $handler );
		}

		/** Initialize all helper associated with the addon */
		public function initialize_helpers() {
			CustomMessagesShortcode::instance();
		}

		/**
		 * This function hooks into the mo_otp_verification_add_on_controller
		 * hook to show the custom message add-on settings page.
		 */
		public function show_addon_settings_page() {
			include MCM_DIR . 'controllers/main-controller.php';
		}
	}
}
