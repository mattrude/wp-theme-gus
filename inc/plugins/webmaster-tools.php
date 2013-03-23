<?php

/*
Plugin Name: MDR Webmaster Tools
Plugin URI: https://github.com/mattrude/wp-plugin-webmaster-tools
Description: Provides Webmaster site verification scripts for Google, Yahoo, & Bing. Plugin also provides Google Analytics Tracking Script for registered sites. See Tools -> Webmaster Tools
Version: 1.1
Author: Matt Rude
Author URI: http://mattrude.com
*/

define( 'WEBMASTER_TOOLS_TEXTDOMAIN' , 'mdr-network');

$currentLocale = get_locale();
if(!empty($currentLocale)) {
   $moFile = dirname(__FILE__) .  $currentLocale . ".mo";
   if(@file_exists($moFile) && is_readable($moFile)) load_textdomain('mdr-network', $moFile);
}

/**
 * Webmaster Tools INIT
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Webmaster Tools
 */
function add_mdr_webmaster_tools() {
   global $mdr_webmaster_tools_hook;
   $mdr_webmaster_tools_hook = add_submenu_page( 'tools.php', 'Site Verification Sittings', __('Webmaster Tools', WEBMASTER_TOOLS_TEXTDOMAIN), 'administrator', 'site_webmaster_tools', 'mdr_webmaster_tools_page' );
   //add_action( 'load-' . $mdr_webmaster_tools_hook, 'webmastertools_help_overview' );
   add_action( 'load-' . $mdr_webmaster_tools_hook, 'webmastertools_help_tools' );
   add_action( 'load-' . $mdr_webmaster_tools_hook, 'webmastertools_help_analytics' );
   add_action( 'load-' . $mdr_webmaster_tools_hook, 'webmastertools_help_robots' );
}


/**
 * Register needed options
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Webmaster Tools
 */
function register_mdr_webmaster_tools() {
  add_option('site_verification_google_id');
  add_option('site_verification_yahoo_id');
  add_option('site_verification_bing_id');
  add_option('site_robots_txt');
  add_option('cdntools_baseuri');
  add_default_robots_txt();
}


/**
 * Adding the Help fucntions
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Webmaster Tools
 */
function webmastertools_help_overview() {
    $screen = get_current_screen();
    $screen->add_help_tab( array(
        'id'      => 'webmastertools-plugin-help-overview', // This should be unique for the screen.
        'title'   => __('Overview', WEBMASTER_TOOLS_TEXTDOMAIN),
        'content' => ''
    ) );
}

/**
 * Top Help section
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Webmaster Tools
 */
function webmastertools_help_tools() {
    $screen = get_current_screen();
    $screen->add_help_tab( array(
        'id'      => 'webmastertools-plugin-help-tools', // This should be unique for the screen.
        'title'   => __('Webmaster Tools', WEBMASTER_TOOLS_TEXTDOMAIN),
        'content' => '<h3>'.__('Webmaster Tools', WEBMASTER_TOOLS_TEXTDOMAIN).'</h3>
<p>'.__('Here\'s how you optain and setup each search engines key\'s', WEBMASTER_TOOLS_TEXTDOMAIN).':</p>
<h4>' . __('Google Webmaster Tools', WEBMASTER_TOOLS_TEXTDOMAIN) . '</h4> 
<ol> 
<li>'.__('Log in to ', WEBMASTER_TOOLS_TEXTDOMAIN).'<a href="https://www.google.com/webmasters/tools/">https://www.google.com/webmasters/tools/</a> '.__('with your Google account.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Enter your blog URL and click <code>Add Site</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('You will be presented with several verification methods. Choose <code>Meta Tag</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Copy the meta tag, which looks something like', WEBMASTER_TOOLS_TEXTDOMAIN).':<br /> 
<code>&lt;meta name="google-site-verification"  content="dBw5CvburAxi537Rp9qi5uG2174Vb6JwHwIRwPSLIK8"&gt;</code></li> 
<li>'.__('Leave the verification page open and go to your blog dashboard.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Open the Tools Page and paste the code in the appropriate field.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Click on <code>Save Changes</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Go back to the verification page and click <code>Verify</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
</ol> 

<h4>'.__('Yahoo Site Explorer', WEBMASTER_TOOLS_TEXTDOMAIN).'</h4> 
<ol> 
<li>'.__('Log in to', WEBMASTER_TOOLS_TEXTDOMAIN).' <a href="https://siteexplorer.search.yahoo.com/">https://siteexplorer.search.yahoo.com/</a> '.__('with your Yahoo account.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Enter your blog URL and click <code>Add My Site</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('You will be presented with several authentication methods. Choose <code>By adding a META tag to my home page.</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Copy the meta tag, which looks something like', WEBMASTER_TOOLS_TEXTDOMAIN).'<br /> 
<code>&lt;meta name="y_key" content="3236dee82aabe064"&gt;</code></li> 
<li>'.__('Leave the verification page open and go to your blog dashboard.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Open the Tools Page and paste the code in the appropriate field.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Click on <code>Save Changes</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li>
<li>'.__('Go back to the verification page and click <code>Ready to Authenticate</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
</ol> 
<p><i>'.__('Note: It may take up to 24 hours for your site to be authenticated.', WEBMASTER_TOOLS_TEXTDOMAIN).'</i></p> 

<h4>'.__('Bing Webmaster Center', WEBMASTER_TOOLS_TEXTDOMAIN).'</h4> 
<ol> 
<li>'.__('Log in to', WEBMASTER_TOOLS_TEXTDOMAIN).' <a href="http://www.bing.com/webmaster">http://www.bing.com/webmaster</a> '.__('with your Live! account.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Click <code>Add a Site</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Enter your blog URL and click <code>Submit</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Copy the meta tag from the text area at the bottom. It looks something like', WEBMASTER_TOOLS_TEXTDOMAIN).'<br /> 
<code>&lt;meta name="msvalidate.01" content="12C1203B5086AECE94EB3A3D9830B2E"&gt;</code></li> 
<li>'.__('Leave the verification page open and go to your blog dashboard.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Open the Tools Page and paste the code in the appropriate field.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Click on <code>Save Changes</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
<li>'.__('Go back to the verification page and click <code>Return to the Site list</code>.', WEBMASTER_TOOLS_TEXTDOMAIN).'</li> 
</ol>'
    ) );
}

