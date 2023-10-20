<?php
/**
 * Addon main helper.
 *
 * @package miniorange-otp-verification/addons
 */

namespace OTP\Addons\PasswordReset\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use OTP\Helper\MoUtility;
use OTP\Objects\BaseMessages;
use OTP\Traits\Instance;

/**
 * This class lists out all the messages that can be used across the AddOn.
 * Created a Base Class to handle all messages.
 */
if ( ! class_exists( 'UMPasswordResetMessages' ) ) {
	/**
	 * UMPasswordResetMessages class
	 */
	final class UMPasswordResetMessages extends BaseMessages {

		use Instance;
		/**
		 * Initializes values
		 */
		private function __construct() {

			define(
				'MO_UMPR_ADDON_MESSAGES',
				maybe_serialize(
					array(
						self::USERNAME_MISMATCH  => mo_( 'Username that the OTP was sent to and the username submitted do not match' ),
						self::USERNAME_NOT_EXIST => mo_(
							"We can't find an account registered with that address or " .
													'username or phone number'
						),
						self::RESET_LABEL        => mo_( 'To reset your password, please enter your email address, username or phone number below' ),
						self::RESET_LABEL_OP     => mo_( 'To reset your password, please enter your registered phone number below' ),
					)
				)
			);
		}

		/**
		 * This function is used to fetch and process the Messages to
		 * be shown to the user. It was created to mostly show dynamic
		 * messages to the user.
		 *
		 * @param string $message_keys   message key or keys.
		 * @param array  $data           key value of the data to be replaced in the message.
		 * @return string
		 */
		public static function showMessage( $message_keys, $data = array() ) {
			$display_message = '';
			$message_keys    = explode( ' ', $message_keys );
			$messages        = maybe_unserialize( MO_UMPR_ADDON_MESSAGES );
			$common_messages = maybe_unserialize( MO_MESSAGES );
			$messages        = array_merge( $messages, $common_messages );
			foreach ( $message_keys as $message_key ) {
				if ( MoUtility::is_blank( $message_key ) ) {
					return $display_message;
				}
				$format_message = $messages[ $message_key ];
				foreach ( $data as $key => $value ) {
					$format_message = str_replace( '{{' . $key . '}}', $value, $format_message );
				}
				$display_message .= $format_message;
			}
			return $display_message;
		}
	}
}
