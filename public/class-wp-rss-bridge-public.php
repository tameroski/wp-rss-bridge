<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.keybored.fr
 * @since      1.0.0
 *
 * @package    Wp_Rss_Bridge
 * @subpackage Wp_Rss_Bridge/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Rss_Bridge
 * @subpackage Wp_Rss_Bridge/public
 * @author     Tameroski <tameroski@gmail.com>
 */
class Wp_Rss_Bridge_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->register_shortcodes();

	}

	/**
	 * Register shortcodes
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {

		add_shortcode( 'rss_data', array($this, 'rss_data') );

	}

	/**
	 * Shortcode to display data, mainly for debugging prupose
	 *
	 * @since    1.0.0
	 */
	function rss_data( $atts ) {

		$bridge = new Wp_Rss_Bridge_Processor();
		$data = $bridge->get_data();

	    return print_r($data, true);
	}

}
