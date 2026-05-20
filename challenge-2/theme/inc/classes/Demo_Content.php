<?php
/**
 * One-time admin-triggered demo content seeder.
 *
 * Idempotent: each seeded entity is keyed by `_pugpuggle_seed_key` (post meta)
 * or `pp_seed_key` (term meta), so re-running the action does not duplicate
 * any posts, terms, menus, or pages.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle;

/**
 * Seeds demo content for the Pug & Puggle law firm theme.
 *
 * Shows an admin-notice banner to administrators until the demo content has
 * been installed, then handles the install via `admin_post_*`. Every insertion
 * is idempotent so the install action can safely be re-fired without creating
 * duplicate records.
 *
 * @package PugPuggle
 */
class Demo_Content {

	/**
	 * Option flag indicating the demo content has been installed.
	 *
	 * @var string
	 */
	public const INSTALLED_OPTION = 'pugpuggle_demo_installed';

	/**
	 * Post-meta key used to mark seeded posts.
	 *
	 * @var string
	 */
	public const SEED_META_KEY = '_pugpuggle_seed_key';

	/**
	 * Term-meta key used to mark seeded terms.
	 *
	 * @var string
	 */
	public const TERM_SEED_META_KEY = 'pp_seed_key';

	/**
	 * `admin_post_*` action name.
	 *
	 * @var string
	 */
	public const ACTION_NAME = 'pugpuggle_install_demo';

	/**
	 * Nonce name used for the install action.
	 *
	 * @var string
	 */
	public const NONCE_NAME = 'pugpuggle_install_demo_nonce';

	/**
	 * Wire up WordPress hooks.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'admin_notices', [ self::class, 'maybe_show_notice' ] );
		add_action( 'admin_post_' . self::ACTION_NAME, [ self::class, 'handle_install' ] );
	}

	/**
	 * Render the admin notice prompting the user to install demo content.
	 *
	 * @return void
	 */
	public static function maybe_show_notice(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( '1' === get_option( self::INSTALLED_OPTION ) ) {
			return;
		}

		$action_url = wp_nonce_url(
			admin_url( 'admin-post.php?action=' . self::ACTION_NAME ),
			self::ACTION_NAME,
			self::NONCE_NAME
		);
		?>
		<div class="notice notice-info">
			<p>
				<strong><?php esc_html_e( 'Pug & Puggle', 'inf' ); ?>:</strong>
				<?php esc_html_e( 'Demo content not yet installed.', 'inf' ); ?>
				<a href="<?php echo esc_url( $action_url ); ?>" class="button button-primary" style="margin-left:0.5em;">
					<?php esc_html_e( 'Install demo content', 'inf' ); ?>
				</a>
			</p>
		</div>
		<?php
	}

