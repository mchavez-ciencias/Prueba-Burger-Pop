<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Gloreya_Product_slider_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'gloreya-product-slider';
    }

    public function get_title() {
        return esc_html__( 'Product Slider', 'gloreya' );
    }

    public function get_icon() { 
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Post', 'gloreya'),
            ]
        );
    
        $this->add_control(
         'product_style',
         [
            'label' => esc_html__( 'Product Slider Style', 'gloreya' ),
            'type' => Custom_Controls_Manager::IMAGECHOOSE,
            'default' => 'style1',
            'options' => [
               'style1'  => [
                  'title' => esc_html__( 'Style 1', 'gloreya' ),
                        'imagelarge' => GLOREYA_IMG. '/admin/product-list/style1.png',
                        'imagesmall' => GLOREYA_IMG. '/admin/product-list/style1.png',
                        'width' => '30%',
               ],
               'style2'  => [
                  'title' => esc_html__( 'Style 2', 'gloreya' ),
                     'imagelarge' => GLOREYA_IMG. '/admin/product-list/style2.png',
                     'imagesmall' => GLOREYA_IMG. '/admin/product-list/style2.png',
                     'width' => '30%',
               ],
               'style3'  => [
                  'title' => esc_html__( 'Style 3', 'gloreya' ),
                     'imagelarge' => GLOREYA_IMG. '/admin/product-list/style3.png',
                     'imagesmall' => GLOREYA_IMG. '/admin/product-list/style3.png',
                     'width' => '30%',
               ],
            ],
         ]
      );


        $this->add_control(
          'post_count',
          [
            'label'         => esc_html__( 'slider count', 'gloreya' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => 4,
          ]
        );

        $this->add_control(
          'post_per_page',
          [
            'label'         => esc_html__( 'Total Post count', 'gloreya' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => 50,
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
			'shap_image',
			[
				'label' => __( 'Shap Image', 'gloreya' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'condition' => ['product_style' => ['style1']],
			]
		);
      
        $this->add_control(
          'post_content_crop',
          [
            'label'         => esc_html__( 'Post Content crop', 'gloreya' ),
            'type'          => Controls_Manager::NUMBER,
            'default'       => '10',
          ]
        );
    

        $this->add_control(
            'post_cats',
            [
                'label' =>esc_html__('Select Categories', 'gloreya'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->post_category(),
                'label_block' => true,
                'multiple'  => true,
            ]
        );
   
     

        $this->add_control(
            'post_sortby',
            [
                'label'     =>esc_html__( 'Post sort by', 'gloreya' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'latestpost',
                'options'   => [
                        'latestpost'      =>esc_html__( 'Latest posts', 'gloreya' ),
                        'mostdiscussed'    =>esc_html__( 'Most discussed', 'gloreya' ),
                    ],
            ]
        );
        
        $this->add_control(
            'post_order',
            [
                'label'     =>esc_html__( 'Post order', 'gloreya' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                        'DESC'      =>esc_html__( 'Descending', 'gloreya' ),
                        'ASC'       =>esc_html__( 'Ascending', 'gloreya' ),
                    ],
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

    $this->add_control('auto_play',
        [
        'label'       => esc_html__('Auto play', 'gloreya'),
        'type'        => Controls_Manager::SWITCHER,
        'label_on'    => esc_html__('Yes', 'gloreya'),
        'label_off'   => esc_html__('No', 'gloreya'),
        'default'     => 'no',

        ]
    ); 
    
   

        $this->end_controls_section();

        $this->start_controls_section('gloreya_style_block_section',
        [
           'label' => esc_html__( ' Post', 'gloreya' ),
           'tab' => Controls_Manager::TAB_STYLE,
        ]
       );
       $this->add_control(
			'title_settings',
			[
				'label' => __( 'Title Style', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
  
       $this->add_control(
           'block_title_color',
           [
              'label' => esc_html__('Title color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-product-single-item .ts-title a' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-product-center-item .ts-product-single-item3 .ts-title a' => 'color: {{VALUE}};',
              ],
           ]
        );
       $this->add_control(
           'block_title_hover_color',
           [
              'label' => esc_html__('Title hover color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-product-single-item:hover .ts-title a' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-product-center-item .ts-product-single-item3:hover .ts-title a' => 'color: {{VALUE}};',
              ],
           ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
               'name' => 'post_title_typography',
               'label' => esc_html__( 'Title Typography', 'gloreya' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .ts-product-single-item .ts-title, {{WRAPPER}} .ts-product-center-item .ts-product-single-item3 .ts-title',
            ]
         );

         $this->add_control(
            'desc_style',
            [
               'label' => __( 'Description Style', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::HEADING,
               'separator' => 'before',
            ]
         );
  
        $this->add_control(
           'content_color',
           [
              'label' => esc_html__('Description color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-product-single-item p' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-product-single-item3 p' => 'color: {{VALUE}};',
              ],
           ]
        );
        $this->add_control(
           'content_hover_color',
           [
              'label' => esc_html__('Hover Description color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-product-single-item:hover p' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-product-single-item3:hover p' => 'color: {{VALUE}};',
              ],
           ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
               'name' => 'post_content_typography',
               'label' => esc_html__( 'Description Typography', 'gloreya' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .ts-product-single-item p, {{WRAPPER}} .ts-product-single-item3 p',
            ]
         );
         $this->add_control(
            'price_style',
            [
               'label' => __( 'Price Style', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::HEADING,
               'separator' => 'before',
            ]
         );
        $this->add_control(
           'price_color',
           [
              'label' => esc_html__('Price color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-product-single-item .product-price' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-product-single-item3 .product-price' => 'color: {{VALUE}};',
              ],
           ]
        );
        $this->add_control(
           'price_hover_color',
           [
              'label' => esc_html__('Price hover color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-product-single-item:hover .product-price' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-product-single-item3:hover .product-price' => 'color: {{VALUE}};',
              ],
           ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
               'name' => 'price_typography',
               'label' => esc_html__( 'Price Typography', 'gloreya' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .product-price',
            ]
         );
         $this->add_control(
            'btn_style',
            [
               'label' => __( 'Button Style', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::HEADING,
               'separator' => 'before',
            ]
         );
         $this->add_control(
            'btn_color',
            [
               'label' => esc_html__('Btn color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
             
               'selectors' => [
                  '{{WRAPPER}}  .product-btn .btn' => 'color: {{VALUE}};',
               ],
            ]
         );
         $this->add_control(
            'btn_bg_color',
            [
               'label' => esc_html__('Btn background color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'default' => '',
             
               'selectors' => [
                  '{{WRAPPER}} .product-btn .btn' => 'background-color: {{VALUE}};',
               ],
            ]
         );

        $this->add_control(
           'btn_hover',
           [
              'label' => esc_html__('Btn hover color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-product-single-item:hover .product-btn .btn' => 'color: {{VALUE}};',
                 '{{WRAPPER}} .ts-product-single-item3:hover .product-btn .btn' => 'color: {{VALUE}};',
              ],
           ]
        );
        $this->add_control(
           'btn_hover_bg',
           [
              'label' => esc_html__('Btn hover bg color', 'gloreya'),
              'type' => Controls_Manager::COLOR,
              'default' => '',
            
              'selectors' => [
                 '{{WRAPPER}} .ts-product-single-item:hover .product-btn .btn' => 'background-color: {{VALUE}};',
                 '{{WRAPPER}} .ts-product-single-item3:hover .product-btn .btn' => 'background-color: {{VALUE}};',
              ],
           ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
               'name' => 'btn_typography',
               'label' => esc_html__( 'Button Typography', 'gloreya' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .product-btn .btn',
            ]
         );
         $this->add_control(
            'advance_style',
            [
               'label' => __( 'Advance Style', 'gloreya' ),
               'type' => \Elementor\Controls_Manager::HEADING,
               'separator' => 'before',
            ]
         );
         $this->add_control(
            'box_hover',
            [
               'label' => esc_html__('Content Box hover bg color', 'gloreya'),
               'type' => Controls_Manager::COLOR,
               'selectors' => [
                  '{{WRAPPER}} .ts-product-single-item:hover' => 'background-color: {{VALUE}};',
                  '{{WRAPPER}} .ts-product-item.style2 .product-shape-hover-img' => 'fill: {{VALUE}};',
               ],
            ]
         );
    

       
  
        $this->end_controls_section();
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $post_order         = $settings['post_order'];
        $post_sortby        = $settings['post_sortby'];
        $post_content_crop    = $settings['post_content_crop'];
        $post_number        = $settings['post_count'];
        $food_currency        = $settings['food_currency'];
        $shap_image        = $settings['shap_image'];
        $show_navigation        = $settings['show_navigation'];
        $auto_play        = $settings['auto_play'];
        $product_style        = $settings['product_style'];
        $post_per_page       = $settings['post_per_page'];
      
        
        $arg = [
            'post_type'   =>  'product',
            'post_status' => 'publish',
            'order' => $settings['post_order'],
            'posts_per_page' => $post_per_page,

        ];

        $arg['tax_query']  = 
        [
           array(
            'taxonomy'  => 'product_cat',
            'field'     => 'term_id',
            'terms'     => $settings['post_cats'],
            'operator'  => 'IN',
           )
        ];


        switch($settings['post_sortby']){
         case 'mostdiscussed':
             $arg['orderby'] = 'comment_count';
         break;
         default:
             $arg['orderby'] = 'date';
         break;
     }

     $controls = [
        'nav'       => $show_navigation,
        'auto_play' => $auto_play,
        'post_count' =>  $post_number,
     ];
     $controls = json_encode($controls); 



        $query = new \WP_Query( $arg ); 
        
        ?>
        
        <?php if($product_style == 'style1'){ ?>
            <?php if ( $query->have_posts() ) : ?>
                  <div class="ts-product-item ts-product-slider owl-carousel" data-controls="<?php echo esc_attr($controls); ?>">
                           <?php
                           while ($query->have_posts()) : $query->the_post();
                              $price =  get_post_meta(get_the_ID(), '_price', true);
                           ?>
                           <div class="ts-product-single-item">
                            <img class="border-shap" src="<?php echo esc_url( GLOREYA_IMG.'/menu_border_shape.png'); ?>" alt="<?php echo esc_attr(the_title_attribute()); ?>">

                              <?php if(isset($shap_image) && $shap_image['url'] !=''): ?>
                                 <div class="shap-img"><img src="<?php echo esc_url($shap_image['url']); ?>" alt="<?php the_title_attribute() ?>"></div>
                              <?php endif; ?>
                              <h3 class="ts-title"> <a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo esc_html(get_the_title()); ?></a></h3>
                              <p><?php echo esc_html(wp_trim_words(get_the_content(), $post_content_crop,'')); ?></p>
                              <h4 class="product-price"><?php echo esc_html($food_currency); ?> <?php echo esc_html($price);  ?></h4>
                              <div class="product-btn">
                                 <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-primary">
                                 <i class="icon icon-tscart"></i>
                                    <?php echo esc_html__("Order Now", 'gloreya'); ?></a>
                              </div>
                              <?php if(has_post_thumbnail()): ?>
                                 <div class="product-img">
                                       <img 
                                          class="img-fluid" 
                                          src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>" 
                                          alt="<?php echo esc_attr(the_title_attribute()); ?>">
                                 </div>
                              <?php endif; ?>
                           </div>
                           <?php
                              
                           ?>
                  
                           <?php endwhile; ?>
                  </div><!-- block-item6 -->
               <?php wp_reset_postdata(); ?>
            <?php endif; ?>
         <?php }elseif ( $product_style == 'style2' ) {?>

            <?php if ( $query->have_posts() ) : ?>

                  <div class="ts-product-item style2 ts-product-slider owl-carousel" data-controls="<?php echo esc_attr($controls); ?>">
                        <?php
                        while ($query->have_posts()) : $query->the_post();
                           $price =  get_post_meta(get_the_ID(), '_price', true);
                        ?>
                        <div class="ts-product-single-item">
                           <div class="bg-shape-img">
                              <img class="product-shape-img" src="<?php echo esc_url( GLOREYA_IMG.'/menu_shape.svg'); ?>" alt="<?php echo esc_attr(the_title_attribute()); ?>">
                              <img class="product-shape-hover-img" src="<?php echo esc_url( GLOREYA_IMG.'/menu_shape_hover.svg'); ?>" alt="<?php echo esc_attr(the_title_attribute()); ?>">
                           </div>
                        <?php if(has_post_thumbnail()): ?>
                              <div class="product-img">
                                    <img 
                                       class="img-fluid" 
                                       src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>" 
                                       alt="<?php echo esc_attr(the_title_attribute()); ?>">
                              </div>
                           <?php endif; ?>
                       
                           <h3 class="ts-title"> <a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo esc_html(get_the_title()); ?></a></h3>
                           <p><?php echo esc_html(wp_trim_words(get_the_content(), $post_content_crop,'')); ?></p>
                           <h4 class="product-price"><?php echo esc_html($food_currency); ?> <?php echo esc_html($price);  ?></h4>
                           <div class="product-btn">
                              <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-primary">
                              <i class="icon icon-tscart"></i>
                             </a>
                           </div>
                          
                        </div>
                        <?php
                           
                        ?>
               
                        <?php endwhile; ?>
                  </div><!-- block-item6 -->
               <?php wp_reset_postdata(); ?>
            <?php endif; ?>

         <?php }elseif ( $product_style == 'style3' ) {?>

            <?php if ( $query->have_posts() ) : ?>

                  <div class="ts-product-center-item style3 ts-product-slider3 owl-carousel" data-controls="<?php echo esc_attr($controls); ?>">
                        <?php
                        while ($query->have_posts()) : $query->the_post();
                           $price =  get_post_meta(get_the_ID(), '_price', true);
                        ?>
                        <div class="ts-product-single-item3">
                        
                        <?php if(has_post_thumbnail()): ?>
                              <div class="product-img">
                                    <img 
                                       class="img-fluid" 
                                       src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>" 
                                       alt="<?php echo esc_attr(the_title_attribute()); ?>">
                              </div>
                           <?php endif; ?>
                           <h3 class="ts-title ex-title"> <a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo esc_html(get_the_title()); ?></a></h3>

                           <div class="product-content">
                              <h3 class="ts-title"> <a href="<?php echo esc_url(get_the_permalink()); ?>"> <?php echo esc_html(get_the_title()); ?></a></h3>
                                 <p><?php echo esc_html(wp_trim_words(get_the_content(), $post_content_crop,'')); ?></p>
                                 <h4 class="product-price"><?php echo esc_html($food_currency); ?> <?php echo esc_html($price);  ?></h4>
                                 <div class="product-btn">
                                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-primary">
                                    <i class="icon icon-tscart"></i>
                                 </a>
                                 </div>
                           </div>
                          
                        </div>
                        <?php
                           
                        ?>
               
                        <?php endwhile; ?>
                  </div><!-- block-item6 -->
               <?php wp_reset_postdata(); ?>
            <?php endif; ?>

         <?php } ?>

      <?php  
    }
    protected function _content_template() { }

    public function post_category() {

      $terms = get_terms( array(
            'taxonomy'    => 'product_cat',
            'hide_empty'  => false,
            'posts_per_page' => -1, 
      ) );

      $cat_list = [];
      foreach($terms as $post) {
      $cat_list[$post->term_id]  = [$post->name];
      }
      return $cat_list;
   }
}