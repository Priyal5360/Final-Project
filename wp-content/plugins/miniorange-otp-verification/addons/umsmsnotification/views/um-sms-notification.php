<?php
/**
 * Load admin view for Ultimate Member SMS Notification.
 *
 * @package miniorange-otp-verification/umsmsnotification/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationUtility;

echo '	<div class="mo_registration_divided_layout mo-otp-full">
				<div class="mo_registration_table_layout mo-otp-center">';

				UltimateMemberSMSNotificationUtility::is_addon_activated();

echo '			<table style="width:100%">
						<form name="f" method="post" action="" id="mo_um_sms_notif_settings">
							<input type="hidden" name="option" value="mo_um_sms_notif_settings" />
							<tr>
								<td>
									<h2>' . esc_html( mo_( 'ULTIMATE MEMBER NOTIFICATION SETTINGS' ) ) . '
                                        <span style="float:right;margin-top:-10px;">
                                            <a href="' . esc_url( $addon ) . '" id="goBack" class="button button-primary button-large">' . esc_html( mo_( 'Go Back' ) ) . '</a>
                                        </span>
									</h2>
									<hr>
								</td>
							</tr>
							<tr>
								<td>' . esc_html( mo_( 'SMS notifications sent from Ultimate Member are listed below. Click on one to configure it.' ) ) . '</td>
							</tr>
							<tr>
								<table class="umsn-table-list" cellspacing="0">
									<thead>
										<tr>
											<th class="umsn-table-list-status" style="width:15px;">Enabled</th>
											<th class="umsn-table-list-name">SMS Type</th>
											<th class="umsn-table-list-recipient">Recipient</th>
											<th class="umsn-table-list-actions"></th>						
										</tr>
									</thead>
									<tbody>';

									show_notifications_table( $notification_settings );

echo '							</tbody>
								</table>
							</tr>
						</form>	
					</table>
				</div>
			</div>';
