<?php
/**
 * The Default template for the site
 */
get_header(); ?>
<div id=about>
	<div class=group>
		<div id=header-image>
      		<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
		</div>
		<div id=personal itemscope itemtype="http://data-vocabulary.org/Person">
			<?php $siteowner=get_userdata(get_option('gus_siteowner')); ?>
			<?php if ( $siteowner == NULL ) {
				$siteowner=get_userdata( "1" );
			} ?>
			<h2 itemprop=name><?php echo $siteowner->display_name; ?></h2>
		   	<ul>
				<?php if (get_option('line_1')) { ?><li><?php echo get_option('line_1'); ?></li><?php } ?>
				<?php if (get_option('line_2')) { ?><li><?php echo get_option('line_2'); ?></li><?php } ?>
				<?php if (get_option('line_3')) { ?><li><?php echo get_option('line_3'); ?></li><?php } ?>
				<?php if (get_option('line_4')) { ?><li><?php echo get_option('line_4'); ?></li><?php } ?>
				<?php if (get_option('line_5')) { ?><li><?php echo get_option('line_5'); ?></li><?php } ?>
				<?php if (get_option('line_6')) { ?><li><?php echo get_option('line_6'); ?></li><?php } ?>
		   	</ul>
			<p id=icons>
			<?php if (get_option('gus_use_siteowner')) {
				if ($siteowner->facebook) { ?><a class=facebook rel=me target="_blank" href="https://www.facebook.com/<?php echo $siteowner->facebook; ?>"></a><?php }
				if ($siteowner->linkedin) { ?><a class=linkedin rel=me target="_blank" href="http://www.linkedin.com/in/<?php echo $siteowner->linkedin; ?>"></a><?php }
				if ($siteowner->twitter) { ?><a class=twitter rel=me target="_blank" href="http://twitter.com/<?php echo $siteowner->twitter; ?>"></a><?php }
				if ($siteowner->google) { ?><a class=google rel=me target="_blank" href="https://plus.google.com/<?php echo $siteowner->google; ?>"></a><?php }
				if ($siteowner->github) { ?><a class=github rel=me target="_blank" href="https://github.com/<?php echo $siteowner->github; ?>"></a><?php }
				if ($siteowner->flickr) { ?><a class=flickr rel=me target="_blank" href="http://www.flickr.com/people/<?php echo $siteowner->flickr; ?>"></a><?php }
				if ($siteowner->vimeo) { ?><a class=vimeo rel=me target="_blank" href="http://vimeo.com/<?php echo $siteowner->vimeo; ?>"></a><?php }
			/*	if ($siteowner->user_email) { ?><a class=email rel=me target="_blank" href="mailto:<?php echo $siteowner->user_email; ?>"></a><?php } */
			} else {
				if (get_option('gus_linkedin')) { ?><a class=linkedin rel=me href="<?php echo get_option('gus_linkedin'); ?>"></a><?php }
				if (get_option('gus_twitter')) { ?><a class=twitter rel=me href="<?php echo get_option('gus_twitter'); ?>"></a><?php }
				if (get_option('gus_google')) { ?><a class=google rel=me href="<?php echo get_option('gus_google'); ?>"></a><?php }
				if (get_option('gus_github')) { ?><a class=github rel=me href="<?php echo get_option('gus_github'); ?>"></a><?php }
				if (get_option('gus_flickr')) { ?><a class=flickr rel=me href="<?php echo get_option('gus_flickr'); ?>"></a><?php }
				if (get_option('gus_vimeo')) { ?><a class=vimeo rel=me href="<?php echo get_option('gus_vimeo'); ?>"></a><?php }
				if (get_option('gus_email')) { ?><a class=email rel=me href="<?php echo get_option('gus_email'); ?>"></a><?php }
			} ?>
			</p>
		</div>
	</div><!-- End class=group -->
</div><!-- End About -->
<div id=main role=main>
  	<div id=page class=content>
		<div id=home>
	    	<div id=home-about>
				<?php if (get_option('gus_home_textarea')) {
					echo "<p class=home-about>".get_option('gus_home_textarea')."</p>";
				} else {
					echo "<!-- Using Site Owners User Description -->";
					echo "<p class=home-about>$siteowner->user_description</p>";
				} ?>
			</div>
			<?php if (have_posts()) : ?>
				<div id=home-center>
					<?php query_posts("posts_per_page=10"); ?>
					<?php if (have_posts()) : ?>
						<div id=home-recent-posts>
							<h3 style=padding-top:0.75em>Recent Posts <a href="/archives" class=more>view all posts</a></h3>
							<ul class=posts>
								<!--Starting "The Loop"-->
								<?php while (have_posts()) : the_post(); ?>
									<li>
                                        					<?php $format = get_post_format(); ?>
                                        					<span class="icon-type-<?php echo $format; ?>"></span>
										<a href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_date('Y M d'); ?></time>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					<?php endif;

                                        $home_gallery_id = get_option('gus_gallery_cat');
                                        $query_post_args = array(
                                                'posts_per_page' => 2,
                                                'post_type' => 'post',
                                                'category__in' => $home_gallery_id,
					);
					query_posts( $query_post_args );
					if (have_posts()) { ?>
						<div id=home-gallery>
							<h3 style=padding-top:0.75em;text-align:center;>Recent Gallery Posts</h3>
							<center>
								<?php while (have_posts()) : the_post(); ?>
									<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail() ?></a>
								<?php endwhile; ?>
							</center>
						    <div id="home-gallery-text"><p><a href="<?php echo get_category_link( $home_gallery_id ); ?>">Site Gallery</a></p></div> 
						</div>
					<?php } ?>
				</div><!-- End home-center -->
			<?php endif; ?>
		</div><!-- End Home -->
	</div><!-- End Page -->
</div><!-- End Main -->
<?php get_footer('index'); ?>
