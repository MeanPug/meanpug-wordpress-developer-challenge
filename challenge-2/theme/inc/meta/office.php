<?php
// inc/meta/office.php
// Registers and handles meta fields for the Office custom post type.

add_action('init', 'pug_register_office_meta');
function pug_register_office_meta() {
    register_post_meta('office', 'address', [
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('office', 'phone', [
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('office', 'city', [
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
    ]);
}

add_action('add_meta_boxes', 'pug_add_office_meta_box');
function pug_add_office_meta_box() {
    add_meta_box('office_details', 'Office Details', 'pug_office_meta_box', 'office', 'normal');
}

function pug_office_meta_box($post) {
    wp_nonce_field('pug_office_meta', 'pug_office_meta_nonce');
    $address = get_post_meta($post->ID, 'address', true);
    $phone   = get_post_meta($post->ID, 'phone', true);
    $city    = get_post_meta($post->ID, 'city', true);
    ?>
    <p>
        <label for="pug_office_address">Address:</label><br>
        <textarea id="pug_office_address" name="address" rows="3" cols="50"><?php echo esc_textarea($address); ?></textarea>
    </p>
    <p>
        <label for="pug_office_phone">Phone:</label><br>
        <input type="text" id="pug_office_phone" name="phone" value="<?php echo esc_attr($phone); ?>" size="30">
    </p>
    <p>
        <label for="pug_office_city">City:</label><br>
        <input type="text" id="pug_office_city" name="city" value="<?php echo esc_attr($city); ?>" size="30">
    </p>
    <?php
}

add_action('save_post', 'pug_save_office_meta');
function pug_save_office_meta($post_id) {
    if (!isset($_POST['pug_office_meta_nonce']) || !wp_verify_nonce($_POST['pug_office_meta_nonce'], 'pug_office_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['address'])) {
        update_post_meta($post_id, 'address', sanitize_textarea_field($_POST['address']));
    }
    if (isset($_POST['phone'])) {
        update_post_meta($post_id, 'phone', sanitize_text_field($_POST['phone']));
    }
    if (isset($_POST['city'])) {
        update_post_meta($post_id, 'city', sanitize_text_field($_POST['city']));
    }
}