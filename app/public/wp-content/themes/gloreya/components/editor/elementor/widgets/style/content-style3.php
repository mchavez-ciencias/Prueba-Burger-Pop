<?php
 
  $show_desc = (isset($settings['show_desc'])) 
                     ? $settings['show_desc'] 
                     : 'no'; 
  $post_content_crop = (isset($settings['post_content_crop'])) 
                     ? $settings['post_content_crop'] 
                     : '20'; 
   $blog_cat_show	    = (isset($settings['show_cat'])) 
                     ? $settings['show_cat'] 
                     : $settings['show_cat'] ;
  $crop        = (isset($settings['post_title_crop'])) 
                     ? $settings['post_title_crop'] 
                     : '20'; 
$show_rating      =   (isset($settings['show_rating']))
                     ? $settings['show_rating']
                     :'no'; 
 $rating_bar_color      =   (isset($settings['rating_bar_color']))
                      ? $settings['rating_bar_color']
                      :'#bc906b'; 

?>

<div class="post-block-style">
   <div class="row">
      <div class="col-lg-6">
         <div class="post-thumb">
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
         </div>
      </div>

      <div class="col-lg-6">
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
                        <span  data-bar-color="<?php echo esc_attr($rating_bar_color); ?>" class="review-chart" data-percent="<?php echo esc_attr($total_percentage); ?>">
                           <span class="total-avg"><?php echo  esc_html($total_avg); ?> </span>
                        </span>
                        <span><?php echo esc_html($total_review . ' Reviews', 'gloreya'); ?></span>
                     </div>
                </div>
            
            <?php endif; ?>
             
               <h4 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo esc_html(wp_trim_words( get_the_title() ,$crop,'') );  ?></a></h4>
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
               <?php if($show_desc=='yes'): ?>
                  <p> <?php echo esc_html(wp_trim_words(get_the_content(),$post_content_crop,'')); ?> </p>
               <?php endif; ?>

             
         </div><!-- Post content end -->
      </div>
   </div>
</div><!-- Post block style end -->