<?php
 

   if ( defined( 'FW' ) ) { 
   // off canvas 
   $header_offcanvas_settings = gloreya_option("header_offcanvas_settings");

   $offcanvas_desc  = $header_offcanvas_settings['offcanvas_desc'];
   $offcanvas_email_icon  = $header_offcanvas_settings['offcanvas_email_icon'];
   $offcanvas_email  = $header_offcanvas_settings['offcanvas_email'];
   $offcanvas_phone_icon  = $header_offcanvas_settings['offcanvas_phone_icon'];
   $offcanvas_phone_number  = $header_offcanvas_settings['offcanvas_phone_number'];
   }else{

   //  off canvas 
   $offcanvas_desc= '';
   $offcanvas_email_icon =[];
   $offcanvas_email = '';
   $offcanvas_phone_icon = [];
   $offcanvas_phone_number = '';

   }

?>
<!-- sidebar cart item -->
<div class="xs-sidebar-group info-group">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget">
                <i class="icon icon-cross"></i>
                </a>
            </div>
            <div class="sidebar-textwidget">
                <div class="sidebar-logo-wraper">
                    <a class="navbar-brand" href="<?php echo esc_url( home_url('/')); ?>">                        <img src="<?php 
                           echo esc_url(
                              gloreya_src(
                                 'offcanvas_logo',
                                 GLOREYA_IMG . '/logo/logo.png'
                              )
                           );
                        ?>" alt="<?php bloginfo('name'); ?>">
                     </a>
                </div>
                <div class="off-canvas-desc">
                     <?php if(isset($offcanvas_desc) && $offcanvas_desc !=''){
                        echo gloreya_kses($offcanvas_desc);
                     } ?>
                </div>
                
 

                <ul class="sideabr-list-widget">
                <?php if(isset( $offcanvas_email) &&  $offcanvas_email !=''): ?>
                    <li>
                        <div class="media">
                           <?php if(isset($offcanvas_email_icon) && $offcanvas_email_icon!=''): ?>
                              <div class="d-flex">
                                <i class="<?php echo esc_attr($offcanvas_email_icon); ?>"></i>
                              </div>
                              <?php endif; ?>
                            <div class="media-body">
                                <span><?php echo esc_html($offcanvas_email); ?></span>
                            </div>
                        </div><!-- address 1 -->
                    </li>
                  <?php endif; ?>
    
                <?php if(isset( $offcanvas_phone_number) &&  $offcanvas_phone_number !=''): ?>
                    <li>
                        <div class="media">
                           <?php if(isset($offcanvas_phone_icon) && $offcanvas_phone_icon!=''): ?>
                              <div class="d-flex">
                                <i class="<?php echo esc_attr($offcanvas_phone_icon); ?>"></i>
                              </div>
                              <?php endif; ?>
                            <div class="media-body">
                                <span><?php echo esc_html($offcanvas_phone_number); ?></span>
                            </div>
                        </div><!-- address 1 -->
                    </li>
                  <?php endif; ?>
              
                 
                </ul><!-- .sideabr-list-widget -->

                <?php $social_links = gloreya_option('general_social_links',[]);  ?>
                  <ul class="social-list version-2">
                  <?php 
                  
                     if(count($social_links)):  
                        $class= ''; 
                        foreach($social_links as $sl):
                           if( isset( $sl['icon_class']))  :
                              $class = 'ts-' . str_replace('fa fa-', '', $sl['icon_class']);
                              $title = $sl["title"];
                           endif; 
                  ?>
                        <li class="<?php echo esc_attr($class); ?>">
                           <a title="<?php echo esc_attr($title); ?>" href="<?php echo esc_url($sl['url']); ?>">
                            <i class="<?php echo esc_attr($sl['icon_class']); ?>"></i>
                           </a>
                        </li>
                  <?php endforeach; ?>
               <?php endif; ?>
            </ul>
               
            </div>
        </div>
    </div>
</div>    <!-- END sidebar widget item -->    <!-- END offset cart strart -->

