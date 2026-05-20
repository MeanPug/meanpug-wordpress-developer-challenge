<?php
/**
 * FAQ Accordion render template.
 *
 * @package PugPuggle
 *
 * @var array $attributes
 */

if ( class_exists( '\\PugPuggle\\Assets' ) ) {
	\PugPuggle\Assets::enqueue_block( 'faq-accordion' );
}

$heading = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : __( 'Frequently Asked Questions', 'inf' );
$faq_ids = isset( $attributes['faqIds'] ) && is_array( $attributes['faqIds'] ) ? $attributes['faqIds'] : array();

$faq_posts = array();
foreach ( $faq_ids as $faq_id ) {
	$post = get_post( (int) $faq_id );
	if ( $post instanceof WP_Post ) {
		$faq_posts[] = $post;
	}
}
?>
<section class="inf-block inf-faq-accordion py-16 px-6 max-w-4xl mx-auto">
	<?php if ( '' !== $heading ) : ?>
		<h2 class="text-3xl md:text-4xl font-bold text-center"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( ! empty( $faq_posts ) ) : ?>
		<dl class="mt-10 space-y-4">
			<?php foreach ( $faq_posts as $faq_post ) : ?>
				<details class="border border-stone-200 rounded">
					<summary class="cursor-pointer p-4 font-semibold text-lg">
						<?php echo esc_html( get_the_title( $faq_post ) ); ?>
					</summary>
					<div class="p-4 pt-0 prose">
						<?php echo wp_kses_post( apply_filters( 'the_content', $faq_post->post_content ) ); ?>
					</div>
				</details>
			<?php endforeach; ?>
		</dl>

		<?php
		if ( function_exists( 'mp_generate_question_answer_schema' ) && function_exists( 'mp_generate_faq_page_schema' ) ) {
			$qa_entries = array();
			foreach ( $faq_posts as $faq_post ) {
				$qa_entries[] = mp_generate_question_answer_schema(
					get_the_title( $faq_post ),
					wp_strip_all_tags( (string) $faq_post->post_content )
				);
			}
			if ( ! empty( $qa_entries ) ) {
				mp_generate_faq_page_schema( $qa_entries );
			}
		}
		?>
	<?php else : ?>
		<p class="mt-10 text-center text-stone-600"><?php esc_html_e( 'No FAQs found.', 'inf' ); ?></p>
	<?php endif; ?>
</section>
