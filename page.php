<?php get_header(); ?>
	<div id=main role=main>
		<div id=post class=content itemscope itemtype="http://schema.org/Article">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h1 itemprop=name><?php single_post_title(); ?></h1>
					<?php the_content(); ?>
					<p class="byline-bottom">
						Updated: <time itemprop="datePublished" datetime="<?php the_date('Y-m-d'); ?>" updated="<?php echo the_modified_time('Y-m-d'); ?>"><?php echo the_modified_time('Y-m-d'); ?></time>
					</p>
					<hr>
				</div>
				<?php comments_template( '', true ); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_footer(); ?>
