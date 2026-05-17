<?php

function my_custom_post_types() {

    $args = array(
        'labels' => array(
            'name'          => 'Staff',
            'singular_name' => 'staff',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-groups',
        'rewrite'       => array('slug' => 'staff'),
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'  => true, // enables Gutenberg + REST API
    );

    register_post_type('staff', $args);

     $args = array(
        'labels' => array(
            'name'          => 'Practice Areas',
            'singular_name' => 'PA',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-book',
        'rewrite'       => array('slug' => 'PA'),
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'  => true, // enables Gutenberg + REST API
    );

    register_post_type('PA', $args);

    $args = array(
        'labels' => array(
            'name'          => 'Results',
            'singular_name' => 'result',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-money-alt',
        'rewrite'       => array('slug' => 'result'),
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'  => true, // enables Gutenberg + REST API
    );

    register_post_type('result', $args);

    $args = array(
        'labels' => array(
            'name'          => 'Reviews',
            'singular_name' => 'review',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-testimonial',
        'rewrite'       => array('slug' => 'review'),
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'  => true, // enables Gutenberg + REST API
    );

    register_post_type('review', $args);

    $args = array(
        'labels' => array(
            'name'          => 'Locations',
            'singular_name' => 'location',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-location',
        'rewrite'       => array('slug' => 'location'),
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'  => true, // enables Gutenberg + REST API
    );

    register_post_type('location', $args);
}

add_action('init', 'my_custom_post_types');

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_6a09ed20d20c2',
	'title' => 'Locations',
	'fields' => array(
		array(
			'key' => 'field_6a09ed21a9ced',
			'label' => 'Address',
			'name' => 'address',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09ed87a9cee',
			'label' => 'City',
			'name' => 'city',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09ed93a9cef',
			'label' => 'State',
			'name' => 'state',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09ed99a9cf0',
			'label' => 'Postal Number',
			'name' => 'postal_number',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'location',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'display_title' => '',
	'allow_ai_access' => false,
	'ai_description' => '',
) );

	acf_add_local_field_group( array(
	'key' => 'group_6a09f3468f8a8',
	'title' => 'Practice Areas',
	'fields' => array(
		array(
			'key' => 'field_6a09f346b58e5',
			'label' => 'Related Attorneys',
			'name' => 'related_attorneys',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'pa',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'id',
			'multiple' => 0,
			'allow_null' => 0,
			'allow_in_bindings' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
		array(
			'key' => 'field_6a09f3b3b58e6',
			'label' => 'Related Locations',
			'name' => 'related_locations',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'location',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'id',
			'multiple' => 0,
			'allow_null' => 0,
			'allow_in_bindings' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
		array(
			'key' => 'field_6a09f3c4b58e7',
			'label' => 'Related Reviews',
			'name' => 'related_reviews',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'review',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'id',
			'multiple' => 0,
			'allow_null' => 0,
			'allow_in_bindings' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
		array(
			'key' => 'field_6a09f3efb58e8',
			'label' => 'Related Results',
			'name' => 'related_results',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'result',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'id',
			'multiple' => 0,
			'allow_null' => 0,
			'allow_in_bindings' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'pa',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'display_title' => '',
	'allow_ai_access' => false,
	'ai_description' => '',
) );

	acf_add_local_field_group( array(
	'key' => 'group_6a09f001a0c65',
	'title' => 'Results',
	'fields' => array(
		array(
			'key' => 'field_6a09f00213c0e',
			'label' => 'Title',
			'name' => 'title',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09f01f13c0f',
			'label' => 'Description',
			'name' => 'description',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'allow_in_bindings' => 0,
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
			'delay' => 0,
		),
		array(
			'key' => 'field_6a09f02d13c10',
			'label' => 'Ammount',
			'name' => 'ammount',
			'aria-label' => '',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'min' => '',
			'max' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'step' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09f24c13c11',
			'label' => 'Related PA',
			'name' => 'related_pa',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'pa',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'id',
			'multiple' => 0,
			'allow_null' => 0,
			'allow_in_bindings' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
		array(
			'key' => 'field_6a09f26d13c12',
			'label' => 'Related Attorney',
			'name' => 'related_attorney',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'staff',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'id',
			'multiple' => 0,
			'allow_null' => 0,
			'allow_in_bindings' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'result',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'display_title' => '',
	'allow_ai_access' => false,
	'ai_description' => '',
) );

	acf_add_local_field_group( array(
	'key' => 'group_6a09f2c3f0e45',
	'title' => 'Review',
	'fields' => array(
		array(
			'key' => 'field_6a09f2c41bb61',
			'label' => 'Review Content',
			'name' => 'review_content',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09f2d61bb62',
			'label' => 'Client Name',
			'name' => 'client_name',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09f2dd1bb63',
			'label' => 'Related PA',
			'name' => 'related_pa',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'pa',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'object',
			'multiple' => 0,
			'allow_null' => 0,
			'allow_in_bindings' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
		array(
			'key' => 'field_6a09f2ed1bb64',
			'label' => 'Related Attorney',
			'name' => 'related_attorney',
			'aria-label' => '',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'staff',
			),
			'post_status' => '',
			'taxonomy' => '',
			'return_format' => 'object',
			'multiple' => 0,
			'allow_null' => 0,
			'allow_in_bindings' => 0,
			'bidirectional' => 0,
			'ui' => 1,
			'bidirectional_target' => array(
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'review',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'display_title' => '',
	'allow_ai_access' => false,
	'ai_description' => '',
) );

	acf_add_local_field_group( array(
	'key' => 'group_6a09edb5c70fe',
	'title' => 'Staff',
	'fields' => array(
		array(
			'key' => 'field_6a09edb6d9409',
			'label' => 'Name',
			'name' => 'name',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09ee9dd940a',
			'label' => 'Title',
			'name' => 'title',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6a09eef4d940b',
			'label' => 'Practice Areas',
			'name' => 'practice_areas',
			'aria-label' => '',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'pa',
			),
			'post_status' => '',
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
				1 => 'post_type',
				2 => 'taxonomy',
			),
			'return_format' => 'id',
			'min' => '',
			'max' => '',
			'allow_in_bindings' => 0,
			'elements' => '',
			'bidirectional' => 0,
			'bidirectional_target' => array(
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'staff',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'display_title' => '',
	'allow_ai_access' => false,
	'ai_description' => '',
) );
} );



