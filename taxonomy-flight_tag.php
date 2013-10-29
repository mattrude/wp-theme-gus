<?php
/**
 * The default taxonomy template
 */
get_header();

global $blog_id; 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<div id=main role=main>
   <div id=page class='content index taxonomy-index taxonomy-<?php echo $term->name ?>'>
        <div id=home><?php
            global $wp_query;
            if (have_posts()) {
	    	echo "<h1>Flight posts tagged as $term->name:</h1>"; ?>
		    <?php while (have_posts()) : the_post(); ?>
		    <ul class="posts">
                    	<li>
                	    <?php $format = get_post_format(); ?>
                            <span class="icon-type-<?php echo $format; ?>"></span>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            <time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_date('Y M d'); ?></time>
                        </li>
		    </ul>
		    <?php endwhile; ?>
	    <?php } ?>
	</div>
    </div>
</div>
<?php get_footer(); ?>
