<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//register WP Cafe block category
function wpc_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'wp-cafe-blocks',
				'title' => __( 'WP Cafe', 'wpcafe' ),
			),
		)
	);
}
add_filter( 'block_categories', 'wpc_block_category', 10, 2);

//register block assets
function wpc_block_assets() {
	// Register block styles for both frontend + backend.
	wp_register_style(
		'wpc-block-style-css',
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ),
		is_admin() ? array( 'wp-editor' ) : null,
		null
	);

	// Register block editor styles for backend.
	wp_register_style(
			'wpc-block-editor-style-css',
			plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ),
			array( 'wp-edit-blocks' ),
			null
	);

	// Register block editor script for backend.
	wp_register_script(
		'wpc-block-js',
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-compose', 'wp-server-side-render' ),
		null,
		true
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'wpc-block-js',
		'tsGlobal',
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),

		]
	);
}

// Hook: Block assets.
add_action( 'init', 'wpc_block_assets' );

//include food list block
if( file_exists( WPC_DIR . '/core/guten-block/inc/blocks/food-list.php' )){
	include_once WPC_DIR . '/core/guten-block/inc/blocks/food-list.php';
}

//include food tab block
if( file_exists( WPC_DIR . '/core/guten-block/inc/blocks/food-tab.php' )){
	include_once WPC_DIR . '/core/guten-block/inc/blocks/food-tab.php';
}
