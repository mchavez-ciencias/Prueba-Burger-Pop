<?php
// party size loop

use WpCafe\Utils\Wpc_Utilities;

$wpc_min_guest_no    = isset($settings['wpc_min_guest_no']) ? $settings['wpc_min_guest_no'] : 1;
$wpc_max_guest_no    = isset($settings['wpc_max_guest_no']) && $settings['wpc_max_guest_no'] !=="" ? $settings['wpc_max_guest_no'] : $seat_capacity;
$wpc_default_gest_no = isset($settings['wpc_default_gest_no']) && $settings['wpc_default_gest_no'] !=="" ? $settings['wpc_default_gest_no'] : $wpc_min_guest_no;
$wpc_late_bookings   = isset($settings['wpc_late_bookings']) && $settings['wpc_late_bookings'] !== "1"  ? $settings['wpc_late_bookings'] : "";
$phone_required      = isset($settings['wpc_require_phone']) ? "required" : "";
$show_branches       = isset($settings['show_branches'] )   ? "yes" : "no";
$require_branch      = isset($settings['require_branch'] )   ? "required" : "no";

$cancellation_option = '';

if ( isset($settings['wpc_allow_cancellation']) && $settings['wpc_allow_cancellation'] == 'off' ) {
    $cancellation_option .= "hide-cancel-text";
}
$wpc_image_url = WPC_ASSETS . 'images/wpc_reservation_image.jpeg';
if (is_array($atts) && isset($atts['wpc_image_url']) && $atts['wpc_image_url'] !== '') {
    $wpc_image_url = $atts['wpc_image_url'];
}

$reservation_arr = array(
    'wpc_check_name'        => 'Name :',
    'wpc_check_email'       => 'Email :',
    'wpc_check_phone'       => 'Phone :',
    'wpc_check_guest'       => 'Guests:',
    'wpc_check_start_time'  => 'Time  :',
    'wpc_check_booking_date'=> 'Date  :',
);

if( $show_branches=="yes" ){
    // Add branch field in backend reservation form
    $reservation_arr['wpc_check_branch'] = 'Branch  :';
}
$style="";
if ( isset($atts['form_style']) ) {
    switch ( $atts['form_style'] ) {
        case "1":
            $view = "yes";
            $column_lg = "wpc-col-lg-6";
            $column_md = "wpc-col-md-12";
            break;
        case "2":
            $view = "no";
            $column_lg = "wpc-col-lg-12";
            $column_md = "wpc-col-md-6";
            break;
        default:
            $view = "yes";
            break;
    }
    $style=$atts['form_style'];
}

$late_one   = esc_html__("Our last booking time is","wpcafe" );
$late_two   = " {last_time}.";
$late_three =  esc_html__(" You can boook before","wpcafe");
$late_four  = " {last_min}";
$late_five  =  esc_html__(" minutes of closing time.","wpcafe" );
// get loctaion
$wpc_loctaion_arr = Wpc_Utilities::get_location_data( "Select a branch","No branch is set", "value" );

$dash="";

if ( $show_form_field =="on" && $show_to_field =="on" ){
    $dash="-";
}

