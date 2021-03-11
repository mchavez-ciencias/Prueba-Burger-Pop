<?php if (!defined('ABSPATH')) die('Direct access forbidden.');

$manifest = array();

$manifest[ 'name' ]			 = esc_html__( 'Gloreya', 'gloreya' );
$manifest[ 'uri' ]			 = esc_url( 'https://themeforest.net/user/tripples' );
$manifest[ 'description' ]	 = esc_html__( 'Restaurant WordPress Theme', 'gloreya' );
$manifest[ 'version' ]		 = '1.0';
$manifest[ 'author' ]			 = 'Tripples';
$manifest[ 'author_uri' ]		 = esc_url( 'https://themeforest.net/user/tripples' );
$manifest[ 'requirements' ]	 = array(
	'wordpress' => array(
		'min_version' => GLOREYA_MINWP_VERSION,
	),
);

$manifest[ 'id' ] = 'scratch';

$manifest[ 'supported_extensions' ] = array(
	'backups'		 => array(),
);


?>
