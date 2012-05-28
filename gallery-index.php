<div id="gallerypost-<?php the_ID(); ?>" class="gallerypost post">
    <div id="gallerypost_main-<?php the_ID(); ?>" class="gallerypost_main">
	<div id="gallerypost_thumbnail-<?php the_ID(); ?>" class="gallerypost_thumbnail">
		<a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
	</div>
	<div id="gallerypost_body-<?php the_ID(); ?>" class="gallerypost_body">
		<?php $images =& get_children( 'post_type=attachment&post_mime_type=image' ); ?>
		<h1 class="single-title entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<div class="byline">
		        <span class="byline-prep byline-prep-author text">Album created by </span>
		        <span class="author"><?php the_author(); ?></span>
		        <span class="byline-prep byline-prep-author text"> on </span>
		        <span class="published updated"><?php the_time('F jS, Y') ?></span>
			<span class="byline-prep byline-prep-author text"> <?php edit_post_link('Edit', ' | '); ?> </span>
		</div>
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
	</div>
    </div>
    <div id="gallerypost_sub-<?php the_ID(); ?>" class="gallerypost_sub">
	<div id="gallerypost_sub_left-<?php the_ID(); ?>" class="gallerypost_sub_left">
		<p><?php echo get_the_term_list( $post->ID, 'people', 'Who: ', ', ', '<br />' ); ?></p>
		<p><?php echo get_the_term_list( $post->ID, 'events', 'What: ', ', ', '<br />' ); ?></p>
             	<p><?php echo get_the_term_list( $post->ID, 'places', 'Where: ', ', ', '' ); ?></p>
	</div>
        <?php $num_gallery_posts = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_type = 'attachment'" );
        if ( $num_gallery_posts > 1 ) {
	  ?><div id="gallerypost_sub_right-<?php the_ID(); ?>" class="gallerypost_sub_right">
	    <small>This Album contains <?php echo $num_gallery_posts; ?> items.</small>
	  </div>
        <?php } ?>
    </div>
</div>
