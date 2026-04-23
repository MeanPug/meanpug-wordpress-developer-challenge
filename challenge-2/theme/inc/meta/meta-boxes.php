<?php
/**
 * Admin meta boxes
 *
 * Lightweight native meta boxes for the headline fields on each CPT.
 * The complete schema is declared in meta/all.php via register_post_meta
 * (so REST / block editor / ACF can all see every field). This file
 * only adds a simple UI for the most-edited keys so the site is usable
 * without ACF Pro installed.
 *
 * @package pnp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Declarative config: post_type => [ box_id => [ title, fields[] ] ]
 * Each field = [ key, label, type ]. type: text|url|email|tel|number|textarea
 */
function pnp_meta_box_config() {
	return array(
		'attorney' => array(
			'attorney_details' => array(
				'title'  => __( 'Attorney Details', 'pnp' ),
				'fields' => array(
					array( 'attorney_title',     __( 'Position / Title', 'pnp' ), 'text' ),
					array( 'attorney_email',     __( 'Email', 'pnp' ), 'email' ),
					array( 'attorney_phone',     __( 'Direct Phone', 'pnp' ), 'tel' ),
					array( 'attorney_vcard_url', __( 'vCard URL', 'pnp' ), 'url' ),
				),
			),
		),
		'case_result' => array(
			'case_result_details' => array(
				'title'  => __( 'Case Result Details', 'pnp' ),
				'fields' => array(
					array( 'case_result_amount_cents', __( 'Amount (in cents)', 'pnp' ), 'number' ),
					array( 'case_result_amount_label', __( 'Amount Label (optional)', 'pnp' ), 'text' ),
					array( 'case_result_year',         __( 'Year', 'pnp' ), 'number' ),
					array( 'case_result_is_featured',  __( 'Featured?', 'pnp' ), 'checkbox' ),
				),
			),
		),
		'testimonial' => array(
			'testimonial_details' => array(
				'title'  => __( 'Testimonial Details', 'pnp' ),
				'fields' => array(
					array( 'testimonial_rating',        __( 'Rating (1-5)', 'pnp' ), 'number' ),
					array( 'testimonial_reviewer_name', __( 'Reviewer Name', 'pnp' ), 'text' ),
					array( 'testimonial_reviewer_city', __( 'Reviewer City', 'pnp' ), 'text' ),
					array( 'testimonial_source',        __( 'Source', 'pnp' ), 'text' ),
					array( 'testimonial_source_url',    __( 'Source URL', 'pnp' ), 'url' ),
				),
			),
		),
		'office' => array(
			'office_address' => array(
				'title'  => __( 'Office Address', 'pnp' ),
				'fields' => array(
					array( 'office_street',   __( 'Street', 'pnp' ), 'text' ),
					array( 'office_city',     __( 'City', 'pnp' ), 'text' ),
					array( 'office_region',   __( 'State', 'pnp' ), 'text' ),
					array( 'office_postcode', __( 'Postal Code', 'pnp' ), 'text' ),
					array( 'office_country',  __( 'Country', 'pnp' ), 'text' ),
				),
			),
			'office_contact' => array(
				'title'  => __( 'Office Contact', 'pnp' ),
				'fields' => array(
					array( 'office_phone',     __( 'Phone', 'pnp' ), 'tel' ),
					array( 'office_fax',       __( 'Fax', 'pnp' ), 'tel' ),
					array( 'office_email',     __( 'Email', 'pnp' ), 'email' ),
					array( 'office_latitude',  __( 'Latitude', 'pnp' ), 'number' ),
					array( 'office_longitude', __( 'Longitude', 'pnp' ), 'number' ),
					array( 'office_is_primary', __( 'Primary office?', 'pnp' ), 'checkbox' ),
				),
			),
		),
		'practice_area' => array(
			'practice_area_hero' => array(
				'title'  => __( 'Practice Area Hero', 'pnp' ),
				'fields' => array(
					array( 'practice_area_hero_headline', __( 'Hero Headline', 'pnp' ), 'text' ),
					array( 'practice_area_hero_subhead',  __( 'Hero Subhead', 'pnp' ), 'textarea' ),
					array( 'practice_area_cta_label',     __( 'CTA Label', 'pnp' ), 'text' ),
					array( 'practice_area_cta_url',       __( 'CTA URL', 'pnp' ), 'url' ),
				),
			),
		),
		'faq' => array(
			'faq_details' => array(
				'title'  => __( 'FAQ Details', 'pnp' ),
				'fields' => array(
					array( 'faq_answer_summary', __( 'Short Answer Summary (for schema)', 'pnp' ), 'textarea' ),
				),
			),
		),
	);
}

