<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: banner
 */

 
$options = [
    'banner_setting' => [
        'title' => esc_html__('Banner Settings', 'gloreya'),

        'options' => [
            'page_banner_setting' => [
                'type'        => 'popup',
                'label'       => esc_html__('Page Banner settings', 'gloreya'),
                'popup-title' => esc_html__('Page banner settings', 'gloreya'),
                'button'      => esc_html__('Edit page Banner Button', 'gloreya'),
                'size'        => 'medium', // small, medium, large
                'popup-options' => [
                    'page_show_banner' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show banner?', 'gloreya' ),
                        'desc'          => esc_html__('Show or hide the banner', 'gloreya'),
                        'value'         => 'yes',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'gloreya' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'gloreya' ),
                        ],
                    ],
                    'page_show_breadcrumb' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show Breadcrumb?', 'gloreya' ),
                        'desc'          => esc_html__('Show or hide the Breadcrumb', 'gloreya'),
                        'value'         => 'yes',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'gloreya' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'gloreya' ),
                        ],
                    ],
                    'banner_page_title'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Banner title', 'gloreya' ),
                        'value'  => esc_html__( '', 'gloreya' ),
                    ],

                    'banner_page_image'	 =>array(
                        'label'			 => esc_html__( 'Banner image', 'gloreya' ),
                        'type'			 => 'upload',
                        'images_only'	 => true,
                        'files_ext'		 => array( 'jpg', 'png', 'jpeg', 'gif', 'svg' ),
                              
                        )

                ],
            ], 
        
            'blog_banner_setting' => [
                'type'         => 'popup',
                'label'        => esc_html__('Blog Banner settings', 'gloreya'),
                'popup-title'  => esc_html__('Blog banner settings', 'gloreya'),
                'button'       => esc_html__('Edit Blog Banner Button', 'gloreya'),
                'size'         => 'medium', // small, medium, large
                'popup-options' => [
                    'blog_show_banner' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show banner?', 'gloreya' ),
                        'desc'          => esc_html__('Show or hide the banner', 'gloreya'),
                        'value'         => 'yes',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'gloreya' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'gloreya' ),
                        ],
                    ],
                    'blog_show_breadcrumb' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show Breadcrumb?', 'gloreya' ),
                        'desc'          => esc_html__('Show or hide the Breadcrumb', 'gloreya'),
                        'value'         => 'yes',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'gloreya' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'gloreya' ),
                        ],
                    ],
                    'banner_blog_title'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Banner title', 'gloreya' ),
                    ],
                   
                    'banner_blog_image'	 =>array(
                        'type'  => 'upload',
                        'label' => esc_html__('Image', 'gloreya'),
                        'desc'  => esc_html__('Banner blog image', 'gloreya'),
                        'images_only' => true,
                        'files_ext' => array( 'PNG', 'JPEG', 'JPG','GIF'),
                              
                     
                    )

                ],
            ],
            'shop_banner_settings' => [
                'type' => 'popup',
                'label' => esc_html__('Shop banner settings', 'gloreya'),
                'popup-title' => esc_html__('Shop banner settings', 'gloreya'),
                'button' => esc_html__('Edit shop banner settings', 'gloreya'),
                'size' => 'small', // small, medium, large
                'popup-options' => array(
                    'show' => array(
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show banner?', 'gloreya' ),
                        'value' => 'yes',
                        'left-choice'	 => array(
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'gloreya' ),
                        ),
                        'right-choice'	 => array(
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'gloreya' ),
                        ),
                    ),
                    'show_breadcrumb' => array(
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show breadcrumb?', 'gloreya' ),
                        'value' => 'yes',
                        'left-choice'	 => array(
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'gloreya' ),
                        ),
                        'right-choice'	 => array(
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'gloreya' ),
                        ),
                    ),
                    'title'		 => array(
                        'label'	 => esc_html__( 'Shop Banner title', 'gloreya' ),
                        'type'	 => 'text',
                    ),
                    'single_title'		 => array(
                        'label'	 => esc_html__( 'Single Shop Banner title', 'gloreya' ),
                        'type'	 => 'text',
                    ),
                    'image'			 => array(
                        'label'			 => esc_html__( 'Banner image', 'gloreya' ),
                        'type'			 => 'upload',
                        'images_only'	 => true,
                        'files_ext'		 => array( 'jpg', 'png', 'jpeg', 'gif', 'svg' ),
                    ),
                ),
             ],
            'banner_style_settings' => [
                'type'         => 'popup',
                'label'        => esc_html__('Banner Title Style', 'gloreya'),
                'popup-title'  => esc_html__('banner settings', 'gloreya'),
                'button'       => esc_html__('Edit Banner Button', 'gloreya'),
                'size'         => 'medium', // small, medium, large
                'popup-options' => [
                     
                  'banner_overlay_color' => [
                    'label'	        => esc_html__( 'Banner Overlay color', 'gloreya' ),
                    'desc'	        => esc_html__( 'banner overlay  color.', 'gloreya' ),
                    'type'	        => 'rgba-color-picker',
                    ],
                  'banner_title_color' => [
                    'label'	        => esc_html__( 'Title color', 'gloreya' ),
                    'desc'	        => esc_html__( 'title color.', 'gloreya' ),
                    'type'	        => 'color-picker',
                    ],
                  'banner_heighlihgt_title_color' => [
                    'label'	        => esc_html__( 'Heiglight Title color', 'gloreya' ),
                    'desc'	        => esc_html__( ' Heiglight title color.', 'gloreya' ),
                    'type'	        => 'color-picker',
                    ],
                
              
                ],
            ],
      

        ],
    ],
];