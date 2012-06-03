<?php get_header(); ?>
		<div id=main role=main>
	    	<div id=page class=content>
				<div id=home>
					<?php if (have_posts()) : ?>
						<h3 style=padding-top:0.75em>Archive Posts</a></h3>
						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'twentyeleven' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyeleven' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentyeleven' ) ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'twentyeleven' ); ?>
						<?php endif; ?>

						<ul class=posts>
							<!--Starting "The Loop"-->
							<?php while (have_posts()) : the_post(); ?>
								<li>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_date('Y M d'); ?></time>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php endif; ?>
					<?php gus_content_nav( 'nav-below' ); ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>
