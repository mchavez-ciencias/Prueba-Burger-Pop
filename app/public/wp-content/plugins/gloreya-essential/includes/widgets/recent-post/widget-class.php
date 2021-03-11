<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * recent post widget
 */
class Gloreya_Recent_Post extends WP_Widget {

	function __construct() {

		$widget_opt = array(
			'classname'		 => 'gloreya-widget',
			'description'	 => esc_html__('Recent post with thumbnail','gloreya-essential')
		);

		parent::__construct( 'xs-recent-post', esc_html__( 'Gloreya recent post', 'gloreya-essential' ), $widget_opt );
	}

	function widget( $args, $instance ) {

		global $wp_query;

		echo gloreya_return($args[ 'before_widget' ]);

		if ( !empty( $instance[ 'title' ] ) ) {

			echo gloreya_return($args[ 'before_title' ]) . apply_filters( 'widget_title', $instance[ 'title' ] ) . gloreya_return($args[ 'after_title' ]);
		}

		if ( !empty( $instance[ 'number_of_posts' ] ) ) {
			$no_of_post = $instance[ 'number_of_posts' ];
		} else {
			$no_of_post = 3;
		}


		$query = array(
			'post_type'		 => array( 'post' ),
			'post_status'	 => array( 'publish' ),
			'orderby'		 => 'date',
			'order'			 => 'DESC',
			'posts_per_page' => $no_of_post
		);  

		$loop = new WP_Query( $query );
		?>
		<div class="widget-posts recent-post-widget">
			<?php
			if ( $loop->have_posts() ):
				while ( $loop->have_posts() ):
					$loop->the_post();
					?>
					<div class="widget-post media">
						<?php
							$thumbnail	 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), '' );
							$img  = fw_resize( $thumbnail[ 0 ], 70, 70,true );
							echo '<a href="'.get_the_permalink().'"><img src="' . esc_url( $img ) . '" alt="' . esc_attr__('thumb','gloreya-essential') . '"></a>';
							?>
						<div class="media-body">
							<h5 class="entry-title">
								<a href="<?php echo get_the_permalink(); ?>" >
								<?php echo esc_html(wp_trim_words(get_the_title(), 6,'')); ?>
							</h5>
							<span class="post-meta-date"> 
								<?php echo get_the_time( 'd M, Y' ); ?>
							</span>
						</div>
					</div>

				<?php endwhile; ?>
			<?php else: ?>
				<div class="nopost_message">
					<p><?php echo esc_html__( 'No post avainable', 'gloreya-essential' ) ?></p>';
				</div>
			<?php endif; ?>  
			</div>
		<?php
		wp_reset_postdata();
		echo gloreya_return($args[ 'after_widget' ]);
	}

	function update( $new_instance, $old_instance ) {

		$old_instance[ 'title' ]			 = strip_tags( $new_instance[ 'title' ] );
		$old_instance[ 'number_of_posts' ] = $new_instance[ 'number_of_posts' ];

		return $old_instance;
	}

	function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = esc_html__( 'Recent posts', 'gloreya-essential' );
		}
		if ( isset( $instance[ 'number_of_posts' ] ) ) {
			$no_of_post = $instance[ 'number_of_posts' ];
		} else {
			$no_of_post = 3;
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gloreya-essential' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'gloreya-essential' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_posts' ) ); ?>" type="text" value="<?php echo esc_attr( $no_of_post ); ?>" />
		</p>
		<?php
	}

}
