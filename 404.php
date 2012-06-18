<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
	<div id=main role=main>
		<div id=page class=content>
			<article id="post-0" class="post error404 not-found">
				<div class="entry-header">
					<h1><center><?php _e( 'Error: 404', 'twentyeleven' ); ?></center></h1>
					<h2><center><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentyeleven' ); ?></center></h2>
				</div>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'twentyeleven' ); ?></p>

					<?php get_search_form(); ?>

					<div class="widget-middle">
						<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 8 ), array( 'widget_id' => '404' ) ); ?>

						<div class="widget-center">
							<div class="widget">
								<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'twentyeleven' ); ?></h2>
								<ul>
									<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
								</ul>
							</div>

							<?php
							$archive_content = '<p>' . __( 'Try looking in the monthly archives.', 'twentyeleven' ) . '</p>';
							the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) ); ?>
						</div>
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					</div>

					<?php the_widget( 'WP_Widget_Tag_Cloud', 'taxonomy=people' ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer('index'); ?>
