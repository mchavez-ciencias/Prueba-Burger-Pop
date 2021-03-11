

	<?php
	wp_nav_menu([
		'menu'            => 'footer',
		'theme_location'  => 'footermenu',
		'container'       => 'div',
		'container_id'    => 'footer-nav',
		'menu_id'         => 'footer-menu',
		'menu_class'      => 'footer-menu',
		'depth'           => 1,
		'walker'          => new gloreya_navwalker(),
		'fallback_cb'     => '',
	]);
	?>


