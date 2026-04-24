<?php
/**
 * Plugin Name: Law Firm Contact Plugin
 * Plugin URI: https://meanpug.com
 * Description: A custom plugin for handling contact forms and inquiries for the law firm.
 * Version: 1.0.0
 * Author: MeanPug Digital
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: law-firm-contact
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constants
define( 'LAW_FIRM_CONTACT_VERSION', '1.0.0' );
define( 'LAW_FIRM_CONTACT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LAW_FIRM_CONTACT_PLUGIN_URL', get_stylesheet_directory_uri() . '/plugins/' );

// Include necessary files
require_once LAW_FIRM_CONTACT_PLUGIN_DIR . 'includes/class-law-firm-contact.php';

// Initialize the plugin when the theme is ready
function law_firm_contact_init() {
    if ( class_exists( 'Law_Firm_Contact' ) ) {
        $plugin = new Law_Firm_Contact();
        $plugin->init();
    }
}
add_action( 'after_setup_theme', 'law_firm_contact_init' );
