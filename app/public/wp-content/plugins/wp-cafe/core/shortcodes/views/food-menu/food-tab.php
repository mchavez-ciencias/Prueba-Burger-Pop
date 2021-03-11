<?php
use WpCafe\Utils\Wpc_Utilities;

//check if woocommerce exists
if (!class_exists('Woocommerce')) { return; }

if( is_array( $food_menu_tabs ) && count( $food_menu_tabs )>0 ){
apply_filters( 'elementor/control/search_data' , $settings , $unique_id , 'wpc-food-menu-tab' );
$wpc_menu_count = is_array($settings) && isset($settings['wpc_menu_count']) ? $settings['wpc_menu_count'] : 5;
$wpc_show_desc  = is_array($settings) && isset($settings['wpc_show_desc']) ? $settings['wpc_show_desc'] : 'yes';
$show_thumbnail = is_array($settings) && isset($settings['show_thumbnail']) ? $settings['show_thumbnail'] : 'yes';
$title_link_show= is_array($settings) && isset($settings['title_link_show']) ? $settings['title_link_show'] : 'yes';
$class = ($title_link_show=='yes')? '' : 'wpc-no-link';
?>
<div class="wpc-food-tab-wrapper wpc-nav-shortcode main_wrapper_<?php echo esc_attr($unique_id)?>" data-id="<?php echo esc_attr($unique_id)?>">
    <ul class="wpc-nav">
        <?php
        if( is_array( $food_menu_tabs ) && count( $food_menu_tabs )>0 ){
            foreach ($food_menu_tabs as $tab_key => $value) {
                $active_class = (($tab_key == array_keys($food_menu_tabs)[0]) ? 'wpc-active' : ' ');
                $cat_id       = isset($value['post_cats'][0] ) ? intval( $value['post_cats'][0] ) : 0 ;
                ?>
                <li>
                    <a href='#' class='wpc-tab-a <?php echo esc_attr($active_class); ?>' data-id='tab_<?php echo intval($tab_key); ?>'
                    data-cat_id='<?php echo esc_attr( $cat_id ); ?>'>
                        <span><?php echo esc_html($value['tab_title']); ?></span>
                    </a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <div class="wpc-tab-content wpc-widget-wrapper">
        <?php
            foreach ($food_menu_tabs as $content_key => $value) {
                if(isset( $value['post_cats'][0] )){
                    $active_class = (($content_key == array_keys($food_menu_tabs)[0]) ? 'tab-active' : ' ');
                    $cat_id = isset($value['post_cats'][0] ) ? intval( $value['post_cats'][0] ) : 0 ;
                    ?>
                    <div class='wpc-tab <?php echo esc_attr($active_class); ?>' data-id='tab_<?php echo intval($content_key); ?>'
                    data-cat_id='<?php echo  esc_attr($cat_id);?>'>
                    <div class="tab_template_<?php echo esc_attr( $cat_id.'_'.$unique_id );?>"></div>
                        <div class="template_data_<?php echo esc_attr( $cat_id.'_'.$unique_id );?>">
                        <?php
                        $products = Wpc_Utilities::product_query( "product", $wpc_menu_count , $value['post_cats'], $wpc_menu_order );
                        include WPC_DIR . "/widgets/wpc-food-menu-tab/style/{$style}.php";
                        ?>
                        </div>
                    </div><!-- Tab pane 1 end -->
                    <?php 
                }
            } 
        ?>
    </div><!-- Tab content-->
</div>
<?php
}
return;

