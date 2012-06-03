<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'twentyeleven_status_avatar', '65' ) ); ?></div>

			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<hr>
		<div class="entry-meta">
			<?php gus_posted_on(); ?>
			<?php if ( comments_open() ) : ?>
			<span class="sep"> | </span>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentyeleven' ) . '</span>', __( '<b>1</b> Reply', 'twentyeleven' ), __( '<b>%</b> Replies', 'twentyeleven' ) ); ?></span>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
