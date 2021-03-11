<?php
defined('ABSPATH') || exit;

use \WpCafe\Utils\Wpc_Utilities as Wpc_Utilities;

$col = ($show_thumbnail == 'yes') ? 'wpc-col-md-9' : 'wpc-col-md-12';

$class = (($title_link_show == 'yes') ? '' : 'wpc-no-link');


if (is_array($products) && count($products) > 0) : ?>
    <div class="wpc-food-block-tab-item wpc-food-tab-style3 wpc-row">
        <?php foreach ($products as $product) :
            $price = $product->get_price_html(); // true for getting tax price 
            $current_tags = get_the_terms($product->get_id(), 'product_tag');
            $permalink = (($title_link_show == 'yes') ? get_the_permalink($product->get_id()) : '');
        ?>
            <div class="wpc-col-lg-<?php echo esc_attr($wpc_menu_col); ?> wpc-col-md-12">
                <div class="wpc-food-menu-item wpc-row">
                    <?php if ($show_thumbnail == 'yes') : ?>
                        <div class="wpc-col-md-3">
                            <!-- thumbnail -->
                            <?php if ($product->get_image()) { ?>
                                <div class="wpc-food-menu-thumb">
                                    <a href="<?php echo esc_url($permalink); ?>" class="<?php echo esc_attr($class); ?>">
                                        <?php echo Wpc_Utilities::wpc_kses($product->get_image()) ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endif; ?>
                    <div class="<?php echo esc_attr($col); ?>">
                        <div class="wpc-food-inner-content">
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
                                            <li> <?php echo esc_html($tag_title); ?> </li>

                                        <?php
                                        } ?>

                                    </ul>
                                <?php
                                }
                                ?>
                             
                            </div>
                            <h3 class="wpc-post-title wpc-title-with-border">
                                <a href="<?php echo esc_url($permalink); ?>" class="<?php echo esc_attr($class); ?>"><?php echo esc_html(get_the_title($product->get_id()));  ?> </a>
                                <span class="wpc-title-border"></span>
                                <span class="wpc-menu-currency"><span class="wpc-menu-price"><?php echo Wpc_Utilities::wpc_kses($price); ?></span></span>

                            </h3>
                         

                            <?php if ($wpc_show_desc == 'yes') { ?>
                                <p>
                                    <?php echo  Wpc_Utilities::wpcafe_trim_words(get_the_excerpt($product->get_id()), $wpc_desc_limit); ?>
                                </p>
                            <?php  } ?>
                            <?php
                            // show cart button
                            echo  Wpc_Utilities::product_add_to_cart($product, $wpc_cart_button, $wpc_btn_text, $customize_btn,  $unique_id);

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div><!-- block-item6 -->
<?php endif; ?>