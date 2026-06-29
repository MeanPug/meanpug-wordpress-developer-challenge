<?php
/**
 * Front-page header partial — Airbnb-style nav for Challenge 1
 *
 * @package infra
 */

?>
<div class="airbnb-fp__announcement">
    <?php esc_html_e( 'Get the latest on our COVID-19 response and cancellation policies.', 'inf' ); ?>
    <a href="#"><?php esc_html_e( 'Learn more', 'inf' ); ?></a>
</div>

<header id="airbnb-header">
    <div class="airbnb-header__inner">

        <!-- Logo: cute-pug.png replaces the Airbnb logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="airbnb-header__logo">
            <img
                src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/cute-pug.png' ); ?>"
                alt="<?php esc_attr_e( 'MeanPug Home', 'inf' ); ?>"
            />
        </a>

        <!-- Desktop navigation links (right side) -->
        <nav class="airbnb-header__nav" aria-label="<?php esc_attr_e( 'Main navigation', 'inf' ); ?>">
            <a href="#"><?php esc_html_e( 'Host your home', 'inf' ); ?></a>
            <a href="#"><?php esc_html_e( 'Host an experience', 'inf' ); ?></a>
            <a href="#"><?php esc_html_e( 'Help', 'inf' ); ?></a>
            <div class="airbnb-header__profile">
                <svg xmlns="http://www.w3.org/2000/svg" class="airbnb-header__profile-menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                <div class="airbnb-header__profile-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="airbnb-header__profile-avatar-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                </div>
            </div>
        </nav>

        <!-- Mobile burger menu (visual only) -->
        <button
            type="button"
            class="airbnb-header__menu-toggle"
            aria-label="<?php esc_attr_e( 'Open menu', 'inf' ); ?>"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="airbnb-header__menu-toggle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>

    </div>
</header>
