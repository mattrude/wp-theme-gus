<?php get_header(); ?>
<div id=about>
	<div class=group>
		<div id=personal itemscope itemtype="http://data-vocabulary.org/Person">
			<?php $siteowner=get_userdata(get_option('gus_siteowner')); ?>
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
					if ($siteowner->twitter) { ?><a class=twitter rel=me target="_blank" href="http://twitter.com/#!/<?php echo $siteowner->twitter; ?>"></a><?php }
					if ($siteowner->google) { ?><a class=google rel=me target="_blank" href="https://plus.google.com/<?php echo $siteowner->google; ?>"></a><?php }
					if ($siteowner->github) { ?><a class=github rel=me target="_blank" href="https://github.com/<?php echo $siteowner->github; ?>"></a><?php }
					if ($siteowner->flickr) { ?><a class=flickr rel=me target="_blank" href="http://www.flickr.com/people/<?php echo $siteowner->flickr; ?>"></a><?php }
					if ($siteowner->user_email) { ?><a class=email rel=me target="_blank" href="mailto:<?php echo $siteowner->user_email; ?>"></a><?php }
				} else {
					if (get_option('gus_linkedin')) { ?><a class=linkedin rel=me href="<?php echo get_option('gus_linkedin'); ?>"></a><?php }
					if (get_option('gus_twitter')) { ?><a class=twitter rel=me href="<?php echo get_option('gus_twitter'); ?>"></a><?php }
					if (get_option('gus_google')) { ?><a class=google rel=me href="<?php echo get_option('gus_google'); ?>"></a><?php }
					if (get_option('gus_github')) { ?><a class=github rel=me href="<?php echo get_option('gus_github'); ?>"></a><?php }
					if (get_option('gus_flickr')) { ?><a class=flickr rel=me href="<?php echo get_option('gus_flickr'); ?>"></a><?php }
					if (get_option('gus_email')) { ?><a class=email rel=me href="<?php echo get_option('gus_email'); ?>"></a><?php }
				} ?>
				</p>
			</div>
	    </div>
	</div>
	<div id=main role=main>
	  	<div id=page class=content>
			<div id=home>
				<p class=about><?php echo $siteowner->user_description; ?></p>
		    	<p class=about><?php if (get_option('gus_home_textarea')) { echo get_option('gus_home_textarea'); } ?></p>
				<?php query_posts("posts_per_page=10"); ?>
				<?php if (have_posts()) : ?>
					<h3 style=padding-top:0.75em>Recent Posts <a href="/archives" class=more>view all posts</a></h3>
					<ul class=posts>
						<?php while (have_posts()) : the_post(); ?>
							<!--Starting "The Loop"-->
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_date('Y M d'); ?></time>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>