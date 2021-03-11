<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_Site_Logo_Widget extends Widget_Base {


  public $base;

    public function get_name() {
        return 'gloreya-logo';
    }

    public function get_title() {

        return esc_html__( 'Site Logo', 'gloreya'  );

    }

    public function get_icon() { 
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function _register_controls() {

      $this->start_controls_section(
         'section_tab',
         [
               'label' => esc_html__('Logo settings', 'gloreya' ),
         ]
      );

	    $this->add_control(
            'site_logo',
            [
                'label' => esc_html__('Logo', 'gloreya' ),
                'type' => Controls_Manager::MEDIA,
              
            ]
        );
    
        $this->add_responsive_control(
            'logo_size_width',
            [
                'label' => esc_html__('Logo Width', 'gloreya' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .gloreya-widget-logo img' => 'max-width: {{VALUE}}px;',
                ],
            ]
        );
        $this->add_responsive_control(
            'logo_size_height',
            [
                'label' => esc_html__('Logo Height', 'gloreya' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .gloreya-widget-logo img' => 'max-height: {{VALUE}}px;',
                    '{{WRAPPER}} .gloreya-widget-logo a' => 'line-height: {{VALUE}}px;',
                ],
            ]
        );
        $this->add_responsive_control(
            'date_text_align', [
                'label'          => esc_html__( 'Alignment', 'gloreya'  ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
    
                    'left'         => [
                        'title'    => esc_html__( 'Left', 'gloreya'  ),
                        'icon'     => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title'    => esc_html__( 'Center', 'gloreya'  ),
                        'icon'     => 'fa fa-align-center',
                    ],
                    'right'         => [
                        'title'     => esc_html__( 'Right', 'gloreya'  ),
                        'icon'     => 'fa fa-align-right',
                    ],
                ],
               'default'         => '',
               'selectors' => [
                   '{{WRAPPER}} .gloreya-widget-logo' => 'text-align: {{VALUE}};'
               ],
            ]
        );
 

        $this->add_responsive_control(
			'logo_padding',
			[
				'label' =>esc_html__( 'Padding', 'gloreya'  ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gloreya-widget-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
      );
       
        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $site_logo = $settings['site_logo'];
      
    ?>
    <div class="gloreya-widget-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <img src="<?php 
             if(isset($site_logo['url']) && $site_logo['url'] !=''){
               echo esc_url( $site_logo['url']);
            }else{
               echo esc_url(
                  gloreya_src(
                     'general_dark_logo',
                     GLOREYA_IMG . '/logo/logo-dark.png'
                  )
               );
            }
            ?>" alt="<?php bloginfo('name'); ?>">
        </a>
    </div>

    <?php  
    }
    protected function _content_template() { }
}