<?php
/**
 * content.php
 *
 * The default template for displaying content.
 */
                  
$blog_cat_show	    = (isset($settings['show_cat'])) 
						? $settings['show_cat'] 
						: $settings['show_cat'] ;
$thumb 					= (isset($thumb))
						? $thumb
                  : [1000, 500];
$crop					= (isset($settings['post_title_crop']))
						? $settings['post_title_crop']
                  : 20;
$show_rating      =   (isset($settings['show_rating']))
                      ? $settings['show_rating']
                      :'no'; 
$rating_bar_color =   (isset($settings['rating_bar_color']))
                      ? $settings['rating_bar_color']
                      :'#bc906b'; 

 

?>
   

<div class="row m-10">
    <?php
      foreach($value as $b_key => $slider){
         $column = count($value);
         $lg = $column==2 ? '6' : '3';
         $md = $column==1 ? '12' : '6';
         ?>
         
         <div class="col-lg-<?php echo esc_attr($b_key==0 ? $md : $lg) ?> slide-item">
            <div class="item ts-overlay-style" style="background-image:url(<?php echo esc_attr(esc_url(get_the_post_thumbnail_url($slider->ID))); ?>)">
               <a href="<?php the_permalink($slider->ID); ?>" class="img-link"></a>
               <div class="post-content">
               <?php if($show_rating=='yes'): ?> 
                     <?php $returnRat = gloreya_review_rating( [ 'post-id' =>  $slider->ID, 'ratting-show' => 'no', 'ratting-style' => 'pie', 'count-show' => 'no', 'vote-show' => 'no', 'vote-text' => 'Review', 'return-type' => 'get_all' ]); 
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
                     <h3 class="post-title">
                        <a href="<?php the_permalink($slider->ID); ?>">
                        <?php echo esc_html($column); ?>
                        <?php echo esc_html(wp_trim_words(get_the_title($slider->ID), $crop,'')); ?>
                        </a>
                     </h3>
                     <?php if($blog_cat_show == 'yes'): ?> 
                        <ul class="post-meta-info">
                        <?php
                           $categories = get_the_category($slider->ID);
                           foreach ( $categories as $category ) {
                              echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" >' . esc_html( $category->name ).'</a></li>';
                           }
                        ?>
                     </ul>  
                     <?php endif; ?>
               </div>
            </div>
         </div>
           
         <?php

      }
   ?>
     

   </div>
 

