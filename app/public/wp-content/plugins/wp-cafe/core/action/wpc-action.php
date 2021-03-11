<?php
namespace WpCafe\Core\Action;

defined( 'ABSPATH' ) || exit;

class Wpc_Action {
    use \WpCafe\Traits\Wpc_Singleton;

    private $key_option_settings;
    private $form_id;
    private $form_setting;
    public $response = [];

    /**
     * Return response
     */
    function __construct() {
        $this->key_option_settings = 'wpcafe_reservation_settings_options';
        $this->response            = [
            'saved'  => false,
            'status' => esc_html__( "Something went wrong.", 'wpcafe' ),
            'data'   => [],
        ];
    }

    /**
     * Update settings
     */
    public function wpc_store( $form_id, $form_setting ) {
        if ( !current_user_can( 'manage_options' ) ) {
            return;
        }

        $this->wpc_sanitize( $form_setting );
        $this->form_id = $form_id;

        if ( $this->form_id == -1 ) {
            $this->wpc_update_option_settings();
        }

        return;
    }

    /**
     * Sanitize field
     */
    public function wpc_sanitize( $form_setting ) {
        foreach ( $form_setting as $key => $value ) {
            $this->form_setting[$key] = $value;
        }

    }

    /**
     * Update field
     */
    public function wpc_update_option_settings() {   
       $response = update_option( $this->key_option_settings, $this->form_setting );

        $tab_name = $this->form_setting['settings_tab'];
        $redirect = 'admin.php?page=cafe_menu&saved='.$response.'';

       return wp_redirect(set_query_var( 'settings-tab' , $tab_name, $redirect));
    }

}
