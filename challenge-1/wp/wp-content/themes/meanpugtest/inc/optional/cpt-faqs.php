<?php
/**
 * This post type is used to run the testimonial module 
 * Default assumes that all fields are added through ACF, post title is admin use only, menu order used for query sorting
 */
new MeanpugTestCPT_FAQs();

class MeanpugTestCPT_FAQs extends MeanpugTestCPT_Prototype{
	protected $key = 'faq';
	protected $label = 'FAQ';
	protected $registration = [
		"public" => false,
		"publicly_queryable" => false,
		"has_archive" => false,
		"show_in_nav_menus" => false,
		"exclude_from_search" => true,
		"rewrite" => false,
		"query_var" => false,
		'menu_icon' => 'dashicons-info',
		"supports" => [
			"title",
			"editor",
		]
	];

}
