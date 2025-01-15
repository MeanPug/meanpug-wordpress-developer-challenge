<!-- <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
</article> -->

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php
        $args = array(
            'post_type' => 'listing',
            'posts_per_page' => 12, // Limit to 12 listings for the homepage
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $listings = new WP_Query($args);

        if ($listings->have_posts()) :
            while ($listings->have_posts()) : $listings->the_post();
                // Get ACF fields
                $location = get_field('location');
                $price = get_field('price');
                $rating = get_field('rating');
                $gallery = get_field('gallery');
                $thumbnail = !empty($gallery) ? $gallery[0]['url'] : get_the_post_thumbnail_url();
                ?>
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 listings-boxes">
                    <a href="<?php the_permalink(); ?>">
                        <div class="h-48 bg-gray-200">
                            <img src="/wp-content/uploads/2025/01/MeanPug-Best-In-Show-Icon.png" alt="MeanPug" class="mean-pug-icon">
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h2 class="text-lg font-semibold mb-2"><?php the_title(); ?></h2>
                            <p class="text-sm text-gray-600 mb-1"><strong>Location:</strong> <?php echo esc_html($location); ?></p>
                            <p class="text-sm text-gray-600 mb-1"><strong>Price:</strong> $<?php echo esc_html($price); ?> per night</p>
                            <p class="text-sm text-gray-600"><strong>Rating:</strong> <?php echo esc_html($rating); ?> / 5</p>
                        </div>
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p class="text-center text-gray-500">No listings found.</p>
        <?php endif; ?>
    </div>
</div>