
<h3 class="wpc-tab-title"><?php esc_html_e('Notifications', 'wpcafe'  ); ?></h3>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="sender_email"><?php esc_html_e('Sender email address', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Mail will be sent both admin and user from this email address", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="email" class="wpc-settings-input" name="sender_email_address" id="sender_email"
            value="<?php echo esc_attr( isset($settings['sender_email_address'] ) && $settings['sender_email_address'] !== '' ? $settings['sender_email_address'] : wp_get_current_user()->data->user_email ); ?>"
            placeholder="<?php echo esc_attr(wp_get_current_user()->data->user_email) ?>" />
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_reply_to_name"><?php esc_html_e('Reply-To Name', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Set the 'reply-to' name that will be shown on email sent to user", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="text" class="wpc-settings-input" name="wpc_reply_to_name" id="wpc_reply_to_name"
            value="<?php echo esc_attr( isset($settings['wpc_reply_to_name'] ) && $settings['wpc_reply_to_name'] !== '' ? $settings['wpc_reply_to_name'] : wp_get_current_user()->data->display_name ); ?>"
            placeholder="<?php echo esc_attr(wp_get_current_user()->data->display_name)?>" />
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_email_address"><?php esc_html_e('Admin email address', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Set the admin-email address to use in email.If sender email address is not set, mail will be sent both admin and user from this address", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="email" class="wpc-settings-input" name="wpc_admin_email_address" id="wpc_admin_email_address"
            value="<?php echo esc_attr( isset($settings['wpc_admin_email_address'] )  ? $settings['wpc_admin_email_address'] : "" ); ?>" />
    </div>
</div> 
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_notification_for_booking_req"><?php esc_html_e('Admin notification for new booking', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Send email to admin when a new reservation arrives", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
    <input name="wpc_admin_notification_for_booking_req" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $allow_admin_notif_book_req == 'off' ? 'checked' : '' ); ?> />
    <input id="wpc_admin_notification_for_booking_req" type="checkbox" <?php echo esc_attr( $allow_admin_notif_book_req == 'on' ? 'checked' : '' ); ?> class="wpcafe-admin-control-input"
        name="wpc_admin_notification_for_booking_req" />
    <label for="wpc_admin_notification_for_booking_req" class="wpcafe_switch_button_label"></label>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_user_notification_for_booking_req"><?php esc_html_e('Notify user about new booking request', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Send email to user after placing a reservation successfully", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
    <input name="wpc_user_notification_for_booking_req" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $allow_user_notif_book_req == 'off' ? 'checked' : ''  ); ?>>
    <input id="wpc_user_notification_for_booking_req" type="checkbox" <?php echo esc_attr( $allow_user_notif_book_req == 'on' ? 'checked' : ''  ); ?> class="wpcafe-admin-control-input"
        name="wpc_user_notification_for_booking_req" />
        <label for="wpc_user_notification_for_booking_req" class="wpcafe_switch_button_label"></label>
    </div>
</div> 
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_user_notification_for_confirm_req"><?php esc_html_e('Notify user confirmed request', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Send email to user when admin update reservation status.", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
    <input name="wpc_user_notification_for_confirm_req" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $user_notif_confirm_book == 'off' ? 'checked' : '' ); ?>/>
    <input  id='wpc_user_notification_for_confirm_req' type="checkbox" <?php echo esc_attr( $user_notif_confirm_book == 'on' ? 'checked' : '' ); ?> class="wpcafe-admin-control-input "
        name="wpc_user_notification_for_confirm_req" disabled />
        <label for="wpc_user_notification_for_confirm_req" class="wpcafe_switch_button_label"></label>
        <span class="wpc-pro-text"><?php esc_html_e('pro version only', 'wpcafe'  ) ?></span>
    </div>
</div> 
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_notification_for_confirm_req"><?php esc_html_e('Notify admin about confirmed request', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Send email to admin when update reservation status from backend", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
    <input name="wpc_admin_notification_for_confirm_req" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $admin_notif_confirm_book =='off' ? 'checked' : '' ); ?>/>
    <input id='wpc_admin_notification_for_confirm_req'  
        type="checkbox" 
        <?php echo esc_attr( $admin_notif_confirm_book =='on' ? 'checked' : '' ); ?>
        class="wpcafe-admin-control-input "
        name="wpc_admin_notification_for_confirm_req" disabled />
        <label for="wpc_admin_notification_for_confirm_req" class="wpcafe_switch_button_label"></label>
        <span class="wpc-pro-text"><?php esc_html_e('pro version only', 'wpcafe'  ) ?></span>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_user_notification_for_cancel_req"><?php esc_html_e('Notify user about cancelled request', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Send email to user when a reservation is cancelled from admin", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
    <input name="wpc_user_notification_for_cancel_req" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $user_notif_cancel_req =='off' ? 'checked' : ''  ); ?>/>
    <input  id='wpc_user_notification_for_cancel_req' type="checkbox" 
    <?php echo esc_attr( $user_notif_cancel_req =='on' ? 'checked' : ''  ); ?> 
    class="wpcafe-admin-control-input "
        name="wpc_user_notification_for_cancel_req" disabled />
        <label for="wpc_user_notification_for_cancel_req" class="wpcafe_switch_button_label"></label>
        <span class="wpc-pro-text"><?php esc_html_e('pro version only', 'wpcafe'  ) ?></span>
    </div>
