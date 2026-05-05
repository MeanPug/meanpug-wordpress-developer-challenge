<?php
?>
<main class="inf-archive inf-case-results py-16 px-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4 text-center">Verdicts & Settlements</h1>
        <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto">Proven results for our clients. We have recovered millions of dollars for victims of negligence.</p>
        
        <div class="space-y-6">
            <?php while (have_posts()) : the_post(); 
                $amount = get_field('case_result_amount') ?: 'Confidential';
                $case_type = get_field('case_result_type') ?: 'Personal Injury';
            ?>
                <article class="bg-white rounded-lg shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row items-center justify-between hover:shadow-md transition-shadow">
                    <div class="mb-4 md:mb-0 md:mr-8 text-center md:text-left">
                        <span class="text-yellow-600 font-bold uppercase tracking-widest text-xs mb-2 block"><?php echo esc_html($case_type); ?></span>
                        <h2 class="text-2xl font-bold text-gray-900 leading-tight"><?php the_title(); ?></h2>
                    </div>
                    <div class="flex flex-col items-center md:items-end">
                        <span class="text-3xl md:text-4xl font-black text-gray-900 mb-4"><?php echo esc_html($amount); ?></span>
                        <a href="<?php the_permalink(); ?>" class="text-sm font-bold text-gray-900 uppercase tracking-widest border-b-2 border-yellow-500 hover:text-yellow-600 transition-colors">
                            Case Details
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>
