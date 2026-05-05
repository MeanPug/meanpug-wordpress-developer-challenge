<?php
/**
 * Block Name: Featured Attorneys
 * Description: Display attorneys in Harkness style
 */

$args = array(
    'post_type'      => 'attorney',
    'posts_per_page' => 2,
);
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <section class="py-32 px-6 bg-white border-t border-gray-100">
        <div class="max-w-[1000px] mx-auto">
            <div class="mb-16">
                <span class="section-label text-[#d4af37] text-4xl font-bold">Our Firm</span>
                <h2 class="text-black text-3xl font-medium">The Faces of Justice.</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <?php while ($query->have_posts()) : $query->the_post(); 
                    $headshot = get_field('attorney_headshot');
                    $title = get_field('attorney_title') ?: 'Attorney at Law';
                    $img_url = $headshot ? $headshot['url'] : get_template_directory_uri() . '/assets/images/harkness_hero_pug.png';
                ?>
                    <div class="attorney-card-harkness group">
                        <div class="aspect-[4/5] overflow-hidden relative">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 scale-110 group-hover:scale-100">
                            <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent opacity-60"></div>
                        </div>
                        <div class="p-8 text-center border-t-4 border-[#d4af37]">
                            <h3 class="text-xl font-black text-[#0b1120] uppercase tracking-tight mb-1"><?php the_title(); ?></h3>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest"><?php echo esc_html($title); ?></p>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>

            <div class="mt-20 text-center">
                <a href="<?php echo get_post_type_archive_link('attorney'); ?>" class="bg-[#d4af37] text-black px-10 py-4 rounded text-[10px] font-black uppercase tracking-widest hover:bg-[#0b1120] hover:text-white transition-colors shadow-xl inline-block">
                    Meet Our Firm
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>
