<?php
/**
 * Plugin Name: VP Backup
 * Plugin URI: http://www.volcanicpixels.com/wordpress-backup
 * Description: The easiest way to keep your WordPress site backed up.
 * Author: Volcanic Pixels
 * Author URI: http://www.volcanicpixls.com
 * Version 0.0.0
 */

$required_php_version = '5.2.4';
$required_wp_version  = '3.2';

// Registers the autoloader that will load all classes as they are needed
require_once( dirname(__FILE__) . '/autoloader.php' );
require_once( dirname(__FILE__) . '/vendor/autoloader.php' );
VPBackup_Autoloader::register();

// Check if PHP and WordPress versions satisfy requirements.
// If they don't then refuse to activate and give a helpful error message

$php_too_old = version_compare( PHP_VERSION, $required_php_version, '<');
$wp_too_old  = version_compare( get_bloginfo( 'version' ), $required_wp_version, '<');

if ($php_too_old || $wp_too_old) {

    require_once( ABSPATH . WPINC . 'plugin.php');
    deactivate_plugins( basename( __FILE__ ) );
    
    if (isset( $_GET['action'])
        && ($_GET['action'] == 'activate' || $_GET['action'] == 'error_scrape' )
    ) {
        die(
            printf(
                __(
                    'VP Backup requires PHP version %s or greater and WordPress version %s or greater',
                    'vpbackup'
                ),
                $required_php_version,
                $required_wp_version
            )
        );
    }
}

// Load plugin using singleton
if (function_exists('add_action')) {
    add_action('plugins_loaded', array('VPBackup', 'getPlugin'));
}
