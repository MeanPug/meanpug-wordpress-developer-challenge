<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $settlement_amount = get_field('settlement_amount');
        $related_attorney = get_field('related_attorney');
        $related_practice_area = get_field('related_practice_area');
?>

<div class="bg-white min-h-screen pb-20">
    <!-- Hero Banner -->
    <div class="bg-gray-900 py-20 px-4 sm:px-6 lg:px-8 text-center relative overflow-hidden">
        <!-- Abstract background pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#f59e0b 2px, transparent 2px); background-size: 30px 30px;"></div>
        
        <div class="relative z-10 max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6"><?php the_title(); ?></h1>
            
            <?php if ($settlement_amount) : ?>
                <div class="inline-block bg-yellow-500 text-gray-900 font-black text-5xl md:text-7xl px-8 py-4 rounded-lg shadow-2xl mt-4">
                    <?php echo esc_html($settlement_amount); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Content & Details -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden flex flex-col md:flex-row">
            
            <!-- Details Sidebar -->
            <div class="md:w-1/3 bg-gray-50 p-8 border-r border-gray-200 flex flex-col gap-8">
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Verdict / Settlement</h3>
                    <div class="text-xl font-bold text-gray-900 border-l-4 border-yellow-500 pl-3">
                        <?php echo $settlement_amount ? esc_html($settlement_amount) : 'Confidential'; ?>
                    </div>
                </div>

                <?php if ($related_practice_area) : ?>
                    <div>
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Practice Area</h3>
                        <a href="<?php echo get_permalink($related_practice_area->ID); ?>" class="text-lg font-bold text-yellow-600 hover:text-yellow-700 transition-colors block border-l-4 border-yellow-500 pl-3">
                            <?php echo esc_html(get_the_title($related_practice_area->ID)); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($related_attorney) : ?>
                    <div>
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Lead Attorney</h3>
                        <div class="flex items-center gap-4 mt-2">
                            <?php if (has_post_thumbnail($related_attorney->ID)) : ?>
                                <a href="<?php echo get_permalink($related_attorney->ID); ?>" class="block w-16 h-16 rounded-full overflow-hidden border-2 border-yellow-500 flex-shrink-0">
                                    <?php echo get_the_post_thumbnail($related_attorney->ID, 'thumbnail', ['class' => 'w-full h-full object-cover object-top']); ?>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo get_permalink($related_attorney->ID); ?>" class="text-lg font-bold text-gray-900 hover:text-yellow-600 transition-colors">
                                <?php echo esc_html(get_the_title($related_attorney->ID)); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="mt-auto pt-8">
                    <a href="<?php echo get_post_type_archive_link('case-result'); ?>" class="text-gray-500 hover:text-gray-900 font-semibold text-sm flex items-center gap-2">
                        &larr; Back to all results
                    </a>
                </div>
            </div>

            <!-- Case Summary -->
            <div class="md:w-2/3 p-8 md:p-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Case Summary</h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    <?php the_content(); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
    endwhile;
endif;

get_footer();
?>
