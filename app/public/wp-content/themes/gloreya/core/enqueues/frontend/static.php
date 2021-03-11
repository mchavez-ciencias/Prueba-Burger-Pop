<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * enqueue all theme scripts and styles
 */


// stylesheets
// ----------------------------------------------------------------------------------------
if ( !is_admin() ) {
	// wp_enqueue_style() $handle, $src, $deps, $version

	// 3rd party css
	wp_enqueue_style( 'gloreya-fonts', gloreya_google_fonts_url(['Barlow:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Roboto:300,300i,400,400i,500,500i,700,700i,900,900i']), null, GLOREYA_VERSION );

	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap-min-rtl', GLOREYA_CSS . '/bootstrap.min-rtl.css', null, GLOREYA_VERSION );
	}else{
		wp_enqueue_style( 'bootstrap-min', GLOREYA_CSS . '/bootstrap.min.css', null, GLOREYA_VERSION );

	}
	wp_enqueue_style( 'font-awesome-5', GLOREYA_CSS . '/font-awesome.css', null, GLOREYA_VERSION );
	wp_enqueue_style( 'iconfont', GLOREYA_CSS . '/iconfont.css', null, GLOREYA_VERSION );
	wp_enqueue_style( 'magnific-popup', GLOREYA_CSS . '/magnific-popup.css', null, GLOREYA_VERSION );
	wp_enqueue_style( 'owl-carousel-min', GLOREYA_CSS . '/owl.carousel.min.css', null, GLOREYA_VERSION );
	wp_enqueue_style( 'gloreya-woocommerce', GLOREYA_CSS . '/woocommerce.css', null, GLOREYA_VERSION );
  // gutenberg css
	wp_enqueue_style( 'gloreya-gutenberg-custom', GLOREYA_CSS . '/gutenberg-custom.css', null, GLOREYA_VERSION );
	// theme css
	wp_enqueue_style( 'gloreya-style', GLOREYA_CSS . '/master.css', null, GLOREYA_VERSION );
}

// javascripts
// ----------------------------------------------------------------------------------------
if ( !is_admin() ) {

	// 3rd party scripts
	if ( is_rtl() ) {
		wp_enqueue_script( 'bootstrap-min-rtl', GLOREYA_JS . '/bootstrap.min-rtl.js', array( 'jquery' ), GLOREYA_VERSION, true );
	}else{
		wp_enqueue_script( 'bootstrap-min', GLOREYA_JS . '/bootstrap.min.js', array( 'jquery' ), GLOREYA_VERSION, true );
	}

	wp_enqueue_script( 'popper-min', GLOREYA_JS . '/popper.min.js', array( 'jquery' ), GLOREYA_VERSION, true );
	wp_enqueue_script( 'jquery-magnific-popup-min', GLOREYA_JS . '/jquery.magnific-popup.min.js', array( 'jquery' ), GLOREYA_VERSION, true );
	wp_enqueue_script( 'instafeed', GLOREYA_JS . '/instafeed.min.js', array( 'jquery' ), GLOREYA_VERSION, true );

	wp_enqueue_script( 'owl-carousel-min', GLOREYA_JS . '/owl.carousel.min.js', array( 'jquery' ), GLOREYA_VERSION, true );
	wp_enqueue_script( 'jquery-easypiechart-min', GLOREYA_JS . '/jquery.easypiechart.min.js', array( 'jquery' ), GLOREYA_VERSION, true );

	// theme scripts
	wp_enqueue_script( 'gloreya-script', GLOREYA_JS . '/script.js', array( 'jquery' ), GLOREYA_VERSION, true );
	
	// Load WordPress Comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}


