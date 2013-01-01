<?php get_header();
global $blog_id; 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_name = $term->name;
$term_slug = $term->slug;
?>
<div id=main role=main>
   	<div id=page class="content index taxonomy-people">
		<div id=home>
			<?php if (have_posts()) :
                if ( is_tax( 'people' ) ) {
                    if ( $term->description != "" ) {
                        $term_name = $term->description;
                    }
				    echo "<h3 style=padding-top:0.75em>Posts about $term_name:</h3>";
                } elseif ( is_tax( 'events' ) ) {
                    echo "<h3 style=padding-top:0.75em>Posts from: $term->name</h3>";
                    echo "<p>$term->description</p>";
                } elseif ( is_tax( 'places' ) ) {
                    echo "<h3 style=padding-top:0.75em>Posts at: $term->name</h3>";
                    echo "<p>$term->description</p>";
                } elseif ( is_tax() ) {
                    echo "<h3 style=padding-top:0.75em>Posts of the type: $term->name</h3>";
                    echo "<p>$term->description</p>";
                } ?>
				<ul class=posts>
					<!--Starting "The Loop"-->
					<?php while (have_posts()) : the_post(); ?>
						<li>
                            <?php $format = get_post_format(); ?>
                            <span class="icon-type-<?php echo $format; ?>"></span>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_date('Y M d'); ?></time>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif;
			$attachments = wp_cache_get( "people_tax_$term_slug" );
			if ( false == $attachments ) {
			    $args = array( 
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => null,
		    		'orderby' => 'post_date',
    				'order' => 'DESC',
					'tax_query'=>array(array(
						'taxonomy' => 'people',
						'field' => 'slug',
						'terms' => $term_slug
					))
				); 
				$attachments = get_posts( $args );
				wp_cache_set( "people_tax_$term_slug", $attachments, $blog_id, 86400 );
			}
			if ($attachments) { ?>
				<br />
				<h3 style=padding-top:0.75em>Pictures of <?php echo $term_name; ?>:</h3>
				<div class="post taxonomy-people-gallery"><center><?php
				foreach ( $attachments as $attachment ) {
					setup_postdata($attachment);
					the_attachment_link($attachment->ID, false, null, 1);
					the_excerpt();
				} ?>
				</center></div>
			<?php } ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
