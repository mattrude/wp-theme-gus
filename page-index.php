<?php
/*
Template Name: Archive Page
*/
?>
<?php get_header(); ?>
		<div id=main role=main>
	    	<div id=page class=content>
				<div id=home>
				<h2 style=padding-top:0.75em>Archived Posts</h2>
				<?php $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC");
				foreach($years as $year) : ?>
					<?php query_posts("posts_per_page=500&year=$year"); ?>
					<?php if (have_posts()) : ?>
						<h3><?php echo $year; ?>
						<ul class=posts>
							<?php while (have_posts()) : the_post(); ?>
								<!--Starting "The Loop"-->
								<?php $format = get_post_format(); ?>
								<li>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									<?php if ( $format == "gallery" ) {
										echo "<span class='gus-postformat-gallery'>Gallery</span>";
									} elseif ( $format == "image" ) {
										echo "<span class='gus-postformat-image'>Single Image</span>";
									} elseif ( $format == "status" ) {
										echo "<span class='gus-postformat-aside'>Status Update</span>";
									} elseif ( $format == "aside" ) {
										echo "<span class='gus-postformat-aside'>Aside</span>";
									} elseif ( $format == "video" ) {
										echo "<span class='gus-postformat-aside'>Video</span>";
									} ?>
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
