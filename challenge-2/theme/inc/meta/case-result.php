<?php
add_action('init', 'pug_register_case_result_meta');
function pug_register_case_result_meta() {
    register_post_meta('case_result', 'verdict_amount', [
        'type'         => 'integer',
        'single'       => true,
        'show_in_rest' => true,
    ]);
    register_post_meta('case_result', 'case_summary', [
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
    ]);
}

add_action('add_meta_boxes', 'pug_add_case_result_meta_box');
function pug_add_case_result_meta_box() {
    add_meta_box('case_result_details', 'Case Details', 'pug_case_result_meta_box', 'case_result', 'normal');
}

function pug_case_result_meta_box($post) {
    wp_nonce_field('pug_case_result_meta', 'pug_case_result_meta_nonce');
    $verdict_amount = get_post_meta($post->ID, 'verdict_amount', true);
    $case_summary   = get_post_meta($post->ID, 'case_summary', true);
    ?>
    <p>
        <label for="pug_verdict_amount">Verdict Amount (in cents):</label><br>
        <input type="number" id="pug_verdict_amount" name="verdict_amount" value="<?php echo esc_attr($verdict_amount); ?>" min="0" step="1" size="20">
    </p>
    <p>
        <label for="pug_case_summary">Case Summary:</label><br>
        <textarea id="pug_case_summary" name="case_summary" rows="6" cols="50"><?php echo esc_textarea($case_summary); ?></textarea>
    </p>
    <?php
}

add_action('save_post', 'pug_save_case_result_meta');
function pug_save_case_result_meta($post_id) {
    if (!isset($_POST['pug_case_result_meta_nonce']) || !wp_verify_nonce($_POST['pug_case_result_meta_nonce'], 'pug_case_result_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['verdict_amount'])) {
        update_post_meta($post_id, 'verdict_amount', intval($_POST['verdict_amount']));
    }
    if (isset($_POST['case_summary'])) {
        update_post_meta($post_id, 'case_summary', sanitize_textarea_field($_POST['case_summary']));
    }
}