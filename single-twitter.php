<?php get_header(); ?>

<div id='content'>
  <?php $pageposts = $wpdb->get_results($querystr, OBJECT); ?>
  <?php setup_postdata($post); ?>
  <?php global $post; ?>
  <div class="post" id="tweet_template-<?php echo $post->ID; ?>">
    <div id='tweet-<?php echo $post->ID; ?>' class='tweet_post' >
      <div class='twitter-avatar'>
        <img src="<?php milly_twitter_image_url(); ?>" class="tweet-image" width="60" height="60" style="margin-right: 5px;" >
      </div>
      <?php the_content(); ?>
    </div>
    <?php milly_twitter_byline(); ?>
  </div><!--close post class-->
  <?php milly_pre_next_post(); ?>
</div><!--close content class-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
