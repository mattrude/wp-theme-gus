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
					<a href="<?php echo wp_get_attachment_url( $post->ID ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
						$attachment_size = apply_filters( 'twentyeleven_attachment_size', 770 );
						echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1024 ) ); // filterable image width with 1024px limit for image height.
					?></a>
					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>
					<?php the_content(); ?>
					<div id=image-right>
						<?php $attachments = array_values(get_children( 
							array(
								'post_parent' => $post->post_parent,
								'post_status' => 'inherit',
								'post_type' => 'attachment',
								'post_mime_type' => 'image',
								'order' => 'ASC',
								'orderby' => 'menu_order ID'
							)
						));
						foreach ( $attachments as $k => $attachment )
							if ( $attachment->ID == $post->ID )
								break;
						$next_url =  isset($attachments[$k+1]) ? get_permalink($attachments[$k+1]->ID) : get_permalink($attachments[0]->ID);
						$previous_url =  isset($attachments[$k-1]) ? get_permalink($attachments[$k-1]->ID) : get_permalink($attachments[0]->ID);
						if ( wp_get_attachment_image( $post->ID+1 ) != null ) { ?>
							<p class="attachment">
								<?php _e('Next Image', 'milly') ?><br />
								<a href="<?php echo $next_url; ?>"><?php echo wp_get_attachment_image( $post->ID+1, 'thumbnail' ); ?></a>
							</p> <?php
						}
	
						if ( wp_get_attachment_image( $post->ID-1 ) != null ) { ?>
							<p class="attachment">
								<?php _e('Previous Image', 'milly') ?><br />
								<a href="<?php echo $previous_url; ?>"><?php echo wp_get_attachment_image( $post->ID-1, 'thumbnail' ); ?></a>
							</p> <?php
						} ?>
					</div>
					<div id=image-left>
						<div id=taxonomy-meta>
							<h3>Image Meta Data</h3>
							<ul>
								<?php echo get_the_term_list( $post->post_parent, 'places', '<li>' .__('Location', 'gus'). ': ', ', ', '</li>' ); ?>
								<?php echo get_the_term_list( $post->post_parent, 'events', '<li>' .__('Event', 'gus'). ': ', ', ', '</li>' ); ?>
								<?php echo get_the_term_list( $post->ID, 'people', '<li>' .__('People Already Tagged', 'gus'). ': ', ', ', '</li>' ); ?>
							</ul>
						</div>
						<!-- Adding matt's cumnity tags: http://wordpress.org/extend/plugins/matts-community-tags/ -->
						<div id="community-tags">
							<h3 class="comment-title exif-title">Who is this?</h3>	
							<div id="tagthis"></div>
						</div>
						<!-- Closing matt's cumnity tags -->
						<?php mdr_exif(); ?>
					</div>
					<hr>
				</div>
				<?php comments_template( '', true ); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_footer(); ?>
