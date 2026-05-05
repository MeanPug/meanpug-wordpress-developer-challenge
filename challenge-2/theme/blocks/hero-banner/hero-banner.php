<?php
$headline = get_field('hero_headline') ?: 'Fighting for the People';
$subheadline = get_field('hero_subheadline') ?: 'Our experienced attorneys are ready to fight for your rights.';
$cta_text = get_field('hero_cta_text') ?: 'Free Case Evaluation';
$cta_link = get_field('hero_cta_link') ?: '#';

if (isset($block['data']['is_preview'])) : ?>
    <div style="background:#1f2937; padding:40px; text-align:center; color:white;">
        <h2 style="font-size:32px; margin:0;"><?php echo esc_html($headline); ?></h2>
        <p><?php echo esc_html($subheadline); ?></p>
        <button style="background:#f59e0b; color:white; padding:10px 20px; border:none; margin-top:20px;">
            <?php echo esc_html($cta_text); ?>
        </button>
    </div>
<?php else : ?>
    <section class="relative bg-gray-900 text-white py-24 px-6 md:py-32 flex flex-col items-center justify-center text-center overflow-hidden">
        <!-- Background Overlay / Image placeholder -->
        <div class="absolute inset-0 bg-black opacity-50 z-0"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto flex flex-col items-center">
            <!-- Trust Badge -->
            <div class="mb-6 inline-block bg-yellow-500 text-gray-900 font-bold px-4 py-2 rounded-full uppercase tracking-wider text-sm">
                Over $50 Billion Recovered
            </div>
            
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                <?php echo esc_html($headline); ?>
            </h1>
            
            <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl">
                <?php echo esc_html($subheadline); ?>
            </p>
            
            <a href="<?php echo esc_url($cta_link); ?>" class="inline-block bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-bold py-4 px-8 rounded shadow-lg transition-transform transform hover:scale-105 text-lg">
                <?php echo esc_html($cta_text); ?>
            </a>
        </div>
    </section>
<?php endif; ?>
