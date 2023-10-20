<?php
/**
 * Load admin view for Elementor pro free form.
 *
 * @package miniorange-otp-verification/handler
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


echo '<div class="text-center"><strong>' . wp_kses(
	$form_name,
	array(
		'b'    => array(),
		'span' => array(
			'style' => array(),
		),
	)
) . '</strong><b><span style="color:red"> ' . esc_html( ( '[Premium Feature]' ) ) . '</span></b></div>';


echo '<div class="mo_otp_note">
						' . esc_html( mo_( 'The ' ) ) . '<b>' . esc_html( mo_( $form_name ) ) . '</b>' . esc_html( mo_( ' plugin has been separately integrated to provide users with Phone verification or Email Verification via OTP on the forms created by it.' ) ) . '<br>' . esc_html( mo_( 'To get access to this' ) ) . '<b>' . esc_html( mo_( ' Premium Feature ' ) ) . '</b>' . esc_html( mo_( ' please kindly contact us at ' ) ) . wp_kses(
	'<a style="cursor:pointer;" onClick="otpSupportOnClick();"><u> otpsupport@xecurify.com</u></a></div>',
	array(
		'a' => array(
			'style'   => array(),
			'onclick' => array(),
		),
		'u' => array(),
	)
);
