<?php
/**
 * Extended schema.org JSON-LD emitters for the law-firm site.
 *
 * Complements (never replaces) the procedural emitters in
 * `inc/utils/seo/schema.php`. Hooks `wp_footer` at priority 11 so the
 * existing priority-10 emitters fire first.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle;

/**
 * Emits additional JSON-LD blocks (Person, LegalService, Review,
 * BreadcrumbList, openingHoursSpecification) for the law-firm CPTs.
 *
 * @package PugPuggle
 */
class Schema {

	/**
	 * Register WordPress hooks for the additional schema emitter.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'wp_footer', [ self::class, 'emit_additional' ], 11 );
	}

	/**
	 * Dispatch the right additional schema for the current request.
	 *
	 * @return void
	 */
	public static function emit_additional(): void {
		if ( is_singular( 'attorney' ) ) {
			$post = get_post();
			if ( $post instanceof \WP_Post ) {
				self::print_jsonld( self::attorney_person_schema( $post ), 'Attorney' );
				self::print_jsonld( self::breadcrumbs_schema( $post ), 'Breadcrumbs' );
			}
		}

		if ( is_singular( 'practice-area' ) ) {
			$post = get_post();
			if ( $post instanceof \WP_Post ) {
				self::print_jsonld( self::legal_service_schema( $post ), 'LegalService' );
				self::print_jsonld( self::breadcrumbs_schema( $post ), 'Breadcrumbs' );
			}
		}

		if ( is_singular( 'case-result' ) ) {
			$post = get_post();
			if ( $post instanceof \WP_Post ) {
				self::print_jsonld( self::case_result_schema( $post ), 'Case Result' );
				self::print_jsonld( self::breadcrumbs_schema( $post ), 'Breadcrumbs' );
			}
		}

		if ( is_singular( 'office' ) ) {
			$post = get_post();
			if ( $post instanceof \WP_Post ) {
				self::print_jsonld( self::office_extras( $post ), 'Office Hours' );
			}
		}
	}

	/**
	 * Read an ACF field if ACF is active, otherwise return null.
	 *
	 * @param string          $key     ACF field key/name.
	 * @param int|string|null $post_id Post ID or option scope.
	 * @return mixed|null
	 */
	private static function acf( string $key, $post_id = null ) {
		if ( ! function_exists( 'get_field' ) ) {
			return null;
		}

		return null === $post_id ? get_field( $key ) : get_field( $key, $post_id );
	}

	/**
	 * Build the Person schema for an Attorney CPT.
	 *
	 * @param \WP_Post $attorney The attorney post.
	 * @return array<string, mixed>
	 */
	public static function attorney_person_schema( \WP_Post $attorney ): array {
		$position  = self::acf( 'position', $attorney->ID );
		$phone     = self::acf( 'phone', $attorney->ID );
		$email     = self::acf( 'email', $attorney->ID );
		$linkedin  = self::acf( 'linkedin', $attorney->ID );
		$quote     = self::acf( 'featured_quote', $attorney->ID );
		$education = self::acf( 'education', $attorney->ID );

		$image_url   = wp_get_attachment_image_url( get_post_thumbnail_id( $attorney->ID ), 'full' );
		$excerpt     = get_the_excerpt( $attorney );
		$description = '' !== (string) $excerpt ? $excerpt : (string) $quote;

		$same_as = [];
		if ( null !== $linkedin && '' !== (string) $linkedin ) {
			$same_as[] = (string) $linkedin;
		}

		$alumni_of = [];
		if ( is_array( $education ) ) {
			foreach ( $education as $row ) {
				if ( ! is_array( $row ) ) {
					continue;
				}
				$institution = isset( $row['institution'] ) ? (string) $row['institution'] : '';
				if ( '' === $institution ) {
					continue;
				}
				$alumni_of[] = [
					'@type' => 'EducationalOrganization',
					'name'  => $institution,
				];
			}
		}

		$schema = [
			'@context'    => 'https://schema.org',
			'@type'       => 'Person',
			'name'        => get_the_title( $attorney ),
			'jobTitle'    => null !== $position && '' !== (string) $position ? (string) $position : null,
			'image'       => false !== $image_url ? $image_url : null,
			'description' => '' !== (string) $description ? (string) $description : null,
			'telephone'   => null !== $phone && '' !== (string) $phone ? (string) $phone : null,
			'email'       => null !== $email && '' !== (string) $email ? (string) $email : null,
			'sameAs'      => ! empty( $same_as ) ? $same_as : null,
			'worksFor'    => [
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
				'url'   => home_url(),
			],
			'alumniOf'    => ! empty( $alumni_of ) ? $alumni_of : null,
		];

		return self::filter_nulls( $schema );
	}

