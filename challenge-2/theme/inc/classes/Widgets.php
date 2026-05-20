<?php
/**
 * Widget registrar.
 *
 * Registers all PugPuggle widgets with WordPress on the `widgets_init` hook.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle;

/**
 * Class Widgets
 *
 * Central registrar for PugPuggle widget classes.
 *
 * @package PugPuggle
 */
class Widgets {

	/**
	 * Bootstrap the registrar.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'widgets_init', [ self::class, 'on_widgets_init' ] );
	}

	/**
	 * Register each PugPuggle widget with WordPress.
	 *
	 * @return void
	 */
	public static function on_widgets_init(): void {
		register_widget( '\\PugPuggle\\Widgets\\Office_Hours' );
		register_widget( '\\PugPuggle\\Widgets\\Free_Consultation_CTA' );
	}
}
