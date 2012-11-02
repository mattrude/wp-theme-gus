		<footer id=page-footer>
			<div id=footer>
			<div id=footer-top>
				<?php if ( is_active_sidebar( 'top-widget-area' ) ) {
					echo "<div id=top-widget class=footer-widget>";
						dynamic_sidebar( 'top-widget-area' );
					echo "</div>";
				} 
				if ( is_active_sidebar( 'left-widget-area' ) ) {
					echo "<div id=left-widget class=footer-widget>";
						dynamic_sidebar( 'left-widget-area' );
					echo "</div>";
				}
				if ( is_active_sidebar( 'center-widget-area' ) ) {
					echo "<div id=center-widget class=footer-widget>";
						dynamic_sidebar( 'center-widget-area' );
					echo "</div>";
				}
				if ( is_active_sidebar( 'right-widget-area' ) ) {
					echo "<div id=right-widget class=footer-widget>";
						dynamic_sidebar( 'right-widget-area' );
					echo "</div>";
				}
				if ( is_active_sidebar( 'bottom-widget-area' ) ) {
					echo "<div id=bottom-widget class=top-footer-widget>";
						dynamic_sidebar( 'bottom-widget-area' );
					echo "</div>";
				} ?>
			</div>
			<div id=lower-footer>
				<div id=copyright >
					<span>Copyright &copy; <?php echo get_option('gus_copy_year'); ?> - <?php echo date("Y") ?> by <?php
						$siteowner=get_userdata(get_option('gus_siteowner'));
						if ( $siteowner == NULL ) {
							$siteowner=get_userdata( "1" );
						}
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
					<?php if ( is_user_logged_in() ) { ?>
						<div><small>This page took <?php timer_stop(1); ?> seconds of computer labor, and required <?php echo get_num_queries(); ?> questions to produce.</small></div>
                    <?php } else { ?>
                        <div><small>Theme: <a href='https://github.com/mattrude/wp-theme-gus/#readme'>Gus</a> - Proudly powered by <a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">WordPress</a>.</small></div>
                    <?php } ?>
				</div> <!-- closing id copyright -->
			</div> <!-- closing id lower-footer -->
			</div> <!-- closing id footer -->
		<?php wp_footer(); ?>
		</footer>
	</div><!-- closing id container -->
</body><!-- closing body -->
</html>
