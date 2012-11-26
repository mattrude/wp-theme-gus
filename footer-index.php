		<footer id=page-footer>
			<div id=lower-footer>
				<div class='content'>
                    <div class='social-icons' >
                        <ul>
                            <li><a href="/feed"><span class="icon-feed-2"></span></a></li>
                        </ul>
                    </div> <!-- closing id social -->
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
					<?php if ( is_user_logged_in() ) { ?>
						<div><small>This page took <?php timer_stop(1); ?> seconds of computer labor, and required <?php echo get_num_queries(); ?> questions to produce.</small></div>
					<?php } else { ?>
                        <div><small>Theme: <a href='https://github.com/mattrude/wp-theme-gus/#readme'>Gus</a> - Proudly powered by <a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">WordPress</a>.</small></div>
                    <?php } ?>
				</div>
			</div>
		</footer>
	</div><!-- closing id container -->
	<?php wp_footer(); ?>
</body><!-- closing body -->
</html>
