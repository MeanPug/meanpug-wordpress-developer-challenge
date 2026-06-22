<?php
/**
 * Front page partial: the category navigation row.
 *
 * The Airbnb reference shows a "tab" strip (Places to stay / Monthly stays /
 * Experiences / Online Experiences). We deliberately model this as a <nav> with
 * aria-current rather than ARIA tablist/tab/tabpanel semantics: a true tablist
 * must own focusable tab panels and arrow-key handling, and we have no panels to
 * switch (this challenge is visual only). Using nav + aria-current is the
 * honest, accessible choice — it announces correctly to screen readers without
 * promising interactive behaviour that isn't there.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

$doghouse_categories = array(
	array(
		'label'   => __( 'Places to stay', 'inf' ),
		'current' => true,
		'badge'   => '',
	),
	array(
		'label'   => __( 'Monthly stays', 'inf' ),
		'current' => false,
		'badge'   => '',
	),
	array(
		'label'   => __( 'Experiences', 'inf' ),
		'current' => false,
		'badge'   => '',
	),
	array(
		'label'   => __( 'Online Experiences', 'inf' ),
		'current' => false,
		'badge'   => __( 'New', 'inf' ),
	),
);
?>
<nav class="doghouse-tabs bg-white border-t border-doghouse-line" aria-label="<?php esc_attr_e( 'Browse stay categories', 'inf' ); ?>">
	<ul class="container mx-auto px-6 flex gap-6 overflow-x-auto list-none m-0 p-0">
		<?php foreach ( $doghouse_categories as $doghouse_category ) : ?>
			<li class="shrink-0">
				<a
					href="#"
					class="inline-flex items-center gap-1 py-4 border-b-2 whitespace-nowrap text-sm font-semibold transition-colors <?php echo $doghouse_category['current'] ? 'border-doghouse-ink text-doghouse-ink' : 'border-transparent text-doghouse-muted hover:text-doghouse-ink hover:border-doghouse-line'; ?>"
					<?php echo $doghouse_category['current'] ? 'aria-current="page"' : ''; ?>
				>
					<?php echo esc_html( $doghouse_category['label'] ); ?>
					<?php if ( '' !== $doghouse_category['badge'] ) : ?>
						<span class="ml-1 inline-block rounded-full bg-doghouse px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-white"><?php echo esc_html( $doghouse_category['badge'] ); ?></span>
					<?php endif; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
