<?php
new NarwhalBoilerplate62122LogoTagTaxonomy();

class NarwhalBoilerplate62122LogoTagTaxonomy{
	function __construct(){
		add_action( 'init', [ $this, 'register' ] );
	}

	function register(){
		$args = [
			'labels' => [
				'name' => 'Tags',
				'singular_name' => 'Tag',
			],
			'description' => __( '', 'narwhal-boilerplate-62122' ),
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

		register_taxonomy( 'logo_tag', [
			'logo',
		 ], $args );
	}
}
