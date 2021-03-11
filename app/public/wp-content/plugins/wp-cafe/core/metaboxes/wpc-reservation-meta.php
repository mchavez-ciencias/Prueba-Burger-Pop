<?php
namespace WpCafe\Core\Metaboxes;

use WpCafe\Core\Base\Wpc_Metabox;
use WpCafe\Utils\Wpc_Utilities;

defined( 'ABSPATH' ) || exit;

class Wpc_Reservation_Meta extends Wpc_Metabox {

    public $metabox_id         = 'wpc_reservation_meta';
    public $reservation_fields = [];
    public $cpt_id             = 'wpc_reservation';

    /**
     * Register meta box
     *
     * @return void
     */
    public function register_meta_boxes() {
        add_meta_box(
            $this->metabox_id,
            esc_html__( 'Reservation Info', 'wpcafe' ),
            [$this, 'display_callback'],
            $this->cpt_id
        );
    }

    /**
     * Pass metabox array
     */
    public function wpc_default_metabox_fields() {
        $settings = \WpCafe\Core\Base\Wpc_Settings_Field::instance()->get_settings_option();

        $wpc_late_bookings   = isset($settings['wpc_late_bookings']) && $settings['wpc_late_bookings'] !== "1"  ? $settings['wpc_late_bookings'] : "";
        $late_one   = esc_html__("Our last booking time is","wpcafe" );
        $late_two   = " {last_time}.";
        $late_three =  esc_html__(" You can boook before","wpcafe");
        $late_four  = " {last_min}";
        $late_five  =  esc_html__(" minutes of closing time.","wpcafe" );

        ?>
            <div class='late_booking' data-late_booking="<?php echo esc_html($late_one.$late_two.$late_three.$late_four.$late_five);?>"></div>
            <div class='wpc_cancell_log_message'></div>
            <div class='wpc_error_message' data-time_compare="<?php echo esc_html__('Booking end time must be after start time','wpcafe')?>"></div>
            <div class='wpc_success_message' data-start="<?php echo esc_html__("Start time","wpcafe");?>" data-end="<?php echo esc_html__("End time","wpcafe");?>" data-schedule="<?php echo esc_html__("Schedule","wpcafe");?>" data-late_booking = "<?php echo ( $wpc_late_bookings !=="" ) ? esc_html__("You can booked before ".$wpc_late_bookings."min of closing time.","wpcafe") : "" ?>"></div>
            <div class='date_missing' data-date_missing="<?php echo esc_html__("Please select a date first","wpcafe");?>"></div>
        <?php

        $this->reservation_fields = [
            'wpc_name'              => [
                'label'    => esc_html__( 'Name', 'wpcafe' ),
                'type'     => 'text',
                'default'  => '',
                'value'    => '',
                'desc'     => esc_html__( 'Name of customer', 'wpcafe' ),
                'priority' => 1,
                'attr'     => ['class' => 'wpc-label-item'],
                'required' => true,
            ],
            'wpc_email'             => [
                'label'    => esc_html__( 'Email', 'wpcafe' ),
                'type'     => 'email',
                'default'  => '',
                'value'    => '',
                'desc'     => esc_html__( 'Email of customer', 'wpcafe' ),
                'priority' => 1,
                'attr'     => ['class' => 'wpc-label-item'],
                'required' => true,
            ],
            'wpc_phone'             => [
                'label'    => esc_html__( 'Phone', 'wpcafe' ),
                'type'     => 'tel',
                'default'  => '',
                'value'    => '',
                'desc'     => esc_html__( 'Phone of customer', 'wpcafe' ),
                'priority' => 1,
                'attr'     => ['class' => 'wpc-label-item'],
                'required' => true,
            ],
            'wpc_message'           => [
                'label'    => esc_html__( 'Message', 'wpcafe' ),
                'type'     => 'textarea',
                'default'  => '',
                'value'    => '',
                'desc'     => esc_html__( 'Add a note', 'wpcafe' ),
                'priority' => 1,
                'attr'     => ['class' => 'wpc-label-item'],
                'required' => true,
            ],
            'wpc_booking_date'      => [
                'label'     => esc_html__( 'Date', 'wpcafe' ),
                'type'      => 'text',
                'inline'    => false,
                'timestamp' => false,
                'priority'  => 1,
                'desc'      => esc_html__( 'Date of reservation', 'wpcafe' ),
                'attr'      => ['class' => 'wpc-label-item wpc-booking-date'],
                'required'  => true,
            ],
            'wpc_from_time'         => [
                'label'    => esc_html__( 'From', 'wpcafe' ),
                'type'     => 'text',
                'default'  => '',
                'value'    => '',
                'desc'     => esc_html__( 'Reservation start time', 'wpcafe' ),
                'priority' => 1,
                'attr'     => ['class' => 'wpc-label-item wpc_from_time'],
                'required' => true,
            ],
            'wpc_to_time'           => [
                'label'    => esc_html__( 'To', 'wpcafe' ),
                'type'     => 'text',
                'default'  => '',
                'value'    => '',
                'desc'     => esc_html__( 'Reservation end time', 'wpcafe' ),
                'priority' => 1,
                'attr'     => ['class' => 'wpc-label-item wpc_to_time'],
                'required' => true,
            ],
            'wpc_total_guest'       => [
                'label'    => esc_html__( 'No of Guests', 'wpcafe' ),
                'type'     => 'select_single',
                'options'  => Wpc_Utilities::get_seat_count_limit(),
                'priority' => 1,
                'required' => true,
                'desc'     => esc_html__( 'No of total guests', 'wpcafe' ),
                'attr'     => ['class' => 'wpc-label-item'],
            ],
            'wpc_reservation_state' => [
                'label'    => esc_html__( 'Status', 'wpcafe' ),
                'type'     => 'select_single',
                'options'  => Wpc_Utilities::get_reservation_states(),
                'priority' => 1,
                'required' => true,
                'desc'     => esc_html__( 'Reservation status', 'wpcafe' ),
                'attr'     => ['class' => 'wpc-label-item'],
            ],
        ];

        if( isset( $settings['show_branches'] ) && $settings['show_branches'] !=="" ){
                $branch = ['wpc_branch' => [
                'label'    => esc_html__( "Which branch of our restaurant", "wpcafe" ),
                'type'     => 'select_single',
                'options'  => Wpc_Utilities::get_location_data( "Select a branch","No branch is set","value" ),
                'priority' => 1,
                'required' => true,
                'desc'     => esc_html__( "Show food location / branch in reservation form", "wpcafe" ),
                'attr'     => ['class' => 'wpc-label-item'],
            ] ] ;
            
            // Add branch field in backend reservation form
            $final_array = array_merge( $branch, $this->reservation_fields );
        }else{
            $final_array = $this->reservation_fields;
        }

        $all_reserve_fields = apply_filters('wpcafe/meta/extra_field_label', $final_array );

        return $all_reserve_fields;
    }

