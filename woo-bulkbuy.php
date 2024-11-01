<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpdrizzle.com/
 * @since             1.0.2
 * @package           Woo_Ws
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Bulkbuy
 * Plugin URI:        https://github.com/bplv112/woo-bulkbuy
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.3
 * Author:            Bplv
 * Author URI:        https://wpdrizzle.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-ws
 * Domain Path:       /languages
 */

namespace WPD\WWS;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WWS_VER_NUM', '1.0.3' );
define( 'WWS_BASE_PATH', dirname( __FILE__ ) );
define( 'WWS_FILE_URL', plugins_url( '', __FILE__ ) );
define( 'WWS_ARCHIVE_ACTIVATE',false );

/**
 * Autoload classes.
 */
spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = __NAMESPACE__;

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/classes';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-ws-activator.php
 */
function activate() {
	Activator\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-ws-deactivator.php
 */
function deactivate() {
	Activator\Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'WPD\\WWS\\activate' );
register_deactivation_hook( __FILE__, 'WPD\\WWS\\deactivate' );


/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */

function init() {
    $template = Woo\Template::get_instance();
	$template = Styles\Styles::get_instance();
}
add_action( 'plugins_loaded', 'WPD\\WWS\\init' );
