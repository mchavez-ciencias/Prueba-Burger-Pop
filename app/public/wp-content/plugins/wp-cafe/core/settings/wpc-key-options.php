<?php
namespace WpCafe\Core\Settings;

defined( "ABSPATH" ) || exit;

use WpCafe\Utils\Wpc_Utilities;


class Wpc_Key_Options {

    use \WpCafe\Traits\Wpc_Singleton;

    public $wpc_settings_field;

    /**
     * Settings field
     *
     * @return void
     */
    public function wpc_key_options() {
        if (isset($_GET['action']) && sanitize_text_field($_GET['action']) == 'reservation_details') {
            apply_filters('wpcafe/key_options/reservation_details','wpc_pro_reservation_details');
        }
        else {
            if ( isset($_GET['saved']) && sanitize_text_field($_GET['saved']) == 1 ) {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?php echo esc_html__("Your settings have been saved","wpcafe")?></p>
                </div>
                <?php
            }
            ?>
            <div class="wrap wpc-settings">
                <h1 class="wpc-settings-title"><?php echo esc_html__('Settings', 'wpcafe' ) ?></h1>
                <div id="setting_message" class="hide_field"></div>
                <?php
                $visit          = esc_html__('Visit', 'wpcafe');
                $documentation  = esc_html__('Documentation', 'wpcafe');
                $schedule_text  = esc_html__('reservation settings section for reservation schedule of your restaurant.', 'wpcafe');
                $menu_text      = esc_html__(' for food menu options of your restaurant.', 'wpcafe');
                $sched_doc_link = Wpc_Utilities::wpc_kses( '<a href="https://support.themewinter.com/docs/plugins/docs/general-settings-2/" target="_blank" class="doc-link">'. $documentation .'</a> ' );
                $fmenu_doc_link = Wpc_Utilities::wpc_kses( '<a href="https://support.themewinter.com/docs/plugins/docs/food-menu/" target="_blank" class="doc-link"> '. $documentation .'</a> ' );
                // show tab
                $settings_tabs = array(
                    'key_options'   => [esc_html__('Key options', 'wpcafe'),esc_html__('( For reservation )', 'wpcafe')],
                    'schedule'      => [esc_html__('Reservation schedule', 'wpcafe'),esc_html__('( For reservation )', 'wpcafe')],
                    'notification'  => [esc_html__('Notifications', 'wpcafe'),esc_html__('( For reservation )', 'wpcafe')],
                    'menu_settings' => [esc_html__('Menu settings', 'wpcafe'),esc_html__('( For food menu )', 'wpcafe')],
                    'hooks'         => [esc_html__('Available shortcode', 'wpcafe'),esc_html__('( General )', 'wpcafe')],
                );
                $wpc_doc_link = array(
                    'schedule'      => $visit .' '.$sched_doc_link .' '. $schedule_text .'',
                    'menu_settings' => $visit .' '.$fmenu_doc_link .' '. $menu_text .'',
                );
                $tab_arr    = [ $settings_tabs , $wpc_doc_link ];
                $settings   =  \WpCafe\Core\Base\Wpc_Settings_Field::instance()->get_settings_option();

//                if( isset($settings['settings_tab']) && $settings['settings_tab']!=="" ){
//                    $recent_tab = sanitize_text_field($settings['settings_tab']);
//                }else{
//                    $recent_tab = 'key_options' ;
//                }

                $recent_tab = get_query_var('settings-tab', 'key_options');

                ?>
                <ul class="nav nav-tabs wpc-tab">
                    <?php
                    $filterd_tab = apply_filters('wpcafe/key_options/settings_tab_item', $tab_arr );
                    if( isset( $filterd_tab['settings_tab']) ){
                        $tabs = $filterd_tab['settings_tab'][0];
                        $wpc_doc_link = $filterd_tab['settings_tab'][1];
                    }else{
                        $tabs = $tab_arr[0];
                    }

                    $i=0;
                    foreach ($tabs as $key => $value){
                        $i++
                        ?>
                        <li>
                            <a href="#" class="nav-tab <?php echo esc_html($recent_tab) == $key ? 'nav-tab-active': '';?>" data-id="<?php echo esc_html($key) ?>">
                                <i class="wpcafe-icon<?php echo Wpc_Utilities::wpc_numeric($i);?>"></i>
                                <span><?php esc_html_e( $value[0] , 'wpcafe'  ); ?></span>
                                <small><?php esc_html_e( $value[1] , 'wpcafe'  )?></small>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content settings-content-wraps">
                    <?php
                    $week_days = ['Sat','Sun','Mon','Tue','Wed','Thu','Fri'];

                    $sample_date = strtotime(date('Y-m-d'));
                    $date_options         = [
                        'Y-m-d' => date('Y-m-d', $sample_date),
                        'y/m/d' => date('y/m/d', $sample_date),
                        'm/d/Y' => date('m/d/Y', $sample_date),
                        'd/m/Y' => date('j/n/Y', $sample_date),
                        'd/m/Y' => date('d/m/Y', $sample_date),
                        'd-m-Y' => date('n-j-Y', $sample_date),
                        'm-d-Y' => date('m-d-Y', $sample_date),
                        'd-m-Y' => date('d-m-Y', $sample_date),
                        'Y.m.d' => date('Y.m.d', $sample_date),
                        'm.d.Y'  => date('m.d.Y', $sample_date),
                        'd.m.Y' => date('d.m.Y', $sample_date),
                    ];
                    $get_data                                     = apply_filters('wpcafe/key_options/menu_settings', $settings);

                    $wpc_reservation_form_display_page            =  (isset($settings['wpc_reservation_form_display_page'] ) ?  $settings['wpc_reservation_form_display_page'] : '');
                    $wpcafe_food_location                         =  isset($settings['wpcafe_food_location']) ? "checked" : "";
                    $wpcafe_allow_cart                            =  (! isset($settings['wpcafe_allow_cart'] ) || isset($settings['wpcafe_allow_cart'] ) && $settings['wpcafe_allow_cart'] == 'on' ) ? 'on' : 'off';
                    $show_branches                                =  isset($settings['show_branches'] )   ? "checked" : "";
                    $wpc_checked_allow_cancellation               =  (! isset($settings['wpc_allow_cancellation'] ) || isset($settings['wpc_allow_cancellation'] ) && $settings['wpc_allow_cancellation'] == 'on' ) ? 'on' : 'off';
                    $checked_require_phone                        =  (isset($settings['wpc_require_phone']) ? "checked" : "");
                    $checked_require_branch                       =  (isset($settings['require_branch']) ? "checked" : "");
                    $allow_admin_notif_book_req                   =  (! isset($settings['wpc_admin_notification_for_booking_req'] ) || isset($settings['wpc_admin_notification_for_booking_req'] ) && $settings['wpc_admin_notification_for_booking_req'] == 'on' )  ? 'on' : 'off';
                    $allow_user_notif_book_req                    =  (! isset($settings['wpc_user_notification_for_booking_req'] ) || isset($settings['wpc_user_notification_for_booking_req'] ) && $settings['wpc_user_notification_for_booking_req'] == 'on' )  ? 'on' : 'off';

                    $admin_notif_confirm_book                     =  (isset($get_data['notification_settings']['admin_notif_confirm_book']) ? $get_data['notification_settings']['admin_notif_confirm_book'] : 'off');
                    $user_notif_confirm_book                      =  (isset($get_data['notification_settings']['user_notif_confirm_book']) ? $get_data['notification_settings']['user_notif_confirm_book'] : 'off');

                    $admin_notif_cancel_req                       =  (isset($get_data['notification_settings']['admin_notif_cancel_req']) ? $get_data['notification_settings']['admin_notif_cancel_req'] : 'off');
                    $user_notif_cancel_req                        =  (isset($get_data['notification_settings']['user_notif_cancel_req']) ? $get_data['notification_settings']['user_notif_cancel_req'] : 'off');
                    $reserve_dynamic_message                      =  (isset($settings['reserve_dynamic_message']) ? $settings['reserve_dynamic_message'] : '');

                    $wpc_booking_confirmed =  esc_html__('Thank you for  booking. Your booking is confirmed. Please check your email.','wpcafe');
                    $wpc_booking_confirmed_message = $wpc_booking_confirmed;
                    $wpc_pending = esc_html__('Thank you for  booking. Your booking is pending. Please check your email.','wpcafe');
                    $wpc_pending_message = $wpc_pending;
                    if ( isset($settings['wpc_pending_message'])) {
                        if ($settings['wpc_pending_message'] == '') {
                            $wpc_pending_message = $wpc_pending;
                        }else {
                            $wpc_pending_message = $settings['wpc_pending_message'];
                        }
                    }

                    if ( isset($settings['wpc_booking_confirmed_message'])) {
                        if ($settings['wpc_booking_confirmed_message'] == '') {
                            $wpc_booking_confirmed_message = $wpc_booking_confirmed;
                        }else {
                            $wpc_booking_confirmed_message = $settings['wpc_booking_confirmed_message'];
                        }
                    }
                    ?>
                    <form method='post' class='wpc_pb_two wpc_tab_content' id='wpc_settings_form' >
                        <input type="hidden" name="settings_tab" class="settings_tab" value="key_options"/>
                        <?php
                        foreach ($tabs as $item => $content) {
                            $active_class = (  ( $item == $recent_tab ) ? 'active' : '' );
                            if ( in_array( $item, array_keys( $settings_tabs ) ) ) {
                                ?>
                                <div id='<?php echo esc_attr( $item );?>' data-id='tab_<?php echo esc_attr( $item ); ?>' class='tab-pane <?php echo esc_attr( $active_class );?>'>
                                    <?php
                                    if ( isset( $wpc_doc_link[$item] ) ) { ?>
                                        <!-- documentation link -->
                                        <div class="mb-2"><?php echo Wpc_Utilities::wpc_kses( $wpc_doc_link[$item] ); ?></div>
                                        <?php
                                    }
                                    //Schedule
                                    if ( $item == 'schedule' && file_exists(  WPC_CORE ."settings/part/schedule.php" ) ) {
                                        include_once WPC_CORE ."settings/part/schedule.php";
                                    }
                                    // Key options
                                    elseif ( $item == 'key_options' && file_exists(  WPC_CORE ."settings/part/key_options.php" ) ) {

                                        include_once WPC_CORE ."settings/part/key_options.php";

                                    }
                                    //Notification
                                    elseif ( $item == 'notification'  && file_exists(  WPC_CORE ."settings/part/notifications.php" ) ) {
                                        include_once WPC_CORE ."settings/part/notifications.php";
                                    }
                                    // Menu settings
                                    elseif ( $item == 'menu_settings' ) {
                                        ?>
                                        <h3 class="wpc-tab-title"><?php esc_html_e("Food Menu Options", "wpcafe"  ); ?></h3>
                                        <div class="wpc-label-item">
                                            <div class="wpc-label">
                                                <label for="wpcafe_food_location"><?php esc_html_e("Allow location", "wpcafe"  ); ?></label>
                                                <div class="wpc-desc"> <?php esc_html_e("Show location dropdown on front-end menu (only in front page) and checkout", "wpcafe"  ); ?> </div>
                                            </div>
                                            <div class="wpc-meta">
                                                <input id='wpcafe_food_location' type="checkbox" <?php echo esc_attr( $wpcafe_food_location ) ; ?> class="wpcafe-admin-control-input"
                                                       name="wpcafe_food_location" />
                                                <label for="wpcafe_food_location" class="wpcafe_switch_button_label"></label>
                                            </div>
                                        </div>
                                        <div class="wpc-label-item">
                                            <div class="wpc-label">
                                                <label for="wpcafe_allow_cart"><?php esc_html_e("Allow Cart", "wpcafe"  ); ?></label>
                                                <div class="wpc-desc"> <?php esc_html_e("Show cart on the frontend",  "wpcafe"  ); ?> </div>
                                            </div>
                                            <div class="wpc-meta">
                                                <input name="wpcafe_allow_cart" class="hide_field" type="checkbox" value="off" <?php echo esc_attr( $wpcafe_allow_cart == 'off' ? 'checked' : ''  ) ; ?>/>
                                                <input id='wpcafe_allow_cart' type="checkbox" <?php echo esc_attr( $wpcafe_allow_cart == 'on' ? 'checked' : ''  ) ; ?> class="wpcafe-admin-control-input "
                                                       name="wpcafe_allow_cart" />
                                                <label for="wpcafe_allow_cart" class="wpcafe_switch_button_label"></label>
                                            </div>
                                        </div>
                                        <div class="wpc-label-item">
                                            <div class="wpc-label">
                                                <label for="wpc_mini_cart_icon"><?php esc_html_e('Minicart icon', 'wpcafe'  ); ?></label>
                                                <div class="wpc-desc"> <?php esc_html_e("Icon class for mini cart",  'wpcafe'  ); ?> </div>
                                            </div>
                                            <div class="wpc-meta">
                                                <input type="text" class="wpc-settings-input" name="wpc_mini_cart_icon" id="wpc_mini_cart_icon"
                                                       value="<?php echo esc_attr( isset($settings['wpc_mini_cart_icon'] ) ? $settings['wpc_mini_cart_icon'] : ''); ?>"
                                                       placeholder="<?php esc_html_e("icon here",  'wpcafe'  ); ?>" />
                                                <span class="wpc-admin-settings-message"><?php echo esc_html_e( 'For instance : fa fa-shopping-cart', 'wpcafe'  )?>
                                            </div>
                                        </div>
                                        <div class="wpc-label-item">
                                            <div class="wpc-label">
                                                <label for="wpc_primary_color"><?php esc_html_e('Primary color', 'wpcafe'  ); ?></label>
                                                <div class="wpc-desc"> <?php esc_html_e("Choose primary color for menu", 'wpcafe'  ); ?> </div>
                                            </div>
                                            <div class="wpc-meta">
                                                <input type="text" name="wpc_primary_color" id="wpc_primary_color"
                                                       value="<?php echo esc_attr( isset($settings['wpc_primary_color'] ) ? $settings['wpc_primary_color'] : ''); ?>"
                                                />
                                            </div>
                                        </div>
                                        <div class="wpc-label-item">
                                            <div class="wpc-label">
                                                <label for="wpc_secondary_color"><?php esc_html_e('Secondary color', 'wpcafe'  ); ?></label>
                                                <div class="wpc-desc"> <?php esc_html_e("Choose secondary color for menu", 'wpcafe'  ); ?> </div>
                                            </div>
                                            <div class="wpc-meta">
                                                <input type="text" name="wpc_secondary_color" id="wpc_secondary_color"
                                                       value="<?php echo esc_attr( isset($settings['wpc_secondary_color'] ) ? $settings['wpc_secondary_color'] : ''); ?>"
                                                />
                                            </div>
                                        </div>
                                        <div class="wpc-label-item">
                                            <div class="wpc-label">
                                                <label for="wpc_secondary_color"><?php esc_html_e('Minicart product background color', 'wpcafe'  ); ?></label>
                                                <div class="wpc-desc"> <?php esc_html_e("Choose background color of minicart product background", 'wpcafe'  ); ?> </div>
                                            </div>
                                            <div class="wpc-meta">
                                                <input type="text" name="mini_product_bg" id="mini_product_bg"
                                                       value="<?php echo esc_attr( isset($settings['mini_product_bg'] ) ? $settings['mini_product_bg'] : ''); ?>"
                                                />
                                            </div>
                                        </div>
                                        <?php
                                        // render menu settings
                                        if( !empty( $get_data['menu_settings'] ) && file_exists( $get_data['menu_settings'] )){
                                            include_once $get_data['menu_settings'];
                                        }
                                    }
                                    //hooks
                                    elseif ( $item == 'hooks' && file_exists( WPC_CORE ."settings/part/hooks.php") ) {
                                        include_once WPC_CORE ."settings/part/hooks.php";
                                    }
                                    ?>
                                </div>
                            <?php } }
                        apply_filters('wpcafe/key_options/tab_content', $settings,$wpc_doc_link,$recent_tab);
                        ?>
                        <input type="hidden" name="wpcafe_settings_key_options_action" value="save">
                        <input type="submit" name="submit" id="cafe_settings_submit" class="wpc_mt_two wpc-btn" value="<?php esc_attr_e('Save Changes', 'wpcafe' ); ?>">
                        <?php wp_nonce_field('wpcafe-settings-page', 'wpcafe-settings-page'); ?>
                    </form>
                </div>
            </div>
            <?php
        }
    }
}

