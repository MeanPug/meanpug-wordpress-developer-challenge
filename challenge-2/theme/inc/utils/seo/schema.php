<?php
/**
 * Global:
 *  - Generate "LocalBusiness" schema
 *
 * Testimonials Archive:
 *  - Generate "Review" schema
 *
 * Practice Area:
 *  - Generate "Review" schema for attached testimonials
 *  - Generate "Product" schema for post
 *  - Editors should set their own FAQ markup based on page headers
 *
 * Office:
 *  - Generate "LocalBusiness" schema
 *
 * Attorney:
 *  - Nothing for now
 *
 * FAQ Category:
 *  - FAQ
 *
 * Result:
 *  - Nothing for now
 *
 * Area Served:
 *  - Nothing for now, but we should markup with FAQs
 */

function mp_generate_office_schema( $office ) {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $location = get_field( 'address', $office );
    $geopoint = get_field( 'geopoint', $office );

    $schema = array(
        '@context' => "http://schema.org",
        '@type' => "LocalBusiness",
        'additionalType' => "LegalService",
        'name' => get_bloginfo( 'name' ),
        'description' => get_bloginfo( 'description' ),
        'url'   => get_site_url(),
        'image' => wp_get_attachment_image_url( $custom_logo_id, 'full' ),
        'telephone' => get_field('contact_phone', 'option')['title'],
        'email' => get_field('contact_email', 'option')['title'],
        'address' => array(
            'type'  => 'PostalAddress',
            'addressLocality'  => $location['city'],
            'addressRegion' => $location['state'],
            'postalCode'    => $location['postal_code'],
            'streetAddress' => $location['street'] . ($location['street2'] ? ', ' . $location['street2'] : '')
        ),
        'geo'   => array(
            'type'  => 'GeoCoordinates',
            'latitude'  => $geopoint['lat'],
            'longitude' => $geopoint['lng']
        ),
        'priceRange' => 'Free consultation',
        'openingHours' => 'Mo-Su,all day'
    );

    $sameas = [];
    $social_profiles = get_field('social_profiles', 'option');
    foreach ( $social_profiles as $profile ) {
        $sameas[] = $profile['url'];
    }
    $schema['sameAs'] = $sameas;

    echo '<!-- SCHEMA: Office -->';
    echo '<script type="application/ld+json">';
    echo json_encode( $schema );
    echo '</script>';
}

/**
 * schema that should appear on every page
 * @param office - if set, we use fields from the given office for business address/contact info instead of the defaults
 */
function mp_generate_local_business_schema( $office = null ) {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $location = get_field('contact_main_address', 'option');

    if ($location) {
      $schema = array(
          '@context' => "http://schema.org",
          '@type' => "LocalBusiness",
          'additionalType' => "LegalService",
          'name' => get_bloginfo( 'name' ),
          'description' => get_bloginfo( 'description' ),
          'url'   => get_site_url(),
          'image' => wp_get_attachment_image_url( $custom_logo_id, 'full' ),
          'telephone' => get_field('contact_phone', 'option')['title'],
          'email' => get_field('contact_email', 'option')['title'],
          'address' => array(
              'type'  => 'PostalAddress',
              'addressLocality'  => $location['city'],
              'addressRegion' => $location['state'],
              'postalCode'    => $location['post_code'],
              'streetAddress' => $location['street_number'] . ' ' . $location['street_name']
          ),
          'geo'   => array(
              'type'  => 'GeoCoordinates',
              'latitude'  => $location['lat'],
              'longitude' => $location['lng']
          ),
          'priceRange' => 'Free consultation',
          'openingHours' => 'Mo-Su,all day'
      );

      $sameas = [];
      $social_profiles = get_field('social_profiles', 'option');
      foreach ( $social_profiles as $profile ) {
          $sameas[] = $profile['url'];
      }
      $schema['sameAs'] = $sameas;

      echo '<!-- SCHEMA: Local Business -->';
      echo '<script type="application/ld+json">';
      echo json_encode( $schema );
      echo '</script>';
    }
}

function mp_generate_testimonial_schema( $testimonial, $print_out = false ) {
    $reviewer = get_field( 'reviewer', $testimonial);
    $schema = array(
        '@type' => 'Review',
        'author' => array(
            'type'  => 'Person',
            'name'  => $reviewer['name']
        ),
        'datePublished' => get_the_date( 'Y-m-d', $testimonial ),
        'reviewBody' => get_the_content( null, null, $testimonial ),
        'name' =>  get_the_title( $testimonial ),
        'reviewRating' => array(
            '@type' => 'Rating',
            'bestRating' => '5',
            'ratingValue' => '5',
            'worstRating'   => '0'
        ),
    );

    if ( $print_out ) {
        echo '<!-- SCHEMA: Testimonial -->';
        echo '<script type="application/ld+json">';
        echo json_encode( $schema );
        echo '</script>';
    }

    return $schema;
}