function webmastertools_help_analytics() {
    $screen = get_current_screen();
    $screen->add_help_tab( array(
        'id'      => 'webmastertools-plugin-help-analytics', // This should be unique for the screen.
        'title'   => __('Analytics', WEBMASTER_TOOLS_TEXTDOMAIN),
        'content' => '<h3>'.__('Google Analytics Tracking', WEBMASTER_TOOLS_TEXTDOMAIN).'</h3>
<p><b>Google Analytics</b> is a free service offered by Google that generates detailed statistics about the visitors to a website. The product is aimed at marketers as opposed to webmasters and technologists from which the industry of web analytics originally grew. It is the most widely used website statistics service, currently in use on around 57% of the 10,000 most popular websites. Another market share analysis claims that Google Analytics is used at around 49.95% of the top 1,000,000 websites (as currently ranked by Alexa).</p>'
    ) );
}

function webmastertools_help_robots() {
    $screen = get_current_screen();
    $screen->add_help_tab( array(
        'id'      => 'webmastertools-plugin-help-robots', // This should be unique for the screen.
        'title'   => __('Robots', WEBMASTER_TOOLS_TEXTDOMAIN),
        'content' => '<h3>'.__('The Robots.txt File', WEBMASTER_TOOLS_TEXTDOMAIN).'</h3>
<p>'.__('The <strong>robots.txt</strong> file is a way to prevent cooperating web spiders and other web robots from accessing all or part of a website which is otherwise publicly viewable. Robots are often used by search engines to categorize and archive web sites, or by webmasters to proofread source code.', WEBMASTER_TOOLS_TEXTDOMAIN).'</p>
<h4>'.__('To Allow all robots', WEBMASTER_TOOLS_TEXTDOMAIN).'</h4>
<p>'.__('To allow any robot to access your entire site, you can simply leave the robots.txt file blank, or you could use this', WEBMASTER_TOOLS_TEXTDOMAIN).':</p>
<blockquote><pre>User-agent: *<br />Disallow:</pre></blockquote>
<h4'.__('>To Ban all robots', WEBMASTER_TOOLS_TEXTDOMAIN).'</h4> 
<blockquote><pre>User-agent: *<br />Disallow: /</pre></blockquote>
<h4>'.__('To Ban all crawlers from four directories of a website', WEBMASTER_TOOLS_TEXTDOMAIN).'</h4> 
<blockquote><pre>User-agent: *<br />Disallow: /cgi-bin/<br />Disallow: /images/<br />Disallow: /tmp/<br />Disallow: /private/</pre></blockquote>'
    ) );
}

