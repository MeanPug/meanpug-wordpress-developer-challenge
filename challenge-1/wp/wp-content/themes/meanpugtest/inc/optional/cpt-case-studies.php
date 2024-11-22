<?php

new NarwhalBoilerplate62122CPT_CaseStudies();

class NarwhalBoilerplate62122CPT_CaseStudies extends NarwhalBoilerplate62122CPT_Prototype{
	protected $key = 'case_study';
	protected $label = 'Case Study';
	protected $plural_label = 'Case Studies';
	protected $registration = [
		'menu_icon' => 'dashicons-clipboard',
		'supports' => [
			"title",
			"thumbnail",
			'page-attributes',
		]
	];

	function __construct(){
		add_filter( "narwhal-boilerplate-62122/{$this->key}/excerpt", [ $this, 'custom_excerpt' ] );
		parent::__construct();
	}

	function custom_excerpt( $excerpt ){
		return get_field( 'description' );
	}

	function module_default_value( $default, $field ){
		switch( $field['name'] ){
			case 'title_type':
				if( isset( $field['_clone'] ) ):
					switch( $field['_clone'] ){
						case 'field_602fedd46db27':
							return 'h1';
						break;
					}
				endif;
			break;
			case 'title_text':
				if( isset( $field['_clone'] ) ):
					switch( $field['_clone'] ){
						case 'field_6033d1a2929fa':
							return __( 'Key Outcomes', 'narwhal-boilerplate-62122' );
						break;
						case 'field_6033d140929f8':
							return __( 'Related Case Studies', 'narwhal-boilerplate-62122' );
						break;
					}
				endif;
			break;
		}
		return parent::module_default_value( $default, $field );
	}
}
