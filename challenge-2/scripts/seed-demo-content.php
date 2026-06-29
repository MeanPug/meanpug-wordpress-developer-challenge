<?php
/**
 * Seed demo content for local schema and CPT validation.
 * Idempotent — safe to re-run.
 *
 * Prerequisites: WordPress installed, ACF + Yoast + Classic Editor active, infra theme active.
 *
 * Run from challenge-2/:
 *   cat scripts/seed-demo-content.php | docker compose exec -T wordpress bash -c "cat > /tmp/seed-demo-content.php && php /tmp/seed-demo-content.php"
 *
 * @package challenge-2
 */

require '/var/www/html/wp-load.php';

if ( ! function_exists( 'update_field' ) ) {
	fwrite( STDERR, "ACF is required. Install and activate Advanced Custom Fields first.\n" );
	exit( 1 );
}

/**
 * CPTs and taxonomies are registered by the theme on init. In CLI the active
 * theme may not be loaded yet on a fresh install — bootstrap from theme files.
 */
function inf_seed_bootstrap_registrations() {
	if ( taxonomy_exists( 'practice-category' ) && post_type_exists( 'practice-area' ) ) {
		return;
	}

	$theme_slug = 'challenge-2-theme';
	$theme_dir  = get_theme_root() . '/' . $theme_slug;

	if ( ! is_dir( $theme_dir ) ) {
		fwrite( STDERR, "Theme not found at {$theme_dir}. Check the docker volume mount.\n" );
		exit( 1 );
	}

	require_once $theme_dir . '/inc/cpt/post-types-config.php';
	require_once $theme_dir . '/inc/cpt/register.php';
	require_once $theme_dir . '/inc/tax/register.php';

	if ( ! post_type_exists( 'practice-area' ) && function_exists( 'inf_register_custom_post_types' ) ) {
		inf_register_custom_post_types();
	}
	if ( ! taxonomy_exists( 'practice-category' ) && function_exists( 'inf_register_custom_taxonomies' ) ) {
		inf_register_custom_taxonomies();
	}

	if ( ! taxonomy_exists( 'practice-category' ) || ! post_type_exists( 'practice-area' ) ) {
		$active = wp_get_theme();
		fwrite( STDERR, "Custom post types/taxonomies are not registered.\n" );
		fwrite( STDERR, "Activate the infra theme first: Appearance → Themes.\n" );
		fwrite( STDERR, 'Active theme: ' . $active->get( 'Name' ) . ' (' . $active->get_stylesheet() . ")\n" );
		exit( 1 );
	}

	echo "Bootstrapped CPT/taxonomy registration from theme.\n";
}

inf_seed_bootstrap_registrations();

/**
 * Get or create a post by slug (idempotent).
 *
 * @param array<string, mixed> $args wp_insert_post args; post_name required.
 * @return int Post ID or 0.
 */
function inf_seed_ensure_post( array $args ) {
	$slug      = $args['post_name'] ?? '';
	$post_type = $args['post_type'] ?? 'post';

	if ( ! $slug ) {
		return 0;
	}

	$existing = get_page_by_path( $slug, OBJECT, $post_type );
	if ( $existing ) {
		$args['ID'] = $existing->ID;
		$id         = wp_update_post( $args, true );
	} else {
		$id = wp_insert_post( $args, true );
	}

	if ( is_wp_error( $id ) ) {
		fwrite( STDERR, "Post error ({$slug}): " . $id->get_error_message() . "\n" );
		return 0;
	}

	return (int) $id;
}

/**
 * Get or create a taxonomy term (idempotent).
 *
 * @param string $taxonomy Taxonomy slug.
 * @param string $name     Term name.
 * @param string $slug     Term slug.
 * @return int Term ID or 0.
 */
function inf_seed_ensure_term( $taxonomy, $name, $slug ) {
	$term = get_term_by( 'slug', $slug, $taxonomy );
	if ( $term ) {
		return (int) $term->term_id;
	}

	$result = wp_insert_term( $name, $taxonomy, array( 'slug' => $slug ) );
	if ( is_wp_error( $result ) ) {
		fwrite( STDERR, "Term error ({$slug}): " . $result->get_error_message() . "\n" );
		return 0;
	}

	return (int) $result['term_id'];
}

