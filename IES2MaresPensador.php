<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://iesdosmares.com
 * @since             1.0.0
 * @package           IES2MaresPensador
 *
 * @wordpress-plugin
 * Plugin Name:       El Pensador
 * Plugin URI:        http://iesdosmares.com/IES2MaresPensador-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Alberto Sierra Olmo
 * Author URI:        http://iesdosmares.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       IES2MaresPensador
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
define( 'IES2MaresPensador_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-IES2MaresPensador-activator.php
 */
function activate_IES2MaresPensador() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-IES2MaresPensador-activator.php';
	IES2MaresPensador_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-IES2MaresPensador-deactivator.php
 */
function deactivate_IES2MaresPensador() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-IES2MaresPensador-deactivator.php';
	IES2MaresPensador_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_IES2MaresPensador' );
register_deactivation_hook( __FILE__, 'deactivate_IES2MaresPensador' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-IES2MaresPensador.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_IES2MaresPensador() {

	$plugin = new IES2MaresPensador();
	$plugin->run();

}
run_IES2MaresPensador();
