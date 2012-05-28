		<footer>
			<div id=copyright>
				<div class=group>
					<span>Copyright &copy; 1980 - <?php echo date("Y") ?> by <a href="http://mattrude.com/"><?php
						if ( is_home() ) {
							?><a rel="me" href="https://plus.google.com/112621058996703559018/posts"><?php
						} else {
							?><a rel="author" href="http://mattrude.com/"><?php
						} 
						?>Matt Rude</a>
					</span>
					<a href="<?php bloginfo('rss2_url'); ?>" class="about rss">subscribe via rss</a>
				</div>
			</div>
		<?php wp_footer(); ?>
		</footer>
	</div>
</html>