/**
 * Google Map field value for ACF.
 *
 * @param string $address Full address string.
 * @param string $lat     Latitude.
 * @param string $lng     Longitude.
 * @return array<string, string>
 */
function inf_seed_geopoint( $address, $lat, $lng ) {
	return array(
		'address' => $address,
		'lat'     => $lat,
		'lng'     => $lng,
		'zoom'    => 14,
	);
}

// -------------------------------------------------------------------------
// Theme Settings
// -------------------------------------------------------------------------
update_field(
	'contact_phone',
	array(
		'title'  => '1-800-PUG-LAW',
		'url'    => 'tel:+1800784529',
		'target' => '',
	),
	'option'
);
update_field(
	'contact_email',
	array(
		'title'  => 'contact@pugandpuggle.com',
		'url'    => 'mailto:contact@pugandpuggle.com',
		'target' => '',
	),
	'option'
);
update_field(
	'contact_main_address',
	array(
		'street'    => '123 Puggle Plaza',
		'city'      => 'Orlando',
		'state'     => 'FL',
		'post_code' => '32801',
		'lat'       => '28.5383',
		'lng'       => '-81.3792',
	),
	'option'
);
update_field(
	'social_profiles',
	array(
		'facebook_url'  => 'https://facebook.com/pugandpuggle',
		'linkedin_url'  => 'https://linkedin.com/company/pugandpuggle',
		'twitter_url'   => 'https://twitter.com/pugandpuggle',
	),
	'option'
);
update_field(
	'schema_aggregate_rating',
	array(
		'value' => 4.9,
		'count' => 127,
	),
	'option'
);
echo "Theme options updated.\n";

// -------------------------------------------------------------------------
// Taxonomy terms
// -------------------------------------------------------------------------
$term_pi_cat       = inf_seed_ensure_term( 'practice-category', 'Personal Injury', 'personal-injury' );
$term_mm_cat       = inf_seed_ensure_term( 'practice-category', 'Medical Malpractice', 'medical-malpractice' );
$term_partners     = inf_seed_ensure_term( 'attorney-department', 'Partners', 'partners' );
$term_litigation   = inf_seed_ensure_term( 'attorney-department', 'Litigation', 'litigation' );
$term_florida_area = inf_seed_ensure_term( 'area-served', 'Florida', 'florida' );
$term_google       = inf_seed_ensure_term( 'testimonial-source', 'Google Reviews', 'google-reviews' );
$term_avvo         = inf_seed_ensure_term( 'testimonial-source', 'Avvo', 'avvo' );
$term_facebook     = inf_seed_ensure_term( 'testimonial-source', 'Facebook', 'facebook' );
$term_seminar      = inf_seed_ensure_term( 'event-type', 'Seminar', 'seminar' );
echo "Taxonomy terms seeded.\n";

// -------------------------------------------------------------------------
// Practice Areas — 1 post
// -------------------------------------------------------------------------
$pa_car_accidents = inf_seed_ensure_post(
	array(
		'post_type'    => 'practice-area',
		'post_title'   => 'Car Accidents',
		'post_name'    => 'car-accidents',
		'post_content' => 'We help victims of car accidents recover compensation.',
		'post_status'  => 'publish',
		'post_parent'  => 0,
	)
);

if ( $pa_car_accidents && $term_florida_area ) {
	wp_set_post_terms( $pa_car_accidents, array( $term_florida_area ), 'area-served', false );
}
if ( $pa_car_accidents && $term_pi_cat ) {
	wp_set_post_terms( $pa_car_accidents, array( $term_pi_cat ), 'practice-category', false );
}

