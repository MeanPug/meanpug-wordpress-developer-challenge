<?php
/**
 * Footer template
 *
 * @package infra
 */
?>
  </div><!-- #content -->

  <footer class="airbnb-footer" role="contentinfo">
    <div class="airbnb-footer__inner">
      <div class="airbnb-footer__left">
        <span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Airbnb, Inc.</span>
        <span class="airbnb-footer__dot" aria-hidden="true">&middot;</span>
        <a href="#" class="airbnb-footer__link"><?php esc_html_e( 'Privacy', 'inf' ); ?></a>
        <span class="airbnb-footer__dot" aria-hidden="true">&middot;</span>
        <a href="#" class="airbnb-footer__link"><?php esc_html_e( 'Terms', 'inf' ); ?></a>
        <span class="airbnb-footer__dot" aria-hidden="true">&middot;</span>
        <a href="#" class="airbnb-footer__link"><?php esc_html_e( 'Sitemap', 'inf' ); ?></a>
      </div>
      <div class="airbnb-footer__right">
        <a href="#" class="airbnb-footer__link airbnb-footer__link--icon">
          <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M8 .25a7.77 7.77 0 017.75 7.78 7.75 7.75 0 01-7.52 7.72h-.25A7.75 7.75 0 01.25 8.24v-.25A7.75 7.75 0 018 .25zm1.95 8.5h-3.9c.15 2.9 1.17 5.34 1.88 5.5H8c.68 0 1.72-2.37 1.93-5.23zm4.26 0h-2.76c-.09 1.96-.53 3.78-1.18 5.08A6.26 6.26 0 0014.17 8.75zm-9.67 0H1.8a6.26 6.26 0 005.94 5.08c-.63-1.29-1.07-3.1-1.18-5.08zM6.1 2.18l-.06.08c-.7 1-1.17 2.57-1.31 4.49h2.47V2.28c-.38.02-.73.1-1.1-.1zm1.9-.12v4.69h2.47C10.32 4.82 9.74 2.84 9 2.2 8.74 2.15 8.37 2.1 8 2.06zm-2.28.3A6.27 6.27 0 001.8 6.75h2.37c.14-1.77.54-3.36 1.14-4.52zm6.73 4.22a6.28 6.28 0 00-4.16-4.2c.62 1.17 1.03 2.78 1.15 4.57h2.97z" fill="currentColor"/>
          </svg>
          <?php esc_html_e( 'English (US)', 'inf' ); ?>
        </a>
        <a href="#" class="airbnb-footer__link airbnb-footer__link--icon">
          <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M10.9 2.1l.7 1.4 1.4.7-1.4.7-.7 1.4-.7-1.4-1.4-.7 1.4-.7.7-1.4zm-6 1l1.1 2.2 2.2 1.1-2.2 1.1-1.1 2.2-1.1-2.2-2.2-1.1 2.2-1.1 1.1-2.2zm6 6l.7 1.4 1.4.7-1.4.7-.7 1.4-.7-1.4-1.4-.7 1.4-.7.7-1.4z" fill="currentColor"/>
          </svg>
          <?php esc_html_e( '$ USD', 'inf' ); ?>
        </a>
        <a href="#" class="airbnb-footer__link"><?php esc_html_e( 'Support & resources', 'inf' ); ?></a>
      </div>
    </div>
  </footer>

</div><!-- #page -->

<!-- MeanPug badge -->
<aside
  class="airbnb-meanpug-badge"
  aria-label="<?php esc_attr_e( 'Built by MeanPug', 'inf' ); ?>"
>
  <a
    href="https://meanpug.com"
    class="airbnb-meanpug-badge__link"
    target="_blank"
    rel="noopener noreferrer"
  >
    <img
      src="https://media.prod.meanpug.net/wp-content/uploads/sites/9/2020/01/24060038/MeanPug-Best-In-Show-Icon.png"
      alt="MeanPug Best In Show"
      class="airbnb-meanpug-badge__image"
      width="48"
      height="48"
      loading="lazy"
    >
    <span class="airbnb-meanpug-badge__label">
      <?php esc_html_e( 'Built by MeanPug', 'inf' ); ?>
    </span>
  </a>
</aside>

<?php wp_footer(); ?>
</body>
</html>