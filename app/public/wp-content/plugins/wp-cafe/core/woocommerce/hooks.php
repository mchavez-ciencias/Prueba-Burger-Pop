<?php
defined( 'ABSPATH' ) || exit;

add_action( 'woocommerce_thankyou', 'wpc_checkout_callback', 10, 1 );

/**
 * aftersuccessfull checkout, some data are returned from woocommerce
 * we can use these data to update our own data storage / tables
 */
function wpc_checkout_callback( $order_id ) {

    if ( !$order_id ) {
        return;
    }
    global $wpdb;
    $order = wc_get_order( $order_id );
    
    do_action("wpcafe/after_thankyou");

}
