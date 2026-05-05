<?php
/**
 * Block Name: Hero Banner
 * Description: Centered MeanPug style hero banner
 */

$subheading = get_field('subheading') ?: 'Justice for the Underdog.';
$title = get_field('title') ?: 'MeanPug';
?>

<section class="relative bg-[#0b1120] text-white min-h-[85vh] flex items-center justify-center overflow-hidden">
    <!-- Background image -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/harkness_hero_pug.png" class="w-full h-full object-cover opacity-70" alt="MeanPug hero banner">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#0b1120]"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 text-center px-6 pt-20">
        <div class="flex flex-col items-center">
            <div class="mb-6">
                <svg class="w-16 h-16 text-[#d4af37] mb-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.36a11.076 11.076 0 01.25 3.762 1 1 0 01-.89.89 8.976 8.976 0 00-1.742.347 1 1 0 00-.317.138L11.71 14.71a1 1 0 01-1.42 0l-1-1z"></path></svg>
            </div>
            <h2 class="text-xl md:text-2xl font-bold text-[#d4af37] tracking-[0.4em] uppercase mb-4"><?php echo esc_html($title); ?></h2>
            <div class="w-12 h-[1px] bg-white/30 mb-8"></div>
            <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tight italic leading-none max-w-4xl">
                Justice for <br/>
                <span class="text-white not-italic">The Underdog.</span>
            </h1>
        </div>
    </div>
</section>
