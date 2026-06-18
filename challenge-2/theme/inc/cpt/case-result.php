<?php
/**
 * Case Result (Verdicts & Settlements) CPT.
 *
 * Own-initiative content type — every PI firm publishes verdicts/settlements as
 * social proof. The theme's SEO schema file already anticipates a "Result"
 * entity (`inc/utils/seo/schema.php`). Each result carries an amount, case type,
 * year, the responsible attorney (`team`) and related practice areas via ACF.
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `case-result` post type.
 *
 * @return void
 */
function inf_register_case_result_cpt() {
	inf_register_post_type(
		'case-result',
		esc_html__( 'Case Result', 'inf' ),
		esc_html__( 'Case Results', 'inf' ),
		array(
			'menu_icon' => 'dashicons-awards',
			'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'rewrite'   => array( 'slug' => 'results' ),
			'labels'    => array(
				'menu_name' => esc_html__( 'Verdicts & Settlements', 'inf' ),
			),
		)
	);
}
add_action( 'init', 'inf_register_case_result_cpt' );
