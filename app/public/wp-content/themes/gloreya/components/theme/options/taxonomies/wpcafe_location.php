<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * metabox options for taxonomy
 */
$options = array(
    'gloryea_location_image'	 => array(
        'label'	 => esc_html__( ' Location image', 'gloreya' ),
        'desc'	 => esc_html__( 'Upload a Location image', 'gloreya' ),
        'help'	 => esc_html__( "This default Loca image will be used for all your service.", 'gloreya' ),
        'type'  => 'upload',

    ),
);