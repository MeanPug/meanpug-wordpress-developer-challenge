<?php
/**
 * Abstract base class for custom taxonomy registrars.
 *
 * Subclasses declare a slug, the object types the taxonomy applies to,
 * and an args array; this base wires up the standard `init` hook via late
 * static binding so each subclass resolves its own configuration.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Tax;

/**
 * Base taxonomy registrar.
 *
 * @package PugPuggle
 */
abstract class Base {

	/**
	 * Return the taxonomy slug.
	 *
	 * @return string
	 */
	abstract protected static function slug(): string;

	/**
	 * Return the post type slugs this taxonomy attaches to.
	 *
	 * @return array<int, string>
	 */
	abstract protected static function object_types(): array;

	/**
	 * Return the `register_taxonomy` args.
	 *
	 * @return array<string, mixed>
	 */
	abstract protected static function args(): array;

	/**
	 * Hook the registrar onto WordPress.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'init', [ static::class, 'do_register' ] );
	}

	/**
	 * Actually call `register_taxonomy` with the subclass's config.
	 *
	 * @return void
	 */
	public static function do_register(): void {
		register_taxonomy( static::slug(), static::object_types(), static::args() );
	}
}
