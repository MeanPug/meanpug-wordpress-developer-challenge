<?php
function pug_register_tax_region_position() {
    register_taxonomy('region', ['office', 'region_area'], [
        'hierarchical'      => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'region-position'],
    ]);
}
add_action('init', 'pug_register_tax_region_position');