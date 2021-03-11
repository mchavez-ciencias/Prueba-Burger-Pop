<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * metabox options for pages
 */

$options = array(
	'settings-page' => array(
		'title'		 => esc_html__( 'Page settings', 'gloreya' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => array(
			'header_title'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Banner title', 'gloreya' ),
				'desc'	 => esc_html__( 'Add your Page hero title', 'gloreya' ),
			),

			'header_image'	 => array(
				'label'	 => esc_html__( ' Banner image', 'gloreya' ),
				'desc'	 => esc_html__( 'Upload a page header image', 'gloreya' ),
				'help'	 => esc_html__( "This default header image will be used for all your service.", 'gloreya' ),
				'type'	 => 'upload'
			),

			/*
			'page_header_override' => [
				'type'			 => 'switch',
				'label'			 => esc_html__( 'Override header?', 'gloreya' ),
				'desc'          => esc_html__('Override header layout', 'gloreya'),
				'value'         => 'no',
				'left-choice'	 => [
						'value'	 => 'yes',
						'label'	 => esc_html__( 'Yes', 'gloreya' ),
				],
				'right-choice'	 => [
						'value'	 => 'no',
						'label'	 => esc_html__( 'No', 'gloreya' ),
				],
			],
			'page_header_layout_style' => [
				'label'	        => esc_html__( 'Header style', 'gloreya' ),
				'desc'	        => esc_html__( 'This is the site\'s main header style.', 'gloreya' ),
				'type'	        => 'image-picker',
				'choices'       => [
					 'transparent'    => [
						  'small'     => GLOREYA_IMG . '/admin/header-style/style1.png',
						  'large'     => GLOREYA_IMG . '/admin/header-style/style1.png',
					 ],
					 'transparent2'    => [
						'small'     => GLOREYA_IMG . '/admin/header-style/style2.png',
						'large'     => GLOREYA_IMG . '/admin/header-style/style2.png',
				  ],
					 'standard'    => [
						  'small'     => GLOREYA_IMG . '/admin/header-style/style3.png',
						  'large'     => GLOREYA_IMG . '/admin/header-style/style3.png',
					 ],
				],
				'value'         => 'transparent',
			], 
			*/
		),
	),
);
