<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package infra
 */

get_header();
?>

<?php
$options_id = airpug_get_options_page_id();

// Build tabs array from individual fields
$tabs_list = array();
for ($i = 1; $i <= 5; $i++) {
    $label = $options_id ? get_field("tab_{$i}_label", $options_id) : '';
    if (!empty($label)) {
        $tabs_list[] = array(
            'label' => $label,
            'new_badge' => $options_id ? get_field("tab_{$i}_new_badge", $options_id) : false,
        );
    }
}

$loc_label  = $options_id ? get_field('location_label', $options_id) : 'Location';
$loc_ph     = $options_id ? get_field('location_placeholder', $options_id) : 'Where are you going?';
$dates_label = $options_id ? get_field('dates_label', $options_id) : 'Check in / Check out';
$dates_ph   = $options_id ? get_field('dates_placeholder', $options_id) : 'Add dates';
$guests_label = $options_id ? get_field('guests_label', $options_id) : 'Guests';
$guests_ph  = $options_id ? get_field('guests_placeholder', $options_id) : 'Add pugs';
$btn_text   = $options_id ? get_field('search_button_text', $options_id) : 'Search';
?>

<!-- Tabs + Search -->
<section class="bg-white border-b border-airbnb-border px-6 lg:px-10 pt-2 pb-7" aria-label="Search stays">
    <div class="max-w-screen-3xl mx-auto">
        <div class="relative">
            <ul role="tablist"
                class="flex gap-7 overflow-x-auto whitespace-nowrap text-sm font-medium text-airbnb-text pt-4 pb-2 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                
                <?php if (!empty($tabs_list)) : 
                    $first = true; 
                    foreach ($tabs_list as $tab) : 
                        $label = esc_html($tab['label']);
                        $active_class = $first ? 'border-airbnb-text' : 'border-transparent';
                        $aria = $first ? 'true' : 'false';
                ?>
                    <li role="tab" aria-selected="<?php echo $aria; ?>"
                        class="cursor-pointer flex items-center gap-2 pb-1 border-b-2 <?php echo $active_class; ?>">
                        <?php echo $label; ?>
                        <?php if ($tab['new_badge']) : ?>
                            <span class="bg-airbnb-text text-white text-[10px] font-medium tracking-wider px-1.5 py-1 rounded leading-none">NEW</span>
                        <?php endif; ?>
                    </li>
                <?php $first = false; endforeach; endif; ?>
            </ul>
            <div class="md:hidden pointer-events-none absolute top-0 right-0 h-full w-12 bg-gradient-to-l from-white via-white/80 to-transparent" aria-hidden="true"></div>
        </div>

        <!-- Search form -->
        <form action="#" method="get" role="search"
              class="mt-2 flex flex-col md:flex-row md:items-stretch bg-white border border-airbnb-border rounded-lg shadow-md hover:shadow-sm transition-shadow p-2 md:pl-0">
            <?php wp_nonce_field('airpug_search_nonce', 'search_nonce'); ?>

            <label class="flex-1 flex flex-col justify-center px-5 py-1 rounded-md hover:bg-airbnb-soft transition-colors cursor-pointer">
                <span class="text-xs font-bold uppercase tracking-wide text-airbnb-text"><?php echo esc_html($loc_label); ?></span>
                <input type="text" name="location" placeholder="<?php echo esc_attr($loc_ph); ?>"
                       class="bg-transparent border-0 p-0 mt-0.5 text-sm text-airbnb-muted placeholder:text-airbnb-muted focus:outline-none focus:ring-0 w-full">
            </label>

            <span class="hidden md:block w-px bg-airbnb-border my-0" aria-hidden="true"></span>

            <label class="flex-1 flex flex-col justify-center px-5 py-1 rounded-md hover:bg-airbnb-soft transition-colors cursor-pointer">
                <span class="text-xs font-bold uppercase tracking-wide text-airbnb-text"><?php echo esc_html($dates_label); ?></span>
                <input type="text" name="dates" placeholder="<?php echo esc_attr($dates_ph); ?>"
                       class="bg-transparent border-0 p-0 mt-0.5 text-sm text-airbnb-muted placeholder:text-airbnb-muted focus:outline-none focus:ring-0 w-full">
            </label>

            <span class="hidden md:block w-px bg-airbnb-border my-0" aria-hidden="true"></span>

            <label class="flex-1 flex flex-col justify-center px-5 py-1 rounded-md hover:bg-airbnb-soft transition-colors cursor-pointer">
                <span class="text-xs font-bold uppercase tracking-wide text-airbnb-text"><?php echo esc_html($guests_label); ?></span>
                <input type="text" name="guests" placeholder="<?php echo esc_attr($guests_ph); ?>"
                       class="bg-transparent border-0 p-0 mt-0.5 text-sm text-airbnb-muted placeholder:text-airbnb-muted focus:outline-none focus:ring-0 w-full">
            </label>

            <button type="submit" class="mt-2 md:mt-0 md:ml-1.5 flex items-center justify-center gap-2 bg-airbnb-pink hover:bg-airbnb-pink-dark text-white font-bold text-base rounded-md px-4 py-2 md:py-0 transition-colors">
                <svg viewBox="0 0 24 24" class="w-4 h-4" aria-hidden="true">
                    <path fill="currentColor" d="M22.7 19.3l-5.4-5.4c1-1.5 1.5-3.2 1.5-5.1C18.7 4 14.7 0 9.8 0S.9 4 .9 8.9c0 4.9 4 8.9 8.9 8.9 1.9 0 3.6-.6 5.1-1.5l5.4 5.4c.4.4 1.1.4 1.5 0l.9-.9c.4-.4.4-1.1 0-1.5zM2.7 8.9c0-3.9 3.2-7.1 7.1-7.1s7.1 3.2 7.1 7.1S13.7 16 9.8 16 2.7 12.8 2.7 8.9z"/>
                </svg>
                <span><?php echo esc_html($btn_text); ?></span>
            </button>
        </form>
    </div>
