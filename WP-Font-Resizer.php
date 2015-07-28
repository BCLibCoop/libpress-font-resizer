<?php
/*
Plugin Name: WP-Font-Resizer
Plugin URI: http://shovon.info/wp/wp-font-resizer/
Description: WP-Font-Resizer is a plugin that helps users to increase or decrease font size and also reset default font size.
Version: 1.0
Author: Ahmedur Rahman Shovon
Author URI: http://www.shovon.info
License: GPL2
*/

/* Font Awesome licensed under SIL OFL 1.1 ihttp://scripts.sil.org/OFL */

class WPFontResizer {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/	 
	 
	const name = 'WP-Font-Resizer';
	const slug = 'WP-Font-Resizer';


	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	function __construct() {

	    // Define constants used throughout the plugin
	    $this->init_plugin_constants();

	    // Define plugin url
		$plugins_url = plugins_url();
  
    	// Load JavaScript and stylesheets
    	$this->register_scripts_and_styles();

		// Plugin Actions	    
	    //add_action( 'wp_footer', array( $this, 'display_link' ) );
	    
	} // end constructor


	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------

	function display_link() {
		$htmlcode='jQuery(".search").append("<div class="fontResizer"><i class="fa fa-plus fa-2x" title="Increase font size"></i><i class="fa fa-font fa-2x" title="Default font size"></i><i class="fa fa-minus fa-2x" title="Decrease font size"></i></div>");';
		echo $htmlcode;
	} 
	  
	  
	/*--------------------------------------------*
	 * Private Functions
	 *---------------------------------------------*/
   
	// Initializes constants used for convenience throughout the plugin.
	private function init_plugin_constants() {

		if ( !defined( 'PLUGIN_NAME' ) ) {
		  define( 'PLUGIN_NAME', self::name );
		} 
		if ( !defined( 'PLUGIN_SLUG' ) ) {
		  define( 'PLUGIN_SLUG', self::slug );
		} 

	} // end init_plugin_constants

	// Registers and enqueues stylesheets
	private function register_scripts_and_styles() {
		if ( is_admin() ) {
			// no admin styes or scripts
		} else { 
			$this->load_file( self::slug . '-loader', '/js/fontResizerLoad.js', true);
			$this->load_file( self::slug . '-script', '/js/fontResizer.js', true );
			$this->load_file( self::slug . '-fontawesome', '/font-awesome/css/font-awesome.min.css' );
			$this->load_file( self::slug . '-style', '/css/fontResizer.css' );

		} // end if/else
	} // end register_scripts_and_styles

	// Helper function for registering and enqueueing scripts and styles.
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url($file_path, __FILE__);
		$file = plugin_dir_path(__FILE__) . $file_path;

		if( file_exists( $file ) ) {
			if( $is_script ) {
				wp_register_script( $name, $url, array('jquery') );
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
				error_log("Style loaded: " . $name . $url);
			} // end if
		} // end if
    
	} // end load_file
  
  
} // end class
new WPFontResizer();
