<?php get_header();

global $blog_id; 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$tax = $term->taxonomy;
$term_name = $term->name;
$term_slug = $term->slug;
$gallery_id = get_option('gus_gallery_cat'); ?>

<div id=main role=main>
   	<div id=page class='content index taxonomy-index taxonomy-<?php echo $term_name ?>'>
		<div id=home>
			<?php  $attachments = wp_cache_get( "people_tax_$term_slug" );
            if ( false == $attachments ) {
                $args = array(
                    'post_type' => 'attachment',
                    'numberposts' => -1,
                    'post_status' => null,
                    'post_parent' => null,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'tax_query' => array( array(
                        'taxonomy' => $tax,
                        'field' => 'slug',
                        'terms' => $term_slug
                    ) )
                );
                $attachments = get_posts( $args );
                wp_cache_set( "people_tax_$term_slug", $attachments, $blog_id, 86400 );
            }
            if ($attachments) { ?>
                <?php if ( is_tax( 'people' ) ) {
                    if ( $term->description != "" ) { $term_name = $term->description; }
                    echo "<h1>Pictures with $term_name in them:</h1>";
                } elseif ( is_tax( 'events' ) ) {
                    echo "<h1>Pictures from: $term->name</h1>";
                    echo "<p>$term->description</p>";
                } elseif ( is_tax( 'places' ) ) {
                    echo "<h1>Pictures at: $term->name</h1>";
                    echo "<p>$term->description</p>";
                } elseif ( is_tax() ) {
                    echo "<h1>Galleries of the type: $term->name</h1>";
                    echo "<p>$term->description</p>";
                } ?>

                <div class="post taxonomy-index-gallery"><center><?php
                foreach ( $attachments as $attachment ) {
                    setup_postdata($attachment);
                    the_attachment_link($attachment->ID, false, null, 1);
                    the_excerpt();
                } ?>
                </center></div>
                <br />
                <hr>
            <?php }

            global $wp_query;
            $args = array_merge( $wp_query->query_vars, array( 'cat' => $gallery_id ) );
            query_posts( $args );
            if (have_posts()) :
                if ( is_tax( 'people' ) ) {
                    if ( $term->description != "" ) { $term_name = $term->description; }
				    echo "<h1>Galleries with $term_name in them:</h1>";
                } elseif ( is_tax( 'events' ) ) {
                    echo "<h1>Galleries from: $term->name</h1>";
                    echo "<p>$term->description</p>";
                } elseif ( is_tax( 'places' ) ) {
                    echo "<h1>Galleries at: $term->name</h1>";
#                    echo "<p>$term->description</p>";
                } elseif ( is_tax() ) {
                    echo "<h1>Galleries of the type: $term->name</h1>";
                    echo "<p>$term->description</p>";
                } ?>
				<ul class=posts>
					<?php while (have_posts()) : the_post();
                        get_template_part( 'content', 'galleryindex' );
					endwhile; ?>
				</ul>
			<?php endif;

            global $wp_query;
            $args = array_merge( $wp_query->query_vars, array( 'cat' => "-$gallery_id" ) );
            query_posts( $args );
            if (have_posts()) :
                if ( is_tax( 'people' ) ) {
                    if ( $term->description != "" ) { $term_name = $term->description; }
                    echo "<h1>Posts about $term_name:</h1>";
                } elseif ( is_tax( 'events' ) ) {
                    echo "<h1>Posts from: $term->name</h1>";
                    echo "<p>$term->description</p>";
                } elseif ( is_tax( 'places' ) ) {
                    echo "<h1>Posts at: $term->name</h1>";
                    echo "<p>$term->description</p>";
                } elseif ( is_tax() ) {
                    echo "<h1>Posts of the type: $term->name</h1>";
                    echo "<p>$term->description</p>";
                } ?>
                <ul class=posts>
                    <?php while (have_posts()) : the_post();
                        $format = get_post_format(); ?>
                        <li>
                            <span class="icon-type-<?php echo $format; ?>"></span>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            <time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_date('Y M d'); ?></time>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
