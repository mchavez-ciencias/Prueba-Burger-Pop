<?php
/**
 * The header template for the theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>> 

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

	<?php 
         
		$gloreya_header_style             = gloreya_option('header_layout_style', 'standard');
		$gloreya_page_override_header     = gloreya_meta_option(get_the_ID(),'page_header_override');
		$gloreya_page_header_layout_style = gloreya_meta_option(get_the_ID(),'page_header_layout_style','standard');

		if($gloreya_page_override_header=='yes'):
			$gloreya_header_style = $gloreya_page_header_layout_style;
			endif;  
		

		get_template_part( 'template-parts/headers/header', $gloreya_header_style );
    ?>
    