/**
 * @param $testimonials array
 * @param $agg_values array
 */
function mp_generate_testimonials_schema($testimonials, $name_override = null, $description_override = null, $agg_values = null) {
    $custom_logo_id = get_theme_mod( 'custom_logo' );

    $schema = array(
        '@context' => "http://schema.org",
        '@type' => "Product",
        'description' => $description_override ?: get_bloginfo( 'description' ),
        'name' => $name_override ?: get_bloginfo( 'name' ),
        'image' => wp_get_attachment_image_url( $custom_logo_id, 'full' ),
        'review' => [],
    );

    if ( $agg_values ) {
        $schema['aggregateRating'] = array(
            '@type' => 'AggregateRating',
            'ratingValue' => $agg_values['value'],
            'reviewCount' => $agg_values['count'],
        );
    }

    foreach ( $testimonials as $testimonial ) {
        array_push( $schema['review'], mp_generate_testimonial_schema( $testimonial ) );
    }

    echo '<!-- SCHEMA: Testimonials -->';
    echo '<script type="application/ld+json">';
    echo json_encode( $schema );
    echo '</script>';
}

/**
 * generates the schema markup for a practice area
 * @param $practice_area
 */
function mp_generate_practice_area_schema( $practice_area, $agg_values = null ) {
    $pa_testimonials = get_field( 'testimonials', $practice_area );

    $schema = array(
        '@context' => "http://schema.org",
        '@type' => "Product",
        'description' => get_post_meta($practice_area->ID, '_yoast_wpseo_metadesc', true),
        'name' => get_the_title($practice_area),
        'image' => get_the_post_thumbnail_url( $practice_area ),
        'brand' => array(
            'name'  => get_bloginfo( 'name' ),
            'type'  => 'Organization'
        )
    );

    if ( $agg_values ) {
        $schema['aggregateRating'] = array(
            '@type' => 'AggregateRating',
            'ratingValue' => $agg_values['value'],
            'ratingCount' => $agg_values['count'],
            'reviewCount' => $agg_values['count'],
        );
    }

    if ($pa_testimonials && sizeof( $pa_testimonials ) > 0 ) {
        $sample_review = $pa_testimonials[0];
        $schema['review'] = mp_generate_testimonial_schema( $sample_review );
    }

    echo '<!-- SCHEMA: Practice Area -->';
    echo '<script type="application/ld+json">';
    echo json_encode( $schema );
    echo '</script>';
}

/**
 * generates Question+Answer schema markup for a given question and answer string
 * @param $question
 * @param $answer
 * @param false $print_out
 */
function mp_generate_question_answer_schema( $question, $answer, $print_out = false ) {
    $schema = array(
        '@context' => "http://schema.org",
        '@type' => "Question",
        'name' => $question,
        'acceptedAnswer' => array(
            '@type' => 'Answer',
            'text'  => $answer
        )
    );

    if ( $print_out ) {
        echo '<!-- SCHEMA: FAQ -->';
        echo '<script type="application/ld+json">';
        echo json_encode( $schema );
        echo '</script>';
    }

    return $schema;
}

function mp_generate_faq_page_schema( $faq_markup, $comment = '' ) {
    $schema = array(
        '@context' => "http://schema.org",
        '@type' => "FAQPage",
        'mainEntity' => $faq_markup
    );

    printf('<!-- SCHEMA: %s -->', $comment );
    echo '<script type="application/ld+json">';
    echo json_encode( $schema );
    echo '</script>';
}

/**
 * Generates Person schema for an attorney.
 *
 * @param WP_Post $attorney
 */
function mp_generate_attorney_schema( WP_Post $attorney ): void {
    $custom_logo_id = get_theme_mod( 'custom_logo' );

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => array( 'Person', 'Attorney' ),
        'name'        => get_the_title( $attorney ),
        'description' => get_the_excerpt( $attorney ),
        'url'         => get_permalink( $attorney ),
        'image'       => get_the_post_thumbnail_url( $attorney, 'attorney-headshot-square' ),
        'jobTitle'    => function_exists( 'get_field' ) ? get_field( 'job_title', $attorney ) : '',
        'email'       => function_exists( 'get_field' ) ? get_field( 'email', $attorney ) : '',
        'telephone'   => function_exists( 'get_field' ) ? get_field( 'phone_direct', $attorney ) : '',
        'worksFor'    => array(
            '@type' => 'LegalService',
            'name'  => get_bloginfo( 'name' ),
            'url'   => get_site_url(),
            'logo'  => wp_get_attachment_image_url( $custom_logo_id, 'full' ),
        ),
    );

    // Attach sameAs from LinkedIn if set.
    $linkedin = function_exists( 'get_field' ) ? get_field( 'social_linkedin', $attorney ) : '';
    if ( $linkedin ) {
        $schema['sameAs'] = array( $linkedin );
    }

    // Attach knowsAbout from related practice areas.
    $practice_areas = function_exists( 'get_field' ) ? get_field( 'practice_areas', $attorney ) : array();
    if ( ! empty( $practice_areas ) ) {
        $schema['knowsAbout'] = wp_list_pluck( (array) $practice_areas, 'post_title' );
    }

    echo '<!-- SCHEMA: Attorney -->';
    echo '<script type="application/ld+json">';
    echo wp_json_encode( $schema );
    echo '</script>';
}

