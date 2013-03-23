<?php
/**
 * Plugin Feed Footer
 *
 * Adds a link back to the origninal page on all RSS & ATOM feeds.  This does not affect your normal posts & pages.
 * 
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Feed Footer
 * @since 0.2
 */

/**
 * Filter to added content to the bottom of rss feeds
 *
 * @param string $content The content of the page/post in the rrs feed.
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Feed Footer
 * @since 0.2
 */ 
function mdr_postrss($content) {
    if(is_feed()){
        $site_name = get_bloginfo_rss('name');
        $post_title = get_the_title_rss();
        $home_url = home_url('/');
        $post_url = post_permalink();
        $content = $content.'<a href="'.$post_url.'">'.$post_title.'</a> is a post from; <a href="'.$home_url.'">'.$site_name.'</a> which is not allowed to be copied on other sites.';
    }
    return $content;
}
add_filter('the_excerpt_rss', 'mdr_postrss');
add_filter('the_content', 'mdr_postrss');

?>