add_action( 'add_meta_boxes', function () {
	foreach ( pnp_meta_box_config() as $post_type => $boxes ) {
		foreach ( $boxes as $box_id => $box ) {
			add_meta_box(
				$box_id,
				$box['title'],
				'pnp_render_meta_box',
				$post_type,
				'normal',
				'default',
				array( 'fields' => $box['fields'] )
			);
		}
	}
} );

function pnp_render_meta_box( $post, $metabox ) {
	wp_nonce_field( 'pnp_meta_save', 'pnp_meta_nonce' );
	$fields = $metabox['args']['fields'];
	echo '<table class="form-table"><tbody>';
	foreach ( $fields as $f ) {
		list( $key, $label, $type ) = $f;
		$value = get_post_meta( $post->ID, $key, true );
		$id    = 'pnp_' . $key;
		echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label></th><td>';

		switch ( $type ) {
			case 'textarea':
				printf(
					'<textarea id="%1$s" name="%1$s" rows="3" class="large-text">%2$s</textarea>',
					esc_attr( $id ),
					esc_textarea( $value )
				);
				break;
			case 'checkbox':
				printf(
					'<label><input type="checkbox" id="%1$s" name="%1$s" value="1"%2$s /> %3$s</label>',
					esc_attr( $id ),
					checked( (bool) $value, true, false ),
					esc_html__( 'Yes', 'pnp' )
				);
				break;
			case 'number':
				printf(
					'<input type="number" step="any" id="%1$s" name="%1$s" value="%2$s" class="regular-text" />',
					esc_attr( $id ),
					esc_attr( $value )
				);
				break;
			case 'email':
			case 'url':
			case 'tel':
			default:
				$input_type = in_array( $type, array( 'email', 'url', 'tel' ), true ) ? $type : 'text';
				printf(
					'<input type="%3$s" id="%1$s" name="%1$s" value="%2$s" class="regular-text" />',
					esc_attr( $id ),
					esc_attr( $value ),
					esc_attr( $input_type )
				);
				break;
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

add_action( 'save_post', function ( $post_id ) {
	if ( ! isset( $_POST['pnp_meta_nonce'] ) || ! wp_verify_nonce( $_POST['pnp_meta_nonce'], 'pnp_meta_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$post_type = get_post_type( $post_id );
	$config    = pnp_meta_box_config();
	if ( empty( $config[ $post_type ] ) ) {
		return;
	}

	foreach ( $config[ $post_type ] as $box ) {
		foreach ( $box['fields'] as $f ) {
			list( $key, , $type ) = $f;
			$input_name = 'pnp_' . $key;

			if ( $type === 'checkbox' ) {
				update_post_meta( $post_id, $key, isset( $_POST[ $input_name ] ) ? 1 : 0 );
				continue;
			}

			if ( ! isset( $_POST[ $input_name ] ) ) {
				continue;
			}

			$raw = wp_unslash( $_POST[ $input_name ] );
			switch ( $type ) {
				case 'email':
					$clean = sanitize_email( $raw );
					break;
				case 'url':
					$clean = esc_url_raw( $raw );
					break;
				case 'number':
					$clean = is_numeric( $raw ) ? $raw + 0 : '';
					break;
				case 'textarea':
					$clean = sanitize_textarea_field( $raw );
					break;
				default:
					$clean = sanitize_text_field( $raw );
			}
			update_post_meta( $post_id, $key, $clean );
		}
	}
} );
