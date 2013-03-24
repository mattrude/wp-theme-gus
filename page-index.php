<?php
/**
 * Template Name: Archive Page
 */
get_header(); ?>
		<div id=main role=main>
	    	<div id=page class=content>
				<div id=home>
				<h2 style=padding-top:0.75em>Archived Posts</h2>
				<?php $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
				foreach($years as $year) : ?>
					<?php query_posts("posts_per_page=500&year=$year"); ?>
					<?php if (have_posts()) : ?>
						<h3><?php echo "Posts from the year $year"; ?>
						<ul class=posts>
							<?php while (have_posts()) : the_post(); ?>
								<!--Starting "The Loop"-->
								<?php $format = get_post_format(); ?>
								<li>
                                    <?php $format = get_post_format(); ?>
                                    <span class="icon-type-<?php echo $format; ?>"></span>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_date('Y M d'); ?></time>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
					<?php endforeach;?>
					<?php gus_content_nav( 'nav-below' ); ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>
