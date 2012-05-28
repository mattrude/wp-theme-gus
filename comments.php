<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) {
  echo 'This post is password protected. Enter the password to view comments.';
  return;
}

/* This variable is for alternating comment background */
$oddcomment = 'alt'; ?>

<?php //count comments, trackbacks, and pingbacks
if($comments) {
  $trackping_count = 0; $comment_count = 0;
  foreach($comments as $comment) {
    $comment_type = get_comment_type();
    if($comment_type == 'comment') {
      $comment_count++;
    }else{
      $trackping_count++;
    }
  }
}
?>

<?php if (have_comments($comment_type = 'comment')) : ?>
  <div id="comments" class="post">			
    <h2 class="comment-title"><?php echo $comment_count . " Comments"; ?></h2>
  </div>
  <div id="comments">			
    <ol class="comment-list">
      <?php wp_list_comments('avatar_size=50&style=ol&type=comment'); ?>
    </ol>
  </div>

<?php else : // this is displayed if there are no comments so far ?>
  <?php if ('open' == $post->comment_status) : ?>
    <!-- If comments are open, but there are no comments. -->
  <?php else : // comments are closed ?>
    <!-- If comments are closed. -->
    <p class="nocomments"></p>
  <?php endif; ?>
<?php endif; ?>

<?php paginate_comments_links(); ?>

<?php if ('open' == $post->comment_status) : ?>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
  <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
  <div id="respond">
    <h2 class='comment-title'><?php comment_form_title( 'Leave a Comment', 'Reply to %s' ); ?></h2>
    <div id="cancel-comment-reply">
    <small><?php cancel_comment_reply_link() ?></small>
  </div>
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
  <?php if ( $user_ID ) : ?>
    <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> | <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a></p>
    <textarea id="comment" tabindex="4" cols="20" rows="10" onfocus="if ( value == 'Your comment please...' ) { this.value='' }" name="comment">Your comment please...</textarea>

    <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

<?php else : ?>

  <div id="comment-user-details" class="comment-left">
  <?php do_action('alt_comment_login'); ?>
  <input id="author" type="text" onblur="if ( value == '' ) { this.value='Your name (Required)' }" onfocus="if ( value == 'Your name (Required)' ) { this.value='' }" tabindex="1" size="22" value="Your name (Required)" name="author"/>
  <input id="email" type="text" onblur="if ( value == '' ) { this.value='Your email (Required)' }" onfocus="if ( value == 'Your email (Required)' ) { this.value='' }" tabindex="2" size="22" value="Your email (Required)" name="email"/>
  <input id="url" type="text" tabindex="3" size="22" value="http://" name="url"/>
  <div class="comment-submit">
    <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
  </div>
</div>
<div class="comment-right">
  <textarea id="comment" tabindex="4" cols="20" rows="9" onfocus="if ( value == 'Your comment...' ) { this.value='' }" name="comment">Your comment...</textarea>
</div>
<?php endif; ?>

<?php do_action('comment_form', $post->ID); ?>
<?php comment_id_fields(); ?>
</form>
</div><!-- close respond id -->

<!-- Display trackbacks/pingbacks at bottom of post
	If you do not want trackbacks/pingbacks visible, delete this section -->
<?php if($comments && ($trackping_count != 0)) : ?>
<div id="trackback">
  <div class="trackback">
    <h2 id="trackbacks" class="comment-title"><?php echo $trackping_count; ?> Trackbacks / Pingbacks</h2>
    <ul class="trackback-list">
      <?php foreach ($comments as $comment) :
        $comment_type = get_comment_type();
        if($comment_type != 'comment') {
         ?><li><?php comment_author_link() ?></li><?php
        }
      endforeach; ?>
    </ol>
  </div>
</div>
<?php endif; ?>
<!--End of trackbacks / pingbacks section -->

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