</div> 
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_cancel_notification"><?php esc_html_e('Notify admin about cancelled request', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Send email to admin when a reservation is cancelled from backend", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
    <input name="wpc_admin_cancel_notification" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $admin_notif_cancel_req =='off' ? 'checked' : ''  ); ?>/>
    <input id='wpc_admin_cancel_notification' type="checkbox"   
    <?php echo esc_attr( $admin_notif_cancel_req == 'on' ? 'checked' : ''   ); ?>
    class="wpcafe-admin-control-input"
        name="wpc_admin_cancel_notification" disabled />
        <label for="wpc_admin_cancel_notification" class="wpcafe_switch_button_label"></label>
        <span class="wpc-pro-text"><?php esc_html_e('pro version only', 'wpcafe'  ) ?></span>
    </div>
</div>  
<h3 class="wpc-tab-title"><?php esc_html_e('Notification Emails', 'wpcafe'  ); ?></h3>
<div class="wpc-label-item wpc-email-tag">
    <div class="wpc-label">
        <label for="wpc_admin_email_address"><?php esc_html_e('Template tags', 'wpcafe'  ); ?></label>

        <p class="wpc-desc"> <?php echo esc_html__('Use the following tags to automatically add booking information to the emails' , 'wpcafe' ); ?></p>
            <?php
                $tag_box = array (
                    array(
                        "tag_name" => '{user_email}',
                        "description" => esc_html__('Email of the user who made the booking' , 'wpcafe'  ),
                    ),
                    array(
                        "tag_name" => '{user_name}',
                        "description" => esc_html__('* Name of the user who made the booking' , 'wpcafe'  ),
                    ),
                    array(
                        "tag_name" => '{party}',
                        "description" => esc_html__('* Number of people booked', 'wpcafe'  ),
                    ),
                    array(
                        "tag_name" => '{date}',
                        "description" => esc_html__('* Date and time of the booking', 'wpcafe'  ),
                    ),
                    array(
                        "tag_name" => '{phone}',
                        "description" => esc_html__('Phone number if supplied with the request', 'wpcafe'  ),
                    ),
                    array(
                        "tag_name" => '{message}',
                        "description" => esc_html__('Message added to the request', 'wpcafe'  ),
                    ),
                    array(
                        "tag_name" => '{site_name}',
                        "description" => esc_html__('The name of this website', 'wpcafe'  ),
                    ),
                    array(
                        "tag_name" => '{site_link}',
                        "description" => esc_html__('A link to this website', 'wpcafe'  ),
                    ),
                    array(
                        "tag_name" => '{current_time}',
                        "description" => esc_html__('Current date and time', 'wpcafe'  ),
                    ),
            );
            foreach ($tag_box as $key => $value) { ?>
                <div class="wpc-template-tags-box">
                <strong><?php echo esc_html( $value['tag_name'] ); ?></strong> <?php echo  esc_html( $value['description'] ); ?>
                </div>
            <?php } ?> 
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_notification_subject"><?php esc_html_e('Admin new reservation email subject', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Subject of email that will be sent to admin when a new reservation occurs ", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="text" class="wpc-settings-input" name="wpc_admin_notification_subject" id="wpc_admin_notification_subject"
            value="<?php echo esc_attr( isset($settings['wpc_admin_notification_subject'] ) ? $settings['wpc_admin_notification_subject'] : ''); ?>"
            placeholder="<?php esc_html_e( 'New booking request', 'wpcafe'  ); ?>" />
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_notification_email"><?php esc_html_e('Admin new reservation email body', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Body of email that will be sent to admin when a new reservation occurs ", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <?php wp_editor( html_entity_decode( isset( $settings['wpc_admin_notification_email'] ) ? $settings['wpc_admin_notification_email'] : "" ) , 
        'wpc_admin_notification_email', array('textarea_name'=>'wpc_admin_notification_email','media_buttons' => false ) ); ?> 
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_new_req_email_subject"><?php esc_html_e('New request email subject to user', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Subject of email that will be sent to user when a new reservation occurs ", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="text" class="wpc-settings-input" name="wpc_new_req_email_subject" id="wpc_new_req_email_subject"
            value="<?php echo esc_attr( isset($settings['wpc_new_req_email_subject'] ) ? $settings['wpc_new_req_email_subject'] : ''); ?>"
            placeholder="<?php esc_html_e( 'New booking request subject' , 'wpcafe'  );?>" />
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_new_req_email"><?php esc_html_e('User new booking request email body', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Body of email that will be sent to user when a new reservation occurs ",  'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <?php wp_editor( html_entity_decode( isset( $settings['wpc_new_req_email'] ) ? $settings['wpc_new_req_email'] : "" ), 
        'wpc_new_req_email',  array('textarea_name'=>'wpc_new_req_email','media_buttons' => false) ); ?> 
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_booking_confirm_subject"><?php esc_html_e('Admin reservation confirm email subject', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Subject of email that will be sent to admin when a reservation is confirmed ",  'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="text" name="wpc_admin_booking_confirm_subject" class="wpc-settings-input" id="wpc_admin_booking_confirm_subject"
            value="<?php echo esc_attr( isset($settings['wpc_admin_booking_confirm_subject'] ) ? $settings['wpc_admin_booking_confirm_subject'] : ''); ?>"
            placeholder="<?php echo esc_html__("New booking confirmed", "wpcafe");?>" disabled/>
            <span class="wpc-pro-text"><?php esc_html_e('Pro version only', 'wpcafe' ); ?></span>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_booking_confirm_email"><?php esc_html_e('Admin reservation confirm email body', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Body of email that will be sent to admin when a reservation is confirmed ",  'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <?php wp_editor( html_entity_decode( isset( $settings['wpc_admin_booking_confirm_email'] ) ? $settings['wpc_admin_booking_confirm_email'] : "" ), 
        'wpc_admin_booking_confirm_email', array('textarea_name'=>'wpc_admin_booking_confirm_email','media_buttons' => false) ); ?> 
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_booking_cancel_subject"><?php esc_html_e('Admin booking cancelled Subject', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Subject of email that will be sent to admin when a reservation is cancelled ",  'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="text" name="wpc_admin_booking_cancel_subject" class="wpc-settings-input" id="wpc_admin_booking_cancel_subject"
            value="<?php echo esc_attr( isset($settings['wpc_admin_booking_cancel_subject'] ) ? $settings['wpc_admin_booking_cancel_subject'] : ''); ?>"
            placeholder="<?php esc_html_e("Reservation request cancelled", 'wpcafe'  )?>" disabled/>
            <span class="wpc-pro-text"><?php esc_html_e('Pro version only', 'wpcafe' ); ?></span>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_admin_booking_cancel_email"><?php esc_html_e('Admin booking cancelled email', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Body of email that will be sent to admin when a reservation is cancelled ", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <?php wp_editor( html_entity_decode( isset( $settings['wpc_admin_booking_cancel_email'] ) ? $settings['wpc_admin_booking_cancel_email'] : "" ), 
        'wpc_admin_booking_cancel_email', array('textarea_name'=>'wpc_admin_booking_cancel_email', 'media_buttons' => false
        ) ); ?> 
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_confirm_email_subject"><?php esc_html_e('User confirmed email subject', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Subject of email that will be sent to user when reservation is confirmed ", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="text" class="wpc-settings-input" name="wpc_confirm_email_subject" id="wpc_confirm_email_subject"
            value="<?php echo esc_attr( isset($settings['wpc_confirm_email_subject'] ) ? $settings['wpc_confirm_email_subject'] : ''); ?>"
            placeholder="<?php esc_html_e("Confirm email subject", 'wpcafe'  ); ?>" disabled/>
            <span class="wpc-pro-text"><?php esc_html_e('Pro version only', 'wpcafe' ); ?></span>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_confirm_email"><?php esc_html_e('User confirmed email', 'wpcafe'   ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Body of email that will be sent to user when reservation is confirmed ", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <?php wp_editor( html_entity_decode( isset( $settings['wpc_confirm_email'] ) ? $settings['wpc_confirm_email'] : "" ), 
        'wpc_confirm_email',  array('textarea_name'=>'wpc_confirm_email','media_buttons' => false) ); ?> 
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_rejected_email_subject"><?php esc_html_e('User cancelled email subject', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Subject of email that will be sent to user when a reservation is cancelled ", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <input type="text" class="wpc-settings-input" name="wpc_rejected_email_subject" id="wpc_rejected_email_subject"
            value="<?php echo esc_attr( isset($settings['wpc_rejected_email_subject'] ) ? $settings['wpc_rejected_email_subject'] : ''); ?>"
            placeholder="<?php esc_html_e("Rejected email subject", 'wpcafe'  )?>" disabled/>
        <span class="wpc-pro-text"><?php esc_html_e('Pro version only', 'wpcafe' ); ?></span>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_rejected_email"><?php esc_html_e('User cancelled email', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Body of email that will be sent to user when a reservation is cancelled ", 'wpcafe'  ); ?> </div>
    </div>
    <div class="wpc-meta">
        <?php wp_editor( html_entity_decode( isset( $settings['wpc_rejected_email'] ) ? $settings['wpc_rejected_email'] : "" ), 
        'wpc_rejected_email',  array('textarea_name'=>'wpc_rejected_email','media_buttons' => false) ); ?> 
    </div>
</div>
