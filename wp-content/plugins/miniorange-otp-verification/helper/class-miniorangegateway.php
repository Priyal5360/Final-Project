<?php
/**Load adminstrator changes for Miniorange Gateway
 *
 * @package miniorange-otp-verification/helper
 */

namespace OTP\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use OTP\Addons\CustomMessage\MiniOrangeCustomMessage;
use OTP\Addons\PasswordReset\UltimateMemberPasswordReset;
use OTP\Addons\PasswordResetwc\WooCommercePasswordReset;
use OTP\Addons\UmSMSNotification\UltimateMemberSmsNotification;
use OTP\Addons\WcSMSNotification\WooCommerceSmsNotification;
use OTP\Addons\WpSMSNotification\WordPressSmsNotification;
use OTP\Addons\CountryCode\SelectedCountryCode;
use OTP\Addons\regwithphone\RegisterWithPhoneOnly;
use OTP\Addons\PasscodeOverCalltwilio\VerifyOverCallAddon;
use OTP\Addons\passwordresetwp\WordPressPasswordReset;
use OTP\Addons\ipbasedropdown\EnableIpBaseCountryCode;
use OTP\Addons\APIVerification\APIAddon;
use OTP\Addons\ResendControl\MiniOrangeResendControl;
use OTP\Addons\MoBulkSMS\MoBulkSMSInit;
use OTP\Addons\CountryCodeDropdown\CountryCodeDropdownInit;
use OTP\Addons\WcSelectedCategory\WcSelectedCategory;
use OTP\Objects\IGatewayFunctions;
use OTP\Objects\NotificationSettings;
use OTP\Traits\Instance;

/**
 * This class has MiniOrange Gateway Plan specific functions
 *
 * @todo - Segregate the functions
 */
