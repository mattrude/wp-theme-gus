<?php
/**
 * Random Image Block
 *
 * Display a random image from your native WordPress photo galley or in-beaded images.
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Random Image Block
 */

/**
 * The main Random Image Block Class
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Random Image Block
 */
class random_image_widget extends WP_Widget {
  function random_image_widget() {
    $currentLocale = get_locale();
    if(!empty($currentLocale)) {
      $moFile = dirname(__FILE__) . "/languages/random-image-block." .  $currentLocale . ".mo";
      if(@file_exists($moFile) && is_readable($moFile)) load_textdomain('random-image-block', $moFile);
    }

    $random_image_widget_name = __('Random Image Widget', 'random-image-block');
    $random_image_widget_description = __('Displays a random gallery image.', 'random-image-block');
    $widget_ops = array('classname' => 'random_image_widget', 'description' => $random_image_widget_description );
    $this->WP_Widget('random_image_widget', $random_image_widget_name, $widget_ops);
  }  
  
  function widget($args, $instance) {
    extract($args);
    $riw_widget_title = empty($instance['widget_title']) ? '&nbsp;' : apply_filters('widget_title', $instance['widget_title']);
    $riw_center = empty($instance['center']) ? 'off' : apply_filters('center', $instance['center']);
    $riw_cat_id = empty($instance['gallery_category']) ? '&nbsp;' : apply_filters('gallery_category', $instance['gallery_category']);
    $riw_link_album = empty($instance['link_album']) ? 'off' : apply_filters('link_album', $instance['link_album']);
    $riw_display_album = empty($instance['display_album']) ? 'on' : apply_filters('display_album', $instance['display_album']);
    $riw_display_title = empty($instance['display_title']) ? 'off' : apply_filters('display_title', $instance['display_title']);
    $riw_display_caption = empty($instance['display_caption']) ? 'on' : apply_filters('display_caption', $instance['display_caption']);
    $riw_display_description = empty($instance['display_description']) ? 'off' : apply_filters('display_description', $instance['display_description']);
    global $wpdb;
    global $blog_id;

    if ($riw_widget_title == "&nbsp;") {
      $riw_widget_title = __('Random Image','random-image-block');
    }

    if ($riw_center == "on") {
      $riw_center_output = "align=center";
    } else {
      $riw_center_output = "";
    }

    $attachments = wp_cache_get( 'rib_attach', $blog_id ); 
    if ( false == $attachments ) {
      $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'numberposts' => -1,
        'post_status' => null
      );

      $attachments = get_posts($args);
      // Cache the content for 2 hours
      wp_cache_set( 'rib_attach', $attachments, $blog_id, 7200 );
    }

