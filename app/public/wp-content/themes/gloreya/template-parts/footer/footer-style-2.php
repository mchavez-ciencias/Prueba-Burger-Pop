<?php 
      $gloreya_back_to_top = gloreya_option('back_to_top');

     
   ?> 
   
      <footer class="ts-footer ts-footer-two" >
            <div class="container">
            <?php if(defined( 'FW' )): ?>
            <?php if( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ): ?> 
                  <div class="row">
                     <div class="col-md-4">
                        <?php  dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                     <div class="col-md-4">
                        <?php  dynamic_sidebar( 'footer-2' ); ?>
                     </div>
                     <div class="col-md-4">
                       <?php  dynamic_sidebar( 'footer-3' ); ?>
                     </div>
                     <!-- end col -->
                  </div>
                  <div class='footer-bar'> </div>
               <?php endif; ?>   
            <?php endif; ?> 
             
                  <div class="row copyright">
                     <div class="col-lg-6 col-md-7">
                       <div class="copyright-text">
                       <?php get_template_part( 'template-parts/navigations/nav', 'footer' ); ?>
                           <?php 
                              
                                 $copyright_text = gloreya_option('footer_copyright', 'Copyright © 2020 Gloreya. All Right Reserved.');
                              echo gloreya_kses($copyright_text);  
                           ?>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-5 align-self-center">
                     <?php if ( defined( 'FW' ) ) : ?>   
                           <div class="footer-social">
                              <ul>
                              <?php 
                                 $social_links = gloreya_option('footer_social_links',[]);                         
                                 foreach($social_links as $sl):
                                    $class = 'ts-' . str_replace('fa fa-', '', $sl['icon_class']);
                                    ?>
                                    <li class="<?php echo esc_attr($class); ?>">
                                          <a href="<?php echo esc_url($sl['url']); ?>" target="_blank">
                                          <i class="<?php echo esc_attr($sl['icon_class']); ?>"></i>
                                          </a>
                                    </li>
                                 <?php endforeach; ?>
                              </ul>
                        <?php endif; ?>     
                           </div>
                     </div>
               </div>
           </div>
      </footer>
        <!-- end footer -->
   <?php if($gloreya_back_to_top=="yes"): ?>
      <div class="BackTo">
         <a href="#" class="fa fa-angle-up" aria-hidden="true"></a>
      </div>
   <?php endif; ?>