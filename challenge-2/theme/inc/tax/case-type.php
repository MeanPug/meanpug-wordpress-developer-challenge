<?php
function pug_register_tax_case_position() {
    register_taxonomy('case-type', ['case_result', 'case_area'], [
        'hierarchical'      => false,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'case-position'],
    ]);
}
add_action('init', 'pug_register_tax_case_position');