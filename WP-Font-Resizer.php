<?php // phpcs:ignore PSR1.Files.SideEffects.FoundWithSymbols

/*
Plugin Name: WP-Font-Resizer (Libpress Fork)
Plugin URI: http://shovon.info/wp/wp-font-resizer/
Description: A plugin that helps users to increase or decrease font size and also reset default font size.
Version: 1.2.2
Author: Ahmedur Rahman Shovon
Author URI: http://www.shovon.info
License: GPL2
*/

/* Font Awesome licensed under SIL OFL 1.1 ihttp://scripts.sil.org/OFL */

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
// phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
class WPFontResizer
{
    /*--------------------------------------------*
     * Constants
     *--------------------------------------------*/

    public const NAME = 'WP-Font-Resizer';
    public const SLUG = 'WP-Font-Resizer';

    /**
     * Constructor
     */
    public function __construct()
    {
        // Define constants used throughout the plugin
        $this->init_plugin_constants();

        // Load JavaScript and stylesheets
        add_action('wp_enqueue_scripts', [&$this, 'register_scripts_and_styles']);
    }

    /*--------------------------------------------*
     * Private Functions
     *---------------------------------------------*/

    /**
     * Initializes constants used for convenience throughout the plugin.
     */
    private function init_plugin_constants()
    {
        if (!defined('PLUGIN_NAME')) {
            define('PLUGIN_NAME', self::NAME);
        }

        if (!defined('PLUGIN_SLUG')) {
            define('PLUGIN_SLUG', self::SLUG);
        }
    }

    /**
     * Registers and enqueues stylesheets
     */
    public function register_scripts_and_styles()
    {
        if (is_admin()) {
            // no admin styes or scripts
        } else {
            $this->load_file(self::SLUG . '-script', '/js/fontResizer.js', true);
            $this->load_file(self::SLUG . '-fontawesome', '/font-awesome/css/font-awesome.min.css');
            $this->load_file(self::SLUG . '-style', '/css/fontResizer.css');
        }
    }

    /**
     * Helper function for registering and enqueueing scripts and styles.
     */
    private function load_file($name, $file_path, $is_script = false)
    {
        $file = plugin_dir_path(__FILE__) . $file_path;

        if (file_exists($file)) {
            $url = plugins_url($file_path, __FILE__);

            if ($is_script) {
                wp_register_script($name, $url, ['jquery'], filemtime($file));
                wp_enqueue_script($name);
            } else {
                wp_register_style($name, $url, [], filemtime($file));
                wp_enqueue_style($name);
            }
        }
    }
}

new WPFontResizer();
