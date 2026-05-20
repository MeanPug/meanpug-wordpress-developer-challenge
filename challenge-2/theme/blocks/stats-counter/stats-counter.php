<?php
/**
 * Stats Counter render template.
 *
 * @package PugPuggle
 *
 * @var array $attributes
 */

if ( class_exists( '\\PugPuggle\\Assets' ) ) {
	\PugPuggle\Assets::enqueue_block( 'stats-counter' );
}

$heading = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : '';
$stats   = isset( $attributes['stats'] ) && is_array( $attributes['stats'] ) ? $attributes['stats'] : array();
?>
<section class="inf-block inf-stats-counter py-16 px-6 max-w-7xl mx-auto">
	<?php if ( '' !== $heading ) : ?>
		<h2 class="text-3xl md:text-4xl font-bold text-center"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( ! empty( $stats ) ) : ?>
		<div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
			<?php
			foreach ( $stats as $stat ) :
				$value       = isset( $stat['value'] ) ? (string) $stat['value'] : '';
				$label       = isset( $stat['label'] ) ? (string) $stat['label'] : '';
				$description = isset( $stat['description'] ) ? (string) $stat['description'] : '';
				?>
				<div class="text-center p-6">
					<?php if ( '' !== $value ) : ?>
						<div class="text-5xl font-bold"><?php echo esc_html( $value ); ?></div>
					<?php endif; ?>
					<?php if ( '' !== $label ) : ?>
						<div class="mt-2 text-lg"><?php echo esc_html( $label ); ?></div>
					<?php endif; ?>
					<?php if ( '' !== $description ) : ?>
						<div class="mt-1 text-sm text-stone-600"><?php echo esc_html( $description ); ?></div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<p class="mt-10 text-center text-stone-600"><?php esc_html_e( 'No stats configured.', 'inf' ); ?></p>
	<?php endif; ?>
</section>
