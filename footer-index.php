		<footer id=page-footer-index>
			<div id=lower-footer>
				<div id=copyright>
					<span>Copyright &copy; <?php echo get_option('gus_copy_year'); ?> - <?php echo date("Y") ?> by <?php
						$siteowner=get_userdata(get_option('gus_siteowner'));
						if ( $siteowner == NULL ) {
							$siteowner=get_userdata( "1" );
						}
						if (get_option('gus_use_siteowner')) {
							?><a rel="me" href="https://plus.google.com/<?php echo $siteowner->google; ?>"><?php
						} elseif (get_option('gus_google')) {
							?><a rel="me" href="https://plus.google.com/<?php echo get_option('gus_google'); ?>"><?php
						} else {
							?><a rel="author" href="<?php bloginfo('url'); ?>"><?php
						}
						echo $siteowner->display_name;?></a>
					</span>
					<a href="<?php bloginfo('rss2_url'); ?>" class="about rss">subscribe via rss</a>
					<?php if ( is_user_logged_in() ) { ?>
						<div><small>This page took <?php timer_stop(1); ?> seconds of computer labor, and required <?php echo get_num_queries(); ?> questions to produce.</small></div>
					<?php } ?>
				</div>
			</div>
		<?php wp_footer(); ?>
		</footer>
	</div>
</html>
