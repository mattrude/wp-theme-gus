<?php

/*
Plugin Name: Feed Footer
Plugin URI: http://github.com/mattrude/mdr-network
Description: Adds a link back to the origninal page on all RSS & ATOM feeds.  This does not affect your normal posts & pages.
Version: 1.0
Author: Matt Rude
Author URI: http://mattrude.com

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
