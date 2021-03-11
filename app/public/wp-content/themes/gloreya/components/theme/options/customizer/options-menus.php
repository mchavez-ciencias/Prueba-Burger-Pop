<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: menus
 */

$options =[
   'menu_settings' => [
       'title'		 => esc_html__( 'Menu settings', 'gloreya' ),

       'options'	 => [
           'menu_color' => [
               'label'	        => esc_html__( 'Menu Color', 'gloreya' ),
               'desc'	        => esc_html__( 'This is the site\'s main menu  color.', 'gloreya' ),
               'type'	        => 'color-picker',

            ], //menu style
           'menu_hover_color' => [
               'label'	        => esc_html__( 'Menu Hover Color', 'gloreya' ),
               'desc'	        => esc_html__( 'This is the site\'s main menu hover color.', 'gloreya' ),
               'type'	        => 'color-picker',

            ], //menu style

           'dropdown_menu_color' => [
               'label'	        => esc_html__( 'Dropdown Menu Color', 'gloreya' ),
               'desc'	        => esc_html__( 'This is the site\'s main dropdown menu color.', 'gloreya' ),
               'type'	        => 'color-picker',

            ], //menu style
           'dropdown_menu_hover_color' => [
               'label'	        => esc_html__( 'Dropdown Menu Hover Color', 'gloreya' ),
               'desc'	        => esc_html__( 'This is the site\'s main dropdown menu Hover color.', 'gloreya' ),
               'type'	        => 'color-picker',

            ], //menu style

            'menu_font'    => array(
               'type' => 'typography-v2',
               'label' => esc_html__('Menu Font', 'gloreya'),
               'desc'  => esc_html__('Choose the typography for the menu', 'gloreya'),
               'value' => array(
                   'family' => 'Barlow',
                   'size'  => '14',
                   'font-weight' => '700',
               ),
               'components' => array(
                   'family'         => true,
                   'size'           => true,
                   'line-height'    => false,
                   'letter-spacing' => false,
                   'color'          => false,
                   'font-weight'    => true,
               ),
           ),
   
       ], //Options end
   ]
];