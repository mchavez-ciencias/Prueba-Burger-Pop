<?php

/**
 * theme's main functions and globally usable variables, contants etc
 * added: v1.0 
 * textdomain: gloreya, class: Gloreya, var: $gloreya, constants:GLOREYA_, function: gloreya_
 */

// shorthand contants
// ------------------------------------------------------------------------
define('GLOREYA_THEME', 'Gloreya Restaurant WordPress Theme');
define('GLOREYA_VERSION', '2.0.1');
define('GLOREYA_MINWP_VERSION', '5.3');


// shorthand contants for theme assets url
// ------------------------------------------------------------------------
define('GLOREYA_THEME_URI', get_template_directory_uri());
define('GLOREYA_IMG', GLOREYA_THEME_URI . '/assets/images');
define('GLOREYA_CSS', GLOREYA_THEME_URI . '/assets/css');
define('GLOREYA_JS', GLOREYA_THEME_URI . '/assets/js');



// shorthand contants for theme assets directory path
// ----------------------------------------------------------------------------------------
define('GLOREYA_THEME_DIR', get_template_directory());
define('GLOREYA_IMG_DIR', GLOREYA_THEME_DIR . '/assets/images');
define('GLOREYA_CSS_DIR', GLOREYA_THEME_DIR . '/assets/css');
define('GLOREYA_JS_DIR', GLOREYA_THEME_DIR . '/assets/js');

define('GLOREYA_CORE', GLOREYA_THEME_DIR . '/core');
define('GLOREYA_COMPONENTS', GLOREYA_THEME_DIR . '/components');
define('GLOREYA_EDITOR', GLOREYA_COMPONENTS . '/editor');
define('GLOREYA_EDITOR_ELEMENTOR', GLOREYA_EDITOR . '/elementor');
define('GLOREYA_INSTALLATION', GLOREYA_CORE . '/installation-fragments');
define('GLOREYA_REMOTE_CONTENT', esc_url('http://demo.themewinter.com/demo-content/gloreya'));


// set up the content width value based on the theme's design
// ----------------------------------------------------------------------------------------
if (!isset($content_width)) {
    $content_width = 800;
}

// set up theme default and register various supported features.
// ----------------------------------------------------------------------------------------
 
function gloreya_setup() {

    // make the theme available for translation
    $lang_dir = GLOREYA_THEME_DIR . '/languages';
    load_theme_textdomain('gloreya', $lang_dir);

    // add support for post formats
    add_theme_support('post-formats', [
        'standard', 'gallery', 'video', 'audio'
    ]);

    // add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // let WordPress manage the document title
    add_theme_support('title-tag');

    // add support for post thumbnails
    add_theme_support('post-thumbnails');

    add_theme_support( 'align-wide' );


    // hard crop center center
    set_post_thumbnail_size(750, 465, ['center', 'center']);

    

     // woocommerce support
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 600,
        'gallery_thumbnail_image_width' => 300,
        'single_image_width' => 600,
    ) );
     add_theme_support( 'wc-product-gallery-lightbox' );
     add_theme_support( 'wc-product-gallery-slider' );


    // register navigation menus
    register_nav_menus(
        [
            'primary' => esc_html__('Primary Menu', 'gloreya'),
            'footermenu' => esc_html__('Footer Menu', 'gloreya'),
        ]
    );

    // HTML5 markup support for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));

}
add_action('after_setup_theme', 'gloreya_setup');



// hooks for unyson framework
// ----------------------------------------------------------------------------------------
function gloreya_framework_customizations_path($rel_path) {
    return '/components';
}
add_filter('fw_framework_customizations_dir_rel_path', 'gloreya_framework_customizations_path');


function gloreya_remove_fw_settings() {
    remove_submenu_page( 'themes.php', 'fw-settings' );
}
add_action( 'admin_menu', 'gloreya_remove_fw_settings', 999 );


//Change sidebar id to your primary sidebar id and add it to 

//themes/theme_name/core/hooks/blog.php
function gloreya_body_classes( $classes ) {

    if ( is_active_sidebar( 'sidebar-1' ) || ( class_exists( 'Woocommerce' ) && ! is_woocommerce() ) || class_exists( 'Woocommerce' ) && is_woocommerce() && is_active_sidebar( 'shop-sidebar' ) ) {
        $classes[] = 'sidebar-active';
    
    }else{
        $classes[] = 'sidebar-inactive';
    }

    $gloreya_sidebar_class = gloreya_option('blog_sidebar'); 

   if( is_active_sidebar('sidebar-1')){
     $classes[] = ($gloreya_sidebar_class != 1) ? 'sidebar-class' : '';

    }


    return $classes;


}
add_filter( 'body_class','gloreya_body_classes' );





// include the init.php
// ----------------------------------------------------------------------------------------
require_once( GLOREYA_CORE . '/init.php');
require_once( GLOREYA_COMPONENTS . '/editor/elementor/elementor.php');


// gutenberg
add_action('enqueue_block_editor_assets', 'gloreya_action_enqueue_block_editor_assets' );
function gloreya_action_enqueue_block_editor_assets() {
	wp_enqueue_style( 'gloreya-fonts', gloreya_google_fonts_url(['Barlow:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Roboto:300,300i,400,400i,500,500i,700,700i,900,900i']), null, GLOREYA_VERSION );
    wp_enqueue_style( 'gloreya-gutenberg-editor-font-awesome-styles', GLOREYA_CSS . '/font-awesome.css', null, GLOREYA_VERSION );
    wp_enqueue_style( 'gloreya-gutenberg-editor-customizer-styles', GLOREYA_CSS . '/gutenberg-editor-custom.css', null, GLOREYA_VERSION );
    wp_enqueue_style( 'gloreya-gutenberg-editor-styles', GLOREYA_CSS . '/gutenberg-custom.css', null, GLOREYA_VERSION );
    wp_enqueue_style( 'gloreya-gutenberg-blog-styles', GLOREYA_CSS . '/blog.css', null, GLOREYA_VERSION );
}

