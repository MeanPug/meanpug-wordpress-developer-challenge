<?php
/**
 * Properties grid — queries and renders dynamic CPT custom entries.
 */
$args = array(
    'post_type'      => 'property',
    'posts_per_page' => 9,
    'orderby'        => 'date',
    'order'          => 'DESC'
);
$properties_query = new WP_Query( $args );
?>

<div class="container mx-auto px-6 max-w-7xl mt-16 pb-12 border-t border-gray-100">
    <h2 class="text-2xl font-bold tracking-tight text-neutral-800 pt-8 mb-6">Rooms near you</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php if ( $properties_query->have_posts() ): ?>
            <?php while ( $properties_query->have_posts() ): $properties_query->the_post(); ?>
                <?php get_template_part( 'template-parts/properties/property-card', null, array( 'property' => $post ) ); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else: ?>
            <p class="col-span-full text-center text-gray-400 py-12">No rooms have been added or seeded yet.</p>
        <?php endif; ?>
    </div>
</div>