<?php
/**Load adminstrator changes for MoUtility
 *
 * @package miniorange-otp-verification/helper
 */

namespace OTP\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use OTP\Traits\Instance;
use OTP\Objects\BaseMessages;

/**
 * This class is to enable Visual Tour and all its functions
 */
if ( ! class_exists( 'MOVisualTour' ) ) {
	/**
	 * MOVisualTour class
	 */
	class MOVisualTour {

		use Instance;
		/** Variable declaration
		 *
		 * @var $nonce
		 */
		protected $nonce;
		/** Variable declaration
		 *
		 * @var $nonce_key
		 */
		protected $nonce_key;
		/** Variable declaration
		 *
		 * @var $tour_ajax_action
		 */
		protected $tour_ajax_action;

		/**Constructor
		 **/
		protected function __construct() {
			$this->nonce            = 'mo_admin_actions';
			$this->nonce_key        = 'security';
			$this->tour_ajax_action = 'miniorange-tour-taken';

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_visual_tour_script' ) );
			add_action( "wp_ajax_{$this->tour_ajax_action}", array( $this, 'update_tour_taken' ) );
			add_action( "wp_ajax_nopriv_{$this->tour_ajax_action}", array( $this, 'update_tour_taken' ) );
		}

		/**
		 * Adds TourTaken variable in Options for the page that has tour completed
		 */
		public function update_tour_taken() {
			if ( ! check_ajax_referer( $this->nonce, 'security' ) ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( BaseMessages::INVALID_OP ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
			}
			$page_id   = isset( $_POST['pageID'] ) ? sanitize_text_field( wp_unslash( $_POST['pageID'] ) ) : null;
			$done_tour = isset( $_POST['pageID'] ) ? sanitize_text_field( wp_unslash( $_POST['pageID'] ) ) : null;

			update_mo_option( 'tourTaken_' . $page_id, $done_tour );
			die();
		}

		/**
		 * Checks if the request made is a valid ajax request or not.
		 * Only checks the none value for now.
		 */
		protected function validate_ajax_request() {
			if ( ! check_ajax_referer( $this->nonce, $this->nonce_key ) ) {
				wp_send_json(
					MoUtility::create_json(
						MoMessages::showMessage( MoMessages::INVALID_OP ),
						MoConstants::ERROR_JSON_TYPE
					)
				);
				exit;
			}
		}

		/**
		 * Function called by Enqueue Hook to register and localize the script and
		 * script variables.
		 */
		public function enqueue_visual_tour_script() {
			wp_register_script( 'tourScript', MOV_URL . 'includes/js/visualTour.min.js?version=' . MOV_VERSION, array( 'jquery' ), MOV_VERSION, false );
			$page = MoUtility::sanitize_check( 'page', $_GET ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the page, doesn't require nonce verification.
			wp_localize_script(
				'tourScript',
				'moTour',
				array(
					'siteURL'     => wp_ajax_url(),
					'currentPage' => $_GET, // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.NonceVerification.Recommended -- Reading GET parameter from the URL for checking the page, doesn't require nonce verification.
				'tnonce'          => wp_create_nonce( $this->nonce ),
				'pageID'          => $page,
				'tourData'        => $this->get_tour_data( $page ),
				'tourTaken'       => get_mo_option( 'tourTaken_' . $page ),
				'ajaxAction'      => $this->tour_ajax_action,
				'nonceKey'        => wp_create_nonce( $this->nonce_key ),
				)
			);
			wp_enqueue_script( 'tourScript' );
			wp_enqueue_style( 'mo_visual_tour_style', MOV_URL . 'includes/css/mo-card.min.css', '', MOV_VERSION );
		}

		/**
		 * Tour Data Template
		 *
		 * @param string $target_e        -   jQuery Selector for the target element.
		 * @param string $point_to_sale    -   the direction to point. place the card on the other side.
		 * @param string $titile_html      -   Title of the card, can be string, HTML or empty.
		 * @param string $content_html    -   Description of the card, can be string, HTML or empty.
		 * @param string $button_html     -   text on the Next Button.
		 * @param string $img            -   image name.
		 * @param int    $size           -    size of the card, 0=small, 1=medium, 2=big.
		 * @return array    -   Tour card array
		 */
		public function tour_template( $target_e, $point_to_sale, $titile_html, $content_html, $button_html, $img, $size ) {
			$card_size = array( 'small', 'medium', 'big' );
			return array(
				'targetE'     => $target_e,
				'pointToSide' => $point_to_sale,
				'titleHTML'   => $titile_html,
				'contentHTML' => $content_html,
				'buttonText'  => $button_html,
				'img'         => $img ? MOV_URL . "includes\\images\\tourIcons\\" . $img : $img,
				'cardSize'    => $card_size[ $size ],
			);
		}


		/**
		 * This functions return the array containing the tour elements for the current page
		 *
		 * @param  string $page_id  current page/tab.
		 * @return array tour data for current tab.
		 */
		public function get_tour_data( $page_id ) {
			$tour_data = array(
				'mosettings'  => $this->get_main_page_pointers(),
				'otpsettings' => $this->get_otp_starting_pointers(),
				'moconfig'      => $this->get_config_page_pointers(),
				'momessages'    => $this->get_message_pointers(),
				'modesign'      => $this->get_design_page_pointers(),
				'addon'       => $this->get_addon_page_pointers(),
			);

			$tabs = $this->get_tabs_pointers();
			if ( MoUtility::micr() && MoUtility::mclv() ) {
				$tour_data['otpaccount'] = $this->gte_account_page_pointers();
			}
			if ( ! get_mo_option( 'tourTaken_mosettings' ) ) {
				$tour_data['mosettings'] = array_merge( $tour_data['mosettings'], $tabs );
			}
			return MoUtility::sanitize_check( $page_id, $tour_data );
		}

		/**
		 * This functions return the array containing the tab details for the current page
		 *
		 * @return array tab data for current tab.
		 */
		private function get_tabs_pointers() {
			return array(
				$this->tour_template(
					'otpSettingsTab',
					'up',
					'<h1>OTP Settings</h1>',
					'Click here to goto OTP settings.',
					'Next',
					'settingsTab.svg',
					1
				),

				$this->tour_template(
					'emailSmsTemplate',
					'up',
					'<h1>Message / SMS Templates</h1>',
					'Click here to goto template settings.',
					'Next',
					'emailSmsTemplate.svg',
					1
				),

				$this->tour_template(
					'messagesTab',
					'up',
					'<h1>Configure Messages</h1>',
					'Click here to configure the messages shown.',
					'Next',
					'messages.svg',
					1
				),

				$this->tour_template(
					'popDesignTab',
					'up',
					'<h1>Popup Design</h1>',
					'Modify your Pop-Up as you like.',
					'Next',
					'design.svg',
					1
				),

				$this->tour_template(
					'addOnsTab',
					'up',
					'<h1>AddOns</h1>',
					'Check our cool AddOns here.',
					'Next',
					'addOnSetting.svg',
					1
				),

				$this->tour_template(
					'accountButton',
					'up',
					'<h1>Start Using the Plugin</h1>',
					'Register with us to get started.',
					'Next',
					'profile.svg',
					1
				),

				$this->tour_template(
					'faqButton',
					'up',
					'<h1>Any Questions?</h1>',
					'Check our FAQ page for more information.',
					'Next',
					'faq.svg',
					1
				),

				$this->tour_template(
					'upgradeTab',
					'up',
					'<h1>Upgrade or Recharge</h1>',
					'Check our cool Plans for everyone here.',
					'Next',
					'upgrade.svg',
					1
				),

				$this->tour_template(
					'feedbackButton',
					'right',
					'<h1>Any Feedback for Us?</h1>',
					'Any issues or missing features ? Let Us Know.',
					'Next',
					'help.svg',
					1
				),

				$this->tour_template(
					'helpButton',
					'right',
					'<h1>Any Queries?</h1>',
					'Click here to leave us an email.',
					'Next',
					'help.svg',
					1
				),

				$this->tour_template(
					'restart_tour_button',
					'right',
					'<h1>Thank You!</h1>',
					'Click here to Restart the Tour for current tab.',
					'Next',
					'replay.svg',
					1
				),
			);
		}

		/**This functions return the array containing the main page details
		 *
		 * @return array tab data for starting page.
		 */
		private function get_main_page_pointers() {
			return array(
				$this->tour_template(
					'',
					'',
					'<h1>WELCOME!</h1>',
					'Fasten your seat belts for a quick ride.',
					'Let\'s Go!',
					'startTour.svg',
					2
				),

				$this->tour_template(
					'tabID',
					'up',
					'<br>',
					'This is Form settings page. Enable/Disable OTP verification for your forms here.',
					'Next',
					'formSettings.svg',
					1
				),

				$this->tour_template(
					'searchForm',
					'left',
					'<br>',
					'Type here to find your Form.<br><br>',
					'Next',
					'searchForm.svg',
					1
				),

				$this->tour_template(
					'formList',
					'left',
					'<br>',
					'Select your form from the list <br><br>',
					'Next',
					'choose.svg',
					1
				),
			);
		}

		/**This functions return the array containing the otp settings page details
		 *
		 * @return array tab data for otp settings page.
		 */
		private function get_otp_starting_pointers() {
			return array(
				$this->tour_template(
					'country_code_settings',
					'left',
					'<h1>Country Code</h1>',
					'Set your default Country Code here.',
					'Next',
					'maps-and-flags.svg',
					1
				),

				$this->tour_template(
					'dropdownEnable',
					'up',
					'<br>',
					'Enable this to show country code drop down in your Form.',
					'Next',
					'drop-down-list.svg',
					1
				),

				$this->tour_template(
					'otpLengthValidity',
					'right',
					'<br>',
					'Check the links to see how to change OTP Length and Validity.',
					'Next',
					'',
					0
				),

				$this->tour_template(
					'blockedEmailList',
					'left',
					'<h1>Blocked Emails</h1>',
					'Add the email ids here to block them.',
					'Next',
					'blockedEmail.svg',
					1
				),

				$this->tour_template(
					'blockedPhoneList',
					'right',
					'<h1>Blocked Phone Numbers</h1>',
					'Add the phone numbers here to block them.',
					'Next',
					'blockPhone.svg',
					1
				),
			);
		}


		/**This functions return the gateway page pointers
		 */
		private function get_config_page_pointers() {
			$gateway_fn = GatewayFunctions::instance();
			return $gateway_fn->get_config_page_pointers();
		}


		/**This functions return the array containing the common message page details
		 *
		 * @return array tab data for common message page.
		 */
		private function get_message_pointers() {
			return array(
				$this->tour_template(
					'',
					'',
					'<h1>Configure your Messages</h1>',
					'These messages are displayed to your users. Customize it to your liking.<style>.mo-tour-content-area>img {padding:0;} .mo-tour-content{padding: 10px 25px 10px 25px;}</style>',
					'Next',
					'allMessages.svg',
					2
				),
			);
		}


		/**This functions return the array containing the design settings page details
		 *
		 * @return array tab data for design settings page.
		 */
		private function get_design_page_pointers() {
			return array(
				$this->tour_template(
					'wp-customEmailMsgEditor-editor-container',
					'left',
					'<h1>Desgin Pop-Up</h1>',
					'Design your pop-up to suit your theme, add css, js and more.',
					'Next',
					'popUp.svg',
					1
				),
				$this->tour_template(
					'defaultPreview',
					'right',
					'<h1>Preview Design</h1>',
					'Preview your Design here. Click on Preview Button to see.',
					'Next',
					'preview.svg',
					1
				),
			);
		}

		/**This functions return the array containing the addon settings page details
		 *
		 * @return array tab data for addon settings tab.
		 */
		private function get_addon_page_pointers() {
			return array(
				$this->tour_template(
					'addOnsTable',
					'right',
					'<h1>AddOns</h1>',
					'Check out our cool AddOns for WooCommerce and Ultimate Member.',
					'Next',
					'addOns.svg',
					1
				),
			);
		}
		/**This functions return the array containing the account settings page details
		 *
		 * @return array tab data for account settings page.
		 */
		private function gte_account_page_pointers() {
			return array(
				$this->tour_template(
					'check_btn',
					'right',
					'<h1>Check Licence</h1>',
					"Don't forget to check your Licence here After Upgrade.",
					'Next',
					'account.svg',
					2
				),
			);
		}
	}
}
