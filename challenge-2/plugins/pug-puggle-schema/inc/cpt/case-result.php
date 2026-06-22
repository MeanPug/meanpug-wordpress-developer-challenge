<?php
/**
 * Case Result post type.
 *
 * Verdicts and settlements — the "we won $4.2M" social proof every PI firm leads
 * with (see forthepeople.com / milberg.com). Not referenced by the inherited
 * theme, but a load-bearing part of a real firm's content model, so it ships here
 * with the rest of the schema. Pairs with the `amount` / `result_type` fields in
 * inc/fields/case-result.php.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `case-result` post type.
 *
 * @return void
 */
function pps_register_case_result_cpt() {
	register_post_type(
		'case-result',
		array(
			'labels'        => pps_post_type_labels(
				__( 'Case Result', 'pug-puggle-schema' ),
				__( 'Case Results', 'pug-puggle-schema' )
			),
			'public'        => true,
			'hierarchical'  => false,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-awards',
			'menu_position' => 26,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'case-results',
				'with_front' => false,
			),
			'taxonomies'    => array( 'area-served' ),
		)
	);
}