/**
 * Generates JobPosting schema for a career listing.
 *
 * @param WP_Post $career
 */
function mp_generate_career_schema( WP_Post $career ): void {
    $closing_date    = function_exists( 'get_field' ) ? get_field( 'closing_date', $career ) : '';
    $employment_type = function_exists( 'get_field' ) ? get_field( 'employment_type', $career ) : 'FULL_TIME';
    $remote_option   = function_exists( 'get_field' ) ? get_field( 'remote_option', $career ) : 'ONSITE';
    $salary_range    = function_exists( 'get_field' ) ? get_field( 'salary_range', $career ) : '';
    $office          = function_exists( 'get_field' ) ? get_field( 'office', $career ) : null;

    $schema = array(
        '@context'         => 'https://schema.org',
        '@type'            => 'JobPosting',
        'title'            => get_the_title( $career ),
        'description'      => get_the_content( null, false, $career ),
        'datePosted'       => get_the_date( 'Y-m-d', $career ),
        'employmentType'   => $employment_type,
        'hiringOrganization' => array(
            '@type' => 'Organization',
            'name'  => get_bloginfo( 'name' ),
            'url'   => get_site_url(),
        ),
        'jobLocationType'  => 'REMOTE' === $remote_option ? 'TELECOMMUTE' : null,
    );

    // Add validThrough if a closing date is set.
    if ( $closing_date ) {
        $schema['validThrough'] = $closing_date . 'T23:59:59';
    }

    // Add salary if provided.
    if ( $salary_range ) {
        $schema['baseSalary'] = array(
            '@type'    => 'MonetaryAmount',
            'currency' => 'USD',
            'value'    => array(
                '@type'    => 'QuantitativeValue',
                'value'    => $salary_range,
                'unitText' => 'YEAR',
            ),
        );
    }

    // Pull location from the linked Office post.
    if ( $office instanceof WP_Post ) {
        $address = function_exists( 'get_field' ) ? get_field( 'address', $office ) : array();
        if ( ! empty( $address ) ) {
            $schema['jobLocation'] = array(
                '@type'   => 'Place',
                'address' => array(
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => $address['street'] . ( ! empty( $address['street2'] ) ? ', ' . $address['street2'] : '' ),
                    'addressLocality' => $address['city'],
                    'addressRegion'   => $address['state'],
                    'postalCode'      => $address['postal_code'],
                    'addressCountry'  => 'US',
                ),
            );
        }
    }

    // Null values must be removed — schema.org validators reject them.
    $schema = array_filter( $schema, fn( $v ) => null !== $v );

    echo '<!-- SCHEMA: Career/JobPosting -->';
    echo '<script type="application/ld+json">';
    echo wp_json_encode( $schema );
    echo '</script>';
}

/**
 * Generates BreadcrumbList schema for the current page.
 *
 * Builds from the current URL path, using WordPress hierarchy.
 * Runs on all singular pages and archives.
 */
function mp_generate_breadcrumb_schema(): void {
    $items = array();
    $pos   = 1;

    // Always start with home.
    $items[] = array(
        '@type'    => 'ListItem',
        'position' => $pos++,
        'name'     => get_bloginfo( 'name' ),
        'item'     => get_site_url(),
    );

    // CPT archive breadcrumb.
    if ( is_singular() ) {
        $post_type = get_post_type();
        $pt_obj    = get_post_type_object( $post_type );

        if ( $pt_obj && $pt_obj->has_archive ) {
            $items[] = array(
                '@type'    => 'ListItem',
                'position' => $pos++,
                'name'     => $pt_obj->labels->name,
                'item'     => get_post_type_archive_link( $post_type ),
            );
        }

        // Parent post for hierarchical CPTs (e.g. Personal Injury > Car Accidents).
        $parent_id = wp_get_post_parent_id( get_the_ID() );
        if ( $parent_id ) {
            $items[] = array(
                '@type'    => 'ListItem',
                'position' => $pos++,
                'name'     => get_the_title( $parent_id ),
                'item'     => get_permalink( $parent_id ),
            );
        }

        // Current page.
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $pos,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        );
    }

    if ( count( $items ) <= 1 ) {
        return; // No breadcrumb on home.
    }

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    );

    echo '<!-- SCHEMA: BreadcrumbList -->';
    echo '<script type="application/ld+json">';
    echo wp_json_encode( $schema );
    echo '</script>';
}

