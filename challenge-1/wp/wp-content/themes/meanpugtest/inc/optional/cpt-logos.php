<?php
/**
 * This post type is used to run the logo grid and logo slider modules
 * Default assumes that all fields are added through ACF
 */
new MeanpugTestCPT_Logos();

class MeanpugTestCPT_Logos extends MeanpugTestCPT_Prototype{
	protected $key = 'logo';
	protected $label = 'Logo';
	protected $registration = [
		"public" => false,
		"publicly_queryable" => false,
		"has_archive" => false,
		"show_in_nav_menus" => false,
		"exclude_from_search" => true,
		"rewrite" => false,
		"query_var" => false,
		'menu_icon' => 'dashicons-share',
		"supports" => [
			"title",
			"page-attributes",
		]
	];

}
