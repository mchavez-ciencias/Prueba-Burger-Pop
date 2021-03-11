<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_Feature_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'gloreya-feature';
    }

    public function get_title() {
        return esc_html__( 'Feature', 'gloreya' );
    }

    public function get_icon() { 
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Gloreya Featured Box', 'gloreya'),
            ]
		);
    

        $this->add_control(
			'title', [
				'label'			=> esc_html__( 'Title', 'gloreya' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'Best food quality', 'gloreya' ),
				'default'	    => esc_html__( 'Best food quality', 'gloreya' ),
			]
		);

        $this->add_control(
			'desc', [
			'label'			=> esc_html__( 'Content', 'gloreya' ),
			'type'			=> Controls_Manager::TEXTAREA,
			'label_block'	=> true,
			'placeholder'	=> esc_html__( 'Which i enjoy with my whole heart', 'gloreya' ),
         'default'      => esc_html__( 'Which i enjoy with my whole heart.', 'gloreya' ),
           
			]
		);
		
		$this->add_control(
			'icon',
			[
				'label' =>esc_html__( 'Icon', 'gloreya' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'icon icon-speaker',
			]
		);

      $this->add_control(
			'bg_icon',
			[
				'label' =>esc_html__( 'Background icon', 'gloreya' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'icon icon-speaker',
			]
		);
        
        $this->add_responsive_control('title_align', 
          [
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
				'default'		 => 'left',
                'selectors' => [
                    '{{WRAPPER}} .single-intro-text' => 'text-align: {{VALUE}};',
				],
			]
        );//Responsive control end
        $this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style', [
				'label'	 => esc_html__( 'Title', 'gloreya' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'title_color', [
				'label'		 => esc_html__( 'Title color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_heighlight_color', [
				'label'		 => esc_html__( 'Title heighlight color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text h3 span' => 'color: {{VALUE}};',
				],
			]
		);

        
        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .single-intro-text h3',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-intro-text h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
     

        $this->end_controls_section();
        
        //Content Style Section
      $this->start_controls_section('section_content_style',
         [
				'label'	 => esc_html__( 'Content', 'gloreya' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'feature_content_color', [
				'label'		 => esc_html__( 'Content color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text p' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			 'name'		 => 'feature_content_typography',
			 'selector'	 => '{{WRAPPER}} .single-intro-text p',
			]
		);

		$this->end_controls_section();

		//Icon Style Section
      $this->start_controls_section('section_icon_style',
         [
				'label'	 => esc_html__( 'Icon', 'gloreya' ),
				'tab'	   => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control('icon_color', 
          [
				'label'		 => esc_html__( 'Icon color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-intro-text i' => 'color: {{VALUE}};',
				],
			]
        );
        

      $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'icon_typography',
			'selector'	 => '{{WRAPPER}} .single-intro-text i',
			]
       ); 
       
       $this->add_control('bg_icon_color', 
         [
            'label'		 => esc_html__( 'Background icon', 'gloreya' ),
            'type'		 => Controls_Manager::COLOR,
            'selectors'	 => [
               '{{WRAPPER}} .single-intro-text .feature-bg span' => 'color: {{VALUE}};',
            ],
         ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'icon_bg_typography',
			'label'		 => esc_html__( 'Background icon size', 'gloreya' ),

			'selector'	 => '{{WRAPPER}} .single-intro-text .feature-bg span',
			]
		 ); 
		 
		 $this->add_responsive_control(
			'bg_icon_position_y',
			[
				'label' => esc_html__('Background icon position Y', 'gloreya' ),
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
					'{{WRAPPER}} .single-intro-text .feature-bg span' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
      );
		 $this->add_responsive_control(
			'bg_icon_position_x',
			[
				'label' => esc_html__('Background icon position X', 'gloreya' ),
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
					'{{WRAPPER}} .single-intro-text .feature-bg span' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
      );

		$this->end_controls_section();

		
    

    } //Register control end

    protected function render( ) { 
      $settings = $this->get_settings();
     
		$icon = $settings["icon"];
		$bg_icon = $settings["bg_icon"];
		$title = $settings["title"];
      $desc = $settings["desc"];
      
		
		$title_1 = str_replace(["{"  ,  "}"] , ["<span>"  ,  "</span>"], $title);

    ?>
 
    
		<div class="single-intro-text">
			<div class="intro-content">
				<i class="<?php echo esc_attr($icon); ?>"></i>
				<h3 class="ts-title"><?php echo gloreya_kses($title_1); ?></h3>
				<p>
					<?php echo gloreya_kses($desc); ?>
				</p>
			</div>
         <div class="feature-bg">
           <span class="<?php echo esc_attr($bg_icon); ?>"></span>   
         </div>  
		</div><!-- single intro text end-->


    

	
    
    <?php  
    }
    protected function _content_template() { }
}