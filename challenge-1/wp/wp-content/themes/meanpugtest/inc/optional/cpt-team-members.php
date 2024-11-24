<?php
/**
 * This post type is used to run the team member tabber modules
 * Default assumes that all fields are added through ACF
 */
new MeanpugTestCPT_TeamMembers();

class MeanpugTestCPT_TeamMembers extends MeanpugTestCPT_Prototype{
	protected $key = 'team_member';
	protected $label = 'Team Member';
	protected $registration = [
		"public" => false,
		"publicly_queryable" => false,
		"has_archive" => false,
		"show_in_nav_menus" => false,
		"exclude_from_search" => true,
		"rewrite" => false,
		"query_var" => false,
		'menu_icon' => 'dashicons-groups',
		"supports" => [
			"title",
			"editor",
			"page-attributes",
			"thumbnail",
		]
	];

}
