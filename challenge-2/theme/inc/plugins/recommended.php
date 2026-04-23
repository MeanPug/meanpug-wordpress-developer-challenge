<?php
/**
 * Recommended plugins
 *
 * Declares the plugin list a production Pug & Puggle install assumes.
 * Rather than bundling or silent-installing them, we surface a
 * dismissible admin notice pointing admins at Plugins → Add New. This
 * keeps the theme free of plugin-territory logic while still guiding
 * setup.
 *
 * Each item: slug (used for the plugin folder or wp.org slug), name,
 * and purpose. The `file` key lets us detect already-active plugins
 * that aren't in the wp.org directory (Gravity Forms, ACF Pro, etc.)
 * by their main-file path.
 *
 * @package pnp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function pnp_recommended_plugins() {
	return array(
		array(
			'slug'    => 'advanced-custom-fields-pro',
			'file'    => 'advanced-custom-fields-pro/acf.php',
			'name'    => 'Advanced Custom Fields Pro',
			'purpose' => 'Editor UI for the post-meta schema declared in inc/meta/all.php.',
		),
		array(
			'slug'    => 'gravityforms',
			'file'    => 'gravityforms/gravityforms.php',
			'name'    => 'Gravity Forms',
			'purpose' => 'Intake / contact forms with conditional routing + CRM webhooks.',
		),
		array(
			'slug'    => 'wordpress-seo',
			'file'    => 'wordpress-seo/wp-seo.php',
			'name'    => 'Yoast SEO',
			'purpose' => 'Title/meta management and schema-graph output (Attorney, LegalService, LocalBusiness).',
		),
		array(
			'slug'    => 'redirection',
			'file'    => 'redirection/redirection.php',
			'name'    => 'Redirection',
			'purpose' => '301-management for the many URL moves a firm site accumulates.',
		),
		array(
			'slug'    => 'wp-rocket',
			'file'    => 'wp-rocket/wp-rocket.php',
			'name'    => 'WP Rocket',
			'purpose' => 'Page caching, critical-CSS, and lazy-loading on a PHP-heavy stack.',
		),
		array(
			'slug'    => 'wordfence',
			'file'    => 'wordfence/wordfence.php',
			'name'    => 'Wordfence',
			'purpose' => 'WAF + login hardening — firm sites are scanned constantly.',
		),
		array(
			'slug'    => 'updraftplus',
			'file'    => 'updraftplus/updraftplus.php',
			'name'    => 'UpdraftPlus',
			'purpose' => 'Off-site backups.',
		),
	);
}

/**
 * True when the plugin's main file is active.
 */
function pnp_plugin_is_active( $file ) {
	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	return is_plugin_active( $file );
}

add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	if ( get_user_meta( get_current_user_id(), 'pnp_recommended_dismissed', true ) ) {
		return;
	}

	$missing = array();
	foreach ( pnp_recommended_plugins() as $p ) {
		if ( ! pnp_plugin_is_active( $p['file'] ) ) {
			$missing[] = $p;
		}
	}
	if ( empty( $missing ) ) {
		return;
	}

	$dismiss_url = wp_nonce_url( add_query_arg( 'pnp_dismiss_recommended', '1' ), 'pnp_dismiss_recommended' );

	echo '<div class="notice notice-info"><p><strong>Pug &amp; Puggle, ESQ.</strong> — recommended plugins are not yet active:</p><ul style="list-style:disc; margin-left:20px">';
	foreach ( $missing as $p ) {
		printf(
			'<li><strong>%s</strong> — %s</li>',
			esc_html( $p['name'] ),
			esc_html( $p['purpose'] )
		);
	}
	printf(
		'</ul><p><a href="%s">%s</a> &nbsp;|&nbsp; <a href="%s">%s</a></p></div>',
		esc_url( admin_url( 'plugin-install.php' ) ),
		esc_html__( 'Go to Add Plugins', 'pnp' ),
		esc_url( $dismiss_url ),
		esc_html__( 'Dismiss for this user', 'pnp' )
	);
} );

add_action( 'admin_init', function () {
	if ( ! isset( $_GET['pnp_dismiss_recommended'] ) ) {
		return;
	}
	if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'pnp_dismiss_recommended' ) ) {
		return;
	}
	update_user_meta( get_current_user_id(), 'pnp_recommended_dismissed', 1 );
	wp_safe_redirect( remove_query_arg( array( 'pnp_dismiss_recommended', '_wpnonce' ) ) );
	exit;
} );
