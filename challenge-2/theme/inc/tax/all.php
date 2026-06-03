<?php

if (!function_exists('pplf_register_taxonomies')) {
    require_once WP_PLUGIN_DIR . '/pug-puggle-law-firm/inc/tax/all.php';
    add_action('init', 'pplf_register_taxonomies');
}
