<?php
/**
 * Custom messages controller.
 *
 * @package miniorange-otp-verification/addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use \OTP\Addons\CustomMessage\Handler\CustomMessages;

$content           = '';
$editor_id         = 'customEmailMsgEditor';
$template_settings = array(
	'media_buttons' => false,
	'textarea_name' => 'content',
	'editor_height' => '170px',
	'wpautop'       => false,
);

$handler  = CustomMessages::instance();
$nonce    = $handler->get_nonce_value();
$post_url = admin_post_url();

require MCM_DIR . 'views/custom.php';
