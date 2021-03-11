<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if(defined('ELEMENTOR_VERSION')):

include_once GLOREYA_EDITOR . '/elementor/manager/controls.php';

class GLOREYA_Shortcode{

	/**
     * Holds the class object.
     *
     * @since 1.0
     *
     */
    public static $_instance;
    

    /**
     * Localize data array
     *
     * @var array
     */
    public $localize_data = array();

	/**
     * Load Construct
     * 
     * @since 1.0
     */

	public function __construct(){

		add_action('elementor/init', array($this, 'GLOREYA_elementor_init'));
        add_action('elementor/controls/controls_registered', array( $this, 'GLOREYA_icon_pack' ), 11 );
        add_action('elementor/controls/controls_registered', array( $this, 'control_image_choose' ), 13 );
        add_action('elementor/controls/controls_registered', array( $this, 'GLOREYA_ajax_select2' ), 13 );
        add_action('elementor/widgets/widgets_registered', array($this, 'GLOREYA_shortcode_elements'));
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_enqueue_styles' ) );
        add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_enqueue_scripts' ) );

        $this -> Gloreya_elementor_icon_pack();
        
	}


    /**
     * Enqueue Scripts
     *
     * @return void  
     */ 
    
     public function enqueue_scripts() {
         wp_enqueue_script( 'gloreya-main-elementor', GLOREYA_JS  . '/elementor.js',array( 'jquery', 'elementor-frontend' ), GLOREYA_VERSION, true );
    }

    /**
     * Enqueue editor styles
     *
     * @return void
     */

    public function editor_enqueue_styles() {
  
        wp_enqueue_style( 'gloreya-icon-elementor', GLOREYA_CSS.'/iconfont.css',null, GLOREYA_VERSION );

    }

    /**
     * Preview Enqueue Scripts
     *
     * @return void
     */

    public function preview_enqueue_scripts() {}
	/**
     * Elementor Initialization
     *
     * @since 1.0
     *
     */

    public function GLOREYA_elementor_init(){
    
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'gloreya-elements',
            [
                'title' =>esc_html__( 'GLOREYA', 'gloreya' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
    }

    /**
     * Extend Icon pack core controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */ 

    public function GLOREYA_icon_pack( $controls_manager ) {

        require_once GLOREYA_EDITOR_ELEMENTOR. '/controls/icon.php';

        $controls = array(
            $controls_manager::ICON => 'Gloreya_Icon_Controler',
        );

        foreach ( $controls as $control_id => $class_name ) {
            $controls_manager->unregister_control( $control_id );
            $controls_manager->register_control( $control_id, new $class_name() );
        }

    }


    // elementor icon fonts loaded

        public function Gloreya_elementor_icon_pack(  ) {

            $this->__generate_font();
            
            add_filter( 'elementor/icons_manager/additional_tabs', function(){
                    return apply_filters( 'elementor/icons_manager/native', [
                        
                        'icon-gloreya' => [
                            'name' => 'icon-gloreya',
                            'label' => esc_html__( 'Gloreya Icon', 'gloreya' ),
                            'url' => GLOREYA_CSS . '/iconfont.css',
                            'enqueue' => [ GLOREYA_CSS . '/iconfont.css' ],
                            'prefix' => 'icon-',
                            'displayPrefix' => 'icon',
                            'labelIcon' => 'icon icon-hand',
                            'ver' => '5.9.0',
                            'fetchJson' => GLOREYA_JS . '/iconfont.js',
                            'native' => true,
                        ]
                    ]);
                }
            );
            
        }
	
        public function __generate_font(){
            global $wp_filesystem;
    
            require_once ( ABSPATH . '/wp-admin/includes/file.php' );
            WP_Filesystem();
            $css_file =  GLOREYA_CSS_DIR . '/iconfont.css';
        
            if ( $wp_filesystem->exists( $css_file ) ) {
                $css_source = $wp_filesystem->get_contents( $css_file );
            } // End If Statement
            
            preg_match_all( "/\.(icon-.*?):\w*?\s*?{/", $css_source, $matches, PREG_SET_ORDER, 0 );
            $iconList = [];
            
            foreach ( $matches as $match ) {
                $new_icons[$match[1] ] = str_replace('icon-', '', $match[1]);
                $iconList[] = str_replace('icon-', '', $match[1]);
            }

            $icons = new \stdClass();
            $icons->icons = $iconList;
            $icon_data = json_encode($icons);
            
            $file = GLOREYA_THEME_DIR . '/assets/js/iconfont.js';
            
                global $wp_filesystem;
                require_once ( ABSPATH . '/wp-admin/includes/file.php' );
                WP_Filesystem();
                if ( $wp_filesystem->exists( $file ) ) {
                    $content =  $wp_filesystem->put_contents( $file, $icon_data) ;
                } 
            
        }






    // registering ajax select 2 control
    public function GLOREYA_ajax_select2( $controls_manager ) {
        require_once GLOREYA_EDITOR_ELEMENTOR. '/controls/select2.php';
        $controls_manager->register_control( 'ajaxselect2', new \Control_Ajax_Select2() );
    }
    
    // registering image choose
    public function control_image_choose( $controls_manager ) {
        require_once GLOREYA_EDITOR_ELEMENTOR. '/controls/choose.php';
        $controls_manager->register_control( 'imagechoose', new \Control_Image_Choose() );
    }

    public function GLOREYA_shortcode_elements($widgets_manager){

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/event.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Event_Widget());
        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/owlslider.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_OwlSlider_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/feature.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Feature_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/foodblog.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Food_Update_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/title.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Title_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/chef.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_chef_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/chef-slider.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_chef_slider_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/testimonial.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Testimonial_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/food-menu.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_food_menu_Widget());
        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/food-list.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_food_list_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/reservation-table.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_reservation_table_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/food-vertical-block.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Post_Vertical_Grid_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/food-vertical-block2.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Post_Vertical_Grid2_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/vertical-grid-slider.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Vertical_Grid_Slider_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/vertical-feature-slider.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Vertical_Features_Slider_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/food-product-slider.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Product_slider_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/video-popup.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Video_Popup_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/masonary-gallery.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_masonary_gallery_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/back-to-top.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_BackToTop_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/sitelogo.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Site_Logo_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/food-menu-slider.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_food_menu_slider_Widget());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/menu-location-list.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Menu_Location_List());

        require_once GLOREYA_EDITOR_ELEMENTOR.'/widgets/food-menu-tab.php';
        $widgets_manager->register_widget_type(new Elementor\Gloreya_Food_Menu_Tab());
        
    
    }
    
	public static function GLOREYA_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new GLOREYA_Shortcode();
        }
        return self::$_instance;
    }

}
$GLOREYA_Shortcode = GLOREYA_Shortcode::GLOREYA_get_instance();

endif;