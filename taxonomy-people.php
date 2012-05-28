<?php get_header();
global $blog_id;
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$person_name = $term->name;
$person_slug = $term->slug;
if ( $term->description == "" ) {
	  $person_description = $term->name;

} else {
	  $person_description = $term->description;
} ?>
<div id=main role=main>
   	<div id=page class=content>
		<div id=home>
			<?php if (have_posts()) : ?>
				<h3 style=padding-top:0.75em>Posts about <?php echo $person_description; ?>:</h3>
				<ul class=posts>
					<!--Starting "The Loop"-->
					<?php while (have_posts()) : the_post(); ?>
						<li>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							<time datetime="<?php the_date('M d y'); ?>" pubdate="pubdate"><?php the_date('Y-m-d'); ?></time>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif;
			$attachments = wp_cache_get( "people_tax_$person_slug" );
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
						'terms' => $person_slug
					))
				); 
				$attachments = get_posts( $args );
				wp_cache_set( "people_tax_$person_slug", $attachments, $blog_id, 86400 );
			}
			if ($attachments) { ?>
				<br />
				<h3 style=padding-top:0.75em>Pictures of <?php echo $person_description; ?>:</h3>
				<div class="post"><center><?php
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
