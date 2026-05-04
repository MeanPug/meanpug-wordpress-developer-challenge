<?php
add_action('init', 'pug_register_practice_area_meta');
function pug_register_practice_area_meta() {
    register_post_meta('practice_area', 'icon', [
        'type'         => 'integer',
        'single'       => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('practice_area', 'short_description', [
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
    ]);
}

add_action('add_meta_boxes', 'pug_add_practice_area_meta_box');
function pug_add_practice_area_meta_box() {
    add_meta_box('practice_area_details', 'Practice Area Details', 'pug_practice_area_meta_box', 'practice_area', 'normal');
}

function pug_practice_area_meta_box($post) {
    wp_nonce_field('pug_practice_area_meta', 'pug_practice_area_meta_nonce');
    $icon_id           = get_post_meta($post->ID, 'icon', true);
    $short_description = get_post_meta($post->ID, 'short_description', true);
    ?>
    <p>
        <label for="pug_icon">Icon (Media ID):</label><br>
        <input type="number" id="pug_icon" name="icon" value="<?php echo esc_attr($icon_id); ?>" min="0" step="1" size="10">
        <?php if ($icon_id) : ?>
            <br><small><?php echo wp_get_attachment_image($icon_id, 'thumbnail'); ?></small>
        <?php endif; ?>
    </p>
    <p>
        <label for="pug_short_description">Short Description:</label><br>
        <textarea id="pug_short_description" name="short_description" rows="3" cols="50"><?php echo esc_textarea($short_description); ?></textarea>
    </p>
    <?php
}

add_action('save_post', 'pug_save_practice_area_meta');
function pug_save_practice_area_meta($post_id) {
    if (!isset($_POST['pug_practice_area_meta_nonce']) || !wp_verify_nonce($_POST['pug_practice_area_meta_nonce'], 'pug_practice_area_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['icon'])) {
        update_post_meta($post_id, 'icon', intval($_POST['icon']));
    }
    if (isset($_POST['short_description'])) {
        update_post_meta($post_id, 'short_description', sanitize_textarea_field($_POST['short_description']));
    }
}