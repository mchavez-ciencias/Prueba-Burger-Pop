<h3 class="wpc-tab-title"><?php esc_html_e('General Options', 'wpcafe'  ); ?></h3>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="reservation_form_display_page"><?php esc_html_e('Display pages', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Display reservation form only in the selected page", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
        <select disabled id="reservation_form_display_page" class="wpc-settings-input" name="wpc_reservation_form_display_page">
            <option><?php echo esc_html__("Select a page",'wpcafe' )?></option>
            <?php
                foreach ( get_pages() as $key => $value ) { ?>
                <option <?php selected( $wpc_reservation_form_display_page , $value->ID , true ); ?> value='<?php echo esc_attr($value->ID); ?>'> <?php echo esc_html( $value->post_title ); ?> </option>
            <?php }
            ?>
        </select>
        <span class="wpc-pro-text"> <?php esc_html_e('pro version only', 'wpcafe'  ); ?></span>
    </div>
</div>
<?php
    // render key settings
    if( !empty( $get_data['key_options']) && file_exists( $get_data['key_options'] )){
        require_once $get_data['key_options'] ;
    }
?>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_default_gest_no"><?php esc_html_e('Automatically confirmed guest no', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e('Confirmed a reservation if no. of guests is the selected number. This no. must be between minimum and maximum guest no.', 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
        <select id="wpc_default_gest_no" class="wpc-settings-input mb-2" name="wpc_default_gest_no">
            <option value=""><?php echo esc_html__("Select no. of guests",  'wpcafe'  )?></option>
            <?php
            $wpc_no_range  = !empty( $get_data['capacity']) ? $get_data['capacity'] : 20 ;
            
            $default_geust_no = isset( $settings['wpc_default_gest_no'] ) && $settings['wpc_default_gest_no'] !== '' ? $settings['wpc_default_gest_no'] : 1;
            for( $i = 1 ; $i <= $wpc_no_range ; $i++ ) { ?>
                <option <?php selected( $default_geust_no , $i , true ); ?> value='<?php echo esc_attr($i); ?>'><?php echo esc_html( $i ); ?></option>
            <?php } ?>
        </select>
        <div class="wpc-row default_error hide_field wpc-default-guest-message"><?php echo esc_html__('This value must be in between ', "wpcafe")?><b><?php echo esc_html__('Minimum', "wpcafe")?></b> &amp; <b><?php echo esc_html__('Maximum', "wpcafe")?></b> <?php echo esc_html__(' guest no.', "wpcafe")?></div>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_min_guest_no"><?php esc_html_e('Minimum guest number', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("No. of minimum allowed guest for a single reservation", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
        <select id="wpc_min_guest_no" class="wpc-settings-input mb-2" name="wpc_min_guest_no">
            <option value=""><?php echo esc_html__("Select no. of guests",  'wpcafe'  )?></option>
            <?php
            $min_geust_no = isset( $settings['wpc_min_guest_no'] ) && $settings['wpc_min_guest_no'] !== '' ? $settings['wpc_min_guest_no'] : 1;
            for( $i = 1 ; $i <= $wpc_no_range ; $i++ ) { ?>
                <option <?php selected( $min_geust_no , $i , true ); ?> value='<?php echo esc_attr($i); ?>'> <?php echo esc_html( $i ); ?> </option>
            <?php }
            ?>
        </select>
        <div class="wpc-row min_error hide_field wpc-default-guest-message"><b><?php echo esc_html__('Minimum','wpcafe')?></b><?php echo esc_html__(' guest number must be less than ','wpcafe')?><b><?php echo esc_html__('Maximum','wpcafe')?></b> <?php echo esc_html__('guest number','wpcafe')?></div>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_max_guest_no"><?php esc_html_e('Maximum guest number', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("No. of maximum allowed guest for a single reservation", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
        <select id="wpc_max_guest_no" class="wpc-settings-input mb-2" name="wpc_max_guest_no">
        <option value=""><?php echo esc_html__("Select no. of guests",  'wpcafe'  )?></option>
            <?php
            $max_geust_no = isset( $settings['wpc_max_guest_no'] ) && $settings['wpc_max_guest_no'] !== '' ? $settings['wpc_max_guest_no'] : $wpc_no_range;
            for( $i = 1 ; $i <= $wpc_no_range ; $i++ ) { ?>
                <option <?php selected( $max_geust_no , $i  ); ?> value='<?php echo esc_attr($i); ?>'> <?php echo esc_html( $i ); ?> </option>
            <?php } ?>
        </select>
        <div class="wpc-row max_error hide_field wpc-default-guest-message"><b><?php echo esc_html__('Maximum','wpcafe')?></b> <?php echo esc_html__('guest number must be grater than ','wpcafe')?><b><?php echo esc_html__('Minimum','wpcafe')?></b> <?php echo esc_html__('guest number','wpcafe')?></div>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_allow_cancellation"><?php esc_html_e('Allow Cancellations', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Allow user to cancelled reservation through cancellation form", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
        <input name="wpc_allow_cancellation" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $wpc_checked_allow_cancellation == 'off' ? 'checked' : ''  ); ?> />
        <input id='wpc_allow_cancellation' type="checkbox" <?php echo esc_attr( $wpc_checked_allow_cancellation == 'on' ? 'checked' : ''  ); ?> class="wpcafe-admin-control-input"
        name="wpc_allow_cancellation"/>
        <label for="wpc_allow_cancellation" class="wpcafe_switch_button_label"></label>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="require_phone"><?php esc_html_e('Require phone', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Make phone / contact no. required while placing reservation", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
    <input id='require_phone' type="checkbox" 
        <?php echo esc_attr( $checked_require_phone ); ?> 
        class="wpcafe-admin-control-input "
        name="wpc_require_phone" />
        <label for="require_phone" class="wpcafe_switch_button_label"></label>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="pending_message"><?php esc_html_e('Pending message', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Message which will be shown when a user successfully places a reservation", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
        <textarea id="pending_message" class="wpc-settings-input wpc-msg-box" name="wpc_pending_message" rows="7" cols="30"><?php echo esc_html( $wpc_pending_message );?></textarea>    
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="confirm_message"><?php esc_html_e('Reservation confirmed message', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Message which will be shown when a user's reservation is confirmed", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
        <textarea id="confirm_message" class="wpc-settings-input wpc-msg-box" name="wpc_booking_confirmed_message" rows="7" cols="30"><?php echo esc_html( $wpc_booking_confirmed_message ) ?></textarea>    
    </div>
</div>

<h3 class="wpc-tab-title"><?php esc_html_e('Booking Form', 'wpcafe'  ); ?></h3> 
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="reserv_form_local"><?php esc_html_e('Calendar language', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Translate reservation form , order type (Delivery/Pickup) day and month name", 'wpcafe' ); ?> </div>
    </div>
    <div class="wpc-meta">
        <select id="reserv_form_local" name="reserv_form_local" class="wpc-settings-input">
            <?php
            $reserv_form_local = isset( $settings["reserv_form_local"] )?  $settings["reserv_form_local"] : "en";
            
            $lang_arr = ['en'=>esc_html__('English','wpcafe'), 'ru'=>esc_html__('Russian','wpcafe') ,
            'ar'=> esc_html__('Arabic','wpcafe') ,'es'=> esc_html__('Spanish','wpcafe'),
            'de' => esc_html__('German','wpcafe'),'ja' => esc_html__('Japanese','wpcafe') ];

            foreach ( $lang_arr as $key => $value ) { ?>
                <option <?php selected( $reserv_form_local, $key, true ); ?> value='<?php echo esc_attr( $key ); ?>'> <?php echo esc_html( $value ); ?> </option>
            <?php }
            ?>
        </select>
    </div>
</div> 
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_date_format"><?php esc_html_e('Date format', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Reservation and order type (Delivery/Pickup) date format", 'wpcafe' ); ?> </div>
    </div>
    <div class="wpc-meta">
        <select id="wpc_date_format" name="wpc_date_format" class="wpc-settings-input">
            <?php
            $selected_date_format = !empty( $settings["wpc_date_format"] ) ? $settings["wpc_date_format"] : "";
            foreach ( $date_options as $key => $date_option ) { ?>
                <option <?php selected( $selected_date_format, $key, true); ?> value='<?php echo esc_attr( $key ); ?>'> <?php echo esc_html( $date_option ); ?> </option>
            <?php }
            ?>
        </select>
    </div>
</div>  
<?php
$selected_time_format = !empty( $settings['wpc_time_format'] ) ? $settings['wpc_time_format'] : "";
?>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_time_format"><?php esc_html_e('Time format', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Reservation and order type (Delivery/Pickup) time format", 'wpcafe' ); ?> </div>
    </div>
    <div class="wpc-meta">
        <select id="wpc_time_format" name="wpc_time_format" class="wpc-settings-input">
            <option value="24" <?php selected($selected_time_format, '24', true); ?>><?php echo esc_html('24h'); ?></option>
            <option value="12" <?php selected($selected_time_format, '12', true); ?>><?php echo esc_html('12h'); ?></option>
        </select>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="reserv_message"><?php esc_html_e('Reservation form message', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e(" When there is no reservation schedule display message.", 'wpcafe' ); ?> </div>
    </div>
    <div class="wpc-meta">
        <textarea id="confirm_message" class="wpc-settings-input wpc-msg-box" name="reserve_dynamic_message" rows="7" cols="30"><?php echo esc_html( $reserve_dynamic_message ) ?></textarea>    
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_allow_cancellation"><?php esc_html_e("Show branch", "wpcafe"  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Show branches in reservation form", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
        <input id="show_branches" type="checkbox" <?php echo esc_attr( $show_branches ); ?> class="wpcafe-admin-control-input"
        name="show_branches"/>
        <label for="show_branches" class="wpcafe_switch_button_label"></label>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="require_branch"><?php esc_html_e('Require branch', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Branch name is required while placing reservation", 'wpcafe'); ?> </div>
    </div>
    <div class="wpc-meta">
    <input id='require_branch' type="checkbox" 
        <?php echo esc_attr( $checked_require_branch ); ?> 
        class="wpcafe-admin-control-input "
        name="require_branch" />
        <label for="require_branch" class="wpcafe_switch_button_label"></label>
    </div>
</div>
<?php
// render reservation form settings settings
if( !empty( $get_data['reservation_form_settings'] ) && file_exists(  $get_data['reservation_form_settings'] )){
    include_once $get_data['reservation_form_settings'];
}

if( !empty( $get_data["license_settings"] ) && file_exists($get_data["license_settings"])){
    include_once $get_data["license_settings"];
}