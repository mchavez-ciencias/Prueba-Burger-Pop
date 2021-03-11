<?php 
   $gloreya_banner_image    = '';
   $gloreya_banner_title    = '';
   $gloreya_banner_style    = 'full';
   $gloreya_header_style    = 'standard';

   if ( defined( 'FW' ) ) { 

 
      $gloreya_banner_settings          = gloreya_option('page_banner_setting'); 
      $gloreya_banner_image             = gloreya_meta_option( get_the_ID(), 'header_image' );
      $gloreya_header_style             = gloreya_option('header_layout_style', 'standard');
      
   
      //title
      if(gloreya_meta_option( get_the_ID(), 'header_title' ) != ''){
         $gloreya_banner_title = gloreya_meta_option( get_the_ID(), 'header_title' );
      }elseif($gloreya_banner_settings['banner_page_title'] != ''){
         $gloreya_banner_title = $gloreya_banner_settings['banner_page_title'];
      }else{
         $gloreya_banner_title   = get_the_title();
      }
      
    
      //image
      if(is_array($gloreya_banner_image) && $gloreya_banner_image['url'] != '' ){
         $gloreya_banner_image = $gloreya_banner_image['url'];
      }elseif( is_array($gloreya_banner_settings['banner_page_image']) && $gloreya_banner_settings['banner_page_image']['url'] != ''){
            $gloreya_banner_image = $gloreya_banner_settings['banner_page_image']['url'];
      }else{
         $gloreya_banner_image = GLOREYA_IMG.'/banner/banner_image.png';
      }
      
      $gloreya_show = (isset($gloreya_banner_settings['page_show_banner'])) ? $gloreya_banner_settings['page_show_banner'] : 'yes'; 
      // breadcumb
      $gloreya_show_breadcrumb =  (isset($gloreya_banner_settings['page_show_breadcrumb'])) ? $gloreya_banner_settings['page_show_breadcrumb'] : 'yes';

   
   }else{
      //default
      $gloreya_banner_image             = '';
      $gloreya_banner_title             = get_the_title();
      $gloreya_show                     = 'yes';
      $gloreya_show_breadcrumb          = 'no';

   }
   if( $gloreya_banner_image != ''){
      $gloreya_banner_image = 'style="background-image:url('.esc_url( $gloreya_banner_image ).');"';
   }
   $gloreya_banner_heading_class = '';
   if($gloreya_header_style=="transparent"){
      $gloreya_banner_heading_class     = "mt-80"; 
   } elseif($gloreya_header_style== 'standard'){
         $gloreya_banner_heading_class     = "mt-80";   
   }

?>

<?php if(isset($gloreya_show) && $gloreya_show == 'yes'): ?>

     <div class="banner-area <?php echo esc_attr($gloreya_banner_image == ''?'banner-solid':'banner-bg'); ?>" <?php echo wp_kses_post( $gloreya_banner_image ); ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="banner-title <?php echo esc_attr($gloreya_banner_heading_class); ?>">
                           <?php 
                              if(is_archive()){
                                    the_archive_title();
                              }else{
                                 $title = str_replace(['{', '}'], ['<span>', '</span>'],$gloreya_banner_title ); 
                                 echo wp_kses_post( $title);
                              }
                           ?> 
                        </h2>
                         <?php if(isset($gloreya_show_breadcrumb) && $gloreya_show_breadcrumb == 'yes'): ?>
                            <?php gloreya_get_breadcrumbs(" / "); ?>
                         <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>  
  
<?php endif; ?>   