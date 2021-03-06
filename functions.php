<?php

//flush_rewrite_rules();
/**
 * Random Settings Changes
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function gus_setup() {
	// Start out by added the Theme's Options page
	require_once('inc/theme-options.php');

        // Add the Technical post_type
        require_once('inc/postype-technical.php');

        // Add the Flight post_type
        require_once('inc/postype-flight.php');

        // Add the 5 Speed post_type
        //require_once('inc/postype-5speed.php');

	// This theme allows users to set a custom background
	add_theme_support( 'custom-background' );

	// Add a top Menu to the page
	add_theme_support( 'nav-menus' );
	register_nav_menus( array(
    	'header' => __( 'The Header Navigation Menu', 'gus' ),
    	'page-submenu' => __( 'The Page Sub Navigation Menu', 'gus' ),
    	'flight-submenu' => __( 'The Flight Sub Navigation Menu', 'gus' ),
    	'5speed-submenu' => __( 'The 5 Speed Sub Navigation Menu', 'gus' ),
	) );
	function gus_nav_fallback() {
		echo "<!--No Header Navigation Menu selected-->";
	}

	// This theme allows users to use custom header images
	$args = array(
		'width'         => 450,
		'height'        => 250,
		'header-text'   => false,
		'default-image' => get_template_directory_uri() . '/images/header.jpg',
	);
	add_theme_support( 'custom-header', $args );

	// Add Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'link', 'status', 'video' ) );

	// Add Post Thumbnails for WordPress 2.9
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(200, 200);

	// Changing excerpt more
	function new_excerpt_more($more) {
	  return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

	// Changing excerpt length
	function new_excerpt_length($length) {
	  return 29;
	}
	add_filter('excerpt_length', 'new_excerpt_length');

	// Disable gallery CSS insertes
	add_filter('gallery_style',
	  create_function(
	    '$css',
	    'return preg_replace("#<style type=\'text/css\'>(.*?)</style>#s", "", $css);'
	  )
	);
}

// Fix removal of oEmbed width options in 3.5
if ( ! isset( $content_width ) ) $content_width = 770;

/**
 * Add Bootstrap 4.0 CSS
 *
 * @since 0.5
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function theme_styles() {
	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_styles');

/**
 * Add Bootstrap 4.0 JS
 *
 * @since 0.5
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function theme_js() {
	global $wp_scripts;
	wp_enqueue_script( 'jquery_js', 'https://code.jquery.com/jquery-3.2.1.slim.min.js');
	wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');
	#wp_enqueue_script( 'my_custom_js', get_template_directory_uri() . '/js/scripts.js');
}
add_action( 'wp_enqueue_scripts', 'theme_js');

/**
 * Add Matt's Community Tags plugin to theme
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action('after_setup_theme', 'community_tags_init');
function community_tags_init() {
	if (!function_exists('mct_admin_init')) {
		include_once(TEMPLATEPATH.'/inc/plugins/community-tags/community-tags.php');
	}
}

/**
 * Add Random Image Block plugin to theme
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action('after_setup_theme', 'random_image_block_init');
function random_image_block_init() {
	if (!class_exists('random_image_widget')) {
		include_once(TEMPLATEPATH.'/inc/plugins/random-image-block.php');
	}
}

/**
 * Add Webmaster Tools plugin to theme
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action('after_setup_theme', 'webmaster_tools_init');
function webmaster_tools_init() {
	if (!function_exists('add_mdr_webmaster_tools')) {
		include_once(TEMPLATEPATH.'/inc/plugins/webmaster-tools.php');
	}
}

/**
 * Add the Foot Notes plugin to theme
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action('after_setup_theme', 'footnotes_init');
function footnotes_init() {
	if (!class_exists('gus_footnotes')) {
		include_once(TEMPLATEPATH.'/inc/plugins/footnotes.php');
	}
}

/**
 * Add the Time Since plugin to theme
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action('after_setup_theme', 'timesince_init');
function timesince_init() {
	if (!function_exists('mdr_timesince')) {
		include_once(TEMPLATEPATH.'/inc/plugins/timesince.php');
	}
}

/**
 * Add the Time Since plugin to theme
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action('after_setup_theme', 'feed_footer_init');
function feed_footer_init() {
	if (!function_exists('mdr_postrss')) {
		include_once(TEMPLATEPATH.'/inc/plugins/feed-footer.php');
	}
}

/**
 * Add the Table of Contents plugin to theme
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action('after_setup_theme', 'tableofcontents_init');
function tableofcontents_init() {
    if (!function_exists('mdr_table_of_contents')) {
        include_once(TEMPLATEPATH.'/inc/plugins/table-of-contents.php');
    }
}


/**
 * Add the Post Link Plus plugin to theme
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action('after_setup_theme', 'postlinkplus_init');
function postlinkplus_init() {
    if (!function_exists('get_adjacent_post_plus')) {
        include_once(TEMPLATEPATH.'/inc/plugins/post-link-plus.php');
    }
}
/**
 * Tell WordPress to run milly_setup() when the 'after_setup_theme' hook is run.
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action( 'after_setup_theme', 'gus_setup' );

// Deregister the JetPack Widgets css
add_action( 'wp_print_styles', 'jetpack_deregister_styles', 100 );

/**
 * Deregister the jetpack-widgets style sheet.
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function jetpack_deregister_styles() {
    wp_deregister_style( 'jetpack-widgets' );
}

/**
 * Deregister the sharedaddy style sheet.
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
 function sharedaddy_deregister_style() {
    wp_deregister_style( 'sharedaddy' );
 }

/**
 * Add Custom Taxonomiesi: people, places, & events
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function create_gus_taxonomies() {
	register_taxonomy( 'people', array( 'post', 'attachment' ), array( 'hierarchical' => false, 'label' => __('People'), 'query_var' => true, 'rewrite' => true ) );
	register_taxonomy( 'places', array( 'post', 'attachment' ), array( 'hierarchical' => false, 'label' => __('Places'), 'query_var' => true, 'rewrite' => true ) );
	register_taxonomy( 'events', array( 'post', 'attachment' ), array( 'hierarchical' => false, 'label' => __('Events'), 'query_var' => true, 'rewrite' => true ) );
}
add_action( 'init', 'create_gus_taxonomies', 0 );

/**
 * Add Widgets to Theme
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
add_action( 'widgets_init', 'gus_register_widgets' );
function gus_register_widgets() {
    register_sidebar(array (
        'id' => 'post-widget-area',
        'name' => __('Post/Page Widget Area', 'gustheme'),
        'description' => __('This is the Post/Page Widget Area', 'gustheme'),
        'before_widget' => '<div class="widget bookmarks widget-bookmarks">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array (
	    'id' => 'top-widget-area',
	    'name' => __('Top Footer Widget Area', 'gustheme'),
	    'description' => __('This is the Footer\'s Top Widget Area', 'gustheme'),
	    'before_widget' => '<div class="widget bookmarks widget-bookmarks">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	));
	register_sidebar(array (
	    'id' => 'left-widget-area',
	    'name' => __('Left Footer Widget Area', 'gustheme'),
	    'description' => __('This is the Footer\'s left hand side Widget Area', 'gustheme'),
	    'before_widget' => '<div class="widget bookmarks widget-bookmarks">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	));
	register_sidebar(array (
	    'id' => 'center-widget-area',
	    'name' => __('Center Footer Widget Area', 'gustheme'),
	    'description' => __('This is the Footer\'s center Widget Area', 'gustheme'),
	    'before_widget' => '<div class="widget bookmarks widget-bookmarks">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	));
	register_sidebar(array (
	    'id' => 'right-widget-area',
	    'name' => __('Right Footer Widget Area', 'gustheme'),
	    'description' => __('This is the Footer\'s right hand side Widget Area', 'gustheme'),
	    'before_widget' => '<div class="widget bookmarks widget-bookmarks">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	));
	register_sidebar(array (
	    'id' => 'bottom-widget-area',
	    'name' => __('Bottom Footer Widget Area', 'gustheme'),
	    'description' => __('This is the Footer\'s Bottom Widget Area', 'gustheme'),
	    'before_widget' => '<div class="widget bookmarks widget-bookmarks">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	));
}


/**
 * Custom Contact methods
 *
 * Adds: facebook, linkedin, twitter, google, github, & flickr
 * to the users profile page, and removes: aim, jabber, & yahoo IM
 * 
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function gus_contactmethod( $contactmethods ) {
	// Adds facebook, linkedin, twitter, google, github, & flickr
	$contactmethods['facebook'] = 'Facebook ID';
	$contactmethods['linkedin'] = 'Linkedin ID';
	$contactmethods['twitter'] = 'Twitter ID';
	$contactmethods['google'] = 'Google+ ID';
	$contactmethods['github'] = 'Github ID';
	$contactmethods['flickr'] = 'Flickr ID';
	$contactmethods['vimeo'] = 'Vimeo ID';
	$contactmethods['jabber'] = 'Jabber/XMPP ID';

	// Remove AIM, Jabber, & Yahoo IM
	unset($contactmethods['aim']);
	unset($contactmethods['yim']);

	return $contactmethods;
}
add_filter('user_contactmethods','gus_contactmethod',10,1);

if ( ! function_exists( 'gus_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function gus_content_nav( $nav_id ) {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>">
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gustheme' ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gustheme' ) ); ?></div>
        </nav><!-- #nav-above -->
    <?php endif;
}
endif; // gus_content_nav

if ( ! function_exists( 'gus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own gus_posted_on to override in a child theme
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function gus_posted_on() {
    printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'gus' ),
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'gus' ), get_the_author() ) ),
        get_the_author()
    );
}
endif;

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function gus_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php
                        $avatar_size = 68;
                        if ( '0' != $comment->comment_parent )
                            $avatar_size = 39;

                        echo get_avatar( $comment, $avatar_size );

                        /* translators: 1: comment author, 2: date and time */
                        printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
                            sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                            sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                get_comment_time( 'c' ),
                                /* translators: 1: date, 2: time */
                                sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
                            )
                        );
                    ?>

                    <?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .comment-author .vcard -->

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
                    <br />
                <?php endif; ?>

            </footer>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->

    <?php
            break;
    endswitch;
}
endif; // ends check for twentyeleven_comment()

