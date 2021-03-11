<h3 class="wpc-tab-title"><?php esc_html_e('Shortcodes', 'wpcafe'  ); ?></h3>

<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="wpc_reservation_form"><?php esc_html_e('Reservation Form', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("Use this [wpc_reservation_form wpc_image_url='' form_style='2'] shortcode anywhere you want to show the reservation form",  'wpcafe'  );?></div>
    </div>
    <div class="wpc-meta">
        <input class="wpc-settings-input" id="reservation_form_shortcode" type="text" name="wpc_reservation_form" 
        value="[wpc_reservation_form wpc_image_url='' form_style='2']"
        readonly />
        <button type="button" onclick="copyTextData('reservation_form_shortcode');" class="wpc_copy_button wpc-btn"><span class="dashicons dashicons-category"></span></button>
    </div>
</div>
<?php
    apply_filters('wpcafe/key_options/hook_settings',false);
?>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="show_food_menu"><?php esc_html_e('Show Food Menu tab', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("You can use [wpc_food_menu_tab wpc_food_categories='16,21,18,17,20,21'  no_of_product='5'  product_thumbnail ='yes' wpc_cart_button ='yes' wpc_menu_order='DESC' wpc_show_desc='yes' wpc_desc_limit='20' title_link_show='yes' show_item_status='yes']",  'wpcafe'  );?></div>
    </div>
    <div class="wpc-meta">
        <input type="text" id="food_menu_shortcode_tab" class="wpc-settings-input"
        value="[wpc_food_menu_tab wpc_food_categories='16,21,18,17,20,21'  no_of_product='5'  product_thumbnail ='yes' wpc_cart_button ='yes' wpc_menu_order='DESC' wpc_show_desc='yes' wpc_desc_limit='20' title_link_show='yes' show_item_status='yes']"
        readonly />
        <button type="button" onclick="copyTextData('food_menu_shortcode_tab');" class="wpc_copy_button wpc-btn"><span class="dashicons dashicons-category"></span></button>
    </div>
</div>
<div class="wpc-label-item">
    <div class="wpc-label">
        <label for="food_menu_shortcode_list"><?php esc_html_e('Show Food Menu List', 'wpcafe'  ); ?></label>
        <div class="wpc-desc"> <?php esc_html_e("You can use [wpc_food_menu_list wpc_food_categories='16,21,18,17,20,21'  no_of_product='5'  wpc_cart_button ='yes' product_thumbnail ='yes' wpc_menu_order='DESC' wpc_show_desc='yes' wpc_desc_limit='20' title_link_show='yes' show_item_status='yes']",  'wpcafe'  );?></div>
    </div>
    
    <div class="wpc-meta">
    <input type="text" id="food_menu_shortcode_list" class="wpc-settings-input"
        value="[wpc_food_menu_list wpc_food_categories='16,21,18,17,20,21'  no_of_product='5'  wpc_cart_button ='yes' product_thumbnail ='yes' wpc_menu_order='DESC' wpc_show_desc='yes' wpc_desc_limit='20' title_link_show='yes' show_item_status='yes']"
        readonly />
        <button type="button" onclick="copyTextData('food_menu_shortcode_list');" class="wpc_copy_button wpc-btn"><span class="dashicons dashicons-category"></span></button>
    </div>
</div>
<?php
return;