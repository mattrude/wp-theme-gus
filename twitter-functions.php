<?php
//This plugin will create a custom post-type 

// Add Custom Post Types for WordPress 2.9
register_post_type('twitter', array(
    'labels' => array(
        'name' => __('Twitter'),
        'singular_name' => _x('Tweet','Tweet'),
        'add_new' => __('Add New Tweet', 'tweet'),
        'add_new_item' => __('Add New Tweet'),
        'edit_item' => __('Edit Tweet'),
        'new_item' => __('New Tweet'),
        'view_item' => __('View Tweet'),
        'search_items' => __('Search Tweets'),
        'not_found' =>  __('No tweets found'),
        'not_found_in_trash' => __('No tweets found in Trash')
    ),
    'description' => __('Imported Twitter Posts'),
    'exclude_from_search' => true,
    'public' => true,
    'has_archive' => true,
    'show_ui' => true,
    'hierarchical' => false,
    'rewrite' => array('slug' => 'twitter'),
    'supports' => array('title', 'editor'),
    'feed' => true,
    'register_meta_box_cb' => 'twitter_save_metabox'
));
  
// Twitter Posts Meta Data
add_action('admin_menu', 'twitter_add_metabox');
add_action('save_post', 'twitter_save_metabox');

function twitter_add_metabox() {
  add_meta_box('twitter-id', __('Tweets Meta Data'), 'twitter_metabox', 'twitter', 'side');
}

function twitter_metabox() {
  echo '<input type="hidden" name="twitter_id_metabox" id="twitter_id_metabox" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

  // The actual fields for data entry
  global $post;
  $post_id_var = get_post_meta($post->ID, 'ozh_ta_id', true);
  echo '<input type="text" name="ozh_ta_id" value="' . $post_id_var . '" size="25" />';
  echo '<label for="ozh_ta_id">' . __(" Tweet Post ID") . '</label><br />';
}

function twitter_save_metabox() {
  global $post;
  $post_id = $post->ID;
  $post_id_var = $_POST['ozh_ta_id'];
  
  if(get_post_meta($post_id, 'ozh_ta_id') != "") 
    add_post_meta($post_id, 'ozh_ta_id', $post_id_var, true);
  elseif($post_id_var != get_post_meta($post_id, 'ozh_ta_id', true))
    update_post_meta($post_id, 'ozh_ta_id', $post_id_var); 
  elseif($post_id_var == "")
    delete_post_meta($post_id, 'ozh_ta_id');  

}

function milly_twitter_image_url() {
    $twitter_image_url = wp_cache_get( 'twitter_image_url', 't' );
    if ( false == $twitter_image_url ) {
      global $ozh_ta;
      $twitterid = $ozh_ta['screen_name'];
      $xml = simplexml_load_file("http://twitter.com/users/".$twitterid.".xml");
      $twitter_image_url = (string)$xml->profile_image_url;
      wp_cache_set( 'twitter_image_url', $twitter_image_url, 't', 86400 );
    }
    echo $twitter_image_url;
}

function milly_twitter_byline() { ?>
<div id='tweet_date-<?php echo $post->ID; ?>' class='byline tweet_date' >
      <?php
      global $post;
      global $ozh_ta;
      $post_id = $post->ID;
      $tweet_id = get_post_meta( $post_id, 'ozh_ta_id', true);
      $tweet_user = $ozh_ta['screen_name'];
      echo "<p>Posted to ";
      if ($tweet_id) {
        echo "<a href='http://twitter.com/$tweet_user/status/$tweet_id'>";
      } else {
        echo "<a href='http://twitter.com'>";
      }
      _e('Twitter');
      echo "</a> "; 
      _e(' on '); ?>
        <a href="<?php the_permalink(); ?>"><?php the_time('F jS, h:ma T Y '); ?></a><?php
      edit_post_link('Edit', ' | ');
      ?>
    </div><?php
}

?>
