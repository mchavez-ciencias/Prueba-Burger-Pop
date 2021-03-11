<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: general
 */
$options =[
    'style_settings' => [
            'title'		 => esc_html__( 'Style settings', 'gloreya' ),
            'options'	 => [
                'style_body_bg' => [
                    'label'	        => esc_html__( 'Body background', 'gloreya' ),
                    'desc'	           => esc_html__( 'Site\'s main background color.', 'gloreya' ),
                    'type'	           => 'color-picker',
                 ],

                'style_primary' => [
                    'label'	        => esc_html__( 'Primary color', 'gloreya' ),
                    'desc'	           => esc_html__( 'Site\'s main color.', 'gloreya' ),
                    'type'	           => 'color-picker',
                ],
                'style_primary_dark' => [
                    'label'	        => esc_html__( 'Secondary color', 'gloreya' ),
                    'desc'	           => esc_html__( 'Site\'s main secondary color.', 'gloreya' ),
                    'type'	           => 'color-picker',
                ],
                
                'title_color' => [
                'label'	        => esc_html__( 'Title color', 'gloreya' ),
                'desc'	        => esc_html__( 'title color.', 'gloreya' ),
                'type'	        => 'color-picker',
                ],
           
                'body_font'    => array(
                    'type' => 'typography-v2',
                    'label' => esc_html__('Body Font', 'gloreya'),
                    'desc'  => esc_html__('Choose the typography for the title', 'gloreya'),
                    'value' => array(
                        'family' => 'Roboto',
                        'size'  => '16',
                        'font-weight' => '400',
                    ),
                    'components' => array(
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                    
                    ),
                ),
                
                'heading_font_one'	 => [
                    'type'		 => 'typography-v2',
                    'value'		 => [
                        'family'		 => 'Barlow',
                        'size'  => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H1 Fonts', 'gloreya' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'gloreya' ),
                ],

                'heading_font_two'	 => [
                    'type'		    => 'typography-v2',
                    'value'		 => [
                        'family'		  => 'Barlow',
                        'size'        => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H2 Fonts', 'gloreya' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'gloreya' ),
                ],
                'heading_font_three'	 => [
                    'type'		    => 'typography-v2',
                    'value'		 => [
                        'family'		  => 'Barlow',
                        'size'        => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H3 Fonts', 'gloreya' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'gloreya' ),
                ],

                'heading_font_four'	 => [
                    'type'		    => 'typography-v2',
                    'value'		 => [
                        'family'		  => 'Barlow',
                        'size'        => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H4 Fonts', 'gloreya' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'gloreya' ),
                ],

            
            
            ],
        ],
    ];