/*
 * Sitemap
 */
function sitemap_flush_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

add_action('init', 'sitemap_flush_rules');

function xml_feed_rewrite($wp_rewrite) {
    $feed_rules = array(
        '.*sitemap.xml$' => 'index.php?feed=sitemap'
    );

    $wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}

add_filter('generate_rewrite_rules', 'xml_feed_rewrite');


// Remove the trailing slash from URI sitemap.xml
function sitemap_no_trailing_slash( $redirect_url ) {
    if ( is_feed() && strpos( $redirect_url, 'sitemap.xml/' ) !== FALSE )
        return;

    return $redirect_url;
}

add_filter( 'redirect_canonical', 'sitemap_no_trailing_slash' );


function do_feed_sitemap() {
    $template_dir = dirname(__FILE__);
    load_template( $template_dir . '/feed-sitemap.php' );
}

add_action('do_feed_sitemap', 'do_feed_sitemap', 10, 1);

//add_action( 'contextual_help', 'my_plugin_help', 10, 3 );
add_action( 'admin_menu', 'add_mdr_webmaster_tools' );
add_action( 'admin_init', 'register_mdr_webmaster_tools' );
add_action( 'wp_head', 'head_mdr_webmaster_tools' );

function head_mdr_webmaster_tools() {
  $site_verification_google_id = get_option( 'site_verification_google_id' );
  $site_verification_yahoo_id = get_option( 'site_verification_yahoo_id' );
  $site_verification_bing_id = get_option( 'site_verification_bing_id' );
  $site_google_analytics_id = get_option( 'site_google_analytics_id' );

  echo "
    <!-- Start Website Verification scripts -->";
  if ( $site_verification_google_id != NULL ) {
    echo "
    <meta name='google-site-verification' content='$site_verification_google_id' />
    ";
  }

  if ( $site_verification_yahoo_id != NULL ) {
    echo "<meta name='y_key' content='$site_verification_yahoo_id'>
    "; 
  }

  if ( $site_verification_bing_id != NULL ) {
    echo "<meta name='msvalidate.01' content='$site_verification_bing_id'>
    ";
  }
  echo "<!-- End Website Verification scripts -->
    ";

    echo "<!-- Start Google Analytics tracking script -->
    ";
  if ( is_user_logged_in() ) {
    echo "<!-- User is logged in, so this request will NOT be tracked by Google Analytics -->
    ";
  } else {
      if ( $site_google_analytics_id != NULL ) { ?>
     <script type="text/javascript">
        
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', '<?php echo $site_google_analytics_id; ?>']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
          })();
           
        </script>
    <?php } else {
	echo "<!-- User is NOT logged in, but Google Analytics is not configured, so will not be displayed -->
    ";
	}
  }
    echo "<!-- End Google Analytics tracking script -->
   ";
}

/**
 * Add Default robots.txt file
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Webmaster Tools
 */
function add_default_robots_txt() {
	// Adds default robots.txt file
	$site_url = get_option('siteurl');
	$site_robots_txt_out = get_option('site_robots_txt');
	if (!$site_robots_txt_out) {
		$site_robots_txt_default = "# This is the default robots.txt file
User-agent: *
Disallow: */feed/
Disallow: */page/

Sitemap: $site_url/sitemap.xml";
		update_option('site_robots_txt', $site_robots_txt_default);
	}
}

$request = str_replace( get_bloginfo('url'), '', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] );
if ( (get_bloginfo('url').'/robots.txt' != 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) && ('/robots.txt' != $_SERVER['REQUEST_URI']) && ('robots.txt' != $_SERVER['REQUEST_URI']) )
  return;         // checking whether they're requesting robots.txt
  $blog_public = get_option('blog_public');
  if ( $blog_public == 1 ) {
    $site_robots_txt_out = get_option('site_robots_txt');
    if ( !$site_robots_txt_out) { return; }
    $site_url = 'http://' . $_SERVER['HTTP_HOST'];
    header('Content-type: text/plain');
    print $site_robots_txt_out;
    echo "
";
  } else {
    return;
  }
die;

/**
 * The Webmaster Tools Admin page
 *
 * @author Matt Rude <matt@mattrude.com>
 * @package Gus Theme
 * @subpackage Webmaster Tools
 */
