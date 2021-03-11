<?php
use \WpCafe\Core\Shortcodes\Template_Functions as Wpc_Widget_Template;

$col = ($show_thumbnail == 'yes' || $show_thumbnail == 'on') ? 'wpc-col-md-8' : 'wpc-col-md-12';
$class = ( ($title_link_show == 'yes') ? '' : 'wpc-no-link' );
if ( is_array( $products ) && count( $products )>0 ) { 
    ?>

    
<div class="wpc-food-block-tab-item wpc-tab-block1">
    <div class="wpc-row">
        <?php
             foreach ($products as $product) {
              $permalink = ( ($title_link_show == 'yes') ? get_permalink( $product->get_id() ) : '');
            ?>
        <div class="wpc-col-lg-6">
             <?php Wpc_Widget_Template::wpc_food_menu_list_template_two($show_thumbnail,$permalink, $wpc_cart_button, $unique_id, $product, $class,$show_item_status,$wpc_show_desc,$wpc_desc_limit ); ?>
        </div>
        <?php
            }
            ?>
    </div>
</div><!-- block-item6 -->
<?php 
}