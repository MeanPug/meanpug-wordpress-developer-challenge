<?php
/**
 * Office Hours widget.
 *
 * Displays today's hours for the nearest office and a link to its page.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Widgets;

/**
 * Class Office_Hours
 *
 * WP_Widget that surfaces today's open/close times for the default office.
 *
 * @package PugPuggle
 */
class Office_Hours extends \WP_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct(
			'pugpuggle_office_hours',
			__( 'Office Hours', 'inf' ),
			[
				'description' => __( "Shows today's hours for the nearest office", 'inf' ),
			]
		);
	}

	/**
	 * Resolve the office post to display.
	 *
	 * Prefers the ACF `default_office` option, falling back to the first
	 * published `office` post.
	 *
	 * @return \WP_Post|null
	 */
	protected function resolve_office(): ?\WP_Post {
		$office = function_exists( 'get_field' ) ? get_field( 'default_office', 'option' ) : null;

		if ( $office ) {
			if ( is_object( $office ) && $office instanceof \WP_Post ) {
				return $office;
			}

			if ( is_numeric( $office ) ) {
				$post = get_post( (int) $office );
				if ( $post instanceof \WP_Post ) {
					return $post;
				}
			}
		}

		$fallback = get_posts(
			[
				'post_type'      => 'office',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			]
		);

		if ( ! empty( $fallback ) && $fallback[0] instanceof \WP_Post ) {
			return $fallback[0];
		}

		return null;
	}

	/**
	 * Find today's row in the ACF `hours` repeater.
	 *
	 * @param int $office_id Office post ID.
	 * @return array|null    Associative row or null if not found.
	 */
	protected function find_today_row( int $office_id ): ?array {
		if ( ! function_exists( 'get_field' ) ) {
			return null;
		}

		$rows = get_field( 'hours', $office_id );
		if ( empty( $rows ) || ! is_array( $rows ) ) {
			return null;
		}

		$today = gmdate( 'l' );

		foreach ( $rows as $row ) {
			if ( ! is_array( $row ) || empty( $row['day'] ) ) {
				continue;
			}
			if ( 0 === strcasecmp( (string) $row['day'], $today ) ) {
				return $row;
			}
		}

		return null;
	}

	/**
	 * Front-end widget output.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved widget instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$office = $this->resolve_office();
		if ( null === $office ) {
			return;
		}

		$row         = $this->find_today_row( (int) $office->ID );
		$closed_flag = ! empty( $row['closed_flag'] );
		$open_time   = isset( $row['open'] ) ? (string) $row['open'] : '';
		$close_time  = isset( $row['close'] ) ? (string) $row['close'] : '';

		$title = ! empty( $instance['title'] )
			? (string) $instance['title']
			: __( 'Office Hours', 'inf' );

		$permalink    = get_permalink( $office );
		$office_title = get_the_title( $office );

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $title ) ) {
			echo wp_kses_post( $args['before_title'] ) . esc_html( $title ) . wp_kses_post( $args['after_title'] );
		}
		?>
		<aside class="pugpuggle-office-hours bg-stone-50 p-6 rounded-lg">
			<p class="text-sm font-semibold text-stone-900 mb-1">
				<?php echo esc_html( $office_title ); ?>
			</p>
			<?php if ( true === $closed_flag || ( '' === $open_time && '' === $close_time ) ) : ?>
				<p class="text-stone-700">
					<?php esc_html_e( 'Closed today', 'inf' ); ?>
				</p>
			<?php else : ?>
				<p class="text-stone-700">
					<?php
					printf(
						/* translators: 1: opening time, 2: closing time */
						esc_html__( 'Open today: %1$s – %2$s', 'inf' ),
						esc_html( $open_time ),
						esc_html( $close_time )
					);
					?>
				</p>
			<?php endif; ?>
			<?php if ( $permalink && $office_title ) : ?>
				<p class="mt-3">
					<a href="<?php echo esc_url( $permalink ); ?>" class="text-stone-900 font-semibold hover:underline">
						<?php
						printf(
							/* translators: %s: office name */
							esc_html__( 'Visit %s', 'inf' ),
							esc_html( $office_title )
						);
						?>
					</a>
				</p>
			<?php endif; ?>
		</aside>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved instance.
	 * @return string
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? (string) $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'inf' ); ?>
			</label>
			<input
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text"
				value="<?php echo esc_attr( $title ); ?>"
			>
		</p>
		<?php
		return '';
	}

	/**
	 * Sanitize widget form values before saving.
	 *
	 * @param array $new_instance Values just sent.
	 * @param array $old_instance Previously saved values.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = isset( $new_instance['title'] )
			? sanitize_text_field( (string) $new_instance['title'] )
			: '';

		return $instance;
	}
}
