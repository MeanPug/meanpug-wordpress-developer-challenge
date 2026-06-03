<?php

if (function_exists('pplf_register_post_types')) {
    add_action('init', 'pplf_register_post_types', 10);
} else {
    require_once WP_PLUGIN_DIR . '/pug-puggle-law-firm/inc/cpt/all.php';
}
