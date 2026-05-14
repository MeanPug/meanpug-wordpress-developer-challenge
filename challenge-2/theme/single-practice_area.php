<?php get_header(); ?>

<main class="bg-gray-400 min-h-screen mx-auto py-12 px-4">
    <?php if (have_posts()) : while (have_posts()) : the_post(); 
        $subtitle = get_field('subtitle');
        $icon = get_field('area_icon');
        $featured_attorneys = get_field('related_attorneys');
    ?>
        <article class="container max-w-4xl mx-auto">
            
            <header class="mb-8 border-b border-gray-100 pb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <?php if ($icon) : ?>
                        <img src="<?php echo esc_url($icon['url']); ?>" alt="" class="w-12 h-12 object-contain">
                    <?php endif; ?>
                    
                    <h1 class="text-4xl font-extrabold text-blue-900 leading-tight">
                        <?php the_title(); ?>
                    </h1>
                </div>

                <?php if ($subtitle) : ?>
                    <p class="text-xl text-gray-600 italic">
                        <?php echo esc_html($subtitle); ?>
                    </p>
                <?php endif; ?>
            </header>

            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed mb-12">
                <?php the_content(); ?>
            </div>

            <?php if( $featured_attorneys ): ?>
                <section class="mt-12 mb-12 border-t pt-8">
                    <h2 class="text-2xl font-bold text-blue-900 mb-6 uppercase tracking-wide">Specialists in this Area</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <?php foreach( $featured_attorneys as $attorney ): 
                            $job_title = get_field('job_title', $attorney->ID);
                        ?>
                            <div class="flex items-center p-4 bg-gray-50 border border-gray-100 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                <?php if ( has_post_thumbnail($attorney->ID) ) : ?>
                                    <div class="w-20 h-20 mr-4 flex-shrink-0">
                                        <?php echo get_the_post_thumbnail($attorney->ID, 'thumbnail', ['class' => 'rounded-full object-cover w-full h-full border-2 border-white shadow-sm']); ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg"><?php echo get_the_title($attorney->ID); ?></h4>
                                    <?php if($job_title): ?>
                                        <p class="text-sm text-blue-800 font-medium"><?php echo esc_html($job_title); ?></p>
                                    <?php endif; ?>
                                    <a href="<?php echo get_permalink($attorney->ID); ?>" class="text-xs text-gray-500 hover:text-blue-900 mt-1 inline-block uppercase font-bold tracking-tighter">View Profile →</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <footer class="mt-12 p-8 bg-blue-900 rounded-lg text-white flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">Need legal help with <?php the_title(); ?>?</h3>
                    <p class="text-blue-100">Contact our attorneys today for a free consultation.</p>
                </div>
                <a href="/contact" class="mt-6 md:mt-0 bg-yellow-400 text-blue-900 font-bold py-3 px-8 rounded-full hover:bg-yellow-300 transition-colors uppercase tracking-widest text-sm">
                    Free Case Evaluation
                </a>
            </footer>

        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>