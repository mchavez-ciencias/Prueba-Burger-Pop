<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * metabox options for pages
 */

$options = array(
	'settings-page' => array(
		'title'		 => esc_html__( 'Chef settings', 'gloreya' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => array(
			  'member_designation' => array(
            'type'  => 'text',
            'value' => '',
            'label' => esc_html__('Designation', 'gloreya'),
        
           ),
           'member_social' => array(
            'type' => 'addable-popup',
            'label' => esc_html__('Social', 'gloreya'),
            'template' => '{{- social_title }}',
            'size' => 'small', 
            'limit' => 0, 
            'add-button-text' => esc_html__('Add', 'gloreya'),
            'sortable' => true,
            'popup-options' => array(
                'social_title' => array(
                    'label' => esc_html__('Title', 'gloreya'),
                    'type' => 'text',
                    ),
                    'social_url' => array(
                     'label' => esc_html__('Link', 'gloreya'),
                     'value' =>  esc_html__('#','gloreya'),
                     'type' => 'text',
                    ),
                     'social_icon'	 => array(
                        'type'  => 'new-icon',
                        'label' => esc_html__('Social Icon', 'gloreya'),
                    
                     ),
               ),
              
            ),
                
         ),
      )
  
);