    /**
     * Save metabox title
     *
     */
    public function wpc_set_reservation_title( $data, $postarr ) {
        if ( is_admin() && 'wpc_reservation' == $data['post_type'] && isset($postarr['wpc_email']) && $postarr['wpc_email'] !=='' ) {
            /**
             * update reservation title from reservation meta
             */
            if ( isset( $postarr['wpc_name'] ) ) {
                $reservation_title = sanitize_text_field( $postarr['wpc_name'] );
            } else {
                $reservation_title = get_post_meta( $postarr['ID'], 'wpc_name', true );
            }

            if ( isset( $postarr['wpc_email'] ) ) {
                $wpc_email = sanitize_email( $postarr['wpc_email'] );
            }

            $reservation_state = isset( $postarr['wpc_reservation_state'] ) ?
            sanitize_text_field( $postarr['wpc_reservation_state'] ) : 'Pending';

            $post_slug          = sanitize_title_with_dashes( $reservation_title, '', 'save' );
            $reservation_slug   = sanitize_title( $post_slug );
            $data['post_title'] = $reservation_title;
            $data['post_name']  = $reservation_slug;

            /**
             * insert invoice but dont update
             */
            $saved_reservation_invoice = get_post_meta( $postarr['ID'], 'wpc_reservation_invoice', true );
            $invoice_no                = '';

            if ( $saved_reservation_invoice ) {
                $postarr['wpc_reservation_invoice'] = $saved_reservation_invoice;
                $invoice_no                         = $saved_reservation_invoice;
            } else {
                $postarr['wpc_reservation_invoice'] = Wpc_Utilities::generate_invoice_number( $postarr['ID'] );
                update_post_meta( $postarr['ID'], 'wpc_reservation_invoice', $postarr['wpc_reservation_invoice'] );
                $invoice_no = $postarr['wpc_reservation_invoice'];
            }

            /**
             * send required notification to both user and admin
             * as per the reservation notification settings
             */
            $settings = \WpCafe\Core\Base\Wpc_Settings_Field::instance()->get_settings_option();

            // get dynamic tag for mail template
            $wpc_tag_arr = [
                '{site_name}',
                '{site_link}',
                '{user_name}',
                '{user_email}',
                '{phone}',
                '{message}',
                '{party}',
                '{date}',
                '{current_time}',
            ];
            $wpc_value_arr = [
                get_bloginfo( 'name' ),
                get_option( 'home' ),
                get_post_meta( $postarr['ID'], 'wpc_name', true ),
                get_post_meta( $postarr['ID'], 'wpc_email', true ),
                get_post_meta( $postarr['ID'], 'wpc_phone', true ),
                get_post_meta( $postarr['ID'], 'wpc_message', true ),
                get_post_meta( $postarr['ID'], 'wpc_total_guest', true ),
                get_post_meta( $postarr['ID'], 'wpc_booking_date', true ) . " Start time : " .
                get_post_meta( $postarr['ID'], 'wpc_from_time', true ) . " End time : " .
                get_post_meta( $postarr['ID'], 'wpc_to_time', true ),
                date( 'Y-m-d H:i:s' ),
            ];
            if ( isset( $reservation_state )  ) {
                
                $wpc_template = [$wpc_tag_arr, $wpc_value_arr, $invoice_no ];
                /**
                 * email to admin & user for new booking request
                 */

                switch ( $reservation_state ) {
                    case ( ($reservation_state == 'cancelled' || $reservation_state == 'confirmed') && $saved_reservation_invoice !="" ):
                        apply_filters( 'wpcafe/metabox/notification', $settings, $reservation_state, $wpc_template );
                        break;
                    case ( $reservation_state == 'confirmed' || $reservation_state == 'pending' && $saved_reservation_invoice =="" ):
                        $message = '';
                        if ( $reservation_state == 'confirmed' ) {
                            $message = $settings['wpc_booking_confirmed_message'];
                        } elseif ( $reservation_state == 'pending' ) {
                            $message = $settings['wpc_pending_message'];
                        }
                        $args = array(
                            'wpc_email'     => $wpc_email,
                            'invoice'       => $invoice_no,
                            'message'       => $message,
                            'wpc_tag_arr'   => $wpc_tag_arr,
                            'wpc_value_arr' => $wpc_value_arr,
                        );
                        Wpc_Utilities::send_notification_admin_user( $settings , $args );

                        break;
                    default:
                        break;
                }
            }
        }
        return $data;
    }

}
