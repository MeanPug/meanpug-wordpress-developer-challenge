<?php
function pug_register_tax_practice_area_position() {
    register_taxonomy('practice-area-group', ['practice_area'], [
        'hierarchical'      => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'practice-area-position'],
    ]);
}
add_action('init', 'pug_register_tax_practice_area_position');