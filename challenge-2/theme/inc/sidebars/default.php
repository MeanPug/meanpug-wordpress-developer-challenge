<?php

function inf_register_single_faq_sidebar()
{
    register_sidebar(array(
        'name' => 'Default Sidebar',
        'id' => 'default-sidebar',
        'description' => 'The default sidebar to show on pages that have a sidebar',
        'before_widget' => '<div id="%1$s" class="widget-container">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Attorney Sidebar', 'inf'),
        'id' => 'attorney-sidebar',
        'description' => esc_html__('Sidebar shown on single attorney pages.', 'inf'),
        'before_widget' => '<div id="%1$s" class="widget-container">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Practice Area Sidebar', 'inf'),
        'id' => 'practice-area-sidebar',
        'description' => esc_html__('Sidebar shown on single practice area pages.', 'inf'),
        'before_widget' => '<div id="%1$s" class="widget-container">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}

add_action('init', 'inf_register_single_faq_sidebar');
