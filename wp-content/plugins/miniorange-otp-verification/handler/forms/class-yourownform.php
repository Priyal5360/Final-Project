<?php
/**
 * Handles the OTP verification logic for WooCommerceRegistrationForm form.
 *
 * @package miniorange-otp-verification/handler
 */

namespace OTP\Handler\Forms;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Helper\FormSessionVars;
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Objects\BaseMessages;
use OTP\Traits\Instance;

/**
 * This is the User Profile Made Easy Registration Form class. This class handles all the
 * functionality related to User Profile Made Easy Registration Form. It extends the FormHandler
 * and implements the IFormHandler class to implement some much needed functions.
 */
if ( ! class_exists( 'YourOwnForm' ) ) {
	/**
	 * YourOwnForm class
	 */
	class YourOwnForm extends FormHandler implements IFormHandler {

		use Instance;

		/**
		 * Submit action for final form submission.
		 *
		 * @var string
		 */
		private $check_validated_on_submit;

		/**
		 * Id of the email/phone field.
		 *
		 * @var string
		 */
		private $form_field_id;

		/**
		 * Id of the final submit button.
		 *
		 * @var string
		 */
		private $form_submit_id;

		/**
		 * Stores the validation status of the form.
		 *
		 * @var boolean
		 */
		private $validated;

		/**
		 * Initializes values
		 */
		protected function __construct() {
			$this->is_login_or_social_form   = false;
			$this->is_ajax_form              = true;
			$this->form_key                  = 'YOUR_OWN_FORM';
			$this->form_name                 = mo_( "<span style='color:green' ><b>Can't Find your Form? Try me!</b></span>" );
			$this->form_session_var          = FormSessionVars::CUSTOMFORM;
			$this->form_details              = maybe_unserialize( get_mo_option( 'custom_form_otp_enabled' ) );
			$this->type_phone_tag            = 'mo_customForm_phone_enable';
			$this->type_email_tag            = 'mo_customForm_email_enable';
			$this->is_form_enabled           = get_mo_option( 'custom_form_contact_enable' );
			$this->generate_otp_action       = 'miniorange-customForm-send-otp';
			$this->validate_otp_action       = 'miniorange-customForm-verify-code';
			$this->check_validated_on_submit = 'miniorange-customForm-verify-submit';
			$this->otp_type                  = get_mo_option( 'custom_form_enable_type' );
			$this->button_text               = get_mo_option( 'custom_form_button_text' );
			$this->button_text               = ! MoUtility::is_blank( $this->button_text ) ? $this->button_text : mo_( 'Click Here to send OTP' );
			$this->validated                 = false;
			parent::__construct();
			$this->handle_form();
		}

		/**
		 * Function checks if form has been enabled by the admin and initializes
		 * all the class variables. This function also defines all the hooks to
		 * hook into to make OTP Verification possible.
		 */
		public function handle_form() {
			MoPHPSessions::check_session();
			if ( ! $this->is_form_enabled ) {
				return;
			}
			$this->form_field_id  = $this->getFieldKeyDetails();
			$this->form_submit_id = $this->getSubmitKeyDetails();
			add_action( 'wp_enqueue_scripts', array( $this, 'mo_enqueue_form_script' ) );
			add_action( 'login_enqueue_scripts', array( $this, 'mo_enqueue_form_script' ) );
			add_action( "wp_ajax_{$this->generate_otp_action}", array( $this, 'send_otp' ) );
			add_action( "wp_ajax_nopriv_{$this->generate_otp_action}", array( $this, 'send_otp' ) );
			add_action( "wp_ajax_{$this->validate_otp_action}", array( $this, 'processFormAndValidateOTP' ) );
			add_action( "wp_ajax_nopriv_{$this->validate_otp_action}", array( $this, 'processFormAndValidateOTP' ) );
			add_action( "wp_ajax_{$this->check_validated_on_submit}", array( $this, 'check_validated_on_submit' ) );
			add_action( "wp_ajax_nopriv_{$this->check_validated_on_submit}", array( $this, 'check_validated_on_submit' ) );

			if ( SessionUtils::is_status_match( $this->form_session_var, self::VALIDATED, $this->get_verification_type() ) ) {
				$this->validated = true;
				$this->unset_otp_session_variables();
				return;
			}
		}

		/**
		 * This function registers the js file for enabling OTP Verification
		 * for Custom form.
		 */
		public function mo_enqueue_form_script() {
			wp_register_script( $this->form_session_var, MOV_URL . 'includes/js/' . $this->form_session_var . '.min.js', array( 'jquery' ), MOV_VERSION, true );
			wp_localize_script(
				$this->form_session_var,
				$this->form_session_var,
				array(
					'siteURL'        => wp_ajax_url(),
					'otpType'        => $this->get_verification_type(),
					'formDetails'    => $this->form_details,
					'buttontext'     => $this->button_text,
					'imgURL'         => MOV_LOADER_URL,
					'fieldText'      => mo_( 'Enter OTP here' ),
					'gnonce'         => wp_create_nonce( $this->nonce ),
					'nonceKey'       => wp_create_nonce( $this->nonce_key ),
					'vnonce'         => wp_create_nonce( $this->nonce ),
					'gaction'        => $this->generate_otp_action,
					'vaction'        => $this->validate_otp_action,
					'saction'        => $this->check_validated_on_submit,
					'fieldSelector'  => $this->form_field_id,
					'submitSelector' => $this->form_submit_id,
				)
			);
			wp_enqueue_script( $this->form_session_var );
			wp_enqueue_style( 'mo_forms_css', MOV_FORM_CSS, array(), MOV_VERSION );

		}

		/**
		 * The function is used to process the email or phone number provided
		 * and send OTP to it for verification. This is called from the form
		 * using AJAX calls.
		 */
		public function send_otp() {
			if ( ! check_ajax_referer( $this->nonce, 'nonce', false ) ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::UNKNOWN_ERROR ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
				exit;
			}
			$data = MoUtility::mo_sanitize_array( $_POST );
			MoPHPSessions::check_session();
			if ( ! SessionUtils::is_otp_initialized( $this->form_session_var ) ) {
				MoUtility::initialize_transaction( $this->form_session_var );
			}
			if ( MoUtility::sanitize_check( 'otpType', $data ) === VerificationType::PHONE ) {
				$this->process_phone_and_send_otp( $data );
			}
			if ( MoUtility::sanitize_check( 'otpType', $data ) === VerificationType::EMAIL ) {
				$this->process_email_and_send_otp( $data );
			}
		}

		/**
		 * Final form submission verification checks.
		 */
		public function check_validated_on_submit() {

			if ( SessionUtils::is_otp_initialized( $this->form_session_var ) || $this->validated ) {
				wp_send_json(
					MoUtility::create_json(
						self::VALIDATED,
						MoConstants::SUCCESS_JSON_TYPE
					)
				);
			} elseif ( ! SessionUtils::is_otp_initialized( $this->form_session_var ) && ! $this->validated ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::PLEASE_VALIDATE ),
						MoConstants::ERROR_JSON_TYPE
					)
				);

			}

		}

		/**
		 * Validates email entered by the user and calls function for sending OTP.
		 *
		 * @param array $data - Post data submitted on the send OTP ajax call.
		 */
		private function process_email_and_send_otp( $data ) {
			MoPHPSessions::check_session();
			if ( ! MoUtility::sanitize_check( 'user_email', $data ) ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::ENTER_EMAIL ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
			} else {
				$user_email = sanitize_email( $data['user_email'] );
				SessionUtils::add_email_verified( $this->form_session_var, $user_email );
				$this->send_challenge( '', $user_email, null, null, VerificationType::EMAIL );
			}
		}


		/**
		 * Validates phone entered by the user and calls function for sending OTP.
		 *
		 * @param array $data - Post data submitted on the send OTP ajax call.
		 */
		private function process_phone_and_send_otp( $data ) {
			if ( ! MoUtility::sanitize_check( 'user_phone', $data ) ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::ENTER_PHONE ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
			} else {
				$user_phone = sanitize_text_field( $data['user_phone'] );
						SessionUtils::add_phone_verified( $this->form_session_var, $user_phone );
				$this->send_challenge( '', null, null, $user_phone, VerificationType::PHONE );
			}
		}

		/**
		 * Checks if OTP is entered and validates the OTP.
		 */
		public function processFormAndValidateOTP() {
			if ( ! check_ajax_referer( $this->nonce, 'nonce', false ) ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::UNKNOWN_ERROR ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
				exit;
			}
			$data = MoUtility::mo_sanitize_array( $_POST );
			MoPHPSessions::check_session();
			$this->checkIfOTPSent();
			$this->checkIntegrityAndValidateOTP( $data );
		}

		/**
		 * Checks if OTP is initialized.
		 */
		private function checkIfOTPSent() {
			if ( ! SessionUtils::is_otp_initialized( $this->form_session_var ) ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::ENTER_VERIFY_CODE ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
			}
		}

		/**
		 * Checks if email or phone is altered after the OTP is sent.
		 * Also, verifies the OTP.
		 *
		 * @param array $data - post data submitted on validate OTP button.
		 */
		private function checkIntegrityAndValidateOTP( $data ) {
			MoPHPSessions::check_session();
			$this->checkIntegrity( $data );
			$this->validate_challenge( sanitize_text_field( $data['otpType'] ), null, sanitize_text_field( $data['otp_token'] ) );
			if ( SessionUtils::is_status_match( $this->form_session_var, self::VALIDATED, $data['otpType'] ) ) {
				if ( VerificationType::PHONE === $data['otpType'] ) {
					SessionUtils::add_phone_submitted( $this->form_session_var, sanitize_text_field( $data['user_phone'] ) );
				}
				if ( VerificationType::EMAIL === $data['otpType'] ) {
					SessionUtils::add_email_submitted( $this->form_session_var, sanitize_email( $data['user_email'] ) );
				}
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::CUSTOM_FORM_MESSAGE ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
			} else {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::CUSTOM_FORM_MESSAGE ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
			}
		}

		/**
		 * Checks if email or phone is altered after the OTP is sent.
		 *
		 * @param array $data - post data submitted on validate OTP button.
		 */
		private function checkIntegrity( $data ) {
			if ( VerificationType::PHONE === $data['otpType'] ) {
				if ( ! SessionUtils::is_phone_verified_match( $this->form_session_var, sanitize_text_field( $data['user_phone'] ) ) ) {
					wp_send_json(
						MoUtility::create_json(
							MoMessages::showMessage( MoMessages::PHONE_MISMATCH ),
							MoConstants::ERROR_JSON_TYPE
						)
					);
				}
			}
			if ( VerificationType::EMAIL === $data['otpType'] ) {
				if ( ! SessionUtils::is_email_verified_match( $this->form_session_var, sanitize_email( $data['user_email'] ) ) ) {
					wp_send_json(
						MoUtility::create_json(
							MoMessages::showMessage( MoMessages::EMAIL_MISMATCH ),
							MoConstants::ERROR_JSON_TYPE
						)
					);
				}
			}
		}

		/**
		 * This function hooks into the otp_verification_failed hook. This function
		 * details what is done if the OTP verification fails.
		 *
		 * @param string $user_login the username posted by the user.
		 * @param string $user_email the email posted by the user.
		 * @param string $phone_number the phone number posted by the user.
		 * @param string $otp_type the verification type.
		 */
		public function handle_failed_verification( $user_login, $user_email, $phone_number, $otp_type ) {
			MoPHPSessions::check_session();
			if ( ! SessionUtils::is_otp_initialized( $this->form_session_var ) ) {
				return;
			}
			SessionUtils::add_status( $this->form_session_var, self::VERIFICATION_FAILED, $otp_type );
		}


		/**
		 * This function hooks into the otp_verification_successful hook. This function is
		 * details what needs to be done if OTP Verification is successful.
		 *
		 * @param string $redirect_to the redirect to URL after new user registration.
		 * @param string $user_login the username posted by the user.
		 * @param string $user_email the email posted by the user.
		 * @param string $password the password posted by the user.
		 * @param string $phone_number the phone number posted by the user.
		 * @param string $extra_data any extra data posted by the user.
		 * @param string $otp_type the verification type.
		 */
		public function handle_post_verification( $redirect_to, $user_login, $user_email, $password, $phone_number, $extra_data, $otp_type ) {
			MoPHPSessions::check_session();
			if ( ! SessionUtils::is_otp_initialized( $this->form_session_var ) ) {
				return;
			}
			SessionUtils::add_status( $this->form_session_var, self::VALIDATED, $otp_type );
		}


		/**
		 * Unsets the session after form submission.
		 */
		public function unset_otp_session_variables() {
			MoPHPSessions::check_session();
			SessionUtils::unset_session( array( $this->form_session_var, $this->tx_session_id ) );
		}


		/**
		 * This function is called by the filter mo_phone_dropdown_selector
		 * to return the Jquery selector of the phone field. The function will
		 * push the formID to the selector array if OTP Verification for the
		 * form has been enabled.
		 *
		 * @param array $selector - the Jquery selector to be modified.
		 * @return array $selector - the Jquery selector to be modified.
		 */
		public function get_phone_number_selector( $selector ) {
			if ( $this->is_form_enabled() && $this->isPhoneEnabled() ) {
				array_push( $selector, $this->form_field_id );
			}
			return $selector;
		}

		/**
		 * Checks if phone verification is enabled.
		 */
		private function isPhoneEnabled() {
			return VerificationType::PHONE === $this->get_verification_type() ? true : false;
		}

		/**
		 * Parses the form details submitted by admin and returns an array of details.
		 *
		 * @param array $data - post data submitted at the time of saving form details on admin side.
		 */
		private function parseFormDetails( $data ) {
			$form = array();
			if ( ! array_key_exists( 'custom_form', $data ) ) {
				return array();
			}

			$mo_customer_validation_custom_form_enable_type = isset( $data['mo_customer_validation_custom_form_enable_type'] ) ? sanitize_text_field( wp_unslash( $data['mo_customer_validation_custom_form_enable_type'] ) ) : '';
			$otp_type                                       = $mo_customer_validation_custom_form_enable_type === $this->type_phone_tag ? 'phone' : 'email';

			foreach ( array_filter( ( $data['custom_form']['form'] ) ) as $key => $value ) { //phpcs:ignore -- $data is an array but considered as a string (false positive).
				$form[ $value ] = array(
					'submit_id' => sanitize_text_field( $data['custom_form'][ $otp_type ]['submit_id'] ),
					'field_id'  => sanitize_text_field( $data['custom_form'][ $otp_type ]['field_id'] ),
				);
			}
			return $form;
		}

		/**
		 * Handles saving all the woocommerce Registration form related options by the admin.
		 */
		public function handle_form_options() {

			if ( ! MoUtility::are_form_options_being_saved( $this->get_form_option() ) || ! current_user_can( 'manage_options' ) || ! check_admin_referer( $this->admin_nonce ) ) {
				return;
			}
			$data = MoUtility::mo_sanitize_array( $_POST );
			$form = $this->parseFormDetails( $data );

			$this->form_details    = ! empty( $form ) ? $form : '';
			$this->is_form_enabled = $this->sanitize_form_post( 'custom_form_contact_enable' );
			$this->otp_type        = $this->sanitize_form_post( 'custom_form_enable_type' );
			$this->button_text     = $this->sanitize_form_post( 'custom_form_button_text' );

			if ( $this->basic_validation_check( BaseMessages::CUSTOM_CHOOSE ) ) {
				update_mo_option( 'custom_form_otp_enabled', maybe_serialize( $this->form_details ) );
				update_mo_option( 'custom_form_contact_enable', $this->is_form_enabled );
				update_mo_option( 'custom_form_enable_type', $this->otp_type );
				update_mo_option( 'custom_form_button_text', $this->button_text );
			}

		}

		/**
		 * Returns final submission key details.
		 */
		public function getSubmitKeyDetails() {
			if ( empty( $this->form_details ) ) {
				return;
			}
			return stripcslashes( $this->form_details[1]['submit_id'] );
		}

		/**
		 * Returns phone or email key details.
		 */
		public function getFieldKeyDetails() {
			if ( empty( $this->form_details ) ) {
				return;
			} return stripcslashes( $this->form_details[1]['field_id'] ); }
	}
}
