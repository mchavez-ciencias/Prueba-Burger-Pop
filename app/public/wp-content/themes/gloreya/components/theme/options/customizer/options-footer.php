<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: general
 */

$options =[
    'footer_settings' => [
        'title'		 => esc_html__( 'Footer settings', 'gloreya' ),

        'options'	 => [

            'footer_style' => array(
                'type'         => 'multi-picker',
                'label'        => false,
                'desc'         => false,
                'picker'       => array(
                    'style' => array(
                        'label'   => esc_html__( 'Select Style', 'gloreya' ),
                        'type'    => 'image-picker',
                        'choices'	 => [
                            'style-1' => [
                                'small'	 => [
                                    'height' => 30,
                                    'src'	 => GLOREYA_IMG. '/admin/footer/style1.png'
                                ],
                                'large'	 => [
                                    'width'	 => 370,
                                    'src'	 => GLOREYA_IMG. '/admin/footer/style1.png'
                                ],
                            ],
                            'style-2' => [
                                'small'	 => [
                                    'height' => 30,
                                    'src'	 => GLOREYA_IMG. '/admin/footer/style2.png'
                                ],
                                'large'	 => [
                                    'width'	 => 370,
                                    'src'	 => GLOREYA_IMG. '/admin/footer/style2.png'
                                ],
                            ],
                         
                        ],
                      
                    )
                ),
               
                'show_borders' => false,
            ), 
           
       

           'footer_bg_img' => [
            'label'	        => esc_html__( 'Footer Background Image', 'gloreya' ),
            'desc'	           => esc_html__( 'It\'s the main Footer background image', 'gloreya' ),
            'type'	           => 'upload',
            'image_only'      => true,
            ],
            'footer_bg_color' => [
                'label'	 => esc_html__( 'Footer Background color', 'gloreya'),
                'type'	 => 'color-picker',
                'desc'	 => esc_html__( 'You can change the footer\'s background color with rgba color or solid color', 'gloreya'),
            ],
            'footer_copyright_color' => [
                'label'	 => esc_html__( 'Footer Copyright color', 'gloreya'),
                'type'	 => 'color-picker',
                'desc'	 => esc_html__( 'You can change the footer\'s background color with rgba color or solid color', 'gloreya'),
            ],
            'footer_social_links' => [
                'type'  => 'addable-popup',
                'template' => '{{- title }}',
                'popup-title' => null,
                'label' => esc_html__( 'Social links', 'gloreya' ),
                'desc'  => esc_html__( 'Add social links and it\'s icon class bellow. These are all fontaweseome-4.7 icons.', 'gloreya' ),
                'add-button-text' => esc_html__( 'Add new', 'gloreya' ),
                'popup-options' => [
                    'title' => [ 
                        'type' => 'text',
                        'label'=> esc_html__( 'Title', 'gloreya' ),
                    ],
                    'icon_class' => [ 
                        'type' => 'new-icon',
                        'label'=> esc_html__( 'Social icon', 'gloreya' ),
                    ],
                    'url' => [ 
                        'type' => 'text',
                        'label'=> esc_html__( 'Social link', 'gloreya' ),
                    ],
                ],
                'value' => [
                   
                ],
            ],
           
       
            'footer_copyright'	 => [
                'type'	 => 'textarea',
                'value'  => '&copy; 2019, Gloreya. All rights reserved',
                'label'	 => esc_html__( 'Copyright text', 'gloreya' ),
                'desc'	 => esc_html__( 'This text will be shown at the footer of all pages.', 'gloreya' ),
            ],

            'footer_padding_top' => [
                'label'	        => esc_html__( 'Footer Padding Top', 'gloreya' ),
                'desc'	        => esc_html__( 'Use Footer Padding Top', 'gloreya' ),
                'type'	        => 'text',
                'value'         => '50px',
             ],
             'footer_padding_bottom' => [
               'label'	        => esc_html__( 'Footer Padding Bottom', 'gloreya' ),
               'desc'	        => esc_html__( 'Use Footer Padding Bottom', 'gloreya' ),
               'type'	        => 'text',
               'value'         => '0px',
            ],
             'back_to_top'				 => [
                'type'			 => 'switch',
                'value'			 => '',
                'label'			 => esc_html__( 'Back to top', 'gloreya'),
                'left-choice'	 => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'gloreya'),
                ],
                'right-choice'	 => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'gloreya'),
                ],
            ],
            
        ],
            
        ]
    ];