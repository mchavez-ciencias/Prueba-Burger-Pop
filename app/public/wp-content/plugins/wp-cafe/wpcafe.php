<?php

/**
 *  @package wpcafe
 */

/**
 * Plugin Name:        WP Cafe
 * Plugin URI:         https://product.themewinter.com/wpcafe
 * Description:        WordPress Restaurant solution plugin to launch Restaurant Websites.
 * Version:            1.3.1
 * Author:             Themewinter
 * Author URI:         http://themewinter.com/
 * License:            GPL-2.0+
 * License URI:        http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:        wpcafe
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || exit;

define( 'WPC_FILE', __FILE__ );
define( 'WPC_BASENAME', plugin_basename( WPC_FILE ) );

require_once plugin_dir_path( __FILE__ ) . '/bootstrap.php';

//block for showing banner
{
    require_once plugin_dir_path( __FILE__ ) . '/utils/notice/notice.php';
    require_once plugin_dir_path( __FILE__ ) . '/utils/banner/banner.php';
    require_once plugin_dir_path( __FILE__ ) . '/utils/pro-awareness/pro-awareness.php';

    // init notice class
    \Oxaim\Libs\Notice::init();

    // init pro menu class
    \Wpmet\Libs\Pro_Awareness::init();
}

{
    define( 'WPC_PATH', plugin_dir_url( __FILE__ ) );
    define( 'WPC_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
    define( 'WPC_CORE', WPC_DIR .'/core/');
    define( 'WPC_ASSETS', WPC_PATH . 'assets/' );
}


// load plugin
add_action( 'plugins_loaded', function () {

    do_action( 'wpcafe/before_load' );

    // action plugin instance class
    \WpCafe\Bootstrap::instance()->init();

    do_action( 'wpcafe/after_load' );

}, 999 );
