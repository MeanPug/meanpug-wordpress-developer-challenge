<?php
/**
 * ACF JSON sync — save/load field groups from theme/acf-json/.
 *
 * @package infra
 */

add_filter(
	'acf/settings/save_json',
	function () {
		return get_stylesheet_directory() . '/acf-json';
	}
);

add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		$paths[] = get_stylesheet_directory() . '/acf-json';
		return $paths;
	}
);

add_filter(
	'acf/json/save_file_name',
	function ( $filename, $post ) {
		$map = array(
			'group_inf_contact_info'    => 'group_contact_info',
			'group_inf_social_profiles' => 'group_social_profiles',
			'group_inf_schema_settings' => 'group_schema_settings',
			'group_inf_practice_area'   => 'group_practice_area_fields',
			'group_inf_team'            => 'group_team_fields',
			'group_inf_local'           => 'group_local_fields',
			'group_inf_testimonial'     => 'group_testimonial_fields',
			'group_inf_post_event'      => 'group_post_event_fields',
		);

		if ( isset( $map[ $post['key'] ] ) ) {
			return $map[ $post['key'] ] . '.json';
		}

		return $filename;
	},
	10,
	2
);
