<?php
/**
 * Template Name: No Title Page
 */
get_header(); ?>
	<div id=main role=main>
		<div id=post class=content itemscope itemtype="http://schema.org/Article">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<?php the_content(); ?>
				</div>
				<?php comments_template( '', true ); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_footer(); ?>