	/**
	 * Build the LegalService schema for a Practice Area CPT.
	 *
	 * @param \WP_Post $practice_area The practice area post.
	 * @return array<string, mixed>
	 */
	public static function legal_service_schema( \WP_Post $practice_area ): array {
		$summary     = self::acf( 'summary', $practice_area->ID );
		$excerpt     = get_the_excerpt( $practice_area );
		$description = '' !== (string) $excerpt ? $excerpt : (string) $summary;
		$image_url   = wp_get_attachment_image_url( get_post_thumbnail_id( $practice_area->ID ), 'full' );

		$area_served = [];
		$terms       = get_the_terms( $practice_area->ID, 'area-served' );
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( $term instanceof \WP_Term ) {
					$area_served[] = $term->name;
				}
			}
		}

		$schema = [
			'@context'    => 'https://schema.org',
			'@type'       => 'LegalService',
			'name'        => get_the_title( $practice_area ),
			'description' => '' !== (string) $description ? (string) $description : null,
			'url'         => get_permalink( $practice_area ),
			'image'       => false !== $image_url ? $image_url : null,
			'provider'    => [
				'@type' => 'LegalService',
				'name'  => get_bloginfo( 'name' ),
				'url'   => home_url(),
			],
			'areaServed'  => ! empty( $area_served ) ? $area_served : null,
		];

		return self::filter_nulls( $schema );
	}

	/**
	 * Build the Review schema for a Case Result CPT.
	 *
	 * @param \WP_Post $case_post The case result post.
	 * @return array<string, mixed>
	 */
	public static function case_result_schema( \WP_Post $case_post ): array {
		$outcome     = self::acf( 'outcome_summary', $case_post->ID );
		$review_body = null !== $outcome ? trim( wp_strip_all_tags( (string) $outcome ) ) : '';

		$schema = [
			'@context'      => 'https://schema.org',
			'@type'         => 'Review',
			'itemReviewed'  => [
				'@type' => 'LegalService',
				'name'  => get_bloginfo( 'name' ),
			],
			'reviewBody'    => '' !== $review_body ? $review_body : null,
			'name'          => get_the_title( $case_post ),
			'author'        => [
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
			],
			'datePublished' => get_the_date( 'Y-m-d', $case_post ),
			'reviewRating'  => [
				'@type'       => 'Rating',
				'ratingValue' => 5,
				'bestRating'  => 5,
			],
		];

		return self::filter_nulls( $schema );
	}

	/**
	 * Build the LocalBusiness extras (opening hours + geo) for an Office CPT.
	 *
	 * @param \WP_Post $office The office post.
	 * @return array<string, mixed>
	 */
	public static function office_extras( \WP_Post $office ): array {
		$hours    = self::acf( 'hours', $office->ID );
		$geopoint = self::acf( 'geopoint', $office->ID );

		$specs = [];
		if ( is_array( $hours ) ) {
			foreach ( $hours as $row ) {
				if ( ! is_array( $row ) ) {
					continue;
				}

				$closed_flag = isset( $row['closed_flag'] ) ? $row['closed_flag'] : false;
				if ( true === (bool) $closed_flag ) {
					continue;
				}

				$day   = isset( $row['day'] ) ? (string) $row['day'] : '';
				$open  = isset( $row['open'] ) ? (string) $row['open'] : '';
				$close = isset( $row['close'] ) ? (string) $row['close'] : '';

				if ( '' === $day || '' === $open || '' === $close ) {
					continue;
				}

				$specs[] = [
					'@type'     => 'OpeningHoursSpecification',
					'dayOfWeek' => $day,
					'opens'     => $open,
					'closes'    => $close,
				];
			}
		}

		$geo = null;
		if ( is_array( $geopoint ) && isset( $geopoint['lat'], $geopoint['lng'] ) ) {
			$geo = [
				'@type'     => 'GeoCoordinates',
				'latitude'  => $geopoint['lat'],
				'longitude' => $geopoint['lng'],
			];
		}

		$schema = [
			'@context'                  => 'https://schema.org',
			'@type'                     => 'LocalBusiness',
			'@id'                       => get_permalink( $office ) . '#office',
			'name'                      => get_the_title( $office ),
			'openingHoursSpecification' => ! empty( $specs ) ? $specs : null,
			'geo'                       => $geo,
		];

		return self::filter_nulls( $schema );
	}

	/**
	 * Build BreadcrumbList schema for a singular post.
	 *
	 * @param \WP_Post $post The current post.
	 * @return array<string, mixed>
	 */
	public static function breadcrumbs_schema( \WP_Post $post ): array {
		$labels = [
			'attorney'      => 'Attorneys',
			'practice-area' => 'Practice Areas',
			'case-result'   => 'Case Results',
			'office'        => 'Offices',
		];

		$items    = [];
		$position = 1;

		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position++,
			'name'     => 'Home',
			'item'     => home_url(),
		];

		$archive_link  = get_post_type_archive_link( $post->post_type );
		$archive_label = isset( $labels[ $post->post_type ] ) ? $labels[ $post->post_type ] : '';
		if ( '' === $archive_label ) {
			$pto = get_post_type_object( $post->post_type );
			if ( $pto instanceof \WP_Post_Type && isset( $pto->labels->name ) ) {
				$archive_label = (string) $pto->labels->name;
			}
		}

		if ( false !== $archive_link && '' !== $archive_label ) {
			$items[] = [
				'@type'    => 'ListItem',
				'position' => $position++,
				'name'     => $archive_label,
				'item'     => $archive_link,
			];
		}

		if ( 'practice-area' === $post->post_type ) {
			$ancestors = get_post_ancestors( $post );
			if ( ! empty( $ancestors ) ) {
				$ancestors = array_reverse( $ancestors );
				foreach ( $ancestors as $ancestor_id ) {
					$items[] = [
						'@type'    => 'ListItem',
						'position' => $position++,
						'name'     => get_the_title( $ancestor_id ),
						'item'     => get_permalink( $ancestor_id ),
					];
				}
			}
		}

		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position++,
			'name'     => get_the_title( $post ),
			'item'     => get_permalink( $post ),
		];

		return [
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $items,
		];
	}

	/**
	 * Remove null and empty-string top-level keys from a schema array.
	 *
	 * @param array<string, mixed> $data The schema array to filter.
	 * @return array<string, mixed>
	 */
	private static function filter_nulls( array $data ): array {
		$out = [];
		foreach ( $data as $key => $value ) {
			if ( null === $value ) {
				continue;
			}
			if ( '' === $value ) {
				continue;
			}
			$out[ $key ] = $value;
		}

		return $out;
	}

	/**
	 * Print a JSON-LD <script> block with an HTML comment label.
	 *
	 * @param array<string, mixed> $data    The schema payload.
	 * @param string               $comment Human-readable label for the HTML comment.
	 * @return void
	 */
	private static function print_jsonld( array $data, string $comment ): void {
		if ( empty( $data ) ) {
			return;
		}

		printf( '<!-- SCHEMA: %s -->', esc_html( $comment ) );
		echo '<script type="application/ld+json">';
		echo wp_json_encode( $data );
		echo '</script>';
	}
}
