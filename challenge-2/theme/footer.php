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
<footer class="site-footer bg-gray-900 text-gray-500 py-12 px-6 border-t border-gray-800">
    <div class="site-footer__inner max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
        <div class="mb-6 md:mb-0 text-center md:text-left">
            <a href="<?php echo home_url(); ?>" class="site-footer__brand text-white text-xl font-black uppercase tracking-tighter hover:text-yellow-500 transition-colors">
                MeanPug <span class="text-yellow-500">Law</span>
            </a>
            <p class="site-footer__copyright mt-2 text-[10px] tracking-widest uppercase font-bold text-gray-600">&copy; <?php echo date('Y'); ?> MeanPug. All Rights Reserved.</p>
        </div>
        <div class="site-footer__links flex flex-wrap justify-center gap-x-8 gap-y-4 text-[10px] font-bold uppercase tracking-[0.2em]">
            <a href="<?php echo esc_url( get_post_type_archive_link('attorney') ?: home_url('/attorney/') ); ?>" class="hover:text-white transition-colors">Attorneys</a>
            <a href="<?php echo esc_url( get_post_type_archive_link('practice-area') ?: home_url('/practice-area/') ); ?>" class="hover:text-white transition-colors">Practice Areas</a>
            <a href="<?php echo esc_url( get_post_type_archive_link('case-result') ?: home_url('/case-result/') ); ?>" class="hover:text-white transition-colors">Results</a>
        </div>
    </div>
</footer>
</div>
<!-- #page -->

<script>
    (function() {
        var toggle = document.getElementById('mobile-menu-toggle');
        var menu = document.getElementById('mobile-menu');

        if (!toggle || !menu) {
            return;
        }

        toggle.addEventListener('click', function() {
            var isOpen = menu.classList.toggle('hidden') === false;
            menu.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    })();
</script>

<?php wp_footer(); ?>

</body>
</html>
