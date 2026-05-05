<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $education = get_field('education');
        $bar_admissions = get_field('bar_admissions');
        $awards = get_field('awards');
        $social_links = get_field('social_links');
        $direct_phone = get_field('direct_phone');
?>

<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col md:flex-row">
            
            <!-- Left Sidebar -->
            <div class="md:w-1/3 bg-gray-900 text-white p-8 flex flex-col items-center md:items-start text-center md:text-left">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="w-48 h-48 rounded-full overflow-hidden mb-6 border-4 border-yellow-500 shadow-lg mx-auto md:mx-0">
                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover object-top']); ?>
                    </div>
                <?php endif; ?>
                
                <h1 class="text-3xl font-extrabold text-white mb-2"><?php the_title(); ?></h1>
                <div class="w-12 h-1 bg-yellow-500 mb-6 mx-auto md:mx-0"></div>

                <?php if ($direct_phone) : ?>
                    <div class="mb-6 w-full">
                        <h3 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-1">Direct Line</h3>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $direct_phone)); ?>" class="text-xl text-yellow-400 hover:text-yellow-300 transition-colors">
                            <?php echo esc_html($direct_phone); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ($social_links) : ?>
                    <div class="mb-6 w-full">
                        <h3 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-2">Social Profiles</h3>
                        <ul class="space-y-2">
                            <?php 
                            $links = explode("\n", $social_links);
                            foreach ($links as $link) : 
                                $link = trim($link);
                                if ($link) :
                            ?>
                                <li>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-300 hover:text-white transition-colors underline truncate block">
                                        <?php echo esc_html($link); ?>
                                    </a>
                                </li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Main Content -->
            <div class="md:w-2/3 p-8 md:p-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-2 border-b-2 border-gray-100">Biography</h2>
                <div class="prose max-w-none text-gray-700 mb-12 leading-relaxed">
                    <?php the_content(); ?>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php if ($education) : ?>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4 border-l-4 border-yellow-500 pl-3">Education</h3>
                            <div class="text-gray-700 prose prose-sm">
                                <?php echo wp_kses_post($education); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($bar_admissions) : ?>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4 border-l-4 border-yellow-500 pl-3">Bar Admissions</h3>
                            <div class="text-gray-700">
                                <?php echo wpautop(wp_kses_post($bar_admissions)); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($awards) : ?>
                        <div class="md:col-span-2 mt-4">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 border-l-4 border-yellow-500 pl-3">Awards & Recognitions</h3>
                            <div class="text-gray-700">
                                <?php echo wpautop(wp_kses_post($awards)); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
    endwhile;
endif;

get_footer();
?>
