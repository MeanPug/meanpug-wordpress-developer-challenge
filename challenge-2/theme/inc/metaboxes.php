<?php
/**
 * Custom Metaboxes for Law Firm Theme
 */

// Add metabox for attorney details
function add_attorney_metabox() {
    add_meta_box(
        'attorney_details',
        'Attorney Details',
        'attorney_details_callback',
        'attorney',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_attorney_metabox' );

// Callback function for attorney details metabox
function attorney_details_callback( $post ) {
    wp_nonce_field( 'attorney_details_nonce', 'attorney_details_nonce' );

    $position = get_post_meta( $post->ID, '_attorney_position', true );
    $phone = get_post_meta( $post->ID, '_attorney_phone', true );
    $email = get_post_meta( $post->ID, '_attorney_email', true );
    $bio = get_post_meta( $post->ID, '_attorney_bio', true );

    ?>
    <table class="form-table">
        <tr>
            <th><label for="attorney_position">Position</label></th>
            <td><input type="text" id="attorney_position" name="attorney_position" value="<?php echo esc_attr( $position ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="attorney_phone">Phone</label></th>
            <td><input type="tel" id="attorney_phone" name="attorney_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="attorney_email">Email</label></th>
            <td><input type="email" id="attorney_email" name="attorney_email" value="<?php echo esc_attr( $email ); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="attorney_bio">Short Bio</label></th>
            <td><textarea id="attorney_bio" name="attorney_bio" rows="4" class="large-text"><?php echo esc_textarea( $bio ); ?></textarea></td>
        </tr>
    </table>
    <?php
}

// Save attorney details
function save_attorney_details( $post_id ) {
    if ( ! isset( $_POST['attorney_details_nonce'] ) || ! wp_verify_nonce( $_POST['attorney_details_nonce'], 'attorney_details_nonce' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    $fields = array( 'attorney_position', 'attorney_phone', 'attorney_email', 'attorney_bio' );

    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post', 'save_attorney_details' );

// Add metabox for case details
function add_case_metabox() {
    add_meta_box(
        'case_details',
        'Case Details',
        'case_details_callback',
        'case',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_case_metabox' );

// Callback function for case details metabox
function case_details_callback( $post ) {
    wp_nonce_field( 'case_details_nonce', 'case_details_nonce' );

    $settlement_amount = get_post_meta( $post->ID, '_case_settlement_amount', true );
    $case_date = get_post_meta( $post->ID, '_case_date', true );
    $client_name = get_post_meta( $post->ID, '_case_client_name', true );

    ?>
    <table class="form-table">
        <tr>
            <th><label for="case_settlement_amount">Settlement Amount</label></th>
            <td><input type="text" id="case_settlement_amount" name="case_settlement_amount" value="<?php echo esc_attr( $settlement_amount ); ?>" class="regular-text" placeholder="e.g., $500,000"></td>
        </tr>
        <tr>
            <th><label for="case_date">Case Date</label></th>
            <td><input type="date" id="case_date" name="case_date" value="<?php echo esc_attr( $case_date ); ?>"></td>
        </tr>
        <tr>
            <th><label for="case_client_name">Client Name (Anonymous)</label></th>
            <td><input type="text" id="case_client_name" name="case_client_name" value="<?php echo esc_attr( $client_name ); ?>" class="regular-text" placeholder="Use initials or keep anonymous"></td>
        </tr>
    </table>
    <?php
}

// Save case details
function save_case_details( $post_id ) {
    if ( ! isset( $_POST['case_details_nonce'] ) || ! wp_verify_nonce( $_POST['case_details_nonce'], 'case_details_nonce' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    $fields = array( 'case_settlement_amount', 'case_date', 'case_client_name' );

    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post', 'save_case_details' );
