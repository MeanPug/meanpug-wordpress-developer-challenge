<?php

/**
 * This file is here to control default sorting order of post types in admin
 */

include get_template_directory() . '/inc/optional/cpt-prototype.php';

//these post types have front end templating
//include get_template_directory() . '/inc/optional/cpt-news.php';
//include get_template_directory() . '/inc/optional/cpt-events.php';
include get_template_directory() . '/inc/optional/cpt-case-studies.php';
//include get_template_directory() . '/inc/optional/cpt-whitepapers.php';
//include get_template_directory() . '/inc/optional/cpt-fact-sheets.php';
//include get_template_directory() . '/inc/optional/cpt-webinars.php';
//include get_template_directory() . '/inc/optional/cpt-videos.php';

//these post types are supporting types to be used as selections in fields
include get_template_directory() . '/inc/optional/cpt-logos.php';
include get_template_directory() . '/inc/optional/cpt-testimonials.php';
include get_template_directory() . '/inc/optional/cpt-team-members.php';
include get_template_directory() . '/inc/optional/cpt-authors.php';

//custom the_taxonomies
include get_template_directory() . '/inc/optional/taxonomy-logo_tag.php';
include get_template_directory() . '/inc/optional/taxonomy-department.php';
