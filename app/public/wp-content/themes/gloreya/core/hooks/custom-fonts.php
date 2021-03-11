<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * hooks for adding custom fonts
 */

function gloreya_custom_fonts( $fonts ) {

	$gilroy			 = array(
		'family' => 'gilroylight'
	);
	$gilroyextrabold = array(
		'family' => 'gilroyextrabold'
	);
	array_push( $fonts, 'gilroylight', 'gilroyextrabold' );
	return $fonts;
}
add_filter( 'fw_option_type_typography_v2_standard_fonts', 'gloreya_custom_fonts' );
