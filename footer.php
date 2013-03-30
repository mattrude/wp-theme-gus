<?php
/**
 * The default footer template
 */
namespace dochead;
?>
		<footer id=page-footer>
			<div id='footer-top'>
			<div class='content'>
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
					echo "<div id=right-widget class='footer-widget right-footer'>";
						dynamic_sidebar( 'right-widget-area' );
					echo "</div>";
				}
				if ( is_active_sidebar( 'bottom-widget-area' ) ) {
					echo "<div id=bottom-widget class=bottom-footer-widget>";
						dynamic_sidebar( 'bottom-widget-area' );
					echo "</div>";
				} ?>
			</div> <!-- closing id footer top content -->
			</div>
			<div id=lower-footer>
				<div class=content >
				<?php $siteowner=get_userdata(get_option('gus_siteowner'));
				if ( $siteowner == NULL ) {
					$siteowner=get_userdata( "1" );
				} ?>
                <div class='social-icons' >
                    <ul>
                        <li><a rel=me target="_blank" href="http://twitter.com/<?php echo $siteowner->twitter; ?>"><i class="icon-twitter-2"></i></a></li>
                        <li><a rel=me target="_blank" href="http://facebook.com/<?php echo $siteowner->facebook; ?>"><i class="icon-facebook-2"></i></a></li>
                        <li><a rel=me target="_blank" href="https://plus.google.com/<?php echo $siteowner->google; ?>"><i class="icon-google-plus-2"></i></a></li>
                        <li><a rel=me target="_blank" href="https://github.com/<?php echo $siteowner->github; ?>"><i class="icon-github-2"></i></a></li>
                    </ul>
                </div> <!-- closing id social -->
					<span>Copyright &copy; <?php echo get_option('gus_copy_year'); ?> - <?php echo date("Y") ?> by <?php
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
                <?php $siteowner=get_userdata(get_option('gus_siteowner')); ?>
			</div> <!-- closing id lower-footer -->
			</div> <!-- closing id footer -->
		</footer>
	</div><!-- closing id container -->
	<?php wp_footer(); ?>
</body><!-- closing body -->
</html>
