<?php
/**
 * This post type is used to run the authors module
 * Default assumes that all fields are added through ACF
 */
new MeanpugTestCPT_Authors();

class MeanpugTestCPT_Authors extends MeanpugTestCPT_Prototype{
	protected $key = 'author';
	protected $label = 'Author';
	protected $registration = [
		"public" => false,
		"publicly_queryable" => false,
		"has_archive" => false,
		"show_in_nav_menus" => false,
		"exclude_from_search" => true,
		"rewrite" => false,
		"query_var" => false,
		'menu_icon' => 'dashicons-welcome-learn-more',
		"supports" => [
			"title",
			"thumbnail",
		]
	];

}
