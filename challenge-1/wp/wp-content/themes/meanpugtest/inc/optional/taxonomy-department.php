<?php
new NarwhalDigitalDepartmentTaxonomy();

class NarwhalDigitalDepartmentTaxonomy{
	function __construct(){
		add_action( 'init', [ $this, 'register' ] );
	}

	function register(){
		$args = [
			'labels' => [
				'name' => 'Departments',
				'singular_name' => 'Department',
			],
			'description' => __( '', 'narwhal-digital' ),
			'public' => true,
			'publicly_queryable' => false,
			'hierarchical' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => false,
			'show_in_rest' => false,
			'show_tagcloud' => false,
			'show_admin_column' => true,
			'rewrite' => false,
		];

		register_taxonomy( 'department', [
			'team_member',
		 ], $args );
	}
}
