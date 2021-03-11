<?php
namespace WpCafe\Core\Menu;

defined( 'ABSPATH' ) || exit;

/**
 * Menu handle class
 */
class Wpc_Menus {
    use \WpCafe\Traits\Wpc_Singleton;
    public $settings;
    private $pages;
    private $sub_pages;

    /**
     * Call all action
     */
    public function init() {
        $this->settings   = new \WpCafe\Core\Base\Wpc_Menu_Build();
        // create cafe  menu
        $this->pages = array(
            array(
                "page_title"  => esc_html__( 'Settings', 'wpcafe' ),
                "menu_title"  => esc_html__( 'WpCafe', 'wpcafe' ),
                "capability"  => 'manage_options',
                "menu_slug"   => 'cafe_menu',
                "cb_function" => [$this, 'wpc_reservation_settings'],
                "icon"        => '',
                'position'    => 9,
            )
        );

        // create cafe sub menu
        $this->sub_pages = array(
            array(
                "parent_slug" => 'cafe_menu',
                "page_title"  =>esc_html__( 'Add new bookings', 'wpcafe' ),
                "menu_title"  =>esc_html__( 'Reservations', 'wpcafe' ),
                "capability"  => 'manage_options',
                "menu_slug"   => 'edit.php?post_type=wpc_reservation',
                "cb_function" => [$this, 'wpc_reservation_submenu'],
                'position'    => 1,
            )
        );
    }

    /**
     * Add menu and submenu
     */
    public function wpc_menu_register() {
        // create cafe menu
        $this->settings->wpc_add_pages( $this->pages )->wpc_sub_menu_pages( esc_html__( 'Settings', 'wpcafe' ) )->wpc_add_sub_pages( $this->sub_pages )->wpc_register();
    }

    /**
     * Add menu page
     */
    public function wpc_admin_menu_page() {
        return "";
    }
    
    /**
     * Show bookings
     */
    public function wpc_reservation_settings() {
        \WpCafe\Core\Settings\Wpc_Key_Options::instance()->wpc_key_options();
    }
}