    shuffle( $attachments );
    if ($attachments) {
      foreach ($attachments as $attachment) {
	$albumid = 0;
        if ( $riw_cat_id !== "-1" ) {
          $albumid = $attachment->post_parent;
        } else {
          $albumid = $attachment->post_parent;
	  foreach((get_the_category($albumid)) as $category) { 
            $riw_cat_id = $category->cat_ID; 
          }

	}
        if (in_category($riw_cat_id, $albumid)) { 
          $imgid = $attachment->ID;
          $meta = wp_get_attachment_metadata($imgid);

          if ($riw_link_album == "on") {
            $riw_image_link = $albumid;
          } else {
            $riw_image_link = $imgid;
          }

          // construct the image
          echo "{$before_widget}{$before_title}$riw_widget_title{$after_title}";
          echo "<div class='random-image'>";
            if ( $riw_display_title == "on" ) { echo "<p class='random-image-title'><strong>$attachment->post_title</strong></p>"; }
            echo "<p class='random-image-img' $riw_center_output >";
            echo "<a href=".get_permalink( $riw_image_link )."  >";
            echo "<img width='".$meta['sizes']['thumbnail']['width']."' height='".$meta['sizes']['thumbnail']['height']."' src='".wp_get_attachment_thumb_url($imgid)."' alt='Random image: ".$attachment->post_title."' />";
            echo "</a></p>";
            if ( $riw_display_caption == "on" ) { echo "<p class='random-image-caption'><i>$attachment->post_excerpt</i></p>"; }
            if ( $riw_display_description == "on" ) { echo "<p class='random-image-description'>$attachment->post_content</p>"; }
            if ( $riw_display_album == "on" ) { echo "<p class='random-image-album'><small>".__('Album:','random-image-block')." <a href=".get_permalink( $albumid ).">".get_the_title($albumid)."</a></small></p>"; }
	    ?><p class='random-image-album'><small><?php echo get_the_term_list( $attachment->ID, 'people', 'Who: ', ', ', '<br />' ); ?></small></p><?php
	    ?><p class='random-image-album'><small><?php echo get_the_term_list( $albumid, 'events', 'Event: ', ', ', '<br />' ); ?></small></p><?php
	    ?><p class='random-image-album'><small><?php echo get_the_term_list( $albumid, 'places', 'Where: ', ', ', '<br />' ); ?></small></p><?php
          echo "</div>";
          echo $after_widget;
          break;
	}
      }
    }
  }
  
  function update($new_instance, $old_instance) {
    if ( !current_user_can('edit_theme_options') ) die(__('You cannot edit this screen.', 'random-image-block'));
    $instance = $old_instance;
    $instance['widget_title'] = strip_tags($new_instance['widget_title']);
    $instance['gallery_category'] = strip_tags($new_instance['gallery_category']);
    $instance['center'] = strip_tags(empty($new_instance['center']) ? 'off' : apply_filters('center', $new_instance['center']));
    $instance['show_advanced'] = strip_tags(empty($new_instance['show_advanced']) ? 'off' : apply_filters('show_advanced', $new_instance['show_advanced']));
    $instance['link_album'] = strip_tags(empty($new_instance['link_album']) ? 'off' : apply_filters('link_album', $new_instance['link_album']));
    $instance['display_album'] = strip_tags(empty($new_instance['display_album']) ? 'off' : apply_filters('display_album', $new_instance['display_album']));
    $instance['display_title'] = strip_tags(empty($new_instance['display_title']) ? 'off' : apply_filters('display_title', $new_instance['display_title']));
    $instance['display_caption'] = strip_tags(empty($new_instance['display_caption']) ? 'off' : apply_filters('display_caption', $new_instance['display_caption']));
    $instance['display_description'] = strip_tags(empty($new_instance['display_description']) ? 'off' : apply_filters('display_description', $new_instance['display_description']));
    return $instance;
  }
  
  function form($instance) {

    $riw_widget_title = strip_tags($instance['widget_title']);
    $riw_center = $instance['center'];
    $riw_show_advanced = empty($instance['show_advanced']) ? 'off' : apply_filters('show_advanced', $instance['show_advanced']);
    $riw_link_album = $instance['link_album'];
    $riw_cat_id = strip_tags($instance['gallery_category']);
    $riw_display_album = empty($instance['display_album']) ? 'on' : apply_filters('display_album', $instance['display_album']);
    $riw_display_title = $instance['display_title'];
    $riw_display_caption = empty($instance['display_caption']) ? 'on' : apply_filters('display_caption', $instance['display_caption']);
    $riw_display_description = $instance['display_description'];
    ?><p><label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e('Widget Title', 'random-image-block')?>:<input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo esc_attr($riw_widget_title); ?>" /></label></p>

    <p><input class="checkbox" type="checkbox" <?php if ("$riw_center" == "on" ){echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('center'); ?>" name="<?php echo $this->get_field_name('center'); ?>" />
    <label for="<?php echo $this->get_field_id('center'); ?>"><?php _e('Center the Image?', 'random-image-block')?></label></p>

    <p><label for="<?php echo $this->get_field_id('gallery_category'); ?>"><?php _e('Select a Post Category to display images from, or All Categories to disable filtering', 'random-image-block')?>:<br />
    <?php wp_dropdown_categories( array( 'name' => $this->get_field_name("gallery_category"), 'hide_empty' => 0, 'hierarchical' => 1, 'selected' =>  $instance["gallery_category"], 'show_option_none' => __('All Categories') ) ); ?>
    </label></p>

    <p><input class="checkbox" type="checkbox" <?php if ("$riw_show_advanced" == "on" ){echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('show_advanced'); ?>" name="<?php echo $this->get_field_name('show_advanced'); ?>" />
    <label for="<?php echo $this->get_field_id('show_advanced'); ?>"><?php _e('Show Advanced Options', 'random-image-block')?></label></p>

    <?php if ( $riw_show_advanced == "on" ) {
      ?><div style='border-width: 1px;
border-color: #DFDFDF;
border-bottom-left-radius: 6px 6px;
border-bottom-right-radius: 6px 6px;
border-style: solid;
border-width: 1px;
border-top-left-radius: 6px 6px;
border-top-right-radius: 6px 6px;
padding: 0 10px;
line-height: 10px;
'><br /><?php
    } else {
      ?><div style="display: none; " id="riw-advanced-options" ><?php
    } ?>

    <p><strong><?php _e('Album Options:', 'random-image-block') ?></strong></p>
    <p style="line-height: 6px;"><input class="checkbox" type="checkbox" <?php if ("$riw_link_album" == "on" ){echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('link_album'); ?>" name="<?php echo $this->get_field_name('link_album'); ?>" />
    <label for="<?php echo $this->get_field_id('link_album'); ?>"><?php _e('Link to the Album not Image?', 'random-image-block')?></label></p>

    <p><input class="checkbox" type="checkbox" <?php if ("$riw_display_album" == "on" ){echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('display_album'); ?>" name="<?php echo $this->get_field_name('display_album'); ?>" />
    <label for="<?php echo $this->get_field_id('display_album'); ?>"><?php _e('Display name of Album?', 'random-image-block')?></label></p>

    <p><strong><?php _e('Meta Data to Display:', 'random-image-block') ?></strong></p>
    <p><input class="checkbox" type="checkbox" <?php if ("$riw_display_title" == "on" ){echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('display_title'); ?>" name="<?php echo $this->get_field_name('display_title'); ?>" />
    <label for="<?php echo $this->get_field_id('display_title'); ?>"><?php _e('Show the Images Title?', 'random-image-block')?></label></p>

    <p><input class="checkbox" type="checkbox" <?php if ("$riw_display_caption" == "on" ){echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('display_caption'); ?>" name="<?php echo $this->get_field_name('display_caption'); ?>" />
    <label for="<?php echo $this->get_field_id('display_caption'); ?>"><?php _e('Show the Images Caption?', 'random-image-block')?></label</p>

    <p><input class="checkbox" type="checkbox" <?php if ("$riw_display_description" == "on" ){echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('display_description'); ?>" name="<?php echo $this->get_field_name('display_description'); ?>" />
    <label for="<?php echo $this->get_field_id('display_description'); ?>"><?php _e('Show Images Description?', 'random-image-block')?></label></p>

    </div>
    <?php 
  }
}

/**
 * Random Image Widget INIT
 *
 * This is the main INIT function for the Random Image Block Widget
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Random Image Block
 */
function random_image_widget_init() {
        register_widget('random_image_widget');
}
add_action('widgets_init', 'random_image_widget_init');

?>
