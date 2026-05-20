<?php
/**
 * Bootstrap dispatcher.
 *
 * Wires up every PSR-4 registrar that ships with the Pug & Puggle theme layer.
 * Each registrar is guarded with `class_exists()` so the theme remains bootable
 * during incremental builds when some classes have not yet landed.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle;

/**
 * Central dispatcher that invokes the `register()` method on every known
 * subsystem class (CPTs, taxonomies, assets, schema, widgets, demo content).
 *
 * @package PugPuggle
 */
class Bootstrap {

	/**
	 * Boot every registrar that is currently autoloadable.
	 *
	 * Missing classes are skipped silently so the theme keeps working while
	 * the OOP layer is being built out incrementally.
	 *
	 * @return void
	 */
	public static function init(): void {
		self::maybe_register( '\\PugPuggle\\Cpt\\Practice_Area' );
		self::maybe_register( '\\PugPuggle\\Cpt\\Attorney' );
		self::maybe_register( '\\PugPuggle\\Cpt\\Office' );
		self::maybe_register( '\\PugPuggle\\Cpt\\Testimonial' );
		self::maybe_register( '\\PugPuggle\\Cpt\\Case_Result' );
		self::maybe_register( '\\PugPuggle\\Cpt\\Faq' );

		self::maybe_register( '\\PugPuggle\\Tax\\Practice_Area_Category' );
		self::maybe_register( '\\PugPuggle\\Tax\\Area_Served' );
		self::maybe_register( '\\PugPuggle\\Tax\\Attorney_Specialty' );

		self::maybe_register( '\\PugPuggle\\Queries\\Registrar' );

		self::maybe_register( '\\PugPuggle\\Assets' );
		self::maybe_register( '\\PugPuggle\\Schema' );
		self::maybe_register( '\\PugPuggle\\Widgets' );
		self::maybe_register( '\\PugPuggle\\Demo_Content' );
	}

	/**
	 * Invoke `register()` on the given class if it has been autoloaded.
	 *
	 * @param string $class Fully-qualified class name to dispatch.
	 * @return void
	 */
	private static function maybe_register( string $class ): void {
		if ( ! class_exists( $class ) ) {
			return;
		}

		call_user_func( [ $class, 'register' ] );
	}
}
