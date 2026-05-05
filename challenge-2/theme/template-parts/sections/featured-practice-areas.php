<?php
/**
 * Section: Featured Practice Areas
 * Harkness Style
 */

$args = array(
    'post_type'      => 'practice-area',
    'posts_per_page' => 2,
);
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <section class="py-32 px-6 bg-white">
        <div class="max-w-[1000px] mx-auto">
            <div class="mb-16">
                <span class="section-label text-[#d4af37] text-4xl font-bold">Areas of Care</span>
           
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <?php while ($query->have_posts()) : $query->the_post(); 
                    $icon = get_field('icon_class') ?: 'fas fa-scale-balanced';
                ?>
                    <div class="harkness-card flex flex-col items-start">
                        <div class="text-3xl text-[#0b1120] mb-8 opacity-40">
                             <i class="<?php echo esc_attr($icon); ?>"></i>
                        </div>
                        <h3 class="text-xl font-black text-[#0b1120] uppercase tracking-tight mb-6"><?php the_title(); ?></h3>
                        <div class="text-sm text-gray-400 leading-loose font-medium mb-8">
                            <?php echo wp_trim_words(get_the_content(), 25); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="text-[10px] font-black uppercase tracking-[0.3em] text-[#d4af37] border-b-2 border-[#d4af37] pb-1 hover:text-[#0b1120] hover:border-[#0b1120] transition-colors">
                            Learn More
                        </a>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
