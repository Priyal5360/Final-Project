<?php //phpcs:ignore -- legacy plugin
/**
 * Plugin Name: Email Verification / SMS verification / Mobile Verification
 * Plugin URI: http://miniorange.com
 * Description: Email & SMS OTP Verification for all forms. WooCommerce SMS Notification. PasswordLess Login. Custom Gateway for OTP Verification. 24/7 support.
 * Version: 4.2.1
 * Author: miniOrange
 * Author URI: http://miniorange.com
 * Text Domain: miniorange-otp-verification
 * Domain Path: /lang
 * WC requires at least: 2.0.0
 * WC tested up to: 5.6.0
 * License: MIT/Expat
 * License URI: https://docs.miniorange.com/mit-license
 *
 * @package miniorange-otp-verification
 */

use OTP\MoInit;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'MOV_PLUGIN_NAME', plugin_basename( __FILE__ ) );
$dir_name = substr( MOV_PLUGIN_NAME, 0, strpos( MOV_PLUGIN_NAME, '/' ) );
define( 'MOV_NAME', $dir_name );
require_once 'autoload.php';
MoInit::instance(); // initialize the main class.
