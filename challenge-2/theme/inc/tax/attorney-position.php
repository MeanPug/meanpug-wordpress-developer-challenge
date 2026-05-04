<?php
function pug_register_tax_attorney_position() {
    register_taxonomy('attorney-position', ['attorney'], [
        'labels'            => [/* ... */],
        'hierarchical'      => false,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'attorney-position'],
    ]);
}
add_action('init', 'pug_register_tax_attorney_position');