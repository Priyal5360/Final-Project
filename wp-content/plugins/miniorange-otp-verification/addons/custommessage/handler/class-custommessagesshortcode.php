<?php
/**
 * Handler to add shortcodes.
 *
 * @package miniorange-otp-verification/addons
 */

namespace OTP\Addons\CustomMessage\Handler;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use OTP\Traits\Instance;

/**
 * Class Handles all the shortcode that
 * can be used by the Admin to show a custom
 * Message form on the frontend.
 *
 * Users can use this form to send messages to anyone.
 */
if ( ! class_exists( 'CustomMessagesShortcode' ) ) {
	/**
	 * CustomMessagesShortcode class
	 */
	class CustomMessagesShortcode {

		use Instance;

		/**
		 * Adds shortcode.
		 *
		 * @var array $admin_actions Admin Actions
		 */
		private $admin_actions;

		/**
		 * Add nonce value.
		 *
		 * @var string $nonce
		 */
		private $nonce;
		/**
		 * Constructor initialize the shortcode function.
		 * This function also defines all the hooks to
		 * hook into to make the add-on functionality work.
		 */
		public function __construct() {
			$custom_message_handler = CustomMessages::instance();
			$this->nonce            = $custom_message_handler->get_nonce_value();
			$this->admin_actions    = $custom_message_handler->admin_actions;
			add_shortcode( 'mo_custom_sms', array( $this, '_custom_sms_shortcode' ) );
			add_shortcode( 'mo_custom_email', array( $this, '_custom_email_shortcode' ) );
		}

		/**
		 * Callback function for mo_custom_sms shortcode.
		 * Renders the form and script for Custom SMS Template.
		 */
		public function custom_sms_shortcode() {
			if ( ! is_user_logged_in() ) {
				return;
			}
			$actions = array_keys( $this->admin_actions );
			include MCM_DIR . 'views/customSMSBox.php';
			wp_register_script( 'custom_sms_msg_script', MCM_SHORTCODE_SMS_JS, array( 'jquery' ), MOV_VERSION, true );
			wp_localize_script(
				'custom_sms_msg_script',
				'movcustomsms',
				array(
					'alt'        => mo_( 'Sending...' ),
					'img'        => MOV_LOADER_URL,
					'nonce'      => wp_create_nonce( $this->nonce ),
					'url'        => wp_ajax_url(),
					'action'     => $actions[0],
					'buttonText' => mo_( 'Send SMS' ),
				)
			);
			wp_enqueue_script( 'custom_sms_msg_script' );
		}

		/**
		 * Callback function for mo_custom_email shortcode.
		 * Renders the form and script for Custom Email Template.
		 */
		public function custom_email_shortcode() {
			if ( ! is_user_logged_in() ) {
				return;
			}
			$actions = array_keys( $this->admin_actions );
			include MCM_DIR . 'views/customemailbox.php';
			wp_register_script( 'custom_email_msg_script', MCM_SHORTCODE_EMAIL_JS, array( 'jquery' ), MOV_VERSION, true );
			wp_localize_script(
				'custom_email_msg_script',
				'movcustomemail',
				array(
					'alt'        => mo_( 'Sending...' ),
					'img'        => MOV_LOADER_URL,
					'nonce'      => wp_create_nonce( $this->nonce ),
					'url'        => wp_ajax_url(),
					'action'     => $actions[1],
					'buttonText' => mo_( 'Send Email' ),
				)
			);
			wp_enqueue_script( 'custom_email_msg_script' );
		}
	}
}
