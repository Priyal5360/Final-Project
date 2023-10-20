<?php
/**
 * Defines addon constants and prefix functions.
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'UMPR_DIR', plugin_dir_path( __FILE__ ) );
define( 'UMPR_URL', plugin_dir_url( __FILE__ ) );
define( 'UMPR_VERSION', '1.0.0' );
define( 'UMPR_CSS_URL', UMPR_URL . 'includes/css/settings.min.css?version=' . UMPR_VERSION );

/*
|------------------------------------------------------------------------------------------------------
| SOME COMMON FUNCTIONS USED ALL OVER THE ADD-ON
|------------------------------------------------------------------------------------------------------
 */


/**
 * This function is used to handle the add-ons get option call. A separate function has been created so that
 * we can manage getting of database values all from one place. Any changes need to be made can be made here
 * rather than having to make changes in all of the add-on files.
 *
 * Calls the mains plugins get_mo_option function.
 *
 * @param string $string Option name.
 * @param bool   $prefix define prefix.
 * @return String
 */
function get_umpr_option( $string, $prefix = null ) {
	$string = ( null === $prefix ? 'mo_um_pr_' : $prefix ) . $string;
	return get_mo_option( $string, '' );
}


/**
 * This function is used to handle the add-ons update option call. A separate function has been created so that
 * we can manage getting of database values all from one place. Any changes need to be made can be made here
 * rather than having to make changes in all of the add-on files.
 *
 * Calls the mains plugins get_mo_option function.
 *
 * @param string $option_name for option values.
 * @param string $value to get values.
 * @param null   $prefix option prefix.
 */
function update_umpr_option( $option_name, $value, $prefix = null ) {
	$option_name = ( null === $prefix ? 'mo_um_pr_' : $prefix ) . $option_name;
	update_mo_option( $option_name, $value, '' );
}

