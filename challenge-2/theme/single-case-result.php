<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $settlement_amount = get_field('settlement_amount');
        $related_attorney = get_field('related_attorney');
        $related_practice_area = get_field('related_practice_area');
?>

<div class="bg-gray-900 min-h-screen pb-20">
    <!-- Hero Banner -->
    <div class="bg-gray-900 py-24 px-4 sm:px-6 lg:px-8 text-center relative overflow-hidden border-b border-gray-800">
        <!-- Abstract background pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#f59e0b 2px, transparent 2px); background-size: 30px 30px;"></div>
        
        <div class="relative z-10 max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-black text-white mb-8 uppercase tracking-tighter"><?php the_title(); ?></h1>
            
            <?php if ($settlement_amount) : ?>
                <div class="inline-block bg-yellow-500 text-gray-900 font-black text-5xl md:text-7xl px-10 py-6 rounded-2xl shadow-2xl mt-4 transform -rotate-2">
                    <?php echo esc_html($settlement_amount); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Content & Details -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 relative z-20">
        <div class="bg-gray-800 rounded-2xl shadow-2xl border border-gray-700 overflow-hidden flex flex-col md:flex-row">
            
            <!-- Details Sidebar -->
            <div class="md:w-1/3 bg-gray-900 p-10 border-r border-gray-700 flex flex-col gap-10">
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-[0.2em] mb-4">Verdict / Settlement</h3>
                    <div class="text-2xl font-black text-white border-l-4 border-yellow-500 pl-4">
                        <?php echo $settlement_amount ? esc_html($settlement_amount) : 'Confidential'; ?>
                    </div>
                </div>

                <?php if ($related_practice_area) : ?>
                    <div>
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-[0.2em] mb-4">Practice Area</h3>
                        <a href="<?php echo get_permalink($related_practice_area->ID); ?>" class="text-xl font-bold text-yellow-500 hover:text-yellow-400 transition-colors block border-l-4 border-yellow-500 pl-4">
                            <?php echo esc_html(get_the_title($related_practice_area->ID)); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($related_attorney) : ?>
                    <div>
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-[0.2em] mb-4">Lead Attorney</h3>
                        <div class="flex items-center gap-5 mt-2">
                            <?php if (has_post_thumbnail($related_attorney->ID)) : ?>
                                <a href="<?php echo get_permalink($related_attorney->ID); ?>" class="block w-20 h-20 rounded-full overflow-hidden border-4 border-yellow-500 flex-shrink-0 shadow-xl">
                                    <?php echo get_the_post_thumbnail($related_attorney->ID, 'thumbnail', ['class' => 'w-full h-full object-cover object-top']); ?>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo get_permalink($related_attorney->ID); ?>" class="text-xl font-bold text-white hover:text-yellow-500 transition-colors">
                                <?php echo esc_html(get_the_title($related_attorney->ID)); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="mt-auto pt-10 border-t border-gray-800">
                    <a href="<?php echo get_post_type_archive_link('case-result'); ?>" class="text-gray-500 hover:text-white font-bold text-xs uppercase tracking-widest flex items-center gap-3 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back to all results
                    </a>
                </div>
            </div>

            <!-- Case Summary -->
            <div class="md:w-2/3 p-10 md:p-16">
                <h2 class="text-3xl font-black text-white mb-8 pb-6 border-b border-gray-700 uppercase tracking-tight">Case Summary</h2>
                <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed">
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
