<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_food_menu_Widget extends Widget_Base {


      public $base;
      public $food_order = 'DESC';

      public function get_name() {
         return 'gloreya-food-menu';
      }

      public function get_title() {
         return esc_html__( 'Food tab', 'gloreya' );
      }

      public function get_icon() { 
         return 'eicon-checkbox';
      }

      public function get_categories() {
         return [ 'gloreya-elements' ];
      }

      protected function _register_controls() {
        
         $this->start_controls_section('section_tab',
            [
                'label' => esc_html__('Food menu settings', 'gloreya'),
            ]
         );

         $this->add_control(
            'food_menu_style',
            [
               'label' => esc_html__( 'Food Menu Style', 'gloreya' ),
               'type' => Custom_Controls_Manager::IMAGECHOOSE,
               'default' => 'style1',
               'options' => [
                  'style1'  => [
                     'title' => esc_html__( 'Style 1', 'gloreya' ),
                           'imagelarge' => GLOREYA_IMG. '/admin/food-menu/style1.png',
                           'imagesmall' => GLOREYA_IMG. '/admin/food-menu/style1.png',
                           'width' => '30%',
                  ],
                  'style2'  => [
                     'title' => esc_html__( 'Style 2', 'gloreya' ),
                           'imagelarge' => GLOREYA_IMG. '/admin/food-menu/style2.png',
                           'imagesmall' => GLOREYA_IMG. '/admin/food-menu/style2.png',
                           'width' => '30%',
                  ],
                  'style3'  => [
                     'title' => esc_html__( 'Style 3', 'gloreya' ),
                           'imagelarge' => GLOREYA_IMG. '/admin/food-menu/style3.png',
                           'imagesmall' => GLOREYA_IMG. '/admin/food-menu/style3.png',
                           'width' => '30%',
                  ],
                  'style4'  => [
                     'title' => esc_html__( 'Style 4', 'gloreya' ),
                           'imagelarge' => GLOREYA_IMG. '/admin/food-menu/style4.png',
                           'imagesmall' => GLOREYA_IMG. '/admin/food-menu/style4.png',
                           'width' => '30%',
                  ],
                
              
               ],
            ]
         );

         $this->add_control(
            'show_food_tab_menu',
            [
               'label' => esc_html__( 'Show Tab menu', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::SWITCHER,
               'label_on' => esc_html__( 'Show', 'gloreya' ),
               'label_off' => esc_html__( 'Hide', 'gloreya' ),
               'return_value' => 'yes',
               'default' => 'yes',
               'condition' => [
                  'food_menu_style' => ['style2']
               ]
            ]
         );

         $this->add_control(
            'column_width',
            [
               'label' => esc_html__( 'Column', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => '6',
               'options' => [
                  '6'  => esc_html__( '2', 'gloreya' ),
                  '12' => esc_html__( '1', 'gloreya' ),
               
               ],
               'condition' => [
                  'food_menu_style' => ['style1','style2']
               ]
             
            ]
         );

         $this->add_control(
            'show_food_image',
            [
               'label' => esc_html__( 'Show food image', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::SWITCHER,
               'label_on' => esc_html__( 'Show', 'gloreya' ),
               'label_off' => esc_html__( 'Hide', 'gloreya' ),
               'return_value' => 'yes',
               'default' => 'yes',
               'condition' => [
                  'food_menu_style' => ['style2']
               ]
            ]
         );
       
         $this->add_control(
            'food_currency',
            [
               'label' => esc_html__( 'Currency ', 'gloreya' ),
               'type'  => \Elementor\Controls_Manager::TEXT,
               'default' => esc_html__('$', 'gloreya'),
               
           
            ]
         );

         $this->add_control(
            'tab_style',
            [
               'label' => esc_html__( 'Tab menu Style', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => 'style1',
               'options' => [
                  'style1'  => esc_html__( 'Style 1', 'gloreya' ),
                  'style2' =>  esc_html__( 'Style 2', 'gloreya' ),
                  'style3' =>  esc_html__( 'Style 3', 'gloreya' ),
              
               ],
               'condition' => [
                  'food_menu_style' => ['style2']
               ]
            ]
         );

        

         $this->add_control(
            'food_menu_type',
            [
               'label' => esc_html__( 'Food Type', 'gloreya' ),
               'type' => Controls_Manager::SELECT2,
               'multiple' => true,
               'default' => [],
               'options' => $this->getFoodMenu(),
                  
            ]
         );

         $this->add_control(
            'food_menu_item_number',
            [
               'label' => esc_html__( ' Number of food items', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::NUMBER,
               'min' => 1,
               'max' => 100,
               'step' => 1,
               'default' => 5,
             
            ]
         );

         $this->add_control(
            'food_order',
            [
               'label' => esc_html__( 'Food order', 'gloreya' ),
               'type' => Controls_Manager::SELECT,
               'default' => 'ASC',
               'options' => [
                       'ASC'  => esc_html__( 'ASC', 'gloreya' ),
                       'DESC'  => esc_html__( 'DESC', 'gloreya' ),
                   ],
                  
            ]
         );
        
      
        $this->end_controls_section();

        $this->start_controls_section('tab_menu_section',
            [
               'label' => esc_html__( 'Tab menu ', 'gloreya' ),
               'tab' => Controls_Manager::TAB_STYLE,
            ]
         ); 
         $this->add_control('tab_menu_color',
         [
               'label' => esc_html__('Tab Menu color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}}  .ts-tab-menu .nav-menu-tabs li a' => 'color: {{VALUE}};',                  
               ],
            ]
         );
            $this->add_control('tab_menu_active_color',
            [
                  'label' => esc_html__('Tab Menu active color', 'gloreya'),
                  'type' => Controls_Manager::COLOR,
                  'default' => '',
                  'selectors' => [
                     '{{WRAPPER}}  .ts-tab-menu .nav-menu-tabs li a.active' => 'color: {{VALUE}};',                  
                  ],
            ]
         );
         $this->add_group_control(
            Group_Control_Typography::get_type(), [
            'name'		 => 'tab_menu_typography',
            'label' => esc_html__('Tab Menu Typography', 'gloreya'),

            'selector'	 => '{{WRAPPER}} .ts-tab-menu .nav-menu-tabs li a',
            ]
         );
         $this->add_group_control(
            Group_Control_Typography::get_type(), [
            'name'		 => 'tab_menu_icon_typography',
            'label' => esc_html__('Tab Menu  icon Typography', 'gloreya'),

            'selector'	 => '{{WRAPPER}} .ts-tab-menu .nav-menu-tabs li a i',
            ]
         );
         

         $this->add_responsive_control(
            'tab_menu_margin',
            [
               'label' => esc_html__('Margin bottom', 'gloreya' ),
               'type' => Controls_Manager::SLIDER,
               'size_units' => [ '%','px' ],
               'range' => [
                  'px' => [
                     'min' => 0,
                     'max' => 600,
                     'step' => 1,
                  ],
                  
               ],
               'default' => [
                  'unit' => 'px',
                  'size' => 48,
               ],
               'selectors' => [
                  '{{WRAPPER}} .ts-tab-menu .nav-menu-tabs' => 'margin-bottom: {{SIZE}}{{UNIT}};',
               ],
            ]
         );
         $this->add_control('tab_menu_border_bottom_color',
            [
                  'label' => esc_html__('Tab Menu Border bottom color', 'gloreya'),
                  'type' => Controls_Manager::COLOR,
                  'default' => '',
                  'selectors' => [
                     '{{WRAPPER}}  .ts-tab-menu .nav-menu-tabs' => 'border-bottom-color: {{VALUE}};',                  
                     '{{WRAPPER}}  .ts-tab-menu .nav-menu-tabs li a:after' => 'border-color: {{VALUE}};',                  
                  ],
            ]
         );
         $this->add_control('tab_menu_border_bottom_angle_color',
            [
                  'label' => esc_html__('Menu Border angle color', 'gloreya'),
                  'type' => Controls_Manager::COLOR,
                  'default' => '',
                  'selectors' => [
                     '{{WRAPPER}}  .ts-tab-menu .nav-menu-tabs li a:after' => 'background-color: {{VALUE}};',                  
                  ],
            ]
         );

         $this->add_responsive_control(
            'tab_menu_padding',
            [
               'label' => esc_html__( 'menu gap', 'gloreya' ),
               'type' => Controls_Manager::DIMENSIONS,
               'size_units' => [ 'px', '%', 'em' ],
               'allowed_dimensions' => [ 'right', 'left' ],
               'selectors' => [
                  '{{WRAPPER}} .ts-tab-menu .nav-menu-tabs li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               ],
            ]
         );
   
         $this->end_controls_section();



        $this->start_controls_section('style_title_section',
            [
               'label' => esc_html__( 'Title', 'gloreya' ),
               'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

        $this->add_control('food_text_color',
         [
               'label' => esc_html__('Title color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}}  .menu-block .inner-box .info h3.post-title' => 'color: {{VALUE}};',
                  '{{WRAPPER}}  .menu-block .inner-box .info h3.post-title a' => 'color: {{VALUE}};',
                  '{{WRAPPER}}  .feature-tab-post-wrapper .feature-content h3' => 'color: {{VALUE}};',
                  
               ],
         ]
       );
        $this->add_control('food_texthover__color',
         [
               'label' => esc_html__('Title Hover color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}}  .menu-block .inner-box .info h3.post-title:hover' => 'color: {{VALUE}};',
                  '{{WRAPPER}}  .menu-block .inner-box .info h3.post-title a:hover' => 'color: {{VALUE}};',
                  '{{WRAPPER}}  .feature-tab-post-wrapper .feature-content h3:hover' => 'color: {{VALUE}};',
                  
               ],
         ]
       );

        $this->add_control('food_title_bg_color',
         [
               'label' => esc_html__('Title BG color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}}  .menu-block .inner-box .info .post-title' => 'background-color: {{VALUE}};',
                  '{{WRAPPER}}  .menu-block .inner-box .info .price' => 'background-color: {{VALUE}};',
                  
               ],
         ]
       );
        $this->add_control('food_title_border_color',
         [
               'label' => esc_html__('Title Border color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}}  .menu-block .inner-box .info:before' => 'border-color: {{VALUE}};',
                  
               ],
         ]
       );

      $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'food_title_typography',
			'selector'	 => '{{WRAPPER}} .menu-block .inner-box .info h3.post-title, {{WRAPPER}} .feature-tab-post-wrapper .feature-content h3',
			]
      );
      
      $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .feature-tab-post-wrapper .feature-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );

      $this->end_controls_section();

      $this->start_controls_section('style_currency_section',
         [
            'label' => esc_html__( 'Currency ', 'gloreya' ),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
        ); 

        $this->add_control('food_currency_color',
        [
              'label' => esc_html__('Currency color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                 '{{WRAPPER}} .menu-block .inner-box .info h3 > i' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .feature-tab-post-wrapper .feature-image .feature-price > i' => 'color: {{VALUE}};',
                
                 
              ],
        ]
      );

      $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'food_currency_typography',
			'selector'	 => '{{WRAPPER}} .menu-block .inner-box .info h3 > i,{{WRAPPER}} .feature-tab-post-wrapper .feature-image .feature-price > i',
			]
      );
      
      $this->end_controls_section();

      $this->start_controls_section('style_price_section',
         [
            'label' => esc_html__( 'Price ', 'gloreya' ),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
      ); 

      $this->add_control('food_price_color',
         [
               'label' => esc_html__('Price color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .menu-block .inner-box .info h3' => 'color: {{VALUE}};',
                  '{{WRAPPER}} .feature-tab-post-wrapper .feature-image .feature-price' => 'color: {{VALUE}};',
                  
                  
               ],
         ]
      );
      $this->add_control('food_price_bg_color',
      [
            'label' => esc_html__('Price bg color', 'gloreya'),
            'type' => Controls_Manager::COLOR,
            'condition' => [
               'food_menu_style' => ['style3']
            ],
            'default' => '',
            'selectors' => [
               
               '{{WRAPPER}} .feature-tab-post-wrapper .feature-image .feature-price' => 'background: {{VALUE}};',
               
               
            ],
         ]
      );
      $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'gloreya' ),
            'selector' => '{{WRAPPER}} .feature-tab-post-wrapper .feature-image .feature-price',
            'condition' => [
               'food_menu_style' => ['style3']
            ],
			]
		);

      $this->add_group_control(
         Group_Control_Typography::get_type(), [
         'name'		 => 'food_price_typography',
         'selector'	 => '{{WRAPPER}} .menu-block .inner-box .info h3 ,{{WRAPPER}} .feature-tab-post-wrapper .feature-image .feature-price',
         ]
      );
      
      $this->end_controls_section();

      $this->start_controls_section('style_ingredient_section',
         [
            'label' => esc_html__( 'Ingredient ', 'gloreya' ),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
      ); 

      $this->add_control('food_ingredient_color',
         [
               'label' => esc_html__('Ingredient color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .menu-block .inner-box .ingradien-text' => 'color: {{VALUE}};',
                  '{{WRAPPER}} .feature-tab-post-wrapper .feature-content p' => 'color: {{VALUE}};',
                  
                  
               ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(), [
         'name'		 => 'food_ingredient_typography',
         'selector'	 => '{{WRAPPER}} .menu-block .inner-box .ingradien-text,{{WRAPPER}} .feature-tab-post-wrapper .feature-content p',
         ]
      );
      $this->add_responsive_control(
			'food_ingredient_padding',
			[
				'label' => esc_html__( 'Block Content Margin', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
           
				'selectors' => [
					'{{WRAPPER}} .menu-block .inner-box .ingradien-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
      
      $this->end_controls_section();

      $this->start_controls_section('style_food_status_section',
         [
            'label' => esc_html__( 'Item Status ', 'gloreya' ),
            'tab' => Controls_Manager::TAB_STYLE,
         ]
      );
      $this->add_control(
         'show_item_status',
         [
            'label' => esc_html__('Show Item Status', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'gloreya' ),
            'label_off' => esc_html__('Hide', 'gloreya' ),
            'return_value' => 'yes',
            'default' => 'yes',
         ]
      );
      $this->add_control('food_status_color',
         [
               'label' => esc_html__('Status color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .menu-block .inner-box .menu-tag a' => 'color: {{VALUE}};',
                  '{{WRAPPER}} .feature-tab-post-wrapper .feature-status' => 'color: {{VALUE}};',
                     
               ],
         ]
      );

      $this->add_control('food_status_background',
         [
               'label' => esc_html__('Status background', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .menu-block .inner-box .menu-tag' => 'background: {{VALUE}};',
                  '{{WRAPPER}} .feature-tab-post-wrapper .feature-status' => 'background: {{VALUE}};',
                     
               ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(), [
         'name'		 => 'food_status_typography',
         'selector'	 => '{{WRAPPER}} .menu-block .inner-box .menu-tag,{{WRAPPER}} .feature-tab-post-wrapper .feature-status',
         ]
      );

      $this->end_controls_section();

      $this->start_controls_section('style_food_tab_menu_section',
         [
            'label' => esc_html__( 'Tab menu ', 'gloreya' ),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
               'food_menu_style' => ['style2'],
            ]
         ]
      );

      $this->add_control('food_tab_menu_text_color',
         [
               'label' => esc_html__('Text', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .food-menu-nav li a' => 'color: {{VALUE}};',
                     
               ],
         ]
      );

      $this->add_control('food_tab_menu_text_active_color',
         [
               'label' => esc_html__('Text active', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .food-menu-nav li a.active' => 'color: {{VALUE}};',
                     
               ],
         ]
      );

     $this->add_group_control(
         Group_Control_Typography::get_type(), [
         'name'		 => 'food_tab_menu_text_typhography',
         'selector'	 => '{{WRAPPER}} .food-menu-nav li a',
         ]
      );
      
      $this->add_control('food_tab_menu_background',
         [
               'label' => esc_html__('Tab background', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .food-menu-nav li' => 'background: {{VALUE}};',
                     
               ],
         ]
      );

      $this->add_control('food_tab_menu_icon_color',
         [
               'label' => esc_html__('Icon', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .food-menu-nav li i' => 'color: {{VALUE}};',
                     
               ],
         ]
      );
      
      $this->add_group_control(
         Group_Control_Typography::get_type(), [
         'name'		 => 'food_tab_menu_icon_typhography',
         'selector'	 => '{{WRAPPER}} .food-menu-nav li i',
         ]
      );

      $this->end_controls_section();

      $this->start_controls_section('style_menu_body_section',
         [
            'label' => esc_html__( 'Main section', 'gloreya' ),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
               'food_menu_style' => ['style1', 'style2', 'style4']
            ]
         ]
      );
       
      $this->add_responsive_control(
			'body_section_pad',
			[
				'label' => esc_html__( 'Padding', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .menu-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
      
      $this->add_responsive_control(
			'post_block_margin',
			[
				'label' => esc_html__( 'Block Content Margin', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'condition' => [
               'food_menu_style' => ['style1', 'style2']
            ],
				'selectors' => [
					'{{WRAPPER}} .menu-section .menu-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
      
      $this->end_controls_section();

      }

      protected function render( ) { 
         $settings           = $this->get_settings();
         $food_order         = $settings['food_order'];
         $food_currency      = $settings['food_currency'];
         $show_status      = $settings['show_item_status'];
        
         $tab_style          = $settings['tab_style'];
         $food_menu_style    = $settings['food_menu_style'];
         $food_menu_type     = $settings['food_menu_type'];
         $show_food_tab_menu = $settings['show_food_tab_menu'];
         $show_food_image    = $settings['show_food_image'];
         $column_width    = $settings['column_width'];
         $food_menu_item_number    = $settings['food_menu_item_number'];
         $menu = [];
         $this->food_order = $food_order;
        
       
         $food_list = [];
         global $post;
         $args = array(
            'post_type' 			   => 'ts-foodmenu',
            'post__in'              => $food_menu_type,
            'order' 				      => $food_order,
            'posts_per_page'        => -1,
         );
      
         if(is_array($food_menu_type) && count($food_menu_type) ):
            $food_list = get_posts($args);
         endif;   
         $column = 'col-md-6 col-sm-6';
            if($column_width=='12'){
               $column = 'col-md-12 col-sm-12'; 
            } 
         ?>
         <?php if($food_menu_style=='style1'): ?>
          
            <?php 
             
            foreach($food_list as $value){
              $menu = array_merge($menu,gloreya_meta_option($value->ID,'delicios_food_pop_up',[]));
            }
       
            ?>
            <div class="row menu-section"> 
               <?php foreach($menu as $key=>$style1_food): ?>
                  <div class="menu-block col-xs-12 <?php echo esc_attr($column); ?>"> 
                     <div class="inner-box"> 
                        <?php if(isset($style1_food['item_status']) &&  $show_status =='yes'): ?>
                           <span class="menu-tag">
                              <?php echo esc_html($style1_food['item_status']); ?>
                           </span>
                        <?php endif; ?>
                        <div class="info clearfix">
                              <h3 class="post-title pull-left">
                                 <?php echo esc_html($style1_food['item_title']); ?>
                              </h3> 
                              <h3 class="price pull-right"><i><?php echo esc_html($food_currency); ?> </i> <?php echo esc_html($style1_food['item_price']); ?></h3>
                                 
                        </div>
                        <p class="ingradien-text"> 
                           <?php echo esc_html($style1_food['item_ingredient']); ?>
                        </p>
                     </div>
                  </div>
                  <?php ++$key; if($food_menu_item_number==$key){ break; } ?>
               <?php endforeach; ?>
            </div>

         <?php elseif($food_menu_style=='style2'): ?>   
           <?php if(is_array($food_menu_type) && count($food_menu_type) ): ?>
               <div class="row ts-tab-menu">
                 <div class="col d-flex justify-content-center">
                     <ul class="nav nav-menu-tabs" role="tablist">
                        <?php 
                           $food_nav_key = 0;
                           $food_nav_active = '';
                           $menu_title =  $this->menuTitle($food_menu_type);
                     
                           foreach($menu_title as $keys=>$value): 
                        
                           if($food_nav_key==0): 
                              $food_nav_active = $keys;
                           endif;

                           $menu_icon = gloreya_meta_option($keys,'menu_nav_icon','');  
                           $menu_icon_img = gloreya_meta_option($keys,'menu_icon_img','');  
                           
                        ?>
                        
                           <li class="col">
                                 <a class=" <?php echo esc_attr($food_nav_key==0?'active show':''); ?> " data-toggle="tab" href="#<?php echo sanitize_title($value); ?>" role="tab" aria-controls="<?php echo sanitize_title($value); ?>" aria-selected="true">
                                 
                                   <?php $this->get_img_icon($menu_icon_img, $menu_icon, $value); ?>
                                 
                                 <?php echo esc_html($value); ?>
                               </a>
                           </li>
                           
                        <?php ++$food_nav_key; endforeach; ?>
                     </ul>
                  </div>
               </div>
           <?php endif; ?>
  
         <div class="tab-content">
          <?php  foreach($food_list as $value): ?>
            <?php 
               
               $gloreya_food_pop_up = gloreya_meta_option($value->ID,'delicios_food_pop_up',[]); 
               
            ?>
            <div id="<?php echo sanitize_title($value->post_title); ?>" class="container tab-pane <?php    echo esc_attr($food_nav_active==$value->ID?'active':''); ?>">
               
            <div class="row menu-section"> 
               <?php foreach($gloreya_food_pop_up as $key=>$style1_food): ?>
                  <div class="menu-block col-xs-12 <?php echo esc_attr($column); ?>"> 
                  <div class="inner-box"> 
                        <?php if(isset($style1_food['item_status']) &&  $show_status =='yes'): ?>
                           <span class="menu-tag">
                              <?php echo esc_html($style1_food['item_status']); ?>
                           </span>
                        <?php endif; ?>
                        <div class="info clearfix">
                              <h3 class="post-title pull-left">
                                 <a href="<?php echo esc_url($style1_food['item_order']); ?>">
                                    <?php echo esc_html($style1_food['item_title']); ?>
                                 </a>
                              </h3> 
                              <h3 class="price pull-right"><i><?php echo esc_html($food_currency); ?> </i> <?php echo esc_html($style1_food['item_price']); ?></h3>
                                 
                        </div>
                        <p class="ingradien-text"> 
                           <?php echo esc_html($style1_food['item_ingredient']); ?>
                        </p>
                     </div>
                  </div>
                  <?php ++$key; if($food_menu_item_number==$key){ break; } ?>
               <?php endforeach; ?>
            </div>

            </div>
           
          <?php ++$food_nav_key; endforeach; ?>  
         </div>
         <?php elseif($food_menu_style=='style3'): ?>   
           <?php if(is_array($food_menu_type) && count($food_menu_type) ): ?>
           <div class="row ts-tab-menu">
                 <div class="col d-flex justify-content-center">
                     <ul class="nav nav-menu-tabs" role="tablist">
                        <?php 
                           $food_nav_key = 0;
                           $food_nav_active = '';
                         
                           $menu_title =  $this->menuTitle($food_menu_type);
                           
                           
                           foreach($menu_title as $keys=>$value): 
                        
                           if($food_nav_key==0): 
                              $food_nav_active = $keys;
                           endif;

                           $menu_icon = gloreya_meta_option($keys,'menu_nav_icon','');  
                        ?>
                        
                           <li>
                               <a class=" <?php echo esc_attr($food_nav_key==0?'active show':''); ?> " data-toggle="tab" href="#<?php echo sanitize_title($value); ?>" role="tab" aria-controls="<?php echo sanitize_title($value); ?>" aria-selected="true">  <i class='<?php echo esc_attr($menu_icon); ?>'></i> <?php echo esc_html($value); ?></a>
                           </li>
                           
                        <?php ++$food_nav_key; endforeach; ?>
                     </ul>
                  </div>
               </div>
           <?php endif; ?>
  
         <div class="tab-content">
          <?php  foreach($food_list as $value): ?>
            <?php 
               
               $gloreya_food_pop_up = gloreya_meta_option($value->ID,'delicios_food_pop_up',[]); 
               
            ?>
            <div id="<?php echo sanitize_title($value->post_title); ?>" class="container tab-pane <?php    echo esc_attr($food_nav_active==$value->ID?'active':''); ?>">
               
               <div class="feature-tab-slider owl-carousel"> 
                  <?php foreach($gloreya_food_pop_up as $key=>$style1_food): ?>
                  <div class="feature-tab-post-wrapper">
                        <?php if(isset($style1_food['item_status']) && $style1_food['item_status']!=''): ?>
                           <span class="feature-status"> <?php echo esc_html($style1_food['item_status']); ?> 
                           </span>
                        <?php endif; ?>   
                           <div class="feature-image text-center">
                           <?php if(count($style1_food['item_image'])): ?>
                           <div class="feature-img">
                               <img src="<?php echo esc_url($style1_food['item_image']['url']); ?>" class="img-fluid" alt=' <?php echo esc_attr($style1_food['item_title']); ?> ' />
                           </div>
                           <?php endif; ?>
                              <div class="feature-price"> 
                              <i><?php echo esc_html($food_currency); ?> </i>  <?php echo esc_html($style1_food['item_price']); ?>  
                              </div>
                           </div>
                           <div class="feature-content text-center"> 
                              <h3>
                                <?php echo esc_html($style1_food['item_title']); ?>  
                              </h3>
                              <p>
                                <?php echo esc_html($style1_food['item_ingredient']); ?>  
                              </p>
                           </div>
                           <div class="btn-wrapper text-center">
                                 <a href="<?php echo esc_html($style1_food['item_order']); ?> " class="btn btn-primary"> <?php echo esc_html( isset($style1_food['item_order_label'])?$style1_food['item_order_label']:'Order now'); ?>   </a>
                           </div>  
                     </div>
                  <?php ++$key; if($food_menu_item_number==$key){ break; } ?>
                  <?php endforeach; ?>
               </div>

            </div>
           
          <?php ++$food_nav_key; endforeach; ?>  
         </div>
          <?php elseif($food_menu_style=='style4'): ?>   
           <?php if(is_array($food_menu_type) && count($food_menu_type) ): ?>
              <div class="row ts-tab-menu">
                 <div class="col d-flex justify-content-center">
                     <ul class="nav nav-menu-tabs" role="tablist">
                        <?php 
                           $food_nav_key = 0;
                           $food_nav_active = '';
                           $menu_title =  $this->menuTitle($food_menu_type);
                     
                           foreach($menu_title as $keys=>$value): 
                        
                           if($food_nav_key==0): 
                              $food_nav_active = $keys;
                           endif;

                           $menu_icon = gloreya_meta_option($keys,'menu_nav_icon','');  
                        ?>
                        
                           <li>
                               <a class=" <?php echo esc_attr($food_nav_key==0?'active show':''); ?> " data-toggle="tab" href="#<?php echo sanitize_title($value); ?>" role="tab" aria-controls="<?php echo sanitize_title($value); ?>" aria-selected="true">  <i class='<?php echo esc_attr($menu_icon); ?>'></i> <?php echo esc_html($value); ?></a>
                           </li>
                           
                        <?php ++$food_nav_key; endforeach; ?>
                     </ul>
                  </div>
               </div>
           <?php endif; ?>
  
         <div class="tab-content">
          <?php  foreach($food_list as $value): ?>
            <?php 
               $gloreya_food_pop_up = gloreya_meta_option($value->ID,'delicios_food_pop_up',[]); 
               $gloreya_food_image = gloreya_meta_option($value->ID,'food_menu_image',[]); 
            ?>
            <div id="<?php echo sanitize_title($value->post_title); ?>" class="container tab-pane <?php    echo esc_attr($food_nav_active==$value->ID?'active':''); ?>">
               
            <div class="row menu-section"> 
               <div class="col-lg-6 hidden-mobile col-md-12"> 
                  <?php if(count($gloreya_food_image)): ?>
                     <div class="menu-cat-img">
                        <img src="<?php echo esc_url($gloreya_food_image['url']); ?>" class="img-fluid" alt=' <?php echo esc_attr($value->post_title); ?> ' />
                     </div>
                  <?php endif; ?>
               </div>
               <div class="col-lg-6 col-md-12"> 
               <?php foreach($gloreya_food_pop_up as $key=>$style1_food): ?>
                  <div class="menu-block"> 
                     <div class="inner-box"> 
                        <?php if(isset($style1_food['item_status']) &&  $show_status =='yes'): ?>
                       
                           <span class="menu-tag">
                              <?php echo esc_html($style1_food['item_status']); ?>
                           </span>
                        <?php endif; ?>
                        <div class="info clearfix">
                              <h3 class="post-title pull-left">
                                 <?php echo esc_html($style1_food['item_title']); ?>
                              </h3> 
                              <h3 class="price pull-right"><i><?php echo esc_html($food_currency); ?> </i> <?php echo esc_html($style1_food['item_price']); ?></h3>
                                 
                        </div>
                        <p class="ingradien-text"> 
                           <?php echo esc_html($style1_food['item_ingredient']); ?>
                        </p>
                     </div>
                  </div>
                  <?php ++$key; if($food_menu_item_number==$key){ break; } ?>
               <?php endforeach; ?>
               </div>
               
            </div>

            </div>
           
          <?php ++$food_nav_key; endforeach; ?>  
         </div>
         <?php endif; ?>
          
           
      <?php   
      }
     
     public function getFoodMenu(){
      $food_menu = [];  
      $food_list = [];
      global $post;
      $args = array(
         'post_type' 			   => 'ts-foodmenu',
         'posts_per_page' 		   => -1,
         'order' 				      => $this->food_order,
        
      );
   
      $food_list = get_posts($args);

      foreach($food_list as $item){
         $food_menu[$item->ID] = $item->post_title;
      }
      return $food_menu;
     }
     
     public function menuTitle($filtermenu=[]){
       
        $foodmenu = $this->getFoodMenu();
        if(count($foodmenu)){
            return array_intersect_key($foodmenu,array_flip($filtermenu));
        }

        return [];
         
     }


     public function get_img_icon($image, $icon, $value){
         if(count($image) && $image['url'] !=''):
          ?>
         <img src="<?php echo esc_url($image['url']); ?>" class="img-fluid" alt='<?php echo esc_attr($value); ?>'/>
            <?php else: ?>
               <i class='<?php echo esc_attr($icon); ?>'></i> 
         <?php endif; ?>
         <?php
     }

   }