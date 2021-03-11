

	<?php
	wp_nav_menu([
		'menu'            => 'primary',
		'theme_location'  => 'primary',
		'container'       => 'div',
		'container_id'    => 'primary-nav',
		'container_class' => 'collapse navbar-collapse',
		'menu_id'         => 'main-menu',
		'menu_class'      => 'navbar-nav  main-menu',
		'depth'           => 3,
		'walker'          => new gloreya_navwalker(),
		'fallback_cb'     => 'gloreya_navwalker::fallback',
	]);
	?>


