<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="airbnb-skip-link" href="#main">
  <?php esc_html_e( 'Skip to content', 'inf' ); ?>
</a>

<header class="airbnb-header" role="banner">

  <!-- Top bar -->
  <div class="airbnb-header__bar">
    <div class="airbnb-header__bar-inner">

      <!-- Logo -->
      <a
        href=""
        class="airbnb-header__logo"
        aria-label=""
      >
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/69/Airbnb_Logo_B%C3%A9lo.svg" alt="Airbnb" class="airbnb-header__logo-svg">
      </a>

      <!-- Center nav tabs -->
      <nav class="airbnb-header__tabs-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'inf' ); ?>">

        <!-- Stays -->
        <button class="airbnb-header__tab airbnb-header__tab--active" type="button">
          <span class="airbnb-header__tab-icon" aria-hidden="true">
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 28V13.5L16 4l13 9.5V28H20v-9h-8v9H3z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <rect x="13" y="19" width="6" height="9" rx="1" stroke="currentColor" stroke-width="2"/>
            </svg>
          </span>
          <span><?php esc_html_e( 'Stays', 'inf' ); ?></span>
        </button>

        <!-- Experiences -->
        <button class="airbnb-header__tab" type="button">
          <span class="airbnb-header__tab-badge"><?php esc_html_e( 'New', 'inf' ); ?></span>
          <span class="airbnb-header__tab-icon" aria-hidden="true">
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <ellipse cx="16" cy="20" rx="10" ry="8" stroke="currentColor" stroke-width="2"/>
              <path d="M16 12V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M10 20c0-5 3-10 6-10s6 5 6 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
              <path d="M6 20h20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
              <path d="M12 4.5c0 0 1.5 2 4 2s4-2 4-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
          </span>
          <span><?php esc_html_e( 'Experiences', 'inf' ); ?></span>
        </button>

        <!-- Services -->
        <button class="airbnb-header__tab" type="button">
          <span class="airbnb-header__tab-badge"><?php esc_html_e( 'New', 'inf' ); ?></span>
          <span class="airbnb-header__tab-icon" aria-hidden="true">
            <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 22h20M8 22V14a8 8 0 1116 0v8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <rect x="4" y="22" width="24" height="4" rx="2" stroke="currentColor" stroke-width="2"/>
              <path d="M14 6.5V4M18 6.5V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
          </span>
          <span><?php esc_html_e( 'Services', 'inf' ); ?></span>
        </button>

      </nav>

      <!-- Right nav -->
      <nav class="airbnb-header__nav" aria-label="<?php esc_attr_e( 'Account navigation', 'inf' ); ?>">
        <a href="#" class="airbnb-header__nav-link airbnb-header__nav-link--host">
          <?php esc_html_e( 'Become a host', 'inf' ); ?>
        </a>
        <a
          href="#"
          class="airbnb-header__nav-link airbnb-header__nav-link--globe"
          aria-label="<?php esc_attr_e( 'Choose language and currency', 'inf' ); ?>"
        >
          <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M8 .25a7.77 7.77 0 017.75 7.78 7.75 7.75 0 01-7.52 7.72h-.25A7.75 7.75 0 01.25 8.24v-.25A7.75 7.75 0 018 .25zm1.95 8.5h-3.9c.15 2.9 1.17 5.34 1.88 5.5H8c.68 0 1.72-2.37 1.93-5.23zm4.26 0h-2.76c-.09 1.96-.53 3.78-1.18 5.08A6.26 6.26 0 0014.17 8.75zm-9.67 0H1.8a6.26 6.26 0 005.94 5.08c-.63-1.29-1.07-3.1-1.18-5.08zM6.1 2.18l-.06.08c-.7 1-1.17 2.57-1.31 4.49h2.47V2.28c-.38.02-.73.1-1.1-.1zm1.9-.12v4.69h2.47C10.32 4.82 9.74 2.84 9 2.2 8.74 2.15 8.37 2.1 8 2.06zm-2.28.3A6.27 6.27 0 001.8 6.75h2.37c.14-1.77.54-3.36 1.14-4.52zm6.73 4.22a6.28 6.28 0 00-4.16-4.2c.62 1.17 1.03 2.78 1.15 4.57h2.97z" fill="currentColor"/>
          </svg>
        </a>
        <button
          class="airbnb-header__user-menu"
          type="button"
          aria-label="<?php esc_attr_e( 'Open user menu', 'inf' ); ?>"
          aria-expanded="false"
        >
          <svg class="airbnb-header__hamburger" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
            <rect y="6" width="32" height="2" rx="1" fill="currentColor"/>
            <rect y="15" width="32" height="2" rx="1" fill="currentColor"/>
            <rect y="24" width="32" height="2" rx="1" fill="currentColor"/>
          </svg>
          <span class="airbnb-header__avatar" aria-hidden="true">
            <svg viewBox="0 0 32 32" focusable="false">
              <path d="M16 .7C7.56.7.7 7.56.7 16S7.56 31.3 16 31.3 31.3 24.44 31.3 16 24.44.7 16 .7zm0 28c-4.02 0-7.6-1.88-9.96-4.81a12.43 12.43 0 0119.92 0A12.38 12.38 0 0116 28.7zM10 12.4a6 6 0 1112 0 6 6 0 01-12 0zm16.52 14.29A14.43 14.43 0 0022 22.1a8 8 0 10-12 0 14.43 14.43 0 00-4.52 4.59 13.3 13.3 0 01-2.78-8.09C2.7 10.01 8.73 2.7 16 2.7s13.3 7.31 13.3 15.9a13.3 13.3 0 01-2.78 8.09z" fill="currentColor"/>
            </svg>
          </span>
        </button>
      </nav>

    </div>
  </div>

  <!-- Search bar -->
  <div class="airbnb-header__search-wrap">
    <div class="airbnb-search-bar" role="search" aria-label="<?php esc_attr_e( 'Search stays', 'inf' ); ?>">
      <div class="airbnb-search-bar__field">
        <label class="airbnb-search-bar__label"><?php esc_html_e( 'Where', 'inf' ); ?></label>
        <input
          class="airbnb-search-bar__input"
          type="text"
          placeholder="<?php esc_attr_e( 'Explore destinations', 'inf' ); ?>"
          aria-label="<?php esc_attr_e( 'Search destination', 'inf' ); ?>"
        >
      </div>
      <span class="airbnb-search-bar__divider" aria-hidden="true"></span>
      <div class="airbnb-search-bar__field">
        <label class="airbnb-search-bar__label"><?php esc_html_e( 'Dates', 'inf' ); ?></label>
        <span class="airbnb-search-bar__placeholder"><?php esc_html_e( 'Add dates', 'inf' ); ?></span>
      </div>
      <span class="airbnb-search-bar__divider" aria-hidden="true"></span>
      <div class="airbnb-search-bar__field airbnb-search-bar__field--last">
        <div>
          <label class="airbnb-search-bar__label"><?php esc_html_e( 'Who', 'inf' ); ?></label>
          <span class="airbnb-search-bar__placeholder airbnb-search-bar__placeholder--muted"><?php esc_html_e( 'Add guests', 'inf' ); ?></span>
        </div>
        <button class="airbnb-search-bar__submit" type="button" aria-label="<?php esc_attr_e( 'Search', 'inf' ); ?>">
          <svg viewBox="0 0 32 32" focusable="false" aria-hidden="true">
            <path d="M31 28l-7.6-7.6A12.9 12.9 0 1021 22.4L28.6 30 31 28zm-18-4a11 11 0 110-22 11 11 0 010 22z" fill="currentColor"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

</header>

<div id="page" class="site">
  <div id="content" class="site-content">