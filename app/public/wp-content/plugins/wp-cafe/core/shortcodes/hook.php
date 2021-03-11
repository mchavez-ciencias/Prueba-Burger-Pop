<?php

namespace WpCafe\Core\Shortcodes;

defined("ABSPATH") || exit;

use WpCafe\Traits\Wpc_Singleton;
use WpCafe\Utils\Wpc_Utilities;

/**
 * create post type class
 */
class Hook{

    use Wpc_Singleton;

    private $settings_obj = null;
    public $wpc_message   = '';
    public $wpc_cart_css  = '';
    /**
     * call hooks
     */
    public function init(){
        $settings = $this->settings_obj =  \WpCafe\Core\Base\Wpc_Settings_Field::instance()->get_settings_option();

        // add shortcode
        add_shortcode('wpc_food_menu_tab', [$this, 'wpc_food_menu_tab']);
        add_shortcode('wpc_food_menu_list', [$this, 'wpc_food_menu_list']);
        add_shortcode('wpc_reservation_form', [$this, 'reservation_shortcode']);

        // add minicart to header
        add_action('wp_head', [$this, 'wpc_custom_inline_css']);
        add_action('wp_head', [$this, 'wpc_custom_mini_cart']);

        // add new field in checkout page
        if ( isset($settings['wpcafe_food_location']) && $settings['wpcafe_food_location'] == 'on' && class_exists('WooCommerce')) {
            add_action('woocommerce_checkout_before_customer_details', [$this, 'wpc_location_checkout_form']);
            add_action('woocommerce_checkout_process', [$this, 'wpc_validate_location']);
            add_action('woocommerce_checkout_create_order', [$this, 'wpc_location_update_meta'], 10, 2);
        }

        // menu order action
        add_action('product_cat_add_form_fields', [$this, 'wpc_product_cat_taxonomy_add_new_meta_field'], 10, 1);
        add_action('product_cat_edit_form_fields', [$this, 'wpc_product_cat_taxonomy_edit_meta_field'], 10, 1);
        add_action('edited_product_cat', [$this, 'wpc_product_cat_taxonomy_save_meta_field'], 10, 1);
        add_action('create_product_cat', [$this, 'wpc_product_cat_taxonomy_save_meta_field'], 10, 1);

        //Displaying Additional Columns
        add_filter('manage_edit-product_cat_columns', [$this, 'wpc_custom_fields_list_title']);
        add_action('manage_product_cat_custom_column', [$this, 'wpc_custom_fields_list_diplay'], 10, 3);

        if (class_exists('woocommerce')) {
            // update cart counter 
            add_filter('woocommerce_add_to_cart_fragments', [$this, 'wpc_add_to_cart_count_fragment_refresh'], 30, 1);
            add_filter('woocommerce_add_to_cart_fragments', [$this, 'wpc_add_to_cart_content_fragment_refresh']);
        }
        
    }


