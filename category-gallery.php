<?php get_header(); ?>
<div id=main role=main>
   	<div id=page class=content>
		<div id=home>
			<?php if (have_posts()) : ?>
				<h3 style=padding-top:0.75em>Gallery Albums</h3>
				<ul class=posts>
					<!--Starting "The Loop"-->
					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part( 'content', 'gallery' ); ?>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
			<?php gus_content_nav( 'nav-below' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
