<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: general
 */

$options =[
    'general_settings' => [
            'title'		 => esc_html__( 'General settings', 'gloreya' ),
            'options'	 => [
                'general_main_logo' => [
                    'label'	        => esc_html__( 'Main logo', 'gloreya' ),
                    'desc'	           => esc_html__( 'It\'s the main logo, mostly it will be shown on "dark or coloreful" type area.', 'gloreya' ),
                    'type'	           => 'upload',
                    'image_only'      => true,
                 ],
                'general_dark_logo' => [
                    'label'	        => esc_html__( 'Footer logo', 'gloreya' ),
                    'desc'	           => esc_html__( 'It will be set footer logo.', 'gloreya' ),
                    'type'	           => 'upload',
                    'image_only'      => true,
                 ],
                 'offcanvas_logo' => [
                    'label'	        => esc_html__( 'Offcanvas logo', 'gloreya' ),
                    'desc'	           => esc_html__( 'put offcanvas logo', 'gloreya' ),
                    'type'	           => 'upload',
                    'image_only'      => true,
                 ],
                 'general_sticky_sidebar' => [
                    'type'			    => 'switch',
                    'label'			 => esc_html__( 'Sticky sidebar', 'gloreya' ),
                    'desc'			    => esc_html__( 'Use sticky sidebar?', 'gloreya' ),
                    'value'          => 'yes',
                    'left-choice' => [
                        'value'	 => 'yes',
                        'label'	 => esc_html__( 'Yes', 'gloreya' ),
                    ],
                    'right-choice' => [
                        'value'	 => 'no',
                        'label'	 => esc_html__( 'No', 'gloreya' ),
                    ],
               ],
              
                'general_social_links' => [
                    'type'          => 'addable-popup',
                    'template'      => '{{- title }}',
                    'popup-title'   => null,
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
                   
                ],
            ],
        ],
    ];
