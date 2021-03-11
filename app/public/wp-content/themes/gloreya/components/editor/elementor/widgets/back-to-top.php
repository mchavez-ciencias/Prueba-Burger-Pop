<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_BackToTop_Widget extends Widget_Base {


  public $base;

    public function get_name() {
        return 'gloreya-back-to-top';
    }

    public function get_title() {

        return esc_html__( 'Gloreya back to top', 'gloreya' );

    }

    public function get_icon() { 
        return 'eicon-spacer';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('back to top settings', 'gloreya'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'button_style',
			[
				'label' => esc_html__( 'Back to Style', 'gloreya'),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [

					'style1'  => esc_html__( 'Style 1', 'gloreya'),
                    'style2'  => esc_html__( 'Style 2', 'gloreya')
                    
                ],
                
			]
		);
	
			 
		$this->add_control(
			'backto_button_icon',
			[
				'label' => esc_html__( 'Select Icon', 'gloreya' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-sort-up',
				]
			]
		);

        $this->add_control(
            'backto_button_bg',
            [
                'label' => esc_html__('Scroll bg color', 'gloreya'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ts-scroll-box .BackTo' => 'background-color: {{VALUE}};',
                ],
            ]
		);
		
        $this->add_control(
            'backto_button_hov_bg',
            [
                'label' => esc_html__('Scroll Hover bg color', 'gloreya'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ts-scroll-box .BackTo:hover' => 'background-color: {{VALUE}};',
                ],
            ]
		);
		
        $this->add_control(
            'backto_button_color',
            [
                'label' => esc_html__('Backto color', 'gloreya'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ts-scroll-box .BackTo' => 'color: {{VALUE}};',
                ],
            ]
		);
		
        $this->add_control(
            'backto_button_hov_color',
            [
                'label' => esc_html__('Backto Hover color', 'gloreya'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ts-scroll-box .BackTo:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'btn_align', [
				'label'			 => esc_html__( 'Alignment', 'gloreya' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

               'left'		 => [
                  
                  'title'	 => esc_html__( 'Left', 'gloreya' ),
						'icon'	 => 'fa fa-align-left',
               
               ],
				'center'	     => [
                  
                  'title'	 => esc_html__( 'Center', 'gloreya' ),
						'icon'	 => 'fa fa-align-center',
               
               ],
				'right'		 => [

						'title'	 => esc_html__( 'Right', 'gloreya' ),
                  'icon'	 => 'fa fa-align-right',
                  
					],
			
				],
            'default'		 => 'center',
            'selectors' => [
                     '{{WRAPPER}} .ts-scroll-box .BackTo' => 'text-align: {{VALUE}};',

				],
			]
		);//Responsive control end
		
		
		$this->add_responsive_control(
			'backto_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ts-scroll-box .BackTo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		  );
		  
		$this->add_responsive_control(
			'backto_border_padding',
			[
				'label' => esc_html__( 'Button Padding', 'gloreya' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ts-scroll-box .BackTo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );

        $this->end_controls_section();
            
     
    }

    protected function render( ) { 
        
        $settings = $this->get_settings();

    

    ?>
     <?php if($settings['button_style']=='style1'): ?> 
      <div class="ts-scroll-box">
			<div class="BackTo">
				<a href="#">
					<?php Icons_Manager::render_icon( $settings['backto_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</a>
			</div>
      </div>
    <?php endif; ?> 

     <?php if($settings['button_style']=='style2'): ?> 
		<div class="ts-scroll-box">
			<div class="BackTo style-2">
				<a href="#"> Back To Top
					<?php Icons_Manager::render_icon( $settings['backto_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</a>
			</div>
      	</div>
    <?php endif; ?> 

    <?php  
    }
    protected function _content_template() { }
}