/**
 * Check for the ID of the parent page, if there is one.
 *
 * See: http://codex.wordpress.org/Conditional_Tags#Testing_for_sub-Pages
 *
 * @since 0.2.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function is_subpage() {
    global $post;                              // load details about this page

    if ( is_page() && $post->post_parent ) {   // test to see if the page has a parent
        return $post->post_parent;             // return the ID of the parent post

    } else {                                   // there is no parent so ...
        return false;                          // ... the answer to the question is false
    }
}

/**
 * Using WordPress functions to retrieve the extracted EXIF 
 * information from database
 *
 * @since 0.1
 * @package Gus Theme
 * @author Matt Rude <matt@mattrude.com>
 */
function mdr_exif() { ?>
  <div id="exif">
    <h3 class='comment-title exif-title'><?php _e('Images EXIF Data', 'millytheme'); ?></h3>
    <div id="exif-data"> <?php
      $imgmeta = wp_get_attachment_metadata();
      // Convert the shutter speed retrieve from database to fraction
      $image_shutter_speed = $imgmeta['image_meta']['shutter_speed'];
      if ($image_shutter_speed > 0) {
        if ((1 / $image_shutter_speed) > 1) {
          if ((number_format((1 / $image_shutter_speed), 1)) == 1.3
            or number_format((1 / $image_shutter_speed), 1) == 1.5
            or number_format((1 / $image_shutter_speed), 1) == 1.6
            or number_format((1 / $image_shutter_speed), 1) == 2.5){
            $pshutter = "1/" . number_format((1 / $image_shutter_speed), 1, '.', '') ." ".__('second', 'millytheme');
          } else {
            $pshutter = "1/" . number_format((1 / $image_shutter_speed), 0, '.', '') ." ".__('second', 'millytheme');
          }
        } else {
          $pshutter = $image_shutter_speed ." ".__('seconds', 'millytheme');
        }
      }

      // Start to display EXIF and IPTC data of digital photograph
      echo "<p>" . date("d-M-Y H:i:s", $imgmeta['image_meta']['created_timestamp'])."</p>";
      echo "<p>" . $imgmeta['image_meta']['camera']."</p>";
      echo "<p>" . $imgmeta['image_meta']['focal_length']."mm</p>";
      echo "<p>f/" . $imgmeta['image_meta']['aperture']."</p>";
      echo "<p>" . $imgmeta['image_meta']['iso']."</p>";
      echo "<p>" . $pshutter . "</p>"
      ?>
    </div>
    <div id="exif-lable">
      <?php // EXIF Titles
      echo "<p><span>".__('Date Taken:', 'millytheme')."</span>";
      echo "<p><span>".__('Camera:', 'millytheme')."</span>";
      echo "<p><span>".__('Focal Length:', 'millytheme')."</span>";
      echo "<p><span>".__('Aperture:', 'millytheme')."</span>";
      echo "<p><span>".__('ISO:', 'millytheme')."</span>";
      echo "<p><span>".__('Shutter Speed:', 'millytheme')."</span>"; ?>
    </div>
  </div>
<?php }

?>
