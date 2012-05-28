<?php get_header(); ?>
<div id=about>
	<div class=group>
		<div id=personal itemscope itemtype="http://data-vocabulary.org/Person">
			<h2 itemprop=name>Matt Rude</h2>
		    	<ul>
					<?php if (get_option('line_1')) { ?><li><?php echo get_option('line_1'); ?></li><?php } ?>
					<?php if (get_option('line_2')) { ?><li><?php echo get_option('line_2'); ?></li><?php } ?>
					<?php if (get_option('line_3')) { ?><li><?php echo get_option('line_3'); ?></li><?php } ?>
					<?php if (get_option('line_4')) { ?><li><?php echo get_option('line_4'); ?></li><?php } ?>
					<?php if (get_option('line_5')) { ?><li><?php echo get_option('line_5'); ?></li><?php } ?>
					<?php if (get_option('line_6')) { ?><li><?php echo get_option('line_6'); ?></li><?php } ?>
		    	</ul>
		    	<p id=icons>
					<?php if (get_option('gus_linkedin')) { ?><a class=linkedin rel=me href="<?php echo get_option('gus_linkedin'); ?>"></a><?php } ?>
					<?php if (get_option('gus_twitter')) { ?><a class=twitter rel=me href="<?php echo get_option('gus_twitter'); ?>"></a><?php } ?>
					<?php if (get_option('gus_google')) { ?><a class=google rel=me href="<?php echo get_option('gus_google'); ?>"></a><?php } ?>
					<?php if (get_option('gus_github')) { ?><a class=github rel=me href="<?php echo get_option('gus_github'); ?>"></a><?php } ?>
					<?php if (get_option('gus_flickr')) { ?><a class=flickr rel=me href="<?php echo get_option('gus_flickr'); ?>"></a><?php } ?>
					<?php if (get_option('gus_email')) { ?><a class=email rel=me href="<?php echo get_option('gus_email'); ?>"></a><?php } ?>
				</p>
			</div>
	    </div>
	</div>
	<div id=main role=main>
	  	<div id=page class=content>
			<div id=home>
		    	<p class=about><?php if (get_option('gus_home_textarea')) { echo get_option('gus_home_textarea'); } ?></p>
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
