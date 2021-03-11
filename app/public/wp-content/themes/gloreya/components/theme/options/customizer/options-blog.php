<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: blog
 */

$options =[
    'blog_settings' => [
        'title'		 => esc_html__( 'Blog settings', 'gloreya' ),

        'options'	 => [
            'blog_sidebar' =>[
                'type'  => 'select',
                              
                'label' => esc_html__('Sidebar', 'gloreya'),
                'desc'  => esc_html__('Description', 'gloreya'),
                'help'  => esc_html__('Help tip', 'gloreya'),
                'choices' => array(
                    '1' => esc_html__('No sidebar','gloreya'),
                    '2' => esc_html__('Left Sidebar', 'gloreya'),
                    '3' => esc_html__('Right Sidebar', 'gloreya'),
                 
                 ),
              
                'no-validate' => false,
            ],   
           
            'blog_author' => [
                'type'			 => 'switch',
                'label'			 => esc_html__( 'Blog author', 'gloreya' ),
                'desc'			 => esc_html__( 'Do you want to show blog author?', 'gloreya' ),
                'value'          => 'no',
                'left-choice' => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'gloreya' ),
                ],
                'right-choice' => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'gloreya' ),
                ],
           ],
        ],
            
        ]
    ];