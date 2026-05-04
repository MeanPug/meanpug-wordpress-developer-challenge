<?php
add_action('init', 'pug_register_attorney_meta');
function pug_register_attorney_meta() {
    register_post_meta('attorney', 'position', [
        'type'        => 'string',
        'single'      => true,
        'show_in_rest'=> true,
    ]);
    register_post_meta('attorney', 'bar_admissions', [
        'type'        => 'array',
        'single'      => true,
        'show_in_rest'=> [
            'schema' => [
                'type'  => 'array',
                'items' => ['type' => 'string']
            ]
        ]
    ]);
}

// Meta box
add_action('add_meta_boxes', 'pug_add_attorney_meta_boxes');
function pug_add_attorney_meta_boxes() {
    add_meta_box('attorney_details', 'Attorney Details', 'pug_attorney_meta_box', 'attorney', 'normal');
}

function pug_attorney_meta_box($post) {
    wp_nonce_field('pug_attorney_meta', 'pug_attorney_meta_nonce');
    $position = get_post_meta($post->ID, 'position', true);
    $bar_admissions = get_post_meta($post->ID, 'bar_admissions', true);
    if (!is_array($bar_admissions)) $bar_admissions = [];
    ?>
    <p><label>Position:</label><br>
       <input type="text" name="position" value="<?php echo esc_attr($position); ?>" size="40"></p>
    <p><label>Bar Admissions (one per line):</label><br>
       <textarea name="bar_admissions" rows="5" cols="40"><?php echo esc_textarea(implode("\n", $bar_admissions)); ?></textarea></p>
    <?php
}

add_action('save_post', 'pug_save_attorney_meta');
function pug_save_attorney_meta($post_id) {
    if (!isset($_POST['pug_attorney_meta_nonce']) || !wp_verify_nonce($_POST['pug_attorney_meta_nonce'], 'pug_attorney_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['position'])) {
        update_post_meta($post_id, 'position', sanitize_text_field($_POST['position']));
    }
    if (isset($_POST['bar_admissions'])) {
        $lines = sanitize_textarea_field($_POST['bar_admissions']);
        $array = array_filter(array_map('trim', explode("\n", $lines)));
        update_post_meta($post_id, 'bar_admissions', $array);
    }
}