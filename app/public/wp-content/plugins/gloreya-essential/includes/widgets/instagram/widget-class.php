<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * recent post widget with thumbnails
 */

class Gloreya_Instagram extends WP_Widget
{
    function __construct() {

        $widget_opt = array(
            'classname'     => 'gloreya-widget',
            'description'   => 'Gloreya Instagrams'
        );
        
        parent::__construct('gloreya-instagram', esc_html__('Gloreya instagram', 'gloreya-essntial'), $widget_opt);
    }
    
    function widget( $args, $instance ){

    	$access_token = '';
        $media_count = 10;
        $title = apply_filters( 'widget_title', $instance['title'] );

        if ( ! empty( $title ) ){ 
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }
        if(isset($instance['access_token'])){
            $access_token = $instance['access_token'];
        }
       
        if(isset($instance['media_count'])){
            $media_count = $instance['media_count'];
        }
        
        ?>
        
        <div class="instagram_photo">
            <div id="instafeed" class="feed-content" data-token="<?php echo esc_attr($access_token);?>" data-media-count="<?php echo esc_attr($media_count);?>"></div>  
        </div>
        <?php
        echo $args['after_widget'];
    }
    
    
    function update ( $new_instance, $old_instance ) {

    	$old_instance['title'] = strip_tags( $new_instance['title'] );
        $old_instance['access_token'] = $new_instance['access_token'];
        
        $old_instance['media_count'] = $new_instance['media_count'];

        return $old_instance;
    }
    
    function form($instance){

        $access_token = '';
        $media_count = 10;
        $title = esc_html__( 'Instagram', 'gloreya-essntial' );

    	if(isset($instance['title'])){
            $title = $instance['title'];
        }
        if(isset($instance['access_token'])){
            $access_token = $instance['access_token'];
        }
       
        if(isset($instance['media_count'])){
            $media_count = $instance['media_count'];
        }
        
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'gloreya-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" placeholder="<?php echo esc_attr('Title','gloreya-essntial'); ?>"/>
        </p>

        <p>
            <a href="https://instagram.com/oauth/authorize/?client_id=3a81a9fa2a064751b8c31385b91cc25c&scope=basic+public_content&redirect_uri=https://smashballoon.com/instagram-feed/instagram-token-plugin/?return_uri=<?php echo admin_url() ?>widgets.php&response_type=token" class="sbi_admin_btn">
            <?php esc_html__( 'Log in and get my Access Token and User ID' , 'gloreya-essntial' ); ?>
            </a>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>"><?php esc_html__( 'Access token:' , 'gloreya-essntial' ); ?></label>
            <input class="widefat xs_access_token" id="<?php echo esc_attr($this->get_field_id( 'access_token' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'access_token' )); ?>" type="text" value="<?php echo esc_attr( $access_token ); ?>" placeholder="<?php echo esc_attr('Instagram Access Token','gloreya-essntial'); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'media_count' )); ?>"><?php esc_html__( 'Count:' , 'gloreya-essntial' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'media_count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'media_count' )); ?>" type="text" value="<?php echo esc_attr( $media_count ); ?>" placeholder="<?php echo esc_attr('Instagram Post Limit','gloreya-essntial'); ?>" />
        </p>
        <?php
    }
}
