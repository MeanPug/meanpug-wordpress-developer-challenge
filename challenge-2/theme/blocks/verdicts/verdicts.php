<?php
/**
 * Block Name: Verdicts
 * Description: Display recent case results in Harkness style
 */

$args = array(
    'post_type'      => 'case-result',
    'posts_per_page' => 3,
);
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <section class="py-32 px-6 bg-[#0b1120]">
        <div class="max-w-[1200px] mx-auto">
            <div class="mb-16">
          
                <h2 class="text-[#d4af37] text-4xl font-bold">Our Case Results.</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php while ($query->have_posts()) : $query->the_post(); 
                    $amount = get_field('settlement_amount');
                    $type = get_field('case_type');
                ?>
                    <div class="bg-white p-10 rounded-xl flex flex-col items-center text-center shadow-2xl">
                        <div class="mb-6 text-[#d4af37]">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10v2a2 2 0 002 2V6a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h4a2 2 0 110 4H8a2 2 0 01-2-2z" clip-rule="evenodd"></path></svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#0b1120] uppercase tracking-tighter mb-2"><?php echo esc_html($amount); ?></h3>
                        <p class="text-[10px] font-black text-[#d4af37] uppercase tracking-widest mb-6"><?php echo esc_html($type); ?></p>
                        <div class="text-xs text-gray-500 leading-relaxed font-medium">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
