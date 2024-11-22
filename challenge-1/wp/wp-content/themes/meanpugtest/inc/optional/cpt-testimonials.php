<?php
/**
 * This post type is used to run the testimonial module 
 * Default assumes that all fields are added through ACF, post title is admin use only, menu order used for query sorting
 */
new NarwhalBoilerplate62122CPT_Testimonials();

class NarwhalBoilerplate62122CPT_Testimonials extends NarwhalBoilerplate62122CPT_Prototype{
	protected $key = 'testimonial';
	protected $label = 'Testimonial';
	protected $registration = [
		"public" => false,
		"publicly_queryable" => false,
		"has_archive" => false,
		"show_in_nav_menus" => false,
		"exclude_from_search" => true,
		"rewrite" => false,
		"query_var" => false,
		'menu_icon' => 'dashicons-testimonial',
		"supports" => [
			"title",
			"page-attributes",
		]
	];

}
