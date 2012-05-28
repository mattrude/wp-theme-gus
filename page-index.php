<?php
/*
Template Name: Archive Page
*/
?>
<?php get_header(); ?>
		<div id=main role=main>
	    	<div id=page class=content>
				<div id=home>
					<?php if (have_posts()) : ?>
						<h3 style=padding-top:0.75em>Recent Posts <a href="/archives" class=more>view all posts</a></h3>
						<ul class=posts>
							<?php while (have_posts()) : the_post(); ?>
								<!--Starting "The Loop"-->
								<li>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									<time datetime="<?php the_date('M d y'); ?>" pubdate="pubdate"><?php the_date('Y-m-d'); ?></time>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>