	/**
	 * Handle the install action: verify capabilities and nonce, then seed.
	 *
	 * @return void
	 */
	public static function handle_install(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'Insufficient permissions.', 'inf' ) );
		}

		check_admin_referer( self::ACTION_NAME, self::NONCE_NAME );

		self::seed_terms();
		self::seed_practice_areas();
		self::seed_attorneys();
		self::seed_offices();
		self::seed_case_results();
		self::seed_testimonials();
		self::seed_faqs();
		self::seed_home_page();
		self::seed_menus();

		update_option( self::INSTALLED_OPTION, '1' );

		wp_safe_redirect( add_query_arg( 'pugpuggle_demo', 'installed', admin_url() ) );
		exit;
	}

	/**
	 * Return a 2-paragraph chunk of lorem ipsum text.
	 *
	 * @return string
	 */
	public static function lorem(): string {
		static $text = null;

		if ( null === $text ) {
			$text = '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'inf' ) . '</p>'
				. '<p>' . esc_html__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'inf' ) . '</p>';
		}

		return $text;
	}

	/**
	 * Look up a seeded post by its seed key.
	 *
	 * @param string $post_type Post type slug.
	 * @param string $seed_key  Seed identifier.
	 * @return int Existing post ID or zero if none.
	 */
	protected static function find_seeded_post( string $post_type, string $seed_key ): int {
		$existing = get_posts(
			[
				'post_type'   => $post_type,
				'meta_key'    => self::SEED_META_KEY, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				'meta_value'  => $seed_key, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
				'numberposts' => 1,
				'post_status' => 'any',
				'fields'      => 'ids',
			]
		);

		if ( ! empty( $existing ) ) {
			return (int) $existing[0];
		}

		return 0;
	}

	/**
	 * Insert (or return existing) demo post idempotently.
	 *
	 * @param string               $post_type Post type slug.
	 * @param string               $seed_key  Seed identifier.
	 * @param array<string, mixed> $args      Args for `wp_insert_post`.
	 * @return int Resulting post ID, or zero on failure.
	 */
	protected static function insert_seeded_post( string $post_type, string $seed_key, array $args ): int {
		$existing_id = self::find_seeded_post( $post_type, $seed_key );

		if ( $existing_id > 0 ) {
			return $existing_id;
		}

		$args['post_type']   = $post_type;
		$args['post_status'] = isset( $args['post_status'] ) ? $args['post_status'] : 'publish';

		$new_id = wp_insert_post( $args, true );

		if ( is_wp_error( $new_id ) || 0 === (int) $new_id ) {
			return 0;
		}

		update_post_meta( (int) $new_id, self::SEED_META_KEY, $seed_key );

		return (int) $new_id;
	}

	/**
	 * Look up a seeded term by seed key.
	 *
	 * @param string $taxonomy Taxonomy slug.
	 * @param string $seed_key Seed identifier.
	 * @return int Existing term ID or zero if none.
	 */
	protected static function find_seeded_term( string $taxonomy, string $seed_key ): int {
		$terms = get_terms(
			[
				'taxonomy'   => $taxonomy,
				'meta_key'   => self::TERM_SEED_META_KEY, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				'meta_value' => $seed_key, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
				'hide_empty' => false,
				'number'     => 1,
				'fields'     => 'ids',
			]
		);

		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			return (int) $terms[0];
		}

		return 0;
	}

	/**
	 * Insert (or return existing) demo term idempotently.
	 *
	 * @param string               $taxonomy Taxonomy slug.
	 * @param string               $seed_key Seed identifier.
	 * @param string               $name     Term display name.
	 * @param array<string, mixed> $args     Optional args for `wp_insert_term`.
	 * @return int Resulting term ID, or zero on failure.
	 */
	protected static function insert_seeded_term( string $taxonomy, string $seed_key, string $name, array $args = [] ): int {
		$existing_id = self::find_seeded_term( $taxonomy, $seed_key );

		if ( $existing_id > 0 ) {
			return $existing_id;
		}

		$result = wp_insert_term( $name, $taxonomy, $args );

		if ( is_wp_error( $result ) ) {
			// If the term already exists (without seed meta), grab and tag it.
			$data = $result->get_error_data();
			if ( is_array( $data ) && isset( $data['term_id'] ) ) {
				$term_id = (int) $data['term_id'];
				update_term_meta( $term_id, self::TERM_SEED_META_KEY, $seed_key );
				return $term_id;
			}
			return 0;
		}

		$term_id = (int) $result['term_id'];
		update_term_meta( $term_id, self::TERM_SEED_META_KEY, $seed_key );

		return $term_id;
	}

	/**
	 * Seed taxonomy terms across the three custom taxonomies.
	 *
	 * @return void
	 */
	public static function seed_terms(): void {
		$categories = [
			'cat-personal-injury'   => __( 'Personal Injury', 'inf' ),
			'cat-civil-litigation'  => __( 'Civil Litigation', 'inf' ),
		];

		foreach ( $categories as $key => $name ) {
			self::insert_seeded_term( 'practice-area-category', $key, $name );
		}

		$areas = [
			'area-florida'    => __( 'Florida', 'inf' ),
			'area-california' => __( 'California', 'inf' ),
		];

		foreach ( $areas as $key => $name ) {
			self::insert_seeded_term( 'area-served', $key, $name );
		}

		$specialties = [
			'spec-class-actions'   => __( 'Class Actions', 'inf' ),
			'spec-trial-advocacy'  => __( 'Trial Advocacy', 'inf' ),
			'spec-appellate'       => __( 'Appellate', 'inf' ),
		];

		foreach ( $specialties as $key => $name ) {
			self::insert_seeded_term( 'attorney-specialty', $key, $name );
		}
	}

	/**
	 * Seed Practice Area CPT posts (parent + 5 children).
	 *
	 * @return void
	 */
	public static function seed_practice_areas(): void {
		$parent_id = self::insert_seeded_post(
			'practice-area',
			'pa-personal-injury',
			[
				'post_title'   => __( 'Personal Injury', 'inf' ),
				'post_name'    => 'personal-injury',
				'post_content' => self::lorem(),
				'post_excerpt' => __( 'Representing injured clients across a full spectrum of personal-injury matters.', 'inf' ),
			]
		);

		$category_term_id = self::find_seeded_term( 'practice-area-category', 'cat-personal-injury' );

		if ( $parent_id > 0 && $category_term_id > 0 ) {
			wp_set_object_terms( $parent_id, [ $category_term_id ], 'practice-area-category' );
		}

		$children = [
			'pa-car-accidents' => [
				'title'   => __( 'Car Accidents', 'inf' ),
				'excerpt' => __( 'Pursuing maximum compensation for victims of automobile collisions.', 'inf' ),
			],
			'pa-truck-accidents' => [
				'title'   => __( 'Truck Accidents', 'inf' ),
				'excerpt' => __( 'Holding commercial carriers accountable for catastrophic truck wrecks.', 'inf' ),
			],
			'pa-slip-and-fall' => [
				'title'   => __( 'Slip & Fall', 'inf' ),
				'excerpt' => __( 'Helping clients recover after dangerous-property injuries.', 'inf' ),
			],
			'pa-medical-malpractice' => [
				'title'   => __( 'Medical Malpractice', 'inf' ),
				'excerpt' => __( 'Advocating for patients harmed by negligent medical care.', 'inf' ),
			],
			'pa-wrongful-death' => [
				'title'   => __( 'Wrongful Death', 'inf' ),
				'excerpt' => __( 'Standing with families seeking justice after a preventable loss.', 'inf' ),
			],
		];

		foreach ( $children as $seed_key => $child ) {
			$child_id = self::insert_seeded_post(
				'practice-area',
				$seed_key,
				[
					'post_title'   => $child['title'],
					'post_content' => self::lorem(),
					'post_excerpt' => $child['excerpt'],
					'post_parent'  => $parent_id,
				]
			);

			if ( $child_id > 0 && $category_term_id > 0 ) {
				wp_set_object_terms( $child_id, [ $category_term_id ], 'practice-area-category' );
			}
		}
	}

	/**
	 * Seed the Attorney CPT.
	 *
	 * @return void
	 */
	public static function seed_attorneys(): void {
		$attorneys = [
			'att-penelope-pug' => [
				'title'         => __( 'Penelope Pug', 'inf' ),
				'position'      => __( 'Senior Partner', 'inf' ),
				'specialty_key' => 'spec-trial-advocacy',
				'excerpt'       => __( 'Penelope leads complex trial work with two decades of courtroom experience.', 'inf' ),
			],
			'att-bartholomew-puggle' => [
				'title'         => __( 'Bartholomew Puggle', 'inf' ),
				'position'      => __( 'Managing Partner', 'inf' ),
				'specialty_key' => 'spec-class-actions',
				'excerpt'       => __( 'Bartholomew built the firm’s class-action practice from the ground up.', 'inf' ),
			],
			'att-cassandra-beagle' => [
				'title'         => __( 'Cassandra Beagle', 'inf' ),
				'position'      => __( 'Associate Attorney', 'inf' ),
				'specialty_key' => 'spec-appellate',
				'excerpt'       => __( 'Cassandra focuses on appellate strategy and dispositive motion practice.', 'inf' ),
			],
		];

		foreach ( $attorneys as $seed_key => $attorney ) {
			$post_id = self::insert_seeded_post(
				'attorney',
				$seed_key,
				[
					'post_title'   => $attorney['title'],
					'post_content' => self::lorem(),
					'post_excerpt' => $attorney['excerpt'],
				]
			);

			if ( 0 === $post_id ) {
				continue;
			}

			$specialty_id = self::find_seeded_term( 'attorney-specialty', $attorney['specialty_key'] );

			if ( $specialty_id > 0 ) {
				wp_set_object_terms( $post_id, [ $specialty_id ], 'attorney-specialty' );
			}

			if ( function_exists( 'update_field' ) ) {
				update_field( 'position', $attorney['position'], $post_id );
			}
		}
	}

	/**
	 * Seed the Office CPT.
	 *
	 * @return void
	 */
	public static function seed_offices(): void {
		$offices = [
			'office-miami' => [
				'title' => __( 'Miami Office', 'inf' ),
				'slug'  => 'miami-office',
				'lat'   => 25.7617,
				'lng'   => -80.1918,
			],
			'office-tampa' => [
				'title' => __( 'Tampa Office', 'inf' ),
				'slug'  => 'tampa-office',
				'lat'   => 27.9506,
				'lng'   => -82.4572,
			],
		];

		foreach ( $offices as $seed_key => $office ) {
			$post_id = self::insert_seeded_post(
				'office',
				$seed_key,
				[
					'post_title'   => $office['title'],
					'post_name'    => $office['slug'],
					'post_content' => self::lorem(),
				]
			);

			if ( 0 === $post_id ) {
				continue;
			}

			if ( function_exists( 'update_field' ) ) {
				update_field(
					'geopoint',
					[
						'lat' => $office['lat'],
						'lng' => $office['lng'],
					],
					$post_id
				);
			}
		}
	}

	/**
	 * Seed the Case Result CPT.
	 *
	 * @return void
	 */
	public static function seed_case_results(): void {
		$results = [
			'cr-truck-32m' => [
				'title'       => __( '$3.2M Settlement — Truck Accident', 'inf' ),
				'excerpt'     => __( 'Multi-million dollar resolution for a family devastated by a commercial truck crash.', 'inf' ),
				'amount'      => '$3.2M',
				'result_type' => __( 'Settlement', 'inf' ),
			],
			'cr-medmal-15m' => [
				'title'       => __( '$1.5M Verdict — Medical Malpractice', 'inf' ),
				'excerpt'     => __( 'Jury verdict against a hospital system in a misdiagnosis case.', 'inf' ),
				'amount'      => '$1.5M',
				'result_type' => __( 'Verdict', 'inf' ),
			],
			'cr-slip-850k' => [
				'title'       => __( '$850K Settlement — Slip & Fall', 'inf' ),
				'excerpt'     => __( 'Pre-trial settlement for a client injured at a national retailer.', 'inf' ),
				'amount'      => '$850K',
				'result_type' => __( 'Settlement', 'inf' ),
			],
			'cr-car-21m' => [
				'title'       => __( '$2.1M Verdict — Car Accident', 'inf' ),
				'excerpt'     => __( 'Verdict securing lifetime care for a severely injured driver.', 'inf' ),
				'amount'      => '$2.1M',
				'result_type' => __( 'Verdict', 'inf' ),
			],
			'cr-wd-500k' => [
				'title'       => __( '$500K Settlement — Wrongful Death', 'inf' ),
				'excerpt'     => __( 'Compassionate resolution for a grieving family.', 'inf' ),
				'amount'      => '$500K',
				'result_type' => __( 'Settlement', 'inf' ),
			],
		];

		foreach ( $results as $seed_key => $result ) {
			$post_id = self::insert_seeded_post(
				'case-result',
				$seed_key,
				[
					'post_title'   => $result['title'],
					'post_content' => self::lorem(),
					'post_excerpt' => $result['excerpt'],
				]
			);

			if ( 0 === $post_id ) {
				continue;
			}

			if ( function_exists( 'update_field' ) ) {
				update_field( 'amount_display', $result['amount'], $post_id );
				update_field( 'result_type', $result['result_type'], $post_id );
				update_field( 'case_year', 2024, $post_id );
			}
		}
	}

	/**
	 * Seed the Testimonial CPT.
	 *
	 * @return void
	 */
	public static function seed_testimonials(): void {
		$testimonials = [
			'test-best-decision' => [
				'title'    => __( 'Best decision we made', 'inf' ),
				'content'  => __( 'From the first phone call we felt heard. The team kept us informed every step of the way and delivered a result that changed our lives.', 'inf' ),
				'reviewer' => __( 'Marie L.', 'inf' ),
			],
			'test-life-changing' => [
				'title'    => __( 'Truly life changing', 'inf' ),
				'content'  => __( 'I came in nervous and uncertain. They walked me through every option, fought hard, and won. I cannot recommend them highly enough.', 'inf' ),
				'reviewer' => __( 'John D.', 'inf' ),
			],
			'test-incredible-team' => [
				'title'    => __( 'An incredible team', 'inf' ),
				'content'  => __( 'Professional, kind, and relentless when it counted. They treated my case like it was the only one on their docket.', 'inf' ),
				'reviewer' => __( 'Sarah W.', 'inf' ),
			],
			'test-felt-like-family' => [
				'title'    => __( 'Felt like family', 'inf' ),
				'content'  => __( 'Pug & Puggle made a difficult chapter of my life feel manageable. I will always be grateful for the care they showed.', 'inf' ),
				'reviewer' => __( 'Tom K.', 'inf' ),
			],
			'test-worth-every-penny' => [
				'title'    => __( 'Worth every penny', 'inf' ),
				'content'  => __( 'They exceeded my expectations at every turn. The settlement came in higher than I dared to hope.', 'inf' ),
				'reviewer' => __( 'Lisa M.', 'inf' ),
			],
			'test-fast-and-fair' => [
				'title'    => __( 'Fast and fair resolution', 'inf' ),
				'content'  => __( 'Communication was excellent throughout, and they never pressured me to settle for less than I deserved.', 'inf' ),
				'reviewer' => __( 'David R.', 'inf' ),
			],
		];

		foreach ( $testimonials as $seed_key => $testimonial ) {
			$post_id = self::insert_seeded_post(
				'testimonials',
				$seed_key,
				[
					'post_title'   => $testimonial['title'],
					'post_content' => $testimonial['content'],
				]
			);

			if ( 0 === $post_id ) {
				continue;
			}

			if ( function_exists( 'update_field' ) ) {
				update_field( 'rating', 5, $post_id );
				update_field(
					'reviewer',
					[
						'name' => $testimonial['reviewer'],
					],
					$post_id
				);
			}
		}
	}

	/**
	 * Seed the FAQ CPT.
	 *
	 * @return void
	 */
	public static function seed_faqs(): void {
		$faqs = [
			'faq-cost' => [
				'title'   => __( 'How much does it cost to hire a lawyer?', 'inf' ),
				'content' => __( 'Most of our personal-injury cases are handled on a contingency-fee basis, which means there are no up-front costs to you. We only get paid if we recover money on your behalf.', 'inf' ),
			],
			'faq-contingency' => [
				'title'   => __( 'What is a contingency fee?', 'inf' ),
				'content' => __( 'A contingency fee is a percentage of the recovery that we keep as our fee. If we do not win, you owe us nothing for our time.', 'inf' ),
			],
			'faq-office-visit' => [
				'title'   => __( 'Do I need to come to your office?', 'inf' ),
				'content' => __( 'Not at all. We can meet by phone, video conference, or visit you at home or in the hospital if needed. Whatever is easiest for you.', 'inf' ),
			],
			'faq-case-length' => [
				'title'   => __( 'How long will my case take?', 'inf' ),
				'content' => __( 'Every case is different. Some resolve in a few months, while complex matters can take a year or more. We will give you a realistic timeline after reviewing the facts.', 'inf' ),
			],
		];

		foreach ( $faqs as $seed_key => $faq ) {
			self::insert_seeded_post(
				'faq',
				$seed_key,
				[
					'post_title'   => $faq['title'],
					'post_content' => $faq['content'],
				]
			);
		}
	}

	/**
	 * Seed the Home page and pin it to the front of the site.
	 *
	 * @return void
	 */
	public static function seed_home_page(): void {
		$content = '<!-- wp:paragraph --><p>' . esc_html__( 'Welcome to the Law Firm of Pug and Puggle, ESQ.', 'inf' ) . '</p><!-- /wp:paragraph -->';

		$page_id = self::insert_seeded_post(
			'page',
			'page-home',
			[
				'post_title'   => __( 'Home', 'inf' ),
				'post_name'    => 'home',
				'post_content' => $content,
			]
		);

		if ( $page_id > 0 ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $page_id );
		}
	}

	/**
	 * Seed the three theme-registered nav menus and assign to locations.
	 *
	 * @return void
	 */
	public static function seed_menus(): void {
		$locations = [ 'nav', 'mobile-nav', 'footer' ];

		$items = [
			[
				'title' => __( 'Home', 'inf' ),
				'url'   => home_url( '/' ),
			],
			[
				'title' => __( 'Practice Areas', 'inf' ),
				'url'   => home_url( '/practice-areas/' ),
			],
			[
				'title' => __( 'Attorneys', 'inf' ),
				'url'   => home_url( '/attorneys/' ),
			],
			[
				'title' => __( 'Offices', 'inf' ),
				'url'   => home_url( '/offices/' ),
			],
			[
				'title' => __( 'Case Results', 'inf' ),
				'url'   => home_url( '/case-results/' ),
			],
			[
				'title' => __( 'Testimonials', 'inf' ),
				'url'   => home_url( '/testimonials/' ),
			],
		];

		$menu_locations = get_theme_mod( 'nav_menu_locations' );

		if ( ! is_array( $menu_locations ) ) {
			$menu_locations = [];
		}

		foreach ( $locations as $location ) {
			$menu_slug = 'pp-' . $location;
			$menu_name = 'PP ' . $location;

			$existing = get_term_by( 'slug', $menu_slug, 'nav_menu' );

			if ( false !== $existing ) {
				$menu_id = (int) $existing->term_id;
			} else {
				$created = wp_create_nav_menu( $menu_name );

				if ( is_wp_error( $created ) ) {
					continue;
				}

				$menu_id = (int) $created;

				// Force the menu slug so subsequent runs can find it.
				wp_update_term(
					$menu_id,
					'nav_menu',
					[
						'slug' => $menu_slug,
					]
				);

				foreach ( $items as $item ) {
					wp_update_nav_menu_item(
						$menu_id,
						0,
						[
							'menu-item-title'   => $item['title'],
							'menu-item-url'     => $item['url'],
							'menu-item-type'    => 'custom',
							'menu-item-status'  => 'publish',
						]
					);
				}
			}

			$menu_locations[ $location ] = $menu_id;
		}

		set_theme_mod( 'nav_menu_locations', $menu_locations );
	}
}
