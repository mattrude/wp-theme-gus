<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1 itemprop=name><?php single_post_title(); ?></h1>
	<p class="byline">
		By <a href="/" rel="author" itemprop="author"><?php the_author_meta( 'display_name' ) ?></a>
		on <b itemprop="datePublished" datetime="<?php the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></b>
	</p>
	<?php the_content(); ?>
	<hr>
</article><!-- #post-<?php the_ID(); ?> -->
