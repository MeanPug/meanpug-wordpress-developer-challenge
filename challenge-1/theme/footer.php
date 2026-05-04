<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infra
 */
?>
</div><!-- #content -->
    <footer>
        <!-- Final Pug -->
        <div class="container mx-auto py-8 text-center">
            <?php
            // Get footer image from theme options or use local fallback
            $options_id = airpug_get_options_page_id();
            $footer_img = $options_id ? get_field('footer_image', $options_id) : '';
            if (!$footer_img) {
                $footer_img = get_stylesheet_directory_uri() . '/assets/img/MeanPug-Best-In-Show-Icon.png';
            }
            ?>
            <img src="<?php echo esc_url($footer_img); ?>" alt="Pug MeanPug" class="mx-auto w-32 h-32" />
            <p class="mt-4 text-gray-600">Powered by Gabriel Pacheco and MeanPug</p>
        </div>
    </footer>
</div>
<!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
