<?php

/** 
 * Create the Theme Options menus on the WordPress Dashboard
 *
 * @since Gus 0.1
 */
function gus_create_menu() {

	//create new top-level menu
	add_submenu_page( 'themes.php', 'Gus Theme Settings', 'Theme Options', 'administrator', 'theme-options', 'gus_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_gus_settings' );
}
// create custom plugin settings menu
add_action('admin_menu', 'gus_create_menu');


/**
 * Register the form setting for our gus_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, gus_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * @since Gus 0.1
 */
function gus_theme_options_init() {

    register_setting(
        'gus_options',       // Options group, see settings_fields() call in gus_theme_options_render_page()
        'gus_theme_options', // Database option, see gus_get_theme_options()
        'gus_theme_options_validate' // The sanitization callback, see gus_theme_options_validate()
    );

    // Register our settings field group
    add_settings_section(
        'general', // Unique identifier for the settings section
        '', // Section title (we don't want one)
        '__return_false', // Section callback (we don't want anything)
        'theme_options' // Menu slug, used to uniquely identify the page; see gus_theme_options_add_page()
    );

    // Register our individual settings fields
    add_settings_field(
        'color_scheme',  // Unique identifier for the field for this section
        __( 'Color Scheme', 'gus' ), // Setting field label
        'gus_settings_field_color_scheme', // Function that renders the settings field
        'theme_options', // Menu slug, used to uniquely identify the page; see gus_theme_options_add_page()
        'general' // Settings section. Same as the first argument in the add_settings_section() above
    );

    add_settings_field( 'link_color', __( 'Link Color',     'gus' ), 'gus_settings_field_link_color', 'theme_options', 'general' );
    add_settings_field( 'layout',     __( 'Default Layout', 'gus' ), 'gus_settings_field_layout',     'theme_options', 'general' );
}
add_action( 'admin_init', 'gus_theme_options_init' );

/**
 * Built the main Settings for the theme.
 *
 * @since Gus 0.1
 */
function register_gus_settings() {
	register_setting( 'gus-settings-group', 'gus_use_siteowner' );
	register_setting( 'gus-settings-group', 'gus_copy_year' );
	register_setting( 'gus-settings-group', 'gus_siteowner' );
	register_setting( 'gus-settings-group', 'gus_use_cdn' );
	register_setting( 'gus-settings-group', 'gus_cdn_address' );
	register_setting( 'gus-settings-group', 'line_1' );
	register_setting( 'gus-settings-group', 'line_2' );
	register_setting( 'gus-settings-group', 'line_3' );
	register_setting( 'gus-settings-group', 'line_4' );
	register_setting( 'gus-settings-group', 'line_5' );
	register_setting( 'gus-settings-group', 'line_6' );
	register_setting( 'gus-settings-group', 'gus_home_textarea' );
	register_setting( 'gus-settings-group', 'gus_facebook' );
	register_setting( 'gus-settings-group', 'gus_linkedin' );
	register_setting( 'gus-settings-group', 'gus_twitter' );
	register_setting( 'gus-settings-group', 'gus_google' );
	register_setting( 'gus-settings-group', 'gus_github' );
	register_setting( 'gus-settings-group', 'gus_flickr' );
	register_setting( 'gus-settings-group', 'gus_email' );
}

function gus_settings_page() {
?>
<div class="wrap">
<div id="icon-themes" class="icon32"><br></div>
<h2>The Gus Theme's Options Page</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'gus-settings-group' ); ?>

	<h3>Site Owner</h3>
    <table class="form-table">
		<?php wp_dropdown_users(array('name' => 'gus_siteowner')); ?>
		<p>Use Site Owner? <input type="checkbox" name="gus_use_siteowner" value="checked" <?php echo get_option('gus_use_siteowner'); ?> /></p>
		<tr valign="top">
			<th scope="row">Copyright starting year</th>
			<td><input type="text" name="gus_copy_year" value="<?php echo get_option('gus_copy_year'); ?>" /></td>
		</tr>
	</table>

	<h3>Opening Bullet Points</h3>
    <table class="form-table">
		<tr valign="top">
			<th scope="row">1st Line</th>
			<td><input type="text" name="line_1" class="regular-text" value="<?php echo get_option('line_1'); ?>" /></td>
			<th scope="row">2nd Line</th>
			<td><input type="text" name="line_2" class="regular-text" value="<?php echo get_option('line_2'); ?>" /></td>
		</tr>
         
        <tr valign="top">
        	<th scope="row">3rd Line</th>
        	<td><input type="text" name="line_3" class="regular-text" value="<?php echo get_option('line_3'); ?>" /></td>
        	<th scope="row">4th Line</th>
        	<td><input type="text" name="line_4" class="regular-text" value="<?php echo get_option('line_4'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        	<th scope="row">5th Line</th>
        	<td><input type="text" name="line_5" class="regular-text" value="<?php echo get_option('line_5'); ?>" /></td>
        	<th scope="row">6th Line</th>
        	<td><input type="text" name="line_6" class="regular-text" value="<?php echo get_option('line_6'); ?>" /></td>
        </tr>
	</table>

	<?php if (get_option('gus_use_siteowner')) { ?>
	<p></p>
	<?php } else { ?>

	<h3>Social Links</h3>
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Facebook Link</th>
			<td><input type="text" name="gus_facebook" class="regular-text" value="<?php echo get_option('gus_facebook'); ?>" /></td>
			<th scope="row">Linkedin Link</th>
			<td><input type="text" name="gus_linkedin" class="regular-text" value="<?php echo get_option('gus_linkedin'); ?>" /></td>
		</tr>

		<tr valign="top">
			<th scope="row">Twitter Link</th>
			<td><input type="text" name="gus_twitter" class="regular-text" value="<?php echo get_option('gus_twitter'); ?>" /></td>
			<th scope="row">Google+ Link</th>
			<td><input type="text" name="gus_google" class="regular-text" value="<?php echo get_option('gus_google'); ?>" /></td>
		</tr>

		<tr valign="top">
			<th scope="row">Github Link</th>
			<td><input type="text" name="gus_github" class="regular-text" value="<?php echo get_option('gus_github'); ?>" /></td>
			<th scope="row">Flickr Link</th>
			<td><input type="text" name="gus_flickr" class="regular-text" value="<?php echo get_option('gus_flickr'); ?>" /></td>
		</tr>

		<tr valign="top">
			<th scope="row">Email Address</th>
			<td><input type="text" name="gus_email" class="regular-text" value="<?php echo get_option('gus_email'); ?>" /></td>
		</tr>

	</table>

	<?php } ?>

	<h3>About Text</h3>
	<table class="form-table">
		<tr valign="top">
			<th scope="row">The Lower text area</th>
			<td><textarea id="gus_home_textarea" name="gus_home_textarea" rows="10" cols="120"><?php echo get_option('gus_home_textarea'); ?></textarea></td>
		</tr>
    </table>

	<h3>CDN Options</h3>
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Use a CDN on this site?</th>
			<td><input type="checkbox" name="gus_use_cdn" value="checked" <?php echo get_option('gus_use_cdn'); ?> /></td>
			<?php if ( get_option('gus_use_cdn') ) { ?>
				<th scope="row">The CDN's URL</th>
				<td><input type="text" name="gus_cdn_address" class="regular-text" value="<?php echo get_option('gus_cdn_address'); ?>" /></td>
			<?php } else { ?>
				<input type="hidden" name="gus_cdn_address" class="regular-text" value="<?php echo get_option('gus_cdn_address'); ?>" />
			<?php } ?>
		</tr>
	</table>

    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>