if ( $pa_car_accidents ) {
	update_field(
		'schema_faq_items',
		array(
			'faq_1' => array(
				'question' => 'How long do I have to file a car accident claim in Florida?',
				'answer'   => 'Florida law generally allows four years from the date of the accident to file a personal injury lawsuit.',
			),
			'faq_2' => array(
				'question' => 'Do you offer free consultations for car accident cases?',
				'answer'   => 'Yes. We provide free, no-obligation consultations for all car accident inquiries.',
			),
			'faq_3' => array(
				'question' => 'What compensation can I recover?',
				'answer'   => 'You may recover medical expenses, lost wages, pain and suffering, and other damages depending on your case.',
			),
		),
		$pa_car_accidents
	);
}

echo "Practice areas seeded (1 post).\n";

// -------------------------------------------------------------------------
// Testimonials — 1 post
// -------------------------------------------------------------------------
$testimonial_john = inf_seed_ensure_post(
	array(
		'post_type'    => 'testimonials',
		'post_title'   => 'John D.',
		'post_name'    => 'john-d',
		'post_content' => 'Outstanding representation after my car accident.',
		'post_status'  => 'publish',
	)
);

if ( $testimonial_john ) {
	update_field( 'reviewer', array( 'name' => 'John D.' ), $testimonial_john );
	update_field( 'rating', 5, $testimonial_john );
	if ( $term_google ) {
		wp_set_post_terms( $testimonial_john, array( $term_google ), 'testimonial-source', false );
	}
}

if ( $pa_car_accidents && $testimonial_john ) {
	update_field( 'testimonials', array( $testimonial_john ), $pa_car_accidents );
}

echo "Testimonials seeded (1 post).\n";

// -------------------------------------------------------------------------
// Locals — 1 post (Office Location)
// -------------------------------------------------------------------------
$local_tampa = inf_seed_ensure_post(
	array(
		'post_type'   => 'local',
		'post_title'  => 'Tampa Office',
		'post_name'   => 'tampa-office',
		'post_status' => 'publish',
		'post_parent' => 0,
	)
);
if ( $local_tampa ) {
	update_field( 'content_type', 'Office Location', $local_tampa );
	update_field( 'area_type', 'City', $local_tampa );
	update_field(
		'address',
		array(
			'street'      => '456 Bayshore Blvd',
			'street2'     => 'Suite 200',
			'city'        => 'Tampa',
			'state'       => 'FL',
			'postal_code' => '33602',
		),
		$local_tampa
	);
	update_field(
		'geopoint',
		inf_seed_geopoint( '456 Bayshore Blvd, Tampa, FL 33602', '27.9506', '-82.4572' ),
		$local_tampa
	);
	update_field(
		'phone',
		array(
			'title'  => '813-555-PUGS',
			'url'    => 'tel:+18135557847',
			'target' => '',
		),
		$local_tampa
	);
	if ( $term_florida_area ) {
		wp_set_post_terms( $local_tampa, array( $term_florida_area ), 'area-served', false );
	}
}

echo "Locals seeded (Tampa Office).\n";

// -------------------------------------------------------------------------
// Attorneys (team) — 1 post
// -------------------------------------------------------------------------
$attorney_pug = inf_seed_ensure_post(
	array(
		'post_type'    => 'team',
		'post_title'   => 'Pug Esq.',
		'post_name'    => 'pug-esq',
		'post_content' => 'Founding partner with decades of personal injury experience across Florida.',
		'post_status'  => 'publish',
	)
);

if ( $attorney_pug ) {
	update_field( 'role', 'Managing Partner', $attorney_pug );
	update_field( 'email', 'pug@pugandpuggle.com', $attorney_pug );
	update_field(
		'phone',
		array(
			'title'  => '407-555-PUG1',
			'url'    => 'tel:+14075557841',
			'target' => '',
		),
		$attorney_pug
	);
	update_field( 'practice_areas', array_filter( array( $pa_car_accidents ) ), $attorney_pug );
	if ( $term_partners ) {
		wp_set_post_terms( $attorney_pug, array( $term_partners ), 'attorney-department', false );
	}
}

echo "Attorneys seeded (Pug Esq.).\n";

