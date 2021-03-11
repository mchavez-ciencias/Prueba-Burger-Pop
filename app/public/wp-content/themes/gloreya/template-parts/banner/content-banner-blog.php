<?php 
   $gloreya_banner_image    =  '';
   $gloreya_banner_title    = '';
   $gloreya_header_style    = 'standard';
   
if ( defined( 'FW' ) ) { 
   $gloreya_banner_settings         = gloreya_option('blog_banner_setting'); 
   $gloreya_banner_style            = gloreya_option('sub_page_banner_style');
   $gloreya_header_style            = gloreya_option('header_layout_style', 'standard');
  
   //image
   $gloreya_banner_image = ( is_array($gloreya_banner_settings['banner_blog_image']) && $gloreya_banner_settings['banner_blog_image']['url'] != '') ? 
                        $gloreya_banner_settings['banner_blog_image']['url'] : GLOREYA_IMG.'/banner/banner_image.png';

   //title 
   $gloreya_banner_title = (isset($gloreya_banner_settings['banner_blog_title']) && $gloreya_banner_settings['banner_blog_title'] != '') ? 
                        $gloreya_banner_settings['banner_blog_title'] : get_bloginfo( 'name' );
   //show
   $gloreya_show = (isset($gloreya_banner_settings['blog_show_banner'])) ? $gloreya_banner_settings['blog_show_banner'] : 'yes'; 
   // banner overlay
   $gloreya_show = (isset($gloreya_banner_settings['blog_show_banner'])) ? $gloreya_banner_settings['blog_show_banner'] : 'yes'; 
    
   //breadcumb 
   $gloreya_show_breadcrumb =  (isset($gloreya_banner_settings['blog_show_breadcrumb'])) ? $gloreya_banner_settings['blog_show_breadcrumb'] : 'yes';

 }else{
     //default
   $gloreya_banner_image             = '';
   $gloreya_banner_title             = get_bloginfo( 'name' );
   $gloreya_show                     = 'yes';
   $gloreya_show_breadcrumb          = 'no';

     
 }
 if( isset($gloreya_banner_image) && $gloreya_banner_image != ''){
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
                              }elseif(is_single()){
                                 the_title();
                              }
                              else{
                                 $title = str_replace(['{', '}'], ['<span>', '</span>'],$gloreya_banner_title ); 
                                 echo wp_kses_post( $title);
                              }
                           ?> 
                        </h2>
                         <?php if(isset($gloreya_show_breadcrumb) && $gloreya_show_breadcrumb == 'yes'): ?>
                            <?php gloreya_get_breadcrumbs(' / '); ?>
                         <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>  
  
<?php endif; ?>     