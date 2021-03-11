<?php

namespace WpCafe\Core\Shortcodes;
use \WpCafe\Utils\Wpc_Utilities;

defined( 'ABSPATH' ) || exit;

class Template_Functions {

    /**
     * Food Menu List Template One
     */
    public static function wpc_food_menu_list_template($show_thumbnail,$permalink, $wpc_cart_button, $unique_id, $product, $class,$show_item_status,$wpc_show_desc,$col,$wpc_desc_limit ){
        ?>
          <div class="wpc-food-menu-item wpc-row">
            <?php 
            if ($show_thumbnail == 'yes' || $show_thumbnail == 'on') { ?>
                <div class="wpc-col-md-4">
                    <!-- thumbnail -->
                    <?php if ($product->get_image()) { ?>
                        <div class="wpc-food-menu-thumb">
                            <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr($class); ?>">
                                <?php  echo Wpc_Utilities::wpc_kses( $product->get_image() )?>
                            </a>
                        </div>
                        
                    <?php  } ?>
                </div>
            <?php }  ?>
            <div class="<?php echo esc_attr($col); ?>">
                <div class="wpc-food-inner-content">
                    <!-- product tag and tax -->
                    <div class="wpc-menu-tag-wrap">
                        <?php
                        $show_item_status == 'yes' ? Wpc_Utilities::wpc_tag( $product->get_id() , $product->is_in_stock() ) : "";
                        if ($product->get_price_suffix() != '') { ?>
                            <ul class="wpc-menu-tag">
                                <li>
                                    <?php if (wc_get_price_including_tax($product)) {
                                        // get percentage tax
                                        echo Wpc_Utilities::wpc_kses($product->get_price_suffix());
                                    } ?>
                                </li>
                            </ul>
                            <?php 
                        } ?>
                    </div>
                
                    <h3 class="wpc-post-title wpc-title-with-border">
                        <a href="<?php echo esc_url($permalink); ?>" class="<?php echo esc_attr($class); ?>"> <?php echo esc_html($product->get_name());  ?> </a>
                        <span class="wpc-title-border"></span>
                        <?php 
                        if( $product->get_type() !== 'variable' ) {
                            ?>
                            <span class="wpc-menu-price"><?php echo Wpc_Utilities::wpc_kses( $product->get_price_html() ); ?></span></span>
                            <?php 
                        } else { 
                            // variation price 
                            $variation_price = $product->get_variation_prices( true ); // true for getting tax price 
                            $var_price = '';
                            if( is_array( $variation_price ) && isset( $variation_price['price'] ) ){
                                $var_price = get_woocommerce_currency_symbol() . array_shift($variation_price['price']) ."-". get_woocommerce_currency_symbol() . array_pop($variation_price['price']);
                            }

                            ?>
                            <span class="wpc-menu-currency"><span class="wpc-menu-price"><?php echo esc_html($var_price); ?></span></span>
                            <?php 
                        } 
                        ?>
                    </h3>
                    <p>
                        <?php
                        if ($wpc_show_desc == 'yes') {
                            echo  Wpc_Utilities::wpcafe_trim_words( get_the_excerpt( $product->get_id() ) , $wpc_desc_limit);
                        }
                        ?>
                    </p>
                    <?php
                        // cart button
                        echo  Wpc_Utilities::product_add_to_cart( $product, $wpc_cart_button, '', '',$unique_id );
                    ?>
                </div>
            </div>
        </div>

        <?php
    }

        /**
     * Food Menu List Template One
     */
    public static function wpc_food_menu_list_template_two($show_thumbnail,$permalink, $wpc_cart_button, $unique_id, $product, $class,$show_item_status,$wpc_show_desc,$wpc_desc_limit ){
        ?>

        <div class="wpc-food-menu-item style2">
                <div class="wpc-row">
                    <div class="wpc-col-md-8 wpc-align-self-center">
                        <div class="wpc-food-inner-content">
                            <!-- display tag -->
                        <div class="wpc-menu-tag-wrap">
                        <?php
                        $show_item_status == 'yes' ? Wpc_Utilities::wpc_tag( $product->get_id() , $product->is_in_stock() ) : "";
                        $price = Wpc_Utilities::menu_price_by_tax( $product );
                        ?>
                             <?php 
                               if ($show_item_status == 'yes' && $product->get_price_suffix() != '') { 
                            ?>
                                <ul class="wpc-menu-tag">
                                    <li>
                                        <?php 
                                    if (wc_get_price_including_tax($product)) {
                                        // get percentage tax
                                        echo Wpc_Utilities::wpc_kses($product->get_price_suffix());
                                    } 
                                    ?>
                                    </li>
                                </ul>
                                <?php 
                                } 
                            ?>
                            </div>
                            <h3 class="wpc-post-title">
                                <a href="<?php echo esc_url( $permalink ); ?>"
                                    class="<?php echo esc_attr( $class); ?>"><?php echo esc_html($product->get_name());  ?>
                                </a>

                            </h3>
                            <?php  if( $wpc_show_desc == 'yes' ){ ?>
                            <p>
                                <?php echo  Wpc_Utilities::wpcafe_trim_words( get_the_excerpt($product->get_id() ), $wpc_desc_limit); ?>
                            </p>
                            <?php } ?>

                        </div>
                    </div>
                    <!-- thumbnail -->
                    <?php 
                    if ( $show_thumbnail == 'yes' ) {

                        if ($product->get_image()) { 
                            ?>
                                <div class="wpc-col-md-4">
                                    <div class="wpc-food-menu-thumb">
                                        <?php 
                                    if( $product->get_type() !== 'variable' ) {
                                        ?>
                                        <span
                                            class="wpc-menu-currency"><?php echo Wpc_Utilities::wpc_render( get_woocommerce_currency_symbol() ); ?>
                                            <span class="wpc-menu-price"><?php echo esc_html($price); ?></span></span>
                                        <?php 
                                    } else { 
                                        // variation price 
                                        $variation_price = $product->get_variation_prices( true ); // true for getting tax price 
                                        $var_price = '';
                                        if( is_array( $variation_price ) && isset( $variation_price['price'] ) ){
                                            $var_price = get_woocommerce_currency_symbol().array_shift($variation_price['price']) ."-". get_woocommerce_currency_symbol().array_pop($variation_price['price']);
                                        }

                                        ?>
                                        <span class="wpc-menu-currency"><span
                                                class="wpc-menu-price"><?php echo esc_html($var_price); ?></span></span>
                                        <?php 
                                        } 
                                        ?>
                                        <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
                                            class="<?php echo esc_attr( $class ); ?>">
                                            <?php
                                            echo Wpc_Utilities::wpc_kses( $product->get_image() ) ?>
                                        </a>
                                        <?php
                                        // cart button
                                        echo  Wpc_Utilities::product_add_to_cart( $product, $wpc_cart_button, '', '', $unique_id );
                                    ?>
                                    </div>
                                </div>
                                <?php 
                        } 
                    }
                 ?>
                </div>
            </div>
        <?php
    }
  
}
