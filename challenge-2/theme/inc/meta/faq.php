<?php
add_action('init', 'pug_register_faq_meta');
function pug_register_faq_meta() {
    register_post_meta('faq', 'faq_answer', [
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
    ]);
}

add_action('add_meta_boxes', 'pug_add_faq_meta_box');
function pug_add_faq_meta_box() {
    add_meta_box('faq_details', 'Answer', 'pug_faq_meta_box', 'faq', 'normal');
}

function pug_faq_meta_box($post) {
    wp_nonce_field('pug_faq_meta', 'pug_faq_meta_nonce');
    $faq_answer = get_post_meta($post->ID, 'faq_answer', true);
    ?>
    <p>
        <label for="pug_faq_answer">FAQ Answer:</label><br>
        <textarea id="pug_faq_answer" name="faq_answer" rows="8" cols="60"><?php echo esc_textarea($faq_answer); ?></textarea>
    </p>
    <?php
}

add_action('save_post', 'pug_save_faq_meta');
function pug_save_faq_meta($post_id) {
    if (!isset($_POST['pug_faq_meta_nonce']) || !wp_verify_nonce($_POST['pug_faq_meta_nonce'], 'pug_faq_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['faq_answer'])) {
        update_post_meta($post_id, 'faq_answer', sanitize_textarea_field($_POST['faq_answer']));
    }
}