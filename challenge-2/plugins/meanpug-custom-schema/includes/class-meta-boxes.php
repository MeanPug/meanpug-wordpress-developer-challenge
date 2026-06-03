<?php
declare( strict_types=1 );

namespace MeanPug\CustomSchema;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Meta_Boxes {

    public function register(): void {
        add_meta_box(
            'attorney_details',
            'Attorney Details',
            [ $this, 'render_attorney_meta_box' ],
            'attorney',
            'normal',
            'high'
        );

        add_meta_box(
            'practice_area_details',
            'Practice Area Details',
            [ $this, 'render_practice_area_meta_box' ],
            'practice_area',
            'normal',
            'high'
        );

        add_meta_box(
            'case_result_details',
            'Case Result Details',
            [ $this, 'render_case_result_meta_box' ],
            'case_result',
            'normal',
            'high'
        );
    }

    public function render_attorney_meta_box( \WP_Post $post ): void {
        wp_nonce_field( 'meanpug_attorney_meta', 'meanpug_attorney_nonce' );

        $designation      = get_post_meta( $post->ID, '_attorney_designation', true );
        $bar_year         = get_post_meta( $post->ID, '_attorney_bar_year', true );
        $law_school       = get_post_meta( $post->ID, '_attorney_law_school', true );
        $graduation_year  = get_post_meta( $post->ID, '_attorney_graduation_year', true );
        $phone            = get_post_meta( $post->ID, '_attorney_phone', true );
        $email            = get_post_meta( $post->ID, '_attorney_email', true );
        $linkedin         = get_post_meta( $post->ID, '_attorney_linkedin', true );
        $years_experience = get_post_meta( $post->ID, '_attorney_years_experience', true );
        ?>
        <table class="meanpug-meta-table">
            <tr>
                <td><label for="attorney_designation">Designation</label></td>
                <td><input type="text" id="attorney_designation" name="attorney_designation" value="<?php echo esc_attr( $designation ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="attorney_bar_year">Bar Admission Year</label></td>
                <td><input type="number" id="attorney_bar_year" name="attorney_bar_year" value="<?php echo esc_attr( $bar_year ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="attorney_law_school">Law School</label></td>
                <td><input type="text" id="attorney_law_school" name="attorney_law_school" value="<?php echo esc_attr( $law_school ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="attorney_graduation_year">Graduation Year</label></td>
                <td><input type="number" id="attorney_graduation_year" name="attorney_graduation_year" value="<?php echo esc_attr( $graduation_year ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="attorney_phone">Direct Phone</label></td>
                <td><input type="text" id="attorney_phone" name="attorney_phone" value="<?php echo esc_attr( $phone ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="attorney_email">Direct Email</label></td>
                <td><input type="email" id="attorney_email" name="attorney_email" value="<?php echo esc_attr( $email ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="attorney_linkedin">LinkedIn URL</label></td>
                <td><input type="url" id="attorney_linkedin" name="attorney_linkedin" value="<?php echo esc_attr( $linkedin ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="attorney_years_experience">Years of Experience</label></td>
                <td><input type="number" id="attorney_years_experience" name="attorney_years_experience" value="<?php echo esc_attr( $years_experience ); ?>" /></td>
            </tr>
        </table>
        <?php
    }

    public function render_practice_area_meta_box( \WP_Post $post ): void {
        wp_nonce_field( 'meanpug_practice_area_meta', 'meanpug_practice_area_nonce' );

        $summary           = get_post_meta( $post->ID, '_practice_area_summary', true );
        $icon              = get_post_meta( $post->ID, '_practice_area_icon', true );
        $free_consultation = get_post_meta( $post->ID, '_practice_area_free_consultation', true );
        ?>
        <table class="meanpug-meta-table">
            <tr>
                <td><label for="practice_area_summary">Short Summary</label></td>
                <td><textarea id="practice_area_summary" name="practice_area_summary" rows="3"><?php echo esc_textarea( $summary ); ?></textarea></td>
            </tr>
            <tr>
                <td><label for="practice_area_icon">Icon Class</label></td>
                <td><input type="text" id="practice_area_icon" name="practice_area_icon" value="<?php echo esc_attr( $icon ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="practice_area_free_consultation">Free Consultation</label></td>
                <td><input type="checkbox" id="practice_area_free_consultation" name="practice_area_free_consultation" value="1" <?php checked( $free_consultation, '1' ); ?> /></td>
            </tr>
        </table>
        <?php
    }

