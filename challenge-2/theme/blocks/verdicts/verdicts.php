<?php
$heading = get_field('verdicts_heading') ?: 'Recent Verdicts & Settlements';

// Fetch the 3 most recent case results
$args = array(
    'post_type'      => 'case-result',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
);
$query = new WP_Query($args);

if (isset($block['data']['is_preview'])) : ?>
    <div style="padding:20px; border:2px dashed #ccc; background:#fafafa;">
        <h3 style="text-align:center;"><?php echo esc_html($heading); ?></h3>
        <p style="text-align:center; color:#666;">[ Preview of 3 recent Case Results will display here ]</p>
    </div>
<?php else : ?>
    <section class="py-20 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">
                <?php echo esc_html($heading); ?>
            </h2>
            
            <?php if ($query->have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php while ($query->have_posts()) : $query->the_post(); 
                        $amount = get_field('settlement_amount');
                        $practice_area = get_field('related_practice_area');
                    ?>
                        <div class="bg-gray-50 border-l-4 border-yellow-500 p-8 shadow hover:shadow-lg transition-shadow duration-300">
                            <?php if ($amount) : ?>
                                <div class="text-4xl font-black text-gray-900 mb-4">
                                    <?php echo esc_html($amount); ?>
                                </div>
                            <?php endif; ?>
                            
                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                <?php the_title(); ?>
                            </h3>
                            
                            <?php if ($practice_area) : ?>
                                <p class="text-yellow-600 font-semibold uppercase tracking-wider text-sm mt-4">
                                    <?php echo esc_html(get_the_title($practice_area->ID)); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                
                <div class="text-center mt-12">
                    <a href="<?php echo get_post_type_archive_link('case-result'); ?>" class="inline-block border-2 border-gray-900 text-gray-900 font-bold py-3 px-6 rounded hover:bg-gray-900 hover:text-white transition-colors duration-300">
                        View All Results
                    </a>
                </div>
            <?php else : ?>
                <p class="text-center text-gray-500">No case results published yet.</p>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
