<?php
namespace WpCafe\Core\Base;

defined( 'ABSPATH' ) || exit;

/**
 * cutsom Post type class
 */
class Wpc_Custom_Post {
    private $xs_posts;
    /**
     * Call action
     *
     * @param [type] $textdomain
     */
    public function __construct() {
        $this->xs_posts   = [];
        add_action( 'init', [ $this, 'register_custom_post' ] );
    }

    /**
     * Create custom post
     */
    public function xs_init( $type, $singular_label, $plural_label, $settings = [] ) {
        $default_settings = [
            'labels'              => [
                'name'               => esc_html__( $plural_label, 'wpcafe' ),
                'singular_name'      => esc_html__( $singular_label, 'wpcafe' ),
                'add_new_item'       => esc_html__( 'Add New ' . $singular_label, 'wpcafe' ),
                'edit_item'          => esc_html__( 'Edit ' . $singular_label, 'wpcafe' ),
                'new_item'           => esc_html__( 'New ' . $singular_label, 'wpcafe' ),
                'view_item'          => esc_html__( 'View ' . $singular_label, 'wpcafe' ),
                'search_items'       => esc_html__( 'Search ' . $plural_label, 'wpcafe' ),
                'not_found'          => esc_html__( 'No ' . $plural_label . ' found', 'wpcafe' ),
                'not_found_in_trash' => esc_html__( 'No ' . $plural_label . ' found in trash', 'wpcafe' ),
                'parent_item_colon'  => esc_html__( 'Parent ' . $singular_label, 'wpcafe' ),
                'menu_name'          => esc_html__( $plural_label, 'wpcafe' ),
            ],
            'supports'            => false,
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => 'cafe_menu',
            'menu_icon'           => 'dashicons-text-page',
            'menu_position'       => 1,
            'show_in_admin_bar'   => false,
            'show_in_nav_menus'   => false,
            'can_export'          => false,
            'has_archive'         => false,
            'publicly_queryable'  => true,
            'query_var'           => true,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest'        => false,
            'rewrite'             => [ 'slug' => $plural_label, 'with_front' => false ],
        ];
        $this->xs_posts[$type] = array_merge( $default_settings, $settings );
    }

    /**
     * Register custom post
     *
     * @return void
     */
    public function register_custom_post() {

        foreach ( $this->xs_posts as $key => $value ) {
            register_post_type( $key, $value );
        }

    }

}

class Wpc_Taxonomies {
    protected $textdomain;
    protected $taxonomies;
    /**
     * Call action
     *
     * @param [type] $textdomain
     */
    public function __construct() {
        $this->taxonomies = [];
        add_action( 'init', [ $this, 'register_taxonomy' ] );
    }

    /**
     * Create texonomies
     *
     * @param [type] $type
     * @param [type] $singular_label
     * @param [type] $plural_label
     * @param [type] $post_types
     * @param array $settings
     * @return void
     */
    public function xs_init( $type, $singular_label, $plural_label, $slug, $post_types, $settings = [] ) {
        $default_settings = [
            'labels'            => [
                'name'                  => esc_html__( $plural_label, 'wpcafe' ),
                'singular_name'         => esc_html__( $singular_label, 'wpcafe' ),
                'add_new_item'          => esc_html__( 'New ' . $singular_label . ' name', 'wpcafe' ),
                'new_item_name'         => esc_html__( 'Add New ' . $singular_label, 'wpcafe' ),
                'edit_item'             => esc_html__( 'Edit ' . $singular_label, 'wpcafe' ),
                'update_item'           => esc_html__( 'Update ' . $singular_label, 'wpcafe' ),
                'add_or_remove_items'   => esc_html__( 'Add or remove ' . strtolower( $plural_label ), 'wpcafe' ),
                'search_items'          => esc_html__( 'Search ' . $plural_label, 'wpcafe' ),
                'popular_items'         => esc_html__( 'Popular ' . $plural_label, 'wpcafe' ),
                'all_items'             => esc_html__( 'All ' . $plural_label, 'wpcafe' ),
                'parent_item'           => esc_html__( 'Parent ' . $singular_label, 'wpcafe' ),
                'choose_from_most_used' => esc_html__( 'Choose from the most used ' . strtolower( $plural_label ), 'wpcafe' ),
                'parent_item_colon'     => esc_html__( 'Parent ' . $singular_label, 'wpcafe' ),
                'menu_name'             => esc_html__( $singular_label, 'wpcafe' ),
            ],

            'public'            => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'hierarchical'      => true,
            'query_var'         => true,
            'show_tagcloud'     => true,
            'show_ui'           => true,
            'rewrite'           => [
                'slug' => sanitize_title_with_dashes( $slug ),
            ],
        ];
        $this->taxonomies[$type]['post_types'] = $post_types;
        $this->taxonomies[$type]['args']       = array_merge( $default_settings, $settings );
    }

    /**
     * register texonomies
     *
     * @return void
     */
    public function register_taxonomy() {
        foreach ( $this->taxonomies as $key => $value ) {
            register_taxonomy( $key, $value['post_types'], $value['args'] );
        }
    }
}
