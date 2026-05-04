<?php
add_action('init', 'pug_register_testimonial_meta');
function pug_register_testimonial_meta() {
    register_post_meta('testimonial', 'client_name', [
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('testimonial', 'rating', [
        'type'         => 'number',
        'single'       => true,
        'show_in_rest' => true,
    ]);
}

add_action('add_meta_boxes', 'pug_add_testimonial_meta_box');
function pug_add_testimonial_meta_box() {
    add_meta_box('testimonial_details', 'Testimonial Details', 'pug_testimonial_meta_box', 'testimonial', 'normal');
}

function pug_testimonial_meta_box($post) {
    wp_nonce_field('pug_testimonial_meta', 'pug_testimonial_meta_nonce');
    $client_name = get_post_meta($post->ID, 'client_name', true);
    $rating      = get_post_meta($post->ID, 'rating', true);
    ?>
    <p>
        <label for="pug_client_name">Client Name:</label><br>
        <input type="text" id="pug_client_name" name="client_name" value="<?php echo esc_attr($client_name); ?>" size="40">
    </p>
    <p>
        <label for="pug_rating">Rating (1-5):</label><br>
        <input type="number" id="pug_rating" name="rating" value="<?php echo esc_attr($rating); ?>" min="1" max="5" step="0.1" size="10">
    </p>
    <?php
}

add_action('save_post', 'pug_save_testimonial_meta');
function pug_save_testimonial_meta($post_id) {
    if (!isset($_POST['pug_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['pug_testimonial_meta_nonce'], 'pug_testimonial_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['client_name'])) {
        update_post_meta($post_id, 'client_name', sanitize_text_field($_POST['client_name']));
    }
    if (isset($_POST['rating'])) {
        update_post_meta($post_id, 'rating', floatval($_POST['rating']));
    }
}