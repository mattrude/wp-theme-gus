<?php
/**
 * Plugin Name: Time Since
 *
 * Adds a Time Since shotcode "[ts date'1980-06-19']" that will display the years since the date provided.
 * Plugin Version 1.1
 *
 * @author Matt Rude <matt@mattrude.com>
 * @since 0.1
 * @package Gus Theme
 * @subpackage Time Since Plugin
 */

if ( !function_exists('mdr_timesince') ) {
  /**
   * Time Since Plugin shortcode
   *
   * Adds a Time Since shotcode "[ts date'1980-06-19']" that will display the years since the date provided.
   *
   * This shortcode displays the years since the date provided.
   * To use this shortcode, add some text to a post or page simmiler to:
   *
   *<samp>[ts date='1983-09-02']</samp>
   *
   * The date format is YYYY-MM-DD
   *
   * @param string $atts the date from the shortcode
   * @param string $content The content of the shortcode but be null
   *
   * @author Matt Rude <matt@mattrude.com>
   * @since 0.1
   * @package Gus Theme
   * @subpackage Time Since Plugin
   */
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
