<?php

function gloreya_fw_ext_backups_demos( $demos ) {
	$demo_content_installer	 = 'https://demo.themewinter.com/wp/demo-content/gloreya';
	$demos_array			 = array(
		'default'			 => array(
			'title'			 => esc_html__( 'Demo (1-2)', 'gloreya' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/default/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'defaultgreen'			 => array(
			'title'			 => esc_html__( 'Demo Green', 'gloreya' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/defaultgreen/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'wpcafe'			 => array(
			'title'			 => esc_html__( 'WpCafe Demo', 'gloreya' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/wpcafe/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		'restaurant'			 => array(
			'title'			 => esc_html__( 'Restaurant Demo', 'gloreya' ),
			'screenshot'	 => esc_url( $demo_content_installer ) . '/restaurant/screenshot.png',
			'preview_link'	 => esc_url( 'http://themeforest.net/user/tripples/portfolio' ),
		),
		
	);
	$download_url			 = esc_url( $demo_content_installer ) . '/manifest.php';
	foreach ( $demos_array as $id => $data ) {
		$demo						 = new FW_Ext_Backups_Demo( $id, 'piecemeal', array(
			'url'		 => $download_url,
			'file_id'	 => $id,
		) );
		$demo->set_title( $data[ 'title' ] );
		$demo->set_screenshot( $data[ 'screenshot' ] );
		$demo->set_preview_link( $data[ 'preview_link' ] );
		$demos[ $demo->get_id() ]	 = $demo;
		unset( $demo );
	}
	return $demos;
}

add_filter( 'fw:ext:backups-demo:demos', 'gloreya_fw_ext_backups_demos' );