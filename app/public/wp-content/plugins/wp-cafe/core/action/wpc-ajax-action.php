<?php
namespace WpCafe\Core\Action;

defined( 'ABSPATH' ) || exit;

use WpCafe\Utils\Wpc_Utilities as Utils;

Class Wpc_Ajax_Action {

    use \WpCafe\Traits\Wpc_Singleton;
    /**
     * Ajax function call
     */
    public function init() {
        // reservation
        add_action( 'wp_ajax_wpc_check_for_submission', [$this, 'wpc_check_for_submission'] );
        // for users who are not logged in
        add_action( 'wp_ajax_nopriv_wpc_check_for_submission', [$this, 'wpc_check_for_submission'] );

    }

    /**
     * Reservation form submit check
     */
    public function wpc_check_for_submission() {
        // Process a booking request
        $settings = \WpCafe\Core\Base\Wpc_Settings_Field::instance()->get_settings_option();
        
        $wpc_tag_arr = [
            '{site_name}',
            '{site_link}',
            '{user_name}',
            '{user_email}',
            '{phone}',
            '{message}',
            '{party}',
            '{date}',
            '{current_time}', ];

        if ( "wpc_reservation" == sanitize_text_field( $_POST['wpc_action'] ) ) {

            //check for valid nonce
            $post_arr = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

            //store our post vars into variables for later use
            //now would be a good time to run some basic error checking/validation
            //to ensure that data for these values have been set

            $meta_array                          = [];
            $meta_array['wpc_name']              = $title                 = isset( $post_arr['wpc_name'] ) ? sanitize_text_field( $post_arr['wpc_name'] ) : "";
            $meta_array['wpc_message']           = $content               = isset( $post_arr['wpc_message'] ) ? sanitize_text_field( $post_arr['wpc_message'] ) : "";
            $meta_array['wpc_email']             = $wpc_email             = (isset( $post_arr['wpc_email'] ) && is_email( $post_arr['wpc_email'] ) ) ? sanitize_email( $post_arr['wpc_email'] ) : "";
            $meta_array['wpc_phone']             = $wpc_phone             = isset( $post_arr['wpc_phone'] ) ? preg_replace( '/[^0-9+-]/', '', sanitize_text_field( $post_arr['wpc_phone'] ) ) : "";
            $meta_array['wpc_total_guest']       = $wpc_total_guest       = isset( $post_arr['wpc_guest_count'] ) ? intval( sanitize_text_field( $post_arr['wpc_guest_count'] ) ) : "";
            $meta_array['wpc_from_time']         = $wpc_from_time         = isset( $post_arr['wpc_from_time'] ) ? sanitize_text_field( $post_arr['wpc_from_time'] ) : "";
            $meta_array['wpc_to_time']           = $wpc_to_time           = isset( $post_arr['wpc_to_time'] ) ? sanitize_text_field( $post_arr['wpc_to_time'] ) : "";
            $meta_array['wpc_booking_date']      = $wpc_date              = isset( $post_arr['wpc_booking_date'] ) ? $post_arr['wpc_booking_date'] : "";
            $meta_array['wpc_branch']            = $wpc_branch            = isset( $post_arr['wpc_branch'] ) ? $post_arr['wpc_branch'] : "";
            $default_guest                       = isset( $settings['wpc_default_gest_no'] ) ? intval( $settings['wpc_default_gest_no'] ) : 0;
            $meta_array['wpc_reservation_state'] = $reservation_status = ( $wpc_total_guest <= $default_guest ) ? 'confirmed' : 'pending';

            $post_type                           = 'wpc_reservation';

            $post_slug = sanitize_title_with_dashes( $title, '', 'save' );
            $postslug  = sanitize_title( $post_slug );

            if ( isset( $title ) && isset( $wpc_email ) && isset( $wpc_total_guest ) &&
                isset( $wpc_from_time ) && isset( $wpc_to_time ) && isset( $wpc_date ) ||
                ( isset( $settings['wpc_require_phone'] ) && isset( $wpc_phone ) ) ||
                ( isset( $settings['require_branch'] ) && isset( $wpc_branch ) )
                ) {

                //the array of arguements to be inserted with wp_insert_post
                $new_post = [
                    'post_title'     => $title,
                    'post_content'   => $content,
                    'post_status'    => 'publish',
                    'post_type'      => $post_type,
                    'comment_status' => 'closed',
                    'post_name'      => $postslug,
                ];

                //insert the the post into database by passing $new_post to wp_insert_post
                //store our post ID in a variable $pid
                $pid                                   = wp_insert_post( $new_post );
                $invoice                               = Utils::generate_invoice_number( $pid );
                $meta_array['wpc_reservation_invoice'] = $invoice;

                //we now use $pid (post id) to help add out post meta data
                foreach ( $meta_array as $key => $value ) {
                    add_post_meta( $pid, $key, $value, true );
                }

                apply_filters( 'wpcafe/action/extra_field', $pid , $post_arr );

                /** use action for success message **/
                if ( $pid != 0 ) {
                    $wpc_value_arr = [
                        get_bloginfo( 'name' ),
                        get_option( 'home' ),
                        get_post_meta( $pid, 'wpc_name', true ),
                        get_post_meta( $pid, 'wpc_email', true ),
                        get_post_meta( $pid, 'wpc_phone', true ),
                        get_post_meta( $pid, 'wpc_message', true ),
                        get_post_meta( $pid, 'wpc_total_guest', true ),
                        get_post_meta( $pid, 'wpc_booking_date', true ) . " Start time : " .
                        get_post_meta( $pid, 'wpc_from_time', true ) . " End time : " .
                        get_post_meta( $pid, 'wpc_to_time', true ),
                        date( 'Y-m-d H:i:s' ),
                    ];
                    $message = ''; $form_type = ""; $booking_invoice="";
                    
                    if ( $reservation_status == 'confirmed' ) {
                        $message    = $settings['wpc_booking_confirmed_message'];
                        $form_type  = "wpc_reservation";
                        $booking_invoice = $invoice;
                    } elseif ( $reservation_status == 'pending' ) {
                        $message    = $settings['wpc_pending_message'];
                        $form_type  ="wpc_reservation";
                        $booking_invoice = $invoice;
                    } 

                    $response = [ 'status_code' => 200 , 'message' => [ $message ] ,'data' => ['form_type' => $form_type , 'invoice'=> $booking_invoice ] ];

                    /**
                     * email to admin & user for new booking request
                     */
                    $args = array(
                        'wpc_email'     => $wpc_email,
                        'invoice'       => $invoice,
                        'message'       => $message,
                        'wpc_tag_arr'   => $wpc_tag_arr,
                        'wpc_value_arr' => $wpc_value_arr,
                    );
                    
                    Utils::send_notification_admin_user( $settings , $args );
                    
                    wp_send_json_success( $response );
                } else {
                    $response = [ 'status_code' => 400 , 'message' => [ esc_html__('Booking placement was failed, please try again!' ,'wpcafe' ) ] , 'data' => ['form_type' => 'wpc_reservation_field_missing'] ];
                    wp_send_json_error( $response );
                }
            } else {
                $response = [ 'status_code' => 400 , 'message' => [ esc_html__('Please enter all required fields!' ,'wpcafe' )  ] , 'data' => ['form_type' => 'wpc_reservation_field_missing'] ];
                wp_send_json_error( $response );
            }
        }

        if ( isset( $_POST['wpc_action'] ) && "wpc_cancellation" == sanitize_text_field( $_POST['wpc_action'] ) ) {

            $post_arr   = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
            $invoice_no = isset( $post_arr['wpc_reservation_invoice'] ) ?
            sanitize_text_field( $post_arr['wpc_reservation_invoice'] ) : "";
            $wpc_email = ( isset( $post_arr['wpc_cancell_email'] ) && is_email( $post_arr['wpc_cancell_email'] ) ) ?
            sanitize_email( $post_arr['wpc_cancell_email'] ) : "";
            $wpc_phone = isset( $post_arr['wpc_cancell_phone'] ) ?
            preg_replace( '/[^0-9+-]/', '', sanitize_text_field( $post_arr['wpc_cancell_phone'] ) ) : "";
            $content = sanitize_text_field( $post_arr['wpc_message'] );

            //check if all required fields are given
            //else show a message
            if ( $invoice_no && $wpc_email ) {
                $args = array(
                    'post_type'      => 'wpc_reservation',
                    'posts_per_page' => '1',
                    'meta_query'     => array(
                        array(
                            'key'   => 'wpc_reservation_invoice',
                            'value' => $invoice_no,
                        ),
                        array(
                            'key'   => 'wpc_email',
                            'value' => $wpc_email,
                        )
                    ),
                );
                $reservations = get_posts( $args );

                //check if reservation record found with the given details
                if ( !$reservations || is_wp_error( $reservations ) ) {
                    $response = [ 'status_code' => 401 , 'message' => [ esc_html__( 'No reservation found with the given details' , 'wpcafe' ) ] , 'data' => ['form_type' => 'wpc_reservation_cancell'] ];
                } else {
                    $reservation_id = $reservations[0]->ID;
                    update_post_meta( $reservation_id, 'wpc_reservation_state', 'cancelled' );
                    apply_filters( 'wpcafe/action/cancell_notification', $settings, $invoice_no , $wpc_tag_arr );
                    $response = [ 'status_code' => 200 , 'message' => [ esc_html__( 'Cancellation requested successfully!', 'wpcafe' ) ] , 'data' => ['form_type' => 'wpc_reservation_cancell'] ];
                }
                wp_send_json_success( $response );
            } else {
                $response = [ 'status_code' => 400 , 'message' => [ esc_html__(  'Please enter required fields correctly!', 'wpcafe' )  ] , 'data' => ['form_type' => 'wpc_reservation_cancell'] ];
                wp_send_json_error( $response );
            }
        }

        exit;
    }
}
