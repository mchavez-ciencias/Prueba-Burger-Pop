<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * register widget area
 */

      function gloreya_widget_init()
      {
         if (function_exists('register_sidebar')) {
            register_sidebar(
                  array(
                     'name' => esc_html__('Blog widget area', 'gloreya'),
                     'id' => 'sidebar-1',
                     'description' => esc_html__('Appears on posts.', 'gloreya'),
                     'before_widget' => '<div id="%1$s" class="widget %2$s">',
                     'after_widget' => '</div>',
                     'before_title' => '<h4 class="widget-title">',
                     'after_title' => '</h4>',
                  )
            );
         }
      }

     add_action('widgets_init', 'gloreya_widget_init');

   if(defined( 'FW' )):
      function footer_left_widgets_init(){
            if ( function_exists('register_sidebar') )
            register_sidebar(array(
            'name' => esc_html__('Footer widget one','gloreya'),
            'id' => 'footer-1',
            'before_widget' => '<div class="footer-widget footer-left-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
            )
         );
         }
         add_action( 'widgets_init', 'footer_left_widgets_init' );

         function footer_two_widgets_init(){
         if ( function_exists('register_sidebar') )
         register_sidebar(array(
            'name' => esc_html__('Footer widget two','gloreya'),
            'id' => 'footer-2',
            'before_widget' => '<div class="footer-widget footer-two-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
         )
         );
         }
         add_action( 'widgets_init', 'footer_two_widgets_init' );

         function footer_three_widgets_init(){
         if ( function_exists('register_sidebar') )
         register_sidebar(array(
            'name' => esc_html__('Footer widget three','gloreya'),
            'id' => 'footer-3',
            'before_widget' => '<div class="footer-widget footer-three-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
         )
         );
         }
         add_action( 'widgets_init', 'footer_three_widgets_init' );

         function footer_four_widgets_init(){
         if ( function_exists('register_sidebar') )
         register_sidebar(array(
            'name' => esc_html__('Footer widget four','gloreya'),
            'id' => 'footer-4',
            'before_widget' => '<div class="footer-widget footer-four-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
         )
         );
         }
         add_action( 'widgets_init', 'footer_four_widgets_init' );

      if (function_exists('register_sidebar') && defined('WC_VERSION')) {
         register_sidebar(
         [
            'name'			 => esc_html__( 'WooCommerce Sidebar Area', 'gloreya' ),
            'id'			 => 'sidebar-woo',
            'description'	 => esc_html__( 'Appears on posts and pages.', 'gloreya' ),
            'before_widget'	 => '<div id="%1$s" class="widgets %2$s">',
            'after_widget'	 => '</div> <!-- end widget -->',
            'before_title'	 => '<h4 class="widget-title">',
            'after_title'	 => '</h4>',
            ] 
         );
   } 

endif;