if ( ! class_exists( 'MiniOrangeGateway' ) ) {
	/**
	 * MiniOrangeGateway class
	 */
	class MiniOrangeGateway implements IGatewayFunctions {

		use Instance;
		/**
		 * Global variable
		 *
		 * @var Array
		 */
		private $nonce;

		/**Constructor
		 **/
		public function __construct() {
			$this->nonce = 'mo_admin_actions';
			$this->load_hooks();
		}

		/**Loads Hooks for ajax
		 **/
		public function load_hooks() {
			add_action( 'wp_ajax_wa_miniorange_get_test_response', array( $this, 'get_gateway_response' ) );
			add_action( 'wp_ajax_miniorange_get_test_response', array( $this, 'get_gateway_response' ) );
		}

		/**Global variable
		 *
		 * @var string application_name used in API calls */
		private $application_name = 'wp_otp_verification';

		/**
		 * ---------------------------------------------------------------------------------------
		 * FUNCTIONS RELATED TO ADDONS
		 * ---------------------------------------------------------------------------------------
		 **/
		public function register_addons() {
			MiniOrangeCustomMessage::instance();
			UltimateMemberPasswordReset::instance();
			UltimateMemberSmsNotification::instance();
			WooCommerceSmsNotification::instance();
			if ( file_exists( MOV_DIR . 'addons/passwordresetwc' ) ) {
				WooCommercePasswordReset::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/regwithphone' ) ) {
				RegisterWithPhoneOnly::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/wpsmsnotification' ) ) {
				WordPressSmsNotification::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/passcodeovercalltwilio' ) ) {
				VerifyOverCallAddon::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/passwordresetwp' ) ) {
				WordPressPasswordReset::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/apiverification' ) ) {
				APIAddon::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/resendcontrol' ) ) {
				MiniOrangeResendControl::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/countrycode' ) ) {
				SelectedCountryCode::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/mobulksms' ) ) {
				MoBulkSMSInit::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/countrycodedropdown' ) ) {
				CountryCodeDropdownInit::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/ipbasedropdown' ) ) {
				EnableIpBaseCountryCode::instance();
			}
			if ( file_exists( MOV_DIR . 'addons/wcselectedcategory' ) ) {
				WcSelectedCategory::instance();
			}
		}

		/**Function for showing addonlist
		 * */
		public function show_addon_list() {
			$addon_list = AddOnList::instance();
			$addon_list = $addon_list->get_list();

			$premium_feature_list   = PremiumFeatureList::instance();
			$premium_addon_list     = $premium_feature_list->get_premium_add_on_list();
			$premium_addon_page_url = admin_url() . 'admin.php?page=mootppricing&subpage=premaddons';

			foreach ( $addon_list as $addon ) {
				echo '<tr>
                    <td class="addon-table-list-status">
                        ' . esc_html( $addon->get_add_on_name() ) . '
                    </td>
                    <td class="addon-table-list-name">
                        <i>
                            ' . esc_html( $addon->getAddOnDesc() ) . '
                        </i>
                    </td>';

				echo '
                    <td class="addon-table-list-actions">
                        <a  class="button-primary button tips" style="background: #349cd9;"
                            href="' . esc_url( $addon->getSettingsUrl() ) . '">
                            ' . esc_html( mo_( 'Settings' ) ) . '
                        </a>
                    </td>';

				echo '
                    </tr>';
			}

			foreach ( $premium_addon_list as $key => $value ) {
				if ( ! array_key_exists( $key, $addon_list ) ) {
					echo '<tr>
                                <td class="addon-table-list-status">
                                    ' . esc_html( $value['name'] ) . '
                                </td>
                                <td class="addon-table-list-name">
                                    <i>
                                        ' . esc_html( $value['description'] ) . '
                                    </i>
                                </td>';
					echo '
                        <td class="addon-table-list-actions">
                            <a  class="button-primary button tips" style="background: rgb(250 204 21); color:#000; border:none; display:flex; align-items:center; justify-content:center; gap: 4px; font-weight:bold; padding: 2px 8px;" href="' . esc_url( $premium_addon_page_url ) . '">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                    <g id="d4a43e0162b45f718f49244b403ea8f4">
                                        <g id="4ea4c3dca364b4cff4fba75ac98abb38">
                                            <g id="2413972edc07f152c2356073861cb269">
                                                <path id="2deabe5f8681ff270d3f37797985a977" d="M20.8007 20.5644H3.19925C2.94954 20.5644 2.73449 20.3887 2.68487 20.144L0.194867 7.94109C0.153118 7.73681 0.236091 7.52728 0.406503 7.40702C0.576651 7.28649 0.801941 7.27862 0.980492 7.38627L7.69847 11.4354L11.5297 3.72677C11.6177 3.54979 11.7978 3.43688 11.9955 3.43531C12.1817 3.43452 12.3749 3.54323 12.466 3.71889L16.4244 11.3598L23.0197 7.38654C23.1985 7.27888 23.4233 7.28702 23.5937 7.40728C23.7641 7.52754 23.8471 7.73707 23.8056 7.94136L21.3156 20.1443C21.2652 20.3887 21.0501 20.5644 20.8007 20.5644Z" fill="black"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                ' . esc_html( mo_( 'Premium' ) ) . '
                            </a>
                            </td>';
					echo '
                            </tr>';
				}
			}
		}

		/**
		 * ---------------------------------------------------------------------------------------
		 * FUNCTIONS RELATED TO LICENSING AND SYNC
		 * ---------------------------------------------------------------------------------------
		 */
		public function hourly_sync() {
			$customer_key = get_mo_option( 'admin_customer_key' );
			$api_key      = get_mo_option( 'admin_api_key' );
			if ( isset( $customer_key ) && isset( $api_key ) ) {
				MoUtility::handle_mo_check_ln( false, $customer_key, $api_key );
			}
		}
		/** Flushing Cache
		 */
		public function flush_cache() {

		}

		/** MoInternal Function
		 *
		 * @param object $post postarray.
		 */
		public function vlk( $post ) {

		}

		/** MoInternal Function
		 *
		 * @return bool
		 */
		public function mclv() {
			return true;
		}


		/** MoInternal Function
		 *
		 * @return bool
		 */
		public function is_gateway_config() {
			return true;
		}


		/** MoInternal Function
		 *
		 * @return bool
		 */
		public function is_mg() {
			return $this->mclv();
		}

		/**
		 * Returns the application Name for the gateway
		 *
		 * @return string
		 */
		public function get_application_name() {
			return $this->application_name;
		}

		/**
		 * ---------------------------------------------------------------------------------------
		 * FUNCTIONS RELATED TO CUSTOM SMS AND EMAIL TEMPLATES
		 * ---------------------------------------------------------------------------------------
		 *
		 * @param string $original_email_from email of user.
		 */
		public function custom_wp_mail_from_name( $original_email_from ) {
			return $original_email_from;
		}
		/**
		 * Returns the sms template
		 *
		 * @param object $posted post values.
		 */
		public function mo_configure_sms_template( $posted ) {

		}
		/**
		 * Returns the email template
		 *
		 * @param object $posted post values.
		 */
		public function mo_configure_email_template( $posted ) {

		}
		/**
		 * Returns if Configuration page to be shown
		 *
		 * @param bool $disabled value.
		 */
		public function show_configuration_page( $disabled ) {
			include MOV_DIR . 'views/mconfiguration.php';
		}
		/**
		 * Function for test SMS Configuration for Whatsapp Feature
		 */
		public function get_gateway_response() {
			if ( ! check_ajax_referer( $this->nonce, 'security', false ) ) {
				return;
			}

			$data                      = MoUtility::mo_sanitize_array( $_POST );
			$test_configuration_number = isset( $data['test_config_number'] ) ? $data['test_config_number'] : '';
			$test_configuration_type   = isset( $data['action'] ) ? $data['action'] : '';

			$test_gateway_response = 'wa_miniorange_get_test_response' === $test_configuration_type ? $this->mo_send_otp_token( 'WHATSAPP', '', $test_configuration_number, $data ) : $this->mo_send_otp_token( 'SMS', '', $test_configuration_number, $data );

			$result = ( 'SUCCESS' === $test_gateway_response['status'] ) ? 'Success !! Your message has been sent.' : 'Error !! You message has not been sent.';
			echo esc_attr( $result );

			die();
		}

		/**
		 * Calls the server to send OTP to the user's phone or email
		 *
		 * @param string $auth_type  OTP Type - EMAIL or SMS.
		 * @param string $email     Email Address of the user.
		 * @param string $phone     Phone Number of the user.
		 * @param array  $data     Data submitted by the user.
		 * @return array
		 */
		public function mo_send_otp_token( $auth_type, $email, $phone, $data = array() ) {
			if ( MO_TEST_MODE ) {
				return array(
					'status' => 'SUCCESS',
					'txId'   => MoUtility::rand(),
				);
			} else {
				$auth_type = apply_filters( 'otp_over_call_activation', $auth_type );
				$content   = 'WHATSAPP' === $auth_type ? apply_filters( 'mo_wa_send_otp_token', $auth_type, $email, $phone, $data ) : MocURLCall::mo_send_otp_token( $auth_type, $email, $phone );
				return json_decode( $content, true );
			}
		}

		/**
		 * Calls server apis to send email or sms message to the user
		 *
		 * @param NotificationSettings $settings notification object.
		 * @return string
		 */
		public function mo_send_notif( NotificationSettings $settings ) {
			$url = '';
			if ( $settings->send_email ) {
				$url = MoConstants::HOSTNAME . '/moas/api/notify/send';
			} else {
				$url = MoConstants::HOSTNAME . '/moas/api/plugin/notify/send';
			}

			$customer_key = get_mo_option( 'admin_customer_key' );
			$api_key      = get_mo_option( 'admin_api_key' );

			$fields = array(
				'customerKey' => $customer_key,
				'sendEmail'   => $settings->send_email,
				'sendSMS'     => $settings->send_sms,
				'email'       => array(
					'customerKey' => $customer_key,
					'fromEmail'   => $settings->from_email,
					'bccEmail'    => $settings->bcc_email,
					'fromName'    => $settings->from_name,
					'toEmail'     => $settings->to_email,
					'toName'      => $settings->to_email,
					'subject'     => $settings->subject,
					'content'     => $settings->message,
				),
				'sms'         => array(
					'customerKey' => $customer_key,
					'phoneNumber' => $settings->phone_number,
					'message'     => $settings->message,
				),
			);

			$json        = wp_json_encode( $fields );
			$auth_header = MocURLCall::create_auth_header( $customer_key, $api_key );
			$response    = MocURLCall::call_api( $url, $json, $auth_header );
			return $response;
		}

		/**
		 * Calls the server to validate the OTP
		 *
		 * @param string $tx_id      Transaction ID from session.
		 * @param string $otp_token OTP Token to validate.
		 * @return array
		 */
		public function mo_validate_otp_token( $tx_id, $otp_token ) {
			if ( MO_TEST_MODE ) {
				return MO_FAIL_MODE ? array( 'status' => '' ) : array( 'status' => 'SUCCESS' );
			} else {
				$content = '';
				if ( get_mo_option( 'wa_only' ) || get_mo_option( 'wa_otp' ) ) {
					$content = apply_filters( 'mo_wa_validate_otp_token', $tx_id, $otp_token );
				}
				if ( ! $content ) {
					$content = MocURLCall::validate_otp_token( $tx_id, $otp_token );
				}
				return json_decode( $content, true );
			}
		}

		/** FUNCTIONS RELATED TO VISUAL TOUR
		 *
		 * @return array
		 */
		public function get_config_page_pointers() {
			$visual_tour = MOVisualTour::instance();
			return array(
				$visual_tour->tour_template(
					'configuration_instructions',
					'right',
					'',
					'<br>Check the links here to see how to change email/sms template, custom gateway, senderID, etc.',
					'Next',
					'emailSms.svg',
					1
				),
			);
		}
	}
}
