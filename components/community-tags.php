<?php

/*
Plugin Name: Matt's Community Tags
Plugin URI: http://wordpress.org/extend/plugins/matts-community-tags/
Description: Very beta, in this version the intention is for this to allow a moderated community to assist in tagging primarily photographic content, image attachments and such.
Version: 0.3
Author: Matt Mullenweg
Author URI: http://ma.tt/
Requires: WordPress Version 2.6 or above
*/

add_action('activate_' . plugin_basename(__FILE__), 'mct_taxes_activate');

function mct_taxes_activate() {
	mct_init();
	$GLOBALS['wp_rewrite']->flush_rules();
}

function mct_init() {
	//wp_enqueue_script( 'jquery' );
	add_action( 'wp_head', 'wp_print_scripts');

	global $wp_rewrite;
}

add_action( 'init', 'mct_init' );

function mct_script() {
	global $posts; ?>
<script type='text/javascript' src='<?php echo get_bloginfo( 'template_directory' ); ?>/components/suggest.js'></script>
<script type="text/javascript">
<!--
var $j = jQuery.noConflict();

$j( document ).ready( function(){
	$j( '#tagthis' ).html('<p>Recognize someone in this photo? Tag them.</p><form action="/index.php?addtag=go" method="post" id="tagthisform"><p>Separate multiple people with commas, example: Elvis Presley, Britney Spears.</p><p><input type="text" id="mct_people" name="mct_people" size="30" /> <input type="hidden" value="<?php echo $posts[0]->ID; ?>" name="post_id" id="post_id" /><input type="button" value="Tag People &raquo;" id="tagthisbutt" /></p></form>');
	$j( '#tagthisbutt' ).click( mct_process_form );
	$j( '#mct_people' ).suggest( '<?php bloginfo('url'); ?>/index.php?suggesttag=go', { onSelect: function() { mct_process_form(); } } );

} );

function mct_process_form() {
	var mct_people = $j( '#mct_people' ).value;
	var mct_people = $j( '#post_id' ).value;
	$j.post( '<?php bloginfo('url'); ?>/index.php?addtag=go', $j("#tagthis :input").serializeArray(), function(data){ $j('#tagthis').html('<p>Thank you for your submission, it is in moderation and should appear shortly.'); } );
}
-->
</script>
<?php
}
//add_action( 'wp_head', 'mct_script' );

function mct_admin_head() {
?>

<?php
}
add_action( 'admin_head', 'mct_admin_head' );

function mct_process_tags() {
	global $wpdb;

	$post_id = absint( $_POST['post_id'] );

	if ( !$post = get_post( $post_id ) )
		die('invalid post');

	foreach ( $_POST as $possible => $tags ) {
		if ( !strstr( $possible, 'mct_' ) )
			continue;
		$taxonomy = str_replace( 'mct_', '', $possible );
		$taxonomy = preg_replace( '|[^a-z]|', '', $taxonomy );
		if ( empty( $tags ) || empty( $taxonomy ) )
			continue; // random empty stuff
		if ( stristr( $tags, 'http://' ) )
			continue; // usually spam
		$to_add[ $taxonomy ] = stripslashes( $tags );
	}

	// todo: merge with old arrays

	if ( empty( $to_add ) )
		die('no tags to add');

	add_post_meta( $post_id, 'mct_proposed_tags', $to_add );
	if ( isset( $_GET['ajax'] ) )
		die;
	wp_redirect( get_permalink( $post_id ) );
	die;
}

if ( isset( $_GET['addtag'] ) )
	add_action( 'init', 'mct_process_tags' );

function mct_suggest_tags() {
	global $wpdb;

	header( 'Content-type: text/plain; charset=utf-8' );
	
	$s = addslashes( $_REQUEST['q'] );
	if ( strlen( $s ) < 3 ) die;
	
	$results = $wpdb->get_col( "SELECT name FROM $wpdb->terms WHERE name LIKE ('%$s%')" );
	
	foreach ( $results as $r )
		echo str_replace( '-', ' ', $r ) . "\n";
	die;
}

if ( isset( $_GET['suggesttag'] ) )
	add_action( 'init', 'mct_suggest_tags' );

