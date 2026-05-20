<?php
/**
 * Registrar for all transient-cached query helper classes.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Queries;

/**
 * Dispatches `register()` on every query helper class so each can wire its
 * own cache-busting action hooks. Bootstrap calls this once during init.
 *
 * @package PugPuggle
 */
class Registrar {

	/**
	 * Register all query helper classes.
	 *
	 * @return void
	 */
	public static function register(): void {
		Practice_Areas::register();
		Attorneys::register();
		Offices::register();
		Testimonials::register();
		Case_Results::register();
		Attorney_Specialty::register();
		Practice_Area_Category::register();
		Area_Served::register();
	}
}
