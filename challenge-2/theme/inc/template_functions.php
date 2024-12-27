<?php

function inf_get_asset_url($path) {
    return sprintf('%s/assets/%s', get_template_directory_uri(), $path);
}

function inf_acf_link($link_field, $class='') {
  printf('<a href=%s class="%s">%s</a>', $link_field['url'], $class, $link_field['title']);
}

// Automatically Create Terms for Taxonomies on Publish
function auto_create_terms_for_taxonomies( $post_id, $post, $update ) {
  // Prevent the function from running on auto-saves or revisions to avoid infinite loops
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

  // Prevent this function from running for manual updates (when post is not published)
  if ( $update && 'publish' !== $post->post_status ) return;

  // Run the code only after the post is fully saved and published
  if ( 'publish' === $post->post_status ) {
      // Schedule the term creation to run after the post is fully saved
      wp_schedule_single_event( time() + 1, 'create_terms_for_taxonomies', array( $post_id ) );
  }
}
add_action( 'save_post', 'auto_create_terms_for_taxonomies', 20, 3 );

// Create terms after the post has been fully saved
function create_terms_for_taxonomies( $post_id ) {
  $post = get_post( $post_id );

  // Handle 'Team' Post Type
  if ( 'team' === $post->post_type ) {

      // Get the assigned terms for the 'staff_type' taxonomy
      $staff_type_terms = wp_get_post_terms( $post->ID, 'staff_type' );

      // Check if the post is assigned to the 'Attorney' staff type; assuming only attorneys will be needed in taxonomy.
      $is_attorney = false;
      foreach ( $staff_type_terms as $term ) {
          if ( 'attorney' === $term->slug ) {
              $is_attorney = true;
              break;
          }
      }

      // If the post is assigned to 'Attorney', create a new term in the 'team_member' taxonomy
      if ( $is_attorney ) {
          if ( !term_exists( $post->post_title, 'team_member' ) ) {
              wp_insert_term( $post->post_title, 'team_member' );
          }
      }
  }

  // Practice Areas Post Type - Create term in 'practice_area'
  if ( 'practice_areas' === $post->post_type ) {
      if ( !term_exists( $post->post_title, 'practice_area' ) ) {
          wp_insert_term( $post->post_title, 'practice_area' );
      }
  }

  // Cases Post Type - Create term in 'cases'
  if ( 'cases' === $post->post_type ) {
      if ( !term_exists( $post->post_title, 'cases' ) ) {
          wp_insert_term( $post->post_title, 'cases' );
      }
  }
}
add_action( 'create_terms_for_taxonomies', 'create_terms_for_taxonomies', 10, 1 );
