<?php get_header(); ?>
	<div id=main role=main>
		<div id=post class=content itemscope itemtype="http://schema.org/Article">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<?php gus_content_nav('nav-top-right'); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
					&nbsp;
				</div>
				<?php comments_template( '', true ); ?>
			<?php endwhile; ?>
		</div>
		&nbsp;
	</div>
	&nbsp;
<?php get_footer(); ?>