    /**
     * Create a shortcode to render the reservation form.
     * Print the reservation form's HTML code.
     */
    public function reservation_shortcode($atts){
        ob_start();

        $settings = $this->settings_obj;
        $result_data = apply_filters('wpcafe/action/reservation_template', $atts);
        
         $from_field_label = "From"; $to_field_label = "To"; $show_form_field = "on"; $show_to_field = "on";
        $from_to_column = "wpc-col-md-6"; $required_from_field = 'on'; $required_to_field = 'on';$view = 'yes'; 
        $column_lg = 'wpc-col-lg-6';$column_md = 'wpc-col-md-12'; $booking_button_text = "Book a table"; $cancell_button_text = "Request Cancellation";
        
        if ( is_array($result_data) ) {
            if ( isset( $result_data['calender_view']) ) {
                $view      = $result_data['calender_view'];
                $column_lg = isset($result_data['column_lg']) ? $result_data['column_lg'] : 'wpc-col-lg-6';
                $column_md = isset($result_data['column_md']) ? $result_data['column_md'] : 'wpc-col-md-12';
            }
            if(isset( $result_data['from_field_label'] ) && isset( $result_data['to_field_label'] )  ) {
                $from_field_label   =  $result_data['from_field_label'];
                $to_field_label     =  $result_data['to_field_label'];
                $show_form_field    =  $result_data['show_form_field'];
                $show_to_field      =  $result_data['show_to_field'];
                $required_from_field=  $result_data['required_from_field'];
                $required_to_field  =  $result_data['required_to_field'];

                if(!( $show_form_field =='on' && $show_to_field =='on' ) ){
                    $from_to_column = "wpc-col-md-12";
                }

                $booking_button_text = $result_data['form_booking_button'];
                $cancell_button_text = $result_data['form_cancell_button'];
            }
        }

        $seat_capacity  = isset( $result_data['seat_capacity'] ) ? $result_data['seat_capacity'] : 20;
        $booking_status = isset( $result_data['booking_status'] ) ? $result_data['booking_status']: '';

        $reservation_form_template = WPC_DIR . "/core/shortcodes/views/reservation/reservation-form-template.php";
        $cancellation_form_template = WPC_DIR . "/core/shortcodes/views/reservation/cancellation-form-template.php";

        ?>
        <div class="reservation_section">
            <?php

            if( file_exists( $reservation_form_template ) ){
                include $reservation_form_template;
            }

            if ( !empty( $settings['wpc_allow_cancellation'] ) && $settings['wpc_allow_cancellation'] !=="off" && file_exists( $cancellation_form_template )) {
                include $cancellation_form_template;
            }

            ?>
        </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Food menu shortcode
     */
    public function wpc_food_menu_tab($atts){
        if (!class_exists('Woocommerce')) { return; }
        $settings = array();

        $atts = extract(shortcode_atts([
            'style'                 => 'style-1',
            'wpc_food_categories'   => '',
            'no_of_product'         => 5,
            'wpc_desc_limit'        => 20,
            'wpc_menu_order'        => 'DESC',
            'wpc_show_desc'         => 'yes',
            'title_link_show'       => 'yes',
            'show_item_status'      => 'yes',
            'product_thumbnail'     => 'yes',
            'wpc_cart_button'       => 'yes',
        ], $atts));

        ob_start();
        $wpc_cat_arr  = explode(',', $wpc_food_categories);
        if (count($wpc_cat_arr) > 0) {
            $food_menu_tabs = [];
            foreach ($wpc_cat_arr as $key => $value) {
                if ($wpc_cat = get_term_by('id', $value, 'product_cat')) {
                    $wpc_get_menu_order = get_term_meta($wpc_cat->term_id, 'wpc_menu_order_priority', true);
                    $wpc_cat    = get_term_by('id', $value, 'product_cat');
                    $cat_name   = ($wpc_cat && $wpc_cat->name ) ? $wpc_cat->name : "";
                    $tab_data   = array('post_cats'=>[$value],'tab_title' => $cat_name);
                    if ($wpc_get_menu_order == '') {
                        $food_menu_tabs[$key] = $tab_data;
                    } else {
                        $food_menu_tabs[$wpc_get_menu_order] = $tab_data;
                    }
                }
            }
            // sort category list
            ksort($food_menu_tabs);
            $unique_id = md5(md5(microtime()));

            $settings["food_menu_tabs"]         = $food_menu_tabs;
            $settings["food_tab_menu_style"]    = $style;
            $settings["show_thumbnail"]         = $product_thumbnail;
            $settings["wpc_menu_order"]         = $wpc_menu_order;
            $settings["show_item_status"]       = $show_item_status;
            $settings["wpc_menu_count"]         = $no_of_product;
            $settings["wpc_show_desc"]          = $wpc_show_desc;
            $settings["wpc_desc_limit"]         = $wpc_desc_limit;
            $settings["title_link_show"]        = $title_link_show;
            $settings["wpc_cart_button"]        = $wpc_cart_button;
            // render template
            $template = WPC_CORE ."/shortcodes/views/food-menu/food-tab.php";
            if( file_exists( $template ) ){
                include $template;
            }
        }
        
        return ob_get_clean();
    }

    /**
     * Food menu list block
     */
    public function wpc_food_menu_list($atts){
        if (!class_exists('Woocommerce')) { return; }

        $atts = extract(shortcode_atts(
            [
                'style'      => 'style-1',
                'wpc_food_categories'   => '',
                'no_of_product'         => 5,
                'wpc_cart_button'       => 'yes',
                'product_thumbnail'     => 'yes',
                'show_item_status'      => 'yes',
                'wpc_show_desc'         => 'yes',
                'title_link_show'       => 'yes',
                'wpc_desc_limit'        => 20,
                'wpc_menu_order'        => 'DESC',
            ],
            $atts
        ));
        ob_start();
        // category sorting from backend
        $wpc_cat_arr      = explode(',', $wpc_food_categories);

        if (is_array($wpc_cat_arr) && count($wpc_cat_arr) > 0) {
            $unique_id = md5(md5(microtime()));
            $settings = array();
            $settings["food_menu_style"]        = $style;
            $settings["show_thumbnail"]         = $product_thumbnail;
            $settings["wpc_cart_button_show"]   = $wpc_cart_button;
            $settings["show_item_status"]       = $show_item_status;
            $settings["title_link_show"]        = $title_link_show;
            $settings["wpc_show_desc"]          = $wpc_show_desc;
            $settings["wpc_desc_limit"]         = 20;
            $settings["wpc_menu_cat"]           = $wpc_cat_arr;
            $settings["wpc_menu_count"]         = $no_of_product;
            $settings["wpc_menu_order"]         = $wpc_menu_order;
            // render template
            $template = WPC_CORE ."/shortcodes/views/food-menu/food-list.php";
            if( file_exists( $template ) ){
                include $template;
            }
        }
        return ob_get_clean();
    }

    /**
     * Mini cart for frontend
     *
     */
    public function wpc_custom_mini_cart(){
        if (!class_exists('WooCommerce')) {  return; }
        // show location
        if (is_front_page()) {
            Wpc_Utilities::get_location_details();
        }
        $settings       = $this->settings_obj;
        if ( !isset($settings['wpcafe_allow_cart']) || ( isset($settings['wpcafe_allow_cart'])
            && $settings['wpcafe_allow_cart'] == 'on' ) ) {
            $wpc_cart_icon  = !empty( $settings['wpc_mini_cart_icon'] ) ? $settings['wpc_mini_cart_icon'] : 'wpcafe-cart_icon';
            
            $custom_mini_cart = WPC_CORE ."/shortcodes/views/mini-cart/custom-mini-cart.php";
            
            if( file_exists($custom_mini_cart) ){
                include_once $custom_mini_cart;
            }
        }
    }

    /**
     * Cart count  function
     */
    public function wpc_add_to_cart_count_fragment_refresh($fragments){
        ob_start();
        ?>
        <div id="wpc-mini-cart-count">
            <?php echo WC()->cart->get_cart_contents_count(); ?>
        </div>
        <?php
        $fragments['#wpc-mini-cart-count'] = ob_get_clean();
        return $fragments;
    }

    /**
     * Cart count  function
     */
    public function wpc_add_to_cart_content_fragment_refresh($fragments){
        ob_start();
        ?>
        <div class="widget_shopping_cart_content">
            <?php
            is_object(WC()->cart) ? woocommerce_mini_cart() : '';
            ?>
        </div>
        <?php
        $fragments['div.widget_shopping_cart_content'] = ob_get_clean();
        return $fragments;
    }

    /**
     * Location field in checkout form
     *
     */
    public function wpc_location_checkout_form(){
        $checkout = WC()->checkout;
        ?>
        <div id="wpc_location_field">
            <?php
            // get loctaion
            $wpc_loctaion_arr = Wpc_Utilities::get_location_data();

            woocommerce_form_field('wpc_location_name', [
                'type'        => 'select',
                'class'       => ['wpc-location form-row-wide'],
                'label'       => esc_html__('Order location', 'wpcafe'),
                'placeholder' => esc_html__('Enter location', 'wpcafe'),
                'required'    => true,
                'options'     => $wpc_loctaion_arr,
            ], $checkout->get_value('wpc_location_name'));
            ?>
        </div>
        <?php
    }

    /**
     * Valid location select option
     *
     */
    public function wpc_validate_location(){
        if (sanitize_text_field(isset($_POST['wpc_location_name'])) && empty(sanitize_text_field($_POST['wpc_location_name']))) {
            wc_add_notice(esc_html__('Please select a location', 'wpcafe'), 'error');
        }
    }

    /**
     * Update location select option
     *
     * @param [type] $order
     */
    public function wpc_location_update_meta($order){

        if (sanitize_text_field(isset($_POST['wpc_location_name'])) && !empty(sanitize_text_field($_POST['wpc_location_name']))) {
            $order->update_meta_data('wpc_location_name', sanitize_text_field($_POST['wpc_location_name']));
        }
    }

    /**
     * Category new field for set priority
     */
    public function wpc_product_cat_taxonomy_add_new_meta_field(){
    ?>
        <div class="form-field">
            <label for="wpc_menu_order_priority"><?php esc_html_e('Order menu', 'wpcafe'); ?></label>
            <input type="text" name="wpc_menu_order_priority" id="wpc_menu_order_priority">
        </div>
    <?php
    }

    /**
     * Category edit field for set priority
     */
    public function wpc_product_cat_taxonomy_edit_meta_field($term){
        //getting term ID
        $term_id                 = $term->term_id;
        $wpc_menu_order_priority = get_term_meta($term_id, 'wpc_menu_order_priority', true);
        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="wpc_menu_order_priority"><?php esc_html_e('Order menu', 'wpcafe'); ?></label></th>
            <td>
                <input type="text" name="wpc_menu_order_priority" id="wpc_menu_order_priority" value="<?php echo esc_attr($wpc_menu_order_priority) ? esc_attr($wpc_menu_order_priority) : ''; ?>">
            </td>
        </tr>
        <?php
    }

    /**
     * Category save field for set priority
     */
    public function wpc_product_cat_taxonomy_save_meta_field($term_id){
        $wpc_menu_order_priority = filter_input(INPUT_POST, 'wpc_menu_order_priority');
        update_term_meta($term_id, 'wpc_menu_order_priority', $wpc_menu_order_priority);
    }

    /**
     * Order menu column added to category admin screen.
     */
    public function wpc_custom_fields_list_title($columns){
        $columns['wpc_menu_order_priority'] = esc_html__('Order menu', 'wpcafe');
        $columns['cat_id']                  = esc_html__('ID', 'wpcafe');
        return $columns;
    }

    /**
     * Order menu column value added to product category admin screen.
     */
    public function wpc_custom_fields_list_diplay($columns, $column, $id){
        if ('wpc_menu_order_priority' == $column) {
            $columns = esc_html(get_term_meta($id, 'wpc_menu_order_priority', true));
        } elseif ('cat_id' == $column) {
            $columns = esc_html($id);
        }

        return $columns;
    }

    /**
     * Custom inline css
     */
    public function wpc_custom_inline_css(){
        if (!class_exists('WooCommerce')) {
            return;
        }
        $settings       = $this->settings_obj;
        $template       = WPC_CORE . "/shortcodes/views/mini-cart//mini-cart.php";

        if( file_exists( $template ) ){
            include_once $template;
        }
    }
}
