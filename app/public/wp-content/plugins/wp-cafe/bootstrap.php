<?php
namespace WpCafe;

defined( 'ABSPATH' ) || exit;

use WpCafe\Autoloader;
use WpCafe\Utils\Wpc_Utilities;

/**
 * Autoload all classes
 */
require_once plugin_dir_path( __FILE__ ) . '/autoloader.php';

final class Bootstrap{
    
    const version = '1.3.1';
    private static $instance;
    private $has_pro;

    /**
     * Register action
     */
    private function __construct() {
        // load autoload method
        Autoloader::run();
    }

    public function init(){

        define( 'WPC_VERSION', self::version );
        $this->has_pro = defined('WPC_PRO_FILES_LOADED');
        
        // activation and deactivation hook
        register_activation_hook( __FILE__, [$this, 'wpc_active'] );
        register_deactivation_hook( __FILE__, [$this, 'wpc_deactive'] );

        //handle buy-pro notice
        $this->handle_buy_pro_menu();

        //enqueue file
        \WpCafe\Core\Enqueue\Wpc_Enqueue::instance()->init();

        // fire in every plugin load action
        $this->wpc_init_plugin();  
        
    }

    /**
     * do stuff on active
     *
     * @return void
     */
    public function wpc_active() {
        $installed = get_option( 'wpc_cafe_installed' );

        if ( !$installed ) {
            update_option( 'wpc_cafe_installed', time() );
        }

        update_option( 'wpc_cafe_version', WPC_VERSION );
    }

    /**
     * do stuff on deactive
     *
     * @return void
     */
    public function wpc_deactive() {
        flush_rewrite_rules();
    }

    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Load all class
     *
     * @return void
     */
    public function wpc_init_plugin() {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            add_action( 'admin_notices', [$this, 'wpc_admin_notice_woocommerce_not_active'] );
        }