</section>

<?php
// Get Hero fields (they belong to the current page)
$hero_title    = get_field('hero_title');
$hero_desc     = get_field('hero_description');
$hero_btn_text = get_field('hero_button_text');
$hero_btn_url  = get_field('hero_button_url');
$hero_bg_image = get_field('hero_background_image');

// Fallbacks
if (!$hero_title) $hero_title = "We stand with<br>#PugMatter";
if (!$hero_desc) $hero_desc = "Now more than ever, it's important that you know how we're fighting discrimination on Airpug. We'd like to share our newest initiative with you, Project Gabriel Pug Lover.";
if (!$hero_btn_text) $hero_btn_text = "Learn more";
if (!$hero_btn_url) $hero_btn_url = "#";
if (!$hero_bg_image) $hero_bg_image = 'theme\assets\img\pub-matter.jpg';

// Gradient overlay
$gradient = 'linear-gradient(90deg, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.95) 5%, rgba(0, 0, 0, 0.65) 70%, rgba(0, 0, 0, 0.35) 100%)';
?>

<section class="mx-auto mt-6 mb-10 px-4 sm:px-6 lg:px-10" aria-labelledby="hero-title">
    <article class="max-w-screen-3xl mx-auto relative rounded-xl overflow-hidden text-white min-h-96 flex flex-col justify-center px-6 sm:px-12 lg:px-16 py-16 lg:py-20 bg-cover bg-center"
             style="background-image: <?php echo $gradient; ?>, url('<?php echo esc_url($hero_bg_image); ?>');">
        <div class="relative max-w-sm">
            <?php if (!empty($hero_title)) : ?>
                <h1 id="hero-title" class="text-3xl md:text-4xl font-extrabold leading-[1.12] tracking-tight mb-4">
                    <?php echo wp_kses_post($hero_title); ?>
                </h1>
            <?php endif; ?>
            <?php if (!empty($hero_desc)) : ?>
                <p class="text-base leading-relaxed mb-6 opacity-95">
                    <?php echo esc_html($hero_desc); ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($hero_btn_text)) : ?>
                <a href="<?php echo esc_url($hero_btn_url); ?>" class="flex items-center gap-2 text-base font-bold hover:underline">
                    <?php echo esc_html($hero_btn_text); ?>
                    <svg viewBox="0 0 16 16" class="w-3.5 h-3.5" aria-hidden="true">
                        <path fill="currentColor" d="M5.5 1.5l1-1L13 7l-6.5 6.5-1-1L11 7.5H1v-1h10z"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </article>
</section>




<?php
// Featured Destinations
$featured_title = get_field('featured_title') ?: 'Destinos populares';

// Build array of destinations (only those with name)
$dests = array();
for ($i = 1; $i <= 3; $i++) {
    $name = get_field("dest_{$i}_name");
    $image = get_field("dest_{$i}_image");
    if ( ! empty($name) ) {
        $dests[] = array(
            'name'  => $name,
            'image' => $image ?: 'https://via.placeholder.com/400x300',
        );
    }
}
?>

<?php if ( ! empty($dests) ) : ?>
<section class="container mx-auto py-12 px-4 sm:px-6 lg:px-10">
    <h2 class="text-3xl font-semibold mb-8"><?php echo esc_html( $featured_title ); ?></h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <?php foreach ($dests as $dest) : ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                <img class="w-full h-48 object-cover" src="<?php echo esc_url( $dest['image'] ); ?>" alt="<?php echo esc_attr( $dest['name'] ); ?>" />
                <div class="p-4">
                    <h3 class="text-xl font-bold"><?php echo esc_html( $dest['name'] ); ?></h3>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

 
<?php
get_footer();
