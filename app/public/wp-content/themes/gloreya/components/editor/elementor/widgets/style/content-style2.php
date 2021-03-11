<?php
 
   $crop        = (isset($settings['post_title_crop'])) 
                     ? $settings['post_title_crop'] 
                     : '20'; 
   $thumb 			= (isset($thumb))
						? $thumb
                  : [600, 398];
   $blog_cat_show	    = (isset($settings['show_cat'])) 
						? $settings['show_cat'] 
                  : $settings['show_cat'] ;
   $show_rating      =   (isset($settings['show_rating']))
                      ? $settings['show_rating']
                      :'no'; 
   $rating_bar_color =   (isset($settings['rating_bar_color']))
                      ? $settings['rating_bar_color']
                      :'#bc906b'; 
?>

<div class="post-block-style">
                                                     
      <div class="post-thumb">
          <div class="item ts-overlay-style" style="background-image:url(<?php echo esc_attr(esc_url(get_the_post_thumbnail_url())); ?>)">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="img-link" rel="bookmark" title="<?php the_title_attribute(); ?>"></a>
          
          </div>
      </div>
      <div class="post-content">
         
      <?php if($show_rating=='yes'): ?> 
                <?php $returnRat = gloreya_review_rating( [ 'post-id' =>  get_the_ID(), 'ratting-show' => 'no', 'ratting-style' => 'pie', 'count-show' => 'no', 'vote-show' => 'no', 'vote-text' => 'Review', 'return-type' => 'get_all' ]); 
                 $total_avg =  isset($returnRat['only_avg']) ? $returnRat['only_avg'] : 0;
                 $total_review =  isset($returnRat['total_review']) ? $returnRat['total_review'] : 0;
                 $total_percentage =  isset($returnRat['percentage']) ? $returnRat['percentage'] : 0;
                 //fw_print( $total_avg );
                ?> 
                <div class="gloreya-rating">
                     <div class="gloreya-review-percent">
                        <span data-bar-color="<?php echo esc_attr($rating_bar_color); ?>" class="review-chart" data-percent="<?php echo esc_attr($total_percentage); ?>">
                           <span class="total-avg"><?php echo  esc_html($total_avg); ?> </span>
                        </span>
                        <span><?php echo esc_html($total_review . ' Reviews', 'gloreya'); ?></span>
                     </div>
                </div>
            
            <?php endif; ?>

        
         <h4 class="post-title">
               <a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                  <?php echo esc_html(wp_trim_words( get_the_title() ,$crop,'') );  ?>
               </a>
         </h4>
         <?php if($blog_cat_show == 'yes'): ?> 
                  <ul class="post-meta-info">
                  <?php
                     $categories = get_the_category();
                     foreach ( $categories as $category ) {
                        echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" >' . esc_html( $category->name ).'</a></li>';
                     }
                  ?>
               </ul>  
          <?php endif; ?>
      </div><!-- Post content end -->
</div><!-- Post block style end -->