function mdr_webmaster_tools_page() {

  // Update Settings
  if ( isset($_POST['submit']) ) {
    if (!current_user_can('manage_options')) die(__('You cannot edit this screen.', WEBMASTER_TOOLS_TEXTDOMAIN));
    update_option( 'site_verification_google_id', $_POST['site_verification_google_id'] );
    update_option( 'site_verification_yahoo_id', $_POST['site_verification_yahoo_id'] );
    update_option( 'site_verification_bing_id', $_POST['site_verification_bing_id'] );
    update_option( 'site_google_analytics_id', $_POST['site_google_analytics_id'] );
    update_option( 'cdntools_baseuri', $_POST['cdntools_baseuri'] );
    update_option( 'site_robots_txt', $_POST['site_robots_txt'] );
  }
   
  // The is the robots.txt reset button
  if ( isset($_POST['reset_robots']) ) {
    if (!current_user_can('manage_options')) die(__('You cannot edit this screen.', WEBMASTER_TOOLS_TEXTDOMAIN));
    delete_option( 'site_robots_txt');
    add_default_robots_txt();
  }

  // Set Current Options after updating
  $site_verification_google_id = get_option( 'site_verification_google_id' );
  $site_verification_yahoo_id = get_option( 'site_verification_yahoo_id' );
  $site_verification_bing_id = get_option( 'site_verification_bing_id' );
  $site_google_analytics_id = get_option( 'site_google_analytics_id' );
  $site_robots_txt_out = get_option('site_robots_txt');
  $site_baseurl = get_option('cdntools_baseuri');

  // And Display the Admin Page ?>
  <style type="text/css"> 
    div.robots_txt_in {border: 1px solid #CCC;clear: left;float: left;height: 220px;margin-right: 25px;margin: 0px 5px 10px;padding: 10px;width: 45%;}
    div.robots_txt_out {border: 1px solid #CCC;float: left;height: 220px;margin-right: 25px;margin: 0px 5px 10px;padding: 10px;width: 45%;}
    div.robots_txt_in_lable {clear: left;float: left;margin-right: 25px;margin: 0px 5px;width: 45%;}
    div.robots_txt_out_lable {float: left;margin-right: 25px;margin: 0px 10px;padding: 0 20px;width: 45%;}
    div.reset {float: right;padding: 5px;}
  </style>
  <div class="wrap">
    <div id="icon-themes" class="icon32"><br></div>
     <h2><?php _e('Webmaster Tools', WEBMASTER_TOOLS_TEXTDOMAIN); ?></h2>
     <div class="tool-box">
     <h3 class="title"><?php _e('Site Verification', WEBMASTER_TOOLS_TEXTDOMAIN); ?></h3>
     <p><?php _e('All three major search engines provide webmaster tools that give you detailed information and statistics about how they see and crawl your website. In order to access most of the features, you will have to verify your sites.', WEBMASTER_TOOLS_TEXTDOMAIN); ?></p>
     <p><?php _e('Enter your meta key "content" value to verify your blog with', WEBMASTER_TOOLS_TEXTDOMAIN); ?> 
        <a href="https://www.google.com/webmasters/tools/" target="_blank" ><?php _e('Google Webmaster Tools', WEBMASTER_TOOLS_TEXTDOMAIN); ?></a>, 
        <a href="https://siteexplorer.search.yahoo.com/" target="_blank" ><?php _e('Yahoo! Site Explorer', WEBMASTER_TOOLS_TEXTDOMAIN); ?></a>, 
        <?php _e('and', WEBMASTER_TOOLS_TEXTDOMAIN); ?> 
        <a href="http://www.bing.com/webmaster" target="_blank" ><?php _e('Bing Webmaster Center', WEBMASTER_TOOLS_TEXTDOMAIN); ?></a>
     </p> 

     <form method="post" action="tools.php?page=site_webmaster_tools"> 
     <table class="form-table"> 
       <tr valign='top'> 
	 <th scope='row'><?php _e('Google Webmaster Tools', WEBMASTER_TOOLS_TEXTDOMAIN); ?>:</th> 
	 <td> 
	   <input value='<?php echo $site_verification_google_id ?>' size='70' name='site_verification_google_id' type='text' /> 
           <?php if ( $site_verification_google_id == NULL ) { echo "<span style='color: red'><strong>" . __('Disabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; } else { echo "<span style='color: green'><strong>" . __('Enabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; }?>
	 </td> 
       </tr><tr> 
	 <td colspan='2'> 
	   <label for='site_verification_google'><?php _e('Example', WEBMASTER_TOOLS_TEXTDOMAIN); ?>: <code>&lt;meta name='google-site-verification' content='<strong>dBw5CvburAxi537Rp9qi5uG2174Vb6JwHwIRwPSLIK8</strong>'&gt;</code></label> 
	 </td> 
       </tr><tr valign='top'> 
	 <th scope='row'><?php _e('Yahoo! Site Explorer', WEBMASTER_TOOLS_TEXTDOMAIN); ?>:</th> 
	 <td> 
	   <input value='<?php echo $site_verification_yahoo_id ?>' size='50' name='site_verification_yahoo_id' type='text' /> 
           <?php if ( $site_verification_yahoo_id == NULL ) { echo "<span style='color: red'><strong>" . __('Disabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; } else { echo "<span style='color: green'><strong>" . __('Enabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; }?>
	 </td> 
       </tr><tr> 
	 <td colspan='2'> 
	   <label for='site_verification_yahoo'><?php _e('Example', WEBMASTER_TOOLS_TEXTDOMAIN); ?>: <code>&lt;meta name='y_key' content='<strong>3236dee82aabe064</strong>'&gt;</code></label> 
	 </td> 
       </tr><tr valign='top'> 
	 <th scope='row'><?php _e('Bing Webmaster Center', WEBMASTER_TOOLS_TEXTDOMAIN); ?>:</th> 
	 <td> 
	   <input value='<?php echo $site_verification_bing_id ?>' size='50' name='site_verification_bing_id' type='text' /> 
           <?php if ( $site_verification_bing_id == NULL ) { echo "<span style='color: red'><strong>" . __('Disabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; } else { echo "<span style='color: green'><strong>" . __('Enabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; }?>
	 </td> 
       </tr><tr> 
	 <td colspan='2'> 
	   <label for='site_verification_bing'><?php _e('Example', WEBMASTER_TOOLS_TEXTDOMAIN); ?>: <code>&lt;meta name='msvalidate.01' content='<strong>12C1203B5086AECE94EB3A3D9830B2E</strong>'&gt;</code></label> 
	 </td> 
       </tr>
     </table>
     <br />
    </div>
    <div class="tool-box"> 
     <h3 class="title"><?php _e('Google Analytics Tracking Script', WEBMASTER_TOOLS_TEXTDOMAIN); ?></h3>
     <p><a href="http://www.google.com/analytics/" target="_blank" ><?php _e('Google Analytics', WEBMASTER_TOOLS_TEXTDOMAIN); ?></a> <?php _e('is a web analytics solution that gives you rich insights into your website traffic and marketing effectiveness. Powerful, flexible and easy-to-use features now let you see and analyze your traffic data in an entirely new way. With Google Analytics, you\'re more prepared to write better-targeted ads, strengthen your marketing initiatives and create higher converting websites.', WEBMASTER_TOOLS_TEXTDOMAIN); ?></p>
     <p><?php _e('Enter your', WEBMASTER_TOOLS_TEXTDOMAIN); ?> "<strong><?php _e('Account ID', WEBMASTER_TOOLS_TEXTDOMAIN); ?></strong>" <?php _e('for this site, to allow', WEBMASTER_TOOLS_TEXTDOMAIN); ?> <a href="http://www.google.com/analytics/" target="_blank" ><?php _e('Google Analytics', WEBMASTER_TOOLS_TEXTDOMAIN); ?></a> <?php _e('to track you page views.', WEBMASTER_TOOLS_TEXTDOMAIN); ?></p>
     <table class="form-table">
      <tr valign='top'> 
	 <th scope='row'><?php _e('Google Analytics Tracking ID', WEBMASTER_TOOLS_TEXTDOMAIN); ?>:</th> 
	 <td> 
	   <input value='<?php echo $site_google_analytics_id ?>' size='20' name='site_google_analytics_id' type='text' /> 
           <?php if ( $site_google_analytics_id == NULL ) { echo "<span style='color: red'><strong>" . __('Disabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; } else { echo "<span style='color: green'><strong>" . __('Enabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; }?>
	 </td> 
       </tr><tr> 
	 <td colspan='2'> 
	   <label for='site_google_analytics_id'><?php _e('Example', WEBMASTER_TOOLS_TEXTDOMAIN); ?>: <code><strong>UA-9527634-1</strong></code></label> 
	 </td> 
       </tr>
     </table> 
     <br />

     <?php if (function_exists('cdn_urls')) { ?>
        <h3 class="Title"><?php _e('CDN Network URL', WEBMASTER_TOOLS_TEXTDOMAIN); ?></h3>
	<p><?php _e('A', WEBMASTER_TOOLS_TEXTDOMAIN); ?> <strong><?php _e('Content Delivery Network (CDN)', WEBMASTER_TOOLS_TEXTDOMAIN); ?></strong> <?php _e('is a system of computers containing copies of data, placed at various points in a network so as to maximize bandwidth for access to the data from clients throughout the network. A client accesses a copy of the data near to the client, as opposed to all clients accessing the same central server, so as to avoid bottlenecks near that server.', WEBMASTER_TOOLS_TEXTDOMAIN); ?></p>
	<table class="form-table">
          <tr valign='top'>
            <th scope='row'><?php _e('CDN Site URL', WEBMASTER_TOOLS_TEXTDOMAIN); ?>:</th>
            <td><input value='<?php echo $site_baseurl ?>' size='50' name='cdntools_baseuri' type='text' /><?php
	      if ( $site_baseurl == NULL ) {
	        echo "<span style='color: red'><strong> " . __('Disabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>"; 
	      } else {
	        echo "<span style='color: green'><strong> " . __('Enabled', WEBMASTER_TOOLS_TEXTDOMAIN) . "</strong></span>";
	      }?>
	    </td>
	 </tr>
       </table>
     <?php } ?>
    </div>

    <div class="tool-box"> 
      <h3 class="title"><?php _e('Robots.txt File', WEBMASTER_TOOLS_TEXTDOMAIN); ?></h3>
      <div class="inside">
        <div class="wrap">
          <?php $blog_public = get_option('blog_public');
          if ( $blog_public == 1 ) {

	  $private_url = 'http://' . $_SERVER['HTTP_HOST'] . '/wp-admin/options-privacy.php'; ?>

          <p><?php _e('You may edit your robots.txt file in the space below. Lines beginning with <code>#</code> are treated as comments. If you don\'t understand what your doing, most likly you don\'t need to do anything.', WEBMASTER_TOOLS_TEXTDOMAIN); ?></p>
          <p><?php _e('Using your robots.txt file, you can ban specific robots, ban all robots, or block robot access to specific pages or areas of your site. If you are not sure what to type, look in the <em>help</em> button on the top right of this screen.', WEBMASTER_TOOLS_TEXTDOMAIN); ?></p>
	  <p><?php _e('To Disable all search engines from browsing your site, see the', WEBMASTER_TOOLS_TEXTDOMAIN); ?> <a href="<?php echo $private_url; ?>"><?php _e('Privacy Settings', WEBMASTER_TOOLS_TEXTDOMAIN); ?></a> <?php _e('page.', WEBMASTER_TOOLS_TEXTDOMAIN); ?></p>
	  <div class="robots_txt_in_lable"><strong><?php _e('Modify Your Robots.txt file', WEBMASTER_TOOLS_TEXTDOMAIN); ?>:</strong></div>
	  <div class="robots_txt_out_lable"><strong><?php _e('Your Current Robots.txt file', WEBMASTER_TOOLS_TEXTDOMAIN); ?>:</strong></div>
	  <div class="robots_txt_in">
              <textarea id="site_robots_txt" name="site_robots_txt" rows="10" cols="45" class="widefat"><?php echo $site_robots_txt_out; ?></textarea>
	<div class="reset">
          <input type="submit" name="reset_robots" class="reset" value="<?php _e('reset robots.txt', WEBMASTER_TOOLS_TEXTDOMAIN); ?>" /> 
	</div>
	  </div>
	  <div class="robots_txt_out">
	    <pre><?php echo $site_robots_txt_out; 
		$site_url = 'http://' . $_SERVER['HTTP_HOST'];
	   ?> </pre>
	  </div>
        </div>
      </div>
	<?php } else {
	$private_url = 'http://' . $_SERVER['HTTP_HOST'] . '/wp-admin/options-privacy.php'; ?>
       <p><?php _e('Privacy Settings are curently <strong>Blocking</strong> all search engines. Enable search engine browsing on the ', WEBMASTER_TOOLS_TEXTDOMAIN); ?><a href="<?php echo $private_url; ?>"><?php _e('Privacy Settings', WEBMASTER_TOOLS_TEXTDOMAIN); ?></a> <?php _e('page to be able to modify the robots.txt file.', WEBMASTER_TOOLS_TEXTDOMAIN); ?></p>
       <?php } ?>
     </p> 
    </div>
       <p class="submit"> 
       <input type="submit" name="submit" class="button-primary" value="<?php _e('Save Changes', WEBMASTER_TOOLS_TEXTDOMAIN); ?>" /> 
     </form> 
</div>
<?php

}


?>
