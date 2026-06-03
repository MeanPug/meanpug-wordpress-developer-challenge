<?php

if (function_exists('pplf_register_taxonomies')) {
    add_action('init', 'pplf_register_taxonomies', 10);
} else {
    require_once WP_PLUGIN_DIR . '/pug-puggle-law-firm/inc/tax/all.php';
}
