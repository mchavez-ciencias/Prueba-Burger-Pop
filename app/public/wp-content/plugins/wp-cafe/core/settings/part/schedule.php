<?php
use WpCafe\Utils\Wpc_Utilities;

?>
<h3 class="wpc-tab-title"><?php

esc_html_e('Schedule options', 'wpcafe'  ); ?></h3>
    <div class="wpc-label-item">
        <?php
            // render reservation schedule settings
            if( !empty( $get_data['reservation_schedule'] ) && file_exists( $get_data['reservation_schedule'] )){
                include_once  $get_data['reservation_schedule'] ;
            }
        ?>
        <div class="single_schedule">
            <div class="wpc-label">
                <label for="wpc_schedule" class="wpc-settings-label"><?php esc_html_e('Schedule', 'wpcafe'  ); ?></label>
                <p class="wpc-desc"> <?php esc_html_e("Set opening and closing schedule of your restaurant", 'wpcafe'); ?> </p>
            </div>
            <div class="wpc-meta">
            
                <div class="schedule_main_block">
                    <h5 class="wpc_pb_two"><?php esc_html_e('Weekly (set opening and closing schedule for each day of a week seperately)', 'wpcafe'  ); ?></h5>
                    <?php
                    $wpc_schedule['wpc_weekly_schedule'] = isset( $settings['wpc_weekly_schedule'] ) ? $settings['wpc_weekly_schedule'] : [];
                    $wpc_schedule['wpc_weekly_schedule_start_time'] = isset( $settings['wpc_weekly_schedule_start_time'] ) ? $settings['wpc_weekly_schedule_start_time'] : [];
                    $wpc_schedule['wpc_weekly_schedule_end_time']   = isset( $settings['wpc_weekly_schedule_end_time'] ) ? $settings['wpc_weekly_schedule_end_time'] : [];
                    
                    if( is_array( $wpc_schedule['wpc_weekly_schedule']  ) && count( $wpc_schedule['wpc_weekly_schedule']  ) >0 ){
                        for ( $index=0; $index < count( $wpc_schedule['wpc_weekly_schedule']   ) ; $index ++) { ?>
                            <div class="schedule_block week_schedule_wrap">
                                <div class="wpc-weekly-schedule-list">
                                    <?php foreach ($week_days as $key => $value) { ?>
                                        <input type="checkbox" name="wpc_weekly_schedule[<?php echo intval($index)?>][<?php echo esc_html($value);?>]" 
                                        class="<?php echo esc_html(strtolower($value));?>" id="<?php echo esc_html(strtolower($value).intval($index));?>"
                                        <?php echo isset( $wpc_schedule['wpc_weekly_schedule'][$index][$value] ) ? 'checked' : ''?>
                                        /><label for="<?php echo esc_html(strtolower($value).intval($index));?>"><?php echo esc_html__($value, "wpcafe" ); ?></label>
                                    <?php } ?>
                                </div>
                                <div class="schedule_block wpc-schedule-field">
                                    <input type="text"  name="wpc_weekly_schedule_start_time[]" id="<?php echo intval($index) ?>" value="<?php echo Wpc_Utilities::wpc_render( $wpc_schedule['wpc_weekly_schedule_start_time'][ $index ] ); ?>" class="wpc_weekly_schedule_start_time wpc_weekly_schedule_start_time_<?php echo Wpc_Utilities::wpc_numeric($index) ?> ml-2 mr-1 wpc-settings-input attr-form-control" id="<?php echo intval($index);?>" placeholder="<?php echo esc_html__("Start time" , 'wpcafe' ); ?>"/>
                                    <input type="text"  name="wpc_weekly_schedule_end_time[]"   id="<?php echo intval($index) ?>" value="<?php echo Wpc_Utilities::wpc_render( $wpc_schedule['wpc_weekly_schedule_end_time'][ $index ] ); ?>" class="wpc_weekly_schedule_end_time wpc_weekly_schedule_end_time_<?php echo Wpc_Utilities::wpc_numeric($index) ?> ml-2 wpc-settings-input attr-form-control" id="<?php echo intval($index);?>" placeholder="<?php echo esc_html__("End time", 'wpcafe' ); ?>"/>
                                    <div class="wpc_weekly_clear" id="<?php echo intval($index) ?>" ><?php echo esc_html__("clear", 'wpcafe' ); ?></div>                                                                     
                                </div>
                                <div class="weekly_message_<?php echo intval($index) ?> wpc-default-guest-message"></div>
                                <?php if( $index != 0 ) { ?>
                                <span class="dashicons wpc-btn dashicons dashicons-no-alt remove_schedule_block pl-1"></span>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    }
                    else {
                    ?>
                        <div class="schedule_block week_schedule_wrap">
                            <div class="wpc-weekly-schedule-list">
                            <?php foreach ($week_days as $key => $value) { ?>
                                    <input type="checkbox" name="wpc_weekly_schedule[0][<?php echo esc_html($value);?>]" 
                                    class="<?php echo esc_html(strtolower($value));?>" id="schedule_<?php echo esc_html(strtolower($value));?>"
                                    /><label for="schedule_<?php echo esc_html(strtolower($value));?>"><?php echo esc_html__($value, "wpcafe" ); ?></label>
                            <?php } ?>
                            </div>
                            <div class="wpc-schedule-field">
                                <input type="text" name="wpc_weekly_schedule_start_time[]" id="0" class="wpc_weekly_schedule_start_time wpc_weekly_schedule_start_time_0 mr-1 wpc-settings-input attr-form-control" placeholder="<?php echo esc_html__('Start time', 'wpcafe' ); ?>"/>
                                <input type="text" name="wpc_weekly_schedule_end_time[]" id="0" class="wpc_weekly_schedule_end_time wpc_weekly_schedule_end_time_0 wpc-settings-input attr-form-control"  placeholder="<?php echo esc_html__('End time', 'wpcafe' ); ?>"/>
                                <div class="wpc_weekly_clear" id="0" ><?php echo esc_html__("clear", 'wpcafe' ); ?></div>  
                            </div>
                            <div class="weekly_message_0 wpc-default-guest-message"></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="wpc_flex_reverse wpc-weekly-schedule-btn">
                    <span class="add_schedule_block wpc-btn" data-start_time="<?php echo esc_html__('Start time', 'wpcafe' ); ?>" data-end_time="<?php echo esc_html__('End time', 'wpcafe' ); ?>">
                            <i class="dashicons icon_cursor text-right dashicons-plus-alt  pl-1"></i>
                    </span>
                </div>
                <div class="wpc-all-day-schedule">
                    <h5 class="wpc_pb_two"><?php esc_html_e('All day (set opening and closing schedule for all days of a week)', 'wpcafe'  ); ?></h5>  
                    <div class="wpc-schedule-field mb-2">
                        <input type="text" name="wpc_all_day_start_time" value="<?php echo esc_attr( isset($settings['wpc_all_day_start_time'] ) ? $settings['wpc_all_day_start_time'] : ''); ?>"
                        class="wpc_all_day_start mb-1 wpc-settings-input attr-form-control" placeholder="<?php echo esc_html__('Start time', 'wpcafe' ); ?>" />
                        <input type="text" name="wpc_all_day_end_time" value="<?php echo esc_attr( isset($settings['wpc_all_day_end_time'] ) ? $settings['wpc_all_day_end_time'] : ''); ?>" 
                        class="wpc_all_day_end wpc-settings-input attr-form-control" placeholder="<?php echo esc_html__('End time', 'wpcafe' ); ?>"/> 
                        <div class="wpc_all_day_clear"><?php echo esc_html__("clear", 'wpcafe' ); ?></div> 
                    </div>
                    <div class="all_day_message wpc-default-guest-message"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="wpc-label-item wpc-shcedule-event-item">
        <div class="wpc-label">
            <label for="wpc_exceptions"><?php esc_html_e('Exceptions', 'wpcafe'  ); ?></label>
            <div class="wpc-desc"> <?php esc_html_e("Set opening and closing schedule for any special day", 'wpcafe'); ?> </div>
        </div>
        <div class="wpc-meta exception_section">
            <div class="exception_main_block">
                <?php
                $wpc_exception['wpc_exception_date']       = isset( $settings['wpc_exception_date'] ) ? $settings['wpc_exception_date'] : [];
                $wpc_exception['wpc_exception_start_time'] = isset( $settings['wpc_exception_start_time'] ) ? $settings['wpc_exception_start_time'] : [];
                $wpc_exception['wpc_exception_end_time']   = isset( $settings['wpc_exception_end_time'] ) ? $settings['wpc_exception_end_time'] : [];
                if( is_array( $wpc_exception['wpc_exception_date'] ) && count($wpc_exception['wpc_exception_date']) > 0 && $wpc_exception['wpc_exception_date']['0'] !== ''){
                    for ( $index=0; $index < count( $wpc_exception['wpc_exception_date'] ) ; $index ++) {
                        ?>
                        <div class="exception_block d-flex mb-2">
                            <input type="text" name="wpc_exception_date[]" value="<?php echo Wpc_Utilities::wpc_render( $wpc_exception['wpc_exception_date'][ $index ] ); ?>" class="wpc_exception_date mr-1 wpc-settings-input attr-form-control" id="exception_date_<?php echo Wpc_Utilities::wpc_render( $index )?>" placeholder="<?php esc_html_e('Date', 'wpcafe' ); ?>" />
                            <input type="text" name="wpc_exception_start_time[]" value="<?php echo Wpc_Utilities::wpc_render( $wpc_exception['wpc_exception_start_time'][ $index ] ); ?>" class="wpc_exception_start_time wpc_exception_start_time_<?php echo intval( $index )?> mr-1 wpc-settings-input attr-form-control" id="<?php echo intval( $index ) ?>"  placeholder="<?php esc_html_e('Start time', 'wpcafe' ); ?>" />
                            <input type="text"  name="wpc_exception_end_time[]" value="<?php echo Wpc_Utilities::wpc_render( $wpc_exception['wpc_exception_end_time'][ $index ] ); ?>" class="wpc_exception_end_time wpc_exception_end_time_<?php echo intval( $index )?> wpc-settings-input attr-form-control" id="<?php echo intval( $index ) ?>"  placeholder="<?php esc_html_e('End time', 'wpcafe' ); ?>"/>
                            <div class="exception_time_clear" id="<?php echo intval( $index )?>" ><?php echo esc_html__("clear", 'wpcafe' ); ?></div>
                            <?php if( $index != 0 ) { ?>
                                <span class="wpc-btn dashicons dashicons-no-alt remove_exception_block wpc_icon_middle_position"></span>
                            <?php } ?>
                        </div>
                        <div class=" wpc-default-guest-message schedule_exception_message_<?php echo intval( $index );?>"></div>
                        <?php
                    }
                }
                else {
                ?>
                    <div class="exception_block d-flex mb-2">
                        <input type="text" name="wpc_exception_date[]" value="" class="wpc_exception_date mr-1 wpc-settings-input attr-form-control" placeholder="<?php esc_html_e('Date', 'wpcafe'  )?>" />
                        <input type="text" name="wpc_exception_start_time[]" value="" id="0" class="wpc_exception_start_time wpc_exception_start_time_0 mr-1 wpc-settings-input attr-form-control" placeholder="<?php esc_html_e('Start time', 'wpcafe'  )?>" />
                        <input type="text" name="wpc_exception_end_time[]" value="" id="0" class="wpc_exception_end_time wpc_exception_end_time_0 wpc-settings-input attr-form-control" placeholder="<?php esc_html_e('End time', 'wpcafe'  )?>"/>
                        <div class="exception_time_clear" id="0" ><?php echo esc_html__("clear", 'wpcafe' ); ?></div>
                    </div>
                    <div class=" wpc-default-guest-message schedule_exception_message_0"></div>
                <?php
                }
                ?>
            </div>
            <div class="wpc_flex_reverse">
                <span class="add_exception_block wpc-btn" data-start_time="<?php echo esc_html__('Start time', 'wpcafe' ); ?>" data-end_time="<?php echo esc_html__('End time', 'wpcafe' ); ?>">
                    <i class="dashicons icon_cursor text-right dashicons-plus-alt  pl-1"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="wpc-label-item">
        <div class="wpc-label">
            <label for="wpc_early_bookings"><?php esc_html_e('Early bookings', 'wpcafe'  ); ?></label>
            <div class="wpc-desc"> <?php esc_html_e("Set time limit for early booking. user can not pre-book before the defined time", 'wpcafe'); ?> </div>
        </div>
        <div class="wpc-meta">
            <select id="wpc_early_bookings" class="wpc-settings-input" name="wpc_early_bookings">
                <?php
                $selected_early_booking = !empty( $settings['wpc_early_bookings'] ) ? $settings['wpc_early_bookings'] : "";
                $wpc_early_bookings= array( 
                    'any_time'     => esc_html__( 'Any time', 'wpcafe'   ),
                    '1day'         => esc_html__( 'From 1 day advance', 'wpcafe'   ),
                    '1week'        => esc_html__( 'From 1 week advance', 'wpcafe'   ),
                    '1month'       => esc_html__( 'From 1 month advance', 'wpcafe'   ),
                    );
                    foreach( $wpc_early_bookings as $key => $value ) { ?>
                        <option <?php selected( $selected_early_booking , $key , true ); ?> value='<?php echo esc_attr( $key ); ?>'><?php echo esc_html( $value ); ?></option>
                    <?php }
                ?>
            </select>
        </div>
    </div>
    <div class="wpc-label-item">
        <div class="wpc-label">
            <label for="wpc_late_bookings"><?php esc_html_e('Late bookings', 'wpcafe'  ); ?></label>
            <div class="wpc-desc"> <?php esc_html_e("Set time limit for late booking. user can not pre-book after the defined time", 'wpcafe'); ?> </div>
        </div>
        <div class="wpc-meta">
            <select id="wpc_late_bookings" class="wpc-settings-input" name="wpc_late_bookings">
                <?php
                $selected_late_booking = !empty( $settings['wpc_late_bookings'] ) ? $settings['wpc_late_bookings'] : "";
                $wpc_late_bookings= array( 
                    '1'       => esc_html__( 'Up to the last minute', 'wpcafe'   ),
                    '15'      => esc_html__( 'Atleast 15 minutes in advance', 'wpcafe'   ),
                    '30'      => esc_html__( 'Atleast 30 minutes in advance', 'wpcafe'   ),
                    '45'      => esc_html__( 'Atleast 45 minutes in advance', 'wpcafe'   ),
                    );
                    foreach( $wpc_late_bookings as $key => $value ) { ?>
                        <option <?php selected( $selected_late_booking , $key , true ); ?> value='<?php echo esc_attr( $key ); ?>'><?php echo esc_html( $value ); ?></option>
                    <?php }
                ?>
            </select>
        </div>
    </div>
<?php
return;