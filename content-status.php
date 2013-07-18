<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Gus Theme
 */
namespace dochead;
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
            <?php $format = get_post_format(); ?>
	        <h1 itemprop=name><span class="icon-type-<?php echo $format; ?> icon-post-title"></span><span class="entry-title">Status Update: <?php single_post_title(); ?></span></h1>
			<div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'twentyeleven_status_avatar', '65' ) ); ?></div>

			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<hr>
		<div class="entry-meta"><small>
			<?php gus_posted_on(); ?>
			<span class="sep"> | </span>
            <?php $categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
            if ( $categories_list ): ?>
                <span class="cat-links">
                    <?php printf( __( '<span class="%1$s">Categorized as:</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
                    $show_sep = true; ?>
                </span>
			    <span class="sep"> | </span>
            <?php endif; // End if categories
            $tags_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
            if ( $tags_list ): ?>
                <span class="tag-links">
                    <?php printf( __( '<span class="%1$s">Tagged as:</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
                    $show_sep = true; ?>
                </span>
			    <span class="sep"> | </span>
            <?php endif; // End if $tags_list ?>
			<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- #entry-meta --></small>

	</article><!-- #post-<?php the_ID(); ?> -->
	<nav id="nav-single" class="status">
		<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
		<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
	</nav><!-- #nav-single -->
