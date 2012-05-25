<?php get_header(); ?>
	<div id=main role=main>
		<div id=post class=content itemscope itemtype="http://schema.org/Article">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<h1 itemprop=name><?php single_post_title(); ?></h1>
					<p class="byline">
						By <a href="/" rel="author" itemprop="author"><?php the_author_meta( 'display_name' ) ?></a>
						on <b itemprop="datePublished" datetime="<?php the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></b>
					</p>
					<?php the_content(); ?>
					<hr>
				</div>
				<?php comments_template( '', true ); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_footer(); ?>
