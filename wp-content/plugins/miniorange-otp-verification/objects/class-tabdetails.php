<?php
/**Load Interface TabDetails
 *
 * @package miniorange-otp-verification/objects
 */

namespace OTP\Objects;

use OTP\Helper\MoUtility;
use OTP\Traits\Instance;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'TabDetails' ) ) {
	/**
	 * This class is used to define the Tab details interface functions taht needs to be implementated
	 */
	final class TabDetails {

		use Instance;

		/**
		 * Array of PluginPageDetails Object detailing
		 * all the page menu options.
		 *
		 * @var array[PluginPageDetails] $tab_details
		 */
		public $tab_details;

		/**
		 * The parent menu slug
		 *
		 * @var string $_parentSlug
		 */
		public $parent_slug;

		/** Private constructor to avoid direct object creation */
		private function __construct() {
			$registered        = MoUtility::micr();
			$this->parent_slug = 'mosettings';
			$url               = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
			$request_uri       = remove_query_arg( 'addon', $url );

			$this->tab_details = array(
				Tabs::ACCOUNT          => new PluginPageDetails(
					'OTP Verification - Accounts',
					'otpaccount',
					! $registered ? 'Account Setup' : 'User Profile',
					! $registered ? 'Account Setup' : 'Profile',
					$request_uri,
					'account.php',
					'account',
					'',
					false
				),
				Tabs::FORMS            => new PluginPageDetails(
					'OTP Verification - Forms',
					$this->parent_slug,
					mo_( 'Forms' ),
					mo_( 'Forms' ),
					$request_uri,
					'settings.php',
					'tabID',
					'background:#D8D8D8'
				),
				Tabs::OTP_SETTINGS     => new PluginPageDetails(
					'OTP Verification - OTP Settings',
					'otpsettings',
					mo_( 'OTP Settings' ),
					mo_( 'OTP Settings' ),
					$request_uri,
					'otpsettings.php',
					'otpSettingsTab',
					'background:#D8D8D8'
				),
				Tabs::SMS_EMAIL_CONFIG => new PluginPageDetails(
					'OTP Verification - SMS & Email',
					'moconfig',
					mo_( 'SMS/Email Config' ),
					mo_( 'SMS/Email Config' ),
					$request_uri,
					'configuration.php',
					'emailSmsTemplate',
					'background:#D8D8D8'
				),
				Tabs::MESSAGES         => new PluginPageDetails(
					'OTP Verification - Messages',
					'momessages',
					mo_( 'Common Messages' ),
					mo_( 'Common Messages' ),
					$request_uri,
					'messages.php',
					'messagesTab',
					'background:#D8D8D8'
				),
				Tabs::DESIGN           => new PluginPageDetails(
					'OTP Verification - Design',
					'modesign',
					mo_( 'Pop-Up Design' ),
					mo_( 'Pop-Up Design' ),
					$request_uri,
					'design.php',
					'popDesignTab',
					'background:#D8D8D8'
				),
				Tabs::CONTACT_US       => new PluginPageDetails(
					'OTP Verification - Contact Us',
					'contactus',
					'Contact Us',
					mo_( 'Contact Us' ),
					$request_uri,
					'contactus.php',
					'contactusTab',
					'',
					false
				),
				Tabs::CUSTOMIZATION    => new PluginPageDetails(
					'OTP Verification - Custom Work',
					'customwork',
					'Need Custom Work?',
					mo_( 'Need Custom Work?' ),
					$request_uri,
					'customwork.php',
					'contactusTab',
					'',
					false
				),
				Tabs::PRICING          => new PluginPageDetails(
					'OTP Verification - License',
					'mootppricing',
					"<span style='color:orange;font-weight:bold'>" . mo_( 'Licensing Plans' ) . '</span>',
					mo_( 'Licensing Plans' ),
					$request_uri,
					'pricing.php',
					'upgradeTab',
					'background:#D8D8D8',
					false
				),
				Tabs::ADD_ONS          => new PluginPageDetails(
					'OTP Verification - Add Ons',
					'addon',
					"<span style='color:orange;font-weight:bold'>" . mo_( 'AddOns' ) . '</span>',
					mo_( 'AddOns' ),
					$request_uri,
					'add-on.php',
					'addOnsTab',
					'background:orange'
				),
				Tabs::REPORTING        => new PluginPageDetails(
					'OTP Verification - Reporting',
					'moreporting',
					"<span style='color:#84cc1e;font-weight:bold'>" . mo_( 'Transaction Report' ) . '</span>',
					mo_( 'Transaction Report' ),
					$request_uri,
					'moreport.php',
					'reportTab',
					'background:#d4e21ee0'
				),
				Tabs::CUSTOM_FORM      => new PluginPageDetails(
					'OTP Verification - Customization',
					'customization',
					"<span style='color:#84cc1e;font-weight:bold'>" . mo_( 'Do It Yourself' ) . '</span>',
					mo_( 'Do It Yourself' ),
					$request_uri,
					'customform.php',
					'customTab',
					'background:#a2ec3b',
					false
				),
				Tabs::WHATSAPP         => new PluginPageDetails(
					'OTP Verification - WhatsApp',
					'mowhatsapp',
					"<span style='color:#84cc1e;font-weight:bold'>" . mo_( 'WhatsApp' ) . '</span>',
					mo_( 'WhatsApp' ),
					$request_uri,
					'mowhatsapp.php',
					'WhatsAppTab',
					'background:#a2ec3b'
				),
			);
		}
	}
}
