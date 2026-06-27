<article id="post-<?php the_ID(); ?>" <?php post_class( 'airbnb-fp' ); ?>>

    <!-- Category Tab Navigation -->
    <section class="airbnb-fp__tabs" aria-label="<?php esc_attr_e( 'Browse categories', 'inf' ); ?>">
        <div class="airbnb-fp__tabs__inner">
            <?php
            $tabs = [
                [ 'label' => __( 'Places to stay', 'inf' ),     'active' => true  ],
                [ 'label' => __( 'Monthly stays', 'inf' ),      'active' => false ],
                [ 'label' => __( 'Experiences', 'inf' ),        'active' => false ],
                [ 'label' => __( 'Online Experiences', 'inf' ), 'active' => false, 'badge' => __( 'NEW', 'inf' ) ],
            ];
            foreach ( $tabs as $tab ) :
                $class = 'airbnb-fp__tab' . ( $tab['active'] ? ' airbnb-fp__tab--active' : '' );
            ?>
            <button class="<?php echo esc_attr( $class ); ?>" type="button">
                <?php echo esc_html( $tab['label'] ); ?>
                <?php if ( ! empty( $tab['badge'] ) ) : ?>
                    <span class="inline-block bg-[#222222] text-white text-[10px] font-bold uppercase px-1.5 py-0.5 rounded ml-1 align-middle">
                        <?php echo esc_html( $tab['badge'] ); ?>
                    </span>
                <?php endif; ?>
            </button>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Search Bar (visual mock — no form submission) -->
    <section class="airbnb-fp__search" aria-label="<?php esc_attr_e( 'Search', 'inf' ); ?>">
        <div class="airbnb-fp__search__bar">
            <?php
            $fields = [
                [ 'label' => __( 'LOCATION', 'inf' ),             'placeholder' => __( 'Where are you going?', 'inf' ) ],
                [ 'label' => __( 'CHECK IN / CHECK OUT', 'inf' ), 'placeholder' => __( 'Add dates', 'inf' ) ],
                [ 'label' => __( 'GUESTS', 'inf' ),               'placeholder' => __( 'Add guests', 'inf' ) ],
            ];
            foreach ( $fields as $field ) :
            ?>
            <div class="airbnb-fp__search__field">
                <label><?php echo esc_html( $field['label'] ); ?></label>
                <input type="text" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" readonly aria-label="<?php echo esc_attr( $field['label'] ); ?>" />
            </div>
            <?php endforeach; ?>
            <button class="airbnb-fp__search__btn" type="button" aria-label="<?php esc_attr_e( 'Search', 'inf' ); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/></svg>
                <?php esc_html_e( 'Search', 'inf' ); ?>
            </button>
        </div>
    </section>

    <!-- Hero Banner -->
    <section class="airbnb-fp__hero" aria-label="<?php esc_attr_e( 'Featured message', 'inf' ); ?>">
        <h2 class="airbnb-fp__hero__headline">
            <?php esc_html_e( 'We stand with #BlackLivesMatter', 'inf' ); ?>
        </h2>
        <p class="airbnb-fp__hero__body">
            <?php esc_html_e( 'Now more than ever, it\'s important that you know how we\'re fighting discrimination on Airbnb. We\'d like to share our newest initiative with you, Project Lighthouse.', 'inf' ); ?>
        </p>
        <a href="#" class="airbnb-fp__hero__cta">
            <?php esc_html_e( 'Learn more', 'inf' ); ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    </section>

    <!-- Category Card Grid -->
    <section class="airbnb-fp__cards" aria-label="<?php esc_attr_e( 'Browse destinations', 'inf' ); ?>">
        <div class="airbnb-fp__cards__grid">
            <?php
            $cards = [
                [
                    'src'   => 'https://picsum.photos/seed/airbnb1/600/400',
                    'alt'   => __( 'Outdoor experience', 'inf' ),
                    'label' => __( 'Unique stays', 'inf' ),
                    'badge' => __( 'NEW', 'inf' ),
                ],
                [
                    'src'   => 'https://picsum.photos/seed/airbnb2/600/400',
                    'alt'   => __( 'Online experience', 'inf' ),
                    'label' => __( 'Online Experiences', 'inf' ),
                    'badge' => '',
                ],
                [
                    'src'   => 'https://picsum.photos/seed/airbnb3/600/400',
                    'alt'   => __( 'Cabin in the woods', 'inf' ),
                    'label' => __( 'Cabins', 'inf' ),
                    'badge' => '',
                ],
            ];
            foreach ( $cards as $card ) :
            ?>
            <article class="airbnb-fp__card">
                <img
                    src="<?php echo esc_url( $card['src'] ); ?>"
                    alt="<?php echo esc_attr( $card['alt'] ); ?>"
                    loading="lazy"
                />
                <?php if ( ! empty( $card['badge'] ) ) : ?>
                    <span class="airbnb-fp__card__badge"><?php echo esc_html( $card['badge'] ); ?></span>
                <?php endif; ?>
                <span class="airbnb-fp__card__label"><?php echo esc_html( $card['label'] ); ?></span>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

</article>
