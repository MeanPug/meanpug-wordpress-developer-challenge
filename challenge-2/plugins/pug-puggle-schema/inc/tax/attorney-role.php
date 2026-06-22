<?php
/**
 * Attorney Role taxonomy.
 *
 * Flat tagging for the team: Partner / Associate / Of Counsel / Paralegal. Lets
 * editors group and filter attorneys without hard-coding roles into the post body.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `attorney-role` taxonomy.
 *
 * @return void
 */
function pps_register_attorney_role_taxonomy() {
	register_taxonomy(
		'attorney-role',
		array( 'team' ),
		array(
			'labels'            => pps_taxonomy_labels(
				__( 'Attorney Role', 'pug-puggle-schema' ),
				__( 'Attorney Roles', 'pug-puggle-schema' )
			),
			'public'            => true,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'attorney-role',
				'with_front' => false,
			),
		)
	);
}
