<?php
/**
 * Addon main handler.
 *
 * @package miniorange-otp-verification/addons
 */

namespace OTP\Addons\PasswordReset\Handler;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use OTP\Objects\BaseAddOnHandler;
use OTP\Traits\Instance;
use OTP\Helper\MoFormDocs;

/**
 * The class is used to handle all Ultimate Member Password Reset related functionality.
 * <br/><br/>
 * This class hooks into all the available notification hooks and filters of
 * Ultimate Member to provide the possibility of overriding the default password reset
 * behaviour of Ultimate Member and replace it with OTP.
 */
if ( ! class_exists( 'UMPasswordResetAddOnHandler' ) ) {
	/**
	 * UMPasswordResetAddOnHandler class
	 */
	class UMPasswordResetAddOnHandler extends BaseAddOnHandler {
		use Instance;

		/**
		 * Constructor checks if add-on has been enabled by the admin and initializes
		 * all the class variables. This function also defines all the hooks to
		 * hook into to make the add-on functionality work.
		 */
		public function __construct() {
			parent::__construct();
			if ( ! $this->moAddOnV() ) {
				return;
			}
			UMPasswordResetHandler::instance();
		}

		/** Set a unique for the AddOn */
		public function set_addon_key() {
			$this->add_on_key = 'um_pass_reset_addon';
		}

		/** Set a AddOn Description */
		public function set_add_on_desc() {
			$this->add_on_desc = mo_(
				'Allows your users to reset their password using OTP instead of email links.'
				. 'Click on the settings button to the right to configure settings for the same.'
			);
		}
		/** Set an AddOnName */
		public function set_add_on_name() {
			$this->addon_name = mo_( 'Ultimate Member Password Reset Over OTP' );
		}

		/** Set an Addon Docs link */
		public function set_add_on_docs() {
			$this->add_on_docs = MoFormDocs::ULTIMATEMEMBER_PASSWORD_RESET_ADDON_LINK['guideLink'];
		}
		/** Set an Addon Video link */
		public function set_add_on_video() {
			$this->add_on_video = MoFormDocs::ULTIMATEMEMBER_PASSWORD_RESET_ADDON_LINK['videoLink'];
		}
		/** Set Settings Page URL */
		public function set_settings_url() {
			$this->settings_url = add_query_arg( array( 'addon' => 'umpr_notif' ), isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : null );
		}
	}
}
