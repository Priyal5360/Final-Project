<?php
/**Load administrator changes for MoWhatsApp
 *
 * @package miniorange-otp-verification/helper
 */

namespace OTP\Helper;

use OTP\Traits\Instance;
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Helper\MocURLCall;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\TransactionCost;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * This class is for Whatsapp Verification and all its functions
 */
if ( ! class_exists( 'MoWhatsApp' ) ) {
	/**
	 * MoWhatsApp class
	 */
	class MoWhatsApp {

		use Instance;
		/**Constructor
		 **/
		protected function __construct() {

			add_filter( 'mo_wa_send_otp_token', array( $this, 'mo_wa_send_otp_token' ), 99, 4 );
			add_filter( 'mo_wa_validate_otp_token', array( $this, 'mo_wa_validate_otp_token' ), 99, 2 );
		}

		/**
		 * Calls the server to send OTP to the user's phone or email
		 *
		 * @param string $auth_type  OTP Type - EMAIL or SMS.
		 * @param string $email     Email Address of the user.
		 * @param string $phone     Phone Number of the user.
		 * @param string $data     data of the user.
		 * @return array
		 */
		public function mo_wa_send_otp_token( $auth_type, $email, $phone, $data ) {
			$content = $this->send_otp_token( $auth_type, $email, $phone, $data );
			return $content;
		}

		/**
		 * Calls the server to send OTP to the user's phone or email
		 *
		 * @param string $auth_type  OTP Type - EMAIL or SMS.
		 * @param string $email     Email Address of the user.
		 * @param string $phone     Phone Number of the user.
		 * @param string $data     data of the user.
		 * @return array
		 */
		public function send_otp_token( $auth_type, $email, $phone, $data ) {
			$mo_otp_length = get_mo_option( 'otp_length' ) ? get_mo_option( 'otp_length' ) : 5;
			$otp           = wp_rand( pow( 10, $mo_otp_length - 1 ), pow( 10, $mo_otp_length ) - 1 );
			$otp           = apply_filters( 'mo_alphanumeric_otp_filter', $otp );

			$customer_key   = get_mo_option( 'admin_customer_key' );
			$string_to_hash = $customer_key . $otp;
			$transaction_id = hash( 'sha512', $string_to_hash );
			$message        = 'Dear Customer, Your OTP is ##otp##. Use this Passcode to complete your transaction. Thank you.';
			$message        = str_replace( '##otp##', $otp, $message );
			$response       = $this->send_notif( $message, $phone, $otp );
			if ( $response ) {
				MoPHPSessions::add_session_var( 'mo_otptoken', true );
				MoPHPSessions::add_session_var( 'sent_on', time() );
				$content = array(
					'status' => 'SUCCESS',
					'tx_id'  => $transaction_id,
				);
			} else {
				$content = array( 'status' => 'FAILURE' );
			}

			if ( 'wa_miniorange_get_test_response' === isset( $data['action'] ) && sanitize_textarea_field( wp_unslash( $data['action'] ) ) ) {
				return wp_json_encode( $response );
			}
			return wp_json_encode( $content );
		}

		/**
		 * Calls the server to send SMS to the user's phone or email
		 *
		 * @param string $message  SMS text.
		 * @param string $phone     Phone Number of the user.
		 * @param string $otp     otp sent to the user.
		 * @return array
		 */
		public function send_notif( $message, $phone, $otp ) {
			$message      = str_replace( ' ', '+', $message );
			$url          = MoConstants::HOSTNAME . '/moas/api/plugin/whatsapp/send';
			$customer_key = get_mo_option( 'admin_customer_key' );
			$site_name    = get_bloginfo( 'name' );

			/*only to send otp via whatsapp on miniOrange and/or custom gateway*/
			$message = 'otp_test_whatsapp';
			$fields  = array(
				'customerId'       => $customer_key,
				'variable'         => array(
					'var1' => $site_name,
					'var2' => $otp,
				),
				'isDefault'        => true,
				'templateId'       => $message,
				'phoneNumber'      => $phone,
				'templateLanguage' => 'en',
				'customerEmail'    => get_mo_option( 'admin_email' ),
			);
			$arr     = array();
			array_push( $arr, $site_name, $otp );
			$json     = wp_json_encode( $fields );
			$response = MocURLCall::call_api( $url, $json );
			return $response;
		}

		/**
		 * Calls the server to validate the OTP
		 *
		 * @param string $transaction_id      Transaction ID from session.
		 * @param string $otp_token OTP Token to validate.
		 * @return array
		 */
		public function mo_wa_validate_otp_token( $transaction_id, $otp_token ) {
			$customer_key = get_mo_option( 'admin_customer_key' );
			if ( MoPHPSessions::get_session_var( 'mo_otptoken' ) ) {
				$pass = $this->check_time_stamp( MoPHPSessions::get_session_var( 'sent_on' ), time() );
				$pass = $this->check_transaction_id( $customer_key, $otp_token, $transaction_id, $pass );
				if ( $pass ) {
					$content = wp_json_encode( array( 'status' => MoConstants::SUCCESS ) );
				} else {
					$content = wp_json_encode( array( 'status' => MoConstants::FAILURE ) );
				}
				MoPHPSessions::unset_session( '$mo_otptoken' );
			} else {
				$content = wp_json_encode( array( 'status' => MoConstants::FAILURE ) );
			}
			return $content;
		}

		/**
		 * Calls the server for timestamp
		 *
		 * @param string $sent_time      otp sent time.
		 * @param string $validation_time OTP Token validation time.
		 * @return array
		 */
		private function check_time_stamp( $sent_time, $validation_time ) {
			$mo_otp_validity = get_mo_option( 'otp_validity' ) ? get_mo_option( 'otp_validity' ) : 5;
			$diff            = round( abs( $validation_time - $sent_time ) / 60, 2 );
			return ! $diff > $mo_otp_validity;
		}
		/**
		 * Calls the server to check teh transaction id
		 *
		 * @param string $customer_key      Transaction ID from session.
		 * @param string $otp_token OTP Token to validate.
		 * @param string $transaction_id      Transaction ID from session.
		 * @param string $pass      password.
		 * @return array
		 */
		private function check_transaction_id( $customer_key, $otp_token, $transaction_id, $pass ) {
			if ( ! $pass ) {
				return false;
			}
			$string_to_hash = $customer_key . $otp_token;
			$txt_id         = hash( 'sha512', $string_to_hash );
			return $txt_id === $transaction_id;
		}
	}
}
