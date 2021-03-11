<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * register required plugins
 */

function gloreya_register_required_plugins() {
	$plugins	 = array(
		array(
			'name'		 => esc_html__( 'Unyson', 'gloreya' ),
			'slug'		 => 'unyson',
			'required'	 => true,
		), 
		array(
			'name'		 => esc_html__( 'Elementor', 'gloreya' ),
			'slug'		 => 'elementor',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'WP Cafe', 'gloreya' ),
			'slug'		 => 'wp-cafe',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Mailchimp ', 'gloreya' ),
			'slug'		 => 'mailchimp-for-wp',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Contact Form 7 ', 'gloreya' ),
			'slug'		 => 'contact-form-7',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Gloreya Essentials', 'gloreya' ),
			'slug'		 => 'gloreya-essential',
			'required'	 => true,
			'version'    => '1.4',
			'source'     => 'https://demo.themewinter.com/wp/plugins/gloreya/gloreya-essential.zip', // The plugin source.
		),	
		array(
			'name'		 => esc_html__( 'WP Ultimate Review', 'gloreya' ),
			'slug'		 => 'wp-ultimate-review',
			'required'	 => true,
		),	
		array(
			'name'		 => esc_html__( 'woocommerce', 'gloreya' ),
			'slug'		 => 'woocommerce',
			'required'	 => true,
		),	
		array(
			'name'		 => esc_html__( 'Elementskit Lite', 'gloreya' ),
			'slug'		 => 'elementskit-lite',
		),	
		array(
			'name'		 => esc_html__( 'revslider', 'gloreya' ),
			'slug'		 => 'revslider',
			'required'	 => true,
			'source'	 => 'http://demo.themewinter.com/wp/plugins/online/rev_slider.zip'
		),
	);


	$config = array(
		'id'			 => 'gloreya', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'gloreya-install-plugins', // Menu slug.
		'parent_slug'	 => 'themes.php', // Parent menu slug.
		'capability'	 => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	 => true, // Automatically activate plugins after installation or not.
		'message'		 => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'gloreya_register_required_plugins' );