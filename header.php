<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( get_option('gus_use_cdn') ) { ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_option('gus_cdn_address'); ?>/wp-content/themes/gus/style.css" />
<?php } else { ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php } ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	if ( is_attachment() ) {
		wp_enqueue_script( 'jquery' );
		add_action( 'wp_head', 'mct_script' );
	}

	wp_head();
?>
</head>
<body <?php body_class(); ?>>
    <div id=container>
        <header>
            <div class=content>
			<?php
			/* The navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged
			to the primary position is the one used. If none is assigned, the menu with the lowest ID is used.  */
			wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header', 'theme_location' => 'header', 'fallback_cb' => 'gus_nav_fallback' ) ); ?>
				<a href="/"><?php bloginfo( 'name' ); ?></a> <b>&nbsp;|&nbsp;</b> <span><?php bloginfo( 'description' ); ?></span>
	        </div>
	    </header>
