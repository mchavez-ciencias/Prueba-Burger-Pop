<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: Header
 */

$options =[
    'header_settings' => [
        'title'		 => esc_html__( 'Header settings', 'gloreya' ),

        'options'	 => [

            'header_layout_style' => [
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
                'value'         => 'standard',
             ], //Header style

            //  nav sticky
            'header_nav_sticky' => [
                'type'			 => 'switch',
                'label'			 => esc_html__( 'Show nav sticky?', 'gloreya' ),
                'desc'          => esc_html__('Show or hide the header sticky', 'gloreya'),
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
            'shop_btn_show' => [
                'type'			 => 'switch',
                'label'			 => esc_html__( 'Show cart button?', 'gloreya' ),
                'desc'          => esc_html__('Show or hide the header cart button', 'gloreya'),
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
            
             'header_table_button_settings' => [
                'type'        => 'popup',
                'label'       => esc_html__('Header table button settings', 'gloreya'),
                'popup-title' => esc_html__('Header table button settings', 'gloreya'),
                'button'      => esc_html__('Edit header table button', 'gloreya'),
                'size'        => 'small', // small, medium, large
                'popup-options' => [
                
                    'header_btn_show' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show button?', 'gloreya' ),
                        'desc'          => esc_html__('Show or hide the header button', 'gloreya'),
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
                
                    'header_btn_title'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Button title', 'gloreya' ),
                        'value'   => esc_html__( 'Order Online', 'gloreya' ),
                    ],
                    'header_btn_url'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Button Url', 'gloreya' ),
                        'desc'	 => esc_html__( 'Put the url of the button', 'gloreya' ),
                        'value'   => '#',
                    ],

                    'header_button_bg_color' =>[
                        'type' => 'color-picker',
                        'label' => esc_html__('Header Button BG color', 'gloreya'),
                        'desc'  => esc_html__('button bg color set', 'gloreya'),
                        'value' => '#e7272d',
                    ],
                    'header_button_text_color' =>[
                        'type' => 'color-picker',
                        'label' => esc_html__('Header Button text color', 'gloreya'),
                        'desc'  => esc_html__('button text color set', 'gloreya'),
                        'value' => '#fff',

                    ],

                ],
            ],

            'header_offcanvas_settings' => [
                'type'        => 'popup',
                'label'       => esc_html__('Header Offcanvas menu settings', 'gloreya'),
                'popup-title' => esc_html__('Header Offcanvas menu settings', 'gloreya'),
                'button'      => esc_html__('Edit header Offcanvas menu', 'gloreya'),
                'size'        => 'small', // small, medium, large
                'popup-options' => [
                
                    'header_offcanvas_show' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show offcanvas menu?', 'gloreya' ),
                        'desc'          => esc_html__('Show or hide the header button', 'gloreya'),
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
                
                    'offcanvas_desc'	 => [
                        'type'	 => 'textarea',
                        'label'	 => esc_html__( 'Description', 'gloreya' ),
                    ],
                 
                    'offcanvas_email_icon'	 => [
                        'type'	 => 'new-icon',
                        'label'	 => esc_html__( 'Email icon', 'gloreya' ),
                    ],
                    'offcanvas_email'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Email', 'gloreya' ),
                    ],

                    'offcanvas_phone_icon'	 => [
                        'type'	 => 'new-icon',
                        'label'	 => esc_html__( 'Phone icon', 'gloreya' ),
                    ],
                    'offcanvas_phone_number'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Phone', 'gloreya' ),
                    ],
                 

                ],
            ],
        ], //Options end
    ]
];