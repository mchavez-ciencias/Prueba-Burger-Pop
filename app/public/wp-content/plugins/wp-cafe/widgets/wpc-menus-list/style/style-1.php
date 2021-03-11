<?php

use \WpCafe\Utils\Wpc_Utilities;
use \WpCafe\Core\Shortcodes\Template_Functions as Wpc_Widget_Template;

$col = ($show_thumbnail == 'yes') ? 'wpc-col-md-8' : 'wpc-col-md-12';
$class = ($title_link_show=='yes')? '' : 'wpc-no-link';
foreach ($products as $product) { 
    $permalink = ( $title_link_show == 'yes' ) ?  get_permalink($product->get_id()) : '#';
    ?>
     <?php Wpc_Widget_Template::wpc_food_menu_list_template($show_thumbnail,$permalink, $wpc_cart_button, $unique_id, $product, $class,$show_item_status,$wpc_show_desc,$col,$wpc_desc_limit ); ?>
    <?php 
}