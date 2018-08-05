<?php

/**
 * Custom Post Type: Technical 
 * 
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */

/**
 * Hook Technical into the 'init' action
 *
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action( 'init', 'technical_tag_init', 1 );
add_action( 'init', 'technical_category_init', 2 );
add_action( 'init', 'post_type_technical', 3 );

/**
 * Register Custom Post Type: Technical
 *
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function post_type_technical() {
    $labels = array(
        'name'                => _x( 'Technicals', 'Post Type General Name', 'gus' ),
        'singular_name'       => _x( 'Technical', 'Post Type Singular Name', 'gus' ),
        'menu_name'           => __( 'Technical', 'gus' ),
        'parent_item_colon'   => __( 'Parent Technical:', 'gus' ),
        'all_items'           => __( 'All Technical Posts', 'gus' ),
        'view_item'           => __( 'View Technical Posts', 'gus' ),
        'add_new_item'        => __( 'Add New Technical Post', 'gus' ),
        'add_new'             => __( 'New Technical Post', 'gus' ),
        'edit_item'           => __( 'Edit Technical Post', 'gus' ),
        'update_item'         => __( 'Update Technical Post', 'gus' ),
        'search_items'        => __( 'Search Technicals', 'gus' ),
        'not_found'           => __( 'No Technicals found', 'gus' ),
        'not_found_in_trash'  => __( 'No Technicals found in Trash', 'gus' ),
    );

    $rewrite = array(
        'slug'                => 'technical',
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
    );

    $args = array(
        'label'               => __( 'technical', 'gus' ),
        'description'         => __( 'Technical posts', 'gus' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', 'gutenberg', ),
        'taxonomies'          => array( 'technical_tag' ),
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

    register_post_type( 'technical', $args );
}

/**
 * Register Taxonomy Tag for Custom Post Type Technical
 *
 * @since 2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function technical_tag_init() {
    // create a new taxonomy
    register_taxonomy( 'technical_tag', 'technical', array(
            'label' 	=> __( 'Technical Tags' ),
	    'show_ui'   => true,
	    'show_admin_column'     => true,
            'rewrite' => array( 'slug' => 'technical/tags' ),
        )
    );
}

/**
 * Register Taxonomy Category for Custom Post Type Technical
 *
 * @since 3.0
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function technical_category_init() {
    $technical_category_labels = array(
        'name' => _x( 'Technical Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Categories' ),
        'all_items' => __( 'All Technical Categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ), 
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
        'menu_name' => __( 'Technical Categories' ),
    );

    // create a new taxonomy
    register_taxonomy( 'technical_category', 'technical', array(
        'label' => __( 'Technical Categories' ),
        'hierarchical' => false,
        'labels' => $technical_category_labels,
        'show_ui' => true,
        'show_admin_column'     => true,
        'rewrite' => array( 'slug' => 'technical/categories' ),
        )
    );
}

?>
