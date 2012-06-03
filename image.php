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
    				<?php foreach ( $attachments as $k => $attachment ) {
		        		if ( $attachment->ID == $post->ID )
							break;
					}
					$k++;
					// If there is more than 1 attachment in a gallery
					if ( count( $attachments ) > 1 ) {
						if ( isset( $attachments[ $k ] ) )
							// get the URL of the next image attachment
							$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
						else
							// or get the URL of the first image attachment
							$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
					} else {
						// or, if there's only 1 image, get the URL of the image
						$next_attachment_url = wp_get_attachment_url();
					} ?>
					<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
						$attachment_size = apply_filters( 'twentyeleven_attachment_size', 770 );
						echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1024 ) ); // filterable image width with 1024px limit for image height.
					?></a>
					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>
					<?php the_content(); ?>
					<div id=taxonomy-meta>
						<h3>Image Meta Data</h3>
						<ul>
							<?php echo get_the_term_list( $post->post_parent, 'places', '<li>' .__('Location', 'gus'). ': ', ', ', '</li>' ); ?>
							<?php echo get_the_term_list( $post->post_parent, 'events', '<li>' .__('Event', 'gus'). ': ', ', ', '</li>' ); ?>
							<?php echo get_the_term_list( $post->ID, 'people', '<li>' .__('People Already Tagged', 'gus'). ': ', ', ', '</li>' ); ?>
						</ul>
					</div>
					<?php mdr_exif(); ?>
					<hr>
				</div>
				<?php comments_template( '', true ); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_footer(); ?>
