<?php get_header(); ?>
	    <div id=about>
	        <div class=group>
	            <div id=personal itemscope itemtype="http://data-vocabulary.org/Person">
		            <h2 itemprop=name>Matt Rude</h2>
		            <ul>
			            <li></li>
			            <li>Open-source <a href="https://github.com/mattrude">geek</a>
						<li></li>
						<li></li>
		    		</ul>
		    		<p id=icons>
						<a class=linkedin rel=me href="http://www.linkedin.com/in/mrude"></a>
						<a class=twitter rel=me href="http://twitter.com/mdrude"></a>
						<a class=google rel=me href="https://plus.google.com/112621058996703559018"></a>
						<a class=github rel=me href="http://github.com/mattrude"></a>
						<a class=flickr rel=me href="http://flickr.com/photos/mattrude/"></a>
						<a class=email rel=me href="mailto:matt@mattrude.com"></a>
					</p>
				</div>
	    	</div>
		</div>
		<div id=main role=main>
	    	<div id=page class=content>
				<div id=home>
		    		<p class=about>Hi, my name is Matt Rude, I.m a 31 year old guy, living in the Twin Cities, Minnesota. I have worked in Information Technology for over 15 years. During that time I have worked for business sectors as diverse as Public Schools to Auto Part to Health Care.</p>

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
