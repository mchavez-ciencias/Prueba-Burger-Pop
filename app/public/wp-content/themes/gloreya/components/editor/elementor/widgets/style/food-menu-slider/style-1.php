<?php

use \WpCafe\Utils\Wpc_Utilities as Wpc_Utilities;

$class = (($title_link_show == 'yes') ? '' : 'wpc-no-link');
?>

<div class='gloreya-food-slider1 wpc-food-menu-slider wpc-widget-wrapper ' data-count="<?php echo esc_attr($gloreya_slider_count); ?>">
    <div class="swiper-wrapper">
        <?php
        if ( is_array( $products ) && count( $products )>0 ) { 
            foreach ($products as $product) {
                $price = $product->get_price_html(); // true for getting tax price 
                $current_tags = get_the_terms( $product->get_id() , 'product_tag');
                $permalink = (($title_link_show == 'yes') ? get_the_permalink( $product->get_id() ) : '');
                ?>
                <div class="swiper-slide">
                    <div class="wpc-food-menu-item wpc-slider-grid-3">
                        <?php if ($show_thumbnail == 'yes') : ?>
                            <!-- thumbnail -->
                                <div class="wpc-food-menu-thumb wpc-post-bg-img" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url( $product->get_id())); ?>);">
                                    <a href="<?php echo esc_url($permalink); ?>" class="wpc-img-link <?php echo esc_attr($class); ?>">
                                    </a>
                                    <div class="wpc-menu-tag-wrap">
                                        <?php
                                        //only start if we have some tags
                                        if ($show_item_status == 'yes' && $current_tags && !is_wp_error($current_tags)) { ?>
                                            <!-- create a list to hold our tags -->
                                            <ul class="wpc-menu-tag">
                                                <!-- for each tag we create a list item -->
                                                <?php
                                                foreach ($current_tags as $tag) {
                                                    $tag_title = $tag->name; // tag name
                                                ?>
                                                    <li> <?php echo esc_html__($tag_title, 'wpcafe-pro'); ?> </li>

                                                <?php
                                                } ?>

                                            </ul>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <span class="wpc-menu-currency"><span class="wpc-menu-price"><?php echo Wpc_Utilities::wpc_kses($price); ?></span></span>
                                </div>
                        <?php endif; ?>
                        <div class="wpc-food-inner-content">

                            <h3 class="wpc-post-title">
                                <a href="<?php echo esc_url($permalink); ?>" class="<?php echo esc_attr($class); ?>"><?php echo esc_html( get_the_title( $product->get_id() ) );  ?> </a>
                            </h3>

                            <?php if ($gloreya_show_desc == 'yes') { ?>
                                <p>
                                    <?php echo Wpc_Utilities::wpcafe_trim_words(get_the_excerpt(  $product->get_id() ), $gloreya_desc_limit); ?>
                                </p>
                            <?php  } ?>
                            <?php
                            // show cart button
                            echo  Wpc_Utilities::product_add_to_cart($product, $gloreya_cart_button, $gloreya_btn_text, $customize_btn,  $unique_id);

                            ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <?php if ($gloreya_slider_nav_show == 'yes') : ?>
        <!-- next / prev arrows -->
        <div class="swiper-button-next"> <i class="wpcafe-next"></i> </div>
        <div class="swiper-button-prev"> <i class="wpcafe-previous"></i> </div>
        <!-- !next / prev arrows -->
    <?php endif; ?>
    <?php if ($gloreya_slider_dot_show == 'yes') : ?>
        <!-- pagination dots -->
        <div class="swiper-pagination"></div>
        <!-- !pagination dots -->
    <?php endif; ?>
</div>