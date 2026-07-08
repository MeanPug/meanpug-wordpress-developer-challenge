<?php
/**
 * Registers custom taxonomies for the law firm content model.
 *
 * @package MeanPugLawFirmCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Builds reusable labels for a taxonomy.
 *
 * @param string $singular Singular label.
 * @param string $plural   Plural label.
 * @return array
 */
function mp_law_firm_core_get_taxonomy_labels( $singular, $plural ) {
	return array(
		'name'              => _x( $plural, 'Taxonomy general name', 'mp-law-firm-core' ),
		'singular_name'     => _x( $singular, 'Taxonomy singular name', 'mp-law-firm-core' ),
		'search_items'      => sprintf( __( 'Search %s', 'mp-law-firm-core' ), $plural ),
		'all_items'         => sprintf( __( 'All %s', 'mp-law-firm-core' ), $plural ),
		'parent_item'       => sprintf( __( 'Parent %s', 'mp-law-firm-core' ), $singular ),
		'parent_item_colon' => sprintf( __( 'Parent %s:', 'mp-law-firm-core' ), $singular ),
		'edit_item'         => sprintf( __( 'Edit %s', 'mp-law-firm-core' ), $singular ),
		'update_item'       => sprintf( __( 'Update %s', 'mp-law-firm-core' ), $singular ),
		'add_new_item'      => sprintf( __( 'Add New %s', 'mp-law-firm-core' ), $singular ),
		'new_item_name'     => sprintf( __( 'New %s Name', 'mp-law-firm-core' ), $singular ),
		'menu_name'         => $plural,
	);
}

/**
 * Registers law firm custom taxonomies.
 *
 * @return void
 */
function mp_law_firm_core_register_taxonomies() {
	$taxonomies = array(
		'practice-area-type' => array(
			'singular'    => 'Practice Area Type',
			'plural'      => 'Practice Area Types',
			'post_types'  => array( 'practice-area' ),
			'rewrite'     => 'practice-area-type',
			'hierarchical' => true,
		),
		'attorney-role'      => array(
			'singular'    => 'Attorney Role',
			'plural'      => 'Attorney Roles',
			'post_types'  => array( 'attorney' ),
			'rewrite'     => 'attorney-role',
			'hierarchical' => true,
		),
		'area-served'        => array(
			'singular'    => 'Area Served',
			'plural'      => 'Areas Served',
			'post_types'  => array( 'office', 'practice-area', 'case-result' ),
			'rewrite'     => 'areas-served',
			'hierarchical' => true,
		),
		'case-result-type'   => array(
			'singular'    => 'Case Result Type',
			'plural'      => 'Case Result Types',
			'post_types'  => array( 'case-result' ),
			'rewrite'     => 'case-result-type',
			'hierarchical' => true,
		),
	);

	foreach ( $taxonomies as $taxonomy => $config ) {
		register_taxonomy(
			$taxonomy,
			$config['post_types'],
			array(
				'labels'            => mp_law_firm_core_get_taxonomy_labels( $config['singular'], $config['plural'] ),
				'public'            => true,
				'hierarchical'      => $config['hierarchical'],
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'query_var'         => true,
				'rewrite'           => array(
					'slug'       => $config['rewrite'],
					'with_front' => false,
				),
			)
		);
	}
}
add_action( 'init', 'mp_law_firm_core_register_taxonomies' );