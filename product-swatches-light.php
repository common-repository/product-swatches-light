<?php
/**
 * Plugin Name:       Product Swatches Light
 * Description:       Provides product swatches for WooCommerce.
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Requires Plugins:  woocommerce
 * Version:           2.0.2
 * Author:            laOlaWeb
 * Author URI:        https://laolaweb.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       product-swatches-light
 *
 * @package product-swatches-light
 */

// prevent direct access.
defined( 'ABSPATH' ) || exit;

use ProductSwatchesLight\Plugin\Init;
use ProductSwatchesLight\Plugin\Installer;

// do nothing if PHP-version is not 8.0 or newer.
if ( version_compare( PHP_VERSION, '8.0', '<' ) ) {
	return;
}

// save plugin path.
const LW_SWATCHES_PLUGIN = __FILE__;

// get autoloader generated by composer.
require_once __DIR__ . '/vendor/autoload.php';

// get constants.
require_once __DIR__ . '/inc/constants.php';

// on activation.
register_activation_hook( LW_SWATCHES_PLUGIN, array( Installer::get_instance(), 'initialize_plugin' ) );

// on deactivation.
register_deactivation_hook( LW_SWATCHES_PLUGIN, array( Init::get_instance(), 'deactivation' ) );

// initialize the plugin.
add_action(
	'plugins_loaded',
	function () {
		Init::get_instance()->init();
	}
);
