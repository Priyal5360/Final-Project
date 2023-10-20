<?php
/**
 * Custom messages addon handler.
 *
 * @package miniorange-otp-verification/addons
 */

namespace OTP\Addons\CustomMessage\Handler;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\BaseAddOnHandler;
use OTP\Objects\BaseMessages;
use OTP\Traits\Instance;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\MoFormDocs;

/**
 * The class is used to handle all custom message sending related functionality.
 * This class just handles the plugin related functionality to send custom sms
 * or email messages to the user.
 */
if ( ! class_exists( 'CustomMessages' ) ) {
	/**
	 * CustomMessages class
	 */
	class CustomMessages extends BaseAddOnHandler {

		use Instance;

		/**
		 * Define variable .
		 *
		 * @var string
		 */
		protected $addon_session_var;

		/**
		 * Add actions.
		 *
		 *  @var array $admin_actions Admin Actions and their Callback functions
		 */
		public $admin_actions = array(
			'mo_customer_validation_admin_custom_phone_notif' => 'mo_validation_send_sms_notif_msg',
			'mo_customer_validation_admin_custom_email_notif' => 'mo_validation_send_email_notif_msg',
		);

		/**
		 * Constructor checks if add-on has been enabled by the admin and initializes
		 * all the class variables. This function also defines all the hooks to
		 * hook into to make the add-on functionality work.
		 */
		public function __construct() {
			parent::__construct();
			$this->nonce = 'mo_admin_actions';
			if ( ! $this->moAddOnV() ) {
				return;
			}
			$this->addon_session_var = 'custom_message_addon';
			$this->send_admin_notification();
			foreach ( $this->admin_actions as $action => $callback ) {
				add_action( "wp_ajax_{$action}", array( $this, $callback ) );
				add_action( "admin_post_{$action}", array( $this, $callback ) );
			}
		}
		/**
		 * Function is used to display success/error notifications in admin notices.
		 */
		public function send_admin_notification() {

			if ( MoPHPSessions::get_session_var( $this->addon_session_var ) ) {
				MoConstants::SUCCESS_JSON_TYPE === MoPHPSessions::get_session_var( $this->addon_session_var )['result'] ?
				do_action( 'mo_registration_show_message', MoPHPSessions::get_session_var( $this->addon_session_var )['message'], MoConstants::CUSTOM_MESSAGE_ADDON_SUCCESS ) :
				do_action( 'mo_registration_show_message', MoPHPSessions::get_session_var( $this->addon_session_var )['message'], MoConstants::CUSTOM_MESSAGE_ADDON_ERROR );
				$this->unset_sessionVariables();
			}
		}
		/**
		 * Unset all the session variables so that a new form submission starts
		 * a fresh process of OTP verification.
		 */
		public function unset_sessionVariables() {

			MoPHPSessions::unset_session( $this->addon_session_var );
		}
		/**
		 * Callback function is used to send SMS notifications. Processes the
		 * messages being sent and the phone number(s) message needs to be sent
		 * to.
		 */
		public function mo_validation_send_sms_notif_msg() {
			if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['security'] ) ), $this->nonce ) ) {
				if ( MoUtility::sanitize_check( 'ajax_mode', $_POST ) ) {
					wp_send_json(
						MoUtility::create_json(
							MoMessages::showMessage( BaseMessages::INVALID_OP ),
							MoConstants::ERROR_JSON_TYPE
						)
					);
				} else {
					wp_die( esc_attr( MoMessages::showMessage( MoMessages::INVALID_OP ) ) );
				}
			}

			$data          = MoUtility::mo_sanitize_array( $_POST );
			$phone_numbers = explode( ';', MoUtility::sanitize_check( 'mo_phone_numbers', $data ) );
			$message       = MoUtility::sanitize_check( 'mo_customer_validation_custom_sms_msg', $data );
			$content       = null;

			foreach ( $phone_numbers as $phone ) {
				$content = MoUtility::send_phone_notif( $phone, $message );
			}
			MoUtility::sanitize_check( 'ajax_mode', $_POST ) ? $this->checkStatusAndSendJSON( $content ) : $this->checkStatusAndShowMessage( $content );
		}

		/**
		 * Callback function is used to send Email notifications. Processes the
		 * messages being sent and the email address(s) message needs to be
		 * sent to.
		 */
		public function mo_validation_send_email_notif_msg() {
			if ( MoUtility::sanitize_check( 'ajax_mode', $_POST ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing -- No need for nonce verification as the function is called on third party plugin hook.
				if ( ! check_ajax_referer( $this->nonce, 'security' ) ) {
					wp_send_json(
						MoUtility::create_json(
							MoMessages::showMessage( BaseMessages::INVALID_OP ),
							MoConstants::ERROR_JSON_TYPE
						)
					);
				}
			} else {
				if ( ! current_user_can( 'manage_options' ) || ! check_admin_referer( $this->nonce ) ) {
					wp_die( esc_attr( MoMessages::showMessage( MoMessages::INVALID_OP ) ) );
				}
			}

			$data            = MoUtility::mo_sanitize_array( $_POST );
			$email_addresses = explode( ';', MoUtility::sanitize_check( 'toEmail', $data ) );
			$content         = null;

			foreach ( $email_addresses as $email ) {
				$content = MoUtility::send_email_notif(
					isset( $data['fromEmail'] ) ? sanitize_email( wp_unslash( $data['fromEmail'] ) ) : '',
					isset( $data['fromName'] ) ? sanitize_text_field( wp_unslash( $data['fromName'] ) ) : '',
					sanitize_email( $email ),
					isset( $data['subject'] ) ? sanitize_text_field( wp_unslash( $data['subject'] ) ) : '',
					isset( $data['content'] ) ? stripslashes( sanitize_text_field( wp_unslash( $data['content'] ) ) ) : ''
				);
			}
			MoUtility::sanitize_check( 'ajax_mode', $_POST ) ? $this->checkStatusAndSendJSON( $content ) : $this->checkStatusAndShowMessage( $content );
		}

		/**
		 * This function is used to check the status of the API Call and show user
		 * the appropriate message. This function currently only checks the Custom
		 * Message Sending API call.
		 *
		 * @param string $content - true or false.
		 */
		private function checkStatusAndShowMessage( $content ) {
			if ( is_null( $content ) ) {
				return;
			}
			$msg_type = $content ? MoConstants::SUCCESS : MoConstants::ERROR;
			if ( MoConstants::SUCCESS === $msg_type ) {
				MoPHPSessions::add_session_var(
					$this->addon_session_var,
					MoUtility::create_json(
						MoMessages::showMessage( BaseMessages::CUSTOM_MSG_SENT ),
						MoConstants::SUCCESS_JSON_TYPE
					)
				);
			} else {
				MoPHPSessions::add_session_var(
					$this->addon_session_var,
					MoUtility::create_json(
						MoMessages::showMessage( BaseMessages::CUSTOM_MSG_SENT_FAIL ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
			}

			wp_safe_redirect( wp_get_referer() );
			exit();
		}
		/**
		 * This function is used to check the status of the API call and then
		 * send an appropriate JSON response.
		 *
		 * @param string $content form content.
		 */
		private function checkStatusAndSendJSON( $content ) {
			if ( is_null( $content ) ) {
				return;
			}
			if ( $content ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( BaseMessages::CUSTOM_MSG_SENT ),
						MoConstants::SUCCESS_JSON_TYPE
					)
				);
			} else {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( BaseMessages::CUSTOM_MSG_SENT_FAIL ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
			}
		}

		/*
		|-----------------------------------------------------------------------------------------------
		| Getters & Setters
		|-----------------------------------------------------------------------------------------------
		 */

		/** Set a unique for the AddOn */
		public function set_addon_key() {
			$this->add_on_key = 'custom_messages_addon';
		}

		/** Set a AddOn description */
		public function set_add_on_desc() {
			$this->add_on_desc = mo_( 'Send Customized message to any phone or email directly from the dashboard.' );
		}

		/** Set an AddOnName */
		public function set_add_on_name() {
			$this->addon_name = mo_( 'Custom Messages' );
		}

		/** Set an Addon Docs link */
		public function set_add_on_docs() {
			$this->add_on_docs = MoFormDocs::CUSTOM_MESSAGES_ADDON_LINK['guideLink'];
		}

		/** Set an Addon Video link */
		public function set_add_on_video() {
			$this->add_on_video = MoFormDocs::CUSTOM_MESSAGES_ADDON_LINK['videoLink'];
		}

		/** Set Settings Page URL */
		public function set_settings_url() {
			$request_url        = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
			$this->settings_url = add_query_arg( array( 'addon' => 'custom' ), $request_url );
		}
	}
}
