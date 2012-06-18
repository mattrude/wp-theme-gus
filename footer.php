		<footer>
			<div id=footer>
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
				</div> <!-- closing id copyright -->
			</div> <!-- closing id lower-footer -->
		<?php wp_footer(); ?>
		</footer>
	</div>
</html>
