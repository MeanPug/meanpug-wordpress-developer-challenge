<?php
/**
 * Plugin Name: Pug & Puggle Law Firm
 * Description: Custom post types, taxonomies, and field groups for the Pug & Puggle, ESQ law firm website.
 * Version: 1.0.0
 * Author: MeanPug Digital
 * Text Domain: pug-puggle-law
 */

define('PPLF_VERSION', '1.0.0');
define('PPLF_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once PPLF_PLUGIN_DIR . 'inc/cpt/all.php';
require_once PPLF_PLUGIN_DIR . 'inc/tax/all.php';

register_activation_hook(__FILE__, 'pplf_flush_rewrites');
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');
