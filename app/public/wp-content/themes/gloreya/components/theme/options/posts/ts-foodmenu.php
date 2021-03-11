<?php if ( !defined( 'FW' ) ) {	die( 'Forbidden' ); }

$options = array(
     
    'menu_icon_img' =>  array(
        'type'  => 'upload',
        'value' => array(
        
        ),
        'label' => esc_html__('Food Menu Image Icon', 'gloreya'),
        'images_only' => true,
     
     ),

      'menu_nav_icon' => array(
         'type'  => 'new-icon',
         'value' => '',
         'label' => esc_html__('Menu Icon', 'gloreya'),
      
      ),

      'food_menu_image' =>  array(
         'type'  => 'upload',
         'value' => array(
         
         ),
         'label' => esc_html__('Food Category Image', 'gloreya'),
         'images_only' => true,
      
      ),
     
    'delicios_food_pop_up' =>array(
        'type' => 'addable-popup',
        'value' => array(
            array(
                'item_title' => '',
               
            ),
        ),
        'label' => esc_html__('All food', 'gloreya'),
        'desc'  => esc_html__('Add your food item', 'gloreya'),
        'template' => '{{- item_title }}',
        'popup-title' => 'Food ',
        'size' => 'small', // small, medium, large
        'limit' => 0, // limit the number of popup`s that can be added
        'add-button-text' => esc_html__('Add', 'gloreya'),
        'sortable' => true,
        'popup-options' => array(
         
            'item_image' =>  array(
               'type'  => 'upload',
               'value' => array(
               
               ),
               'label' => esc_html__('Image', 'gloreya'),
               'images_only' => true,
             ), 
            'item_title' => array(
                'type'  => 'text',
                'value' => '',
                'label' => esc_html__('Item Title', 'gloreya'),
              
            ),
            'item_price' => array(
                'type'  => 'text',
                'value' => '',
                'label' => esc_html__('Item price', 'gloreya'),
              
            ),
            'item_ingredient' => array(
               'type'  => 'textarea',
               'value' => '',
               'label' => esc_html__('Item ingredient', 'gloreya'),
             
            ),
            'item_order_label' => array(
               'type'  => 'text',
               'value' => '',
               'label' => esc_html__('Order label', 'gloreya'),
             
            ),
            'item_order' => array(
               'type'  => 'text',
               'value' => '',
               'label' => esc_html__('Order url', 'gloreya'),
            ),
            
            'item_status' => array(
               'type'  => 'text',
               'value' => '',
               'label' => esc_html__('Item Status', 'gloreya'),
             
           ),
        ),
    )

);
