<?php

/**
 * Register blog topic taxonomy for default posts.
 */
function inf_register_tax_blog_topic() {
	$labels = array(
		'name'          => esc_html__( 'Blog Topics', 'inf' ),
		'singular_name' => esc_html__( 'Blog Topic', 'inf' ),
		'search_items'  => esc_html__( 'Search Blog Topics', 'inf' ),
		'all_items'     => esc_html__( 'All Blog Topics', 'inf' ),
		'edit_item'     => esc_html__( 'Edit Blog Topic', 'inf' ),
		'update_item'   => esc_html__( 'Update Blog Topic', 'inf' ),
		'add_new_item'  => esc_html__( 'Add New Blog Topic', 'inf' ),
		'new_item_name' => esc_html__( 'New Blog Topic Name', 'inf' ),
		'menu_name'     => esc_html__( 'Blog Topics', 'inf' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'blog-topic' ),
	);

	register_taxonomy( 'blog_topic', array( 'post' ), $args );
}
add_action( 'init', 'inf_register_tax_blog_topic' );
