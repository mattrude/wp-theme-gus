<?php

/********************************************************************************
  Random Settings Changes
*/
function gus_setup() {
	// Start out by added the Theme's Options page
	require_once('theme-options.php');

    // This theme has some pretty cool theme options
    //require_once ( get_template_directory() . '/theme-options.php' );

	// This theme allows users to set a custom background
	//add_theme_support( 'custom-background', $args );

	// This theme allows users to use custom header images
	//add_theme_support( 'custom-header', $args );

	// Add Post Thumbnails for WordPress 2.9
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(200, 200);

	// Changing excerpt more
	function new_excerpt_more($more) {
	  return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

	// Changing excerpt length
	function new_excerpt_length($length) {
	  return 29;
	}
	add_filter('excerpt_length', 'new_excerpt_length');

	// Disable gallery CSS insertes
	add_filter('gallery_style',
	  create_function(
	    '$css',
	    'return preg_replace("#<style type=\'text/css\'>(.*?)</style>#s", "", $css);'
	  )
	);
}

/** Tell WordPress to run milly_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'gus_setup' );


/********************************************************************************
Add Custom Taxonomiesi: people, places, & events
*/

function create_gus_taxonomies() {
	register_taxonomy( 'people', array( 'post', 'attachment' ), array( 'hierarchical' => false, 'label' => __('People'), 'query_var' => true, 'rewrite' => true ) );
	register_taxonomy( 'places', 'post', array( 'hierarchical' => false, 'label' => __('Places'), 'query_var' => true, 'rewrite' => true ) );
	register_taxonomy( 'events', 'post', array( 'hierarchical' => false, 'label' => __('Events'), 'query_var' => true, 'rewrite' => true ) );
}
add_action( 'init', 'create_gus_taxonomies', 0 );


function add_gus_contactmethod( $contactmethods ) {
	// Add Facebook, Google+, Google Talk, & Twitter
	$contactmethods['facebook'] = 'Facebook ID';
	$contactmethods['linkedin'] = 'Linkedin ID';
	$contactmethods['twitter'] = 'Twitter ID';
	$contactmethods['google'] = 'Google+ ID';
	$contactmethods['github'] = 'Github ID';
	$contactmethods['flickr'] = 'Flickr ID';

	// Remove Jabber, & Yahoo IM
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);

	return $contactmethods;
}
add_filter('user_contactmethods','add_gus_contactmethod',10,1);

if ( ! function_exists( 'gus_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function gus_content_nav( $nav_id ) {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="<?php echo $nav_id; ?>">
            <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gus' ) ); ?></div>
            <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gus' ) ); ?></div>
        </nav><!-- #nav-above -->
    <?php endif;
}
endif; // gus_content_nav


/*********************************************************************************
   This shortcode displays the years since the date provided.
   To use this shortcode, add some text to a post or page simmiler to:

     [ts date='1980-06-19']

   The date format is YYYY-MM-DD 
*/
if ( !function_exists('mdr_timesince') ) {
  function mdr_timesince($atts, $content = null) {
    extract(shortcode_atts(array("date" => ''), $atts));
    if(empty($date)) {
      return "<br /><br />************No date provided************<br /><br />";
    }
    $mdr_unix_date = strtotime($date);
    $mdr_time_difference = time() - $mdr_unix_date ;
    $years = floor($mdr_time_difference / 31556926 );
    $num_years_since = $years;
    return $num_years_since;
  }
add_shortcode('ts', 'mdr_timesince');
}

/*********************************************************************************
  Using WordPress functions to retrieve the extracted EXIF 
  information from database
*/
function mdr_exif() { ?>
  <div id="exif">
    <h3 class='comment-title exif-title'><?php _e('Images EXIF Data', 'millytheme'); ?></h3>
    <div id="exif-data">
      <?php
      $imgmeta = wp_get_attachment_metadata( $id );
      // Convert the shutter speed retrieve from database to fraction
      $image_shutter_speed = $imgmeta['image_meta']['shutter_speed'];
      if ($image_shutter_speed > 0) {
        if ((1 / $image_shutter_speed) > 1) {
          if ((number_format((1 / $image_shutter_speed), 1)) == 1.3
            or number_format((1 / $image_shutter_speed), 1) == 1.5
            or number_format((1 / $image_shutter_speed), 1) == 1.6
            or number_format((1 / $image_shutter_speed), 1) == 2.5){
            $pshutter = "1/" . number_format((1 / $image_shutter_speed), 1, '.', '') ." ".__('second', 'millytheme');
          } else {
            $pshutter = "1/" . number_format((1 / $image_shutter_speed), 0, '.', '') ." ".__('second', 'millytheme');
          }
        } else {
          $pshutter = $image_shutter_speed ." ".__('seconds', 'millytheme');
        }
      }

      // Start to display EXIF and IPTC data of digital photograph
      echo "<p>" . date("d-M-Y H:i:s", $imgmeta['image_meta']['created_timestamp'])."</p>";
      echo "<p>" . $imgmeta['image_meta']['camera']."</p>";
      echo "<p>" . $imgmeta['image_meta']['focal_length']."mm</p>";
      echo "<p>f/" . $imgmeta['image_meta']['aperture']."</p>";
      echo "<p>" . $imgmeta['image_meta']['iso']."</p>";
      echo "<p>" . $pshutter . "</p>"
      ?>
    </div>
    <div id="exif-lable">
      <?php // EXIF Titles
      echo "<p><span>".__('Date Taken:', 'millytheme')."</span>";
      echo "<p><span>".__('Camera:', 'millytheme')."</span>";
      echo "<p><span>".__('Focal Length:', 'millytheme')."</span>";
      echo "<p><span>".__('Aperture:', 'millytheme')."</span>";
      echo "<p><span>".__('ISO:', 'millytheme')."</span>";
      echo "<p><span>".__('Shutter Speed:', 'millytheme')."</span>"; ?>
    </div>
  </div>
<?php }

?>
