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
<div class="bg-gray-900 text-white py-24 md:py-32 border-b border-gray-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <?php if ($icon_class) : ?>
            <div class="text-6xl text-yellow-500 mb-8">
                <i class="<?php echo esc_attr($icon_class); ?>"></i>
            </div>
        <?php endif; ?>
        <h1 class="text-4xl md:text-7xl font-black mb-8 uppercase tracking-tighter"><?php the_title(); ?></h1>
        <?php if ($short_description) : ?>
            <p class="text-xl md:text-2xl text-gray-400 max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html($short_description); ?>
            </p>
        <?php endif; ?>
    </div>
</div>

<!-- Main Content -->
<div class="bg-gray-900 py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<!-- FAQs -->
<?php if ($faq_1_question || $faq_2_question) : ?>
<div class="bg-gray-900 py-24 border-t border-gray-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-5xl font-black text-center text-white mb-16 uppercase tracking-tighter">Frequently Asked Questions</h2>
        <div class="space-y-8">
            <?php if ($faq_1_question && $faq_1_answer) : ?>
                <div class="bg-gray-800 p-10 rounded-2xl shadow-xl border border-gray-700">
                    <h3 class="text-2xl font-bold text-white mb-6 border-l-4 border-yellow-500 pl-4"><?php echo esc_html($faq_1_question); ?></h3>
                    <div class="text-gray-300 leading-relaxed prose prose-invert max-w-none">
                        <?php echo wpautop(wp_kses_post($faq_1_answer)); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($faq_2_question && $faq_2_answer) : ?>
                <div class="bg-gray-800 p-10 rounded-2xl shadow-xl border border-gray-700">
                    <h3 class="text-2xl font-bold text-white mb-6 border-l-4 border-yellow-500 pl-4"><?php echo esc_html($faq_2_question); ?></h3>
                    <div class="text-gray-300 leading-relaxed prose prose-invert max-w-none">
                        <?php echo wpautop(wp_kses_post($faq_2_answer)); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Call to Action -->
<div class="bg-yellow-500 py-24 text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-4xl md:text-6xl font-black text-gray-900 mb-8 uppercase tracking-tighter">Need Legal Help with <?php the_title(); ?>?</h2>
        <a href="#contact" class="inline-block bg-gray-900 text-white font-black py-5 px-12 rounded shadow-2xl hover:bg-gray-800 transition-all transform hover:scale-105 text-lg uppercase tracking-widest">
            Get a Free Case Evaluation
        </a>
    </div>
</div>

<?php
    endwhile;
endif;

get_footer();
?>
