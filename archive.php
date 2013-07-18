<?php
/**
 * The default Archive template
 */
get_header(); ?>
		<div id=main role=main>
	    	<div id=page class=content>
				<div id=home>
					<?php if (have_posts()) :
                        if ( is_day() ) {
						    printf( __( 'Daily Archives: %s', 'twentyeleven' ), '<span>' . get_the_date() . '</span>' );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyeleven' ) ) . '</span>' );
						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentyeleven' ) ) . '</span>' );
                        } elseif ( is_category() ) {
                            echo "<h3 style=padding-top:0.75em>Posts in the category: ";
                            echo single_cat_title();
                            echo "</h3>";
                            echo category_description();
                        } elseif ( is_post_type_archive('flight') ) {
                            $page_id = 6507;
                            $page_object = get_page( $page_id );
                            echo "<h2>$page_object->post_title</h2>";
                            echo $page_object->post_content;
						    echo "<h3 style=padding-top:0.75em>Flight Post Archives</a></h3>";
						} else {
							 _e( 'Blog Archives', 'twentyeleven' );
						    echo "<h3 style=padding-top:0.75em>Archive Posts</a></h3>";
						} ?>

						<ul class=posts>
                            <?php $home_gallery_id = get_option('gus_gallery_cat');
                            if ( is_category($home_gallery_id) ) {
                                while (have_posts()) : the_post();
                                    get_template_part( 'content', 'galleryindex' );
                                endwhile;
                            } else {
							    while (have_posts()) : the_post(); ?>
								    <li>
                                        <?php $format = get_post_format(); ?>
                                        <span class="icon-type-<?php echo $format; ?>"></span>
									    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				    					<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_date('Y M d'); ?></time>
					    			</li>
						    	<?php endwhile;
                            } ?>
						</ul>
					<?php endif; ?>
					<?php gus_content_nav( 'nav-below' ); ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>