// -------------------------------------------------------------------------
// Community Seminar (post + event-type)
// -------------------------------------------------------------------------
$seminar_id = inf_seed_ensure_post(
	array(
		'post_type'    => 'post',
		'post_title'   => 'Community Seminar',
		'post_name'    => 'community-seminar',
		'post_content' => 'Join us for a free community seminar on personal injury rights.',
		'post_status'  => 'publish',
	)
);
if ( $seminar_id && $term_seminar ) {
	wp_set_post_terms( $seminar_id, array( $term_seminar ), 'event-type', false );
	update_field( 'event_date', '2026-09-15', $seminar_id );
	update_field( 'event_location', 'Orlando Convention Center', $seminar_id );
	echo "Post Community Seminar: ID $seminar_id\n";
}

// -------------------------------------------------------------------------
// Contact page
// -------------------------------------------------------------------------
$contact_page = inf_seed_ensure_post(
	array(
		'post_type'    => 'page',
		'post_title'   => 'Contact',
		'post_name'    => 'contact',
		'post_content' => 'Contact the Law Firm of Pug and Puggle for a free consultation.',
		'post_status'  => 'publish',
	)
);

// -------------------------------------------------------------------------
// Main navigation menu
// -------------------------------------------------------------------------
$menu_name = 'Main Menu';
$menu      = wp_get_nav_menu_object( $menu_name );

if ( ! $menu ) {
	$menu_id = wp_create_nav_menu( $menu_name );
} else {
	$menu_id = $menu->term_id;
}

if ( ! is_wp_error( $menu_id ) && $menu_id ) {
	$existing_items = wp_get_nav_menu_items( $menu_id );
	$existing_urls  = array();
	if ( $existing_items ) {
		foreach ( $existing_items as $item ) {
			$existing_urls[] = untrailingslashit( $item->url );
		}
	}

	$menu_links = array(
		array(
			'title' => 'Practice Areas',
			'url'   => get_post_type_archive_link( 'practice-area' ),
		),
		array(
			'title' => 'Attorneys',
			'url'   => get_post_type_archive_link( 'team' ),
		),
		array(
			'title' => 'Testimonials',
			'url'   => get_post_type_archive_link( 'testimonials' ),
		),
		array(
			'title' => 'Contact',
			'url'   => $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' ),
		),
	);

	$position = 1;
	foreach ( $menu_links as $link ) {
		$normalized = untrailingslashit( $link['url'] );
		if ( in_array( $normalized, $existing_urls, true ) ) {
			continue;
		}
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'  => $link['title'],
				'menu-item-url'    => $link['url'],
				'menu-item-status' => 'publish',
				'menu-item-type'   => 'custom',
				'menu-item-position' => $position,
			)
		);
		++$position;
	}

	$locations = get_theme_mod( 'nav_menu_locations', array() );
	$locations['nav']         = $menu_id;
	$locations['mobile-nav']  = $menu_id;
	$locations['footer']      = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	echo "Main menu configured (Nav, Mobile Nav, Footer).\n";
}

// -------------------------------------------------------------------------
// Sidebar widgets (Related Practice Areas on default sidebar)
// -------------------------------------------------------------------------
$widget_option = get_option( 'widget_related_practice_areas', array() );
if ( empty( $widget_option ) || ! is_array( $widget_option ) ) {
	$widget_option = array( '_multiwidget' => 1 );
}
$widget_instance_id = 2;
if ( ! isset( $widget_option[ $widget_instance_id ] ) ) {
	$widget_option[ $widget_instance_id ] = array();
	update_option( 'widget_related_practice_areas', $widget_option );

	$sidebars = get_option( 'sidebars_widgets', array() );
	if ( ! isset( $sidebars['default-sidebar'] ) || ! is_array( $sidebars['default-sidebar'] ) ) {
		$sidebars['default-sidebar'] = array();
	}
	$widget_key = 'related_practice_areas-' . $widget_instance_id;
	if ( ! in_array( $widget_key, $sidebars['default-sidebar'], true ) ) {
		$sidebars['default-sidebar'][] = $widget_key;
		update_option( 'sidebars_widgets', $sidebars );
		echo "Related Practice Areas widget added to default-sidebar.\n";
	}
}

echo "Demo content seed complete.\n";

flush_rewrite_rules( false );
echo "Rewrite rules flushed.\n";
