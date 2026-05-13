<?php

function inf_register_menus() {
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'nav' => esc_html__( 'Nav', 'inf' ),
      'mobile-nav' => esc_html__( 'Mobile Nav', 'inf' ),
			'footer' => esc_html__( 'Footer', 'inf' )
		) );
}
add_action( 'after_setup_theme', 'inf_register_menus' );

/*-----------------------------------------------------------------------------------*/
/* PRACTICE AREAS MENU
/*-----------------------------------------------------------------------------------*/
function practice_areas_admin_menu() {
    add_menu_page(
        'Practice Areas',
        'Practice Areas',
        'read',
        'practice-areas-menu',
        '',
        'dashicons-awards',
        41
    );
}
add_action('admin_menu', 'practice_areas_admin_menu');