    public function render_case_result_meta_box( \WP_Post $post ): void {
        wp_nonce_field( 'meanpug_case_result_meta', 'meanpug_case_result_nonce' );

        $amount      = get_post_meta( $post->ID, '_case_result_amount', true );
        $case_type   = get_post_meta( $post->ID, '_case_result_case_type', true );
        $court       = get_post_meta( $post->ID, '_case_result_court', true );
        $year        = get_post_meta( $post->ID, '_case_result_year', true );
        $is_featured = get_post_meta( $post->ID, '_case_result_is_featured', true );
        ?>
        <table class="meanpug-meta-table">
            <tr>
                <td><label for="case_result_amount">Verdict / Settlement Amount</label></td>
                <td><input type="text" id="case_result_amount" name="case_result_amount" value="<?php echo esc_attr( $amount ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="case_result_case_type">Case Type</label></td>
                <td><input type="text" id="case_result_case_type" name="case_result_case_type" value="<?php echo esc_attr( $case_type ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="case_result_court">Court / Jurisdiction</label></td>
                <td><input type="text" id="case_result_court" name="case_result_court" value="<?php echo esc_attr( $court ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="case_result_year">Year Resolved</label></td>
                <td><input type="number" id="case_result_year" name="case_result_year" value="<?php echo esc_attr( $year ); ?>" /></td>
            </tr>
            <tr>
                <td><label for="case_result_is_featured">Featured</label></td>
                <td><input type="checkbox" id="case_result_is_featured" name="case_result_is_featured" value="1" <?php checked( $is_featured, '1' ); ?> /></td>
            </tr>
        </table>
        <?php
    }

    public function save( int $post_id, \WP_Post $post ): void {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $this->save_attorney_meta( $post_id, $post );
        $this->save_practice_area_meta( $post_id, $post );
        $this->save_case_result_meta( $post_id, $post );
    }

    private function save_attorney_meta( int $post_id, \WP_Post $post ): void {
        if ( 'attorney' !== $post->post_type ) {
            return;
        }

        if ( ! isset( $_POST['meanpug_attorney_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['meanpug_attorney_nonce'] ) ), 'meanpug_attorney_meta' ) ) {
            return;
        }

        $fields = [
            '_attorney_designation'      => 'sanitize_text_field',
            '_attorney_bar_year'         => 'absint',
            '_attorney_law_school'       => 'sanitize_text_field',
            '_attorney_graduation_year'  => 'absint',
            '_attorney_phone'            => 'sanitize_text_field',
            '_attorney_email'            => 'sanitize_email',
            '_attorney_linkedin'         => 'esc_url_raw',
            '_attorney_years_experience' => 'absint',
        ];

        $post_keys = [
            '_attorney_designation'      => 'attorney_designation',
            '_attorney_bar_year'         => 'attorney_bar_year',
            '_attorney_law_school'       => 'attorney_law_school',
            '_attorney_graduation_year'  => 'attorney_graduation_year',
            '_attorney_phone'            => 'attorney_phone',
            '_attorney_email'            => 'attorney_email',
            '_attorney_linkedin'         => 'attorney_linkedin',
            '_attorney_years_experience' => 'attorney_years_experience',
        ];

        foreach ( $fields as $meta_key => $sanitize_callback ) {
            $post_key = $post_keys[ $meta_key ];
            if ( isset( $_POST[ $post_key ] ) ) {
                update_post_meta( $post_id, $meta_key, $sanitize_callback( wp_unslash( $_POST[ $post_key ] ) ) );
            }
        }
    }

    private function save_practice_area_meta( int $post_id, \WP_Post $post ): void {
        if ( 'practice_area' !== $post->post_type ) {
            return;
        }

        if ( ! isset( $_POST['meanpug_practice_area_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['meanpug_practice_area_nonce'] ) ), 'meanpug_practice_area_meta' ) ) {
            return;
        }

        if ( isset( $_POST['practice_area_summary'] ) ) {
            update_post_meta( $post_id, '_practice_area_summary', sanitize_textarea_field( wp_unslash( $_POST['practice_area_summary'] ) ) );
        }

        if ( isset( $_POST['practice_area_icon'] ) ) {
            update_post_meta( $post_id, '_practice_area_icon', sanitize_text_field( wp_unslash( $_POST['practice_area_icon'] ) ) );
        }

        $free_consultation = isset( $_POST['practice_area_free_consultation'] ) ? '1' : '0';
        update_post_meta( $post_id, '_practice_area_free_consultation', $free_consultation );
    }

    private function save_case_result_meta( int $post_id, \WP_Post $post ): void {
        if ( 'case_result' !== $post->post_type ) {
            return;
        }

        if ( ! isset( $_POST['meanpug_case_result_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['meanpug_case_result_nonce'] ) ), 'meanpug_case_result_meta' ) ) {
            return;
        }

        if ( isset( $_POST['case_result_amount'] ) ) {
            update_post_meta( $post_id, '_case_result_amount', sanitize_text_field( wp_unslash( $_POST['case_result_amount'] ) ) );
        }

        if ( isset( $_POST['case_result_case_type'] ) ) {
            update_post_meta( $post_id, '_case_result_case_type', sanitize_text_field( wp_unslash( $_POST['case_result_case_type'] ) ) );
        }

        if ( isset( $_POST['case_result_court'] ) ) {
            update_post_meta( $post_id, '_case_result_court', sanitize_text_field( wp_unslash( $_POST['case_result_court'] ) ) );
        }

        if ( isset( $_POST['case_result_year'] ) ) {
            update_post_meta( $post_id, '_case_result_year', absint( $_POST['case_result_year'] ) );
        }

        $is_featured = isset( $_POST['case_result_is_featured'] ) ? '1' : '0';
        update_post_meta( $post_id, '_case_result_is_featured', $is_featured );
    }
}