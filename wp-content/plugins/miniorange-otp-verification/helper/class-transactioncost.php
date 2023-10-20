<?php
/**
 * Contains List of countries to be shown in dropdown.
 * Contains functions for getting country list for dropdown and whatsapp pricing
 *
 * @package miniorange-validaition-settings
 */

namespace OTP\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use OTP\Traits\Instance;

/**
 * This class lists down all the countries and their country code.
 * It also lists down a few country code related functions.
 */
if ( ! class_exists( 'TransactionCost' ) ) {
	/**
	 * CountryList class
	 */
	class TransactionCost {

		use Instance;
		/**Constructor
		 **/
		protected function __construct() {
			add_action( 'wp_ajax_wa_miniorange_check_pricing', array( $this, 'check_whatsapp_pricing' ) );
		}

		/**
		 * Function for checking the whatsapp pricing.
		 */
		public function check_whatsapp_pricing() {
			if ( ! check_ajax_referer( 'whatsappnonce', 'security', false ) ) {
				return;
			}
			$target_country = isset( $_POST['target_country'] ) ? sanitize_text_field( wp_unslash( $_POST['target_country'] ) ) : '';

			$whatsapp_pricing_response = $this->mo_wa_check_pricing( $target_country );
			echo wp_json_encode( $whatsapp_pricing_response );
			die();
		}

		/**
		 * Check the whatsapp pricing for a particular target country.
		 *
		 * @param string $target_country - target country.
		 * @return array
		 */
		public function mo_wa_check_pricing( $target_country ) {
			$content = $this->check_transaction_cost( $target_country );
			return $content;
		}

		/**Country List
		 *
		 * @var $countries
		 */
		public static $countries = array(
			array(
				'name'         => 'All Countries',
				'alphacode'    => '',
				'countryCode'  => '',
				'whatsappcost' => array(
					'100'   => '25',
					'500'   => '89',
					'1000'  => '169',
					'5000'  => '768',
					'10000' => '1518',
					'50000' => '7475',
				),
			),
			array(
				'name'         => 'North America',
				'whatsappcost' => array(
					'100'   => '3',
					'500'   => '9',
					'1000'  => '17',
					'5000'  => '75',
					'10000' => '150',
					'50000' => '740',
				),
			),
			array(
				'name'         => 'Rest of Africa',
				'whatsappcost' => array(
					'100'   => '13',
					'500'   => '63',
					'1000'  => '124',
					'5000'  => '612',
					'10000' => '1215',
					'50000' => '6050',
				),
			),
			array(
				'name'         => 'Rest of Asia Pacific',
				'whatsappcost' => array(
					'100'   => '9',
					'500'   => '42',
					'1000'  => '83',
					'5000'  => '410',
					'10000' => '821',
					'50000' => '4101',
				),
			),
			array(
				'name'         => 'Rest of Central & Eastern Europe',
				'whatsappcost' => array(
					'100'   => '10',
					'500'   => '46',
					'1000'  => '91',
					'5000'  => '438',
					'10000' => '865',
					'50000' => '4220',
				),
			),
			array(
				'name'         => 'Rest of Latin America',
				'whatsappcost' => array(
					'100'   => '8',
					'500'   => '37',
					'1000'  => '72',
					'5000'  => '355',
					'10000' => '710',
					'50000' => '3535',
				),
			),
			array(
				'name'         => 'Rest of Middle East',
				'whatsappcost' => array(
					'100'   => '9',
					'500'   => '41',
					'1000'  => '81',
					'5000'  => '389',
					'10000' => '767',
					'50000' => '3680',
				),
			),
			array(
				'name'         => 'Rest of Western Europe',
				'whatsappcost' => array(
					'100'   => '15',
					'500'   => '71',
					'1000'  => '139',
					'5000'  => '682',
					'10000' => '1357',
					'50000' => '6670',
				),
			),
			array(
				'name'         => 'Argentina',
				'alphacode'    => 'ar',
				'countryCode'  => '+54',
				'whatsappcost' => array(
					'100'   => '8',
					'500'   => '37',
					'1000'  => '70',
					'5000'  => '340',
					'10000' => '665',
					'50000' => '3300',
				),
			),
			array(
				'name'         => 'Brazil (Brasil)',
				'alphacode'    => 'br',
				'countryCode'  => '+55',
				'whatsappcost' => array(
					'100'   => '8',
					'500'   => '33',
					'1000'  => '63',
					'5000'  => '275',
					'10000' => '533',
					'50000' => '2550',
				),
			),
			array(
				'name'         => 'Chile',
				'alphacode'    => 'cl',
				'countryCode'  => '+56',
				'whatsappcost' => array(
					'100'   => '10',
					'500'   => '42',
					'1000'  => '83',
					'5000'  => '399',
					'10000' => '787',
					'50000' => '3830',
				),
			),
			array(
				'name'         => 'Colombia',
				'alphacode'    => 'co',
				'countryCode'  => '+57',
				'whatsappcost' => array(
					'100'   => '3',
					'500'   => '10',
					'1000'  => '17',
					'5000'  => '70',
					'10000' => '130',
					'50000' => '545',
				),
			),
			array(
				'name'         => 'Egypt (‫مصر‬‎)',
				'alphacode'    => 'eg',
				'countryCode'  => '+20',
				'whatsappcost' => array(
					'100'   => '13',
					'500'   => '58',
					'1000'  => '114',
					'5000'  => '557',
					'10000' => '1103',
					'50000' => '5410',
				),

			),
			array(
				'name'         => 'France',
				'alphacode'    => 'fr',
				'countryCode'  => '+33',
				'whatsappcost' => array(
					'100'   => '16',
					'500'   => '76',
					'1000'  => '150',
					'5000'  => '736',
					'10000' => '1462',
					'50000' => '7205',
				),
			),
			array(
				'name'         => 'Germany (Deutschland)',
				'alphacode'    => 'de',
				'countryCode'  => '+49',
				'whatsappcost' => array(
					'100'   => '16',
					'500'   => '73',
					'1000'  => '144',
					'5000'  => '703',
					'10000' => '1395',
					'50000' => '6870',
				),
			),
			array(
				'name'         => 'India (भारत)',
				'alphacode'    => 'in',
				'countryCode'  => '+91',
				'whatsappcost' => array(
					'100'   => '3',
					'500'   => '8',
					'1000'  => '14',
					'5000'  => '53',
					'10000' => '96',
					'50000' => '375',
				),
			),
			array(
				'name'         => 'Indonesia',
				'alphacode'    => 'id',
				'countryCode'  => '+62',
				'whatsappcost' => array(
					'100'   => '4',
					'500'   => '16',
					'1000'  => '32',
					'5000'  => '160',
					'10000' => '318',
					'50000' => '1582',
				),
			),
			array(
				'name'         => 'Israel (‫ישראל‬‎)',
				'alphacode'    => 'il',
				'countryCode'  => '+972',
				'whatsappcost' => array(
					'100'   => '5',
					'500'   => '20',
					'1000'  => '37',
					'5000'  => '170',
					'10000' => '330',
					'50000' => '1545',
				),
			),
			array(
				'name'         => 'Italy (Italia)',
				'alphacode'    => 'it',
				'countryCode'  => '+39',
				'whatsappcost' => array(
					'100'   => '8',
					'500'   => '37',
					'1000'  => '71',
					'5000'  => '342',
					'10000' => '673',
					'50000' => '3260',
				),
			),
			array(
				'name'         => 'Kazakhstan (Казахстан)',
				'alphacode'    => 'kz',
				'countryCode'  => '+7',
				'whatsappcost' => array(
					'100'   => '8',
					'500'   => '38',
					'1000'  => '75',
					'5000'  => '373',
					'10000' => '746',
					'50000' => '3728',
				),
			),
			array(
				'name'         => 'Malaysia',
				'alphacode'    => 'my',
				'countryCode'  => '+60',
				'whatsappcost' => array(
					'100'   => '10',
					'500'   => '45',
					'1000'  => '78',
					'5000'  => '375',
					'10000' => '746',
					'50000' => '3720',
				),
			),
			array(
				'name'         => 'Mexico (México)',
				'alphacode'    => 'mx',
				'countryCode'  => '+52',
				'whatsappcost' => array(
					'100'   => '5',
					'500'   => '22',
					'1000'  => '42',
					'5000'  => '195',
					'10000' => '379',
					'50000' => '1790',
				),
			),
			array(
				'name'         => 'Netherlands (Nederland)',
				'alphacode'    => 'nl',
				'countryCode'  => '+31',
				'whatsappcost' => array(
					'100'   => '17',
					'500'   => '79',
					'1000'  => '156',
					'5000'  => '763',
					'10000' => '1515',
					'50000' => '7470',
				),
			),
			array(
				'name'         => 'Nigeria',
				'alphacode'    => 'ng',
				'countryCode'  => '+234',
				'whatsappcost' => array(
					'100'   => '7',
					'500'   => '30',
					'1000'  => '59',
					'5000'  => '278',
					'10000' => '546',
					'50000' => '2625',
				),
			),
			array(
				'name'         => 'Pakistan (‫پاکستان‬‎)',
				'alphacode'    => 'pk',
				'countryCode'  => '+92',
				'whatsappcost' => array(
					'100'   => '7',
					'500'   => '28',
					'1000'  => '54',
					'5000'  => '257',
					'10000' => '503',
					'50000' => '2410',
				),
			),
			array(
				'name'         => 'Peru (Perú)',
				'alphacode'    => 'pe',
				'countryCode'  => '+51',
				'whatsappcost' => array(
					'100'   => '8',
					'500'   => '34',
					'1000'  => '67',
					'5000'  => '319',
					'10000' => '628',
					'50000' => '3035',
				),
			),
			array(
				'name'         => 'Russia (Россия)',
				'alphacode'    => 'ru',
				'countryCode'  => '+7',
				'whatsappcost' => array(
					'100'   => '9',
					'500'   => '38',
					'1000'  => '73',
					'5000'  => '352',
					'10000' => '693',
					'50000' => '3360',
				),
			),
			array(
				'name'         => 'Saudi Arabia (‫المملكة العربية السعودية‬‎)',
				'alphacode'    => 'sa',
				'countryCode'  => '+966',
				'whatsappcost' => array(
					'100'   => '5',
					'500'   => '21',
					'1000'  => '40',
					'5000'  => '183',
					'10000' => '355',
					'50000' => '1670',
				),
			),
			array(
				'name'         => 'South Africa',
				'alphacode'    => 'za',
				'countryCode'  => '+27',
				'whatsappcost' => array(
					'100'   => '5',
					'500'   => '19',
					'1000'  => '35',
					'5000'  => '160',
					'10000' => '310',
					'50000' => '1445',
				),
			),
			array(
				'name'         => 'Spain (España)',
				'alphacode'    => 'es',
				'countryCode'  => '+34',
				'whatsappcost' => array(
					'100'   => '8',
					'500'   => '35',
					'1000'  => '69',
					'5000'  => '328',
					'10000' => '645',
					'50000' => '3120',
				),
			),
			array(
				'name'         => 'Turkey (Türkiye)',
				'alphacode'    => 'tr',
				'countryCode'  => '+90',
				'whatsappcost' => array(
					'100'   => '3',
					'500'   => '10',
					'1000'  => '17',
					'5000'  => '70',
					'10000' => '130',
					'50000' => '545',
				),
			),
			array(
				'name'         => 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)',
				'alphacode'    => 'ae',
				'countryCode'  => '+971',
				'whatsappcost' => array(
					'100'   => '5',
					'500'   => '20',
					'1000'  => '39',
					'5000'  => '178',
					'10000' => '346',
					'50000' => '1625',
				),
			),
			array(
				'name'         => 'United Kingdom',
				'alphacode'    => 'gb',
				'countryCode'  => '+44',
				'whatsappcost' => array(
					'100'   => '9',
					'500'   => '40',
					'1000'  => '70',
					'5000'  => '340',
					'10000' => '660',
					'50000' => '3275',
				),
			),
		);

		/**
		 * Function for selected countries.
		 */
		public static function get_only_country_list() {
			$country_list = array();
			foreach ( self::$countries as $country ) {
				if ( $country['name'] ) {
					array_push( $country_list, $country['name'] );
				}
			}
			return $country_list;
		}

		/**
		 * Function to check the whatsapp pricing for the target country.
		 *
		 * @param string $target_country - target country.
		 */
		public static function check_transaction_cost( $target_country ) {
			foreach ( self::$countries as $country ) {
				if ( $country['name'] === $target_country ) {
					return $country['whatsappcost'];
				}
			}
		}
	}
}
