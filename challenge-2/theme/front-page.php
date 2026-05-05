<?php
/**
 * The template for displaying the front page
 *
 * @package infra
 */

get_header();
?>
	<div id="primary" class="content-area bg-white w-full">
        <main id="main" class="site-main">
            <?php
            // Harkness Design Order
            
            // 1. Hero Banner (Includes Title & Subheading)
            include get_template_directory() . '/blocks/hero-banner/hero-banner.php';

            // 2. Case Results (Verdicts)
            include get_template_directory() . '/blocks/verdicts/verdicts.php';

            // 3. Areas of Expertise (Practice Areas)
            include get_template_directory() . '/template-parts/sections/featured-practice-areas.php';

            // 4. The Faces of Justice (Attorneys)
            include get_template_directory() . '/blocks/featured-attorneys/featured-attorneys.php';

            // 5. Contact Section
            include get_template_directory() . '/template-parts/sections/contact-section.php';
            ?>
        </main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
