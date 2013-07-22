<?php

/**
 * Custom Post Type: 5 Speed 
 * 
 * @since 2.2
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
// Register Custom Post Type
function post_type_5speed() {
    $labels = array(
        'name'                => _x( 'Reasons', 'Post Type General Name', 'gus' ),
        'singular_name'       => _x( 'Reason', 'Post Type Singular Name', 'gus' ),
        'menu_name'           => __( '5 Speed', 'gus' ),
        'parent_item_colon'   => __( 'Parent Reason:', 'gus' ),
        'all_items'           => __( 'All Reasons', 'gus' ),
        'view_item'           => __( 'View Reason', 'gus' ),
        'add_new_item'        => __( 'Add New Reason', 'gus' ),
        'add_new'             => __( 'New Reason', 'gus' ),
        'edit_item'           => __( 'Edit Reason', 'gus' ),
        'update_item'         => __( 'Update Reason', 'gus' ),
        'search_items'        => __( 'Search Reasons', 'gus' ),
        'not_found'           => __( 'No Reasons found', 'gus' ),
        'not_found_in_trash'  => __( 'No Reasons found in Trash', 'gus' )
    );

    $rewrite = array(
        'slug'                => '5speed',
        'with_front'          => '/',
        'pages'               => false,
        'feeds'               => true
    );

    $args = array(
        'label'               => __( '5speed', 'gus' ),
        'description'         => __( 'Why I drive a 5 Speed Car Posts', 'gus' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'comments', 'trackbacks', 'revisions', 'custom-fields' ),
        'taxonomies'          => false,
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
        'capability_type'     => 'post'
    );

    register_post_type( '5speed', $args );
}

// Hook into the 'init' action
add_action( 'init', 'post_type_5speed', 0 );

function load_5speed_archive() {
    echo "<h3 class=\"list-title\">My list of reasons why I drive a manual transmission car:</h3>";
    echo "<div class=\"5speed\">";
    while (have_posts()) : the_post(); ?>
        <li>
            <h3 style="margin-bottom:0px;"># <a href="<?php the_permalink() ?>" rel="bookmark" title="Reason <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
            <?php the_content(); ?>
        </li>
    <?php endwhile;
    echo "</div>";
}

?>
