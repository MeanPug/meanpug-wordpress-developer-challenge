<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $icon_class = get_field('icon_class');
        $short_description = get_field('short_description');
        $faq_1_question = get_field('faq_1_question');
        $faq_1_answer = get_field('faq_1_answer');
        $faq_2_question = get_field('faq_2_question');
        $faq_2_answer = get_field('faq_2_answer');
?>

<!-- Hero Section -->
<div class="bg-gray-900 text-white py-16 md:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <?php if ($icon_class) : ?>
            <div class="text-5xl text-yellow-500 mb-6">
                <i class="<?php echo esc_attr($icon_class); ?>"></i>
            </div>
        <?php endif; ?>
        <h1 class="text-4xl md:text-5xl font-extrabold mb-6"><?php the_title(); ?></h1>
        <?php if ($short_description) : ?>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html($short_description); ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none text-gray-800">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<!-- FAQs -->
<?php if ($faq_1_question || $faq_2_question) : ?>
<div class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Frequently Asked Questions</h2>
        <div class="space-y-8">
            <?php if ($faq_1_question && $faq_1_answer) : ?>
                <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-4"><?php echo esc_html($faq_1_question); ?></h3>
                    <div class="text-gray-700 leading-relaxed">
                        <?php echo wpautop(wp_kses_post($faq_1_answer)); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($faq_2_question && $faq_2_answer) : ?>
                <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-4"><?php echo esc_html($faq_2_question); ?></h3>
                    <div class="text-gray-700 leading-relaxed">
                        <?php echo wpautop(wp_kses_post($faq_2_answer)); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Call to Action -->
<div class="bg-yellow-500 py-16 text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Need Legal Help with <?php the_title(); ?>?</h2>
        <a href="#contact" class="inline-block bg-gray-900 text-white font-bold py-4 px-8 rounded shadow-lg hover:bg-gray-800 transition-colors text-lg">
            Get a Free Case Evaluation
        </a>
    </div>
</div>

<?php
    endwhile;
endif;

get_footer();
?>
