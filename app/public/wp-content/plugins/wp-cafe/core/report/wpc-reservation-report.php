<?php

namespace WpCafe\Core\Report;

use WpCafe\Utils\Wpc_Utilities;

defined( 'ABSPATH' ) || exit;

class Wpc_Reservation_Report {
    use \WpCafe\Traits\Wpc_Singleton;

    /**
     * Class constructor.
     */
    public function init() {
        add_filter( "manage_wpc_reservation_posts_columns",
            [$this, "wpc_reservation_post_columns"] );

        add_action( "manage_wpc_reservation_posts_custom_column",
            [$this, 'wpc_reservation_custom_column'], 10, 2 );
        // remove bulk action edit
        add_filter( 'bulk_actions-edit-wpc_reservation', [$this,'custom_bulk_actions'] );
        // reservation report order by desc
        add_action( 'pre_get_posts', [$this,'reservation_report_desc_order'] );
    }

    /**
     * Reservation report order by desc
     */
    public function reservation_report_desc_order( $wp_query ) {
        if (is_admin()) {
          // Get the post type from the query
          $post_type = $wp_query->query['post_type'];
          if ( $post_type == 'wpc_reservation') {
      
            $wp_query->set('orderby', 'date');
      
            $wp_query->set('order', 'DESC');
            
          }
        }
    }

    /**
     * Remove edit bulk action
     */
    public function custom_bulk_actions( $actions ){
        unset( $actions[ 'edit' ] );

        return $actions;
    }

    /**
     * Column name
     */
    public function wpc_reservation_post_columns( $columns ) {
        unset( $columns['date'] );
        unset( $columns['title'] );
        $columns['id']                      =   esc_html__(  'Id', 'wpcafe' );
        $settings = \WpCafe\Core\Base\Wpc_Settings_Field::instance()->get_settings_option();
        if( isset($settings['show_branches']) && $settings['show_branches'] !==""){
            $columns['wpc_branch']              =   esc_html__(  'Branch', 'wpcafe' );
        }
        $columns['wpc_name']                =   esc_html__(  'Name', 'wpcafe' );
        $columns['wpc_email']               =   esc_html__(  'Email', 'wpcafe' );
        $columns['wpc_phone']               =   esc_html__(  'Phone', 'wpcafe' );
        $columns['wpc_guest_count']         =   esc_html__(  'Seat(s)', 'wpcafe' );
        $columns['wpc_booking_date']        =   esc_html__(  'Date', 'wpcafe' );
        $columns['wpc_reservation_state']   =   esc_html__(  'Status', 'wpcafe' );
        $columns['wpc_reservation_invoice'] =   esc_html__(  'Invoice', 'wpcafe' );
        return $columns;
    }

    /**
     * Return row
     */
    public function wpc_reservation_custom_column( $column, $post_id ) {
        switch ( $column ) {
        case 'id':
            echo intval( $post_id );
            break;
        case 'wpc_branch':
            echo Wpc_Utilities::wpc_render( get_post_meta( $post_id, 'wpc_branch', true ) );
            break;
        case 'wpc_name':
            echo Wpc_Utilities::wpc_render( get_post_meta( $post_id, 'wpc_name', true ) ) ;
            break;
        case 'wpc_guest_count':
            echo Wpc_Utilities::wpc_render( get_post_meta( $post_id, 'wpc_total_guest', true ) );
            break;
        case 'wpc_reservation_state':
            echo Wpc_Utilities::wpc_render( get_post_meta( $post_id, 'wpc_reservation_state', true ) );
            break;
        case 'wpc_phone':
            echo Wpc_Utilities::wpc_render( get_post_meta( $post_id, 'wpc_phone', true ) );
            break;
        case 'wpc_email':
            echo Wpc_Utilities::wpc_render( get_post_meta( $post_id, 'wpc_email', true ) );
            break;
        case 'wpc_booking_date':
            echo Wpc_Utilities::wpc_render( get_post_meta( $post_id, 'wpc_booking_date', true ) . "<br>" . get_post_meta( $post_id, 'wpc_from_time', true ) . "-" . get_post_meta( $post_id, 'wpc_to_time', true ) );
            break;
        case 'wpc_reservation_invoice':
            echo Wpc_Utilities::wpc_render( get_post_meta( $post_id, 'wpc_reservation_invoice', true ) );
            break;
        }
    }
}
