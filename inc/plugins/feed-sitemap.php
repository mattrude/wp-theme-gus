<?php
/**
 * XML Sitemap Feed Template for displaying XML Sitemap Posts feed.
 */

//header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

        <!-- Main Site -->

        <url>
                <loc><?php bloginfo_rss('url') ?></loc>
                <lastmod><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT'), false); ?></lastmod>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
        </url>

        <!-- Site Pages -->

<?php
        $args = array(
                'post_type' => 'page',
                'numberposts' => 100,
                'status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
        );
        $post_ids = get_posts($args);

        if ($post_ids) {
                foreach ($post_ids as $post) { ?>
        <url>
                <loc><?php the_permalink_rss() ?></loc>
                <lastmod><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_post_modified_time('Y-m-d H:i:s', true), false); ?></lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.7</priority>
        </url>
<?php
 } }
?>

        <!-- Site Posts -->

<?php
        $args = array(
                'post_type' => 'post',
                'numberposts' => 100,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC'
        );
        $post_ids = get_posts($args);

        if ($post_ids) {
                foreach ($post_ids as $post) { ?>
        <url>
                <loc><?php the_permalink_rss() ?></loc>
                <lastmod><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_post_modified_time('Y-m-d H:i:s', true), false); ?></lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.5</priority>
<?php
        $args2 = array(
                'post_type' => 'attachment',
                'numberposts' => 200,
                'post_parent' => $post->ID,
                'post_mime_type' => 'image',
                'orderby' => 'date',
                'order' => 'DESC'
        );
        $images = get_posts($args2);
        if ($images) {
                foreach ($images as $post) { ?>
                <image:image>
                        <image:loc><?php echo wp_get_attachment_url(); ?></image:loc>
<?php if ( !empty($post->post_excerpt) ) echo '                 <image:caption>' . esc_html($post->post_excerpt, 1) . '</image:caption>
'; ?>
                        <image:title><?php echo esc_html($post->post_title, 1) ?></image:title>
                </image:image>
<?php } } ?>
        </url>
<?php
                }
        }
?>
</urlset>
