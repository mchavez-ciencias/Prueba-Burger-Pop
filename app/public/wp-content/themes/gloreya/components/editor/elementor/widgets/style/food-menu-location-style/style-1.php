<div class="wpc-row">
    <?php foreach ($cats as $value) { ?>
        <div class="wpc-col-lg-<?php echo esc_attr($grid_column); ?> wpc-col-md-6 ">
            <?php
            $term = get_term($value, $taxonomy);
            $term_link = get_term_link($term->slug, $taxonomy);
            $img = fw_get_db_term_option($term->term_id, 'wpcafe_location', 'gloryea_location_image');
            $image_url = (!empty($img['url']) ? $img['url'] : '');
            ?>
            <div class="wpc-single-cat-item">
                <?php if (isset($image_url) && $image_url != '') { ?>
                    <div class="wpc-cat-thumb" style="background-image: url(<?php echo esc_url($image_url); ?>);">
                        <a href="<?php echo esc_url($term_link); ?>" class="wpc-img-link"></a>
                    </div>
                <?php } else { ?>
                    <div class="wpc-cat-thumb"></div>
                <?php } ?>
                <h3 class="wpc-category-title">
                    <a href="<?php echo esc_url($term_link); ?>">
                        <?php
                        echo esc_html($term->name);
                        if ('yes' == $show_count) { ?>
                            <span class="menu-count">
                                ( <?php echo esc_html($term->count); ?> )
                            </span>
                        <?php } ?>
                    </a>

                </h3>

            </div>
        </div>
    <?php } ?>
</div>