?>
<div class='wpc-reservation-form <?php echo esc_attr($cancellation_option) ?>' 
data-reservation_status='<?php echo json_encode( $booking_status ) ?>'>
    <div class='late_booking' data-late_booking="<?php echo esc_html($late_one.$late_two.$late_three.$late_four.$late_five);?>"></div>
    <div class='wpc_cancell_log_message'></div>
    <div class='wpc_error_message' data-time_compare="<?php echo esc_html__('Booking end time must be after start time','wpcafe')?>"></div>
    <div class='wpc_success_message' data-start="<?php echo esc_html__("Start time","wpcafe");?>" data-end="<?php echo esc_html__("End time","wpcafe");?>" data-schedule="<?php echo esc_html__("Schedule","wpcafe");?>" data-late_booking = "<?php echo ( $wpc_late_bookings !=="" ) ? esc_html__("You can booked before ".$wpc_late_bookings."min of closing time.","wpcafe") : "" ?>"></div>
    <div class='wpc_calender_view' data-view="<?php echo esc_html($view);?>"></div>
    <div class='date_missing' data-date_missing="<?php echo esc_html__("Please select a date first","wpcafe");?>"></div>
    <div class="form_style" data-form_style="free-<?php echo esc_attr( $style )?>" data-form_type="free"></div>
    <div class='wpc_reservation_form_two' style='display:none;'>
        <div class='wpc_reservation_form_two'>
            <form method='post' class=' wpc_reservation_table'>
                <div class='wpc-reservation-form'>
                    <div class='wpc-row'>
                        <?php if ($view === "yes") { ?>
                            <div class='wpc-col-lg-6 wpc_bg_image' style="background-image: url(<?php echo esc_url($wpc_image_url) ?>);">
                               
                            </div>
                        <?php } ?>
                        <div class='<?php echo esc_attr($column_lg); ?>'>
                            <div class='wpc_reservation_form wpc_reservation_user_info'>
                                <ul>
                                    <?php foreach( $reservation_arr as $key => $value) : 
                                        if (  $key == 'wpc_check_start_time' ) {
                                            if ( $show_form_field =="on" || $show_to_field =="on" ) { ?>
                                        <li> 
                                            <span class='wpc-user-field-info'><?php echo esc_html__( $value , 'wpcafe'); ?></span>
                                            <?php if ( $key == 'wpc_check_start_time' ) { ?>
                                            <span class='<?php echo esc_attr($key) ?>'></span>  <?php echo  $dash ; echo  ( $show_to_field == 'on' ) ?  " <span class='wpc_check_end_time'></span>" : "" ?>
                                            <?php } else{ ?>
                                                    <span class='<?php echo esc_html($key) ?>'></span>
                                            <?php } ?>
                                        </li>
                                         
                                    <?php } }
                                    else { ?>
                                        <li id="<?php echo esc_attr($key) ?>"> 
                                            <span class='wpc-user-field-info'><?php echo esc_html__( $value , 'wpcafe'); ?></span>
                                            <span class='<?php echo esc_attr($key) ?>'></span>
                                        </li>
                                    <?php }
                                 endforeach;?>
                                </ul>
                                <div class='wpc_log_message'></div>

                                <button class='confirm_booking_btn wpc-btn' data-id='reservation_form_second_step'><?php echo esc_html__('Confirm Booking', 'wpcafe'); ?></button>
                                <button class='edit_booking_btn wpc-btn' data-id='edit_booking_btn'><?php echo esc_html__('Edit Booking', 'wpcafe'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form method='post' class='wpc_reservation_table'>
        <input type='hidden' name='wpc_action' value='wpc_reservation' />
        <div class='wpc_reservation_form_one'>
            <div class="wpc-row">
                <?php if ("yes" === $view ) { ?>
                    <div class='wpc-col-lg-6 wpc-align-self-center'>
                        <div class='wpc-reservation-field date wpc-reservation-calender-field'>
                            <h3 class="wpc-choose-date"><?php echo esc_html__('Choose a Date', 'wpcafe'); ?></h3>
                            <input type='text' name='wpc_booking_date' class='wpc-form-control' id='wpc_booking_date' value='' required aria-required='true' />
                        </div>
                    </div>
                <?php } ?>
                <div class='<?php echo esc_attr($column_lg); ?>'>
                    <div class="wpc_reservation_form">
                        <?php if ( "yes" == $show_branches ) { ?>
                            <div class="wpc-row">
                                <div class="wpc-col-lg-12 wpc-align-self-center">
                                    <div class='wpc-reservation-field branch'>
                                        <label for='wpc-branch'><?php echo esc_html__('Which branch of our restaurant', 'wpcafe'); echo ( $require_branch == "required" ) ? "<small class='wpc_required'>*</small>" : "" ?></label>
                                        <select name='wpc_branch' id='wpc-branch' class='wpc-form-control' <?php echo esc_attr($require_branch == "required" ? "required" : ""); ?>>
                                            <?php foreach( $wpc_loctaion_arr as $key=>$branch ) {?>
                                                <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $branch ); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="wpc-row">
                            <div class='wpc-col-md-6'>
                                <div class='wpc-reservation-field name'>
                                    <label for='wpc-name'><?php echo esc_html__('Your Name', 'wpcafe'); ?><small class='wpc_required'>*</small></label>
                                    <input type='text' name='wpc_name' placeholder='<?php echo esc_html__('Name here', 'wpcafe'); ?>' id='wpc-name' class='wpc-form-control' value='' required aria-required='true'>
                                    <div class="wpc-name wpc_danger_text"></div>
                                </div>
                            </div>
                            <div class='wpc-col-md-6'>
                                <div class='wpc-reservation-field email'>
                                    <label for='wpc-email'><?php echo esc_html__('Your Email', 'wpcafe'); ?><small class='wpc_required'>*</small></label>
                                    <input type='email' name='wpc_email' placeholder='<?php echo esc_html__('Email here', 'wpcafe'); ?>' class='wpc-form-control' id='wpc-email' value='' required aria-required='true'>
                                    <div class="wpc-email wpc_danger_text"></div>
                                </div>
                            </div>
                        </div>
                        <div class='wpc-row'>
                            <div class='<?php echo esc_attr($column_md) ?>'>
                                <div class='wpc-reservation-field phone'>
                                    <label for='wpc-phone'><?php echo esc_html__('How can we contact you?', 'wpcafe');
                                        echo ( $phone_required == "required" ) ? "<small class='wpc_required'>*</small>" : "" ?>
                                    </label>
                                    <input type='tel' placeholder='<?php echo esc_html__('Phone Number here', 'wpcafe'); ?>' <?php echo esc_attr($phone_required == "required" ? "required" : ""); ?> name='wpc_phone' class='wpc-form-control' id='wpc-phone' value=''>
                                    <div class="wpc-phone wpc_danger_text"></div>
                                </div>
                            </div>
                            <?php if ($view === "no") { ?>
                                <div class='wpc-col-lg-6'>
                                    <div class='wpc-reservation-field'>
                                        <label for='wpc_booking_date'><?php echo esc_html__('Date', 'wpcafe'); ?><small class='wpc_required'>*</small></label>
                                        <input type='text' placeholder='<?php echo esc_html__('Booking date here', 'wpcafe'); ?>' name='wpc_booking_date' class='wpc-form-control' id='wpc_booking_date' value='' required aria-required='true' />
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class='wpc-row'>
                            <div class='<?php esc_attr_e( $from_to_column ) ;?>'>
                                <?php if( $show_form_field == 'on'): ?>
                                    <div class='wpc-reservation-field time'>
                                        <label for='wpc_from_time'><?php echo esc_html__( $from_field_label , 'wpcafe'); ?>
                                            <?php if ( $required_from_field == 'on') : ?>
                                                <small class='wpc_required'>*</small>
                                            <?php endif; ?> 
                                         </label>
                                        <input type='text' name='wpc_from_time' placeholder='<?php echo esc_html__('Start time here', 'wpcafe'); ?>' class='wpc-form-control' id='wpc_from_time' value='' <?php echo ( $required_from_field == 'on' ) ? 'required aria-required="true"' : '' ?>  >
                                        <span class="dashicons dashicons-clock"></span>

                                    </div>
                                <?php endif;?>
                            </div>
                            <div class='<?php esc_attr_e( $from_to_column ) ;?>'>
                                <?php if( $show_to_field == 'on' ): ?>
                                    <div class='wpc-reservation-field time'>
                                        <label for='wpc_to_time'><?php echo esc_html__( $to_field_label , 'wpcafe'); ?>
                                            <?php if ( $required_to_field == 'on') : ?>
                                                <small class='wpc_required'>*</small>
                                            <?php endif; ?>
                                         </label>
                                        <input type='text' name='wpc_to_time' placeholder='<?php echo esc_html__('End time here', 'wpcafe'); ?>' class='wpc-form-control' id='wpc_to_time' value='' <?php echo ( $required_to_field == 'on' ) ? 'required aria-required="true"' : '' ?> >
                                        <span class="dashicons dashicons-clock"></span>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class='wpc-select party wpc-reservation-field'>
                            <label for='wpc-total-guest'><?php echo esc_html__('Total Guest ', 'wpcafe'); ?><small class='wpc_required'>*</small></label>
                            <select name='wpc_guest_count' id='wpc-party' class='wpc-form-control' required aria-required='true'>
                                <option value=""><?php echo esc_html__("Select no of geuests","wpcafe")?></option>
                                <?php for ($i = $wpc_min_guest_no; $i <= $wpc_max_guest_no; $i++) {
                                    $selected = ($wpc_default_gest_no == $i) ? "selected" : ""; ?>
                                    <option value='<?php echo esc_attr( $i ); ?>' <?php echo esc_attr( $selected ); ?>><?php echo esc_html( $i ); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class='wpc-reservation-fieldarea message wpc-reservation-field'>
                            <label for='wpc-message'><?php echo esc_html__('Special Information', 'wpcafe'); ?></label>
                            <textarea name='wpc_message' placeholder='<?php echo esc_html__('Enter Your Message here', 'wpcafe'); ?>' id='wpc-message' class='wpc-form-control'></textarea>
                        </div>
                        <?php
                            // render extra field
                            if( !empty( $result_data['reservation_extra_field']) && file_exists( $result_data['reservation_extra_field'] )) {
                                include $result_data['reservation_extra_field'];
                            }
                        ?>
                        <input type='hidden' value='reservation_form_first_step' class='reservation_form_first_step' />
                        <button type='submit' class='reservation_form_submit wpc-btn'><?php echo esc_html__( $booking_button_text , 'wpcafe' ); ?></button>
                        <span id='wpc_cancel_request'><?php echo esc_html__( $cancell_button_text ,'wpcafe'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

