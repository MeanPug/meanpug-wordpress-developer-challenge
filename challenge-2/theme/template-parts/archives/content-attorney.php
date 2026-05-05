<?php
?>
<main class="inf-archive inf-attorneys py-16 px-6 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-extrabold text-white mb-12 text-center">Our Attorneys</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php while (have_posts()) : the_post(); 
                $position = get_field('attorney_position') ?: 'Partner';
                $headshot = get_field('attorney_headshot');
            ?>
                <article class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 hover:border-yellow-500 transition-all duration-300">
                    <div class="aspect-square bg-gray-900 relative overflow-hidden group">
                        <?php 
                        $fallback_img = '';
                        if (stripos(get_the_title(), 'John') !== false) $fallback_img = 'attorney-1.png';
                        elseif (stripos(get_the_title(), 'Sarah') !== false) $fallback_img = 'attorney-2.png';
                        
                        if ($headshot) : ?>
                            <img src="<?php echo esc_url($headshot['url']); ?>" alt="<?php echo esc_attr($headshot['alt']); ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                        <?php elseif ($fallback_img) : ?>
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/' . $fallback_img; ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                        <?php else : ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-800">
                                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-6 text-center">
                        <h2 class="text-xl font-bold text-white mb-1 uppercase tracking-tight"><?php the_title(); ?></h2>
                        <p class="text-yellow-500 text-sm font-semibold uppercase mb-4 tracking-widest"><?php echo esc_html($position); ?></p>
                        <a href="<?php the_permalink(); ?>" class="inline-block border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 font-bold py-2 px-6 rounded transition-colors text-sm uppercase">
                            View Profile
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>
