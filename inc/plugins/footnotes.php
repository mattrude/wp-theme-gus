<?php
/**
 * Footnotes Plugin
 *
 * Create simple, elegant footnotes on your site. Use the <code>[ref]</code> shortcode ([ref]My note.[/ref]) and the plugin takes care of the rest. There's also a <a href="options-reading.php">setting</a> that enables you to move the footnotes below your page links, for those who paginate posts.
 * @version: 0.3
 * @since 0.1
 * @package Gus Theme
 * @subpackage Footnotes
 */
/**
 * Footnotes Class
 *
 * This is the main Class for Footnotes
 *
 * @since 0.1
 * @package Gus Theme
 * @subpackage Footnotes
 */
class gus_footnotes {
    /**
     * Footnotes array
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	var $footnotes = array();
    /**
     * Option Name 'simple_footnotes'
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	var $option_name = 'simple_footnotes';
    /**
     * Database Version Number
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	var $db_version = 1;
    /**
     * Location of output
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	var $placement = 'content';

    /**
     * Fires when class is constructed, adds init hook
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function gus_footnotes() {
		add_shortcode( 'ref', array( &$this, 'shortcode' ) );

		$this->options = get_option( 'simple_footnotes' );
		if ( ! empty( $this->options ) )
			$this->placement = $this->options['placement'];
		if ( 'page_links' == $this->placement )
			add_filter( 'wp_link_pages_args', array( &$this, 'wp_link_pages_args' ) );
		add_filter( 'the_content', array( &$this, 'the_content' ), 12 );

		if ( ! is_admin() )
			return;
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
	}

    /**
     * Admin init Callback
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function admin_init() {
		if ( false === $this->options || ! isset( $this->options['db_version'] ) || $this->options['db_version'] < $this->db_version ) {
			if ( ! is_array( $this->options ) )
				$this->options = array();
			$current_db_version = isset( $this->options['db_version'] ) ? $this->options['db_version'] : 0;
			$this->upgrade( $current_db_version );
			$this->options['db_version'] = $this->db_version;
			update_option( $this->option_name, $this->options );
		}

		add_settings_field( 'simple_footnotes_placement', 'Footnotes placement', array( &$this, 'settings_field_cb' ), 'reading' );
		register_setting( 'reading', 'simple_footnotes', array( &$this, 'register_setting_cb' ) );
	}

    /**
     * Sanitizes settings before saving
     * @param string $input the user input
     * @returns string the sanitized input
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function register_setting_cb( $input ) {
		$output = array( 'db_version' => $this->db_version, 'placement' => 'content' );
		if ( ! empty( $input['placement'] ) && 'page_links' == $input['placement'] )
			$output['placement'] = 'page_links';
		return $output;
	}

    /**
     * Callback to output settings field UI
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function settings_field_cb() {
		$fields = array(
			'content' => 'Below content',
			'page_links' => 'Below page links',
		);
		foreach ( $fields as $field => $label ) {
			echo '<label><input type="radio" name="simple_footnotes[placement]" value="' . $field . '"' . checked( $this->placement, $field, false ) . '> ' . $label . '</label><br/>';
		}
	}

    /**
     * Upgrades Database
     * @param int $current_db_version the current DB version
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function upgrade( $current_db_version ) {
		if ( $current_db_version < 1 )
			$this->options['placement'] = 'content';
	}

    /**
     * Processes ref short code
     * @param array $atts the attributes passed within the short code
     * @param string $content the content within the short code tags
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function shortcode( $atts, $content = null ) {
		global $id;
		if ( null === $content )
			return;
		if ( ! isset( $this->footnotes[$id] ) )
			$this->footnotes[$id] = array( 0 => false );
		$this->footnotes[$id][] = $content;
		$note = count( $this->footnotes[$id] ) - 1;
		return ' <a class="simple-footnote" title="' . esc_attr( wp_strip_all_tags( $content ) ) . '" id="return-note-' . $id . '-' . $note . '" href="#note-' . $id . '-' . $note . '"><sup>' . $note . '</sup></a>';
	}

    /**
     * The content filter to process footnotes
     * @param string $content the content
     * @return string the modified content
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function the_content( $content ) {
		if ( 'content' == $this->placement || ! $GLOBALS['multipage'] )
			return $this->footnotes( $content );
		return $content;
	}

    /**
     * Callback to clear collected footnotes 
     *
     * Callback to clear collected footnotes 
     * incase the_content is called more than once
     * @param string $content the content
     * @returns string the same content
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
    function clear_footnotes($content) {
        $this->footnotes = array();
        return $content;
    }

    /**
     * If wp_link_pages is after footnotes
     *
     * If wp_link_pages appears both before and after the content,
     * $this->footnotes[$id] will be empty the first time through,
     * so it works, simple as that.
     * @param string $args Each inbound link
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function wp_link_pages_args( $args ) {
		$args['after'] = $this->footnotes( $args['after'] );
		return $args;
	}

    /**
     * Outputs the footnotes
     * @param string $content the content
     * @returns string the content with footnotes
     *
     * @since 0.1
     * @package Gus Theme
     * @subpackage Footnotes
     */
	function footnotes( $content ) {
		global $id;
		if ( empty( $this->footnotes[$id] ) )
			return $content;
		$content .= '<div class="simple-footnotes"><p class="notes">Notes:</p><ol>';
		foreach ( array_filter( $this->footnotes[$id] ) as $num => $note )
			$content .= '<li id="note-' . $id . '-' . $num . '">' . do_shortcode( $note ) . ' <a href="#return-note-' . $id . '-' . $num . '">&#8617;</a></li>';
		$content .= '</ol></div>';
		return $content;
	}
}
new gus_footnotes();