function mct_admin_init() {
	global $wpdb;

	if ( !isset( $_GET['update'] ) )
		return;

	if ( 'doingitwell' != $_GET['update'] )
		return;

	if ( !current_user_can( 'manage_options' ) )
		die('no page access');

	if ( $_POST ) {

	foreach ( $_POST as $key => $juice ) {
		if ( !strstr( $key, 'mct_' ) )
			continue;
		if ( 'ignore' == $juice['action'] )
			continue;

		$old = $remove = $new = array();
		
		$juice['tag'] = stripslashes( $juice['tag'] );

		// first let's get all the stuff currently proposed, and combine it
		$meta = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE post_id = {$juice['post_id']} AND meta_key = 'mct_proposed_tags'" );

		
		foreach ( $meta as $m ) {
			$array = unserialize( $m->meta_value );
			foreach ( $array as $taxonomy => $str )
				$old[ $taxonomy ] .= $str . ', ';
		}

		foreach ( $old as $tax => $str ) {
			$old[ $tax ] = strtolower( $old[$juice['taxonomy']] );
			$old[ $tax ] = trim( $old[$juice['taxonomy']] );
			if ( $old[ $tax ] == ',' )
				continue;
			$old[ $tax ] = str_replace(',', ', ', $old[ $tax ] );
			$old[ $tax ] = preg_split( '|,\s+|', $old[ $tax ], -1, PREG_SPLIT_NO_EMPTY );
			$old[ $tax ] = array_unique( $old[ $tax ] );
		}

		if ( 'approve' == $juice['action'] ) {
			$test = wp_set_object_terms( $juice['post_id'], $juice['tag'], $juice['taxonomy'], true ); // append = true so we don't axe previous tags
			$remove[$juice['taxonomy']][] = $juice['tag'];
		}

		if ( 'discard' == $juice['action'] )
			$remove[$juice['taxonomy']][] = $juice['tag'];

		$new = array();
		foreach ( $remove as $tax => $r_arr ) { // geez this is ugly
			foreach ( $r_arr as $str ) {
				foreach( $old as $tax2 => $people_array ) {
					foreach ( $people_array as $key => $person ) {
						if ( trim($str) != trim($person) )
							$new[$tax2][] = $person;
					}
				}
			}
		}
		foreach ( $new as $tax => $str ) {
			$new[ $tax ] = array_unique( $new[ $tax ] );
			$new[ $tax ] = join( ', ', $new[ $tax ] );
		}
//		die(var_dump('<pre>',$juice, $remove, $old, $new));

		// remove old values
		$meta = $wpdb->query( "DELETE FROM $wpdb->postmeta WHERE post_id = {$juice['post_id']} AND meta_key = 'mct_proposed_tags'" );
		wp_cache_delete( $juice['post_id'], 'post_meta' );

//var_dump('<pre>', $juice, $old, $new);
		if ( !empty( $new ) )
			$wpdb->insert( $wpdb->postmeta, array( 'post_id' => $juice['post_id'], 'meta_key' => 'mct_proposed_tags', 'meta_value' => serialize($new) ) );
//			add_post_meta( $juice['post_id'], 'mct_proposed_tags', $new );

	}
	}
//	die(var_dump($wpdb->queries));
	wp_redirect( 'admin.php?page=mct-manage-tags&updated=true' );
	die;
}

add_action( 'init', 'mct_admin_init', 99 );

function ts_dropdown( $object_type, $id, $current = 'tag' ) {
	$ts = get_object_taxonomies( $object_type );
	$r = "<select name='{$id}[taxonomy]'>";
	foreach ( $ts as $t ) {
		if ( $t == $current )
			$r .= "<option value='$t' selected='selected'>$t</option>";
		else
			$r .= "<option value='$t'>$t</option>";
		
	}
	$r .= '</select>';
	return $r;
}

