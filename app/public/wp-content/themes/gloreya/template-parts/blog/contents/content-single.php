<article id="post-<?php the_ID(); ?>" class="post-details">

	<?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
		<div class="entry-thumbnail post-media post-image text-center">
			<?php 
			the_post_thumbnail( 'post-thumbnails' );
			?>
		</div>
	<?php endif; ?>

<!-- Article header -->
	<header class="entry-header">
     	<?php gloreya_post_meta(); ?>	
	</header><!-- header end -->

	<div class="post-body">
		<!-- Article content -->
		<div class="entry-content clearfix">
			<?php
			if ( is_search() ) {
				the_excerpt();
			} else {
				the_content( esc_html__( 'Continue reading &rarr;', 'gloreya' ) );
				gloreya_link_pages();
			}
			?>
		</div> <!-- end entry-content -->
    </div> <!-- end post-body -->
</article>