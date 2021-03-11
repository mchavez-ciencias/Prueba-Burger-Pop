<?php
    use WpCafe\Utils\Wpc_Utilities;

    $style               = $settings["food_menu_style"];
    $show_item_status    = $settings["show_item_status"];
    $show_thumbnail      = $settings["show_thumbnail"];
    $title_link_show     = $settings["title_link_show"];
    $wpc_cart_button     = $settings["wpc_cart_button_show"];
    $wpc_show_desc       = $settings["wpc_show_desc"];
    $wpc_desc_limit      = $settings["wpc_desc_limit"];
    $wpc_menu_cat        = $settings["wpc_menu_cat"];
    $wpc_menu_count      = $settings["wpc_menu_count"];
    $wpc_menu_order      = $settings["wpc_menu_order"];
    $show_thumbnail      = $settings["show_thumbnail"];
    $no_desc_class = ($wpc_show_desc != 'yes') ? 'wpc-no-desc' : '';
    
    apply_filters( 'elementor/control/search_data' , $settings , $unique_id , 'wpc-menus-list' );
    ?>
    <div class="wpc-nav-shortcode main_wrapper_<?php echo esc_attr($unique_id .' '. $no_desc_class)?>" data-id="<?php echo esc_attr($unique_id)?>">
        <div class="list_template_<?php echo esc_attr($unique_id) ?> wpc-nav-shortcode wpc-widget-wrapper">
            <?php
            $products = Wpc_Utilities::product_query("product", $wpc_menu_count, $wpc_menu_cat, $wpc_menu_order);
            include WPC_DIR . "/widgets/wpc-menus-list/style/{$style}.php";
            ?>
        </div>
    </div>
    <?php
    return;