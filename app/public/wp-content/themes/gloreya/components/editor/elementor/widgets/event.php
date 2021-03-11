<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_Event_Widget extends Widget_Base {


    public $base;

    public function get_name() {
        return 'gloreya-event';
    }

    public function get_title() {
        return esc_html__( 'Event reservation', 'gloreya' );
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
                'label' => esc_html__('Gloreya Event', 'gloreya'),
            ]
		);
    

        $this->add_control(
			'title', [
				'label'			=> esc_html__( 'Title', 'gloreya' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'Best food quality', 'gloreya' ),
				'default'	    => esc_html__( 'Good time for barbecue', 'gloreya' ),
			]
		);

        $this->add_control(
			'desc', [
			'label'			=> esc_html__( 'Content', 'gloreya' ),
			'type'			=> Controls_Manager::TEXTAREA,
			'label_block'	=> true,
			'placeholder'	=> esc_html__( 'At Bagatelle we are committed to provide excellent service', 'gloreya' ),
  
           
			]
      );

      $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
      );
    
      $this->add_control(
			'due_date',
			[
				'label' => esc_html__( 'Event Date', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::DATE_TIME,
          
            'picker_options'=>[
              'dateFormat' =>'j,F, Y',
              'enableTime'=>false,
            ],
			]
      );
      
      $this->add_control(
			'event_start_time', [
				'label'			=> esc_html__( 'Start Time', 'gloreya' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( '7:00', 'gloreya' ),
				'default'	    => esc_html__( '7:00', 'gloreya' ),
			]
		);
      
      $this->add_control(
			'event_end_time', [
				'label'			=> esc_html__( 'End Time', 'gloreya' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( '9:00', 'gloreya' ),
				'default'	    => esc_html__( '9:00', 'gloreya' ),
			]
      );

      
      $this->add_control(
			'order_button_title', [
				'label'			=> esc_html__( 'Button text', 'gloreya' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( 'Book a table', 'gloreya' ),
				'default'	    => esc_html__( 'Book a table', 'gloreya' ),
			]
      );
      
      $this->add_control(
			'order_button_url', [
				'label'			=> esc_html__( 'Button url', 'gloreya' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder'	=> esc_html__( '#', 'gloreya' ),
				'default'	    => esc_html__( '#', 'gloreya' ),
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
                    '{{WRAPPER}} .single-event-reservation' => 'text-align: {{VALUE}};',
                   
                    
				],
			]
        );

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
					'{{WRAPPER}} .single-event-reservation h3' => 'color: {{VALUE}};',
				],
			]
		);

        
        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .single-event-reservation h3',
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
					'{{WRAPPER}} .single-event-reservation p' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_group_control(Group_Control_Typography::get_type(),
         [
			 'name'		 => 'feature_content_typography',
			 'selector'	 => '{{WRAPPER}} .single-event-reservation p',
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

        $this->add_control('date_icon_color', 
          [
				'label'		 => esc_html__( 'Date icon color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-event-reservation .event-meta .event-date i' => 'color: {{VALUE}};',
				],
			]
        );
        $this->add_control('time_icon_color', 
          [
				'label'		 => esc_html__( 'Time icon color', 'gloreya' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-event-reservation .event-meta .event-time i' => 'color: {{VALUE}};',
				],
			]
        );
        

      $this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'icon_typography',
			'selector'	 => '{{WRAPPER}} .single-event-reservation .event-meta .event-time i,{{WRAPPER}} .single-event-reservation .event-meta .event-date i',
			]
       ); 
       
      

      $this->end_controls_section();
      $this->start_controls_section('section_button_style',
         [
				'label'	 => esc_html__( 'Reservation button', 'gloreya' ),
				'tab'	   => Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control('button_text_color', 
        [
          'label'		 => esc_html__( 'color', 'gloreya' ),
          'type'		 => Controls_Manager::COLOR,
          'selectors'	 => [
             '{{WRAPPER}} .single-event-reservation .event-order a' => 'color: {{VALUE}};',
          ],
       ]
       );
       $this->add_control('button_bg_color', 
       [
         'label'		 => esc_html__( 'bgcolor', 'gloreya' ),
         'type'		 => Controls_Manager::COLOR,
         'selectors'	 => [
            '{{WRAPPER}} .single-event-reservation .event-order a' => 'background: {{VALUE}};',
         ],
      ]
      );
		$this->end_controls_section();

		
    

    } //Register control end

    protected function render( ) { 
      $settings = $this->get_settings();
     
	
		$title = $settings["title"];
      $desc = $settings["desc"];
      $due_date = $settings["due_date"];
      $event_start_time = $settings["event_start_time"];
      $event_end_time = $settings["event_end_time"];
      $order_button_title = $settings["order_button_title"];
      $order_button_url = $settings["order_button_url"];
      $image = $settings["image"];
    
	
    ?>
 
    
	<div class="row">
      <div class="col-md-6"> 
         <div class="single-event-reservation">
            <h3 class="ts-title">
               <?php echo esc_html($title); ?>
            </h3>
            <div class="event-meta">
               <span class="event-date">
                  <i class="icon icon-calendar"></i> 
                  <?php echo esc_html($due_date); ?>
               </span>  
               <span class="event-time">
                     <i class="icon icon-clock"></i> 
                     <?php echo esc_html($event_start_time); ?>
                     <?php echo esc_html(' - '.$event_end_time); ?>
               </span>   
            </div>
            
            <p>
               <?php echo gloreya_kses($desc); ?>
            </p>
            <div class="event-order">
               <a class="btn" href="<?php echo esc_url($order_button_url); ?>"> 
                  <?php echo esc_html($order_button_title); ?>
               </a>
            </div> 
         </div>
      </div>
      <div class="col-md-6">
        <img src="<?php echo esc_url($image['url']); ?>" />
      </div>

   </div>


    

	
    
    <?php  
    }
    protected function _content_template() { }
}