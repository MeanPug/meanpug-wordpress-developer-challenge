<?php

#-- Default Hooks
add_filter( 'block_categories_all', 'inf_block_categories', 10, 2 );
function inf_block_categories( $categories ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'pug-puggle-blocks',
                'title' => __( 'Pug & Puggle Blocks', 'inf' ),
            ],
        ]
    );
}

# Block Editor Config
function mp_parent_block_categories( $categories ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'mp-parent',
                'title' => __( 'Parent Theme Blocks', 'inf' ),
            ]
        ]
    );
}
add_filter( 'block_categories_all', 'mp_parent_block_categories', 10, 2 );

# Fix SVG
function mp_fix_svg() {
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'mp_fix_svg' );

# Content Type Schema Output
function mp_output_default_schema_for_post() {
    global $post;
    global $wp_query;

    if ( is_singular( 'office' ) ) {
        mp_generate_office_schema( $post );
    } else {
        mp_generate_local_business_schema();
    }

    if ( is_singular( 'practice-area' ) ) {
        mp_generate_practice_area_schema( $post, get_field('schema_aggregate_rating', 'option' ) );
    } elseif ( is_post_type_archive( 'testimonials' ) ) {
        $testimonials = get_posts( array( 'post_type' => 'testimonials', 'numberposts' => 15 ) );
        mp_generate_testimonials_schema( $testimonials, null, null, get_field('schema_aggregate_rating', 'option' ) );
    }
}
add_action('wp_footer', 'mp_output_default_schema_for_post');

# outputs any additional for a post/page not covered by the default schema definitions
function mp_output_additional_schema_for_post() {
    if ( is_singular( array( 'post', 'practice-area' ) ) ) {
        $faq_items = get_field('schema_faq_items');

        if ( $faq_items && sizeof( $faq_items ) > 0 ) {
            $faq_markup = array();
            foreach ( $faq_items as $faq_item ) {
                $faq_markup[] = mp_generate_question_answer_schema( $faq_item['question'], $faq_item['answer'] );
            }

            mp_generate_faq_page_schema( $faq_markup, 'Post FAQ' );
        }
    }
}
add_action('wp_footer', 'mp_output_additional_schema_for_post');

##-- MPD
add_action('mpdcontent/ask-question/submission', function($data) {
  GFAPI::add_entry(array(
    '1' => $data['question'],
    '4' => $data['name'],
    '6' => $data['email'],
    '7' => $data['content'],
    'form_id'   => get_field('ask_a_question_form_id', 'option'),
  ));
});

add_action('mpdcontent/ask-question/submission', function($data) {
  GFAPI::submit_form(
    get_field('ask_a_question_form_id', 'option'),
    array(
      'input_1' => $data['question'],
      'input_4' => $data['name'],
      'input_6' => $data['email'],
      'input_7' => $data['content']
    )
  );
});

add_action('mpdreviews/new-reviews', function( $new_reviews ) {
    if ( ! is_array( $new_reviews ) ) {
        return;
    }

    foreach ( $new_reviews as $review ) {
        $title  = isset( $review['title'] ) ? sanitize_text_field( $review['title'] ) : '';
        $body   = isset( $review['body'] ) ? wp_kses_post( $review['body'] ) : '';
        $rating = isset( $review['rating'] ) && is_numeric( $review['rating'] )
            ? max( 1, min( 5, (int) $review['rating'] ) )
            : 0;
        $reviewer_name = isset( $review['reviewer']['name'] )
            ? sanitize_text_field( $review['reviewer']['name'] )
            : '';

        if ( '' === $title && '' === $body ) {
            continue;
        }

        $post_id = wp_insert_post(
            [
                'post_title'    => $title,
                'post_content'  => $body,
                'post_status'   => 'publish',
                'post_category' => [],
                'post_type'     => 'testimonials',
                'tags_input'    => [],
            ],
            true
        );

        if ( is_wp_error( $post_id ) || ! $post_id ) {
            continue;
        }

        if ( function_exists( 'update_field' ) ) {
            if ( $rating > 0 ) {
                update_field( 'rating', $rating, $post_id );
            }
            if ( '' !== $reviewer_name ) {
                update_field( 'reviewer', [ 'name' => $reviewer_name ], $post_id );
            }
        }
    }
});
