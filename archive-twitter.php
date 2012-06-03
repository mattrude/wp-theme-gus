<?php get_header(); ?>

<div id="content">
  <?php if (have_posts()) : ?>
    <!--This is "The Loop"-->
    <?php query_posts( 'posts_per_page=20&post_type=twitter' ); ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="post" id="tweet_template-<?php echo $post->ID; ?>">
        <div id='tweet-<?php echo $post->ID; ?>' class='tweet_post' >
          <div class='twitter-avatar'>
	    <img src="<?php milly_twitter_image_url(); ?>" class="tweet-image" width="60" height="60" style="margin-right: 5px;" ></div>
          <?php the_content(); ?>
        </div><!--close tweet id-->
        <?php milly_twitter_byline(); ?>
      </div><!--close post id-->
    <?php endwhile; ?>
    <!--The Loop has ended-->	
    <?php milly_pre_next_post_cat(); ?>
  <?php endif; ?>
</div><!--close content id-->

<?php get_footer(); ?>
