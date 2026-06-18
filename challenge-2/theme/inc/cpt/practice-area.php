<?php
/**
 * Practice Area CPT.
 *
 * Core PI content type (Car Accidents, Medical Malpractice, ...). Referenced by
 * `inc/widgets/practice-areas.php` (queries by `post_parent` + `menu_order`),
 * `single.php` (child topics explorer), the practice-area archive template and
 * `inc/utils/seo/schema.php` (Product schema). Hierarchical so editors can nest
 * sub-practice-areas and order them via the page-attributes box.
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `practice-area` post type.
 *
 * @return void
 */
function inf_register_practice_area_cpt() {
	inf_register_post_type(
		'practice-area',
		esc_html__( 'Practice Area', 'inf' ),
		esc_html__( 'Practice Areas', 'inf' ),
		array(
			'hierarchical' => true,
			'menu_icon'    => 'dashicons-portfolio',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			// Practice areas are categorised with the core `category` taxonomy
			// (see inc/widgets/practice-areas.php), so opt it in here.
			'taxonomies'   => array( 'category' ),
		)
	);
}
add_action( 'init', 'inf_register_practice_area_cpt' );