        // call ajax submit
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            \WpCafe\Core\Action\Wpc_Ajax_Action::instance()->init();
        }
        
        // load text domain 
        load_plugin_textdomain( 'wpcafe', false, WPC_DIR . '/languages/' );

        //make admin menu open if any custom post type is selected
        add_action( 'parent_file', [$this, 'wpc_keep_cpt_menu_open'] );

        //register all custom post type
        \WpCafe\Core\Post_type\Cpt::instance()->init();

        // register elementor
        \WpCafe\Widgets\Manifest::instance()->init();

        // resgiter widgets and shortcode
        $this->register_shortcodes();

        // register gutenberg blocks
        if( file_exists( WPC_DIR . '/core/guten-block/inc/init.php' )){
            include_once WPC_DIR . '/core/guten-block/inc/init.php';
        } 

        if ( is_admin() ){
            \WpCafe\Core\Core::instance()->init();
        }
        
        //fire-up all woocommerce related hooks
        if( file_exists( WPC_DIR . '/core/woocommerce/hooks.php' )){
            include_once WPC_DIR . '/core/woocommerce/hooks.php';
        }
    }

    /**
     * Load on plugin
     *
     * @return void
     */
    public function wpc_admin_notice_woocommerce_not_active() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        if ( file_exists( WP_PLUGIN_DIR . '/woocommerce/woocommerce.php' ) ) {
            $btn['label'] = esc_html__( 'Activate WooCommerce', 'wpcafe' );
            $btn['url']   = wp_nonce_url( 'plugins.php?action=activate&plugin=woocommerce/woocommerce.php&plugin_status=all&paged=1', 'activate-plugin_woocommerce/woocommerce.php' );
        } else {
            $btn['label'] = esc_html__( 'Install WooCommerce', 'wpcafe' );
            $btn['url']   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' );
        }

        Wpc_Utilities::push(
            [
                'id'          => 'unsupported-woocommerce-version',
                'type'        => 'error',
                'dismissible' => true,
                'btn'         => $btn,
                'message'     => sprintf( esc_html__( 'WpCafe requires WooCommerce , which is currently NOT RUNNING.', 'wpcafe' ) ),
            ]
        );
    }

    

    public function admin_notice_wpcafe_pro_not_active() {
        $btn['label'] = esc_html__( 'Buy Pro', 'wpcafe' );
        $btn['url']   = 'https://themewinter.com/wp-cafe/';

        Wpc_Utilities::push(
            [
                'id'          => 'wpcafe-pro-notice',
                'type'        => 'error',
                'dismissible' => true,
                'btn'         => $btn,
                'message'     => sprintf( esc_html__( 'Unlock more features with the pro version', 'wpcafe' ) ),
            ]
        );
    }

    /**
     * Register shortcode function
     *
     * @return void
     */
    public function register_shortcodes() {
        \WpCafe\Core\Shortcodes\Hook::instance()->init();
    }

    /**
     * Keep open menu function
     *
     */
    public function wpc_keep_cpt_menu_open( $parent_file ) {
        global $current_screen;
        $post_type = $current_screen->post_type;

        if ( $post_type == 'wpc_reservation' ) {
            wp_enqueue_script( 'wpc-active-custom-post-type', WPC_ASSETS . 'js/wpc-admin-menu.js', ['jquery'], self::version, false );
            $parent_file = 'cafe_menu';
        }

        return $parent_file;
    }

    

    /**
     * Show buy-pro menu if pro plugin not active
     *
     * @return void
     */
    public function handle_buy_pro_menu(){
        if ( !$this->has_pro ) { 

            /**
            * Show WPMET banner (codename: jhanda)
            */
            \Wpmet\Libs\Banner::instance('wp-cafe')
            // ->is_test(true)
            ->set_api_url('https://api.wpmet.com/public/jhanda')
            ->set_plugin_screens('toplevel_page_cafe_menu')
            ->set_plugin_screens('edit-wpc_reservation')
            ->call();
        }


        {
            /**
             * Show go Premium menu
             */
            \Wpmet\Libs\Pro_Awareness::instance('wpcafe')
            ->set_parent_menu_slug('cafe_menu')
            ->set_plugin_file('wp-cafe/wpcafe.php')
            ->set_pro_link( $this->has_pro ? "" : 'https://themewinter.com/wp-cafe/' )
            ->set_default_grid_thumbnail( WPC_PATH . '/utils/pro-awareness/assets/support.png' )
            ->set_default_grid_link('http://support.themewinter.com/support-center/login')
            ->set_page_grid([
                'url' => 'https://www.facebook.com/groups/1319571704894531',
                'title' => 'Join the Community',
                'thumbnail' => WPC_PATH . '/utils/pro-awareness/assets/community.png'
            ])
            ->set_page_grid([
                'url' => 'https://www.youtube.com/channel/UCfdo_ujAqztsz4QnjkrrPlw',
                'title' => 'Video Tutorials',
                'thumbnail' => WPC_PATH . '/utils/pro-awareness/assets/video_tutorial.png'
            ])
            ->set_page_grid([
                'url' => 'https://themewinter.com/wpcafe-roadmaps/#ideas',
                'title' => 'Feature Request',
                'thumbnail' => WPC_PATH . '/utils/pro-awareness/assets/feature_request.png'
            ])
            ->set_page_grid([
                'url' => 'https://support.themewinter.com/docs/plugins/docs-category/wp-cafe/',
                'title' => 'Documentation',
                'thumbnail' => WPC_PATH . '/utils/pro-awareness/assets/documentation.png'
            ])
            ->set_plugin_row_meta('Documentation','https://support.themewinter.com/docs/plugins/docs-category/wp-cafe/', ['target'=>'_blank'])
            ->set_plugin_row_meta('Facebook Community','https://www.facebook.com/groups/wpmet', ['target'=>'_blank'])
            ->set_plugin_action_link('Settings', admin_url() . 'admin.php?page=cafe_menu')
            ->set_plugin_action_link( ( $this->has_pro ? '' : 'Go Premium'),'https://themewinter.com/wp-cafe/', ['target'=>'_blank', 'style' => 'color: #FCB214; font-weight: bold;'])
            ->call();
        }
    }

}