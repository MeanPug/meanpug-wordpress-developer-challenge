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

  <!-- Top bar: logo / search / nav -->
  <div class="airbnb-header__bar">
    <div class="airbnb-header__bar-inner">

      <!-- Logo -->
      <a
        href="<?php echo esc_url( home_url( '/' ) ); ?>"
        class="airbnb-header__logo"
        aria-label="<?php esc_attr_e( 'Go to homepage', 'inf' ); ?>"
      >
        <svg class="airbnb-header__logo-belo" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
          <path d="M16 1C10.2 1 5.5 6.6 5.5 13.5c0 4.2 1.8 7.8 4.3 10.8 1.8 2.2 3.8 4.1 6 5.7.4.3.9.3 1.4 0 2.2-1.6 4.2-3.5 6-5.7 2.5-3 4.3-6.6 4.3-10.8C27.5 6.6 22.8 1 16 1zm0 27.2c-2-1.5-3.9-3.2-5.5-5.2C8.2 20.3 7 17.1 7 13.5 7 7.4 11 2.5 16 2.5s9 4.9 9 11c0 3.6-1.2 6.8-3.5 9.5-1.6 2-3.5 3.7-5.5 5.2zM16 7.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zm0 9.5a4 4 0 110-8 4 4 0 010 8z"/>
        </svg>
        <span class="airbnb-header__logo-wordmark">airbnb</span>
      </a>

      <!-- Search pill -->
      <div class="airbnb-header__search" role="search" aria-label="<?php esc_attr_e( 'Search stays', 'inf' ); ?>">
        <div class="airbnb-search-pill">
          <button class="airbnb-search-pill__segment" type="button" aria-label="<?php esc_attr_e( 'Search by destination', 'inf' ); ?>">
            <span class="airbnb-search-pill__label"><?php esc_html_e( 'Anywhere', 'inf' ); ?></span>
          </button>
          <span class="airbnb-search-pill__divider" aria-hidden="true"></span>
          <button class="airbnb-search-pill__segment" type="button" aria-label="<?php esc_attr_e( 'Search by dates', 'inf' ); ?>">
            <span class="airbnb-search-pill__label"><?php esc_html_e( 'Any week', 'inf' ); ?></span>
          </button>
          <span class="airbnb-search-pill__divider" aria-hidden="true"></span>
          <button class="airbnb-search-pill__segment airbnb-search-pill__segment--guests" type="button" aria-label="<?php esc_attr_e( 'Search by guests', 'inf' ); ?>">
            <span class="airbnb-search-pill__label airbnb-search-pill__label--muted"><?php esc_html_e( 'Add guests', 'inf' ); ?></span>
            <span class="airbnb-search-pill__submit" aria-hidden="true">
              <svg viewBox="0 0 32 32" focusable="false" aria-hidden="true">
                <path d="M31 28l-7.6-7.6A12.9 12.9 0 1021 22.4L28.6 30 31 28zm-18-4a11 11 0 110-22 11 11 0 010 22z" fill="currentColor"/>
              </svg>
            </span>
          </button>
        </div>
      </div>

      <!-- Right nav -->
      <nav class="airbnb-header__nav" aria-label="<?php esc_attr_e( 'Account navigation', 'inf' ); ?>">
        <a href="#" class="airbnb-header__nav-link airbnb-header__nav-link--host">
          <?php esc_html_e( 'Airbnb your home', 'inf' ); ?>
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

  <!-- Category tabs -->
  <div class="airbnb-header__tabs">
    <div class="airbnb-header__tabs-inner">

      <div class="airbnb-category-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Property types', 'inf' ); ?>">
        <?php
        $airbnb_categories = array(
          array( 'slug' => 'icons',       'label' => 'Icons' ),
          array( 'slug' => 'views',       'label' => 'Amazing views' ),
          array( 'slug' => 'beach',       'label' => 'Beach' ),
          array( 'slug' => 'tiny',        'label' => 'Tiny homes' ),
          array( 'slug' => 'cabins',      'label' => 'Cabins' ),
          array( 'slug' => 'lake',        'label' => 'Lakefront' ),
          array( 'slug' => 'design',      'label' => 'Design' ),
          array( 'slug' => 'mansions',    'label' => 'Mansions' ),
          array( 'slug' => 'camping',     'label' => 'Camping' ),
          array( 'slug' => 'castles',     'label' => 'Castles' ),
          array( 'slug' => 'farms',       'label' => 'Farms' ),
          array( 'slug' => 'boats',       'label' => 'Boats' ),
          array( 'slug' => 'luxe',        'label' => 'Luxe' ),
          array( 'slug' => 'treehouses',  'label' => 'Treehouses' ),
          array( 'slug' => 'arctic',      'label' => 'Arctic' ),
          array( 'slug' => 'containers',  'label' => 'Containers' ),
        );

        $airbnb_icons = array(
          'icons'      => '<path d="M16 2l3.09 6.26L26 9.27l-5 4.87 1.18 6.86L16 17.9l-6.18 3.1L11 14.14 6 9.27l6.91-1.01L16 2z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round" fill="none"/>',
          'views'      => '<path d="M2 26l6-8 5 6 5-9 5 5 7-12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
          'beach'      => '<path d="M28 28H4M16 28V12M8 18c0-4.4 3.6-8 8-8s8 3.6 8 8M10 12l12 4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" fill="none"/>',
          'tiny'       => '<path d="M3 28h26M5 28V14l11-10 11 10v14M12 28v-8h8v8" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
          'cabins'     => '<path d="M2 28h28M4 28V16M28 28V16M16 2L2 16h28L16 2zM11 28v-8h10v8" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
          'lake'       => '<path d="M2 22c5-6 10 0 15-6s10 0 13-4M2 28c5-4 10 2 15-4s10 0 13-2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" fill="none"/><circle cx="16" cy="8" r="5" stroke="currentColor" stroke-width="1.75" fill="none"/>',
          'design'     => '<rect x="3" y="4" width="26" height="24" rx="2" stroke="currentColor" stroke-width="1.75" fill="none"/><path d="M3 11h26M10 11v17" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" fill="none"/>',
          'mansions'   => '<path d="M1 28h30M3 28V13h26v15M1 13l15-10 15 10M13 28v-9h6v9" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
          'camping'    => '<path d="M2 28h28M16 3L3 28h26L16 3zM16 3v25" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
          'castles'    => '<path d="M3 28h26M5 28V14h5V9h4V5h-2V2h2v3h4V2h2v3h-2v4h4v5h5v14M10 28v-8h12v8" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
          'farms'      => '<path d="M2 28h28M18 28V16h8v12M6 28V15L14 8l8 7v13M10 28v-6h8v6M24 16V9h4v7" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
          'boats'      => '<path d="M5 22l2-10h18l2 10H5zM16 12V5M11 8l5-3 5 3M2 22c4 8 24 8 28 0" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
          'luxe'       => '<path d="M16 2l3.7 7.5 8.3 1.2-6 5.9 1.4 8.1L16 20.9 8.6 24.7l1.4-8.1L4 10.7l8.3-1.2L16 2z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round" fill="none"/>',
          'treehouses' => '<circle cx="16" cy="11" r="9" stroke="currentColor" stroke-width="1.75" fill="none"/><path d="M16 20v10M12 30h8M10 15h12M16 10v8" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" fill="none"/>',
          'arctic'     => '<path d="M16 2v28M2 16h28M6 6l20 20M26 6L6 26" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" fill="none"/><circle cx="16" cy="16" r="6" stroke="currentColor" stroke-width="1.75" fill="none"/>',
          'containers' => '<rect x="2" y="8" width="28" height="18" rx="2" stroke="currentColor" stroke-width="1.75" fill="none"/><path d="M9 8V6a2 2 0 012-2h10a2 2 0 012 2v2M12 17h8M2 17h28" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" fill="none"/>',
        );

        foreach ( $airbnb_categories as $i => $cat ) :
          $is_active = ( 0 === $i );
          $icon_path = isset( $airbnb_icons[ $cat['slug'] ] ) ? $airbnb_icons[ $cat['slug'] ] : '';
          ?>
          <button
            class="airbnb-category-tabs__tab<?php echo $is_active ? ' airbnb-category-tabs__tab--active' : ''; ?>"
            role="tab"
            aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
            data-category="<?php echo esc_attr( $cat['slug'] ); ?>"
            type="button"
          >
            <span class="airbnb-category-tabs__icon" aria-hidden="true">
              <svg viewBox="0 0 32 32" focusable="false" aria-hidden="true">
                <?php echo $icon_path; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
              </svg>
            </span>
            <span class="airbnb-category-tabs__label"><?php echo esc_html( $cat['label'] ); ?></span>
          </button>
          <?php
        endforeach;
        ?>
      </div>

      <div class="airbnb-header__filters">
        <button class="airbnb-filters-btn" type="button" aria-label="<?php esc_attr_e( 'Show filters', 'inf' ); ?>">
          <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false">
            <path d="M5 8c1.306 0 2.418.835 2.83 2H14v2H7.829A3.001 3.001 0 112 10h.001A3 3 0 015 8zm0 2a1 1 0 100 2 1 1 0 000-2zm6-8a3 3 0 012.829 4H14v2h-.17a3.001 3.001 0 01-5.66 0H2V6h6.17A3.001 3.001 0 0111 2zm0 2a1 1 0 100 2 1 1 0 000-2z" fill="currentColor"/>
          </svg>
          <span><?php esc_html_e( 'Filters', 'inf' ); ?></span>
        </button>
      </div>

    </div>
  </div>

</header>

<div id="page" class="site">
  <div id="content" class="site-content">