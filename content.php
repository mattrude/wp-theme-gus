<?php
/**
 * The default template for displaying content
 *
 * @package Gus Theme
 * @since 0.1
 */
namespace dochead;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php $format = get_post_format(); ?>
	<h1 itemprop=name><span class="icon-type-<?php echo $format; ?> icon-post-title"></span><span class="entry-title"><?php single_post_title(); ?></span></h1>
	<div class="vcard">
		<p class="byline">
			By <span itemprop="name"><a href="/" rel="author" class="url fn" itemprop="author"><?php the_author_meta( 'display_name' ) ?></a></span>
			on <b><time itemprop="datePublished" datetime="<?php the_date('Y-m-d'); ?>" updated="<?php the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time></b>
		</p>
	</div>

	<nav id="nav-single">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
        <span class="nav-previous"><?php previous_post_link_plus( array( 'order_by' => 'post_date', 'format' => '%link', 'link' => __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ), 'tooltip' => '%title' ) ); ?></span>
        <span class="nav-next"><?php next_post_link_plus( array( 'order_by' => 'post_date', 'format' => '%link', 'link' => __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ) ); ?></span>
	</nav><!-- #nav-single -->


	<?php the_content(); ?>
	<?php $show_sep = false; ?>
	<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
		if ( $categories_list ): ?>
			<span class="cat-links">
				<?php printf( __( '<span class="%1$s">Posted in:</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
				$show_sep = true; ?>
            </span>
		<?php endif; // End if categories
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
		if ( $tags_list ):
			if ( $show_sep ) : ?>
				<span class="sep"> | </span>
			<?php endif; // End if $show_sep ?>
			<span class="tag-links">
                <?php printf( __( '<span class="%1$s">Tagged:</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
                $show_sep = true; ?>
            </span>
		<?php endif; // End if $tags_list
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_term_list( $id, 'places','', __( ', ', 'twentyeleven' ) );
        if ( $tags_list ):
            if ( $show_sep ) : ?>
                <span class="sep"> | </span>
            <?php endif; // End if $show_sep ?>
            <span class="tag-links">
                <?php printf( __( '<span class="%1$s">Location:</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
                $show_sep = true; ?>
            </span>
        <?php endif; // End if $tags_list
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_term_list( $id, 'events','', __( ', ', 'twentyeleven' ) );
        if ( $tags_list ):
            if ( $show_sep ) : ?>
                <span class="sep"> | </span>
            <?php endif; // End if $show_sep ?>
            <span class="tag-links">
                <?php printf( __( '<span class="%1$s">Event:</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
                $show_sep = true; ?>
            </span>
        <?php endif; // End if $tags_list
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_term_list( $id, 'people','', __( ', ', 'twentyeleven' ) );
        if ( $tags_list ):
            if ( $show_sep ) : ?>
                <span class="sep"> | </span>
            <?php endif; // End if $show_sep ?>
            <span class="tag-links">
                <?php printf( __( '<span class="%1$s">People:</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
                $show_sep = true; ?>
            </span>
        <?php endif; // End if $tags_list ?>
	<?php endif; // End if 'post' == get_post_type() ?>
    <?php if ( 'flight' == get_post_type() ) :
        $tags_list = get_the_term_list( $id, 'flight_tag','', __( ', ', 'twentyeleven' ) );
		if ( $tags_list ):
			if ( $show_sep ) : ?>
				<span class="sep"> | </span>
			<?php endif; // End if $show_sep ?>
			<span class="tag-links">
                <?php printf( __( '<span class="%1$s">Tagged:</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
                $show_sep = true; ?>
            </span>
		<?php endif; // End if $tags_list
	endif; // End if flight
	gus_content_nav('nav-bottom'); ?>
	<hr>
</article><!-- #post-<?php the_ID(); ?> -->
