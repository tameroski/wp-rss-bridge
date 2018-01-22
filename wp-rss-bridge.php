<?php

/**
 * @link              http://www.keybored.fr
 * @since             1.0.0
 * @package           Wp_Rss_Bridge
 *
 * @wordpress-plugin
 * Plugin Name:       WP RSS Bridge
 * Plugin URI:        http://www.keybored.fr
 * Description:       Use social network data in you WP project.
 * Version:           1.0.0
 * Author:            Tameroski
 * Author URI:        http://www.keybored.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-rss-bridge
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-rss-bridge.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_rss_bridge() {

	$plugin = new Wp_Rss_Bridge();
	$plugin->run();

}
run_wp_rss_bridge();
