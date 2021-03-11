<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Gloreya_Testimonial_Widget extends Widget_Base {

    public function get_name() {
        return 'gloreya-testimonial';
    }

    public function get_title() {
        return esc_html__( 'Gloreya testimonial', 'gloreya' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return ['gloreya-elements'];
    }

    protected function _register_controls() {
        
        $this->start_controls_section('section_tab_style',
            [
                'label' => esc_html__('Gloreya quote carousel', 'gloreya'),
            ]
         );

         
         $this->add_control(
            'testimonial_style',
            [
               'label' => esc_html__( 'Testimonial Style', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => 'style1',
               'options' => [
                  'style1'  => esc_html__( 'Style 1', 'gloreya' ),
                  'style2' =>  esc_html__( 'Style 2', 'gloreya' ),
                  'style3' =>  esc_html__( 'Style 3', 'gloreya' ),
                  'style4' =>  esc_html__( 'Style 4', 'gloreya' ),
              
               ],
            ]
         );

         $this->add_control('show_client_image',
                     [
                     'label'       => esc_html__('Show client image', 'gloreya'),
                     'type'        => Controls_Manager::SWITCHER,
                     'label_on'    => esc_html__('Yes', 'gloreya'),
                     'label_off'   => esc_html__('No', 'gloreya'),
                     'default'     => 'yes',
             
                     ]
         );

        $this->add_control('show_navigation',
                     [
                     'label'       => esc_html__('Show Navigation', 'gloreya'),
                     'type'        => Controls_Manager::SWITCHER,
                     'label_on'    => esc_html__('Yes', 'gloreya'),
                     'label_off'   => esc_html__('No', 'gloreya'),
                     'default'     => 'yes',
             
                     ]
         ); 
        $this->add_control('show_pagination',
                     [
                     'label'       => esc_html__('Show Pagination', 'gloreya'),
                     'type'        => Controls_Manager::SWITCHER,
                     'label_on'    => esc_html__('Yes', 'gloreya'),
                     'label_off'   => esc_html__('No', 'gloreya'),
                     'default'     => 'yes',
             
                     ]
         ); 
         
         $this->add_control('auto_play',
            [
            'label'       => esc_html__('Auto play', 'gloreya'),
            'type'        => Controls_Manager::SWITCHER,
            'label_on'    => esc_html__('Yes', 'gloreya'),
            'label_off'   => esc_html__('No', 'gloreya'),
            'default'     => 'yes',
   
            ]
         ); 

         $this->add_control('auto_loop',
            [
            'label'       => esc_html__('Slider loop', 'gloreya'),
            'type'        => Controls_Manager::SWITCHER,
            'label_on'    => esc_html__('Yes', 'gloreya'),
            'label_off'   => esc_html__('No', 'gloreya'),
            'default'     => 'yes',
   
            ]
        ); 

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'qoute_content', [
               'label'        => esc_html__('Qoute Content', 'gloreya'),
               'type'         => Controls_Manager::TEXTAREA,
               'default'      => esc_html__(' A small river named Duden flows by their place and supplies it with the necessary regelialia. It is
               a paradisematic country, in which', 'gloreya'),
               'label_block'  => true,
            ]
         );
         
        $repeater->add_control(
            'qoute_title', [
               'label'       => esc_html__('Client Name', 'gloreya'),
               'type'        => Controls_Manager::TEXT,
               'default'     => esc_html__('Quote Carousel #1', 'gloreya'),
               'label_block' => true,
            ]
         );
        $repeater->add_control(
            'qoute_designation', [
               'label'        => esc_html__('Client designation', 'gloreya'),
               'type'         => Controls_Manager::TEXT,
               'default'      => esc_html__('CEO,apple', 'gloreya'),
               'label_block'  => true,
            ]
         );
        $repeater->add_control(
            'qoute_photo', [
               'label'       => esc_html__('Client image', 'gloreya'),
               'type'        => Controls_Manager::MEDIA,
               'label_block' => true,
            ]
         );
         
         $this->add_control(
            'quote_carousel',
            [
               'label' => esc_html__('Quote Carousel', 'gloreya'),
               'type' => \Elementor\Controls_Manager::REPEATER,
               'fields' => $repeater->get_controls(),
               'default' => [
                  [
                     'qoute_title' => esc_html__('Quote Carousel #1', 'gloreya') 
                  ],
                  [
                     'qoute_title' => esc_html__('Quote Carousel #2', 'gloreya') 
                  ],
                  [
                     'qoute_title' => esc_html__('Quote Carousel #3', 'gloreya') 
                  ],
               ],
               'title_field' => '{{{ qoute_title }}}',
            ]
         );

        $this->end_controls_section();

        //style
        $this->start_controls_section('style_section',
            [
               'label'      => esc_html__( 'Style Section', 'gloreya' ),
               'tab'        => Controls_Manager::TAB_STYLE,
            ]
       ); 
      
      $this->add_control('testimonial_text_color',
            [
               'label'      => esc_html__('Content color', 'gloreya'),
               'type'       => Controls_Manager::COLOR,
               'selectors'  => [

                     '{{WRAPPER}} .testimonial-author-content .testimonial-text' => 'color: {{VALUE}};',
               ],
            ]
        );
      $this->add_control('testimonial_qoute_color',
            [
               'label'      => esc_html__('Qoute color', 'gloreya'),
               'type'       => Controls_Manager::COLOR,
               'selectors'  => [

                     '{{WRAPPER}} .testimonial-author-content .testimonial-text i' => 'color: {{VALUE}};',
               ],
            ]
        );

     

      $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'Content_typogrphy',
            'label' => esc_html__( 'Content Typography', 'gloreya' ),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .testimonial-author-content .testimonial-text',
        ]
       );

       $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_background',
				'label' => esc_html__( 'Background', 'gloreya' ),
				'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .ts-testimonial-standard',
            'condition' => [
               'testimonial_style' => ['style1','style3']
            ]
			]
      );


      $this->add_control(
			'content_background_style2_headingl',
			[
				'label' => esc_html__( 'Section Left', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
               'testimonial_style' => ['style2']
            ]
			]
      );

      $this->add_control('left_content_color',
            [
               'label'      => esc_html__('Left content color', 'gloreya'),
               'type'       => Controls_Manager::COLOR,
               'selectors'  => [
                  '{{WRAPPER}} .ts-testimonial .testimonial-author-content.one p.testimonial-text' => 'color: {{VALUE}};',
               ],
               'condition' => [
                  'testimonial_style' => ['style2']
               ]
            ]
      );
      
      $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_background_style2_sec1',
            'label' => esc_html__( 'Background Left', 'gloreya' ),
            'description' => esc_html__( 'Background Left', 'gloreya' ),
				'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .testimonial-author-content.one',
            'show_label' => true,
            'label_block' =>true,
            'condition' => [
               'testimonial_style' => ['style2']
            ]
			]
      );

      $this->add_control(
			'content_background_style2_headingr',
			[
				'label' => esc_html__( 'Section right', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
               'testimonial_style' => ['style2', 'style4']
            ]
			]
      );

      $this->add_control('right_content_color',
            [
               'label'      => esc_html__('Right content color', 'gloreya'),
               'type'       => Controls_Manager::COLOR,
               'selectors'  => [
                  '{{WRAPPER}} .ts-testimonial .testimonial-author-content.two p.testimonial-text' => 'color: {{VALUE}};',
               ],
               'condition' => [
                  'testimonial_style' => ['style2', 'style4']
               ]
            ]
      );
      $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_background_style2_sec2',
            'label' => esc_html__( 'Background Right', 'gloreya' ),
            'description' => esc_html__( 'Background Right', 'gloreya' ),
				'types' => [ 'classic', 'gradient' ],
            'selector' => '{{WRAPPER}} .testimonial-author-content.two',
            'show_label' => true,
            'label_block' =>true,
            'condition' => [
               'testimonial_style' => ['style2', 'style4']
            ]
			]
		);
      
      $this->end_controls_section(); 
       
        //style
        $this->start_controls_section('author_section',
            [
               'label'      => esc_html__( 'Testimonial Footer Section', 'gloreya' ),
               'tab'        => Controls_Manager::TAB_STYLE,
            ]
       ); 
      
       $this->add_control('client_title_color',
            [
               'label'      => esc_html__('Client Title color', 'gloreya'),
               'type'       => Controls_Manager::COLOR,
               'selectors'  => [

                     '{{WRAPPER}} .testimonial-author-content .testimonial-footer .author-name' => 'color: {{VALUE}};',
               ],
               'condition' => [
                  'testimonial_style' => ['style1', 'style3']
               ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'client_name_typogrphy',
                'label' => esc_html__( 'Title Typography', 'gloreya' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                  'testimonial_style' => ['style1', 'style3']
                ],
                'selector' => '{{WRAPPER}} .testimonial-author-content .testimonial-footer .author-name',
            ]
        );

      $this->add_control('client_designation_color',
        [
           'label'      => esc_html__('Designation color', 'gloreya'),
           'type'       => Controls_Manager::COLOR,
           'selectors'  => [
               '{{WRAPPER}} .testimonial-author-content .testimonial-footer .author-designation' => 'color: {{VALUE}};',
           ],
           'condition' => [
            'testimonial_style' => ['style1','style3']
         ]
        ]
      );
      $this->add_control('slide_pagination_color',
        [
           'label'      => esc_html__('Pagination color', 'gloreya'),
           'type'       => Controls_Manager::COLOR,
           'selectors'  => [
               '{{WRAPPER}} .ts-testimonial-standard .owl-carousel .owl-dots .owl-dot' => 'background-color: {{VALUE}};',
           ],
           'condition' => [
            'testimonial_style' => ['style1', 'style3']
         ]
        ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
             'name' => 'client_designation_typogrphy',
             'label' => esc_html__( 'Designation typography', 'gloreya' ),
             'scheme' => Scheme_Typography::TYPOGRAPHY_1,
             'selector' => '{{WRAPPER}} .testimonial-author-content .testimonial-footer .author-designation',
             'condition' => [
               'testimonial_style' => ['style1', 'style3']
            ]
         ]
      );

      //style2
      $this->add_control(
			'content_background_style2_heading_l',
			[
				'label' => esc_html__( 'Section Left', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
               'testimonial_style' => ['style2']
            ]
			]
      );
      
      $this->add_control('client_title_color_style2l',
            [
               'label'      => esc_html__('Client Title color', 'gloreya'),
               'type'       => Controls_Manager::COLOR,
               'selectors'  => [

                     '{{WRAPPER}} .testimonial-author-content.one .testimonial-footer .author-name' => 'color: {{VALUE}};',
               ],
               'condition' => [
                  'testimonial_style' => ['style2']
               ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'client_name_typogrphy_style2l',
                'label' => esc_html__( 'Title Typography', 'gloreya' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                  'testimonial_style' => ['style2']
                ],
                'selector' => '{{WRAPPER}} .testimonial-author-content.one .testimonial-footer .author-name',
            ]
        );

      $this->add_control('client_designation_color_style2l',
        [
           'label'      => esc_html__('Designation color', 'gloreya'),
           'type'       => Controls_Manager::COLOR,
           'selectors'  => [
               '{{WRAPPER}} .testimonial-author-content.one .testimonial-footer .author-designation' => 'color: {{VALUE}};',
           ],
           'condition' => [
            'testimonial_style' => ['style2']
         ]
        ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
             'name' => 'client_designation_typogrphy_style2l',
             'label' => esc_html__( 'Designation typography', 'gloreya' ),
             'scheme' => Scheme_Typography::TYPOGRAPHY_1,
             'selector' => '{{WRAPPER}} .testimonial-author-content.one .testimonial-footer .author-designation',
             'condition' => [
               'testimonial_style' => ['style2']
            ]
         ]
      );

      $this->add_control(
			'content_background_style2_heading_r',
			[
				'label' => esc_html__( 'Section Right', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
               'testimonial_style' => ['style2', 'style4']
            ]
			]
      );
      
      $this->add_control('client_title_color_style2r',
            [
               'label'      => esc_html__('Client Title color', 'gloreya'),
               'type'       => Controls_Manager::COLOR,
               'selectors'  => [
                    '{{WRAPPER}} .testimonial-author-content.two .testimonial-footer .author-name' => 'color: {{VALUE}};',
               ],
               'condition' => [
                  'testimonial_style' => ['style2', 'style4']
               ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'client_name_typogrphy_style2r',
                'label' => esc_html__( 'Title Typography', 'gloreya' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                  'testimonial_style' => ['style2', 'style4']
                ],
                'selector' => '{{WRAPPER}} .testimonial-author-content.two .testimonial-footer .author-name',
            ]
        );

      $this->add_control('client_designation_color_style2r',
        [
           'label'      => esc_html__('Designation color', 'gloreya'),
           'type'       => Controls_Manager::COLOR,
           'selectors'  => [
               '{{WRAPPER}} .testimonial-author-content.two .testimonial-footer .author-designation' => 'color: {{VALUE}};',
           ],
           'condition' => [
            'testimonial_style' => ['style2', 'style4']
          ]
        ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
             'name' => 'client_designation_typogrphy_style2r',
             'label' => esc_html__( 'Designation typography', 'gloreya' ),
             'scheme' => Scheme_Typography::TYPOGRAPHY_1,
             'selector' => '{{WRAPPER}} .testimonial-author-content.two .testimonial-footer .author-designation',
             'condition' => [
               'testimonial_style' => ['style2', 'style4']
            ]
         ]
      );

    
      
      $this->end_controls_section();  

    }

    protected function render( ) {

        $settings           =     $this->get_settings();
        $quote_carousel     =     $settings['quote_carousel'];
        $show_navigation    =     $settings["show_navigation"];
        $show_pagination    =     $settings["show_pagination"];
        $auto_play          =     $settings["auto_play"];
        $auto_loop          =     $settings["auto_loop"];
        $testimonial_style  =     $settings["testimonial_style"];
        $show_client_image  =     $settings["show_client_image"];
        
        $controls = [
           'nav'       => $show_navigation,
           'dot'       => $show_pagination,
           'auto_play' => $auto_play,
           'auto_loop' => $auto_loop,
        ];
        $controls = json_encode($controls); 
        ?>
         <?php if($testimonial_style=="style1"): ?>
           
            <div  class="ts-testimonial-standard ts-testimonial-classic text-center" >
                     <div data-controls="<?php echo esc_attr($controls); ?>" class="testimonial-carousel owl-carousel">
                     <?php foreach($quote_carousel as $quote_item): ?>
                        <div class="testimonial-author-content">
                              <p class="testimonial-text"><i class="fa fa-quote-left" aria-hidden="true"></i>
                              <?php echo gloreya_kses($quote_item['qoute_content']); ?>
                              </p>
                              <div class="testimonial-footer">
                                 <?php
                                    $client_img = $quote_item['qoute_photo'];
                                 ?>
                              <?php if(isset($client_img['url']) && $client_img['url']!='' && $show_client_image=='yes') : ?>
                                    <img src=" <?php echo esc_url($client_img["url"]); ?> " alt="<?php echo esc_attr($quote_item['qoute_title']); ?>" class="img-fluid testimonial-img">
                                 <?php endif; ?>
                                 <h4 class="author-name"><?php echo esc_html($quote_item['qoute_title']); ?></h4>
                                 <span class="author-designation"><?php echo esc_html($quote_item['qoute_designation']); ?>
                                 </span>
                              </div>
                        </div>
                     <?php endforeach; ?>
                     </div>
            </div>
          <?php endif; ?>
          <?php if($testimonial_style=="style2"): ?>
            <div  class="ts-testimonial ts-testimonial-classic">
                  <div class="row">
                  <?php foreach($quote_carousel as $t_key => $quote_item): ?>
                     
                  <?php if($t_key==0): ?>
                     <div class="col-md-6 ">
                        <div class="testimonial-author-content one">
                              <p class="testimonial-text">
                                 <i class="fa fa-quote-left" aria-hidden="true"> </i> 
                                 <?php echo gloreya_kses($quote_item['qoute_content']); ?>
                               </p>
                              <div class="testimonial-footer media">
                                 <?php
                                    $client_img = $quote_item['qoute_photo'];
                                    
                                 ?>
                                    <?php if(isset($client_img['url']) && $client_img['url']!='' && $show_client_image=='yes') : ?>
                                    <img src="<?php echo esc_url($client_img["url"]); ?>" alt="<?php echo esc_attr($quote_item['qoute_title']); ?>" class="img-fluid testimonial-img">
                                 <?php endif; ?> 
                                 <div class="testimonial-info align-self-center">
                                    <h4 class="author-name"><?php echo esc_html($quote_item['qoute_title']); ?></h4>
                                    <span class="author-designation"><?php echo esc_html($quote_item['qoute_designation']); ?></span>
                                 </div>
                              </div>
                        </div>
                     </div>
                  <?php endif; ?>
                  <?php if($t_key==1): ?>
                     <div class="col-md-6 ">
                        <div class="testimonial-author-content two">
                            <p class="testimonial-text">
                                 <i class="fa fa-quote-left" aria-hidden="true"> </i> 
                                 <?php echo gloreya_kses($quote_item['qoute_content']); ?>
                               </p>
                              <div class="testimonial-footer media">
                                 <?php
                                    $client_img = $quote_item['qoute_photo'];
                                    
                                 ?>
                                    <?php if(isset($client_img['url']) && $client_img['url']!='' && $show_client_image=='yes') : ?>
                                    <img src="<?php echo esc_url($client_img["url"]); ?>" alt="<?php echo esc_attr($quote_item['qoute_title']); ?>" class="img-fluid testimonial-img">
                                 <?php endif; ?> 
                                 <div class="testimonial-info align-self-center">
                                 <h4 class="author-name"><?php echo esc_html($quote_item['qoute_title']); ?></h4>
                                    <span class="author-designation"><?php echo esc_html($quote_item['qoute_designation']); ?></span>
                                 </div>
                              </div>
                        </div>
                     </div>
                  <?php break; endif; ?>   
                  <?php endforeach; ?> 
                  </div>
             </div>

          <?php endif; ?>

          <?php if($testimonial_style=="style3"): ?>
            <div  class="ts-testimonial-standard ts-testimonial-classic text-center" >
                     <div data-controls="<?php echo esc_attr($controls); ?>" class="testimonial-carousel owl-carousel">
                     <?php foreach($quote_carousel as $quote_item): ?>
                        <div class="testimonial-author-content">
                             <div class="testimonial-footer">
                                 <?php
                                    $client_img = $quote_item['qoute_photo'];
                                 ?>
                              <?php if(isset($client_img['url']) && $client_img['url']!='' && $show_client_image=='yes') : ?>
                                    <img src=" <?php echo esc_url($client_img["url"]); ?> " alt="<?php echo esc_attr($quote_item['qoute_title']); ?>" class="img-fluid testimonial-img">
                                 <?php endif; ?>
                                 <h4 class="author-name"><?php echo esc_html($quote_item['qoute_title']); ?></h4>
                                 <span class="author-designation"><?php echo esc_html($quote_item['qoute_designation']); ?>
                                 </span>
                              </div>
                              <p class="testimonial-text"><i class="fa fa-quote-left" aria-hidden="true"></i>
                              <?php echo gloreya_kses($quote_item['qoute_content']); ?>
                              </p>
                            
                        </div>
                     <?php endforeach; ?>
                     </div>
            </div>
          <?php endif; ?>


          <?php if($testimonial_style=="style4"): ?>
            <div  class="ts-testimonial ts-testimonial-classic testimonial-carousel owl-carousel style4" data-controls="<?php echo esc_attr($controls); ?>">
               <?php foreach($quote_carousel as $t_key => $quote_item): ?>
                     <div class="row">
                     <div class="col-lg-6">
                        <div class="testimonial-thumb">
                            <?php
                                    $client_img = $quote_item['qoute_photo'];
                                    
                                 ?>
                                    <?php if(isset($client_img['url']) && $client_img['url']!='' && $show_client_image=='yes') : ?>
                                    <img src="<?php echo esc_url($client_img["url"]); ?>" alt="<?php echo esc_attr($quote_item['qoute_title']); ?>" class="img-fluid testimonial-img">
                                 <?php endif; ?> 
                        </div>
                     </div>
                     <div class="col-lg-6 ">
                        <div class="testimonial-author-content two">
                            <p class="testimonial-text">
                                 <i class="fa fa-quote-left" aria-hidden="true"> </i> 
                                 <?php echo gloreya_kses($quote_item['qoute_content']); ?>
                               </p>
                              <div class="testimonial-footer media">
                             
                                 <div class="testimonial-info align-self-center">
                                 <h4 class="author-name"><?php echo esc_html($quote_item['qoute_title']); ?></h4>
                                    <span class="author-designation"><?php echo esc_html($quote_item['qoute_designation']); ?></span>
                                 </div>
                              </div>
                        </div>
                     </div>
                  
                  </div>
                  <?php endforeach; ?> 
             </div>

          <?php endif; ?>



        <?php
    }
    protected function _content_template() { }
}