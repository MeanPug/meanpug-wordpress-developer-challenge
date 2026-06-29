<?php

function inf_get_schema_faq_items( $post_id = null ) {
	$group = get_field( 'schema_faq_items', $post_id );

	if ( ! $group || ! is_array( $group ) ) {
		return array();
	}

	$items = array();

	foreach ( array( 'faq_1', 'faq_2', 'faq_3' ) as $slot ) {
		if ( empty( $group[ $slot ]['question'] ) ) {
			continue;
		}

		$items[] = array(
			'question' => $group[ $slot ]['question'],
			'answer'   => $group[ $slot ]['answer'] ?? '',
		);
	}

	return $items;
}

function inf_get_social_profile_urls() {
	$social = get_field( 'social_profiles', 'option' );

	if ( ! $social || ! is_array( $social ) ) {
		return array();
	}

	$urls = array();

	foreach ( array( 'facebook_url', 'linkedin_url', 'twitter_url' ) as $key ) {
		if ( ! empty( $social[ $key ] ) ) {
			$urls[] = $social[ $key ];
		}
	}

	return $urls;
}

function inf_review_schema_for_testimonial( $testimonial ) {
    $reviewer = get_field( 'reviewer', $testimonial );
    $rating   = get_field( 'rating', $testimonial ) ?: 5;

    return array(
        '@type'         => 'Review',
        'author'        => array(
            '@type' => 'Person',
            'name'  => $reviewer['name'] ?? get_the_title( $testimonial ),
        ),
        'datePublished' => get_the_date( 'Y-m-d', $testimonial ),
        'reviewBody'    => get_the_content( null, false, $testimonial ),
        'name'          => get_the_title( $testimonial ),
        'reviewRating'  => array(
            '@type'       => 'Rating',
            'bestRating'  => '5',
            'ratingValue' => (string) $rating,
            'worstRating' => '0',
        ),
    );
}

function inf_add_reviews_schema_for_post( $content ) {
    if ( is_singular( array( 'practice-area' ) ) ) {
        $testimonials = get_field( 'testimonials' );

        if ( $testimonials ) {
            $review_schema_array = array();
            foreach ( $testimonials as $testimonial ) {
                $review_schema = inf_review_schema_for_testimonial( $testimonial );
                array_push( $review_schema_array, $review_schema );
            }

            $output_schema = array(
                "@context"  => "http://schema.org",
                "@graph"    => $review_schema_array
            );

            $html_segment = sprintf( '<script type="application/ld+json" id="inf-post-reviews-schema">%s</script>', wp_json_encode( $output_schema ));
            $content = $content . $html_segment;
        }
    }

    return $content;
}

add_filter( 'the_content', 'inf_add_reviews_schema_for_post' );
