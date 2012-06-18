		<footer>
			<div id=footer>
				<div id=top-widget class=footer-widget>
					<?php if ( is_active_sidebar( 'top-widget-area' ) ) {
						dynamic_sidebar( 'top-widget-area' );
					} ?>
				</div>
				<div id=left-widget class=footer-widget>
					<?php if ( is_active_sidebar( 'left-widget-area' ) ) {
						dynamic_sidebar( 'left-widget-area' );
					} else {
						the_widget( 'random_image_widget' );
					} ?>
				</div>
				<div id=center-widget class=footer-widget>
					<?php if ( is_active_sidebar( 'center-widget-area' ) ) {
						dynamic_sidebar( 'center-widget-area' );
					} else {
						the_widget( 'Jetpack_RSS_Links_Widget' );
						the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 8 ), array( 'widget_id' => 'footer' ) );
					} ?>
				</div>
				<div id=right-widget class=footer-widget>
					<?php if ( is_active_sidebar( 'right-widget-area' ) ) {
						dynamic_sidebar( 'right-widget-area' );
					} else {
						$archive_content = '<p>' . __( 'Try looking in the monthly archives.', 'twentyeleven' ) . '</p>';
						the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
					} ?>
				</div>
				<div id=bottom-widget class=top-footer-widget>
					<?php if ( is_active_sidebar( 'bottom-widget-area' ) ) {
						dynamic_sidebar( 'bottom-widget-area' );
					} else {
						the_widget( 'WP_Widget_Tag_Cloud', 'taxonomy=people' );
					} ?>
				</div>
				&nbsp;
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
