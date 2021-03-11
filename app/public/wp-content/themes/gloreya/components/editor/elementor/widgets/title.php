<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_Title_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'gloreya-title';
    }

    public function get_title() {
        return esc_html__( 'Title', 'gloreya' );
    }

    public function get_icon() { 
        return 'eicon-editor-h1';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Title settings', 'gloreya'),
            ]
        );

        $this->add_control(
         'title_style',
         [
            'label' => esc_html__( 'Title style', 'gloreya' ),
            'type' => Custom_Controls_Manager::IMAGECHOOSE,
            'default' => 'style1',
            'options' => [
               'style1'  => [
                  'title' => esc_html__( 'Style 1', 'gloreya' ),
                        'imagelarge' => GLOREYA_IMG. '/admin/title/style1.png',
                        'imagesmall' => GLOREYA_IMG. '/admin/title/style1.png',
                        'width' => '30%',
               ],
               'style2'  => [
                  'title' => esc_html__( 'Style 2', 'gloreya' ),
                        'imagelarge' => GLOREYA_IMG. '/admin/title/style2.png',
                        'imagesmall' => GLOREYA_IMG. '/admin/title/style2.png',
                        'width' => '30%',
               ],
               'style3'  => [
                  'title' => esc_html__( 'Style 3', 'gloreya' ),
                        'imagelarge' => GLOREYA_IMG. '/admin/title/style3.png',
                        'imagesmall' => GLOREYA_IMG. '/admin/title/style3.png',
                        'width' => '30%',
               ],
           
            ],
         ]
       );
   
      $this->add_control(
			'title', [
				'label'			=> esc_html__( 'Heading Title', 'gloreya' ),
				'type'			=> Controls_Manager::TEXTAREA,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'Breakfast', 'gloreya' ),
				'default'	     => esc_html__( 'why {choose} us', 'gloreya' ),
			]
      );
      
      $this->add_control(
			'title_icon',
			[
				'label' => esc_html__( 'Icon', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::ICON,
            'default' => 'icon icon-title',
            'condition' => [
               'title_style' => ['style1']
              ]
			]
		);
        
      $this->add_control('show_title_border',
      [
      'label'       => esc_html__('Show title border', 'gloreya'),
      'type'        => Controls_Manager::SWITCHER,
      'label_on'    => esc_html__('Yes', 'gloreya'),
      'label_off'   => esc_html__('No', 'gloreya'),
      'default'     => 'yes',
      'condition' => [
         'title_style' => ['style2']
        ]
       
      ]
      );
        
      $this->add_responsive_control(
			'title_align', [
				'label'			 => esc_html__( 'Alignment', 'gloreya' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 => esc_html__( 'Left', 'gloreya' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 => esc_html__( 'Center', 'gloreya' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 => esc_html__( 'Right', 'gloreya' ),
						'icon'	 => 'fa fa-align-right',
					],
					'justify'	 => [
						'title'	 => esc_html__( 'Justified', 'gloreya' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ts-section-title' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .section-title' => 'text-align: {{VALUE}};',
                    
				],
			]
        );

      $this->end_controls_section();
   
		$this->start_controls_section(
			'section_title_style', [
				'label'	 => esc_html__( 'Title', 'gloreya' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
      );

      $this->add_control(
			'title_color', [
				'label'		 => esc_html__( 'Title color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ts-section-title i' => 'color: {{VALUE}};',
				],
			]
      );

       
      $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .section-title',
			]
			);
			
			$this->add_responsive_control(
				'title_margin',
				[
					'label' => esc_html__( 'Tilte Margin', 'gloreya' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
				
					'selectors' => [
						'{{WRAPPER}} .ts-section-title .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
				);
		

      $this->end_controls_section();  

      $this->start_controls_section(
			'section_title_border_style', [
				'label'	 => esc_html__( 'Title border', 'gloreya' ),
            'tab'	 => Controls_Manager::TAB_STYLE,
            'condition' => [
               'title_style' => ['style2', 'style3']
              ]
			]
      );

      $this->add_responsive_control(
			'title_border_color', [

				'label'		 => esc_html__( 'Title border color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [

               '{{WRAPPER}} .title-border:after' => 'background: {{VALUE}};',
               '{{WRAPPER}} .title-bar span.title-left-bar, .title-bar span' => 'background: {{VALUE}};',
				],
			]
        );

      $this->add_responsive_control(
			'title_boder_width',
			[
				'label' => esc_html__('Border width', 'gloreya' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .title-border:after' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .title-bar span.title-left-bar, .title-bar span.title-right-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
      );

      $this->add_control(
			'title_boder_height',
			[
				'label' => esc_html__('Border height', 'gloreya' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .title-border:after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .title-bar span.title-left-bar, .title-bar span.title-right-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
      );
      $this->add_responsive_control(
			'title_margin_bottom',
			[
				'label' => esc_html__('Border bottom', 'gloreya' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%','px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 600,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => '%',
					'size' => -26,
				],
			
				'selectors' => [
					'{{WRAPPER}} .title-border:after' => 'bottom: {{SIZE}}{{UNIT}};',
					
				],
			]
      );
    
      $this->end_controls_section();  

      $this->start_controls_section(
			'section_title_highlight_style', [
				'label'	 => esc_html__( 'Title highlight', 'gloreya' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
      );

      $this->add_control(
			'title_highlight_color', [
				'label'		 => esc_html__( 'Highlight color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .section-title span' => 'color: {{VALUE}};',
			   ],
			]
        );


      $this->end_controls_section(); 

      $this->start_controls_section(
			'section_title_icon_style', [
				'label'	 => esc_html__( 'Icon', 'gloreya' ),
            'tab'	 => Controls_Manager::TAB_STYLE,
            'condition' => [
               'title_style' => ['style1']
              ]
			]
      );

      
      $this->add_control(
			'content_title_icon_headingl',
			[
				'label' => esc_html__( 'Icon typhography', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
               'title_style' => ['style1']
              ]
            
			]
      );
 
      $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_icon_typography',
         'selector'	 => '{{WRAPPER}} .ts-section-title i',
         'condition' => [
            'title_style' => ['style1']
           ]
			]
      );

      $this->add_control(
			'title_icon_color', [
				'label'		 => esc_html__( 'Icon color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .ts-section-title i' => 'color: {{VALUE}};',
					
				],
			]
      );
      
      $this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Margin', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ts-section-title i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
     

      $this->end_controls_section();  

   } 

   protected function render( ) { 
      $settings       = $this->get_settings();
      $title_style    = $settings['title_style']; 
      $title          = $settings['title']; 
      $title_icon     = $settings['title_icon']; 
      $title_align    = $settings['title_align']; 
      $show_title_border          = $settings['show_title_border']; 
      $title_1        = str_replace(['{', '}'], ['<span>', '</span>'], $title); 
      $title_border   = '';
      if($title_style == 'style2' && $show_title_border == 'yes'): 
         $title_border = 'title-border';
      endif;   
     
   ?>

   <div class="ts-section-title title-<?php echo esc_attr( $title_align); ?>">
      <h2 class="section-title <?php echo esc_attr($title_border); ?>">
        <?php echo wp_kses_post($title_1); ?>
     </h2>
      <?php if($title_style=='style1'): ?>
         <i class="<?php echo esc_attr($title_icon); ?>"></i>
			<?php endif; ?>
      <?php if($title_style=='style3'): ?>
         <div class="title-bar">
					 <span class="title-left-bar"></span>
					 <span class="title-middle-bar"></span>
					 <span class="title-right-bar"></span>
				 </div>
			<?php endif; ?>
			
   </div>
    
    <?php  
    }
    protected function _content_template() { }
}