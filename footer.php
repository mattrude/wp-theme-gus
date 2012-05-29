		<footer>
			<div id=copyright>
				<div class=group>
					<span>Copyright &copy; 1980 - <?php echo date("Y") ?> by <?php
						$siteowner=get_userdata(get_option('gus_siteowner'));
						if ( is_home() ) {
							if (get_option('gus_use_siteowner')) {
								?><a rel="me" href="https://plus.google.com/<?php echo $siteowner->google; ?>"><?php
							} elseif (get_option('gus_google')) {
								?><a rel="me" href="https://plus.google.com/<?php echo get_option('gus_google'); ?>"><?php
							} else {
								?><a rel="author" href="<?php bloginfo('url'); ?>"><?php
							}
						} else {
							?><a rel="author" href="<?php bloginfo('url'); ?>"><?php
						} 
						echo $siteowner->display_name;?></a>
					</span>
					<a href="<?php bloginfo('rss2_url'); ?>" class="about rss">subscribe via rss</a>
				</div>
			</div>
		<?php wp_footer(); ?>
		</footer>
	</div>
</html>
