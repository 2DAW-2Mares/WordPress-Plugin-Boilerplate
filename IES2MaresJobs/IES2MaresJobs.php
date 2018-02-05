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
 * @package           IES2MaresJobs
 *
 * @wordpress-plugin
 * Plugin Name:       IES Dos Mares Jobs
 * Plugin URI:        http://iesdosmares.com/IES2MaresJobs-uri/
 * Description:       Gestión de ofertas de trabajo para los alumnos del I.E.S. Dos Mares
 * Version:           1.0.0
 * Author:            I.E.S. Dos Mares
 * Author URI:        http://iesdosmares.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       IES2MaresJobs
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
define( 'IES2MARESJOBS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-IES2MaresJobs-activator.php
 */
function activate_IES2MaresJobs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-IES2MaresJobs-activator.php';
	IES2MaresJobs_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-IES2MaresJobs-deactivator.php
 */
function deactivate_IES2MaresJobs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-IES2MaresJobs-deactivator.php';
	IES2MaresJobs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_IES2MaresJobs' );
register_deactivation_hook( __FILE__, 'deactivate_IES2MaresJobs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-IES2MaresJobs.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_IES2MaresJobs() {

	$plugin = new IES2MaresJobs();
	$plugin->run();

}
run_IES2MaresJobs();
