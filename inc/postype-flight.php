<?php

/**
 * Custom Post Type: Flight 
 * 
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */

/**
 * Hook Flight into the 'init' action
 *
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action( 'init', 'flight_tag_init', 1 );
add_action( 'init', 'post_type_flight', 2 );

/**
 * Register Custom Post Type: Flight
 *
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function post_type_flight() {
    $labels = array(
        'name'                => _x( 'Flights', 'Post Type General Name', 'gus' ),
        'singular_name'       => _x( 'Flight', 'Post Type Singular Name', 'gus' ),
        'menu_name'           => __( 'Flight', 'gus' ),
        'parent_item_colon'   => __( 'Parent Flight:', 'gus' ),
        'all_items'           => __( 'All Flight Posts', 'gus' ),
        'view_item'           => __( 'View Flight Posts', 'gus' ),
        'add_new_item'        => __( 'Add New Flight Post', 'gus' ),
        'add_new'             => __( 'New Flight Post', 'gus' ),
        'edit_item'           => __( 'Edit Flight Post', 'gus' ),
        'update_item'         => __( 'Update Flight Post', 'gus' ),
        'search_items'        => __( 'Search Flights', 'gus' ),
        'not_found'           => __( 'No Flights found', 'gus' ),
        'not_found_in_trash'  => __( 'No Flights found in Trash', 'gus' ),
    );

    $rewrite = array(
        'slug'                => 'flight',
        'with_front'          => '/%year%/%monthnum%',
        'pages'               => false,
        'feeds'               => true,
    );

    $args = array(
        'label'               => __( 'flight', 'gus' ),
        'description'         => __( 'Flight posts', 'gus' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
        'taxonomies'          => array( 'flight_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
    );

    register_post_type( 'flight', $args );
}

/**
 * Register Taxonomy Tag for Custom Post Type Flight
 *
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function flight_tag_init() {
    // create a new taxonomy
    register_taxonomy( 'flight_tag', 'flight', array(
            'label' 	=> __( 'Flight Tags' ),
	    'show_ui'   => true,
	    'show_admin_column'     => true,
            'rewrite' => array( 'slug' => 'tag' ),
        )
    );
}

/**
 * Flush rewrite cache when theme is switched to
 *
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function my_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );

?>
