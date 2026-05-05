<?php
$heading = get_field('attorneys_heading') ?: 'Meet Our Experienced Team';

$args = array(
    'post_type'      => 'attorney',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
);
$query = new WP_Query($args);

if (isset($block['data']['is_preview'])) : ?>
    <div style="padding:20px; border:2px dashed #ccc; background:#fafafa;">
        <h3 style="text-align:center;"><?php echo esc_html($heading); ?></h3>
        <p style="text-align:center; color:#666;">[ Preview of 4 recent Attorneys will display here ]</p>
    </div>
<?php else : ?>
    <section class="py-20 px-6 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-16">
                <?php echo esc_html($heading); ?>
            </h2>
            
            <?php if ($query->have_posts()) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col transition-transform duration-300 hover:-translate-y-2">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="block h-64 overflow-hidden">
                                    <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover object-top']); ?>
                                </a>
                            <?php else : ?>
                                <div class="h-64 bg-gray-300 flex items-center justify-center">
                                    <span class="text-gray-500">No Photo</span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6 flex-grow flex flex-col">
                                <h3 class="text-xl font-bold text-gray-900 mb-1">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-yellow-600 transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                
                                <div class="text-gray-600 text-sm flex-grow mb-4">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="text-yellow-600 font-semibold uppercase tracking-wider text-sm hover:text-yellow-700">
                                    View Profile &rarr;
                                </a>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                
                <div class="text-center mt-12">
                    <a href="<?php echo get_post_type_archive_link('attorney'); ?>" class="inline-block bg-gray-900 text-white font-bold py-3 px-8 rounded shadow hover:bg-gray-800 transition-colors duration-300">
                        See All Attorneys
                    </a>
                </div>
            <?php else : ?>
                <p class="text-center text-gray-500">No attorneys published yet.</p>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
