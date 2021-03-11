<?php
namespace WpCafe\Core;

defined( "ABSPATH" ) || exit;

/**
 * Load all admin class
 */
class Core {
    
    use \WpCafe\Traits\Wpc_Singleton;

    /**
     *  Call admin function
     */
    function init() {

        //register all menu
        \WpCafe\Core\Menu\Wpc_Menus::instance()->init();
        \WpCafe\Core\Menu\Wpc_Menus::instance()->wpc_menu_register();
        
        // Settings field for bookings
        $setting_field = \WpCafe\Core\Base\Wpc_Settings_Field::instance();
        // Register report
        $this->register_all_reports();
        $this->dispatch_actions( $setting_field );
    }

    /**
     * Register report
     */
    public function register_all_reports() {
        //register reservation report dashboard
        \WpCafe\Core\Report\Wpc_Reservation_Report::instance()->init();
    }

    /**
     * Save settings
     */
    public function dispatch_actions( $setting_field ) {
        add_action( 'admin_init', [$setting_field, 'form_handler'] );
    }

}
