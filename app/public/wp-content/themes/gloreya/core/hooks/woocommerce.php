<?php 

add_filter('add_to_cart_fragments', 'gloreya_woocommerce_header_add_to_cart_fragment');

function gloreya_woocommerce_header_add_to_cart_fragment( $fragments ) 
{
  
      ob_start(); ?>
      <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'gloreya'); ?>">
      <span class="icon icon-tscart"></span>
      <sup><?php echo sprintf(_n('%d item', '%d', WC()->cart->cart_contents_count, 'gloreya'), WC()->cart->cart_contents_count);?></sup>
                           
      </a>

    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}