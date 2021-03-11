<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * options for wp customizer
 * section name format: gloreya_section_{section name}
 */
$options = [
	'gloreya_section_theme_settings' => [
		'title'				 => esc_html__( 'Theme settings', 'gloreya' ),
		'options'			 => Gloreya_Theme_Includes::_customizer_options(),
		'wp-customizer-args' => [
			'priority' => 3,
		],
	],
];