function mct_moderation() {
	global $wpdb, $pagenow;

	if ( !current_user_can( 'manage_options' ) )
		die('no page access');

?>

<?php if ( isset( $_GET['updated'] ) ) { ?>
<div class="updated"><p>Community tags updated.</p></div>
<?php } ?>
<div class="wrap">
<style type="text/css">
.mct-post .mct-im {
	float: left;
	margin-right: 1em;
	margin-bottom: 5px;
	width: 250px;
}
</style>
<h2><?php _e('Matt&#8217;s Community Tags'); ?></h2>
<?php

$proposed = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key = 'mct_proposed_tags' ORDER BY post_id DESC" );
if ( $proposed ) {
?>
<p>Below you can see community-proposed tags.</p>
<form method="post" action="edit.php?page=mct-manage-tags&amp;update=doingitwell">
<p class="submit"><input type="submit" name="submit" value="<?php _e('Moderate Tags &raquo;'); ?>" /></p>

<?php

$i = 0;
foreach ( $proposed as $p ) {
	$post = get_post( $p->post_id );
	$link = get_permalink( $p->post_id );
	$edit = get_edit_post_link( $p->post_id );
	$image = '';
	if ( $post->post_type = 'attachment' ) {
		$image = wp_get_attachment_link($p->post_id, 'thumbnail', true);
	}
	
	$todo = unserialize( $p->meta_value );

	if ( !$todo || empty( $p->meta_value ) ) {
		$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_id = $p->meta_id" );
		continue;
	}

	echo "<div class='mct-post'> <div class='mct-im'>$image</div> <h3>$post->post_title <a href='$link'>&infin;</a> <a href='$edit'>e</a></h3>";

	if ( !isset( $ts ) )
		$ts = get_object_taxonomies( 'post' );
	foreach ( $ts as $t ) {
		$add = $ps = '';
		$current = get_the_terms( $p->post_id, $t );
		if ( $current ) {
			foreach ( $current as $person )
				$ps[] = $person->name;
		$add = " <strong>$t:</strong> " . join( ', ', $ps ) . '. ';
		}
		if ( $add )
			echo "$add";
	}
	
	echo "<table><tr><th>Taxonomy</th><th>Tag</th><th>Action</th></tr>";


	foreach ( $todo as $tax => $tags ) {
		++$i;
		$current = get_the_terms( $p->post_id, $tax );
		
		$tags = strtolower( $tags );
		$tags = explode( ',', $tags );
		foreach ( $tags as $tag ) {
			++$i;
			$tag_attr = trim( esc_attr( $tag ) );
			$drop = ts_dropdown( 'post', "mct_{$i}", $tax );
			$tag = strtolower( trim( $tag ) );
			if ( is_array( $ps ) && in_array( $tag, $ps ) ) { // if it's already a tag
			 	echo "<p>$drop &#8212; $tag &#8212; <input type='hidden' name='mct_{$i}[tag]' value='$tag_attr' /> <input type='hidden' name='mct_{$i}[post_id]' value='$p->post_id' /><label><input type='radio' name='mct_{$i}[action]' value='discard' checked='checked' /> Discard (already there)</label></p>";
				continue;	
			}
			echo "<tr><td>$drop</td><td><input type='text' name='mct_{$i}[tag]' value='$tag_attr' size='30' /></td><td><label><input type='radio' name='mct_{$i}[action]' value='approve' /> Approve</label> <label><input type='radio' name='mct_{$i}[action]' value='discard' /> Discard</label> <label><input type='radio' name='mct_{$i}[action]' value='ignore' checked='checked' /> Ignore</label><input type='hidden' name='mct_{$i}[post_id]' value='$p->post_id' /></td></tr>";
			
		}
	}
	echo "</table></div><hr style='clear: both' />\n\n";
	
}

?>
<p class="submit"><input type="submit" name="submit" value="<?php _e('Moderate Tags &raquo;'); ?>" /></p>
</form>
<?php
} else { // if proposed 
?>

<p>No tags pending, yet.</p>
<?php 
}
?>
</div>
<?php
}

function mct_menu() {
	if ( function_exists('add_menu_page') ) {
		global $wpdb;
		// I don't like doing this on every page, maybe an option to store count?
		$proposed = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key = 'mct_proposed_tags' ORDER BY post_id DESC" );
		$todo = 0;
		foreach ( $proposed as $p ) {
			$tags = unserialize( $p->meta_value );
			$todo += count( $tags );
		}
		add_menu_page( __('Community Tags123'), __('Community Tags'), 'manage_options', 'mct-manage-tags', 'mct_moderation');
	}
}

add_action('admin_menu', 'mct_menu');

// no closing tag on purpose, it's the new black
