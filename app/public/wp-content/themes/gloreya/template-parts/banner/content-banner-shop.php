<?php
/**
 * Blog Header
 *
 */
 
$gloreya_banner_bg	 = $gloreya_banner_title = $gloreya_banner_subtitle = '';
$gloreya_header_style    = 'standard';
 
if ( defined( 'FW' ) ) {
    
    $gloreya_banner_settings = gloreya_option('shop_banner_settings');
    //Page settings
    $gloreya_header_style    = gloreya_option('header_layout_style', 'standard');

    $gloreya_show = (isset($gloreya_banner_settings['show'])) ? $gloreya_banner_settings['show'] : 'yes'; 
    $gloreya_show_breadcrumb = (isset($gloreya_banner_settings['show_breadcrumb'])) ? $gloreya_banner_settings['show_breadcrumb'] : 'yes';

    $gloreya_banner_title = (isset($gloreya_banner_settings['title']) && $gloreya_banner_settings['title'] != '') ? 
                        $gloreya_banner_settings['title'] : esc_html__('Products','gloreya');
    $gloreya_single_title = (isset($gloreya_banner_settings['single_title']) && $gloreya_banner_settings['single_title'] != '') ? 
                        $gloreya_banner_settings['single_title'] : esc_html__('Products','gloreya');

    $gloreya_banner_image = ( is_array($gloreya_banner_settings['image']) && $gloreya_banner_settings['image']['url'] != '') ? 
                        $gloreya_banner_settings['image']['url'] : GLOREYA_IMG.'/banner/banner_image.png';

}else{
    $gloreya_banner_image =GLOREYA_IMG.'/banner/banner_image.png';
    $gloreya_banner_title = esc_html__('Shop','gloreya');
    $gloreya_single_title = esc_html__('Products','gloreya');
    $gloreya_show = 'yes';
    $gloreya_show_breadcrumb = 'yes';
}
if( isset($gloreya_banner_image) && $gloreya_banner_image != ''){
    $gloreya_banner_bg = 'style="background-image:url('.esc_url( $gloreya_banner_image ).');"';
}

if(isset($gloreya_show) && $gloreya_show == 'yes'): ?>

<?php

   $gloreya_banner_heading_class = '';

   if( $gloreya_header_style=="transparent" ){
      $gloreya_banner_heading_class     = "mt-80"; 
   } elseif( $gloreya_header_style== 'standard' ){
      $gloreya_banner_heading_class     = "mt-80";   
   }
?>

<div id="page-banner-area" class="page-banner-area banner-area" <?php echo wp_kses_post( $gloreya_banner_bg ); ?>>
   <!-- Subpage title start -->
   <div class="page-banner-title">
   
      <div class="text-center">
      
         <p class="banner-title <?php echo esc_attr($gloreya_banner_heading_class); ?>">
            <?php 
                  if(is_shop()){
                        $shop_title = explode(':',get_the_archive_title() );
                        
                        if(isset($gloreya_banner_title)){
                           echo gloreya_kses($gloreya_banner_title);
                        }else{
                           echo gloreya_kses($shop_title[1]);
                        }
                  
                  }elseif(is_product()){
                        echo gloreya_kses( $gloreya_single_title );
                  }else{
                        echo gloreya_kses( $gloreya_banner_title );
                  }
            ?>
         </p> 
      
      
         <?php if($gloreya_show_breadcrumb == 'yes'): ?>
               <?php woocommerce_breadcrumb(); ?>
         <?php endif; ?>
      </div>
   </div><!-- Subpage title end -->
</div><!-- Page Banner end -->

<?php endif; ?>