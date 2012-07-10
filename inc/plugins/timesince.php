<?php
/*
Plugin Name: Time Since
Plugin URI: http://github.com/mattrude/mdr-network
Description: Adds a Time Since shotcode "[ts date'1980-06-19']" that will display the years since the date provided.
Version: 1.1
Author: Matt Rude
Author URI: http://mattrude.com

Matt Rude <matt@mattrude.com> - 1 Nov 2009
This shortcode displays the years since the date provided.
To use this shortcode, add some text to a post or page simmiler to:

    [ts date='1983-09-02']

The date format is YYYY-MM-DD
*/

if ( !function_exists('mdr_timesince') ) {
  function mdr_timesince($atts, $content = null) {
    extract(shortcode_atts(array("date" => ''), $atts));
    if(empty($date)) {
      return "<br /><br />************No date provided************<br /><br />";
    }
    $mdr_unix_date = strtotime($date);
    $mdr_time_difference = time() - $mdr_unix_date ;
    $years = floor($mdr_time_difference / 31556926 );
    $num_years_since = $years;
    return $num_years_since;
  }
  add_shortcode('ts', 'mdr_timesince');
} ?>
