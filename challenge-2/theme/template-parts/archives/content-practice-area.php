<?php
?>
<main class="inf-archive inf-practice-areas py-16 px-6 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-12 text-center">Practice Areas</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while (have_posts()) : the_post(); ?>
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="p-8 flex-grow">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4"><?php the_title(); ?></h2>
                        <div class="text-gray-600 mb-6 line-clamp-3">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                    <div class="p-8 bg-gray-50 border-t border-gray-100">
                        <a href="<?php the_permalink(); ?>" class="text-yellow-600 font-bold hover:text-yellow-700 inline-flex items-center">
                            Learn More
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</main>
