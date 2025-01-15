<?php
/**
 * Template for displaying single listings
 */

// Ensure ACF is active
if (!function_exists('get_field')) {
    echo '<p class="text-center text-red-600">ACF plugin is not active. Please activate it to display custom fields.</p>';
    return;
}

// Fetch custom fields
$location = get_field('location'); // ACF field name
$price = get_field('price');       // ACF field name
$rating = get_field('rating');     // ACF field name

get_header();
?>

<div class="container mx-auto my-12 p-6 bg-gray-50 shadow-md rounded-lg">
    <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center"><?php the_title(); ?></h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div>
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="w-full h-auto rounded-lg shadow-lg mb-6">
            <?php endif; ?>

            <div class="text-gray-700 space-y-4 leading-relaxed">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Details</h2>
            <ul class="text-lg text-gray-700 space-y-3">
                <li><strong>Location:</strong> <?php echo esc_html($location); ?></li>
                <li><strong>Price:</strong> $<?php echo number_format($price, 2); ?> per night</li>
                <li><strong>Rating:</strong> <?php echo esc_html($rating); ?> / 5</li>
            </ul>
        </div>
    </div>
</div>

<?php get_footer(); ?>
