<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;


class Gloreya_masonary_gallery_Widget extends Widget_Base {


  public $base;

    public function get_name() {
        return 'gloreya-masonary-gallery';
    }

    public function get_title() {

        return esc_html__( 'masonary gallery', 'gloreya' );

    }

    public function get_icon() { 
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'gloreya-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('gallery settings', 'gloreya'),
            ]
        );
        $this->add_control(
			'gallery',
			[
				'label' => __( 'Add Images', 'gloreya' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

        $this->end_controls_section();

        

     
    }

    protected function render( ) { 
        $settings = $this->get_settings();
        $settings = $this->get_settings_for_display();

?>
<div class="ts-masonry">
      <?php
        foreach ( $settings['gallery'] as $image ) {
           ?>
            <div class="ts-masonary-item">
               <a href="<?php echo esc_url( $image['url']); ?>" class="ts-gallery-popup">
                  <img src="<?php echo esc_url($image['url'] ); ?>" alt="<?php echo esc_attr('gallery', 'gloreya'); ?>">
               </a>
            </div>
            <?php
         }

      ?>
    </div>
  

    <?php  
    }
    protected function _content_template() {
   
     }
}