<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Gloreya_OwlSlider_Widget extends Widget_Base {

    public function get_name() {
        return 'gloreya-slider';
    }
    

    public function get_title() {
        return esc_html__( 'Gloreya main sliders', 'gloreya' );
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_categories() {
        return ['gloreya-elements'];
    }

    protected function _register_controls() {
        
        $this->start_controls_section('section_tab_style',
            [
                'label' => esc_html__('Gloreya Slider', 'gloreya'),
            ]
         );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'delicios_slider_top_title', [
                'label' => esc_html__('Slider Sub Title','gloreya'),
                'type'         => Controls_Manager::TEXT,
                'default'      => esc_html__('Eat Different', 'gloreya'),
                'label_block'  => true,
			]
        );
        $repeater->add_control(
			'slider_main_title', [
                'label' => esc_html__('Slider Main Title','gloreya'),
                'type'         => Controls_Manager::TEXT,
                'default'      => esc_html__('Speak with the taste
                ', 'gloreya'),
                'label_block'  => true,
			]
        );
        $repeater->add_control(
			'slider_bg_image', [
                'label'       => esc_html__('Background Image', 'gloreya'),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
                'separator'   => 'after',
			]
        );
        $repeater->add_control(
			'delicios_button_text', [
                'label'        => esc_html__('Button Text', 'gloreya'),
                'type'         => Controls_Manager::TEXT,
                'default'      => esc_html__('Button ', 'gloreya'),
                'label_block'  => true,
			]
        );
        $repeater->add_control(
			'delicios_button_url', [
                'label'            => esc_html__( 'Button', 'gloreya' ),
                'type'             => \Elementor\Controls_Manager::URL,
                'label_block'      => true,
                'separator'        => 'after', 
                'separator'        => 'before',    
			]
        );
        $repeater->add_control(
			'content_align_text', [
                'label' => esc_html__( 'Content Alignment', 'gloreya' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'mr-auto',
                'options' => [
                    'mr-auto'  => esc_html__( 'Left', 'gloreya' ),
                    'mx-auto text-center' => esc_html__( 'Center', 'gloreya' ),
                    'ml-auto text-right' => esc_html__( 'Right', 'gloreya' ),
                
                ],
			]
        );
        $repeater->add_control(
			'justify_content_text', [
                'label' => esc_html__( 'Justify content', 'gloreya' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'gloreya' ),
                'label_off' => esc_html__( 'No', 'gloreya' ),
                'return_value' => 'yes',
                'default' => 'yes'
			]
        );

        $this->add_control(
			'delicios_slider_items',
			[
				'label' => esc_html__( 'Main Slider', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'slider_main_title' => esc_html__('Slider Main Title','gloreya'),
					],
					[
						'slider_main_title' => esc_html__('Slider Main Title','gloreya'),
					],
					[
						'slider_main_title' => esc_html__('Slider Main Title','gloreya'),
					],
					
				],
				'title_field' => '{{{ slider_main_title }}}',
			]
		);

        
        $this->add_responsive_control(
			'thumbnail_height',
			[
				'label' =>esc_html__( 'Slider Height', 'gloreya' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 645,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 400,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 400,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .slider-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'heading_type',
			[
				'label' => esc_html__('Heading Type', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1'  => esc_html__('H1', 'gloreya' ),
					'h2' => esc_html__('H2', 'gloreya' ),
					'h3' => esc_html__('H3', 'gloreya' ),
					'h4' => esc_html__('H4', 'gloreya' ),
					'h5' => esc_html__('H5', 'gloreya' ),
					'h6' => esc_html__('H6', 'gloreya' ),
					'p' => esc_html__('P', 'gloreya' ),
				],
			]
      );
      $this->add_control(
			'title_position',
			[
				'label' => esc_html__( 'Title position', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'after'  => esc_html__( 'After', 'gloreya' ),
					'before' => esc_html__( 'Before', 'gloreya' ),
				
				],
			]
		);
      $this->end_controls_section();

        //style
        $this->start_controls_section('style_section',
            [
               'label'    => esc_html__( 'Style Section', 'gloreya' ),
               'tab'      => Controls_Manager::TAB_STYLE,
            ]
       ); 

       $this->add_control(
        'delicios_slider_autoplay',
            [
            'label' => esc_html__( 'Autoplay', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'gloreya' ),
            'label_off' => esc_html__( 'No', 'gloreya' ),
            'return_value' => 'yes',
            'default' => 'no'
            ]
        );

        $this->add_control(
        'delicios_slider_nav_show',
            [
            'label' => esc_html__( 'Nav show', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'gloreya' ),
            'label_off' => esc_html__( 'No', 'gloreya' ),
            'return_value' => 'yes',
            'default' => 'yes'
            ]
        );
        $this->add_control(
         'delicios_slider_dot_nav_show',
             [
             'label' => esc_html__( 'Dot nav', 'gloreya' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'gloreya' ),
             'label_off' => esc_html__( 'No', 'gloreya' ),
             'return_value' => 'yes',
             'default' => 'yes'
             ]
         );

        $this->end_controls_section();

        $this->start_controls_section('title_style_section',
         [
            'label'    => esc_html__( 'Title ', 'gloreya' ),
            'tab'      => Controls_Manager::TAB_STYLE,
         ]
       );
       $this->add_control('slider_top_title_color',
            [
                'label'     => esc_html__('Top title color', 'gloreya'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                        '{{WRAPPER}} .slider-title > span' => 'color: {{VALUE}};',
                
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'top_title_typography',
				'label' => esc_html__('Top Title Typography', 'gloreya' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .slider-title >span',
			]
        );
        $this->add_responsive_control(
            'top_title_margin',
            [
                'label' => esc_html__( 'Top TItle Margin', 'gloreya' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slider-title >span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
     
        
        $this->add_control('slider_text_color',
            [
               'label'     => esc_html__('Title color', 'gloreya'),
               'type'      => Controls_Manager::COLOR,
               'default'   => '',
               'selectors' => [
                     '{{WRAPPER}} .slider-title' => 'color: {{VALUE}};',
               
               ],
            ]
        );
     
      
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Title Typography', 'gloreya' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slider-title',
			]
       );
       $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'TItle Margin', 'gloreya' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_sub_typography',
				'label' => esc_html__('Sub Title Typography', 'gloreya' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slider-info',
			]
        );
        $this->add_control('slider_sub_text_color',
            [
            'label'     => esc_html__('Sub Title color', 'gloreya'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                    '{{WRAPPER}} .slider-info' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slider-item .slider-content .slider-info .info-before-bar,
                     .slider-item .slider-content .slider-info .info-after-bar' => 'background: {{VALUE}};',
            
                ],
            ]
        );
   
        $this->add_control(
            'sub_title_border_left_show',
                [
                'label' => esc_html__( 'Left Subtitle Border show', 'gloreya' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'gloreya' ),
                'label_off' => esc_html__( 'No', 'gloreya' ),
                'return_value' => 'yes',
                'default' => 'yes',
                ]
            );

        $this->add_control(
            'sub_title_border_right_show',
                [
                'label' => esc_html__( 'Right Subtitle Border show', 'gloreya' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'gloreya' ),
                'label_off' => esc_html__( 'No', 'gloreya' ),
                'return_value' => 'yes',
                'default' => 'yes',
                ]
        );

      $this->end_controls_section();  

      $this->start_controls_section('button_style_section',
         [
            'label'    => esc_html__( 'Button ', 'gloreya' ),
            'tab'      => Controls_Manager::TAB_STYLE,
         ]
     );
      $this->add_control('slider_button_text_color',
      [
      'label'     => esc_html__('Button color', 'gloreya'),
      'type'      => Controls_Manager::COLOR,
      'default'   => '',
      'selectors' => [
              '{{WRAPPER}} .slider-btn-area .btn' => 'color: {{VALUE}};',
      
          ],
        ]
      );

      $this->add_control('slider_button_text_bgcolor',
         [
         'label'     => esc_html__('Button BG color', 'gloreya'),
         'type'      => Controls_Manager::COLOR,
         'default'   => '',
         'selectors' => [
               '{{WRAPPER}} .slider-btn-area .btn' => 'background: {{VALUE}};',
         
            ],
         ]
      );
      $this->add_control('slider_button_hover_text_bgcolor',
         [
         'label'     => esc_html__('Button BG Hover color', 'gloreya'),
         'type'      => Controls_Manager::COLOR,
         'default'   => '',
         'selectors' => [
               '{{WRAPPER}} .slider-btn-area .btn:hover' => 'background: {{VALUE}};',
         
            ],
         ]
      );
      $this->add_control('slider_button_shadow_color',
         [
         'label'     => esc_html__('Shadow color', 'gloreya'),
         'type'      => Controls_Manager::COLOR,
         'default'   => '',
         'selectors' => [
               '{{WRAPPER}} .slider-btn-area .btn' => 'box-shadow: 5px 5px 0px 0px  {{VALUE}};',
         
            ],
         ]
      );
      $this->add_control('slider_button_hover_shadow_color',
         [
         'label'     => esc_html__('Btn Hover Shadow color', 'gloreya'),
         'type'      => Controls_Manager::COLOR,
         'default'   => '',
         'selectors' => [
               '{{WRAPPER}} .slider-btn-area .btn:hover' => 'box-shadow: 5px 5px 0px 0px  {{VALUE}};',
         
            ],
         ]
      );
      $this->add_control('slider_button_hover_border_color',
      [
      'label'     => esc_html__('Btn Hover border color', 'gloreya'),
      'type'      => Controls_Manager::COLOR,
      'default'   => '',
      'selectors' => [
          '{{WRAPPER}} .slider-btn-area .btn:hover' => 'border-color: {{VALUE}};',
      
      ],
      ]
  );
      $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'btn_border',
            'label' => esc_html__('Border', 'gloreya' ),
            'selector' => '{{WRAPPER}} .slider-btn-area .btn',
        ]
    );
  
      $this->add_responsive_control(
        'btn_margin',
        [
            'label' => esc_html__( 'TItle Margin', 'gloreya' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .slider-btn-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
  
      $this->end_controls_section(); 
   
      $this->start_controls_section('additional_style_section',
            [
               'label'    => esc_html__( 'Additional ', 'gloreya' ),
               'tab'      => Controls_Manager::TAB_STYLE,
            ]
      );

      $this->add_responsive_control(
			'slider_padding',
			[
				'label' => esc_html__( 'Padding', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slider-item .slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
      $this->add_control('bg_overlay_color',
      [
      'label'     => esc_html__('BG overlay color', 'gloreya'),
      'type'      => Controls_Manager::COLOR,
      'default'   => '',
      'selectors' => [
            '{{WRAPPER}} .slider-item:before' => 'background: {{VALUE}};',
      
         ],
      ]
   );

      $this->end_controls_section();  
    

    }

    protected function render( ) {

      $settings          =         $this->get_settings();
      $gloreya_slider   =         $settings['delicios_slider_items'];
      $show_navigation   =         $settings["delicios_slider_nav_show"]=="yes"?true:false;
      $auto_nav_slide    =         $settings['delicios_slider_autoplay'];
      $title_position    =         $settings['title_position'];
      $dot_nav_show      =         $settings['delicios_slider_dot_nav_show'];
      $border_right_show =         $settings['sub_title_border_right_show'];
      $border_left_show  =         $settings['sub_title_border_left_show'];
      $slide_controls    = [
               'show_nav'=>$show_navigation, 
               'dot_nav_show'=>$dot_nav_show, 
               'auto_nav_slide'=>$auto_nav_slide, 
          ];
         
      $slide_controls = \json_encode($slide_controls); 
    
      ?>

<div class="hero-area owl-carousel owl-theme" data-controls="<?php echo esc_attr($slide_controls); ?>">
    <?php foreach ( $gloreya_slider as $value): ?>

      <div class="slider-item" style="background-image:url(<?php echo is_array($value["slider_bg_image"])?$value["slider_bg_image"]["url"]:''; ?>)">
        <div class="slider-table">
            <div class="slider-table-cell">
                    <div class="container">
                        <div class="row <?php echo esc_attr($value["justify_content_text"]=='yes'?"justify-content-end slider-right-content":''); ?>">
                            <div class="col-lg-12 <?php echo esc_attr($value["justify_content_text"]=='yes'?'':$value['content_align_text']); ?>">
                            <div class="slider-content">
                               <?php if($title_position=="before"): ?>
                                    <p class="slider-info">
                                        <?php if($border_left_show== 'yes'): ?>
                                            <span class="info-before-bar"></span>
                                        <?php endif; ?>
                                          <?php echo gloreya_kses($value['delicios_slider_top_title']); ?>
                                          <?php if($border_right_show== 'yes'): ?>
                                             <span class="info-after-bar"></span>
                                        <?php endif; ?>
                                     </p>
                                <?php endif; ?>
                                <<?php echo esc_attr($settings['heading_type']); ?> class="slider-title">
                                    <?php 
                                        $title =  str_replace(['{' , '}'],['<span>' , '</span>'], $value['slider_main_title']);
                                        echo gloreya_kses($title);
                                    ?>
                                </<?php echo esc_attr($settings['heading_type']); ?>>
                                <?php if($title_position=="after"): ?>
                                <p class="slider-info">
                                        <?php if($border_left_show== 'yes'): ?>
                                            <span class="info-before-bar"></span>
                                        <?php endif; ?>
                                          <?php echo gloreya_kses($value['delicios_slider_top_title']); ?>
                                          <?php if($border_right_show== 'yes'): ?>
                                             <span class="info-after-bar"></span>
                                        <?php endif; ?>
                                     </p>
                                <?php endif; ?>
                                <?php if($value['delicios_button_url'] !=''): ?>
                                <div class="slider-btn-area">
                                    <a href="<?php echo esc_url($value['delicios_button_url']['url']); ?>" class="btn btn-primary">
                                        <?php echo esc_html($value['delicios_button_text']); ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div><!-- col end-->
                     </div><!-- row end-->
                </div>
                <!-- Container end -->  
            </div>
        </div>
      </div>

    <?php endforeach; ?>
    </div>
    
    
     
        <?php
    }

    protected function _content_template() { }
}