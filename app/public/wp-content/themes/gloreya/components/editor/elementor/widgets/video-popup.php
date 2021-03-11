<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_Video_Popup_Widget extends Widget_Base {


  public $base;

    public function get_name() {
        return 'gloreya-video-popup';
    }

    public function get_title() {

        return esc_html__( 'Video Popup', 'gloreya' );

    }

    public function get_icon() { 
        return 'eicon-youtube';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Popup settings', 'gloreya'),
            ]
        );
        $this->add_control('icon_animation',
            [
            'label'       => esc_html__('Icon animation', 'gloreya'),
            'type'        => Controls_Manager::SWITCHER,
            'label_on'    => esc_html__('Yes', 'gloreya'),
            'label_off'   => esc_html__('No', 'gloreya'),
            'default'     => 'no',

            ]
      );   
  

        $this->add_control(
			'video_icon',
			[
				'label' => __( 'Icons', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => 'icon icon-play',
			]
      );
      
        $this->add_control(
			'video_text',
            [
               'label' => __( 'Button Text', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::TEXT,
            ]
         );


        $this->add_control(
            'video_url',
            [
                'label' => esc_html__('Link', 'gloreya'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
            ]
        );

   
      $this->add_responsive_control(
         'btn_icon_padding',
         [
            'label' => esc_html__( 'Padding', 'gloreya' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],

            'selectors' => [
               '{{WRAPPER}} .ts-play-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
      );
      $this->add_responsive_control(
         'btn_icon_border_radius',
         [
            'label' => esc_html__( 'Border Radius', 'gloreya' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors' => [
               '{{WRAPPER}} .ts-play-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
      );

      $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'BUtton Text Typography', 'gloreya' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ts-play-btn',
			]
		);



        $this->add_responsive_control(
         'content_title_typography',
         [
            'label' =>esc_html__( 'Icon size', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::SLIDER,

            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 200,
               ],
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'tablet_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'mobile_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'selectors' => [
               '{{WRAPPER}} .ts-play-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
         ]
      );
        $this->add_responsive_control(
         'content_title_typography_line_height',
         [
            'label' =>esc_html__( 'line height', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'condition' => ["icon_animation" => ['yes']],

            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 200,
               ],
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'tablet_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'mobile_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'selectors' => [
               '{{WRAPPER}} .ts-play-btn.video-btn i' => 'line-height: {{SIZE}}{{UNIT}};',
            ],
         ]
      );


        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('icon color', 'gloreya'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ts-play-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__('icon background color', 'gloreya'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ts-play-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_text_align', [
                'label'             =>esc_html__( 'Alignment', 'gloreya' ),
                'type'             => Controls_Manager::CHOOSE,
                'options'         => [
    
                    'left'         => [
                        'title'     =>esc_html__( 'Left', 'gloreya' ),
                        'icon'     => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title'     =>esc_html__( 'Center', 'gloreya' ),
                        'icon'     => 'fa fa-align-center',
                    ],
                    'right'         => [
                        'title'     =>esc_html__( 'Right', 'gloreya' ),
                        'icon'     => 'fa fa-align-right',
                    ],
                ],
                'default'         => '',
               'selectors' => [
                   '{{WRAPPER}} .video-icon' => 'text-align: {{VALUE}};'
               ],
            ]
        );
      //   animation
        $this->add_control(
			'animation_icon_style',
			[
				'label' => __( 'Animation icon style', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => ["icon_animation" => ['yes']],

			]
      );
     
   
      $this->add_responsive_control(
         'anim_width',
         [
            'label' =>esc_html__( 'Icon Width', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'condition' => ["icon_animation" => ['yes']],

            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 200,
               ],
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'tablet_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'mobile_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'selectors' => [
               '{{WRAPPER}} .ts-play-btn.video-btn' => 'width: {{SIZE}}{{UNIT}};',
            ],
         ]
      );
      $this->add_responsive_control(
         'anim_height',
         [
            'label' =>esc_html__( 'Icon Height', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'condition' => ["icon_animation" => ['yes']],

            'range' => [
               'px' => [
                  'min' => 0,
                  'max' => 200,
               ],
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'desktop_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'tablet_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'mobile_default' => [
               'size' => 100,
               'unit' => 'px',
            ],
            'selectors' => [
               '{{WRAPPER}} .ts-play-btn.video-btn' => 'height: {{SIZE}}{{UNIT}};',
            ],
         ]
      );
      $this->add_responsive_control(
         'anim_icon_padding',
         [
            'label' => esc_html__( 'Padding', 'gloreya' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'condition' => ["icon_animation" => ['yes']],

            'selectors' => [
               '{{WRAPPER}} .ts-play-btn.video-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
      );
      $this->add_responsive_control(
         'anim_icon_border_radius',
         [
            'label' => esc_html__( 'Border Radius', 'gloreya' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'condition' => ["icon_animation" => ['yes']],

            'selectors' => [
               '{{WRAPPER}} .ts-play-btn.video-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
         ]
      );

      $this->add_control(
			'anim_before_border',
			[
				'label' => __( 'Before border', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => ["icon_animation" => ['yes']],

			]
      );
      $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'Before_border',
				'label' => __( 'Before Border', 'gloreya' ),
            'selector' => '{{WRAPPER}} .video-btn:after',
            'separator' => 'before',
            'condition' => ["icon_animation" => ['yes']],
			]
      );
      $this->add_control(
			'anim_after_border',
			[
				'label' => __( 'After border', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => ["icon_animation" => ['yes']],

			]
      );
      $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'after_border',
				'label' => __( 'After Border', 'gloreya' ),
            'selector' => '{{WRAPPER}} .video-btn .btn-hover-anim',
            'separator' => 'before',
            'condition' => ["icon_animation" => ['yes']],
			]
		);

        $this->end_controls_section();

        

     
    }

    protected function render( ) { 
        $settings = $this->get_settings();

        $video_icon = $settings['video_icon'];
        $icon_animation = $settings['icon_animation'];
        $video_text = $settings['video_text'];

    ?>
        <div class="video-icon">
            <a href="<?php echo esc_url($settings['video_url']['url']); ?>" class="ts-play-btn <?php echo esc_attr(($icon_animation == 'yes') ? 'video-btn' : ''); ?>">
                <i class="<?php echo  esc_attr($video_icon); ?>"></i> 
                  <?php 
                  if(isset($video_text) && $video_text !=''){
                      echo esc_html( $video_text );
                  }  
                  ?>

                <span class="btn-hover-anim"></span>
            </a>
        </div>

    <?php  
    }
    protected function _content_template() { }
}